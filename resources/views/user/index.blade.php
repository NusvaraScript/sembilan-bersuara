<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Aspirasi dan Pengaduan Online Rakyat</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    
    <style>
        :root {
            --lapor-red: #d9043d;
            --mazer-bg: #f2f7ff;
            --mazer-card-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
        }

        body {
            font-family: 'Nunito', sans-serif;
            background-color: var(--mazer-bg);
            margin: 0;
        }

        /* Hero Section Berdasarkan Foto */
        .hero {
            background: linear-gradient(135deg, #d9043d 0%, #bd0032 100%);
            padding-bottom: 250px;
            position: relative;
            color: white;
            text-align: center;
        }

        .navbar-custom {
            padding: 20px 0;
        }

        .navbar-custom .nav-link {
            color: rgba(255,255,255,0.9);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            margin: 0 15px;
        }

        .hero-content h1 {
            font-weight: 700;
            margin-top: 50px;
            font-size: 2.2rem;
        }

        .hero-content p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 30px;
        }

        /* Card Form Lapor */
        .report-container {
            margin-top: -200px;
            position: relative;
            z-index: 10;
        }

        .card-lapor {
            border: none;
            border-radius: 10px;
            box-shadow: var(--mazer-card-shadow);
            background: #fff;
            overflow: hidden;
        }

        .card-header-red {
            background: var(--lapor-red);
            color: white;
            padding: 15px 20px;
            font-weight: 800;
            font-size: 1.1rem;
        }

        /* Classification Radio sesuai Foto */
        .classification-group {
            display: flex;
            border: 1px solid #dee2e6;
            margin-bottom: 20px;
        }

        .classification-group label {
            flex: 1;
            text-align: center;
            padding: 10px;
            cursor: pointer;
            border-right: 1px solid #dee2e6;
            font-weight: 700;
            font-size: 0.75rem;
            color: var(--lapor-red);
            text-transform: uppercase;
            margin-bottom: 0;
            transition: 0.3s;
        }

        .classification-group label:last-child { border-right: none; }
        .classification-group input[type="radio"] { margin-right: 5px; }
        .classification-group label:hover { background: #fff5f7; }

        /* Form Controls */
        .form-control, .form-select {
            border-radius: 5px;
            padding: 12px;
            border: 1px solid #e5e5e5;
            margin-bottom: 15px;
        }

        .helper-text {
            background: #fdfdfd;
            border: 1px dashed #ddd;
            padding: 10px;
            text-align: center;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .btn-submit-lapor {
            background: var(--lapor-red);
            color: white;
            border: none;
            padding: 10px 25px;
            font-weight: 800;
            border-radius: 4px;
            text-transform: uppercase;
        }

        /* Process Steps */
        .process-section {
            padding: 280px 0 60px; /* Offset for the overlapping card */
            background: #fff;
        }

        .step-icon {
            width: 50px;
            height: 50px;
            background: #f2f2f2;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 1.2rem;
            color: #444;
        }

        .step-active .step-icon {
            background: var(--lapor-red);
            color: #fff;
        }

        .step-item h6 { font-weight: 800; margin-bottom: 5px; }
        .step-item p { font-size: 0.8rem; color: #777; }

        /* Stats Section */
        .stats-banner {
            background: #d9043d;
            color: white;
            padding: 60px 0;
            text-align: center;
        }

        .stats-banner h2 { font-weight: 800; letter-spacing: 1px; }
        .stats-banner .big-number { font-size: 4.5rem; font-weight: 900; }
    </style>
</head>
<body>

    <section class="hero">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-custom">
                <div class="container-fluid">
                    <a class="navbar-brand text-white fw-bold d-flex align-items-center" href="#">
                        <img src="https://www.lapor.go.id/themes/lapor/assets/images/logo.png" height="40" class="me-2" alt="Logo">
                    </a>
                    <div class="ms-auto d-flex align-items-center">
                        <a class="nav-link" href="#">Tentang Lapor!</a>
                        <a class="nav-link" href="#">Statistik</a>
                        <a class="nav-link border px-3 rounded text-white" href="#"><i class="bi bi-person-fill"></i> Masuk</a>
                    </div>
                </div>
            </nav>

            <div class="hero-content">
                <h1>Layanan Aspirasi dan Pengaduan Online Rakyat</h1>
                <p>Sampaikan laporan Anda langsung kepada instansi pemerintah berwenang</p>
                <div style="width: 60px; height: 4px; background: white; margin: 0 auto;"></div>
            </div>
        </div>
    </section>

    <div class="container report-container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card card-lapor">
                    <div class="card-header-red">Sampaikan Laporan Anda</div>
                    <div class="card-body p-4">
                        <form>
                            <label class="text-muted fw-bold small mb-2">Pilih Klasifikasi Laporan</label>
                            <div class="classification-group">
                                <label><input type="radio" name="type" checked> Pengaduan</label>
                                <label><input type="radio" name="type"> Aspirasi</label>
                                <label><input type="radio" name="type"> Permintaan Informasi</label>
                            </div>

                            <div class="helper-text">
                                Perhatikan Cara Menyampaikan Pengaduan Yang Baik dan Benar <span class="badge bg-danger">?</span>
                            </div>

                            <input type="text" class="form-control" placeholder="Ketik Judul Laporan Anda *">
                            <textarea class="form-control" rows="4" placeholder="Ketik Isi Laporan Anda *"></textarea>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" placeholder="Pilih Tanggal Kejadian *">
                                </div>
                            </div>
                            
                            <select class="form-select">
                                <option selected>Ketik Lokasi Kejadian *</option>
                            </select>

                            <select class="form-select">
                                <option selected>Ketik Instansi Tujuan</option>
                            </select>

                            <select class="form-select">
                                <option selected>Pilih Kategori Laporan Anda</option>
                            </select>

                            <div class="d-flex align-items-center justify-content-between mt-4">
                                <div>
                                    <label class="text-primary fw-bold" style="cursor:pointer">
                                        <i class="bi bi-paperclip"></i> Upload Lampiran
                                        <input type="file" class="d-none">
                                    </label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="anonim">
                                        <label class="form-check-label small fw-bold text-muted" for="anonim">Anonim</label>
                                    </div>
                                    <div class="form-check form-check-inline me-3">
                                        <input class="form-check-input" type="checkbox" id="rahasia">
                                        <label class="form-check-label small fw-bold text-muted" for="rahasia">Rahasia</label>
                                    </div>
                                    <button class="btn btn-submit-lapor" type="button">LAPOR!</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="process-section">
        <div class="container text-center">
            <div class="row">
                <div class="col step-item step-active">
                    <div class="step-icon"><i class="bi bi-pencil-square"></i></div>
                    <h6>Tulis Laporan</h6>
                    <p>Laporkan keluhan anda dengan jelas.</p>
                </div>
                <div class="col step-item">
                    <div class="step-icon"><i class="bi bi-arrow-repeat"></i></div>
                    <h6>Proses Verifikasi</h6>
                    <p>Verifikasi dalam 3 hari kerja.</p>
                </div>
                <div class="col step-item">
                    <div class="step-icon"><i class="bi bi-chat-dots"></i></div>
                    <h6>Tindak Lanjut</h6>
                    <p>Instansi akan menindaklanjuti.</p>
                </div>
                <div class="col step-item">
                    <div class="step-icon"><i class="bi bi-chat-left-text"></i></div>
                    <h6>Tanggapan</h6>
                    <p>Beri tanggapan atas balasan.</p>
                </div>
                <div class="col step-item">
                    <div class="step-icon"><i class="bi bi-check-circle"></i></div>
                    <h6>Selesai</h6>
                    <p>Laporan selesai ditangani.</p>
                </div>
            </div>
            <button class="btn btn-outline-danger mt-5 fw-bold px-4 py-2">PELAJARI LEBIH LANJUT</button>
        </div>
    </section>

    <section class="stats-banner">
        <div class="container">
            <h2>JUMLAH LAPORAN SEKARANG</h2>
            <div class="big-number">959,139</div>
        </div>
    </section>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>