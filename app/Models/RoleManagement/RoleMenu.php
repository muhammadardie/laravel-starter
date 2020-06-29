<?php

namespace App\Models\RoleManagement;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Webpatser\Uuid\Uuid;

class RoleMenu extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table      = 'role_menu';
    protected $primaryKey = 'role_menu_id';
    protected $keyType    = 'string';
    protected $guarded    = [];
    public $incrementing  = false;
    public $timestamps    = false;

    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->role_menu_id = (string) Uuid::generate(4);
        });
    }

    /**
     * Get menu record associated with the role.
     */
    public function menu($roleId)
    {
        return $this->hasMany(Menu::class, 'menu_id', 'menu_id');
    }

    public function permission()
    {
        return $this->hasManyThrough(
            Permission::class,
            MenuPermission::class,
            'role_menu_id',
            'permission_id',
            'role_menu_id',
            'permission_id'
        );
    }

    /**
     * Get permissions record associated with the role.
     */
    public function menuPermissions()
    {
        return $this->hasMany(MenuPermission::class, 'role_menu_id', 'role_menu_id');
    }
}
