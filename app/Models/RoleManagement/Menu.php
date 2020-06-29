<?php

namespace App\Models\RoleManagement;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Webpatser\Uuid\Uuid;

class Menu extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table      = 'menu';
    protected $primaryKey = 'menu_id';
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
            $model->menu_id = (string) Uuid::generate(4);
        });
    }

	public function datatableColumns()
	{
	    return [
	    		'menu.menu_id',
			    'menu.name',
                'menu.route',
                'menu.id_parent',
                'menu.is_active'
			];
	}

	public function makeColumns($query) {
    	// example
        return $query
	            ->addColumn('parent', function($collection) {
	                $parentMenu = $this->where('menu_id', $collection->id_parent)->first();
	            	
	            	return $parentMenu ? $parentMenu->name : ' - '; 
	            })
	            ->addColumn('status', function($collection) {
	                $aktif = $collection->is_active ?
	                			'<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">Active</span>'
	                			:
	                			'<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">Inactive</span>';

	                return $aktif;
	            });
    }

    public function rawColumns() {
    	return ['parent', 'status'];
    }

    public function timestamps() {
    	return false;
    }

    // get menu parent collection
    public function parentMenu() {
    	return $this->where('menu_id', $this->id_parent)->first();
    }

    // status available for menu
    public function statusList() {
        return ['1' => 'Active', '0' => 'Inactive'];
    }

    // get status name of menu by array status list
    public function statusMenu() {
    	return $this->statusList()[$this->is_active];
    }

}
