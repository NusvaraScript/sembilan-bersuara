@extends('layout.admin')

@section('title', 'Dashboard Petugas')

@section('content')
<div class="page-heading">
    <h3>Dashboard Petugas</h3>
    <p class="text-subtitle text-muted">Fokus pada verifikasi laporan dan tindak lanjut pengaduan siswa.</p>
</div>

<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-8">
            <div class="row">
                <div class="col-6 col-md-4">
                    <div class="card"><div class="card-body px-3 py-4-5"><h6 class="text-muted">Menunggu</h6><h3 class="mb-0 text-warning">{{ number_format($menunggu) }}</h3></div></div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="card"><div class="card-body px-3 py-4-5"><h6 class="text-muted">Diproses</h6><h3 class="mb-0 text-primary">{{ number_format($diproses) }}</h3></div></div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="card"><div class="card-body px-3 py-4-5"><h6 class="text-muted">Selesai</h6><h3 class="mb-0 text-success">{{ number_format($selesai) }}</h3></div></div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Laporan Terbaru</h4>
                    <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-sm btn-primary">Kelola Laporan</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead><tr><th>Judul</th><th>Siswa</th><th>Kategori</th><th>Status</th></tr></thead>
                            <tbody>
                                @forelse ($pengaduanTerbaru as $pengaduan)
                                    <tr>
                                        <td class="fw-bold">{{ $pengaduan->judul_laporan }}</td>
                                        <td>{{ $pengaduan->siswa->nama_siswa ?? '-' }}</td>
                                        <td>{{ $pengaduan->kategori->nama_kategori ?? '-' }}</td>
                                        <td><span class="badge bg-{{ $pengaduan->status === 'selesai' ? 'success' : ($pengaduan->status === 'proses' ? 'primary' : 'warning') }}">{{ ucfirst($pengaduan->status) }}</span></td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="text-center text-muted">Belum ada laporan masuk.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-header"><h4>Agenda Petugas</h4></div>
                <div class="card-body">
                    <div class="alert alert-light-primary">
                        <strong>{{ number_format($belumDitanggapi) }}</strong> laporan belum mendapatkan tanggapan.
                    </div>
                    <a href="{{ route('admin.tanggapan.create') }}" class="btn btn-danger w-100 fw-bold"><i class="bi bi-chat-left-text me-2"></i>Beri Tanggapan</a>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h4>Aktivitas Terkini</h4></div>
                <div class="card-body">
                    @forelse ($aktivitasPetugas as $aktivitas)
                        <div class="d-flex mb-3">
                            <div class="avatar bg-light-primary me-3"><span class="avatar-content"><i class="bi bi-reply-fill"></i></span></div>
                            <div>
                                <h6 class="mb-1">{{ $aktivitas->petugas->nama_petugas ?? 'Petugas' }}</h6>
                                <p class="mb-0 text-muted small">Menanggapi: {{ $aktivitas->pengaduan->judul_laporan ?? '-' }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted mb-0">Belum ada aktivitas tanggapan.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
