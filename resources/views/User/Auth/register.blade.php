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
</head>

<body>
    <div class="container">
        <div class="row justify-content-center h-100vh align-items-center">
            <div class="col-md-6">
                <div class="card mt-4 mb-4">
                    <div class="card-body p-5">
                        <h1>STUDENT REGISTER</h1>

                        <form action="{{ route('user.create') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="login__field">
                                <i class="login__icon fas fa-user"></i>
                                <input type="text" class="login__input" name="name" placeholder="User name">
                            </div>
                            <div class="login__field">
                                <i class="login__icon fas fa-user"></i>
                                <input type="text" class="login__input" name="email" placeholder="User email">
                            </div>
                            <div class="login__field">
                                <i class="login__icon fas fa-user"></i>
                                <input type="text" class="login__input" name="contact"
                                    placeholder="User mobile number">
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
                                    <input type="radio" class="form__radio-input" id="other" name="o">
                                    <label for="other">
                                        <span class="form__radio-button"></span>
                                        other
                                    </label>
                                </div>
                            </div><br>
                            <div class="form__group">
                                <label><b>DOB:</b></label>
                                <div class="form-group">
                                    <input type='tax' class="form-control datepicker" name="dob" id="dob"
                                        placeholder='Select Date' style='width: 180px;'>
                                </div>
                            </div>

                            <div class="login__field">
                                <i class="login__icon fas fa-user"></i>
                                <input type="text" class="login__input" name="address" placeholder="User address">
                            </div>
                            <div class="login__field">
                                <i class="login__icon fas fa-user"></i>
                                <input type="text" class="login__input" name="adhaar_no"
                                    placeholder="User Adhar card no">
                            </div>
                            <div class="login__field">
                                <i class="login__icon fas fa-lock"></i>
                                <input type="password" class="login__input" name="password" placeholder="Password">
                            </div>
                            <div class="login__field">
                                <i class="login__icon fas fa-lock"></i>
                                <input type="password" class="login__input" name="confirm_password"
                                    placeholder="XConfirm Password">
                            </div>
                            <div class="login__field">
                                <i class="login__icon fas fa-lock"></i>
                                <input type="file" class="login__input" name="image">
                            </div>
                            <button class="button login__submit">
                                <span class="button__text">Register</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/lean-modal@1.0.7/jquery.leanModal.min.js"></script> --}}
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script>
    $(function() {
        $("#dob").datepicker();
    });
</script>

</html>
