<?php

namespace App\Traits;

use App\Models\RoleManagement\{ RoleMenu, MenuPermission };

trait MenuPermissionTrait
{

    public function availablePermission() {
        // get role menu by role user and current menu
        $roleMenu = RoleMenu::where('role_id', \Auth::user()->role->role_id)
                            ->where('menu_id', $this->currentMenu()->menu_id)
                            ->first();

        $permissions = MenuPermission::where('role_menu_id', $roleMenu->role_menu_id)
                            ->with('permission')
                            ->get();
                            
        return $this->permissionOnly($permissions);
    }

    public function permissionOnly($permissions) {
        $permissionList = [];

        foreach ($permissions as $permission) {
            array_push($permissionList, $permission->permission->action);    
        }

        return $permissionList;
    }

    public function userMenu() {
        return \Auth::user()->role->menu; 
    }

    public function currentRoute($param) {
        $route  = \Request::route()->getName();
        $routes = explode('.', $route);
        $currentRoute = collect();
        $currentRoute->put('route', $routes[0]);
        $currentRoute->put('action', ( empty($routes[1]) ? '' : $routes[1] ) );
        $currentRoute->put('full', $route);

        return $currentRoute[$param];
    }

    public function currentMenu() {
        return $this->userMenu()->where('route', $this->currentRoute('route'))->first();
    }

    /*
    * -- parent
    * ---- menu
    * ------ submenu
    */
    public function menuSidebar()
    {
        $arrangedMenu  = [];
        $parents       = $this->userMenu()->sortBy('order')->whereNull('id_parent');

        foreach ($parents as $parent) {
            $arrParent            = [];
            $arrParent['menu_id'] = $parent->menu_id;
            $arrParent['name']    = $parent->name;
            $arrParent['route']   = $parent->route;
            $arrParent['icon']    = $parent->icon;
            $arrParent['active']  = $this->currentRoute('route') === $parent->route;
            $arrParent['menu']    = [];

            $menus = $this->userMenu()->sortBy('order')->where('id_parent', $parent->menu_id);

            foreach ($menus as $menu) {
                $arrMenu            = [];
                $arrMenu['menu_id'] = $menu->menu_id;
                $arrMenu['name']    = $menu->name;
                $arrMenu['route']   = $menu->route;
                $arrMenu['icon']    = $menu->icon;
                $arrMenu['active']  = false;
                // set active menu from parent until menu when menu active
                if($this->currentRoute('route') === $menu->route) {
                    $arrMenu['active']    = true;
                    $arrParent['active']  = true;
                }

                $arrMenu['submenu'] = [];

                $submenus = $this->userMenu()->sortBy('order')->where('id_parent', $menu->menu_id);

                foreach ($submenus as $submenu) {
                    $arrSubmenu            = [];
                    $arrSubmenu['menu_id'] = $submenu->menu_id;
                    $arrSubmenu['name']    = $submenu->name;
                    $arrSubmenu['route']   = $submenu->route;
                    $arrSubmenu['icon']    = $submenu->icon;
                    $arrSubmenu['active']  = false; 
                    // set active menu from parent until submenu when submenu active
                    if($this->currentRoute('route') === $submenu->route) {
                        $arrMenu['active']    = true;
                        $arrParent['active']  = true;
                        $arrSubmenu['active'] = true;   
                    }

                    array_push($arrMenu['submenu'], $arrSubmenu);
                }
                
                array_push($arrParent['menu'], $arrMenu);
            }
            
            array_push($arrangedMenu, $arrParent);
        }

        return $arrangedMenu;
    }

}