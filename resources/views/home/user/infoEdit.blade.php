@extends('layouts.master')

@section('title', '信息设置')

@section('css')
	<link rel="stylesheet" type="text/css" href="/css/home/zgz_infoEdit.css">
	
@section('content')
	<!-- 中间部分 -->
	<div id="content">
	<!-- 主体头部分 -->
		<div class="block">
			<div class="box">
				<h2 class="bar_font">
					<a href="#">我的堆糖</a> &raquo; 
					<a href="#">账号设置</a> &raquo; 
					<a href="#">基本信息</a>
				</h2>
			</div>
			<div class="pb8 set-mt15">
				<ul class="ctr-sw">
					<li id="person" data-info="set-info" class="cur">
						<a href="#">基本信息</a>
						
					</li>
					<li data-info="set-email">
						<a href="#">邮箱</a>
						
					</li>
					<li data-info="set-pwd">
						<a href="#">密码</a>
						
					</li>
				</ul>
			</div>
		</div>
		<!-- 基本信息 -->
		<div id="info">
			<div class="per_info">
				<div class="user_info">
					<form action="{{url('/home/user/doInfo')}}" method='post' enctype="multipart/form-data">
						{{csrf_field()}}
						<div class='iconBlock clearfix'>
							<div class="ps-info-img">
								<div class="ps-img-d">
									<img  id='pic' src="{{url($info['icon'])}}" alt="" width='120px' >
								</div>
							</div>
							<div class="set-selectpic">
								<div id="default-dec">
									享趣,分享生活中的趣事与感动,为了更好的展示自己的“个性”<br>
									点击下面的按钮,选择自己喜欢的图片吧！！
								</div>
								<div id="uploadIcon">
									<input name="icon" type="file" value="选择" size="20" id="fileUpload1" onchange ="uploadFile(this,1)">
									<label>上传图片</label>
								</div>
								<div id="default-dec">
									可以上传jpg,gif,png格式的图片，且文件小于2M
								</div>

							</div>
						</div>
					<hr class="fengge">
						<table class="user_person">
							<tbody>
								<tr>
									<td>		
										<input type="hidden" name="id" value="{{$info['id']}}">
									</td>
								</tr>
								<tr>	
									<th>用户名</th>
									<td><input type="text" name="userName" value="{{$info['userName']}}"></td>
								</tr>
								<tr>
									<th>性别</th>
									<td>
										<input type="radio" name="sex" value="0" {{$info['sex'] ==0 ? 'checked': ''}}>&nbsp;&nbsp;男
										<input type="radio" name="sex" value="1" {{$info['sex'] ==1 ? 'checked': ''}}>&nbsp;&nbsp;女
									</td>
								</tr>
								<tr>
									<th>城市</th>
									<td>
										<select name="">
											<option value="0">不限</option>
											<option value="1">上海</option>
										</select>
										<select name="">
											<option value="">不限</option>
											<option value="">宝山区</option>
										</select>
									</td>
								</tr>
								<tr>
									<th style="vertical-align: top">一句话介绍自己</th>
									<td>
										<div style="margin-top:15px;margin-bottom: 10px;">说说你喜欢什么，也可以写上你的新浪微博、豆瓣、个人博客等。</div>
										<textarea name="desc" rows="10" cols="70" maxlength="70"	{{$info['desc']}}></textarea>
									</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>
										<div class="abtn">
											<button class="btn-primary bb" type="submit">保存设置</button>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</form>
				</div>
			</div>
			<!-- 邮箱 -->
			<div class="per_email">
				<form action="{{url('/home/user/emailUpdate')}}" method="post">
					{{csrf_field()}}
					<table>
						<tbody>
							<tr>
								<th>邮箱地址</th>
								<td>
									<input type="hidden" name="id" value="{{$info['id']}}">
									<input type="text" name="email" value="{{$info['email']}}">
									<span class="change_mail">(更改邮箱地址)</span>
								</td>
							</tr>
							<tr>
								<th>确认密码</th>
								<td>
									<input type="password" name="password">
									<span class="change_mail">(请输入堆糖的密码,以确认修改邮箱地址)</span>
								</td>
							</tr>
							<tr>
								<th>&nbsp;&nbsp;</th>
								<td>
									<div class="abtn">
										<button class="btn-primary bb" type="submit">保存设置</button>
									</div>
								</td>
							</tr>	
						</tbody>
					</table>
				</form>
			</div>
			<!-- 密码 -->
			<div class="per_pass">
				<form action="{{url('/home/user/passEdit')}}" method="post">
					{{csrf_field()}}
					<table>
						<tbody>
							<tr>
								<th>当前密码</th>
								<td>
									<input type="hidden" name="id" value="{{$info['id']}}">
									<input type="password" name="old_pass">
								</td>
							</tr>
							<tr>
								<th>新密码</th>
								<td>
									<input type="password" name="new_pass">
								</td>
							</tr>
							<tr>
								<th>确认新密码</th>
								<td>
									<input type="password" name="reNew_pass">
								</td>
							</tr>
							<tr>
								<th>&nbsp;&nbsp;</th>
								<td>
									<div class="abtn">
										<button class="btn-primary bb" type="submit">保存设置</button>
									</div>
								</td>
							</tr>	
						</tbody>
					</table>
				</form>
			</div>			
		</div>
	</div>
@endsection
@section('js')
	<script>
		$(function(){
			$(".ctr-sw li").click(function() {
			    $(this).addClass('cur').siblings().removeClass('cur');
				var index = $(this).index();
				$("#info > div").eq(index).show().siblings().hide();
			});
		})
		function uploadFile(obj, type) {  
  
		    $.ajaxFileUpload({  
		        url : "http://localhost:8081/ws2/servlet/fileUpload",  
		        secureuri : false,// 一般设置为false  
		        fileElementId : "fileUpload"+type,// 文件上传表单的id <input type="file" id="fileUpload" name="file" />  
		        dataType : 'json',// 返回值类型 一般设置为json  
		        data: {'type': type, "type2":2},  
		          
		        success : function(data) // 服务器成功响应处理函数  
		        {  
		                },  
		        error : function(data)// 服务器响应失败处理函数  
		        {  
		            console.log("服务器异常");  
		        }  
		    });  
		    return false;  
		}

        $(function() {
            $("#pic").click(function () {
                $("#fileUpload1").click(); //隐藏了input:file样式后，点击头像就可以本地上传
                $("#fileUpload1").on("change",function(){
                    var objUrl = getObjectURL(this.files[0]) ; //获取图片的路径，该路径不是图片在本地的路径
                    if (objUrl) {
                        $("#pic").attr("src", objUrl) ; //将图片路径存入src中，显示出图片
                    }
                });
            });
        });

        //建立一個可存取到該file的url
        function getObjectURL(file) {
            var url = null ;
            if (window.createObjectURL!=undefined) { // basic
                url = window.createObjectURL(file) ;
            } else if (window.URL!=undefined) { // mozilla(firefox)
                url = window.URL.createObjectURL(file) ;
            } else if (window.webkitURL!=undefined) { // webkit or chrome
                url = window.webkitURL.createObjectURL(file) ;
            }
            return url ;
        }

	</script>
@endsection