<?php

namespace App\Repositories;

use App\Models\RoleManagement\Role;

class RoleRepository extends BaseRepository
{
    public function __construct(Role $role)
    {
        $this->model = $role;
    }

}