@extends('layout.admin')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Tanggapan</h3>
                <p class="text-subtitle text-muted">Kelola tanggapan admin untuk pengaduan siswa.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tanggapan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Daftar Tanggapan</h4>
                <a href="{{ route('admin.tanggapan.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Tanggapan
                </a>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Pengaduan</th>
                                <th>Nama Petugas</th>
                                <th>Isi Tanggapan</th>
                                <th>Tanggal Dibuat</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tanggapan as $item)
                                <tr>
                                    <td>{{ $tanggapan->firstItem() + $loop->index }}</td>
                                    <td>{{ $item->pengaduan->judul_laporan ?? '-' }}</td>
                                    <td>{{ $item->petugas->nama_petugas ?? '-' }}</td>
                                    <td>{{ $item->isi_tanggapan }}</td>
                                    <td>{{ $item->created_at?->format('d-m-Y H:i') ?? '-' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.tanggapan.edit', $item) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.tanggapan.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus tanggapan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada data tanggapan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $tanggapan->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection