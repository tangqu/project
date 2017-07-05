@extends('layouts.master')

@section('title', '享趣生活馆')

@section('css')
    <link rel="stylesheet" href="/css/home/zgz_listArt.css">
    {{--<meta name="csrf-token" content="{{ csrf_token() }}" />--}}
    <style>
        .gn{
            margin-top: 0px !important;
        }
    </style>
@endsection

@section('content')
    <div id="content">
        <div class="dt-wrap clr pg-article-content">
            <section class="wrap-container">
                <article class="article-detail">
                    <h2>{{$res->title}}</h2>
                    <img src="{{url($res->artPic)}}" alt="" width="400px">
                    <div class="blog-content">
                        <p style="word-break:break-word;">{!!$res->attContent!!}&nbsp;</p></div>
                </article>
                <section class="share-list">
                    <span>分享至：</span>
                    <div class="bdsharebuttonbox">
                        <a href="#" class="bds_more" data-cmd="more"></a>
                        <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
                        <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
                        <a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>
                        <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
                    </div>
                    <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"24"},"share":{},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"24"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
                </section>
                <a href="javascript:void(0)" class="btn btn-info" id="artCollect" style="width: 100px;">
                    @if(Auth::user())
                        @if(empty($coll))
                            收藏该文章
                        @else
                            已收藏
                        @endif
                        @else
                        收藏该文章
                    @endif
                </a>
            </section>
            <aside class="wrap-siderbar">
                <section class="author" style="text-align: center">
                    <a class="link" href="#" target="_blank">
                        <img src="/picture/home/{{$user->icon}}" style="border-radius: 50%;">
                    </a>
                    <a class="name" href="#" target="_blank" >
                        {{$user->userName}}
                    </a>
                    <p>
                        {{$user->desc}}
                    </p>
                    <p id='guanzhu' class="btn btn-info" onclick="gz({{$user->id}})">
                        @if(Auth::user())
                            @if(empty($rele))
                                关注
                            @else
                                已关注
                            @endif
                            @else
                            关注
                         @endif
                    </p>
                    <span class="split-line"></span>
                    <span class="time">
                    {{$res->updated_at}}· {{$view->views}}次浏览
                    </span>
                </section>
            </aside>
        </div>
    </div>
    <div id="content2">
        <div class="art-bg">
            <div class="pg-main-l-title">
                @if(Auth::user())
                        @if(empty($pra))
                            <span>欢迎评论: </span><span style="float: right;"><a href="javascript:void(0)" class="reply-confirm" id="dianzan"></a></span>
                        @else
                            <span>欢迎评论: </span><span style="float: right;"><a href="javascript:void(0)" class="reply-change" id="dianzan"></a></span>
                        @endif
                    @else
                    <span>欢迎评论: </span>

                @endif
            </div>

            @foreach($com as $c)
                <div class="pg-main-letter" style="padding-left:20px;margin-top:7px">
                    <div class="pg-people-avatar">
                        <img src="/picture/home/icon.png" alt="" class="pg-people-image" />
                    </div>
                    <div class="pg-detail-people-info clr">
                        <p class="pg-people-name">{{$c['userName']}}
                            <span class="pg-uptime">  &nbsp;&nbsp;&nbsp;{{$c['created_at']}}</span>
                            <span id='art-hf' class='btn btn-info art-hf'style="float: right;margin-right:50px" >回复</span>
                        </p>
                        <p class="pg-people-msg">{{$c['comment']}}</p>
                        @foreach($reply as $rep)
                            @if($rep['cid'] == $c['id'])
                                {{$rep['re_name']}}回复{{$c['userName']}}：<p style="margin-left: 10px">{{$rep['comment']}}</p>
                                @else
                                @endif
                            @endforeach
                        <form action="" id="send-hf{{$c['id']}}" method="post" style="display:none">
                            {{csrf_field()}}
                            <input type="hidden" name="uid" value="{{$c['uid']}}">
                            <textarea name="comment2" class="msg-txa" style="overflow: hidden; height: 100px; margin: 5px 20px; width: 300px;"></textarea>
                            <input type="hidden" name="cid" value="{{$c['id']}}">
                            <span class="btn btn-info" style="margin-left: 20px;margin-bottom: 35px" onclick="sendhf({{$c['id']}})" >评论</span>
                            <span class="btn btn-info no-hf" style="margin-left: 20px;margin-bottom: 35px">取消评论</span>
                        </form>
                    </div>
                </div>
            @endforeach
            @if(Auth::user())
            <div class="pg-main-letter" style="padding-bottom:20px">
                <form action="" id="send-mail" method="post" name="comment1">
                    {{csrf_field()}}
                    <input type="hidden" name="userName" value="{{Auth::user()->userName}}">
                    <input type="hidden" name="uid" value="{{Auth::user()->id}}">
                    <input type="hidden" name="tid" value="{{$res->id}}">
                    <textarea id="txa-message" name="comment" class="msg-txa" style="overflow: hidden; height: 100px; margin: 5px 20px; width: 628px;"></textarea>
                    <button type="submit" class="btn btn-info" style="margin-left: 20px;">评论</button>
                </form>
            </div>
                @else
            <div>
                登录后才可以评论
            </div>
                @endif
        </div>
    </div>
