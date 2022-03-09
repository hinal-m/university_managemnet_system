<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University-Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('../css/login_1.css')}}" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" , rel="stylesheet" , integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" , crossorigin="anonymous">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-key">
                    <i class="fa fa-key" aria-hidden="true"></i>
                </div>
                <div class="col-lg-12 login-title">
                    UNIVERSITY LOGIN
                </div>

                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form action="{{route('university.university.check')}}" method="post">
                            @csrf
                            @if(Session::get('fail'))
                            <div class="alert alert-danger">
                                {{Session::get('fail')}}
                            </div>
                            @endif
                            <div class="form-group">
                                <label class="form-control-label" style="font-size:15px">EMAIL</label>
                                <input type="text" name="email" value="{{old('email')}}" class="form-control">
                                @error('email')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" style="font-size:15px">PASSWORD</label>
                                <input type="password" name="password" value="{{old('password')}}" class="form-control" i>
                                @error('password')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <!-- <div class="captcha">
                                    <span>{!! captcha_img() !!}</span>
                                    <button type="button" class="btn btn-success"><i class="fa fa-refresh" id="refresh"></i></button>
                                </div> -->
                                <div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
                                @if($errors->has('g-recaptcha-response'))

                                <span class="invalid-feedback" style="display:block">
                                    <strong>{{$errors->first('g-recaptcha-response')}}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- <div class="form-group">
                                <input type="password" name="captcha" placeholder="Enter Captcha" value="{{old('password')}}" class="form-control" i>
                                @error('captcha')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div> -->


                            <div class="col-lg-12 loginbttm">
                                <div class="col-lg-6 login-btm login-text">
                                    <!-- Error Message -->
                                </div>
                                <div class="col-lg-6 login-btm login-button">
                                    <button type="submit" class="btn btn-outline-primary">LOGIN</button>
                                    <div class="flex items-center justify-end mt-4">
                                        <a href="{{ route('university.redirectToGoogle') }}">
                                            <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" style="margin-left: 3em;">
                                        </a>
                                    </div>
                                    <div class="flex items-center justify-end mt-4">
                                        <a href="{{ route('university.redirectToFacebook') }}" class="fa fa-facebook-square btn btn-lg btn-primary btn-block">
                                            <strong>Login With Facebook</strong>
                                        </a>
                                    </div>
                                    <div class="flex items-center justify-end mt-4">
                                        <a class="btn" href="{{ route('university.loginwithTwitter') }}" style="background: #1E9DEA; padding: 10px; width: 100%; text-align: center; display: block; border-radius:4px; color: #ffffff;">
                                            Login with Twitter
                                        </a>
                                    </div>
                                    <div class="flex items-center justify-end mt-4">
                                        <a class="btn" href="{{ route('university.gitRedirect') }}" style="background: #313131; color: #ffffff; padding: 10px; width: 100%; text-align: center; display: block; border-radius:3px;">
                                            Login with GitHub
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript">
        $('#refresh').click(function() {
            $.ajax({
                type: 'GET',
                url: "{{route('university.refreshcaptcha')}}",
                success: function(data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });
    </script>
</body>

</html>