@extends('layouts.app')

@section('title', 'Dashboard Utama')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Dashboard Admin</h3>
                <p class="text-subtitle text-muted">Selamat datang di aplikasi.</p>
            </div>
        </div>
    </div>
    
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Statistik Bulan Ini</h4>
            </div>
            <div class="card-body">
                Isi dari halaman dashboard Anda letakkan di sini.
                (Anda bisa menaruh komponen Livewire <x-molecules.stat-card> Anda di sini).
            </div>
        </div>
    </section>
@endsection