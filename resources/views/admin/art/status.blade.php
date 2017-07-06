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
                    <a href="{{url('/admin/art/artManage')}}"><i class="fa fa-plus"></i>未审核文章</a>
                    <a href="{{url('/admin/art/status')}}"><i class="fa fa-recycle"></i>已通过文章</a>
                    <a href="{{url('/admin/art/Nopass')}}"><i class="fa fa-refresh"></i>未通过文章</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc">ID</th>
                        <th class="tc">文章标题</th>
                        <th class="tc">文章图片</th>
                        <th class="tc">文章状态</th>
                        <th class="tc">发布时间</th>
                        <th class="tc">操作</th>
                    </tr>
                    @foreach($manage as $v)
                    <tr>
                        <td class="tc">{{$v->id}}</td>
                        <td class="tc">{{$v->title}}</td>
                        <td class="tc">
                            <img src="{{url($v->artPic)}}" width='40px' >
                        </td>
                        <td class="tc">{{$v->detector== 0 ? '未通过':($v->detector== 1 ? '未审核':'已通过')}}</td>
                        <td class="tc">{{$v->created_at}}</td>
                        <td width="300px">
                            <a href="{{url('admin/art/artDetail')}}/{{$v->id}}" class="btn btn-info" style='margin-left:27px'><span class="glyphicon glyphicon-th-large"></span> 详情</a>
                            <a href="#" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span>已审</a>
                            <a href="{{url('admin/art/artAgain')}}/{{$v->id}}" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>重审</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div class="page_list">
                    <ul>
                        <li class="disabled"><a href={{$manage->previousPageUrl()}}>&laquo;</a></li>
                        @for($i = 1 ; $i <= $manage->lastPage(); $i++ )
                            <li id="active"><a href={{$manage->url($i)}}>{{$i}}</a></li>
                        @endfor
                        <li><a href={{$manage->nextPageUrl()}}>&raquo;</a></li>
                        <li style="width:80px;margin-left: 15px">
                            <span style="color: #337ab7;">第{{$manage->currentPage()}} / {{$manage->lastPage()}} 页</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
@endsection