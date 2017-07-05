<div class="add-user-album clearfix" id="add-Album-Box">
        <div class='tt-s clearfix'>
            <span style="font-weight: 700;">创建专辑</span>
            <div id="add-album-logout">
                <span class="glyphicon glyphicon-remove"></span>
            </div>
        </div>
        <div style="width:340px;margin:20px 20px;float:left">
            <form role="form" id="add-Album-info">
              <div class="row" style="margin-bottom:5px">
                <div class="col-lg-2">
                  <small>名称</small>
                </div>
                <div class="col-lg-10">
                  <input type="hidden" name="uid" id="userId" value="{{isset(Auth::user()->id) ? Auth::user()->id : ''}}" >
                  <input type="text" class="form-control" id="albumNameInfo" name="albumName" placeholder="专辑名称">
                </div>
              </div>
              <div class="row" style="margin-bottom:5px">
                <div class="col-lg-2">
                  <small>描述</small>
                </div>
                <div class="col-lg-10">
                  <textarea class="form-control" rows="3" id="albumDescInfo" name="desc"></textarea>
                </div>
              </div>
              <div class="row" style="margin-bottom:5px">
                <div class="col-lg-2">
                  <small>标签</small>
                </div>
                <div class="col-lg-10">
                  <input type="text" class="form-control" id="albumLabelInfo" name="label" placeholder="专辑标签">
                </div>

              </div>
              <button type="button" class="btn btn-info" id="submit-add-album" style="margin-left:62px"> 提 交 </button>
            </form>
        </div>
        <div class="bq-choose" id="album-bq-choose">
            <span>常用标签选择</span>
            <ul>
                <li><button type="button" class="btn btn-default btn-sm">美食</button></li>
                <li><button type="button" class="btn btn-default btn-sm">趣事</button></li>
                <li><button type="button" class="btn btn-default btn-sm">衣服</button></li>
                <li><button type="button" class="btn btn-default btn-sm">旅游</button></li>
                <li><button type="button" class="btn btn-default btn-sm">时尚</button></li>
                <li><button type="button" class="btn btn-default btn-sm">明星</button></li>
                
            </ul>
        </div>
    </div>