@extends('layouts.app')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        Pembayaran Reservasi
                    </h4>
                </div>

                <div class="card-body">

                    <h5 class="mb-3">
                        Detail Reservasi
                    </h5>

                    <table class="table">

                        <tr>
                            <td>Lapangan</td>
                            <td>
                                {{ $reservasi->lapangan->nama }}
                            </td>
                        </tr>

                        <tr>
                            <td>Tanggal</td>
                            <td>
                                {{ \Carbon\Carbon::parse($reservasi->tanggal)->format('d-m-Y') }}
                            </td>
                        </tr>

                        <tr>
                            <td>Jam</td>
                            <td>
                                {{ $reservasi->jam_mulai }}
                                -
                                {{ $reservasi->jam_selesai }}
                            </td>
                        </tr>

                        <tr>
                            <td>Total</td>
                            <td>
                                <strong>
                                    Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}
                                </strong>
                            </td>
                        </tr>

                    </table>

                    <hr>

                    <form method="POST"
                          action="{{ route('pembayaran.bayar', $reservasi->id) }}">

                        @csrf

                        <h5 class="mb-3">
                            Pilih Metode Pembayaran
                        </h5>

                        <div class="mb-3">

                            <div class="form-check border rounded p-3 mb-2">

                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="metode_pembayaran"
                                    value="QRIS"
                                    id="qris"
                                    required
                                >

                                <label
                                    class="form-check-label"
                                    for="qris"
                                >
                                    <strong>QRIS</strong>
                                    <br>
                                    <small>
                                        Pembayaran menggunakan QRIS
                                    </small>
                                </label>

                            </div>

                            <div class="form-check border rounded p-3 mb-2">

                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="metode_pembayaran"
                                    value="Transfer Bank"
                                    id="bank"
                                >

                                <label
                                    class="form-check-label"
                                    for="bank"
                                >
                                    <strong>Transfer Bank</strong>
                                    <br>
                                    <small>
                                        Transfer melalui rekening bank
                                    </small>
                                </label>

                            </div>

                            <div class="form-check border rounded p-3">

                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="metode_pembayaran"
                                    value="E-Wallet"
                                    id="ewallet"
                                >

                                <label
                                    class="form-check-label"
                                    for="ewallet"
                                >
                                    <strong>E-Wallet</strong>
                                    <br>
                                    <small>
                                        Pembayaran menggunakan e-wallet
                                    </small>
                                </label>

                            </div>

                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            Lanjutkan Pembayaran
                        </button>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>

@endsection