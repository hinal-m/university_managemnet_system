@extends('User.layouts.master')
@section('title', 'Profile')
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <div class="content-wrapper">
        <section class="users-edit">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <!-- Nav-tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a href="#account" role="tab" id="account-tab"
                                            class="nav-link d-flex align-items-center active" data-toggle="tab"
                                            aria-controls="account" aria-selected="true">
                                            <i class="ft-user mr-1"></i>
                                            <span class="d-none d-sm-block">Account</span>
                                        </a>
                                    </li>
                                </ul>
                                <form action="{{ route('user.edit_profile') }}" id="profile_change" mehtod="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="tab-content">
                                        <!-- Account content starts -->
                                        <div class="tab-pane fade mt-2 show active" id="account" role="tabpanel"
                                            aria-labelledby="account-tab">
                                            <!-- Media object starts -->
                                            <div class="media">
                                                <img src="{{ $user->image }}" alt="user edit avatar"
                                                    class="users-avatar-shadow avatar mr-3 rounded-circle" height="90"
                                                    width="90">
                                                <div class="media-body">
                                                    <h4>Avatar</h4>
                                                    <div
                                                        class="d-flex flex-sm-row flex-column justify-content-start px-0 mb-sm-2">
                                                        <input type="file" name="image">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Media object ends -->

                                            <!-- Account form starts -->

                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="users-edit-username">Name</label>
                                                            <input type="text" name="name" class="form-control"
                                                                placeholder="Username" value="{{ $user->name }}" required
                                                                aria-invalid="false">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="users-edit-name">Email</label>
                                                            <input type="email" name="email" class="form-control"
                                                                placeholder="Name" value="{{ $user->email }}" required
                                                                aria-invalid="false">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="users-edit-email">Contact No</label>
                                                            <input type="text" name="contact" class="form-control"
                                                                placeholder="Email" value="{{ $user->contact_no }}"
                                                                required aria-invalid="false">
                                                        </div>
                                                    </div>
                                                    <div class="form__group">
                                                        <label><b>GENDER:</b></label>
                                                        <div class="form__radio">
                                                            <input type="radio" class="form__radio-input" id="male"
                                                                value="m" name="gender"
                                                                {{ $user->gender == 'M' ? 'checked' : '' }}>
                                                            <label for="male">
                                                                <span class="form__radio-button"></span>
                                                                male
                                                            </label>
                                                        </div>
                                                        <div class="form__radio">
                                                            <input type="radio" class="form__radio-input" id="female"
                                                                value="f" name="gender"
                                                                {{ $user->gender == 'F' ? 'checked' : '' }}>
                                                            <label for="female">
                                                                <span class="form__radio-button"></span>
                                                                female
                                                            </label>
                                                        </div>
                                                        <div class="form__radio">
                                                            <input type="radio" class="form__radio-input" id="other"
                                                                name="o" {{ $user->gender == 'O' ? 'checked' : '' }}>
                                                            <label for="other">
                                                                <span class="form__radio-button"></span>
                                                                other
                                                            </label>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="users-edit-email">Address</label>
                                                            <input type="text" id="users-edit-email" class="form-control"
                                                                placeholder="Email" value="{{ $user->address }}"
                                                                name="address" aria-invalid="false">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="users-edit-email">Adhar card No</label>
                                                            <input type="text" id="users-edit-email" class="form-control"
                                                                placeholder="Email" value="{{ $user->adhaar_card_no }}"
                                                                name="adhaar_no" aria-invalid="false">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="users-edit-company">DOB</label>
                                                            <input type='tax' class="form-control datepicker" name="dob"
                                                                id="dob" value="{{ $user->dob }}"
                                                                placeholder='Select Date'>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div
                                                    class="col-12 d-flex justify-content-end flex-sm-row flex-column mt-3 mt-sm-0">
                                                    <button type="submit" class="btn btn-primary mb-2 mb-sm-0 mr-sm-2">Save
                                                        Changes</button>
                                                    <button type="reset" class="btn btn-secondary">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- Information form ends -->
                            </div>
                            <!-- Information content ends -->
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
    </section>
    </div>
@endsection
@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script>
        $(function() {
            $("#dob").datepicker();
        });
        $(document).ready(function() {
            $('#profile_change').validate({
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
                        maxlength: 10,
                        digits: true
                    },
                    dob:{
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
                    'password': {
                        'required': 'Please Enter Password'
                    },
                    'cpassword': {
                        'required': 'Please Confirm Password'
                    },
                    'dob':{
                        'required': 'Please select DOb'
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


        function register(form) {
            $('.text-strong').html('');
            var form = $('#profile_change');
            var formData = new FormData(form[0]);
            swal({
                title: "Are you sure?",
                text: "you want to update Profile",
            }).then((result) => {
                if (result) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                .attr('content')
                        },
                        type: 'POST',
                        url: "{{ route('user.edit_profile') }}",
                        data: formData,
                        dataType: 'JSON',
                        contentType: false,
                        processData: false,
                        cache: false,
                        success: function(query) {
                            if (query) {
                                swal("Updated!",
                                    "Profile Updated Successfully.",
                                    "success");
                                window.location.href =
                                    "{{ route('user.dashboard') }}";
                            }
                        },
                        error: function(data) {
                            $.each(data.responseJSON.errors, function(
                                key, value) {
                                $('[name=' + key + ']').after(
                                    '<span class="text-strong" style="color:red">' +
                                    value + '</span>')
                            });
                        }
                    });
                } else {
                    swal("Cancelled", "Your record is safe :)", "error");
                }
            });
        }
    </script>
@endpush
