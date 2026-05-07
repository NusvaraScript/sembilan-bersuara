@extends('layout.admin')

@section('title', 'Daftar Siswa')

@section('content')
<div class="page-heading">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3>Daftar Siswa</h3>
            <p class="text-subtitle text-muted mb-0">Lihat data siswa yang terdaftar di sistem pengaduan.</p>
        </div>
        <span class="badge bg-light-primary text-primary">Total: {{ $siswas->total() }} siswa</span>
    </div>
</div>

<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Siswa</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama Siswa</th>
                                <th>Username</th>
                                <th>Kelas</th>
                                <th>No. HP</th>
                                <th>Jumlah Pengaduan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($siswas as $siswa)
                                <tr>
                                    <td>{{ $siswas->firstItem() + $loop->index }}</td>
                                    <td>{{ $siswa->nis }}</td>
                                    <td>{{ $siswa->nama_siswa }}</td>
                                    <td>{{ $siswa->username }}</td>
                                    <td>{{ $siswa->kelas }}</td>
                                    <td>{{ $siswa->no_hp }}</td>
                                    <td>
                                        <span class="badge bg-primary">{{ $siswa->pengaduan_count }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Belum ada data siswa.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $siswas->links() }}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection