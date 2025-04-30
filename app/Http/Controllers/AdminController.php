<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // Method untuk menampilkan halaman login
    public function loginForm()
    {
        return view('admin.login');
    }

    // Method untuk login admin
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('admin.login')->with('error', 'Email atau Password salah!');
    }

    // Method untuk menampilkan halaman dashboard admin + data grafik laporan per bulan
    public function dashboard()
    {
        $laporanPerBulan = Laporan::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'bulan');

        $dataBulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $dataBulan[] = $laporanPerBulan[$i] ?? 0;
        }

        return view('admin.dashboard', [
            'dataBulan' => $dataBulan
        ]);
    }

    // Method untuk logout admin
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    // Menampilkan laporan yang diterima
    public function laporanDiterima()
    {
        $laporanDiterima = Laporan::where('status', 'diterima')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.laporan_diterima', compact('laporanDiterima'));
    }

    // Method untuk menerima laporan dan mengubah status menjadi 'diterima'
    public function terima($laporanId)
    {
        $laporan = Laporan::find($laporanId);

        if (!$laporan) {
            return redirect()->route('laporan.masuk')->with('error', 'Laporan tidak ditemukan.');
        }

        // Ubah status menjadi diterima
        $laporan->status = 'diterima';
        $laporan->save();

        // Redirect ke halaman laporan diterima
        return redirect()->route('laporan.masuk')->with('success', 'Laporan berhasil diterima.');
    }
}
