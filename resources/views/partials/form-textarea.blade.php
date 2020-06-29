@if( isset($summernote) && $summernote === true)
	<style>
	/*editor*/
	.note-editing-area {
	    z-index: -1 !important;
	}

	/*dropdown*/
	.note-check {
	    z-index: auto !important;
	}
	</style>
@endif


<div class="form-group {{ isset($multiColumn) ? 'col-lg-6' : 'col-lg-8' }}">
    <label>
        @if( isset($required) )
            <span style="color:red">*</span>
        @endif
        {{ $title }}
    </label>

	<textarea class="form-control"
		name="{{ $name }}"
		rows="3" 

		@if( isset($placeholder) )
            @if($placeholder === true)
                placeholder="Masukkan {{ $title }}"
            @else
                placeholder="{{ $placeholder }}"
            @endif
        @endif

        {{ (isset($attribute) ? is_array($attribute) : false) ? implode(' ',$attribute) : ''}}
	>{{ isset($value) ? $value : '' }}</textarea>

</div>

@if( isset($summernote) && $summernote === true)
	<script type="text/javascript">
	$(document).ready(function() {
	  $('textarea[name={{ $name }}]').summernote({
	  	  toolbar: [
	        // [groupName, [list of button]]
	        ['style', ['bold', 'italic', 'underline', 'clear']],
	        ['font', ['strikethrough', 'superscript', 'subscript']],
	        ['fontsize', ['fontsize']],
	        ['color', ['color']],
	        ['para', ['ul', 'ol', 'paragraph']],
	        ['height', ['height']],
	        ['view', ['fullscreen', 'codeview']],
	        ['fontname', ['fontname']],
	      ],
	      height: 300,                 // set editor height
	      minHeight: null,             // set minimum height of editor
	      maxHeight: null,   
	  });

	  @if( (isset($attribute) && implode(' ',$attribute) == 'disabled') )
	    $('textarea[name={{ $name }}]').summernote('disable');
	  @endif

	});

	</script>
@endif