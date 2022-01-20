<!DOCTYPE html>
<html class="loading" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description"
        content="Apex admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Apex admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>College Register</title>
    <link rel="shortcut icon" type="image/x-icon" href="../app-assets/img/ico/favicon.ico">
    <link rel="shortcut icon" type="image/png" href="../app-assets/img/ico/favicon-32.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link
        href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900%7CMontserrat:300,400,500,600,700,800,900"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/app-assets/fonts/feather/style.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('saller-assets/app-assets/fonts/simple-line-icons/style.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('saller-assets/app-assets/fonts/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('saller-assets/app-assets/vendors/css/perfect-scrollbar.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/app-assets/vendors/css/prism.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('saller-assets/app-assets/vendors/css/switchery.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('saller-assets/app-assets/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/app-assets/css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/app-assets/css/components.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('saller-assets/app-assets/css/themes/layout-dark.min.css') }}">
    <link rel="stylesheet" href="{{ asset('saller-assets/app-assets/css/plugins/switchery.min.css') }}">
    <link rel="stylesheet" href="{{ asset('saller-assets/app-assets/css/pages/authentication.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('saller-assets/assets/css/style.css') }}">
    <style>

        .error {
            color: red;
        }

        .errorMsg {
            border: 1px solid red;
        }

        .is-invalid {
            border: red 3px solid !important;
        }

        .validation {
            color: red;
        }
    </style>
</head>

<body class="vertical-layout vertical-menu 1-column auth-page navbar-sticky blank-page" data-menu="vertical-menu"
    data-col="1-column">
    <div class="wrapper">
        <div class="main-panel">
            <!-- BEGIN : Main Content-->
            <div class="main-content">
                <div class="content-overlay"></div>
                <div class="content-wrapper">
                    <!--Registration Page Starts-->
                    <section id="regestration" class="auth-height">
                        <div class="row full-height-vh m-0">
                            <div class="col-12 d-flex align-items-center justify-content-center">
                                <div class="card overflow-hidden">
                                    <div class="card-content">
                                        <div class="card-body auth-img">
                                            <div class="row m-0">
                                                <div
                                                    class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center text-center auth-img-bg py-2">
                                                    <img src="{{ asset('saller-assets/app-assets/img/gallery/register.png') }}"
                                                        alt="" class="img-fluid" width="350" height="230">
                                                </div>
                                                <div class="col-lg-6 col-md-12 px-4 py-3">
                                                    <form action="{{ route('college.college.create') }}"
                                                        method="post" id="register" enctype="multipart/form-data">
                                                        @csrf
                                                        @if (Session::get('success'))
                                                            <div class="alert alert-success">
                                                                {{ Session::get('success') }}
                                                            </div>
                                                        @endif
                                                        @if (Session::get('fail'))
                                                            <div class="alert alert-success">
                                                                {{ Session::get('fail') }}
                                                            </div>
                                                        @endif

                                                        <h4 class="card-title mb-2">College Register</h4>
                                                        <p>Fill the below form to create a new account.</p>
                                                        <input type="text" class="form-control mb-2" name="name"
                                                        value="{{old('name')}}" placeholder="Name">
                                                            @error('name')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror

                                                        <input type="email" class="form-control mb-2" name="email"
                                                        value="{{old('email')}}" placeholder="Email">
                                                            @error('email')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror

                                                        <input type="text" class="form-control mb-2" name="contact"
                                                        value="{{old('contact')}}" placeholder="Please Enter Contact No">
                                                            @error('contact')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror

                                                        <input type="text" class="form-control mb-2" name="address"
                                                        value="{{old('address')}}" placeholder="Please Enter Address">
                                                            @error('address')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror

                                                        <input type="file" class="form-control mb-2" value="{{old('logo')}}" name="logo">
                                                        @error('logo')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                        <input type="password" name="password" class="form-control mb-2"
                                                        value="{{old('password')}}" id="password" placeholder="Password">
                                                            @error('password')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror


                                                        <input type="password" name="cpassword" class="form-control mb-2"
                                                        value="{{old('cpassword')}}" placeholder="Confirm Password">
                                                            @error('cpassword')
                                                            <span class="text-danger" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror

                                                        <div class="checkbox auth-checkbox font-small-2 mb-3">


                                                        </div>
                                                        <div
                                                            class="d-flex justify-content-between flex-sm-row flex-column">
                                                            <a href="{{route('college.college.login')}}"
                                                                class="btn bg-light-primary mb-2 mb-sm-0">Back To
                                                                Login</a>
                                                            <button type="submit"
                                                                class="btn btn-primary">Register</button>
                                                        </div>
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
    <script src="{{ asset('saller-assets/app-assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('saller-assets/app-assets/vendors/js/switchery.min.js') }}"></script>
    <script src="{{ asset('saller-assets/app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('saller-assets/app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset('saller-assets/app-assets/js/notification-sidebar.min.js') }}"></script>
    <script src="{{ asset('saller-assets/app-assets/js/customizer.min.js') }}"></script>
    <script src="{{ asset('saller-assets/app-assets/js/scroll-top.min.js') }}"></script>
    <script src="{{ asset('saller-assets/assets/js/scripts.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.0/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#register').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true

                    },
                    address: {
                        required: true,

                    },
                    contact: {
                        required: true,
                        required: true,
                        maxlength: 10,
                        digits: true

                    },
                    logo: {
                        required: true,

                    },
                    password: {
                        required: true,
                    },
                    cpassword: {
                        required: true,
                        equalTo: "#password"
                    },

                },
                messages: {
                    'name': {
                        'required': 'Please Enter  Name'
                    },
                    'email': {
                        'required': 'Please Enter Email'
                    },
                    'contact': {
                        'required': 'Please Enter contact No'
                    },
                    'address': {
                        'required': 'Please Enter address'
                    },
                    'password': {
                        'required': 'Please Enter Password'
                    },
                    'cpassword': {
                        'required': 'Please Confirm Password'
                    },
                    'logo': {
                        'required': 'Please select logo'
                    }
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                },
                submitHandler: function(form) {
                    register(form);
                }

            });
        });
    </script>
</body>
</html>
