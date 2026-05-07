<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // ── Stats 4 kartu ──────────────────────────────────────
        $totalPengaduan = Pengaduan::count();
        $totalTanggapan = Tanggapan::count();
        $totalSiswa     = Siswa::count();
        $totalPetugas   = User::where('level', 'petugas')->count();

        // ── Status penanganan ──────────────────────────────────
        // Sesuaikan value status dengan yang ada di DB-mu
        $menunggu = Pengaduan::where('status', 'menunggu')
                             ->orWhere('status', '0')
                             ->count();

        $diproses = Pengaduan::where('status', 'proses')->count();

        $selesai  = Pengaduan::where('status', 'selesai')->count();

        // ── Pengaduan terbaru (5 data) ─────────────────────────
        $pengaduanTerbaru = Pengaduan::with('siswa')   // eager load relasi
                                     ->latest()
                                     ->limit(5)
                                     ->get();

        return view('admin.index', compact(
            'totalPengaduan',
            'totalTanggapan',
            'totalSiswa',
            'totalPetugas',
            'menunggu',
            'diproses',
            'selesai',
            'pengaduanTerbaru'
        ));
    }
}