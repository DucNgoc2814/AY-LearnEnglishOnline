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

    @if (session('jwt_token'))
        <script nonce="{{ csrf_token() }}" src="{{ asset('js/auth-checker.js') }}"></script>
        <script nonce="{{ csrf_token() }}" src="{{ asset('js/session-manager.js') }}"></script>
        <script nonce="{{ csrf_token() }}">
            // Xử lý đăng xuất form
            document.addEventListener('DOMContentLoaded', function() {
                // Không cần script riêng cho form đăng xuất vì đã sử dụng onclick trên thẻ a
            });
        </script>
    @endif
</body>

</html>
