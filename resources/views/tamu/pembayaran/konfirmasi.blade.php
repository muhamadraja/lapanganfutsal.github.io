@extends('layouts.app')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow border-0">

                <div class="card-body text-center">

                    <h3 class="mb-4">
                        Konfirmasi Pembayaran
                    </h3>

                    <div class="alert alert-warning">

                        <strong>
                            Pembayaran Simulasi
                        </strong>

                        <br>

                        Silakan konfirmasi pembayaran
                        untuk menyelesaikan reservasi.

                    </div>

                    <h4>
                        Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}
                    </h4>

                    <p>
                        Metode:
                        <strong>
                            {{ $reservasi->metode_pembayaran }}
                        </strong>
                    </p>

                    <form
                        method="POST"
                        action="{{ route('pembayaran.proses', $reservasi->id) }}"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="btn btn-success btn-lg w-100"
                        >
                            Konfirmasi Pembayaran
                        </button>

                    </form>

                    <a
                        href="{{ route('pembayaran.index', $reservasi->id) }}"
                        class="btn btn-outline-secondary mt-3 w-100"
                    >
                        Kembali

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection