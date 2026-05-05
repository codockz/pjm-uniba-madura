@extends('frontend_layouts.app')

@section('content')
<div class="container page-content">

    <h3 class="mb-3 fw-bold">Sertifikasi Dosen</h3>

    {{-- ================= PEDOMAN ================= --}}
    <div class="mb-4">

        <h6 class="fw-bold">PEDOMAN SERTIFIKASI DOSEN</h6>

        @forelse ($pedoman as $item)
            <div class="mb-2">

                {{-- LABEL --}}
                <span style="font-weight:600; margin-right:5px;">
                    {{ $item->label }}
                </span>

                {{-- LINK --}}
                <a href="{{ asset('storage/' . $item->file) }}" target="_blank"
                   style="color:#071f1d; text-decoration:none;">
                    {{ $item->judul }}
                </a>

            </div>
        @empty
            <div class="text-muted">
                Belum ada data pedoman.
            </div>
        @endforelse

        {{-- CATATAN --}}
        <p class="mt-2">
            Catatan:
            <a style="color:#091211;">
                Syarat menjadi peserta serdos tahun 2019
            </a>
        </p>

    </div>

    {{-- ================= TABEL ================= --}}
    <table id="tableSertifikasi" class="table table-bordered table-striped">

        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="25%">Tahun Kelulusan</th>
                <th>Surat Keputusan</th>
            </tr>
        </thead>

        <tbody>
    @foreach ($data as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>

            <td>
                <a href="{{ asset('storage/' . $item->file) }}" target="_blank">
                    Sertifikasi Tahun {{ $item->tahun }}
                </a>
            </td>

            <td>{{ $item->judul }}</td>
        </tr>
    @endforeach
</tbody>

    </table>

</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        initFrontendDataTable('#tableSertifikasi');
    });
</script>
@endpush
