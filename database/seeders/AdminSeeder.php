<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Pastikan model User diimport

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Buat akun admin baru
        User::create([
            'username' => 'admin', // Ganti dengan username yang diinginkan
            'password' => bcrypt('password'), // Ganti dengan password yang diinginkan
        ]);
    }
}