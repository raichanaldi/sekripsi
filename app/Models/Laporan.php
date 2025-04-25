<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $fillable = [
        'nama_pelapor', 'nama_lokasi', 'keterangan', 'foto', 'latitude', 'longitude', 'pos_damkar_id'
    ];

    public function posDamkar()
    {
        return $this->belongsTo(PosDamkar::class, 'pos_damkar_id');
    }
}

