@extends('User.layouts.master')
@section('title', 'Courses')

@section('content')
{{-- @dd($addmission) --}}
{{-- @dd($addmission['college']); --}}
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="row">
        </div>
        <!-- Basic Inputs start -->
        <section id="basic-hidden-label-form-layouts">
            <div class="row match-height">
                <!-- Basic Form starts -->
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Addmission Form</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form id="submit_form" action="{{ route('user.addmission.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group mb-2">
                                        <label for="basic-form-6">Collge</label>

                                        <select id="college_id" name="college_id[]" class="form-control" multiple>
                                            <option value="" selected disabled>Select College</option>
                                            @foreach ($addmission['college'] as $value)
                                                <option value="{{ $value->id }}" {{ (isset($addmission['addmission']->college_id) ? (in_array($value->id, explode(',', $addmission['addmission']->college_id)) ? 'selected' : '') : '') }}>{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="basic-form-6">Merit Round</label>
                                        <select id="merit_round_id" name="merit_round_id" class="form-control course">
                                            <option value="" selected disabled>Select Course</option>
                                            @foreach ($addmission['merit_round'] as $value)
                                                <option value="{{ $value->id }}" {{ isset($addmission['addmission']->merit_round_id) ? (($value->id == $addmission['addmission']->merit_round_id) ? 'selected' : '') : '' }}>{{ $value->round_no }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="basic-form-6">Course</label>
                                        <select id="course_id" name="course_id" class="form-control course">
                                            <option value="" selected disabled>Select Course</option>
                                            @foreach ($addmission['course'] as $value)
                                                <option value="{{ $value->id }}" {{ isset($addmission['addmission']->course_id) ? (($value->id == $addmission['addmission']->course_id) ? 'selected' : '') : '' }}>{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary mr-2"><i
                                            class="ft-check-square mr-1"></i>Save</button>
                                    <a type="button" href="" class="btn btn-secondary"><i
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
                        // course_id: {
                        //     required: true,
                        // },
                        // reserved_seat: {
                        //     required: true,
                        //     digits: true
                        // },
                        // merit_seat: {
                        //     required: true,
                        //     digits: true
                        // },

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
                    text: "you want to Insert Course",
                }).then((result) => {
                    if (result) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                    .attr('content')
                            },
                            type: 'POST',
                            url: "{{ route('user.addmission.store') }}",
                            data: formData,
                            dataType: 'JSON',
                            contentType: false,
                            processData: false,
                            cache: false,
                            success: function(query) {
                                if (query) {
                                    swal("Inserted!",
                                        "Course Inserted Successfully.",
                                        "success");
                                    window.location.href =
                                        "{{ route('user.addmission.create') }}";
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
