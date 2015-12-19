<ul class="nav nav-tabs">
    <li role="presentation" class="<?=($this->state==-1)?'active':''?>">
        <a href="<?=site_url($this->controller_name.'/'.$this->method_name.'/-1')?>">全部</a>
    </li>
    <li role="presentation" class="<?=($this->state==1)?'active':''?>">
        <a href="<?=site_url($this->controller_name.'/'.$this->method_name.'/1')?>">正在请求</a>
    </li>
    <li role="presentation" class="<?=($this->state==2)?'active':''?>">
        <a href="<?=site_url($this->controller_name.'/'.$this->method_name.'/2')?>">已结束</a>
    </li>
</ul>
