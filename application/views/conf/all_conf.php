<ul class="nav nav-tabs">
    <li role="presentation" class="<?=($this->typ=="managerweek")?'active':''?>">
        <a href="<?=site_url($this->controller_name.'/managerweek')?>">会议</a>
    </li>
    <li role="presentation" class="<?=($this->typ=="confitem")?'active':''?>">
        <a href="<?=site_url($this->controller_name.'/confitem')?>">我的讨论需求</a>
    </li>


</ul>
