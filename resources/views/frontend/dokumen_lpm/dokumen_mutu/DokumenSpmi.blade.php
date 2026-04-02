@extends('frontend_layouts.app')

@section('content')
    <div class="container py-5" style="max-width: 900px;">

        {{-- JUDUL --}}
        <h2 class="text-center fw-bold mb-4" style="margin-top: 20px;">
            Dokumen SPMI
        </h2>

        @if ($data->count() > 0)
            <div class="row justify-content-center">

                @foreach ($data as $item)
                    <div class="col-md-4 col-sm-6 mb-4">

                        <div class="text-center mx-auto" style="max-width: 300px;">

                            {{-- GAMBAR --}}
                            <a href="{{ $item->link }}" target="_blank">
                                <img src="{{ asset('storage/' . $item->gambar) }}" class="img-fluid shadow-sm img-hover"
                                    style="border-radius: 8px;">
                            </a>

                            {{-- JUDUL --}}
                            <p class="mt-2 fw-semibold mb-1">
                                {{ $item->judul }}
                            </p>

                            {{-- DESKRIPSI --}}
                            <p class="text-muted small" style="line-height: 1.5;">
                                {{ $item->deskripsi }}
                            </p>

                        </div>

                    </div>
                @endforeach

            </div>
        @else
            <div class="alert alert-info text-center mt-4">
                Data belum tersedia.
            </div>
        @endif

    </div>
@endsection
