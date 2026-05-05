@extends('frontend_layouts.app')
@section('content')

<div class="single_banner_inner" style="margin-bottom: 20px;">
    <img @if(!empty($profil)) src="{{ asset('file_gambar_halaman_lain') }}/{{ $profil->gambar }}" @else src="https://dummyimage.com/hd1080" @endif  alt="visi">
    <div class="single_caption">
        <h1 style="font-size: 24px;">@if(!empty($profil)) {{ $profil->judul }}  @else Title @endif</h1>
        <p style="color: white;">@if(!empty($profil)) {{ $profil->isi }}  @else Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi quos, nulla ab sed laudantium et. @endif</p>
    </div><!--end single caption-->
</div>

<div class="col-xs-12 col-sm-12" style="margin-bottom: 50px;">
    <div class="content_left features">
        @if($data->isEmpty())
        @else
        <h1 style="margin-bottom: 20px;">Profil</h1>
        @endif
        <ul>
            @forelse ($data as $item)
            <li><i class="fa fa-check-circle-o"></i>{{ $item->profile }}</li>
            @empty
            <center><h1 style="padding: 100px;">Tidak Ada Data profil</h1></center>
            @endforelse
        </ul>
    </div><!--end content left-->
</div>

@endsection
