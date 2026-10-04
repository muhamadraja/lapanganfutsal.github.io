<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LapanganController extends Controller
{
    /**
     * Daftar lapangan untuk admin
     */
    public function index()
    {
        $data = Lapangan::latest()->get();

        return view(
            'admin.lapangan.index',
            compact('data')
        );
    }

    /**
     * Form tambah lapangan
     */
    public function create()
    {
        return view('admin.lapangan.create');
    }

    /**
     * Simpan lapangan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lapangan' => 'required|string|max:100',
            'jenis_lapangan' => 'required|string|max:50',
            'harga_per_jam' => 'required|numeric|min:0',
            'kapasitas' => 'required|integer|min:1',
            'fasilitas' => 'nullable|string|max:500',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->only([
            'nama_lapangan',
            'jenis_lapangan',
            'harga_per_jam',
            'kapasitas',
            'fasilitas',
            'deskripsi',
        ]);

        // Upload foto
        if ($request->hasFile('foto')) {
            $data['foto'] = $request
                ->file('foto')
                ->store('lapangan', 'public');
        }

        Lapangan::create($data);

        return redirect()
            ->route('lapangan.index')
            ->with('success', 'Lapangan berhasil ditambahkan.');
    }

    /**
     * Detail/show lapangan
     */
    public function show($id)
    {
        return redirect()
            ->route('lapangan.detail', $id);
    }

    /**
     * Form edit lapangan
     */
    public function edit($id)
    {
        $lapangan = Lapangan::findOrFail($id);

        return view(
            'admin.lapangan.edit',
            compact('lapangan')
        );
    }

    /**
     * Update data lapangan
     */
    public function update(Request $request, $id)
    {
        $lapangan = Lapangan::findOrFail($id);

        $request->validate([
            'nama_lapangan' => 'required|string|max:100',
            'jenis_lapangan' => 'required|string|max:50',
            'harga_per_jam' => 'required|numeric|min:0',
            'kapasitas' => 'required|integer|min:1',
            'fasilitas' => 'nullable|string|max:500',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->only([
            'nama_lapangan',
            'jenis_lapangan',
            'harga_per_jam',
            'kapasitas',
            'fasilitas',
            'deskripsi',
        ]);

        // Jika upload foto baru
        if ($request->hasFile('foto')) {

            // Hapus foto lama
            if ($lapangan->foto) {
                Storage::disk('public')
                    ->delete($lapangan->foto);
            }

            // Simpan foto baru
            $data['foto'] = $request
                ->file('foto')
                ->store('lapangan', 'public');
        }

        $lapangan->update($data);

        return redirect()
            ->route('lapangan.index')
            ->with('success', 'Data lapangan berhasil diperbarui.');
    }

    /**
     * Hapus lapangan
     */
    public function destroy($id)
    {
        $lapangan = Lapangan::findOrFail($id);

        // Hapus file foto
        if ($lapangan->foto) {
            Storage::disk('public')
                ->delete($lapangan->foto);
        }

        $lapangan->delete();

        return redirect()
            ->route('lapangan.index')
            ->with('success', 'Lapangan berhasil dihapus.');
    }

    /**
     * Daftar lapangan untuk pengguna/tamu
     */
    public function listUser(Request $request)
    {
        // Ambil tanggal dari form.
        // Jika tidak ada, gunakan tanggal hari ini.
        $tanggal = $request->tanggal ?? now()->toDateString();

        // Ambil semua lapangan
        $data = Lapangan::latest()->get();

        // Ambil reservasi pada tanggal yang dipilih
        foreach ($data as $lapangan) {

            $lapangan->reservasiHariIni = Reservasi::where(
                'lapangan_id',
                $lapangan->id
            )
            ->whereDate('tanggal', $tanggal)
            ->whereIn('status', [
                'menunggu',
                'disetujui'
            ])
            ->orderBy('jam_mulai')
            ->get();
        }

        return view(
            'tamu.lapangan.index',
            compact('data', 'tanggal')
        );
    }

    /**
     * Detail lapangan untuk pengguna
     */
    public function detail($id)
    {
        $lapangan = Lapangan::findOrFail($id);

        return view(
            'tamu.lapangan.detail',
            compact('lapangan')
        );
    }
}
