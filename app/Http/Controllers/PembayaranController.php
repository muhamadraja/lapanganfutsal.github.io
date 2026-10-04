<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    /**
     * Halaman pilihan pembayaran
     */
    public function index($id)
    {
        $reservasi = Reservasi::with('lapangan')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('tamu.pembayaran.index', compact('reservasi'));
    }

    /**
     * Menyimpan metode pembayaran
     */
    public function bayar(Request $request, $id)
    {
        $request->validate([
            'metode_pembayaran' => [
                'required',
                'in:QRIS,Transfer Bank,E-Wallet',
            ],
        ]);

        $reservasi = Reservasi::where('user_id', Auth::id())
            ->findOrFail($id);

        // Jika sudah lunas
        if ($reservasi->status_pembayaran === 'lunas') {
            return redirect()
                ->route('reservasi.saya')
                ->with('info', 'Reservasi ini sudah dibayar.');
        }

        // Simpan metode pembayaran
        $reservasi->update([
            'metode_pembayaran' => $request->metode_pembayaran,
            'status_pembayaran' => 'menunggu',
        ]);

        return redirect()->route(
            'pembayaran.konfirmasi',
            $reservasi->id
        );
    }

    /**
     * Halaman konfirmasi pembayaran
     */
    public function konfirmasi($id)
    {
        $reservasi = Reservasi::with('lapangan')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view(
            'tamu.pembayaran.konfirmasi',
            compact('reservasi')
        );
    }

    /**
     * Proses pembayaran simulasi
     */
    public function prosesPembayaran($id)
    {
        $reservasi = Reservasi::with('lapangan')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        // Jika sudah lunas
        if ($reservasi->status_pembayaran === 'lunas') {
            return redirect()
                ->route('reservasi.saya')
                ->with('info', 'Pembayaran sudah dilakukan.');
        }

        // Pembayaran simulasi berhasil
        $reservasi->update([
            'status_pembayaran' => 'lunas',
            'dibayar_pada' => now(),
            'status' => 'disetujui',
        ]);

        return redirect()
            ->route('pembayaran.berhasil', $id)
            ->with('success', 'Pembayaran berhasil.');
    }

    /**
     * Halaman pembayaran berhasil
     */
    public function berhasil($id)
    {
        $reservasi = Reservasi::with('lapangan')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view(
            'tamu.pembayaran.berhasil',
            compact('reservasi')
        );
    }
}