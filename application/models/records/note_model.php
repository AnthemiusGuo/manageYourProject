<?php
include_once(APPPATH."models/record_model.php");
class Note_model extends Record_model {
    public function __construct() {
        parent::__construct('tNote');
        $this->uname = '';
        $this->uid = 0;

        $this->title_create = 'note';

        $this->deleteCtrl = 'test';
        $this->deleteMethod = 'doDel/note/';
        $this->edit_link = 'test/edit/note/';
        $this->short_info_link = $this->info_link = 'test/info/note/';


        $this->field_list['_id'] = $this->load->field('Field_mongoid',"uid","_id");
        $this->field_list['name'] = $this->load->field('Field_string',"标题","name");

        $this->field_list['releaseId'] = $this->load->field('Field_relate_simple_id',"release","releaseId");
        $this->field_list['releaseId']->set_relate_db('tRelease','_id','name');
        $this->field_list['releaseId']->add_where(WHERE_TYPE_WHERE,'packed',0);
        $this->field_list['releaseId']->relateToProject = 1;

        $this->field_list['createUid'] = $this->load->field('Field_userid',"创建人","createUid");
        $this->field_list['dueUser'] = $this->load->field('Field_userid',"负责人","dueUser");
        $this->field_list['dueUser']->add_where(WHERE_TYPE_IN,'typ',array(2,3));

        $this->field_list['createTS'] = $this->load->field('Field_ts',"发起时间","createTS");
        $this->field_list['endTS'] = $this->load->field('Field_ts',"处理时间","endTS");
        $this->field_list['typ'] = $this->load->field('Field_enum',"类型","typ");
        $this->field_list['typ']->setEnum(array(0=>'feature',1=>'bug',2=>'minorImprove'));

    }

    public function buildChangeShowFields(){
            return array(
                    array('typ','dueUser'),
                    array('name'),
                    array('releaseId'),
                );
    }

    public function buildDetailShowFields(){
        return array(
                    array('name','typ'),
                    array('createUid','dueUser'),
                    array('createTS'),
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
