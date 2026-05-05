@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0">Statuta & Ortaker</h4>

            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="fas fa-plus"></i> Tambah Dokumen
            </button>
        </div>

        {{-- 🔼 GAMBAR --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body text-center">

                @if ($image && $image->gambar)
                    <img src="{{ asset('uploads/statuta/' . $image->gambar) }}" class="img-fluid rounded shadow-sm mb-4"
                        style="max-height:250px">
                @endif

                <form action="{{ route('admin.statua_ortaker_images') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row justify-content-center g-2">
                        <div class="col-md-5">
                            <input type="file" name="gambar" class="form-control form-control-sm">
                        </div>

                        <div class="col-md-2">
                            <button class="btn btn-primary btn-sm w-100">
                                <i class="fas fa-upload"></i> Upload
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        {{-- 🔽 TABLE --}}
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center mb-0 table-bordered">

                        <thead class="bg-primary text-white text-uppercase small">
                            <tr>
                                <th width="5%">No</th>
                                <th width="10%">Urutan</th>
                                <th>Judul</th>
                                <th width="15%">File</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        <span class="badge bg-primary">
                                            {{ $item->urutan }}
                                        </span>
                                    </td>

                                    <td class="text-start">
                                        {{ $item->judul }}
                                    </td>

                                    <td>
                                        <a href="{{ asset('uploads/statuta/' . $item->file) }}" target="_blank">
                                            Download
                                        </a>
                                    </td>

                                    <td>
                                        {{-- EDIT --}}
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#modalEdit{{ $item->id }}" title="Edit Data">
                                            <i class="fas fa-pen"></i>
                                        </button>

                                        {{-- DELETE --}}
                                        <form action="{{ route('admin.statua_ortakers.destroy', $item->id) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="button" class="btn btn-danger btn-sm delete-confirm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                {{-- 🔥 MODAL EDIT --}}
                                <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Dokumen</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <form action="{{ route('admin.statua_ortakers.update', $item->id) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                        <label>Urutan</label>
                                                        <input type="number" name="urutan" class="form-control"
                                                            value="{{ $item->urutan }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label>Judul</label>
                                                        <input type="text" name="judul" class="form-control"
                                                            value="{{ $item->judul }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label>Ganti File (Opsional)</label>
                                                        <input type="file" name="file" class="form-control">
                                                    </div>

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        Batal
                                                    </button>
                                                    <button class="btn btn-primary">Update</button>
                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div>

                            @empty
                                <tr>
                                    <td colspan="5">Data belum tersedia</td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    </div>

    {{-- 🔥 MODAL TAMBAH --}}
    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Dokumen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('admin.statua_ortakers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">

                        <div class="mb-3">
                            <label>Urutan</label>
                            <input type="number" name="urutan" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Judul</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>File PDF</label>
                            <input type="file" name="file" class="form-control" required>
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
@endsection
