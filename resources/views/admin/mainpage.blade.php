<!doctype html>
<html lang="ru">

<head>

    <meta charset="utf-8" />
    <title>B-CMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="B-CMS система управления контентом" name="description" />
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
    <link rel="stylesheet" href="{{ asset('public/assets/admin/libs/toastr/build/toastr.min.css') }}">
    <style>
        body {
            background-image: linear-gradient(115deg, hsl(237deg 65% 27%) 0%, hsl(249deg 49% 33%) 17%, hsl(257deg 40% 38%) 36%, hsl(262deg 33% 44%) 54%, hsl(267deg 28% 49%) 71%, hsl(272deg 28% 55%) 84%, hsl(276deg 29% 61%) 94%, hsl(280deg 31% 67%) 100%);
        }
    </style>
</head>

<body>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center ">
                <img class="mb-5" src="{{ asset('public/assets/admin/images/favicon.ico') }}" alt="Logo Cms"
                    width="20%" height="auto">
                <h2 class="text-white text-center">Добро пожаловать в B-CMS <br>
                    <a href="/admin/login">войдите</a> для управления
                </h2>
            </div>
        </div>
    </div>
</body>

</html>
