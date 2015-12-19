<div class="row">
    <div class="col-lg-12 col-md-12">
        <h3><?=$this->releaseInfo->field_list['name']->gen_show_html()?></h3>
        <div class="list-title-op">
            <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="lightbox({size:'m',url:'<?=site_url('test/edit/release/'.$this->releaseInfo->id)?>'})">
                <span class="glyphicon glyphicon-pencil"></span> 编辑
            </a>
        </div>
        <table class="table table-striped">
            <tr>
                <td class="td_title"><?=$this->releaseInfo->field_list['name']->gen_show_name()?></td>
                <td class="td_data"><?=$this->releaseInfo->field_list['name']->gen_show_html()?></td>
                <td class="td_title"><?=$this->releaseInfo->field_list['projectId']->gen_show_name()?></td>
                <td class="td_data"><?=$this->releaseInfo->field_list['projectId']->gen_show_html()?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->releaseInfo->field_list['pushTime']->gen_show_name()?></td>
                <td class="td_data"><?=$this->releaseInfo->field_list['pushTime']->gen_show_html()?></td>
                <td class="td_title"><?=$this->releaseInfo->field_list['status']->gen_show_name()?></td>
                <td class="td_data"><?=$this->releaseInfo->field_list['status']->gen_show_html()?></td>
            </tr>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-default calendar">
            <div class="panel-heading">
                <h4 class="panel-title">相关功能
                <a class="btn btn-primary btn-xs pull-right" onclick="lightbox({size:'m',url:'<?=site_url('test/create/note/'.$this->releaseInfo->id)?>'})">新建<a>
                    </h4>

            </div>


            <table class="table table-striped">
                <thead>
                    <tr>
                        <?
                        $row_counter = 0;
                        foreach ($this->noteList->listKeys as $key_names):
                            $row_counter++;
                        ?>
                            <th>
                                <?php
                                echo $this->noteList->dataModel[$key_names]->gen_show_name();;
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

                    foreach($this->noteList->record_list as  $this_record):

                        $i++;
                        ?>
                        <tr>

                            <?
                            foreach ($this->noteList->listKeys as $key_names):
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
                                if ($this->noteList->is_lightbox):
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
            if (count($this->noteList->record_list)==0):
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
<br><br>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-default calendar">
            <div class="panel-heading">
                <h4 class="panel-title">相关bug</h4>
            </div>


            <table class="table table-striped">
                <thead>
                    <tr>
                        <?
                        $row_counter = 0;
                        foreach ($this->bugList->listKeys as $key_names):
                            $row_counter++;
                        ?>
                            <th>
                                <?php
                                echo $this->bugList->dataModel[$key_names]->gen_show_name();;
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

                    foreach($this->bugList->record_list as  $this_record):

                        $i++;
                        ?>
                        <tr>

                            <?
                            foreach ($this->bugList->listKeys as $key_names):
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
                                if ($this->bugList->is_lightbox):
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
            if (count($this->bugList->record_list)==0):
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
