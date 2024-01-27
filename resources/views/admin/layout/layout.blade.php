<!doctype html>
<html lang="ru">

<head>

    <meta charset="utf-8" />
    <title>B-CMS | Панель администратора</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('public/assets/admin/images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('public/assets/admin/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('public/assets/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('public/assets/admin/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/admin/css/main.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />

    <link rel="stylesheet" href="{{ asset('public/assets/admin/libs/toastr/build/toastr.min.css') }}">


    @yield('header-links')
</head>

@php
    if (isset($_COOKIE['Menu']) && $_COOKIE['Menu'] === 'false') {
        $menuClosed = 'class=vertical-collpsed ';
    } else {
        $menuClosed = ' ';
    }
@endphp

<body data-sidebar="dark" data-layout-mode="light" {{ $menuClosed }}>

    <!-- Begin page -->
    <div id="layout-wrapper">


        @include('admin.blocks.header')

        @include('admin.blocks.menu')


        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                @yield('page-name')
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    @yield('content')
                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            © <a href="https://bizzone.uz/" target="_blank">Bizzone.uz</a>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Все права защищены ©
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('public/assets/admin/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/assets/admin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/assets/admin/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('public/assets/admin/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('public/assets/admin/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('public/assets/admin/libs/toastr/build/toastr.min.js') }}"></script>
    <script src="{{ asset('public/assets/admin/js/app.js') }}"></script>
    <script src="{{ asset('public/assets/admin/js/main.js') }}"></script>
    @include('admin.blocks.errors')
    @yield('footer-links')

    <script></script>

</body>

</html>
