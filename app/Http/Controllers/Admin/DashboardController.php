<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Petugas;
use App\Models\Siswa;
use App\Models\Tanggapan;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $statusMenunggu = ['pending', 'menunggu', '0'];
        $today = Carbon::today();

        $totalPengaduan = Pengaduan::count();
        $totalTanggapan = Tanggapan::count();
        $totalSiswa = Siswa::count();
        $totalPetugas = Petugas::count();

        $menunggu = Pengaduan::whereIn('status', $statusMenunggu)->count();
        $diproses = Pengaduan::where('status', 'proses')->count();
        $selesai = Pengaduan::where('status', 'selesai')->count();

        $pengaduanHariIni = Pengaduan::whereDate('created_at', $today)->count();
        $belumDitanggapi = Pengaduan::whereDoesntHave('tanggapan')->count();
        $petugasAktif = Tanggapan::whereDate('created_at', $today)
            ->distinct('petugas_id')
            ->count('petugas_id');

        $pengaduanTerbaru = Pengaduan::with(['siswa', 'kategori'])
            ->latest()
            ->limit(5)
            ->get();

        $aktivitasPetugas = Tanggapan::with(['petugas', 'pengaduan'])
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
            'pengaduanHariIni',
            'belumDitanggapi',
            'petugasAktif',
            'pengaduanTerbaru',
            'aktivitasPetugas'
        ));
    }
}
