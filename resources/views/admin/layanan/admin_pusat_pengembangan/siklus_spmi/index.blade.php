@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0">Siklus SPMI</h4>

            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="fas fa-plus"></i> Tambah Tahap
            </button>
        </div>

        {{-- UPLOAD GAMBAR --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body text-center">

                @if ($diagram && $diagram->gambar)
                    <img src="{{ asset('uploads/spmi/' . $diagram->gambar) }}" class="img-fluid rounded shadow-sm mb-4"
                        style="max-height:250px">
                @endif

                <form action="{{ route('admin.siklus-spmi.uploadDiagram') }}" method="POST" enctype="multipart/form-data">
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

        {{-- TABLE --}}
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center mb-0 table-bordered">

                        <thead class="bg-primary text-white text-uppercase small">
                            <tr>
                                <th width="5%">No</th>
                                <th width="10%">Urutan</th>
                                <th>Nama Tahap</th>
                                <th>Deskripsi</th>
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
                                        {{ $item->nama_tahap }}
                                    </td>

                                    <td class="text-start">
                                        {{ Str::limit($item->deskripsi, 100) }}
                                    </td>

                                    <td>
                                        {{-- EDIT --}}
                                        <button class="btn btn-warning btn-sm px-3" data-bs-toggle="modal"
                                            data-bs-target="#modalEdit{{ $item->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        {{-- DELETE --}}
                                        <form action="{{ route('admin.siklus-spmi.destroy', $item->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="button" class="btn btn-danger btn-sm delete-confirm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>

                                </tr>

                                {{-- MODAL EDIT --}}
                                <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Tahap</h5>
                                                <button class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <form action="{{ route('admin.siklus-spmi.update', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')

                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                        <label>Urutan</label>
                                                        <input type="number" name="urutan" class="form-control"
                                                            value="{{ $item->urutan }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label>Nama Tahap</label>
                                                        <input type="text" name="nama_tahap" class="form-control"
                                                            value="{{ $item->nama_tahap }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label>Deskripsi</label>
                                                        <textarea name="deskripsi" class="form-control" rows="4">{{ $item->deskripsi }}</textarea>
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

    {{-- MODAL TAMBAH --}}
    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Tahap</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('admin.siklus-spmi.store') }}" method="POST">
                    @csrf

                    <div class="modal-body">

                        <div class="mb-3">
                            <label>Urutan</label>
                            <input type="number" name="urutan" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Nama Tahap</label>
                            <input type="text" name="nama_tahap" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="4"></textarea>
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
@endsection
