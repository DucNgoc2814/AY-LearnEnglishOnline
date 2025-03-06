<!DOCTYPE html>
<html lang="zxx">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>@yield('title')</title>

    <!-- <link rel="icon" href="{{ asset('themes/admin/img/logo.png') }}" type="image/png"> -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('themes/admin/css/bootstrap1.min.css') }}" />
    <!-- themefy CSS -->
    <link rel="stylesheet" href="{{ asset('themes/admin/vendors/themefy_icon/themify-icons.css') }}" />
    <!-- select2 CSS -->
    <link rel="stylesheet" href="{{ asset('themes/admin/vendors/niceselect/css/nice-select.css') }}" />
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{ asset('themes/admin/vendors/owl_carousel/css/owl.carousel.css') }}" />
    <!-- gijgo css -->
    {{-- <link rel="stylesheet" href="{{ asset('themes/admin/vendors/gijgo/gijgo.min.css') }}" /> --}}
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{ asset('themes/admin/vendors/font_awesome/css/all.min.css') }}" />
    {{-- <link rel="stylesheet" href="{{ asset('themes/admin/vendors/tagsinput/tagsinput.css') }}" /> --}}

    <!-- date picker -->
    <link rel="stylesheet" href="{{ asset('themes/admin/vendors/datepicker/date-picker.css') }}" />

    <link rel="stylesheet" href="{{ asset('themes/admin/vendors/vectormap-home/vectormap-2.0.2.css') }}" />

    <!-- scrollabe  -->
    <link rel="stylesheet" href="{{ asset('themes/admin/vendors/scroll/scrollable.css') }}" />
    <!-- datatable CSS -->
    <link rel="stylesheet" href="{{ asset('themes/admin/vendors/datatable/css/jquery.dataTables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('themes/admin/vendors/datatable/css/responsive.dataTables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('themes/admin/vendors/datatable/css/buttons.dataTables.min.css') }}" />
    <!-- text editor css -->
    <link rel="stylesheet" href="{{ asset('themes/admin/vendors/text_editor/summernote-bs4.css') }}" />
    <!-- morris css -->
    {{-- <link rel="stylesheet" href="{{ asset('themes/admin/vendors/morris/morris.css') }}" /> --}}
    <!-- metarial icon css -->
    {{-- <link rel="stylesheet" href="{{ asset('themes/admin/vendors/material_icon/material-icons.css') }}" /> --}}

    <!-- menu css  -->
    <link rel="stylesheet" href="{{ asset('themes/admin/css/metisMenu.css') }}" />
    <!-- style CSS -->
    <link rel="stylesheet" href="{{ asset('themes/admin/css/style1.css') }}" />
    <link rel="stylesheet" href="{{ asset('themes/admin/css/colors/default.css') }}" id="colorSkinCSS">
</head>

