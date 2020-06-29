@extends('layouts.app') 
@section('content')
<div class="row">
 <div class="col-md-12">
    <div class="card">
       <div class="card-header">
          <div class="card-title">Detail Permission</div>
        </div>
          <form class="kt-form kt-form--fit kt-form--label-right">
            <div class="card-body">
              <div class="row">
                @include('partials.form-input', [
                  'title'       => __('Permission Name'),
                  'type'        => 'text',
                  'name'        => 'name',
                  'required'    => true,
                  'attribute'   => ['disabled'],
                  'value'       => $permission->name
                ])
                @include('partials.form-input', [
                  'title'       => __('Permission Action'),
                  'type'        => 'text',
                  'name'        => 'action',
                  'required'    => true,
                  'attribute'   => ['disabled'],
                  'value'       => $permission->action
                ])
                @include('partials.form-textarea', [
                  'title'       => __('Description'),
                  'name'        => 'description',
                  'required'    => true,
                  'attribute'   => ['disabled'],
                  'value'       => $permission->description
                ])
                @include('partials.form-input', [
                  'title'       => __('Created at'),
                  'type'        => 'text',
                  'name'        => 'created_at',
                  'required'    => true,
                  'attribute'   => ['disabled'],
                  'value'       => Helper::tglIndo($permission->created_at)
                ])
                @include('partials.form-input', [
                  'title'       => __('Updated at'),
                  'type'        => 'text',
                  'name'        => 'updated_at',
                  'required'    => true,
                  'attribute'   => ['disabled'],
                  'value'       => Helper::tglIndo($permission->updated_at)
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