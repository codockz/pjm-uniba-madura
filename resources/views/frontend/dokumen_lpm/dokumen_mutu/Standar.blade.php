@extends('frontend_layouts.app')

@section('content')
    <div class="container page-content">

        <h3 class="mb-4 text-center fw-bold">
            Standar
        </h3>

        <table id="tableStandar" class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Judul Dokumen</th>
                    <th>Tahun Terbit</th>
                    <th>Revisi Ke</th>
                    <th>Lampiran</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($data as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->judul }}</td>
                        <td class="text-center">{{ $item->tahun_terbit }}</td>
                        <td class="text-center">{{ $item->revisi }}</td>
                        <td class="text-center">
                            @if ($item->file)
                               <a href="{{ asset('storage/' . $item->file) }}" target="_blank"
                                    class="text-success text-decoration-none fw-semibold">
                                    <i class="fas fa-download me-1"></i> Download
                                </a>
                            @else
                                -
                            @endif
                        </td>
                    </tr>


                @endforeach

            </tbody>

        </table>

    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            initFrontendDataTable('#tableStandar'); 
        });
    </script>
@endpush
