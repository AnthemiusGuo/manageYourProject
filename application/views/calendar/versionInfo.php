<div class="row">
    <div class="col-lg-12 col-md-12">
        <h3><?=$this->versionInfo->field_list['name']->gen_show_html()?></h3>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-12 row">
        <h3>状态</h3>
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    程序进展百分比
                </div>
                <div class="panel-body">
                    <div id="graphic_holder_1" class="data_pie_holder">
                    </div>
                    <script type="text/javascript">
                        $(function() {
                            var data1 = <?=json_encode($this->dataChartStory)?>;
                            showPie("#graphic_holder_1",data1);
                        });
                    </script>
                </div>
            </div>
        </div>
        <div class="col-lg-6">

            <div class="panel panel-default">
                <div class="panel-heading">
                    策划进展百分比
                </div>
                <div class="panel-body">
                    <div id="graphic_holder_2" class="data_pie_holder">
                    </div>
                    <script type="text/javascript">
                        $(function() {
                            var data2 = <?=json_encode($this->dataChartAi)?>;
                            showPie("#graphic_holder_2",data2);
                        });
                    </script>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    美术进展百分比
                </div>
                <div class="panel-body">
                    <div id="graphic_holder_3" class="data_pie_holder">
                    </div>
                    <script type="text/javascript">
                        $(function() {
                            var data3 = <?=json_encode($this->dataChartNeed)?>;
                            showPie("#graphic_holder_3",data3);
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-12">
        <div class="list-title-op">
            <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="lightbox({size:'m',url:'<?=site_url('calendar/edit/version/'.$this->versionInfo->id)?>'})">
                <span class="glyphicon glyphicon-pencil"></span> 编辑
            </a>
            <?
            if(in_array($this->userInfo->field_list['typ']->value,array(1,4,100))){
            ?>
            <a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="reqOperator('calendar','cartogram','<?=$this->versionInfo->id?>')" title="快照">
                <span class="glyphicon glyphicon-camera"></span> 快照
            </a>
            <?
            }
            ?>
        </div>
        <table class="table table-striped">
            <tr>
                <td class="td_title"><?=$this->versionInfo->field_list['name']->gen_show_name()?></td>
                <td class="td_data"><?=$this->versionInfo->field_list['name']->gen_show_html()?></td>
                <td class="td_title"><?=$this->versionInfo->field_list['status']->gen_show_name()?></td>
                <td class="td_data"><?=$this->versionInfo->field_list['status']->gen_show_html()?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->versionInfo->field_list['projectId']->gen_show_name()?></td>
                <td class="td_data"><?=$this->versionInfo->field_list['projectId']->gen_show_html()?></td>
                <td class="td_title"><?=$this->versionInfo->field_list['desc']->gen_show_name()?></td>
                <td class="td_data"><?=$this->versionInfo->field_list['desc']->gen_show_html()?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->versionInfo->field_list['beginTS']->gen_show_name()?></td>
                <td class="td_data"><?=$this->versionInfo->field_list['beginTS']->gen_show_html()?></td>
                <td class="td_title"><?=$this->versionInfo->field_list['endTS']->gen_show_name()?></td>
                <td class="td_data"><?=$this->versionInfo->field_list['endTS']->gen_show_html()?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->versionInfo->field_list['realEndTS']->gen_show_name()?></td>
                <td colspan="3"><?=$this->versionInfo->field_list['realEndTS']->gen_show_html()?></td>
            </tr>
        </table>
        <div class="panel panel-default calendar">
            <div class="panel-heading">
                <h4 class="panel-title">快照</h4>

            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <?
                        $row_counter = 0;
                        foreach ($this->contrastList->listKeys as $key_names):
                            $row_counter++;
                        ?>
                            <th>
                                <?php
                                echo $this->contrastList->dataModel[$key_names]->gen_show_name();;
                                ?>
                            </th>
                        <?
                        endforeach;
                        ?>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;

                    foreach($this->contrastList->record_list as  $this_record):

                        $i++;
                        ?>
                        <tr>

                            <?
                            foreach ($this->contrastList->listKeys as $key_names):
                            ?>
                                <td>
                                    <?php
                                    if ($this_record->field_list[$key_names]->is_title):
                                        if ($this->changelogList->is_lightbox):
                                            echo '<a href="javascript:void(0)" onclick="lightbox({size:\'m\',url:\''. site_url($this_record->info_link.$this_record->id).'\'})">'.$this_record->field_list[$key_names]->gen_list_html().'</a>';
                                        else :
                                            echo '<a href="'.site_url($this_record->info_link.$this_record->id).'">'.$this_record->field_list[$key_names]->gen_list_html().'</a>';
                                        endif;
                                    else :
                                        echo $this_record->field_list[$key_names]->gen_list_html();

                                    endif;
                                    ?>
                                </td>
                            <?
                            endforeach;
                            ?>
                            <td>
                                <?
                                if ($this->contrastList->is_lightbox):
                                    echo '<a class="list_op tooltips" href="javascript:void(0)" onclick="lightbox({size:\'m\',url:\''. site_url($this_record->info_link.$this_record->id).'\'})"><span class="glyphicon glyphicon-search"></span></a>';
                                else :
                                    echo '<a  class="list_op tooltips" href="'.site_url($this_record->info_link.$this_record->id).'"><span class="glyphicon glyphicon-search"></span></a>';
                                endif;
                                ?>
                                 |
                                <?php
                                if ($this->canEdit) {
                                    echo $this_record->gen_list_op();
                                }
                                ?>
                            </td>
                        </tr>
                    <?php
                    endforeach; ?>

                </tbody>
            </table>
            <?php
            if (count($this->contrastList->record_list)==0):
            ?>
            <div class="panel-body">
                <div class="no-data-large">
                    没有相关记录
                </div>
            </div>
            <?
            endif;
            ?>
        </div>
    </div>
</div>
