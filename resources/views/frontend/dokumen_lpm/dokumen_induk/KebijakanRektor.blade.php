@extends('frontend_layouts.app')

@section('content')
    <div class="container page-content">

        <h3 class="mb-4 text-center fw-bold">
            Produk Kebijakan Rektor
        </h3>

        <table id="tableKebijakan" class="table table-hover table-bordered align-middle text-center">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Tahun</th>
                    <th>Nomor</th>
                    <th>Dokumen</th>
                    <th>Tentang</th>
                    <th>Tanggal Terbit</th>
                    <th>Lihat</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->tahun }}</td>
                        <td>{{ $item->nomor }}</td>
                        <td>{{ $item->dokumen }}</td>

                        <td class="text-start tentang-col" title="{{ $item->tentang }}">
                            {{ $item->tentang }}
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($item->tanggal_terbit)->format('d-m-Y') }}
                        </td>

                        {{-- FILE --}}
                        <td>
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
            initFrontendDataTable('#tableKebijakan');
        });
    </script>
@endpush
