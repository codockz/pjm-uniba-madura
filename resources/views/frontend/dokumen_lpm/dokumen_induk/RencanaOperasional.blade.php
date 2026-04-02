@extends('frontend_layouts.app')

@section('content')
    <div class="container py-5">

        <div style="margin-top:40px; margin-bottom:40px;">
            <h3 class="text-center mb-4 fw-bold">
                Rencana Operasional
            </h3>
        </div>

        <div class="row">
            @forelse ($data as $item)
                <div class="col-12 mb-4">

                    <div class="card shadow-sm border-0">

                        {{-- HEADER --}}
                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-center flex-wrap">

                                <div>
                                    <h5 class="fw-bold mb-1">
                                        {{ $item->judul }}
                                    </h5>
                                </div>

                                <div class="mt-2 mt-md-0">
                                    <a href="{{ asset('storage/' . $item->file) }}" target="_blank"
                                        class="btn btn-success btn-sm me-2">
                                        🔍 Fullscreen
                                    </a>

                                    <a href="{{ asset('storage/' . $item->file) }}" download class="btn btn-primary btn-sm">
                                        ⬇ Download
                                    </a>
                                </div>

                            </div>

                        </div>

                        {{-- PDF VIEWER --}}
                        <div class="px-3 pb-3">
                            <iframe src="{{ asset('storage/' . $item->file) }}" width="100%" height="600px"
                                style="border-radius:8px; border:none;">
                            </iframe>
                        </div>

                    </div>

                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        Belum ada data Rencana Operasional.
                    </div>
                </div>
            @endforelse
        </div>

    </div>
@endsection
