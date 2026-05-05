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
            width: 18%;
            /* Or any specific width value */
        }
        table.dataTable td.custom-width-3 {
            width: 30%;
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
                        <h3 class="card-title">Media</h3>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal" data-target="#exampleModal">
                            + Tambah Media
                        </button>
                        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal"
                            data-target="#kategori_media">
                            + Tambah Data Kategori Media
                        </button>
                        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal"
                            data-target="#modal-xl">
                             Data Kategori Media
                        </button>
                        <table id="example1" class="table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori Media</th>
                                    <th>Judul</th>
                                    <th>isi</th>
                                    <th>Gambar</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="add_new">
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
            <!-- DataTable with Hover -->
        </div>
    </div>

    <div class="modal fade" id="kategori_media" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_form_kategori_media" class="row">
                        @csrf
                        <div class="form-group col-12">
                            <label for="kategori_media">Kategori Media</label>
                            <input name="kategori_media" id="kategori_media" class="form-control">
                            <div class="invalid-feedback" id="kategori_media-error">

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
                        <label for="kategori_media">Kategori Media</label>
                        <select class="form-control kategori_media" name="kategori_media">
                            <option selected disabled>-- Pilih Kategori --</option>
                            @foreach ($kategori as $x)
                            <option value="{{ $x->id }}">{{ $x->nama_kategori }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="kategori_media-error">

                        </div>
                    </div>
                    <div class="form-group col-12">
                        <label for="judul">Judul</label>
                        <input name="judul" id="judul" class="form-control">
                        <div class="invalid-feedback" id="judul-error">

                        </div>
                    </div>

                    <div class="form-group col-12">
                        <label for="isi">Isi</label>
                        <textarea name="isi" id="isi" class="form-control" rows="3"></textarea>
                        <div class="invalid-feedback" id="isi-error">

                        </div>
                    </div>
                    <div class="form-group col-12">
                        <label for="lokasi">Lokasi</label>
                        <input name="lokasi" id="lokasi" class="form-control">
                        <div class="invalid-feedback" id="lokasi-error">

                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control">
                        <div class="invalid-feedback" id="tanggal-error">

                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="jam">Jam</label>
                        <input type="time" name="jam" id="jam" class="form-control">
                        <div class="invalid-feedback" id="jam-error">

                        </div>
                    </div>
                    <div class="form-group col-sm-8">
                        <label for="">Gambar</label>
                        <input type="file" class="form-control" name="gambar" id="gambar"
                            onchange="document.getElementById('ba').src = window.URL.createObjectURL(this.files[0])">
                        <div class="invalid-feedback " id='gambar-error'>

                        </div>
                    </div>
                    <div class="form-group col-sm-4 mb-2">
                        <img src="https://ionicframework.com/docs/img/demos/thumbnail.svg"
                            id="ba" alt="your image" width="125" height="125">
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
            <h5 class="modal-title">Edit Media</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">
               <form id="edit_form" class="row">
                   @csrf
                   <div class="form-group col-12">
                       <label for="kategori_media">Kategori Media</label>
                       <select class="form-control kategori_media" id="kategori_media_edit" name="kategori_media">
                           <option selected disabled>-- Pilih Kategori --</option>
                           @foreach ($kategori as $x)
                           <option value="{{ $x->id }}">{{ $x->nama_kategori }}</option>
                           @endforeach
                       </select>
                       <div class="invalid-feedback" id="kategori_media-error">

                       </div>
                   </div>
                   <div class="form-group col-12">
                       <label for="judul">Judul</label>
                       <input type="hidden" name="id" id="id_media" class="form-control">
                       <input  type="hidden" name="old_gambar" id="old_gambar" class="form-control">
                       <input name="judul_edit" id="judul_edit" class="form-control">
                       <div class="invalid-feedback" id="judul-error">

                       </div>
                   </div>
                   <div class="form-group col-12">
                       <label for="isi_edit">Isi</label>
                       <textarea name="isi_edit" id="isi_edit" class="form-control" rows='3'></textarea>
                       <div class="invalid-feedback" id="isi_edit-error">

                       </div>
                   </div>
                   <div class="form-group col-12">
                    <label for="lokasi_edit">Lokasi</label>
                    <input name="lokasi_edit" id="lokasi_edit" class="form-control">
                    <div class="invalid-feedback" id="lokasi_edit-error">

                    </div>
                </div>
                <div class="form-group col-6">
                    <label for="tanggal_edit">Tanggal</label>
                    <input type="date" name="tanggal_edit" id="tanggal_edit" class="form-control">
                    <div class="invalid-feedback" id="tanggal_edit-error">

                    </div>
                </div>
                <div class="form-group col-6">
                    <label for="jam_edit">Jam</label>
                    <input type="time" name="jam_edit" id="jam_edit" class="form-control">
                    <div class="invalid-feedback" id="jam_edit-error">

                    </div>
                </div>
                   <div class="form-group col-sm-8">
                       <label for="">Gambar</label>
                       <input type="file" class="form-control" name="gambar_edit" id="gambar_edit"
                           onchange="document.getElementById('ba').src = window.URL.createObjectURL(this.files[0])">
                       <div class="invalid-feedback " id='gambar_edit-error'>

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
        <h4 class="modal-title">Data Kategori Media</h4>
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
                                <th>Kategori Media</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="add_new_kategori">
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Kategori Media</th>
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
             newTable = $('#example1').DataTable({
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
                    url: "{{ route('media.index') }}",
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
                        data: 'judul',
                        name: 'judul'
                    },
                    {
                        data: 'isi',
                        name: 'isi'
                    },
                    {
                        data: 'gambar',
                        name: 'gambar'
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
                    url: "{{ route('kategori_media.index') }}",
                },
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'kategori_media',
                        name: 'kategori_media'
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
        $('#exampleModal').on('show.bs.modal', function(e) {
            let now = new Date();
            let currentDate = now.toISOString().slice(0, 10);
            let hour = now.getHours().toString().padStart(2, '0');
            let minute = now.getMinutes().toString().padStart(2, '0');
            let currentTime = hour + ':' + minute;
            $("#tanggal").val(currentDate);
            $("#jam").val(currentTime);
        });
    });


        $("#add_form").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = "{{ route('media.store') }}";
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

    // 🔥 FORCE CLOSE MODAL (WAJIB DI PROJECT KAMU)
    $('#exampleModal').removeClass('show').hide();
    $('.modal-backdrop').remove();
    $('body').removeClass('modal-open');
    $('body').css('padding-right', '');

    $("#add_form")[0].reset();

    // 🔥 reload table
    setTimeout(function(){
        newTable.ajax.reload(null, false);
    }, 300);
}
                },
            });
        });

        $("#add_form_kategori_media").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = "{{ route('kategori_media.store') }}";
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
                        var select = $('.kategori_media');
                        select.empty();
                        select.append('<option selected disabled>-- Pilih Kategori --</option>');
                        $.each(response.data, function (index, category) {
                            console.log(category);
                            select.append('<option value="' + category.id + '">' + category.nama_kategori + '</option>');
                        });

                        $('#btn_add').prop('disabled', false);
                        $('#kategori_media').modal('hide');
                        $("#add_form_kategori_media")[0].reset(); // Fix here
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
                url: "{{ route('media.getData') }}",
                dataType: 'json',
                success: function(response) {
                    $('#id_media').val(response.data.id);
                    $('#old_gambar').val(response.data.gambar);
                    $('#kategori_media_edit').val(response.data.kategori_media_id);
                    $('#judul_edit').val(response.data.judul);
                    $('#isi_edit').val(response.data.isi);
                    $('#lokasi_edit').val(response.data.lokasi);
                    $('#tanggal_edit').val(response.data.tanggal);
                    $('#jam_edit').val(response.data.jam);
                    $('#ba_edit').attr('src',"{{ asset('gambar_media') }}/" + response.data.gambar);
                },
            });
        });

        $('#edit_form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = "{{ route('media.updated') }}";
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


        $("#kategori_media").on('keyup', function() {
            $('#kategori_media').removeClass('is-invalid');
        });

        $(document).ready(function () {
            $("#kembali_kategori").on('click', function () {
                $('#kategori_media').removeClass('is-invalid');
                $("#add_form_kategori_media")[0].reset();
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
                url: "{{ route('kategori_media.updated') }}",
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
                        var select = $('.kategori_media');
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
                            url: "{{ route('media.delete') }}",
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
                            url: "{{ route('kategori_media.delete') }}",
                            type: "POST",
                            data: {
                                ids: id,
                            },
                            success: function(response) {
                                if (response.status == 200) {
                                    toastr.success(response.message);
                                    $('#example2').DataTable().ajax.reload();
                                    var select = $('.kategori_media');
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
