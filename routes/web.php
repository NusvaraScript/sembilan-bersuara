<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PengaduanController as AdminPengaduanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TanggapanController;
use App\Http\Controllers\User\PengaduanController as UserPengaduanController;
use App\Models\Kategori;
use App\Models\Pengaduan;
use App\Models\Petugas;
use App\Models\Siswa;
use App\Models\Tanggapan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('user.index', [
        'totalPengaduan' => Pengaduan::count(),
        'totalSelesai' => Pengaduan::where('status', 'selesai')->count(),
        'totalDiproses' => Pengaduan::where('status', 'proses')->count(),
        'totalSiswa' => Siswa::count(),
        'totalPetugas' => Petugas::count(),
        'totalTanggapan' => Tanggapan::count(),
        'kategoris' => Kategori::orderBy('nama_kategori')->get(),
    ]);
})->name('home');

Route::post('/pengaduan', [UserPengaduanController::class, 'store'])->name('user.pengaduan.store');
Route::get('/pengaduan/status', [UserPengaduanController::class, 'status'])->name('user.pengaduan.status');

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function (): void {
    Route::redirect('/', '/admin/dashboard')->name('home');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('pengaduan', AdminPengaduanController::class);
    Route::resource('tanggapan', TanggapanController::class);

    Route::middleware('role:admin')->group(function (): void {
        Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
        Route::get('/siswa/export', [SiswaController::class, 'export'])->name('siswa.export');
        Route::get('/siswa/template', [SiswaController::class, 'template'])->name('siswa.template');
        Route::post('/siswa/import', [SiswaController::class, 'import'])->name('siswa.import');

        Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas.index');
        Route::post('/petugas', [PetugasController::class, 'store'])->name('petugas.store');
        Route::put('/petugas/{petugas}', [PetugasController::class, 'update'])->name('petugas.update');
    });
});
