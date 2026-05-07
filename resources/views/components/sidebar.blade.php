<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo">
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

                <li class="sidebar-item {{ request()->routeIs('admin.pengaduan.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.pengaduan.index') }}" class="sidebar-link">
                        <i class="bi bi-chat-left-text-fill"></i>
                        <span>Pengaduan</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('admin.tanggapan.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.tanggapan.index') }}" class="sidebar-link">
                        <i class="bi bi-reply-fill"></i>
                        <span>Tanggapan</span>
                    </a>
                </li>

                <li class="sidebar-title">Manajemen User</li>

                <li class="sidebar-item {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.siswa.index') }}" class="sidebar-link">
                        <i class="bi bi-people-fill"></i>
                        <span>Daftar Siswa</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('admin.petugas.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.petugas.index') }}" class="sidebar-link">
                        <i class="bi bi-person-badge-fill"></i>
                        <span>Daftar Petugas</span>
                    </a>
                </li>

                <li class="sidebar-title">Akun</li>

                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>

        <button class="sidebar-toggler btn x">
            <i data-feather="x"></i>
        </button>
    </div>
</div>