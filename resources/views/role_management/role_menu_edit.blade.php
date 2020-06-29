@extends('layouts.app') 
@section('content')
<div class="row">
 <div class="col-md-12">
    <div class="card">
       <div class="card-header">
          <div class="card-title">Edit Role Menu</div>
        </div>
          <form id="form-update-role-menu" action="{{ route('role-menu.update', $role->role_id) }}" method="post" class="form-submit">
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
                              <label>
                                  <input name="menu[]" type="checkbox" value="{{ $parent['menu_id'] }}" {{ $parent['active'] ? 'checked' : '' }}>&nbsp;
                                  <i class="fa fa-folder-open"></i> 
                                  {{ $parent['name'] }}
                              </label>
                              
                            </td>
                          </tr>
                          
                          @foreach($parent['menu'] as $child)
                            
                            <tr>
                              <td> 
                                <label class="role-menu-child">
                                  <input name="menu[]" type="checkbox" data-parent="{{ $parent['menu_id'] }}" value="{{ $child['menu_id'] }}" {{ $child['active'] ? 'checked' : '' }}>&nbsp;
                                  {{ $child['name'] }}
                                </label>
                              </td>
                            </tr>
                            
                            @foreach($child['menu'] as $grandchild)
                              <tr>
                                <td>
                                  <label class="role-menu-grandchild"> 
                                    <input name="menu[]" type="checkbox" data-parent="{{ $child['menu_id'] }}" value="{{ $grandchild['menu_id'] }}" {{ $grandchild['active'] ? 'checked' : '' }}>&nbsp;
                                    {{ $grandchild['name'] }}
                                  </label>
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
          </div>
          <div class="card-action">
            @include('partials.form-submit')
          </div>
        </form>
      </div>
    </div>
  </div>
<script>

$('input[type=checkbox]').on('click', function() {
  let childs  = document.querySelectorAll('[data-parent="'+ this.value +'"]');
  let parents = document.querySelectorAll('[value="'+ this.getAttribute('data-parent') +'"]');

  // auto checked node child
  setCheckbox(childs, this.checked)

  if(this.checked) {
    // auto checked node parent if this checked
    for (let parent of parents) {
      parent.checked = this.checked
    }
  } else {
    // if this unchecked then check all sibling
    let siblings       = document.querySelectorAll('[data-parent="'+ this.getAttribute('data-parent') +'"]')
    let siblingChecked = false
    
    for (let sibling of siblings) {
      if(sibling.checked) siblingChecked = sibling.checked;
    }

    // if none checked then uncheck node parent
    if(!siblingChecked) {
      setCheckbox(parents, false)
    }

  }
    
})

// set checkbox until grandchild and grandprent if exists
function setCheckbox(elements, value) {
  for (let element of elements) {
    let childElements  = document.querySelectorAll('[data-parent="'+ element.getAttribute('value') +'"]')
    let parentElements = document.querySelectorAll('[value="'+ element.getAttribute('value') +'"]')

    for (let childElement of childElements) {
      childElement.checked = value
    }

    for (let parentElement of parentElements) {
      parentElement.checked = value
    }

    element.checked = value
  }
}

</script>
@endsection