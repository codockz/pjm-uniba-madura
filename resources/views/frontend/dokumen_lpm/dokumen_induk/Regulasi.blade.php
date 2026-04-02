@extends('frontend_layouts.app')

@section('content')
    <div class="container page-content">

        <h3 class="mb-4 text-center fw-bold">
            Regulasi
        </h3>
        <table id="tableRegulasi" class="table table-hover table-bordered align-middle text-center">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Tahun</th>
                    <th>Sumber Dokumen</th>
                    <th>Nomor</th>
                    <th>Tentang</th>
                    <th>Lihat</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->tahun }}</td>
                        <td>{{ $item->sumber_dokumen }}</td>
                        <td>{{ $item->nomor }}</td>
                        <td class="text-start">{{ $item->tentang }}</td>

                        {{-- FILE --}}
                        <td>
                            @if ($item->file)
                                <a href="{{ asset('storage/' . $item->file) }}" target="_blank">
                                    Download
                                </a>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            Data tidak ditemukan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            initFrontendDataTable('#tableRegulasi');
        });
    </script>
@endpush
