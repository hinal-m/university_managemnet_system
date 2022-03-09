<!DOCTYPE html>
<html class="loading" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Apex admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Apex admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>College Login</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('saller-assets/app-assets/img/ico/favicon.ico') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('saller-assets/app-assets/img/ico/favicon-32.png') }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900%7CMontserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/app-assets/fonts/feather/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/app-assets/fonts/simple-line-icons/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/app-assets/fonts/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/app-assets/vendors/css/perfect-scrollbar.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/app-assets/vendors/css/prism.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/app-assets/vendors/css/switchery.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/app-assets/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/app-assets/css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/app-assets/css/components.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/app-assets/css/themes/layout-dark.min.css') }}">
    <link rel="stylesheet" href="{{ asset('saller-assets/app-assets/css/plugins/switchery.min.css') }}">
    <link rel="stylesheet" href="{{ asset('saller-assets/app-assets/css/pages/authentication.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/assets/css/style.css') }}">
</head>

<body class="vertical-layout vertical-menu 1-column auth-page navbar-sticky blank-page" data-menu="vertical-menu" data-col="1-column">
    <div class="wrapper">
        <div class="main-panel">
            <!-- BEGIN : Main Content-->
            <div class="main-content">
                <div class="content-overlay"></div>
                <div class="content-wrapper">
                    <!--Login Page Starts-->
                    <section id="login" class="auth-height">
                        <div class="row full-height-vh m-0">
                            <div class="col-12 d-flex align-items-center justify-content-center">
                                <div class="card overflow-hidden">
                                    <div class="card-content">
                                        <div class="card-body auth-img">
                                            <div class="row m-0">
                                                <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center auth-img-bg p-3">
                                                    <img src="{{ asset('saller-assets/app-assets/img/gallery/login.png') }}" alt="" class="img-fluid" width="300" height="230">
                                                </div>
                                                <div class="col-lg-6 col-12 px-4 py-3">
                                                    <form action="{{ route('college.college.check') }}" method="post">
                                                        @csrf
                                                        @if (Session::get('fail'))
                                                        <div class="alert alert-danger">
                                                            {{ Session::get('fail') }}
                                                        </div>
                                                        @endif
                                                        <h4 class="mb-2 card-title">College Login</h4>
                                                        <p>Welcome back, please login to your account.</p>
                                                        <input type="text" name="email" value="{{ old('email') }}" class="form-control mb-3" placeholder="College Name">
                                                        @error('email')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                        <input type="password" name="password" value="{{ old('password') }}" class="form-control mb-2" placeholder="Password">
                                                        @error('password')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                        <div class="d-sm-flex justify-content-between mb-3 font-small-2">
                                                            <div class="remember-me mb-2 mb-sm-0">
                                                                <div class="checkbox auth-checkbox">
                                                                    <input type="checkbox" id="auth-ligin">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-between flex-sm-row flex-column">
                                                            <a href="{{ route('college.college.register') }}" class="btn bg-light-primary mb-2 mb-sm-0">Register</a>
                                                            <button type="submit" class="btn btn-primary">Login</button>
                                                        </div>
                                                        <div class="flex items-center justify-end mt-4">
                                                            <a href="{{ route('college.redirectToGoogle') }}">
                                                                <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" style="margin-left: 3em;">
                                                            </a>
                                                        </div>
                                                        <hr>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('saller-assets/app-assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('saller-assets/app-assets/vendors/js/switchery.min.js') }}"></script>
    <script src="{{ asset('saller-assets/app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('saller-assets/app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset('saller-assets/app-assets/js/notification-sidebar.min.js') }}"></script>
    <script src="{{ asset('saller-assets/app-assets/js/customizer.min.js') }}"></script>
    <script src="{{ asset('saller-assets/app-assets/js/scroll-top.min.js') }}"></script>
    <script src="{{ asset('saller-assets/assets/js/scripts.js') }}"></script>
</body>

</html>