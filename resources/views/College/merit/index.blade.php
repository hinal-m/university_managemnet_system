@extends('College.layouts.master')
@section('title', 'Courses')

@section('content')
<div class="content-overlay"></div>
<div class="content-wrapper">
   <div class="row">
      <div class="col-12">
         <div class="content-header">Course Table</div>
      </div>
      <div class="text-right">
         <div class="mb-2">
            <a href="{{route('college.merit.create')}}" class="btn gradient-pomegranate big-shadow">Add Courses</a>
         </div>
      </div>
   </div>
   <!-- Zero configuration table -->
   <section id="configuration">
      <div class="row">
         <div class="col-12 gradient-man-of-steel d-block rounded">
            <div class="card">
               <div class="card-header">
                  <h4 class="card-title">Store List</h4>
               </div>
               <div class="card-content">
                  <div class="card-body">
                     <div class="table-responsive-sg">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
        $(document).on('click', '.delete', function() {
        var id = $(this).data('id');
        var el = this;
        swal({
                title: "Are you sure?",
                text: "You Want To Delete The College Merit!",
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
                        url: "{{ route('college.merit_delete') }}",
                        type: 'POST',
                        dataType: "JSON",
                        data: {
                            'id': id,
                        },
                        cache: false,
                        success: function(data) {
                            if (data) {
                                window.LaravelDataTables["collegemerit-table"].draw();
                            } else {
                                swal("oops!", "Something went wrong", "error");
                            }
                        }
                    });
                    swal("College Merit has been deleted!", {
                        icon: "success",
                    });
                } else {
                    swal("Your Product is safe!");
                }
            });
    });
    </script>
    @endpush
