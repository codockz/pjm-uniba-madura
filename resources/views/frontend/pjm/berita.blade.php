@extends('frontend_layouts.app')

@section('content')

@php
$monthNames = [
    'January'   => 'Januari',
    'February'  => 'Februari',
    'March'     => 'Maret',
    'April'     => 'April',
    'May'       => 'Mei',
    'June'      => 'Juni',
    'July'      => 'Juli',
    'August'    => 'Agustus',
    'September' => 'September',
    'October'   => 'Oktober',
    'November'  => 'November',
    'December'  => 'Desember',
];
@endphp

<div class="post_section">
    <div class="container">
        <div class="row">

            {{-- ================= DETAIL BERITA ================= --}}
            <div class="col-xs-12 col-sm-8 post_left">
                <div class="post_left_section post_left_border">
                    <div class="post single_post">

                        <div class="post_thumb">
                            <img src="{{ asset('gambar_media') }}/{{ $berita->gambar }}" alt="Berita PJM Uniba" />
                        </div>

                        <div class="meta">
                            <span class="author">
                                By: <a href="#">{{ $berita->name }}</a>
                            </span>

                            <span class="date">
                                Posted:
                                <a href="#">
                                    {{ date('d', strtotime($berita->tanggal)) }}
                                    {{ $monthNames[\Carbon\Carbon::parse($berita->tanggal)->format('F')] }}
                                    {{ date('Y', strtotime($berita->tanggal)) }}
                                </a>
                            </span>
                        </div>

                        <h1>{{ $berita->judul }}</h1>

                        <div class="post_desc">
                            <p>{{ $berita->isi }}</p>
                        </div>

                    </div>
                </div>
            </div>

            {{-- ================= SIDEBAR ================= --}}
            <div class="col-xs-12 col-sm-4 post_right">
                <div class="related_post_sec">

                    {{-- ===== LIST BERITA ===== --}}
                    <div class="list_block">
                        <h3>Berita</h3>
                        <ul>
                            @forelse ($semua_berita as $item)
                            <li>
                                <span class="rel_thumb">
                                    <img src="{{ asset('gambar_media') }}/{{ $item->gambar }}" alt="Berita Uniba" />
                                </span>

                                <div class="rel_right">
                                    <a href="{{ route('frontend.showBerita',$item->slug) }}">
                                        <h4>{{ $item->judul }}</h4>
                                    </a>

                                    <span class="date">
                                        Posted:
                                        <a href="{{ route('frontend.showBerita',$item->slug) }}">
                                            {{ date('d', strtotime($item->tanggal)) }},
                                            {{ $monthNames[\Carbon\Carbon::parse($item->tanggal)->format('F')] }}
                                            {{ date('Y', strtotime($item->tanggal)) }}
                                        </a>
                                    </span>
                                </div>
                            </li>
                            @empty
                                <center><strong>Tidak Ada Berita</strong></center>
                            @endforelse
                        </ul>

                        @if(!$semua_berita->isEmpty())
                            <a href="#" class="more_post">Tampilkan Lebih banyak</a>
                        @endif
                    </div>

                    {{-- ===== PENGUMUMAN ===== --}}
                    <div class="list_block">
                        <div class="upcoming_events">
                            <h3>Pengumuman</h3>
                            <ul>
                                @forelse ($pengumuman as $m)
                                <li class="related_post_sec single_post">

                                    <span class="date-wrapper">
                                        <span class="date">
                                            <span>
                                                {{ date('d', strtotime($m->tanggal)) }}
                                            </span>
                                            {{ date('d F Y', strtotime($m->tanggal)) }}
                                        </span>
                                    </span>

                                    <div class="rel_right">
                                        <h4>
                                            <a href="{{ url('your-route', $m->id) }}">
                                                {{ $m->judul }}
                                            </a>
                                        </h4>

                                        <div class="meta">
                                            <span class="place">
                                                <i class="fa fa-map-marker"></i>{{ $m->lokasi }}
                                            </span>

                                            <span class="event-time">
                                                <i class="fa fa-clock-o"></i>
                                                {{ \Carbon\Carbon::parse($m->jam)->format('H:i') }}
                                            </span>
                                        </div>
                                    </div>

                                </li>
                                @empty
                                    <center><strong>Tidak Ada Pengumuman</strong></center>
                                @endforelse
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
