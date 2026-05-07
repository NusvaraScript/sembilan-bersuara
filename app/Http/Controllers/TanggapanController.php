<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Petugas;
use App\Models\Tanggapan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TanggapanController extends Controller
{
    public function index(): View
    {
        $tanggapan = Tanggapan::with(['pengaduan.siswa', 'petugas'])
            ->latest()
            ->paginate(10);

        return view('admin.tanggapan.index', compact('tanggapan'));
    }

    public function create(): View
    {
        $pengaduan = Pengaduan::with('siswa')
            ->orderBy('judul_laporan')
            ->get();
        $petugas = Petugas::orderBy('nama_petugas')->get();

        return view('admin.tanggapan.create', compact('pengaduan', 'petugas'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->rules());

        Tanggapan::create($validated);
        $this->markPengaduanInProgress((int) $validated['pengaduan_id']);

        return redirect()
            ->route('admin.tanggapan.index')
            ->with('success', 'Tanggapan berhasil ditambahkan.');
    }

    public function show(Tanggapan $tanggapan): View
    {
        $tanggapan->load(['pengaduan.siswa', 'pengaduan.kategori', 'petugas']);

        return view('admin.tanggapan.show', compact('tanggapan'));
    }

    public function edit(Tanggapan $tanggapan): View
    {
        $pengaduan = Pengaduan::with('siswa')
            ->orderBy('judul_laporan')
            ->get();
        $petugas = Petugas::orderBy('nama_petugas')->get();

        return view('admin.tanggapan.edit', compact('tanggapan', 'pengaduan', 'petugas'));
    }

    public function update(Request $request, Tanggapan $tanggapan): RedirectResponse
    {
        $validated = $request->validate($this->rules());
        $oldPengaduanId = $tanggapan->pengaduan_id;

        $tanggapan->update($validated);

        $this->syncPengaduanStatus((int) $oldPengaduanId);
        $this->markPengaduanInProgress((int) $validated['pengaduan_id']);

        return redirect()
            ->route('admin.tanggapan.index')
            ->with('success', 'Tanggapan berhasil diperbarui.');
    }

    public function destroy(Tanggapan $tanggapan): RedirectResponse
    {
        $pengaduanId = $tanggapan->pengaduan_id;

        $tanggapan->delete();
        $this->syncPengaduanStatus((int) $pengaduanId);

        return redirect()
            ->route('admin.tanggapan.index')
            ->with('success', 'Tanggapan berhasil dihapus.');
    }

    private function rules(): array
    {
        return [
            'pengaduan_id' => ['required', 'exists:pengaduan,id'],
            'petugas_id' => ['required', 'exists:petugas,id'],
            'isi_tanggapan' => ['required', 'string', 'max:255'],
        ];
    }

    private function markPengaduanInProgress(int $pengaduanId): void
    {
        Pengaduan::where('id', $pengaduanId)
            ->where('status', 'pending')
            ->update(['status' => 'proses']);
    }

    private function syncPengaduanStatus(int $pengaduanId): void
    {
        $pengaduan = Pengaduan::withCount('tanggapan')->find($pengaduanId);

        if ($pengaduan === null || $pengaduan->status === 'selesai') {
            return;
        }

        $pengaduan->update([
            'status' => $pengaduan->tanggapan_count > 0 ? 'proses' : 'pending',
        ]);
    }
}