@extends('layouts.app') 
@section('content')
<div class="row">
 <div class="col-md-12">
    <div class="card">
       <div class="card-header">
          <div class="card-title">Edit Role</div>
        </div>
          <form id="form-update-role" action="{{ route('role.update', $role->role_id) }}" method="post" class="form-submit">
            @csrf
            {{ method_field('PATCH') }}
            <div class="card-body">  
              <div class="row">
                @include('partials.form-input', [
                  'title'       => __('Role Name'),
                  'type'        => 'text',
                  'name'        => 'name',
                  'required'    => true,
                  'placeholder' => true,
                  'value'       => $role->name
                ])
                @include('partials.form-textarea', [
                  'title'       => __('Description'),
                  'name'        => 'description',
                  'required'    => true,
                  'placeholder' => true,
                  'value'       => $role->description
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
{!! JsValidator::formRequest('App\Http\Requests\RoleRequest', '#form-update-role') !!}
@endsection