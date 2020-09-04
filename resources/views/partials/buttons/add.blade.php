@if(in_array('create', $availablePermission))
    <div class="card-header">
        <a href="{{ isset($route) ? $route : \Request::url() . '/create' }}" class="btn btn-primary"> 
            <span class="btn-label">
		        <i class="fa fa-plus"></i>
		    </span>
            {{ isset($text) ? $text : 'New Data' }} 
       </a>
    </div>
@endif