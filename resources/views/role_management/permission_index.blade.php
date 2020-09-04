@extends('layouts.app') 
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      @include('partials.buttons.add', ['text' => 'New Permission'])
      <div class="card-body">
        @include('partials.alert')
        <div class="row">
          <table class="table table-hover" id="table">
             <thead>
                <tr>
                   <th>No</th>
                   <th>Permission name</th>
                   <th>Action</th>
                   <th>Created at</th>
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
         ajax: '{{ route('permission.ajaxDatatable') }}',
         columns: [
             {data: 'rownum', searchable: false, width: '10%' },
             {data: 'name', name: 'permission.name'},
             {data: 'permission_action', name: 'permission.action'},
             {data: 'created_at', name: 'permission.created_at'},
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
@include('partials.datatable-delete', ['text' => __('permission'), 'table' => '#table'])
@endsection