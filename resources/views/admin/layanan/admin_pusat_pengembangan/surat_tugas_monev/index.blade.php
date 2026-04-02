@extends('layouts.app')

@section('content')
    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h3 class="card-title">
                <i class="fas fa-folder-open text-primary"></i> Surat Tugas Monev
            </h3>

            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalUpload">
                <i class="fas fa-upload"></i> Upload Dokumen
            </button>

        </div>

        <div class="card-body">

            @if ($data->count() > 0)
                <div class="row">

                    @foreach ($data as $item)
                        <div class="col-md-4">

                            <div class="card shadow-sm border-0 h-100">

                                <div class="card-body text-center">

                                    <i class="fas fa-file-pdf fa-3x text-danger mb-3"></i>

                                    <h6 class="font-weight-bold">
                                        {{ $item->judul }}
                                    </h6>

                                    <small class="text-muted">
                                        Tahun: {{ $item->tahun }}
                                    </small>

                                    <br>

                                    <small class="text-muted">
                                        Upload: {{ $item->created_at->format('d M Y') }}
                                    </small>

                                    <hr>

                                    <button class="btn btn-info btn-sm mb-2" data-toggle="collapse"
                                        data-target="#preview{{ $item->id }}">

                                        <i class="fas fa-eye"></i> Preview

                                    </button>

                                    <br>

                                    <a href="{{ asset('storage/' . $item->file) }}" class="btn btn-success btn-sm"
                                        target="_blank">

                                        <i class="fas fa-download"></i>

                                    </a>

                                    <form action="{{ route('surat_tugas_monev.destroy', $item->id) }}" method="POST"
                                        style="display:inline">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Hapus dokumen ini?')">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </form>

                                </div>

                                <div id="preview{{ $item->id }}" class="collapse">

                                    <iframe src="{{ asset('storage/' . $item->file) }}" width="100%" height="400px">
                                    </iframe>

                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>

                <div class="mt-3">
                    {{ $data->links() }}
                </div>
            @else
                <div class="alert alert-info text-center">
                    Belum ada dokumen Surat Tugas Monev
                </div>
            @endif

        </div>

    </div>



    {{-- MODAL UPLOAD --}}

    <div class="modal fade" id="modalUpload">

        <div class="modal-dialog">

            <div class="modal-content">

                <form action="{{ route('surat_tugas_monev.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="modal-header">

                        <h5 class="modal-title">
                            Upload Surat Tugas Monev
                        </h5>

                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>

                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Judul Dokumen</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Tahun</label>
                            <input type="number" name="tahun" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Upload File PDF</label>
                            <input type="file" name="file" class="form-control" required>
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit" class="btn btn-primary">
                            Upload
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
