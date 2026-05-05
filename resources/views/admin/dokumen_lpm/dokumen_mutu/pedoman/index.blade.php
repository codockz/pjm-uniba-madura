@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Data Pedoman</h3>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
                + Tambah Data
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                @if ($data->count() > 0)
                    <div class="table-responsive">
                        <table id="tablePedoman" class="table table-bordered table-hover align-middle text-center">

                            <thead class="bg-primary text-white">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Judul Dokumen</th>
                                    <th>Tahun</th>
                                    <th>Revisi</th>
                                    <th>File</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td class="text-start">{{ $item->judul }}</td>

                                        <td>{{ $item->tahun_terbit }}</td>

                                        <td>
                                            <span class="badge bg-info">
                                                {{ $item->revisi }}
                                            </span>
                                        </td>

                                        <td>
                                            @if ($item->file)
                                                <a href="{{ asset('storage/' . $item->file) }}" target="_blank">
                                                    Download
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modalEdit{{ $item->id }}" title="Edit Data">
                                                <i class="fas fa-pen"></i>
                                            </button>

                                            <form action="{{ route('admin.pedoman.destroy', $item->id) }}" method="POST"
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
                        Belum ada data Pedoman.
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
                    <h5 class="modal-title">Tambah Pedoman</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('admin.pedoman.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">

                        <div class="mb-3">
                            <label>Judul Dokumen</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Tahun Terbit</label>
                            <input type="number" name="tahun_terbit" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Revisi</label>
                            <input type="number" name="revisi" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>File (PDF/DOC)</label>
                            <input type="file" name="file" class="form-control" required>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary">Simpan</button>
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
                        <h5 class="modal-title">Edit Pedoman</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="{{ route('admin.pedoman.update', $item->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">

                            <div class="mb-3">
                                <label>Judul</label>
                                <input type="text" name="judul" value="{{ $item->judul }}" class="form-control"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label>Tahun</label>
                                <input type="number" name="tahun_terbit" value="{{ $item->tahun_terbit }}"
                                    class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Revisi</label>
                                <input type="number" name="revisi" value="{{ $item->revisi }}" class="form-control"
                                    required>
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
                            <button class="btn btn-primary">Update</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    @endforeach

    @push('scripts')
        <script>
            $(function() {
                $("#tablePedoman").DataTable({
                    responsive: true,
                    autoWidth: false,
                    pageLength: 10,
                    ordering: false
                });
            });
        </script>
    @endpush

@endsection
