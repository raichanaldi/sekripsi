<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosDamkar extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan
    protected $table = 'pos_damkars';

    // Menentukan kolom yang bisa diisi
    protected $fillable = [
        'nama', // Nama Pos Damkar
        'latitude', // Latitude Pos Damkar
        'longitude', // Longitude Pos Damkar
    ];

    // Relasi ke TepiJalan (Pos Damkar asal dan tujuan)
    public function tepiJalans()
    {
        return $this->hasMany(TepiJalan::class, 'pos_damkar_id');
    }

    // Relasi ke TepiJalan (Pos Damkar tujuan)
    public function tepiJalanDest()
    {
        return $this->hasMany(TepiJalan::class, 'dest_pos_damkar_id');
    }
}

