<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
}
