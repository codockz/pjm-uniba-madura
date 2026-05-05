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



        .dropdown:hover > .dropdown-menu {
    display: block;
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

       .dropdown-submenu {
    position: relative;
}


.dropdown-submenu > .dropdown-menu {
    top: 0;
    left: 100%;
    transform: translateX(-2px);
}
/* 🔥 jembatan hover */
.dropdown-submenu > .dropdown-menu::before {
    content: "";
    position: absolute;
    left: -15px;
    top: 0;
    width: 15px;
    height: 100%;
}




.dropdown-menu li {
    position: relative;
}
.dropdown-menu {
    padding: 8px 0;
}

.dropdown-menu > li > a {
    padding: 10px 20px;
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
            background: linear-gradient(45deg, #006634, #004d26) !important;
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
            background: linear-gradient(45deg, #22924f, #02ac5a);
            color: #fff;
            font-weight: 600;
            text-align: center;
        }


        /* Header tabel center, isi tabel rata kiri */
        table.dataTable thead th {
            text-align: center !important;
        }

        table.dataTable tbody td {
            text-align: left !important;
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

        /* Baris datatable */
        .dataTables_wrapper .dataTables_length {
            float: left;
        }

        .dataTables_wrapper .dataTables_filter {
            float: right;
        }

        /* Biar sejajar */
        .dataTables_length label,
        .dataTables_filter label {
            display: flex;
            align-items: center;
            gap: 6px;
            margin: 0;
        }

        /* Search */
        .dataTables_filter input {
            width: 200px;
        }

        /* Dropdown filter */
        #filterTahun {
            height: 31px;
        }

        .filter-wrapper {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .filter-icon {
            font-size: 14px;
            color: #6c757d;
        }

        .filter-select {
            width: 130px;
            height: 31px;
            padding-left: 10px;
            padding: 2px 6px;
        }

        .filter-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .filter-label {
            font-size: 13px;
            color: #6c757d;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .filter-select {
            width: 100px;
            height: 20px;
            border-radius: 6px;
        }

        .filter-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 6px;
        }

        .filter-label {
            font-size: 13px;
            color: #6c757d;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .filter-select {
            width: 100px;
            height: 32px;
            border-radius: 8px;
        }

        .filter-select:hover {
            border-color: #0d6efd;
        }

        .page-content h3 {
            margin-bottom: 40px;
        }

        .filter-label {
            font-size: 12px;
        }

        .arsip-scroll {
            max-height: 200px;
            /* tinggi box */
            overflow-y: auto;
            /* scroll aktif */
            padding-right: 5px;
        }

        /* optional biar lebih smooth */
        .arsip-scroll li {
            margin-bottom: 6px;
        }

        /* scrollbar custom (biar lebih cakep) */
        .arsip-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .arsip-scroll::-webkit-scrollbar-thumb {
            background-color: #877272;
            border-radius: 10px;
        }

        .arsip-scroll {
            max-height: 150px;
            overflow-y: auto;
            padding: 10px;
            border: 1px solid #e9d7d7;
            border-radius: 6px;
            background: #ffffff;
        }

        /* ===== INFO TERBARU FIX ===== */
        .info-terbaru {
            display: flex !important;
            flex-direction: column !important;
            gap: 12px !important;
            margin-top: 10px;
        }

        .info-card {
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            padding: 12px 14px !important;
            background: #ffffff !important;
            border-radius: 10px !important;
            text-decoration: none !important;
            border: 1px solid #e5e5e5 !important;
            transition: all 0.3s ease !important;
            color: inherit !important;
        }

        .info-card:hover {
            background: #f5f9ff !important;
            border-color: #0d6efd !important;
            transform: translateX(5px);
        }

        .info-text {
            flex: 1;
        }

        .info-title {
            font-size: 14px !important;
            font-weight: 600 !important;
            color: #333 !important;
            margin-bottom: 4px;
        }

        .info-date {
            font-size: 12px !important;
            color: #c09999 !important;
        }

        .info-arrow {
            font-size: 16px !important;
            color: #000000 !important;
            margin-left: 10px;
            display: flex;
            align-items: center;
        }

        .info-card:hover .info-arrow {
            transform: translateX(5px);
        }

        .info-card {
            border-left: 4px solid #0d6efd;
        }

        .mainContent {
            padding-bottom: 0 !important;
            margin-bottom: 0 !important;
        }

        .brandSection {
            margin-top: 0 !important;
            padding-top: 10px !important;
        }
        .aboutImage img {
    width: 100%;
    height: 220px;
    object-fit: cover;
}

.news-card {
    display: flex;
    flex-direction: column;
    height: 100%;
}

.news-title {
    min-height: 60px;
}

.news-title a {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.aboutImage img {
    width: 100%;
    height: 220px;
    object-fit: cover;
}

.news-card {
    display: flex;
    flex-direction: column;
    width: 100%;
}

.news-title {
    min-height: 60px;
}
.col-sm-4.d-flex {
    display: flex;
}

.news-card {
    display: flex;
    flex-direction: column;
    width: 100%;
}
.aboutImage img {
    width: 100%;
    height: 220px;
    object-fit: cover;
}
.aboutImage {
    width: 100%;
}
.row {
    display: flex !important;
    flex-wrap: wrap;
}

.slider-wrapper {
    position: relative;
}

.slider-img {
    width: 100%;
    height: 500px;
    object-fit: cover;
}

/* ===== SLIDER - CLEAN VERSION ===== */

/* Fix gap navbar & slider */
main {
    margin: 0 !important;
    padding: 0 !important;

}

#mainSlider,
.carousel,
.carousel-inner,
.carousel-item {
    margin: 0 !important;
    padding: 0 !important;
    line-height: 0 !important;
    height: 60vh;
}

.carousel-item {
    overflow: hidden;
}

/* Wrapper gambar */
.slider-wrapper {
    position: relative;
    width: 100%;
    height: 100%;
}

/* Gambar slider */
.slider-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    vertical-align: top;
    margin: 0;
    padding: 0;
}

/* Overlay gradasi */
.slider-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to right, rgba(0,0,0,0.65), rgba(0,0,0,0.1));
}

/* Konten teks */
.slider-content {
    position: absolute;
    top: 50%;
    left: 8%;
    transform: translateY(-50%);
    max-width: 520px;
    color: #fff;
    background: rgba(0, 0, 0, 0.5);
    padding: 28px 32px;
    border-radius: 10px;
    animation: fadeInUp 0.8s ease;
    line-height: 1.5;
}

.slider-content h2 {
    font-size: 36px;
    font-weight: bold;
    color: #fff;
    margin-bottom: 10px;
    margin-top: 0;
}

.slider-content p {
    font-size: 15px;
    color: #ddd;
    margin-bottom: 18px;
    line-height: 1.6;
}

.slider-content .btn {
    font-size: 14px;
    padding: 8px 22px;
    border-radius: 6px;
}

/* Animasi */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(calc(-50% + 20px)); }
    to   { opacity: 1; transform: translateY(-50%); }
}

