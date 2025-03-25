<section class="menubar mb-5">
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top py-3 shadow">
        <div class="container">
            <a class="navbar-brand logo pt-0" href="{{ route('home') }}">
                <img loading="lazy" src="{{ asset('uploads/logos/amazing you.png') }}" alt="Logo" />
            </a>
            <ul class="menu-offcanves">
                <li>
                    <div class="search-item">
                        <span class="m-cross-icon"><i class="fa-solid fa-xmark"></i></span>
                        <span class="m-search-icon"> <i class="fa-solid fa-magnifying-glass"></i></span>
                    </div>
                </li>
                <li>
                    <a href="#" class="btn-bar" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"><i
                            class="fa-sharp fa-solid fa-bars"></i></a>
                </li>
            </ul>

            <div class="navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav main-nav-wrap mb-2 mb-lg-0 ms-2">
                    <li class="nav-item">
                        <a class="nav-link header-dropdown bg-white text-dark fw-600 text-nowrap hover-effect active-effect"
                            href="{{ route('home') }}" id="navbarDropdown3">
                            <span class="ms-2">Trang chủ</span>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav main-nav-wrap mb-2 mb-lg-0 align-items-center ms-1">
                    <li class="nav-item">
                        <a class="nav-link header-dropdown ps-2 text-nowrap bg-white text-dark hover-effect active-effect"
                            href="#" id="navbarDropdown1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-grid">
                                <rect x="3" y="3" width="7" height="7"></rect>
                                <rect x="14" y="3" width="7" height="7"></rect>
                                <rect x="14" y="14" width="7" height="7"></rect>
                                <rect x="3" y="14" width="7" height="7"></rect>
                            </svg>
                            <span class="ms-2 fw-600 text-nowrap fs-13" style="color: #000;">Danh mục</span>
                        </a>
                        <ul class="navbarHover">
                            @foreach ($categories as $category)
                                <li class="dropdown-submenu">
                                    <a href="{{ route('category.index', $category->slug) }}">
                                        <span class="text-cat">{{ $category->name }}</span>
                                        <span class="has-sub-category ms-auto"><i
                                                class="fa-solid fa-angle-right"></i></span>
                                    </a>
                                    @if ($category->courses->count() > 0)
                                        <ul class="sub-category-menu">
                                            @foreach ($category->courses as $course)
                                                <li><a
                                                        href="{{ route('detailCourse', $course->slug) }}">{{ $course->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav main-nav-wrap mb-2 mb-lg-0 ms-2">
                    <li class="nav-item">
                        <a class="nav-link header-dropdown bg-white text-dark fw-600 text-nowrap hover-effect active-effect"
                            href="addons/bootcamp/bootcamp_list.html" id="navbarDropdown4">
                            <span class="ms-2">Thi thử Toeic</span>
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav main-nav-wrap mb-2 mb-lg-0 ms-2">
                    <li class="nav-item">
                        <a class="nav-link header-dropdown bg-white text-dark fw-600 text-nowrap hover-effect active-effect"
                            href="addons/team_training/packages.html" id="navbarDropdown4">
                            <span class="ms-2">Giới thiệu</span>
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav main-nav-wrap mb-2 mb-lg-0 ms-2">
                    <li class="nav-item">
                        <a class="nav-link header-dropdown bg-white text-dark fw-600 text-nowrap hover-effect active-effect"
                            href="tutors.html" id="navbarDropdown2">
                            Liên hệ
                        </a>
                    </li>
                </ul>
                <div class="right-menubar ms-auto d-flex justify-content-end align-items-center">
                    <form class="search-input-form" action="https://demo.creativeitem.com/AY/home/courses"
                        method="get">
                        <div class="search-container position-relative">
                            <input type="text" name="query" class="form-control search-input"
                                placeholder="Tìm kiếm khóa học..."
                                style="width: 300px; display: block; border: 1px solid #ddd; border-radius: 4px; padding: 8px 35px 8px 12px;">
                            <button type="submit" class="btn search-btn position-absolute"
                                style="right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                            </button>
                        </div>
                    </form>
                    <div class="navbar-nav main-nav-wrap mb-2 mb-lg-0 ms-2">
                        @if (Auth::check())
                            <div class="menu_pro_tgl_div ms-2">
                                <div class="menu_pro_tgl_2div">
                                    <a class="menu_pro_tgl profile-dropdown my-auto" href="#">
                                        @if (Auth::user()->avatar)
                                            <img loading="lazy" src="{{ Auth::user()->avatar }}" alt="User Image"
                                                style="margin: auto;">
                                        @else
                                            <i class="fa-solid fa-user-circle fa-3x"></i>
                                        @endif
                                    </a>
                                    <div class="menu_pro_tgl_bg">
                                        <div class="">
                                            <div class="text-center p-3">
                                                @if (Auth::user()->avatar)
                                                    <img loading="lazy" class="profile-image rounded-circle mb-3"
                                                        src="{{ asset(Auth::user()->avatar) }}" alt="Profile">
                                                @else
                                                    <i class="fa-solid fa-user-circle fa-7x mb-3"></i>
                                                @endif
                                                <h4 class="mb-1">{{ Auth::user()->name }}</h4>
                                                <span class="text-muted">{{ Auth::user()->email }}</span>
                                            </div>
                                            <ul class="user-dropdown-menu">
                                                <li class="user-dropdown-menu-item">
                                                    <a href="{{ route('profile.index') }}"
                                                        class="d-flex align-items-center">
                                                        <i class="fas fa-user me-2"></i>
                                                        <span class="text-cat">Thông tin cá nhân</span>
                                                    </a>
                                                </li>
                                                <li class="user-dropdown-menu-item">
                                                    <a href="{{ route('profile.index') }}#my-courses"
                                                        class="d-flex align-items-center">
                                                        <i class="fas fa-graduation-cap me-2"></i>
                                                        <span class="text-cat">Khóa học của tôi</span>
                                                    </a>
                                                </li>
                                                <li class="user-dropdown-menu-item">
                                                    <form action="{{ route('logout') }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        <a href="javascript:void(0)"
                                                            onclick="this.closest('form').submit()"
                                                            class="d-flex align-items-center">
                                                            <i class="fas fa-sign-out-alt me-2"></i>
                                                            <span class="text-cat">Đăng xuất</span>
                                                        </a>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="menu_pro_tgl_div">
                                <div class="menu_pro_tgl_2div">
                                    <a class="menu_pro_tgl profile-dropdown my-auto" href="#">
                                        <i class="fas fa-user-circle fa-3x"></i>
                                    </a>
                                    <div class="menu_pro_tgl_bg">
                                        <div class="">
                                            <ul class="user-dropdown-menu">
                                                <li class="user-dropdown-menu-item">
                                                    <a href="{{ route('login') }}" class="d-flex align-items-center">
                                                        <i class="fas fa-user me-2 my-auto"></i>
                                                        <span class="text-cat my-auto">Đăng nhập</span>
                                                    </a>
                                                </li>
                                                <li class="user-dropdown-menu-item">
                                                    <a href="{{ route('register') }}"
                                                        class="d-flex align-items-center">
                                                        <i class="fas fa-user-plus me-2 my-auto"></i>
                                                        <span class="text-cat my-auto">Đăng ký</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Device Form -->
        <form action="https://demo.creativeitem.com/AmazingYou/home/courses" method="get" class="inline-form">
            <div class="mobile-search test">
                <button type="submit" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                <input value="" name="query" class="form-control" type="text" placeholder="Search" />
            </div>
        </form>

        </div>
    </nav> <!-- Offcanves Menu  -->
    <div class="mobile-view-offcanves">
        <div class="offcanvas offcanvas-start bg-light" data-bs-scroll="true" tabindex="-1"
            id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
            <div class="offcanves-top">
                <div class="offcanvas-header bg-light">
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                    <div class="offcanves-btn">
                        @if (Auth::check())
                            <a href="{{ route('profile.index') }}" class="signUp-btn">Tài khoản</a>
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <a href="javascript:void(0)" onclick="this.closest('form').submit()" class="logIn-btn">Đăng xuất</a>
                            </form>
                        @else
                            <a href="{{ route('register') }}" class="signUp-btn">Đăng ký</a>
                            <a href="{{ route('login') }}" class="logIn-btn">Đăng nhập</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="offcanvas-body p-0">
                <div class="flex-shrink-0 mt-3">
                    <ul class="list-unstyled ps-0">
                        <!-- Trang chủ -->
                        <li class="bg-light">
                            <a href="{{ route('home') }}"
                                class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500 hover-effect active-effect">
                                <i class="fas fa-home me-2"></i> Trang chủ</a>
                        </li>

                        <!-- Danh mục -->
                        <li class="bg-light">
                            <button
                                class="btn btn-toggle d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500 collapsed hover-effect active-effect"
                                data-bs-toggle="collapse" data-bs-target="#category-collapse" aria-expanded="false">
                                <i class="fas fa-th-large me-2"></i>
                                Danh mục </button>
                            <div class="collapse" id="category-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small bg-white pt-2">
                                    @foreach ($categories as $category)
                                    <li>
                                        <button
                                            class="btn btn-toggle d-inline-flex align-items-center rounded border-0 text-dark text-15px fw-400 collapsed hover-effect"
                                            data-bs-toggle="collapse" data-bs-target="#subCategory-collapse{{ $category->id }}"
                                            aria-expanded="false">
                                            <span class="text-cat">{{ $category->name }}</span>
                                        </button>
                                        @if ($category->courses->count() > 0)
                                        <div class="collapse" id="subCategory-collapse{{ $category->id }}">
                                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                                @foreach ($category->courses as $course)
                                                <li>
                                                    <a class="text-dark text-14px fw-400 w-100 hover-effect"
                                                        href="{{ route('detailCourse', $course->slug) }}"
                                                        style="padding-left: 35px;">{{ $course->name }}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>

                        <!-- Thi thử Toeic -->
                        <li class="bg-light">
                            <a href="addons/bootcamp/bootcamp_list.html"
                                class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500 hover-effect active-effect">
                                <i class="fas fa-book me-2"></i> Thi thử Toeic</a>
                        </li>

                        <!-- Giới thiệu -->
                        <li class="bg-light">
                            <a href="addons/team_training/packages.html"
                                class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500 hover-effect active-effect">
                                <i class="fas fa-info-circle me-2"></i> Giới thiệu</a>
                        </li>

                        <!-- Liên hệ -->
                        <li class="bg-light">
                            <a href="tutors.html"
                                class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500 hover-effect active-effect">
                                <i class="fas fa-phone me-2"></i> Liên hệ</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@push('css')
    <style>
        /* CSS cải tiến cho hover và active */
        .navbar-nav .nav-item .nav-link {
            position: relative;
            transition: color 0.3s ease;
        }

        /* Hiệu ứng hover */
        .navbar-nav .nav-item .nav-link.hover-effect:hover {
            color: #ff6600 !important; /* Màu cam (phù hợp với logo của bạn) */
        }

        /* Hiệu ứng gạch chân khi hover */
        .navbar-nav .nav-item .nav-link.hover-effect:hover::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            background-color: #ff6600;
            bottom: 0;
            left: 0;
            transform: scaleX(1);
            transition: transform 0.3s ease;
        }

        /* Hiệu ứng active */
        .navbar-nav .nav-item .nav-link.active-effect.active {
            color: #ff6600 !important;
        }

        .navbar-nav .nav-item .nav-link.active-effect.active::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            background-color: #ff6600;
            bottom: 0;
            left: 0;
        }

        /* Cải thiện dropdown menu */
        .navbarHover {
            display: none;
            position: absolute;
            background: white;
            min-width: 220px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            z-index: 1000;
            border-radius: 4px;
            padding: 8px 0;
            margin-top: 5px;
        }

        .navbar-nav .nav-item:hover .navbarHover {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Style cho các mục trong dropdown */
        .navbarHover li {
            padding: 0;
            list-style: none;
        }

        .navbarHover li a {
            padding: 10px 15px;
            color: #212529;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: all 0.2s ease;
        }

        .navbarHover li a:hover {
            color: #ff6600;
            background-color: #f8f9fa;
        }

        /* CSS cho submenu */
        .dropdown-submenu {
            position: relative;
        }

        .sub-category-menu {
            display: none;
            position: absolute;
            left: 100%;
            top: 0;
            background: white;
            min-width: 200px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            border-radius: 4px;
            padding: 8px 0;
        }

        .dropdown-submenu:hover .sub-category-menu {
            display: block;
            animation: fadeIn 0.3s ease;
        }
        
        /* CSS cho menu mobile */
        @media (max-width: 991.98px) {
            /* Style cho các nút trong menu mobile */
            .btn-toggle-list, .btn-toggle {
                padding: 10px 15px;
                width: 100%;
                text-align: left;
                transition: all 0.3s ease;
            }
            
            .btn-toggle-list:hover, .btn-toggle:hover {
                color: #ff6600 !important;
                background-color: #f8f9fa;
            }
            
            .btn-toggle-list.active, .btn-toggle.active {
                color: #ff6600 !important;
            }
            
            /* Ẩn các hình ảnh không cần thiết trên mobile */
            .mobile-view-offcanves img,
            .mobile-view-offcanves svg:not(.fa-*) {
                display: none !important;
            }
            
            /* Cải thiện menu mobile - loại bỏ khoảng cách thừa */
            .offcanvas-body .flex-shrink-0 {
                margin-top: 0 !important;
            }
            
            .offcanvas-body ul.list-unstyled {
                padding: 0 !important;
            }
            
            .offcanvas-body .list-unstyled li {
                margin-bottom: 5px;
            }
            
            /* Cải thiện dropdown trong mobile */
            .offcanvas-body .collapse {
                padding-left: 15px;
            }
        }
    </style>
@endpush

