<?php

namespace App\Http\Controllers\UserManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\{ RoleRepository };
use App\Http\Requests\RoleRequest;

class RoleController extends Controller
{
    protected $roleRepo;
        
    public function __construct(RoleRepository $roleRepo)
    {
        $this->roleRepo = $roleRepo;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('role_management.role_index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('role_management.role_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $store = $this->roleRepo->store($request->all());

        return redirect()->route('role.index')->with(\Helper::alertStatus('store', $store));
    }

    /**
     * Display the specified resource.
     *
     * @param  int 
     * @return \Illuminate\Http\Response
     */
    public function show($roleId)
    {
        $role = $this->roleRepo->show($roleId);

        return view('role_management.role_show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int
     * @return \Illuminate\Http\Response
     */
    public function edit($roleId)
    {
        $role = $this->roleRepo->show($roleId);

        return view('role_management.role_edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int 
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $roleId)
    {
        $update = $this->roleRepo->update( $request->all(), $roleId );

        return redirect()->route('role.index')->with(\Helper::alertStatus('update', $update));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       return $this->roleRepo->delete($id);
    }

    /**
    * Showing list bank by datatable
    * @param $request ajax
    * @return json
    */
    public function ajaxDatatable(Request $request)
    {
        return $this->roleRepo->makeDatatable($request);
    }
}
