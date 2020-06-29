@if(in_array('create', $availablePermission))
	<div class="card-header">
		<a class="btn btn-primary" href="{{ $route }}">
	      <span class="btn-label">
	        <i class="fa fa-plus"></i>
	      </span>
	      {{ $text }} 
	    </a>
	</div>
@endif