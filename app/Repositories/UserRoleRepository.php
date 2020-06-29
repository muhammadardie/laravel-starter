<?php

namespace App\Repositories;

use App\Models\RoleManagement\UserRole;

class UserRoleRepository extends BaseRepository
{
    public function __construct(UserRole $userRole)
    {
        $this->model = $userRole;
    }

}