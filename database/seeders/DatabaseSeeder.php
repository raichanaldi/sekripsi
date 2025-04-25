<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat akun admin
        User::create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password123'),
        ]);

        // Menambahkan data Pos Damkar
        $this->call(PosDamkarSeeder::class);  // Panggil PosDamkarSeeder
    }
}

