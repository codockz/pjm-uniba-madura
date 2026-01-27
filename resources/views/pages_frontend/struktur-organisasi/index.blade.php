@extends('frontend_layouts.app')
@section('content')
@if (!empty($data))
<center><h1 style="margin-top: 25px;">Struktur Organisasi</h1></center>
@endif
<div class="mainContent clearfix">
    <div class="container">
      <div class="course-grid">
        <div class="about_inner clearfix">
          <div class="row">
                @php
                    $ketuaStruktur = $i->where('jabatan', 'Ketua Struktur Organisasi')->first();
                @endphp
                @php
                    $sekretaris = $j->where('jabatan', 'Sekretaris')->first();

                @endphp

                <div class="container">
                    <div class="row">
                        <div class="col-xs-6 text-center">
                            <center>@if($ketuaStruktur)<img src="{{ asset('foto_anggota_struktur_organisasi') }}/{{ $ketuaStruktur->foto }}" width="150" class="img-responsive" />@endif</center>
                            <h4>@if($ketuaStruktur){{ $ketuaStruktur->nama_anggota }}@endif</h4>
                            <p>@if($ketuaStruktur){{ $ketuaStruktur->jabatan }}@else @endif</p>
                        </div>

                        <div class="col-xs-6 text-center">
                            <center> @if($sekretaris)<img src="{{ asset('foto_anggota_struktur_organisasi') }}/{{ $sekretaris->foto }}" width="150" class="img-responsive" />@endif</center>
                            <h4>@if($sekretaris){{ $sekretaris->nama_anggota }}@endif</h4>
                            <p>@if($sekretaris){{ $sekretaris->jabatan }}@endif</p>
                        </div>
                    </div>
                </div>

          </div><!-- row -->
        </div>
      </div>
    </div>
</div>

@if (empty($data))
    <center><h1 style="padding: 100px;">Tidak Ada Data Anggota Struktur Organisasi</h1></center>
    @else
    <div class="mainContent">
        <div class="container">
            <div class="course-grid">
                <div class="about_inner clearfix">
                    <div class="row">
                        @php
                            $groupedData = [];

                            foreach ($data as $x) {
                                $groupedData[$x['nama_kategori']][] = $x;
                            }
                        @endphp

                        @foreach ($groupedData as $category => $categoryData)
                            <div class="col-xs-6 col-sm-2 text-center">
                                <div class="row">
                                    <div class="col">
                                        <h5>{{ $category }}</h5>
                                        @forelse ($categoryData as $x)
                                            <img src="{{ asset('foto_anggota_struktur_organisasi') }}/{{ $x['foto'] }}" width="100" />
                                            <p>
                                                <span>{{ $x['nama_anggota'] }}</span>
                                            </p>
                                            @empty
                                            <p>Tidak Ada Anggota</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div><!-- row -->
                </div>
            </div>
        </div>
    </div>
@endif



@endsection
