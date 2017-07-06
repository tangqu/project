@extends('app')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">角色管理</a> &raquo; 角色列表
    </div>
    <!--面包屑导航 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/role-Add')}}"><i class="fa fa-plus"></i>新增角色</a>
                    <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                    <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc">ID</th>
                        <th class="tc">角色名称</th>
                        <th class="tc">角色分类</th>
                        <th class="tc">角色描述</th>
                        <th class="tc">角色权限</th>
                        <th class="tc">操作</th>
                    </tr>
                    @foreach($roles as $role)
                    <tr>
                        <td class="tc">{{$role['id']}}</td>
                        <td class="tc">{{$role['name']}}</td>
                        <td class="tc">{{$role['display_name']}}</td>
                        <td class="tc">{{$role['description']}}</td>
                        <td class="tc">{{$role['perms']}}</td>
                        <td class="tc" style="width:300px">
                            <a href="{{url('/admin/attachPermission')}}/{{$role['id']}}" style="margin-left:90px">分配权限</a>
                            <a href="{{url('/admin/role-Update')}}/{{$role['id']}}">修改</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div class="page_list">
                    {{--分页--}}
                    <ul>
                        <li class="disabled"><a href={{$roles->previousPageUrl()}}>&laquo;</a></li>
                        @for($i = 1 ; $i <= $roles->lastPage(); $i++ )
                            <li id="active"><a href={{$roles->url($i)}}>{{$i}}</a></li>
                        @endfor
                        <li><a href={{$roles->nextPageUrl()}}>&raquo;</a></li>
                        <li style="width:80px;margin-left: 15px">
                            <span style="color: #337ab7;">第{{$roles->currentPage()}} / {{$roles->lastPage()}} 页</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
@endsection