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

<div class="mainContent clearfix">
    <div class="container">
        <div class="upcoming_events event-col">
            <div class="row clearfix">
            @forelse ($pengumuman as $m)
                <div class="col-xs-6 col-sm-4">
                    <div class="related_post_sec single_post">
                    <span class="date-wrapper">
                        <span class="date"><span>{{  date('d', strtotime($m->tanggal)) }}</span>  {{ $monthNames[\Carbon\Carbon::parse($m->tanggal)->format('F')] }}</span>
                    </span>
                    <div class="rel_right">
                        <h4><a href="{{ route('frontend.showPengumuman', $m->slug) }}">{{ $m->judul }}</a></h4>
                        <div class="meta">
                            <span class="place"><i class="fa fa-map-marker"></i>{{ $m->lokasi }}</span>
                            <span class="event-time"><i class="fa fa-clock-o"></i>{{ \Carbon\Carbon::parse($m->jam)->format('H:i') }}</span>
                        </div>
                        <p>{{ Str::limit($m->isi, 250) }}</p>
                        <a href="{{ route('frontend.showPengumuman',$m->slug) }}" class="btn btn-default commonBtn">view Detals</a>
                    </div>
                    </div>
                </div>
                @empty
                <center><h1 style="padding:50px; ">Tidak Ada Pengumuman</h1></center>
             @endforelse
        </div><!-- row clearfix -->
      </div>

    </div><!-- container -->
  </div><!-- mainContent -->
@endsection
