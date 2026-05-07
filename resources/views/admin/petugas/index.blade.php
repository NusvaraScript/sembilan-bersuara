@extends('layout.admin')

@section('title', 'Daftar Petugas')

@section('content')
<div class="page-heading">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3>Daftar Petugas</h3>
            <p class="text-subtitle text-muted mb-0">Lihat data petugas yang menangani tanggapan pengaduan.</p>
        </div>
        <span class="badge bg-light-primary text-primary">Total: {{ $petugas->total() }} petugas</span>
    </div>
</div>

<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Petugas</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Petugas</th>
                                <th>Username</th>
                                <th>Level</th>
                                <th>Jumlah Tanggapan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($petugas as $petugasItem)
                                <tr>
                                    <td>{{ $petugas->firstItem() + $loop->index }}</td>
                                    <td>{{ $petugasItem->nama_petugas }}</td>
                                    <td>{{ $petugasItem->username }}</td>
                                    <td>
                                        <span class="badge {{ $petugasItem->level === 'admin' ? 'bg-success' : 'bg-info' }}">
                                            {{ ucfirst($petugasItem->level) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">{{ $petugasItem->tanggapan_count }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Belum ada data petugas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $petugas->links() }}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection