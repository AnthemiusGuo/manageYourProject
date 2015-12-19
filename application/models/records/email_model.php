<?php
include_once(APPPATH."models/record_model.php");
class Email_model extends Record_model {
    public function __construct() {
        parent::__construct('iEmail');
        $this->uname = '';
        $this->uid = 0;
        $this->title_create = '美术需求';
        $this->deleteCtrl = 'email';
        $this->deleteMethod = 'doDel/email/';
        $this->edit_link = 'email/edit/email/';
        $this->short_info_link = $this->info_link = 'email/info/email/';


        $this->field_list['_id'] = $this->load->field('Field_mongoid',"uid","_id");
        $this->field_list['name'] = $this->load->field('Field_string',"邮件标题","name",true);
        $this->field_list['createUid'] = $this->load->field('Field_userid',"发送人","createUid");
        $this->field_list['recUser'] = $this->load->field('Field_userid',"接收人","recUser",true);

        $this->field_list['createTS'] = $this->load->field('Field_ts',"发起时间","createTS");
        $this->field_list['content'] = $this->load->field('Field_text',"内容","content");

        $this->field_list['status'] = $this->load->field('Field_enum_colorful',"状态","status");
        $this->field_list['status']->setEnum(array(0=>'未读',1=>'已读'));
        $this->field_list['status']->setColor(array(0=>'danger',1=>'success'));

    }

    public function buildChangeShowFields(){
            return array(
                array('name','recUser'),
                array('content'),
                );
    }

    public function buildDetailShowFields(){
        return array(
                    array('name'),
                    array('createUid','recUser'),
                    array('content'),
                    array('createTS'),
                );
    }

    public function gen_list_html($templates){
        $msg = $this->load->view($templates, '', true);
    }
    public function gen_editor(){

    }

    public function buildInfoTitle(){
        return '邮件 :'.$this->field_list['name']->gen_show_html();
    }

    public function do_delete_related($id){

    }

    public function gen_op_delete(){
        return '<a class="list_op tooltips" onclick=\'reqDelete("'.$this->deleteCtrl.'","'.$this->deleteMethod.'","'.$this->id.'")\' title="删除"><span class="glyphicon glyphicon-trash"></span></a>';

    }

    public function get_list_ops(){
        $allow_ops[] = 'delete';

        return $allow_ops;
    }

    public function inc_counter(){
        $this->db->where(array('_id'=>new MongoId($this->id)))->increment($this->tableName,array('hitCounter'=>1));
    }


}
?>
