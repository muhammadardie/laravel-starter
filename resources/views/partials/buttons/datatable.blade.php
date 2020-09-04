{{-- SHOW BUTTON --}}
@if ( isset($show) && in_array("show", $availablePermission) )
	<a title="Show details" href="{{ $show }}" class="btn cur-p btn-outline-primary btn-datatable">
		<i class="fa fa-search"></i>
	</a>
@endif
{{-- EDIT BUTTON --}}
@if ( isset($edit) && in_array("edit", $availablePermission) )
    <a title="Edit details" href="{{ $edit }}" class="btn cur-p btn-outline-primary btn-datatable">
    	<i class="fa fa-edit"></i>
    </a>
@endif
{{-- DESTROY BUTTON --}}
@if ( isset($destroy) && in_array("destroy", $availablePermission) )
    <a title="Delete" href="{{ $destroy }}" class="btn cur-p btn-outline-primary btn-datatable btn-delete-datatable">
    	<i class="fa fa-trash"></i>
    </a>
@endif