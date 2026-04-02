@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <h4 class="mb-4">Tambah Tahap Siklus SPMI</h4>

        <div class="card shadow-sm">

            <div class="card-body">

                <form action="{{ route('admin.siklus-spmi.store') }}" method="POST">

                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="urutan" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Tahap</label>
                        <input type="text" name="nama_tahap" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="5" required></textarea>
                    </div>
                    <button class="btn btn-primary">
                        Simpan
                    </button>
                    <a href="{{ route('admin.siklus-spmi.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
