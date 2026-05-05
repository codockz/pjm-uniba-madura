@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Data SK Akreditasi Program Studi</h3>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
                + Tambah Data
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                @if ($data->count() > 0)
                    <div class="table-responsive">
                        <table id="tableSk" class="table table-bordered table-hover align-middle text-center">

                            <thead class="bg-primary text-white">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Program Studi</th>
                                    <th>Jenjang</th>
                                    <th>SK Izin</th>
                                    <th>Akreditasi</th>
                                    <th>SK Akreditasi</th>
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

                                        <td class="text-start">{{ $item->program_studi }}</td>

                                        <td>{{ $item->jenjang }}</td>

                                        <td>
                                            @if ($item->sk_izin_text)
                                                <a href="{{ asset('storage/' . $item->file_sk_izin) }}" target="_blank">
                                                    {{ $item->sk_izin_text }}
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-success">{{ $item->akreditasi }}</span>
                                        </td>
                                        <td>
                                            @if ($item->sk_akreditasi_text)
                                                <a href="{{ asset('storage/' . $item->file_sk_akreditasi) }}"
                                                    target="_blank">
                                                    {{ $item->sk_akreditasi_text }}
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                           <td>
    {{ $item->berlaku ?? '-' }}
</td>

<td>
    {{ $item->kadaluarsa ?? '-' }}
</td>
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

                                            <form action="{{ route('admin.sk_akreditasi_prodi.destroy', $item->id) }}"
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
                        Belum ada data SK Akreditasi Program Studi.
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
                    <h5 class="modal-title">Tambah SK Akreditasi</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('admin.sk_akreditasi_prodi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">

                        <div class="mb-3">
                            <label>Program Studi</label>
                            <input type="text" name="program_studi" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Jenjang</label>
                            <input type="text" name="jenjang" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>SK Izin (Teks)</label>
                            <input type="text" name="sk_izin_text" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>File SK Izin (PDF)</label>
                            <input type="file" name="file_sk_izin" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Akreditasi</label>
                            <input type="text" name="akreditasi" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>SK Akreditasi (Teks)</label>
                            <input type="text" name="sk_akreditasi_text" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>File SK Akreditasi (PDF)</label>
                            <input type="file" name="file_sk_akreditasi" class="form-control">
                        </div>
                        <div class="mb-3">
                        <label>Tanggal Berlaku</label>
                         <input type="date" name="berlaku" class="form-control">
                        </div>

                        <div class="mb-3">
                       <label>Tanggal Kadaluarsa</label>
                         <input type="date" name="kadaluarsa" class="form-control">
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

    {{-- ================= MODAL EDIT ================= --}}
    @foreach ($data as $item)
        <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Edit SK Akreditasi</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="{{ route('admin.sk_akreditasi_prodi.update', $item->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">

                            <div class="mb-3">
                                <label>Program Studi</label>
                                <input type="text" name="program_studi" value="{{ $item->program_studi }}"
                                    class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Jenjang</label>
                                <input type="text" name="jenjang" value="{{ $item->jenjang }}" class="form-control"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label>SK Izin (Teks)</label>
                                <input type="text" name="sk_izin_text" value="{{ $item->sk_izin_text }}"
                                    class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>File SK Izin (PDF)</label>
                                <input type="file" name="file_sk_izin" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Akreditasi</label>
                                <input type="text" name="akreditasi" value="{{ $item->akreditasi }}"
                                    class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>SK Akreditasi (Teks)</label>
                                <input type="text" name="sk_akreditasi_text" value="{{ $item->sk_akreditasi_text }}"
                                    class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>File SK Akreditasi (PDF)</label>
                                <input type="file" name="file_sk_akreditasi" class="form-control">
                            </div>

                            <div class="mb-3">
                            <label>Tanggal Berlaku</label>
                          <input type="date" name="berlaku" value="{{ $item->berlaku }}" class="form-control">
</div>

<div class="mb-3">
    <label>Tanggal Kadaluarsa</label>
    <input type="date" name="kadaluarsa" value="{{ $item->kadaluarsa }}" class="form-control">
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
                $("#tableSk").DataTable({
                    responsive: true,
                    autoWidth: false,
                    pageLength: 10,
                    ordering: false
                });
            });
        </script>
    @endpush

@endsection
