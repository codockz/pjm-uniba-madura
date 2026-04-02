@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Data Rencana Strategis</h3>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
                + Tambah Data
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                @if ($data->count() > 0)
                    <div class="table-responsive">
                        <table id="tableRenstra" class="table table-bordered table-hover align-middle text-center">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Tahun</th>
                                    <th>File</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-start">{{ $item->judul }}</td>
                                        <td>
                                            <span class="badge bg-primary px-3 py-2">
                                                {{ $item->tahun_mulai }} - {{ $item->tahun_berakhir }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ asset('storage/' . $item->file) }}" target="_blank"
                                                class="btn btn-success btn-sm">
                                                <i class="fa fa-file-pdf"></i> Lihat PDF
                                            </a>
                                        </td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modalEdit{{ $item->id }}">
                                                Edit
                                            </button>

                                            <form action="{{ route('admin.rencana_strategis.destroy', $item->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                    Hapus
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
                        Belum ada data Rencana Strategis.
                    </div>
                @endif

            </div>
        </div>
    </div>

    {{-- ================= MODAL CREATE ================= --}}
    <div class="modal fade" id="modalCreate">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Rencana Strategis</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('admin.rencana_strategis.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label>Judul</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Tahun Mulai</label>
                            <input type="number" name="tahun_mulai" class="form-control" placeholder="2020" required>
                        </div>

                        <div class="mb-3">
                            <label>Tahun Berakhir</label>
                            <input type="number" name="tahun_berakhir" class="form-control" placeholder="2025" required>
                        </div>

                        <div class="mb-3">
                            <label>Upload PDF</label>
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
        <div class="modal fade" id="modalEdit{{ $item->id }}">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Rencana Strategis</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="{{ route('admin.rencana_strategis.update', $item->id) }}" method="POST"
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
                                <label>Tahun Mulai</label>
                                <input type="number" name="tahun_mulai" value="{{ $item->tahun_mulai }}"
                                    class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Tahun Berakhir</label>
                                <input type="number" name="tahun_berakhir" value="{{ $item->tahun_berakhir }}"
                                    class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Ganti PDF</label>
                                <input type="file" name="file" class="form-control">
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
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
                initDataTable("#tableRenstra");
            });
        </script>
    @endpush

@endsection

