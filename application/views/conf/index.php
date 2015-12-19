<?php include_once('header.php');?>
<div class="col-lg-5 col-md-10 ">
    <div class="panel panel-default">
        <div class="panel-heading">
            任务进展百分比
        </div>
        <div class="panel-body">
            <div id="graphic_holder_1" class="data_pie_holder">
            </div>
            <script type="text/javascript">
                $(function() {
                    var data1 = <?=json_encode($this->dataChartTask)?>;
                    showPie("#graphic_holder_1",data1);
                });
            </script>
        </div>
    </div>
</div>
<?
$statusName = array(0=>'未设置',1=>'未启动',2=>'准备',3=>'进行中',4=>'完工',5=>'延迟');
$statusColor = array(0=>'danger',1=>'danger',2=>'warning',3=>'primary',4=>'success',5=>'danger');
foreach ($this->taskStatusArray as $status => $allTask) :
    ?>
    <div class="row">
        <div class="col-lg-12">
            <h3><?=$statusName[$status]?></h3>
            <hr/>
        </div>
    <?
    foreach ($allTask as $this_record):
    ?>
        <div class="col-lg-6 col-md-12 ">
            <div class="panel panel-<?=$statusColor[$this_record->field_list['status']->value]?> ">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a href="<?=site_url('task/taskinfo/'.$this_record->id)?>" target="_blank"><?=$this_record->field_list['name']->value?></a> <small> <?=$this_record->field_list['beginTS']->gen_show_value()?> - <?=$this_record->field_list['dueEndTS']->gen_show_html()?></small></h3>

                </div>
                <table class="table table-striped table-bordered">
                    <tr>
                        <td><?=$this_record->field_list['createUid']->gen_show_name()?></td>
                        <td><?=$this_record->field_list['createUid']->gen_show_html()?></td>
                        <td><?=$this_record->field_list['dueUser']->gen_show_name()?></td>
                        <td><?=$this_record->field_list['dueUser']->gen_show_html()?></td>
                    </tr>
                    <tr>
                        <td><?=$this_record->field_list['status']->gen_show_name()?></td>
                        <td><?=$this_record->field_list['status']->gen_show_html()?></td>
                        <td><?=$this_record->field_list['progress']->gen_show_name()?></td>
                        <td><?=$this_record->field_list['progress']->gen_show_html()?></td>
                    </tr>
                    <tr>
                        <td><?=$this_record->field_list['dueEndTS']->gen_show_name()?></td>
                        <td><?=$this_record->field_list['dueEndTS']->gen_show_html()?></td>
                        <td><?=$this_record->field_list['endTS']->gen_show_name()?></td>
                        <td><?=$this_record->field_list['endTS']->gen_show_html()?></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <?
                            if (isset($this->taskChangLog[$this_record->id])){
                            ?>
                                <blockquote>
                                <?
                                foreach ($this->taskChangLog[$this_record->id] as $this_changelog){
                                    if ( $this_changelog->field_list['solution']->value==""){
                                        continue;
                                    }
                                ?>
                                <p>
                                    [<?=$this_changelog->field_list['beginTS']->gen_show_html()?>]:
                                    <?=$this_changelog->field_list['solution']->gen_show_html()?>
                                </p>
                                <?
                                }
                                ?>
                                </blockquote>
                            <?
                            }
                            ?>
                        </td>
                    </tr>
                </table>
                <ul class="list-group">
                    <?
                    if (isset($this->realSubTasksList[$this_record->id])){
                    ?>
                        <?php
                        $i = 0;

                        foreach($this->realSubTasksList[$this_record->id] as  $this_sub_record):
                            $i++;
                            ?>
                            <li class="list-group-item">
                                &nbsp;&nbsp;&nbsp;|---- [子任务]
                                <?=$this_sub_record->field_list['status']->gen_list_html();?>
                                <?
                                echo '<a href="'.site_url($this_sub_record->info_link.$this_sub_record->id).'">'.$this_sub_record->field_list['name']->gen_list_html().'</a>';
                                ?>

                                <?=$this_sub_record->field_list['dueUser']->gen_list_html();?>
                                [<?=$this_sub_record->field_list['dueEndTS']->gen_list_html();?>]

                            <?
                            if (isset($this->taskChangLog[$this_sub_record->id])){
                            ?>
                                <blockquote>
                                <?
                                foreach ($this->taskChangLog[$this_sub_record->id] as $this_changelog){
                                    if ($this_changelog->field_list['solution']->value==""){
                                        continue;
                                    }
                                ?>
                                <p>
                                    [<?=$this_changelog->field_list['beginTS']->gen_show_html()?>]:
                                    <?=$this_changelog->field_list['solution']->gen_show_html()?>
                                </p>
                                <?
                                }
                                ?>
                                </blockquote>
                            <?
                            }
                            ?>
                            </li>

                        <?php
                        endforeach; ?>
                    <?
                    }
                    ?>
                    <?
                    if (isset($this->realFeatureList[$this_record->id])){
                    ?>
                        <?php
                        $i = 0;
                        foreach($this->realFeatureList[$this_record->id] as  $this_sub_record):
                            $i++;
                            ?>
                            <li class="list-group-item ">
                                &nbsp;&nbsp;&nbsp;|---- [子开发内容]
                                <?=$this_sub_record->field_list['status']->gen_list_html();?>
                                <?
                                echo '<a href="'.site_url($this_sub_record->info_link.$this_sub_record->id).'">'.$this_sub_record->field_list['name']->gen_list_html().'</a>';
                                ?>

                                <?=$this_sub_record->field_list['dueUser']->gen_list_html();?>
                                [<?=$this_sub_record->field_list['dueEndTS']->gen_list_html();?>]

                            <?
                            if (isset($this->taskChangLog[$this_sub_record->id])){
                            ?>
                                <blockquote>
                                    更新日志：

                                <?
                                foreach ($this->taskChangLog[$this_sub_record->id] as $this_changelog){
                                    if ($this_changelog->field_list['solution']->value==""){
                                        continue;
                                    }
                                ?>
                                <p>
                                    [<?=$this_changelog->field_list['beginTS']->gen_show_html()?>]:
                                    <?=$this_changelog->field_list['solution']->gen_show_html()?>
                                </p>
                                <?
                                }
                                ?>
                                </blockquote>
                            <?
                            }
                            ?>
                            </li>
                        <?php
                        endforeach; ?>
                    <?
                    }
                    ?>
                </ul>

                <div class="panel-footer">

                    <a href="javascript:void(0)" class="btn btn-primary" onclick="lightbox({size:'m',url:'<?=site_url('task/edit/task/'.$this_record->id);?>'})"><span class="glyphicon glyphicon-pencil"></span> 编辑</a>

                    <a class="btn btn-danger" onclick="lightbox({size:'m',url:'<?=site_url('task/create/task/'.$this_record->id);?>'})"><span class="glyphicon glyphicon-list"></span> 派发子工作</a>
                </div>
            </div>
        </div>
    <?
    endforeach;
    ?>
    </div>
<?
endforeach;
?>
