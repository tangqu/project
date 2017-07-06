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
        #picManger span{
            cursor: pointer;
            margin-left: 10px;
        }
        #picMangerInfo div{
            display: none;
        }
        
    </style>
@section('content')
    
    <div class="crumb_warp">
        {{--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。--}}
        <i class="fa fa-home"></i> <a href="{{url('/admin/index')}}">首页</a> &raquo; 图片管理
    </div>
    

    
    <div class="result_wrap">
            
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('/admin/picture/manager')}}/0"><i class="fa fa-plus"></i>未通过图片</a>
                <a href="{{url('/admin/picture/manager')}}/1"><i class="fa fa-recycle"></i>未审核图片</a>
                <a href="{{url('/admin/picture/manager')}}/2"><i class="fa fa-refresh"></i>已通过图片</a>
            </div>
        </div>
        
    </div>

        <div class="result_wrap">
            <div class="result_content" id="picMangerInfo">

                    <table class="list_tab">
                        <tr>
                            <th class="tc">图片ID</th>
                            <th class="tc">图片</th>
                            <th class="tc">图片描述</th>
                            <th class='tc'>发布人</th>
                            <th class="tc">操作</th>
                        </tr>
                        @foreach($picMangerInfo as $res)
                        <tr>
                            <td class="tc">{{$res['id']}}</td>
                            <td class="tc"><img src="{{url($res['picName'])}}" width="35px"></td>
                            <td class="tc">{{$res['picDesc']}}</td>
                            <td class="tc">{{$res['userName']}}</td>
                            <td width="300px">        
                                <button class="btn btn-info imgInfo" style="margin-left:-5px" onclick=page({{$res['id']}})>
                                    查看图片
                                </button>
                                @if($res['detector'] == 0)
                                <a href="{{url('/admin/picture/sh')}}/{{$res['id']}}"  class="btn btn-warning" style="margin-left:35px">重新审核</a>
                                <a href="{{url('/admin/picture/delete')}}/{{$res['id']}}"  class="btn btn-danger" style="margin-left:-5px">删除</a>
                                @elseif($res['detector'] == 1)
                                <a href="{{url('/admin/picture/yes')}}/{{$res['id']}}"  class="btn btn-success" style="margin-left:35px">通过</a>
                                <a href="{{url('/admin/picture/no')}}/{{$res['id']}}"  class="btn btn-danger" style="margin-left:-5px">未通过</a>
                                @elseif($res['detector'] == 2)
                                <a href="{{url('/admin/picture/sh')}}/{{$res['id']}}"  class="btn btn-warning" style="margin-left:60px">重新审核</a>
                                @endif
                                <div id="imgBox_{{$res['id']}}" class="imgBox">
                                    <a href="javascrip:void(0);" onclick = dele({{$res['id']}})></a>
                                    <img src="{{url($res['picName'])}}" width="200px" >
                                </div>
                            </td>
                        </tr>

                        @endforeach
                    </table>
                     <div class="page_list" style="display:block">
                        <ul>
                            <li class="disabled"><a href="{{$picMangerInfo->previousPageUrl()}}">&laquo;</a></li>
                            <div style="display:inline" id ="pagelist">
                            @for ($i = 1; $i <= $picMangerInfo->lastPage(); $i++)
                                <a href="{{ $picMangerInfo->url($i) }}"><li style="width:32px;text-align: center">
                                    {{ $i }}
                                </li></a>
                            @endfor
                            </div>
                            
                            <li><a href="{{$picMangerInfo->nextPageUrl()}}">&raquo;</a></li>
                            <li style="width:100px;text-align: center"><span>第 <span id="catePage">{{$picMangerInfo->currentPage()}}</span> / {{$picMangerInfo->lastPage()}} 页</span></li>
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