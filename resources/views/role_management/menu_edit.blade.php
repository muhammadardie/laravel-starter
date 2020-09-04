@extends('layouts.app') 
@section('content')
<div class="row">
 <div class="col-md-12">
    <div class="card">
       <div class="card-header">
          <div class="card-title">Edit Menu</div>
        </div>
          <form id="form-update-menu" action="{{ route('menu.update', $menu->menu_id) }}" method="post" class="form-submit">
            @csrf
            {{ method_field('PATCH') }}
            <div class="card-body">  
              <div class="row">
                @include('partials.form-input', [
                  'title'       => __('Menu name'),
                  'type'        => 'text',
                  'name'        => 'name',
                  'required'    => true,
                  'value'       => $menu->name,
                  'multiColumn' => true
                ])
                @include('partials.form-input', [
                  'title'       => __('Route'),
                  'type'        => 'text',
                  'name'        => 'route',
                  'value'       => $menu->route,
                  'multiColumn' => true
                ])
                @include('partials.form-select', [
                  'title'       => __('Menu parent'),
                  'name'        => 'id_parent',
                  'data'        => $menuList,
                  'required'    => true,
                  'selected'    => $menu->id_parent ?? '0', // jika null maka menu induknya root menu
                  'multiColumn' => true
                ])
                @include('partials.form-input', [
                  'title'       => __('Icon'),
                  'type'        => 'text',
                  'name'        => 'icon',
                  'value'       => $menu->icon,
                  'multiColumn' => true
                ])   
                @include('partials.form-select', [
                  'title'       => __('Status'),
                  'name'        => 'is_active',
                  'data'        => $statusList,
                  'required'    => true,
                  'selected'    => $menu->is_active,
                  'multiColumn' => true
                ])
                @include('partials.form-input', [
                  'title'       => __('Urutan menu'),
                  'type'        => 'number',
                  'name'        => 'order',
                  'value'       => $menu->order,
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
{!! JsValidator::formRequest('App\Http\Requests\MenuRequest', '#form-update-menu') !!}
@endsection