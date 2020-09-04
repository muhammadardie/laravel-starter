@extends('layouts.app') 
@section('content')
<div class="row">
 <div class="col-md-12">
    <div class="card">
       <div class="card-header">
          <div class="card-title">Detail User</div>
        </div>
          <form class="kt-form kt-form--fit kt-form--label-right">
            <div class="card-body">
              <div class="row">
                @include('partials.form-file', [
                  'title'       => __('Photo'),
                  'name'        => 'photo',
                  'disabled'    => true,
                  'value'       => 'user/'. $user->photo,
                ])
                
                @include('partials.form-input', [
                  'title'       => __('Username'),
                  'type'        => 'text',
                  'name'        => 'username',
                  'attribute'   => ['disabled'],
                  'multiColumn' => true,
                  'value'       => $user->username
                ])
                @include('partials.form-input', [
                  'title'       => __('Email'),
                  'type'        => 'text',
                  'name'        => 'email',
                  'attribute'   => ['disabled'],
                  'multiColumn' => true,
                  'value'       => $user->email
                ]) 
                @include('partials.form-input', [
                  'title'       => __('Role'),
                  'name'        => 'role',
                  'type'        => 'text',
                  'multiColumn' => true,
                  'value'       => $user->role->name,
                  'attribute'   => ['disabled'],
                ])
                @include('partials.form-input', [
                  'title'       => __('Last logoin'),
                  'name'        => 'last_login',
                  'type'        => 'text',
                  'multiColumn' => true,
                  'value'       => Helper::tglIndo($user->last_login),
                  'attribute'   => ['disabled'],
                ])
                @include('partials.form-input', [
                  'title'       => __('Created at'),
                  'name'        => 'created_at',
                  'type'        => 'text',
                  'multiColumn' => true,
                  'value'       => Helper::tglIndo($user->created_at),
                  'attribute'   => ['disabled'],
                ])
                @include('partials.form-input', [
                  'title'       => __('Updated at'),
                  'name'        => 'created_at',
                  'type'        => 'text',
                  'multiColumn' => true,
                  'value'       => Helper::tglIndo($user->updated_at),
                  'attribute'   => ['disabled'],
                ])
                <div class="form-group col-lg-6">
                  <label>
                    Status
                  </label>
                  @if($user->is_logged)
                    <h6 class="text-success"> <i class="fa fa-user-alt"></i> Online </h6>
                  @else
                    <h6 class="text-danger"> <i class="fa fa-user-alt-slash"></i> Offline </h6>
                  @endif
                </div>
              </div>
            </div>
             <div class="card-action">
            @include('partials.buttons.submit', ['noSubmit' => true])
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection