<ul class="nav nav-tabs">
    <li role="presentation" class="<?=($this->typ=="task")?'active':''?>">
        <a href="<?=site_url('task/duetask/task')?>">工作</a>

    </li>
    <li role="presentation" class="<?=($this->typ=="actionitem")?'active':''?>">
        <a href="<?=site_url('task/duetask/actionitem')?>">事项</a>
    </li>
    <li role="presentation" class="<?=($this->typ=="story")?'active':''?>">
        <a href="<?=site_url('task/duetask/story')?>">开发项</a>
    </li>
    <li role="presentation" class="<?=($this->typ=="relatedTask")?'active':''?>">
        <a href="<?=site_url('task/duetask/relatedTask')?>">已关注的工作</a>
    </li>
</ul>
<div class="row">
<div class="col-lg-12 list-title-op">
    <label class="checkbox-inline">
        <input type="radio" name="taskType" id="allTask" value="1" onchange="reloadTask()" <?=($this->taskType==1)?'checked="checked"':''?>/>全部
    </label>
    <label class="checkbox-inline">
        <input type="radio" name="taskType" id="finishedTask" value="2"  onchange="reloadTask()" <?=($this->taskType==2)?'checked="checked"':''?>/>已完成
    </label>
    <label class="checkbox-inline">
        <input type="radio" name="taskType" id="unfinishedTask" value="3"  onchange="reloadTask()" <?=($this->taskType==3)?'checked="checked"':''?>/>未完成
    </label>
</div>
</div>
<script>
function reloadTask(){
    var taskType=$('input[name=taskType]:checked').val();
    var url=req_url_template.str_supplant({ctrller:'task',action:'duetask/<?=$this->typ?>/'});
    url+='?taskType='+taskType;
    gotoUrl(url);
}
</script>
