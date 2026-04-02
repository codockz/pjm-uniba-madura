@extends('frontend_layouts.app')

@section('content')
    <div class="container py-5">

        <div style="margin-top:40px; margin-bottom:40px;">
            <h3 class="text-center mb-4 fw-bold">
                Rencana Strategis
            </h3>
        </div>

        <div class="row">
            @forelse ($data as $item)
                <div class="col-12 mb-5">

                    <div class="card border-0 shadow-sm rounded-3">

                        {{-- HEADER --}}
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">

                                {{-- KIRI --}}
                                <div>
                                    <h5 class="fw-bold mb-1 text-dark">
                                        {{ $item->judul }}
                                    </h5>

                                    <small class="text-muted">
                                        Periode {{ $item->tahun_mulai }} - {{ $item->tahun_berakhir }}
                                    </small>
                                </div>

                                {{-- KANAN --}}
                                <div class="mt-2 mt-md-0">
                                    <a href="{{ asset('storage/' . $item->file) }}" target="_blank"
                                        class="btn btn-success btn-sm me-2">
                                        <i class="fa fa-expand"></i> Fullscreen
                                    </a>

                                    <a href="{{ asset('storage/' . $item->file) }}" download class="btn btn-primary btn-sm">
                                        <i class="fa fa-download"></i> Download
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
                        Belum ada data Rencana Strategis.
                    </div>
                </div>
            @endforelse
        </div>

    </div>
@endsection

