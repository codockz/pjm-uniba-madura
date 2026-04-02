@extends('frontend_layouts.app')

@section('content')
    <div class="container py-5">

        <h3 class="text-center fw-bold mb-4">
            Statuta & Ortaker
        </h3>

        {{-- 🔼 GAMBAR --}}
        @if ($image && $image->gambar)
            <div class="text-center mb-4">
                <img src="{{ asset('uploads/statuta/' . $image->gambar) }}" class="img-fluid" style="max-height:300px;">
            </div>
        @endif

        {{-- 🔽 LIST --}}
        <ol class="ps-3">
            @forelse ($data as $item)
                <li class="mb-3">
                    {{ $item->judul }}

                    <a href="{{ asset('uploads/statuta/' . $item->file) }}" target="_blank" class="fw-bold text-primary">
                        (Download)
                    </a>
                </li>
            @empty
                <li>Data belum tersedia</li>
            @endforelse
        </ol>

    </div>
@endsection
