<?php

namespace Database\Seeders;

use App\Models\PosDamkar;
use Illuminate\Database\Seeder;

class PosDamkarSeeder extends Seeder
{
    public function run()
    {
        PosDamkar::insert([
            ['nama_pos' => 'Pos Damkar Temanggung', 'latitude' => -7.2970625, 'longitude' => 110.1827112, 'created_at' => now(), 'updated_at' => now()],
            ['nama_pos' => 'Pos Damkar Candiroto', 'latitude' => -7.1735274, 'longitude' => 110.0651054, 'created_at' => now(), 'updated_at' => now()],
            ['nama_pos' => 'Pos Damkar Pringsurat', 'latitude' => -7.3565132, 'longitude' => 110.2883644, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}


