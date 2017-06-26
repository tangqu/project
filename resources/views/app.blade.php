<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/admin/ch-ui.admin.css">
    <link rel="stylesheet" href="/css/admin/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/css/com/bootstrap.min.css">
    <script type="text/javascript" src="/js/com/jquery.min.js"></script>
    <script type="text/javascript" src="/js/com/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/admin/ch-ui.admin.js"></script>
    @yield('my-css')
</head>
<body>
<!--头部 开始-->
<div class="top_box">
    <div class="top_left">
        <div class="logo">后台管理模板</div>
        <ul>
            <li><a href="{{url('/admin/index')}}" class="active">首页</a></li>
            <li><a href="#">管理页</a></li>
        </ul>
    </div>
    <div class="top_right">
        <ul>
            <li>管理员：{{Auth::guard('admin')->user()->mangerName}}</li>
            <li><a href="{{url('/admin/editPass')}}" >修改密码</a></li>
            <li><a href="{{url('/admin/logout')}}">退出</a></li>
        </ul>
    </div>
</div>
<!--头部 结束-->
<!--左侧导航 开始-->
<div class="menu_box">
    <ul>
        <li>
            <h3><i class="fa fa-fw fa-clipboard"></i>权限管理</h3>
            <ul class="sub_menu" style="display:none">
                <li><a href="#"><i class="fa fa-fw fa-list-ul"></i>权限管理</a></li>
                <li><a href="#"><i class="fa fa-fw fa-list-alt"></i>角色管理</a></li>
                <li><a href="#"><i class="fa fa-fw fa-plus-square"></i>管理员管理</a></li>
            </ul>
        </li>
        <li>
            <h3><i class="glyphicon glyphicon-user"></i>用户管理</h3>
            <ul class="sub_menu">
                <li><a href="{{url('/admin/user/list/')}}"><i class="fa fa-fw fa-list-ul"></i>用户列表</a></li>
                <li><a href="{{url('admin/user/add')}}"><i class="glyphicon glyphicon-plus"></i>新增用户</a></li>
            </ul>
        </li>
        <li>
            <h3><i class="glyphicon glyphicon-th-list"></i>分类管理</h3>
            <ul class="sub_menu">
                <li><a href="{{url('/admin/category/list')}}"><i class="fa fa-fw fa-list-ul"></i>显示分类</a></li>
                <li><a href="{{url('/admin/category/add')}}"><i class="glyphicon glyphicon-plus"></i>添加分类</a></li>
            </ul>
        </li>
        <li>
            <h3><i class="glyphicon glyphicon-headphones"></i>专辑管理</h3>
            <ul class="sub_menu">
                <li><a href="#"><i class="fa fa-fw fa-list-ul"></i>用户专辑列表</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-picture"></i> 图片管理</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-comment"></i>图片评论管理</a></li>
            </ul>
        </li>
        <li>
            <h3><i class="glyphicon glyphicon-leaf"></i>文章管理</h3>
            <ul class="sub_menu">
                <li><a href="#"><i class="fa fa-fw fa-list-ul"></i>用户文章列表</a></li>
                <li><a href="#"><i class="fa fa-fw fa-list-alt"></i>文章管理</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-comment"></i>文章评论管理</a></li>
            </ul>
        </li>
    </ul>
</div>
<!--左侧导航 结束-->
<!--主体部分 开始-->
<div class="main_box">
   @yield('content')
</div>
<!--主体部分 结束-->

<!--底部 开始-->
<div class="bottom_box">
    CopyRight © 2015. Powered By <a href="http://www.houdunwang.com">http://www.houdunwang.com</a>.
</div>
<!--底部 结束-->
@yield('my-js')
</body>
</html>