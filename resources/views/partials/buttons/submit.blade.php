@php
	$canStore  = Route::getCurrentRoute()->getActionMethod() === 'create' && in_array("store", $availablePermission);
	$canUpdate = Route::getCurrentRoute()->getActionMethod() === 'edit' && in_array("update", $availablePermission);
@endphp
<div class="kt-form__actions">
    <div class="col-lg-6">
    	@if( !isset($noSubmit) )
    		@if($canStore || $canUpdate)
	      		<button type="submit" class="btn btn-primary btn-submit">Submit</button>&nbsp;
	      	@endif
	    @endif
      <a href="#" class="btn btn-grey btn-back">Back</a>
    </div>
</div>

<script>
$(document).ready(function() { 

	@if( !isset($noSubmit) )

		// on click submit disable button submit and process
	    $('form.form-submit').on('submit', function() {
	        $(this).valid() && disableButton();
		});

    @endif
    // on click back button redirect to index menu page
    $('a.btn-back').on('click', backToIndex);

    function disableButton(){
    	let loading = '<i class="fas fa-circle-notch fa-spin"></i> Loading...'

		$('.btn-submit').html(loading);
		$('.btn-submit').attr('disabled', true);
	}

	function backToIndex(e){
		e.preventDefault();
		let redirect    = $('li.active:last').children().attr('href');
		window.location = redirect;
	}

}); 
</script>