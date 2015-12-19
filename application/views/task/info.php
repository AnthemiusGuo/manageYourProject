<div class="row">
    <div class="col-lg-7 col-md-12">
        <h3><?=$this->taskInfo->field_list['name']->gen_show_html()?></h3>
        <div class="list-title-op">
            <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="lightbox({size:'m',url:'<?=site_url('task/edit/task/'.$this->taskInfo->id)?>'})">
                <span class="glyphicon glyphicon-pencil"></span> 编辑
            </a>
            <?
            if($this->taskInfo->field_list['createUid']->value!=$this->userInfo->id&&$this->taskInfo->field_list['dueUser']->value!=$this->userInfo->id&&(!in_array($this->userInfo->id,$this->taskInfo->field_list['relatedUsers']->value))){
            ?>
            <a href="javascript:void(0)" class="btn btn-info btn-sm" onclick="reqOperator('task','doLook','<?=$this->taskInfo->id?>','确认关注该工作？')" title="关注工作">
                <span class="glyphicon glyphicon-eye-open"></span> 关注
            </a>
            <?
        }
            ?>
            <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="lightbox({size:'m',url:'<?=site_url('task/editTaskParent/'.$this->taskInfo->id)?>'})">
                <span class="glyphicon glyphicon-tag"></span> 编辑父任务
            </a>
        </div>
        <table class="table table-striped">
            <tr>
                <td class="td_title"><?=$this->taskInfo->field_list['name']->gen_show_name()?></td>
                <td class="td_data"><?=$this->taskInfo->field_list['name']->gen_show_html()?></td>
                <td class="td_title"><?=$this->taskInfo->field_list['parentTaskId']->gen_show_name()?></td>
                <td class="td_data"><?=$this->taskInfo->field_list['parentTaskId']->gen_show_html()?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->taskInfo->field_list['dueUser']->gen_show_name()?></td>
                <td class="td_data"><?=$this->taskInfo->field_list['dueUser']->gen_show_html()?></td>
                <td class="td_title"><?=$this->taskInfo->field_list['createUid']->gen_show_name()?></td>
                <td class="td_data"><?=$this->taskInfo->field_list['createUid']->gen_show_html()?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->taskInfo->field_list['relatedUsers']->gen_show_name()?></td>
                <td class="td_data"><?=$this->taskInfo->field_list['relatedUsers']->gen_show_html()?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->taskInfo->field_list['progress']->gen_show_name()?></td>
                <td class="td_data"><?=$this->taskInfo->field_list['progress']->gen_show_html()?></td>
                <td class="td_title"><?=$this->taskInfo->field_list['status']->gen_show_name()?></td>
                <td class="td_data"><?=$this->taskInfo->field_list['status']->gen_show_html()?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->taskInfo->field_list['dueEndTS']->gen_show_name()?></td>
                <td class="td_data"><?=$this->taskInfo->field_list['dueEndTS']->gen_show_html()?></td>
                <td class="td_title"><?=$this->taskInfo->field_list['endTS']->gen_show_name()?></td>
                <td class="td_data"><?=$this->taskInfo->field_list['endTS']->gen_show_html()?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->taskInfo->field_list['desc']->gen_show_name()?></td>
                <td class="td_data" colspan="3"><?=$this->taskInfo->field_list['desc']->gen_show_html()?></td>
            </tr>

            <?
            if($this->taskInfo->field_list['dueUser']->value!=$this->userInfo->id||$this->taskInfo->field_list['createUid']->value==$this->userInfo->id){
                ?>
            <tr>
                <td class="td_title"><?=$this->taskInfo->field_list['rate']->gen_show_name()?></td>
                <td class="td_data"><?=$this->taskInfo->field_list['rate']->gen_show_html()?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->taskInfo->field_list['solution']->gen_show_name()?></td>
                <td class="td_data" colspan="3"><?=$this->taskInfo->field_list['solution']->gen_show_html()?></td>
            </tr>
        <?}?>
            <tr>
                <td class="td_title"><?=$this->taskInfo->field_list['relate_turple']->gen_show_name()?></td>
                <td class="td_data"><?=$this->taskInfo->field_list['relate_turple']->gen_show_html()?></td>
            </tr>


            <tr>
                <td class="td_title"><?=$this->taskInfo->field_list['typ']->gen_show_name()?></td>
                <td class="td_data"><?=$this->taskInfo->field_list['typ']->gen_show_html()?></td>
                <td class="td_title"><?=$this->taskInfo->field_list['priority']->gen_show_name()?></td>
                <td class="td_data"><?=$this->taskInfo->field_list['priority']->gen_show_html()?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->taskInfo->field_list['createTS']->gen_show_name()?></td>
                <td class="td_data"><?=$this->taskInfo->field_list['createTS']->gen_show_html()?></td>
                <td class="td_title"><?=$this->taskInfo->field_list['beginTS']->gen_show_name()?></td>
                <td class="td_data"><?=$this->taskInfo->field_list['beginTS']->gen_show_html()?></td>
            </tr>

        </table>


    </div>
    <div class="col-lg-5 col-md-12">
        <div class="panel panel-default calendar">
            <div class="panel-heading">
                <h4 class="panel-title">子工作
                <a class="btn btn-primary btn-xs pull-right" onclick="lightbox({size:'m',url:'<?=site_url('task/create/task/'.$this->taskInfo->id)?>'})">派发子工作<a>
                    </h4>

            </div>


            <table class="table table-striped">
                <thead>
                    <tr>
                        <?
                        $row_counter = 0;
                        foreach ($this->subTasksList->listKeys as $key_names):
                            $row_counter++;
                        ?>
                            <th>
                                <?php
                                echo $this->subTasksList->dataModel[$key_names]->gen_show_name();;
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

                    foreach($this->subTasksList->record_list as  $this_record):

                        $i++;
                        ?>
                        <tr>

                            <?
                            foreach ($this->subTasksList->listKeys as $key_names):
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
                                if ($this->subTasksList->is_lightbox):
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
            if (count($this->subTasksList->record_list)==0):
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

        <div class="panel panel-default calendar">
            <div class="panel-heading">
                <h4 class="panel-title">关联开发项功能

                </h4>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <?
                        $row_counter = 0;
                        foreach ($this->featureList->listKeys as $key_names):
                            $row_counter++;
                        ?>
                            <th>
                                <?php
                                echo $this->featureList->dataModel[$key_names]->gen_show_name();;
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

                    foreach($this->featureList->record_list as  $this_record):

                        $i++;
                        ?>
                        <tr>

                            <?
                            foreach ($this->featureList->listKeys as $key_names):
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
                                if ($this->featureList->is_lightbox):
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
            if (count($this->featureList->record_list)==0):
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
<div class="row">
    <div class="col-lg-12 col-md-12">
        <h4>更新记录</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <?
                    $row_counter = 0;
                    foreach ($this->changelogList->listKeys as $key_names):
                        $row_counter++;
                    ?>
                        <th>
                            <?php
                            echo $this->changelogList->dataModel[$key_names]->gen_show_name();;
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
                $now_begin_ts = 0;

                foreach($this->changelogList->record_list as  $this_record):
                    $this_begin_ts = $this_record->field_list['beginTS']->formatTSAsDayBeginTS();
                    if ($this_begin_ts!=$now_begin_ts){
                        $now_begin_ts = $this_begin_ts;
                    ?>
                    <tr>
                        <th colspan="<?=$row_counter?>"><?=date("Y-m-d",$this_record->field_list['beginTS']->value)?></th>
                    </tr>
                    <?
                    }
                    $i++;
                    ?>
                    <tr>

                        <?
                        foreach ($this->changelogList->listKeys as $key_names):
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
                            if ($this->changelogList->is_lightbox):
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
        if (count($this->changelogList->record_list)==0):
        ?>
            <div class="no-data-large">
                没有相关记录
            </div>
        <?
        endif;
        ?>
    </div>
</div>
