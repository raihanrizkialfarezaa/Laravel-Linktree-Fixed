<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if (Auth::user()->roles == 'KETUA')
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">KETUA SUPERVISI | {{ Auth::user()->name  }}</span>
                @else
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->roles }} | {{ Auth::user()->name  }}</span>
                @endif
                <img class="img-profile rounded-circle"
                    src="{{ url('backend/img/undraw_profile.svg') }}">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-danger" type="submit">Log Out</button>
                </form>
                <a href="{{ route('edit-user') }}" class="btn btn-primary mt-2">Edit Profile</a>
            </div>
        </li>

    </ul>

</nav>