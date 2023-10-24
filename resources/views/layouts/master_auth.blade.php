<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title>@yield('title') | Initiative AREC - Gestion disciplinaire</title>
    <link rel="apple-touch-icon" href="{{ asset('images/bfc.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/iup_logo.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.min.css') }}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/horizontal-menu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-gradient.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/charts/morris.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/fonts/simple-line-icons/style.min.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/line-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">


    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/fonts/feather/style.min.css') }}">
    <!-- END: Page CSS-->

    <link rel="stylesheet" href="{{ asset('css/top-header-style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <style>
        .border-top-primary {
            border-top: 3px solid #666ee8!important;
        }
        .border-top-success {
            border-top: 3px solid #28d094!important;ff9149
        }

        .border-top-warning {
            border-top: 3px solid #ff9149!important;
        }

        .border-top-danger {
            border-top: 3px solid #ff4961!important;
        }
        .border-top-dark {
            border-top: 3px solid #424242!important;
        }
        .text-bold{
            font-weight: bold!important;
        }
    </style>

    @yield('styles')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
        *{
            font-family: Poppins, sans-serif;
        }
        .header-navbar{
            font-family: Poppins, sans-serif;
        }
        .blue-grey.lighten-2, .blue-grey.lighten-2 a{
            color: white!important;
        }
        footer, btn-dark{
            background-color: #2c343b!important;
        }
        .breadcrumb-item.active, .content-header-title{
            color: #2c343b!important;
            font-weight: bold!important;
            /* text-decoration: underline; */
        }
        .breadcrumb-item>a{
            color: #6d7378!important;
            font-weight: bold!important;
        }
        .card-title{
            font-weight: bold!important;
            text-decoration: underline;
        }

        .breadcrumb .breadcrumb-item+.breadcrumb-item::before{
            content:'»';
        }
        .breadcrumb-item+.breadcrumb-item::before{
            padding-right: 1px;
            padding-left: 0px;
        }
        .btn-success, .badge-success{
            background-color: #009562!important;
            border: 1px solid #009562!important;
        }
        .bg-success{
            background-color: #009562!important;
        }
        .btn-primary, .badge-primary, .bg-primary{
            background-color: #006aab!important;
        }
        .btn-danger, .badge-danger{
            background-color: #e61e5d;
        }
        .btn{
            font-size: 16px;
        }
        .btn-warning{
            color: #fff!important;
        }

    </style>

</head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
<body style="font-family: Poppins, sans-serif;" class="horizontal-layout horizontal-menu 2-columns" data-open="hover" data-menu="horizontal-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
    {{-- @include('includes.top-header') --}}
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    {{-- @include('includes.header') --}}
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        @yield('content')
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Footer-->
    @include('includes.footer')
    <!-- END: Footer-->

    @yield('scripts')
</body>
  <!-- END: Body-->

<!-- Mirrored from pixinvent.com/modern-admin-clean-bootstrap-4-dashboard-html-template/html/ltr/horizontal-menu-template-nav/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 29 Apr 2022 11:18:19 GMT -->
</html>
