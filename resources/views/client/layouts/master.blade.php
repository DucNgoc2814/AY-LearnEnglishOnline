<!DOCTYPE html>
<html lang="en" dir="ltr">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5.0, minimum-scale=0.86">
    <meta name="description" content="Home page for AmazingYou Seo">
    <meta name="keywords" content="">
    <meta name="robots" content="Meta robot">
    <meta name="author" content="Creativeitem">
    <!-- Security Headers -->
    <meta http-equiv="X-XSS-Protection" content="1; mode=block">
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="Referrer-Policy" content="same-origin">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'unsafe-inline' 'nonce-{{ csrf_token() }}' https://cdn.jsdelivr.net https://code.jquery.com; style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net; img-src 'self' data: https://api.vietqr.io; font-src 'self'; connect-src 'self' https://api.vietqr.io; frame-src 'self'; object-src 'none'">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (session('notification'))
        <meta name="notification" content="{{ json_encode(session('notification')) }}">
    @endif
    <title>@yield('title')</title>
    @include('client.layouts.partials.style')
    <script nonce="{{ csrf_token() }}" src="{{ asset('themes/client/assets/global/js/jquery-3.6.1.min.js') }}"></script>
    <script nonce="{{ csrf_token() }}" src="{{ asset('js/csrf-manager.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="{{ asset('css/notification.css') }}">
    @yield('styles')
    @stack('css')

    <!-- CSRF token for JavaScript -->
    <script nonce="{{ csrf_token() }}">
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}',
            appUrl: '{{ url('/') }}'
        };

        // Tránh vấn đề reload do CSRF token mismatch
        document.addEventListener('DOMContentLoaded', function() {
            // Kiểm tra xem đã lưu token không
            const savedToken = sessionStorage.getItem('saved_csrf_token');

            // Cập nhật token trong form
            if (savedToken) {
                // Cập nhật token trong tất cả form
                document.querySelectorAll('form').forEach(form => {
                    const tokenInput = form.querySelector('input[name="_token"]');
                    if (tokenInput) {
                        tokenInput.value = savedToken;
                    }
                });

                // Xóa token đã lưu sau khi sử dụng
                sessionStorage.removeItem('saved_csrf_token');
            }

            // Kiểm tra URL xem có phải là trang chi tiết khóa học không
            if (window.location.href.includes('/khoa-hoc/')) {
                // Đang ở trang khóa học, ngăn chặn việc reload do CSRF
                sessionStorage.setItem('disable_csrf_redirect', 'true');
            } else {
                sessionStorage.removeItem('disable_csrf_redirect');
            }
        });
    </script>

</head>

