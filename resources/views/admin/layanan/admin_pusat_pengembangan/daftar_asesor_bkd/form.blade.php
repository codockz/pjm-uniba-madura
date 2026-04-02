@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row mb-3">
        <div class="col-md-6">
            <h4>Edit Asesor BKD</h4>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('admin.daftar_asesor_bkd.index') }}" class="btn btn-secondary btn-sm">
                Kembali
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.daftar_asesor_bkd.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label>Nama Dosen</label>
                    <input type="text" name="nama_dosen" class="form-control"
                           value="{{ old('nama_dosen', $data->nama_dosen) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label>NIRA</label>
                    <input type="text" name="nira" class="form-control"
                           value="{{ old('nira', $data->nira) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label>Program Studi</label>
                    <input type="text" name="program_studi" class="form-control"
                           value="{{ old('program_studi', $data->program_studi) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label>Periode</label>
                    <input type="text" name="periode" class="form-control"
                           value="{{ old('periode', $data->periode) }}" required>
                </div>

                <button type="submit" class="btn btn-primary">
                    Update Data
                </button>

            </form>

        </div>
    </div>

</div>
@endsection
