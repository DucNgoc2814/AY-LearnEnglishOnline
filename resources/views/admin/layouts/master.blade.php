<!DOCTYPE html>
<html lang="vi">


<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('uploads/logos/LG 1.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/ad.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    <meta http-equiv="x-dns-prefetch-control" content="on">
    @include('admin.layouts.partials.styles')
    @stack('styles')
</head>

<body>

    <div class="flex flex-col min-h-screen">
        @include('admin.layouts.partials.header')
        @yield('content')
        @include('admin.layouts.partials.footer')
    </div>

    @include('admin.layouts.partials.scripts')
    @stack('scripts')
</body>

</html>