<body class="{{ session('jwt_token') ? 'user-logged-in' : '' }}">
    <header>
        @if (!str_starts_with(Route::currentRouteName(), 'course.learning'))
            @include('client.layouts.partials.header')
            @include('client.layouts.partials.menu-response')
        @endif
    </header>

    @yield('content')
    @if (!str_starts_with(Route::currentRouteName(), 'course.learning'))
        <div class="py-4 w-100"></div>
        @include('client.layouts.partials.footer')
        @include('client.layouts.partials.script')
        <script nonce="{{ csrf_token() }}" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        <script nonce="{{ csrf_token() }}" src="{{ asset('js/notification.js') }}"></script>
    @endif

    @stack('scripts')

    @if(Route::currentRouteName() == 'home')
    <!-- Promotion Modal -->
    <div class="modal fade" id="promotionModal" tabindex="-1" aria-labelledby="promotionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content" style="background: linear-gradient(135deg, #1a2980 0%, #26d0ce 100%);">
                <div class="modal-header border-0 position-absolute w-100" style="z-index: 1;">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="row g-0 align-items-stretch flex-column flex-md-row">
                        <!-- Phần hình ảnh - ẩn trên mobile -->
                        <div class="col-md-5 d-none d-md-flex p-4 align-items-center justify-content-center position-relative overflow-hidden promotion-image-container">
                            <div class="position-relative" style="z-index: 1;">
                                <img src="{{ asset('images/promotion.jpg') }}" alt="Promotion" class="img-fluid rounded-3 promotion-image">
                            </div>
                            <div class="position-absolute top-0 start-0 w-100 h-100 bg-overlay"></div>
                        </div>
                        <!-- Phần nội dung -->
                        <div class="col-12 col-md-7 p-4 content-section">
                            <div class="text-center mb-3 mb-md-4">
                                <h2 class="h3 fw-bold mb-2 text-gradient">
                                    Thi Thử TOEIC Miễn Phí!
                                </h2>
                                <p class="lead mb-0 text-white">Kiểm tra trình độ của bạn ngay hôm nay</p>
                            </div>
                            
                            <div class="features-list">
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div class="feature-text">
                                        <h6 class="mb-0">Full Test như thi thật</h6>
                                        <small class="feature-desc">Mô phỏng bài thi TOEIC</small>
                                    </div>
                                </div>
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div class="feature-text">
                                        <h6 class="mb-0">Mini Test theo kỹ năng</h6>
                                        <small class="feature-desc">Reading & Listening</small>
                                    </div>
                                </div>
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div class="feature-text">
                                        <h6 class="mb-0">Chấm điểm chi tiết</h6>
                                        <small class="feature-desc">Phân tích điểm số</small>
                                    </div>
                                </div>
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div class="feature-text">
                                        <h6 class="mb-0">Giải thích đáp án</h6>
                                        <small class="feature-desc">Hướng dẫn chi tiết</small>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <a href="{{ route('practice-tests.index') }}" class="btn btn-glow px-4 py-2 px-md-5 py-md-3">
                                    Thi Thử Ngay
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Desktop styles */
        .modal-xl {
            max-width: 1000px;
        }

        #promotionModal .modal-content {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .promotion-image-container {
            min-height: 400px;
            background: linear-gradient(45deg, #1a2980, #26d0ce);
        }

        .promotion-image {
            transform: scale(1);
            transition: transform 0.5s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .promotion-image:hover {
            transform: scale(1.02);
        }

        .bg-overlay {
            background: radial-gradient(circle at center, transparent 0%, rgba(0,0,0,0.2) 100%);
            backdrop-filter: blur(5px);
        }

        .text-gradient {
            background: linear-gradient(to right, #FFD700, #FFA500);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 1.8rem;
        }

        .features-list {
            margin: 1.5rem 0;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            padding: 0.8rem;
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .feature-item:hover {
            transform: translateX(3px);
            background: rgba(255,255,255,0.15);
        }

        .feature-icon {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        .feature-icon i {
            color: #FFD700;
            font-size: 1.1rem;
        }

        .feature-text {
            flex: 1;
        }

        .feature-text h6 {
            color: #fff;
            margin: 0;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .feature-desc {
            color: rgba(255,255,255,0.8);
            font-size: 0.9rem;
            margin-top: 0.2rem;
            display: block;
        }

        .btn-glow {
            background: linear-gradient(45deg, #FFD700, #FFA500);
            border: none;
            color: #000;
            font-weight: 600;
            border-radius: 30px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            font-size: 1.2rem;
            white-space: nowrap;
        }

        .btn-glow:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255,215,0,0.4);
            color: #000;
        }

        .btn-glow::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: rgba(255,255,255,0.2);
            transform: rotate(45deg);
            animation: glow 1.5s linear infinite;
        }

        @keyframes glow {
            0% { transform: rotate(45deg) translateX(-100%); }
            100% { transform: rotate(45deg) translateX(100%); }
        }

        .content-section {
            background: rgba(0,0,0,0.2);
        }

        /* Mobile styles */
        @media (max-width: 768px) {
            .modal-dialog {
                margin: 0.5rem;
            }

            .modal-content {
                border-radius: 10px;
            }

            .text-gradient {
                font-size: 1.4rem;
            }

            .feature-item {
                padding: 0.6rem;
                margin-bottom: 0.8rem;
            }

            .feature-icon {
                width: 30px;
                height: 30px;
            }

            .feature-text h6 {
                font-size: 1rem;
            }

            .feature-desc {
                font-size: 0.85rem;
            }

            .btn-glow {
                font-size: 1rem;
                padding: 0.5rem 2rem;
            }

            .lead {
                font-size: 1rem;
            }

            .modal-body {
                padding: 1rem !important;
            }

            .features-list {
                margin: 1rem 0;
            }
        }

        /* Small mobile styles */
        @media (max-width: 375px) {
            .text-gradient {
                font-size: 1.2rem;
            }

            .feature-text h6 {
                font-size: 0.9rem;
            }

            .feature-desc {
                font-size: 0.8rem;
            }

            .btn-glow {
                font-size: 0.9rem;
                padding: 0.4rem 1.5rem;
            }
        }
    </style>

    <script>
        // Hiển thị modal sau 5 giây nếu đang ở trang chủ
        setTimeout(function() {
            var promotionModal = new bootstrap.Modal(document.getElementById('promotionModal'));
            promotionModal.show();
        }, 5000);
    </script>
    @endif

</body>

</html>
