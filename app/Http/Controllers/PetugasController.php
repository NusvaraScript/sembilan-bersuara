<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PetugasController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('search')->trim()->toString();

        $petugas = Petugas::withCount('tanggapan')
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($query) use ($search): void {
                    $query->where('nama_petugas', 'like', "%{$search}%")
                        ->orWhere('username', 'like', "%{$search}%")
                        ->orWhere('level', 'like', "%{$search}%");
                });
            })
            ->orderBy('nama_petugas')
            ->paginate(10)
            ->withQueryString();

        return view('admin.petugas.index', compact('petugas', 'search'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:petugas,username'],
            'nama_petugas' => ['required', 'string', 'max:255'],
            'level' => ['nullable', 'in:admin,petugas'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $validated['level'] = $validated['level'] ?? 'petugas';
        $validated['password'] = Hash::make($validated['password']);

        Petugas::create($validated);

        return redirect()
            ->route('admin.petugas.index')
            ->with('success', 'Petugas berhasil ditambahkan.');
    }

    public function update(Request $request, Petugas $petugas): RedirectResponse
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255', Rule::unique('petugas', 'username')->ignore($petugas->id)],
            'nama_petugas' => ['required', 'string', 'max:255'],
            'level' => ['required', 'in:admin,petugas'],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        $petugas->update($validated);

        return redirect()
            ->route('admin.petugas.index')
            ->with('success', 'Petugas berhasil diperbarui.');
    }
}
