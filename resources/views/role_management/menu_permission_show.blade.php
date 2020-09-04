@extends('layouts.app') 
@section('content')
<div class="row">
 <div class="col-md-12">
    <div class="card">
       <div class="card-header">
          <div class="card-title">Detail Menu Permission</div>
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

                  <div class="role-menu-content">
                    <table class="table table-permission table-bordered">
                      <thead class="thead-light">
                        <th class="permission-menu-name"> 
                          <b>Menu Name</b>
                        </th>
                        @foreach($permissions as $permission)
                            <th class="permission-name"> 
                              <b>{{ $permission->name }}</b>
                            </th>
                          @endforeach
                      </thead>
                      <tbody>
                        {{-- list menu --}}
                        @foreach($menuPermission as $parent)
                          <tr>
                            <td class="font-weight-bold"> 
                              <i class="fa fa-folder-open"></i> 
                              {{ $parent['name'] }}
                            </td>
                            
                            {{-- if have any route then show permission available --}}
                            
                            @for ($i = 0; $i < count($permissions); $i++)
                              @if($parent['route'])
                                <td class="permission-checkbox">
                                  <!-- checked checkbox permission -->
                                   <label>
                                     <input 
                                      type="checkbox"
                                      disabled="" 
                                      {{ 
                                        in_array( $permissionIds[$i], $parent['permissions']) 
                                          ? 'checked="checked"'
                                          : ''  
                                      }}
                                    >
                                   </label>
                                 </td>
                              @else
                                <td class="permission-checkbox">
                                 </td>
                              @endif
                            @endfor
                            

                          </tr>

                          @foreach($parent['menu'] as $child)
                            <tr>
                              <td> 
                                <span class="role-menu-child">{{ $child['name'] }}</span>
                              </td>

                              {{-- if have any route then show permission available --}}
                              @for ($i = 0; $i < count($permissions); $i++)  
                                @if($child['route'])
                                  <td class="permission-checkbox">
                                    <!-- checked checkbox permission -->
                                     <label>
                                       <input 
                                        type="checkbox"
                                        disabled="" 
                                        {{ 
                                          in_array( $permissionIds[$i], $child['permissions']) 
                                            ? 'checked="checked"'
                                            : ''  
                                        }}
                                       >
                                     </label>
                                   </td>
                                @else
                                  <td class="permission-checkbox">
                                  </td>
                                @endif
                              @endfor
                              

                            </tr>

                            @foreach($child['menu'] as $grandchild)
                              <tr>
                                <td>
                                  <span class="role-menu-grandchild">
                                    {{ $grandchild['name'] }}
                                  </span>
                                </td>

                                {{-- if have any route then show permission available --}}
                                  @for ($i = 0; $i < count($permissions); $i++)  
                                    @if($grandchild['route'])
                                      <td class="permission-checkbox">
                                        <!-- checked checkbox permission -->
                                         <label>
                                           <input 
                                            type="checkbox"
                                            disabled="" 
                                            {{ 
                                              in_array( $permissionIds[$i], $grandchild['permissions']) 
                                                ? 'checked="checked"'
                                                : ''  
                                            }}
                                           >
                                         </label>
                                       </td>
                                    @else
                                      <td class="permission-checkbox">
                                      </td>
                                    @endif
                                  @endfor
                                

                              </tr>
                            @endforeach
                          
                          @endforeach

                        @endforeach
                      </tbody>
                    </table>
                  </div>

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