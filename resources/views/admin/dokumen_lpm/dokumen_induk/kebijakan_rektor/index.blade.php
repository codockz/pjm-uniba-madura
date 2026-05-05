@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Produk Kebijakan Rektor</h3>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
                + Tambah Data
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                @if ($data->count() > 0)
                    <div class="table-responsive">
                        <table id="tableKebijakan" class="table table-bordered table-hover align-middle text-center">

                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Tahun</th>
                                    <th>Nomor</th>
                                    <th>Dokumen</th>
                                    <th>Tentang</th>
                                    <th>Tanggal Terbit</th>
                                    <th>File</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->tahun }}</td>
                                        <td>{{ $item->nomor }}</td>
                                        <td>{{ $item->dokumen }}</td>
                                        <td class="text-start tentang-col" title="{{ $item->tentang }}">
                                            {{ $item->tentang }}
                                        </td>
                                        <td>{{ $item->tanggal_terbit }}</td>

                                        <td>
                                            @if ($item->file)
                                                <a href="{{ asset('storage/' . $item->file) }}" target="_blank"
                                                    class="btn btn-sm btn-info">
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

                                            <form action="{{ route('admin.kebijakan_rektor.destroy', $item->id) }}"
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
                        Belum ada data.
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
                    <h5 class="modal-title">Tambah Data</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('admin.kebijakan_rektor.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">

                        <div class="mb-3">
                            <label>Tahun</label>
                            <input type="number" name="tahun" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Nomor</label>
                            <input type="text" name="nomor" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Jenis Dokumen</label>
                            <input type="text" name="dokumen" class="form-control" placeholder="SK, Maklumat, dll">
                        </div>

                        <div class="mb-3">
                            <label>Tentang</label>
                            <textarea name="tentang" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Tanggal Terbit</label>
                            <input type="date" name="tanggal_terbit" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>File</label>
                            <input type="file" name="file" class="form-control">
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
                        <h5>Edit Data</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="{{ route('admin.kebijakan_rektor.update', $item->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">

                            <div class="mb-3">
                                <label>Tahun</label>
                                <input type="number" name="tahun" value="{{ $item->tahun }}" class="form-control"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label>Nomor</label>
                                <input type="text" name="nomor" value="{{ $item->nomor }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Jenis Dokumen</label>
                                <input type="text" name="dokumen" value="{{ $item->dokumen }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Tentang</label>
                                <textarea name="tentang" class="form-control" rows="3">{{ $item->tentang }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label>Tanggal Terbit</label>
                                <input type="date" name="tanggal_terbit" value="{{ $item->tanggal_terbit }}"
                                    class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>File</label>
                                <input type="file" name="file" class="form-control">
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
                $("#tableKebijakan").DataTable({
                    responsive: true,
                    autoWidth: false,
                    pageLength: 10,
                    ordering: false
                });
            });
        </script>
    @endpush

@endsection
