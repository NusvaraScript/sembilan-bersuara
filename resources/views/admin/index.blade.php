@extends('layout.admin')

@section('title', 'Dashboard')

@section('content')

<div class="page-heading">
    <h3>Dashboard Pengaduan Siswa</h3>
    <p class="text-subtitle text-muted">
        Ringkasan data pengaduan, tanggapan, siswa, dan petugas
    </p>
</div>

<div class="page-content">
    <section class="row">

        <!-- Statistik -->
        <div class="col-12 col-lg-9">

            <div class="row">

                <!-- Total Pengaduan -->
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="bi bi-chat-left-text-fill"></i>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">
                                        Pengaduan
                                    </h6>

                                    <h6 class="font-extrabold mb-0">
                                        {{ $totalPengaduan ?? 120 }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Tanggapan -->
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="bi bi-reply-fill"></i>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">
                                        Tanggapan
                                    </h6>

                                    <h6 class="font-extrabold mb-0">
                                        {{ $totalTanggapan ?? 98 }}
                                    </h6>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Siswa -->
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="bi bi-people-fill"></i>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">
                                        Siswa
                                    </h6>

                                    <h6 class="font-extrabold mb-0">
                                        {{ $totalSiswa ?? 320 }}
                                    </h6>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <!-- Total Petugas -->
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="bi bi-person-badge-fill"></i>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">
                                        Petugas
                                    </h6>

                                    <h6 class="font-extrabold mb-0">
                                        {{ $totalPetugas ?? 12 }}
                                    </h6>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <!-- Statistik Status -->
            <div class="row">

                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h4>Status Pengaduan</h4>
                        </div>

                        <div class="card-body">

                            <div class="row text-center">

                                <div class="col-md-4">
                                    <div class="border rounded p-3">
                                        <h6 class="text-warning">
                                            Menunggu
                                        </h6>

                                        <h3>
                                            {{ $menunggu ?? 20 }}
                                        </h3>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="border rounded p-3">
                                        <h6 class="text-primary">
                                            Diproses
                                        </h6>

                                        <h3>
                                            {{ $diproses ?? 45 }}
                                        </h3>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="border rounded p-3">
                                        <h6 class="text-success">
                                            Selesai
                                        </h6>

                                        <h3>
                                            {{ $selesai ?? 55 }}
                                        </h3>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

            </div>

            <!-- Pengaduan Terbaru -->
            <div class="row">

                <div class="col-12 col-xl-8">

                    <div class="card">

                        <div class="card-header">
                            <h4>Pengaduan Terbaru</h4>
                        </div>

                        <div class="card-body">

                            <div class="table-responsive">

                                <table class="table table-hover table-lg">

                                    <thead>
                                        <tr>
                                            <th>Nama Siswa</th>
                                            <th>Isi Pengaduan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <tr>
                                            <td class="col-3">
                                                Ahmad Fauzi
                                            </td>

                                            <td class="col-auto">
                                                Terjadi bullying di kelas XI RPL 2
                                            </td>

                                            <td>
                                                <span class="badge bg-warning">
                                                    Menunggu
                                                </span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="col-3">
                                                Siti Nurhaliza
                                            </td>

                                            <td class="col-auto">
                                                Kerusakan fasilitas laboratorium
                                            </td>

                                            <td>
                                                <span class="badge bg-primary">
                                                    Diproses
                                                </span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="col-3">
                                                Budi Santoso
                                            </td>

                                            <td class="col-auto">
                                                Kehilangan barang di kelas
                                            </td>

                                            <td>
                                                <span class="badge bg-success">
                                                    Selesai
                                                </span>
                                            </td>
                                        </tr>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Aktivitas Petugas -->
                <div class="col-12 col-xl-4">

                    <div class="card">

                        <div class="card-header">
                            <h4>Aktivitas Petugas</h4>
                        </div>

                        <div class="card-content pb-4">

                            <div class="recent-message d-flex px-4 py-3">

                                <div class="avatar avatar-lg">
                                    <img src="{{ asset('assets/images/faces/1.jpg') }}">
                                </div>

                                <div class="name ms-4">
                                    <h5 class="mb-1">
                                        Admin BK
                                    </h5>

                                    <h6 class="text-muted mb-0">
                                        Menanggapi laporan bullying
                                    </h6>
                                </div>

                            </div>

                            <div class="recent-message d-flex px-4 py-3">

                                <div class="avatar avatar-lg">
                                    <img src="{{ asset('assets/images/faces/2.jpg') }}">
                                </div>

                                <div class="name ms-4">
                                    <h5 class="mb-1">
                                        Petugas Sekolah
                                    </h5>

                                    <h6 class="text-muted mb-0">
                                        Memverifikasi pengaduan fasilitas
                                    </h6>
                                </div>

                            </div>

                            <div class="recent-message d-flex px-4 py-3">

                                <div class="avatar avatar-lg">
                                    <img src="{{ asset('assets/images/faces/3.jpg') }}">
                                </div>

                                <div class="name ms-4">
                                    <h5 class="mb-1">
                                        Wali Kelas
                                    </h5>

                                    <h6 class="text-muted mb-0">
                                        Menutup laporan siswa
                                    </h6>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- Sidebar Kanan -->
        <div class="col-12 col-lg-3">

            <!-- Profile Admin -->
            <div class="card">

                <div class="card-body py-4 px-5">

                    <div class="d-flex align-items-center">

                        <div class="avatar avatar-xl">
                            <img src="{{ asset('assets/images/faces/1.jpg') }}" alt="">
                        </div>

                        <div class="ms-3 name">
                            <h5 class="font-bold">
                                Admin Sekolah
                            </h5>

                            <h6 class="text-muted mb-0">
                                @admin
                            </h6>
                        </div>

                    </div>

                </div>

            </div>

            <!-- Informasi Sistem -->
            <div class="card">

                <div class="card-header">
                    <h4>Informasi Sistem</h4>
                </div>

                <div class="card-body">

                    <div class="mb-3">
                        <small class="text-muted">
                            Total Pengaduan Hari Ini
                        </small>

                        <h5>
                            {{ $pengaduanHariIni ?? 8 }}
                        </h5>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted">
                            Pengaduan Belum Ditanggapi
                        </small>

                        <h5>
                            {{ $belumDitanggapi ?? 14 }}
                        </h5>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted">
                            Petugas Aktif
                        </small>

                        <h5>
                            {{ $petugasAktif ?? 5 }}
                        </h5>
                    </div>

                </div>

            </div>

            <!-- Notifikasi -->
            <div class="card">

                <div class="card-header">
                    <h4>Notifikasi</h4>
                </div>

                <div class="card-body">

                    <div class="alert alert-warning">
                        Ada 3 pengaduan baru yang belum diproses
                    </div>

                    <div class="alert alert-success">
                        5 pengaduan berhasil diselesaikan hari ini
                    </div>

                </div>

            </div>

        </div>

    </section>
</div>

@endsection