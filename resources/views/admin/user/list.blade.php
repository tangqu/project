@extends('app')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('/admin/index')}}">首页</a> &raquo; 用户管理
    </div>
    <!--面包屑导航 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
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

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc">ID</th>
                        <th class="tc">用户名</th>
                        <th class="tc">头像</th>
                        <th class="tc">状态</th>
                        <th class="tc">在线</th>
                        <th class="tc">创建时间</th>
                        <th class="tc">操作</th>
                    </tr>
                    <tr>
                        <td class="tc">1</td>
                        <td class="tc">1</td>
                        <td class="tc">1</td>
                        <td class="tc">1</td>
                        <td class="tc">1</td>
                        <td class="tc">1</td>
                        <td width="300px">        
                            <a href="#" class="btn btn-info" style='margin-left:27px'><span class="glyphicon glyphicon-th-large"></span> 详情</a>
                            <a href="{{url('/admin/user/update/')}}" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span> 修改</a>
                            <a href="#" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> 删除</a>
                        </td>
                    </tr>
                </table>
                <div class="page_list">
                    <ul>
                        <li class="disabled"><a href="#">&laquo;</a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">&raquo;</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
@endsection