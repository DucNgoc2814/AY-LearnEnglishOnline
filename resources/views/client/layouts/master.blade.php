<!DOCTYPE html>
<html lang="en" dir="ltr">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5.0, minimum-scale=0.86">


    <!-- Meta Tags -->
    <meta name="description" content="Home page for academy Seo">
    <meta name="keywords" content="">
    <meta name="robots" content="Meta robot">
    <meta name="author" content="Creativeitem">
    <title>@yield('title')</title>
    @include('client.layouts.partials.style')
    <script src="{{ asset('themes/client/assets/global/js/jquery-3.6.1.min.js') }}"></script>
    @yield('styles')
</head>

<body class="">
    <!---------- Header Section start  ---------->
    <header>
        <!-- Sub Header Start -->
        @include('client.layouts.partials.header');
        <!---- Sub Header End ------>

        @include('client.layouts.partials.menu-response');
    </header>
    <!---------- Header Section End  ---------->
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
    <!---------- Banner Section Start ---------------->
    @include('client.layouts.partials.banner')
    <!---------- Banner Section End ---------------->


    @yield('content')

    <div class="py-4 w-100"></div>



    <!--------- footer Section Start--------------->
    @include('client.layouts.partials.footer')
    <!--------- footer Section End--------------->

    <!-- PAYMENT MODAL -->
    <!-- Modal -->


    @include('client.layouts.partials.script')

    @yield('scripts')
</body>


</html>
