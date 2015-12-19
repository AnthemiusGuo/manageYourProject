<ul class="nav nav-tabs">
    <li role="presentation" class="<?=($this->reporterUid=="")?'active':''?>">
        <?
        $url=site_url($this->controller_name.'/'.$this->method_name.'/');
        $param=array();
        if($this->status!=-1){
            $param['s']=$this->status;
        }
        if($this->begin!=""){
            $param['begin']=$this->begin;
        }
        if($this->end!=""){
            $param['end']=$this->end;
        }
        $url.='?'.http_build_query($param);
        ?>
        <a href="<?=$url?>">全部</a>
    </li>
    <?
    foreach ($this->reporterList->record_list as $this_record) {
        $url=site_url($this->controller_name.'/'.$this->method_name.'/'.$this_record->id);
        $param=array();
        if($this->status!=-1){
            $param['s']=$this->status;
        }
        if($this->begin!=""){
            $param['begin']=$this->begin;
        }
        if($this->end!=""){
            $param['end']=$this->end;
        }
        $url.='?'.http_build_query($param);
    ?>
    <li role="presentation" class="<?=($this->reporterUid==$this_record->id)?'active':''?>">
        <a href="<?=$url?>"><?=$this_record->name?></a>
    </li>
    <?
    }
    ?>
</ul>
<div class="col-lg-12 list-title-op ">
    <div class="input-group input-group-sm">
      <span class="input-group-addon">状态</span>
      <select id="filter_status" name="filter_status" class="form-control">
      <option value="-1" <?=($this->status==-1)?'selected':''?> >全部</option>
      <?
        foreach ($this->taskInfo->field_list['status']->enum as $key => $value) {
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
        <button class="btn btn-primary  btn-sm" type="button" onclick="search_req('<?=$this->reporterUid?>')">查询</button>
        <button class="btn btn-warning  btn-sm" type="button" onclick="reset_req('<?=$this->reporterUid?>')">重置</button>
      </span>
    </div>
    <script type="text/javascript">
        $(function(){
          $("#filter_beginTS").datetimepicker({"autoclose": true,"language": "zh-CN","calendarMouseScroll": false,"dateOnly":true,format: 'yyyy-mm-dd',startView:'year',minView:'month'});
          $("#filter_endTS").datetimepicker({"autoclose": true,"language": "zh-CN","calendarMouseScroll": false,"dateOnly":true,'format' : 'yyyy-mm-dd',startView:'year',minView:'month'});
        });
        function search_req(reporterUid){
          var url = req_url_template.str_supplant({ctrller:'task',action:'reportertask/'+reporterUid});
          url= url+'?'+http_build_query(
              {
                  s:$("#filter_status").val(),
                  begin:$("#filter_beginTS").val(),
                  end:$("#filter_endTS").val()
              }
          );
          window.location.href=url;
        }
        function reset_req(reporterUid){
          var url = req_url_template.str_supplant({ctrller:'task',action:'reportertask/'+reporterUid});
          window.location.href=url;
        }
    </script>
</div>
