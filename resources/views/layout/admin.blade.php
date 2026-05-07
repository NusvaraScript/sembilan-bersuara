<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Panel Admin</title>
    
    <!-- CSS Mazer Utama -->
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/iconly.css') }}">
    
    <!-- CSS Tambahan (Opsional, untuk halaman tertentu) -->
    @stack('styles')
</head>

<body>
    <!-- SCRIPT TEMA GELAP/TERANG MAZER -->
    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>

    <div id="app">
        
        <!-- SIDEBAR -->
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="#">NamaApp</a>
                        </div>
                        <div class="sidebar-toggler x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu Utama</li>
                        
                        <li class="sidebar-item active">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        
                        <!-- Tambahkan menu lain di sini -->
                    </ul>
                </div>
            </div>
        </div>
        <!-- END SIDEBAR -->

        <!-- MAIN CONTENT -->
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <!-- Slot untuk Livewire Volt Layouts atau @yield Laravel biasa -->
                {{ $slot ?? '' }} 
                @yield('content')
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2026 &copy; NamaApp</p>
                    </div>
                </div>
            </footer>
        </div>
        <!-- END MAIN CONTENT -->

    </div>

    <!-- SCRIPT MAZER UTAMA -->
    <script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    
    <!-- WAJIB: File ini yang membuat sidebar interaktif -->
    <script src="{{ asset('assets/compiled/js/app.js') }}"></script>
    
    <!-- JS Tambahan (Opsional) -->
    @stack('scripts')
</body>
</html>