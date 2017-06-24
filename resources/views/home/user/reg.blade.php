@extends('layouts.master')

@section('title', '用户注册')

@section('css')
	<meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" type="text/css" href="/css/home/zgz_reg.css">

@section('head')
    <!-- 头部 -->
	<div class="pg-header">
		<div class="pg-head">
			<a class="pg-home" href="#">
				<img class="pg-logo" src="/picture/home/logo.png">
			</a>
			<div class="pg-logbtns">
				<span class="pg-reg active">注册</span>
				<span>|</span>
				<a class="pg-log" href="{{url('login')}}">登录</a>
				<span>|</span>
				<a href="{{url('/')}}" class='pg-log'>返回首页</a>
			</div>
		</div>
	</div>
@endsection

@section('content')

	<div style="width:700px; margin:0 auto;position:relative;">
		<div class="container login" style='width:400px'>

	      <form class="form-signin" action="{{url('doReg')}}" method='post' id="userReg">
	        {{csrf_field()}}
	        <input type="text" name='phone' id ='userPhone' class="form-control" placeholder="请输入手机号" required autofocus>
			
			<input type="text" name='userName' id="userName" class="form-control" placeholder="请输入用户名" required>

	        <input type="password" name='password' id="userPass" class="form-control" placeholder="请输入密码" required>

	        <div class="row">
				<div class="col-lg-7">
					<input type="text" name='phoneCode' id = 'code' class="form-control" placeholder="请输入验证码" required>
				</div>
				<div class="col-lg-5">
					<button id = 'send_sms' class="form-control">获取验证码</button>
				</div>
			</div>

	        <button class="btn btn-lg btn-primary btn-block" type="submit">注册</button>
	      </form>

	    </div>

	    <div class='phoneError' style="position:absolute;top:8px;left:550px"></div>
	    <div class='nameError' style="position:absolute;top:60px;left:550px"></div>
	    <div class='passError' style="position:absolute;top:112px;left:550px"></div>
	    <div class='codeError' style="position:absolute;top:169px;left:550px"></div>


	</div>

@endsection

@section('foot')
@endsection

@section('js')
	<script> 

	var reg = true;
	var phonereg = 0;

        $('#userPhone').blur(function(){
        	var phone = $(this).val();
            var regex=/^1[34578][0-9]{9}$/;
              if(phone.length==0){
                  $(".phoneError").html('<font color="red">手机号不能为空</font>');
                  reg = false;
              }else if(!regex.test(phone)){
                  $(".phoneError").html('<font color="red">手机号码格式错误</font>');
                  reg = false;
              }else{
                  $.ajax({
	               url:'/regPhone',
	               type:'post',
					data:{phone:phone},
	                async:true,
	                headers: {
	                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                },
	               success:function (data) {
	               		if (data == false) {
	               			$(".phoneError").html('<font color="red">该手机号已注册</font>');
	               			reg = false;
	               		} else {
	               			$(".phoneError").html('<font color="green">填写正确</font>');
	               			phonereg = 1;
	               			reg = true;
	               		}
	                   
				   },
				   
				});
              }
        });

        $('#userName').blur(function(){
        	var name = $(this).val();
        	if(name.length==0){
                  $(".nameError").html('<font color="red">用户名不能为空</font>');
                  reg = false;
              }else{
                  $.ajax({
	               url:'/regName',
	               type:'post',
					data:{name:name},
	                async:true,
	                headers: {
	                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                },
	               success:function (data) {
	               		if (data == false) {
	               			$(".nameError").html('<font color="red">用户名已注册</font>');
	               			reg = false;
	               		} else {
	               			$(".nameError").html('<font color="green">填写正确</font>');
	               			phonereg = true;
	               			reg = true;
	               		}
				   },
				   
				});
              }
        });

         $('#userPass').blur(function(){
        	var pass = $(this).val();
        	if(pass.length==0){
                $(".passError").html('<font color="red">密码不能为空</font>');
                  reg = false;
            } else {
            	$(".passError").html('<font color="green">填写正确</font>');
            	reg = true;
            }
        });
         $('#code'),blur(function(){
             var code = $(this).val();
             if(code.length == 0){
                 $(".codeError").html('<font color="red">请填写验证码</font>');
                 reg = false;
			 };
		 });

        $('#userReg').submit(function(){
        	return reg;
        });

		//手机验证码发送事件

            $('#send_sms').click(function () {
                //获取用户手机号

				if(phonereg)
				{
                    var phone = $('#userPhone').val();
                    var time = 120;
                    $.ajax({
                        url: '/sendSms',
                        type: 'get',
                        data: {phone: phone},
                        success: function (data) {
                            if (data.status == 0) {
                                var run = setInterval(function () {
                                    $('#send_sms').text((--time) + 's  '+data.message);
                                    $('#send_sms').attr('disabled', true);
                                    if (time == 0) {
                                        time = 120
                                        clearTimeout(run)
                                        $('#send_sms').text('获取验证码');
                                        $('#send_sms').attr('disabled', false);
                                    }
                                }, 1000);
                            } else if (data.status == 2) {
                                $(".codeError").html('<font color="red">验证码发送错误</font>');
                            }
                        },
                        dataType: 'json',
                    });
				}


            });





	</script>

@endsection