@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-3">Sidebar Item</h3>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm">
                + Tambah Item
            </button>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">

            {{-- FILTER --}}
            <div class="d-flex gap-2">

                <select id="filterKategori" class="form-control">
                    <option value="">Semua Kategori</option>
                    @foreach ($kategori as $k)
                        <option value="{{ $k->nama_kategori }}">
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>

                {{-- <select id="filterStatus" class="form-control">
            <option value="">Semua Status</option>
            <option value="Aktif">Aktif</option>
            <option value="Tidak Aktif">Tidak Aktif</option>
        </select> --}}

            </div>

        </div>
        {{-- TABLE --}}
        <div class="card shadow-sm">
            <div class="card-body">

                <div class="table-responsive">
                    <table id="tableSidebarItem" class="table table-bordered table-hover align-middle text-center">

                        <thead class="bg-primary text-white">
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Judul</th>
                                <th>Link</th>
                                <th>Urutan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $d->category->nama_kategori ?? '-' }}</td>

                                    <td class="text-start">{{ $d->judul }}</td>

                                    <td>
                                        @if ($d->link)
                                            <a href="{{ $d->link }}" target="_blank">Link</a>
                                        @else
                                            -
                                        @endif
                                    </td>

                                    <td>{{ $d->urutan }}</td>

                                    <td>
                                        <span class="badge bg-{{ $d->is_active ? 'success' : 'danger' }}">
                                            {{ $d->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>

                                    <td>
                                        {{-- EDIT --}}
                                        <button class="btn btn-warning btn-sm btn-edit" data-id="{{ $d->id }}"
                                            data-kategori="{{ $d->category_id }}" data-judul="{{ $d->judul }}"
                                            data-link="{{ $d->link }}" data-urutan="{{ $d->urutan }}"
                                            data-status="{{ $d->is_active }}">
                                            <i class="fas fa-pen"></i>
                                        </button>

                                        {{-- DELETE --}}
                                        <form action="{{ route('sidebar-item.destroy', $d->id) }}" method="POST"
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

            </div>
        </div>

    </div>


    {{-- 🔥 MODAL --}}
    <div class="modal fade" id="modalForm" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Item</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form id="formItem" method="POST">
                    @csrf
                    <div id="methodField"></div>

                    <div class="modal-body">

                        <div class="row">

                            {{-- KATEGORI --}}
                            <div class="col-md-6 mb-3">
                                <label>Kategori</label>
                                <select name="category_id" id="kategori" class="form-control" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($kategori as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- JUDUL --}}
                            <div class="col-md-6 mb-3">
                                <label>Judul</label>
                                <input type="text" name="judul" id="judul" class="form-control" required>
                            </div>

                            {{-- LINK --}}
                            <div class="col-md-6 mb-3">
                                <label>Link (optional)</label>
                                <input type="text" name="link" id="link" class="form-control">
                            </div>

                            {{-- URUTAN --}}
                            <div class="col-md-3 mb-3">
                                <label>Urutan</label>
                                <input type="number" name="urutan" id="urutan"
                                    class="form-control @error('urutan') is-invalid @enderror" value="0">

                                @error('urutan')
                                    <div class="text-danger small">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- STATUS --}}
                            <div class="col-md-3 mb-3">
                                <label>Status</label>
                                <select name="is_active" id="is_active" class="form-control">
                                    <option value="1">Aktif</option>
                                    <option value="0">Nonaktif</option>
                                </select>
                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button class="btn btn-primary">Simpan</button>
                    </div>

                </form>

            </div>
        </div>
    </div>


    {{-- 🔥 SCRIPT --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const modal = new bootstrap.Modal(document.getElementById('modalForm'));
            const form = document.getElementById('formItem');
            const title = document.getElementById('modalTitle');

            // TAMBAH
            document.querySelector('[data-bs-target="#modalForm"]').addEventListener('click', function() {
                form.action = "{{ route('sidebar-item.store') }}";
                title.innerText = "Tambah Item";

                form.reset();
                document.getElementById('methodField').innerHTML = '';
            });

            // EDIT
            document.querySelectorAll('.btn-edit').forEach(btn => {
                btn.addEventListener('click', function() {

                    const id = this.dataset.id;

                    form.action = "/admin/sidebar-item/" + id;
                    title.innerText = "Edit Item";

                    document.getElementById('kategori').value = this.dataset.kategori;
                    document.getElementById('judul').value = this.dataset.judul;
                    document.getElementById('link').value = this.dataset.link;
                    document.getElementById('urutan').value = this.dataset.urutan;
                    document.getElementById('is_active').value = this.dataset.status;

                    document.getElementById('methodField').innerHTML =
                        '<input type="hidden" name="_method" value="PUT">';

                    modal.show();
                });
            });

        });
    </script>


    @push('scripts')
        <script>
            $(function() {

                let table = $("#tableSidebarItem").DataTable({
                    responsive: true,
                    autoWidth: false,
                    pageLength: 10,
                    ordering: false
                });

                // 🔍 FILTER KATEGORI
                $('#filterKategori').on('change', function() {
                    table.column(1).search(this.value).draw();
                });

                // // 🔍 FILTER STATUS
                // $('#filterStatus').on('change', function () {
                //     table.column(5).search(this.value).draw();
                // });

            });
        </script>
        <script>
            
        <script>
            document.getElementById('urutan').addEventListener('input', function() {
                this.classList.remove('is-invalid');

                let error = this.parentNode.querySelector('.text-danger');
                if (error) error.remove();
            });
        </script>
        <script>
            document.getElementById('modalForm').addEventListener('hidden.bs.modal', function() {

                // reset form
                document.getElementById('formItem').reset();

                // hapus semua error class
                document.querySelectorAll('.is-invalid').forEach(el => {
                    el.classList.remove('is-invalid');
                });

                // hapus semua pesan error
                document.querySelectorAll('#modalForm .text-danger').forEach(el => {
                    el.remove();
                });

            });
        </script>
    @endpush
@endsection
