<?php

namespace App\Models\RoleManagement;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;
use Webpatser\Uuid\Uuid;

class User extends Authenticatable implements Auditable
{
    use Notifiable;
    use \OwenIt\Auditing\Auditable;

    protected $table      = 'user';
    protected $primaryKey = 'user_id';
    protected $keyType    = 'string';
    protected $guarded    = [];
    public $incrementing  = false;
    
    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->user_id = (string) Uuid::generate(4);
        });
    }

    /**
     * Get user role record associated with the user.
     */
    public function userRole()
    {
        return $this->hasOne(UserRole::class, 'user_id', 'user_id');
    }

    /**
     * Get role record associated with the user.
     */
    public function role()
    {
        return $this->hasOneThrough(
        	Role::class,
            UserRole::class,
            'user_id', // Foreign key on user_role table...
            'role_id', // Foreign key on role table...
            'user_id', // Local key on user table...
            'role_id' // Local key on user_role table...
        );
    }


    public function datatableColumns()
    {
        return [
                'user.user_id',
                'user.username',
                'user.email',
                'user.created_at',
                'user.updated_at'
            ];
    }
}
