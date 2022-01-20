@extends('College.layouts.master')
@section('title', 'Admission')

@section('content')
<div class="content-overlay"></div>
<div class="content-wrapper">
   <div class="row">
      <div class="col-12">
         <div class="content-header">Admission Merit Table</div>
      </div>
      <div class="text-right">
        <div class="mb-2">
           {{-- <a href="{{route('college.course.create')}}" class="btn gradient-pomegranate big-shadow">Add Courses</a> --}}
           {{-- <a href="{{route('college.meritexport')}}" class="btn btn-warning  float-right">EXPORT DATA</a> --}}

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
                        {!! $dataTable->table(['class' => 'table text-nowrap table-bordered dt-responsive nowrap']) !!}
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
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>

    @endpush
