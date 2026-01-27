<style>
    .user-footer{
        font-size: 14px;
        text-align: left;
        text-decoration: none;
        word-spacing: 0px;
        padding: 10px;
    }

</style>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav ms-auto">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('frontend.frontend') }}">Beranda</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('frontend.profile') }}">Profil</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('frontend.layanan') }}">Layanan</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('frontend.akreditasi') }}">Akreditasi</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('frontend.dokumen_induk') }}">Dokumen Induk</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('frontend.dokumen_mutu') }}">Dokumen Mutu</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('frontend.infografis') }}">Infografis</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('frontend.sim') }}">Sistem Informasi Mutu</a>
    </li>
</ul>


    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" id="toggleButton" data-widget="pushmenu" href="#" role="button"><i
                    class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

        <li class="dropdown user user-menu nav-item">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user"></i>
            </a>
            <ul class="dropdown-menu">

            <li class="user-header">
            <img src="https://png.pngtree.com/png-vector/20190710/ourmid/pngtree-user-vector-avatar-png-image_1541962.jpg" class="img-circle" alt="User Image">
            <p>
            {{ Auth::user()->name }}
                <small>{{ Auth::user()->created_at }}</small>
            </p>
            </li>
            @php
                $id = Auth::user()->id;
            @endphp
            <li class="user-footer">
                <div class="row">
                    <div class="col-xs-6 ml-2">
                        <a href="{{ route('users.edit',$id) }}" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="col-xs-6 ml-auto mr-2">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Sign out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </li>


          </ul>
        </li>
        <!-- Logout Link -->
    </ul>


</nav>










