<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Lapangan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'lapangan_id' => 'required|exists:lapangans,id',
            'tanggal' => 'required|date|after_or_equal:today',
            'jam_mulai' => ['required', 'date_format:H:i'],
            'jam_selesai' => ['required', 'date_format:H:i', 'after:jam_mulai'],
        ], [
            'tanggal.after_or_equal' => 'Tanggal bermain tidak boleh sebelum hari ini.',
            'jam_selesai.after' => 'Jam selesai harus setelah jam mulai.',
        ]);

        $lapangan = Lapangan::findOrFail($request->lapangan_id);

        $mulai = Carbon::createFromFormat('H:i', $request->jam_mulai);
        $selesai = Carbon::createFromFormat('H:i', $request->jam_selesai);

        $durasi = $mulai->diffInMinutes($selesai) / 60;

        if ($durasi <= 0 || $durasi > 6 || $durasi != floor($durasi)) {
            return back()
                ->withErrors([
                    'jam_selesai' => 'Durasi reservasi harus dalam kelipatan 1 jam dan maksimal 6 jam.'
                ])
                ->withInput();
        }

        $bentrok = Reservasi::where('lapangan_id', $lapangan->id)
            ->whereDate('tanggal', $request->tanggal)
            ->whereIn('status', ['menunggu', 'disetujui'])
            ->where(function ($query) use ($request) {
                $query->where('jam_mulai', '<', $request->jam_selesai)
                    ->where('jam_selesai', '>', $request->jam_mulai);
            })
            ->exists();

        if ($bentrok) {
            return back()
                ->withErrors([
                    'jam_mulai' => 'Jadwal tersebut sudah dipesan. Silakan pilih jam lain.'
                ])
                ->withInput();
        }

        $total = (int) round($durasi * $lapangan->harga_per_jam);

        Reservasi::create([
            'user_id' => auth()->id(),
            'lapangan_id' => $lapangan->id,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'durasi_jam' => $durasi,
            'total_harga' => $total,
            'status' => 'menunggu',
            'metode_pembayaran' => null,
            'status_pembayaran' => 'belum_bayar',
            'dibayar_pada' => null,
        ]);

        return redirect()
            ->route('reservasi.saya')
            ->with('success', 'Reservasi berhasil dibuat dan menunggu konfirmasi admin.');
    }

    public function listUser(Request $request)
    {
        $tanggal = $request->tanggal ?? now()->toDateString();

        $data = Lapangan::latest()->get();

        foreach ($data as $lapangan) {
            $lapangan->reservasiHariIni = Reservasi::where('lapangan_id', $lapangan->id)
                ->whereDate('tanggal', $tanggal)
                ->whereIn('status', ['menunggu', 'disetujui'])
                ->orderBy('jam_mulai')
                ->get();
        }

        return view(
            'tamu.lapangan.index',
            compact('data', 'tanggal')
        );
    }

    public function reservasiSaya()
    {
        $data = Reservasi::with('lapangan')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view(
            'tamu.reservasi.index',
            compact('data')
        );
    }

    public function indexAdmin()
    {
        $reservasis = Reservasi::with(['user', 'lapangan'])
            ->latest()
            ->get();

        return view(
            'admin.reservasi.index',
            compact('reservasis')
        );
    }

    public function approve($id)
    {
        $reservasi = Reservasi::findOrFail($id);

        if ($reservasi->status !== 'menunggu') {
            return back()->with(
                'error',
                'Reservasi sudah diproses.'
            );
        }

        $bentrok = Reservasi::where('id', '!=', $reservasi->id)
            ->where('lapangan_id', $reservasi->lapangan_id)
            ->whereDate('tanggal', $reservasi->tanggal)
            ->whereIn('status', ['menunggu', 'disetujui'])
            ->where('jam_mulai', '<', $reservasi->jam_selesai)
            ->where('jam_selesai', '>', $reservasi->jam_mulai)
            ->exists();

        if ($bentrok) {
            $reservasi->update([
                'status' => 'ditolak'
            ]);

            return back()->with(
                'error',
                'Jadwal bentrok dengan reservasi lain. Reservasi otomatis ditolak.'
            );
        }

        $reservasi->update([
            'status' => 'disetujui'
        ]);

        return back()->with(
            'success',
            'Reservasi telah disetujui.'
        );
    }

    public function reject($id)
    {
        $reservasi = Reservasi::findOrFail($id);

        $reservasi->update([
            'status' => 'ditolak'
        ]);

        return back()->with(
            'success',
            'Reservasi telah ditolak.'
        );
    }
}

