<style>
    .sidebar-wrapper {
        position: fixed !important;
        height: 100vh !important;
        bottom: 0 !important;
    }
    .sidebar-menu {
        padding-bottom: 5rem !important;
    }
</style>
<div id="sidebar" class="active">
    <script>
        // Mencegah sidebar "berkedip" muncul sebentar di layar kecil (mobile/tablet) saat di-refresh
        if (window.innerWidth < 1200) {
            document.getElementById('sidebar').classList.remove('active');
        }
    </script>
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo" style="height: 2.5rem;">
                    </a>
                </div>

                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block">
                        <i class="bi bi-x bi-middle"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu Utama</li>

                <li class="sidebar-item {{ request()->is('/') ? 'active' : '' }}">
                    <a href="{{ url('/') }}" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-title">Layanan</li>

                <li class="sidebar-item has-sub {{ request()->routeIs('admin.pengaduan.*') || request()->routeIs('admin.tanggapan.*') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-stack"></i>
                        <span>Data Laporan</span>
                    </a>
                    <ul class="submenu {{ request()->routeIs('admin.pengaduan.*') || request()->routeIs('admin.tanggapan.*') ? 'active' : '' }}">
                        <li class="submenu-item {{ request()->routeIs('admin.pengaduan.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.pengaduan.index') }}">Pengaduan Siswa</a>
                        </li>
                        <li class="submenu-item {{ request()->routeIs('admin.tanggapan.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.tanggapan.index') }}">Tanggapan Petugas</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-title">Manajemen User</li>

                <li class="sidebar-item has-sub {{ request()->routeIs('admin.siswa.*') || request()->routeIs('admin.petugas.*') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-people-fill"></i>
                        <span>Pengguna Sistem</span>
                    </a>
                    <ul class="submenu {{ request()->routeIs('admin.siswa.*') || request()->routeIs('admin.petugas.*') ? 'active' : '' }}">
                        <li class="submenu-item {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.siswa.index') }}">Daftar Siswa</a>
                        </li>
                        <li class="submenu-item {{ request()->routeIs('admin.petugas.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.petugas.index') }}">Daftar Petugas</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-title">Akun</li>

                <li class="sidebar-item">
                    <a href="#" class="sidebar-link text-danger">
                        <i class="bi bi-box-arrow-left text-danger"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>