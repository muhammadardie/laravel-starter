<div class="form-group {{ isset($multiColumn) ? 'col-lg-6' : 'col-lg-8' }}">
    <label>
        @if( isset($required) )
            <span style="color:red">*</span>
        @endif
        {{ $title }}
    </label>

    <input  
        type="{{ isset($type) ? $type : 'text' }}" 
        class="form-control"
        name="{{ $name }}"
        value="{{ isset($value) ? $value : '' }}"

        @if( isset($placeholder) )
            @if($placeholder === true)
                placeholder="Enter {{ $title }}"
            @else
                placeholder="{{ $placeholder }}"
            @endif
        @endif

        {{ (isset($attribute) ? is_array($attribute) : false) ? implode(' ',$attribute) : ''}}
    >

</div>

@if( isset($date) )
    <script>
        let input = $('input[name={{ $name }}]'); 
        <?= \Helper::date_formats('$(input)', 'js') ?>
    </script>
@endif