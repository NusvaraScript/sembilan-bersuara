<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\View\View;

class PetugasController extends Controller
{
    public function index(): View
    {
        $petugas = Petugas::withCount('tanggapan')
            ->orderBy('nama_petugas')
            ->paginate(10);

        return view('admin.petugas.index', compact('petugas'));
    }
}