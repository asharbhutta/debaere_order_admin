<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
    <a href="/" class="navbar-brand d-flex d-lg-none me-4">
    </a>
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>
    <form class="d-none d-md-flex ms-4" id="searchForm">
        <input class="form-control border-0" type="search" name="query" placeholder="Search" value="{{  app('request')->has('query') ?  app('request')->input('query') : '' }}">
    </form>
    <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <x-rounded-user-image />
                <span class="d-none d-lg-inline-flex">{{ auth()->user()->name }}!</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <a href="#" class="dropdown-item">My Profile</a>
                <a href="#" class="dropdown-item">Settings</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>