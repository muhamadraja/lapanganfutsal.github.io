@extends('layouts.app')

@section('content')

<div class="container py-4">

```
{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="page-title mb-1">
            Reservasi Saya
        </h2>

        <p class="text-muted mb-0">
            Pantau jadwal, pembayaran, dan status reservasi Anda.
        </p>
    </div>

    <a href="{{ route('lapangan.list') }}" class="btn btn-success">
        <i class="fa-solid fa-plus"></i>
        Reservasi Baru
    </a>
</div>


{{-- PESAN SUKSES --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-circle-check me-2"></i>
        {{ session('success') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
        </button>
    </div>
@endif


{{-- PESAN INFO --}}
@if(session('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-circle-info me-2"></i>
        {{ session('info') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
        </button>
    </div>
@endif


{{-- PESAN ERROR --}}
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-circle-exclamation me-2"></i>
        {{ session('error') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
        </button>
    </div>
@endif


{{-- TABEL RESERVASI --}}
<div class="card shadow-sm border-0">

    <div class="card-header bg-white py-3">
        <h5 class="mb-0">
            <i class="fa-solid fa-calendar-check me-2 text-success"></i>
            Daftar Reservasi
        </h5>
    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>
                        <th>No</th>
                        <th>Lapangan</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Durasi</th>
                        <th>Total</th>
                        <th>Status Reservasi</th>
                        <th>Pembayaran</th>
                    </tr>

                </thead>


                <tbody>

                @forelse($data as $key => $reservasi)

                    <tr>

                        {{-- NOMOR --}}
                        <td>
                            {{ $key + 1 }}
                        </td>


                        {{-- LAPANGAN --}}
                        <td>

                            <strong>
                                {{ $reservasi->lapangan->nama_lapangan }}
                            </strong>

                            <br>

                            <small class="text-muted">
                                <i class="fa-solid fa-location-dot"></i>
                                {{ $reservasi->lapangan->lokasi }}
                            </small>

                        </td>


                        {{-- TANGGAL --}}
                        <td>

                            {{ $reservasi->tanggal->format('d M Y') }}

                        </td>


                        {{-- WAKTU --}}
                        <td>

                            <span class="text-nowrap">

                                {{ \Carbon\Carbon::parse($reservasi->jam_mulai)->format('H:i') }}

                                -

                                {{ \Carbon\Carbon::parse($reservasi->jam_selesai)->format('H:i') }}

                            </span>

                        </td>


                        {{-- DURASI --}}
                        <td>

                            {{ $reservasi->durasi_jam }}

                            jam

                        </td>


                        {{-- TOTAL HARGA --}}
                        <td>

                            <strong class="text-success">

                                Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}

                            </strong>

                        </td>


                        {{-- STATUS RESERVASI --}}
                        <td>

                            @if($reservasi->status === 'menunggu')

                                <span class="badge bg-warning text-dark">
                                    <i class="fa-solid fa-clock me-1"></i>
                                    Menunggu
                                </span>

                            @elseif($reservasi->status === 'disetujui')

                                <span class="badge bg-success">
                                    <i class="fa-solid fa-circle-check me-1"></i>
                                    Disetujui
                                </span>

                            @elseif($reservasi->status === 'ditolak')

                                <span class="badge bg-danger">
                                    <i class="fa-solid fa-circle-xmark me-1"></i>
                                    Ditolak
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    {{ ucfirst($reservasi->status) }}
                                </span>

                            @endif

                        </td>


                        {{-- PEMBAYARAN --}}
                        <td>

                            @if($reservasi->status_pembayaran === 'lunas')

                                <span class="badge bg-success mb-2">
                                    <i class="fa-solid fa-check me-1"></i>
                                    Lunas
                                </span>

                                <br>

                                @if($reservasi->metode_pembayaran)

                                    <small class="text-muted">
                                        {{ $reservasi->metode_pembayaran }}
                                    </small>

                                @endif


                            @elseif($reservasi->status_pembayaran === 'menunggu')

                                <span class="badge bg-warning text-dark mb-2">
                                    <i class="fa-solid fa-clock me-1"></i>
                                    Menunggu Pembayaran
                                </span>

                                <br>

                                <a
                                    href="{{ route('pembayaran.konfirmasi', $reservasi->id) }}"
                                    class="btn btn-sm btn-success mt-1"
                                >
                                    <i class="fa-solid fa-credit-card me-1"></i>
                                    Lanjut Bayar
                                </a>


                            @else

                                <span class="badge bg-danger mb-2">
                                    Belum Bayar
                                </span>

                                <br>

                                <a
                                    href="{{ route('pembayaran.index', $reservasi->id) }}"
                                    class="btn btn-sm btn-success mt-1"
                                >
                                    <i class="fa-solid fa-credit-card me-1"></i>
                                    Bayar Sekarang
                                </a>

                            @endif

                        </td>

                    </tr>


                @empty

                    <tr>

                        <td
                            colspan="8"
                            class="text-center py-5 text-muted"
                        >

                            <i
                                class="fa-solid fa-calendar-xmark fa-3x mb-3"
                            ></i>

                            <h5>
                                Belum Ada Reservasi
                            </h5>

                            <p>
                                Yuk pilih lapangan futsal
                                dan tentukan jadwal bermain Anda.
                            </p>

                            <a
                                href="{{ route('lapangan.list') }}"
                                class="btn btn-success"
                            >
                                <i class="fa-solid fa-plus me-1"></i>
                                Reservasi Lapangan
                            </a>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>
```

</div>

@endsection
