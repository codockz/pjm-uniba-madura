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
            width: 10%;
            /* Or any specific width value */
        }

        table.dataTable td.custom-width-2 {
            width: 30%;
            /* Or any specific width value */
        }
        table.dataTable td.custom-width-3 {
            width: 15%;
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
                        <h3 class="card-title">Data Struktur Organisasi</h3>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal"
                            data-target="#exampleModal">
                            + Tambah Data Struktur Organisasi
                        </button>
                        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal"
                            data-target="#kategori_struktur">
                            + Tambah Data Kategori Struktur Organisasi
                        </button>
                        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal"
                            data-target="#modal-xl">
                             Data Kategori Struktur Organisasi
                        </button>
                        <table id="example1" class="table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Nama Anggota Struktur Organisasi</th>
                                    <th>Jabatan</th>
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
                                    <th>Nama Anggota Struktur Organisasi</th>
                                    <th>Jabatan</th>
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

    <div class="modal fade" id="kategori_struktur" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_form_kategori_struktur_organisasi" class="row">
                        @csrf
                        <div class="form-group col-12">
                            <label for="kategori_struktur_organisasi">Kategori Struktur Organisasi</label>
                            <input name="kategori_struktur_organisasi" id="kategori_struktur_organisasi" class="form-control">
                            <div class="invalid-feedback" id="kategori_struktur_organisasi-error">

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

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_form" class="row">
                    @csrf
                    <div class="form-group col-12">
                        <label for="kategori_struktur">Kategori Struktur Organisasi</label>
                        <select class="form-control kategori_struktur" name="kategori_struktur">
                            <option selected disabled>-- Pilih Kategori --</option>
                            @foreach ($kategori as $x)
                            <option value="{{ $x->id }}">{{ $x->nama_kategori }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="kategori_struktur-error">

                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="nama_anggota">Nama Anggota Struktur Organisasi</label>
                        <input name="nama_anggota" id="nama_anggota" class="form-control">
                        <div class="invalid-feedback" id="nama_anggota-error">

                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="jabatan">Jabatan Anggota Struktur Organisasi</label>
                        <input name="jabatan" id="jabatan" class="form-control">
                        <div class="invalid-feedback" id="jabatan-error">

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

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
            <h5 class="modal-title">Edit Struktur Organisasi</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">
               <form id="edit_form" class="row">
                   @csrf
                   <div class="form-group col-12">
                       <label for="kategori_struktur">Kategori Struktur Organisasi</label>
                       <select class="form-control kategori_struktur" id="kategori_struktur_edit" name="kategori_struktur">
                           <option selected disabled>-- Pilih Kategori --</option>
                           @foreach ($kategori as $x)
                           <option value="{{ $x->id }}">{{ $x->nama_kategori }}</option>
                           @endforeach
                       </select>
                       <div class="invalid-feedback" id="kategori_struktur-error">

                       </div>
                   </div>
                   <div class="form-group col-6">
                       <label for="nama_anggota">Nama Anggota Struktur Organisasi</label>
                       <input type="hidden" name="id" id="id_struktur" class="form-control">
                       <input  type="hidden" name="old_foto" id="old_foto" class="form-control">
                       <input name="nama_anggota" id="nama_anggota_edit" class="form-control">
                       <div class="invalid-feedback" id="nama_anggota-error">

                       </div>
                   </div>
                   <div class="form-group col-6">
                       <label for="jabatan">Jabatan Anggota Struktur Organisasi</label>
                       <input name="jabatan" id="jabatan_edit" class="form-control">
                       <div class="invalid-feedback" id="jabatan-error">

                       </div>
                   </div>
                   <div class="form-group col-sm-8">
                       <label for="">Foto</label>
                       <input type="file" class="form-control" name="foto" id="foto_edit"
                           onchange="document.getElementById('ba').src = window.URL.createObjectURL(this.files[0])">
                       <div class="invalid-feedback " id='foto-error'>

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

    <div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Data Kategori Struktur Organisasi</h4>
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
                                <th>Kategori Struktur Organisasi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="add_new_kategori">
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Kategori Struktur Organisasi</th>
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
                    url: "{{ route('struktur_organisasi.index') }}",
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
                        data: 'jabatan',
                        name: 'jabatan'
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
                    url: "{{ route('kategori_struktur_organisasi.index') }}",
                },
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'kategori_struktur',
                        name: 'kategori_struktur'
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



        $("#add_form").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = "{{ route('struktur_organisasi.store') }}";
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
                        $('#exampleModal').modal('hide');
                        $("#add_form")[0].reset(); // Fix here
                        $('#example1').DataTable().ajax.reload();
                    }
                },
            });
        });

        $("#add_form_kategori_struktur_organisasi").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = "{{ route('kategori_struktur_organisasi.store') }}";
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
                        var select = $('.kategori_struktur');
                        select.empty();
                        select.append('<option selected disabled>-- Pilih Kategori --</option>');
                        $.each(response.data, function (index, category) {
                            console.log(category);
                            select.append('<option value="' + category.id + '">' + category.nama_kategori + '</option>');
                        });

                        $('#btn_add').prop('disabled', false);
                        $('#kategori_struktur').modal('hide');
                        $("#add_form_kategori_struktur_organisasi")[0].reset(); // Fix here
                        $('#example2').DataTable().ajax.reload();
                    }
                },
            });
        });

          // modal edit
          $('#example1').on('click', '.edit-button', function() {
                var rowId = $(this).data('row-id');
            $.ajax({
                type: 'GET',
                data: 'data='+ rowId,
                url: "{{ route('struktur_organisasi.getData') }}",
                dataType: 'json',
                success: function(response) {
                    $('#id_struktur').val(response.data.id);
                    $('#old_foto').val(response.data.foto);
                    $('#kategori_struktur_edit').val(response.data.kategori_struktur_id);
                    $('#nama_anggota_edit').val(response.data.nama_anggota);
                    $('#jabatan_edit').val(response.data.jabatan);
                    $('#ba_edit').attr('src',"{{ asset('foto_anggota_struktur_organisasi') }}/" + response.data.foto);
                },
            });
        });

        $('#edit_form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = "{{ route('struktur_organisasi.updated') }}";
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
                url: "{{ route('tupoksi_pjm.updated') }}",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: 'action=edit&id=' + ID + '&' + $("select[name=kategori_tupoksi_id]").val() + '&' + inputData,
                success: function(response) {
                    console.log(response.data);
                    if (response.status == 200) {
                        trObj.find(".editSpan.isi_tupoksi").text(response.data.isi_tupoksi);
                        trObj.find(".editInput.isi_tupoksi").val(response.data.isi_tupoksi);

                        trObj.find(".editSpan.kategori_tupoksi_id").text(response.data.nama_kategori);
                        trObj.find(".editInput.kategori_tupoksi_id").val(response.data.kategori_tupoksi_id);

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


        $("#kategori_struktur_organisasi").on('keyup', function() {
            $('#kategori_struktur_organisasi').removeClass('is-invalid');
        });

        $(document).ready(function () {
            $("#kembali_kategori").on('click', function () {
                $('#kategori_struktur_organisasi').removeClass('is-invalid');
                $("#add_form_kategori_struktur_organisasi")[0].reset();
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
                url: "{{ route('kategori_struktur_organisasi.updated') }}",
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
                        var select = $('.kategori_struktur');
                        select.empty();
                        select.append('<option selected disabled>-- Pilih Kategori --</option>');
                        $.each(response.data_select, function (index, category) {
                            select.append('<option value="' + category.id + '">' + category.nama_kategori + '</option>');
                        });
                        $('#example1').DataTable().ajax.reload();
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
                            url: "{{ route('struktur_organisasi.delete') }}",
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
                            url: "{{ route('kategori_struktur_organisasi.delete') }}",
                            type: "POST",
                            data: {
                                ids: id,
                            },
                            success: function(response) {
                                if (response.status == 200) {
                                    toastr.success(response.message);
                                    $('#example2').DataTable().ajax.reload();
                                    var select = $('.kategori_struktur');
                                    select.empty();
                                    select.append('<option selected disabled>-- Pilih Kategori --</option>');
                                    $.each(response.data, function (index, category) {
                                       select.append('<option value="' + category.id + '">' + category.nama_kategori + '</option>');
                                     });
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
    </script>
@endsection
