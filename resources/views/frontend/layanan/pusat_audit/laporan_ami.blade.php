@extends('frontend_layouts.app')

@section('content')
    <div class="container page-content">

        <h3 class="mt-4 mb-4 text-center fw-bold">
            Laporan AMI
        </h3>

        <div class="filter-wrapper">

            <span class="filter-label">
                <i class="fas fa-filter"></i>
                Filter
            </span>

            <select id="filterTahun" class="form-select form-select-sm filter-select">
                <option value="">Semua</option>
                @foreach ($listTahun as $thn)
                    <option value="{{ $thn }}">{{ $thn }}</option>
                @endforeach
            </select>

        </div>

        {{-- 📋 TABEL --}}
        <table id="tableAmiFrontend" class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Judul Dokumen</th>
                    <th>Lampiran</th>
                </tr>
            </thead>

            <tbody>

                @forelse ($data as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>

                        <td>
                            {{ $item->judul }}
                            @if ($item->tahun)
                                ({{ $item->tahun }})
                            @endif
                        </td>

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

                @empty
                    <tr>
                        <td></td>
                        <td class="text-center">Data tidak ditemukan</td>
                        <td></td>
                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            let table = $('#tableAmiFrontend').DataTable({});

            $('#filterTahun').on('change', function() {

                let tahun = $(this).val();

                loadData({
                    url: "/laporan-ami?tahun=" + tahun,
                    table: table,
                    columns: [

                        // No
                        (item, index) => index + 1,

                        // Judul
                        (item) => {
                            let judul = item.judul;
                            if (item.tahun) {
                                judul += ` (${item.tahun})`;
                            }
                            return judul;
                        },

                        // Download
                        (item) => {
                            return item.file ?
                                `<a href="/storage/${item.file}" target="_blank"
        class="download-link">
        <i class="fas fa-download me-1"></i> Download
    </a>` :
                                '-';
                        }

                    ]
                });

            });

        });
    </script>
@endpush
