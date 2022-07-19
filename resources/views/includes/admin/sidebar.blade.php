<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-toolbox"></i>
        </div>
        @if(Auth::user()->roles == 'ADMIN')
            <a href="{{ route('dashboard') }}"><div class="text-center mb-3" style="color: white">Admin</div></a>
        @elseif(Auth::user()->roles == 'KETUA')
            <a href="{{ route('dashboard') }}"><div class="text-center mb-3" style="color: white">Ketua</div></a>
        @else
            <a href="{{ route('dashboard') }}"><div class="text-center mb-3" style="color: white">User</div></a>
        @endif
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    @if(Auth::user()->roles == 'ADMIN')
        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ Request::is('admin*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('users.index') }}">
                <i class="fas fa-fw fa-vote-yea"></i>
                <span>User</span></a>
        </li>
        <li class="nav-item {{ Request::is('links*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('links.index') }}">
                <i class="fas fa-fw fa-people-arrows"></i>
                <span>Links</span></a>
        </li>
        <li class="nav-item {{ Request::is('office*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('office.index') }}">
                <i class="fas fa-fw fa-people-arrows"></i>
                <span>Link General Office</span></a>
        </li>
        <li class="nav-item {{ Request::is('ketua*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('ketua.index') }}">
                <i class="fas fa-fw fa-people-arrows"></i>
                <span>Link Ketua</span></a>
        </li>
        <li class="nav-item {{ Request::is('category') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('category.index') }}">
                <i class="fas fa-fw fa-people-arrows"></i>
                <span>Category Link Office & Ketua</span></a>
        </li>
        <li class="nav-item {{ Request::is('categoryuser*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('categoryuser.index') }}">
                <i class="fas fa-fw fa-people-arrows"></i>
                <span>Category Link User</span></a>
        </li>
    @else
    <li class="nav-item {{ Request::is('admin*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item {{ Request::is('links*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('links.index') }}">
            <i class="fas fa-fw fa-people-arrows"></i>
            <span>Links</span></a>
    </li>
    <li class="nav-item {{ Request::is('categoryuser*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('categoryuser.index') }}">
            <i class="fas fa-fw fa-people-arrows"></i>
            <span>Category Link User</span></a>
    </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>