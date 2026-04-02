@extends('frontend_layouts.app')
@section('content')
    {{-- <div class="banner carousel slide" id="recommended-item-carousel" data-ride="carousel">
  <div class="slides carousel-inner">
    <div class="item active">
        @if ($data->isEmpty())
        @else
        <img src="{{ asset('gambar_slide') }}/{{ $data->first()->gambar_slide }}" alt=""/>
        @endif
      <div class="banner_caption">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <div class="caption_inner animated fadeInUp">
                @if ($data->isEmpty())
                @else
                <h1>{{ $data->first()->judul }}</h1>
                @endif
                @if ($data->isEmpty())
                @else
                <p>{{ $data->first()->isi }}</p>
                @endif
              </div><!--end caption_inner-->
            </div>
          </div><!--end row-->
        </div><!--end container-->
      </div><!--end banner_caption-->
    </div>
    @foreach ($data->skip(1) as $a)
    <div class="item">
      <img src="{{ asset('gambar_slide') }}/{{ $a->gambar_slide }}" alt="" />
      <div class="banner_caption">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <div class="caption_inner animated fadeInUp">
                <h1>{{ $a->judul }}</h1>
                <p>{{ $a->isi }}</p>
              </div><!--end caption_inner-->
            </div>
          </div><!--end row-->
        </div><!--end container-->
      </div><!--end banner_caption-->
    </div>
    @endforeach

  </div>
  <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
    <img src="{{ asset('frontend_asset/img/home/slider/prev.png') }}">
    </a>
  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
    <img src="{{ asset('frontend_asset/img/home/slider//next.png') }}">
  </a>
</div><!--end banner--> --}}
    @php
        $monthNames = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember',
        ];
    @endphp
    <div class="mainContent clearfix">
        <div class="container">
            <div class="row clearfix">

                <div class="col-sm-8 col-xs-12">
                    <div class="videoNine clearfix">

                        <div class="videoArea clearfix">
                            <h3>Selamat datang di Pusat Jaminan Mutu Uniba Madura</h3>
                            <div class="row">
                                @if (!empty($about))
                                    <div class="col-lg-8 col-md-7 col-xs-12 videoLeft">
                                        {{-- <iframe width="560" height="315" src="https://youtu.be/22bHe05BX8M?si=xe25YTrb-PRl3jcF" frameborder="0" allowfullscreen></iframe> --}}
                                        <iframe width="560" height="315" src="{{ $about->link_video }}"
                                            title="Ayo Daftar Sekarang!! PMDK UNIBA MADURA" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            allowfullscreen></iframe>
                                    </div><!-- videoLeft -->
                                    <div class="col-lg-4 col-md-5 col-xs-12 videoRight">
                                        <p>{{ $about->isi }}</p>
                                        {{-- <a href="about.html" class="btn btn-block learnBtn">Selengkapnya</a> --}}
                                    </div><!-- videoRight -->
                                @else
                                    <center>
                                        <h1>No Content Found</h1>
                                    </center>
                                @endif
                            </div><!-- row -->
                        </div><!-- videoArea -->

                        <div class="related_post_sec single_post">
                            @if (isset($month))
                                <h4 style="margin-bottom:10px;">
                                    Bulan: {{ $month }}/{{ $year }}
                                </h4>
                            @endif
                            <h3>Berita Uniba</h3>
                            <ul>
                                @forelse ($berita as $b)
                                    <li>
                                        <span class="rel_thumb">
                                            <a href="{{ route('frontend.showBerita', $b->slug) }}"><img
                                                    src="{{ asset('gambar_media') }}/{{ $b->gambar }}"></a>
                                        </span><!--end rel_thumb-->
                                        <div class="rel_right">
                                            <h4><a
                                                    href="{{ route('frontend.showBerita', $b->slug) }}">{{ $b->judul }}</a>
                                            </h4>
                                            <div class="meta">
                                                <span class="author">Posted in: <a
                                                        href="{{ route('frontend.showBerita', $b->slug) }}">{{ $b->lokasi }}</a></span>
                                                <span class="date">on: <a
                                                        href="{{ route('frontend.showBerita', $b->slug) }}">
                                                        @if (!empty($b->tanggal) && strtotime($b->tanggal))
                                                            {{ date('d', strtotime($b->tanggal)) }},
                                                            {{ $monthNames[\Carbon\Carbon::parse($b->tanggal)->format('F')] }}
                                                            {{ date('Y', strtotime($b->tanggal)) }}
                                                        @else
                                                            -
                                                        @endif
                                                    </a></span>
                                            </div>
                                            <p>{{ Str::limit($b->isi, 240) }}</p>
                                        </div><!--end rel right-->
                                    </li>
                                @empty
                                    <li>
                                        <center><strong>Tidak Ada Berita</strong></center>
                                    </li>
                                @endforelse
                            </ul>
                        </div><!--related_post_sec-->

                    </div><!--videoNine-->
                </div><!-- col-sm-8 col-xs-12 -->

                <div class="col-sm-4 col-xs-12">
                    <div class="formArea clearfix">
                        <div class="formTitle">
                            <h3>E-Survey</h3>
                        </div>
                        <ul>
                            <li style="list-style: inside;">
                                <a href="#">Kuesioner VMTS Dosen</a>
                            </li>
                            <li style="list-style: inside;">
                                <a href="#">Kuesioner VMTS Tenaga Kependidikan</a>
                            </li>
                            <li style="list-style: inside;">
                                <a href="#">Kuesioner VMTS Mahasiswa</a>
                            </li>
                        </ul>
                    </div>
                    <div class="formArea clearfix">
                        <div class="formTitle">
                            <h3>Tautan Cepat</h3>
                            <p>Berikut adalah tautan yang anda bisa akases :</p>
                        </div><!-- formTitle -->
                        <ul>
                            <li style="list-style: inside;"><a href="https://unibamadura.ac.id">Uniba Madura</a></li>
                            <li style="list-style: inside;"><a href="https://fst.unibamadura.ac.id">Fakultas Sains &
                                    Teknologi</a></li>
                            <li style="list-style: inside;"><a href="https://pmb.unibamadura.ac.id/login">PMB UNIBA
                                    Madura</a></li>
                            {{-- <li><a href=""></a></li> --}}
                        </ul>
                    </div><!-- formArea -->
                    <div class="formArea clearfix">
                        <div class="formTitle">
                            <h3>Kalender</h3>
                        </div>

                        @php
                            use Carbon\Carbon;

                            if (isset($year) && is_numeric($year) && isset($month) && is_numeric($month)) {
                                $currentDate = Carbon::create($year, $month, 1);
                            } else {
                                $currentDate = Carbon::now();
                            }

                            $now = $currentDate;

                            $startDay = $currentDate->copy()->startOfMonth()->dayOfWeek;
                            $daysInMonth = $currentDate->daysInMonth;

                            $prev = $currentDate->copy()->subMonth();
                            $next = $currentDate->copy()->addMonth();
                        @endphp

                        @php
                            $prev = $currentDate->copy()->subMonth();
                            $next = $currentDate->copy()->addMonth();
                        @endphp

                        <div style="text-align:center; padding:10px;">

                            <!-- tombol prev next -->
                            <div style="display:flex; justify-content:space-between; margin-bottom:10px; font-size:14px;">
                                <a href="{{ route('frontend.byMonth', [$prev->year, $prev->month]) }}">
                                    « {{ $prev->translatedFormat('F Y') }}
                                </a>

                                <a href="{{ route('frontend.byMonth', [$next->year, $next->month]) }}">
                                    {{ $next->translatedFormat('F Y') }} »
                                </a>
                            </div>

                            <!-- judul bulan -->
                            <h5 style="margin-bottom:10px;">
                                {{ $currentDate->translatedFormat('F Y') }}
                            </h5>

                            <table class="table table-bordered text-center" style="font-size:12px;">
                                <thead>
                                    @for ($i = 0; $i < $startDay; $i++)
                                        <td></td>
                                    @endfor

                                    @for ($day = 1; $day <= $daysInMonth; $day++)
                                        @php
                                            $formattedDay = str_pad($day, 2, '0', STR_PAD_LEFT);
                                        @endphp

                                        <td>
                                            @if (in_array($formattedDay, $datesWithBerita))
                                                <a
                                                    href="{{ url('arsip/' . $now->year . '/' . $now->month . '?day=' . $formattedDay) }}">
                                                    <strong>{{ $day }}</strong>
                                                </a>
                                            @else
                                                {{ $day }}
                                            @endif
                                        </td>

                                        @if (($day + $startDay) % 7 == 0)
                                            </tr>
                                            <tr>
                                        @endif
                                    @endfor
                                    </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="formArea clearfix">
                        <div class="formTitle">
                            <h3>Fakultas & Pascasarjana</h3>
                        </div>
                        <ul>
                            <li style="list-style: inside;">
                                <a href="#">Fakultas Sains & Teknologi</a>
                            </li>
                            <li style="list-style: inside;">
                                <a href="#">Fakultas Ekonomi & Bisnis</a>
                            </li>
                            <li style="list-style: inside;">
                                <a href="#">Fakultas Hukum</a>
                            </li>
                            <li style="list-style: inside;">
                                <a href="#">Pascasarjana</a>
                            </li>
                        </ul>

                    </div>
                    <div class="formArea clearfix">
                        <div class="formTitle">
                            <h3>Pos-pos Terbaru</h3>
                        </div>
                        <ul>
                            @forelse($recentPosts as $post)
                                <li style="list-style: inside;">
                                    <a href="{{ route('frontend.showBerita', $post->slug) }}">
                                        {{ $post->judul }}
                                    </a>
                                    <br>
                                    <small>
                                        @if (!empty($post->tanggal) && strtotime($post->tanggal))
                                            {{ \Carbon\Carbon::parse($post->tanggal)->translatedFormat('d F Y') }}
                                        @else
                                            -
                                        @endif
                                    </small>
                                </li>
                            @empty
                                <li>Tidak ada data</li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="formArea clearfix">
                        <div class="formTitle">
                            <h3>Lembaga dan Unit Pelaksana Teknis</h3>
                        </div>
                        <ul>
                            <li style="list-style: inside;"><a href="#">LPPM</a></li>
                            <li style="list-style: inside;"><a href="#">UPT Perpustakaan</a></li>
                            <li style="list-style: inside;"><a href="#">UPT Bahasa</a></li>
                            <li style="list-style: inside;"><a href="#">UPT Teknologi Informasi</a></li>
                        </ul>
                    </div>

                    <div class="formArea clearfix">
                        <div class="formTitle">
                            <h3>Tautan Luar</h3>
                        </div>
                        <ul>
                            <li style="list-style: inside;"><a href="https://banpt.or.id" target="_blank">BAN-PT</a></li>
                            <li style="list-style: inside;"><a href="https://sinta.kemdikbud.go.id"
                                    target="_blank">SINTA</a></li>
                            <li style="list-style: inside;"><a href="https://dikti.kemdikbud.go.id"
                                    target="_blank">DIKTI</a></li>
                        </ul>
                    </div>
                    <div class="formArea clearfix">
                        <div class="formTitle">
                            <h3>Arsip</h3>
                        </div>

                        <ul class="list-unstyled">
                            @foreach ($arsip as $item)
                                <li>
                                    <a href="{{ url('arsip/' . $item->year . '/' . $item->month) }}">
                                        {{ \Carbon\Carbon::create($item->year, $item->month)->translatedFormat('F Y') }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div><!-- col-sm-4 col-xs-12 -->

            </div><!-- row clearfix -->
        </div><!-- container -->
    </div><!-- mainContent -->

    <div class="count clearfix wow fadeIn paralax" data-wow-delay="100ms"
        style="background-image: url({{ asset('frontend_asset/img/home/paralax/paralax03.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-sm-4">
                    <div class="text-center">
                        <div class="icon"><i class="fa fa-image"></i></div>
                        <div class="counter">
                            <span class="">{{ $jumlh_media }}</span>
                        </div>
                        <div class="seperator-small"></div>
                        <p>Media</p>
                    </div>
                </div><!-- col-sm-3 -->
                <div class="col-xs-6 col-sm-4">
                    <div class="text-center">
                        <div class="icon"><i class="fa fa-book"></i></div>
                        <div class="counter">
                            <span class="">{{ $dokumen }}</span>
                        </div>
                        <div class="seperator-small"></div>
                        <p>Dokumen</p>
                    </div>
                </div><!-- col-sm-3 -->
                <div class="col-xs-6 col-sm-4">
                    <div class="text-center">
                        <div class="icon"><i class="fa fa-handshake-o"></i></div>
                        <div class="counter">
                            <span class="">1047</span>
                        </div>
                        <div class="seperator-small"></div>
                        <p>Anggota PJM</p>
                    </div>
                </div><!-- col-sm-3 -->
            </div><!-- row -->
            {{-- <div class="paralax-text text-center">
        <h2>Do you like this template?</h2>
        <p>nec congue consequat risus, nec volutpat enim tempus id. Proin et sapien eget diam ullamcorper consectetur. Sed blandit imperdiet mauris. Mauris eleifend faucib</p>
        <p>ipsum quis varius. Quisque pharetra leo erat, non eleifend nibh interdum quis.</p>
        <a href="buying-steps.html" class="btn btn-default commonBtn">Buy now</a>
      </div><!-- row --> --}}
        </div><!-- container -->
    </div><!-- count -->

    <div class="testimonial-section clearfix">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="testimonial">
                        <div class="carousal_content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                laboris</p>
                        </div>
                        <div class="carousal_bottom">
                            <div class="thumb">
                                <img src="{{ asset('foto_anggota_divisi/prof-rachmad.jpg') }}" alt=""
                                    draggable="false" style="background-size: cover">
                            </div>
                            <div class="thumb_title">
                                <span class="author_name">Prof Dr Ir H Rachmat Hidayat, MT, IPU, ASEAN Eng </span>
                                <span class="author_designation"><a href="javascript:void(0);"> Rektor Uniba
                                        Madura</a></span>
                            </div>
                        </div>
                    </div><!-- testimonial -->
                </div><!-- col-xs-12 -->
                <div class="col-xs-12 col-sm-6">
                    <div class="features">
                        <h3>Kenapa Harus Uniba ?</h3>
                        <ul>
                            <li><i class="fa fa-check-circle-o"></i>Program Studi yang Tersedia: Pastikan universitas
                                tersebut menyediakan program studi atau jurusan yang sesuai dengan minat dan tujuan karier
                                Anda.</li>
                            <li><i class="fa fa-check-circle-o"></i>Fasilitas dan Sarana: Periksa fasilitas yang disediakan
                                oleh universitas, termasuk laboratorium, perpustakaan, pusat penelitian, dan lain-lain.
                                Infrastruktur yang baik dapat meningkatkan pengalaman belajar.</li>
                            <li><i class="fa fa-check-circle-o"></i>Lokasi Geografis: Pertimbangkan lokasi universitas,
                                apakah sesuai dengan preferensi Anda. Lokasi yang nyaman atau sesuai dengan minat Anda dapat
                                meningkatkan kualitas hidup selama masa studi.</li>
                            <li><i class="fa fa-check-circle-o"></i>Biaya dan Bantuan Keuangan: Evaluasi biaya studi dan
                                perbandingan dengan sumber-sumber bantuan keuangan yang mungkin tersedia, seperti beasiswa,
                                untuk memastikan kesesuaian dengan anggaran Anda.</li>
                            <li><i class="fa fa-check-circle-o"></i>Kultur Kampus: Pertimbangkan atmosfer dan budaya
                                kampus. Apakah Anda merasa nyaman di lingkungan tersebut? Kultur kampus dapat mempengaruhi
                                pengalaman sosial dan belajar Anda.</li>
                        </ul>
                    </div>
                </div><!-- col-xs-12 -->
            </div><!-- row -->
        </div><!-- container -->
    </div><!-- testimonial-section -->

    <div class="brandSection clearfix">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="owl-carousel partnersLogoSlider">
                        @forelse ($kerjasama as $k)
                            <div class="slide">
                                <div class="partnersLogo clearfix">
                                    <a href="#"><img src="{{ asset('gambar_kerjasama') }}/{{ $k->gambar }}"
                                            width="100" height="100" /></a>
                                </div>
                            </div>
                        @empty
                            <div class="slide">
                                <div class="partnersLogo clearfix">
                                    <a href="#"><img src="{{ asset('frontend_asset/img/home/brand5.png') }}" /></a>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Brand-section -->
@endsection
