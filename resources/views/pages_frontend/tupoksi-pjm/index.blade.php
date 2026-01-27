@extends('frontend_layouts.app')
@section('content')

<div class="single_banner_inner" style="margin-bottom: 20px;">
    <img src="{{ asset('frontend_asset/img/home/slider/lab.jpg') }}" alt="">
    <div class="single_caption">
        <h1 style="font-size: 24px;">Profil Pusat Jaminan Mutu Uniba Madura :</h1>
        <p style="color: white;">Landasan keunggulan dalam menjaga dan meningkatkan kualitas layanan serta pendidikan. Dedikasi untuk pelayanan akademis, dan peran sebagai terhadap lingkungan universitas kami.</p>
    </div><!--end single caption-->
</div>

<div class="col-xs-12 col-sm-12" style="margin-bottom: 50px;">
    <div class="content_left features">
        @php
           $tupoksi = $data->groupBy('kategori_tupoksi_id');
       @endphp
        @if($tupoksi->isEmpty())
        @else
        <h1 style="margin-bottom: 20px;">Tupoksi Pusat Jaminan Mutu Uniba Madura</h1>
        @endif


@forelse ($tupoksi as $categoryId => $items)
    <h4 style="margin-left: 20px; margin-top:20px; margin-bottom:20px;">{{ $items->first()->nama_kategori }}</h4>
    <ul>
        @php
            $no = 1;
        @endphp
        @foreach ($items as $item)
            <li>{{ $no++ }}. {{ $item->isi_tupoksi }}</li>
        @endforeach
    </ul>
    @empty
    <center><h1 style="padding: 100px;">Tidak Ada data Tupoksi PJM</h1></center>
@endforelse
    </div><!--end content left-->
</div>

@endsection
