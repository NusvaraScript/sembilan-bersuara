@extends('layout.admin')

@section('title', 'Dashboard')

@section('content')
@php
    $statusLabels = [
        'pending' => ['label' => 'Menunggu', 'class' => 'bg-warning'],
        'menunggu' => ['label' => 'Menunggu', 'class' => 'bg-warning'],
        '0' => ['label' => 'Menunggu', 'class' => 'bg-warning'],
        'proses' => ['label' => 'Diproses', 'class' => 'bg-primary'],
        'selesai' => ['label' => 'Selesai', 'class' => 'bg-success'],
    ];
@endphp

<div class="page-heading">
    <h3>Dashboard Pengaduan Siswa</h3>
    <p class="text-subtitle text-muted">
        Ringkasan data pengaduan, tanggapan, siswa, dan petugas
    </p>
</div>

<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="bi bi-chat-left-text-fill" style="width: auto; height: auto;"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Pengaduan</h6>
                                    <h6 class="font-extrabold mb-0">{{ number_format($totalPengaduan) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="bi bi-reply-fill" style="width: auto; height: auto;"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Tanggapan</h6>
                                    <h6 class="font-extrabold mb-0">{{ number_format($totalTanggapan) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="bi bi-people-fill" style="width: auto; height: auto;"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Siswa</h6>
                                    <h6 class="font-extrabold mb-0">{{ number_format($totalSiswa) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="bi bi-person-badge-fill" style="width: auto; height: auto;"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Petugas</h6>
                                    <h6 class="font-extrabold mb-0">{{ number_format($totalPetugas) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Status Pengaduan</h4>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <div class="border rounded p-3">
                                        <h6 class="text-warning">Menunggu</h6>
                                        <h3>{{ number_format($menunggu) }}</h3>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <div class="border rounded p-3">
                                        <h6 class="text-primary">Diproses</h6>
                                        <h3>{{ number_format($diproses) }}</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="border rounded p-3">
                                        <h6 class="text-success">Selesai</h6>
                                        <h3>{{ number_format($selesai) }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Pengaduan Terbaru</h4>
                        </div>
                        <div class="card-body">
                        @include('components.table-search', [
                                'searchAction' => url('/'),
                                'searchValue' => $search ?? '',
                                'searchPlaceholder' => 'Cari nama siswa, judul, isi pengaduan, atau status...',
                            ])

                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>Nama Siswa</th>
                                            <th>Judul Pengaduan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($pengaduanTerbaru as $pengaduan)
                                            @php($status = $statusLabels[$pengaduan->status] ?? ['label' => ucfirst($pengaduan->status), 'class' => 'bg-secondary'])
                                            <tr>
                                                <td class="col-3">{{ $pengaduan->siswa->nama_siswa ?? 'Siswa tidak ditemukan' }}</td>
                                                <td class="col-auto">
                                                    <strong>{{ $pengaduan->judul_laporan }}</strong>
                                                    <p class="mb-0 text-muted">{{ \Illuminate\Support\Str::limit($pengaduan->isi_laporan, 80) }}</p>
                                                </td>
                                                <td>
                                                    <span class="badge {{ $status['class'] }}">{{ $status['label'] }}</span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted py-4">Belum ada data pengaduan.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Aktivitas Petugas</h4>
                        </div>
                        <div class="card-content pb-4">
                            @forelse ($aktivitasPetugas as $aktivitas)
                                <div class="recent-message d-flex px-4 py-3">
                                    <div class="avatar avatar-lg bg-light-primary d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person-check-fill fs-4"></i>
                                    </div>
                                    <div class="name ms-4">
                                        <h5 class="mb-1">{{ $aktivitas->petugas->nama_petugas ?? 'Petugas' }}</h5>
                                        <h6 class="text-muted mb-0">
                                            Menanggapi: {{ \Illuminate\Support\Str::limit($aktivitas->pengaduan->judul_laporan ?? 'Pengaduan', 36) }}
                                        </h6>
                                        <small class="text-muted">{{ $aktivitas->created_at?->diffForHumans() }}</small>
                                    </div>
                                </div>
                            @empty
                                <div class="px-4 py-3 text-muted">Belum ada aktivitas petugas.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-5">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl bg-light-primary d-flex align-items-center justify-content-center">
                            <i class="bi bi-shield-lock-fill fs-3"></i>
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold">Admin Sekolah</h5>
                            <h6 class="text-muted mb-0">Dashboard</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Informasi Sistem</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <small class="text-muted">Total Pengaduan Hari Ini</small>
                        <h5>{{ number_format($pengaduanHariIni) }}</h5>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted">Pengaduan Belum Ditanggapi</small>
                        <h5>{{ number_format($belumDitanggapi) }}</h5>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted">Petugas Aktif Hari Ini</small>
                        <h5>{{ number_format($petugasAktif) }}</h5>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Notifikasi</h4>
                </div>
                <div class="card-body">
                    @if ($menunggu > 0)
                        <div class="alert alert-warning">
                            Ada {{ number_format($menunggu) }} pengaduan yang belum diproses.
                        </div>
                    @else
                        <div class="alert alert-success">
                            Semua pengaduan sudah mulai diproses.
                        </div>
                    @endif

                    @if ($belumDitanggapi > 0)
                        <div class="alert alert-primary">
                            {{ number_format($belumDitanggapi) }} pengaduan belum memiliki tanggapan.
                        </div>
                    @else
                        <div class="alert alert-success">
                            Semua pengaduan sudah memiliki tanggapan.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection