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
            width: 25%;
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
        #file-input {
        display: none;
        }

        #custom-button {
        padding: 10px;
        margin-bottom: -60px !important;
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
        border: none;
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
                        <h3 class="card-title">Data Dokumen</h3>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal"
                            data-target="#tmbhModal">
                            + Tambah Data Dokumen
                        </button>
                      
                        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal"
                            data-target="#modal-xl">
                             Data Kategori dan Sub Kategori Dokumen
                        </button>
                        
                        <table id="example1" class="table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Dokumen</th>
                                    <th>Nama Dokumen</th>
                                    <th>Publish Dokumen</th>
                                    <th>Download Dokumen</th>
                                    <th>thumbnail</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="add_new">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Dokumen</th>
                                    <th>Nama Dokumen</th>
                                    <th>thumbnail</th>
                                    <th>Publish Dokumen</th>
                                    <th>Download Dokumen</th>
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
                <h5 class="modal-title">Tambah Dokumen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tmbh_form" class="row">
                    @csrf
                    <div class="form-group col-12">
                        <label for="select_kategori_dokumen">Sub Kategori Dokumen</label>
                        <select class="form-control select_kategori_dokumen" id="select_kategori_dokumen" name="select_kategori_dokumen">
                            <option selected disabled>-- Pilih Sub Kategori --</option>
                            @foreach ($subkategori as $x)
                            <option value="{{ $x->id }}">{{ $x->nama_kategori }} - {{ $x->sub_kategori_dokumen }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="select_kategori_dokumen-error">

                        </div>
                    </div>

                    <div class="form-group col-12">
                        <label for="nama_dokumen">Nama Dokunen</label>
                        <input name="nama_dokumen" id="nama_dokumen" class="form-control">
                        <div class="invalid-feedback" id="nama_dokumen-error">

                        </div>
                    </div>
                    <div class="form-group col-12">
                        <label for="dokumen">Dokumen</label>
                        <input type="file" name="dokumen" id="dokumen" class="form-control">
                        <div class="invalid-feedback" id="dokumen-error">

                        </div>
                    </div>
                    <div class="form-group col-sm-8">
                        <label for="">Thumbnail</label>
                        <input type="file" class="form-control" name="thumbnail" id="thumbnail"
                            onchange="document.getElementById('ba').src = window.URL.createObjectURL(this.files[0])">
                        <div class="invalid-feedback " id='thumbnail-error'>

                        </div>
                    </div>
                    <div class="form-group col-sm-4 mb-2">
                        <img src="https://www.simavaziry.com/wp-content/uploads/2020/05/720x550.png"
                            id="ba" alt="your image" width="120" height="120">
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

    <div class="modal fade" id="modal_kategori_dokumen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_form_kategori_dokumen" class="row">
                        @csrf
                        <div class="form-group col-12">
                            <label for="nama_kategori">Kategori Dokumen</label>
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

    <div class="modal fade" id="modal_sub_kategori_dokumen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_form_sub_kategori_dokumen" class="row">
                        @csrf
                        <div class="form-group col-12">
                            <label for="kategori_id">Sub Kategori Dokumen</label>
                            <select name="kategori_id" id="kategori_id" class="form-control">
                                <option selected disabled>Sub Kategori</option>
                                @foreach ($kategori as $kat)
                                <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="kategori_id-error">
    
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="sub_kategori_dokumen">Sub Kategori Dokumen</label>
                            <input name="sub_kategori_dokumen" id="sub_kategori_dokumen" class="form-control">
                            <div class="invalid-feedback" id="sub_kategori_dokumen-error">

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

    <div class="modal fade" id="modal_sub_kategori_dokumen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_form_sub_kategori_dokumen" class="row">
                    @csrf
                    <div class="form-group col-12">
                        <label for="kategori_id">Sub Kategori Dokumen</label>
                        <select name="kategori_id" id="kategori_id" class="form-control">
                            <option selected disabled>Sub Kategori</option>
                            <option value=""></option>
                        </select>
                        <div class="invalid-feedback" id="kategori_id-error">

                        </div>
                    </div>
                    <div class="form-group col-12">
                        <label for="sub_kategori_id">Sub Kategori Dokumen</label>
                        <select name="" id=""></select>
                        <div class="invalid-feedback" id="sub_kategori_id-error">

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
                    <button type="button" class="btn btn-primary btn-sm mb-2 ml-3 float-right kategori_dokumen" data-toggle="modal"
                    data-target="#modal_kategori_dokumen">
                    + Tambah Data Kategori Dokumen
                </button>
                <button type="button" class="btn btn-primary btn-sm mb-2 float-right sub_kategori_dokumen" data-toggle="modal"
                    data-target="#modal_sub_kategori_dokumen">
                    + Tambah Data Sub Kategori Dokumen
                </button>
            <h4>Kategori Dokumen</h4>
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
                                <th>Kategori Dokumen</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                    <hr>
                    <h4>Sub Kategori Dokumen</h4>
                    <table id="example3" class="table table-bordered mt-3" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori Dokumen</th>

                                <th>Sub Kategori Dokumen</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="add_new_sub_kategori">
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Kategori Dokumen</th>
                                <th>Sub Kategori Dokumen</th>
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
                <h5 class="modal-title">Edit Dokumen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_form" >
                    @csrf
                    <div class="row">

                    <div class="form-group col-12">
                        <label for="sub_kategori_dokumen_id">Kategori Dokumen</label>
                        <select class="form-control sub_kategori_dokumen_id" id="sub_kategori_dokumen_id" name="sub_kategori_dokumen_id">
                            @foreach ($subkategori1 as $x)
                            <option value="{{ $x->id }}">{{ $x->sub_kategori_dokumen }} - {{ $x->sub_kategori_dokumen }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="sub_kategori_dokumen_id-error">

                        </div>
                    </div>
                    <div class="form-group col-12">
                        <label for="nama_dokumen_edit">Nama Dokumen</label>
                        <input type="hidden" name="id" id="id_dokumen" class="form-control">
                        <input  type="hidden" name="old_thumbnail" id="old_thumbnail" class="form-control">
                        <input  type="hidden" name="old_dokumen" id="old_dokumen" class="form-control">
                        <input name="nama_dokumen" id="nama_dokumen_edit" class="form-control">
                        <div class="invalid-feedback" id="nama_dokumen_edit-error">

                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="Dokumen">Dokumen</label>
                        <input name="dokumen_i" id="dokumen_edit" class="form-control">
                        <div class="invalid-feedback" id="Dokumen-error"></div>
                    </div>

                    <div class="form-group col-6">
                        <label for="file-input" style="display: block; margin-bottom: 8px;">‎</label>
                        <span id="custom-button" style="display: inline-block; padding: 6px 12px; background-color: #007BFF; color: #fff; cursor: pointer;">Pilih File</span>
                        <input type="file" id="file-input" name="dokumen" onchange="displayFileName()" style="display: none;">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-8">
                        <label for="">Thumbnail</label>
                        <input type="file" class="form-control" name="thumbnail" id="thumbnail_edit"
                            onchange="document.getElementById('ba_edit').src = window.URL.createObjectURL(this.files[0])">
                        <div class="invalid-feedback" id='thumbnail-error'></div>
                    </div>

                    <div class="form-group col-sm-4 mb-2">
                        <img id="ba_edit" alt="your image" width="100" height="100" style="display: block; margin-top: 8px;">
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
   </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

   

   $(document).ready(function() {
            $('#modal-xl').on('hidden.bs.modal', function (e) {
                $(this).find('input.form-control').hide();
                $(this).find(".editSpan").show();
                $(this).find(".editInput").hide();
                $(this).find(".editCancelKategori").hide();
                $(this).find(".edit_kategori").show();
                $(this).find(".btnSaveKategori").hide();
                $(this).find('.edit_sub_kategori').show();
            });
        });


        $("#file-input").change(function () {
            var fileName = $(this).val().split("\\").pop();
            $("#dokumen_edit").val(fileName);
        });

        // Trigger the file input when the custom button is clicked
        $("#custom-button").click(function () {
            $("#file-input").click();
        });
        $(document).ready(function() {
            $("#modal_kategori_dokumen,#modal_sub_kategori_dokumen").on('show.bs.modal', function(e) {
                $("#modal-xl").modal('hide');
            });
        });

        // $(document).ready(function() {
        //     $("#modal-kategorisubkategori").on('show.bs.modal', function(e) {
        //         $("#").modal('hide');
        //     });
        // });

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
                    url: "{{ route('dokumen.index') }}",
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
                        data: 'dokumen',
                        name: 'dokumen'
                    },
                    {
                        data: 'nama_dokumen',
                        name: 'nama_dokumen'
                    },
                    {
                        data: 'publish_dokumen',
                        name: 'publish_dokumen'
                    },
                    {
                        data: 'download_dokumen',
                        name: 'download_dokumen'
                    },
                    {
                        data: 'thumbnail',
                        name: 'thumbnail'
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
                    url: "{{ route('kategori_dokumen.index') }}",
                },
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'kategori_dokumen',
                        name: 'kategori_dokumen'
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
                    },{
                        "targets": [3],
                        "className": "custom-width-3",
                    }
                    
                ],
                processing: true,
                serverSide: true,
                type: 'post',
                ajax: {
                    url: "{{ route('sub_kategori_dokumen.index') }}",
                },
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'kategori_dokumen',
                        name: 'kategori_dokumen'
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

        $("#tmbh_form").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = "{{ route('dokumen.store') }}";
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
                        $("#ba").attr('src','https://www.simavaziry.com/wp-content/uploads/2020/05/720x550.png');
                        $('#example1').DataTable().ajax.reload();
                    }
                },
            });
        });

        $("#add_form_kategori_dokumen").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = "{{ route('kategori_dokumen.store') }}";
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
                        $('#modal_kategori_dokumen').modal('hide');
                        $("#add_form_kategori_dokumen")[0].reset(); // Fix here
                        $('#example2').DataTable().ajax.reload();
                        var select = $('#kategori_id');
                        select.empty();
                        select.append('<option selected disabled>-- Pilih Kategori --</option>');
                        $.each(response.data_select, function (index, category) {
                                select.append('<option value="' + category.id + '">' + category.nama_kategori + '</option>');
                        });
                    }
                },
            });
        });

        $("#add_form_sub_kategori_dokumen").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = "{{ route('sub_kategori_dokumen.store') }}";
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
                        $('#modal_sub_kategori_dokumen').modal('hide');
                        $("#add_form_sub_kategori_dokumen")[0].reset(); // Fix here
                        $('#example3').DataTable().ajax.reload();
                        
                        var select = $('.select_kategori_dokumen,.sub_kategori_dokumen_id');
                        console.log(select);
                        select.empty();
                        select.append('<option selected disabled>-- Pilih Kategori --</option>');
                        $.each(response.data_select, function (index, category) {
                            select.append('<option value="' + category.id + '">' + ' ' + category.nama_kategori + ' - ' + category.sub_kategori_dokumen + ' ' + '</option>');

                        });
                    }
                },
            });
        });
        $(document).ready(function() {
    // Your code here
            $('#example1').on('click', '.edit-button', function() {
                var rowId = $(this).data('row-id');
                $.ajax({
                    type: 'GET',
                    data: 'data='+ rowId,
                    url: "{{ route('dokumen.getData') }}",
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        $('#id_dokumen').val(response.data.id);
                        $('#old_thumbnail').val(response.data.thumbnail);
                        $('#old_dokumen').val(response.data.dokumen);
                        $('#sub_kategori_dokumen_id').val(response.data.sub_kategori_dokumen_id); // Set the value here
                        $('#nama_dokumen_edit').val(response.data.nama_dokumen);
                        $('#dokumen_edit').val(response.data.dokumen);
                        $('#ba_edit').attr('src',"{{ asset('thumbnail_dokumen') }}/" + response.data.thumbnail);
                    },
                });
            });
        });


        $('#edit_form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = "{{ route('dokumen.updated') }}";
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
                    }
                },
            });
        });






        $("#add_new_kategori").on('click', '.editCancelKategori', function() {
            $(this).closest('tr').find('.editInput').removeClass('is-invalid');
        });

        $("#kategori_tupoksi_pjm").on('keyup',function (e) {
            $("#kategori_tupoksi_pjm").removeClass('is-invalid');
        });


        $("#kategori_dokumen").on('keyup', function() {
            $('#kategori_dokumen').removeClass('is-invalid');
        });

        $(document).ready(function () {
            $("#kembali_kategori").on('click', function () {
                $('#kategori_dokumen').removeClass('is-invalid');
                $("#add_form_kategori_dokumen")[0].reset();
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
                url: "{{ route('kategori_dokumen.updated') }}",
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

                        var select1 = $('#kategori_id');
                        var select2 = $('.select_kategori_dokumen_edit');
                        select1.empty();
                        select1.append('<option selected disabled>-- Pilih Kategori --</option>');
                        $.each(response.data_select, function (index, category) {
                            select1.append('<option value="' + category.id + '">' + category.nama_kategori + '</option>');
                        });

                        select2.empty();
                        select2.append('<option selected disabled>-- Pilih Kategori --</option>');
                        $.each(response.data_select, function (index, category) {
                            select2.append('<option value="' + category.id + '">' + category.nama_kategori + '</option>');
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

        $(document).ready(function() {
    // Event delegation for edit button
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
            url: "{{ route('sub_kategori_dokumen.updated') }}",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: 'action=edit&id=' + ID + '&' + inputData,
            success: function(response) {
             
                    if (response.status == 200) {
                        trObj.find(".editSpan.nama_sub_kategori").text(response.data.sub_kategori);
                        trObj.find(".editInput.nama_sub_kategori").val(response.data.sub_kategori);

                        trObj.find(".editSpan.kategori_dokumen").text(response.data.kategori_dokumen);
                        trObj.find(".editInput.kategori_dokumen").val(response.data.kategori_id);
                        trObj.find(".editInput").hide();
                        trObj.find(".editSpan").show();
                        trObj.find(".btnSaveKategori").hide();
                        trObj.find(".editCancelKategori").hide();
                        trObj.find(".edit_sub_kategori").show();
                        var select = $('.select_kategori_dokumen,.sub_kategori_dokumen_id');
                        
                        select.empty();
                        select.append('<option selected disabled>-- Pilih Kategori --</option>');
                        $.each(response.data_select, function (index, category) {
                            select.append('<option value="' + category.id + '">' + ' ' + category.nama_kategori + ' - ' + category.sub_kategori_dokumen + ' ' + '</option>');
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

        function handleSwitchChange(rowId) {
            var isChecked = $('#customSwitchPublish' + rowId).prop('checked');
            var check = '';
            if (isChecked) {
                check = 1;
            } else {
                check = 0;
            }
            $.ajax({
                type: "POST",
                url: "{{ route('dokumen.publish') }}",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: 'check=' + check + '&' + 'id=' + rowId,
                success: function(response) {
                    if (response.status == 200) {
                        toastr.success(response.message);
                    }
                }
            });
        }

        function UpdateSwitchDownload(rowId){
            console.log(rowId);
            var isChecked = $('#customSwitchDownload' + rowId).prop('checked');
            var check = '';
            if (isChecked) {
                check = 1;
            } else {
                check = 0;
            }

            $.ajax({
                type: "POST",
                url: "{{ route('dokumen.download') }}",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: 'check=' + check + '&' + 'id=' + rowId,
                success: function(response) {
                    if (response.status == 200) {
                        toastr.success(response.message);
                    }
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
                            url: "{{ route('dokumen.delete') }}",
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
                            url: "{{ route('kategori_dokumen.delete') }}",
                            type: "POST",
                            data: {
                                ids: id,
                            },
                            success: function(response) {
                                if(response.status == 200){
                                    toastr.success(response.message);
                                    var select = $('#kategori_id');
                                    var select1 = $('#kategori_dokumens_id');
                                    select.empty();
                                    select1.empty();
                                    if(response.data.length == 0){
                                        select.append('<option selected disabled>-- Pilih Kategori --</option>');
                                        select1.append('<option selected disabled>-- Pilih Kategori --</option>');
                                    }else{
                                        $.each(response.data, function (index, category) {
                                            select.append('<option value="' + category.id + '">' + category.nama_kategori + '</option>');
                                            select1.append('<option value="' + category.id + '">' + category.nama_kategori + '</option>');
                                        });
                                    }
                                    $('#example2').DataTable().ajax.reload();
                                }else{
                                    toastr.error(response.message);
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
                            url: "{{ route('sub_kategori_dokumen.delete') }}",
                            type: "POST",
                            data: {
                                ids: id,
                            },
                            success: function(response) {
                                if(response.status == 200){
                                    toastr.success(response.message);
                                    var select = $('.select_kategori_dokumen,.sub_kategori_dokumen_id');
                                    select.empty();
                                    if(response.data.length == 0){
                                        select.append('<option selected disabled>-- Pilih Kategori --</option>');
                                    }else{
                                        $.each(response.data, function (index, category) {
                                            select.append('<option value="' + category.id + '">' + ' ' + category.nama_kategori + ' - ' + category.sub_kategori_dokumen + ' ' + '</option>');
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
