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
    public function index(Request $request): View
    {
        $search = $request->string('search')->trim()->toString();

        $pengaduans = Pengaduan::with(['siswa', 'kategori', 'tanggapan'])
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($query) use ($search): void {
                    $query->where('judul_laporan', 'like', "%{$search}%")
                        ->orWhere('isi_laporan', 'like', "%{$search}%")
                        ->orWhere('status', 'like', "%{$search}%")
                        ->orWhereHas('siswa', function ($query) use ($search): void {
                            $query->where('nama_siswa', 'like', "%{$search}%")
                                ->orWhere('nis', 'like', "%{$search}%");
                        })
                        ->orWhereHas('kategori', function ($query) use ($search): void {
                            $query->where('nama_kategori', 'like', "%{$search}%");
                        });
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.pengaduan.index', compact('pengaduans', 'search'));
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