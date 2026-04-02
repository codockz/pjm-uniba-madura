@extends('frontend_layouts.app')

@section('content')
<center>
    <h1 style="margin-top: 25px;">Struktur Organisasi</h1>
</center>

<div class="mainContent clearfix">
    <div class="container">
        <div class="course-grid">
            <div class="about_inner clearfix">

                {{-- GAMBAR STRUKTUR ORGANISASI --}}
                <div class="text-center" style="margin-bottom: 30px;">
                    <img src="{{ asset('storage/struktur/struktur.png') }}"
                         class="img-responsive center-block"
                         alt="Struktur Organisasi"
                         onerror="this.style.display='none'">
                </div>

                <div class="row">
                    {{-- kalau nanti mau isi anggota, taruh di sini --}}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
