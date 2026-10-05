@extends('layouts.app')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow border-0">

                <div class="card-body text-center">

                    <div class="display-1 text-success mb-3">
                        ✓
                    </div>

                    <h2>
                        Pembayaran Berhasil
                    </h2>

                    <p class="text-muted">
                        Reservasi lapangan futsal Anda
                        telah berhasil dikonfirmasi.
                    </p>

                    <hr>

                    <p>
                        <strong>Lapangan:</strong><br>
                        {{ $reservasi->lapangan->nama }}
                    </p>

                    <p>
                        <strong>Tanggal:</strong><br>
                        {{ \Carbon\Carbon::parse($reservasi->tanggal)->format('d-m-Y') }}
                    </p>

                    <p>
                        <strong>Jam:</strong><br>
                        {{ $reservasi->jam_mulai }}
                        -
                        {{ $reservasi->jam_selesai }}
                    </p>

                    <p>
                        <strong>Total:</strong><br>

                        Rp
                        {{ number_format($reservasi->total_harga, 0, ',', '.') }}

                    </p>

                    <span class="badge bg-success">
                        LUNAS
                    </span>

                    <div class="mt-4">

                        <a
                            href="{{ route('lapangan.list') }}"
                            class="btn btn-primary"
                        >
                            Kembali ke Lapangan
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection