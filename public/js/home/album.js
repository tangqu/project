$(function () {

	//弹出退出框
	$('#addAlbum,#addAlbum1').click(function(){
        $('#add-Album-Box').css('display','block');
    });
    $('#add-album-logout').click(function(){
        $('#add-Album-Box').css('display','none');
    });

    


	//创建专辑
	//选择专辑标签
	$('#album-bq-choose button').click(function(){
		var labelVal = $(this).text();
		$('#albumLabelInfo').val(labelVal);
	});

	$('#submit-add-album').click(function(){
		$.ajax({
			url:'/home/album/add',
			type:'post',
			data:$("#add-Album-info").serialize(),
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

	
});