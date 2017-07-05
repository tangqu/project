@extends('app')
@section('my-css')
    <style>
        .imgBox{
            display:none;
            background:rgba(255,255,255, 0.7);
            position:absolute;
            top:0px;
            left:0px;
            width:100%;
            height:100%;
        }
        .imgBox a{
            position:absolute;
            top: 0;
            right: 0;
            width: 80px;
            height: 80px;
            background:url(/picture/home/page.gif);
            text-indent: -9999px;
        }
        .imgBox img{
            position:absolute;
            top:30%;
            left:40%;
        }
    </style>
@endsection
@section('content')
    
    <div class="crumb_warp">
        {{--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。--}}
        <i class="fa fa-home"></i> <a href="{{url('/admin/index')}}">首页</a> &raquo; 专辑管理
    </div>
    

    
    
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
                        <th class="tc">图片ID</th>
                        <th class="tc">图片名</th>
                        <th class="tc">图片描述</th>
                        <th class="tc">操作</th>
                    </tr>
                    @foreach($picInfo as $res)
                    <tr>
                        <td class="tc">{{$res['id']}}</td>
                        <td class="tc"><img src="{{url($res['picName'])}}" width="35px"></td>
                        <td class="tc">{{$res['picDesc']}}</td>
                        <td width="300px">        
                            <button class="btn btn-info imgInfo" style="margin-left:105px" onclick=page({{$res['id']}})>
                                查看图片
                            </button>
                            <div id="imgBox_{{$res['id']}}" class="imgBox">
                                <a href="javascrip:void(0);" onclick = dele({{$res['id']}})></a>
                                <img src="{{url($res['picName'])}}" width="200px" >
                            </div>
                        </td>
                    </tr>

                    @endforeach
                </table>
                
                

                <div class="page_list">
                    <ul>
                        <li class="disabled"><a href="{{$picInfo->previousPageUrl()}}">&laquo;</a></li>
                        <div style="display:inline" id ="pagelist">
                        @for ($i = 1; $i <= $picInfo->lastPage(); $i++)
                            <a href="{{ $picInfo->url($i) }}"><li style="width:32px;text-align: center">
                                {{ $i }}
                            </li></a>
                        @endfor
                        </div>
                        
                        <li><a href="{{$picInfo->nextPageUrl()}}">&raquo;</a></li>
                        <li style="width:100px;text-align: center"><span>第 <span id="catePage">{{$picInfo->currentPage()}}</span> / {{$picInfo->lastPage()}} 页</span></li>
                    </ul>
                    <input type="button" class="back" onclick="history.go(-1)" style="margin-top:-23px"value="返回">
                </div>
            </div>
        </div>
    
    
    
@endsection



@section('my-js')
    <script>
    
    function page(id){
        $('#imgBox_'+id).css('display','block');
    }

    function dele(id){
        $('#imgBox_'+id).css('display','none');
    }

    </script>
@endsection