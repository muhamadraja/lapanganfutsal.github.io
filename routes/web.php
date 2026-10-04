```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PembayaranController;


/*
|--------------------------------------------------------------------------
| HALAMAN UTAMA
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])
    ->name('home');


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    // Kelola lapangan
    Route::resource('/admin/lapangan', LapanganController::class);

    // Kelola reservasi
    Route::get(
        '/admin/reservasi',
        [ReservasiController::class, 'indexAdmin']
    )->name('admin.reservasi');

    // Setujui reservasi
    Route::get(
        '/admin/reservasi/{id}/approve',
        [ReservasiController::class, 'approve']
    )->name('admin.reservasi.approve');

    // Tolak reservasi
    Route::get(
        '/admin/reservasi/{id}/reject',
        [ReservasiController::class, 'reject']
    )->name('admin.reservasi.reject');
});


/*
|--------------------------------------------------------------------------
| PENGGUNA / TAMU
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Daftar lapangan
    Route::get(
        '/lapangan',
        [LapanganController::class, 'listUser']
    )->name('lapangan.list');


    // Detail lapangan
    Route::get(
        '/lapangan/{id}',
        [LapanganController::class, 'detail']
    )->name('lapangan.detail');


    // Membuat reservasi
    Route::post(
        '/reservasi',
        [ReservasiController::class, 'store']
    )->name('reservasi.store');


    // Reservasi saya
    Route::get(
        '/reservasi/saya',
        [ReservasiController::class, 'reservasiSaya']
    )->name('reservasi.saya');
});


/*
|--------------------------------------------------------------------------
| PEMBAYARAN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Halaman pilihan pembayaran
    Route::get(
        '/pembayaran/{id}',
        [PembayaranController::class, 'index']
    )->name('pembayaran.index');


    // Simpan metode pembayaran
    Route::post(
        '/pembayaran/{id}/bayar',
        [PembayaranController::class, 'bayar']
    )->name('pembayaran.bayar');


    // Konfirmasi pembayaran
    Route::get(
        '/pembayaran/{id}/konfirmasi',
        [PembayaranController::class, 'konfirmasi']
    )->name('pembayaran.konfirmasi');


    // Proses pembayaran
    Route::post(
        '/pembayaran/{id}/proses',
        [PembayaranController::class, 'prosesPembayaran']
    )->name('pembayaran.proses');


    // Pembayaran berhasil
    Route::get(
        '/pembayaran/{id}/berhasil',
        [PembayaranController::class, 'berhasil']
    )->name('pembayaran.berhasil');

});
