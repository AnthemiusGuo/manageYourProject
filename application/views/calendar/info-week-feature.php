<?
$statusName = array('思路','计划内','开发中','测试中','已结','内容补充中');
$statusColor = array('default','primary','danger','warning','success','warning');
foreach ($this->arrFeaturesByStatus as $status => $featureList) {
?>
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <h4><?=$statusName[$status]?></h4>
            <hr/>
        </div>
        <?
        foreach ($featureList as $thisFeature) {
        ?>
        <div class="col-md-6 col-lg-4">
            <div class="panel panel-<?=$statusColor[$status]?> ">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a href="<?=site_url('calendar/featureInfo/'.$thisFeature->id)?>" target="_blank">
                            <?=$thisFeature->field_list['name']->value?>
                        </a> <small> <?=$thisFeature->field_list['versionId']->gen_show_value()?> : <?=$thisFeature->field_list['dueEndTS']->gen_show_html()?></small></h3>
                </div>

                <ul class="list-group">

                        <?
                        if (isset($this->featureChangLog[$thisFeature->id])){
                        ?>
                        <li class="list-group-item">

                        <table class="table table-striped">
                            <?
                                foreach ($this->featureChangLog[$thisFeature->id] as $this_changelog){
                                ?>
                                <tr>
                                    <td ><?=$this_changelog->field_list['beginTS']->gen_show_html()?></td>
                                    <td><?=$this_changelog->field_list['changes']->gen_list_html()?><?=$this_changelog->field_list['solution']->gen_show_html()?></td>
                                </tr>
                                <?
                                }
                                ?>
                            </table>
                            </li>

                        <?
                        }
                        ?>

                    <?

                    if (!isset($this->arrStoryByFeatures[$thisFeature->id])){
                        $this->arrStoryByFeatures[$thisFeature->id] = array();

                    }
                    foreach ($this->arrStoryByFeatures[$thisFeature->id] as $key) {
                        $thisStory = $this->storyList->record_list[$key];
                    ?>
                        <li class="list-group-item">
                            [<?=$thisStory->field_list['system']->gen_show_value()?>开发]<?=$thisStory->field_list['name']->value?> &nbsp;&nbsp;<?=$thisStory->field_list['dueUser']->gen_show_value()?>&nbsp;&nbsp;<?=$thisStory->field_list['status']->gen_show_html()?>&nbsp;&nbsp;<?=$thisStory->field_list['dueEndTS']->gen_show_html()?>
                            <?
                            if($this->canEditFeature){
                            ?>
                            <a href="javascript:void(0)" onclick="lightbox({size:'m',url:'<?=site_url('calendar/edit/story/'.$thisStory->id);?>'})"><span class="glyphicon glyphicon-pencil"></span> 编辑</a>
                            <?
                        }
                            ?>
                            <table class="table table-striped" style="font-size:12px;">
                                <?
                                if (isset($this->storyChangLog[$thisStory->id])){
                                ?>
                                    <?
                                        foreach ($this->storyChangLog[$thisStory->id] as $this_changelog){
                                        ?>
                                        <tr>
                                            <td ><?=$this_changelog->field_list['beginTS']->gen_show_html()?></td>
                                            <td><?=$this_changelog->field_list['changes']->gen_list_html()?><?=$this_changelog->field_list['solution']->gen_show_html()?></td>
                                        </tr>
                                        <?
                                        }
                                        ?>

                                <?
                                }
                                ?>
                            </table>
                        </li>
                    <?
                    }
                    ?>
                    <?

                    if (!isset($this->arrAiByFeatures[$thisFeature->id])){
                        $this->arrAiByFeatures[$thisFeature->id] = array();
                    }
                    foreach ($this->arrAiByFeatures[$thisFeature->id] as $key) {
                        $thisStory = $this->aiList->record_list[$key];
                    ?>
                        <li class="list-group-item">
                            [事项]<?=$thisStory->field_list['name']->value?> &nbsp;&nbsp;<?=$thisStory->field_list['dueUser']->gen_show_value()?>&nbsp;&nbsp;<?=$thisStory->field_list['status']->gen_show_html()?>&nbsp;&nbsp;<?=$thisStory->field_list['dueEndTS']->gen_show_html()?>
                            <?
                            if($this->canEditFeature){
                            ?>
                            <a href="javascript:void(0)" onclick="lightbox({size:'m',url:'<?=site_url('calendar/edit/actionitem/'.$thisStory->id);?>'})"><span class="glyphicon glyphicon-pencil"></span> 编辑</a>
                            <?
                        }
                            ?>
                            <table class="table table-striped" style="font-size:12px;">
                                <?
                                if (isset($this->aiChangLog[$thisStory->id])){
                                ?>
                                    <?
                                        foreach ($this->aiChangLog[$thisStory->id] as $this_changelog){
                                        ?>
                                        <tr>
                                            <td ><?=$this_changelog->field_list['beginTS']->gen_show_html()?></td>
                                            <td><?=$this_changelog->field_list['changes']->gen_list_html()?><?=$this_changelog->field_list['solution']->gen_show_html()?></td>
                                        </tr>
                                        <?
                                        }
                                        ?>

                                <?
                                }
                                ?>
                            </table>
                        </li>
                    <?
                    }
                    ?>
                    <div class="panel-footer">
                        <?
                        if($this->canEditFeature){
                        ?>
                        <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="lightbox({size:'m',url:'<?=site_url('calendar/edit/feature/'.$thisFeature->id);?>'})"><span class="glyphicon glyphicon-pencil"></span> 编辑</a>
                        <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="lightbox({size:'m',url:'<?=site_url('calendar/createPresent/actionitem/'.$thisFeature->id);?>'})"><span class="glyphicon glyphicon-pencil"></span> 创建事项</a>
                        <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="lightbox({size:'m',url:'<?=site_url('calendar/createPresent/story/'.$thisFeature->id);?>'})"><span class="glyphicon glyphicon-pencil"></span> 创建开发项</a>
                        <?
                    }
                        ?>
                    </div>
                </ul>
            </div>
        </div>
        <?
        }
        ?>
    </div>
<?
}
?>
