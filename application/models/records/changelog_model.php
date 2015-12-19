<?php
include_once(APPPATH."models/record_model.php");
class Changelog_model extends Record_model {
    public function __construct() {
        parent::__construct('pChangelog');
        $this->title_create = 'Change Log';
        $this->deleteCtrl = 'calendar';
        $this->deleteMethod = 'doDel/changelog';
        $this->edit_link = 'calendar/edit/changelog/';
        $this->short_info_link = $this->info_link = 'calendar/info/changelog/';

        $this->field_list['_id'] = $this->load->field('Field_mongoid',"id","_id");
        $this->field_list['name'] = $this->load->field('Field_string',"内容","name");
        $this->field_list['changes'] = $this->load->field('Field_text',"变化内容","changes");

        $this->field_list['typ'] = $this->load->field('Field_enum_colorful',"操作","typ");
        $this->field_list['typ']->setEnum(array('其他','新增','更新'));
        $this->field_list['typ']->setColor(array(0=>'default',1=>'danger',2=>'primary'));

        $this->field_list['solution'] = $this->load->field('Field_text',"解决方案","solution");

        $this->field_list['relate_turple'] = $this->load->field('Field_cross_relate',"关联内容","relate_turple");
        $this->field_list['relate_turple']->setEnum(array(
            0=>array('tableName'=>'pVersion','valueField'=>'_id','showField'=>'name'),
            1=>array('tableName'=>'pStory','valueField'=>'_id','showField'=>'name'),
            2=>array('tableName'=>'pFeature','valueField'=>'_id','showField'=>'name'),
            3=>array('tableName'=>'pActionitem','valueField'=>'_id','showField'=>'name'),
            4=>array('tableName'=>'tTask','valueField'=>'_id','showField'=>'name'),
            5=>array('tableName'=>'aNeeds','valueField'=>'_id','showField'=>'name'),
        ));

        $this->field_list['projectId'] = $this->load->field('Field_projectid',"所属项目","projectId");
        $this->field_list['versionId'] = $this->load->field('Field_relate_simple_id',"所属版本","versionId");
        $this->field_list['versionId']->set_relate_db('pVersion','_id','name');
        $this->field_list['versionId']->add_where(WHERE_TYPE_WHERE,'packed',0);

        $this->field_list['dueUser'] = $this->load->field('Field_userid',"负责人","dueUser");

        $this->field_list['beginTS'] = $this->load->field('Field_ts',"记录时间","beginTS");
    }

    public function gen_list_html($templates){
        $msg = $this->load->view($templates, '', true);
    }
    public function gen_editor(){

    }

    public function buildInfoTitle(){
        return '事项Action Item :'.$this->field_list['name']->gen_show_html();
    }

    public function buildChangeShowFields(){
            return array(
                    array('name'),
                    array('solution'),
                );
    }

    public function buildDetailShowFields(){
        return array(
            array('name','typ'),
            array('projectId','versionId'),
            array('dueUser'),
            array('solution'),

            );
    }

    public function do_delete_related($id){
        //用户表，清除店长

    }



}
?>
