@extends('frontend_layouts.app')

@section('content')
    <div class="container" style="margin-top:50px; margin-bottom:50px;">

        <!-- JUDUL -->
        <h4 class="text-center fw-bold mb-4">
            Rencana Strategis Lembaga
        </h4>

        @if ($data)
            <!-- PDF VIEWER ONLY -->
            <div style="max-width:900px; margin:auto;">

                <div style="background:#2f2f2f; padding:10px; border-radius:8px;">
                    <iframe src="{{ asset('storage/' . $data->file) }}" width="100%" height="750px"
                        style="border:none; border-radius:6px;">
                    </iframe>
                </div>


                <div class="mt-2 text-start">
                    <a href="{{ asset('storage/' . $data->file) }}" download
                        style="font-size:13px; text-decoration:none; color:#888;">
                        Unduh
                    </a>
                </div>

            </div>
        @else
            <div class="alert alert-warning text-center">
                Data belum tersedia
            </div>
        @endif

    </div>
@endsection
