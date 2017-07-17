<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Gate;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::where('delflag',0)->orderBy('id', 'desc')->get();
        return view('admin.role.index')->withRoles($roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role=new Role();
        return view('admin.role.create',compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'rolename' => 'required|string|max:255|unique:role',
            'rolelabel' => 'required|string|max:255',                        
        ]);

        $role = new Role();
        $role->rolename=$request->rolename;
        $role->rolelabel=$request->rolelabel;
        $role->description= $request->description;
        $role->save();

        return redirect('/admin/role')
                        ->withSuccess("角色 '$role->rolename' 新建成功.");
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
        return view('admin.role.edit', compact('role'));
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
        $this->validate($request, [            
            'rolelabel' => 'required|string|max:255',                        
        ]);
        $role = Role::findOrFail($id);
                
        $this->authorize('modify-role', $role);

        $role->rolelabel=$request->rolelabel;
        $role->description= $request->description;

        $role->save();

        return redirect("/admin/role/$id/edit")
                        ->withSuccess("角色 '$role->rolename' 更新成功.");
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
        $role->delflag=1;
        $role->save();

        return redirect('/admin/role')
                        ->withSuccess("角色 '$role->rolename' .已经被删除.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPermission($id)
    {
        $role = Role::findOrFail($id);
        $rp=$role->permissions;
        $rolePermissions=array();
        foreach ($rp as $permission){
            $pid=$permission->id;
            array_push($rolePermissions,$pid);
        }

        $permissions = Permission::all();

        return view('admin.role.permissions', ['role'=>$role,'rolePermissions'=>$rolePermissions,'permissions'=>$permissions]);
    }


    public function updatePermission(Request $request,$id)
    {
        $role = Role::findOrFail($id);
        $permissionids=$request->permissions;
        $count=0;
        $rolePermissionids=array();
        $role->permissions()->detach();
        if (count($permissionids)>0){
            foreach ($permissionids as $permissionid){
                $role->givePermissionTo(Permission::findOrFail($permissionid));
                $count++;
            }
        }
        return redirect('/admin/role')
                        ->withSuccess("角色 '$role->rolename' .权限更改成功！");

    }
}
