@extends('frontend_layouts.app')

@section('content')

    <div class="container page-content">

        <h3>Laporan Monitoring & Evaluasi</h3>

        @if ($data->count() > 0)
            @foreach ($data as $item)
                <h5 class="mt-4">Tahun {{ $item->tahun }}</h5>

                <a href="{{ asset('storage/' . $item->file) }}" target="_blank" class="btn btn-primary btn-sm mb-3">
                    View Fullscreen
                </a>
                <div class="card shadow-sm">

                    <div class="card-body">

                        <iframe src="{{ asset('storage/' . $item->file) }}" width="100%" height="600px">

                        </iframe>
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-info">
                Belum ada dokumen Laporan Monev
            </div>
        @endif
    </div>
@endsection
