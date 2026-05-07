@extends('layout.admin')

@section('title', 'Tambah Tanggapan')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah Tanggapan</h3>
                <p class="text-subtitle text-muted">Tambahkan tanggapan untuk pengaduan siswa.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.tanggapan.index') }}">Tanggapan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Tambah Tanggapan</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.tanggapan.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="pengaduan_id" class="form-label">Pengaduan</label>
                        <select name="pengaduan_id" id="pengaduan_id" class="form-select @error('pengaduan_id') is-invalid @enderror" required>
                            <option value="">Pilih Pengaduan</option>
                            @foreach ($pengaduan as $item)
                                <option value="{{ $item->id }}" @selected(old('pengaduan_id', request('pengaduan_id')) == $item->id)>
                                    {{ $item->judul_laporan }} - {{ $item->siswa->nama_siswa ?? 'Tanpa siswa' }}
                                </option>
                            @endforeach
                        </select>
                        @error('pengaduan_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="petugas_id" class="form-label">Petugas</label>
                        <select name="petugas_id" id="petugas_id" class="form-select @error('petugas_id') is-invalid @enderror" required>
                            <option value="">Pilih Petugas</option>
                            @foreach ($petugas as $item)
                                <option value="{{ $item->id }}" @selected(old('petugas_id') == $item->id)>
                                    {{ $item->nama_petugas }}
                                </option>
                            @endforeach
                        </select>
                        @error('petugas_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="isi_tanggapan" class="form-label">Isi Tanggapan</label>
                        <textarea name="isi_tanggapan" id="isi_tanggapan" rows="5" class="form-control @error('isi_tanggapan') is-invalid @enderror" required>{{ old('isi_tanggapan') }}</textarea>
                        @error('isi_tanggapan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('admin.tanggapan.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection