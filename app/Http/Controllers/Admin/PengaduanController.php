<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Pengaduan;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PengaduanController extends Controller
{
    public function index(): View
    {
        $pengaduans = Pengaduan::with(['siswa', 'kategori', 'tanggapan'])
            ->latest()
            ->paginate(10);

        return view('admin.pengaduan.index', compact('pengaduans'));
    }

    public function create(): View
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        $siswas = Siswa::orderBy('nama_siswa')->get();
        $statuses = $this->statuses();

        return view('admin.pengaduan.create', compact('kategoris', 'siswas', 'statuses'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->rules());
        $validated['foto'] = $validated['foto'] ?? '';

        Pengaduan::create($validated);

        return redirect()
            ->route('admin.pengaduan.index')
            ->with('success', 'Pengaduan berhasil ditambahkan.');
    }

    public function show(Pengaduan $pengaduan): View
    {
        $pengaduan->load(['kategori', 'siswa', 'tanggapan.petugas']);

        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    public function edit(Pengaduan $pengaduan): View
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        $siswas = Siswa::orderBy('nama_siswa')->get();
        $statuses = $this->statuses();

        return view('admin.pengaduan.edit', compact('pengaduan', 'kategoris', 'siswas', 'statuses'));
    }

    public function update(Request $request, Pengaduan $pengaduan): RedirectResponse
    {
        $validated = $request->validate($this->rules());
        $validated['foto'] = $validated['foto'] ?? '';

        $pengaduan->update($validated);

        return redirect()
            ->route('admin.pengaduan.index')
            ->with('success', 'Pengaduan berhasil diperbarui.');
    }

    public function destroy(Pengaduan $pengaduan): RedirectResponse
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
            'judul_laporan' => ['required', 'string', 'max:255'],
            'isi_laporan' => ['required', 'string'],
            'foto' => ['nullable', 'string', 'max:255'],
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