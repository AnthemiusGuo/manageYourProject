<ul class="nav nav-tabs">
    <!-- $this->field_list['typ']->setEnum(array('其他','UI','2D场景','3D人物','动作特效')); -->

    <li role="presentation" class="<?=($this->typ==-1)?'active':''?>">
        <a href="<?=site_url($this->controller_name.'/'.$this->method_name.'/-1')?>">全部</a>
    </li>
    <li role="presentation" class="<?=($this->typ==1)?'active':''?>">
        <a href="<?=site_url($this->controller_name.'/'.$this->method_name.'/1')?>">UI</a>
    </li>
    <li role="presentation" class="<?=($this->typ==2)?'active':''?>">
        <a href="<?=site_url($this->controller_name.'/'.$this->method_name.'/2')?>">2D场景</a>
    </li>
    <li role="presentation" class="<?=($this->typ==3)?'active':''?>">
        <a href="<?=site_url($this->controller_name.'/'.$this->method_name.'/3')?>">3D人物</a>
    </li>
    <li role="presentation" class="<?=($this->typ==4)?'active':''?>">
        <a href="<?=site_url($this->controller_name.'/'.$this->method_name.'/4')?>">动作特效</a>
    </li>
    <li role="presentation" class="<?=($this->typ==0)?'active':''?>">
        <a href="<?=site_url($this->controller_name.'/'.$this->method_name.'/0')?>">其他</a>
    </li>
</ul>
