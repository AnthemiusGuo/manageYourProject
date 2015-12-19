<ul class="nav nav-tabs">
    <li role="presentation" class="<?=($this->versionId=="")?'active':''?>">
        <a href="<?=site_url($this->controller_name.'/'.$this->method_name.'/')?>">全部</a>
    </li>
    <?
    foreach ($this->versionList->record_list as $this_record) {
    ?>
    <li role="presentation" class="<?=($this->versionId==$this_record->id)?'active':''?>">
        <a href="<?=site_url($this->controller_name.'/'.$this->method_name.'/'.$this_record->id)?>"><?=$this_record->name?>
        <small><?=$this_record->field_list['endTS']->gen_show_html()?></small></a>
    </li>
    <?
    }
    ?>
</ul>
<div class="row">
<div class="col-lg-12 list-title-op">
    <label class="checkbox-inline">
        <input type="radio" name="needStatus" id="all" value="1" onchange="reloadNeed()" <?=($this->needStatus==1)?'checked="checked"':''?>/>全部
    </label>
    <label class="checkbox-inline">
        <input type="radio" name="needStatus" id="finished" value="2"  onchange="reloadNeed()" <?=($this->needStatus==2)?'checked="checked"':''?>/>已完成
    </label>
    <label class="checkbox-inline">
        <input type="radio" name="needStatus" id="unfinished" value="3"  onchange="reloadNeed()" <?=($this->needStatus==3)?'checked="checked"':''?>/>未完成
    </label>
</div>
</div>
<script>
function reloadNeed(){
    var needStatus=$('input[name=needStatus]:checked').val();
    var url=req_url_template.str_supplant({ctrller:'calendar',action:'<?=$this->method_name?>/<?=$this->versionId?>/'});
    url+='?needStatus='+needStatus;
    gotoUrl(url);
}
</script>
