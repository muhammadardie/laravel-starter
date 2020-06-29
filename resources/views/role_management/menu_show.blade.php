@extends('layouts.app') 
@section('content')
<div class="row">
 <div class="col-md-12">
    <div class="card">
       <div class="card-header">
          <div class="card-title">Detail Menu</div>
        </div>
          <form class="kt-form kt-form--fit kt-form--label-right">
            <div class="card-body">
              <div class="row">
                @include('partials.form-input', [
                  'title'       => __('Menu name'),
                  'type'        => 'text',
                  'name'        => 'name',
                  'value'       => $menu->name,
                  'multiColumn' => true,
                  'attribute'   => ['disabled'],
                ])
                @include('partials.form-input', [
                  'title'       => __('Route'),
                  'type'        => 'text',
                  'name'        => 'route',
                  'value'       => $menu->route,
                  'multiColumn' => true,
                  'attribute'   => ['disabled'],
                ])
                @include('partials.form-input', [
                  'title'       => __('Menu parent'),
                  'type'        => 'text',
                  'name'        => 'id_parent',
                  'value'       => ( $menu->parentMenu() ? $menu->parentMenu()->name : '-' ),
                  'multiColumn' => true,
                  'attribute'   => ['disabled'],
                ])
                @include('partials.form-input', [
                  'title'       => __('Icon'),
                  'type'        => 'text',
                  'name'        => 'icon',
                  'value'       => $menu->icon,
                  'multiColumn' => true,
                  'attribute'   => ['disabled'],
                ])   
                @include('partials.form-input', [
                  'title'       => __('Status'),
                  'type'        => 'text',
                  'name'        => 'icon',
                  'value'       => $menu->statusMenu(),
                  'multiColumn' => true,
                  'attribute'   => ['disabled'],
                ])
                @include('partials.form-input', [
                  'title'       => __('Menu order'),
                  'type'        => 'number',
                  'name'        => 'order',
                  'value'       => $menu->order,
                  'multiColumn' => true,
                  'attribute'   => ['disabled'],
                ])
                @include('partials.form-input', [
                  'title'       => __('Created at'),
                  'name'        => 'created_at',
                  'type'        => 'text',
                  'multiColumn' => true,
                  'value'       => Helper::tglIndo($menu->created_at),
                  'attribute'   => ['disabled'],
                ])
                @include('partials.form-input', [
                  'title'       => __('Updated at'),
                  'name'        => 'created_at',
                  'type'        => 'text',
                  'multiColumn' => true,
                  'value'       => Helper::tglIndo($menu->updated_at),
                  'attribute'   => ['disabled'],
                ])
              </div>
            </div>
             <div class="card-action">
            @include('partials.form-submit', ['noSubmit' => true])
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection