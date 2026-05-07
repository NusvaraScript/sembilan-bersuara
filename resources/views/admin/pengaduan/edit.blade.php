@extends('layout.admin')

@section('title', 'Edit Pengaduan')

@section('content')
<div class="page-heading">
    <h3>Edit Pengaduan</h3>
    <p class="text-subtitle text-muted">Perbarui data pengaduan siswa.</p>
</div>

<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Edit Pengaduan</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.pengaduan.update', $pengaduan) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori</label>
                        <select name="kategori_id" id="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror" required>
                            <option value="">Pilih kategori</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" @selected(old('kategori_id', $pengaduan->kategori_id) == $kategori->id)>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="siswa_nis" class="form-label">Siswa</label>
                        <select name="siswa_nis" id="siswa_nis" class="form-select @error('siswa_nis') is-invalid @enderror" required>
                            <option value="">Pilih siswa</option>
                            @foreach ($siswas as $siswa)
                                <option value="{{ $siswa->nis }}" @selected(old('siswa_nis', $pengaduan->siswa_nis) == $siswa->nis)>
                                    {{ $siswa->nama_siswa }} ({{ $siswa->nis }})
                                </option>
                            @endforeach
                        </select>
                        @error('siswa_nis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="judul_laporan" class="form-label">Judul Laporan</label>
                        <input type="text" name="judul_laporan" id="judul_laporan" value="{{ old('judul_laporan', $pengaduan->judul_laporan) }}" class="form-control @error('judul_laporan') is-invalid @enderror" required>
                        @error('judul_laporan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="isi_laporan" class="form-label">Isi Laporan</label>
                        <textarea name="isi_laporan" id="isi_laporan" rows="5" class="form-control @error('isi_laporan') is-invalid @enderror" required>{{ old('isi_laporan', $pengaduan->isi_laporan) }}</textarea>
                        @error('isi_laporan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="text" name="foto" id="foto" value="{{ old('foto', $pengaduan->foto) }}" class="form-control @error('foto') is-invalid @enderror" placeholder="Nama file atau URL foto (opsional)">
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                            @foreach ($statuses as $value => $label)
                                <option value="{{ $value }}" @selected(old('status', $pengaduan->status) === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-light-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection