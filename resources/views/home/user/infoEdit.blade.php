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
					<div class='iconBlock clearfix'>
						<div class="ps-info-img">
							<div class="ps-img-d">
								<img src="{{url('/picture/home/icon.png')}}" alt="" width='120px' >
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
					<form action="" method='post'>
						<table class="user_person">
							<tbody>
								
								<tr>
									<td>		
										<input type="hidden" name="id">
									</td>
								</tr>
								<tr>	
									<th>登录名:</th>
									<td><input type="text" name="nickname"></td>
								</tr>
								
								<tr>
									<th>性别:</th>
									<td>
										<input type="radio" name="sex" value='1'>&nbsp;&nbsp;男
										<input type="radio" name="sex" value='2'>&nbsp;&nbsp;女
									</td>
								</tr>
								<tr>
									<th>城市:</th>
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
									<td>&nbsp;</td>
									<td>
										<div class="abtn">
											<buttom type="submit">保存设置</buttom>
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
				<form action="#" method="post">			
					<table>
						<tbody>
							<tr>
								<th>邮箱地址</th>
								<td>
									<input type="text" name="e_address">
									<span class="change_mail">(更改邮箱地址)</span>
								</td>
							</tr>
							<tr>
								<th>确认密码</th>
								<td>
									<input type="text" name="e_address">
									<span class="change_mail">(请输入堆糖的密码,以确认修改邮箱地址)</span>
								</td>
							</tr>
							<tr>
								<th>&nbsp;&nbsp;</th>
								<td>
									<div class="abtn">
										<buttom type="submit">保存设置</buttom>
									</div>
								</td>
							</tr>	
						</tbody>
					</table>
				</form>
			</div>
			<!-- 密码 -->
			<div class="per_pass">
				<form action="#" method="post">
					<table>
						<tbody>
							<tr>
								<th>当前密码</th>
								<td>
									<input type="password" name="old_pass">
								</td>
							</tr>
							<tr>
								<th>新密码</th>
								<td>
									<input type="password" name="new_pass">
									<span class="pass_info">密码至少是8位字母加数字</span>
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
										<buttom type="submit">保存设置</buttom>
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
	</script>
@endsection