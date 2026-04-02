@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-4">

                <h4 class="mb-4 fw-bold">Tambah Asesor BKD</h4>

                <form id="formAsesor" action="{{ route('admin.daftar_asesor_bkd.store') }}" method="POST">
                    @csrf

                    {{-- Nama Dosen --}}
                    <div class="form-group-modern mb-3">
                        <label>Nama Dosen</label>
                        <input type="text" name="nama_dosen" class="form-control form-control-modern"
                            value="{{ old('nama_dosen') }}" required>

                        @error('nama_dosen')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- NIRA --}}
                    <div class="form-group-modern mb-3">
                        <label>NIRA</label>
                        <input type="number" name="nira" class="form-control form-control-modern"
                            value="{{ old('nira') }}" required>

                        @error('nira')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    
                    {{-- Program Studi --}}
                    <div class="form-group-modern mb-3">
                        <label>Program Studi</label>

                        <select name="program_studi" class="form-select form-control-modern" required>
                            <option value="">-- Pilih Program Studi --</option>

                            @foreach ($listProgramStudi as $prodi)
                                <option value="{{ $prodi->id }}"
                                    {{ old('program_studi') == $prodi->id ? 'selected' : '' }}>
                                    {{ $prodi->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('program_studi')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Periode --}}
                    <div class="form-group-modern mb-4">
                        <label>Periode</label>
                        <input type="text" name="periode" class="form-control form-control-modern"
                            value="{{ old('periode') }}" placeholder="Contoh: 2024" required>

                        @error('periode')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4 rounded-2">
                            Simpan
                        </button>

                        <a href="{{ route('admin.daftar_asesor_bkd.index') }}"
                            class="btn btn-outline-secondary px-4 rounded-2">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const form = document.getElementById("formAsesor");
            const inputs = form.querySelectorAll("input, select");

            function showError(input, message) {
                input.classList.add("input-error");

                let error = input.parentElement.querySelector(".error-text");
                if (!error) {
                    error = document.createElement("div");
                    error.classList.add("error-text");
                    input.parentElement.appendChild(error);
                }

                error.innerText = message;
            }

            function clearError(input) {
                input.classList.remove("input-error");
                let error = input.parentElement.querySelector(".error-text");
                if (error) error.remove();
            }

            inputs.forEach(input => {

                input.addEventListener("input", function() {

                    if (input.name === "nira") {
                        input.value = input.value.replace(/[^0-9]/g, '');
                    }

                    if (input.name === "periode") {
                        input.value = input.value.replace(/[^0-9-]/g, '');
                    }

                    if (input.value.trim() === "") {
                        showError(input, "Field ini wajib diisi");
                    } else {
                        clearError(input);
                    }

                });

            });
            form.addEventListener("submit", function(e) {
                let valid = true;
                inputs.forEach(input => {
                    if (input.value.trim() === "") {
                        showError(input, "Field ini wajib diisi");
                        valid = false;
                    }
                });

                if (!valid) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endsection
