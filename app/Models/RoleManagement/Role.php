<?php

namespace App\Models\RoleManagement;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use OwenIt\Auditing\Contracts\Auditable;

class Role extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table      = 'role';
    protected $primaryKey = 'role_id';
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
            $model->role_id = (string) Uuid::generate(4);
        });
    }

	public function datatableColumns()
	{
	    return [
	    		'role.role_id',
			    'role.name',
			    'role.description'
			];
	}

    public function timestamps() {
        return false;
    }
    
    /**
     * Get menu record associated with the role.
     */
    public function menuPermissions()
    {
        return $this->hasManyThrough(
            MenuPermission::class,
            RoleMenu::class,
            'role_id', // Foreign key on user_role table...
            'role_menu_id', // Foreign key on role table...
            'role_id', // Local key on user table...
            'role_menu_id' // Local key on user_role table...
        );
    }

	/**
     * Get menu record associated with the role.
     */
    public function menu()
    {
        return $this->hasManyThrough(
        	Menu::class,
            RoleMenu::class,
            'role_id', // Foreign key on user_role table...
            'menu_id', // Foreign key on role table...
            'role_id', // Local key on user table...
            'menu_id' // Local key on user_role table...
        )
        ->where('menu.is_active', TRUE);
    }

}
