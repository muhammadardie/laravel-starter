<?php

namespace App\Repositories;

use App\Models\RoleManagement\RoleMenu;
use App\Repositories\{ RoleRepository, MenuRepository };
use App\Traits\MenuPermissionTrait;

class RoleMenuRepository extends BaseRepository
{
    use MenuPermissionTrait;

    public function __construct(RoleMenu $roleMenu, RoleRepository $role, MenuRepository $menu)
    {
		$this->model = $roleMenu;
		$this->role  = $role;
		$this->menu  = $menu;
    }

    /**
     * Return menu collection for selected role
     * when $editableMenu === true then add other menu to collection from
     * table menu which not in this role menu collection then set active for added menu = FALSE
     * when $withPermission === true then add available permission for menu by role
     * @param  int $roleId
     * @param  boolean $editableMenu
     * @return \Illuminate\Support\Collection
     */
    public function menuForRole($roleId, $editableMenu=FALSE, $withPermission=FALSE) {
        $role      = $this->role->show($roleId);
        $menuUsers = $role->menu;
        $menu = collect();
        foreach ($menuUsers as $menuUser) {
            $menuCollection = collect($menuUser);
            $menuCollection->put('active', $editableMenu);

            if($withPermission) {
                $roleMenus = $this->where([
                    'menu_id' => $menuUser->menu_id,
                    'role_id' => $roleId
                ])
                ->first();
                $menuPermissions = $roleMenus->permission;
                $permissions     = $menuPermissions->pluck('permission_id')->toArray();
                $menuCollection->put('permissions', $permissions);
            }

            $menu->push($menuCollection);
        }

        if($editableMenu) {
            $menuUserIds = $menuUsers->pluck('menu_id');
            $restMenus   = $this->menu
                                ->getModel()
                                ->whereNotIn('menu_id', $menuUserIds)
                                ->get();

            foreach ($restMenus as $restMenu) {
            	$menuCollection = collect($restMenu); 
                $menuCollection->put('active',  false);
                $menu->push($menuCollection); 
            }
        }

        return $menu;
    }

    /**
     * Return constructed (nested) menu
     * - parent 
     * -- child
     * --- grandchild
     * @param  collection $menu from menuforRole function
     * @return \Illuminate\Support\Collection
     */
    public function constructMenu($menu) {
        $constructedMenu = collect([]);
        $parents         = $menu->sortBy('order')->whereNull('id_parent');

        foreach ($parents as $parent) {
            $parent->put('menu', collect([]) );
            $childs = $menu->sortBy('order')->where('id_parent', $parent['menu_id']);

            foreach ($childs as $child) {
                $child->put('menu', collect([]) );
                $grandchilds = $menu->sortBy('order')->where('id_parent', $child['menu_id']);

                foreach ($grandchilds as $grandchild) {

                    $child['menu']->push($grandchild);
                }
                
                $parent['menu']->push($child);
            }
            
            $constructedMenu->push($parent);
        }


        return $constructedMenu;
    }

    public function updateRoleMenu($request, $roleId) {
        $roleMenu     = $this->menuForRole($roleId, false);
        $roleMenuIds  = $roleMenu->pluck('menu_id');
        $menuToUpdate = !empty($request->menu) ? $request->menu : [];

        $menuToDelete    = $roleMenu->whereNotIn('menu_id', $menuToUpdate);
        $menuToCreate    = array_diff($menuToUpdate, $roleMenuIds->toArray());

        $deletedRoleMenu = $this->deleteRoleMenu($roleId, $menuToDelete);
        $createdRoleMenu = $this->createRoleMenu($roleId, $menuToCreate);
        
        return $createdRoleMenu;
    }

    public function createRoleMenu($roleId, $menuToCreate) {
        $createRoleMenu = true;

        foreach ($menuToCreate as $menu) {
            $createRoleMenu = $this->store([
                'role_id' => $roleId,
                'menu_id' => $menu
            ]);
        }

        return $createRoleMenu;
    }

    public function deleteRoleMenu($roleId, $menuToDelete) {
        $deleteRoleMenu = false;

        foreach ($menuToDelete as $menu) {
            $deleteRoleMenu = $this->where([
                'role_id' => $roleId,
                'menu_id' => $menu['menu_id']
            ])
            ->delete();
        }

        return $deleteRoleMenu;
    }

    public function datatableRoleMenu($request)
    {
        if($request->ajax())
        {
			$sqlRowNum         = $this->getRowNum($request, 'role', 'role_id');
			$permissions       = $this->availablePermission();
            $role  = $this->role->getModel()->select([
                            \DB::raw($sqlRowNum),
                            'role.role_id',
                            'role.name'
                          ]);

        	return \DataTables::of($role)
        			->addColumn('menu', function($role) use($permissions){
			            return $this->appendMenuByRole($role->role_id);
			        })
        			->addColumn('action', function($role) use($permissions){
			            $btn_action = '';

			            if ( in_array("show", $permissions) ) {
			                $btn_action .= '<a title="Show details" href="'. route('role-menu.show', $role->role_id) .'" class="btn cur-p btn-outline-primary btn-datatable"><i class="fa fa-search"></i></a>';
			            }

			            if ( in_array("edit", $permissions) ) {
			                $btn_action .= '<a title="Edit details" href="'. route('role-menu.edit', $role->role_id) .'" class="btn cur-p btn-outline-primary btn-datatable"><i class="fa fa-edit"></i></a>';
			            }


			            return $btn_action;
			        })
			        ->rawColumns(['menu', 'action']) // to html
		            ->make(true);
        }
    }

    public function appendMenuByRole($roleId) {
        $role       = $this->role->show($roleId);
        $menus      = $role->menu;
        $stringMenu = '';

        foreach ($menus as $value) {
            $stringMenu .= '<code>'. $value->name .'</code>&ensp;';
        }
        
        // return \Helper::limitText($stringMenu, 10);
        return $stringMenu;
    }


}