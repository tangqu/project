@extends('app')
@section('my-css')
    <style>
        input{
            line-height: 20px;
        }
    </style>
@endsection
@section('content')

    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('/admin/index')}}">首页</a> &raquo; <a href="{{url('/admin/user/list/')}}">用户列表</a> &raquo; 添加用户
    </div>
    <!--面包屑导航 结束-->

    <!--结果集标题与导航组件 开始-->
    <div class="result_wrap">
        <div class="result_content">
            <div class="short_wrap">
                <a href="#"><i class="fa fa-plus"></i>新增文章</a>
                <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->

    <div class="result_wrap">
        <form action="{{url('/admin/user/doAdd')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th><i class="require">*</i>头像：</th>
                    <td>
                        <input type="file" class="mg" name="icon" >
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>用户名：</th>
                    <td>
                        <input type="text" class="mg" name="userName" id="userName" value="" style="margin-top: 5px;float: left">
                        <span id="user_name" style="display:none;float: left;color:deeppink">用户名不能为空</span>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>密码：</th>
                    <td>
                        <input type="password" class="mg" name="password" id="password" value="" style="margin-top: 5px;float: left">
                        <span id="user_pass" style="display:none;float: left;color:deeppink">密码不能为空</span>
                </tr>
                <tr>
                    <th><i class="require">*</i>手机号：</th>
                    <td>
                        <input type="text" class="mg" name="phone" id="phone" value="" style="margin-top: 5px;float: left">
                        <span id="phone1" style="display:none;float: left;color:deeppink">手机格式不正确</span>
                        <span id="phone2" style="display:none;float: left;color:green">手机格式正确</span>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>性别：</th>
                    <td>
                        <label><input type="radio" name="sex" value="0" checked>男</label>
                        <label><input type="radio" name="sex" value="1">女</label>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>email：</th>
                    <td>
                        <input type="text" class="mg" name="email" id="email" value="" style="margin-top: 5px;float: left" >
                        <span id="pass1" style="display:none;float: left;color:deeppink">邮箱格式不正确</span>
                        <span id="pass2" style="display:none;float: left;color:green">邮箱格式正确</span>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>状态：</th>
                    <td>
                        <label><input type="radio" name="status" value="0" checked>禁用</label>
                        <label><input type="radio" name="status" value="1">激活</label>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>登录状态：</th>
                    <td>
                        <label><input type="radio" name="reg_status" value="0" checked>下线</label>
                        <label><input type="radio" name="reg_status" value="1">在线</label>
                    </td>
                </tr>
                <tr>
                    <th>描述：</th>
                    <td>
                        <textarea name="desc"></textarea>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <input id="btn" type="submit" value="提交">
                        <input type="button" class="back" onclick="history.go(-1)" value="返回">
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
@endsection
@section('my-js')
    <script>
        {{--用户名--}}
            $("input[name='userName']").blur(function () {
                $.post('/admin/user/userName',{'_token':'{{csrf_token()}}','userName': $("#userName").val()},function(data)
                {
                    if(data == 1){
                        $('#user_name').css('display','block');
                        $("input[name='userName']").focus(function () {
                            $("user_name").css("display","none");
                        })
                    }else {
                        $('#user_name').css('display','none');
                    }
                });
            });
        {{--密码--}}
          $("input[name='password']").blur(function () {
                $.post('/admin/user/password',{'_token':'{{csrf_token()}}','password': $("#password").val()},function(data)
                {
                    if(data == 1){
                        $('#user_pass').css('display','block');
                        $("input[name='password']").focus(function () {
                            $("user_pass").css("display","none");
                        })
                    }else {
                        $('#user_pass').css('display','none');
                    }
                });
            })
        {{--手机号--}}
            $("input[name='phone']").blur(function () {
                    $.post('/admin/user/phone',{'_token':'{{csrf_token()}}','phone': $("#phone").val()},function(data)
                    {
                        if(data == 2)
                        {
                            $("#phone1").css("display","block");
                            $("input[name='phone']").on('focus',function(){
                                $("#phone1").css("display","none");
                            });
                        }else if(data == 1){
                            $("#phone2").css("display","block");
                            $("input[name='phone']").on('focus',function(){
                                $("#phone2").css("display","none");
                            });
                        }
                    });
                })
        {{--邮箱--}}
          $("input[name='email']").blur(function () {
                    $.post('/admin/user/email',{'_token':'{{csrf_token()}}','email': $("#email").val()},function(data)
                    {
                        if(data == 2)
                        {
                            $("#pass1").css("display","block");
                            $("input[name='email']").on('focus',function(){
                                $("#pass1").css("display","none");
                            });
                        }else if(data == 1){
                            $("#pass2").css("display","block");
                            $("input[name='email']").on('focus',function(){
                                $("#pass2").css("display","none");
                            });
                        }
                    });
                })

    </script>
@endsection