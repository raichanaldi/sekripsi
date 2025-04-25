<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TepiJalanSeeder extends Seeder
{
    public function run()
    {
        // Mengambil ID dari pos damkar
        $temanggungId = DB::table('pos_damkars')->where('nama_pos', 'Pos Damkar Temanggung')->value('id');
        $candirotoId = DB::table('pos_damkars')->where('nama_pos', 'Pos Damkar Candiroto')->value('id');
        $pringsuratId = DB::table('pos_damkars')->where('nama_pos', 'Pos Damkar Pringsurat')->value('id');

        // Memastikan ID berhasil diambil
        if ($temanggungId && $candirotoId && $pringsuratId) {
            // Melakukan insert ke tabel tepi_jalan jika ID ditemukan
            DB::table('tepi_jalan')->insert([
                ['node_awal' => $temanggungId, 'node_tujuan' => $candirotoId, 'jarak' => 25.8],
                ['node_awal' => $temanggungId, 'node_tujuan' => $pringsuratId, 'jarak' => 17.5],
                ['node_awal' => $candirotoId, 'node_tujuan' => $pringsuratId, 'jarak' => 41.2],
            ]);
            Log::info('Data tepi_jalan berhasil diinsert');
        } else {
            // Menampilkan pesan jika ID tidak ditemukan
            Log::error('Gagal mendapatkan ID dari pos damkar. Pastikan data pos damkar sudah ada.');
            abort(500, 'Gagal mendapatkan ID dari pos damkar');
        }
    }
}
