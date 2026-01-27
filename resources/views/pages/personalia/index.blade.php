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
                        <h3 class="card-title">Data Personalia</h3>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal"
                            data-target="#personalia">
                            + Tambah Data Personalia
                        </button>
                        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal"
                            data-target="#petugas_personalia">
                            + Tambah Petugas Personalia
                       </button>
                        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal" data-target="#modal-xl">
                            Data Petugas Personalia
                         </button>
                     <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal"
                         data-target="#kategori_personalia">
                         + Tambah Data Kategori Personalia
                     </button>
                     <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal"
                         data-target="#kategori-personalia">
                          Data Kategori Personalia
                     </button>
                        <table id="example1" class="table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Personalia</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="add_new">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Personalia</th>
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

    <div class="modal fade" id="personalia" tabindex="-1" role="dialog" aria-labelledby="personaliaLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_form">
                        @csrf
                        <div class="form-group">
                            <label for="personalia">Kategori Personalia</label>
                            <select name="kategori_personalia_id" class="form-control" id="kategori_personalia_id">
                                <option selected disabled>-- Kategori Personalia --</option>
                                @foreach ($kategori as $item)
                                   <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="kategori_personalia_id-error">

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="personalia">Isi Personalia</label>
                            <textarea name="personalia" id="personalia" rows="3" class="form-control"></textarea>
                            <div class="invalid-feedback" id="personalia-error">

                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="petugas_personalia" tabindex="-1" role="dialog" aria-labelledby="personaliaLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_form_petugas_personalia" class="row">
                        @csrf
                        <div class="form-group col-12">
                            <label for="nama_anggota_personalia">Nama Anggota Personalia</label>
                            <input name="nama_anggota_personalia" id="nama_anggota_personalia" class="form-control">
                            <div class="invalid-feedback" id="nama_anggota_personalia-error">

                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="pangkat">Pangkat/Gol</label>
                            <input name="pangkat" id="pangkat"  class="form-control">
                            <div class="invalid-feedback" id="pangkat-error">

                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="jurusan">Jurusan </label>
                            <input name="jurusan" id="jurusan" class="form-control">
                            <div class="invalid-feedback" id="jurusan-error">

                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="email">Email</label>
                            <input name="email" id="email" class="form-control">
                            <div class="invalid-feedback" id="email-error">

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
                    <button type="button" class="btn btn-secondary" id="CancelPetugasPersonalia" data-dismiss="modal">Kembali</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="kategori_personalia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_form_kategori_personalia" class="row">
                    @csrf
                    <div class="form-group col-12">
                        <label for="kategori_personalia">Kategori Personalia</label>
                        <input name="kategori_personalia" id="kategori_personalia" class="form-control">
                        <div class="invalid-feedback" id="kategori_personalia-error">

                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
            </div>
            </form>
        </div>
    </div>
