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
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modalEdit{{ $item->id }}">
                                                Edit
                                            </button>

                                            <form action="{{ route('admin.kebijakan_rektor.destroy', $item->id) }}"
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

                        <input type="number" name="tahun" class="form-control mb-2" placeholder="Tahun" required>

                        <input type="text"name="nomor" class="form-control mb-2" placeholder="Nomor">

                        <input type="text" name="dokumen" class="form-control mb-2"
                            placeholder="Jenis Dokumen (SK, Maklumat, dll)">

                        <textarea name="tentang" class="form-control mb-2" placeholder="Tentang"></textarea>

                        <input type="date" name="tanggal_terbit" class="form-control mb-2">

                        <input type="file" name="file" class="form-control">

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

                            <input type="number" name="tahun" value="{{ $item->tahun }}" class="form-control mb-2"
                                required>

                            <input type="text" name="nomor" value="{{ $item->nomor }}" class="form-control mb-2">

                            <input type="text" name="dokumen" value="{{ $item->dokumen }}" class="form-control mb-2">

                            <textarea name="tentang" class="form-control mb-2">{{ $item->tentang }}</textarea>

                            <input type="date" name="tanggal_terbit" value="{{ $item->tanggal_terbit }}"
                                class="form-control mb-2">

                            <input type="file" name="file" class="form-control">

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
