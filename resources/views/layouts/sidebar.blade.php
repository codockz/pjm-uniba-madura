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
                        <li class="nav-item">
                            <a href="{{ route('slider.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Slide halaman Beranda</p>
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
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>
                            Sidebar
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('sidebar-category.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sidebar</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('sidebar-item.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Item Sidebar</p>
                            </a>
                        </li>

                    </ul>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{ route('admin.program-studi.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>Program Studi</p>
                    </a>
                </li> --}}
                <li class="nav-header">Fitur</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Profil
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('profile.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Profil PJM</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('visi_misi_tujuan.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Visi, Misi & Tujuan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin_struktur_organisasi.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Struktur Organisasi</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- ================== LAYANAN ================== --}}
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Layanan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-university"></i>
                                <p>
                                    Pusat Pengembangan Standar Mutu
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.daftar_asesor_bkd.index') }}"class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Daftar Asesor BKD</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.siklus-spmi.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Siklus SPMI</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.kpm_gpm.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>KPM & GPM</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.surat_tugas_monev.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Surat Tugas Monev</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.laporan_monev.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Laporan Monev</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-clipboard-check"></i>
                                <p>
                                    Pusat Audit & Pengendalian Mutu
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.laporan_hasil_survei.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Laporan Hasil Survei</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.laporan_ami.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Laporan AMI</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.jadwal_rtm.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Jadwal RTM</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.jadwal_ami.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Jadwal AMI</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.auditor_internal.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Daftar Auditor Internal</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.kalender_mutu.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kalender Mutu</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.kalender_akademik.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kalender Akademik</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.survei_pemangku.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Survei Pemangku Kepentingan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.sertifikasi_dosen.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Sertifikasi Dosen</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.pedoman_sertifikasi_dosen.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pedoman Sertifikasi Dosen</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user-graduate"></i>
                                <p>
                                    Tracer Study
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Laporan Tracer Study 2022</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </li>
                {{-- ================ AKHIR LAYANAN ================ --}}
                {{-- ================== AKREDITASI ================== --}}
                <li class="nav-item has-treeview">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-certificate"></i>
                        <p>
                            Akreditasi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        {{-- Akreditasi Institusi --}}
                        <li class="nav-item">
                            <a href="{{ route('admin.akreditasi_institusi.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Akreditasi Institusi</p>
                            </a>
                        </li>
                        {{-- SK & Sertifikat --}}
                        <li class="nav-item">
                            <a href="{{ route('admin.sk_akreditasi_prodi.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>SK & Sertifikat Akreditasi Program Studi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.mekanisme_pengajuan_akreditasi.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Mekanisme Pengajuan Akreditasi</p>
                            </a>
                        </li>

                        {{-- Mekanisme --}}
                        {{-- <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-route"></i>
                                <p>
                                    Mekanisme Pengajuan Akreditasi
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Syarat Pengajuan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Alur Pengajuan</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                        {{-- Instrumen Akreditasi --}}
                        {{-- <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fas fa-clipboard-list nav-icon"></i>
                                <p>
                                    Instrumen Akreditasi
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Instrumen 9 Kriteria</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>LED & LKPS</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                    </ul>
                </li>
                {{-- ================ END AKREDITASI ================ --}}
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            Dokumen PJM
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- ================= DOKUMEN INDUK ================= --}}
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-folder-open"></i>
                                <p>
                                    Dokumen Induk
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.regulasi.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Regulasi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.kebijakan_rektor.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Produk Kebijakan Rektor</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.rencana_induk_pengembangan.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Rencana Induk Pengembangan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.rencana_strategis.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Rencana Strategis PJM Universitas Bahaudin Mudhari</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.rencana_strategis_lembaga.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Rencana Strategis PJM Uniba Madura</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.rencana_operasional.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Rencana Operasional</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.statua_ortakers.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Statuta & Ortaker</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- ================= DOKUMEN MUTU ================= --}}
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Dokumen Mutu
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.dokumen_spmi.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Dokumen SPMI</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.pedoman.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pedoman</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.standar.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Standar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.sop.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>SOP</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                {{-- ================== STATISTIK ================== --}}
                {{-- <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            Statistik Dosen
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Dosen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Mahasiswa</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Alumni (Tracer Study)</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                {{-- ================ END STATISTIK ================ --}}
               <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-images"></i>
                        <p>
                            Sistem Informasi Mutu
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{ route('admin.sistem_informasi_mutu.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sistem Informasi Mutu</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- ================ END SISTEM INFORMASI MUTU ================ --}}

                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
</aside>
