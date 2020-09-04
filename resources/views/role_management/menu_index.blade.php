@extends('layouts.app') 
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      @include('partials.buttons.add', ['text' => 'New Menu'])
      <div class="card-body">
        @include('partials.alert')
        <div class="row">
          <table class="table table-hover" id="table">
             <thead>
                <tr>
                   <th>No</th>
                   <th>Menu Name</th>
                   <th>Route</th>
                   <th>Parent</th>
                   <th>Status</th>
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
         ajax: '{{ route('menu.ajaxDatatable') }}',
         columns: [
             {data: 'rownum', searchable: false, width: '10%' },
             {data: 'name', name: 'menu.name'},
             {data: 'route', name: 'menu.route'},
             {data: 'parent', name: 'menu.id_parent'},
             {data: 'status', name: 'menu.is_active'},
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
@include('partials.datatable-delete', ['text' => __('menu'), 'table' => '#table', 'reload' => true])
@endsection