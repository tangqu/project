@extends('layouts.master')

@section('title', '享趣生活馆')

@section('css')
    <link rel="stylesheet" href="/css/admin/ch-ui.admin.css">
    <link rel="stylesheet" href="/css/home/article.css">

@endsection
@section('head')
@endsection
@section('content')
    <div id="header">
        <nav class="nav-bar">
            <a class="logo" href="#/"></a>
            <div class="userinfo">
                <a href="" target="_blank" class="ng-binding">
                    <img class="pg-avatar" src="/picture/home/icon.png">{{Auth::user()->userName}}
                </a>
            </div>
        </nav>
    </div>
    <div class="container ng-scope" >
        <div id="content" class="ng-scope">
            <div class="warp">
                <navbar class="ng-isolate-scope">
                    <aside class="sidebar" id="article">
                        <a class="ng-binding ng-scope " href="{{url('/home/art/article')}}">
                            <i class="icon art"></i>
                            写文章
                        </a>
                        <a class="ng-binding ng-scope active" herf="/#publish" href="{{url('/home/art/articleTwo')}}">
                            <i class="icon list"></i>
                            已发布文章
                        </a>
                    </aside>
                </navbar>
                <div class="warp-inner" id="artbox" >
                    <div class="draft">
                        @if ($res->total()!=0)
                            <h3 class="hd-title">
                                已发布文章{{$res->total()}}
                            </h3>
                            @foreach($res as $v)
                                <div class="article-list ng-scope">
                                    <ul>
                                        <li class="article-item ng-scope">
                                            <div class="cover-img">
                                                <img  alt="暂无封面图" src="{{url($v['artPic'])}}">
                                            </div>
                                            <div class="ar-title">
                                                <a class="ar-link ng-binding ng-scope" href="/home/art/listArt/{{$v['id']}}">{{$v['title']}}
                                                </a>
                                                <span class="ar-time ng-binding">
                                                      编辑于{{$v['updated_at']}}
                                                </span>
                                                <span class="btn-info btn">{{$v['detector']==0 ? '审核不通过' : $v['detector']==1 ? '待审核' : '审核通过'}}</span>
                                            </div>
                                            {!! $v['attContent'] !!}
                                            <div class="opt-btns">
                                                <span class=""><i class="icon arr"></i></span>
                                                <div class="opt-box">
                                                    <a href="{{url('home/art/newEditArt')}}/{{$v['id']}}"><button type="button" class="btn btn-info">编辑</button></a>
                                                    <a href="deleteArt/{{$v['id']}}"><button type="button" class="btn btn-danger">删除</button></a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    {{--分页--}}
                                </div>
                            @endforeach
                                <div class="page_list">
                                <ul>
                                    <li class="disabled"><a href={{$res->previousPageUrl()}}>&laquo;</a></li>
                                    @for($i = 1 ; $i <= $res->lastPage(); $i++ )
                                        <li id="active"><a href={{$res->url($i)}}>{{$i}}</a></li>
                                    @endfor
                                    <li><a href={{$res->nextPageUrl()}}>&raquo;</a></li>
                                    <li style="width:80px;margin-left: 15px">
                                        <span style="color: #337ab7;">第{{$res->currentPage()}} / {{$res->lastPage()}} 页</span>
                                    </li>
                                </ul>
                            </div>
                        @elseif($res->total()==0)
                            <h3 class="hd-title">
                                已发布文章 (0)
                            </h3>
                            <p class="has-none">
                                您还没有发布任何文章，您可以立即<a href="{{url('home/art/wrArt')}}" target="_blank">添加新文章</a>
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        //鼠标移动显示隐藏
        $(".opt-btns").mouseover(function(){
            $(this).children('div').show();
        }).mouseout(function(){
            $(this).children('div').hide();
        })
    </script>
@endsection