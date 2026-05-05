@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        {{-- 🔥 BUTTON TAMBAH --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-3">Sidebar Kategori</h3>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm">
                + Tambah Kategori
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                <div class="table-responsive">
                    <table id="tableSidebar" class="table table-bordered table-hover align-middle text-center">

                        <thead class="bg-primary text-white">
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama</th>
                                <th>Urutan</th>
                                <th>Status</th>
                                <th width="20%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td class="text-start">{{ $d->nama_kategori }}</td>

                                    <td>{{ $d->urutan }}</td>

                                    <td>
                                        <span class="badge bg-{{ $d->is_active ? 'success' : 'danger' }}">
                                            {{ $d->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>

                                    <td>

                                        {{-- EDIT --}}
                                        <button class="btn btn-warning btn-sm btn-edit" data-id="{{ $d->id }}"
                                            data-nama="{{ $d->nama_kategori }}" data-urutan="{{ $d->urutan }}"
                                            data-status="{{ $d->is_active }}">
                                            <i class="fas fa-pen"></i>
                                        </button>

                                        {{-- DELETE --}}
                                        <form action="{{ route('sidebar-category.destroy', $d->id) }}" method="POST"
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
    </div>



    {{-- 🔥 MODAL --}}
    <div class="modal fade" id="modalForm" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Kategori</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form id="formKategori" method="POST">
                    @csrf
                    <div id="methodField"></div>

                    <div class="modal-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @endif
                        <div class="mb-3">
                            <label>Nama Kategori</label>
                            <input type="text" name="nama_kategori" id="nama_kategori" class="form-control"
                                placeholder="Contoh: E-Survey" required>
                        </div>

                        <div class="mb-3">
                            <label>Urutan</label>
                            <input type="number" name="urutan" id="urutan"
                                class="form-control @error('urutan') is-invalid @enderror" value="0">
                        </div>

                        <div class="mb-3">
                            <label>Status</label>
                            <select name="is_active" id="is_active" class="form-control">
                                <option value="1">Aktif</option>
                                <option value="0">Nonaktif</option>
                            </select>
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
            const form = document.getElementById('formKategori');
            const title = document.getElementById('modalTitle');

            // TAMBAH
            document.querySelector('[data-bs-target="#modalForm"]').addEventListener('click', function() {
                form.action = "{{ route('sidebar-category.store') }}";
                title.innerText = "Tambah Kategori";

                form.reset();
                document.getElementById('methodField').innerHTML = '';
            });

            // EDIT
            document.querySelectorAll('.btn-edit').forEach(btn => {
                btn.addEventListener('click', function() {

                    const id = this.dataset.id;

                    form.action = "/admin/sidebar-category/" + id;
                    title.innerText = "Edit Kategori";

                    document.getElementById('nama_kategori').value = this.dataset.nama;
                    document.getElementById('urutan').value = this.dataset.urutan;
                    document.getElementById('urutan').defaultValue = this.dataset.urutan;
                    document.getElementById('is_active').value = this.dataset.status;

                    document.getElementById('methodField').innerHTML =
                        '<input type="hidden" name="_method" value="PUT">';

                    modal.show();
                });
            });

        });
    </script>
    <script>
        document.getElementById('formKategori').addEventListener('submit', function(e) {

            let urutanInput = document.getElementById('urutan');
            let urutan = urutanInput.value;

            let duplicate = false;

            let isEdit = document.querySelector('input[name="_method"]');

            document.querySelectorAll('#tableSidebar tbody tr').forEach(row => {
                let urutanText = row.children[2].innerText.trim();

                // skip data lama saat edit
                if (isEdit && urutanText == urutanInput.defaultValue) {
                    return;
                }

                if (urutanText == urutan) {
                    duplicate = true;
                }
            });

            if (duplicate) {
                e.preventDefault();

                urutanInput.classList.add('is-invalid');

                let errorDiv = urutanInput.parentNode.querySelector('.text-danger');

                if (!errorDiv) {
                    let div = document.createElement('div');
                    div.className = 'text-danger small';
                    div.innerText = 'Urutan sudah digunakan!';
                    urutanInput.parentNode.appendChild(div);
                }
            }
        });
    </script>
    <script>
        document.getElementById('urutan').addEventListener('input', function() {
            this.classList.remove('is-invalid');

            let error = this.parentNode.querySelector('.text-danger');
            if (error) error.remove();
        });
    </script>
    <script>
        document.getElementById('modalForm').addEventListener('hidden.bs.modal', function() {

            document.getElementById('formKategori').reset();

            document.querySelectorAll('#modalForm .is-invalid').forEach(el => {
                el.classList.remove('is-invalid');
            });

            document.querySelectorAll('#modalForm .text-danger').forEach(el => {
                el.remove();
            });

        });
    </script>
    @push('scripts')
        <script>
            $(function() {
                $("#tableSidebar").DataTable({
                    responsive: true,
                    autoWidth: false,
                    pageLength: 10,
                    ordering: false
                });
            });
        </script>
    @endpush
    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var modal = new bootstrap.Modal(document.getElementById('modalForm'));
                modal.show();
            });
        </script>
    @endif
@endsection
