<?php

namespace App\Models\RoleManagement;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Webpatser\Uuid\Uuid;

class UserRole extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

	protected $table      = 'user_role';
	protected $primaryKey = 'user_role_id';
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
            $model->user_role_id = (string) Uuid::generate(4);
        });
    }

	public function datatableColumns()
	{
	    return [
	    		'user_role.user_role_id',
			    'user_role.nama',
			    'user_role.created_at',
			    'user_role.updated_at'
			];
	}

	public function datatableButtons()
	{
	    return ['show', 'edit', 'destroy'];
	}

}
