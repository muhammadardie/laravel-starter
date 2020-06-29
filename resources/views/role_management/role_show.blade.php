@extends('layouts.app') 
@section('content')
<div class="row">
 <div class="col-md-12">
    <div class="card">
       <div class="card-header">
          <div class="card-title">Detail Role</div>
        </div>
          <form class="kt-form kt-form--fit kt-form--label-right">
            <div class="card-body">
              <div class="row">
                @include('partials.form-input', [
                  'title'       => __('Role Name'),
                  'type'        => 'text',
                  'name'        => 'name',
                  'attribute'   => ['disabled'],
                  'value'       => $role->name
                ])
                @include('partials.form-textarea', [
                  'title'       => __('Description'),
                  'name'        => 'description',
                  'attribute'   => ['disabled'],
                  'value'       => $role->description
                ])
                @include('partials.form-input', [
                  'title'       => __('Created at'),
                  'type'        => 'text',
                  'name'        => 'created_at',
                  'attribute'   => ['disabled'],
                  'value'       => Helper::tglIndo($role->created_at)
                ])
                @include('partials.form-input', [
                  'title'       => __('Updated at'),
                  'type'        => 'text',
                  'name'        => 'updated_at',
                  'attribute'   => ['disabled'],
                  'value'       => Helper::tglIndo($role->updated_at)
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