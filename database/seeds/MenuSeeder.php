<?php

use Illuminate\Database\Seeder;
use App\Models\RoleManagement\{ Menu };

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        // first menu created will be used for redirect after login so make sure url for this route used in \App\Providers\RouteServiceProvider
        $dashboard = Menu::create([
            'name'       => 'Dashboard',
            'icon'       => 'fas fa-home',
            'route'      => 'dashboard',
            'order'      => 1,
            'created_at' => $now,
            'updated_at' => $now
        ]);

        $roleManagement = Menu::create([
            'name'       => 'Role Management',
            'icon'       => 'fas fa-user-cog',
            'order'      => 2,
            'created_at' => $now,
            'updated_at' => $now
        ]);

        $master = Menu::create([
            'name'       => 'Master',
            'id_parent'  => $roleManagement->menu_id,
            'order'      => 1,
            'created_at' => $now,
            'updated_at' => $now
        ]);

        $role = Menu::create([
            'name'       => 'Role',
            'route'      => 'role',
            'id_parent'  => $master->menu_id,
            'order'      => 1,
            'created_at' => $now,
            'updated_at' => $now
        ]);

        $menu = Menu::create([
            'name'       => 'Menu',
            'route'      => 'menu',
            'id_parent'  => $master->menu_id,
            'order'      => 2,
            'created_at' => $now,
            'updated_at' => $now
        ]);

        $permission = Menu::create([
            'name'       => 'Permission',
            'route'      => 'permission',
            'id_parent'  => $master->menu_id,
            'order'      => 3,
            'created_at' => $now,
            'updated_at' => $now
        ]);

        $roleMenu = Menu::create([
            'name'       => 'Role Menu',
            'route'      => 'role-menu',
            'id_parent'  => $roleManagement->menu_id,
            'order'      => 2,
            'created_at' => $now,
            'updated_at' => $now
        ]);

        $menuPermission = Menu::create([
            'name'       => 'Menu Permission',
            'route'      => 'menu-permission',
            'id_parent'  => $roleManagement->menu_id,
            'order'      => 3,
            'created_at' => $now,
            'updated_at' => $now
        ]);

        $user = Menu::create([
            'name'       => 'User',
            'route'      => 'user',
            'id_parent'  => $roleManagement->menu_id,
            'order'      => 4,
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
