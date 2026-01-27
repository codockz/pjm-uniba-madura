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
<div class="row clearfix">

          <div class="col-xs-12 col-sm-8 post_left">

    <div class="upcoming_events event-col">
      <div class="related_post_sec single_post">
        <span class="date-wrapper">
          <span class="date"><span>{{  date('d', strtotime($pengumuman->tanggal)) }}</span> {{ $monthNames[\Carbon\Carbon::parse($pengumuman->tanggal)->format('F')] }}</span>
        </span>
        <div class="rel_right">
          <div class="single_post single-event">
            <h1>{{ $pengumuman->judul }}</h1>
            <div class="meta">
              <span class="place"><i class="fa fa-map-marker"></i>{{ $pengumuman->lokasi }}</span>
              <span class="event-time"><i class="fa fa-clock-o"></i>Jam {{ \Carbon\Carbon::parse($pengumuman->jam)->format('H:i') }}</span>
            </div>
            <div class="post_desc">
              <p>{{ $pengumuman->isi }}</p>
            </div><!--end post desc-->
          </div><!--end single_post-->
        </div>
      </div>
    </div>
  </div><!--end post_left-->

  <div class="col-xs-12 col-sm-4 post_right">
    <div class="list_block related_post_sec">
        <div class="upcoming_events">
          <h3>Pengumuman</h3>
          <ul>
            @forelse ($semua_pengumuman as $m)
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
          {{-- <a href="events-3col.html" class="btn btn-default btn-block commonBtn">Tampilkan Lebih Banyak</a> --}}
        </div>
      </div><!-- end list_block -->
    <div class="post_right_inner">
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
      <div class="related_post_sec">
        <div class="list_block">
          <h3>Agenda</h3>
          <ul>
            @forelse ($agenda as $a )
            <li>
                <span class="rel_thumb">
                    <img src="{{ asset('gambar_media') }}/{{ $a->gambar }}" alt="Agenda Uniba" />
                </span><!--end rel_thumb-->
                <div class="rel_right">
                    <h4><a href="{{ route('frontend.showAgenda',$a->slug) }}">{{ $a->judul }}</a></h4>
                    <span class="date">on: <a href="{{ route('frontend.showAgenda',$a->slug) }}">{{  date('d', strtotime($a->tanggal)) }}, {{ $monthNames[\Carbon\Carbon::parse($a->tanggal)->format('F')] }} {{ date('Y', strtotime($a->tanggal)) }}</a></span>
                </div><!--end rel right-->
            </li>
            @empty
                <center><strong>Tidak Ada Berita</strong></center>
            @endforelse
        </ul>
        @if($berita->isEmpty())

        @else
         <a href="{{ route('frontend.agenda') }}" class="more_post">Tampilkan Lebih Banyak</a>
        @endif
        </div>
      </div><!--end related_post_sec-->
    </div><!--end post right inner-->
  </div><!--end post_right-->
        </div><!--row-->
    </div>
</div><!--end post section-->
@endsection
