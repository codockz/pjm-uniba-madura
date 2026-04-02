@extends('frontend_layouts.app')
@section('content')
<div class="custom_content clearfix">
    <div class="container">
        <div class="photo_gallery custom">
            <ul class="gallery popup-gallery gallery-3col">
                @forelse ($foto as $f)
                <li>
                    <a href="{{ asset('gambar_media') }}/{{ $f->gambar }}" title="Photo 1">
                        <img src="{{ asset('gambar_media') }}/{{ $f->gambar }}" alt="Foto"/>
                        <div class="overlay">
                            <span class="zoom">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </a>
                </li>
                @empty
                <center><h1 style="padding: 70px;">Tidak Ada Foto</h1></center>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
