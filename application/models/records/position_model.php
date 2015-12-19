<?php
include_once(APPPATH."models/record_model.php");
class Position_model extends Record_model {
    public function __construct() {
        parent::__construct('qPosition');
        $this->uname = '';
        $this->uid = 0;

        $this->title_create = '岗位需求';

        $this->deleteCtrl = 'quiz';
        $this->deleteMethod = 'doDel/position/';
        $this->edit_link = 'quiz/edit/position/';
        $this->short_info_link = $this->info_link = 'quiz/info/position/';


        $this->field_list['_id'] = $this->load->field('Field_mongoid',"uid","_id");
        $this->field_list['name'] = $this->load->field('Field_string',"所需岗位","name",true);
        $this->field_list['num'] = $this->load->field('Field_float',"所需人数","num");
        $this->field_list['fNum'] = $this->load->field('Field_float',"已完成人数","fNum");

        $this->field_list['createUid'] = $this->load->field('Field_userid',"发起人","createUid");

        $this->field_list['createTS'] = $this->load->field('Field_date',"发起时间","createTS");
        $this->field_list['endDate'] = $this->load->field('Field_date',"結束时间","endDate");

        $this->field_list['state'] = $this->load->field('Field_enum',"状态","state");
        $this->field_list['state']->setEnum(array(0=>'新提交',1=>'已确认',2=>'已结束'));
        $this->field_list['departId'] = $this->load->field('Field_departid',"部门","departId");

        $this->field_list['jd'] = $this->load->field('Field_text',"JD","jd");

    }

    public function buildChangeShowFields(){
            return array(
                    array('name','null'),
                    array('num','fNum'),
                    array('endDate','state'),
                    array('jd'),

                );
    }

    public function buildDetailShowFields(){
        return array(
                    array('createUid','state'),
                    array('name','departId'),
                    array('num','fNum'),
                    array('createTS','endDate'),
                    array('jd'),

                );
    }


    public function gen_list_html($templates){
        $msg = $this->load->view($templates, '', true);
    }
    public function gen_editor(){

    }

    public function buildInfoTitle(){
        return $this->field_list['name']->gen_show_html();
    }

    public function do_delete_related($id){

    }

    public function inc_counter(){
        $this->db->where(array('_id'=>new MongoId($this->id)))->increment($this->tableName,array('hitCounter'=>1));
    }


}
?>
