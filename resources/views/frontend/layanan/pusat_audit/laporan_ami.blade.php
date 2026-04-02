@extends('frontend_layouts.app')

@section('content')
    <div class="container py-5">

        <h3 class="text-center mb-4">
            Laporan AMI Tahun {{ $tahun }}
        </h3>

        <div class="row">
            @forelse($data as $item)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4 text-center">
                    <div class="card shadow-sm border-0">
                        <img src="{{ asset('storage/' . $item->cover) }}" class="img-fluid p-2">

                        <div class="card-body">
                            <a href="{{ asset('storage/' . $item->file) }}" target="_blank" class="btn btn-success btn-sm">
                                Lihat PDF
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">Data belum tersedia.</p>
            @endforelse
        </div>

    </div>
@endsection
