<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/jvectormap/jquery-jvectormap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/flag-icon-css/css/flag-icon.min.cs')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/owl-carousel-2/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/owl-carousel-2/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" />
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

        table#college-table {
            width: 100px !important;
        }
    </style>
</head>

<body>
    <div class="container-scroller">

        @include('University.layouts.sidebar')

        <div class="container-fluid page-body-wrapper">

            @include('University.layouts.navbar')

            <div class="main-panel">

                @yield('content')

                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
                            bootstrapdash.com 2022</span>
                         <a href="{{route('university.dashboard')}}" >University Panel</a></span>
                    </div>
                </footer>
                 
            </div>

        </div>

    </div>

    <script src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('assets/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('assets/vendors/progressbar.js/progressbar.min.js')}}"></script>
    <script src="{{asset('assets/vendors/jvectormap/jquery-jvectormap.min.js')}}"></script>
    <script src="{{asset('assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.j')}}"></script>
    <script src="{{asset('assets/vendors/owl-carousel-2/owl.carousel.min.js')}}"></script>
    <script src="{{asset('public/assets/js/app.js')}}"></script>

    <script src="{{asset('assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('assets/js/misc.js')}}"></script>
    <script src="{{asset('assets/js/settings.js')}}"></script>
    <script src="{{asset('assets/js/todolist.js')}}"></script>
    <script src="{{asset('assets/js/dashboard.js')}}"></script>
    @stack('js')
</body>

</html>
