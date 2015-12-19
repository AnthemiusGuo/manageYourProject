<div class="row">
    <div class="col-lg-7 col-md-12">
        <h3><?=$this->dataInfo->field_list['name']->gen_show_html()?></h3>
        <div class="list-title-op">
            <a href="<?=site_url('test/editBug/'.$this->dataInfo->id)?>" class="btn btn-primary btn-sm" ><span class="glyphicon glyphicon-pencil"></span> 编辑</a>
        </div>
        <table class="table table-striped">
            <tr>
                <td class="td_title"><?=$this->dataInfo->field_list['name']->gen_show_name()?></td>
                <td class="td_data"><?=$this->dataInfo->field_list['name']->gen_show_html()?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->dataInfo->field_list['createUid']->gen_show_name()?></td>
                <td class="td_data"><?=$this->dataInfo->field_list['createUid']->gen_show_html()?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->dataInfo->field_list['reStep']->gen_show_name()?></td>
                <td class="td_data"><?=$this->dataInfo->field_list['reStep']->gen_show_html()?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->dataInfo->field_list['desc']->gen_show_name()?></td>
                <td class="td_data"><?=$this->dataInfo->field_list['desc']->gen_show_html()?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->dataInfo->field_list['picture']->gen_show_name()?></td>
                <td class="td_data"><?=$this->dataInfo->field_list['picture']->gen_show_html()?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->dataInfo->field_list['attachment']->gen_show_name()?></td>
                <td class="td_data"><?=$this->dataInfo->field_list['attachment']->gen_show_html()?></td>
            </tr>
        </table>
    </div>
    <br><br><br><br>
    <div class="col-lg-5 col-md-12">
        <table class="table table-striped">
            <tr>
                <td class="td_title"><?=$this->dataInfo->field_list['projectId']->gen_show_name()?></td>
                <td class="td_data"><?=$this->dataInfo->field_list['projectId']->gen_show_html()?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->dataInfo->field_list['versionId']->gen_editor_show_name()?></td>
                <td class="td_data"><?=$this->dataInfo->field_list['versionId']->gen_show_html()?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->dataInfo->field_list['releaseId']->gen_editor_show_name()?></td>
                <td class="td_data"><?=$this->dataInfo->field_list['releaseId']->gen_show_html()?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->dataInfo->field_list['typ']->gen_show_name()?></td>
                <td class="td_data"><?=$this->dataInfo->field_list['typ']->gen_show_html()?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->dataInfo->field_list['level']->gen_show_name()?></td>
                <td class="td_data"><?=$this->dataInfo->field_list['level']->gen_show_html()?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->dataInfo->field_list['priority']->gen_editor_show_name()?></td>
                <td class="td_data"><?=$this->dataInfo->field_list['priority']->gen_show_html()?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->dataInfo->field_list['status']->gen_show_name()?></td>
                <td class="td_data"><?=$this->dataInfo->field_list['status']->gen_show_html()?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->dataInfo->field_list['dueUser']->gen_show_name()?></td>
                <td class="td_data"><?=$this->dataInfo->field_list['dueUser']->gen_show_html()?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->dataInfo->field_list['IE']->gen_show_name()?></td>
                <td class="td_data"><?=$this->dataInfo->field_list['IE']->gen_show_html()?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->dataInfo->field_list['relatedUsers']->gen_show_name()?></td>
                <td class="td_data"><?=$this->dataInfo->field_list['relatedUsers']->gen_show_html()?></td>
            </tr>
        </table>
    </div>
</div>
