@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center"><div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h3 class="page-title mb-4"><i class="fa-solid fa-pen text-warning"></i> Edit Lapangan</h3>
                <form action="{{ route('lapangan.update',$lapangan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    @include('admin.lapangan.form')
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('lapangan.index') }}" class="btn btn-secondary">Kembali</a>
                        <button class="btn btn-success px-4"><i class="fa-solid fa-save"></i> Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div></div>
</div>
@endsection
