@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Data Dokumen SPMI</h3>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
                + Tambah Data
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                @if ($data->count() > 0)
                    <div class="table-responsive">
                        <table id="tableSPMI" class="table table-bordered table-hover align-middle text-center">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Cover</th>
                                    <th>Link</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td class="text-start">{{ $item->judul }}</td>

                                        <td>
                                            <img src="{{ asset('storage/' . $item->gambar) }}" width="80"
                                                class="img-thumbnail">
                                        </td>

                                        <td>
                                            <a href="{{ $item->link }}" target="_blank" class="btn btn-success btn-sm">
                                                Buka Link
                                            </a>
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modalEdit{{ $item->id }}" title="Edit Data">
                                                <i class="fas fa-pen"></i>
                                            </button>

                                            <form action="{{ route('admin.dokumen_spmi.destroy', $item->id) }}"
                                                method="POST" class="d-inline">
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
                        Belum ada data Dokumen SPMI.
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
                    <h5 class="modal-title">Tambah Dokumen SPMI</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('admin.dokumen_spmi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">

                        <div class="mb-3">
                            <label>Judul</label>
                            <input type="text" name="judul" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Link Google Drive</label>
                            <input type="text" name="link" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Upload Cover</label>
                            <input type="file" name="gambar" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control"></textarea>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
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
                        <h5 class="modal-title">Edit Dokumen SPMI</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="{{ route('admin.dokumen_spmi.update', $item->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">

                            <div class="mb-3">
                                <label>Judul</label>
                                <input type="text" name="judul" value="{{ $item->judul }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Link Google Drive</label>
                                <input type="text" name="link" value="{{ $item->link }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Ganti Cover</label>
                                <input type="file" name="gambar" class="form-control">
                                <img src="{{ asset('storage/' . $item->gambar) }}" width="100" class="mt-2">
                            </div>

                            <div class="mb-3">
                                <label>Deskripsi</label>
                                <textarea name="deskripsi" class="form-control">{{ $item->deskripsi }}</textarea>
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
                initDataTable("#tableSPMI");
            });
        </script>
    @endpush

@endsection
