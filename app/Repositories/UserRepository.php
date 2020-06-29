<?php

namespace App\Repositories;

use App\Models\RoleManagement\User;
use App\Repositories\{ RoleRepository, UserRoleRepository };

class UserRepository extends BaseRepository
{
    public function __construct(User $user, RoleRepository $role, UserRoleRepository $userRole)
    {
        $this->model    = $user;
        $this->role     = $role;
        $this->userRole = $userRole;
    }

    public function storeUser($request)
    {
        $recordCreated       = true;
        $storeImage          = true;
        $request['password'] = bcrypt($request['password']);

        $user     = $this->store($request->except(['role', 'password_confirmation']), $storeImage, $recordCreated);
        $userRole = $this->userRole->store([
                        'user_id' => $user->user_id, 
                        'role_id' => $request->role
                    ]);

        return $userRole;
    }

    public function updateUser($request, $userId)
    {
        $recordUpdated = true;
        $updateImage   = true;
        $role          = $this->role->show($request->role);
        
        if($request['password'] == ''){
            unset($request['password']);
        } else {
            $request['password'] = bcrypt($request['password']);
        }

        $user     = $this->update($request->except(['role', 'password_confirmation']), $userId, $updateImage, $recordUpdated);

        $userRole = $this->userRole->update(['role_id' => $request->role], $user->userRole->user_role_id);

        return $userRole;
    }

    public function deleteUSer($userId)
    {
        $fileName    = $this->show($userId)->photo;
        $deleteImage = $this->deleteFile('user/' . $fileName);

        return $this->delete($userId);
    }

}