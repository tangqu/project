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
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc">评论ID</th>
                        <th class="tc">评论人</th>
                        <th class="tc">评论内容</th>
                        <th class="tc">评论时间</th>
                        <th class="tc" width="30">操作</th>
                    </tr>
                    @foreach($rev as $r)
                    <tr>
                        <td class="tc"><a href="reply/{{$r['id']}}">{{$r['id']}}</a></td>
                        <td class="tc">{{$r['userName']}}</td>
                        <td class="tc">{{$r['comment']}}</td>
                        <td class="tc">{{$r['created_at']}}</td>
                        <td>
                            <a href="redel/{{$r['id']}}" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> 删除</a>
                        </td>

                    </tr>
                    @endforeach
                </table>
                <div class="page_list">
                    {{--分页--}}
                    <ul>
                        <li class="disabled"><a href={{$rev->previousPageUrl()}}>&laquo;</a></li>
                        @for($i = 1 ; $i <= $rev->lastPage(); $i++ )
                            <li id="active"><a href={{$rev->url($i)}}>{{$i}}</a></li>
                        @endfor
                        <li><a href={{$rev->nextPageUrl()}}>&raquo;</a></li>
                        <li style="width:80px;margin-left: 15px">
                            <span style="color: #337ab7;">第{{$rev->currentPage()}} / {{$rev->lastPage()}} 页</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
@endsection