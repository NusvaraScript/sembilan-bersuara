<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Laporan - Sembilan Bersuara</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <style>
        body { font-family: 'Nunito', sans-serif; background: #f6f7fb; }
        .hero-mini { background: linear-gradient(135deg, #d9043d, #bd0032); color: #fff; padding: 56px 0; }
        .brand { color: #fff; font-weight: 900; text-decoration: none; font-size: 1.4rem; }
        .card { border: 0; box-shadow: 0 12px 32px rgba(0,0,0,.08); }
    </style>
</head>
<body>
    <section class="hero-mini">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <a href="{{ route('home') }}" class="brand"><i class="bi bi-chat-square-text me-2"></i>LAPOR!</a>
                <h1 class="fw-bold mt-4 mb-2">Cek Status Laporan</h1>
                <p class="mb-0">Masukkan NIS untuk melihat perkembangan laporan Anda.</p>
            </div>
            <a href="{{ route('home') }}" class="btn btn-light fw-bold">Kembali</a>
        </div>
    </section>

    <main class="container py-5">
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('user.pengaduan.status') }}" class="row g-3 align-items-end">
                    <div class="col-md-9">
                        <label class="form-label fw-bold">NIS Siswa</label>
                        <input type="number" name="nis" value="{{ $nis }}" class="form-control form-control-lg" placeholder="Contoh: 12345">
                    </div>
                    <div class="col-md-3 d-grid">
                        <button class="btn btn-danger btn-lg fw-bold" type="submit">Cek Status</button>
                    </div>
                </form>
            </div>
        </div>

        @if ($nis !== '')
            <div class="card">
                <div class="card-header bg-white">
                    <h4 class="mb-0 fw-bold">Riwayat Laporan NIS {{ $nis }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th>Tanggapan Terakhir</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pengaduans as $pengaduan)
                                    <tr>
                                        <td class="fw-bold">{{ $pengaduan->judul_laporan }}</td>
                                        <td>{{ $pengaduan->kategori->nama_kategori ?? '-' }}</td>
                                        <td><span class="badge bg-{{ $pengaduan->status === 'selesai' ? 'success' : ($pengaduan->status === 'proses' ? 'primary' : 'warning') }}">{{ ucfirst($pengaduan->status) }}</span></td>
                                        <td>{{ $pengaduan->tanggapan->last()->isi_tanggapan ?? 'Belum ada tanggapan' }}</td>
                                        <td>{{ $pengaduan->created_at?->format('d M Y') }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="text-center text-muted py-4">Belum ada laporan untuk NIS tersebut.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </main>
</body>
</html>
