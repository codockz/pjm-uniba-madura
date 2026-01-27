
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
          <li class="hidden-xs"><a href="https://www.instagram.com/unibamadura/" target="_blank"><i class="fa fa-instagram"></i></a></li>
          <li class="hidden-xs"><a href="https://www.facebook.com/unibamaduraa?locale=id_ID" target="_blank"><i class="fa fa-facebook"></i></a></li>
          <li class="hidden-xs"><a href="#"><i class="fa fa-envelope"></i></a></li>
          <li class="hidden-xs"><a href="https://www.youtube.com/@unibamadura8029" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
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
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav" aria-expanded="false">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  </button>
                  
                  <a class="navbar-brand" href="{{ route('frontend.frontend') }}">
                  <img src="{{ asset('logo/logo_unibamadura.png') }}" class="logo clearfix" alt="Uniba Madura" width="300" style="margin-top:10px;">
                  {{-- <a class="navbar-brand logo clearfix" href="#"><img src="{{ asset('logo/logo_unibamadura.png') }}" alt="Uniba Madura" class="img-responsive" /></a> --}}
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="main-nav">
                  <ul class="nav navbar-nav navbar-right">
    {{-- <li>
        <a href="{{ route('frontend.frontend') }}">Beranda</a>
    </li> --}}

    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            Profil <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li><a href="{{ route('frontend.profile') }}">Profil PJM</a></li>
            <li><a href="{{ route('frontend.visi-misi') }}">Visi Misi & Tujuan</a></li>
            <li><a href="{{ route('frontend.struktur_organisasi') }}">Struktur Organisasi</a></li>
            <li><a href="{{ route('frontend.personalia') }}">Personalia</a></li>
        </ul>
    </li>

    <li><a href="#">Layanan</a></li>
    <li><a href="#">Akreditasi</a></li>
    <li><a href="#">Dokumen Induk</a></li>
    <li><a href="#">Dokumen Mutu</a></li>
    <li><a href="#">Infografis</a></li>

    <li>
        <a href="{{ route('frontend.sim') }}">Sistem Informasi Mutu</a>
    </li>
</ul>

                    {{-- <li class="active" style="color: #006634 !important;">
                      <a href="/" role="button" style="color: #006634 !important;">Beranda</a> --}}
                    </li>
                    <li class=" dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Profil</a>
                      <ul class="dropdown-menu">
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">PJM</a>
                          <ul class="dropdown-menu">
                            <li><a href="{{ route('frontend.profile') }}">Profil</a></li>
                            <li><a href="{{ route('frontend.visi-misi') }}">Visi,Misi dan Tujuan</a></li>
                            <li><a href="{{ route('frontend.struktur_organisasi') }}">Struktur Organisasi</a></li>
                            <li><a href="{{ route('frontend.personalia') }}">Personalia</a></li>
                            <li><a href="{{ route('frontend.tupoksi_pjm') }}">Tupoksi PJM Uniba</a></li>
                          </ul>
                        </li>
                            @php
                              use App\Models\KategoriDivisi;
                              use App\Models\SubKategoriDivisi;
                              $kategori_divisi = KategoriDivisi::all();

                              $sub_kategori_divisi = SubKategoriDivisi::all();
                              // dd($sub_kategori_divisi,$kategori_divisi);
                            @endphp
                        @foreach ($kategori_divisi as $div)
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ $div->nama_kategori }}</a>
                          <ul class="dropdown-menu">
                                @forelse ($sub_kategori_divisi->where('kategori_divisi_id', $div->id) as $sub)
                                <li><a href="{{ route('frontend.divisi',$sub->sub_kategori_divisi) }}">{{ $sub->sub_kategori_divisi }}</a></li>
                                @empty
                                    <li style="font-size: 9px;">Tidak ada sub kategori Divisi </li>
                                @endforelse
                            </ul>
                            </li>
                          </ul>
                        </li>
                        @endforeach
                    <li class=" dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dokumen</a>
                      <ul class="dropdown-menu">
                        @php
                            use App\Models\KategoriDokumen;
                            use App\Models\SubKategoriDokumen;
                            $kategori = KategoriDokumen::all();
                            $sub_kategori = SubKategoriDokumen::all();
                       @endphp
                        @foreach ($kategori as $kat)
                            <li class="dropdown">
                                <!-- Category Link -->
                                <a href="#" class="dropdown-toggle subcategory-link">{{ $kat->nama_kategori }}</a>
                                <ul class="dropdown-menu">
                                    @forelse ($sub_kategori->where('kategori_dokumen_id', $kat->id) as $sub)
                                        <!-- Subcategory Links -->
                                        <li><a href="{{ route('frontend.dokumen',$sub->sub_kategori_dokumen) }}" class="subcategory-link">{{ $sub->sub_kategori_dokumen }}</a></li>
                                    @empty
                                        <li style="font-size: 9px;">Tidak ada sub kategori dokumen </li>
                                    @endforelse
                                </ul>
                            </li>
                        @endforeach
                     </ul>
                      </li>
                    <li class=" dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">SPMI dan AMI</a>
                      <ul class="dropdown-menu">
                        <li><a href="javascript::void(0);">Workshop SPMI</a></li>
                        <li><a href="javascript::void(0);">Workshop AMI</a></li>
                      </ul>
                    </li>
                    <li class=" dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Media</a>
                        <ul class="dropdown-menu">
                          <li><a href="{{ route('frontend.pengumuman') }}">Pengumuman</a></li>
                          <li><a href="{{ route('frontend.berita') }}">Berita</a></li>
                          <li><a href="{{  route('frontend.agenda') }}">Agenda</a></li>
                          <li><a href="{{ route('frontend.foto') }}">Foto</a></li>
                        </ul>
                      </li>
                    {{-- <li class="apply_now"><a href="javascript::(0);" style="background-color: transparent !important;  pointer-events: none;" >Apply Now </a></li>
                  </ul> --}}
                </div><!-- navbar-collapse -->

              </div>
            </div>
          </div>
        </div><!-- /.container -->
      </nav><!-- navbar -->
    </div>
  </header>

