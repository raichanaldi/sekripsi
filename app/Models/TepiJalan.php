<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TepiJalan extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan
    protected $table = 'tepi_jalan';

    // Menentukan kolom yang bisa diisi
    protected $fillable = [
        'pos_damkar_id', // ID Pos Damkar asal
        'dest_pos_damkar_id', // ID Pos Damkar tujuan
        'jarak', // Jarak antara pos damkar
    ];

    // Relasi ke Pos Damkar (Pos Damkar Asal)
    public function posDamkar()
    {
        return $this->belongsTo(PosDamkar::class, 'pos_damkar_id');
    }

    // Relasi ke Pos Damkar (Pos Damkar Tujuan)
    public function destPosDamkar()
    {
        return $this->belongsTo(PosDamkar::class, 'dest_pos_damkar_id');
    }
}

