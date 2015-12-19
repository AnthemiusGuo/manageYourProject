<div class="col-lg-12 list-title-op">
    <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="lightbox({size:'m',url:'<?=site_url('calendar/create/story')?>'})"><span class="glyphicon glyphicon-file"></span> 新建</a>
</div>
<div class="col-lg-12">
    <table class="table table-striped">
        <thead>
            <tr>
                <?
                $col_count = 0;
                foreach ($this->storyList->listKeys as $key_names):
                    $col_count++;
                ?>
                    <th>
                        <?php
                        echo $this->storyList->dataModel[$key_names]->gen_show_name();;
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

            foreach($this->storyList->record_list as  $this_record):
                $i++;
                ?>
                <tr>

                    <?

                    foreach ($this->storyList->listKeys as $key_names):

                    ?>
                        <td>
                            <?php
                            if ($this_record->field_list[$key_names]->is_title):
                                if ($this->storyList->is_lightbox):
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
                    if (isset($this->storyChangLog[$this_record->id])){
                    ?>
                        <td >
                            <table class="table" >
                            <?
                            foreach ($this->storyChangLog[$this_record->id] as $this_changelog){
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
                        if ($this->storyList->is_lightbox):
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
    if (count($this->storyList->record_list)==0):
    ?>
        <div class="no-data-large">
            没有相关记录
        </div>
    <?
    endif;
    ?>

</div>
