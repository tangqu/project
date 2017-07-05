@extends('app')

@section('content')
    
    <div class="crumb_warp">
        {{--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。--}}
        <i class="fa fa-home"></i> <a href="{{url('/admin/index')}}">首页</a> &raquo; 专辑管理
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
                        <th class="tc">专辑ID</th>
                        <th class="tc">专辑名</th>
                        <th class="tc">图片数</th>
                        <th class="tc">专辑更新时间</th>
                        <th class="tc">操作</th>
                    </tr>
                    @foreach($albumInfo as $res)
                    <tr>
                        <td class="tc">{{$res['id']}}</td>
                        <td class="tc">{{$res['albumName']}}</td>
                        <td class="tc">{{$res['count']}}</td>
                        <td class="tc">{{$res['updated_at']}}</td>
                        <td width="300px">        
                            <a href="#" class="btn btn-info" style="margin-left:40px"><span class="glyphicon glyphicon-list-alt"> </span> 专辑详情</a>
                            <a href="{{url('/admin/album/picList')}}/{{$res['id']}}" class="btn btn-success"><span class="glyphicon glyphicon-folder-open"> </span> 查看图片</a>
                        </td>
                    </tr>
                    @endforeach
                </table>

                <div class="page_list">
                    <ul>
                        <li class="disabled"><a href="{{$albumInfo->previousPageUrl()}}">&laquo;</a></li>
                        <div style="display:inline" id ="pagelist">
                        @for ($i = 1; $i <= $albumInfo->lastPage(); $i++)
                            <li><a href="{{ $albumInfo->url($i) }}">
                                {{ $i }}
                            </a></li>
                        @endfor
                        </div>
                        
                        <li><a href="{{$albumInfo->nextPageUrl()}}">&raquo;</a></li>
                        <li style="width:100px;text-align: center"><span>第 <span id="catePage">{{$albumInfo->currentPage()}}</span> / {{$albumInfo->lastPage()}} 页</span></li>
                    </ul>
                    <input type="button" class="back" onclick="history.go(-1)" style="margin-top:-23px"value="返回">
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