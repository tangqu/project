@extends('app')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">管理员管理</a> &raquo; 管理员列表
    </div>
    <!--面包屑导航 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/user-Add')}}"><i class="fa fa-plus"></i>新增管理员</a>
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
                        <th class="tc">用户名</th>
                        <th class="tc">角色名称</th>
                        <th class="tc">操作</th>
                    </tr>
                    @foreach($users as $user)
                    <tr>
                        <td class="tc">{{$user['id']}}</td>
                        <td class="tc">{{$user['mangerName']}}</td>
                        <td class="tc">{{$user['roles']}}</td>
                        <td class="tc" style="width:500px">
                        
                            <a href="{{url('admin/attachRole')}}/{{$user['id']}}" style="margin-left:150px;">分配角色</a>
                            <a href="{{url('admin/user-Update')}}/{{$user['id']}}">修改</a>
                        @if(Auth::guard('admin')->user()->mangerName != $user['mangerName'])
                            <a href="{{url('admin/user-Del')}}/{{$user['id']}}">删除</a>
                            <a href="{{url('admin/user-reset')}}/{{$user['id']}}">重置密码</a>
                        @endif
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div class="page_list">
                    {{--分页--}}
                    <ul>
                        <li class="disabled"><a href={{$users->previousPageUrl()}}>&laquo;</a></li>
                        @for($i = 1 ; $i <= $users->lastPage(); $i++ )
                            <li id="active"><a href={{$users->url($i)}}>{{$i}}</a></li>
                        @endfor
                        <li><a href={{$users->nextPageUrl()}}>&raquo;</a></li>
                        <li style="width:80px;margin-left: 15px">
                            <span style="color: #337ab7;">第{{$users->currentPage()}} / {{$users->lastPage()}} 页</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
@endsection