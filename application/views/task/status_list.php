<ul class="nav nav-tabs">
    <li role="presentation" class="<?=($this->status==-1)?'active':''?>">
        <a href="<?=site_url($this->controller_name.'/'.$this->method_name.'/-1')?>">全部</a>
    </li>
    <li role="presentation" class="<?=($this->status==0)?'active':''?>">
        <a href="<?=site_url($this->controller_name.'/'.$this->method_name.'/0')?>">未设置</a>
    </li>
    <li role="presentation" class="<?=($this->status==1)?'active':''?>">
        <a href="<?=site_url($this->controller_name.'/'.$this->method_name.'/1')?>">未启动</a>
    </li>
    <li role="presentation" class="<?=($this->status==2)?'active':''?>">
        <a href="<?=site_url($this->controller_name.'/'.$this->method_name.'/2')?>">准备</a>
    </li>
    <li role="presentation" class="<?=($this->status==3)?'active':''?>">
        <a href="<?=site_url($this->controller_name.'/'.$this->method_name.'/3')?>">进行中</a>
    </li>
    <li role="presentation" class="<?=($this->status==4)?'active':''?>">
        <a href="<?=site_url($this->controller_name.'/'.$this->method_name.'/4')?>">完工</a>
    </li>
    <li role="presentation" class="<?=($this->status==5)?'active':''?>">
        <a href="<?=site_url($this->controller_name.'/'.$this->method_name.'/5')?>">延迟</a>
    </li>

</ul>
