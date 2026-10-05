@extends('layouts.app')

@section('content')
<div class="container">
    <div class="hero-mini p-4 p-md-5 mb-4 shadow-sm">
        <h2 class="fw-bold"><i class="fa-solid fa-gauge"></i> Dashboard Admin</h2>
        <p class="mb-0">Kelola lapangan futsal dan reservasi UIN RF dari satu halaman.</p>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4"><div class="card shadow-sm p-4"><div class="text-success fs-3"><i class="fa-solid fa-table-tennis-paddle-ball"></i></div><small class="text-muted">Total Lapangan</small><h2 class="fw-bold">{{ \App\Models\Lapangan::count() }}</h2><a href="{{ route('lapangan.index') }}">Kelola lapangan →</a></div></div>
        <div class="col-md-4"><div class="card shadow-sm p-4"><div class="text-primary fs-3"><i class="fa-solid fa-calendar-check"></i></div><small class="text-muted">Total Reservasi</small><h2 class="fw-bold">{{ \App\Models\Reservasi::count() }}</h2><a href="{{ route('admin.reservasi') }}">Lihat reservasi →</a></div></div>
        <div class="col-md-4"><div class="card shadow-sm p-4"><div class="text-warning fs-3"><i class="fa-solid fa-clock"></i></div><small class="text-muted">Menunggu Konfirmasi</small><h2 class="fw-bold">{{ \App\Models\Reservasi::where('status','menunggu')->count() }}</h2><a href="{{ route('admin.reservasi') }}">Proses sekarang →</a></div></div>
    </div>

    <div class="row g-4">
        <div class="col-md-6"><div class="card shadow-sm p-4 h-100"><i class="fa-solid fa-plus-circle fa-3x text-success mb-3"></i><h4>Tambah Lapangan</h4><p class="text-muted">Masukkan nama, jenis, harga per jam, lokasi, fasilitas, dan foto lapangan.</p><a href="{{ route('lapangan.create') }}" class="btn btn-success">Tambah Lapangan</a></div></div>
        <div class="col-md-6"><div class="card shadow-sm p-4 h-100"><i class="fa-solid fa-calendar-check fa-3x text-primary mb-3"></i><h4>Kelola Reservasi</h4><p class="text-muted">Periksa jadwal pengguna dan konfirmasi reservasi yang masuk.</p><a href="{{ route('admin.reservasi') }}" class="btn btn-primary">Lihat Reservasi</a></div></div>
    </div>
</div>
@endsection
