@extends('layouts.master')

@section('title', '个人中心')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/home/zgz_person.css">
    <link rel="stylesheet" type="text/css" href="/css/home/pbl.css">
    
@endsection


@section('content')
    <div id="content">
        <div class="layer">
            <div class="tube">

                {{--个人信息显示部分--}}
                <div class="blockmb">
                    <div class="people-header clearfix">
                        <div class="people-header-left">
                            <img src="/picture/home/default.jpeg"/ id="personBackPic">
                            <div class="header-bg-mask">
                                <div style="position:absolute;top:75px;left:160px;border-radius: 40px;">
                                    <img src="{{url(Auth::user()->icon)}}" alt="" style="border-radius: 50%">
                                    <div style="margin:10px 0 0 40px;color:#fff">
                                        用户名:{{Auth::user()->userName}}
                                    </div>
                                </div>
                            </div>
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
                    <div class="people-nav-wrap" id='daohang'>
                        <ul class="people-nav clearfix" id='daohang'>
                          <li class='woo-other'>专辑</li>  
                          <li class='woo-other' onclick=userArt({{Auth::user()->id}})>文章</li>  
                          <li class='woo-other' onclick=userPicCollect({{Auth::user()->id}})>收藏的图片</li>  
                          <li class='woo-other' onclick=userPushPic({{Auth::user()->id}})>发布的图片</li>  
                          <li class='woo-other' onclick=doubanInfo()>豆瓣图书介绍</li>  
                        </ul>
                        <div class="nav-bottom">
                            <div  class="nav-bottom-span" style="display:block;width:142px;opacity:1;transition: all 0.5s">
                                
                            </div>
                        </div>
                    </div>
                    {{--显示区--}}
                    <div class="content-info" id="userContent">
                        
                            {{--显示用户专辑--}}
                            <div style="display:block"> 
                                <div class="disInfo clearfix">
                                    <div class="dis-float-info">
                                        <a href="javascrip:void(0);" id="addAlbum">
                                            <div class="add-album" ><div class="add-album-info">添加专辑</div></div>
                                        </a>
                                    </div>
                                    @foreach ($albumInfo as $res)
                                    <div class="dis-float-info">
                                        <a href="{{url('/home/album/picList')}}/{{$res['id']}}" >
                                            <div class="user-album">
                                                @if($res['count'] == 0)
                                                    <img src="{{url('/picture/home/picError.png')}}" alt="">
                                                @else
                                                    <img src="{{url($res['picName'])}}" alt="">
                                                @endif
                                                
                                                <p class="album-name">{{$res['albumName']}}</p>
                                                <p class="album-desc">{{$res['count']}}张图片 · 0人收藏</p>
                                            </div>
                                        </a>
                                    </div>   
                                    @endforeach    
                                </div>
                                <div class="pageInfo">
                                    <ul class="clearfix">
                                        @for ($i = 1; $i <= $albumInfo->lastPage(); $i++)
                                            <a href="{{ $albumInfo->url($i) }}"><li>
                                                {{ $i }}
                                            </li></a>
                                        @endfor
                                    </ul> 
                                </div>
                            </div>

                            {{--文章--}}
                            <div style="display:none" id="artPushInfo" class='clearfix'>
                                
                            </div>

                            {{--收藏--}}
                            <div style="display:none" id="picCollect-info" class="clearfix">

                            </div>

                            {{--发布--}}
                            <div style="display:none" id="picPushInfo" class="clearfix">
                                
                            </div>

                            {{--上传--}}
                            <div style="display:none" id='doubanBook' class="clearfix">
                                <button type="" id='uploadDouBan'>点击查看更多</button>
                            </div>
                         
                    </div>
                        
                </div>
                

            </div>
        </div>
    </div>

    
@endsection

@section('js')
    <script src="/js/com/jquery.tmpl.js"></script>
    <script type="text/html" id="collectUser">
       <div class="grid">
                
            <div class="imgholder">
                <a href="{{url('/comUser/delate')}}/${id}" title=""><img src="{{url('/')}}/${picName}" /></a>
            </div>
            <strong>by `${userName}`</strong>
            <p>${picDesc}</p>
            <div class="meta" ><a href="{{url('/home/picCollect/delete')}}/${co_id}" title="">删除</a></div>

        </div>
    </script>
    <script type="text/html" id="pushPicInfo">
       <div class="grid">
                
            <div class="imgholder">
                <img src="{{url('/')}}/${picName}" />
            </div>
            <p>${picDesc}</p>
            <div class="meta" ><a href="{{url('/home/picture/delete')}}/${id}" >删除</a></div>

        </div>
    </script>
    <script type="text/html" id="douban">
       <div class="grid" style="height:300px">
                
            <div class="imgholder">
                <a href="${alt}" title=""><img src="${image}" /></a>
            </div>
            <strong>作者: ${author}</strong>
            <p>出版社:${publisher}</p>
            <div class="meta" >售价:${price} ~~ 页数:${pages}</div>

        </div>
    </script>
    <script type="text/html" id="pushArtInfo">
       <div class="grid" style="height:250px">
                
            <div class="imgholder">
                <a href="{{url('/home/art/listArt')}}/${id}" title=""><img src="${artPic}" /></a>
            </div>
            <strong>标题:${title}</strong>
            <p>....</p>
            <div class="meta" >${created_at}</div>

        </div>
    </script>
    <script>

        // 添加用户个人中心背景图按钮js
        $('#imgArea').mouseover(function(){
            $('#imgArea button').css('display','block');
        }).mouseout(function(){
            $('#imgArea button').css('display','none');
        });

        // 导航栏滑动js
        var juli1 = $('#daohang').offset().left;
        $('#daohang li').click(function () {
            var juli = $(this).offset().left-juli1+'px';
            index = $(this).index();
            $('.nav-bottom-span').css('left',juli);
            $('#userContent>div').eq(index).css('display','block').siblings().css('display','none');
        });

        //查看收藏的图片
        function userPicCollect($id){
            $('#picCollect-info').empty();
            var user_id = $id;
            $.ajax({
                url:'/home/picCollect/userList',
                type:'get',
                data:{user_id:user_id},
                success:function(data){
                    $("#collectUser").tmpl(data).prependTo("#picCollect-info");
                }
            })
        }

        //查看发布的图片
        function userPushPic($id){
            $('#picPushInfo').empty();
            var user_id = $id;
            $.ajax({
                url:'/home/picture/pushPic',
                type:'get',
                data:{uid:user_id},
                success:function(data){
                    $("#pushPicInfo").tmpl(data).prependTo("#picPushInfo");
                }
            })

        }

        //豆瓣信息查看
        page = 0;
        function doubanInfo(){
            count = (page++)*12;
            $('#doubanBook div').remove();
            $.ajax({
                url:'https://api.douban.com/v2/book/search?q=javascript&count=12&start='+count,
                type:'get',
                success:function(data){
                    console.log(data['books']);
                    $("#douban").tmpl(data['books']).prependTo("#doubanBook");
                },
                dataType:'jsonp',
            })
        }
        $('#uploadDouBan').click(function(){
            doubanInfo();
        })

        //获取文章信息
        function userArt($id){
            $('#artPushInfo').empty();
            var uid = $id;
            $.ajax({
                url:'/home/art/pushArt',
                type:'get',
                data:{uid:uid},
                success:function(data){
                    $("#pushArtInfo").tmpl(data).prependTo("#artPushInfo");
                }
            })
        }

        

    </script>
@endsection