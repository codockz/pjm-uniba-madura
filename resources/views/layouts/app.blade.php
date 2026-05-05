<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if (!empty($setting))
        <title>{{ $title ?? 'Admin Panel' }}</title>
    @else
        <title>Pusat Jaminan Mutu | Uniba Madura</title>
    @endif


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">



    <link rel="stylesheet"
        href="https://adminlte.io/themes/v3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="https://adminlte.io/themes/v3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet"
        href="https://adminlte.io/themes/v3/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css">
    @if (!empty($setting))
        <link rel="icon" type="image/x-icon" href="{{ asset('logo') }}/{{ $setting->logo_web }}" id="myIconLink">
    @else
        <link rel="icon" type="image/x-icon" href="{{ asset('logo/logo.png') }}" id="myIconLink">
    @endif

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('logo/logo_unibamadura.png') }}" alt="AdminLTELogo"
                height="25%" width="50%">

        </div>

        <!-- Navbar -->
        @include('layouts.nav')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            {{-- <h1 class="m-0">{{ $title }}</h1> --}}
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            @yield('content')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('layouts.footer')
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('assets/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    {{-- pop up --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    {{-- // search engine// --}}

    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('assets/dist/js/pages/dashboard.js') }}"></script>

    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#toggleButton').click(function() {
                // Toggle push menu (you can adjust this based on your push menu logic)
                // For demonstration purposes, toggle a class on body
                $('body').toggleClass('menu-open');

                // Change logo image based on the menu state
                var logoImg = $('#logo-sidebar');
                if ($('body').hasClass('menu-open')) {
                    logoImg.attr('src', "{{ asset('logo/logo.png') }}");
                    logoImg.css('width', '50px');
                } else {
                    logoImg.attr('src',
                        "{{ asset('logo/logo-invers.png') }}");
                    logoImg.css('width', '220px');
                }
            });
        });
    </script>
    @if (session('success'))
        <script>
            toastr.success("{{ session('success') }}", "Berhasil", {
                positionClass: "toast-top-right",
                timeOut: 3000,
                closeButton: true,
                progressBar: true
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            toastr.error("{{ session('error') }}", "Gagal", {
                positionClass: "toast-top-right",
                timeOut: 3000,
                closeButton: true,
                progressBar: true
            });
        </script>
    @endif


    <script>
        /* delete */
document.addEventListener('click', function (e) {

    if (e.target.closest('.delete-confirm')) {

        e.preventDefault();

        let button = e.target.closest('.delete-confirm');
        let form = button.closest('form');

        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Data akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#6c757d'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });

    }

});
</script>

    <style>
        .card {
            border-radius: 18px;
        }

        .btn {
            border-radius: 12px;
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
            transition: 0.2s;
        }

        .card {
            border-radius: 14px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
        }

        .btn {
            transition: 0.2s ease-in-out;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        /* FIX AREA PUTIH DROPDOWN */
        .navbar-nav .nav-item {
            width: auto !important;
        }

        .navbar-nav .nav-link {
            display: inline-block !important;
            width: auto !important;
            padding: 5px 10px !important;
        }

        .small-box {
            border-radius: 14px;
            transition: all 0.2s ease;
        }

        .small-box:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .small-box .icon {
            opacity: 0.25;
        }

        .content-wrapper {
            padding-top: 10px;
        }

        .btn-sm {
            margin-right: 3px;
        }

        .btn-sm {
            margin-right: 3px;
        }
    </style>
    <script>
        function loadData(url = null) {

            let form = document.getElementById('filterForm');
            let formData = new URLSearchParams(new FormData(form));

            if (!url) {
                url = "{{ route('admin.daftar_asesor_bkd.index') }}";
            }

            let finalUrl = new URL(url, window.location.origin);

            formData.forEach((value, key) => {
                finalUrl.searchParams.set(key, value);
            });

            fetch(finalUrl, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(data => {
                    document.getElementById('tableData').innerHTML = data;
                });
        }

        // Auto filter select
        document.querySelectorAll('#filterForm select').forEach(el => {
            el.addEventListener('change', function() {
                loadData();
            });
        });

        // Search delay
        let typingTimer;
        const searchInput = document.querySelector('input[name="search"]');

        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(() => {
                    loadData();
                }, 500);
            });
        }

        // Pagination AJAX
        document.addEventListener('click', function(e) {
            if (e.target.closest('.pagination a')) {
                e.preventDefault();
                let url = e.target.closest('a').getAttribute('href');
                loadData(url);
            }
        });
    </script>
    <style>
        .custom-select-clean {
            height: 45px;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            transition: all 0.2s ease-in-out;
        }

        .custom-select-clean:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, .25);
        }

        .form-label {
            font-weight: 600;
            font-size: 14px;
        }
    </style>
    <style>
        .form-group-modern label {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 6px;
            color: #495057;
        }

        .form-control-modern {
            height: 45px;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            transition: all 0.2s ease-in-out;
        }

        .form-control-modern:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, .25);
        }

        .card {
            border-radius: 12px;
        }
    </style>
    <style>
        .input-error {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.15rem rgba(220, 53, 69, .25);
        }

        .error-text {
            font-size: 13px;
            color: #dc3545;
            margin-top: 5px;
        }
    </style>
    <script>
        /* GLOBAL DATATABLE ADMIN */
        function initDataTable(selector) {

    if ($.fn.DataTable.isDataTable(selector)) {
        return $(selector).DataTable(); // ambil instance kalau sudah ada
    }

    return $(selector).DataTable({
        responsive: true,
        autoWidth: false,
        pageLength: 10,
        ordering: false,

        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            paginate: {
                previous: "Sebelumnya",
                next: "Selanjutnya"
            }
        }
    });
}

        $(document).ready(function () {

    $(".datatable").each(function () {

        let tableId = "#" + $(this).attr("id");

        initDataTable(tableId);

    });

});


    </script>
    @stack('scripts')
    <style>
        .table td {
            vertical-align: middle;
        }

        /* Kolom panjang */
        .tentang-col {
            max-width: 250px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Kolom aksi */
        .col-aksi {
            width: 120px;
            white-space: nowrap;
        }

        /* Kolom file */
        .col-file {
            width: 120px;
        }

        .table-hover tbody tr:hover {
            background-color: #eef4ff;
            transition: 0.2s;
        }
        .filter-select {
    width: 100px; /* kecilin panjang */
    border-radius: 8px;
    padding: 2px 8px;
}
    </style>

</body>

</html>
