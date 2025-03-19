<!DOCTYPE html>
<html lang="vi">


<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('themes/admin/img/logo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{asset('css/ad.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" media="print" onload="this.media='all'">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    <meta http-equiv="x-dns-prefetch-control" content="on">



    @include('admin.layouts.partials.styles')
    @stack('styles')
</head>

<body class="crm_body_bg">
    <!-- sidebar  -->
    {{-- @include('admin.layouts.partials.sidebar') --}}
    <!--/ sidebar  -->

    {{-- <section class="main_content "> --}}
        <!-- header  -->
        {{-- @include('admin.layouts.partials.header') --}}

        <!-- content -->
        @yield('content')

    {{-- </section> --}}

    <!-- Scripts -->
    {{-- @include('admin.layouts.partials.scripts') --}}
    @stack('scripts')
</body>

</html>
