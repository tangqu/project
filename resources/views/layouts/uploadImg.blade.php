<div class="upload-album-img clearfix" id="upload-Img-Box" >
    <form action="{{url('home/picture/uploadImg')}}" method="post" enctype="multipart/form-data" id="imgForm">
        {{csrf_field()}}
        <input type="hidden" name="uid" value="{{Auth::user()->id}}">
        <div class='tt-s clearfix'>
            <span style="font-weight: 700;">上传图片</span>
            <div id="upload-Img-logout">
                <span class="glyphicon glyphicon-remove"></span>
            </div>
        </div>
        <div id="sgcoll-pics">
          <div id="preview" style="margin-left:120px;margin-top:35px">
              <img id="imghead" border="0" src="/picture/home/uploadFile.png" width="90" height="90" onclick="$('#previewImg').click();">
              <span>
                  点击上传图片
              </span>
          </div>
          <input type="file" onchange="previewImage(this)" style="display: none;" id="previewImg" name="picName" class="picUpload">
        </div>

        <div id="sgcoll-panel">
            
           
            <div class="form-group">
              <select class="form-control" id="user-Album-pic-opt" name="aid"></select>
            </div>
            <div class="row" style="margin-bottom:10px">
              <div class="col-lg-5">
                <select class="form-control" id="Cate-pic-opt1"></select>
              </div>
              <div class="col-lg-4">
                <select class="form-control" id="Cate-pic-opt2"></select>
              </div>
              <div class="col-lg-3">
                <select class="form-control" id="Cate-pic-opt3" name="cid"></select>
              </div>
            </div>
            <div class="form-group">
                <textarea class="form-control" rows="3" name="picDesc" placeholder="说说你对ta的介绍吧 ~_~" ></textarea>
                <!-- <button type="submit" class="btn btn-info" id="upload-Img" style="margin-top:15px">提交图片</button> -->
                <input type="submit"  value="提交图片" class="btn btn-info" style="margin-top:10px" >
            </div>
            
        </div>
    </form>
</div>