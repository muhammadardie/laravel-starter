@extends('layouts.app') 
@section('content')
<div class="row">
 <div class="col-md-12">
    <div class="card">
       <div class="card-header">
          <div class="card-title">New Permission</div>
        </div>
        <form id="form-create-permission" action="{{ route('permission.store') }}" method="post" class="form-submit">
        @csrf
        <div class="card-body">  
          <div class="row">
            @include('partials.form-input', [
              'title'       => __('Permission Name'),
              'type'        => 'text',
              'name'        => 'name',
              'required'    => true,
              'placeholder' => true
            ])
            @include('partials.form-input', [
              'title'       => __('Permission Action'),
              'type'        => 'text',
              'name'        => 'action',
              'required'    => true,
              'placeholder' => true
            ])
            @include('partials.form-textarea', [
              'title'       => __('Description'),
              'name'        => 'description',
              'required'    => true,
              'placeholder' => true
            ])
          </div>
        </div>
        <div class="card-action">
          @include('partials.buttons.submit')
        </div>
      </form>
    </div>
  </div>
</div>
{!! JsValidator::formRequest('App\Http\Requests\PermissionRequest', '#form-create-permission') !!}
@endsection