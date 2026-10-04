@extends('layouts.app')

@section('content')

<div class="container">

```
{{-- HERO --}}
<div class="hero-mini p-4 p-md-5 mb-4 shadow-sm">
    <h2 class="fw-bold">Lapangan Badminton UIN RF</h2>
    <p class="mb-0">
        Pilih lapangan, cek fasilitas, lalu tentukan jadwal bermain Anda.
    </p>
</div>

{{-- PILIH TANGGAL --}}
<div class="card shadow-sm mb-4">
    <div class="card-body">
       <form method="GET" action="{{ route('lapangan.list') }}">php artisan make:migration add_payment_fields_to_reservasis_table --table=reservasis
            <label for="tanggal" class="form-label fw-bold">
                <i class="fa-solid fa-calendar-days"></i>
                Pilih Tanggal
            </label>

            <div class="row">
                <div class="col-md-4">
                    <input
                        type="date"
                        id="tanggal"
                        name="tanggal"
                        class="form-control"
                        value="{{ $tanggal }}"
                        min="{{ date('Y-m-d') }}"
                        onchange="this.form.submit()"
                    >
                </div>
            </div>

        </form>
    </div>
</div>


{{-- DAFTAR LAPANGAN --}}
<div class="row g-4">

    @forelse($data as $lapangan)

        <div class="col-md-6 col-lg-4">

            <div class="card shadow-sm h-100 overflow-hidden">

                {{-- FOTO LAPANGAN --}}
                @if($lapangan->foto)

                    <img
                        src="{{ asset('storage/'.$lapangan->foto) }}"
                        class="card-img-top"
                        style="height:210px;object-fit:cover;"
                        alt="{{ $lapangan->nama_lapangan }}"
                    >

                @else

                    <div
                        class="d-flex align-items-center justify-content-center bg-success-subtle text-success"
                        style="height:210px;"
                    >
                        <i class="fa-solid fa-table-tennis-paddle-ball fa-4x"></i>
                    </div>

                @endif


                <div class="card-body d-flex flex-column">

                    {{-- NAMA DAN JENIS --}}
                    <div class="d-flex justify-content-between align-items-start gap-2">

                        <h5 class="fw-bold mb-0">
                            {{ $lapangan->nama_lapangan }}
                        </h5>

                        <span class="badge bg-success">
                            {{ $lapangan->jenis_lapangan }}
                        </span>

                    </div>


                    {{-- KAPASITAS --}}
                    <p class="mb-2 mt-3">
                        <i class="fa-solid fa-users"></i>
                        Kapasitas {{ $lapangan->kapasitas }} orang
                    </p>


                    {{-- HARGA --}}
                    <p class="fw-bold text-success fs-5 mb-2">
                        Rp {{ number_format($lapangan->harga_per_jam,0,',','.') }}

                        <small class="text-muted fw-normal">
                            / jam
                        </small>
                    </p>


                    {{-- DESKRIPSI --}}
                    <p class="text-muted small">
                        {{ Str::limit($lapangan->deskripsi ?? 'Lapangan badminton UIN RF.',100) }}
                    </p>


                    {{-- JADWAL LAPANGAN --}}
                    <div class="mt-3">

                        <h6 class="fw-bold mb-3">
                            <i class="fa-solid fa-clock"></i>
                            Jadwal
                            {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}
                        </h6>


                        @php
                            $jamMulai = 8;
                            $jamSelesai = 22;
                        @endphp


                        {{-- SLOT JAM --}}
                        @for ($jam = $jamMulai; $jam < $jamSelesai; $jam++)

                            @php
                                $mulai = sprintf('%02d:00:00', $jam);
                                $selesai = sprintf('%02d:00:00', $jam + 1);

                                $terisi = $lapangan->reservasiHariIni->contains(function ($reservasi) use ($mulai, $selesai) {

                                    return $reservasi->jam_mulai < $selesai &&
                                           $reservasi->jam_selesai > $mulai;

                                });
                            @endphp


                            <div class="d-flex justify-content-between align-items-center border rounded p-2 mb-2">

                                {{-- JAM --}}
                                <span class="small">
                                    <i class="fa-regular fa-clock"></i>

                                    {{ substr($mulai, 0, 5) }}
                                    -
                                    {{ substr($selesai, 0, 5) }}
                                </span>


                                {{-- STATUS --}}
                                @if ($terisi)

                                    <span class="badge bg-danger">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                        Tidak Tersedia
                                    </span>

                                @else

                                    <span class="badge bg-success">
                                        <i class="fa-solid fa-circle-check"></i>
                                        Tersedia
                                    </span>

                                @endif

                            </div>

                        @endfor

                    </div>


                    {{-- TOMBOL PESAN --}}
                    <a
                        href="{{ route('lapangan.detail',$lapangan->id) }}"
                        class="btn btn-success mt-3"
                    >
                        <i class="fa-solid fa-calendar-plus"></i>
                        Pesan Lapangan
                    </a>

                </div>

            </div>

        </div>

    @empty

        <div class="col-12">

            <div class="alert alert-info text-center">
                <i class="fa-solid fa-circle-info"></i>
                Belum ada lapangan yang tersedia.
            </div>

        </div>

    @endforelse

</div>
```

</div>
@endsection
