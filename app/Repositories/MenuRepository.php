<?php

namespace App\Repositories;

use App\Models\RoleManagement\Menu;
use App\Repositories\RoleRepository;

class MenuRepository extends BaseRepository
{
    public function __construct(Menu $menu, RoleRepository $role)
    {
        $this->model       = $menu;
        $this->role        = $role;
    }
    
    public function menuList() {
    	$menuStructure = collect([ 0 => '• root menu •']);

    	$parents = $this->model->getModel()->whereNull('id_parent')->get();
        
    	foreach ($parents as $parent) {
    		$menuStructure->put($parent->menu_id, $parent->name);

    		$childs = $this->model->getModel()->where('id_parent', $parent->menu_id)->get();

    		foreach ($childs as $child) {
    			$menuStructure->put($child->menu_id, '&emsp;'. $child->name);
    		}
    	}

    	return $menuStructure;
    }

    public function allMenu() {
        $menuStructure = collect([ 0 => '• root menu •']);

        $parents = $this->model->getModel()->whereNull('id_parent')->get();

        foreach ($parents as $parent) {
            $menuStructure->put($parent->menu_id, $parent->name);

            $childs = $this->model->getModel()->where('id_parent', $parent->menu_id)->get();

            foreach ($childs as $child) {
                $menuStructure->put($child->menu_id, '&emsp;'. $child->name);
            }
        }

        return $menuStructure;
    }

    public function storeMenu($request) {
        $request['id_parent'] = $request['id_parent'] === "0" ? null : $request['id_parent'];
        $higherOrder = $this->reorderMenu($request);

        return $this->store($request);
    }

    public function updateMenu($request, $menuId) {
        $request['id_parent'] = $request['id_parent'] === "0" ? null : $request['id_parent'];
        $higherOrder = $this->reorderMenu($request);

        return $this->update($request, $menuId);
    }

    public function reorderMenu($request) {
        $higherOrder  = false;
        $higherOrders = $this->model
                            ->getModel()
                            ->where('id_parent', $request['id_parent'])
                            ->where('order', '>=', $request['order'])
                            ->get();

        foreach ($higherOrders as $higherOrder) {
            $newOrder = $higherOrder->order + 1;
            $higherOrder->update(['order' => $newOrder]);
        }

        return $higherOrder;
    }

}