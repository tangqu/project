@extends('layouts.master')

@section('title', '用户登录')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/home/zgz_reg.css">

@section('head')
    <!-- 头部 -->
	<div class="pg-header">
		<div class="pg-head">
			<a class="pg-home" href="#">
				<img class="pg-logo" src="/picture/home/logo.png">
			</a>
			<div class="pg-logbtns">
				<a class="pg-log" href="{{url('/reg')}}">注册</a>
				<span>|</span>
				<span class="pg-reg active">登录</span>
				<span>|</span>
				<a href="{{url('/')}}" class='pg-log'>返回首页</a>
			</div>
		</div>
	</div>
@endsection

@section('content')

	<div class="container login" style="width:400px" >

      <form class="form-signin" action="{{url('doLogin')}}" method='post' id ='login'>
        {{csrf_field()}}
        <input type="text" name='userName' class="form-control" placeholder="用户名" required autofocus>
  
        <input type="password" name='password' class="form-control" placeholder="密码" required>

		  <div class="row">
			  <div class="col-lg-7">
				  <input type="text" name='code' id='loginCode' class="form-control" placeholder="请输入验证码" required>
			  </div>
			  <div class="col-lg-4">
				  {!!captcha_img()!!}
			  </div>
		  </div>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me" > 记住账号
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" disabled id="homeLogin">登录</button>
      </form>

    </div>	

@endsection

@section('foot')
@endsection
@section('js')
	<script>
		

        $('#loginCode').blur(function(){
        	var code = $(this).val();
	          $.ajax({
	           url:'/loginCode',
	           type:'get',
				data:'code='+code,
	            async:true,
	           success:function (data) {
	           		$('#homeLogin').removeAttr('disabled');
			   },
			   error:function (data) {
			   		var json = JSON.parse(data.responseText);
			   		alert(json.code[0]);
			   		window.location.reload();
			   }
			   
			});
        });
        
       
	</script>
@endsection