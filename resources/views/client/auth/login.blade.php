@extends('client.layouts.master')
@section('title', 'Home page | AY-LearnEnglish')
@section('content')
    @if(session('clear_storage_script'))
        {!! session('clear_storage_script') !!}
    @endif

    <section class="sign-up my-5 py-5">
        <div class="container ">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12 col-12 text-center">
                    <img loading="lazy" width="65%"
                        src="{{ asset('themes/client/assets/frontend/default-new/image/login-security.gif') }}" alt="Login Security Image">
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12 col-12 ">
                    <div class="sing-up-right">
                        <h3 class="text-center">Đăng nhập</h3>
                        <p>Khám phá, học tập và phát triển cùng chúng tôi. Hãy bắt đầu một hành trình học tập trực tuyến
                            trơn tru và giàu cảm hứng.
                        </p>

                        <div class="alert alert-info mb-3">
                            <strong>Thông báo bảo mật:</strong>
                            Mỗi tài khoản chỉ có thể đăng nhập trên một trình duyệt tại một thời điểm.
                            Vui lòng đăng xuất khỏi phiên hiện tại trước khi đăng nhập ở thiết bị mới.
                        </div>

                        @if(session('notification'))
                        <div class="alert alert-{{ session('notification.type') }} mb-3">
                            <strong>{{ session('notification.type') == 'success' ? 'Thành công:' : (session('notification.type') == 'warning' ? 'Chú ý:' : 'Lỗi:') }}</strong>
                            {{ session('notification.message') }}
                        </div>
                        @endif

                        <div class="alert alert-warning mb-3" id="auto-logout-alert" style="display: none;">
                            <strong>Thông báo:</strong> Bạn đã được tự động đăng xuất do không hoạt động hoặc đóng trình duyệt.
                        </div>

                        <script nonce="{{ csrf_token() }}">
                            // Check for auto logout notification
                            document.addEventListener('DOMContentLoaded', function() {
                                // Ngăn chặn việc quay lại trang này sau khi đã đăng nhập
                                history.pushState(null, null, location.href);
                                window.onpopstate = function () {
                                    history.go(1);
                                };

                                // Kiểm tra và khôi phục CSRF token từ sessionStorage
                                const savedCsrfToken = sessionStorage.getItem('saved_csrf_token');
                                if (savedCsrfToken) {
                                    // Cập nhật token trong meta tag
                                    const metaTag = document.querySelector('meta[name="csrf-token"]');
                                    if (metaTag) {
                                        metaTag.content = savedCsrfToken;
                                    }

                                    // Cập nhật token trong form nếu có
                                    const csrfInputs = document.querySelectorAll('input[name="_token"]');
                                    csrfInputs.forEach(input => {
                                        input.value = savedCsrfToken;
                                    });

                                    // Xóa token đã lưu sau khi sử dụng
                                    sessionStorage.removeItem('saved_csrf_token');
                                }

                                // Thêm timestamp vào form để đảm bảo mỗi request là duy nhất
                                const loginForm = document.getElementById('login-form');
                                if (loginForm) {
                                    loginForm.addEventListener('submit', function() {
                                        const timeInput = document.createElement('input');
                                        timeInput.type = 'hidden';
                                        timeInput.name = 'request_time';
                                        timeInput.value = new Date().getTime();
                                        loginForm.appendChild(timeInput);
                                    });
                                }

                                const showAutoLogoutNotification = () => {
                                    const alert = document.getElementById('auto-logout-alert');
                                    if (alert) {
                                        alert.style.display = 'block';

                                        // Auto-hide after 10 seconds
                                        setTimeout(function() {
                                            // Fade out effect
                                            alert.style.transition = 'opacity 1s ease';
                                            alert.style.opacity = '0';

                                            // Remove after fade completes
                                            setTimeout(function() {
                                                alert.style.display = 'none';
                                            }, 1000);
                                        }, 10000); // 10 seconds
                                    }
                                };

                                // Xóa cache trang để đảm bảo luôn load mới
                                if (!window.performance.navigation.type) {
                                    // Xóa cache nếu không phải do quay lại
                                    window.onpageshow = function(event) {
                                        if (event.persisted) {
                                            window.location.reload();
                                        }
                                    };
                                }

                                // Check URL parameter - sử dụng DOMPurify để tránh XSS
                                const urlParams = new URLSearchParams(window.location.search);
                                if (urlParams.has('auto_logout') && urlParams.get('auto_logout') === '1') {
                                    showAutoLogoutNotification();

                                    // Remove the parameter from URL
                                    if (window.history.replaceState) {
                                        let currentUrl = window.location.href;

                                        // Remove auto_logout param and cleanup URL
                                        if (currentUrl.indexOf('?auto_logout=1') > -1) {
                                            currentUrl = currentUrl.replace('?auto_logout=1', '');
                                        } else if (currentUrl.indexOf('&auto_logout=1') > -1) {
                                            currentUrl = currentUrl.replace('&auto_logout=1', '');
                                        }

                                        // Clean up any trailing ? or & if they're now at the end
                                        if (currentUrl.endsWith('?') || currentUrl.endsWith('&')) {
                                            currentUrl = currentUrl.slice(0, -1);
                                        }

                                        window.history.replaceState({}, document.title, currentUrl);
                                    }
                                }

                                // Also check sessionStorage (for the new implementation)
                                if (sessionStorage.getItem('auto_logout') === '1') {
                                    showAutoLogoutNotification();
                                    sessionStorage.removeItem('auto_logout');
                                }

                                // Tự động khôi phục session nếu có thể
                                (function attemptSessionRecovery() {
                                    // Kiểm tra xem có lỗi hiển thị trên URL không
                                    const urlParams = new URLSearchParams(window.location.search);
                                    if (urlParams.has('error')) {
                                        console.log('Error detected in URL, attempting recovery');

                                        // Xóa tham số error
                                        if (window.history.replaceState) {
                                            const newUrl = window.location.pathname +
                                                window.location.search.replace(/[\?&]error=[^&]+/, '');
                                            window.history.replaceState({}, document.title, newUrl);
                                        }

                                        // Reload trang để có token mới
                                        setTimeout(() => {
                                            window.location.reload();
                                        }, 1000);
                                        return;
                                    }

                                    // Kiểm tra form có hiển thị không
                                    const loginForm = document.getElementById('login-form');
                                    if (loginForm) {
                                        // Đảm bảo CSRF token được cập nhật
                                        const tokenInput = loginForm.querySelector('input[name="_token"]');
                                        const metaToken = document.querySelector('meta[name="csrf-token"]')?.content;

                                        if (tokenInput && metaToken && tokenInput.value !== metaToken) {
                                            console.log('CSRF token mismatch detected, updating form token');
                                            tokenInput.value = metaToken;
                                        }
                                    }
                                })();
                            });
                        </script>

                        @if(session('force_logout_option'))
                        <div class="alert alert-warning mb-3">
                            <strong>Chú ý:</strong>
                            <p>Bạn đang cố gắng đăng nhập trên một thiết bị mới, trong khi tài khoản của bạn đã đăng nhập ở thiết bị khác.</p>
                            <form action="{{ route('login.submit') }}" method="post" class="mt-3">
                                @csrf
                                <input type="hidden" name="email" value="{{ old('email') }}">
                                <input type="hidden" name="password" value="{{ session('temp_password') }}">
                                <input type="hidden" name="force_logout_token" value="{{ session('force_logout_token') }}">
                                <input type="hidden" name="force_logout" value="1">
                                <button type="submit" class="btn btn-warning">
                                    <i class="fa-solid fa-right-from-bracket me-2"></i>Đăng xuất thiết bị cũ và đăng nhập tại đây
                                </button>
                            </form>
                        </div>
                        @endif

                        <form action="{{ route('login.submit') }}" method="post" id="login-form">
                            @csrf
                            <div class="mb-4">
                                <h5>Email</h5>
                                <div class="position-relative">
                                    <i class="fa-solid fa-user"></i>
                                    <input class="form-control" id="email" type="email" name="email"
                                        placeholder="Nhập email" value="{{ old('email') }}" autocomplete="email">
                                </div>
                                @error('email')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="">
                                <h5>Mật khẩu</h5>
                                <div class="position-relative">
                                    <i class="fa-solid fa-key"></i>
                                    <i class="fa-solid fa-eye cursor-pointer" id="password-toggle"
                                        onclick="togglePasswordVisibility()"
                                        style="right: 20px; left: unset; position: absolute; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                                    <input class="form-control" id="password" type="password" name="password"
                                        placeholder="Nhập mật khẩu" autocomplete="current-password">
                                </div>
                                @error('password')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                                <small class="w-100">
                                    <a class="text-end w-100 text-muted" href="login/forgot_password_request.html">Quên mật
                                        khẩu?</a>
                                </small>
                            </div>
                            <div class="log-in">
                                <button type="submit" class="btn btn-primary">
                                    Đăng nhập </button>
                            </div>
                        </form>

                        <div class="text-center">
                            <p>
                                Bạn chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script nonce="{{ csrf_token() }}">
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const passwordToggle = document.getElementById('password-toggle');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordToggle.classList.remove('fa-eye');
            passwordToggle.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            passwordToggle.classList.remove('fa-eye-slash');
            passwordToggle.classList.add('fa-eye');
        }
    }
    </script>
@endsection
