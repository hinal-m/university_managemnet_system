<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('./assets/css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/css/radio.scss') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <title>Register</title>
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

        .send {
            position: absolute;
            /* display: block; */
            width: 200px;
            height: 50px;
            /* top: 50%; */
            left: 30%;
            /* margin: -35px 0 0 -100px; */
            background: #7e73cf;
            text-align: center;
            color: #fff;
            /* line-height: 70px;    */
            font-weight: 300;
            font-size: 20px;
            cursor: pointer;
            transition: all 0.25s ease-in-out;
        }

        .send input {
            position: relative;
            display: block;
            width: 100%;
            height: 100%;
            outline: none;
            border: 0;
            background: none;
            text-transform: uppercase;
            transition: all 0.25s ease-in-out;
        }

        .send.spin input {
            opacity: 0;
        }

        .send:before {
            position: absolute;
            display: block;
            content: "";
            width: 4px;
            height: 100%;
            right: 100%;
            top: -4px;
            bottom: -4px;
            padding-bottom: 8px;
            background: #fff;
            transition: all 1s ease-in-out;
        }

        .send:after {
            position: absolute;
            display: block;
            content: "";
            width: 4px;
            height: 100%;
            left: 100%;
            top: -4px;
            bottom: -4px;
            padding-bottom: 8px;
            background: #fff;
            transition: all 1s ease-in-out;
        }

        .send b:before {
            position: absolute;
            display: block;
            content: "";
            height: 4px;
            width: 100%;
            bottom: 100%;
            left: -4px;
            right: -4px;
            padding-right: 8px;
            background: #fff;
            transition: all 1s ease-in-out;
        }

        .send b:after {
            position: absolute;
            display: block;
            content: "";
            height: 4px;
            width: 100%;
            top: 100%;
            left: -4px;
            right: -4px;
            padding-right: 8px;
            background: #fff;
            transition: all 1s ease-in-out;
        }

        .send.spin:before {
            height: 20px;
            right: 50%;
            top: 50%;
            margin: -30px 0 0 -4px;
            padding: 0;
            transform-origin: 2px 30px;
        }

        .send.spin:after {
            height: 20px;
            left: 50%;
            top: 50%;
            margin: 10px 0 0 -4px;
            padding: 0;
            transform-origin: 2px -10px;
        }

        .send.spin b:before {
            width: 20px;
            bottom: 50%;
            left: 50%;
            right: 0;
            margin: 0 0 -2px -30px;
            padding: 0;
            transform-origin: 30px 2px;
        }

        .send.spin b:after {
            width: 20px;
            top: 50%;
            left: 50%;
            right: 0;
            margin: -2px 0 0 6px;
            padding: 0;
            transform-origin: -10px 2px;
        }

        .send.spin:before,
        .send.spin:after,
        .send.spin b:before,
        .send.spin b:after {
            animation: spinin 0.75s linear infinite 1s;
        }

        .send:active {
            transform: scale(0.9);
        }

        @keyframes spinin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center h-100vh align-items-center">
            <div class="col-md-6">
                <div class="card mt-4 mb-4">
                    <div class="card-body p-5">
                        <h1>STUDENT REGISTER</h1>
                        <div class="row" id="flashmessage">
                            <div class="col-12">
                                @include('notification')
                            </div>
                        </div>

                            <form action="{{ route('user.create') }}" id="register" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="login__field">
                                    <i class="login__icon fas fa-user"></i>
                                    <input type="text" class="login__input" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==15)" value="{{ old('name') }}" name="name" placeholder="User name">
                                    @error('name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <div class="login__field">
                                    <i class="login__icon fas fa-user"></i>
                                    <input type="text" class="login__input" value="{{ old('email') }}" name="email" placeholder="User email">
                                    @error('email')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <div class="login__field">
                                    <i class="login__icon fas fa-user"></i>
                                    <input type="text" class="login__input" value="{{ old('contact') }}" name="contact" placeholder="User mobile number">
                                    @error('contact')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <div class="form__group">
                                    <label class="d-block"><b>GENDER:</b></label>
                                    <div class="form__radio d-inline-block mr-2">
                                        <input type="radio" class="form__radio-input" id="male" value="m" name="gender">

                                        <label for="male">
                                            <span class="form__radio-button"></span>
                                            male
                                        </label>
                                    </div>
                                    <div class="form__radio d-inline-block mr-2">
                                        <input type="radio" class="form__radio-input" id="female" value="f" name="gender">


                                        <label for="female">
                                            <span class="form__radio-button"></span>
                                            female
                                        </label>
                                    </div>
                                    <div class="form__radio d-inline-block mr-2">
                                        <input type="radio" class="form__radio-input" value="o" id="other" name="gender">

                                        <label for="other">
                                            <span class="form__radio-button"></span>
                                            other
                                        </label>
                                    </div>
                                    @error('gender')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div><br>
                                <div class="form__group">
                                    <label><b>DOB:</b></label>
                                    <div class="form-group">
                                        <input type='tax' class="form-control datepicker" value="{{ old('dob') }}" name="dob" id="dob" placeholder='Select Date' style='width: 180px;' autocomplete="off">
                                        @error('dob')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="login__field">
                                    <i class="login__icon fas fa-user"></i>
                                    <input type="text" class="login__input" name="address" value="{{ old('address') }}" placeholder="User address">
                                    @error('address')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="login__field">
                                    <i class="login__icon fas fa-user"></i>
                                    <input type="text" class="login__input" value="{{ old('adhaar_no') }}" name="adhaar_no" onKeyPress="if(this.value.length==16) return false;" placeholder="User Adhar card no">
                                    @error('adhaar_no')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="login__field">
                                    <i class="login__icon fas fa-lock"></i>
                                    <input type="password" class="login__input" value="{{ old('password') }}" name="password" id="password" placeholder="Password">
                                    @error('password')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="login__field">
                                    <i class="login__icon fas fa-lock"></i>
                                    <input type="password" class="login__input" value="{{ old('confirm_password') }}" name="confirm_password" placeholder="Confirm Password">
                                    @error('confirm_password')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="login__field">
                                    <i class="login__icon fas fa-lock"></i>
                                    <input type="file" class="login__input" value="{{ old('image') }}" name="image">
                                    @error('image')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="send">
                                    <b></b>
                                    <input type="submit" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.0/jquery.validate.min.js"></script>
<script>
    $(function() {
        $("#dob").datepicker({
            maxDate: 0
        });
        $(".send").click(function() {
            $(this).toggleClass("spin");
        });
        setTimeout(function() {
            $("#flashmessage").fadeOut(3000);
        });
    });
    

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
                    noSpace: true

                },
                adhaar_no: {
                    required: true,
                    max: 16

                },
                dob: {
                    required: true,
                    noSpace: true

                },
                gender: {
                    required: true,

                },
                contact: {
                    required: true,
                    maxlength: 10,
                    digits: true
                },
                password: {
                    required: true,
                },
                confirm_password: {
                    required: true,
                    equalTo: "#password"
                },
                image: {
                    required: true
                }

            },
            messages: {
                'name': {
                    'required': 'Please Enter  Name'
                },
                'email': {
                    'required': 'Please Enter Email'
                },
                'contact': {
                    'required': 'Please Enter Mobile No'
                },
                'address': {
                    'required': 'Please Enter address'
                },
                'gender': {
                    'required': 'Please Select Gender'
                },
                'dob': {
                    'required': 'Please Select DOB'
                },
                'password': {
                    'required': 'Please Enter Password'
                },
                'confirm_password': {
                    'required': 'Please Confirm Password'
                },
                'image': {
                    'required': 'Please select image'
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

</html>