<!DOCTYPE html>
<html lang="vi">


<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('themes/admin/img/logo.png') }}" type="image/png">

    @include('admin.layouts.partials.styles')
    @stack('styles')
</head>

<body class="crm_body_bg">
    <!-- sidebar  -->
    @include('admin.layouts.partials.sidebar')
    <!--/ sidebar  -->

    <section class="main_content dashboard_part large_header_bg">
        <!-- header  -->
        @include('admin.layouts.partials.header')
        
        <!-- content -->
        @yield('content')

        <!-- footer -->
        @include('admin.layouts.partials.footer')
    </section>

    <!-- Scripts -->
    @include('admin.layouts.partials.scripts')
    @stack('scripts')
</body>

</html>
