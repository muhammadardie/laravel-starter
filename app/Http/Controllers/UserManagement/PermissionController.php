<?php

namespace App\Http\Controllers\UserManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\{ PermissionRepository };
use App\Http\Requests\PermissionRequest;

class PermissionController extends Controller
{
    protected $permissionRepo;
        
    public function __construct(PermissionRepository $permissionRepo)
    {
        $this->permissionRepo = $permissionRepo;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('role_management.permission_index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('role_management.permission_create', compact('permissionStructure', 'statusList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $store = $this->permissionRepo->store($request->all());

        return redirect()->route('permission.index')->with(\Helper::alertStatus('store', $store));
    }

    /**
     * Display the specified resource.
     *
     * @param  int 
     * @return \Illuminate\Http\Response
     */
    public function show($permissionId)
    {
        $permission = $this->permissionRepo->show($permissionId);

        return view('role_management.permission_show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int
     * @return \Illuminate\Http\Response
     */
    public function edit($permissionId)
    {
        $permission = $this->permissionRepo->show($permissionId);

        return view('role_management.permission_edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int 
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, $permissionId)
    {
        $update = $this->permissionRepo->update( $request->all(), $permissionId );

        return redirect()->route('permission.index')->with(\Helper::alertStatus('update', $update));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       return $this->permissionRepo->delete($id);
    }

    /**
    * Showing list bank by datatable
    * @param $request ajax
    * @return json
    */
    public function ajaxDatatable(Request $request)
    {
        return $this->permissionRepo->makeDatatable($request);
    }
}
