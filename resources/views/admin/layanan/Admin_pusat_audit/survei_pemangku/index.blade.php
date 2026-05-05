@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Data Survei Pemangku Kepentingan</h3>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
                + Tambah Data
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                @if ($data->count() > 0)
                    <div class="table-responsive">
                        <table id="tableSurvei" class="table table-bordered table-hover align-middle text-center">

                            <thead class="bg-primary text-white">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Pengisi</th>
                                    <th>Survei Kepuasan Pemangku Kepentingan</th>
                                    <th>Survei Evaluasi dan Pemahaman Visi Misi Tujuan dan Strategi</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td class="text-start">{{ $item->pengisi }}</td>

                                        <td>
                                            @if ($item->link_kepuasan)
                                                <a href="{{ $item->link_kepuasan }}" target="_blank">
                                                    {{ $item->kepuasan_text ?? 'Lihat Survei' }}
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>

                                        <td>
                                            @if ($item->link_evaluasi)
                                                <a href="{{ $item->link_evaluasi }}" target="_blank">
                                                    {{ $item->evaluasi_text ?? 'Isi Form' }}
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

                                            <form action="{{ route('admin.survei_pemangku.destroy', $item->id) }}"
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
                        Belum ada data survei.
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
                    <h5 class="modal-title">Tambah Survei</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('admin.survei_pemangku.store') }}" method="POST">
                    @csrf

                    <div class="modal-body">

                        <div class="mb-3">
                            <label>Pengisi</label>
                            <input type="text" name="pengisi" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Judul Survei Kepuasan</label>
                            <input type="text" name="kepuasan_text" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Link Survei Kepuasan</label>
                            <input type="url" name="link_kepuasan" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Judul Survei Evaluasi</label>
                            <input type="text" name="evaluasi_text" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Link Survei Evaluasi (Google Form)</label>
                            <input type="url" name="link_evaluasi" class="form-control">
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
                        <h5 class="modal-title">Edit Survei</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="{{ route('admin.survei_pemangku.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">

                            <div class="mb-3">
                                <label>Pengisi</label>
                                <input type="text" name="pengisi" value="{{ $item->pengisi }}" class="form-control"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label>Judul Kepuasan</label>
                                <input type="text" name="kepuasan_text" value="{{ $item->kepuasan_text }}"
                                    class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Link Kepuasan</label>
                                <input type="url" name="link_kepuasan" value="{{ $item->link_kepuasan }}"
                                    class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Judul Evaluasi</label>
                                <input type="text" name="evaluasi_text" value="{{ $item->evaluasi_text }}"
                                    class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Link Evaluasi</label>
                                <input type="url" name="link_evaluasi" value="{{ $item->link_evaluasi }}"
                                    class="form-control">
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
                $("#tableSurvei").DataTable({
                    responsive: true,
                    autoWidth: false,
                    pageLength: 10,
                    ordering: false
                });
            });
        </script>
    @endpush

@endsection
