@extends('layouts.app')

@section('content')
    <div class="container">

        <h4>Upload Dokumen KPM & GPM</h4>

        <form action="{{ route('kpm_gpm.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="mb-3">

                <label>Judul</label>

                <input type="text" name="judul" class="form-control">

            </div>

            <div class="mb-3">

                <label>Upload File PDF</label>

                <input type="file" name="file" class="form-control">

            </div>

            <button class="btn btn-success">

                Upload

            </button>

        </form>
    </div>
@endsection
