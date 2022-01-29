@extends('User.layouts.master')
@section('title', 'Admission')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="row">
        </div>
        <section id="basic-hidden-label-form-layouts">
            <div class="row match-height">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Addmission Form</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                @dd($round)
                                @if ($round)
                                    <form id="submit_form" action="{{ route('user.addmission.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <label for="basic-form-6">Please Enter Subject Marks</label><br>
                                        @foreach ($subjects as $subject)
                                            <input type="hidden" name="id[]" value="{{ $subject->id }}">
                                            <div class="col-auto">
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">{{ $subject->name }}</div>
                                                    </div>
                                                    <input type="text" class="form-control" min="0" max="100"
                                                        class="form-control" name="mark[]" placeholder="Marks"
                                                        value="{{ optional($subject->userStudentMark)->obtain_mark }}">
                                                </div><br>
                                            </div>
                                        @endforeach

                                        <div class="form-group">
                                            <label for="basic-form-6">Please Select College</label>

                                            <select id="college_id" name="college_id[]"
                                                class="js-example-basic-multiple form-control" multiple="multiple">
                                                <option value="0" selected disabled>Select College</option>
                                                @foreach ($addmission['college'] as $value)
                                                    <option value="{{ $value->id }}"
                                                        {{ isset($addmission['addmission']->college_id) ? (in_array($value->id, $addmission['addmission']->college_id) ? 'selected' : '') : '' }}>
                                                        {{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="basic-form-6">Please Select Course</label>
                                            <select id="course_id" name="course_id" class="form-control course">
                                                <option value="" selected disabled>Select Course</option>
                                                @foreach ($addmission['course'] as $value)
                                                    <option value="{{ $value->id }}"
                                                        {{ isset($addmission['addmission']->course_id) ? ($value->id == $addmission['addmission']->course_id ? 'selected' : '') : '' }}>
                                                        {{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <button type="submit" class="btn gradient-pomegranate big-shadow"><i
                                                class="ft-check-square mr-1"></i>Save</button>
                                        <a type="button" href="" class="btn gradient-mint shadow-z-4"><i
                                                class="ft-x mr-1"></i>Cancel</a>
                                    </form>
                                @else
                                    <h1>Admission Process Date Over </h1>

                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
    @push('js')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.0/jquery.validate.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $('.js-example-basic-multiple').select2({
                tags: true
            });

            $(".js-example-basic-multiple").on("select2:select", function(evt) {
                var element = evt.params.data.element;
                var $element = $(element);

                $element.detach();
                $(this).append($element);
                $(this).trigger("change");
            });
            var thing = $(".js-example-basic-multiple").select2({
                closeOnSelect: false
            }).on("change", function(e) {});




            $(document).ready(function() {
                $('#submit_form').validate({
                    rules: {
                        'mark[]': {
                            required: true,
                            digits: true
                        },
                        'college_id[]': {
                            required: true,
                        },
                        course_id: {
                            required: true,
                        },

                    },
                    messages: {
                        'mark[]': {
                            'required': 'Please Enter Marks'
                        },
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
                    text: "you want to Submit Admission",
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
                        });
                    } else {
                        swal("Cancelled", "Your record is safe :)", "error");
                    }
                });
            }
        </script>
    @endpush
