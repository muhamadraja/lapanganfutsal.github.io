```blade
@extends('layouts.app')

@section('content')

<div class="container-fluid">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow-sm">

        <div class="card-header bg-success text-white">
            <h4 class="mb-0">
                <i class="fa-solid fa-calendar-check me-2"></i>
                Data Reservasi
            </h4>
        </div>

        <div class="card-body">

            @if($reservasis->count() > 0)

                <div class="table-responsive">

                    <table class="table table-bordered table-striped table-hover align-middle">

                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Pengguna</th>
                                <th>Lapangan</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Durasi</th>
                                <th>Total Harga</th>
                                <th>Metode Pembayaran</th>
                                <th>Status Pembayaran</th>
                                <th>Dibayar Pada</th>
                                <th>Status Reservasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($reservasis as $reservasi)

                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        {{ $reservasi->user->name ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $reservasi->lapangan->nama_lapangan ?? '-' }}
                                    </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($reservasi->tanggal)->format('d-m-Y') }}
                                    </td>

                                    <td>
                                        {{ $reservasi->jam_mulai }}
                                        -
                                        {{ $reservasi->jam_selesai }}
                                    </td>

                                    <td>
                                        {{ $reservasi->durasi_jam }} jam
                                    </td>

                                    <td>
                                        <strong>
                                            Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}
                                        </strong>
                                    </td>

                                    {{-- METODE PEMBAYARAN --}}
                                    <td>
                                        @if($reservasi->metode_pembayaran)
                                            <span class="badge bg-info text-dark">
                                                {{ $reservasi->metode_pembayaran }}
                                            </span>
                                        @else
                                            <span class="text-muted">
                                                Belum memilih
                                            </span>
                                        @endif
                                    </td>

                                    {{-- STATUS PEMBAYARAN --}}
                                    <td>
                                        @if($reservasi->status_pembayaran === 'lunas')

                                            <span class="badge bg-success">
                                                <i class="fa-solid fa-circle-check me-1"></i>
                                                Lunas
                                            </span>

                                        @elseif($reservasi->status_pembayaran === 'menunggu')

                                            <span class="badge bg-warning text-dark">
                                                <i class="fa-solid fa-clock me-1"></i>
                                                Menunggu Pembayaran
                                            </span>

                                        @else

                                            <span class="badge bg-danger">
                                                <i class="fa-solid fa-circle-xmark me-1"></i>
                                                Belum Bayar
                                            </span>

                                        @endif
                                    </td>

                                    {{-- TANGGAL PEMBAYARAN --}}
                                    <td>
                                        @if($reservasi->dibayar_pada)

                                            {{ $reservasi->dibayar_pada->format('d-m-Y H:i') }}

                                        @else

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @endif
                                    </td>

                                    {{-- STATUS RESERVASI --}}
                                    <td>
                                        @if($reservasi->status === 'menunggu')

                                            <span class="badge bg-warning text-dark">
                                                Menunggu
                                            </span>

                                        @elseif($reservasi->status === 'disetujui')

                                            <span class="badge bg-success">
                                                Disetujui
                                            </span>

                                        @elseif($reservasi->status === 'ditolak')

                                            <span class="badge bg-danger">
                                                Ditolak
                                            </span>

                                        @else

                                            <span class="badge bg-secondary">
                                                {{ $reservasi->status }}
                                            </span>

                                        @endif
                                    </td>

                                    {{-- AKSI --}}
                                    <td>

                                        @if($reservasi->status === 'menunggu')

                                            <a
                                                href="{{ route('admin.reservasi.approve', $reservasi->id) }}"
                                                class="btn btn-success btn-sm mb-1"
                                                onclick="return confirm('Apakah reservasi ini ingin disetujui?')"
                                            >
                                                <i class="fa-solid fa-check me-1"></i>
                                                Setujui
                                            </a>

                                            <a
                                                href="{{ route('admin.reservasi.reject', $reservasi->id) }}"
                                                class="btn btn-danger btn-sm mb-1"
                                                onclick="return confirm('Apakah reservasi ini ingin ditolak?')"
                                            >
                                                <i class="fa-solid fa-xmark me-1"></i>
                                                Tolak
                                            </a>

                                        @elseif($reservasi->status === 'disetujui')

                                            <span class="text-success">
                                                <i class="fa-solid fa-circle-check me-1"></i>
                                                Sudah disetujui
                                            </span>

                                        @elseif($reservasi->status === 'ditolak')

                                            <span class="text-danger">
                                                <i class="fa-solid fa-circle-xmark me-1"></i>
                                                Sudah ditolak
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="alert alert-info">
                    Belum ada reservasi.
                </div>

            @endif

        </div>

    </div>

</div>

@endsection
```
