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

<div class="post_section clearfix">
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-sm-8 post_left">
                <div class="post_left_section post_left_border">
                    <div class="post">
                        <div class="post_thumb">
                            <img src="{{ asset('gambar_media') }}/{{ $agenda->gambar }}" alt="Gambar Agenda" />
                        </div><!--end post thumb-->
                        <div class="meta">
                            <span class="author">By: <a href="single-post-right-sidebar.html">{{ $agenda->name }}</a></span>
                            <span class="date">Posted: <a href="single-post-right-sidebar.html">{{  date('d', strtotime($agenda->tanggal)) }}, {{ $monthNames[\Carbon\Carbon::parse($agenda->tanggal)->format('F')] }} {{ date('Y', strtotime($agenda->tanggal)) }}</a></span>
                        </div><!--end meta-->
                        <h1><a href="single-post-right-sidebar.html">{{ $agenda->judul }}</a></h1>
                        <div class="post_desc">
                            <p>{{ $agenda->isi }}</p>
                        </div><!--end post desc-->
                    </div><!--end post-->
                </div><!--end post left section-->
            </div><!--end post_left-->

            <div class="col-xs-12 col-sm-4 post_right">
                <div class="post_right_inner">
                    <div class="post_right_inner">

                        <div class="related_post_sec">
                            <div class="list_block">
                                <h3>Agenda</h3>
                                <ul>
                                    @forelse ($semua_agenda as $b)
                                    <li>
                                        <span class="rel_thumb">
                                            <img src="{{ asset('gambar_media') }}/{{ $b->gambar }}" alt="">
                                        </span><!--end rel_thumb-->
                                        <div class="rel_right">
                                            <a href="{{ route('frontend.showAgenda',$b->slug) }}"><h4>{{ $b->judul }}</h4></a>
                                            <span class="date">Posted: <a href="{{ route('frontend.showAgenda',$b->slug) }}">{{  date('d', strtotime($b->tanggal)) }}, {{ $monthNames[\Carbon\Carbon::parse($b->tanggal)->format('F')] }} {{ date('Y', strtotime($b->tanggal)) }}</a></span>
                                        </div><!--end rel right-->
                                    </li>
                                    @empty
                                    <center><strong>Tidak Ada Pengumuman</strong></center>
                                    @endforelse
                            </ul>
                            @if($semua_agenda->isEmpty())
                            @else
                            <a href="{{ route('frontend.agenda') }}" class="more_post">Tampilkan Lebih Banyak</a>
                            @endif
                            </div>
                        </div><!--end related_post_sec-->
                    </div>

                    <div class="related_post_sec">
                        <div class="list_block">
                          <h3>Berita</h3>
                          <ul>
                            @forelse ($berita as $b )
                            <li>
                                <span class="rel_thumb">
                                    <img src="{{ asset('gambar_media') }}/{{ $b->gambar }}" alt="Berita Uniba" />
                                </span><!--end rel_thumb-->
                                <div class="rel_right">
                                    <h4><a href="{{ route('frontend.showBerita',$b->slug) }}">{{ $b->judul }}</a></h4>
                                    <span class="date">on: <a href="{{ route('frontend.showBerita',$b->slug) }}">{{  date('d', strtotime($b->tanggal)) }}, {{ $monthNames[\Carbon\Carbon::parse($b->tanggal)->format('F')] }} {{ date('Y', strtotime($b->tanggal)) }}</a></span>
                                </div><!--end rel right-->
                            </li>
                            @empty
                                <center><strong>Tidak Ada Berita</strong></center>
                            @endforelse
                        </ul>
                        @if($berita->isEmpty())

                        @else
                         <a href="{{ route('frontend.berita') }}" class="more_post">Tampilkan Lebih Banyak</a>
                        @endif
                        </div>
                      </div><!--end related_post_sec-->

                    <div class="list_block related_post_sec">
                        <div class="upcoming_events">
                          <h3>Pengumuman</h3>
                          <ul>
                            @forelse ($pengumuman as $m)
                                <li class="related_post_sec single_post">
                                    <span class="date-wrapper">
                                        {{-- Check if $m->tanggal is not null and is a Carbon instance --}}
                                        <span class="date">
                                            <span>
                                            {{  date('d', strtotime($m->tanggal)) }}
                                            </span>
                                            {{ $monthNames[\Carbon\Carbon::parse($m->tanggal)->format('F')] }}
                                        </span>
                                    </span>
                                    <div class="rel_right">
                                        <h4><a href="{{ route('frontend.showPengumuman', $m->slug) }}">{{ $m->judul }}</a></h4>
                                        <div class="meta">
                                            <span class="place"><i class="fa fa-map-marker"></i>{{ $m->lokasi }}</span>
                                            <span class="event-time"><i class="fa fa-clock-o"></i>{{ \Carbon\Carbon::parse($m->jam)->format('H:i') }}</span>
                                        </div>
                                    </div>
                                </li>
                                @empty
                                <center><strong>Tidak Ada Pengumuman</strong></center>
                            @endforelse
                          </ul>
                          @if($pengumuman->isEmpty())
                          @else
                          <a href="{{ route('frontend.pengumuman') }}" class="btn btn-default btn-block commonBtn">Tampilkan lebih Banyak</a>
                          @endif
                        </div>
                      </div>

                </div><!--end post right inner-->
            </div><!--end post_right-->

        </div>
    </div>
</div><!--end post section-->
@endsection
