<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\PosDamkar;
use App\Models\TepiJalan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LaporanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelapor' => 'required',
            'nama_lokasi' => 'required',
            'keterangan' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'foto' => 'nullable|image|max:10240',
        ]);

        $posDamkars = PosDamkar::all();
        $closestPos = $this->getClosestPosDamkar($request->latitude, $request->longitude, $posDamkars);

        if (!$closestPos) {
            return back()->with('error', 'Tidak ada pos damkar terdekat ditemukan.');
        }

        $laporan = Laporan::create([
            'nama_pelapor' => $request->nama_pelapor,
            'nama_lokasi' => $request->nama_lokasi,
            'keterangan' => $request->keterangan,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'pos_damkar_id' => $closestPos->id,
            'status' => 'masuk',
            'foto' => $request->hasFile('foto') ? $request->file('foto')->store('foto_bukti', 'public') : null,
        ]);
        
        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dibuat! Laporan Anda akan segera diproses.');
        
    }

    private function getClosestPosDamkar($latitude, $longitude, $posDamkars)
{
    // Mengambil ID pos damkar yang terdekat
    $startPos = $this->getClosestPosStart($latitude, $longitude, $posDamkars);
    if (!$startPos) return null;

    // Caching untuk graph dan hasil Dijkstra
    $cacheKey = "graph_cache_" . implode('_', array_map(fn($pos) => $pos->id, $posDamkars->all()));

    $distances = Cache::remember($cacheKey, 60, function () use ($posDamkars, $startPos) {
        $graph = $this->buildGraph($posDamkars);
        return $this->dijkstra($graph, $startPos); // Mengirim ID pos damkar ke dijkstra
    });

    // Menentukan pos damkar terdekat
    $closestPosId = $this->findClosestPosId($distances);

    return PosDamkar::find($closestPosId); // Mengembalikan objek PosDamkar berdasarkan ID terdekat
}


private function buildGraph($posDamkars)
{
    $graph = [];

    // Menggunakan query yang lebih efisien daripada TepiJalan::all()
    $edges = TepiJalan::select('node_awal', 'node_tujuan', 'jarak')->get();

    foreach ($edges as $edge) {
        $graph[$edge->node_awal][$edge->node_tujuan] = $edge->jarak;
        $graph[$edge->node_tujuan][$edge->node_awal] = $edge->jarak;
    }

    return $graph;
}


    private function dijkstra($graph, $startPos)
    {
        $distances = [];
        $previous = [];
        $queue = new \SplPriorityQueue();

        foreach ($graph as $vertex => $edges) {
            $distances[$vertex] = INF;
            $previous[$vertex] = null;
            $queue->insert($vertex, INF);
        }

        $distances[$startPos] = 0;
        $queue->insert($startPos, 0);

        while (!$queue->isEmpty()) {
            $minVertex = $queue->extract();

            foreach ($graph[$minVertex] as $neighbor => $weight) {
                $alt = $distances[$minVertex] + $weight;

                if ($alt < $distances[$neighbor]) {
                    $distances[$neighbor] = $alt;
                    $previous[$neighbor] = $minVertex;
                    $queue->insert($neighbor, $alt);
                }
            }
        }

        return $distances;
    }

    private function findClosestPosId($distances)
    {
        return array_search(min($distances), $distances);
    }

    private function getClosestPosStart($latitude, $longitude, $posDamkars)
    {
        $minDistance = PHP_INT_MAX;
        $startPos = null;

        foreach ($posDamkars as $pos) {
            $distance = $this->calculateDistance($latitude, $longitude, $pos->latitude, $pos->longitude);
            if ($distance < $minDistance) {
                $minDistance = $distance;
                $startPos = $pos->id;
            }
        }

        return $startPos;
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371;
        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lon1);
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($lon2);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $a = sin($latDelta / 2) ** 2 +
            cos($latFrom) * cos($latTo) *
            sin($lonDelta / 2) ** 2;
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }

    public function masuk()
    {
        // Mengambil laporan dengan status 'masuk', diurutkan berdasarkan 'created_at' terbaru, dan menampilkan 10 laporan per halaman
        $laporanMasuk = Laporan::where('status', 'masuk')
                              ->orderBy('created_at', 'desc') // Urutkan berdasarkan waktu terbaru
                              ->paginate(10); // Pagination 10 laporan per halaman
    
        return view('admin.laporan_masuk', compact('laporanMasuk'));
    }
    

    public function diterima()
{
    $laporanDiterima = Laporan::where('status', 'diterima')->get();
    return view('laporan.laporan_diterima', compact('laporanDiterima'));
}

    



    public function terima($laporanId)
{
    // Cari laporan berdasarkan ID
    $laporan = Laporan::findOrFail($laporanId);

    // Update status laporan menjadi 'diterima'
    $laporan->status = 'diterima';
    
    // Simpan perubahan ke database
    $laporan->save();

    // Arahkan ke halaman laporan diterima dengan pesan sukses
    return redirect()->route('admin.laporan.diterima')->with('success', 'Laporan berhasil diterima.');
}


    public function show($laporanId)
{
    $laporan = Laporan::with('posDamkar')->findOrFail($laporanId);
    return view('admin.laporan_detail', compact('laporan'));
}


    public function index()
    {
        return view('laporan.index');
    }
}
