@extends('College.layouts.master')
@section('title', 'Courses')
@section('content')

    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">

            </div>
        </div>
        <!-- Basic Inputs start -->
        <section id="basic-hidden-label-form-layouts">
            <div class="row match-height">
                <!-- Basic Form starts -->
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">College Course Add</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form id="submit_form" action="{{ route('college.course.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group mb-2">
                                        <label for="basic-form-6">Courses</label>
                                        <select id="course_id" name="course_id" class="form-control">
                                            <option value="" selected disabled>Select Course</option>
                                            @foreach ($college_course as $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="reserved_seat">Reserved Seat</label>
                                        <input type="text" id="reserved_seat" class="form-control"
                                            data-validation-required-message="This First Name field is required"
                                            name="reserved_seat">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="seat_no">Merit Seat</label>
                                        <input type="text" id="merit_seat" class="form-control"
                                            data-validation-required-message="This First Name field is required"
                                            name="merit_seat">
                                    </div>


                                    <button type="submit" class="btn gradient-pomegranate big-shadow"><i
                                            class="ft-check-square mr-1"></i>Save</button>
                                    <a type="button" href="" class="btn gradient-mint shadow-z-4"><i
                                            class="ft-x mr-1"></i>Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Hidden Label ends -->
            </div>
        </section>
        <!-- Basic Inputs end -->
    @endsection
    @push('js')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.0/jquery.validate.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#submit_form').validate({
                    rules: {
                        course_id: {
                            required: true,
                        },
                        reserved_seat: {
                            required: true,
                            digits: true
                        },
                        merit_seat: {
                            required: true,
                            digits: true
                        },

                    },
                    messages: {
                        'course_id': {
                            'required': 'Please Select Course'
                        },
                        'reserved_seat': {
                            'required': 'Please Enter Reserved seat'
                        },
                        'merit_seat': {
                            'required': 'Please Enter Merit Seat'
                        },
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
                    text: "you want to Insert College Course",
                }).then((result) => {
                    if (result) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                    .attr('content')
                            },
                            type: 'POST',
                            url: "{{ route('college.course.store') }}",
                            data: formData,
                            dataType: 'JSON',
                            contentType: false,
                            processData: false,
                            cache: false,
                            success: function(query) {
                                if (query.status === 2) {
                                    swal("Inserted!",
                                        "College Course Inserted Successfully.",
                                        "success");
                                    window.location.href =
                                        "{{ route('college.course.index') }}";
                                }else if(query.status === 1){
                                    swal("danger!",
                                        "You Hvae Already Inserted This Course.",'error'
                                       );
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
