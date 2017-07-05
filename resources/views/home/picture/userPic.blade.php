@extends('layouts.master')

@section('title', '用户专辑')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/home/picture.css">
    <link rel="stylesheet" type="text/css" href="/css/home/project.css">
    <style>
        .pic-area{overflow:hidden;width:100%;min-height: 400px;margin:0 auto}
        .pic-dis{margin:0 15px 20px 0;padding:5px;border:1px solid #ccc;float:left;}
        .pic-dis .pic-info{min-width:100%;min-height:50px;padding:10px}
        .pic-dis .pic-info form{display:none;}
        .pic-info-other{margin-top:20px;}
        .pic-info-other p{float:left;}
        .pageInfo{text-align:center;}
        .pageInfo ul{display:inline-block;}
        .pageInfo ul li{font-weight: 700;color:#fff;background-color: #5BA5E8;width:50px;height:36px;border-radius:3px;float:left;margin-left:20px;text-align:center;line-height:36px;display:inline;}
    </style>
 	<style>
 		/* .bq-choose-edit button{
 			width: 46px;
 			height: 30px;
 			background: #fff;
 			text-align: center;
 			padding-left;
 		} */
 	</style>
@endsection


@section('content')
	<div id="content"> 
   <div class="album-header"> 
    <!-- 注释了改改改 --> 
    <!-- 注释了改改改end --> 
     
    <div class="album-header-bg-mask"></div> 
    <table class="album-header-info tc"> 
     <tbody> 
      <tr> 
       <td> <h1 class="album-title">{{$albumInfo['albumName']}}</h1> <p class="album-info"><span class="album-count">{{$count}}张图片</span> </td> 
      </tr> 
     </tbody> 
    </table> 
    <div class="album-header-attr-mask"></div> 
    <div class="album-header-attr tc"> 
     <a class="album-account" href="#"> <img class="avatar" src="{{url($albumInfo['icon'])}}" /> <span class="name">{{$albumInfo['userName']}}</span> </a> 
     <div class="album-action dib"> 
      <a title="发布" id="upload-Img-Btn" class="album-post" href="javascript:;"><span>发布趣图</span></a> 
       
     </div> 
     <div id="album-edit" class="album-edit"> 
      @if(Auth::user()->userName == $albumInfo['userName'])
      <a href="javascript:;" id="editAlbum">编辑</a> 
      @endif
     </div> 
    </div> 
    <div class="album-header-mask dn"></div> 
   </div> 
   <div class="album-content"> 
    <div id="woo-holder"> 
     <a name="woo-anchor"></a> 
     <div class="albumshowstyle clr dymswitch-0" style="opacity: 1;"> 
      <a title="列表显示" class="woo-swa cur woo-cur" href="javascript:;">列表展示</a> 
      <a title="幻灯片显示" id="albumentr" href="javascript:;" data-albuminfo="{&quot;id&quot;:84678263,&quot;tot&quot;:0}" onmousedown="$.G.gaq('/_trc/Album/_/slider_entry');" class="">幻灯播放</a> 
      <!-- <a title="专辑评论" class="album-reply" href="javascript:;">专辑评论</a> --> 
     </div> 
      
    </div>
   </div> 
   <div class="pic-area">
   @foreach( $picInfo as $res )
   
     <div class="pic-dis">
        <a href="{{url('/comUser/delate')}}/{{$res['id']}}" title="">
          <img src="{{url($res['picName'])}}"  height="100px" style="box-shadow: 2px 2px 3px 0px">
        </a>
        <div class="pic-info">
          <p>{{$res['picDesc']}}</p>
         
          <div class="pic-info-other">
            <p>...</p>
            <div style="float:right;margin-left:15px">
              <span>点击图片查看详情</span>
            </div>
          </div>
          

        </div>
     </div>
      
   @endforeach
   </div>
    <div class="pageInfo">
        <ul class="clearfix">
            @for ($i = 1; $i <= $picInfo->lastPage(); $i++)
                <a href="{{ $picInfo->url($i) }}"><li>
                    {{ $i }}
                </li></a>
            @endfor
        </ul> 
    </div>
  </div> 
  
  <div class="add-user-album clearfix" id="edit-Album-Box">
        <div class='tt-s clearfix'>
            <span style="font-weight: 700;">编辑专辑</span>
            <div id="add-album-logout" class="edit-Album-Box">
                <span class="glyphicon glyphicon-remove"></span>
            </div>
        </div>
        <div style="width:340px;margin:20px 20px;float:left">
            <form role="form" id="update-Album-info">
              <div class="row" style="margin-bottom:5px">
                <div class="col-lg-2">
                  <small>名称</small>
                </div>
                <div class="col-lg-10">
                  <input type="hidden" name="id" value="{{$albumInfo['id']}}" >
                  <input type="text" class="form-control" name="albumName" placeholder="专辑名称" value="{{$albumInfo['albumName']}}">
                </div>
              </div>
              <div class="row" style="margin-bottom:5px">
                <div class="col-lg-2">
                  <small>描述</small>
                </div>
                <div class="col-lg-10">
                  <textarea class="form-control" rows="3" name="desc">{{$albumInfo['desc']}}</textarea>
                </div>
              </div>
              <div class="row" style="margin-bottom:5px">
                <div class="col-lg-2">
                  <small>标签</small>
                </div>
                <div class="col-lg-10">
                  <input type="text" class="form-control" id="albumLabelInfo1" name="label" placeholder="专辑标签" value="{{$albumInfo['label']}}">
                </div>

              </div>
              <button type="button" class="btn btn-info" id="submit-update-album" style="margin-left:62px"> 提 交 编 辑</button>
            </form>
        </div>
        <div class="bq-choose bq-choose-edit" id="album-bq-choose1">
            <span>常用标签选择</span>
            <ul>
                <li><button type="button" class="btn btn-default btn-sm">美食</button></li>
                <li><button type="button" class="btn btn-default btn-sm">趣事</button></li>
                <li><button type="button" class="btn btn-default btn-sm">衣服</button></li>
                <li><button type="button" class="btn btn-default btn-sm">旅游</button></li>
                <li><button type="button" class="btn btn-default btn-sm">时尚</button></li>
                <li><button type="button" class="btn btn-default btn-sm">明星</button></li>
                
            </ul>
        </div>
        <a href="{{url('/home/album/delete')}}/{{$albumInfo['id']}}/{{Auth::user()->id}}"><button type="button" class="btn" style="position:absolute;bottom:17px;right:55px;color:#fff">删除专辑</button></a>
    </div>
   
    
</div>
@endsection

@section('js')
    <script>

        $(function(){


              //退出弹出编辑框
              $('#editAlbum').click(function(){;
                $('#edit-Album-Box').css('display','block');
              });
              $('.edit-Album-Box').click(function(){
                  $('#edit-Album-Box').css('display','none');
              });
              //修改编辑标签
              $('#album-bq-choose1 button').click(function(){
              var labelVal = $(this).text();
              $('#albumLabelInfo1').val(labelVal);
              });

              //编辑专辑
              $('#submit-update-album').click(function(){
                $.ajax({
                  url:'/home/album/update',
                  type:'post',
                  data:$("#update-Album-info").serialize(),
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                  success:function (data) {
                    window.location.reload();
                  },
                  error:function (data)
                  {
                    var json = JSON.parse(data.responseText);
                    var errorInfo = '';

                      $.each(json,function(k,v){
                        errorInfo += v[0]+', ';
                      })
                      alert(errorInfo);
                  },
                });
              });
        })

    </script>
@endsection