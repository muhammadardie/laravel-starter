
<div class="form-group {{ isset($multiColumn) ? 'col-lg-6' : 'col-lg-12' }}">
    <label>
        @if( isset($required) )
            <span style="color:red">*</span>
        @endif
        {{ $title }}
    </label>
    
    @if( isset($disabled) )
        <br />
        
        @if(\Storage::get( $value) )
            <img src="{{ asset('uploaded_files') . '/' . $value }}" class="rounded" style="width:200px"; />
        @else
            <img src="{{ asset('uploaded_files/no-image.png') }}" class="rounded" style="width:200px"; />
        @endif
    
    @else

        <div class="kv-avatar-errors col-md-12" style="display:none"></div> 
        <div class="file-loading">
            <input name="{{ $name }}" type="file" class="form-control">
            
        </div>
        <span class="text-danger">Allowed type:jpg, jpeg, png &emsp; Max Size:2MB</span>
    
    @endif
</div>
<script>
@if( !isset($disabled) )

    @if( isset($value) && \Storage::get( $value) )
        let img = '<img src="{{ asset('uploaded_files') . '/' . $value }}" alt="Your Avatar" style="width:200px";>'
    @else
        let img = null
    @endif

    $("input[name={{ $name }}]").fileinput({
        showConsoleLogs: false,
        showUpload: false,
        showBrowse: false,
        fileActionSettings: {
          showZoom: false
        },
        showCancel: false,
        browseOnZoneClick: true,
        theme: 'fas',
        overwriteInitial: true,
        maxFileSize: 2000,
        showClose: false,
        showCaption: false,
        elErrorContainer: '.kv-avatar-errors',
        msgErrorClass: 'alert alert-block alert-danger',
        allowedFileTypes: ['image'],   // allow only images
        defaultPreviewContent: img
    });
@endif
</script>