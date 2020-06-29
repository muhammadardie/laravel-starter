@extends('layouts.app') 
@section('content')
<div class="row">
 <div class="col-md-12">
    <div class="card">
       <div class="card-header">
          <div class="card-title">New User</div>
        </div>
          <form id="form-create-user" action="{{ route('user.store') }}" method="post" enctype="multipart/form-data" class="form-submit">
            @csrf
            <div class="card-body">
              <div class="row"> 
                @include('partials.form-file', [
                  'title'       => __('Photo'),
                  'name'        => 'photo'
                ])
                
                @include('partials.form-input', [
                  'title'       => __('Username'),
                  'type'        => 'text',
                  'name'        => 'username',
                  'placeholder' => true,
                  'required'    => true,
                  'multiColumn' => true
                ])
                @include('partials.form-input', [
                  'title'       => __('Email'),
                  'type'        => 'email',
                  'name'        => 'email',
                  'placeholder' => true,
                  'required'    => true,
                  'multiColumn' => true
                ])
                @include('partials.form-input', [
                  'title'       => __('Password'),
                  'type'        => 'password',
                  'name'        => 'password',
                  'placeholder' => true,
                  'required'    => true,
                  'multiColumn' => true
                ])   
                @include('partials.form-select', [
                  'title'    => __('Role'),
                  'name'     => 'role',
                  'data'     => $roles,
                  'required' => true,
                  'multiColumn' => true
                ])
                @include('partials.form-input', [
                  'title'       => __('Password Confirmation'),
                  'type'        => 'password',
                  'name'        => 'password_confirmation',
                  'placeholder' => true,
                  'required'    => true,
                  'multiColumn' => true
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
{!! JsValidator::formRequest('App\Http\Requests\UserRequest', '#form-create-user') !!}
@endsection