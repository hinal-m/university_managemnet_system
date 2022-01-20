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
                                <form id="submit_form" action="{{ route('college.course.update', $college_course->id) }}"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="id" value="{{ $college_course->id }}">
                                    <div class="form-group mb-2">
                                        <label for="basic-form-6">Courses</label>
                                        <select id="course_id" name="course_id" class="form-control">
                                            <option value="" selected disabled>Select Course</option>
                                            @foreach ($course as $value)
                                                <option value="{{ $value->id }}"
                                                    {{$value->id==$college_course->course_id ?'selected' :''}}>
                                                    {{ $value->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="reserved_seat">Reserved Seat</label>
                                        <input type="text" id="reserved_seat" class="form-control"
                                            data-validation-required-message="This First Name field is required"
                                            name="reserved_seat" value="{{ $college_course->reserved_seat }}">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="merit_seat">Meriet Seat</label>
                                        <input type="text" id="merit_seat" class="form-control"
                                            value="{{ $college_course->merit_seat }}" name="merit_seat">
                                    </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2"><i
                                    class="ft-check-square mr-1"></i>Save</button>
                            <a type="button" href="{{route('college.course.index')}}" class="btn btn-secondary"><i class="ft-x mr-1"></i>Cancel</a>
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
                        url: "{{ route('college.course.update', $college_course->id) }}",
                        data: formData,
                        dataType: 'JSON',
                        contentType: false,
                        processData: false,
                        cache: false,
                        success: function(query) {
                            if (query) {
                                swal("Updated!",
                                    "College Course Updated Successfully.",
                                    "success");
                                window.location.href =
                                    "{{ route('college.course.index') }}";
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
