<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/home/initial.css">
    <link rel="stylesheet" href="/css/home/wrArt.css">
    <script src="/js/com/jquery-1.8.3.min.js"></script>
    <script src="/js/home/article.js"></script>
    <title>Document</title>
    {!! we_css() !!}
</head>
<body>
<form method="post" enctype="multipart/form-data" name="form">

    {{csrf_field()}}
    <input type="hidden" name="uid" value="{{Auth::user()->id}}">
    @if($dra['id'])
        <input type="hidden" name="id" value="{{$dra['id']}}">
    @endif
    <div class="article-content" id="addCommodityIndex">
        <div class="input-group row article-cover">
            <div class="col-sm-9 big-photo">
                <div id="preview">
                    @if($dra['artPic'])
                        <img id="imghead" border="0" src="{{url($dra['artPic'])}}" height="180px" onclick="$('#previewImg').click();">
                    @elseif(empty($dra['artPic']))
                        <img id="imghead" border="0" src="/picture/home/xj.png" width="90" height="90" onclick="$('#previewImg').click();">
                    @endif
                </div>
                <input type="file" onchange="previewImage(this)" style="display: none;" id="previewImg" name="artPic">
                <!--<input id="uploaderInput" class="uploader__input" style="display: none;" type="file" accept="" multiple="">-->
            </div>
        </div>
        <textarea class="art-tit" dt-elastic="" max="30" placeholder="在此输入标题" style="height:42px;" name="title">@if($dra['title']){{$dra['title']}}@endif</textarea>
        <div class="art-editor">
            <textarea class="form-control we-container art-zw"  placeholder="请输入正文内容" name="attContent" id="wangeditor" style="display:none;" cols="30" rows="10"  required>@if($dra['attContent']){!! $dra['attContent'] !!}@endif</textarea>
        </div>
    </div>
    //头部
    <div class="article-nav">
        <a class="logo" href="#/"></a>
        <div class="nav-btns">
            @if($dra['type']==1)
                <div class="a-btn save ng-binding" id="test"  onclick="xiugai()">
                    修改
                    <div class="publist-box" >
                        <div class="form-control">
                            {{--<label>选择文章类型：</label>--}}
                            <div class="control">
                                {{--<div class="select-box">--}}
                                    {{--<select name="cid" class="ng-binding">--}}
                                        {{--<option value="1">分类</option>--}}
                                        {{--<i class="icon up"></i>--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                        <input type="submit" class="submit-btn ng-scope" value="确认发布" >
                    </div>
                </div>
                @elseif($dra['type']==0)
                <button class="a-btn ng-binding" onclick="baocun()" ><i class="icon icon_save"></i>保存</button>
                </a>
                <div class="a-btn save ng-binding" id="test"  onclick="fabu()">
                    发布
                    <div class="publist-box" >
                        <div class="form-control">
                            {{--<label>选择文章类型：</label>--}}
                            <div class="control">
                                {{--<div class="select-box">--}}
                                    {{--<select name="cid" class="ng-binding">--}}
                                        {{--<option value="1">分类</option>--}}
                                        {{--<i class="icon up"></i>--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                        <input type="submit" class="submit-btn ng-scope" value="确认发布" >
                    </div>
                </div>
        </div>
        @endif
        </div>
    </div>
</form>
{!! we_js() !!}
{!! we_config('wangeditor') !!}
</body>
<script>
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
//根据不同的点击改变上次的路径
    function fabu()
    {
        document.form.action="/home/art/publishArt";
    }
    function baocun()
    {
        document.form.action="/home/art/editTowArt";
    }
    function xiugai()
    {
        document.form.action="/home/art/draft";
    }
</script>
</html>