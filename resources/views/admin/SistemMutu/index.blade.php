@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Data Sistem Informasi Mutu</h3>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
                + Tambah Data
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                @if ($data->count() > 0)
                    <div class="table-responsive">
                        <table id="tableSIM" class="table table-bordered table-hover align-middle text-center">

                            <thead class="bg-primary text-white">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Sistem</th>
                                    <th>Singkatan</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td class="text-start">
                                            {{ $item->nama_penyelenggara }}
                                        </td>

                                        <td>
                                            @if ($item->link)
                                                <a href="{{ $item->link }}" target="_blank">
                                                    {{ $item->singkatan }}
                                                </a>
                                            @else
                                                {{ $item->singkatan }}
                                            @endif
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modalEdit{{ $item->id }}" title="Edit Data">
                                                <i class="fas fa-pen"></i>
                                            </button>

                                            <form action="{{ route('admin.sistem_informasi_mutu.destroy', $item->id) }}"
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
                        Belum ada data sistem informasi mutu.
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
                    <h5 class="modal-title">Tambah Sistem Informasi Mutu</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('admin.sistem_informasi_mutu.store') }}" method="POST">
                    @csrf

                    <div class="modal-body">

                        <div class="mb-3">
                            <label>Nama Sistem</label>
                            <input type="text" name="nama_penyelenggara" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Singkatan</label>
                            <input type="text" name="singkatan" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Link</label>
                            <input type="url" name="link" class="form-control">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-success">Simpan</button>
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
                        <h5 class="modal-title">Edit Sistem Informasi Mutu</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="{{ route('admin.sistem_informasi_mutu.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">

                            <div class="mb-3">
                                <label>Nama Sistem</label>
                                <input type="text" name="nama_penyelenggara" value="{{ $item->nama_penyelenggara }}"
                                    class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Singkatan</label>
                                <input type="text" name="singkatan" value="{{ $item->singkatan }}" class="form-control"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label>Link</label>
                                <input type="url" name="link" value="{{ $item->link }}" class="form-control">
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Batal
                            </button>
                            <button class="btn btn-success">Update</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    @endforeach

    @push('scripts')
        <script>
            $(function() {
                $("#tableSIM").DataTable({
                    responsive: true,
                    autoWidth: false,
                    pageLength: 10,
                    ordering: false
                });
            });
        </script>
    @endpush

@endsection
