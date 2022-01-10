@extends('University.layouts.master')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">University Change Password</h4>
                            <form class="forms-sample" id="changePassword" action="" method="post">
                                @csrf
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if ($errors)
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger">{{ $error }}</div>
                                    @endforeach
                                @endif

                                <div class="form-group">
                                    <label for="basicInput">Corrent Password</label>
                                    <input type="password" class="form-control" name="current-password"
                                        value="{{ old('current-password') }}" placeholder="Enter Your Corrent Password">

                                </div>
                                <div class="form-group">
                                    <label for="helpInputTop">New Password</label>
                                    <input type="password" class="form-control" name="new-password" id="new-password"
                                        placeholder="Enter Your New Password">

                                </div>
                                <div class="form-group">
                                    <label for="helperText">Confirm Password</label>
                                    <input type="password" name="confirm_password" id="confirm_password"
                                        class="form-control" placeholder="Enter Your Confirm Password">
                                </div>
                                <div class="form-group">
                                <button type="submit" id="submit" class="btn btn-primary btn-icon-text">
                                    <i class="mdi mdi-file-check btn-icon-prepend" id="submit"></i> Change
                                    password </button>
                                <a href="" class="btn btn-dark">Go Back!</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.0/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#changePassword').validate({
                rules: {
                    'current-password': {
                        required: true,
                    },
                    'new-password': {
                        required: true,
                    },
                    confirm_password: {
                        required: true,
                        equalTo: "#new-password"
                    }

                },
                messages: {
                    //  errorElement: 'span',
                    'current-password': {
                        required: 'Please Enter Your Current Password.'
                    },
                    'new-password': {
                        required: 'Please Enter New Password.',
                        minlength: 'Please Enter at least 8 characters.'
                    },
                    'confirm_password': {
                        required: 'Please Enter Confirmation.',
                        equalTo: 'Please Enter Confirm Password Same as a Password.'
                    },
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                    $(element).parents("div.form-control").addClass(errorClass).removeClass(validClass);
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                    $(element).parents(".error").removeClass(errorClass).addClass(validClass);
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element.parent());
                },
            });
        });
    </script>
@endpush
