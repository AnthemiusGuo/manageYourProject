<ul class="nav nav-tabs">
    <li role="presentation" class="<?=($this->status==-1)?'active':''?>">
        <a href="<?=site_url($this->controller_name.'/'.$this->method_name.'/-1')?>">全部</a>
    </li>
    <li role="presentation" class="<?=($this->status==0)?'active':''?>">
        <a href="<?=site_url($this->controller_name.'/'.$this->method_name.'/0')?>">未启动</a>
    </li>
    <li role="presentation" class="<?=($this->status==1)?'active':''?>">
        <a href="<?=site_url($this->controller_name.'/'.$this->method_name.'/1')?>">进行中</a>
    </li>
    <li role="presentation" class="<?=($this->status==2)?'active':''?>">
        <a href="<?=site_url($this->controller_name.'/'.$this->method_name.'/2')?>">完工</a>
    </li>

</ul>
