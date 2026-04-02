@extends('layouts.app')
@section('content')
    <style>
        .error {
            color: red;
            font-size: 12px;
        }

        #btn_add[disabled] {
            opacity: 0.65;
            cursor: not-allowed;
        }

        table.dataTable td.custom-width {
            width: 2%;
            /* Or any specific width value */
        }

        table.dataTable td.custom-width-1 {
            width: 15%;
            /* Or any specific width value */
        }

        table.dataTable td.custom-width-2 {
            width: 20%;
            /* Or any specific width value */
        }
        table.dataTable td.custom-width-3 {
            width: 20%;
            /* Or any specific width value */
        }
        table.dataTable td.custom-width-4 {
            width: 5%;
            text-align: center;

            /* Or any specific width value */
        }
        table.dataTable td.custom-width-5 {
            width: 10%;
            /* Or any specific width value */
        }
    </style>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="toastContainer"></div>
    </div>

    <div class="container-fluid" id="container-wrapper">
        <!-- Row -->
        <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Divisi</h3>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal"
                            data-target="#tmbhModal">
                            + Tambah Data Divisi
                        </button>
                        {{-- <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal"
                            data-target="#modal_sub_kategori_divisi">
                            + Tambah Data Kategori Divisi
                        </button> --}}
                        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal"
                            data-target="#modal_anggota_divisi">
                            + Tambah Data Anggota Divisi
                        </button>
                        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal"
                            data-target="#modal-xl">
                             Data Kategori Divisi
                        </button>
                        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal"
                            data-target="#modal-xl-anggota_divisi">
                             Data Anggota Divisi
                        </button>

                        <table id="example1" class="table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Nama Anggota Divisi</th>
                                    <th>Isi</th>
                                    <th>Foto</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="add_new">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Nama Anggota Divisi</th>
                                    <th>Isi</th>
                                    <th>Foto</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <!-- DataTable with Hover -->
        </div>
    </div>

    <div class="modal fade" id="tmbhModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah divisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tmbh_form" class="row">
                    @csrf
                    <div class="form-group col-6">
                        <label for="select_kategori_divisi">Kategori divisi</label>
                        <select class="form-control select_kategori_divisi" id="select_kategori_divisi" name="select_kategori_divisi">
                            <option selected disabled>-- Pilih Kategori --</option>
                            @foreach ($selectsubkategori as $x)
                            <option value="{{ $x->id }}">{{ $x->nama_kategori }} - {{ $x->sub_kategori_divisi }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="select_kategori_divisi-error">

                        </div>
                    </div>

                    <div class="form-group col-6">
                        <label for="anggota_divisi_id">Anggota Divisi</label>
                        <select class="form-control anggota_divisi_id" id="anggota_divisi_id" name="anggota_divisi_id">
                            <option selected disabled>-- Pilih Anggota Divisi --</option>
                            @foreach ($anggota_divisi as $x)
                            <option value="{{ $x->id }}">{{ $x->nama_anggota }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="anggota_divisi_id-error">

                        </div>
                    </div>
                    <div class="form-group col-12">
                        <div class="view"></div>
                    </div>
                    <div class="form-group col-12">
                        <label for="isi">Isi</label>
                        <textarea name="isi" id="isi" rows="3" class="form-control"></textarea>
                        <div class="invalid-feedback" id="isi-error">

                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" id="kembali" data-dismiss="modal">Kembali</button>
            </div>
            </form>
        </div>
        </div>
   </div>

    <div class="modal fade" id="modal_kategori_divisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_form_kategori_divisi" class="row">
                        @csrf
                        <div class="form-group col-12">
                            <label for="nama_kategori">Kategori divisi</label>
                            <input name="nama_kategori" id="nama_kategori" class="form-control">
                            <div class="invalid-feedback" id="nama_kategori-error">

                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="kembali_kategori">Kembali</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal_sub_kategori_divisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_form_sub_kategori_divisi" class="row">
                        @csrf
                        <div class="form-group col-12">
                            <label for="add_select_kategori_divisi"> Kategori divisi</label>
                            <select class="form-control add_select_kategori_divisi" id="add_select_kategori_divisi" name="add_select_kategori_divisi">
                                <option selected disabled>-- Pilih Kategori --</option>
                                @foreach ($kategori as $x)
                                <option value="{{ $x->id }}">{{ $x->nama_kategori }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="add_select_kategori_divisi-error">

                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="sub_kategori_divisi">Sub Kategori divisi</label>
                            <input name="sub_kategori_divisi" id="sub_kategori_divisi" class="form-control">
                            <div class="invalid-feedback" id="sub_kategori_divisi-error">

                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="kembali_kategori">Kembali</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_anggota_divisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_form_anggota_divisi" class="row">
                    @csrf
                    <div class="form-group col-12">
                        <label for="nama_anggota">Nama Anggota Divisi</label>
                        <input name="nama_anggota" id="nama_anggota" class="form-control">
                        <div class="invalid-feedback" id="nama_anggota-error">

                        </div>
                    </div>
                    <div class="form-group col-sm-8">
                        <label for="">Foto</label>
                        <input type="file" class="form-control" name="foto" id="foto"
                            onchange="document.getElementById('ba').src = window.URL.createObjectURL(this.files[0])">
                        <div class="invalid-feedback " id='foto-error'>

                        </div>
                    </div>
                    <div class="form-group col-sm-4 mb-2">
                        <img src="https://png.pngtree.com/png-vector/20190710/ourmid/pngtree-user-vector-avatar-png-image_1541962.jpg"
                            id="ba" alt="your image" width="100" height="100">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" id="kembali" data-dismiss="modal">Kembali</button>
            </div>
            </form>
        </div>
        </div>
    </div>



    <div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title"> 
            <h5>Kategori & Sub Kategori</h5>
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      
        </div>
        <div class="modal-body">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-primary btn-sm mb-2 ml-3 float-right kategori_divisi" data-toggle="modal"
                    data-target="#modal_kategori_divisi">
                    + Tambah Data Kategori Divisi
                </button>
                <button type="button" class="btn btn-primary btn-sm mb-2 float-right sub_kategori_divisi" data-toggle="modal"
                    data-target="#modal_sub_kategori_divisi">
                    + Tambah Data Sub Kategori Divisi
                </button>
            <h4>Kategori Divisi</h4>
                </div>
                <div class="card-body">
                    <table id="example2" class="table table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori Dokumen</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="add_new_kategori">
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Kategori Divisi</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                    <hr>
                    <h4>Sub Kategori Divisi</h4>
                    <table id="example3" class="table table-bordered mt-3" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori Divisi</th>
                                <th>Sub Kategori Divisi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="add_new_sub_kategori">
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Kategori Divisi</th>
                                <th>Sub Kategori Divisi</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        </div>

        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit divisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_form" class="row">
                    @csrf
                    <div class="form-group col-12">
                        <label for="edit_nama_anggota">Nama Anggota divisi</label>
                        <input type="hidden" name="id" id="id_anggota_divisi" class="form-control">
                        <input  type="hidden" name="old_foto" id="old_foto" class="form-control">
                        <input type="text" name="edit_nama_anggota" id="edit_nama_anggota" class="form-control">
                        <div class="invalid-feedback" id="edit_nama_anggota-error">

                        </div>
                    </div>
                    <div class="form-group col-sm-8">
                        <label for="">Foto</label>
                        <input type="file" class="form-control" name="edit_foto" id="edit_foto"
                            onchange="document.getElementById('ba_edit').src = window.URL.createObjectURL(this.files[0])">
                        <div class="invalid-feedback " id='edit_foto-error'>

                        </div>
                    </div>
                    <div class="form-group col-sm-4 mb-2">
                        <img
                            id="ba_edit" alt="your image" width="100" height="100">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" id="kembali" data-dismiss="modal">Kembali</button>
            </div>
            </form>
        </div>
        </div>
    </div>

    <div class="modal fade" id="modal-xl-anggota_divisi">
      <div class="modal-dialog modal-xl">
       <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Data Anggota Divisi</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
         </button>
       </div>
        <div class="modal-body">
            <div class="card">
                <div class="card-body">
                    <table id="example4" class="table table-bordered example4" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Anggota Divisi</th>
                                <th>Foto</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="add_new_anggota_divisi">
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Anggota Divisi</th>
                                <th>Foto</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        </div>

        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>

        $(document).ready(function() {
            $("#modal_kategori_divisi,#modal_sub_kategori_divisi").on('show.bs.modal', function(e) {
                $("#modal-xl").modal('hide');
            });
        });
        
        $(document).ready(function() {
            $("#editModal").on('show.bs.modal', function(e) {
                $("#modal-xl-anggota_divisi").modal('hide');
            });
        });


        var newTable;
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var newTable = $('#example1').DataTable({
                columnDefs: [{
                        "targets": '_all', // Apply to all columns
                        "orderable": false
                    },
                    {
                        "targets": [0],
                        "className": "custom-width",

                    },
                    {
                        "targets": [1],
                        "className": "custom-width-1",

                    },
                    {
                        "targets": [2],
                        "className": "custom-width-2",
                    },
                    {
                        "targets": [3],
                        "className": "custom-width-3",
                    },
                    {
                        "targets": [4],
                        "className": "custom-width-4",
                    },
                    {
                        "targets": [5],
                        "className": "custom-width-5",
                    }
                ],
                processing: true,
                serverSide: true,
                type: 'post',
                ajax: {
                    url: "{{ route('divisi.index') }}",
                },
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'kategori',
                        name: 'kategori'
                    },
                    {
                        data: 'nama_anggota',
                        name: 'nama_anggota'
                    },
                    {
                        data: 'isi',
                        name: 'isi'
                    },
                    {
                        data: 'foto',
                        name: 'foto'
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                order: [
                    [0, 'desc']
                ]
            });
        });


        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var newTable = $('#example2').DataTable({
                columnDefs: [{
                        "targets": '_all', // Apply to all columns
                        "orderable": false
                    },
                    {
                        "targets": [0],
                        "className": "custom-width",
                    }, {
                        "targets": [2],
                        "className": "custom-width-2",
                    }
                ],
                processing: true,
                serverSide: true,
                type: 'post',
                ajax: {
                    url: "{{ route('kategori_divisi.index') }}",
                },
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'kategori_divisi',
                        name: 'kategori_divisi'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                order: [
                    [0, 'desc']
                ]
            });
        });

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var newTable = $('#example3').DataTable({
                columnDefs: [{
                        "targets": '_all', // Apply to all columns
                        "orderable": false
                    },
                    {
                        "targets": [0],
                        "className": "custom-width",
                    }, {
                        "targets": [1],
                        "className": "custom-width-2",
                    }
                ],
                processing: true,
                serverSide: true,
                type: 'post',
                ajax: {
                    url: "{{ route('sub_kategori_divisi.index') }}",
                },
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'kategori_divisi',
                        name: 'kategori_divisi'
                    },
                    {
                        data: 'nama_sub_kategori',
                        name: 'nama_sub_kategori'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                order: [
                    [0, 'desc']
                ]
            });
        });

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var newTable = $('#example4').DataTable({
                columnDefs: [{
                        "targets": '_all', // Apply to all columns
                        "orderable": false
                    },
                    {
                        "targets": [0],
                        "className": "custom-width",
                    }, {
                        "targets": [2],
                        "className": "custom-width-2",
                    }
                ],
                processing: true,
                serverSide: true,
                type: 'post',
                ajax: {
                    url: "{{ route('anggota_divisi.index') }}",
                },
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'nama_anggota',
                        name: 'nama_anggota'
                    },
                    {
                        data: 'foto',
                        name: 'foto'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                order: [
                    [0, 'desc']
                ]
            });
        });

        // $('.view').on('h');

        $("#anggota_divisi_id").on('change',function (e) {
            e.preventDefault()
            data = $(this).val();
            url = "{{ route('divisi.getAnggota') }}";
            $.ajax({
                type: 'GET',
                url: url,
                data: 'data='+ data,
                dataType: 'json',
                success: function(response) {
                    html = `<label for="foto_anggota_divisi"> Foto </label>
                        <center><img src="{{ asset('foto_anggota_divisi') }}/${response.data.foto}" width="100"></center>`;

                    $(".view").html(html);
                },
            });
        });


        $("#tmbh_form").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = "{{ route('divisi.store') }}";
            $('#btn_add').prop('disabled', true);

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 400) {
                        // toastr.error(response.errors);
                        $.each(response.data, function(field, errors) {
                            $('#' + field).addClass('is-invalid');
                            $('#' + field + '-error').text(errors[0]).wrapInner(
                                "<strong />");
                        });
                        $('#btn_add').prop('disabled', false);


                    } else if (response.status == 401) {
                        toastr.error(response.errors);
                        $('#btn_add').prop('disabled', false);


                    } else if (response.status == 200) {
                        toastr.success(response.message);
                        $('#btn_add').prop('disabled', false);
                        $('#tmbhModal').modal('hide');
                        $("#tmbh_form")[0].reset(); // Fix here
                        $('#example1').DataTable().ajax.reload();
                    }
                },
            });
        });



        $("#add_form_anggota_divisi").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = "{{ route('anggota_divisi.store') }}";
            $('#btn_add').prop('disabled', true);

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 400) {
                        $.each(response.data, function(field, errors) {
                            $('#' + field).addClass('is-invalid');
                            $('#' + field + '-error').text(errors[0]).wrapInner(
                                "<strong />");
                        });
                    }else {
                        toastr.success(response.message);
                        var select = $('#anggota_divisi_id,.anggota_divisi_id');
                        select.empty();
                        select.append('<option selected disabled>-- Pilih Anggota --</option>');
                        $.each(response.data, function (index, category) {
                            select.append('<option value="' + category.id + '">' + category.nama_anggota + '</option>');
                        });
                        $('#modal_anggota_divisi').modal('hide');
                        $("#add_form_anggota_divisi")[0].reset(); // Fix here
                        $('#example3').DataTable().ajax.reload();
                        $('#example1').DataTable().ajax.reload();
                        $('#ba').attr('src','https://png.pngtree.com/png-vector/20190710/ourmid/pngtree-user-vector-avatar-png-image_1541962.jpg')

                    }
                },
            });
        });

        $("#add_form_kategori_divisi").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = "{{ route('kategori_divisi.store') }}";
            $('#btn_add').prop('disabled', true);

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 400) {
                        toastr.error(response.errors);
                        $.each(response.data, function(field, errors) {
                            $('#' + field).addClass('is-invalid');
                            $('#' + field + '-error').text(errors[0]).wrapInner(
                                "<strong />");
                        });
                        $('#btn_add').prop('disabled', false);


                    } else if (response.status == 401) {
                        toastr.error(response.errors);
                        $('#btn_add').prop('disabled', false);


                    } else if (response.status == 200) {
                        toastr.success(response.message);
                        $('#btn_add').prop('disabled', false);
                        $('#modal_kategori_divisi').modal('hide');
                        $("#add_form_kategori_divisi")[0].reset(); // Fix here
                        $('#example2').DataTable().ajax.reload();
                        var select = $('#kategori_divisi,#add_select_kategori_divisi');
                        select.empty();
                        select.append('<option selected disabled>-- Pilih Kategori --</option>');
                        $.each(response.data_select, function (index, category) {
                            select.append('<option value="' + category.id + '">' + category.nama_kategori + '</option>');
                        });
                    }
                },
            });
        });

        $("#add_form_sub_kategori_divisi").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = "{{ route('sub_kategori_divisi.store') }}";
            $('#btn_add').prop('disabled', true);

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 400) {
                        toastr.error(response.errors);
                        $.each(response.data, function(field, errors) {
                            $('#' + field).addClass('is-invalid');
                            $('#' + field + '-error').text(errors[0]).wrapInner(
                                "<strong />");
                        });
                        $('#btn_add').prop('disabled', false);


                    } else if (response.status == 401) {
                        toastr.error(response.errors);
                        $('#btn_add').prop('disabled', false);


                    } else if (response.status == 200) {
                        toastr.success(response.message);
                        $('#btn_add').prop('disabled', false);
                        $('#modal_sub_kategori_divisi').modal('hide');
                        $("#add_form_sub_kategori_divisi")[0].reset(); // Fix here
                        $('#example3').DataTable().ajax.reload();
                        var select = $('.select_kategori_divisi,.sub_kategori_divisi_id');
                                select.empty();
                                select.append('<option selected disabled>-- Pilih Kategori --</option>');
                                $.each(response.data_select, function (index, category) {
                                    select.append('<option value="' + category.id + '">' + ' ' + category.nama_kategori + ' - ' + category.sub_kategori_divisi + ' ' + '</option>');
                                });
                            
                       $('#example1').DataTable().ajax.reload();
                    }
                },
            });
        });


          // modal edit
          $('#example4').on('click', '.edit-button', function() {
                var rowId = $(this).data('id');
                console.log(rowId);
            $.ajax({
                type: 'GET',
                data: 'data='+ rowId,
                url: "{{ route('anggota_divisi.getData') }}",
                dataType: 'json',
                success: function(response) {
                    $('#id_anggota_divisi').val(response.id);
                    $('#old_foto').val(response.foto);
                    $('#edit_nama_anggota').val(response.nama_anggota);
                    $('#ba_edit').attr('src',"{{ asset('foto_anggota_divisi') }}/" + response.foto);
                },
            });
        });

        $('#edit_form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = "{{ route('anggota_divisi.updated') }}";
            $('#btn_add').prop('disabled', true);
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 400) {
                        $.each(response.data, function(field, errors) {
                            $('#' + field).addClass('is-invalid');
                            $('#' + field + '-error').text(errors[0]).wrapInner(
                                "<strong />");
                        });
                        $('#btn_add').prop('disabled', false);

                    }else {
                        toastr.success(response.message);
                        $('#btn_add').prop('disabled', false);
                        $('#editModal').modal('hide');
                        $("#edit_form")[0].reset();
                        $('#example1').DataTable().ajax.reload();
                        $('#example4').DataTable().ajax.reload();
                    }
                },
            });
        });


        $("#add_new").on('click', '.edit_inline', function() {
            var btn = $(this);
            btn.closest("tr").find(".edit_inline").hide();

            $(this).closest("tr").find(".editSpan").hide();
            $(this).closest("tr").find(".editInput").show();
            $(this).closest("tr").find(".editCancel").show();
            $(this).closest("tr").find(".edit_inline").hide();
            $(this).closest("tr").find(".btnSave").show();
        });

        $("#add_new").on('click', '.editCancel', function(e) {
            e.preventDefault();

            $(this).closest("tr").find(".editSpan").show(); // mencari
            $(this).closest("tr").find(".editInput").hide();

            $(this).closest("tr").find(".edit_inline").show();
            $(this).closest("tr").find(".editCancel").hide();

            $(this).closest("tr").find(".btnSave").hide();
        });


        $("#add_new").on("click", '.btnSave', function(e) {
            e.preventDefault();
            var trObj = $(this).closest("tr");
            var ID = $(this).closest("tr").attr('id');
            var inputData = $(this).closest("tr").find(".editInput").serialize();

            $.ajax({
                type: "POST",
                url: "{{ route('divisi.updated') }}",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: 'action=edit&id=' + ID + '&' + $("select[name=kategori_tupoksi_id]").val() + '&' + inputData,
                success: function(response) {
                    console.log(response.data);
                    if (response.status == 200) {
                        $('#example1').DataTable().ajax.reload();
                        trObj.find(".editInput").hide();
                        trObj.find(".editSpan").show();
                        trObj.find(".btnSave").hide();
                        trObj.find(".editCancel").hide();
                        trObj.find(".edit_inline").show();
                    } else {
                        $.each(response.data, function(field, errors) {
                            var inputElement = trObj.find(".editInput." +
                                field);
                            inputElement.addClass('is-invalid');
                            $('#' + field + ID + '-error').text(errors[0]).wrapInner(
                                "<strong />");
                        });
                    }
                }
            });
        });


        $("#add_new_kategori").on('click', '.editCancelKategori', function() {
            $(this).closest('tr').find('.editInput').removeClass('is-invalid');
        });

        $("#kategori_tupoksi_pjm").on('keyup',function (e) {
            $("#kategori_tupoksi_pjm").removeClass('is-invalid');
        });


     $(document).ready(function() {
        $("#add_new_sub_kategori").on('click', '.edit_sub_kategori', function() {
            var btn = $(this);
            btn.closest("tr").find(".edit_sub_kategori").hide();

            $(this).closest("tr").find(".editSpan").hide();
            $(this).closest("tr").find(".editInput").show();
            $(this).closest("tr").find(".editCancelKategori").show();
            $(this).closest("tr").find(".edit_sub_kategori").hide();
            $(this).closest("tr").find(".btnSaveKategori").show();
        });

        // Event delegation for cancel button
        $("#add_new_sub_kategori").on('click', '.editCancelKategori', function(e) {
            e.preventDefault();

            $(this).closest("tr").find(".editSpan").show();
            $(this).closest("tr").find(".editInput").hide();

            $(this).closest("tr").find(".edit_sub_kategori").show();
            $(this).closest("tr").find(".editCancelKategori").hide();

            $(this).closest("tr").find(".btnSaveKategori").hide();
        });

        // Event delegation for save button
        $("#add_new_sub_kategori").on("click", '.btnSaveKategori', function(e) {
            e.preventDefault();
            var trObj = $(this).closest("tr");
            var ID = $(this).closest("tr").attr('id');
            var inputData = $(this).closest("tr").find(".editInput").serialize();

            $.ajax({
                type: "POST",
                url: "{{ route('sub_kategori_divisi.updated') }}",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: 'action=edit&id=' + ID + '&' + inputData,
                success: function(response) {
                
                        if (response.status == 200) {
                            trObj.find(".editSpan.kategori_divisi").text(response.data.kategori_divisi);
                            trObj.find(".editInput.kategori_divisi").val(response.data.kategori_id);

                            trObj.find(".editSpan.sub_kategori_divisi_edit").text(response.data.sub_kategori_divisi);
                            trObj.find(".editInput.sub_kategori_divisi_edit").val(response.data.sub_kategori_divisi);
                            trObj.find(".editInput").hide();
                            trObj.find(".editSpan").show();
                            trObj.find(".btnSaveKategori").hide();
                            trObj.find(".editCancelKategori").hide();
                            trObj.find(".edit_sub_kategori").show();
                            var select = $('.select_kategori_divisi,.sub_kategori_divisi_id');
                                select.empty();
                                select.append('<option selected disabled>-- Pilih Kategori --</option>');
                                $.each(response.data_select, function (index, category) {
                                    select.append('<option value="' + category.id + '">' + ' ' + category.sub_kategori_divisi + ' - ' + category.sub_kategori_divisi + ' ' + '</option>');
                                });
                            
                            $('#example1').DataTable().ajax.reload();
                        } else {
                            $.each(response.data, function(field, errors) {
                                var inputElement = trObj.find(".editInput." +
                                    field);
                                inputElement.addClass('is-invalid');
                                $('#' + field + ID + '-error').text(errors[0]).wrapInner(
                                    "<strong />");
                            });
                        }
                        }
                    });
                });
        });


        $("#kategori_divisi").on('keyup', function() {
            $('#kategori_divisi').removeClass('is-invalid');
        });

        $(document).ready(function () {
            $("#kembali_kategori").on('click', function () {
                $('#kategori_divisi').removeClass('is-invalid');
                $("#add_form_kategori_divisi")[0].reset();
            });
        });




        $("#add_new_kategori").on('click', '.edit_kategori', function() {
            var btn = $(this);
            btn.closest("tr").find(".edit_kategori").hide();

            $(this).closest("tr").find(".editSpan").hide();
            $(this).closest("tr").find(".editInput").show();
            $(this).closest("tr").find(".editCancelKategori").show();
            $(this).closest("tr").find(".edit_kategori").hide();
            $(this).closest("tr").find(".btnSaveKategori").show();
        });

        $("#add_new_kategori").on('click', '.editCancelKategori', function(e) {
            e.preventDefault();

            $(this).closest("tr").find(".editSpan").show(); // mencari
            $(this).closest("tr").find(".editInput").hide();

            $(this).closest("tr").find(".edit_kategori").show();
            $(this).closest("tr").find(".editCancelKategori").hide();

            $(this).closest("tr").find(".btnSaveKategori").hide();
        });


        $("#add_new_kategori").on("click", '.btnSaveKategori', function(e) {
            e.preventDefault();
            var trObj = $(this).closest("tr");
            var ID = $(this).closest("tr").attr('id');
            var inputData = $(this).closest("tr").find(".editInput").serialize();

            $.ajax({
                type: "POST",
                url: "{{ route('kategori_divisi.updated') }}",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: 'action=edit&id=' + ID + '&' + inputData,
                success: function(response) {
                    console.log(response);
                    if (response.status == 200) {
                        trObj.find(".editSpan.nama_kategori").text(response.data);
                        trObj.find(".editInput.nama_kategori").val(response.data);
                        var select = $('#kategori_divisi,#add_select_kategori_divisi,#kategori_divisi_edit');
                        select.empty();
                        select.append('<option selected disabled>-- Pilih Kategori --</option>');
                        $.each(response.data_select, function (index, category) {
                            select.append('<option value="' + category.id + '">' + category.nama_kategori + '</option>');
                        });
                        $('#example3').DataTable().ajax.reload();
                        trObj.find(".editInput").hide();
                        trObj.find(".editSpan").show();
                        trObj.find(".btnSaveKategori").hide();
                        trObj.find(".editCancelKategori").hide();
                        trObj.find(".edit_kategori").show();
                    } else {
                        $.each(response.data, function(field, errors) {
                            var inputElement = trObj.find(".editInput." +
                                field);
                            inputElement.addClass('is-invalid');
                            $('#' + field + ID + '-error').text(errors[0]).wrapInner(
                                "<strong />");
                        });
                    }
                }
            });
        });





        function deleteDataAnggota(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true
            });
            swalWithBootstrapButtons.fire({
                title: 'Apakah Kamu ingin menghapus data ini ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('anggota_divisi.delete') }}",
                            type: "POST",
                            data: {
                                ids: id,
                            },
                            success: function(response) {
                                if(response.status == 200){
                                    toastr.success(response.message);
                                    var select = $('#anggota_divisi_id,#anggota_divisi_id_edit');
                                    select.empty();
                                    if(response.data.length == 0 ){
                                        select.append('<option selected disabled>-- Pilih Kategori --</option>');
                                    }else{
                                        select.append('<option selected disabled>-- Pilih Kategori --</option>');
                                            $.each(response.data, function (index, category) {
                                            select.append('<option value="' + category.id + '">' + category.nama_anggota + '</option>');
                                        });
                                    }
                                    $('.example3').DataTable().ajax.reload();
                                    $('.example1').DataTable().ajax.reload();
                                }else{
                                    toastr.error(response.error);
                                }


                            }
                        });
                    }
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swal.fire(
                        'Cancelled',
                        'Data is not deleted',
                        'error'
                    )
                }
            });
        }

        function deleteData(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true
            });
            swalWithBootstrapButtons.fire({
                title: 'Apakah Kamu ingin menghapus data ini ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('divisi.delete') }}",
                            type: "POST",
                            data: {
                                ids: id,
                            },
                            success: function(response) {
                                toastr.success(response.message);
                                $('#example1').DataTable().ajax.reload();

                            }
                        });
                    }
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swal.fire(
                        'Cancelled',
                        'Data is not deleted',
                        'error'
                    )
                }
            });
        }

        function deleteDataKategori(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true
            });
            swalWithBootstrapButtons.fire({
                title: 'Apakah Kamu ingin menghapus data ini ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('kategori_divisi.delete') }}",
                            type: "POST",
                            data: {
                                ids: id,
                            },
                            success: function(response) {
                                if(response.status == 200){
                                    toastr.success(response.message);
                                    var select = $('#kategori_divisi,#add_select_kategori_divisi');
                                    select.empty();
                                    select.append('<option selected disabled>-- Pilih Kategori --</option>');
                                    $.each(response.data_select, function (index, category) {
                                        select.append('<option value="' + category.id + '">' + category.nama_kategori + '</option>');
                                    });
                                    $('#example2').DataTable().ajax.reload();
                                }else{
                                    toastr.error(response.errors);
                                }
                            }
                        });
                    }
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swal.fire(
                        'Cancelled',
                        'Data is not deleted',
                        'error'
                    )
                }
            });
        }

        function deleteDataSubKategori(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true
            });
            swalWithBootstrapButtons.fire({
                title: 'Apakah Kamu ingin menghapus data ini ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('sub_kategori_divisi.delete') }}",
                            type: "POST",
                            data: {
                                ids: id,
                            },
                            success: function(response) {
                                if(response.status == 200){
                                    toastr.success(response.message);
                                    var select = $('.select_kategori_divisi,.sub_kategori_divisi_id');
                                    select.empty();
                                    if(response.data.length == 0){
                                        select.append('<option selected disabled>-- Pilih Kategori --</option>');
                                    }else{
                                        $.each(response.data, function (index, category) {
                                            select.append('<option value="' + category.id + '">' + ' ' + category.nama_kategori + ' - ' + category.sub_kategori_divisi + ' ' + '</option>');
                                        });
                                    }
                                    $('#example3').DataTable().ajax.reload();
                                }else{
                                    toastr.error(response.errors);
                                }
                            }
                        });
                    }
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swal.fire(
                        'Cancelled',
                        'Data is not deleted',
                        'error'
                    )
                }
            });
        }
    </script>
@endsection
