<nav class="main-header navbar navbar-expand navbar-white navbar-light">
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
        <a href="#" class="dropdown-toggle nav-link d-inline-block p-0" data-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-right" style="right:0; left:auto;">

            <li class="user-header">
                <img src="https://png.pngtree.com/png-vector/20190710/ourmid/pngtree-user-vector-avatar-png-image_1541962.jpg"
                    class="img-circle" alt="User Image">
                <p>
                    {{ Auth::user()->name }}
                    <small>{{ Auth::user()->created_at }}</small>
                </p>
            </li>
            @php
                $id = Auth::user()->id;
            @endphp
            <li class="user-footer">

                <div class="row px-2">
                    <div class="col-6">
                        <a href="{{ route('users.edit', $id) }}" class="btn btn-sm btn-outline-primary w-100">
                            <i class="fas fa-user"></i> Profile
                        </a>
                    </div>
                    <div class="col-6 text-right pr-2">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-sign-out-alt"></i> Sign Out
                            </button>
                        </form>
                    </div>
                </div>
            </li>


        </ul>
    </li>
    <!-- Logout Link -->
</ul>


</nav>
