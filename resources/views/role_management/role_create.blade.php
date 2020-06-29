@extends('layouts.app') 
@section('content')
<div class="row">
 <div class="col-md-12">
    <div class="card">
       <div class="card-header">
          <div class="card-title">New Role</div>
        </div>
        <form id="form-create-role" action="{{ route('role.store') }}" method="post" class="form-submit">
          @csrf
          <div class="card-body">  
            <div class="row">
              @include('partials.form-input', [
                'title'       => __('Role Name'),
                'type'        => 'text',
                'name'        => 'name',
                'required'    => true,
                'placeholder' => true
              ])
              @include('partials.form-textarea', [
                'title'       => __('Description'),
                'name'        => 'description',
                'placeholder' => '(Optional)'
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
{!! JsValidator::formRequest('App\Http\Requests\RoleRequest', '#form-create-role') !!}
@endsection