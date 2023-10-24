<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title') | Initiative AREC DAF_Support</title>

        @yield('style')
        <style>
            .img-size-50{
                width: 25px!important;
            }
            .dropdown-menu-lg{
                min-width:160px;
            }
        </style>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">

        <div class="wrapper">

            <!-- Preloader -->
            <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__shake" src="Logo-BFC.png" alt="AdminLTELogo" height="60" width="60">
            </div>

            @include('layouts.navbar')
            @include('layouts.sidebar')


            {{-- <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="https://www.bfclimited.com/" class="brand-link">
                    <img src="Logo-BFC.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">BFC</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="pb-3 mt-3 mb-3 user-panel d-flex">
                        <div class="image">
                            <img src="image_user.png" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">Utilisateur courant</a>
                        </div>
                    </div>

                    <!-- Menu de la side barre -->
                    <nav class="mt-2">
                        @include('sidebar')
                    </nav>

                    <!-- /.sidebar-menu -->
                    </div>
                    <!-- /.sidebar -->
            </aside> --}}

            <!-- Content Wrapper. Contains page content horizontal -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                @yield('header-section')
                <!-- /.content-header -->

                <!-- Main content -->
                @yield('body-section')
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            @include('includes.footer')
        </div>
        <!-- ./wrapper -->

        @yield('scripts')

    </body>
</html>
