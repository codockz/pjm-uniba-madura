@extends('frontend_layouts.app')

@section('content')
    <div class="container page-content">
        <h3 class="mb-4 text-center fw-bold">
            Daftar Nama Asesor BKD UNIBA Madura
        </h3>
        <div class="d-flex justify-content-between mb-3">
        </div>
            <table id="asesorTable" class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Asesor</th>
                        <th>NIRA</th>
                        <th>Program Studi</th>
                        <th>Periode</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_dosen }}</td>
                            <td>{{ $item->nira }}</td>
                            <td>{{ $item->programStudi->nama ?? '-' }}</td>
                            <td>{{ $item->periode }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                Data tidak ditemukan
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <div class="d-flex justify-content-between">
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#asesorTable').DataTable({
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100],
                scrollX: false,
                ordering: true,
                autoWidth: false,
                language: {
                    lengthMenu: "Tampilkan _MENU_ entri",
                    search: "Cari:",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    paginate: {
                        previous: "Sebelumnya",
                        next: "Selanjutnya"
                    }
                },
                dom: '<"row mb-3"' +
                    '<"col-md-6"l>' +
                    '<"col-md-6 text-end"f>' +
                    '>' +
                    'rt' +
                    '<"row mt-3"' +
                    '<"col-md-6"i>' +
                    '<"col-md-6 text-end"p>' +
                    '>'
            });
        });
    </script>
@endpush
