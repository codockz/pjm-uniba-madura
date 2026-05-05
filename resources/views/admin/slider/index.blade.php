@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Data Slider</h3>

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
            + Tambah Slider
        </button>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            @if ($sliders->count() > 0)
                <div class="table-responsive">
                    <table id="tableSlider" class="table table-bordered table-hover align-middle text-center">

                        <thead class="bg-primary text-white">
                            <tr>
                                <th width="5%">No</th>
                                <th>Judul</th>
                                <th>Gambar</th>
                                <th width="20%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($sliders as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td class="text-start">{{ $item->judul }}</td>

                                    <td>
                                        <img src="{{ asset('storage/' . $item->gambar) }}"
     style="width: 150px; height: 80px; object-fit: cover; border-radius:5px;">
                                    </td>

                                    <td>

                                        {{-- EDIT --}}
                                        <button class="btn btn-warning btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEdit{{ $item->id }}">
                                            <i class="fas fa-pen"></i>
                                        </button>

                                        {{-- DELETE --}}
                                        <form action="{{ route('slider.destroy', $item->id) }}" method="POST"
                                            class="d-inline">
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
                    Belum ada data slider.
                </div>
            @endif

        </div>
    </div>

</div>

{{-- ================= MODAL CREATE ================= --}}
<div class="modal fade" id="modalCreate">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Tambah Slider</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Judul</label>
                        <input type="text" name="judul" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Gambar</label>
                        <input type="file" name="gambar" class="form-control" required>
                    </div>

                    {{-- <div class="mb-3">
                        <label>Link</label>
                        <input type="text" name="link" class="form-control">
                    </div> --}}

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
@foreach ($sliders as $item)
<div class="modal fade" id="modalEdit{{ $item->id }}">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit Slider</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('slider.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Judul</label>
                        <input type="text" name="judul" value="{{ $item->judul }}" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control">{{ $item->deskripsi }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label>Gambar (opsional)</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Link</label>
                        <input type="text" name="link" value="{{ $item->link }}" class="form-control">
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
    $("#tableSlider").DataTable({
        responsive: true,
        autoWidth: false,
        pageLength: 10,
        ordering: false
    });
});
</script>
@endpush

@endsection
