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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (session('notification'))
        <meta name="notification" content="{{ json_encode(session('notification')) }}">
    @endif
    <title>@yield('title')</title>
    @include('client.layouts.partials.style')
    <script src="{{ asset('themes/client/assets/global/js/jquery-3.6.1.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="{{ asset('css/notification.css') }}">
    @yield('styles')
    @stack('css')

</head>

<body class="">
    <header>
        @if (!Route::is('course.learning'))
            @include('client.layouts.partials.header')
            @include('client.layouts.partials.menu-response')
        @endif
    </header>
    <style>
        .eImage span {
            width: auto !important;
        }

        .course-item-one .content .title {
            display: -webkit-box !important;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal
        }
    </style>
    @yield('content')
    @if (!Route::is('course.learning'))
        <div class="py-4 w-100"></div>
        @include('client.layouts.partials.footer')
        @include('client.layouts.partials.script')
        <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        <script src="{{ asset('js/notification.js') }}"></script>
    @endif

    @stack('scripts')

</body>


</html>
