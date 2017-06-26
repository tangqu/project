@extends('app')
@section('my-css')
    <style>    
        .data a{
            color:#000;
            margin-left: 90px;

        }
        .data a:hover{
            text-decoration: none;
        }
    </style>
@section('content')
    
    <div class="crumb_warp">
        {{--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。--}}
        <i class="fa fa-home"></i> <a href="{{url('/admin/index')}}">首页</a> &raquo; 分类管理
    </div>
    

    
    <form action="#" method="post">
        <div class="result_wrap">
            
            <div class="result_content">
                <div class="short_wrap">
                    <a href="#"><i class="fa fa-plus"></i>新增权限</a>
                    <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                    <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
                </div>
            </div>
            
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc">ID</th>
                        <th class="tc">分类名</th>
                        <th class="tc">父级ID</th>
                        <th class="tc">分类路径</th>
                        <th class="tc">状态</th>
                        <th class="tc">操作</th>
                    </tr>
                    @foreach($cateInfo as $res)
                    <tr>
                        <td class="tc">{{$res['id']}}</td>
                        <td class="tc data" style="width:250px"><a href="{{url('/admin/category/list')}}/{{$res['id']}}">{{$res['cateName']}}</a></td>
                        <td class="tc">{{$res['pid']}}</td>
                        <td class="tc">{{$res['path']}}</td>
                        <td class="tc data">{{$res['display'] == 0 ? '隐藏' : '显示'}}</td>
                        <td width="300px">        
                            <a href="{{url('/admin/category/add/')}}/{{$res['id']}}/{{$res['path']}}" class="btn btn-info" style='margin-left:1px'><span class="glyphicon glyphicon-th-large"></span> 添加子分类</a>
                            <a href="{{url('/admin/category/update')}}/{{$res['id']}}" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span> 修改</a>
                            <a href="{{url('/admin/category/delete')}}/{{$res['id']}}" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> 删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div class="page_list">
                    <ul>
                        <li class="disabled"><a href="{{$cateInfo->previousPageUrl()}}">&laquo;</a></li>
                        <div style="display:inline" id ="pagelist">
                         @for ($i = 1; $i <= $cateInfo->lastPage(); $i++)
                            <li><a href="{{ $cateInfo->url($i) }}">
                                {{ $i }}
                            </a></li>
                        @endfor
                        </div>
                        
                        <li><a href="{{$cateInfo->nextPageUrl()}}">&raquo;</a></li>
                        <li style="width:100px;text-align: center"><span>第 <span id="catePage">{{$cateInfo->currentPage()}}</span> / {{$cateInfo->lastPage()}} 页</span></li>
                    </ul>
          
                </div>
            </div>
        </div>
    </form>
    
@endsection

@section('my-js')
    <script>

    $('#pagelist li').eq($('#catePage').text()-1).addClass('active');

    </script>
@endsection