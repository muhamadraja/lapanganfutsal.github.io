<?php

namespace Database\Seeders;

use App\Models\Lapangan;
use Illuminate\Database\Seeder;

class LapanganSeeder extends Seeder
{
    public function run(): void
    {
        if (Lapangan::count() > 0) {
            return;
        }

        $data = [
            [
                'nama_lapangan' => 'Lapangan Badminton 1',
                'jenis_lapangan' => 'Indoor',
                'harga_per_jam' => 25000,
                'kapasitas' => 4,
                'lokasi' => 'Area Olahraga UIN Raden Fatah',
                'fasilitas' => 'Lampu LED, tempat duduk, parkir',
                'deskripsi' => 'Lapangan indoor untuk permainan badminton tunggal maupun ganda.',
            ],
            [
                'nama_lapangan' => 'Lapangan Badminton 2',
                'jenis_lapangan' => 'Indoor',
                'harga_per_jam' => 25000,
                'kapasitas' => 4,
                'lokasi' => 'Area Olahraga UIN Raden Fatah',
                'fasilitas' => 'Lampu LED, tempat duduk, parkir',
                'deskripsi' => 'Lapangan indoor dengan area bermain yang nyaman untuk civitas kampus.',
            ],
            [
                'nama_lapangan' => 'Lapangan Badminton 3',
                'jenis_lapangan' => 'Karpet',
                'harga_per_jam' => 30000,
                'kapasitas' => 4,
                'lokasi' => 'Area Olahraga UIN Raden Fatah',
                'fasilitas' => 'Karpet badminton, lampu, tempat duduk',
                'deskripsi' => 'Lapangan dengan permukaan karpet untuk pengalaman bermain yang nyaman.',
            ],
        ];

        foreach ($data as $item) {
            Lapangan::create($item);
        }
    }
}
