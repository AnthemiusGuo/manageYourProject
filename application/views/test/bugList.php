<ul class="nav nav-tabs">
    <li role="presentation" class="<?=($this->status==-1)?'active':''?>">
        <a href="<?=site_url($this->controller_name.'/'.$this->method_name.'/-1')?>">我的全部</a>
    </li>
    <li role="presentation" class="<?=($this->status==0)?'active':''?>">
        <a href="<?=site_url($this->controller_name.'/'.$this->method_name.'/0')?>">指派给我的</a>
    </li>
    <li role="presentation" class="<?=($this->status==1)?'active':''?>">
        <a href="<?=site_url($this->controller_name.'/'.$this->method_name.'/1')?>">由我创建的</a>
    </li>
    <li role="presentation" class="<?=($this->status==2)?'active':''?>">
        <a href="<?=site_url($this->controller_name.'/'.$this->method_name.'/2')?>">抄送給我的</a>
    </li>
</ul>
<div class="row">
<div class="col-lg-12 list-title-op">
    <label class="checkbox-inline">
        <input type="radio" name="myTestType" id="allMyTest" value="1" onchange="reloadMyTest()" <?=($this->myTestType==1)?'checked="checked"':''?>/>全部
    </label>
    <label class="checkbox-inline">
        <input type="radio" name="myTestType" id="finishedMyTest" value="2"  onchange="reloadMyTest()" <?=($this->myTestType==2)?'checked="checked"':''?>/>未解决
    </label>
    <label class="checkbox-inline">
        <input type="radio" name="myTestType" id="unfinishedMyTest" value="3"  onchange="reloadMyTest()" <?=($this->myTestType==3)?'checked="checked"':''?>/>已解决
    </label>
    <label class="checkbox-inline">
        <input type="radio" name="myTestType" id="closedMyTest" value="4"  onchange="reloadMyTest()" <?=($this->myTestType==4)?'checked="checked"':''?>/>已关闭
    </label>
</div>
</div>
<script>
function reloadMyTest(){
    var myTestType=$('input[name=myTestType]:checked').val();
    var url=req_url_template.str_supplant({ctrller:'test',action:'myTest/<?=$this->status?>/'});
    url+='?myTestType='+myTestType;
    gotoUrl(url);
}
</script>
