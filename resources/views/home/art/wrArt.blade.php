<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/home/initial.css">
    <link rel="stylesheet" href="/css/home/wrArt.css">
    <script src="/js/com/jquery-1.8.3.min.js"></script>
    <script src="/js/com/jquery.validate.min.js"></script>
    <script src="/js/com/messages_zh.js"></script>
    <script src="/js/home/article.js"></script>
    <title>Document</title>
    {!! we_css() !!}
</head>
<body>
<form method="post" enctype="multipart/form-data" name="form" onsubmit="return false">
    {{csrf_field()}}
    <input type="hidden" name="uid" value="{{Auth::user()->id}}">
    <div class="article-content" id="addCommodityIndex">
        <div class="input-group row article-cover">
            <div class="col-sm-9 big-photo">
                <div id="preview">
                    <img id="imghead" border="0" src="" width="700" height="180" onclick="$('#previewImg').click();" name="img">
                </div>
                <input type="file" onchange="previewImage(this)" style="display: none;" id="previewImg" name="artPic">
                <!--<input id="uploaderInput" class="uploader__input" style="display: none;" type="file" accept="" multiple="">-->
            </div>
        </div>
        <textarea class="art-tit" dt-elastic="" max="30" placeholder="在此输入标题" style="height:42px;" name="title" required></textarea>
        <div class="art-editor">
            <textarea class="form-control we-container art-zw"  placeholder="请输入正文内容" minlength:20 name="attContent" id="wangeditor" style="display:none;" cols="30" rows="10"  required></textarea>
            {{--<textarea class="art-zw" id="" cols="30" rows="10" placeholder="请输入正文内容" name="attContent" required></textarea>--}}
        </div>

  </textarea>
    </div>
    <div class="article-nav">
        <a class="logo" href="#/"></a>
        <div class="nav-btns">
            <div class="opt-btns">
                <button class="a-btn ng-binding" onclick="baocun()" ><i class="icon icon_save" ></i>保存</button>
                </a>
                <div class="a-btn save ng-binding" id="test"  onclick="fabu()">
                    发布
                    <div class="publist-box" >
                        {{--<div class="form-control">--}}
                            {{--<label>选择文章类型：</label>--}}
                            {{--<div class="control">--}}
                                {{--<div class="select-box">--}}
                                    {{--<select name="cid" class="ng-binding">--}}
                                        {{--<option value="1">分类</option>--}}
                                        {{--<i class="icon up"></i>--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <input type="submit" class="submit-btn ng-scope" value="确认发布" id="tijiao">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
{!! we_js() !!}
{!! we_config('wangeditor') !!}
</body>
<script>
    //阻止冒泡
    $('.save').click(function(){
        $('.publist-box').show();

    })
    $(document).bind('click',function(e){
        var e = e || window.event; //浏览器兼容性
        var elem = e.target || e.srcElement;
        while (elem) { //循环判断至跟节点，防止点击的是div子元素
            if (elem.id && elem.id=='test') {
                return;
            }
            elem = elem.parentNode;
        }
        $('.publist-box').hide(); //点击的不是div或其子元素
    });
    $('#previewImg').change(function(){
        $('form:first').attr('onsubmit','true')
    })
    //点击改变action值
    function fabu()
    {
        document.form.id='commentForm';
        document.form.action="/home/art/publish";
    }
    function baocun()
    {
        $('form:first').attr('onsubmit','true')
        document.form.action="/home/art/draft";
    }

// 在键盘按下并释放及提交后验证提交表单
    $.validator.setDefaults({
        submitHandler: function() {
            alert("提交事件!");
        }
    });
    $().ready(function() {
        $("#commentForm").validate();
    })
</script>
</html>