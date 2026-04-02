@extends('frontend_layouts.app')

@section('content')
    <div class="container page-content">

        

        @if ($data)
            <a href="{{ asset('storage/' . $data->file) }}" target="_blank" class="btn btn-primary mb-3">
                View Fullscreen
            </a>

            <div class="card shadow-sm">
                <div class="card-body">

                    <iframe src="{{ asset('storage/' . $data->file) }}" width="100%" height="600px">
                    </iframe>

                </div>
            </div>
        @else
            <div class="alert alert-info text-center mt-4">
                📄 Kalender Akademik tahun {{ $tahun }} belum tersedia
            </div>
        @endif

    </div>
@endsection
