@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Data Kalender Mutu</h3>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
                + Tambah Data
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                @if ($data->count() > 0)
                    <div class="table-responsive">
                        <table id="tableKalenderMutu" class="table table-bordered table-hover align-middle text-center">

                            <thead class="bg-primary text-white">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Judul</th>
                                    <th width="10%">Tahun</th>
                                    <th width="15%">Cover</th>
                                    <th width="15%">File</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td class="text-start">
                                            {{ $item->judul }}
                                        </td>

                                        <td>
                                            <span class="badge bg-info">
                                                {{ $item->tahun }}
                                            </span>
                                        </td>

                                        <td>
                                            <img src="{{ asset('storage/'. $item->gambar) }}" width="80"
                                                class="img-thumbnail">
                                        </td>

                                        <td>
                                            <a href="{{ asset('storage/' . $item->file_pdf) }}" target="_blank"
                                                class="btn btn-success btn-sm">
                                                Lihat PDF
                                            </a>
                                        </td>

                                        <td>
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modalEdit{{ $item->id }}">
                                                Edit
                                            </button>

                                            <form action="{{ route('kalender_mutu.destroy', $item->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin hapus data?')">
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
                        Belum ada data kalender mutu.
                    </div>
                @endif

            </div>
        </div>

    </div>

    {{-- ================= CREATE ================= --}}
    <div class="modal fade" id="modalCreate">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kalender Mutu</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('kalender_mutu.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">

                        <div class="mb-3">
                            <label>Judul</label>
                            <input type="text" name="judul" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Tahun</label>
                            <input type="number" name="tahun" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Upload Cover</label>
                            <input type="file" name="gambar" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Upload PDF</label>
                            <input type="file" name="file_pdf" class="form-control">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button class="btn btn-primary">
                            Simpan
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    {{-- ================= EDIT ================= --}}
    @foreach ($data as $item)
        <div class="modal fade" id="modalEdit{{ $item->id }}">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Kalender Mutu</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="{{ route('kalender_mutu.update', $item->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">

                            <div class="mb-3">
                                <label>Judul</label>
                                <input type="text" name="judul" value="{{ $item->judul }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Tahun</label>
                                <input type="number" name="tahun" value="{{ $item->tahun }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Ganti Cover</label>
                                <input type="file" name="gambar" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Ganti PDF</label>
                                <input type="file" name="file_pdf" class="form-control">
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">
                                Batal
                            </button>

                            <button class="btn btn-primary">
                                Update
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    @endforeach

    @push('scripts')
        <script>
            $(function() {
                initDataTable("#tableKalenderMutu");
            });
        </script>
    @endpush

@endsection
