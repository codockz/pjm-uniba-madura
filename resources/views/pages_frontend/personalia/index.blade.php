@extends('frontend_layouts.app')
@section('content')

{{-- <div class="single_banner_inner" style="margin-bottom: 20px;">
    <img src="{{ asset('frontend_asset/img/home/slider/lab.jpg') }}" alt="">
    <div class="single_caption">
        <h1 style="font-size: 24px;">Profil Pusat Jaminan Mutu Uniba Madura :</h1>
        <p style="color: white;">Landasan keunggulan dalam menjaga dan meningkatkan kualitas layanan serta pendidikan. Dedikasi untuk pelayanan akademis, dan peran sebagai terhadap lingkungan universitas kami.</p>
    </div><!--end single caption-->
</div> --}}

<div class="container">
    <div class="row">
        @foreach ($petugas_personalia as $foto)
        <div class="col-md-4">
            <img src="{{ asset('foto') }}" alt="" class="img-circles">
        </div>
        @endforeach
    </div>
</div>
@php
$personaliaGrouped = $personalia->groupBy('kategori_personalia_id');
@endphp

<div class="col-xs-12 col-sm-12" style="margin-bottom: 50px;">
    <div class="content_left features">
        @if($personaliaGrouped->isEmpty())
        <center><h1 style="padding: 120px;">Tidak Ada data Personalia</h1></center>
        @else
        <h1 style="margin-bottom: 20px;">Personalia</h1>
            @if($petugas_personalia->isEmpty())
            @else
            <center><h2 style="margin-bottom: 20px;">Anggota Personalia</h2></center>
            @endif
        @endif
        <div class="row">
        @foreach ($petugas_personalia as $petugas )
            <div class="col-md-4">
                <center><div class="img-anggota">
                    <img src="{{ asset('foto_petugas_personalia') }}/{{ $petugas->foto }}" width="100" class="img-rounded-anggota">
                    <br>
                    <strong><small class="img-rounded-anggota"  style="border-bottom:  1px solid black;">{{ $petugas->nama_anggota_personalia }}</small></strong>
                    <br>
                    <small class="img-rounded-anggota">{{ $petugas->pangkat }}</small>
                    <br>
                    <small class="img-rounded-anggota">{{ $petugas->jurusan }}</small>
                    <br>
                    <small class="img-rounded-anggota">{{ $petugas->email }}</small>
                </div></center>
            </div>
            @endforeach
        </div>



    @foreach ($personaliaGrouped as $categoryId => $items)
        <h4 style="margin-left: 20px;">{{ $items->first()->nama_kategori }}</h4>
        <ul>
            @forelse ($items as $item)
                <li>{{ $loop->iteration }}. {{ $item->personalia }}</li>
            @empty
                <li>Tidak Ada data Personalia</li>
            @endforelse
        </ul>
    @endforeach

    </div><!--end content left-->
</div>

@endsection
