@extends('User.layouts.master')
@section('title', 'Admission')
@section('content')
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
                                @if($round)
                                <form id="submit_form" action="{{ route('user.addmission.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group mb-2">
                                        <label for="basic-form-6">College</label>

                                        <select id="college_id" name="college_id[]" class="form-control" multiple>
                                            <option value="" selected disabled>Select College</option>
                                            @foreach ($addmission['college'] as $value)
                                                <option value="{{ $value->id }}" {{ (isset($addmission['addmission']->college_id) ? (in_array($value->id, $addmission['addmission']->college_id) ? 'selected' : '') : '') }}>{{ $value->name }}</option>
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
                                @else
                                <h1>Admission Process Date Over </h1>

                                @endif
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
                        'college_id[]': {
                            required: true,
                        },
                        course_id: {
                            required: true,
                        },

                    },
                    messages: {
                        'college_id[]': {
                            'required': 'Please Select College'
                        },
                        'merit_round_id': {
                            'required': 'Please Select Merit Round'
                        },
                        'course_id': {
                            'required': 'Please Select Course'
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
                                    swal(
                                        "Admission Saved Successfully.",
                                        "success");
                                    window.location.href =
                                        "{{ route('user.addmission.create') }}";
                                }
                            },
                            // error: function(data) {
                            //     $.each(data.responseJSON.errors, function(
                            //         key, value) {
                            //         $('[name=' + key + ']').after(
                            //             '<span class="text-strong" style="color:red">' +
                            //             value + '</span>')
                            //     });
                            // }
                        });
                    } else {
                        swal("Cancelled", "Your record is safe :)", "error");
                    }
                });
            }
        </script>
    @endpush
