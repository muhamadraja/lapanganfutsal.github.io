@extends('layouts.app')

@section('content')
<div class="container">
    <div class="hero-mini p-4 p-md-5 mb-4 shadow-sm">
        <h2 class="fw-bold">Halo, {{ auth()->user()->name }}! 👋</h2>
        <p class="mb-0">Selamat datang di UIN RF FUTSAL Reservation. Silakan pilih lapangan dan jadwal bermain.</p>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4"><div class="card shadow-sm p-4"><small class="text-muted">Total Reservasi</small><h2 class="fw-bold">{{ \App\Models\Reservasi::where('user_id',auth()->id())->count() }}</h2><i class="fa-solid fa-calendar-days text-primary fa-2x"></i></div></div>
        <div class="col-md-4"><div class="card shadow-sm p-4"><small class="text-muted">Menunggu</small><h2 class="fw-bold">{{ \App\Models\Reservasi::where('user_id',auth()->id())->where('status','menunggu')->count() }}</h2><i class="fa-solid fa-clock text-warning fa-2x"></i></div></div>
        <div class="col-md-4"><div class="card shadow-sm p-4"><small class="text-muted">Disetujui</small><h2 class="fw-bold">{{ \App\Models\Reservasi::where('user_id',auth()->id())->where('status','disetujui')->count() }}</h2><i class="fa-solid fa-circle-check text-success fa-2x"></i></div></div>
    </div>

    <div class="card shadow-sm p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div><h4 class="fw-bold mb-1">Lapangan Tersedia</h4><p class="text-muted mb-0">Pilih lapangan untuk membuat reservasi.</p></div>
            <a href="{{ route('lapangan.list') }}" class="btn btn-outline-success">Lihat Semua</a>
        </div>
        <div class="row g-3">
            @forelse(\App\Models\Lapangan::take(3)->get() as $lapangan)
                <div class="col-md-4"><div class="border rounded-3 p-3 h-100">
                    <h5 class="fw-bold">{{ $lapangan->nama_lapangan }}</h5>
                    <p class="small text-muted mb-2">{{ $lapangan->jenis_lapangan }} · {{ $lapangan->lokasi }}</p>
                    <div class="fw-bold text-success mb-3">Rp {{ number_format($lapangan->harga_per_jam,0,',','.') }}/jam</div>
                    <a href="{{ route('lapangan.detail',$lapangan->id) }}" class="btn btn-success btn-sm w-100">Pesan</a>
                </div></div>
            @empty
                <div class="col-12 text-center text-muted py-4">Belum ada lapangan.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
