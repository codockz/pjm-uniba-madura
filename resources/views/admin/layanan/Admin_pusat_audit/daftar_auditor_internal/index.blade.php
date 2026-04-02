@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Data Daftar Auditor Internal</h3>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
                + Tambah Data
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                @if ($data->count() > 0)
                    <div class="table-responsive">
                        <table id="tableAuditor" class="table table-bordered table-hover align-middle text-center">

                            <thead class="bg-primary text-white">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Auditor</th>
                                    <th>Fakultas/Lembaga/Pascasarjana</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td class="text-start">
                                            {{ $item->nama }}
                                        </td>

                                        <td class="text-start">
                                            {{ $item->fakultas }}
                                        </td>

                                        <td>
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modalEdit{{ $item->id }}">
                                                Edit
                                            </button>

                                            <form action="{{ route('auditor_internal.destroy', $item->id) }}" method="POST"
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
                        Belum ada data Daftar Auditor Internal.
                    </div>
                @endif

            </div>
        </div>

    </div>

    {{-- MODAL CREATE --}}
    <div class="modal fade" id="modalCreate" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Auditor Internal</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('auditor_internal.store') }}" method="POST">
                    @csrf

                    <div class="modal-body">

                        <div class="mb-3">
                            <label>Nama Auditor</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Fakultas/Lembaga/Pascasarjana</label>
                            <input type="text" name="fakultas" class="form-control" required>
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
        <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Auditor Internal</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="{{ route('auditor_internal.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">

                            <div class="mb-3">
                                <label>Nama Auditor</label>
                                <input type="text" name="nama" value="{{ $item->nama }}" class="form-control"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label>Fakultas/Lembaga/Pascasarjana</label>
                                <input type="text" name="fakultas" value="{{ $item->fakultas }}" class="form-control"
                                    required>
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

                $("#tableAuditor").DataTable({

                    responsive: true,
                    autoWidth: false,
                    pageLength: 10,
                    ordering: false

                });

            });
        </script>
    @endpush

@endsection
