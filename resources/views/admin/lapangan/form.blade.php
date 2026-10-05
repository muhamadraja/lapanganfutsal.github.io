<div class="mb-3">
    <label class="form-label">Nama Lapangan</label>
    <input type="text" name="nama_lapangan" class="form-control @error('nama_lapangan') is-invalid @enderror" value="{{ old('nama_lapangan',$lapangan->nama_lapangan ?? '') }}" placeholder="Contoh: Lapangan Futsal 1" required>
    @error('nama_lapangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Jenis Lapangan</label>
        <select name="jenis_lapangan" class="form-select" required>
            @foreach(['Indoor','Outdoor','Vinyl','Karpet'] as $jenis)
                <option value="{{ $jenis }}" {{ old('jenis_lapangan',$lapangan->jenis_lapangan ?? 'Indoor') == $jenis ? 'selected':'' }}>{{ $jenis }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Harga Sewa / Jam (Rp)</label>
        <input type="number" min="0" name="harga_per_jam" class="form-control" value="{{ old('harga_per_jam',$lapangan->harga_per_jam ?? '') }}" required>
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Kapasitas (orang)</label>
        <input type="number" min="1" name="kapasitas" class="form-control" value="{{ old('kapasitas',$lapangan->kapasitas ?? 4) }}" required>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Lokasi</label>
        <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi',$lapangan->lokasi ?? 'UIN Raden Fatah Palembang') }}" required>
    </div>
</div>
<div class="mb-3">
    <label class="form-label">Fasilitas</label>
    <input type="text" name="fasilitas" class="form-control" value="{{ old('fasilitas',$lapangan->fasilitas ?? '') }}" placeholder="Contoh: Lampu LED, tribun, tempat duduk, parkir">
</div>
<div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea name="deskripsi" rows="4" class="form-control">{{ old('deskripsi',$lapangan->deskripsi ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label class="form-label">Foto Lapangan</label>
    @if(!empty($lapangan?->foto))
        <div class="mb-2"><img src="{{ asset('storage/'.$lapangan->foto) }}" style="width:180px;height:110px;object-fit:cover;border-radius:10px;"></div>
    @endif
    <input type="file" name="foto" class="form-control" accept="image/*">
    <small class="text-muted">Opsional. Maksimal 2 MB.</small>
</div>
