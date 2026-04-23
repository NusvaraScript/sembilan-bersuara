<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PengaduanController as AdminPengaduan;
use App\Http\Controllers\User\PengaduanController as UserPengaduan;

// Halaman Depan (Landing Page)
Route::get('/', function () {
    return view('user.index');
});

// --- GROUP ROUTE UNTUK ADMIN ---
// Semua URL di sini akan diawali dengan /admin/...
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');

    // CRUD Kategori (Index, Create, Store, Edit, Update, Delete)
    Route::resource('kategori', KategoriController::class);

    // Pengaduan di sisi Admin (Verifikasi & Validasi)
    Route::get('/pengaduan', [AdminPengaduan::class, 'index'])->name('pengaduan.index');
    Route::get('/pengaduan/{id}', [AdminPengaduan::class, 'show'])->name('pengaduan.show');
});

// --- GROUP ROUTE UNTUK USER (Masyarakat) ---
// Semua URL di sini akan diawali dengan /user/...
Route::prefix('user')->name('user.')->group(function () {
    
    // Dashboard User
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');

    // Halaman buat laporan & cek status
    Route::get('/pengaduan/tambah', [UserPengaduan::class, 'create'])->name('pengaduan.create');
    Route::post('/pengaduan/simpan', [UserPengaduan::class, 'store'])->name('pengaduan.store');
    Route::get('/pengaduan/status', [UserPengaduan::class, 'index'])->name('pengaduan.status');
});
