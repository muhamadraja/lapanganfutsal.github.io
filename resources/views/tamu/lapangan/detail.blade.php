@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('lapangan.list') }}" class="btn btn-outline-secondary mb-3"><i class="fa-solid fa-arrow-left"></i> Kembali</a>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card shadow-sm overflow-hidden">
                @if($lapangan->foto)
                    <img src="{{ asset('storage/'.$lapangan->foto) }}" class="w-100" style="height:380px;object-fit:cover;" alt="{{ $lapangan->nama_lapangan }}">
                @else
                    <div class="d-flex align-items-center justify-content-center bg-success-subtle text-success" style="height:380px;">
                        <i class="fa-solid fa-table-tennis-paddle-ball fa-6x"></i>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-body p-4">
                    <span class="badge bg-success mb-2">{{ $lapangan->jenis_lapangan }}</span>
                    <h2 class="page-title">{{ $lapangan->nama_lapangan }}</h2>
                    <p class="text-muted"><i class="fa-solid fa-location-dot"></i> {{ $lapangan->lokasi }}</p>
                    <h4 class="text-success">Rp {{ number_format($lapangan->harga_per_jam,0,',','.') }} <small class="text-muted fs-6">/ jam</small></h4>
                    <hr>
                    <h6 class="fw-bold">Informasi</h6>
                    <p class="mb-2"><i class="fa-solid fa-users text-success"></i> Kapasitas: {{ $lapangan->kapasitas }} orang</p>
                    <p class="mb-2"><i class="fa-solid fa-list-check text-success"></i> Fasilitas: {{ $lapangan->fasilitas ?: 'Belum diisi' }}</p>
                    <p class="text-muted">{{ $lapangan->deskripsi ?: 'Lapangan badminton untuk kegiatan olahraga civitas UIN Raden Fatah.' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-body p-4">
            <h3 class="fw-bold mb-1"><i class="fa-solid fa-calendar-check text-success"></i> Form Reservasi</h3>
            <p class="text-muted">Pilih tanggal dan jam bermain. Durasi maksimal 6 jam.</p>

            <form action="{{ route('reservasi.store') }}" method="POST">
                @csrf
                <input type="hidden" name="lapangan_id" value="{{ $lapangan->id }}">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tanggal Bermain</label>
                        <input type="date" name="tanggal" min="{{ date('Y-m-d') }}" value="{{ old('tanggal') }}" class="form-control @error('tanggal') is-invalid @enderror" required>
                        @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Jam Mulai</label>
                        <input type="time" name="jam_mulai" value="{{ old('jam_mulai','08:00') }}" class="form-control @error('jam_mulai') is-invalid @enderror" required>
                        @error('jam_mulai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Jam Selesai</label>
                        <input type="time" name="jam_selesai" value="{{ old('jam_selesai','10:00') }}" class="form-control @error('jam_selesai') is-invalid @enderror" required>
                        @error('jam_selesai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="alert alert-light border">
                    <i class="fa-solid fa-circle-info text-success"></i>
                    Total harga dihitung otomatis berdasarkan durasi × harga per jam.
                </div>
                <button class="btn btn-success btn-lg w-100"><i class="fa-solid fa-calendar-plus"></i> Ajukan Reservasi</button>
            </form>
        </div>
    </div>
</div>
@endsection
