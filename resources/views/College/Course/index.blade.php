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
            <a href="{{route('college.course.create')}}" class="btn gradient-pomegranate big-shadow">Add Courses</a>
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
@endpush
