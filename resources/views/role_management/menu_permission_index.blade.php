@extends('layouts.app') 
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        @include('partials.alert')
        <div class="row">
          <table class="table table-hover" id="table">
             <thead>
                <tr>
                   <th>No</th>
                   <th>Role name</th>
                   <th>Menu name</th>
                   <th>Permission</th>
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
         ajax: '{{ route('menu-permission.ajaxDatatable') }}',
         columns: [
             {data: 'rownum', searchable: false, width: '10%' },
             {data: 'name', name: 'role.name', width: '20%' },
             {data: 'menu', orderable:false, searchable: false},
             {data: 'permission', orderable:false, searchable: false},
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
@endsection