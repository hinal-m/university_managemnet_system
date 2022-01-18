@extends('User.layouts.master')
@section('title', 'Student Marks')
@section('content')
    {{-- @dd($student_mark) --}}
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
                            <h4 class="card-title">Student Marks</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form id="submit_form" action="{{ route('user.marks.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @foreach ($subjects as $subject)
                                        <input type="hidden" name="id[]" value="{{ $subject->id }}">
                                        <div class="col-auto">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">{{ $subject->name }}</div>
                                                </div>
                                                <input type="text" class="form-control" min="0" max="100" class="form-control"
                                                     name="mark[]" placeholder="Marks"
                                                     value="{{ optional($subject->userStudentMark)->obtain_mark }}"
                                                     >
                                            </div><br>
                                        </div>
                                    @endforeach


                                    <button type="submit" class="btn btn-primary mr-2"><i
                                            class="ft-check-square mr-1"></i>Save</button>
                                    <a type="button" href="{{route('user.marks.index')}}" class="btn btn-secondary"><i
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
            $(".mark").keypress(function() {
                if(this.value.length==3)
                {
                    return false;
                }
            });
            $(document).ready(function() {
                $('#submit_form').validate({
                    rules: {
                        'mark[]': {
                            required: true,
                            digits: true
                        },

                    },
                    messages: {
                        'mark[]': {
                            'required': 'Please Enter Marks'
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
                    text: "you want to save the Marks",
                }).then((result) => {
                    if (result) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                    .attr('content')
                            },
                            type: 'POST',
                            url: "{{ route('user.marks.store') }}",
                            data: formData,
                            dataType: 'JSON',
                            contentType: false,
                            processData: false,
                            cache: false,
                            success: function(query) {
                                if (query) {
                                    swal("Inserted!",
                                        "Marks Save Successfully.",
                                        "success");
                                    window.location.href =
                                        "{{ route('user.marks.create') }}";
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
