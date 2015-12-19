<div class="row">
    <div class="col-lg-12 col-md-12">
        <h3><?=$this->needInfo->field_list['name']->gen_show_html()?></h3>
        <div class="list-title-op">
            <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="lightbox({size:'m',url:'<?=site_url('art/edit/needs/'.$this->needInfo->id)?>'})">
                <span class="glyphicon glyphicon-pencil"></span> 编辑
            </a>
        </div>
        <table class="table table-striped">
            <tr>
                <td><?=$this->needInfo->field_list['projectId']->gen_show_name()?></td>
                <td><?=$this->needInfo->field_list['projectId']->gen_show_html()?></td>
                <td><?=$this->needInfo->field_list['versionId']->gen_show_name()?></td>
                <td><?=$this->needInfo->field_list['versionId']->gen_show_html()?></td>
                <td><?=$this->needInfo->field_list['priority']->gen_show_name()?></td>
                <td><?=$this->needInfo->field_list['priority']->gen_show_html()?></td>
            </tr>
            <tr>
                <td width="7%"><?=$this->needInfo->field_list['typ']->gen_show_name()?></td>
                <td width="13%"><?=$this->needInfo->field_list['typ']->gen_show_html()?></td>
                <td width="7%"><?=$this->needInfo->field_list['name']->gen_show_name()?></td>
                <td width="13%"><?=$this->needInfo->field_list['name']->gen_show_html()?></td>
                <td width="7%"><?=$this->needInfo->field_list['num']->gen_show_name()?></td>
                <td width="13%"><?=$this->needInfo->field_list['num']->gen_show_html()?></td>
                <td width="7%"><?=$this->needInfo->field_list['status']->gen_show_name()?></td>
                <td width="13%"><?=$this->needInfo->field_list['status']->gen_show_html()?></td>
            </tr>
            <tr>
                <td><?=$this->needInfo->field_list['createUid']->gen_show_name()?></td>
                <td><?=$this->needInfo->field_list['createUid']->gen_show_html()?></td>
                <td><?=$this->needInfo->field_list['dueUser']->gen_show_name()?></td>
                <td><?=$this->needInfo->field_list['dueUser']->gen_show_html()?></td>

                <td><?=$this->needInfo->field_list['createTS']->gen_show_name()?></td>
                <td><?=$this->needInfo->field_list['createTS']->gen_show_html()?></td>
                <td><?=$this->needInfo->field_list['dueEndTS']->gen_show_name()?></td>
                <td><?=$this->needInfo->field_list['dueEndTS']->gen_show_html()?></td>
            </tr>
            <tr>
                <td><?=$this->needInfo->field_list['endTS']->gen_show_name()?></td>
                <td><?=$this->needInfo->field_list['endTS']->gen_show_html()?></td>
                <td><?=$this->needInfo->field_list['details']->gen_show_name()?></td>
                <td colspan="5"><?=$this->needInfo->field_list['details']->gen_show_html()?></td>
            </tr>
            <tr>
                <td><?=$this->needInfo->field_list['pic']->gen_show_name()?></td>
                <td colspan="7"><?=$this->needInfo->field_list['pic']->gen_show_html()?></td>
            </tr>
            <tr>
                <td><?=$this->needInfo->field_list['pics']->gen_show_name()?></td>
                <td colspan="7"><?=$this->needInfo->field_list['pics']->gen_show_html()?></td>
            </tr>
            <tr>
                <td><?=$this->needInfo->field_list['doc']->gen_show_name()?></td>
                <td colspan="7"><?=$this->needInfo->field_list['doc']->gen_show_html()?></td>
            </tr>
            <tr>
                <td><?=$this->needInfo->field_list['docs']->gen_show_name()?></td>
                <td colspan="7"><?=$this->needInfo->field_list['docs']->gen_show_html()?></td>
            </tr>
        </table>
    </div>
    <div class="col-lg-12 col-md-12">
        <div class="list-title-op">
            <a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="lightbox({size:'m',url:'<?=site_url('art/create/artskill/'.$this->needInfo->id)?>'})">
                <span class="glyphicon glyphicon-pencil"></span> 新建技能动作需求
            </a>
        </div>
    </div>
</div>
