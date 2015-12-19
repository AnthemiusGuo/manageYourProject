<?php include_once('header.php');?>
<div class="row">

    <div class="col-lg-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <?
                    $col_count = 0;
                    foreach ($this->taskList->listKeys as $key_names):
                        $col_count++;
                    ?>
                        <th>
                            <?php
                            echo $this->taskList->dataModel[$key_names]->gen_show_name();;
                            ?>
                        </th>
                    <?
                    endforeach;
                    ?>
                    <th>更新日志</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;

                foreach($this->taskList->record_list as  $this_record):
                    $i++;
                    ?>
                    <tr>

                        <?

                        foreach ($this->taskList->listKeys as $key_names):

                        ?>
                            <td>
                                <?php
                                if ($this_record->field_list[$key_names]->is_title):
                                    if ($this->taskList->is_lightbox):
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
                        <?
                        if (isset($this->taskChangLog[$this_record->id])){
                        ?>
                            <td >
                                <table class="table" >
                                <?
                                foreach ($this->taskChangLog[$this_record->id] as $this_changelog){
                                    if ($this_changelog->field_list['changes']->value=="" && $this_changelog->field_list['solution']->value==""){
                                        continue;
                                    }
                                ?>
                                <tr>
                                    <td><?=$this_changelog->field_list['beginTS']->gen_show_html()?></td>
                                    <td><?=$this_changelog->field_list['changes']->gen_list_html()?></td>
                                    <td><?=$this_changelog->field_list['solution']->gen_show_html()?></td>
                                </tr>
                                <?
                                }
                                ?>
                                </table>
                            </td>
                        <?
                        } else {
                        ?>
                            <td >
                                无更新
                            </td>
                        <?
                        }
                        ?>
                        <td>
                            <?
                            if ($this->taskList->is_lightbox):
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
                    <?
                    if (isset($this->realSubTasksList[$this_record->id])){
                    ?>
                        <?php
                        $i = 0;

                        foreach($this->realSubTasksList[$this_record->id] as  $this_sub_record):
                            $i++;
                            ?>
                            <tr>
                                <?
                                $j = 0;
                                foreach ($this->taskList->listKeys as $key_names):
                                    $j++
                                ?>
                                    <td>
                                        <?
                                        if ($j==1){
                                            echo '&nbsp;&nbsp;&nbsp;|---- [子任务]';
                                        }
                                        ?>
                                        <?php
                                        if ($this_sub_record->field_list[$key_names]->is_title):
                                            if ($this->taskList->is_lightbox):
                                                echo '<a href="javascript:void(0)" onclick="lightbox({size:\'m\',url:\''. site_url($this_sub_record->info_link.$this_sub_record->id).'\'})">'.$this_sub_record->field_list[$key_names]->gen_list_html().'</a>';
                                            else :
                                                echo '<a href="'.site_url($this_sub_record->info_link.$this_sub_record->id).'">'.$this_sub_record->field_list[$key_names]->gen_list_html().'</a>';
                                            endif;
                                        else :
                                            echo $this_sub_record->field_list[$key_names]->gen_list_html();

                                        endif;
                                        ?>
                                    </td>
                                <?
                                endforeach;
                                ?>
                                <?
                                if (isset($this->taskChangLog[$this_sub_record->id])){
                                ?>
                                    <td >
                                        <table class="table" >
                                        <?
                                        foreach ($this->taskChangLog[$this_sub_record->id] as $this_changelog){
                                            if ($this_changelog->field_list['changes']->value=="" && $this_changelog->field_list['solution']->value==""){
                                                continue;
                                            }
                                        ?>
                                        <tr>
                                            <td><?=$this_changelog->field_list['beginTS']->gen_show_html()?></td>
                                            <td><?=$this_changelog->field_list['changes']->gen_list_html()?></td>
                                            <td><?=$this_changelog->field_list['solution']->gen_show_html()?></td>
                                        </tr>
                                        <?
                                        }
                                        ?>
                                        </table>
                                    </td>
                                <?
                                } else {
                                ?>
                                    <td >
                                        无更新
                                    </td>
                                <?
                                }
                                ?>
                                <td>
                                    <?
                                    if ($this->$this_sub_record->is_lightbox):
                                        echo '<a class="list_op tooltips" href="javascript:void(0)" onclick="lightbox({size:\'m\',url:\''. site_url($this_record->info_link.$this_record->id).'\'})"><span class="glyphicon glyphicon-search"></span></a>';
                                    else :
                                        echo '<a  class="list_op tooltips" href="'.site_url($this_sub_record->info_link.$this_sub_record->id).'"><span class="glyphicon glyphicon-search"></span></a>';
                                    endif;
                                    ?>
                                     |
                                    <?php
                                    if ($this->canEdit) {
                                        echo $this_sub_record->gen_list_op();
                                    }
                                    ?>
                                </td>
                            </tr>
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
                            <tr>
                                <?
                                $j = 0;
                                foreach ($this->taskList->listKeys as $key_names):
                                    $j++
                                ?>
                                    <td>
                                        <?
                                        if ($j==1){
                                            echo '&nbsp;&nbsp;&nbsp;|---- [子开发项]';
                                        }
                                        ?>
                                        <?php
                                        if ($this_sub_record->field_list[$key_names]->is_title):
                                            if ($this->taskList->is_lightbox):
                                                echo '<a href="javascript:void(0)" onclick="lightbox({size:\'m\',url:\''. site_url($this_sub_record->info_link.$this_sub_record->id).'\'})">'.$this_sub_record->field_list[$key_names]->gen_list_html().'</a>';
                                            else :
                                                echo '<a href="'.site_url($this_sub_record->info_link.$this_sub_record->id).'">'.$this_sub_record->field_list[$key_names]->gen_list_html().'</a>';
                                            endif;
                                        else :
                                            echo $this_sub_record->field_list[$key_names]->gen_list_html();

                                        endif;
                                        ?>
                                    </td>
                                <?
                                endforeach;
                                ?>
                                <?
                                if (isset($this->taskChangLog[$this_sub_record->id])){
                                ?>
                                    <td >
                                        <table class="table" >
                                        <?
                                        foreach ($this->taskChangLog[$this_sub_record->id] as $this_changelog){
                                            if ($this_changelog->field_list['changes']->value=="" && $this_changelog->field_list['solution']->value==""){
                                                continue;
                                            }
                                        ?>
                                        <tr>
                                            <td><?=$this_changelog->field_list['beginTS']->gen_show_html()?></td>
                                            <td><?=$this_changelog->field_list['changes']->gen_list_html()?></td>
                                            <td><?=$this_changelog->field_list['solution']->gen_show_html()?></td>
                                        </tr>
                                        <?
                                        }
                                        ?>
                                        </table>
                                    </td>
                                <?
                                } else {
                                ?>
                                    <td >
                                        无更新
                                    </td>
                                <?
                                }
                                ?>
                                <td>
                                    <?
                                    if ($this->$this_sub_record->is_lightbox):
                                        echo '<a class="list_op tooltips" href="javascript:void(0)" onclick="lightbox({size:\'m\',url:\''. site_url($this_record->info_link.$this_record->id).'\'})"><span class="glyphicon glyphicon-search"></span></a>';
                                    else :
                                        echo '<a  class="list_op tooltips" href="'.site_url($this_sub_record->info_link.$this_sub_record->id).'"><span class="glyphicon glyphicon-search"></span></a>';
                                    endif;
                                    ?>
                                     |
                                    <?php
                                    if ($this->canEdit) {
                                        echo $this_sub_record->gen_list_op();
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php
                        endforeach; ?>
                    <?
                    }
                    ?>
                <?php
                endforeach; ?>

            </tbody>
        </table>
        <?php
        if (count($this->taskList->record_list)==0):
        ?>
            <div class="no-data-large">
                没有相关记录
            </div>
        <?
        endif;
        ?>

    </div>
</div>