@endsection
@section('foot')
@endsection
@section('js')
    <script>
        //阻止表单传递
        document.querySelector('#send-mail').addEventListener('submit',function(e){
            e.preventDefault();
        },false);

        //评论
        $('#send-mail').submit(function(){
            var token =  $('input[name=_token]').val();
            var comment = $('textarea[name=comment]').val();
            var userName =  $('input[name=userName]').val();
            var uid = $("input[name=uid]").val();
            var tid = $('input[name=tid]').val();
            $.ajax({
                url: '/home/art/artComment',
                type: "post",
                data:{tid:tid,userName:userName,comment:comment,_token:token,uid:uid},
                success: function(data){
                    window.location.reload();
                }
            });
        });

        //点赞
        $('#dianzan').click(function(){
            var tid = $("input[name='tid']").val();
            $.ajax({
                url:'/home/art/artPraises',
                type: "get",
                data :{tid:tid},
                async:true,
                success: function(data){
                    if(data == 1){
                        $('#dianzan').removeClass('reply-change').addClass('reply-confirm');
                    }else{
                        $('#dianzan').removeClass('reply-confirm').addClass('reply-change');
                    }
                }
            });
        });

        //显示回复
        $('.art-hf').each(function(){
            $(this).on('click',function(){
                $(this).parent().parent().find('form').show();
            });
        });

        //隐藏回复框
        $('.no-hf').click(function(){
            $('.clr>form').hide();
        });

        //回复评论
        function sendhf(id) {
            sendhf1(id)
        }
        function sendhf1(id){
            var token = $('#send-hf'+id).find('input[name=_token]').val();
            var comment = $('#send-hf'+id).find('textarea[name=comment2]').val();
            var to_uid = $('#send-hf'+id).find("input[name=uid]").val();
            var tid = $('#send-mail').find('input[name=tid]').val();
            var cid = $('#send-hf'+id).find('input[name=cid]').val();
            var re_name =  $('input[name=userName]').val();
            $.ajax({
                url: '/home/art/artReply',
                type: "post",
                data: {tid: tid, comment: comment, _token: token, to_uid: to_uid, cid: cid,re_name:re_name},
                success:function (data) {
                    if(data == 1){
                        window.location.reload();
                    }
                    
                }
            });
        }

        //文章收藏
        $('#artCollect').click(function(){
            var tid = $("input[name='tid']").val();
            $.ajax({
                url:'/home/art/artCollect',
                type: "get",
                data :{tid:tid},
                async:true,
                success: function(data){
                    if(data == 1){
                        $('#artCollect').text('收藏该文章');
                    }else{
                        $('#artCollect').text('已收藏');
                    }
                }
            });
        });
        function gz(id){
            guanzhu(id)
        }

        //好友关注
       function guanzhu(id){
           var to_uid = id;
            $.ajax({
                url:'/home/user/reletion',
                type: "get",
                data :{to_uid:to_uid},
                async:true,
                success: function(data){
                    if(data == 1){
                       $('#guanzhu').text('关注');
                    }else{
                        $('#guanzhu').text('已关注');
                    }
                }
            });
        };
    </script>
@endsection

