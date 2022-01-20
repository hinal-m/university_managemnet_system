@extends('College.layouts.master')
@section('title', 'College Merit')
@section('content')
    {{-- @dd($college_merit['merit_round']) --}}
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="content-header">Inputs</div>
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
                                <form id="submit_form" action="{{ route('college.merit.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group mb-2">
                                        <label for="basic-form-6">Courses</label>
                                        <select id="course_id" name="course_id" class="form-control course">
                                            <option value="" selected disabled>Select Course</option>
                                            @foreach ($college_merit['college_course'] as $value)
                                                <option value="{{ $value->Course->id }}">{{ $value->Course->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="form-group mb-2 " >
                                        <label for="reserved_seat">Select Round</label>
                                                  <select name="round_no" id="round_no" class="form-control round">
                                                      <option value="">Select round</option>
                                                  </select>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="seat_no">Merit</label>
                                        <input type="text" id="merit" class="form-control"
                                            data-validation-required-message="This First Name field is required"
                                            name="merit">
                                    </div>


                                    <button type="submit" class="btn btn-primary mr-2"><i
                                            class="ft-check-square mr-1"></i>Save</button>
                                    <a type="button" href="{{route('college.merit.index')}}" class="btn btn-secondary"><i
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
            $(document).on('change', '.course', function() {
                var id = $(this).val();
                alert(id);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                            .attr('content')
                    },
                    type: 'POST',
                    url: "{{ route('college.round') }}",
                    data: {
                        'id': id
                    },
                    success: function(data) {
                        console.log(data);
                        var htm='';
                        htm+='<option >Select Round</option>';
                        $.each(data.data,function(key,val){
                            htm+='<option value='+val['round_no']+'>Round No: '+val['round_no']+'</option>'
                        })
                        $('.round').html(htm);
                    }
                });
            });
            $(document).ready(function() {
                $('#submit_form').validate({
                    rules: {
                        course_id: {
                            required: true,
                        },
                        round_no: {
                            required: true,
                        },
                        merit: {
                            required: true,
                            digits: true
                        },

                    },
                    messages: {
                        'course_id': {
                            'required': 'Please Select Course'
                        },
                        'round_no': {
                            'required': 'Please Select Round No'
                        },
                        'merit': {
                            'required': 'Please Enter Merit'
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
                    text: "you want to Insert College Merit",
                }).then((result) => {
                    if (result) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                    .attr('content')
                            },
                            type: 'POST',
                            url: "{{ route('college.merit.store') }}",
                            data: formData,
                            dataType: 'JSON',
                            contentType: false,
                            processData: false,
                            cache: false,
                            success: function(query) {
                                if (query) {
                                    swal("Inserted!",
                                        "College Merit Inserted Successfully.",
                                        "success");
                                    window.location.href =
                                        "{{ route('college.merit.index') }}";
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
