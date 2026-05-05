<header class="header-wrapper">
    <div class="topbar clearfix" style="background-color: #006634;">
        <div class="container">
            <ul class="topbar-left">
                <li class="phoneNo"><i class="fa fa-phone"></i>(0328) 6771010</li>
                <li class="email-id hidden-xs hidden-sm"><i class="fa fa-envelope"></i>
                    <a href="mailto:admin@unibamadura.ac.id"> admin@unibamadura.ac.id</a>
                </li>
            </ul>
           <ul class="topbar-right">
          <li class="hidden-xs"><a href="https://www.instagram.com/unibamadura/" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
          <li class="hidden-xs"><a href="https://www.facebook.com/unibamaduraa?locale=id_ID" target="_blank"><i class="fa-brands fa-facebook"></i></a></li>
          <li class="hidden-xs"><a href="#"><i class="fa-solid fa-envelope"></i></a></li>
          <li class="hidden-xs"><a href="https://www.youtube.com/@unibamadura" target="_blank"><i class="fa-brands fa-youtube"></i></a></li>
                {{-- <li class="hidden-xs"><a href="#"><i class="fa fa-rss"></i></a></li> --}}
                {{-- <li class="top-search list-inline">
            <a href="#"><i class="fa fa-search"></i></a>
            <ul class="dropdown-menu dropdown-menu-right">
              <li>
                <span class="input-group">
                  <input type="text" class="form-control" placeholder="Course Name">
                  <button type="submit" class="btn btn-default commonBtn">Search</button>
                </span>
              </li>
            </ul>
          </li>
          <li class="dropdown language">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-globe"></i>EN
            <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu">
              <li class="active">
                    <a href="#">English </a>
              </li>
              <li><a href="#">Spanish</a></li>
              <li><a href="#">Russian</a></li>
              <li><a href="#">German</a></li>
            </ul>
          </li> --}}
            </ul>
        </div>
    </div>

    <div class="header clearfix">
        <nav class="navbar navbar-main navbar-default">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="header_inner">

                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
        data-target="#main-nav" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>

    <a class="navbar-brand" href="/">
        <img src="{{ asset('logo/logo_unibamadura.png') }}" class="logo" alt="Uniba Madura">
    </a>
                                </a {{-- <a class="navbar-brand logo clearfix" href="#"><img src="{{ asset('logo/logo_unibamadura.png') }}" alt="Uniba Madura" class="img-responsive" /></a> --}} </div>
                                <!-- Collect the nav links, forms, and other content for toggling -->
                                <div class="collapse navbar-collapse" id="main-nav">
                                    <ul class="nav navbar-nav navbar-right">
                                        <li class="active" style="color: #006634 !important;">
                                            <a href="/" role="button"
                                                style="color: #006634 !important;">Beranda</a>
                                        </li>
                                        <li class=" dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                                role="button" aria-haspopup="true" aria-expanded="false">Profil</a>
                                            <ul class="dropdown-menu">
                                                <li><a href="/profile/profile-pjm">Profil PJM</a></li>
                                                <li><a href="/profile/visi-dan-misi">Visi Dan Misi </a>
                                                    {{-- <li><a href="{{ route('frontend.tugas-fungsi') }}">Tugas Dan Fungsi </a> --}}
                                                <li><a href="{{ route('frontend.struktur_organisasi') }}">Struktur
                                                        Organisasi</a></li>
                                                {{-- <li><a href="{{ route('frontend.personalia') }}">Personalia</a></li> --}}
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                Layanan <span class=""></span>
                                            </a>
                                            <ul class="dropdown-menu dropdown-layanan">

                                                <!-- Pusat Pengembangan Standar Mutu -->
                                                <li class="dropdown-submenu">
                                                    <a href="#">Pusat Pengembangan Standar Mutu</a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="{{ route('frontend.daftar_asesor_bkd') }}">Daftar
                                                                Asesor BKD</a>
                                                        </li>
                                                        <li><a href="{{ route('frontend.siklus_spmi') }}">Siklus
                                                                SPMI</a></li>
                                                        <li><a href="{{ route('frontend.kpm_gpm') }}">KPM & GPM</a></li>
                                                        <li><a href="{{ route('frontend.surat_tugas_monev') }}">Surat
                                                                Tugas Monev</a>
                                                        </li>
                                                        <li><a href="{{ route('frontend.laporan_monev') }}">Laporan
                                                                Monev</a></li>
                                                        {{-- DALAM BENTUK TABEL SAJA --}}
                                                    </ul>
                                                </li>

                                                <!-- Pusat Audit dan Pengendalian Mutu -->
                                                <li class="dropdown-submenu">
                                                    <a href="#">Pusat Audit dan Pengendalian Mutu</a>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="{{ route('frontend.laporan_hasil_survei') }}">Laporan Hasil
                                                                Survei</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('frontend.laporan_ami') }}">Laporan Ami
                                                                </a>
                                                        </li>
                                                        {{-- DALAM BENTUK TABEL SAJA --}}
                                                        <li><a href="{{ route('frontend.jadwal_rtm') }}">Jadwal RTM</a>
                                                        </li>
                                                        <li><a href="{{ route('frontend.jadwal_ami') }}">Jadwal AMI</a>
                                                        </li>
                                                        <li><a href="{{ route('frontend.daftar_auditor_internal') }}">Daftar
                                                                Auditor
                                                                Internal</a></li>
                                                        <li><a href="{{ route('frontend.survei_pemangku') }}">
                                                                        Survei Untuk Pemangku Kepentingan</a></li>
                                                        <li><a href="{{ route('frontend.kalender_mutu') }}">Kalender Mutu</a>
                                                        </li>
                                                        <li><a href="{{ route('frontend.kalender_akademik') }}">Kalender Akademik</a>
                                                        </li>
                                                        <li><a href="{{ route('frontend.sertifikasi_dosen') }}">Sertifikasi
                                                                Dosen</a>
                                                        </li>
                                                    </ul>
                                                </li>

                                                <!-- Tracer Study -->
                                                <li class="dropdown-submenu">
                                                    <a href="#">Tracer Study</a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#">Laporan Tracer Study 2022</a></li>
                                                    </ul>
                                                </li>

                                            </ul>
                                        </li>

                                        <li class="dropdown akreditasi-menu">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                Akreditasi <span class=""></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{ route('frontend.akreditasi_institusi') }}">
                                                        Akreditasi Institusi</a></li>
                                                <li><a href="{{ route('frontend.akreditasi_program_studi') }}">SK &
                                                        Sertifikat
                                                        <br> Akreditasi Program Studi</a></li>
                                                <li><a href="{{ route('frontend.mekanisme_pengajuan_akreditasi') }}">Mekanisme Pengajuan Akreditasi
                                                         </a></li>
                                                {{-- <li class="dropdown-submenu">
                                                    <a href="#">Instrumen Akreditasi
                                                        <span class="submenu-arrow"></span>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="https://www.banpt.or.id/akreditasi/instrumen-akreditasi/"
                                                                target="_blank">
                                                                Instrumen 9 Kriteria
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="https://www.banpt.or.id/"
                                                                target="_blank">
                                                                LED & LKPS
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li> --}}
                                            </ul>
                                        </li>

                                        <li class="dropdown akreditasi-menu">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dokumen
                                                PJM <span class=""></span></a>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-submenu">
                                                    <a href="#">Dokumen Induk
                                                        <span class="submenu-arrow"></span>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="{{ route('frontend.regulasi') }}">Regulasi</a>
                                                        </li>
                                                        <li><a href="{{ route('frontend.kebijakan_rektor') }}">Produk
                                                                Kebijakan <br> Rektor</a></li>
                                                        <li><a
                                                                href="{{ route('frontend.rencana_induk_pengembangan') }}">Rencana
                                                                Induk <br> Pengembangan</a></li>
                                                        <li><a href="{{ route('frontend.rencana_strategis') }}">Rencana
                                                                Strategis Uniba Madura <br>
                                                                Universitas Bahaudin
                                                                Mudhary</a></li>
                                                        <li><a
                                                                href="{{ route('frontend.rencana_strategis_lembaga') }}">Rencana
                                                                Strategis <br>Lembaga Penjaminan
                                                                Mutu <br>Uniba Madura</a></li>
                                                        <li><a href="{{ route('frontend.rencana_operasional') }}">Rencana
                                                                Operasional</a></li>
                                                        <li><a href="{{ route('frontend.statua_ortaker') }}">Statuta &
                                                                Ortaker</a></li>
                                                    </ul>
                                                </li>
                                                <li class="dropdown-submenu">
                                                    <a href="#">Dokumen Mutu<span
                                                            class="submenu-arrow"></span></a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="{{ route('frontend.dokumen_spmi') }}">Dokumen
                                                                SPMI</a></li>
                                                        <li><a href="{{ route('frontend.pedoman') }}">Pedoman</a></li>
                                                        <li><a href="{{ route('frontend.standar') }}">Standar</a></li>
                                                        <li><a href="{{ route('frontend.sop') }}">SOP</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>

                                        <li class="dropdown infogram-dropdown">
                                            <a href="#" class="dropdown-toggle"
                                                data-toggle="dropdown">Statistik <span class=""></span></a>
                                            <ul class="dropdown-menu infogram-menu">
                                                <li>
                                                    <a href="{{ route('statistik.dosen') }}">
                                                        Data Dosen

                                                    </a>
                                                </li>
                                                <li><a href="{{ route('statistik.mahasiswa') }}">Data Mahasiswa</a>
                                                </li>
                                                <li><a href="{{ route('statistik.alumni') }}">Data Alumni (Tracer Study)</a></li>
                                            </ul>
                                        </li>
                                        <li class="">
                                            <a href="{{ route('frontend.sistem_informasi_mutu') }}" class="" data-toggle="">
                                                Sistem Informasi Mutu <span class=""></span>
                                            </a>

                                        </li>

                                    </ul>
                                </div><!-- navbar-collapse -->

                            </div>
                        </div>
                    </div>
                </div><!-- /.container -->
        </nav><!-- navbar -->
    </div>
</header>