/* Responsive mobile */
@media (max-width: 768px) {
    #mainSlider,
    .carousel-inner,
    .carousel-item {
        height: 50vw;
    }

    .slider-content {
        left: 5%;
        right: 5%;
        max-width: 90%;
        padding: 16px 20px;
    }

    .slider-content h2 {
        font-size: 22px;
    }

    .slider-content p {
        font-size: 13px;
    }
}
/* ===== FIX TOMBOL PREV/NEXT - POSISI KANAN KIRI ===== */
.carousel-control-prev,
.carousel-control-next {
    position: absolute !important;
    top: 50% !important;
    transform: translateY(-50%) !important;
    z-index: 10 !important;
    width: 45px !important;
    height: 45px !important;
    background: rgba(0, 0, 0, 0.4) !important;
    border-radius: 50% !important;
    opacity: 1 !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    border: 2px solid rgba(255,255,255,0.3) !important;
    transition: background 0.3s ease !important;
}

.carousel-control-prev {
    left: 20px !important;
}

.carousel-control-next {
    right: 20px !important;
}

.carousel-control-prev:hover,
.carousel-control-next:hover {
    background: rgba(0, 0, 0, 0.75) !important;
    border-color: rgba(255,255,255,0.6) !important;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    width: 18px !important;
    height: 18px !important;
}

