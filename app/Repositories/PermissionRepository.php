<?php

namespace App\Repositories;

use App\Models\RoleManagement\Permission;

class PermissionRepository extends BaseRepository
{
    public function __construct(Permission $permission)
    {
        $this->model = $permission;
    }

}