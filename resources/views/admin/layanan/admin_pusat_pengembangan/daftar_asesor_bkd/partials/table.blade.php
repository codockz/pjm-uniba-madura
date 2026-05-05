<div class="card shadow-sm border-0">
    <div class="card-body p-0">

        <div class="table-responsive">
            <table id="asesorTable" class="table table-bordered table-hover align-middle text-center">
                <thead class="bg-primary text-white text-uppercase small">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Dosen</th>
                        <th>NIRA</th>
                        <th>Program Studi</th>
                        <th>Periode</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $data->firstItem() + $loop->index }}</td>
                            <td>{{ $item->nama_dosen }}</td>
                            <td>{{ $item->nira }}</td>
                            <td>{{ $item->programStudi->nama ?? '-' }}</td>
                            <td>
                                @php
                                    $currentYear = date('Y');
                                    $periodeParts = explode('-', $item->periode);
                                    $end = $periodeParts[1] ?? $periodeParts[0];
                                    $warna = $end >= $currentYear ? 'success' : 'secondary';
                                @endphp
                                <span class="badge badge-pill badge-{{ $warna }} px-3 py-1">
                                    {{ $item->periode }}
                                </span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm mr-1 btn-edit"
                                    data-id="{{ $item->id }}" data-nama="{{ $item->nama_dosen }}"
                                    data-nira="{{ $item->nira }}" data-prodi="{{ $item->program_studi_id }}"
                                    data-periode="{{ $item->periode }}" data-toggle="modal"
                                    data-target="#modalEditAsesor">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <form action="{{ route('admin.daftar_asesor_bkd.destroy', $item->id) }}" method="POST"
                                    style="display:inline-block;"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
        </div> {{-- tutup table-responsive --}}

        @if ($data->count())
            <div class="d-flex justify-content-between align-items-center px-3 py-3">
                <small class="text-muted">
                    Menampilkan {{ $data->firstItem() }}–{{ $data->lastItem() }}
                    dari {{ $data->total() }} entri
                </small>

                {{ $data->links() }}
            </div>
        @else
            <div class="p-3 text-center text-muted">
                Tidak ada data
            </div>
        @endif

    </div>
</div>
