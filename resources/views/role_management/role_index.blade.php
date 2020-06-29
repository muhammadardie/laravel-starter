@extends('layouts.app') 
@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card">
      @include('partials.datatable-add', ['text' => 'New Role', 'route' => route('role.create')])
      <div class="card-body">
        @include('partials.alert')
        <div class="row">
          <table class="table table-hover" id="table">
             <thead>
                <tr>
                   <th>No</th>
                   <th>Role name</th>
                   <th>Description</th>
                   <th>Action</th>
                </tr>
             </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
   $(function() {
       var t = $('#table').DataTable({
         processing: true,
         serverSide: true,
         ajax: '{{ route('role.ajaxDatatable') }}',
         columns: [
             {data: 'rownum', searchable: false, width: '10%' },
             {data: 'name', name: 'role.name'},
             {data: 'description', name: 'role.description'},
             {data: 'action', orderable:false, searchable: false, className: 'text-center', width: "25%"},
         ],
         "drawCallback": function(settings) {
         //
             },            
             pageLength: 10,
             // stateSave: true,
         });
   });
   
</script>
@include('partials.datatable-delete', ['text' => __('role'), 'table' => '#table'])
@endsection