
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<meta http-equiv="Pragma" content="no-cache"> 
<meta http-equiv="Cache-Control" content="no-cache"> 
<meta http-equiv="Expires" content="0"> 
<title>后台登录</title> 
<link href="/css/admin/login.css" type="text/css" rel="stylesheet"> 
<script src="/js/com/jquery.min.js"></script>
</head> 
<body> 

<div class="login">
    <div class="message">享趣-管理登录</div>
    <div id="darkbannerwrap"></div>
    
    <form method="post" action="{{url('/admin/doLogin')}}">
        {{csrf_field()}}
        <input name="mangerName" placeholder="用户名" required="" type="text">
        <hr class="hr15">
        <input name="password" placeholder="密码" required="" type="password">
        <hr class="hr15">
        <input name="code" id ='loginCode' placeholder="验证码" required="" type="text" style="width:182px;height:37px;margin-right:20px;">
        <div style="float:right;">
           {!!captcha_img()!!} 
        </div>
        <hr class="hr15">
        <input value="登录" style="width:100%;" id="adminLogin" type="submit" disabled>
        <hr class="hr20">
        <!-- 帮助 <a onClick="alert('请联系管理员')">忘记密码</a> -->
        
    </form>
    

    
</div>
<script>

    $('#loginCode').blur(function(){
        var code = $(this).val();
          $.ajax({
           url:'/admin/doCode',
           type:'get',
            data:'code='+code,
            async:true,
           success:function (data) {
                $('#adminLogin').removeAttr('disabled');
           },
           error:function (data) {
                var json = JSON.parse(data.responseText);
                alert(json.code[0]);
                window.location.reload()
           }
           
        });
    });


</script>

</body>
</html>