<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //后台管理员登录
    public function login ()
    {
        return view('admin.login');
    }

    //判断登录验证码
    public function doCode (Request $request)
    {
        $rule = array(
            'code' => 'required|captcha',
        );
        $message = array(
            'code.required' => '验证码为空',
            'code.captcha' => '验证码错误'
        );
        $this->validate($request, $rule, $message);
    }

    //后台页面登录判断
    public function doLogin(Request $request)
    {

        if (Auth::guard('admin')->attempt(['mangerName' => $request->mangerName, 'password' => $request->password])){
            return redirect('/admin/index');
        } else {
            return back();
        }
    }

    //进入后台首页
    public function index()
    {
    	return view('admin.index');
    }

    //跳转修改管理员密码页面
    public function editPass()
    {
    	return view('admin.pass');
    }

    //修改管理员密码
    public function doPass(Request $request)
    {
        //修改密码未与第二次修改的密码比对
       $beforePass = Admin::where('id',$request->id)->first();
       if(!Hash::check($request->password_o,$beforePass->password)){
            return back();
       }
        Admin::where('id',$request->id)->update(['password'=>Hash::make($request->password)]);

        return redirect('/admin/user/list');
    }

    //管理员退出
    public function logout()
    {
        return redirect('/admin/login');
    }
     //管理员视图
    public function userList()
    {
        $users = Admin::paginate(5);

        foreach ($users as $user) {
            $roles = array();
            //得到所以的角色的名称
            foreach ($user->roles as $role) {
                $roles[] = $role->display_name;
            }
            //转为以逗号分割字符串
            $user->roles= implode(',', $roles);
        }
        //加载视图
        return view('/admin/user/userList',compact('users'));
    }

    //添加管理员
    public function userAdd(Request $request)
    {
        if ($request->isMethod('post')) {
            //添加信息到user表
            Admin::create($request->all());
            return redirect('admin/user-list');
        }
        return view('/admin/user/userAdd');
    }

    //分配角色
    public function attachRole(Request $request,$manger_id)
    {
        if ($request->isMethod('post')) {
            //获取当前用户的角色
            $user = Admin::find($manger_id);
            //先将所以的权限删除
            DB::table('role_manger')->where('manger_id', $manger_id)->delete();
            //重新分配角色
            foreach ($request->input('role_id') as $role_id){
                $user->attachRole(Role::find($role_id));
            }
            return redirect('admin/user-list');
        }
        $roles = Role::all();
        return view('/admin/user/attachRole',compact('roles'))->with(['roles'=>$roles,'manger_id'=>$manger_id]);
    }

    //修改角色
    public function userUpdate(Request $request,$user_id)
    {
        if($request->isMethod('post')) {
            $res = $request->except(['_token','id']);
            $result = Admin::where('id',$request->user_id)->update($res);
            return redirect('admin/user-list');
        }
        $users = Admin::where('id',$user_id)->first();
        return view('/admin/user/userUpdate',compact('users'));
    }

    //重置密码
    public function userReset($user_id)
    {
        Admin::where('id',$user_id)->update(['password'=>Hash::make('123456')]);
        return redirect('admin/user-list');
    }

    //删除管理员
    public function userDel($user_id)
    {
        Admin::destroy([$user_id]);
        return redirect('admin/user-list');
    }
}
