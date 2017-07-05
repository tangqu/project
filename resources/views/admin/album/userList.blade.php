@extends('app')

@section('content')
    
    <div class="crumb_warp">
        {{--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。--}}
        <i class="fa fa-home"></i> <a href="{{url('/admin/index')}}">首页</a> &raquo; 专辑管理
    </div>
    

    
    <form action="{{url('/admin/album/userList')}}" method="post">
        <div class="result_wrap">
            
            <div class="result_content">
                <div class="short_wrap">
                    <a href="#"><i class="fa fa-plus"></i>新增权限</a>
                    <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                    <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
                </div>
            </div>
            
        </div>
        {{csrf_field()}}
        <input type="text" name="search" style="margin:10px 0 0 20px" required placeholder="请输入用户名"> <input type="submit" value="查询">
        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc">用户ID</th>
                        <th class="tc">用户名</th>
                        <th class="tc">手机号</th>
                        <th class="tc">专辑数</th>
                        <th class="tc">操作</th>
                    </tr>
                    @foreach($userAlbum as $res)
                    <tr>
                        <tr>
                        <td class="tc">{{$res['id']}}</td>
                        <td class="tc">{{$res['userName']}}</td>
                        <td class="tc">{{$res['phone']}}</td>
                        <td class="tc">{{$res['count']}}</td>
                        <td width="300px">        
                            <a href="{{url('/admin/user/update/')}}" class="btn btn-info" style="margin-left:20px"><span class="glyphicon glyphicon-list-alt"> </span> 专辑详情统计</a>
                            <a href="{{url('/admin/album/albumList')}}/{{$res['id']}}" class="btn btn-success"><span class="glyphicon glyphicon-folder-open"> </span> 查看专辑</a>
                        </td>
                    </tr>
                    </tr>
                    @endforeach
                </table>

                <div class="page_list">
                    <ul>
                        <li class="disabled"><a href="{{$userAlbum->previousPageUrl()}}">&laquo;</a></li>
                        <div style="display:inline" id ="pagelist">
                         @for ($i = 1; $i <= $userAlbum->lastPage(); $i++)
                            <li><a href="{{ $userAlbum->url($i) }}">
                                {{ $i }}
                            </a></li>
                        @endfor
                        </div>
                        
                        <li><a href="{{$userAlbum->nextPageUrl()}}">&raquo;</a></li>
                        <li style="width:100px;text-align: center"><span>第 <span id="catePage">{{$userAlbum->currentPage()}}</span> / {{$userAlbum->lastPage()}} 页</span></li>
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