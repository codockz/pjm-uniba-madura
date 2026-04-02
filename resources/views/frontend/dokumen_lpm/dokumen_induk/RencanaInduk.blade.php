@extends('frontend_layouts.app')


@section('content')

<div class="container py-5" style="max-width: 800px;">

    {{-- JUDUL --}}
    <h2 class="text-center fw-bold mb-4" style="margin-top: 20px;">
        Rencana Induk Pengembangan
    </h2>

    @if($data)

        {{-- GAMBAR --}}
        <div class="text-center mt-4 mb-4">
            <img src="{{ asset('storage/'.$data->gambar) }}"
                 class="img-fluid shadow-sm"
                 style="max-width: 350px; border-radius: 6px;">
        </div>

        {{-- DESKRIPSI --}}
        <p class="text-center text-muted mt-3" style="line-height: 1.6;">
            Untuk mengunduh dokumen
            <strong>{{ $data->judul }}</strong>
            tahun <strong>{{ $data->tahun }}</strong>,
            silahkan klik tombol di bawah ini.
        </p>

        {{-- BUTTON --}}
        <div class="text-center mt-4">
            <a href="{{ asset('storage/'.$data->file) }}"
               target="_blank"
               class="btn btn-primary px-4 py-2">
               📄 Download Dokumen
            </a>
        </div>

    @else

        <div class="alert alert-info text-center mt-4">
            Data belum tersedia.
        </div>

    @endif

</div>

@endsection
