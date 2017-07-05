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
        <i class="fa fa-home"></i> <a href="{{url('/admin/index')}}">首页</a> &raquo; <a href="{{url('/admin/user/list/')}}">用户列表</a> &raquo; 修改用户
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
        <form action="{{url('/admin/user/doUpadte')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th><i class="require">*</i>修改头像：</th>
                    <td>
                        <input type="hidden" name="id" value="{{$user['id']}}">
                        <input type="file" class="mg" name="icon" >
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>用户名：</th>
                    <td>
                        <input type="text" class="mg" name="userName" value="{{$user['userName']}}">
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>手机号：</th>
                    <td>
                        <input type="text" class="mg" name="phone" value="{{$user['phone']}}">
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>email：</th>
                    <td>
                        <input type="email" class="mg" name="email" value="{{$user['email']}}">
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
                        <input type="submit" value="提交">
                        <input type="button" class="back" onclick="history.go(-1)" value="返回">
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
@endsection