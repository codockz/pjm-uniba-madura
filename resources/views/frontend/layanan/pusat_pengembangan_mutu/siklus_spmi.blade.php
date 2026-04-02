@extends('frontend_layouts.app')

@section('content')
    <div class="container page-content">
        <h3 class="text-center fw-bold mb-4">
            Siklus Sistem Penjaminan Mutu Internal (SPMI)
        </h3>
        <hr class="mb-5">
        @if ($diagram)
            <div class="text-center mb-5">
                <img src="{{ asset('uploads/spmi/' . $diagram->gambar) }}" class="img-fluid rounded shadow-sm"
                    style="max-height:420px">
            </div>
        @endif
        <div class="mt-5">
            <div class="container mt-5">
                <h2 class="fw-bold text-center mb-4">
                    Tahapan Siklus SPMI
                </h2>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <ol class="fs-5">
                            @foreach ($tahapan as $item)
                                <li class="mb-4">
                                    <strong class="fs-4">{{ $item->nama_tahap }}</strong>
                                    <p class="text-muted mt-2">
                                        {{ $item->deskripsi }}
                                    </p>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-5"></div>
    </div>
@endsection
