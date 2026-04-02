@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 font-weight-bold">Daftar Asesor BKD</h4>
                <small class="text-muted">Manajemen data asesor universitas</small>
            </div>
            <div>
                <button type="button" class="btn btn-primary btn-sm shadow-sm" data-toggle="modal"
                    data-target="#modalTambahAsesor">
                    <i class="fas fa-plus mr-1"></i> Tambah Data
                </button>
            </div>
        </div>
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <form id="filterForm" action="{{ route('admin.daftar_asesor_bkd.index') }}" method="GET">
                    <div class="row align-items-end">

                        {{-- Search --}}
                        <div class="col-md-3">
                            <label class="small text-muted">Cari Data</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white">
                                        <i class="fas fa-search text-muted"></i>
                                    </span>
                                </div>
                                <input type="text" name="search" class="form-control" placeholder="Nama / NIRA"
                                    value="{{ request('search') }}">
                            </div>
                        </div>

                        {{-- Program Studi --}}
                        <div class="col-md-3">
                            <label class="small text-muted">Program Studi</label>
                            <select name="program_studi" class="form-control">
                                <option value="">Semua Program Studi</option>
                                @foreach ($listProgramStudi as $prodi)
                                    <option value="{{ $prodi->id }}"
                                        {{ request('program_studi') == $prodi->id ? 'selected' : '' }}>
                                        {{ $prodi->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Periode --}}
                        <div class="col-md-2">
                            <label class="small text-muted">Periode</label>
                            <select name="periode" class="form-control">
                                <option value="">Semua Periode</option>
                                @foreach ($listPeriode as $prd)
                                    <option value="{{ $prd }}" {{ request('periode') == $prd ? 'selected' : '' }}>
                                        {{ $prd }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Button --}}
                        <div class="col-md-3">
                            <a href="{{ route('admin.daftar_asesor_bkd.index') }}" class="btn btn-light shadow-sm">
                                Reset
                            </a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body py-3">
                <div class="d-flex justify-content-between align-items-center text-center">

                    <div class="flex-fill">
                        <div class="text-muted small">Total Data Dosen</div>
                        <div class="h5 mb-0 font-weight-bold">
                            {{ $totalAsesor }}
                        </div>
                    </div>

                    <div class="border-left mx-3" style="height:40px;"></div>

                    <div class="flex-fill">
                        <div class="text-muted small">Aktif</div>
                        <div class="h5 mb-0 text-success font-weight-bold">
                            {{ $aktif }}
                        </div>
                    </div>

                    <div class="border-left mx-3" style="height:40px;"></div>

                    <div class="flex-fill">
                        <div class="text-muted small">Tidak Aktif</div>
                        <div class="h5 mb-0 text-secondary font-weight-bold">
                            {{ $nonAktif }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="card shadow-sm">
    <div class="card-body">

        {{-- ================= SHOW ENTRIES ================= --}}
        <div class="d-flex align-items-center mb-3">
            <form method="GET"
                action="{{ route('admin.daftar_asesor_bkd.index') }}"
                class="d-flex align-items-center">

                {{-- supaya filter tidak hilang --}}
                <input type="hidden" name="search" value="{{ request('search') }}">
                <input type="hidden" name="program_studi" value="{{ request('program_studi') }}">
                <input type="hidden" name="periode" value="{{ request('periode') }}">

                <span class="mr-2">Tampilkan</span>

                <select name="per_page"
                        class="form-control form-control-sm mx-2"
                        onchange="this.form.submit()">
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                </select>

                <span>entri</span>
            </form>
        </div>
        {{-- ================= TABEL ================= --}}
        <div class="table-responsive" id="tableData">
            @include('admin.layanan.admin_pusat_pengembangan.daftar_asesor_bkd.partials.table')
        </div>


    </div>
</div>
    </div>
    <!-- Modal Tambah Asesor -->
    <div class="modal fade" id="modalTambahAsesor" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header bg-primary">
                    <h5 class="modal-title">Tambah Asesor BKD</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <form action="{{ route('admin.daftar_asesor_bkd.store') }}" method="POST">
                    @csrf

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Nama Dosen</label>
                            <input type="text" name="nama_dosen" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>NIRA</label>
                            <input type="text" name="nira" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Program Studi</label>
                            <select name="program_studi" class="form-control" required>
                                <option value="">Pilih Program Studi</option>
                                @foreach ($listProgramStudi as $prodi)
                                    <option value="{{ $prodi->id }}"
                                        {{ request('program_studi') == $prodi->id ? 'selected' : '' }}>
                                        {{ $prodi->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Periode</label>
                            <input type="text" name="periode" placeholder="2025-2027" class="form-control" required>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Tutup
                        </button>

                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!-- Modal Edit Asesor -->
    <div class="modal fade" id="modalEditAsesor" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header bg-warning">
                    <h5 class="modal-title">Edit Asesor BKD</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <form id="formEdit" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Nama Dosen</label>
                            <input type="text" name="nama_dosen" id="edit_nama" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>NIRA</label>
                            <input type="text" name="nira" id="edit_nira" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Program Studi</label>
                            <select name="program_studi" id="edit_prodi" class="form-control" required>
                                @foreach ($listProgramStudi as $prodi)
                                    <option value="{{ $prodi->id }}">
                                        {{ $prodi->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Periode</label>
                            <input type="text" name="periode" id="edit_periode" class="form-control" required>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Tutup
                        </button>

                        <button type="submit" class="btn btn-warning">
                            Update
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <script>
        document.addEventListener('click', function(e) {
            if (e.target.closest('.btn-edit')) {

                let button = e.target.closest('.btn-edit');

                let id = button.dataset.id;
                let nama = button.dataset.nama;
                let nira = button.dataset.nira;
                let prodi = button.dataset.prodi;
                let periode = button.dataset.periode;

                document.getElementById('edit_nama').value = nama;
                document.getElementById('edit_nira').value = nira;
                document.getElementById('edit_prodi').value = prodi;
                document.getElementById('edit_periode').value = periode;

                document.getElementById('formEdit').action =
                    "/admin/daftar-asesor-bkd/" + id;
            }
        });
    </script>
@endsection
