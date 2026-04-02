@extends('frontend_layouts.app')

@section('content')

<div class="container page-content">

    <h3 class="mb-4 text-center">
        Komite Penjaminan Mutu (KPM) dan Gugus Penjaminan Mutu (GPM)
    </h3>

    @if ($data->count() > 0)

        @foreach ($data as $item)

            <h5 class="mt-4 text-center">
                {{ $item->judul ?? 'Dokumen KPM GPM' }}
            </h5>

            @php
                // 🔥 path fleksibel (biar gak double / error)
                $filePath = $item->file;

                // kalau belum ada "kpm_gpm/" di DB, tambahkan
                if ($filePath && !str_contains($filePath, 'kpm_gpm/')) {
                    $filePath = 'kpm_gpm/' . $filePath;
                }
            @endphp

            {{-- BUTTON --}}
            <div class="mb-3 text-center">
                <a href="{{ asset('storage/' . $filePath) }}"
                   target="_blank"
                   class="btn btn-primary btn-sm">

                    View Fullscreen

                </a>
            </div>

            {{-- VIEWER --}}
            <div class="card shadow-sm mb-4">
                <div class="card-body">

                    @if ($item->file)
                        <iframe
                            src="{{ asset('storage/' . $filePath) }}"
                            width="100%"
                            height="600px"
                            style="border:1px solid #ddd;">
                        </iframe>
                    @else
                        <div class="alert alert-danger text-center">
                            File tidak tersedia
                        </div>
                    @endif

                </div>
            </div>

        @endforeach

    @else

        <div class="alert alert-info text-center">
            Belum ada dokumen KPM GPM
        </div>

    @endif

</div>

@endsection
