@extends('frontend_layouts.app')

@section('content')
    <div class="container page-content">
        <h3 class="mb-4 text-center fw-bold">
            SK Akreditasi Program Studi
        </h3>

        <table id="tableAkreditasi" class="table table-hover table-bordered align-middle text-center">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Program Studi</th>
                    <th>Jenjang</th>
                    <th>SK Izin</th>
                    <th>Akreditasi</th>
                    <th>SK Akreditasi</th>
                    <th>Berlaku</th>
                    <th>Kadaluarsa</th>
                    <th>Sertifikat</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->program_studi }}</td>
                        <td>{{ $item->jenjang }}</td>
                        {{-- SK IZIN --}}
                        <td>
                            @if ($item->sk_izin_text)
                                <a href="{{ asset('storage/' . $item->file_sk_izin) }}" target="_blank">
                                    {{ $item->sk_izin_text }}
                                </a>
                            @else
                                -
                            @endif
                        </td>
                        {{-- AKREDITASI --}}
                        <td>
                            <span class="badge badge-success">Unggul</span>
                        </td>

                        {{-- SK AKREDITASI --}}
                        <td>
                            @if ($item->sk_akreditasi_text)
                                <a href="{{ asset('storage/' . $item->file_sk_akreditasi) }}" target="_blank">
                                    {{ $item->sk_akreditasi_text }}
                                </a>
                            @else
                                -
                            @endif
                        </td>
                        {{-- BERLAKU --}}
                        <td class="text-nowrap">
                            {{ $item->berlaku ? \Carbon\Carbon::parse($item->berlaku)->format('d-m-Y') : '-' }}
                        </td>

                        {{-- KADALUARSA --}}
                        <td class="text-nowrap">
                            {{ $item->kadaluarsa ? \Carbon\Carbon::parse($item->kadaluarsa)->format('d-m-Y') : '-' }}
                        </td>
                        {{-- SERTIFIKAT --}}
                        <td class="text-nowrap">
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
            initFrontendDataTable('#tableAkreditasi');
        });
    </script>
@endpush
