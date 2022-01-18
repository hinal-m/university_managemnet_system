@extends('University.layouts.master')
@section('title', 'Student')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> </h3>
            </div>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header card-header-flex">
                            <h4 class="card-title">Student Table</h4>
                        </div>
                        <div class="card-body">

                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            {!! $dataTable->table(['class' => 'table table-bordered dt-responsive nowrap']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @push('js')
    {!! $dataTable->scripts() !!}
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
         $(document).on('click', '.delete', function() {
            var id = $(this).data('id');
            var el = this;
            swal({
                    title: "Are you sure?",
                    text: "You Want To Delete The Student!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{ route('university.delete') }}",
                            type: 'POST',
                            dataType: "JSON",
                            data: {
                                'id': id,
                            },
                            cache: false,
                            success: function(data) {
                                if (data) {
                                    window.LaravelDataTables["student-table"].draw();
                                } else {
                                    swal("oops!", "Something went wrong", "error");
                                }
                            }
                        });
                        swal("Student has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Your Product is safe!");
                    }
                });
        });
    </script>


@endpush
