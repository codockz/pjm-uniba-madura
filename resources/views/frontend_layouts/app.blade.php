
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
.navbar-nav > li > a {
    padding-left: 6px;
    padding-right: 6px;
    font-size: 12px;       /* sedikit diperkecil */
    white-space: nowrap;  /* cegah turun baris */
}

/* Supaya sejajar logo */
.navbar-nav {
    display: flex;
    align-items: center;
}

/* Logo tidak terlalu makan tempat */
.navbar-brand img {
    max-width: 200px;
}
</style>
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="body-wrapper ">

<div class="main_wrapper">
   @include('frontend_layouts.nav')
     @yield('content')
    @include('frontend_layouts.footer')

</div>

<!-- JQUERY SCRIPTS -->
    @include('frontend_layouts.script_js')

</body>
</html>

