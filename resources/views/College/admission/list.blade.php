@extends('College.layouts.master')
@section('title', 'Admission')
@section('content')
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="content-header">Admission Reserve Table</div>
            </div>
            <div class="text-right">
                <div class="mb-2">
                    {{-- <a href="{{route('college.course.create')}}" class="btn gradient-pomegranate big-shadow">Add Courses</a> --}}
                    {{-- <a href="{{route('college.reservePdf')}}" class="btn btn-warning  float-right">PDF TO DOWNLOAD</a> --}}
                </div>
            </div>
        </div>
        <!-- Zero configuration table -->
        <section id="configuration">
            <div class="row">
                <div class="col-12 gradient-man-of-steel d-block rounded">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="table-responsive text-nowrap">
                                    {!! $dataTable->table(['class' => 'table table-bordered dt-responsive nowrap']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/ Zero configuration table -->
    </div>
@endsection
@push('js')

    {!! $dataTable->scripts() !!}
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
        $(document).on('click', '.confirm', function() {
            var id = $(this).data('id');
            var el = this;
            swal({
                    title: "Are you sure?",
                    text: "You Want To Confirm This Student",
                    icon: "warning",
                    buttons: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        alert(willDelete);
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{ route('college.confirm') }}",
                            type: 'POST',
                            dataType: "JSON",
                            data: {
                                'id': id,
                            },
                            cache: false,
                            success: function(data) {
                                if (data) {
                                    window.LaravelDataTables["collegecourse-table"].draw();
                                } else {
                                    swal("oops!", "Something went wrong", "error");
                                }
                            }
                        });
                        swal("College Course has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Your Product is safe!");
                    }
                });
        });
    </script>

@endpush
