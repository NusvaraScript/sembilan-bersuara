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
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $tanggapan = Tanggapan::with(['pengaduan', 'petugas'])
            ->latest()
            ->paginate(10);

        return view('admin.tanggapan.index', compact('tanggapan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $pengaduan = Pengaduan::orderBy('judul_laporan')->get();
        $petugas = Petugas::orderBy('nama_petugas')->get();

        return view('admin.tanggapan.create', compact('pengaduan', 'petugas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'pengaduan_id' => ['required', 'exists:pengaduan,id'],
            'petugas_id' => ['required', 'exists:petugas,id'],
            'isi_tanggapan' => ['required', 'string'],
        ]);

        Tanggapan::create($validated);

        Pengaduan::where('id', $validated['pengaduan_id'])
            ->where('status', 'menunggu')
            ->update(['status' => 'proses']);

        return redirect()
            ->route('admin.tanggapan.index')
            ->with('success', 'Tanggapan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tanggapan $tanggapan): RedirectResponse
    {
        return redirect()->route('admin.tanggapan.edit', $tanggapan);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tanggapan $tanggapan): View
    {
        $pengaduan = Pengaduan::orderBy('judul_laporan')->get();
        $petugas = Petugas::orderBy('nama_petugas')->get();

        return view('admin.tanggapan.edit', compact('tanggapan', 'pengaduan', 'petugas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tanggapan $tanggapan): RedirectResponse
    {
        $validated = $request->validate([
            'pengaduan_id' => ['required', 'exists:pengaduan,id'],
            'petugas_id' => ['required', 'exists:petugas,id'],
            'isi_tanggapan' => ['required', 'string'],
        ]);

        $tanggapan->update($validated);

        return redirect()
            ->route('admin.tanggapan.index')
            ->with('success', 'Tanggapan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tanggapan $tanggapan): RedirectResponse
    {
        $tanggapan->delete();

        return redirect()
            ->route('admin.tanggapan.index')
            ->with('success', 'Tanggapan berhasil dihapus.');
    }
}