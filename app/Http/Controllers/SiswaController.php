<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\View\View;

class SiswaController extends Controller
{
    public function index(): View
    {
        $siswas = Siswa::withCount('pengaduan')
            ->orderBy('nama_siswa')
            ->paginate(10);

        return view('admin.siswa.index', compact('siswas'));
    }
}