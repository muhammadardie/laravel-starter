<?php

namespace App\Http\Controllers\UserManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\{ 
    MenuPermissionRepository, 
    RoleRepository, 
    RoleMenuRepository,
    PermissionRepository 
};

class MenuPermissionController extends Controller
{

    public function __construct(
        MenuPermissionRepository $menuPermissionRepo, 
        RoleRepository $roleRepo,
        RoleMenuRepository $roleMenuRepo,
        PermissionRepository $permissionRepo
    )
    {
        $this->menuPermissionRepo = $menuPermissionRepo;
        $this->roleRepo           = $roleRepo;
        $this->permissionRepo     = $permissionRepo;
        $this->roleMenuRepo       = $roleMenuRepo;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('role_management.menu_permission_index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int 
     * @return \Illuminate\Http\Response
     */
    public function show($roleId)
    {
        $editableMenu   = false;
        $withPermission = true;
        $role           = $this->roleRepo->show($roleId);
        $permissions    = $this->permissionRepo->all();
        $permissionIds  = $this->permissionRepo->getModel()->pluck('permission_id');
        $menu           = $this->roleMenuRepo->menuForRole($roleId, $editableMenu, $withPermission);
        $menuPermission = $this->roleMenuRepo->constructMenu($menu);
        
        return view('role_management.menu_permission_show', compact('role', 'menuPermission', 'permissions', 'permissionIds'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int
     * @return \Illuminate\Http\Response
     */
    public function edit($roleId)
    {
        $editableMenu   = false;
        $withPermission = true;
        $role           = $this->roleRepo->show($roleId);
        $permissions    = $this->permissionRepo->all();
        $permissionIds  = $this->permissionRepo->getModel()->pluck('permission_id');
        $menu           = $this->roleMenuRepo->menuForRole($roleId, $editableMenu, $withPermission);
        $menuPermission = $this->roleMenuRepo->constructMenu($menu);

        return view('role_management.menu_permission_edit', compact('role', 'menuPermission', 'permissions', 'permissionIds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $roleId)
    {
        $update = $this->menuPermissionRepo->updateMenuPermission( $request, $roleId );

        return redirect()->route('menu-permission.index')->with(\Helper::alertStatus('update', $update));
    }

    /**
    * Showing list bank by datatable
    * @param $request ajax
    * @return json
    */
    public function ajaxDatatable(Request $request)
    {
        return $this->menuPermissionRepo->datatableMenuPermission($request);
    }
}
