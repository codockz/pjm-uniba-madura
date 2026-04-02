@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Data Akreditasi Institusi</h3>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
                + Tambah Data
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                @if ($data->count() > 0)
                    <div class="table-responsive">
                        <table id="tableAkreditasi" class="table table-bordered table-hover align-middle text-center">

                            <thead class="bg-primary text-white">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama PT</th>
                                    <th>Peringkat</th>
                                    <th>Nomor SK</th>
                                    <th>Tahun</th>
                                    <th>Berlaku</th>
                                    <th>Kadaluarsa</th>
                                    <th>Sertifikat</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td class="text-start">{{ $item->nama_pt }}</td>

                                        <td>
                                            <span class="badge bg-success">{{ $item->peringkat }}</span>
                                        </td>

                                        <td class="text-start">{{ $item->nomor_sk }}</td>

                                        <td>{{ $item->tahun_sk }}</td>

                                        <td>{{ $item->tgl_berlaku }}</td>

                                        <td>{{ $item->tgl_kadaluarsa }}</td>

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
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modalEdit{{ $item->id }}">
                                                Edit
                                            </button>

                                            <form action="{{ route('admin.akreditasi_institusi.destroy', $item->id) }}" method="POST"
                                                class="d-inline">
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
                        Belum ada data Akreditasi Institusi.
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
                <h5 class="modal-title">Tambah Akreditasi</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('admin.akreditasi_institusi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Nama PT</label>
                        <input type="text" name="nama_pt" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Peringkat</label>
                        <input type="text" name="peringkat" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Nomor SK</label>
                        <textarea name="nomor_sk" class="form-control" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Tahun SK</label>
                        <input type="number" name="tahun_sk" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Tanggal Berlaku</label>
                        <input type="date" name="tgl_berlaku" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Tanggal Kadaluarsa</label>
                        <input type="date" name="tgl_kadaluarsa" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>File Sertifikat (PDF)</label>
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
{{-- -- ================= MODAL EDIT ================= --}}
    @foreach ($data as $item)
        <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Akreditasi</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="{{ route('admin.akreditasi_institusi.update', $item->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">

                            <div class="mb-3">
                                <label>Nama PT</label>
                                <input type="text" name="nama_pt" value="{{ $item->nama_pt }}" class="form-control"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label>Peringkat</label>
                                <input type="text" name="peringkat" value="{{ $item->peringkat }}" class="form-control"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label>Nomor SK</label>
                                <textarea name="nomor_sk" class="form-control" required>{{ $item->nomor_sk }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label>Tahun SK</label>
                                <input type="number" name="tahun_sk" value="{{ $item->tahun_sk }}" class="form-control"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label>Tanggal Berlaku</label>
                                <input type="date" name="tgl_berlaku" value="{{ $item->tgl_berlaku }}"
                                    class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Tanggal Kadaluarsa</label>
                                <input type="date" name="tgl_kadaluarsa" value="{{ $item->tgl_kadaluarsa }}"
                                    class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>File Sertifikat (PDF)</label>
                                <input type="file" name="file" class="form-control">
                                @if ($item->file)
                                    <small>File saat ini: {{ $item->file }}</small>
                                @endif
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
                $("#tableAkreditasi").DataTable({
                    responsive: true,
                    autoWidth: false,
                    pageLength: 10,
                    ordering: false
                });
            });
        </script>
    @endpush

@endsection
