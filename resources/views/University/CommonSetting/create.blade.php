@extends('University.layouts.master')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">University Setting</h4>
                            <form class="forms-sample" id="submit_form" action="{{route('university.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Select Subject</label>
                                    <select class="form-control" id="subject" name="subject">
                                        <option value="0">Select Subject</option>
                                        @foreach ($subject as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="helperText">Marks (%)</label>
                                    <input type="text" class="form-control mb-2" name="marks"
                                         placeholder="Please Enter Contact No">
                                    @error('marks')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" id="submit" class="btn btn-primary btn-icon-text">
                                        <i class="mdi mdi-file-check btn-icon-prepend" id="submit"></i> Update</button>
                                    <a href="{{route('university.index')}}" class="btn btn-dark">Go Back!</a>
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
                    text: "you want to insert Data",
                }).then((result) => {
                    if (result) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                    .attr('content')
                            },
                            type: 'POST',
                            url: "{{ route('university.store') }}",
                            data: formData,
                            dataType: 'JSON',
                            contentType: false,
                            processData: false,
                            cache: false,
                            success: function(query) {
                                if (query) {
                                    swal("Inserted!",
                                        "data Inserted Successfully.",
                                        "success");
                                    window.location.href =
                                        "{{ route('university.index') }}";
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
