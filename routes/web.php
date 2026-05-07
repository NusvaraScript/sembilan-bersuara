<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PengaduanController as AdminPengaduan;
use App\Http\Controllers\User\PengaduanController as UserPengaduan;

// Halaman Depan (Landing Page)
Route::get('/', function () {
    return view('admin.index');
});