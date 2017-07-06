@extends('app')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('/admin/index')}}">首页</a> &raquo; 用户管理
    </div>
    <!--面包屑导航 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="{{url('/admin/user/list')}}" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="#"><i class="fa fa-plus"></i>新增权限</a>
                    <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                    <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        {{--搜索--}}
            {{csrf_field()}}
            <input type="text" name="userName" style="margin-left: 20px;margin-top: 10px">
            <input type="submit" value="搜索">

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc">ID</th>
                        <th class="tc">用户名</th>
                        <th class="tc">头像</th>
                        <th class="tc">状态</th>
                        <th class="tc">在线</th>
                        <th class="tc">注册时间</th>
                        <th class="tc">操作</th>
                    </tr>
                    @foreach($users as $user)
                    <tr>
                        <td class="tc">{{$user['id']}}</td>
                        <td class="tc">{{$user['userName']}}</td>
                        <td class="tc">
                            <img src="{{url($user['icon'])}}" width='40px' style="border-radius: 100%" >
                        </td>
                        <td class="tc">
                            <a style="margin-right:0px; color:black" href="{{url('/admin/user/userStutas')}}/{{$user['id']}}">{{$user['status'] == 0 ? '禁用' : '激活'}}</a>
                        </td>
                        <td class="tc">{{$user['reg_status'] == 0 ? '下线' : '上线'}}</td>
                        <td class="tc">{{$user['created_at']}}</td>
                        <td width="300px">        
                            <a href="{{url('/admin/user/detail/')}}/{{$user['id']}}" class="btn btn-info" style='margin-left:27px'><span class="glyphicon glyphicon-th-large"></span> 详情</a>
                            <a href="{{url('/admin/user/update/')}}/{{$user['id']}}" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span> 修改</a>
                            <a href="{{url('/admin/user/delete')}}/{{$user['id']}}" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> 删除</a>
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
