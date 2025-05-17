<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top">
    <div class="container">

        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" height="40">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">Men</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Woman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Kids&Baby</a>
                </li>
            </ul>

            {{-- <form class="d-flex me-3">
                <div class="input-group">
                    <input class="form-control border-end-2" type="search" placeholder="Search: jeans, shirts..." aria-label="Search">
                    <button class="btn btn-outline-primary border-start-0" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form> --}}

            <ul class="navbar-nav">
                @if (Auth::check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userManagementDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-users-cog"></i> User Management
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userManagementDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('users.list') }}">
                                    <i class="fas fa-list"></i> All Users
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('users_create') }}">
                                    <i class="fas fa-user-plus"></i> Add New User
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('profile', ['user' => Auth::id()]) }}">
                                    <i class="fas fa-user-circle"></i> My Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('edit_password', ['user' => Auth::id()]) }}">
                                    <i class="fas fa-key"></i> Change Password
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile', ['user' => Auth::id()]) }}">
                            <i class="fas fa-user"></i> {{ Auth::user()->name }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('do_logout') }}">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <i class="fas fa-user-plus"></i> Register
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <img src="{{ asset('images/cart1.png') }}" alt="Logo" height="35"> Shopping Cart
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>


