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
                        src="{{ asset('themes/client/assets/frontend/default-new/image/login-security.gif') }}">
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

                        <div class="alert alert-warning mb-3" id="auto-logout-alert" style="display: none;">
                            <strong>Thông báo:</strong> Bạn đã được tự động đăng xuất do không hoạt động hoặc đóng trình duyệt.
                        </div>

                        <script>
                            // Check for auto logout notification
                            document.addEventListener('DOMContentLoaded', function() {
                                // Ngăn chặn việc quay lại trang này sau khi đã đăng nhập
                                history.pushState(null, null, location.href);
                                window.onpopstate = function () {
                                    history.go(1);
                                };

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

                                // Check URL parameter
                                if (window.location.href.indexOf('auto_logout=1') > -1) {
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
                                <button type="submit" class="btn btn-warning">
                                    <i class="fa-solid fa-right-from-bracket me-2"></i>Đăng xuất thiết bị cũ và đăng nhập tại đây
                                </button>
                            </form>
                        </div>
                        <script>
                            // Store password temporarily in session storage
                            const passwordField = document.getElementById('password');
                            if (passwordField) {
                                passwordField.addEventListener('input', function() {
                                    sessionStorage.setItem('temp_password', this.value);
                                });
                            }
                        </script>
                        @endif

                        <form action="{{ route('login.submit') }}" method="post" id="login-form">
                            @csrf
                            <div class="mb-4">
                                <h5>Email</h5>
                                <div class="position-relative">
                                    <i class="fa-solid fa-user"></i>
                                    {{-- <i class="fa-solid fa-shield-halved"></i> --}}
                                    <input class="form-control" id="email" type="email" name="email"
                                        placeholder="Nhập email" value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="">
                                <h5>Mật khẩu</h5>
                                <div class="position-relative">
                                    <i class="fa-solid fa-key"></i>
                                    <i class="fa-solid fa-eye cursor-pointer" id="password-toggle"
                                        onclick="togglePasswordVisibility()"
                                        style="right: 20px; left: unset; position: absolute; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                                    <input class="form-control" id="password" type="password" name="password"
                                        placeholder="Nhập mật khẩu">
                                </div>
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

    <script>
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
