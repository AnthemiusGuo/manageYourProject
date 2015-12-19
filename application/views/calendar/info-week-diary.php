<div class="col-lg-12">
    <table class="table table-striped">
        <thead>
            <tr>
                <?
                $row_counter = 0;
                foreach ($this->diaryList->listKeys as $key_names):
                    $row_counter++;
                ?>
                    <th>
                        <?php
                        echo $this->diaryList->dataModel[$key_names]->gen_show_name();;
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

            foreach($this->diaryList->record_list as  $this_record):
                // $this_begin_ts = $this_record->field_list['beginTS']->formatTSAsDayBeginTS();
                $this_begin_ts = $this->utility->getTS("beginToday");
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
                    foreach ($this->diaryList->listKeys as $key_names):
                    ?>
                        <td>
                            <?php
                            if ($this_record->field_list[$key_names]->is_title):
                                if ($this->diaryList->is_lightbox):
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
                        if ($this->diaryList->is_lightbox):
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
    if (count($this->diaryList->record_list)==0):
    ?>
        <div class="no-data-large">
            没有相关记录
        </div>
    <?
    endif;
    ?>

</div>
