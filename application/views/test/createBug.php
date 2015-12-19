<h3><?
if($this->bugId!=0){
    echo "编辑";
}else{
    echo $this->title_create;
}
?></h3>

<div class="row">
    <div class="col-lg-7 col-md-12">
        <table class="table table-striped">
            <tr>
                <td class="td_title"><?=$this->dataInfo->field_list['name']->gen_editor_show_name()?></td>
                <td class="td_data"><?=$this->dataInfo->field_list['name']->gen_editor($this->editor_typ)?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->dataInfo->field_list['reStep']->gen_editor_show_name()?></td>
                <?
                if($this->bugId!=0){
                ?>
                <td class="td_data"><?=$this->dataInfo->field_list['reStep']->gen_editor($this->editor_typ)?></td>
                <?}else{?>
                <td class="td_data"><?=$this->dataInfo->field_list['reStep']->gen_editorAdd($this->editor_typ,$this->tmp)?></td>
                <?}?>
            </tr>
            <tr>
                <td class="td_title"><?=$this->dataInfo->field_list['desc']->gen_editor_show_name()?></td>
                <td class="td_data"><?=$this->dataInfo->field_list['desc']->gen_editor($this->editor_typ)?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->dataInfo->field_list['picture']->gen_editor_show_name()?></td>
                <td class="td_data"><?=$this->dataInfo->field_list['picture']->gen_editor($this->editor_typ)?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->dataInfo->field_list['attachment']->gen_editor_show_name()?></td>
                <td class="td_data"><?=$this->dataInfo->field_list['attachment']->gen_editor($this->editor_typ)?></td>
            </tr>
        </table>
    </div>
    <div class="col-lg-5 col-md-12">
        <table class="table table-striped">
            <tr>
                <td class="td_title"><?=$this->dataInfo->field_list['projectId']->gen_editor_show_name()?></td>
                <td class="td_data"><?=$this->projectName?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->dataInfo->field_list['releaseId']->gen_editor_show_name()?></td>
                <td class="td_data"><?=$this->dataInfo->field_list['releaseId']->gen_editor($this->editor_typ)?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->dataInfo->field_list['typ']->gen_editor_show_name()?></td>
                <td class="td_data"><?=$this->dataInfo->field_list['typ']->gen_editor($this->editor_typ)?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->dataInfo->field_list['level']->gen_editor_show_name()?></td>
                <td class="td_data"><?=$this->dataInfo->field_list['level']->gen_editor($this->editor_typ)?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->dataInfo->field_list['priority']->gen_editor_show_name()?></td>
                <td class="td_data"><?=$this->dataInfo->field_list['priority']->gen_editor($this->editor_typ)?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->dataInfo->field_list['dueUser']->gen_editor_show_name()?></td>
                <td class="td_data"><?=$this->dataInfo->field_list['dueUser']->gen_editor($this->editor_typ)?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->dataInfo->field_list['IE']->gen_editor_show_name()?></td>
                <td class="td_data"><?=$this->dataInfo->field_list['IE']->gen_editor($this->editor_typ)?></td>
            </tr>
            <tr>
                <td class="td_title"><?=$this->dataInfo->field_list['relatedUsers']->gen_editor_show_name()?></td>
                <td class="td_data"><?=$this->dataInfo->field_list['relatedUsers']->gen_editor($this->editor_typ)?></td>
            </tr>
        </table>
    </div>
</div>
<div class="list-title-op">
    <?if($this->bugId!=0){?>
    <button type="button" class="btn btn-primary" onclick="reqEdit('test','doUpdateBug/bug',reqEditFields,editFormValidator)">保存</button>
    <?}else{?>
    <button type="button" class="btn btn-primary" onclick="reqCreate('test','doCreate/bug',reqCreateFields,createFormValidator)">保存</button>
    <?}?>
    <a href="<?=site_url('test/bug/')?>" class="btn btn-default">取消
    </a>
</div>
