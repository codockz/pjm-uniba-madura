@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Data SOP</h3>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
                + Tambah SOP
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                {{-- 🔽 FILTER --}}
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">

                    <div class="d-flex align-items-center gap-2">

                        <span class="text-muted small d-flex align-items-center gap-1 me-1">
                            <i class="fas fa-filter"></i>
                            Filter
                        </span>

                        <select id="filterTahun" class="form-select form-select-sm filter-select">
                            <option value="">Semua</option>
                            @foreach ($data->pluck('tahun')->unique() as $thn)
                                <option value="{{ $thn }}">{{ $thn }}</option>
                            @endforeach
                        </select>

                    </div>

                </div>

                @if ($data->count() > 0)
                    <div class="table-responsive">
                        <table id="tableSop" class="table table-bordered table-hover align-middle text-center">

                            <thead class="bg-primary text-white">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Judul SOP</th>
                                    <th>Tahun</th>
                                    <th>File</th>
                                    <th>Status</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td class="text-start">{{ $item->judul }}</td>

                                        <td>{{ $item->tahun ?? '-' }}</td>

                                        <td>
                                            @if ($item->file)
                                                <a href="{{ asset('storage/' . $item->file) }}" target="_blank">
                                                    Download
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>

                                        {{-- STATUS --}}
                                        <td>
                                            <span class="badge bg-{{ $item->is_active ? 'success' : 'danger' }}">
                                                {{ $item->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                            </span>
                                        </td>

                                        {{-- AKSI --}}
                                        <td>

                                            {{-- TOGGLE --}}
                                            <form action="{{ route('admin.sop.toggle', $item->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button
                                                    class="btn btn-sm {{ $item->is_active ? 'btn-success' : 'btn-secondary' }}"
                                                    title="Toggle Status">

                                                    <i
                                                        class="fas {{ $item->is_active ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                                </button>
                                            </form>

                                            {{-- EDIT --}}
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modalEdit{{ $item->id }}" title="Edit Data">
                                                <i class="fas fa-pen"></i>
                                            </button>

                                            {{-- DELETE --}}
                                            <form action="{{ route('admin.sop.destroy', $item->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')

                                                <button type="button" class="btn btn-danger btn-sm delete-confirm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                @else
                    <div class="alert alert-info text-center">
                        Belum ada data SOP.
                    </div>
                @endif

            </div>
        </div>

    </div>

    {{-- ================= MODAL CREATE ================= --}}
    <div class="modal fade" id="modalCreate" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Tambah SOP</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('admin.sop.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">

                        <div class="mb-3">
                            <label>Judul SOP</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Tahun</label>
                            <input type="number" name="tahun" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Status</label>
                            <select name="is_active" class="form-control">
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>File (PDF)</label>
                            <input type="file" name="file" class="form-control" required>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-success">Simpan</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    {{-- ================= MODAL EDIT ================= --}}
    @foreach ($data as $item)
        <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Edit SOP</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="{{ route('admin.sop.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">

                            <div class="mb-3">
                                <label>Judul SOP</label>
                                <input type="text" name="judul" value="{{ $item->judul }}" class="form-control"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label>Tahun</label>
                                <input type="number" name="tahun" value="{{ $item->tahun }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Status</label>
                                <select name="is_active" class="form-control">
                                    <option value="1" {{ $item->is_active ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ !$item->is_active ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>File</label>
                                <input type="file" name="file" class="form-control">
                                @if ($item->file)
                                    <small>File saat ini: {{ $item->file }}</small>
                                @endif
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Batal
                            </button>
                            <button class="btn btn-success">Update</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    @endforeach

    @push('scripts')
        <script>
            $(function() {
                $("#tableSop").DataTable({
                    responsive: true,
                    autoWidth: false,
                    pageLength: 10,
                    ordering: false
                });
            });

            $(document).ready(function() {

                let table = initDataTable('#tableSop');

                $('#filterTahun').on('change', function() {
                    table.column(2).search(this.value).draw();
                });

            });
        </script>
    @endpush

@endsection