/* Pastikan #mainSlider position relative */
#mainSlider {
    position: relative !important;
}
.carousel-control.left,
.carousel-control.right {
    background: none;
}

.carousel-control .glyphicon {
    font-size: 30px;
    color: #fff;
}
.carousel-indicators {
    bottom: 15px;
}

.carousel-indicators li {
    background-color: #ccc;
    border: none;
}

.carousel-indicators .active {
    background-color: #f0ad4e;
}
.slider-content {
    position: absolute;
    top: 50%;
    left: 10%;

    transform: translateY(-50%);

    width: 600px; /* 🔥 lebih lebar kayak contoh */
}
.slider-content .btn {
    transition: 0.3s;
}

.slider-content .btn:hover {
    transform: translateY(-2px);
}
/* PANAH KIRI */
.carousel-control.left {
    left: 0;
    width: 5%;
}

/* PANAH KANAN */
.carousel-control.right {
    right: 0;
    width: 5%;
}

/* ICON PANAH */
.carousel-control .glyphicon {
    font-size: 30px;
}

/* HILANGKAN BACKGROUND HITAM */
.carousel-control {
    background: none !important;
}
.slider-content-inner {
    transform: translateY(-10px); /* naik sedikit */
}
.slider-content-inner h2 {
    font-size: 42px;
    font-weight: 800;
    color: #fff;
    margin-bottom: 15px;
}

.slider-content-inner p {
    font-size: 16px;
    color: #ddd;
    line-height: 1.6;
    margin-bottom: 20px;
}
.slider-content {
    top: 35%; /* sebelumnya 50% */
    transform: translateY(-50%);
}
.slider-content-inner {
    min-height: 180px; /* 🔥 samakan tinggi */
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.slider-content-inner p {
    display: -webkit-box;
    -webkit-line-clamp: 5; /* maksimal 2 baris */
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.empty-pengumuman {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 50vh;
    text-align: center;
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
        function initFrontendDataTable(tableID, options = {}) {

    // 🔥 CEGAH DOUBLE INIT
    if ($.fn.DataTable.isDataTable(tableID)) {
        return $(tableID).DataTable();
    }

    let defaultOptions = {
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        autoWidth: false,
        responsive: true,

        language: {
            lengthMenu: "Tampilkan _MENU_ entri",
            search: "Cari:",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            zeroRecords: "Data tidak ditemukan",
            emptyTable: "Data tidak ditemukan",
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
    };

    let finalOptions = {
        ...defaultOptions,
        ...options
    };

    return $(tableID).DataTable(finalOptions);
}

        // 🔥 INI HARUS DI LUAR
        function loadData({
            url,
            table,
            columns,
            emptyMessage = 'Data tidak ditemukan'
        }) {

            $.ajax({
                url: url,
                type: "GET",

                beforeSend: function() {
                    table.clear();
                    let colCount = columns.length;

let loadingRow = Array(colCount).fill('');
loadingRow[Math.floor(colCount / 2)] = '<center>Memuat data...</center>';

table.row.add(loadingRow);
                    table.draw();
                },

                success: function(response) {

                    table.clear();

                    if (response.length > 0) {

                        response.forEach(function(item, index) {

                            let row = [];

                            columns.forEach(function(col) {
                                row.push(col(item, index));
                            });

                            table.row.add(row);
                        });

                    } else {
                        let emptyRow = Array(columns.length).fill('');
                        emptyRow[Math.floor(columns.length / 2)] = emptyMessage;
                        table.row.add(emptyRow);
                    }

                    table.draw();
                }
            });
        }


    </script>
</body>

</html>
