@extends('frontend_layouts.app')

@section('content')
    <div class="container py-5">

        <div style="margin-top:40px; margin-bottom:40px;">
            <h3 class="text-center fw-bold">
                Jadwal RTM
            </h3>
        </div>
        <div class="row">
            @foreach ($data as $item)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card shadow-sm border-0 text-center">
                        <img src="{{ asset('storage/' . $item->cover) }}"
                            style="width:100%; object-fit:contain; background:white;">
                        <div style="padding:10px">

                            <a href="{{ asset('storage/' . $item->file) }}" target="_blank" class="btn btn-success btn-sm">

                                Lihat PDF
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
