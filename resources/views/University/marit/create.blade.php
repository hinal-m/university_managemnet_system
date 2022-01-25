@extends('University.layouts.master')
@section('title', 'Merit')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Merit Round</h4>
                        <form class="forms-sample" id="submit_form" action="{{ route('university.marit.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="basicInput">Round No</label>
                                <input type="text" class="form-control mb-2" name="round_no" value="{{ old('round_no') }}" placeholder="Name">
                                @error('round_no')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror


                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Select Course</label>
                                <select class="form-control" id="course_id" name="course_id">
                                    <option value="">Select Course</option>
                                    @foreach ($course as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                    @error('course_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </select>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>
                                        <h5 class="mt-2">Start Date</h5>
                                    </label>
                                    <input type='tax' class="form-control datepicker" name="start_date" id="start_date" placeholder='Select Date' style='width: 180px;' autocomplete="off">
                                    @error('start_date')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <div class="form-group col-md-6">
                                    <label>
                                        <h5 class="mt-2">End Date</h5>
                                    </label>
                                    <input type='tax' name="end_date" class="form-control datepicker" id='end_date' placeholder='Select Date' style='width: 180px;' autocomplete="off">
                                    @error('end_date')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="helperText">Marit Result Declare Date</label>
                                <input type='tax' class="form-control datepicker" value="{{ old('marit_result') }}" name="marit_result" id="marit_result" placeholder='Select Date' style='width: 180px;' autocomplete="off">
                                @error('marit_result')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <button type="submit" id="submit" class="btn btn-primary btn-icon-text">
                                    <i class="mdi mdi-file-check btn-icon-prepend" id="submit"></i> Submit </button>
                                <a href="{{ route('university.marit.index') }}" class="btn btn-dark">Go Back!</a>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.0/jquery.validate.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function() {

        $("#start_date").datepicker({
            minDate: 0,
            onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() + 1);
            $("#end_date").datepicker("option", "minDate", dt);
        }
        });
        $("#end_date").datepicker({
            onSelect: function (selected) {
                var dt = new Date(selected);
                dt.setDate(dt.getDate() - 1);
                $("#start_date").datepicker("option", "maxDate", dt);
            }
        });
        // $('#marit_result').click(function(){
        //     var a= $('#end_date').val();
        //     onSelect: function (selected) {
        //         $("#start_date").datepicker("option", "maxDate", a);
        //     }
        // })
    });

    $(document).ready(function() {
        $('#submit_form').validate({
            rules: {
                round_no: {
                    required: true,
                    digits: true
                },
                course_id: {
                    required: true,

                },
                start_date: {
                    required: true,
                },
                end_date: {
                    required: true,
                },
                marit_result: {
                    required: true,
                },

            },
            messages: {
                'round_no': {
                    'required': 'Please Enter Round No'
                },
                'course_id': {
                    'required': 'Please Select Course'
                },
                'start_date': {
                    'required': 'Please Select Start Date'
                },
                'end_date': {
                    'required': 'Please Select end Date'
                },
                'marit_result': {
                    'required': 'Please Select date'
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
            text: "you want to Declare Merit Round",
        }).then((result) => {
            if (result) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                            .attr('content')
                    },
                    type: 'POST',
                    url: "{{ route('university.marit.store') }}",
                    data: formData,
                    dataType: 'JSON',
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function(query) {
                        if (query) {
                            swal("Inserted!",
                                "Merit Round Declared Successfully.",
                                "success");
                            window.location.href =
                                "{{ route('university.marit.index') }}";
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
