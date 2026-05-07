@extends('layout.admin')

@section('title', 'Data Pengaduan')

@section('content')
<div class="page-heading">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3>Data Pengaduan</h3>
            <p class="text-subtitle text-muted mb-0">Kelola pengaduan siswa yang masuk ke sistem.</p>
        </div>
        <a href="{{ route('admin.pengaduan.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Pengaduan
        </a>
    </div>
</div>

<div class="page-content">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Daftar Pengaduan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Kategori</th>
                                <th>Judul Laporan</th>
                                <th>Isi Laporan</th>
                                <th>Status</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pengaduans as $pengaduan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pengaduan->siswa->nama_siswa ?? '-' }}</td>
                                    <td>{{ $pengaduan->kategori->nama_kategori ?? '-' }}</td>
                                    <td>{{ $pengaduan->judul_laporan }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($pengaduan->isi_laporan, 80) }}</td>
                                    <td>
                                        <span class="badge {{ $pengaduan->status === 'selesai' ? 'bg-success' : ($pengaduan->status === 'proses' ? 'bg-primary' : 'bg-warning') }}">
                                            {{ ucfirst($pengaduan->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('admin.pengaduan.edit', $pengaduan) }}" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.pengaduan.destroy', $pengaduan) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Belum ada data pengaduan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection