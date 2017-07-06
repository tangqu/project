$(function(){
	//弹出退出框
	$('#upload-Img-Btn,#upload-Img-Btn1').click(function(){
        $('#upload-Img-Box').css('display','block');
        $.ajax({
        	url:'/home/picture/userAlbum',
        	type:'get',
        	success:function (data) {
                $('#user-Album-pic-opt').empty();
        		$('#Cate-pic-opt1').empty();
                $('#user-Album-pic-opt').append('<option value="0">请选择专辑</option>');
                $('#Cate-pic-opt1').append('<option>请选择分类</option>');
				$.each(data.album,function(k,v){
					$('#user-Album-pic-opt').append('<option value="'+data.album[k].id+'">'+data.album[k].albumName+'</option>');
   				});
                cateInfo = data.cate;

                $.each(cateInfo,function(k,v){
                    if(cateInfo[k].path == 1){
                        $('#Cate-pic-opt1').append(cate = '<option value="'+cateInfo[k].id+'">'+cateInfo[k].cateName+'</option>');
                    }
                    
                });
			},
			dataType:'json'
        });
        $('#Cate-pic-opt1').change(function(){
            $('#Cate-pic-opt2').empty();
            $.each(cateInfo,function(k,v){
                 if(cateInfo[k].pid == $('#Cate-pic-opt1').val() && cateInfo[k].path == 2){
                        $('#Cate-pic-opt2').append(cate = '<option value="'+cateInfo[k].id+'">'+cateInfo[k].cateName+'</option>');
                 } 
            });
        });
        $('#Cate-pic-opt2').change(function(){
            $('#Cate-pic-opt3').empty();
            $.each(cateInfo,function(k,v){
                 if(cateInfo[k].pid == $('#Cate-pic-opt2').val() && cateInfo[k].path == 3){
                        $('#Cate-pic-opt3').append(cate = '<option value="'+cateInfo[k].id+'">'+cateInfo[k].cateName+'</option>');
                 } 
            });
        });
    });
    $('#upload-Img-logout').click(function(){
        $('#upload-Img-Box').css('display','none');
    });

    //验证信息
    $('#imgForm').submit(function(){

        if(!$(".picUpload").val()){
           alert('上传图片不能为空');
           return false;
         } else if($("#user-Album-pic-opt").val() == 0){
            alert('请选择专辑');
            return false;
        }else if(!$("#Cate-pic-opt3").val()){
            alert('请选择分类');
            return false;
        }

    });
});
