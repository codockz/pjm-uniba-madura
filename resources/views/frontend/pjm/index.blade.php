@extends('frontend_layouts.app')
@section('content')
@include('frontend.components.slider')
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
                    <div class="">
                        <div class="">
                            {{-- <h3>Selamat datang di Pusat Jaminan Mutu Uniba Madura</h3> --}}
                            <div class="row">
                                @if (!empty($about))
                                @else
                                @endif
                            </div><!-- row -->
                        </div><!-- videoArea -->
                        <div class="related_post_sec single_post">
                            @if (isset($month))
                                <h4 style="margin-top:20px;">
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
                        <div class="text-center" style="margin-top:20px; margin-bottom:10px;">
                            @if ($berita->lastPage() > 1)
                                <ul
                                    style="display:inline-flex; flex-direction:row; flex-wrap:wrap; gap:6px; list-style:none; padding:0; margin:0;">

                                    {{-- Tombol Prev --}}
                                    <li>
                                        @if ($berita->onFirstPage())
                                            <span
                                                style="display:inline-block; padding:6px 12px; border:1px solid #ddd; border-radius:4px; color:#aaa; cursor:not-allowed;">&laquo;</span>
                                        @else
                                            <a href="{{ $berita->previousPageUrl() }}"
                                                style="display:inline-block; padding:6px 12px; border:1px solid #ddd; border-radius:4px; color:#8B6914; text-decoration:none;">&laquo;</a>
                                        @endif
                                    </li>

                                    {{-- Nomor Halaman --}}
                                    @for ($i = 1; $i <= $berita->lastPage(); $i++)
                                        <li>
                                            @if ($i == $berita->currentPage())
                                                <span
                                                    style="display:inline-block; padding:6px 12px; border:1px solid #8B6914; border-radius:4px; background:#8B6914; color:#fff; font-weight:bold;">{{ $i }}</span>
                                            @else
                                                <a href="{{ $berita->url($i) }}"
                                                    style="display:inline-block; padding:6px 12px; border:1px solid #ddd; border-radius:4px; color:#8B6914; text-decoration:none;">{{ $i }}</a>
                                            @endif
                                        </li>
                                    @endfor

                                    {{-- Tombol Next --}}
                                    <li>
                                        @if ($berita->hasMorePages())
                                            <a href="{{ $berita->nextPageUrl() }}"
                                                style="display:inline-block; padding:6px 12px; border:1px solid #ddd; border-radius:4px; color:#8B6914; text-decoration:none;">&raquo;</a>
                                        @else
                                            <span
                                                style="display:inline-block; padding:6px 12px; border:1px solid #ddd; border-radius:4px; color:#aaa; cursor:not-allowed;">&raquo;</span>
                                        @endif
                                    </li>

                                </ul>
                            @endif
                        </div>
                    </div><!--videoNine-->
                </div><!-- col-sm-8 col-xs-12 -->

                <div class="col-sm-4 col-xs-12">
                    {{-- 🔥 SIDEBAR DINAMIS --}}
                    @foreach ($sidebar as $category)
                        <div class="formArea clearfix">
                            <div class="formTitle">
                                <h3>{{ $category->nama_kategori }}</h3>
                            </div>

                            <ul>
                                @forelse ($category->items as $item)
                                    <li style="list-style: inside;">
                                        @if ($item->link)
                                            <a href="{{ $item->link }}" target="_blank">
                                                {{ $item->judul }}
                                            </a>
                                        @else
                                            {{ $item->judul }}
                                        @endif
                                    </li>
                                @empty
                                    <li>Tidak ada data</li>
                                @endforelse
                            </ul>
                        </div>
                    @endforeach
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
                            <h3>INFO TERBARU</h3>
                        </div>

                        <div class="info-terbaru">
                            @forelse($recentPosts as $post)
                                <a href="{{ route('frontend.showBerita', $post->slug) }}" class="info-card">

                                    <div class="info-text">
                                        <div class="info-title">
                                            {{ $post->judul }}
                                        </div>

                                        <div class="info-date">
                                            @if (!empty($post->tanggal) && strtotime($post->tanggal))
                                                {{ \Carbon\Carbon::parse($post->tanggal)->translatedFormat('d F Y') }}
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>

                                    <div class="info-arrow">
                                        ➜
                                    </div>

                                </a>

                            @empty
                                <div class="text-muted">Tidak ada data</div>
                            @endforelse
                        </div>
                    </div>
                    <div class="formArea clearfix">
                        <div class="formTitle">
                            <h3>Arsip</h3>
                        </div>

                        <ul class="list-unstyled arsip-scroll">
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