<body class="crm_body_bg">



    <!-- main content part here -->

    <!-- sidebar  -->
    @include('admin.layouts.partials.sidebar')
    <!--/ sidebar  -->


    <section class="main_content dashboard_part large_header_bg">
        <!-- menu  -->
        @include('admin.layouts.partials.header')
        <!--/ menu  -->
        @yield('content')

        <!-- footer part -->
        @include('admin.layouts.partials.footer')
    </section>
    <!-- main content part end -->

    <!-- footer  -->
    <script src="{{ asset('themes/admin/js/jquery1-3.4.1.min.js') }}"></script>
    <!-- popper js -->
    <script src="{{ asset('themes/admin/js/popper1.min.js') }}"></script>
    <!-- bootstarp js -->
    <script src="{{ asset('themes/admin/js/bootstrap.min.html') }}"></script>
    <!-- sidebar menu  -->
    <script src="{{ asset('themes/admin/js/metisMenu.js') }}"></script>
    <!-- waypoints js -->
    <script src="{{ asset('themes/admin/vendors/count_up/jquery.waypoints.min.js') }}"></script>
    <!-- waypoints js -->
    <script src="{{ asset('themes/admin/vendors/chartlist/Chart.min.js') }}"></script>
    <!-- counterup js -->
    <script src="{{ asset('themes/admin/vendors/count_up/jquery.counterup.min.js') }}"></script>

    <!-- nice select -->
    <script src="{{ asset('themes/admin/vendors/niceselect/js/jquery.nice-select.min.js') }}"></script>
    <!-- owl carousel -->
    <script src="{{ asset('themes/admin/vendors/owl_carousel/js/owl.carousel.min.js') }}"></script>

    <!-- responsive table -->
    <script src="{{ asset('themes/admin/vendors/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('themes/admin/vendors/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('themes/admin/vendors/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('themes/admin/vendors/datatable/js/buttons.flash.min.js') }}"></script>
    {{-- <script src="{{ asset('themes/admin/vendors/datatable/js/jszip.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('themes/admin/vendors/datatable/js/pdfmake.min.js') }}"></script> --}}
    <script src="{{ asset('themes/admin/vendors/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('themes/admin/vendors/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('themes/admin/vendors/datatable/js/buttons.print.min.js') }}"></script>

    <!-- datepicker  -->
    <script src="{{ asset('themes/admin/vendors/datepicker/datepicker.js') }}"></script>
    <script src="{{ asset('themes/admin/vendors/datepicker/datepicker.en.js') }}"></script>
    <script src="{{ asset('themes/admin/vendors/datepicker/datepicker.custom.js') }}"></script>

    <script src="{{ asset('themes/admin/js/chart.min.js') }}"></script>
    <script src="{{ asset('themes/admin/vendors/chartjs/roundedBar.min.js') }}"></script>

    <!-- progressbar js -->
    <script src="{{ asset('themes/admin/vendors/progressbar/jquery.barfiller.js') }}"></script>
    <!-- tag input -->
    <script src="{{ asset('themes/admin/vendors/tagsinput/tagsinput.js') }}"></script>
    <!-- text editor js -->
    <script src="{{ asset('themes/admin/vendors/text_editor/summernote-bs4.js') }}"></script>
    <script src="{{ asset('themes/admin/vendors/am_chart/amcharts.js') }}"></script>

    <!-- scrollabe  -->
    <script src="{{ asset('themes/admin/vendors/scroll/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('themes/admin/vendors/scroll/scrollable-custom.js') }}"></script>

    <!-- vector map  -->
    {{-- <script src="{{ asset('themes/admin/vendors/vectormap-home/vectormap-2.0.2.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('themes/admin/vendors/vectormap-home/vectormap-world-mill-en.js') }}"></script> --}}

    <!-- apex chrat  -->
    {{-- <script src="{{ asset('themes/admin/vendors/apex_chart/apex-chart2.js') }}"></script> --}}
    {{-- <script src="{{ asset('themes/admin/vendors/apex_chart/apex_dashboard.js') }}"></script> --}}

    {{-- <script src="{{ asset('themes/admin/vendors/echart/echarts.min.js') }}"></script> --}}


    {{-- <script src="{{ asset('themes/admin/vendors/chart_am/core.js') }}"></script> --}}
    {{-- <script src="{{ asset('themes/admin/vendors/chart_am/charts.js') }}"></script>
    <script src="{{ asset('themes/admin/vendors/chart_am/animated.js') }}"></script>
    <script src="{{ asset('themes/admin/vendors/chart_am/kelly.js') }}"></script>
    <script src="{{ asset('themes/admin/vendors/chart_am/chart-custom.js') }}"></script> --}}
    <!-- custom js -->
    <script src="{{ asset('themes/admin/js/dashboard_init.js') }}"></script>
    <script src="{{ asset('themes/admin/js/custom.js') }}"></script>
</body>

<!-- Mirrored from demo.dashboardpack.com/sales-html/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 05 Mar 2025 10:06:39 GMT -->

</html>
