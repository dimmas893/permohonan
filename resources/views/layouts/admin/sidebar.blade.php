        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Aplikasi Pengajuan</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

                 <li class="nav-item">
                    <a class="nav-link" href="{{ route('user') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>User</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('persyaratan') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Persyaratan</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('layanan') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Layanan</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('rincian_layanan') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Rincian Layanan</span></a>
                </li>


            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
