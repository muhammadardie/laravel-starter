@extends('layouts.app') 
@section('content')
<div class="row">
 <div class="col-md-12">
    <div class="card">
       <div class="card-header">
          <div class="card-title">New Menu</div>
        </div>
        <form id="form-create-menu" action="{{ route('menu.store') }}" method="post" class="form-submit">
          @csrf
          <div class="card-body">  
            <div class="row">
                @include('partials.form-input', [
                  'title'       => __('Menu name'),
                  'type'        => 'text',
                  'name'        => 'name',
                  'required'    => true,
                  'placeholder' => true,
                  'multiColumn' => true
                ])
                @include('partials.form-input', [
                  'title'       => __('Route'),
                  'type'        => 'text',
                  'name'        => 'route',
                  'placeholder' => true,
                  'multiColumn' => true
                ])
                @include('partials.form-select', [
                  'title'       => __('Menu parent'),
                  'name'        => 'id_parent',
                  'data'        => $menuList,
                  'required'    => true,
                  'placeholder' => true,
                  'multiColumn' => true
                ])
                @include('partials.form-input', [
                  'title'       => __('Icon'),
                  'type'        => 'text',
                  'name'        => 'icon',
                  'placeholder' => true,
                  'multiColumn' => true
                ])   
                @include('partials.form-select', [
                  'title'       => __('Status'),
                  'name'        => 'is_active',
                  'data'        => $statusList,
                  'required'    => true,
                  'placeholder' => true,
                  'multiColumn' => true
                ])
                @include('partials.form-input', [
                  'title'       => __('Menu order'),
                  'type'        => 'number',
                  'name'        => 'order',
                  'placeholder' => true,
                  'required'    => true,
                  'multiColumn' => true
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
{!! JsValidator::formRequest('App\Http\Requests\MenuRequest', '#form-create-menu') !!}
@endsection