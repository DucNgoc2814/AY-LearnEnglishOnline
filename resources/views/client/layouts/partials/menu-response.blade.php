<section class="menubar ">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand logo pt-0" href="{{ route('home') }}">
                <img loading="lazy" src="{{ asset('themes/client/uploads/system/e0d3336caa3bf40ceae5b4efeeedf541.png') }}"
                    alt="Logo" />
            </a>

            <!-- Mobile Offcanves  Icon Show -->
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
                <!-- Small Device Hide -->
                <ul class="navbar-nav main-nav-wrap mb-2 mb-lg-0 ms-2">
                    <li class="nav-item">
                        <a class="nav-link header-dropdown bg-white text-dark fw-600 text-nowrap"
                            href="{{ route('home') }}" id="navbarDropdown3">
                            <span class="ms-2">Trang chủ</span>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav main-nav-wrap mb-2 mb-lg-0 align-items-center ms-1">
                    <li class="nav-item">
                        <a class="nav-link header-dropdown ps-2 text-nowrap bg-white text-dark" href="#"
                            id="navbarDropdown1">
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
                                        <span class="icons"><i class="fas fa-desktop"></i></span>
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
                        <a class="nav-link header-dropdown bg-white text-dark fw-600 text-nowrap"
                            href="addons/bootcamp/bootcamp_list.html" id="navbarDropdown4">
                            <span class="ms-2">Tin tức</span>
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav main-nav-wrap mb-2 mb-lg-0 ms-2">
                    <li class="nav-item">
                        <a class="nav-link header-dropdown bg-white text-dark fw-600 text-nowrap"
                            href="addons/team_training/packages.html" id="navbarDropdown4">
                            <span class="ms-2">Giới thiệu</span>
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav main-nav-wrap mb-2 mb-lg-0 ms-2">
                    <li class="nav-item">
                        <a class="nav-link header-dropdown bg-white text-dark fw-600 text-nowrap" href="tutors.html"
                            id="navbarDropdown2">
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

                        <a href="sign_up.html" class="signUp-btn">Sign up</a>
                        <a href="login.html" class="logIn-btn">Login</a>
                    </div>
                </div>
            </div>
            <div class="offcanvas-body p-0">
                <div class="flex-shrink-0 mt-3">
                    <ul class="list-unstyled ps-0">

                        <li><a href="home/shopping_cart.html"
                                class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500 w-100"><i
                                    class="fa-solid fa-cart-shopping me-2"></i> Cart <span
                                    class="badge bg-danger ms-auto">0</span></a></li>

                        <li class="bg-light">
                            <button
                                class="btn btn-toggle d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500 collapsed"
                                data-bs-toggle="collapse" data-bs-target="#category-collapse" aria-expanded="false">
                                <i class="fas fa-book me-2"></i>
                                Categories </button>
                            <div class="collapse" id="category-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small bg-white pt-2">
                                    <li>
                                        <button
                                            class="btn btn-toggle d-inline-flex align-items-center rounded border-0 text-dark text-15px fw-400 collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#subCategory-collapse10"
                                            aria-expanded="false">
                                            <span class="icons"><i class="fas fa-desktop"></i></span>
                                            <span class="text-cat">Web Design</span>
                                        </button>
                                        <div class="collapse" id="subCategory-collapse10">
                                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                                <li>
                                                    <a class="text-dark text-14px fw-400 w-100"
                                                        href="home/courses91d5.html?category=responsive-design"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                                        style="padding-left: 35px;">Responsive Design</a>
                                                </li>
                                                <li>
                                                    <a class="text-dark text-14px fw-400 w-100"
                                                        href="home/courses885f.html?category=wordpress-theme"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                                        style="padding-left: 35px;">WordPress Theme</a>
                                                </li>
                                                <li>
                                                    <a class="text-dark text-14px fw-400 w-100"
                                                        href="home/courses0c91.html?category=bootstrap"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                                        style="padding-left: 35px;">Bootstrap</a>
                                                </li>
                                                <li>
                                                    <a class="text-dark text-14px fw-400 w-100"
                                                        href="home/coursesb5f1.html?category=html-amp-css"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                                        style="padding-left: 35px;">HTML &amp; CSS</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <button
                                            class="btn btn-toggle d-inline-flex align-items-center rounded border-0 text-dark text-15px fw-400 collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#subCategory-collapse13"
                                            aria-expanded="false">
                                            <span class="icons"><i class="fas fa-pencil-alt"></i></span>
                                            <span class="text-cat">Graphic Design</span>
                                        </button>
                                        <div class="collapse" id="subCategory-collapse13">
                                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                                <li>
                                                    <a class="text-dark text-14px fw-400 w-100"
                                                        href="home/courses4696.html?category=photoshop"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                                        style="padding-left: 35px;">Photoshop</a>
                                                </li>
                                                <li>
                                                    <a class="text-dark text-14px fw-400 w-100"
                                                        href="home/coursesd1b3.html?category=adobe-illustrator"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                                        style="padding-left: 35px;">Adobe Illustrator</a>
                                                </li>
                                                <li>
                                                    <a class="text-dark text-14px fw-400 w-100"
                                                        href="home/coursesf6aa.html?category=drawing"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                                        style="padding-left: 35px;">Drawing</a>
                                                </li>
                                                <li>
                                                    <a class="text-dark text-14px fw-400 w-100"
                                                        href="home/courses6e7b.html?category=logo-design"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                                        style="padding-left: 35px;">Logo Design</a>
                                                </li>
                                                <li>
                                                    <a class="text-dark text-14px fw-400 w-100"
                                                        href="home/courses2e21.html?category=digital-art"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                                        style="padding-left: 35px;">Digital Art</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <button
                                            class="btn btn-toggle d-inline-flex align-items-center rounded border-0 text-dark text-15px fw-400 collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#subCategory-collapse14"
                                            aria-expanded="false">
                                            <span class="icons"><i class="fas fa-male"></i></span>
                                            <span class="text-cat">User Experience</span>
                                        </button>
                                        <div class="collapse" id="subCategory-collapse14">
                                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                                <li>
                                                    <a class="text-dark text-14px fw-400 w-100"
                                                        href="home/courses5b8a.html?category=user-experience-design"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                                        style="padding-left: 35px;">User Experience Design</a>
                                                </li>
                                                <li>
                                                    <a class="text-dark text-14px fw-400 w-100"
                                                        href="home/courses1c01.html?category=mobile-app-design"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                                        style="padding-left: 35px;">Mobile App Design</a>
                                                </li>
                                                <li>
                                                    <a class="text-dark text-14px fw-400 w-100"
                                                        href="home/courses6896.html?category=user-interface"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                                        style="padding-left: 35px;">User Interface</a>
                                                </li>
                                                <li>
                                                    <a class="text-dark text-14px fw-400 w-100"
                                                        href="home/coursesd12a.html?category=design-thinking"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                                        style="padding-left: 35px;">Design Thinking</a>
                                                </li>
                                                <li>
                                                    <a class="text-dark text-14px fw-400 w-100"
                                                        href="home/courses2c28.html?category=figma"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                                        style="padding-left: 35px;">Figma</a>
                                                </li>
                                                <li>
                                                    <a class="text-dark text-14px fw-400 w-100"
                                                        href="home/coursesaa5c.html?category=prototyping"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                                        style="padding-left: 35px;">Prototyping</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <button
                                            class="btn btn-toggle d-inline-flex align-items-center rounded border-0 text-dark text-15px fw-400 collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#subCategory-collapse15"
                                            aria-expanded="false">
                                            <span class="icons"><i class="fas fa-magic"></i></span>
                                            <span class="text-cat">Interior Design</span>
                                        </button>
                                        <div class="collapse" id="subCategory-collapse15">
                                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                                <li>
                                                    <a class="text-dark text-14px fw-400 w-100"
                                                        href="home/courses6921.html?category=color-theory"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                                        style="padding-left: 35px;">Color Theory</a>
                                                </li>
                                                <li>
                                                    <a class="text-dark text-14px fw-400 w-100"
                                                        href="home/courses340a.html?category=lighting-design"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                                        style="padding-left: 35px;">Lighting Design</a>
                                                </li>
                                                <li>
                                                    <a class="text-dark text-14px fw-400 w-100"
                                                        href="home/courses8f26.html?category=sketchup"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                                        style="padding-left: 35px;">SketchUp</a>
                                                </li>
                                                <li>
                                                    <a class="text-dark text-14px fw-400 w-100"
                                                        href="home/courses55aa.html?category=home-improvement"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                                        style="padding-left: 35px;">Home Improvement</a>
                                                </li>
                                                <li>
                                                    <a class="text-dark text-14px fw-400 w-100"
                                                        href="home/coursesb29e.html?category=3d-lighting"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                                        style="padding-left: 35px;">3D Lighting</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <button
                                            class="btn btn-toggle d-inline-flex align-items-center rounded border-0 text-dark text-15px fw-400 collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#subCategory-collapse16"
                                            aria-expanded="false">
                                            <span class="icons"><i class="fas fa-cube"></i></span>
                                            <span class="text-cat">3D and Animation</span>
                                        </button>
                                        <div class="collapse" id="subCategory-collapse16">
                                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                                <li>
                                                    <a class="text-dark text-14px fw-400 w-100"
                                                        href="home/courses43c0.html?category=blender"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                                        style="padding-left: 35px;">Blender</a>
                                                </li>
                                                <li>
                                                    <a class="text-dark text-14px fw-400 w-100"
                                                        href="home/courses01b3.html?category=motion-graphics"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                                        style="padding-left: 35px;">Motion Graphics</a>
                                                </li>
                                                <li>
                                                    <a class="text-dark text-14px fw-400 w-100"
                                                        href="home/coursesb587.html?category=after-effects"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                                        style="padding-left: 35px;">After Effects</a>
                                                </li>
                                                <li>
                                                    <a class="text-dark text-14px fw-400 w-100"
                                                        href="home/coursesd853.html?category=maya"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                                        style="padding-left: 35px;">Maya</a>
                                                </li>
                                                <li>
                                                    <a class="text-dark text-14px fw-400 w-100"
                                                        href="home/coursesaa8a.html?category=zbrush"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                                        style="padding-left: 35px;">zBrush</a>
                                                </li>
                                                <li>
                                                    <a class="text-dark text-14px fw-400 w-100"
                                                        href="home/coursesf09c.html?category=character-modeling"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                                        style="padding-left: 35px;">Character Modeling</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <button
                                            class="btn btn-toggle d-inline-flex align-items-center rounded border-0 text-dark text-15px fw-400 collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#subCategory-collapse27"
                                            aria-expanded="false">
                                            <span class="icons"><i class="fas fa-user-secret"></i></span>
                                            <span class="text-cat">Fashion</span>
                                        </button>
                                        <div class="collapse" id="subCategory-collapse27">
                                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                                <li>
                                                    <a class="text-dark text-14px fw-400 w-100"
                                                        href="home/courses80b0.html?category=fashion-design"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                                        style="padding-left: 35px;">Fashion Design</a>
                                                </li>
                                                <li>
                                                    <a class="text-dark text-14px fw-400 w-100"
                                                        href="home/courses21fb.html?category=sewing"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                                        style="padding-left: 35px;">Sewing</a>
                                                </li>
                                                <li>
                                                    <a class="text-dark text-14px fw-400 w-100"
                                                        href="home/coursesd657.html?category=t-shirt-design"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                                        style="padding-left: 35px;">T-shirt Design</a>
                                                </li>
                                                <li>
                                                    <a class="text-dark text-14px fw-400 w-100"
                                                        href="home/courses2cea.html?category=jewelry-design"
                                                        class="link-body-emphasis d-inline-flex text-decoration-none rounded"
                                                        style="padding-left: 35px;">Jewelry Design</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <button
                                            class="btn btn-toggle d-inline-flex align-items-center rounded border-0 text-dark text-15px fw-400 collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#subCategory-collapse51"
                                            aria-expanded="false">
                                            <span class="icons"><i class="fab fa-500px"></i></span>
                                            <span class="text-cat">Frontend Development</span>
                                        </button>
                                        <div class="collapse" id="subCategory-collapse51">
                                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-15px fw-400 py-2 w-100">
                                            <i class="fas fa-list me-2"></i> All courses</a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <li class="bg-light">
                            <a href="course_bundles.html"
                                class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500">
                                <i class="fas fa-cube me-2"></i> Course bundles</a>
                        </li>

                        <li class="bg-light">
                            <a href="addons/bootcamp/bootcamp_list.html"
                                class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500">
                                <i class="fab fa-centercode me-2"></i> Bootcamp</a>
                        </li>

                        <li class="bg-light">
                            <a href="addons/team_training/packages.html"
                                class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500">
                                <i class="fas fa-users me-2"></i> Team training</a>
                        </li>

                        <li class="bg-light">
                            <button
                                class="btn btn-toggle d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500 collapsed"
                                data-bs-toggle="collapse" data-bs-target="#ebook-category-collapse"
                                aria-expanded="false">
                                <i class="fas fa-file me-2"></i>
                                Ebook </button>
                            <div class="collapse" id="ebook-category-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small bg-white pt-2">
                                    <li>
                                        <a href="ebook209b.html?category=kids&amp;price=all&amp;rating=all"
                                            class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-15px fw-400 py-2 w-100">
                                            Kids</a>
                                    </li>
                                    <li>
                                        <a href="ebook2dbf.html?category=science-fiction-amp-fantasy&amp;price=all&amp;rating=all"
                                            class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-15px fw-400 py-2 w-100">
                                            Science Fiction &amp; Fantasy</a>
                                    </li>
                                    <li>
                                        <a href="ebooke323.html?category=politics&amp;price=all&amp;rating=all"
                                            class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-15px fw-400 py-2 w-100">
                                            Politics</a>
                                    </li>
                                    <li>
                                        <a href="ebook9776.html?category=cooking-amp-foods&amp;price=all&amp;rating=all"
                                            class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-15px fw-400 py-2 w-100">
                                            Cooking &amp; Foods</a>
                                    </li>
                                    <li>
                                        <a href="ebook2b87.html?category=motivation&amp;price=all&amp;rating=all"
                                            class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-15px fw-400 py-2 w-100">
                                            Motivation</a>
                                    </li>
                                    <li>
                                        <a href="ebookdf72.html?category=freelancing-amp-outsourcing&amp;price=all&amp;rating=all"
                                            class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-15px fw-400 py-2 w-100">
                                            Freelancing &amp; Outsourcing</a>
                                    </li>
                                    <li>
                                        <a href="ebookb3b4.html?category=programming-language&amp;price=all&amp;rating=all"
                                            class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-15px fw-400 py-2 w-100">
                                            Programming Language</a>
                                    </li>
                                    <li>
                                        <a href="ebook78f6.html?category=education&amp;price=all&amp;rating=all"
                                            class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-15px fw-400 py-2 w-100">
                                            Education</a>
                                    </li>
                                    <li>
                                        <a href="ebook.html"
                                            class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-15px fw-400 py-2 w-100">
                                            <i class="fas fa-list me-2"></i> All ebooks</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="bg-light"><a
                                class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500"
                                href="tutors.html"><i class="fas fa-chalkboard-teacher me-2"></i>Find a
                                tutor</a></li>


                        <li class="bg-light">
                            <a href="page/home-1.html"
                                class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500">
                                <i class="fas fa-arrow-alt-circle-right me-2"></i> Preview Home Page-1</a>
                        </li>
                        <li class="bg-light">
                            <a href="page/home-2.html"
                                class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500">
                                <i class="fas fa-arrow-alt-circle-right me-2"></i> Preview Home Page-2</a>
                        </li>
                        <li class="bg-light">
                            <a href="page/home-3.html"
                                class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500">
                                <i class="fas fa-arrow-alt-circle-right me-2"></i> Preview Home Page-3</a>
                        </li>
                        <li class="bg-light">
                            <a href="page/home-4.html"
                                class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500">
                                <i class="fas fa-arrow-alt-circle-right me-2"></i> Preview Home Page-4</a>
                        </li>
                        <li class="bg-light">
                            <a href="page/home-5.html"
                                class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500">
                                <i class="fas fa-arrow-alt-circle-right me-2"></i> Preview Home Page-5</a>
                        </li>
                        <li class="bg-light">
                            <a href="page/home-6.html"
                                class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500">
                                <i class="fas fa-arrow-alt-circle-right me-2"></i> Preview Home Page-6</a>
                        </li>
                        <li class="bg-light">
                            <a href="page/home-7.html"
                                class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500">
                                <i class="fas fa-arrow-alt-circle-right me-2"></i> Preview Home Page-7</a>
                        </li>

                    </ul>
                </div>

            </div>
        </div>
    </div>
</section>
