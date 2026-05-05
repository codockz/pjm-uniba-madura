@extends('frontend_layouts.app')

@section('content')
    <div class="container page-content">

        <h3 class="mb-4 text-center fw-bold">
            Akreditasi Institusi UNIBA Madura
        </h3>

        <table id="tableAkreditasi" class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama PT</th>
                    <th>Peringkat</th>
                    <th>Nomor SK</th>
                    <th>Tahun</th>
                    <th>Berlaku</th>
                    <th>Kadaluarsa</th>
                    <th>Sertifikat</th>
                </tr>
            </thead>

            <tbody>
    @foreach ($data as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nama_pt }}</td>
            <td>{{ $item->peringkat }}</td>
            <td>{{ $item->nomor_sk }}</td>
            <td>{{ $item->tahun_sk }}</td>
            <td>{{ $item->tgl_berlaku }}</td>
            <td>{{ $item->tgl_kadaluarsa }}</td>
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
        initFrontendDataTable('#tableAkreditasi');
    });
</script>
@endpush
