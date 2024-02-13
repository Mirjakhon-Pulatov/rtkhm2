<!doctype html>
<html lang="ru">

<head>
    <!-- Title -->
    <title>KMT.UZ | Страница не найдена</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main Css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/main.css') }}">

    <!-- Favicon -->
    <link rel="icon" href="public/assets/img/icons/logo/favicon.ico" type="image/x-icon">

    <!-- Map CSS -->
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css">

    <!-- Libs CSS -->
    <link rel="stylesheet" href="{{ asset('public/assets/css/libs.bundle.css') }}">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('public/assets/css/theme.bundle.css') }}">

    <style type="text/css">
        body {
            background-image: linear-gradient(to bottom, #4377c6, #5083d1, #5d8fdc, #6a9be7, #77a8f2);
        }

        .error__ {
            font-size: 200px;
        }

        @media only screen and (max-width: 600px) {
            .error__ {
                font-size: 120px;
            }
        }
    </style>
</head>

<body>

    <!-- CONTENT -->
    <section class="section-border ">
        <div class="container d-flex flex-column">
            <div class="row align-items-center justify-content-center min-vh-100">
                <div class="col-md-6">

                    <!-- Heading -->
                    <h1 class="display-3 fw-bold text-center text-white">
                        <span class="error__">404</span> <br>Страница не найдена
                    </h1>

                    <!-- Link -->
                    <div class="text-center">
                        <a class="btn btn-primary" href="{{ url('/') }}">
                            На главную
                        </a>
                    </div>

                </div>
                <div class="col-md-6">
                    <img width="100%" height="auto"
                        src="{{ asset('public/assets/img/illustrations/illustration-1.png') }}">
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>


    <!-- JAVASCRIPT -->
    <!-- Map JS -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>

    <!-- Vendor JS -->
    <script src="{{ asset('public/assets/js/vendor.bundle.js') }}"></script>

    <!-- Theme JS -->
    <script src="{{ asset('public/assets/js/theme.bundle.js') }}"></script>

</body>

</html>
