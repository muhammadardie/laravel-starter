<?php

use Illuminate\Database\Seeder;
use App\Models\RoleManagement\{ Permission };

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Permission::create([
			'name'        => 'Index page',
			'action'      => 'index',
			'description' => 'Page for display data in table',
			'created_at'  => date('Y-m-d H:i:s'),
			'updated_at'  => date('Y-m-d H:i:s')
        ]);

        Permission::create([
			'name'        => 'Detail Page',
			'action'      => 'show',
			'description' => 'Page for display detail data',
			'created_at'  => date('Y-m-d H:i:s'),
			'updated_at'  => date('Y-m-d H:i:s')
        ]);

    	Permission::create([
			'name'        => 'New data page',
			'action'      => 'create',
			'description' => 'Page for display form for create new data',
			'created_at'  => date('Y-m-d H:i:s'),
			'updated_at'  => date('Y-m-d H:i:s')
        ]);

        Permission::create([
			'name'        => 'Edit page',
			'action'      => 'edit',
			'description' => 'Page for display form for edit existing data',
			'created_at'  => date('Y-m-d H:i:s'),
			'updated_at'  => date('Y-m-d H:i:s')
        ]);

        Permission::create([
			'name'        => 'Store data',
			'action'      => 'store',
			'description' => 'Action to store new data',
			'created_at'  => date('Y-m-d H:i:s'),
			'updated_at'  => date('Y-m-d H:i:s')
        ]);

        Permission::create([
			'name'        => 'Update data',
			'action'      => 'update',
			'description' => 'Action to update existing data',
			'created_at'  => date('Y-m-d H:i:s'),
			'updated_at'  => date('Y-m-d H:i:s')
        ]);

        Permission::create([
			'name'        => 'Delete data',
			'action'      => 'destroy',
			'description' => 'Action to delete data',
			'created_at'  => date('Y-m-d H:i:s'),
			'updated_at'  => date('Y-m-d H:i:s')
        ]);
    }
}
