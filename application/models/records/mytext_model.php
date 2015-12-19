<?php
include_once(APPPATH."models/record_model.php");
class Mytext_model extends Record_model {
    public function __construct() {
        parent::__construct('mMytext');
        $this->uname = '';
        $this->uid = 0;
        $this->title_create = '个人记事本';
        $this->deleteCtrl = 'task';
        $this->deleteMethod = 'doDel/mytext/';
        $this->edit_link = 'task/edit/mytext/';
        $this->short_info_link = $this->info_link = 'task/info/mytext/';


        $this->field_list['_id'] = $this->load->field('Field_mongoid',"uid","_id");
        $this->field_list['name'] = $this->load->field('Field_string',"标题","name",true);
        $this->field_list['createUid'] = $this->load->field('Field_userid',"创建人","createUid");

        $this->field_list['editTS'] = $this->load->field('Field_ts',"最后编辑时间","editTS");
        $this->field_list['content'] = $this->load->field('Field_text',"内容","content");

    }

    public function buildChangeShowFields(){
            return array(
                array('name'),
                array('content'),
                );
    }

    public function buildDetailShowFields(){
        return array(
                    array('name'),
                    array('content'),
                    array('editTS'),
                );
    }

    public function gen_list_html($templates){
        $msg = $this->load->view($templates, '', true);
    }
    public function gen_editor(){

    }

    public function buildInfoTitle(){
        return '记事本 :'.$this->field_list['name']->gen_show_html();
    }

    public function do_delete_related($id){

    }

    public function inc_counter(){
        $this->db->where(array('_id'=>new MongoId($this->id)))->increment($this->tableName,array('hitCounter'=>1));
    }


}
?>
