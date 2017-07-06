<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    //角色视图
    public function roleList()
    {
        $roles = Role::paginate(5);
        foreach ($roles as $role) {
            $perms = array();
            foreach ($role->perms as $perm) {
                $perms[] = $perm->display_name;
            }
            $role->perms= implode(',', $perms);
        }
        return view('/admin/user/roleList',compact('roles'));
    }
    //添加角色
    public function roleAdd(Request $request)
    {
        if ($request->isMethod('post')) {
            $role = Role::create($request->all());
            return redirect('admin/role-list');
        }
        return view('/admin/user/roleAdd');
    }
    //角色分配权限
    public function attachPermission(Request $request,$role_id)
    {
        if ($request->isMethod('post')) {
            //获取当前用户的角色
            $role = Role::find($role_id);
            //先将所以的权限删除
            DB::table('permission_role')->where('role_id', $role_id)->delete();
            //重新分配权限
            foreach ($request->input('permission_id') as $permission_id){
                $role->attachPermission(Permission::find($permission_id));
            }
            return redirect('admin/role-list');
        }
        $permissions = Permission::all();
        return view('/admin/user/attachPermission')->with(['role_id'=>$role_id,'permissions'=>$permissions]);
    }
    //修改角色
    public function roleUpdate(Request $request,$role_id)
    {
        if($request->isMethod('post')) {
            $res = $request->except(['_token','id']);
            $result = Role::where('id',$request->role_id)->update($res);
            return redirect('admin/role-list');
        }
        $roles = Role::where('id',$role_id)->first();
        return view('/admin/user/roleUpdate',compact('roles'));
    }

    //删除角色
    public function roleDel($role_id)
    {
        $res = Role::find($role_id);
        $r = $res->delete();
        return redirect('admin/role-list');
    }
}
