@extends('layouts.app') 
@section('content')
<div class="row">
 <div class="col-md-12">
    <div class="card">
       <div class="card-header">
          <div class="card-title">Detail Role Menu</div>
        </div>
          <form class="kt-form kt-form--fit kt-form--label-right">
            <div class="card-body">
              <div class="row">
                @include('partials.form-input', [
                  'title'       => __('Role name'),
                  'type'        => 'text',
                  'name'        => 'name',
                  'value'       => $role->name,
                  'multiColumn' => true,
                  'attribute'   => ['disabled'],
                ])
                <div class="col-md-12">
                  <br />
                  <div class="role-menu-title">
                    <table class="table table-bordered">
                      <thead class="thead-light">
                        <th class="font-weight-bold"> <b>Menu Name</b>
                        </th>
                      </thead>
                    </table>
                  </div>

                  <div class="role-menu-content">
                    <table class="table table-bordered">
                      <tbody>
                        @foreach($roleMenu as $parent)

                          <tr>
                            <td class="font-weight-bold"> 
                              <i class="fas fa-angle-{{ count($parent['menu']) > 0 ? 'down' : 'right' }}"></i>&nbsp;
                              {{ $parent['name'] }}
                            </td>
                          </tr>
                          
                          @foreach($parent['menu'] as $child)
                            
                            <tr>
                              <td>
                                <span class="role-menu-child">
                                  <i class="fas fa-angle-{{ count($child['menu']) > 0 ? 'down' : 'right' }}"></i>&nbsp;
                                  {{ $child['name'] }}
                                </span>
                              </td>
                            </tr>
                            
                            @foreach($child['menu'] as $grandchild)
                              <tr>
                                <td> 
                                  <span class="role-menu-grandchild">
                                    <i class="fas fa-angle-right"></i> &nbsp;
                                    {{ $grandchild['name'] }}
                                  </span>
                                </td>
                              </tr>
                            @endforeach
                          
                          @endforeach

                        @endforeach
                      </tbody>
                    </table>
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