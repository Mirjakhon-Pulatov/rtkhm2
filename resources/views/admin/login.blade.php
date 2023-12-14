<!doctype html>
<html lang="ru">

<head>

    <meta charset="utf-8"/>
    <title>B-CMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="B-CMS система управления контентом" name="description"/>
    <meta content="Themesbrand" name="author"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/admin/images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/admin/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
          type="text/css"/>
    <!-- Icons Css -->
    <link href="{{ asset('assets/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="{{ asset('assets/admin/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/admin/libs/toastr/build/toastr.min.css') }}">
    <style>
        body {
            background-image: linear-gradient(115deg, hsl(237deg 65% 27%) 0%, hsl(249deg 49% 33%) 17%, hsl(257deg 40% 38%) 36%, hsl(262deg 33% 44%) 54%, hsl(267deg 28% 49%) 71%, hsl(272deg 28% 55%) 84%, hsl(276deg 29% 61%) 94%, hsl(280deg 31% 67%) 100%);
        }
    </style>
</head>

<body>
<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="bg-primary bg-soft">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-4">
                                    <h5 class="text-primary">Добро пожаловать <br>в B-CMS !</h5>
                                    <p>Войдите для управления сайтом.</p>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img src="{{ asset('assets/admin/images/profile-img.png') }}" alt="Logo Bizzone"
                                     class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="auth-logo">

                            <a href="/" class="auth-logo-dark">
                                <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light"
                                              style="background-color: #FF9B22 !important;">
                                            <img src="{{ asset('assets/admin/images/favicon.ico') }}" alt="Logo Cms"
                                                 height="54">
                                        </span>
                                </div>
                            </a>
                        </div>
                        <div class="p-2">
                            <form class="form-horizontal" action="{{ route('login.ajax') }}" method="POST"
                                  id="ajax-login-form">
                                @csrf
                                <div class="mb-3">
                                    <label for="username" class="form-label">Логин</label>
                                    <input type="text" name="login" class="form-control" id="username"
                                           placeholder="Введите Логин" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Пароль</label>
                                    <div class="input-group auth-pass-inputgroup">
                                        <input id="password" type="password" name="password" class="form-control"
                                               placeholder="Введите Пароль" aria-label="Password"
                                               aria-describedby="password-addon" required>
                                        <button class="btn btn-light " type="button" id="password-addon"><i
                                                class="mdi mdi-eye-outline"></i></button>
                                    </div>
                                </div>


                                <div class="mt-3 d-grid">
                                    <button class="btn btn-primary waves-effect waves-light"
                                            type="submit">Войти
                                    </button>
                                </div>

                                <div class="mt-4 text-center">
                                    <a href="https://t.me/erkinov8360" target="_blank" class="text-muted"><i
                                            class="mdi mdi-telegram me-1"></i> Отдел техподдержки</a>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="mt-5 text-center">

                    <div>
                        <p class="text-white">©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            <a class="text-white text-decoration-underline"
                               href="https://bizzone.uz" target="_blank">Bizzone.uz</a>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- end account-pages -->

<!-- JAVASCRIPT -->
<script src="{{ asset('assets/admin/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/admin/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('assets/admin/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/admin/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('assets/admin/libs/toastr/build/toastr.min.js') }}"></script>

<!-- App js -->
<script src="{{ asset('assets/admin/js/app.js') }}"></script>
<script>
    $(document).ready(function () {
        $("#ajax-login-form").submit(function (e) {
            e.preventDefault();
            var t = $(this), a = t.attr("action");
            $.ajax({
                type: "POST", url: a, data: t.serialize(), dataType: "json", success: function (e) {
                    e.success && (window.location.href = e.redirect)
                }, error: function (e) {
                    if ($("#username").val(""), $("#password").val(""), e.responseJSON.error) {
                        $("#username").val(""), $("#password").val(""), toastr.options = {
                            closeButton: !0,
                            debug: !1,
                            newestOnTop: !0,
                            progressBar: !0,
                            positionClass: "toast-bottom-right",
                            preventDuplicates: !1,
                            showDuration: 300,
                            hideDuration: 1e3,
                            timeOut: 5e3,
                            extendedTimeOut: 1e3,
                            showEasing: "swing",
                            hideEasing: "linear",
                            showMethod: "fadeIn",
                            hideMethod: "fadeOut"
                        };
                        Command:toastr.error("Пожалуйста попробуйте еще !", "Неверные данные !")
                    }
                }
            })
        })
    });
</script>
</body>

</html>
