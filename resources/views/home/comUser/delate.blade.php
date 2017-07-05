@extends('layouts.master')
	
@section('css')

<style>
	body{
		background: #F1F2F3 !important;
	}
	.gn{
		margin-top: 0px !important;
	}
	.delate-back-img{
		
		width: 1200px;
		width:100%;
		-webkit-filter: blur(35px);
		position: absolute;
		top: 0;
		left: 0;
		
	}
</style>

@endsection


@section('content')
	<div class="delate-back" style="width:1200px;height:400px;overflow:hidden;margin:0 auto;text-align:center;">
	<div style="width:1200px;min-height:400px;position:relative;">
		<img src="{{url($picInfo['picName'])}}" alt="" class="delate-back-img">
		<div >
			<div style="margin:0 auto;padding:10px;background:#fff;min-width:100px;display:inline-block;position:absolute;left:30%;top:10%">
				<img src="{{url($picInfo['picName'])}}" alt="" height='300px'>
			</div>
		</div>
	</div>
		
	</div>
	
	<style>
		.delate-Info{
			width:1200px;min-height:300px;margin:20px auto;
		}
		.delate-pic-Allinfo{
			float:left;width:712px;background:#fff;border: 1px solid #EBEBEB
		}
		.delate-pic-Allinfo .userInfo{

		}
		.delate-pic-Allinfo .userInfo img{
			width:40px;border-radius: 50%;margin:7px 10px;float: left;
		}
		.delate-pic-Allinfo .userInfo p{
			margin-top: 10px;
		}

		.user-content{
			width:466px;height:121px;background:#fff;padding: 24px 16px;border: 1px solid #EBEBEB
		}
		.content-area div{
			float: left;
			margin-left: 5px;
		}
		.content-area .dianzan{
			height: 32px;width: 40px;border-radius: 2px;background: #FFBB33;text-align: center;color: #fff;font-size:14px;padding-top:7px;cursor: pointer}
		.content-area .content-bf{
			width: 312px;
		}
		.content-area .content-bf .content-text , .update-content-info{
			width:100%;height:32px;margin-bottom:15px;padding-left:20px;
		}
		.mb-content{
			width:100%;background:#fff;border:1px solid #EBEBEB;padding:16px;
		}
		.mb-content img{
			width:40px;height:40px;float:left;margin:10px 20px 0 0;
		}
		.mb-content .content-info{
			float:left;font-size:12px;width:350px;
		}
		.mb-content .content-info .all-content-info{
			width:100%;margin-bottom: 10px;margin-top:7px;
		}
		.collect{
			border: 1px solid #EBEBEB;height:60px;padding: 10px 20px;
		}
		.collect button{
			float: right;margin: 0 10px;
		}
	</style>
	<div class="delate-Info clearfix">
		<div class="delate-pic-Allinfo"> 
			<div class="userInfo">
				<img src="{{url($fbInfo['icon'])}}" alt="" >
				<p>by `{{$fbInfo['userName']}}` | 发布于*{{$alInfo['updated_at']}}</p>
				<p> 发布到 {{$alInfo['albumName']}}</p>
			</div>
			<div class="collect clearfix">
				@if(Auth::check())
					<button type="button" class="btn btn-default" onclick=picCollect({{Auth::user()->id}},{{$picInfo['id']}})>
						<span class="glyphicon glyphicon-star-empty"></span>收集数{{$ccCount}}
					</button>
					<button type="button" class="btn btn-info" id="picCollectUser" onclick=ckPicCollect({{$picInfo['id']}})>
						查看收集用户
					</button>
				@endif
			</div>
			
		</div>
		
		<div style="padding-bottom:25px;float:right;width:466px;">
			<!-- 输入评论 + 点赞区 -->
			@if (Auth::check())
				<!-- 登录后显示 -->
				<span style="display:none" id="nowUserName">{{Auth::user()->userName}}</span>
				<div class="user-content">
					<div class="content-area clearfix">
						<div class="dianzan" onclick=dianzan({{Auth::user()->id}},{{$picInfo['id']}})>
							<span class="glyphicon glyphicon-thumbs-up"></span>
							<span>{{$dzCount}}</span>
						</div>
						<div class="dianzan" style="background:#ccc;" onclick=qxDianZan({{Auth::user()->id}},{{$picInfo['id']}})>
							<span class="glyphicon glyphicon-remove-sign"></span>
						</div>
						<div class="content-bf">
							<form id="user-content-info">
								{{csrf_field()}}
								<input type="hidden" name="pic_id" value="{{$picInfo['id']}}">
								<input type="text" name="content" placeholder="你有什么(ˇˍˇ) 想～说的？？" class="content-text">
								<input type="hidden" name="user_id" value="{{Auth::user()->id}}">		
								<button type="button" class="btn btn-default"  id="content-submit">评论</button>
								<button type="button" onclick=picContentList({{$picInfo['id']}}) title="" class="btn btn-info" id="ckContent">查看评论</button>
							</form>
						</div>
						
					</div>
				</div>
				<!-- 获取评论区 -->
				<div id="allContentArea"></div>
			@else
				<!-- 登录前显示 -->
				<div class="user-content">
					<div class="content-area clearfix">
						<div class="dianzan" style="background:#ccc;" >
							<span class="glyphicon glyphicon-thumbs-up"></span>
							<span>{{$dzCount}}</span>
						</div>
						<div class="content-bf">
							<form id="user-content-info">
								<input type="text" name="content" placeholder="你有什么(ˇˍˇ) 想～说的？？" class="content-text">
								<button type="button" class="btn btn-default">请先登录</button>
							</form>
						</div>
					</div>
				</div>
			@endif

		</div>
	</div>
		

    
@endsection

@section('js')
	<script src="/js/com/jquery.tmpl.js"></script>
	<!--评论回复模板-->
	<script type="text/html" id="temp">

		<div class='mb-content clearfix'>
				
			<img src="${icon}" alt="">
			<div class="content-info">
				<div class="all-content-info clearfix" >
					<div style='color:#444444;float:left;'>by `${userName}`</div> 
					<div style="color:#BBBBBB;float:right;">${created_at}</div>
				</div>
				{%if userName == nowUserName %}
					<div class="all-content-info clearfix" >
						<div style='color:#666666;float:left;'>ta说:${content}</div> 
						<div style="color:#666666;float:right;">
							<span onclick=contentEdit(${id}) style="cursor: pointer;">修改</span> | 
							<a href="{{url('/home/content/delete')}}/${id}">删除</a> | 
							<span onclick=ckReply(${id},0) style="cursor: pointer;" id="ckReply_${id}">查看回复</span>
						</div>
					</div>
					<!-- 更新评论信息表单 -->
					<div style="width:100%;display:none" id="content-update-form">
						<form id="content-update-info">
							{{csrf_field()}}
							<input type="hidden" name="id" value=${id}>
							<input type="text" name="content" class="update-content-info">
							<button type="button" class="btn btn-info btn-sm" onclick=updInfoSub()>提交</button>
						</form>
					</div>	
				{%else%}
					<div class="all-content-info clearfix" >
						<div style='color:#666666;float:left;'>ta说:${content}</div> 
						<div style="color:#666666;float:right;">
							<span onclick=reply(${id}) style="cursor: pointer;">回复</span> | 
							<span onclick=ckReply(${id},0) style="cursor: pointer;" id="ckReply_${id}">查看回复</span>
						</div>
					</div>
					<div style="width:100%;display:none" id="replyDiv_${id}">
						<form id="replySubmitForm_${id}">
							{{csrf_field()}}
							<input type="hidden" name="com_id" value=${id}>
							{%if reply_id %}
							<input type="hidden" name="reply_id" value=${id}>
							{%else%}
							<input type="hidden" name="reply_id" value="0">
							{%/if%}
							<input type="hidden" name="userS_name" value=${nowUserName}>
							<input type="hidden" name="userR_name" value=${userName}>
							<input type="text" name="content" class="update-content-info" id="replyContent_${id}">
							<button type="button" class="btn btn-info btn-sm" onclick=submitReply(${id})>回复</button>
						</form>
					</div>
						
				{%/if%}
			</div>
		</div>
	</script>

	<script type="text/html" id="temp1">

		<div class='mb-content clearfix'>
				
			<img src="${icon}" alt="">
			<div class="content-info">
				<div class="all-content-info clearfix" >
					<div style='color:#444444;float:left;'>by `${userS_name}`</div> 
					<div style="color:#BBBBBB;float:right;">${created_at}</div>
				</div>
				{%if userS_name == nowUserName %}
					<div class="all-content-info clearfix" >
						<div style='color:#666666;float:left;'>ta 对 `${userR_name}` 说:${content}</div> 
						<div style="color:#666666;float:right;">
							<span onclick=replyEdit(${id}) style="cursor: pointer;">修改</span> | 
							<a href="{{url('/home/picReply/delete')}}/${id}">删除</a> | 
							<span onclick=ckReplyR(${com_id},${id}) style="cursor: pointer;" id="ckReplyR_${id}">查看回复</span>
						</div>
					</div>
					<!-- 更新评论信息表单 -->
					<div style="width:100%;display:none" id="reply-update-form_${id}">
						<form id="reply-update-info_${id}">
							<input type="hidden" name="id" value=${id}>
							<input type="text" name="content" class="update-content-info_${id}" style="width:100%;height:32px;margin-bottom:10px">
							<button type="button" class="btn btn-info btn-sm" onclick=updReplyInfo(${id})>提交</button>
						</form>
					</div>	
				{%else%}
					<div class="all-content-info clearfix" >
						<div style='color:#666666;float:left;'>ta 对 `${userR_name}` 说:${content}</div> 
						<div style="color:#666666;float:right;">
							<span onclick=reply(${id}) style="cursor: pointer;">回复</span> | 
							<span onclick=ckReplyR(${com_id},${id}) style="cursor: pointer;" id="ckReplyR_${id}">查看回复</span>
						</div>
					</div>
					<div style="width:100%;display:none" id="replyDiv_${id}">
						<form id="replySubmitForm_${id}">
							{{csrf_field()}}
							<input type="hidden" name="com_id" value=${id}>
							{%if reply_id %}
							<input type="hidden" name="reply_id" value=${id}>
							{%else%}
							<input type="hidden" name="reply_id" value="0">
							{%/if%}
							<input type="hidden" name="userS_name" value=${nowUserName}>
							<input type="hidden" name="userR_name" value=${userName}>
							<input type="text" name="content" class="update-content-info" id="replyContent_${id}">
							<button type="button" class="btn btn-info btn-sm" onclick=submitReply(${id})>回复</button>
						</form>
					</div>
						
				{%/if%}
			</div>
		</div>
	</script>
	<script type="text/html" id="temp2">
		<div class="collect">
			<img src="./123.png" alt="" width="40px" height="40px" style="float:left">
			<div class="clearfix" style="margin:20px 0 0 70px">
				<div style="float:left">收藏用户: `${userName}`</div>
				<div style="float:right">收藏于:${created_at}</div>
			</div>
		</div>
	</script>
	<script>
		//点击收藏图片
		function picCollect($uid,$pid){
			var user_id = $uid;
			var pic_id = $pid;
			$.ajax({
				url:'/home/picCollect/add',
				type:'get',
				data:{user_id:user_id,pic_id:pic_id},
				success:function(data){
					if(data == 0){
						alert('你已经收藏过了！！');
					} else if(data == 1) {
						alert('收藏成功！！');
						window.location.reload();
					}
				}
			})
		}
		//查看图片
		function ckPicCollect($pic_id){
			var pic_id = $pic_id;
			$.ajax({
				url:'/home/picCollect/list',
				type:'get',
				data:{pic_id:pic_id},
				success:function(data){
					$("#temp2").tmpl(data).appendTo(".delate-pic-Allinfo");
				}
			});
			$('#picCollectUser').attr('disabled',true);

		}
		//点赞:点击事件
		function dianzan($uid,$pid){
			var uid = $uid;
			var pid = $pid;
			$.ajax({
				url:'/home/picture/praiseAdd',
				type:'get',
				data:{uid:uid,pic_id:pid},
				success:function(data) {
					console.log(data);
					if(data == 0){
						alert('你已经点赞过了！！');
					} else if(data == 1) {
						alert('点赞成功！！');
						window.location.reload();
					}
				},

			})
		}
		//取消点赞
		function qxDianZan($uid,$pid){
			var uid = $uid;
			var pid = $pid;
			$.ajax({
				url:'/home/picture/praiseQx',
				type:'get',
				data:{uid:uid,pic_id:pid},
				success:function(data) {
					console.log(data);
					if(data == 0){
						alert('你未点赞该图片！！');
					} else if(data == 1) {
						alert('取消成功！！');
						window.location.reload();
					}
				}
			})
		}
		//提交评论
		$('#content-submit').click(function(){
			if(!$('input[name="content"]').val()){
				alert('评论不能为空!!');
			}else{
				$.ajax({
					url:'/home/content/add',
					type:'post',
					data:$("#user-content-info").serialize(),
					success:function(data){
						if(data == 1){
							alert('评论成功');
						} else if(data == 0){
							alert('你以评论过该图片,可点击查看评论查看');
						}
					}
				});
			}
		})

		//查看评论
		function picContentList($pid){
			var pid = $pid;
			if($("#allContentArea > div").length == 0){
				$.ajax({
					url:'/home/content/list',
					type:'get',
					data:{pic_id:pid},
					success:function(data){	
						$.each(data,function(k,v){
							data[k].nowUserName = $('#nowUserName').text();
   						});
   						console.log(data);
						$("#temp").tmpl(data).appendTo("#allContentArea");
					},
				})
				$('#ckContent').text('往上回拉');
			} else {
				$('#allContentArea').empty();
				$('#ckContent').text('查看评论');
			} 
		}

		//修改评论
		function contentEdit($com_id){
			$('#content-update-form').toggle(400);
		}
		//提交修改评论
		function updInfoSub(){
			if(!$('.update-content-info').val()){
				alert('评论不能为空!!');
			}else{
				$.ajax({
					url:'/home/content/update',
					type:'post',
					data:$("#content-update-info").serialize(),
					success:function(data){
						if(data == 1){
							alert('修改成功');
							window.location.reload();
						} else if(data == 0){
							alert('修改失败');
						}
					}
				});
			}
		}

		//回复评论
		function reply($id){
			$('#replyDiv_'+$id).toggle(400);
		}
		//提交回复
		function submitReply($id){
			if(!$('#replyContent_'+$id).val()){
				alert('回复不能为空!!');
			}else{
				$.ajax({
					url:'/home/picReply/add',
					type:'post',
					data:$("#replySubmitForm_"+$id).serialize(),
					success:function(data){
						if(data == 1){
							alert('回复成功');
							window.location.reload();
						} else if(data == 0){
							alert('你已经回复过了!!');
						}
					}
				});
			}
		}
		//查看回复
		function ckReply($com_id,$reply_id){
			var com_id = $com_id;
			var reply_id = $reply_id
			console.log($com_id,$reply_id);
				$.ajax({
					url:'/home/picReply/list',
					type:'get',
					data:{com_id:com_id,reply_id:reply_id},
					success:function(data){	
						$.each(data,function(k,v){
							data[k].nowUserName = $('#nowUserName').text();
   						});
   						console.log(data);
						$("#temp1").tmpl(data).appendTo("#allContentArea");
					},
				})
			$('#ckReply_'+com_id).text('');
		}
		function ckReplyR($com_id,$reply_id){
			var com_id = $com_id;
			var reply_id = $reply_id
			console.log($com_id,$reply_id);
				$.ajax({
					url:'/home/picReply/list',
					type:'get',
					data:{com_id:com_id,reply_id:reply_id},
					success:function(data){	
						$.each(data,function(k,v){
							data[k].nowUserName = $('#nowUserName').text();
   						});
   						console.log(data);
						$("#temp1").tmpl(data).appendTo("#allContentArea");
					},
				})
			$('#ckReplyR_'+reply_id).text('');
		}
		//更新回复
		function replyEdit($id){
			$('#reply-update-form_'+$id).toggle(400);
		}
		function updReplyInfo($id){
			if(!$('.update-content-info_'+$id).val()){
				alert('修改回复不能为空!!');
			}else{
				$.ajax({
					url:'/home/picReply/update',
					type:'get',
					data:$("#reply-update-info_"+$id).serialize(),
					success:function(data){
						if(data == 1){
							alert('修改成功');
							window.location.reload();
						} else if(data == 0){
							alert('修改失败');
						}
					}
				});
			}
		}

		//
		
	</script>
@endsection





