<!-- Top Navbar -->
<div class="top-navbar">
    <div class="d-flex align-items-center">
        <span class="nav-logo">
            <img src="{{ asset('uploads/logos/amazing you.png') }}" alt="AmazingYou" class="img-fluid"
                style="width: 100px;">
        </span>
    </div>
    <div class="ms-auto d-flex align-items-center">
        @if (Auth::check())
            <div class="dropdown me-3">
                <button class="btn dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown">
                    {{ session('user_display_name', Auth::user()->name) }}
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="">Thông tin cá nhân</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form method="POST" action="{{ route('online.logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Đăng xuất</button>
                        </form>
                    </li>
                </ul>
            </div>
        @endif
        <button class="mobile-menu-toggle d-md-none" type="button" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</div>
