@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <h3 class="mb-4">Tambah Data Auditor Internal</h3>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.auditor_internal.store') }}" method="POST">
                @csrf

                <div class="row">

                    {{-- Nama Auditor --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Auditor</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>

                    {{-- Fakultas / Lembaga --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Fakultas / Lembaga</label>
                        <input type="text" name="fakultas" class="form-control" required>
                    </div>

                </div>

                <div class="d-flex justify-content-end mt-3">

                    <a href="{{ route('admin.auditor_internal.index') }}" class="btn btn-secondary me-2">
                        Batal
                    </a>

                    <button class="btn btn-primary">
                        Simpan
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection
