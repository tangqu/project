<?php

namespace App\Http\Controllers\Home;



use App\Models\zgz_code;
use App\Models\zgz_user;
use App\Tool\SMS\SendTemplateSMS;
use Illuminate\Http\Request;
use App\Http\Requests\RegRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //个人中心控制器
    public function perCenter ()
    {
        return view('home.user.personal');
    }

    //用户注册跳转方法
    public function regForm ()
    {
        return view('home.user.reg');
    }

    //判断注册用户手机号信息
    public function regPhone (Request $request)
    {
        $user = zgz_user::where('phone',$request->phone)->first();
        //find($request->phone,['name']);
        if($user){
            echo false;
        }else {
            echo true;
        }

    }

    //判断注册用户名信息
    public function regName (Request $request)
    {
        $userName = zgz_user::where('userName',$request->name)->first();
        if($userName){
            echo false;
        }else {
            echo true;
        }
    }

    //创建用户
    public function doReg (Request $request)
    {
        $res = zgz_code::where('phone',$request->phone)->first(['code','deadtime']);
        if($res){
            $code = $res->code;
            $deadtime = $res->deadtime;
        } else {
            $code = '';
            $deadtime = '';
        }
        if($request->phoneCode == $code && $deadtime>time() ){
            zgz_user::create($request->all());
            return redirect('/');
        } else {
            return back();
        }

    }

    //发送手机验证码
    public function sendSms (Request $request)
    {
        $code = $this->getCode();
        //实例化SendTemplateSMS类
        $sms = new SendTemplateSMS();

        //调用SendTemplateSMS下的方法
        $result = $sms->send($request->phone,array($code,5),1);

        if ($result->status == 0) {
            $res =  zgz_code::where('phone',$request->phone)->first(['deadtime']);
            $res ? $time = time()-$res->deadtime: $time = 0;
            $data=[
                'phone'=>$request->phone,
                'code'=>$code,
                'deadtime'=>time()+300
            ];

            if($res && $time>120){
                zgz_code::where('phone',$request->phone)->update($data);
            } else if ($res == null) {
                zgz_code::create($data);
            }
        }
        return $result->toJson();
    }
    //获取手机验证码
    public function getCode()
    {
        $charset='0123456789';
        $pos = strlen($charset) - 1;
        $code = '';
        for ($i = 0; $i < 4; $i ++) {
            $code .= $charset[mt_rand(0,$pos)];
        }

        return $code;
    }

    //用户登录跳转方法
    public function loginForm ()
    {
        return view('home.user.login');
    }

    //登录验证码判断
    public function loginCode (Request $request)
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


    //接收登录注册信息
    public function doLogin (Request $request)
    {
        if (Auth::attempt(['userName'=>$request->userName,'password'=>$request->password])){
            return redirect('/');
        } else {
            return back();
        }
    }

    //退出登录
    public function logout ()
    {
        Auth::logout();
        return redirect('/');
    }

    public function index()
    {
        echo 1;
    }
}
