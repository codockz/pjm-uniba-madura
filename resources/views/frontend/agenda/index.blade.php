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
        <div class="course-grid course-3col">
            <div class="about_inner clearfix">

            @if($agenda->count() > 0)

                <div class="row">
                    @foreach ($agenda as $as)
                    <div class="col-xs-6 col-sm-4">
                        <div class="aboutImage">
                            <a href="{{ route('frontend.showAgenda', $as->slug) }}">
                                <img src="{{ asset('gambar_media') }}/{{ $as->gambar }}" class="img-responsive" />

                                <div class="overlay">
                                    <p>{{ Str::limit($as->isi, 250) }}</p>
                                </div>

                                <span class="captionLink">Selengkapnya</span>
                            </a>
                        </div>

                        <h3>
                            <a href="{{ route('frontend.showAgenda', $as->slug) }}">
                                {{ $as->judul }}
                            </a>
                        </h3>
                    </div>
                    @endforeach
                </div>

            @else

                <div class="empty-pengumuman">
                    <h1>Tidak Ada Agenda</h1>
                    
                </div>

            @endif

            </div>
        </div>
    </div>
</div>
@endsection
