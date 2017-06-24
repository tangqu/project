@extends('layouts.master')

@section('title', '个人中心')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/home/zgz_person.css">


@section('content')
    <div id="content">
        <div class="layer">
            <div class="tube">

                {{--个人信息显示部分--}}
                <div class="blockmb">
                    <div class="people-header">
                        <div class="people-header-left">
                            <img src="/picture/home/default.jpeg"/>
                            <div class="header-bg-mask"></div>
                        </div>
                        <div class="people-header-right" id="imgArea">
                            <img src="/picture/home/default.jpeg"/>
                            <button style="position:absolute;top:20px;right:20px;background:rgba(0,0,0,0.5);color:#fff;border:0;width:80px;height:30px;display:none;border-radius: 3px">修改图片</button>
                        </div>
                    </div>
                </div>

                {{--用户内容显示排布--}}
                <div class="woo-holder">
                    {{--导航区--}}
                    <div class="people-nav-wrap">
                        <ul class="people-nav clearfix" id='daohang'>
                          <li class='woo-other'>专辑</li>  
                          <li class='woo-other'>文章</li>  
                          <li class='woo-other'>收藏的专辑</li>  
                          <li class='woo-other'>收集的图片</li>  
                          <li class='woo-other'>发布的图片</li>  
                        </ul>
                        <div class="nav-bottom">
                            <div  class="nav-bottom-span" style="display:block;width:142px;opacity:1;transition: all 0.5s">
                                
                            </div>
                        </div>
                    </div>
                </div>
                

            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>

        {{--添加用户个人中心背景图按钮js--}}
        $('#imgArea').mouseover(function(){
            $('#imgArea button').css('display','block');
        }).mouseout(function(){
            $('#imgArea button').css('display','none');
        });

        {{--导航栏滑动js--}}
        $('#daohang li').click(function () {
            var juli = $(this).offset().left-110+'px';
            $('.nav-bottom-span').css('left',juli);
        });

    </script>
@endsection