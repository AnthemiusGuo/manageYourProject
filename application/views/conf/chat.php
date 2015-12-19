<?php include_once('header.php');?>
<div class="row">

    <div class="col-lg-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <?
                    $col_count = 0;
                    foreach ($this->confItemList->listKeys as $key_names):
                        $col_count++;
                    ?>
                        <th>
                            <?php
                            echo $this->confItemList->dataModel[$key_names]->gen_show_name();;
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

                foreach($this->confItemList->record_list as  $this_record):
                    $i++;
                    ?>
                    <tr>

                        <?

                        foreach ($this->confItemList->listKeys as $key_names):

                        ?>
                            <td>
                                <?php
                                if ($this_record->field_list[$key_names]->is_title):
                                    if ($this->confItemList->is_lightbox):
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
                            if ($this->confItemList->is_lightbox):
                                echo '<a class="list_op tooltips" href="javascript:void(0)" onclick="lightbox({size:\'m\',url:\''. site_url($this_record->info_link.$this_record->id).'\'})"><span class="glyphicon glyphicon-search"></span></a>';
                            else :
                                echo '<a  class="list_op tooltips" href="'.site_url($this_record->info_link.$this_record->id).'"><span class="glyphicon glyphicon-search"></span></a>';
                            endif;
                            ?>
                             |
                            <?php
                            if ($this->canEdit) {
                                echo $this_record->gen_list_op('conf');
                            }
                            ?>
                        </td>
                    </tr>

                <?php
                endforeach; ?>

            </tbody>
        </table>
        <?php
        if (count($this->confItemList->record_list)==0):
        ?>
            <div class="no-data-large">
                没有相关记录
            </div>
        <?
        endif;
        ?>

    </div>
</div>
