<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:void(0)" class="brand-link">
        @if (!empty($setting))
            <img src="{{ asset('logo') }}/{{ $setting->logo_sidebar }}" id="logo-sidebar" alt="AdminLTE Logo" width="220"
                style="opacity: .8">
            <span class="brand-text font-weight-light"></span>
        @else
            <img src="{{ asset('logo/logo-invers.png') }}" id="logo-sidebar" alt="AdminLTE Logo" width="220"
                style="opacity: .8">
            <span class="brand-text font-weight-light"></span>
        @endif

    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="javascript:void(0)" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-header">Dashboard</li>
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header">Master</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Setting Web
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{ route('setting_web.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Setting Web</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('setting_halaman_utama.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Setting Halaman Utama</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kerjasama.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kerjasama</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-header">PJM UNIBA</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Selayang Pandang
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{ route('profile.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('visi_misi_tujuan.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Visi,Misi dan Tujuan PJM </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('struktur_organisasi.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Struktur Organisasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('personalia.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Personalia</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tupoksi_pjm.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tupoksi PJM Uniba</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Roadmap Penjaminan Mutu UNIBA</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Divisi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{ route('divisi.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Divisi</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Dokumen
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{ route('dokumen.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dokumen</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-images"></i>
                        <p>
                            Media
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{ route('media.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Media</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