</div>


    <div class="modal fade" id="edit_petugas_personalia" tabindex="-1" role="dialog" aria-labelledby="personaliaLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit Anggota Personalia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_form_petugas_personalia" class="row">
                        @csrf
                        <div class="form-group col-12">
                            <input type="hidden" id="edit_id_anggota_personalia" name="id">
                            <input type="hidden" id="old_foto_anggota_personalia" name="old_foto">
                            <label for="edit_nama_anggota_personalia">Nama Anggota Personalia</label>
                            <input name="edit_nama_anggota_personalia" id="edit_nama_anggota_personalia" class="form-control">
                            <div class="invalid-feedback" id="edit_nama_anggota_personalia-error">

                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="edit_pangkat">Pangkat/Gol</label>
                            <input name="edit_pangkat" id="edit_pangkat"  class="form-control">
                            <div class="invalid-feedback" id="edit_pangkat-error">

                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="edit_jurusan">Jurusan </label>
                            <input name="edit_jurusan" id="edit_jurusan" class="form-control">
                            <div class="invalid-feedback" id="edit_jurusan-error">

                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="edit_email">Email</label>
                            <input name="edit_email" id="edit_email" class="form-control">
                            <div class="invalid-feedback" id="edit_email-error">

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
                            <img src="" id="ba_edit" alt="your image" width="100" height="100">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" id="CancelPetugasPersonalia" data-dismiss="modal">Kembali</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="kategori-personalia">
        <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Data Kategori Personalia</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <div class="card">
                <div class="card-body">
                    <table id="example3" class="table table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori Personalia</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Kategori Personalia</th>
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
    <div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Data Petugas Personalia</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <div class="card">
                <div class="card-body">
                    <table id="example2" class="table table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Anggota Personalia</th>
                                <th>Pangkat</th>
                                <th>Jurusan</th>
                                <th>Email</th>
                                <th>Foto</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Anggota Personalia</th>
                                <th>Pangkat</th>
                                <th>Jurusan</th>
                                <th>Email</th>
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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
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
                    }, {
                        "targets": [1],
                        "className": "custom-width-1",
                    },
                    {
                        "targets": [1],
                        "className": "custom-width-2",
                    }
                ],
                processing: true,
                serverSide: true,
                type: 'post',
                ajax: {
                    url: "{{ route('personalia.index') }}",
                },
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'kategori_personalia_id',
                        name: 'kategori_personalia_id'
                    },
                    {
                        data: 'personalia',
                        name: 'personalia'
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
                    url: "{{ route('petugas_personalia.index') }}",
                },
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'nama_anggota_personalia',
                        name: 'nama_anggota_personalia'
                    },
                    {
                        data: 'pangkat',
                        name: 'pangkat'
                    },
                    {
                        data: 'jurusan',
                        name: 'jurusan'
                    },
                    {
                        data: 'email',
                        name: 'email'
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

             $('#example3').DataTable({
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
                    url: "{{ route('kategori_personalia.index') }}",
                },
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'kategori_personalia',
                        name: 'kategori_personalia'
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

        $("#add_form_kategori_personalia").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = "{{ route('kategori_personalia.store') }}";
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


                    } else if (response.status == 401) {
                        toastr.error(response.errors);
                        $('#btn_add').prop('disabled', false);


                    } else if (response.status == 200) {
                        console.log(response.data);
                        toastr.success(response.message);
                        var select = $('.select_kategori_id');
                            select.empty();
                            select.append('<option selected disabled>-- Pilih Kategori --</option>');
                            $.each(response.data, function (index, category) {
                                select.append('<option value="' + category.id + '">' + category.nama_kategori + '</option>');
                                });
                        $('#btn_add').prop('disabled', false);
                        $('#kategori_personalia').modal('hide');
                        $("#add_form_kategori_personalia")[0].reset(); // Fix here
                        $('#example2').DataTable().ajax.reload();
                        $('.modal-backdrop').remove();
                    }
                },
            });
        });

        $("#add_form").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = "{{ route('personalia.store') }}";
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
                        $('#personalia').modal('hide');
                        $("#add_form")[0].reset(); // Fix here
                        $('.modal-backdrop').remove();
                        $('#example1').DataTable().ajax.reload();
                    }
                },
            });
        });

        $('#CancelPetugasPersonalia').on('click',function (e) {
            $('#nama_anggota_personalia,#pangkat,#jurusan,#email,#foto').removeClass('is-invalid');
        });

        $('#nama_anggota_personalia').on('keyup',function (e) {
            $('#nama_anggota_personalia').removeClass('is-invalid');
        });

        $('#pangkat').on('keyup',function (e) {
            $('#pangkat').removeClass('is-invalid');
        });

        $('#jurusan').on('keyup',function (e) {
            $('#jurusan').removeClass('is-invalid');
        });

        $('#email').on('keyup',function (e) {
            $('#email').removeClass('is-invalid');
        });

        $('#foto').on('change',function (e) {
            $('#foto').removeClass('is-invalid');
        });

        $("#add_form_petugas_personalia").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = "{{ route('petugas_personalia.store') }}";
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
                        $('#petugas_personalia').modal('hide');
                        $("#add_form_petugas_personalia")[0].reset(); // Fix here
                        $('#example2').DataTable().ajax.reload();
                        $('#ba').attr('src','https://png.pngtree.com/png-vector/20190710/ourmid/pngtree-user-vector-avatar-png-image_1541962.jpg');
                    }
                },
            });
        });

        $("#add_new_kategori").on('click', '.editCancelKategori', function() {
            $(this).closest('tr').find('.editInput').removeClass('is-invalid');
        });

        $("#kategori_personalia").on('keyup',function (e) {
            $("#kategori_personalia").removeClass('is-invalid');
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
                url: "{{ route('kategori_personalia.updated') }}",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: 'action=edit&id=' + ID + '&' + inputData,
                success: function(response) {
                    console.log(response.data_select);
                    if (response.status == 200) {
                        trObj.find(".editSpan.nama_kategori").text(response.data);
                        trObj.find(".editInput.nama_kategori").val(response.data);

                        trObj.find(".editInput").hide();
                        trObj.find(".editSpan").show();
                        trObj.find(".btnSaveKategori").hide();
                        trObj.find(".editCancelKategori").hide();
                        trObj.find(".edit_kategori").show();
                        var select = $('.select_kategori_id');
                        select.empty();
                            select.append('<option selected disabled>-- Pilih Kategori --</option>');
                            $.each(response.data_select, function (index, category) {
                                select.append('<option value="' + category.id + '">' + category.nama_kategori + '</option>');
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
                url: "{{ route('personalia-updated') }}",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: 'action=edit&id=' + ID + '&' + inputData,
                success: function(response) {
                    console.log(response.data.nama_kategori);
                    if (response.status == 200) {
                        trObj.find(".editSpan.personalia").text(response.data.personalia);
                        trObj.find(".editInput.personalia").val(response.data.personalia);

                        trObj.find(".editSpan.w").text(response.data.nama_kategori);
                        trObj.find(".editInput.kategori_personalia").val(response.kategori_personalia_id);

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

        $("#add_new").on('keyup', '.editInput', function() {
            $(this).removeClass('is-invalid'); // Remove is-invalid class on keyup
        });

        $("#add_new").on('click', '.editCancel', function() {
            // Find the associated input field within the same table row and remove 'is-invalid' class
            $(this).closest('tr').find('.editInput').removeClass('is-invalid');
        });

        function deleteDataAnggota(ID) {
            console.log(ID);
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
                            url: "{{ route('petugas_personalia-delete') }}",
                            type: "POST",
                            data: {
                                ids: ID,
                            },
                            success: function(response) {
                                toastr.success(response.message);
                                $('#example2').DataTable().ajax.reload();

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

      $(document).on('click', '.edit_inline', function() {
            var id = $(this).data('id');
            var url = "{{ route('petugas_personalia.edit', ['petugas_personalia' => ':id']) }}";
                url = url.replace(':id', id);

            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: 'id=' + id,
                success: function(response) {
                    $('#modal-xl').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    $('#edit_petugas_personalia').modal('show');
                    $('#edit_id_anggota_personalia').val(response.data.id);
                    $('#old_foto_anggota_personalia').val(response.data.foto);
                    $('#edit_nama_anggota_personalia').val(response.data.nama_anggota_personalia);
                    $('#edit_pangkat').val(response.data.pangkat);
                    $('#edit_jurusan').val(response.data.jurusan);
                    $('#edit_email').val(response.data.email);
                    $('#ba_edit').attr('src',"{{ asset('foto_petugas_personalia') }}/" + response.data.foto);
                }
            });
        })

        $(document).on('submit','#edit_form_petugas_personalia',function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                var url = "{{ route('petugas_personalia-updated') }}";
                $.ajax({
                type: "POST",
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(response.status == 200){
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    $('#modal-xl').modal('show');
                    $('#example2').DataTable().ajax.reload();
                    }else{
                        $.each(response.data, function(field, errors) {
                            $('#' + field).addClass('is-invalid');
                            $('#' + field + '-error').text(errors[0]).wrapInner(
                                "<strong />");
                        });
                    }
                }
            });

        });

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
                            url: "{{ route('kategori_personalia.delete') }}",
                            type: "POST",
                            data: {
                                ids: id,
                            },
                            success: function(response) {
                                if (response.status == 200) {
                                var select = $('.select_kategori_id');
                                select.empty();
                                select.append('<option selected disabled>-- Pilih Kategori --</option>');
                                $.each(response.data, function (index, category) {
                                    select.append('<option value="' + category.id + '">' + category.nama_kategori + '</option>');
                                });
                                toastr.success(response.message);
                                $('#example2').DataTable().ajax.reload();
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
                            url: "{{ route('personalia-delete') }}",
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
    </script>
@endsection
