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
                'nama_lapangan' => 'Lapangan Futsal 1',
                'jenis_lapangan' => 'Indoor',
                'harga_per_jam' => 25000,
                'kapasitas' => 4,
                'lokasi' => 'Area Olahraga UIN Raden Fatah',
                'fasilitas' => 'Lampu LED, tempat duduk, parkir',
                'deskripsi' => 'Lapangan indoor untuk permainan futsal tunggal maupun ganda.',
            ],
            [
                'nama_lapangan' => 'Lapangan Futsal 2',
                'jenis_lapangan' => 'Indoor',
                'harga_per_jam' => 25000,
                'kapasitas' => 4,
                'lokasi' => 'Area Olahraga UIN Raden Fatah',
                'fasilitas' => 'Lampu LED, tempat duduk, parkir',
                'deskripsi' => 'Lapangan indoor dengan area bermain yang nyaman untuk civitas kampus.',
            ],
            [
                'nama_lapangan' => 'Lapangan Futsal 3',
                'jenis_lapangan' => 'Indoor',
                'harga_per_jam' => 30000,
                'kapasitas' => 4,
                'lokasi' => 'Area Olahraga UIN Raden Fatah',
                'fasilitas' => 'Karpet futsal, lampu, tempat duduk',
                'deskripsi' => 'Lapangan dengan permukaan karpet untuk pengalaman bermain yang nyaman.',
            ],
        ];

        foreach ($data as $item) {
            Lapangan::create($item);
        }
    }
}
