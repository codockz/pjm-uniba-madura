@extends('frontend_layouts.app')

@section('content')
    <div class="container py-5">

        <div style="margin-top:40px; margin-bottom:40px;">
            <h3 class="text-center mb-4">
                Kalender Mutu Tahun {{ $tahun }}
            </h3>
        </div>

        <div class="row">
            @forelse ($data as $item)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card shadow-sm border-0 text-center">

                        <!-- COVER -->
                        <img src="{{ asset('storage/' . $item->gambar) }}"
                             style="width:100%; object-fit:contain; background:white;"
                             alt="cover">

                        <!-- BUTTON -->
                        <div style="padding:10px;">
                            <a href="{{ asset('storage/' . $item->file_pdf) }}"
                               target="_blank"
                               class="btn btn-success btn-sm">
                                Lihat PDF
                            </a>
                        </div>

                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>Data kalender mutu tahun {{ $tahun }} belum tersedia</p>
                </div>
            @endforelse
        </div>

    </div>
@endsection
