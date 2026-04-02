@extends('frontend_layouts.app')
@section('content')

<div class="col-xs-12 col-sm-12" style="margin-bottom: 50px;">
    <div class="content_left features">
        @php
           $divisiGrouped = $data->groupBy('kategori_divisi_id');
       @endphp
        @if ($divisiGrouped->isEmpty())
        @else
        <center><h1 style="margin-bottom: 20px;">Divisi Monitoring Dan Evaluasi</h1></center>
        @endif
        <div class="row">

        </div>


        @forelse ($divisiGrouped as $categoryId => $items)
        {{-- <h4 style="margin-left: 20px;">{{ $items->first()->nama_kategori }}</h4> --}}
        <ul>
            @php
                $no = 1;
            @endphp
            @foreach ($items as $item)
                @if($item->isi != '')
                 <li>{{ $no++ }}. {{ $item->isi }}</li>
                @endif
            @endforeach
        </ul>
        @empty
        <center><h1 style="padding: 100px;">Tidak Ada Data Monitoring Dan Evaluasi</h1></center>
    @endforelse

    @php
    $anggota = $data->groupBy('anggota_divisi_id');
    @endphp

    @foreach ($data as $petugas )
    <div class="col-md-3" style="margin-top: 50px;">
        <center><div class="img-anggota">
            <img src="{{ asset('foto_anggota_divisi') }}/{{ $petugas->foto }}" width="100" class="img-rounded-anggota">
            <br>
            <strong><small class="img-rounded-anggota"  style="border-bottom:  1px solid black;">{{ $petugas->nama_anggota_personalia }}</small></strong>
            <br>
            <p>
                <span>{{ $petugas->nama_anggota }}</span>
            </p>
        </div></center>
    </div>
    @endforeach
        </div><!--end content left-->
    </div>


@endsection
