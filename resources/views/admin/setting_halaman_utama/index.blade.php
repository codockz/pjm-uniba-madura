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
            width: 25%;
            /* Or any specific width value */
        }

        table.dataTable td.custom-width-3 {
            width: 15%;
            /* Or any specific width value */
        }

        table.dataTable td.custom-width-4 {
            width: 5%;
            text-align: center;

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
                        <h3 class="card-title">Setting Halaman Utama</h3>
                    </div>
                    <div class="card-body">

                        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal"
                            data-target="#footer">
                            Setting Content Footer
                        </button>

                        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal"
                            data-target="#data_judul_gambar_isi">
                            Data setting gambar halaman lain
                        </button>
                        <table id="example1" class="table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Isi</th>
                                    <th>Gambar Slide</th>
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

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tentang PJM Uniba</h3>
                    </div>
                    <div class="card-body">
                        <form id="form_about">
                            <div class="form-group">
                                <label for="">Link Video Youtube</label>
                                <input type="hidden" name="about_id" id="about_id" value="{{ $about->id }}">
                                <input type="text" name="link_video" id="link_video" class="form-control mb-2"
                                    @if (!empty($about)) value="{{ $about->link_video }}" @endif>
                                <div class="invalid-feedback" id="link_video-error">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Tentang PJM Uniba</label>
                                <textarea name="isi" id="isi" class="form-control mb-2" cols="30" rows="10"> @if (!empty($about))
{{ $about->isi }}
@endif
</textarea>
                                <div class="invalid-feedback" id="isi-error">

                                </div>
                                <button class="btn btn-primary float-right">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="footer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_form_footer" class="row">
                        @csrf
                        <div class="form-group col-12">
                            <label for="name">Nama Copyright</label>
                            <input type="hidden" name="old_id"
                                @if ($setting_footer) value="{{ $setting_footer->id }} @endif">
                            <input name="name" id="name" class="form-control"
                                @if ($setting_footer) value="{{ $setting_footer->name }} @endif">
                            <div class="invalid-feedback" id="name-error">

                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="lokasi">Lokasi</label>
                            <input name="lokasi" id="lokasi" class="form-control"
                                @if ($setting_footer) value="{{ $setting_footer->lokasi }} @endif">
                            <div class="invalid-feedback" id="lokasi-error">

                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="g_map">Google Map</label>
                            <input name="g_map" id="g_map" class="form-control"
                                @if ($setting_footer) value="{{ $setting_footer->g_map }} @endif">
                            <div class="invalid-feedback" id="g_map-error">

                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="facebook">Link Facebook</label>
                            <input name="facebook" id="facebook" class="form-control"
                                @if ($setting_footer) value="{{ $setting_footer->facebook }} @endif">
                            <div class="invalid-feedback" id="facebook-error">

                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="instagram">Link Instagram</label>
                            <input name="instagram" id="instagram" class="form-control"
                                @if ($setting_footer) value="{{ $setting_footer->instagram }} @endif">
                            <div class="invalid-feedback" id="instagram-error">

                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="youtube">Link Youtube</label>
                            <input name="youtube" id="youtube" class="form-control"
                                @if ($setting_footer) value="{{ $setting_footer->youtube }} @endif">
                            <div class="invalid-feedback" id="youtube-error">

                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="no_telp">No Telphone</label>
                            <input name="no_telp" id="no_telp" class="form-control"
                                @if ($setting_footer) value="{{ $setting_footer->no_telp }} @endif">
                            <div class="invalid-feedback" id="no_telp-error">

                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        id="kembali_kategori">Kembali</button>
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
                            <label for="judul_slide">Judul Slide</label>
                            <input name="judul_slide" id="judul_slide" class="form-control">
                            <div class="invalid-feedback" id="judul_slide-error">

                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="jabatan">isi</label>
                            <textarea name="isi" id="isi" class="form-control" rows="3"></textarea>
                            <div class="invalid-feedback" id="isi-error">

                            </div>
                        </div>
                        <div class="form-group col-sm-8">
                            <label for="">Gambar Slide</label>
                            <input type="file" class="form-control" name="gambar_slide" id="gambar_slide"
                                onchange="document.getElementById('ba').src = window.URL.createObjectURL(this.files[0])">
                            <div class="invalid-feedback " id='gambar_slide-error'>

                            </div>
                        </div>
                        <div class="form-group col-sm-4 mb-2">
                            <img src="https://dummyimage.com/hd1080" id="ba" alt="your image" width="150"
                                height="150">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" id="kembali"
                        data-dismiss="modal">Kembali</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="judul_gambar_isi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_form_judul_gambar_isi" class="row">
                        @csrf
                        <div class="form-group col-12">
                            <label for="kategori">Kategori</label>
                            <select name="kategori" class="form-control" id="kategori">
                                <option selected disabled>-- Pilih Kategori --</option>
                                <option value="profil">Profile</option>
                                <option value="visi_misi">Visi Misi</option>
                                <option value="visi_misi">Visi </option>
                            </select>
                            <div class="invalid-feedback" id="kategori-error">

                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="judul">Judul</label>
                            <input name="judul" id="judul" class="form-control">
                            <div class="invalid-feedback" id="judul-error">

                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="isi">isi</label>
                            <textarea name="isi" id="isi" class="form-control" rows="3"></textarea>
                            <div class="invalid-feedback" id="isi-error">

                            </div>
                        </div>
                        <div class="form-group col-sm-8">
                            <label for="">Gambar</label>
                            <input type="file" class="form-control" name="gambar" id="input_gambar"
                                onchange="previewImage()">
                            <div class="invalid-feedback " id='input_gambar-error'></div>
                        </div>
                        <div class="form-group col-sm-4 mb-2">
                            <img src="https://dummyimage.com/hd1080" id="preview_gambar" alt="your image" width="150"
                                height="150">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" id="kembali"
                        data-dismiss="modal">Kembali</button>
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
                    <h5 class="modal-title">Edit Slider</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_form" class="row">
                        @csrf
                        <div class="form-group col-12">
                            <label for="judul_edit">Judul</label>
                            <input type="hidden" name="id" id="id_slide" class="form-control">
                            <input type="hidden" name="old_gambar_slide" id="old_gambar_slide" class="form-control">
                            <input name="judul_edit" id="judul_edit" class="form-control">
                            <div class="invalid-feedback" id="judul_edit-error">

                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="isi_edit">Isi</label>
                            <textarea name="isi_edit" id="isi_edit" rows="3" class="form-control"></textarea>
                            <div class="invalid-feedback" id="isi_edit-error">

                            </div>
                        </div>
                        <div class="form-group col-sm-8">
                            <label for="">Gambar Slide</label>
                            <input type="file" class="form-control" name="gambar_slide" id="gambar_slide_edit"
                                onchange="document.getElementById('ba_edit').src = window.URL.createObjectURL(this.files[0])">
                            <div class="invalid-feedback " id='gambar_slide-error'>

                            </div>
                        </div>
                        <div class="form-group col-sm-4 mb-2">
                            <img id="ba_edit" alt="your image" width="100" height="100">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" id="kembali"
                        data-dismiss="modal">Kembali</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModalJudulGambarIsi" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Setting Gambar Halaman Lain</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_form_2" class="row">
                        @csrf
                        <div class="form-group col-12">
                            <label for="judul_gambar_isi_edit">Judul</label>
                            <input type="hidden" name="id" id="id_judul_gambar_isi" class="form-control">
                            <input type="hidden" name="old_gambar" id="old_gambar" class="form-control">
                            <input name="judul_gambar_isi_edit" id="judul_gambar_isi_edit" class="form-control">
                            <div class="invalid-feedback" id="judul_gambar_isi_edit-error">

                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="judul_isi_edit">Isi</label>
                            <textarea name="judul_isi_edit" id="judul_isi_edit" rows="3" class="form-control"></textarea>
                            <div class="invalid-feedback" id="judul_isi_edit-error">

                            </div>
                        </div>
                        <div class="form-group col-sm-8">
                            <label for="">Gambar</label>
                            <input type="file" class="form-control" name="gambar" id="gambar_edit"
                                onchange="document.getElementById('file_gambar_edit').src = window.URL.createObjectURL(this.files[0])">
                            <div class="invalid-feedback " id='gambar-error'>

                            </div>
                        </div>
                        <div class="form-group col-sm-4 mb-2">
                            <img id="file_gambar_edit" alt="your image" width="100" height="100">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" id="kembali"
                        data-dismiss="modal">Kembali</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="data_judul_gambar_isi" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Data Setting Gambar Halaman Lain</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="example2" class="table table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Isi</th>
                                <th>Gambar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="add_new">
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Isi</th>
                                <th>Gambar</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        function previewImage() {
            var input = document.getElementById('input_gambar');
            var preview = document.getElementById('preview_gambar');
            preview.src = window.URL.createObjectURL(input.files[0]);
        }
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
                    }
                ],
                processing: true,
                serverSide: true,
                type: 'post',
                ajax: {
                    url: "{{ route('setting_halaman_utama.index') }}",
                },
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
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
                        data: 'gambar_slide',
                        name: 'gambar_slide'
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
                    }
                ],
                processing: true,
                serverSide: true,
                type: 'post',
                ajax: {
                    url: "{{ route('juduL_gambar_isi.index') }}",
                },
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
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
                        data: 'gambar_halaman_lain',
                        name: 'gambar_halaman_lain'
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

        $("#add_form_footer").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = "{{ route('setting_halaman_utama.setting_footer') }}";
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

                    } else if (response.status == 200) {
                        toastr.success(response.message);
                        $('#btn_add').prop('disabled', false);

                        // 🔥 cara 1 (bootstrap 4)
                        $('#footer').modal('hide');

                        // 🔥 cara 2 (fallback - paksa hilang)
                        $('#footer').removeClass('show');
                        $('.modal-backdrop').remove();
                        $('body').removeClass('modal-open');

                        $("#add_form_footer")[0].reset();

                        $('#example1').DataTable().ajax.reload();
                    }
                },
            });
        });

        $("#add_form").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = "{{ route('setting_halaman_utama.store') }}";
            $('#btn_add').prop('disabled', true);

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {

                    if (response.status == 200) {

                        toastr.success(response.message);

                        // 🔥 FORCE CLOSE MODAL (INI PALING AMPUH)
                        $('#exampleModal').removeClass('show');
                        $('#exampleModal').css('display', 'none');

                        $('.modal-backdrop').remove();
                        $('body').removeClass('modal-open');
                        $('body').css('padding-right', '');

                        $("#add_form")[0].reset();
                        $('#ba').attr('src', 'https://dummyimage.com/hd1080');

                        $('#example1').DataTable().ajax.reload();
                    }
                }
            });
        });

        $("#add_form_judul_gambar_isi").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = "{{ route('juduL_gambar_isi.store') }}";
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

                    } else if (response.status == 200) {
                        toastr.success(response.message);
                        $('#btn_add').prop('disabled', false);
                        $('#judul_gambar_isi').modal('hide');
                        $("#judul_gambar_isi")[0].reset(); // Fix here
                        $('#judul_gambar').attr('src', 'https://dummyimage.com/hd1080');
                        $('#example2').DataTable().ajax.reload();
                    }
                },
            });
        });

        $("#form_about").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = "{{ route('setting_halaman_utama.about') }}";

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
                    } else if (response.status == 200) {
                        toastr.success(response.message);
                    }
                },
            });
        });


        // modal edit
        $('#example1').on('click', '.edit-button', function() {
            var rowId = $(this).data('row-id');
            $.ajax({
                type: 'GET',
                data: 'data=' + rowId,
                url: "{{ route('setting_halaman_utama.getData') }}",
                dataType: 'json',
                success: function(response) {
                    $('#id_slide').val(response.data.id);
                    $('#old_gambar_slide').val(response.data.gambar_slide);
                    $('#judul_edit').val(response.data.judul);
                    $('#isi_edit').val(response.data.isi);
                    $('#ba_edit').attr('src', "{{ asset('gambar_slide') }}/" + response.data
                        .gambar_slide);
                },
            });
        });


        $('#edit_form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = "{{ route('setting_halaman_utama.updated') }}";
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

                    } else {
                        toastr.success(response.message);
                        $('#btn_add').prop('disabled', false);
                        $('#editModal').modal('hide');
$('#editModal').removeClass('show');
$('.modal-backdrop').remove();
$('body').removeClass('modal-open');
$('body').css('padding-right', '');
                        $("#edit_form")[0].reset();
                        $('#example1').DataTable().ajax.reload();
                    }
                },
            });
        });

        $('#example2').on('click', '.edit-button', function() {
            var rowId = $(this).data('id');
            $('#data_judul_gambar_isi').modal('hide');

            $.ajax({
                type: 'GET',
                data: 'data=' + rowId,
                url: "{{ route('juduL_gambar_isi.getData') }}",
                dataType: 'json',
                success: function(response) {
                    $('#id_judul_gambar_isi').val(response.data.id);
                    $('#old_gambar').val(response.data.gambar);
                    $('#judul_gambar_isi_edit').val(response.data.judul);
                    $('#judul_isi_edit').val(response.data.isi);
                    $('#file_gambar_edit').attr('src', "{{ asset('file_gambar_halaman_lain') }}/" +
                        response.data.gambar);
                    $('#editModalJudulGambarIsi').modal('show');
                },
            });
        });

        $('#edit_form_2').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = "{{ route('juduL_gambar_isi.updated') }}";
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

                    } else {
                        toastr.success(response.message);
                        $('#btn_add').prop('disabled', false);
                        $('#editModalJudulGambarIsi').modal('hide');
                        $('#editModalJudulGambarIsi').removeClass('show');
                        $('.modal-backdrop').remove();
                        $('body').removeClass('modal-open');
                        $('body').css('padding-right', '');
                        $('#example2').DataTable().ajax.reload();
                    }
                },
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
                            url: "{{ route('setting_halaman_utama.delete') }}",
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

        function deleteJudulGambarIsi(id) {
            Swal.fire({
                title: 'Apakah Kamu ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{ route('juduL_gambar_isi.delete') }}",
                        type: "POST",
                        data: {
                            ids: id,
                            _token: "{{ csrf_token() }}" // 🔥 WAJIB
                        },
                        success: function(response) {
                            toastr.success(response.message);
                            $('#example2').DataTable().ajax.reload();
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                            Swal.fire('Error!', 'Gagal menghapus data', 'error');
                        }
                    });

                }
            });
        }

        $("#link_video").on('keyup', function() {
            $("#link_video").removeClass('is-invalid'); // Remove is-invalid class on keyup
        });
        $("#isi").on('keyup', function() {
            $("#isi").removeClass('is-invalid'); // Remove is-invalid class on keyup
        });
    </script>
@endsection
