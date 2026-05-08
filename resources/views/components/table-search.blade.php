@php
    $searchValue = $searchValue ?? request('search');
    $searchPlaceholder = $searchPlaceholder ?? 'Cari data tabel...';
@endphp

<form method="GET" action="{{ $searchAction ?? url()->current() }}" class="row g-2 align-items-center mb-3">
    <div class="col">
        <label for="search" class="visually-hidden">Cari Data</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
            <input type="search" name="search" id="search" value="{{ $searchValue }}" class="form-control" placeholder="{{ $searchPlaceholder }}" autocomplete="off">
        </div>
    </div>
    <div class="col-auto d-flex gap-2">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-search"></i> Cari
        </button>
        @if ($searchValue)
            <a href="{{ $searchAction ?? url()->current() }}" class="btn btn-outline-secondary">
                Reset
            </a>
        @endif
    </div>
</form>

@if ($searchValue)
    <p class="text-muted small mb-3">Menampilkan hasil pencarian untuk: <strong>{{ $searchValue }}</strong></p>
@endif