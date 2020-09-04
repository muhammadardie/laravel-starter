@extends('layouts.app') 
@section('content')
<div class="row">
 <div class="col-md-12">
    <div class="card">
       <div class="card-header">
          <div class="card-title">Edit Menu Permission</div>
        </div>
          <form id="form-update-menu-permission" action="{{ route('menu-permission.update', $role->role_id) }}" method="post" class="form-submit">
            @csrf
            {{ method_field('PATCH') }}
            <div class="card-body">
              <div class="row">
                @include('partials.form-input', [
                  'title'       => __('Role Name'),
                  'type'        => 'text',
                  'name'        => 'name',
                  'value'       => $role->name,
                  'multiColumn' => true,
                  'attribute'   => ['disabled'],
                ])
                
                <div class="col-md-12">
                  <div class="permission-menu-content">
                    <table class="table table-permission table-bordered">
                      <thead class="thead-light">
                        <th class="permission-menu-name"> 
                          <b>Menu Name</b>
                        </th>
                        @foreach($permissions as $permission)
                            <th class="permission-name">
                              <b>{{ $permission->name }}</b>
                              <br />
                                <input 
                                  type="checkbox"
                                  data-type="parent"
                                  class="{{ $permission->action }}"
                                >
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
                                      name="permissions"
                                      data-menu="{{ $parent['menu_id'] }}"
                                      data-permission="{{ $permissionIds[$i] }}"
                                      type="checkbox"
                                      class="{{ $permissions[$i]->action }}"
                                      {{ 
                                        in_array( $permissionIds[$i], $parent['permissions']) 
                                          ? 'checked="checked"'
                                          : ''  
                                      }}
                                    >
                                   </label>
                                 </td>
                              @else
                                <td>
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
                                        name="permissions"
                                        data-menu="{{ $child['menu_id'] }}"
                                        data-permission="{{ $permissionIds[$i] }}"
                                        class="{{ $permissions[$i]->action }}"
                                        type="checkbox"
                                        {{ 
                                          in_array( $permissionIds[$i], $child['permissions']) 
                                            ? 'checked="checked"'
                                            : ''  
                                        }}
                                       >
                                     </label>
                                   </td>
                                @else
                                  <td>
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
                                            name="permissions"
                                            data-menu="{{ $grandchild['menu_id'] }}"
                                            data-permission="{{ $permissionIds[$i] }}"
                                            class="{{ $permissions[$i]->action }}"
                                            type="checkbox"
                                            {{ 
                                              in_array( $permissionIds[$i], $grandchild['permissions']) 
                                                ? 'checked="checked"'
                                                : ''  
                                            }}
                                           >
                                         </label>
                                       </td>
                                    @else
                                      <td>
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
            <input type="hidden" name="menu_permission" />
            <div class="card-action">
            @include('partials.buttons.submit')
          </div>
        </form>
      </div>
    </div>
  </div>
<script>

let menuPermissions   = @json($menuPermission); // menu permission from controller
let updatedPermission = []; // assign empty array for updatedpermission

constructUpdatedPermission() // construct updated permission first

// auto check chekcbox below this permission checkbox
$('input[type=checkbox][data-type=parent]').on('click', function() {
  let thisClass      = this.className
  let checkboxBelow  = document.querySelectorAll('[class="'+ this.className +'"]');
  
  for (let checkbox of checkboxBelow) {
    checkbox.checked = this.checked
    updatePermissionMenu(checkbox)
  }
})

// on click checkbox permission
$('input[name=permissions]').on('click', function() {
  updatePermissionMenu(this)
})

function constructUpdatedPermission() {
  for(let parent of menuPermissions) {
    pushPermission(parent)

    for(let child of parent.menu) {
      pushPermission(child)

      for(let grandchild of child.menu) {
        pushPermission(grandchild)
      }
    }
  }  

  // assign to form input for update when submit later
  $('input[name=menu_permission]').val(JSON.stringify(updatedPermission))
}

// update variable updatedPermission when element checked/unchecked
function updatePermissionMenu(inputElement) {
  let checked  = inputElement.checked
  let thisMenu = inputElement.getAttribute('data-menu')
  let sameMenus = document.querySelectorAll('[data-menu="'+ thisMenu +'"]');

  // get all permission checked on same menu
  let permissions = []
  for(sameMenu of sameMenus) {
    if(sameMenu.checked) permissions.push(sameMenu.getAttribute('data-permission'))
  }
  
  // update variable updatedPermission
  for(let update of updatedPermission) {
    if(update.menu_id == thisMenu) {
      update.permissions = permissions
    }
  }

  $('input[name=menu_permission]').val(JSON.stringify(updatedPermission))
}

// push permission into variable updatedpermission
function pushPermission(obj) {
  // only menu with exist route which can be updated
  if(obj.route) {
    let menuPermission = {
      'menu_id': obj.menu_id,
      'permissions': obj.permissions
    }

    updatedPermission.push(menuPermission) 
  }
}


</script>
@endsection