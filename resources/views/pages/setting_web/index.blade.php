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
    </style>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="toastContainer"></div>
    </div>

    <div class="container-fluid p-5" id="container-wrapper">
        <!-- Row -->
        <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12 mb-5">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <ul class="navbar-nav">
                                    <li class="nav-item mb-1">
                                        <span class="text-primary" style="cursor: pointer; font-weight:bold;">Setting
                                            Instansi, Logo *</span>
                                    </li>
                                    <small>Update Informasi Instansi, Logo</small>
                                </ul>
                            </div>
                            <div class="col-md-8 mb-3" style="float:right">
                                <form id="add_form">
                                    <div class="row">

                                        @csrf
                                        <div class="form-group col-sm-12">
                                            <label for="">Nama Website</label>
                                            <input type="text" class="form-control" name="nama_web" id="nama_web"
                                                @if (!empty($setting)) value="{{ $setting->nama_web }}" @endif>
                                            {{-- old --}}
                                            <input type="hidden" class="form-control" name="old_logo" id="old_logo"
                                                @if (!empty($setting)) value="{{ $setting->logo_web }}" @endif>
                                            <input type="hidden" class="form-control" name="old_logo_sidebar"
                                                id="old_logo_sidebar"
                                                @if (!empty($setting)) value="{{ $setting->logo_sidebar }}" @endif>
                                            <input type="hidden" class="form-control" name="id_setting" id="id_setting"
                                                @if (!empty($setting)) value="{{ $setting->id }}" @endif>
                                            <div class="invalid-feedback " id='brand-error'>

                                            </div>
                                        </div>
                                        <div class="form-group col-sm-8">
                                            <label for="">Logo</label>
                                            <input type="file" class="form-control" name="logo_web" id="logo_web"
                                                onchange="document.getElementById('ba').src = window.URL.createObjectURL(this.files[0])">
                                            <div class="invalid-feedback " id='logo_web-error'>

                                            </div>
                                        </div>
                                        <div class="form-group col-sm-4 mb-2">
                                            @if (!empty($setting))
                                                <img src="{{ asset('logo') }}/<?= $setting->logo_web ?>" id="ba"
                                                    alt="your image" width="100" height="100">
                                            @else
                                                <img src="https://previews.123rf.com/images/aquir/aquir1411/aquir141100300/33838205-example-blue-square-stamp-isolated-on-white-background.jpg"
                                                    id="ba" alt="your image" width="100" height="100">
                                            @endif
                                        </div>
                                    </div>

                            </div>
                            <div class="col-md-4 mt-5">
                                <ul class="navbar-nav">
                                    <li class="nav-item mb-1">
                                        <span class="text-primary" style="cursor: pointer; font-weight:bold;">Setting
                                            Version,
                                            Logo Sidebar *</span>
                                    </li>
                                    <small>Update Informasi Halaman Utama</small>
                                </ul>
                            </div>
                            <div class="col-md-8 mt-5" style="float:right">
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="">Version</label>
                                        <input type="text" class="form-control " name="version" id="version"
                                            @if (!empty($setting)) value="{{ $setting->version }}" @endif>
                                        <div class="invalid-feedback " id='version-error'>

                                        </div>
                                    </div>
                                    <div class="form-group col-sm-8">
                                        <label for="">Logo Sidebar</label>
                                        <input type="file" class="form-control" name="logo_sidebar" id="logo_sidebar"
                                            onchange="document.getElementById('bleh').src = window.URL.createObjectURL(this.files[0])">
                                        <div class="invalid-feedback " id='logo_sidebar-error'>

                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4 mb-2">
                                        @if (!empty($setting))
                                            <img src="{{ asset('logo') }}/{{ $setting->logo_sidebar }}" id="bleh"
                                                alt="your image" width="100" height="100">
                                        @else
                                            <img src="https://previews.123rf.com/images/aquir/aquir1411/aquir141100300/33838205-example-blue-square-stamp-isolated-on-white-background.jpg"
                                                id="bleh" alt="your image" width="100" height="100">
                                        @endif
                                        <br>
                                        <small>Rekomendasi Gambar ukuran 720 x 646 px </small>
                                        <button type="submit" id="btn_add" class="btn btn-primary mt-5"
                                            style="float:right;">Kirim</button>

                                    </div>

                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- DataTable with Hover -->
    </div>
    </div>
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

    <script>
        $("#add_form").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = "{{ route('setting_web.store') }}";
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
                            $('#' + field + '-error').text(errors[0]).wrapInner("<strong />");
                        });
                        $('#btn_add').prop('disabled', false);


                    } else if (response.status == 401) {
                        toastr.error(response.errors);
                        $('#btn_add').prop('disabled', false);


                    } else if (response.status == 200) {
                        toastr.success(response.message);
                        $('#btn_add').prop('disabled', false);
                        $('#version_footer').html('<b>Version</b> ' + response.data.version);
                        $('#logo-sidebar').attr('src', "{{ asset('logo') }}/"+response.data.logo_sidebar);
                        $('#myIconLink').attr('src', "{{ asset('logo') }}/"+response.data.logo_sidebar);
                        $('#nama_web').html(response.data.nama_web);
                    }
                },
            });
        });



        $('#logo').on('change', function() {
            $('#logo').removeClass('is-valid is-invalid');
        });
        $('#image').on('change', function() {
            $('#image').removeClass('is-valid is-invalid');
        });

        $('#brand').on('click', function() {
            $('#brand').removeClass('is-valid is-invalid');
        });

        $('#title_pertama').on('click', function() {
            $('#title_pertama').removeClass('is-valid is-invalid');
        });

        $('#title_kedua').on('click', function() {
            $('#title_kedua').removeClass('is-valid is-invalid');
        });

        $('#about').on('click', function() {
            $('#about').removeClass('is-valid is-invalid');
        });

        $('#email').on('click', function() {
            $('#email').removeClass('is-valid is-invalid');
        });
        $('#no_telp').on('click', function() {
            $('#no_telp').removeClass('is-valid is-invalid');
        });
        $('#alamat').on('click', function() {
            $('#alamat').removeClass('is-valid is-invalid');
        });
    </script>
@endsection
