@extends('app')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; 用户管理
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
                        <th class="tc">文章标题</th>
                        <th class="tc">文章状态</th>
                        <th class="tc">发布时间</th>
                        <th class="tc">操作</th>
                    </tr>
                    @foreach($req as $v)
                    <tr>
                        <td class="tc">{{$v->id}}</td>
                        <td class="tc">{{$v->userName}}</td>
                        <td class="tc">{{$v->title}}</td>
                        <td class="tc">{{$v->detector== 0 ? '未通过':($v->detector== 1 ? '未审核':'已通过')}}</td>
                        <td class="tc">{{$v->created_at}}</td>

                        <td width="300px">        
                            <a href="{{url('admin/art/artDetail')}}/{{$v->id}}" class="btn btn-info" style='margin-left:27px'><span class="glyphicon glyphicon-th-large"></span> 详情</a>
                            @if($v->detector==1)
                                <a href="{{url('admin/art/artStatus')}}/{{$v->id}}" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span>{{$v->detector== 1 ? '通过' : '已审核'}}</a>
                                <a href="{{url('admin/art/artNot')}}/{{$v->id}}" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>{{$v->detector== 1 ? '不通过' : '已审核'}}</a>
                                @elseif($v->detector !=1)
                                <a href="{{url('admin/art/artAgain')}}/{{$v->id}}" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>重新审核</a>
                            @endif
                        </td>
                    </tr>
                        @endforeach
                </table>
                <div class="page_list">
                    {{--分页--}}
                    <ul>
                        <li class="disabled"><a href={{$req->previousPageUrl()}}>&laquo;</a></li>
                        @for($i = 1 ; $i <= $req->lastPage(); $i++ )
                            <li id="active"><a href={{$req->url($i)}}>{{$i}}</a></li>
                        @endfor
                        <li><a href={{$req->nextPageUrl()}}>&raquo;</a></li>
                        <li style="width:80px;margin-left: 15px">
                            <span style="color: #337ab7;">第{{$req->currentPage()}} / {{$req->lastPage()}} 页</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
@endsection
@section('my-js')
@endsection

