@extends('frontend_layouts.app')

@section('content')
    <div class="container page-content">

        {{-- ===================== --}}
        {{-- 🔹 JUDUL --}}
        {{-- ===================== --}}
        <h3 class="text-center fw-bold mb-3">
            Siklus Sistem Penjaminan Mutu Internal (SPMI)
        </h3>

        <hr class="my-5">

        {{-- ===================== --}}
        {{-- 🔹 GAMBAR --}}
        {{-- ===================== --}}
        @if ($diagram)
            <div class="text-center mb-5">
                <img src="{{ asset('uploads/spmi/' . $diagram->gambar) }}" class="img-fluid rounded shadow-sm"
                    style="max-height:420px">
            </div>
        @endif

        {{-- ===================== --}}
        {{-- 🔹 DESKRIPSI --}}
        {{-- ===================== --}}
        <div class="mt-4">

            <h2 class="fw-bold text-center mb-4">
                Tahapan Siklus SPMI
            </h2>

            <div class="row justify-content-center">
                <div class="col-md-7">

                    <ol style="font-size:17px; line-height:1.7; padding-left:20px;">
                        @foreach ($tahapan as $item)
                            <li class="mb-3">

                                <strong style="font-size:18px;">
                                    {{ $item->nama_tahap }}
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
