<?php

namespace App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\RoleDataTable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{

       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RoleDataTable $dataTable)
    {
        return $dataTable->render('admin.roles.index' , ['title' => trans('admin/roles/index.title'),]);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Role $model)
    {
         $permission = Permission::get();
        return view('admin.roles.create' , ['title' => trans('admin/roles/create.title')], compact('model','permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'name' => 'required|unique:roles,name',
            'permission'=>'required'
            
        ];
        $messages = [
            'name.required' => trans('admin/roles/create.text_name_required'),
            'permission.required'=>trans('admin/roles/create.text_permission_required'),
            
        ];
        $this->validate($request,$data,$messages);
        
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
        session()->flash('success',trans('admin/roles/messages.text_create_success'));
        return redirect(adminUrl('role'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role= Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
        ->where("role_has_permissions.role_id",$id)->get();
        
        return view('admin.roles.show',compact('role','rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id') ->all();

        return view('admin.roles.edit',  ['title' => trans('admin/roles/edit.title')], compact('role' , 'permission', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = [
            'name' => 'required|unique:roles,name,'.$id,
            'permission'=>'required'
            
        ];
        $messages = [
            'name.required' => trans('admin/roles/create.text_name_required'),
            'permission.required'=>trans('admin/roles/create.text_permission_required')
            
        ];
        
        $this->validate($request,$data,$messages);
        $role = Role::findOrFail($id);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));
        session()->flash('success',trans('admin/roles/messages.text_edit_success'));
        return redirect(adminUrl('role'));

        
        

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $role = Role::findOrFail($id);
      $role->delete();

       session()->flash('success',trans('admin/roles/messages.text_deleted_success'));
        
        return back();

    }

    public function multiDelete()
    {
        if(is_array(request('item')))
        {
            Role::destroy(request('item'));
        }else
        {
            Role::find(request('item'))->delete();
        }
        session()->flash('success',trans('admin/roles/messages.text_deleted_success'));
        return redirect(adminUrl('role'));
    }
}