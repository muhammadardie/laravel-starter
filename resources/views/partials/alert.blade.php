@if(Session::has('alert'))
	<div class="alert {{ Session::get('alert') }} alert-bold" role="alert" id="alert-status">
	  <div class="alert-text">{{ Session::get('alert-text') }}</div>
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>

    <script>
        $("#alert-status").fadeTo(3000, 0).slideUp(500, function(){
            $(this).remove(); 
        });
    </script>
@endif