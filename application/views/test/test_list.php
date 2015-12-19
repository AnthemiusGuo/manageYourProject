<ul class="nav nav-tabs">
    <li role="presentation" class="<?=($this->versionId==-1)?'active':''?>">
        <a href="<?=site_url($this->controller_name.'/'.$this->method_name.'/')?>">全部</a>
    </li>
    <?
    foreach ($this->versionList->record_list as $this_record) {
    ?>
    <li role="presentation" class="<?=($this->versionId==$this_record->id)?'active':''?>">
        <a href="<?=site_url($this->controller_name.'/'.$this->method_name.'/'.$this_record->id)?>"><?=$this_record->name?>
        </a>
    </li>
    <?
    }
    ?>
    <div style="text-align:right">
        <a href="<?=site_url("test/exportBug")?>">导出excel</a>
    </div>
</ul>
<!--
<div class="row">
<div class="col-lg-12 list-title-op">
    <label class="checkbox-inline">
        <input type="radio" name="testType" id="allTest" value="1" onchange="reloadTest()" <?=($this->testType==1)?'checked="checked"':''?>/>全部
    </label>
    <label class="checkbox-inline">
        <input type="radio" name="testType" id="finishedTest" value="2"  onchange="reloadTest()" <?=($this->testType==2)?'checked="checked"':''?>/>未解决
    </label>
    <label class="checkbox-inline">
        <input type="radio" name="testType" id="unfinishedTest" value="3"  onchange="reloadTest()" <?=($this->testType==3)?'checked="checked"':''?>/>已解决
    </label>
    <label class="checkbox-inline">
        <input type="radio" name="testType" id="closedTest" value="4"  onchange="reloadTest()" <?=($this->testType==4)?'checked="checked"':''?>/>已关闭
    </label>
</div>
</div>
<script>
function reloadTest(){
    var testType=$('input[name=testType]:checked').val();
    var url=req_url_template.str_supplant({ctrller:'test',action:'bug/<?=$this->versionId?>/'});
    url+='?testType='+testType;
    gotoUrl(url);
}
</script>
-->
<div class="col-lg-12 list-title-op ">
    <div class="input-group input-group-sm">
        <span class="input-group-addon">状态</span>
        <select id="filter_status" name="filter_status" class="form-control">
        <option value="-1" <?=($this->status==-1)?'selected':''?> >全部</option>
        <?
          foreach ($this->bugInfo->field_list['status']->enum as $key => $value) {
        ?>
            <option value="<?=$key?>" <?=($this->status==$key)?'selected':''?> ><?=$value?></option>
        <?
          }
        ?>
        </select>
      <span class="input-group-addon">从</span>
      <input id="filter_beginTS" type="text" class="form-control" placeholder="<?=$this->begin?>" value="<?=$this->begin?>">
      <span class="input-group-addon">到</span>
      <input id="filter_endTS" type="text" class="form-control" placeholder="<?=$this->end?>" value="<?=$this->end?>">
      <span class="input-group-btn">
        <button class="btn btn-primary  btn-sm" type="button" onclick="search_req('<?=$this->versionId?>')">查询</button>
        <button class="btn btn-warning  btn-sm" type="button" onclick="reset_req('<?=$this->versionId?>')">重置</button>
      </span>
    </div>
    <script type="text/javascript">
        $(function(){
          $("#filter_beginTS").datetimepicker({"autoclose": true,"language": "zh-CN","calendarMouseScroll": false,"dateOnly":true,format: 'yyyy-mm-dd',startView:'year',minView:'month'});
          $("#filter_endTS").datetimepicker({"autoclose": true,"language": "zh-CN","calendarMouseScroll": false,"dateOnly":true,'format' : 'yyyy-mm-dd',startView:'year',minView:'month'});
        });
        function search_req(versionId){
          var url = req_url_template.str_supplant({ctrller:'test',action:'bug/'+versionId});
          url= url+'?'+http_build_query(
              {
                  status:$("#filter_status").val(),
                  begin:$("#filter_beginTS").val(),
                  end:$("#filter_endTS").val()
              }
          );
          window.location.href=url;
        }
        function reset_req(versionId){
          var url = req_url_template.str_supplant({ctrller:'test',action:'bug/'+versionId});
          window.location.href=url;
        }
    </script>
</div>
