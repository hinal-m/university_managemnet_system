@extends('University.layouts.master')
@section('title', 'College')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">University Change Password</h4>
                            <form class="forms-sample" id="submit_form" action="{{route('university.college.update',$college->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <input type="hidden" name="id" value="{{$college->id}}">
                                <div class="form-group">
                                    <label for="basicInput"> Name</label>
                                    <input type="text" class="form-control mb-2" name="name" value="{{ $college->name}}"
                                        placeholder="Name">
                                    @error('name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror


                                </div>
                                <div class="form-group">
                                    <label for="basicInput"> Email</label>
                                    <input type="email" class="form-control mb-2" name="email" value="{{ $college->email }}"
                                        placeholder="Email">
                                    @error('email')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="helperText"> Contact No</label>
                                    <input type="text" class="form-control mb-2" name="contact"
                                        value="{{ $college->contact_no }}" placeholder="Please Enter Contact No">
                                    @error('contact')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="helperText"> Address</label>
                                    <input type="text" class="form-control mb-2" name="address"
                                        value="{{ $college->address }}" placeholder="Please Enter Address">
                                    @error('address')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="helperText"> Logo</label>
                                    <input type="file" class="form-control mb-2" value="{{ old('logo') }}" name="logo">
                                    <img src={{ $college->logo }}
                                                        class="rounded user-profile-stories-image" style="width:100px"
                                                        alt="story-image-1">
                                    @error('logo')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" id="submit" class="btn btn-primary btn-icon-text">
                                        <i class="mdi mdi-file-check btn-icon-prepend" id="submit"></i> Update</button>
                                    <a href="{{route('university.college.index')}}" class="btn btn-dark">Go Back!</a>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
      $(document).ready(function() {
                $('#submit_form').validate({
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
                            'required': 'Please Enter Mobile No'
                        },
                        'password': {
                            'required': 'Please Enter Password'
                        },
                        'cpassword': {
                            'required': 'Please Confirm Password'
                        },
                        'logo':{
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


            function register(form) {
                $('.text-strong').html('');
                var form = $('#submit_form');
                var formData = new FormData(form[0]);
                swal({
                    title: "Are you sure?",
                    text: "you want to update College",
                }).then((result) => {
                    if (result) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                    .attr('content')
                            },
                            type: 'POST',
                            url: "{{ route('university.college.update',$college->id) }}",
                            data: formData,
                            dataType: 'JSON',
                            contentType: false,
                            processData: false,
                            cache: false,
                            success: function(query) {
                                if (query) {
                                    swal("Updated!",
                                        "College Updated Successfully.",
                                        "success");
                                    window.location.href =
                                        "{{ route('university.college.index') }}";
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
