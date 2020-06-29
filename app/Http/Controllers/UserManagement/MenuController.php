<?php

namespace App\Http\Controllers\UserManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\{ MenuRepository };
use App\Http\Requests\MenuRequest;

class MenuController extends Controller
{
    protected $menuRepo;
    
    public function __construct(MenuRepository $menuRepo)
    {
        $this->menuRepo = $menuRepo;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('role_management.menu_index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menuList   = $this->menuRepo->menuList();
        $statusList = $this->menuRepo->getModel()->statusList();

        return view ('role_management.menu_create', compact('menuList', 'statusList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        $store = $this->menuRepo->storeMenu($request->all());

        return redirect()->route('menu.index')->with(\Helper::alertStatus('store', $store));
    }

    /**
     * Display the specified resource.
     *
     * @param  int 
     * @return \Illuminate\Http\Response
     */
    public function show($menuId)
    {
        $menu          = $this->menuRepo->show($menuId);
        $statusList    = $this->menuRepo->getModel()->statusList();

        return view('role_management.menu_show', compact('menu', 'statusList'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int
     * @return \Illuminate\Http\Response
     */
    public function edit($menuId)
    {
        $menu       = $this->menuRepo->show($menuId);
        $menuList   = $this->menuRepo->menuList();
        $statusList = $this->menuRepo->getModel()->statusList();

        return view('role_management.menu_edit', compact('menu', 'menuList', 'statusList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int 
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, $menuId)
    {
        $update = $this->menuRepo->updateMenu( $request->all(), $menuId );

        return redirect()->route('menu.index')->with(\Helper::alertStatus('update', $update));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       return $this->menuRepo->delete($id);
    }

    /**
    * Showing list bank by datatable
    * @param $request ajax
    * @return json
    */
    public function ajaxDatatable(Request $request)
    {
        return $this->menuRepo->makeDatatable($request);
    }
}
