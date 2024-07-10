<!DOCTYPE html>
<html lang="uz">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph для оптимизации отображения в социальных сетях -->
    <meta property="og:title" content="@yield('title-og')">
    <meta property="og:description" content="@yield('desc-og')">
    <meta property="og:image" content="@yield('img-og')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title-fb')">
    <meta property="og:description" content="@yield('desc-fb')">
    <meta property="og:image" content="@yield('img-fb')">

    <!-- Twitter Card для оптимизации отображения в Twitter -->
    <meta name="twitter:card" content="@yield('card-tr')">
    <meta name="twitter:title" content="@yield('title-tr')">
    <meta name="twitter:description" content="@yield('desc-tw')">
    <meta name="twitter:image" content="@yield('img-tr')">


    <!-- favicon -->
{{--    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/asset/img/favicon.png') }}">--}}
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('public/asset/css/bootstrap.min.css') }}">
    <!-- font awesome -->
    <link rel="stylesheet" href="{{ asset('public/asset/css/font-awesome.min.css')}}">
    <!-- flaticon -->
    <link rel="stylesheet" href="{{ asset('public/asset/css/flaticon.css')}}">
    <!-- animate css -->
    <link rel="stylesheet" href="{{ asset('public/asset/css/animate.css')}}">
    <!-- owl-carousel css -->
    <link rel="stylesheet" href="{{ asset('public/asset/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/asset/css/owl.theme.default.min.css')}}">
    <!-- lity css -->
    <link rel="stylesheet" href="{{ asset('public/asset/css/lity.min.css')}}">
    <!-- slick css -->
    <link rel="stylesheet" href="{{ asset('public/asset/css/slick.css')}}">
    <link rel="stylesheet" href="{{ asset('public/asset/css/slick-theme.css') }}">
    <!-- slick nav css -->
    <link rel="stylesheet" href="{{ asset('public/asset/css/slicknav.min.css')}}">
    <!-- smoothbox css -->
    <link rel="stylesheet" href="{{ asset('public/asset/css/smoothbox.css')}}">
    <!-- switcher css -->
    <link rel="stylesheet" href="{{ asset('public/asset/css/switcher.css')}}">
    <!-- style css -->
    <link rel="stylesheet" href="{{ asset('public/asset/css/style.css')}}">
    <!-- skin css -->
    <link class="skin" rel="stylesheet" type="text/css" href="{{ asset('public/asset/css/skin/skin-1.css')}}'">
    <!-- responsive css -->
    <link rel="stylesheet" href="{{ asset('public/asset/css/responsive.css')}}">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>


    @yield('top-css')

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https:/oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body id="bg">

<div class="page-wrapper">


    <!-- ====== Go to top ====== -->
    <a id="c-scroll" title="Go to top" href="javascript:void(0)">
        <i class="fa fa-chevron-up"></i>
    </a>

    <!-- ====== preloader ====== -->
        <div id="preloader"></div>

    <!--======== header=========-->
    @include('blocks.navbar')

    @yield('content')

    <!--======== footer =========-->
    @include('blocks.footer')

</div>

<!-- jQuery -->
<script src="{{ asset('public/asset/js/jquery-1.12.4.min.js') }}"></script>
<!-- bootstraps js -->
<script src="{{ asset('public/asset/js/bootstrap.min.js') }}"></script>
<!--wow js -->
<script src="{{ asset('public/asset/js/wow.js') }}"></script>
<!-- owl carousel js -->
<script src="{{ asset('public/asset/js/owl.carousel.min.js') }}"></script>
<!-- waypoints js plugin -->
<script src="{{ asset('public/asset/js/jquery.waypoints.min.js') }}"></script>
<!-- counter-up js plugin -->
<script src="{{ asset('public/asset/js/jquery.counterup.min.js') }}"></script>
<!-- images-loaded js -->
<script src="{{ asset('public/asset/js/imagesloaded.js') }}"></script>
<!-- slick js -->
<script src="{{ asset('public/asset/js/slick.min.js') }}"></script>
<!-- slicknav js -->
<script src="{{ asset('public/asset/js/jquery.slicknav.js') }}"></script>
<!-- isotope js -->
<script src="{{ asset('public/asset/js/isotope.min.js') }}"></script>
<!-- lity js -->
<script src="{{ asset('public/asset/js/lity.min.js') }}"></script>
<!-- easy pie chart js -->
<script src="{{ asset('public/asset/js/jquery.easypiechart.min.js') }}"></script>
<!-- smoothbox js -->
<script src="{{ asset('public/asset/js/smoothbox.jquery2.js') }}"></script>
<!-- custom settings js -->
<script src="{{ asset('public/asset/js/custom.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"
        integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@yield('bottom-script')
</body>

</html>
