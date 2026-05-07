<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class PetugasController extends Controller
{
    public function index(): View
    {
        $petugas = Petugas::orderBy('nama_petugas')
            ->paginate(10);

        return view('admin.petugas.index', compact('petugas'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:petugas,username'],
            'nama_petugas' => ['required', 'string', 'max:255'],
            'level' => ['required', 'in:admin,petugas'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        Petugas::create($validated);

        return redirect()
            ->route('admin.petugas.index')
            ->with('success', 'Petugas berhasil ditambahkan.');
    }
}