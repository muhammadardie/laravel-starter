@extends('layouts.app') 
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      @include('partials.datatable-add', ['text' => 'New User', 'route' => route('user.create')])
      <div class="card-body">
        @include('partials.alert')
        <div class="row">
          <table class="table table-hover" id="table">
             <thead>
                <tr>
                   <th>No</th>
                   <th>Username</th>
                   <th>Email</th>
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
         ajax: '{{ route('user.ajaxDatatable') }}',
         columns: [
             {data: 'rownum', searchable: false, width: '10%' },
             {data: 'username', name: 'user.username'},
             {data: 'email', name: 'user.email'},
             {data: 'created_at', name: 'user.created_at'},
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
@include('partials.datatable-delete', ['text' => __('user'), 'table' => '#table', 'reload' => true])
@endsection