@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0">Struktur Organisasi</h4>

            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="fas fa-plus"></i> Tambah Deskripsi
            </button>
        </div>

        {{-- ========================= --}}
        {{-- 🔹 GAMBAR + UPLOAD --}}
        {{-- ========================= --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body text-center">

                @if ($gambar && $gambar->gambar)
                    <img src="{{ asset('uploads/struktur/' . $gambar->gambar) }}" class="img-fluid rounded shadow-sm mb-4"
                        style="max-height:250px">
                @endif

                <form action="{{ route('admin_struktur_organisasi.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row justify-content-center align-items-center g-2">
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

        {{-- ========================= --}}
        {{-- 🔹 TABEL DESKRIPSI --}}
        {{-- ========================= --}}
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center mb-0 table-bordered">

                        <thead class="bg-primary text-white text-uppercase small">
                            <tr>
                                <th>No</th>
                                <th>Urutan</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
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
                                        <form action="{{ route('admin_struktur_organisasi.destroy', $item->id) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm px-3"
                                                onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>


                                {{-- 🔹 MODAL EDIT --}}
                                
                                <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Deskripsi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <form action="{{ route('admin_struktur_organisasi.update', $item->id) }}"
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
                                                        <label>Judul</label>
                                                        <input type="text" name="judul" class="form-control"
                                                            value="{{ $item->judul }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label>Deskripsi</label>
                                                        <textarea name="deskripsi" class="form-control" rows="4">{{ $item->deskripsi }}</textarea>
                                                    </div>

                                                </div>

                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
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

        {{-- ========================= --}}
        {{-- 🔹 MODAL TAMBAH --}}
        {{-- ========================= --}}
        <div class="modal fade" id="modalTambah" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Deskripsi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="{{ route('admin_struktur_organisasi.store') }}" method="POST">
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
                                <label>Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="4"></textarea>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection
