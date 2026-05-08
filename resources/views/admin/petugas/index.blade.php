@extends('layout.admin')

@section('title', 'Daftar Petugas')

@section('content')
<div class="page-heading">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3>Daftar Petugas</h3>
            <p class="text-subtitle text-muted mb-0">Lihat data petugas dan tambahkan petugas baru secara manual.</p>
        </div>
        <span class="badge bg-light-primary text-primary">Total: {{ $petugas->total() }} petugas</span>
    </div>
</div>

<div class="page-content">
    <section class="section">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Data petugas belum valid.</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Tambah Petugas Manual</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.petugas.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nama_petugas" class="form-label">Nama Petugas</label>
                            <input type="text" name="nama_petugas" id="nama_petugas" value="{{ old('nama_petugas') }}" class="form-control @error('nama_petugas') is-invalid @enderror" required>
                            @error('nama_petugas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror" required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="level" class="form-label">Level</label>
                            <select name="level" id="level" class="form-select @error('level') is-invalid @enderror" required>
                                <option value="">Pilih level</option>
                                <option value="admin" @selected(old('level') === 'admin')>Admin</option>
                                <option value="petugas" @selected(old('level', 'petugas') === 'petugas')>Petugas</option>
                            </select>
                            @error('level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                            <div class="form-text">Minimal 6 karakter.</div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-person-plus"></i> Simpan Petugas
                    </button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Petugas</h4>
            </div>
            <div class="card-body">
            @include('components.table-search', [
                    'searchAction' => route('admin.petugas.index'),
                    'searchValue' => $search ?? '',
                    'searchPlaceholder' => 'Cari nama petugas, username, atau level...',
                ])

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