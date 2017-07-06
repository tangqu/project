@extends('app')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">权限管理</a> &raquo; 权限列表
    </div>
    <!--面包屑导航 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="{{url('admin/permission-Add')}}" method="post">
        {{csrf_field()}}
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/permission-Add')}}"><i class="fa fa-plus"></i>新增权限</a>
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
                        <th class="tc">权限路由</th>
                        <th class="tc">权限名称</th>
                        <th class="tc">权限描述</th>
                        <th class="tc">操作</th>
                    </tr>
                    @foreach($permissions as $permission)
                    <tr>
                        <td class="tc">{{$permission['id']}}</td>
                        <td class="tc">{{$permission['name']}}</td>
                        <td class="tc">{{$permission['display_name']}}</td>
                        <td class="tc">{{$permission['description']}}</td>
                        <td class="tc" style="width:240px">
                            <a href="{{url('admin/permission-Update')}}/{{$permission['id']}}" style="margin-left:80px">修改</a>
                            <a href="{{url('admin/permission-Del')}}/{{$permission['id']}}">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div class="page_list">
                    {{--分页--}}
                    <ul>
                        <li class="disabled"><a href={{$permissions->previousPageUrl()}}>&laquo;</a></li>
                        @for($i = 1 ; $i <= $permissions->lastPage(); $i++ )
                            <li id="active"><a href={{$permissions->url($i)}}>{{$i}}</a></li>
                        @endfor
                        <li><a href={{$permissions->nextPageUrl()}}>&raquo;</a></li>
                        <li style="width:80px;margin-left: 15px">
                            <span style="color: #337ab7;">第{{$permissions->currentPage()}} / {{$permissions->lastPage()}} 页</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
@endsection