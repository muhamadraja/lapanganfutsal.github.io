@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="page-title mb-1">Kelola Lapangan Badminton</h2>
            <p class="text-muted mb-0">Tambah dan kelola lapangan yang dapat dipesan mahasiswa/pengguna.</p>
        </div>
        <a href="{{ route('lapangan.create') }}" class="btn btn-success"><i class="fa-solid fa-plus"></i> Tambah Lapangan</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead><tr><th>No</th><th>Foto</th><th>Lapangan</th><th>Jenis</th><th>Lokasi</th><th>Harga/Jam</th><th>Aksi</th></tr></thead>
                    <tbody>
                    @forelse($data as $key => $lapangan)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                @if($lapangan->foto)
                                    <img src="{{ asset('storage/'.$lapangan->foto) }}" alt="{{ $lapangan->nama_lapangan }}" style="width:80px;height:55px;object-fit:cover;border-radius:8px;">
                                @else <span class="text-muted">-</span> @endif
                            </td>
                            <td><strong>{{ $lapangan->nama_lapangan }}</strong><br><small class="text-muted">{{ $lapangan->kapasitas }} orang</small></td>
                            <td><span class="badge bg-success-subtle text-success">{{ $lapangan->jenis_lapangan }}</span></td>
                            <td>{{ $lapangan->lokasi }}</td>
                            <td>Rp {{ number_format($lapangan->harga_per_jam,0,',','.') }}</td>
                            <td class="text-nowrap">
                                <a href="{{ route('lapangan.edit',$lapangan->id) }}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen"></i></a>
                                <form action="{{ route('lapangan.destroy',$lapangan->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus lapangan ini?')"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center py-5 text-muted">Belum ada lapangan. Silakan tambahkan lapangan pertama.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
