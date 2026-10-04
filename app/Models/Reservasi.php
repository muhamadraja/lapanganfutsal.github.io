<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasis';

    protected $fillable = [
        'user_id',
        'lapangan_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'durasi_jam',
        'total_harga',
        'status',
        'metode_pembayaran',
        'status_pembayaran',
        'dibayar_pada',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'total_harga' => 'integer',
        'durasi_jam' => 'integer',
        'dibayar_pada' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class);
    }
}

