@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold">Master Program Studi</h4>

            <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                + Tambah Program Studi
            </button>
        </div>

        <div class="card">
            <div class="card-body">

                <table class="table table-bordered table-striped">
                    <thead class="bg-primary text-white text-center">
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Program Studi</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td  class="text-center">
                                    <a href="{{ route('admin.program-studi.edit', $item->id) }}"
                                        class="badge bg-warning text-dark text-decoration-none px-3 py-2 me-1">
                                        <i class="fas fa-edit fa-lg"></i>
                                    </a>
                                    <form action="{{ route('admin.program-studi.destroy', $item->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')

                                        <button class="badge bg-danger border-0 px-3 py-2">
                                            <i class="fas fa-trash fa-lg"></i>
                                        </button>

                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Belum ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>

    </div>


    {{-- Modal Tambah --}}
    <div class="modal fade" id="modalTambah">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.program-studi.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Program Studi</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Program Studi</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
