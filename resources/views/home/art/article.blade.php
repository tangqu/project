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
                        <a class="ng-binding ng-scope active" href="#">
                            <i class="icon art"></i>
                            写文章
                        </a>
                        <a class="ng-binding ng-scope" href="/home/art/articleTwo">
                            <i class="icon list"></i>
                            已发布文章
                        </a>
                    </aside>
                </navbar>
                <div class="warp-inner" id="artbox" >
                    @if($req->total()!=0)
                        <div class="draft published" >
                            <h3 class="hd-title">
                                草稿 ({{$req->total()}})
                                <a class="addnew-btn ng-scope" href="{{url('home/art/wrArt')}}" ng-if="draft.dataList.object_list.length>0">+ 添加新文章</a>
                            </h3>
                                @foreach($req as $e)
                                        <div class="article-list ng-scope">
                                            <ul>
                                                <li class="article-item ng-scope">
                                                    <div class="cover-img">
                                                        @if($e['artPic'])
                                                            <img  alt="暂无封面图" src="{{url($e['artPic'])}}">
                                                        @elseif(empty($e['artPic']))
                                                            <img  alt="暂无封面图" src="">
                                                        @endif
                                                    </div>
                                                    <div class="ar-title" style=" padding-left: 0px;">
                                                        <a class="ar-link ng-binding ng-scope" href="#">
                                                            @if($e['title'])
                                                                {{$e['title']}}
                                                                @elseif(empty($e['title']))
                                                                无标题草稿
                                                                @endif
                                                        </a>
                                                        <span class="ar-time ng-binding">
                                         编辑于{{$e['updated_at']}}
                                         </span>
                                                    </div>
                                                    {{--<p class="ng-binding"  style=" padding-left: 0px;">--}}
                                                        @if($e['attContent'])
                                                            {!! $e['attContent'] !!}
                                                        @endif
                                                    <div class="opt-btns">
                                                        <span class=""><i class="icon arr"></i></span>
                                                        <div class="opt-box">
                                                            <a href="{{url('home/art/editArt')}}/{{$e['id']}}"><button type="button" class="btn btn-info">编辑</button></a>
                                                            <a href="detArt/{{$e['id']}}"><button type="button" class="btn btn-danger">删除</button></a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                 @endforeach
                            <div class="page_list">
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
                        @elseif($req->total()==0)
                        <div class="draft published" >
                            <h3 class="hd-title">
                                草稿 (0)
                            </h3>
                            <div>
                                <div>
                                    <img src="/picture/home/kant.jpg" alt="" class="kant">
                                </div>
                                <p class="has-none ng-scope">
                                    <a class="addnew-btn" href="{{url('home/art/wrArt')}}">+ 添加新文章</a>
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(".opt-btns").mouseover(function(){
            $(this).children('div').show();
        }).mouseout(function(){
            $(this).children('div').hide();
        })
    </script>
@endsection