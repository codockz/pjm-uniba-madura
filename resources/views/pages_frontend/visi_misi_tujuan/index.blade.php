@extends('frontend_layouts.app')
@section('content')

<div class="single_banner_inner" style="margin-bottom: 20px;">
    <img @if(!empty($setting)) src="{{ asset('file_gambar_halaman_lain') }}/{{ $setting->gambar }}" @else src="https://dummyimage.com/hd1080" @endif  alt="visi">
    <div class="single_caption">
        <h1 style="font-size: 24px;">@if(!empty($setting)) {{ $setting->judul }}  @else Title @endif</h1>
        <p style="color: white;">@if(!empty($setting)) {{ $setting->isi }}  @else Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi quos, nulla ab sed laudantium et. @endif</p>
    </div><!--end single caption-->
</div>

<div class="col-xs-12 col-sm-12" style="margin-bottom: 50px;">
    <div class="content_left features">
        @foreach (['visi', 'misi', 'tujuan'] as $type)
        <h1 style="margin-bottom: 20px;">{{ ucfirst($type) }}</h1>
        <ul>
            @forelse ($$type as $item)
                <li>{{ $loop->iteration }}. {{ $item->isi }}</li>
            @empty
                <li>Tidak ada data {{ ucfirst($type) }}</li>
            @endforelse
        </ul>
    @endforeach
    </div><!--end content left-->
</div>

@endsection
