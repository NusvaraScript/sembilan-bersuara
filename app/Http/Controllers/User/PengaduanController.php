<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PengaduanController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kategori_id' => ['required', 'exists:kategori,id'],
            'siswa_nis' => ['required', 'exists:siswa,nis'],
            'judul_laporan' => ['required', 'string', 'max:255'],
            'isi_laporan' => ['required', 'string'],
            'foto' => ['nullable', 'image', 'max:2048'],
        ], [
            'siswa_nis.exists' => 'NIS belum terdaftar sebagai siswa.',
        ]);

        $foto = '';
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('pengaduan', 'public');
        }

        Pengaduan::create([
            'kategori_id' => $validated['kategori_id'],
            'siswa_nis' => $validated['siswa_nis'],
            'judul_laporan' => $validated['judul_laporan'],
            'isi_laporan' => $validated['isi_laporan'],
            'foto' => $foto,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('home')
            ->with('success', 'Laporan Anda berhasil dikirim dan menunggu verifikasi petugas.');
    }

    public function status(Request $request): View
    {
        $nis = $request->string('nis')->trim()->toString();
        $pengaduans = collect();

        if ($nis !== '') {
            $pengaduans = Pengaduan::with(['kategori', 'tanggapan.petugas'])
                ->where('siswa_nis', $nis)
                ->latest()
                ->get();
        }

        return view('user.pengaduan.status', compact('nis', 'pengaduans'));
    }
}
