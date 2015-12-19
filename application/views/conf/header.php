<div class="row">
    <div class="col-lg-7 col-md-12">
        <h3>经理例会：<?=$this->confInfo->field_list['confTS']->gen_show_html()?>
            <small><?=$this->confInfo->field_list['beginTS']->gen_show_html()?> TO <?=$this->confInfo->field_list['endTS']->gen_show_html()?></small></h3>
        <div class="list-title-op">

        </div>
    </div>
</div>
<div class="row">
    <ul class="nav nav-tabs">
        <li role="presentation" class="<?=($this->reporterUid==$this->userInfo->id)?'active':''?>">
            <?
            $url=site_url($this->controller_name.'/'.$this->method_name.'/'.$this->confInfo->id.'/');
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
            <a href="<?=$url?>">我</a>
        </li>
        <?
        foreach ($this->reporterList->record_list as $this_record) {
            $url=site_url($this->controller_name.'/'.$this->method_name.'/'.$this->confInfo->id.'/'.$this_record->id);
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

    <div class="col-lg-12 list-title-op">
        <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="lightbox({size:'m',url:'<?=site_url('task/create/task')?>'})"><span class="glyphicon glyphicon-file"></span> 新建工作安排</a>
    </div>

</div>
