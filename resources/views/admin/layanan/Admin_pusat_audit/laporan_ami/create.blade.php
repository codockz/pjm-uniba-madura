@extends('layouts.app')

@section('content')
    <div class="container">


        <h4 class="mb-4">Tambah Laporan AMI</h4>
        <form action="{{ route('laporan_ami.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="mb-3">
                <label>Judul</label>
                <input type="text" name="judul" class="form-control">
            </div>

            <div class="mb-3">
                <label>Tahun</label>
                <input type="number" name="tahun" class="form-control">
            </div>

            <div class="mb-3">
                <label>Upload Cover</label>
                <input type="file" name="cover" class="form-control">
            </div>

            <div class="mb-3">
                <label>Upload PDF</label>
                <input type="file" name="file" class="form-control">
            </div>

            <button class="btn btn-primary">
                Simpan
            </button>

        </form>


    </div>
@endsection
