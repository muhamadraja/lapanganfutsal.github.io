<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lapangan',
        'jenis_lapangan',
        'harga_per_jam',
        'kapasitas',
        'fasilitas',
        'deskripsi',
        'foto',
    ];

    public function reservasis()
    {
        return $this->hasMany(Reservasi::class);
    }
}