@extends('layout.admin')

@section('title', 'Edit Tanggapan')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Tanggapan</h3>
                <p class="text-subtitle text-muted">Perbarui data tanggapan pengaduan.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.tanggapan.index') }}">Tanggapan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Edit Tanggapan</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.tanggapan.update', $tanggapan) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="pengaduan_id" class="form-label">Pengaduan</label>
                        <select name="pengaduan_id" id="pengaduan_id" class="form-select @error('pengaduan_id') is-invalid @enderror" required>
                            <option value="">Pilih Pengaduan</option>
                            @foreach ($pengaduan as $item)
                                <option value="{{ $item->id }}" @selected(old('pengaduan_id', $tanggapan->pengaduan_id) == $item->id)>
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
                                <option value="{{ $item->id }}" @selected(old('petugas_id', $tanggapan->petugas_id) == $item->id)>
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
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                        <a href="{{ route('admin.tanggapan.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection