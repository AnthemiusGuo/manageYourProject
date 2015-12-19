<?php
include_once(APPPATH."models/record_model.php");
class Crate_model extends Record_model {
    public function __construct() {
        parent::__construct('oCrate');
        $this->uname = '';
        $this->uid = 0;

        $this->title_create = '开机箱申请';

        $this->deleteCtrl = 'operate';
        $this->deleteMethod = 'doDel/crate/';
        $this->edit_link = 'operate/edit/crate/';
        $this->short_info_link = $this->info_link = 'operate/info/crate/';


        $this->field_list['_id'] = $this->load->field('Field_mongoid',"uid","_id");
        $this->field_list['name'] = $this->load->field('Field_string',"原因","name");
        $this->field_list['createUid'] = $this->load->field('Field_userid',"请求人","createUid");
        $this->field_list['examineUser'] = $this->load->field('Field_userid',"审批人","examineUser");
        $this->field_list['dealUser'] = $this->load->field('Field_userid',"执行人","dealUser");

        $this->field_list['crateId'] = $this->load->field('Field_string',"机箱号","crateId");

        $this->field_list['createTS'] = $this->load->field('Field_ts',"发起时间","createTS");
        $this->field_list['endTS'] = $this->load->field('Field_ts',"处理时间","endTS");
        $this->field_list['state'] = $this->load->field('Field_enum',"状态","state");
        $this->field_list['state']->setEnum(array(0=>'正在请求',1=>'取消',2=>'操作成功',3=>'审批成功'));

    }

    public function buildChangeShowFields(){
            return array(
                    array('name'),
                    // array('beginTS'),
                );
    }

    public function buildDetailShowFields(){
        return array(
                    array('name'),
                    array('createUid','state'),
                    array('crateId'),
                    array('examineUser','dealUser'),
                    array('createTS','endTS'),
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

    public function gen_op_cancel(){
        // $this->field_list['state']=array[1];
        return '<a class="list_op tooltips" onclick=\'reqOperator("operate","doCancel","'.$this->id.'","取消开启")\' title="取消"><span class="glyphicon glyphicon-remove"></span></a>';

    }
    public function gen_op_examine(){
        // $this->field_list['state']=array[1];
        return '<a class="list_op tooltips" onclick=\'reqOperator("operate","doExamine","'.$this->id.'","确认审批")\' title="确认"><span class="glyphicon glyphicon-ok"></span></a>';

    }
    public function gen_op_confirm(){
        // $this->field_list['state']=array[2];
        return '<a class="list_op tooltips" onclick=\'reqOperator("operate","doConfirm","'.$this->id.'","确认开启")\' title="确认"><span class="glyphicon glyphicon-ok-sign"></span></a>';

    }
    public function get_list_ops(){
        $allow_ops=array();
        if($this->userInfo->field_list['typ']->value!=6 && $this->userInfo->id==(string)$this->field_list['createUid']->value&&$this->field_list['state']->value==0){
        $allow_ops[] = 'cancel';
    }
        if($this->userInfo->field_list['isManager']->value==3&&$this->field_list['state']->value==0){
            $allow_ops[] = 'examine';
        }
        if($this->userInfo->field_list['typ']->value==6&&$this->field_list['state']->value==3){
            $allow_ops[] = 'confirm';
    }
        return $allow_ops;
    }

    public function inc_counter(){
        $this->db->where(array('_id'=>new MongoId($this->id)))->increment($this->tableName,array('hitCounter'=>1));
    }


}
?>
