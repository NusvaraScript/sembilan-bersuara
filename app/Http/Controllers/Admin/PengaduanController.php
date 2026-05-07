<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Pengaduan;
use App\Models\Siswa;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::with(['siswa', 'kategori'])->latest()->get();

        return view('admin.pengaduan.index', compact('pengaduans'));
    }

    public function create()
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        $siswas = Siswa::orderBy('nama_siswa')->get();
        $statuses = $this->statuses();

        return view('admin.pengaduan.create', compact('kategoris', 'siswas', 'statuses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());
        $validated['foto'] = $validated['foto'] ?? '';

        Pengaduan::create($validated);

        return redirect()
            ->route('admin.pengaduan.index')
            ->with('success', 'Pengaduan berhasil ditambahkan.');
    }

    public function show(Pengaduan $pengaduan)
    {
        return redirect()->route('admin.pengaduan.edit', $pengaduan);
    }

    public function edit(Pengaduan $pengaduan)
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        $siswas = Siswa::orderBy('nama_siswa')->get();
        $statuses = $this->statuses();

        return view('admin.pengaduan.edit', compact('pengaduan', 'kategoris', 'siswas', 'statuses'));
    }

    public function update(Request $request, Pengaduan $pengaduan)
    {
        $validated = $request->validate($this->rules());
        $validated['foto'] = $validated['foto'] ?? '';

        $pengaduan->update($validated);

        return redirect()
            ->route('admin.pengaduan.index')
            ->with('success', 'Pengaduan berhasil diperbarui.');
    }

    public function destroy(Pengaduan $pengaduan)
    {
        $pengaduan->delete();

        return redirect()
            ->route('admin.pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus.');
    }

    private function rules(): array
    {
        return [
            'kategori_id' => ['required', 'exists:kategori,id'],
            'siswa_nis' => ['required', 'exists:siswa,nis'],
            'judul_laporan' => ['required', 'string'],
            'isi_laporan' => ['required', 'string'],
            'foto' => ['nullable', 'string'],
            'status' => ['required', 'in:pending,proses,selesai'],
        ];
    }

    private function statuses(): array
    {
        return [
            'pending' => 'Pending',
            'proses' => 'Proses',
            'selesai' => 'Selesai',
        ];
    }
}