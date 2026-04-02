<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pusat Jaminan Mutu - UNIBA MADURA</title>

    <!-- PLUGINS CSS STYLE -->
    @include('frontend_layouts.link_css')
    <style>
        /* Kecilkan jarak antar menu */
        .navbar-nav>li>a {
            padding-left: 6px;
            padding-right: 6px;
            font-size: 12px;
            /* sedikit diperkecil */
            white-space: nowrap;
            /* cegah turun baris */
        }

        /* Supaya sejajar logo */
        .navbar-nav {
            display: flex;
            align-items: center;
        }

        .page-content {
            margin-top: 40px;
        }

        /* Logo tidak terlalu makan tempat */
        .navbar-brand img {
            max-width: 200px;
        }

        .dataTables_wrapper {
            font-size: 14px;
        }

        .dataTables_length select {
            padding: 4px;
        }

        .dataTables_filter input {
            padding: 4px;
            border: 1px solid #ccc;
        }


        .dataTables_filter input {
            border-radius: 6px;
            padding: 5px 10px;
            border: 1px solid #ccc;
        }

        .dataTables_length select {
            border-radius: 6px;
            padding: 4px 6px;
        }

        .dataTables_paginate .paginate_button {
            border-radius: 4px !important;
        }

        /* Rapikan posisi atas */
        .dataTables_wrapper .row:first-child {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* Search rata kanan */
        .dataTables_filter {
            text-align: right !important;
        }

        /* Hilangkan jarak berlebih */
        .dataTables_length,
        .dataTables_filter {
            margin-bottom: 10px;
        }

        /* #asesorTable thead th {
            background-color: #cfe0ea;
            color: #000;
            font-weight: 600;
            border-bottom: 2px solid #b7cbd6;
        } */

        .dataTables_paginate .paginate_button {
            padding: 6px 12px !important;
            border: 1px solid #ddd !important;
            background: #f8f8f8 !important;
            margin-left: 4px;
        }

        .dataTables_paginate .paginate_button.current {
            background-color: #996533 !important;
            color: #fff !important;
            border-color: #996533 !important;
        }

        #asesorTable {
            font-size: 14px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            background: transparent !important;
            border: none !important;
            color: #8b5e34 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            font-weight: bold;
        }


        .dropdown>a:hover {
            color: #006634 !important;
        }

        .dropdown-menu>li>a:hover {
            color: #006634 !important;
        }

        .captionLink {
            background-color: #996533;
        }

        .captionLink:hover {
            background-color: #996533;
        }

        .formArea.clearfix {
            border-top: 3px solid #006634;
        }

        .commonBtn,
        .commonBtn:hover {
            background-color: #006634;
        }

        .list_block.related_post_sec {
            border-top: 3px solid #006634;
        }

        .learnBtn {
            background-color: #996533 !important;
            border: 1px solid #996533 !important;
        }

        .img-anggota {
            margin-bottom: 55px !important;
            /* justify-content: center; */
        }

        .dropdown>a:hover {
            color: #006634 !important;
        }

        .dropdown-menu>li>a:hover {
            color: #006634 !important;
        }

        .captionLink {
            background-color: #996533;
        }

        .captionLink:hover {
            background-color: #996533;
        }

        .formArea.clearfix {
            border-top: 3px solid #006634;
        }

        .commonBtn,
        .commonBtn:hover {
            background-color: #006634;
        }

        .list_block.related_post_sec {
            border-top: 3px solid #006634;
        }

        .learnBtn {
            background-color: #996533 !important;
            border: 1px solid #996533 !important;
        }

        .img-anggota {
            margin-bottom: 55px !important;
        }

        /* DESKTOP */
        @media (min-width: 992px) {

            .navbar-flex {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .navbar-header {
                display: flex;
                align-items: center;
                margin-left: -70px;
            }

            .navbar-brand {
                margin-right: 5px;
                padding: 0;
            }

            .navbar-brand img.logo {
                height: 55px;
                margin: 0;
            }

            .navbar-collapse {
                display: flex !important;
                justify-content: flex-end;
            }

            .navbar-nav>li>a {
                padding: 20px 8px;
                font-size: 14px;
                white-space: nowrap;
            }

            .navbar-toggle {
                display: none;
            }
        }

        /* MOBILE */
        @media (max-width: 800px) {

            .navbar-brand img.logo {
                height: 45px;
            }

            .navbar-toggle {
                margin-top: 10px;
            }

            .navbar-collapse {
                background-color: #2e082d;
            }

            .navbar-nav>li>a {
                padding: 10px 12px;
                font-size: 10px;
            }
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            padding: 0;
        }

        .navbar-brand img.logo {
            height: 40px;
            width: auto;
            display: block;
        }

        .navbar-collapse {
            flex-grow: 1;
        }

        .navbar-nav {
            margin-left: auto;
        }

        /* ===============================
   CSS UNTUK DROPDOWN SUBMENU
================================ */

        /* Dropdown Submenu Styling */
        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu>.dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -6px;
            margin-left: -1px;
            border-radius: 0 6px 6px 6px;
        }

        .dropdown-submenu:hover>.dropdown-menu {
            display: block;
        }

        .dropdown-submenu>a:after {
            display: block;
            content: " ";
            float: right;
            width: 0;
            height: 0;
            border-color: transparent;
            border-style: solid;
            border-width: 5px 0 5px 5px;
            border-left-color: #ccc;
            margin-top: 5px;
            margin-right: -10px;
        }

        .dropdown-submenu:hover>a:after {
            border-left-color: #fff;
        }

        /* Untuk mobile, submenu tampil dibawah */
        @media (max-width: 767px) {
            .dropdown-submenu>.dropdown-menu {
                position: static;
                float: none;
                width: auto;
                margin-top: 0;
                background-color: #f5f5f5;
                border: 0;
                box-shadow: none;
            }

            .dropdown-submenu>a:after {
                display: none;
            }

            .dropdown-submenu>.dropdown-menu>li>a {
                padding-left: 30px;
            }
        }

        /* Hover effect untuk dropdown menu */
        .dropdown-menu>li>a:hover,
        .dropdown-menu>li>a:focus {
            background-color: #f5f5f5;
            color: #006634 !important;
        }

        .dropdown-submenu>.dropdown-menu>li>a:hover,
        .dropdown-submenu>.dropdown-menu>li>a:focus {
            background-color: #e8e8e8;
            color: #006634 !important;
        }

        /* Arrow icon untuk submenu */
        .dropdown-submenu>a .fa-angle-right {
            margin-top: 3px;
        }

        /* === DROPDOWN SUBMENU === */
        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu>.dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -1px;
            border-radius: 0;
        }

        /* tampil saat hover */
        .dropdown-submenu:hover>.dropdown-menu {
            display: block;
        }



        /* warna hover */
        .dropdown-menu>li>a:hover,
        .dropdown-submenu:hover>a {
            background-color: #f6a623;
            color: #fff;
        }

        .nav-treeview .nav-treeview .nav-link {
            padding-left: 45px;
            font-size: 13px;
        }

        .asesor-card {
            border-radius: 16px;
            transition: all 0.3s ease;
        }

        .asesor-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        }

        .avatar-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #146c43;
            /* hijau uniba */
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 18px;
        }

        /* DROPDOWN MODERN */
        .navbar .dropdown-menu {
            border-radius: 12px;
            padding: 10px;
            border: none;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            animation: fadeIn 0.2s ease-in-out;
        }

        /* ITEM */
        .dropdown-menu .dropdown-item {
            border-radius: 8px;
            padding: 10px 14px;
            transition: 0.2s;
        }

        /* HOVER */
        .dropdown-menu .dropdown-item:hover {
            background-color: #f1f5ff;
            color: #0d6efd;
            transform: translateX(3px);
        }

        /* ANIMASI */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .navbar .dropdown:hover>.dropdown-menu {
            display: block;
        }

        margin-top: 0;




        /* ===== STYLE DATATABLES PJM ===== */

        /* table.dataTable thead th {
            background: linear-gradient(45deg, #0d6efd, #0b5ed7) !important;
            color: #fff !important;
            font-weight: 600;
        } */

        .dataTables_wrapper .dataTables_length select {
            border-radius: 6px;
            padding: 3px 8px;
        }

        .dataTables_wrapper .dataTables_filter input {
            border-radius: 6px;
            padding: 5px 8px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #8b5e34 !important;
            color: #fff !important;
            border: none;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #a47245 !important;
            color: #fff !important;
        }

        .dataTables_info {
            font-size: 14px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 6px !important;
            padding: 6px 10px !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #0d6efd !important;
            color: white !important;
        }

        /* ===== GLOBAL TABLE STYLE ===== */
        .table {
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead th {
            background: linear-gradient(45deg, #0d6efd, #0b5ed7);
            color: #fff;
            font-weight: 600;
            text-align: center;
        }

        .table tbody td {
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #f5f7fa;
            transition: 0.2s;
        }

        /* Link dalam tabel */
        .table a {
            color: #333;
            font-weight: 500;
            text-decoration: none;
        }

        .table a:hover {
            color: #0d6efd;
            text-decoration: underline;
        }

        /* Badge */
        .badge {
            border-radius: 20px;
            font-size: 12px;
        }

        /* DataTables */
        .dataTables_filter input {
            border-radius: 20px;
            padding: 6px 10px;
        }

        .dataTables_length select {
            border-radius: 10px;
            padding: 4px;
        }

        .table {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        }

        /* Hover baris */
        .table tbody tr:hover {
            background: #eef5ff;

            transition: 0.2s;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-success {
            background: linear-gradient(45deg, #198754, #157347);
            color: #fff;
        }

        .tentang-col {
            max-width: 300px;
            white-space: normal;
            word-break: break-word;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .table td {
            vertical-align: top;
        }

        h2 {
            font-size: 28px;
        }

        .btn-primary {
            background-color: #2f5d8a;
            border: none;
        }

        .btn-primary:hover {
            background-color: #24496b;
        }

        img {
            border-radius: 6px;
        }

        h2 {
            margin-top: 20px;
        }

        img {
            margin-top: 10px;
        }

        .img-hover {
            cursor: pointer;
            transition: 0.3s;
        }

        .img-hover:hover {
            transform: scale(1.05);
        }

        /* ===== FIX FOOTER GLOBAL ===== */
        html,
        body {
            height: 100%;
        }

        .body-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main_wrapper {
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        main {
            flex: 1;
        }

        .coming-soon-box {
            max-width: 600px;
            margin: auto;
            padding: 40px 20px;
            border: 2px dashed #ccc;
            border-radius: 12px;
            background: #fafafa;
            color: #555;
            transition: 0.3s;
        }

        .coming-soon-box:hover {
            background: #f5f5f5;
            border-color: #999;
        }

        .center-section {
            min-height: 70vh;
            padding-top: 80px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }
    </style>


</head>

<body class="body-wrapper ">

    <div class="main_wrapper">
        @include('frontend_layouts.nav')

        <main>
            @yield('content')
    </main>

        @include('frontend_layouts.footer')
    </div>

    <!-- JQUERY SCRIPTS -->
    @include('frontend_layouts.script_js')
    @stack('scripts')
    <script>
        function initFrontendDataTable(tableID) {
            $(tableID).DataTable({
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100],
                autoWidth: false,
                responsive: true,

                language: {
                    lengthMenu: "Tampilkan _MENU_ entri",
                    search: "Cari:",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    zeroRecords: "Data tidak ditemukan",
                    paginate: {
                        previous: "←",
                        next: "→"
                    }
                },

                dom: '<"row mb-3"' +
                    '<"col-md-6"l>' +
                    '<"col-md-6 text-end"f>' +
                    '>' +
                    'rt' +
                    '<"row mt-3"' +
                    '<"col-md-6"i>' +
                    '<"col-md-6 text-end"p>' +
                    '>'
            });
        }
    </script>


</body>

</html>
