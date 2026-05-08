<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PengaduanController as AdminPengaduanController;
use App\Http\Controllers\TanggapanController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\User\PengaduanController as UserPengaduan;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\Siswa;
use App\Models\Petugas;
use Carbon\Carbon;

// Halaman Depan (Landing Page)
Route::get('/', function (Request $request) {
    $totalPengaduan = Pengaduan::count();
    $totalTanggapan = Tanggapan::count();
    $totalSiswa = Siswa::count();
    $totalPetugas = Petugas::count();

    $menunggu = Pengaduan::where('status', 'pending')->count();
    $diproses = Pengaduan::where('status', 'proses')->count();
    $selesai = Pengaduan::where('status', 'selesai')->count();

    $search = $request->string('search')->trim()->toString();

    $pengaduanTerbaru = Pengaduan::with('siswa')
        ->when($search !== '', function ($query) use ($search): void {
            $query->where(function ($query) use ($search): void {
                $query->where('judul_laporan', 'like', "%{$search}%")
                    ->orWhere('isi_laporan', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhereHas('siswa', function ($query) use ($search): void {
                        $query->where('nama_siswa', 'like', "%{$search}%")
                            ->orWhere('nis', 'like', "%{$search}%");
                    });
            });
        })
        ->latest()
        ->take(5)
        ->get();
    $aktivitasPetugas = Tanggapan::with('petugas', 'pengaduan')->latest()->take(5)->get();

    $pengaduanHariIni = Pengaduan::whereDate('created_at', Carbon::today())->count();
    $belumDitanggapi = Pengaduan::whereDoesntHave('tanggapan')->count();
    $petugasAktif = Tanggapan::whereDate('created_at', Carbon::today())->distinct()->count('petugas_id');

    return view('admin.index', compact(
        'totalPengaduan',
        'totalTanggapan',
        'totalSiswa',
        'totalPetugas',
        'search',
        'menunggu',
        'diproses',
        'selesai',
        'pengaduanTerbaru',
        'aktivitasPetugas', 
        'pengaduanHariIni',
        'belumDitanggapi',
        'petugasAktif'
    ));
});

Route::resource('/admin/pengaduan', AdminPengaduanController::class)->names('admin.pengaduan');
Route::resource('/admin/tanggapan', TanggapanController::class)->names('admin.tanggapan');
Route::get('/admin/siswa', [SiswaController::class, 'index'])->name('admin.siswa.index');
Route::get('/admin/siswa/export', [SiswaController::class, 'export'])->name('admin.siswa.export');
Route::get('/admin/siswa/template', [SiswaController::class, 'template'])->name('admin.siswa.template');
Route::post('/admin/siswa/import', [SiswaController::class, 'import'])->name('admin.siswa.import');
Route::get('/admin/petugas', [PetugasController::class, 'index'])->name('admin.petugas.index');
Route::post('/admin/petugas', [PetugasController::class, 'store'])->name('admin.petugas.store');