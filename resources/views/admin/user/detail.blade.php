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
        <i class="fa fa-home"></i> <a href="{{url('/admin/index')}}">首页</a> &raquo; <a href="{{url('/admin/user/list/')}}">用户列表</a> &raquo; 用户详情
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
        <form action="" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th><i class="require">*</i>头像：</th>
                    <td>
                        <img src="{{url($user['icon'])}}" width='40px' style="border-radius: 100%" >
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>用户名：</th>
                    <td>
                        <p>{{$user['userName']}}</p>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>手机号：</th>
                    <td>
                        <p>{{$user['phone']}}</p>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>邮箱：</th>
                    <td>
                        <p>{{$user['email']}}</p>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>性别：</th>
                    <td>
                        <p>{{$user['sex']== 0 ? '男' : '女'}}</p>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>地址：</th>
                    <td>
                        <p>{{$user['city']}}</p>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>状态：</th>
                    <td>
                        <p>{{$user['status'] == 0 ? '禁用' : '激活'}}</p>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>登录状态：</th>
                    <td>
                        <p>{{$user['reg_status'] == 0 ? '下线' : '上线'}}</p>
                    </td>
                </tr>
                <tr>
                    <th>描述：</th>
                    <td>
                        <p>{{$user['desc']}}</p>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <input type="submit" value="提交">
                        <input type="button" class="back" onclick="history.go(-1)" value="返回">
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
@endsection