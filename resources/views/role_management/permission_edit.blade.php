@extends('layouts.app') 
@section('content')
<div class="row">
 <div class="col-md-12">
    <div class="card">
       <div class="card-header">
          <div class="card-title">Edit Permission</div>
        </div>
          <form id="form-update-permission" action="{{ route('permission.update', $permission->permission_id) }}" method="post" class="form-submit">
            @csrf
            {{ method_field('PATCH') }}
            <div class="card-body">  
              <div class="row">
                @include('partials.form-input', [
                  'title'       => __('Permission Name'),
                  'type'        => 'text',
                  'name'        => 'name',
                  'required'    => true,
                  'placeholder' => true,
                  'value'       => $permission->name
                ])
                @include('partials.form-input', [
                  'title'       => __('Permission Action'),
                  'type'        => 'text',
                  'name'        => 'action',
                  'required'    => true,
                  'placeholder' => true,
                  'value'       => $permission->action
                ])
                @include('partials.form-textarea', [
                  'title'       => __('Description'),
                  'name'        => 'description',
                  'required'    => true,
                  'placeholder' => true,
                  'value'       => $permission->description
                ])
              </div>
          </div>
          <div class="card-action">
            @include('partials.form-submit')
          </div>
        </form>
      </div>
    </div>
  </div>
{!! JsValidator::formRequest('App\Http\Requests\PermissionRequest', '#form-update-permission') !!}
@endsection