@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Data Sertifikasi Dosen</h3>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
                + Tambah Data
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                <div class="table-responsive">

                    <table id="tableSertifikasi" class="table table-bordered table-hover align-middle text-center">

                        <thead class="bg-primary text-white">
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">Tahun</th>
                                <th>Judul / Surat Keputusan</th>
                                <th width="15%">File</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @if ($data->count() > 0)
                                @foreach ($data as $item)
                                    <tr>

                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $item->tahun }}</td>

                                        <td class="text-start">
                                            {{ $item->judul }}
                                        </td>

                                        <td>

                                            @if ($item->file)
                                                <a href="{{ asset('storage/' . $item->file) }}" target="_blank"
                                                    class="btn btn-info btn-sm">

                                                    Lihat

                                                </a>
                                            @endif

                                        </td>

                                        <td>

                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modalEdit{{ $item->id }}">

                                                Edit

                                            </button>

                                            <form action="{{ route('sertifikasi_dosen.destroy', $item->id) }}" method="POST"
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
                            @else
                                <tr>

                                    <td colspan="5" class="text-center text-muted">
                                        Belum ada data Sertifikasi Dosen
                                    </td>

                                </tr>
                            @endif

                        </tbody>

                    </table>

                </div>

            </div>
        </div>

    </div>

    {{-- MODAL CREATE --}}
    <div class="modal fade" id="modalCreate" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Sertifikasi Dosen</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('sertifikasi_dosen.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="modal-body">

                        <div class="mb-3">
                            <label>Tahun Sertifikasi</label>
                            <input type="text" name="tahun" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Judul / Surat Keputusan</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Upload File (PDF)</label>
                            <input type="file" name="file" class="form-control">
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    @foreach ($data as $item)
        <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1">

            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Sertifikasi Dosen</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="{{ route('sertifikasi_dosen.update', $item->id) }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <div class="modal-body">

                            <div class="mb-3">
                                <label>Tahun Sertifikasi</label>
                                <input type="text" name="tahun" value="{{ $item->tahun }}" class="form-control"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label>Judul / Surat Keputusan</label>
                                <input type="text" name="judul" value="{{ $item->judul }}" class="form-control"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label>Upload File Baru (optional)</label>
                                <input type="file" name="file" class="form-control">
                            </div>

                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Batal
                            </button>

                            <button type="submit" class="btn btn-primary">
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

                $("#tableSertifikasi").DataTable({

                    responsive: true,
                    autoWidth: false,
                    pageLength: 10,
                    ordering: false

                });

            });
        </script>
    @endpush

@endsection
