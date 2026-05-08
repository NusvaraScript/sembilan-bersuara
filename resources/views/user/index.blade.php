<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sembilan Bersuara - Layanan Pengaduan Siswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <style>
        :root { --lapor-red: #d9043d; --lapor-dark: #bd0032; --lapor-yellow: #f8b642; }
        * { font-family: 'Nunito', sans-serif; }
        body { background: #f6f7fb; color: #2d3436; }
        .top-strip { height: 30px; background: var(--lapor-yellow); }
        .hero {
            position: relative;
            overflow: hidden;
            min-height: 720px;
            color: #fff;
            background: linear-gradient(135deg, rgba(217, 4, 61, .97), rgba(193, 0, 50, .97)),
                radial-gradient(circle at 22% 62%, rgba(255,255,255,.08) 0 95px, transparent 96px),
                linear-gradient(45deg, transparent 0 28%, rgba(255,255,255,.06) 28% 42%, transparent 42% 100%);
        }
        .hero:before, .hero:after { content: ''; position: absolute; inset: 0; pointer-events: none; }
        .hero:before { background: repeating-linear-gradient(45deg, transparent 0 180px, rgba(255,255,255,.045) 180px 330px, transparent 330px 520px); }
        .hero:after { bottom: -1px; top: auto; height: 130px; background: rgba(255,255,255,.86); clip-path: ellipse(72% 48% at 50% 100%); }
        .navbar-lapor { position: relative; z-index: 2; padding: 28px 0; }
        .brand-mark { display: inline-flex; align-items: center; gap: 10px; color: #fff; font-weight: 900; font-size: 1.65rem; text-decoration: none; }
        .brand-icon { width: 50px; height: 36px; border: 6px solid #fff; border-radius: 2px; position: relative; }
        .brand-icon:after { content: ''; position: absolute; width: 28px; height: 20px; border: 5px solid #fff; right: -22px; bottom: -12px; background: transparent; }
        .nav-link-lapor { color: #fff; font-size: .82rem; font-weight: 800; letter-spacing: .04em; text-decoration: none; margin-left: 28px; text-transform: uppercase; }
        .hero-title { position: relative; z-index: 2; text-align: center; margin-top: 60px; }
        .hero-title h1 { font-weight: 800; font-size: clamp(2rem, 4vw, 3.1rem); line-height: 1.35; }
        .hero-title p { font-size: 1.35rem; margin-top: 20px; opacity: .92; }
        .hero-title .divider { width: 82px; height: 5px; border-radius: 99px; background: #fff; margin: 32px auto 0; }
        .report-card { position: relative; z-index: 3; max-width: 1080px; margin: 85px auto -210px; border: 0; border-radius: 0; box-shadow: 0 20px 38px rgba(55, 55, 55, .23); }
        .report-card .card-body { padding: 26px 28px 32px; }
        .report-heading { background: var(--lapor-red); color: #fff; font-weight: 900; font-size: 1.25rem; padding: 16px 20px; margin-bottom: 22px; }
        .classification { display: grid; grid-template-columns: repeat(3, 1fr); border: 1px solid var(--lapor-red); margin-bottom: 22px; }
        .classification label { color: var(--lapor-red); font-size: .78rem; letter-spacing: .08em; font-weight: 900; text-align: center; padding: 11px; border-right: 1px solid var(--lapor-red); margin: 0; cursor: pointer; }
        .classification label:last-child { border-right: 0; }
        .form-control, .form-select { border-radius: 0; min-height: 48px; font-size: .95rem; }
        textarea.form-control { min-height: 145px; }
        .helper-row { background: #f8f8f8; text-align: center; font-size: .82rem; font-weight: 700; padding: 12px; margin-bottom: 16px; }
        .btn-lapor { background: var(--lapor-red); border: 0; border-radius: 5px; color: #fff; font-weight: 900; padding: 13px 32px; box-shadow: 0 8px 18px rgba(217,4,61,.28); }
        .process-section { padding: 260px 0 80px; background: #fff; }
        .process-item { text-align: center; padding: 0 12px; }
        .process-icon { width: 58px; height: 58px; border-radius: 50%; display: inline-grid; place-items: center; background: #fff; box-shadow: 0 12px 30px rgba(0,0,0,.08); color: #202020; font-size: 1.45rem; margin-bottom: 16px; }
        .process-item.active .process-icon { background: var(--lapor-red); color: #fff; }
        .process-item h5 { font-size: .98rem; font-weight: 900; margin-bottom: 4px; }
        .process-item p { color: #69707a; font-size: .9rem; line-height: 1.45; }
        .red-stat { background: linear-gradient(135deg, var(--lapor-red), var(--lapor-dark)); color: #fff; padding: 58px 0; position: relative; overflow: hidden; }
        .red-stat:before { content: ''; position: absolute; inset: 0; background: repeating-linear-gradient(45deg, transparent 0 190px, rgba(255,255,255,.045) 190px 350px, transparent 350px 560px); }
        .red-stat .container { position: relative; }
        .red-stat h2 { font-weight: 900; letter-spacing: .02em; }
        .red-stat .number { font-size: clamp(3rem, 8vw, 5.2rem); font-weight: 900; margin-top: 32px; }
        .connected { padding: 72px 0; background: #fff; text-align: center; }
        .connected h3 { color: #777f86; font-weight: 900; letter-spacing: .06em; margin-bottom: 40px; }
        .connected-number { font-size: 3.8rem; font-weight: 900; line-height: 1; }
        .footer-user { background: #f4f5f7; padding: 55px 0 30px; text-align: center; color: #7c858d; }
        .store-badge { display: inline-flex; align-items: center; gap: 10px; background: #050505; color: #fff; border-radius: 7px; padding: 10px 22px; min-width: 205px; justify-content: center; margin: 8px; font-weight: 800; text-decoration: none; }
        .floating-help { position: fixed; right: 18px; top: 45%; z-index: 20; width: 56px; height: 56px; border-radius: 50%; background: var(--lapor-red); color: #fff; display: grid; place-items: center; border: 4px solid #fff; box-shadow: 0 8px 18px rgba(0,0,0,.25); font-size: 1.35rem; }
        @media (max-width: 767.98px) {
            .hero { min-height: 900px; }
            .report-card { margin-top: 45px; }
            .classification { grid-template-columns: 1fr; }
            .classification label { border-right: 0; border-bottom: 1px solid var(--lapor-red); }
            .classification label:last-child { border-bottom: 0; }
            .process-section { padding-top: 300px; }
        }
    </style>
</head>
<body>
    <div class="top-strip"></div>
    <section class="hero" id="beranda">
        <nav class="navbar-lapor">
            <div class="container d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <a class="brand-mark" href="{{ route('home') }}"><span class="brand-icon"></span><span>LAPOR!</span></a>
                    <a class="nav-link-lapor d-none d-md-inline" href="#tentang">Tentang Lapor!</a>
                    <a class="nav-link-lapor d-none d-md-inline" href="#statistik">Statistik</a>
                </div>
                <a class="nav-link-lapor" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right me-2"></i>Masuk</a>
            </div>
        </nav>

        <div class="container hero-title">
            <h1>Layanan Aspirasi dan Pengaduan Online<br class="d-none d-md-block"> Siswa</h1>
            <p>Sampaikan laporan Anda langsung kepada petugas sekolah yang berwenang</p>
            <div class="divider"></div>
        </div>

        <div class="container">
            <div class="card report-card">
                <div class="card-body">
                    <div class="report-heading">Sampaikan Laporan Anda</div>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Laporan belum dapat dikirim.</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('user.pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-2 fw-bold text-muted">Pilih Klasifikasi Laporan</div>
                        <div class="classification">
                            <label><input type="radio" name="klasifikasi" checked> Pengaduan</label>
                            <label><input type="radio" name="klasifikasi"> Aspirasi</label>
                            <label><input type="radio" name="klasifikasi"> Permintaan Informasi</label>
                        </div>

                        <div class="helper-row">Perhatikan cara menyampaikan pengaduan yang baik dan benar <span class="badge bg-danger ms-2">?</span></div>

                        <input type="text" name="judul_laporan" value="{{ old('judul_laporan') }}" class="form-control mb-3" placeholder="Ketik Judul Laporan Anda *" required>
                        <textarea name="isi_laporan" class="form-control mb-3" placeholder="Ketik Isi Laporan Anda *" required>{{ old('isi_laporan') }}</textarea>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="number" name="siswa_nis" value="{{ old('siswa_nis') }}" class="form-control" placeholder="Ketik NIS Siswa *" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="date" name="tanggal_kejadian" value="{{ old('tanggal_kejadian') }}" class="form-control" aria-label="Pilih Tanggal Kejadian">
                            </div>
                        </div>
                        <input type="text" name="lokasi" value="{{ old('lokasi') }}" class="form-control mb-3" placeholder="Ketik Lokasi Kejadian">
                        <select name="kategori_id" class="form-select mb-3" required>
                            <option value="">Pilih Kategori Laporan Anda *</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" @selected(old('kategori_id') == $kategori->id)>{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>

                        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mt-4">
                            <label class="fw-bold text-muted"><i class="bi bi-paperclip text-primary"></i> Upload Lampiran <input type="file" name="foto" class="d-none" accept="image/*"></label>
                            <div class="d-flex align-items-center gap-3">
                                <label class="text-muted"><input type="radio" name="visibilitas"> Anonim</label>
                                <label class="text-muted"><input type="radio" name="visibilitas"> Rahasia</label>
                                <button class="btn-lapor" type="submit">LAPOR!</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="process-section" id="tentang">
        <div class="container">
            <div class="row g-4 justify-content-center">
                @php
                    $steps = [
                        ['icon' => 'bi-pencil-square', 'title' => 'Tulis Laporan', 'text' => 'Laporkan keluhan atau aspirasi anda dengan jelas dan lengkap', 'active' => true],
                        ['icon' => 'bi-arrow-right', 'title' => 'Proses Verifikasi', 'text' => 'Dalam 3 hari, laporan Anda akan diverifikasi dan diteruskan kepada petugas berwenang'],
                        ['icon' => 'bi-chat-dots-fill', 'title' => 'Proses Tindak Lanjut', 'text' => 'Dalam 5 hari, petugas akan menindaklanjuti laporan Anda'],
                        ['icon' => 'bi-chat-left-text', 'title' => 'Beri Tanggapan', 'text' => 'Anda dapat menanggapi kembali balasan yang diberikan oleh petugas'],
                        ['icon' => 'bi-check-lg', 'title' => 'Selesai', 'text' => 'Laporan Anda akan terus ditindaklanjuti hingga terselesaikan'],
                    ];
                @endphp
                @foreach ($steps as $step)
                    <div class="col-6 col-md process-item {{ $step['active'] ?? false ? 'active' : '' }}">
                        <div class="process-icon"><i class="bi {{ $step['icon'] }}"></i></div>
                        <h5>{{ $step['title'] }}</h5>
                        <p>{{ $step['text'] }}</p>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-4"><a href="{{ route('user.pengaduan.status') }}" class="btn btn-outline-danger fw-bold px-4">CEK STATUS LAPORAN</a></div>
        </div>
    </section>

    <section class="red-stat" id="statistik">
        <div class="container">
            <h2>JUMLAH LAPORAN SEKARANG</h2>
            <div class="number">{{ number_format($totalPengaduan) }}</div>
        </div>
    </section>

    <section class="connected">
        <div class="container">
            <h3>STATISTIK TERHUBUNG</h3>
            <div class="row g-4 justify-content-center">
                <div class="col-6 col-md-3"><div class="connected-number">{{ number_format($totalSiswa) }}</div><div>Siswa</div></div>
                <div class="col-6 col-md-3"><div class="connected-number">{{ number_format($totalPetugas) }}</div><div>Petugas</div></div>
                <div class="col-6 col-md-3"><div class="connected-number">{{ number_format($totalDiproses) }}</div><div>Diproses</div></div>
                <div class="col-6 col-md-3"><div class="connected-number">{{ number_format($totalSelesai) }}</div><div>Selesai</div></div>
            </div>
        </div>
    </section>

    <footer class="footer-user">
        <div class="container">
            <p class="mb-2">Download aplikasi mobile LAPOR!</p>
            <a class="store-badge" href="#"><i class="bi bi-google-play fs-3"></i> GET IT ON<br>Google Play</a>
            <a class="store-badge" href="#"><i class="bi bi-apple fs-3"></i> Download on the<br>App Store</a>
            <div class="mt-5 fw-bold text-danger">Sembilan Bersuara</div>
            <div class="my-3">
                <a href="#" class="mx-2 text-primary"><i class="bi bi-twitter"></i></a>
                <a href="#" class="mx-2 text-danger"><i class="bi bi-instagram"></i></a>
                <a href="#" class="mx-2 text-primary"><i class="bi bi-facebook"></i></a>
            </div>
            <div class="small fw-bold text-uppercase">Privacy &nbsp; Beranda &nbsp; Blog &nbsp; Ketentuan Layanan &nbsp; Tentang Kami</div>
            <p class="small mt-3 mb-0">Copyright 2026. Sembilan Bersuara. Hak cipta dilindungi Undang-Undang.</p>
        </div>
    </footer>

    <a class="floating-help" href="{{ route('user.pengaduan.status') }}" title="Cek status laporan"><i class="bi bi-universal-access"></i></a>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
