<ul class="navbar-nav bg-gradient-primary-dua sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon">
            <img class="img-profile"
                    src="{{asset('template/img/logo.png')}}" style="width:85%">
        </div>
        <div class="sidebar-brand-text mx-3">Desa Kebonsari</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @if (Request::segment(2) == '') active @endif">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-home"></i>
            <span>Halaman Utama</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    @if (Auth::user()->role_id != 3)
    <!-- Nav Item - Data Pengguna -->
    <li class="nav-item @if (Request::segment(2) == 'pengguna') active @endif">
        <a class="nav-link" href="{{ route('pengguna.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Data Pengguna</span></a>
    </li>

    <!-- Nav Item - Data Warga -->
    <li class="nav-item @if (Request::segment(2) == 'warga') active @endif">
        <a class="nav-link" href="{{route('warga')}}">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Warga</span></a>
    </li>
    @endif

    <!-- Nav Item - Surat -->
    <li class="nav-item @if (Request::segment(2) == 'permintaan') active @endif">
        <a class="nav-link" href="{{ route('permintaan.index') }}">
            <i class="fas fa-fw fa-envelope"></i>
            <span>Permintaan</span></a>
    </li>

    @if (Auth::user()->role_id != 3)
    <!-- Nav Item - Surat-Masuk -->
    <li class="nav-item @if (Request::segment(2) == 'surat-masuk') active @endif">
        <a class="nav-link" href="{{ route('surat-masuk.index') }}">
            <i class="fas fa-fw fa-envelope-open"></i>
            <span>Surat Masuk</span></a>
    </li>

    <!-- Nav Item - Surat-Keluar -->
    <li class="nav-item @if (Request::segment(2) == 'surat-keluar') active @endif">
        <a class="nav-link" href="{{ route('surat-keluar.index') }}">
            <i class="fas fa-fw fa-envelope-open-text"></i>
            <span>Surat Keluar</span></a>
    </li>

    <!-- Nav Item - Layanan -->
    <li class="nav-item @if (Request::segment(2) == 'laporan') active @endif">
        <a class="nav-link" href="{{route('laporan')}}">
            <i class="fas fa-fw fa-handshake"></i>
            <span>Laporan</span></a>
    </li>

    <!-- Nav Item - Prosedur -->
    <li class="nav-item @if (Request::segment(2) == 'profil-desa') active @endif">
        <a class="nav-link" href="{{ route('profil-desa.create') }}">
            <i class="fas fa-fw fa-tasks"></i>
            <span>Profil Desa</span></a>
    </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
