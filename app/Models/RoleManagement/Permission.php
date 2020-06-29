<?php

namespace App\Models\RoleManagement;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Webpatser\Uuid\Uuid;

class Permission extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

	protected $table      = 'permission';
	protected $primaryKey = 'permission_id';
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
            $model->permission_id = (string) Uuid::generate(4);
        });
    }
    
	public function datatableColumns()
	{
	    return [
	    		'permission.permission_id',
			    'permission.name',
			    'permission.action AS permission_action', // prevent conflict same name with action
			    'permission.created_at',
			    'permission.updated_at'
			];
	}

}
