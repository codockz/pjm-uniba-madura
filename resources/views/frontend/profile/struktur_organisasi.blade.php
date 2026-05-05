@extends('frontend_layouts.app')

@section('content')
    <div class="container page-content">


        {{-- 🔹 JUDUL --}}
        {{-- ===================== --}}
        <h3 class="text-center fw-bold mb-4">
            Struktur Organisasi
        </h3>

        <hr class="mb-5">


        {{-- 🔹 GAMBAR --}}
        {{-- ===================== --}}
        @if ($gambar && $gambar->gambar)
            <div class="text-center mb-5">
                <img src="{{ asset('uploads/struktur/' . $gambar->gambar) }}" class="img-fluid rounded shadow-sm"
                    style="max-height:420px">
            </div>
        @endif


        <div class="mt-4">

    <h2 class="fw-bold text-center mb-4">
        Penjelasan Struktur Organisasi
    </h2>

    <div class="row justify-content-center">
        <div class="col-md-7">

            <ol style="font-size:17px; line-height:1.7; padding-left:20px;">
                @foreach ($data as $item)
                    <li class="mb-3">

                        <strong style="font-size:18px;">
                            {{ $item->judul }}
                        </strong>

                        <div style="color:#444; margin-top:5px;">
                            {{ $item->deskripsi }}
                        </div>

                    </li>
                @endforeach
            </ol>

        </div>
    </div>

</div>

    <div class="mb-5"></div>

    </div>
@endsection
