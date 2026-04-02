@extends('layouts.app')

@section('content')
    <div class="container">

        <h4>Upload Surat Tugas Monev</h4>

        <form action="{{ route('surat_tugas_monev.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="mb-3">

                <label>Judul</label>

                <input type="text" name="judul" class="form-control" required>

            </div>

            <div class="mb-3">

                <label>Tahun</label>

                <input type="number" name="tahun" class="form-control" required>

            </div>

            <div class="mb-3">

                <label>Upload File PDF</label>

                <input type="file" name="file" class="form-control" required>

            </div>

            <button class="btn btn-success">

                Upload

            </button>

            <a href="{{ route('surat_tugas_monev.index') }}" class="btn btn-secondary">

                Kembali

            </a>

        </form>

    </div>
@endsection
