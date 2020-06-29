<?php

namespace App\Models\RoleManagement;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Webpatser\Uuid\Uuid;

class MenuPermission extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

	protected $table      = 'menu_permission';
	protected $primaryKey = 'menu_permission_id';
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
            $model->menu_permission_id = (string) Uuid::generate(4);
        });
    }
    
	public function datatableColumns()
	{
	    return [
	    		'menu_permission.menu_permission_id',
			    'menu_permission.nama',
			    'menu_permission.created_at',
			    'menu_permission.updated_at'
			];
	}

	public function datatableButtons()
	{
	    return ['show', 'edit', 'destroy'];
	}

	public function whereRoleMenu($roleId, $menuId) 
	{
		return $this->where(['role_id' => $roleId, 'menuId' => 'menuId'])->with('permission')->first();
	}

	public function permission()
    {
        return $this->hasOne(Permission::class, 'permission_id', 'permission_id');
    }

}
