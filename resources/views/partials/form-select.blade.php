<div class="form-group {{ isset($multiColumn) ? 'col-lg-6' : 'col-lg-8' }}">
    <label>
        @if( isset($required) )
            <span style="color:red">*</span>
        @endif
        {{ $title }}
    </label>

    <select 
      name="{{ $name }}" 
      class="form-control"
      {{ (isset($attribute) ? is_array($attribute) : false) ? implode(' ',$attribute) : ''}}
    >

      <option></option>
        @foreach($data as $key => $value)
            <option value="{{ $key }}" 
            @if(isset($selected) && !is_array($selected) && $selected== $key)
              selected
            @endif
            > 
              {!! $value !!} 
            </option>
        @endforeach
    </select>
</div>

<script>
  $("select[name='{{ $name }}']").select2({ 
    placeholder: "{{ \Lang::get('-- Pilih '. $title . ' --') }}", 
    width: '{{ isset($multiColumn) ? '100%' : '50%' }}'
  });
</script>