<?php
include_once(APPPATH."models/record_model.php");
class Contrast_model extends Record_model {
    public function __construct() {
        parent::__construct('qContrast');
        $this->uname = '';
        $this->uid = 0;
        $this->title_create = '快照';
        $this->deleteCtrl = 'calendar';
        $this->deleteMethod = 'doDel/contrast/';
        // $this->edit_link = 'calendar/edit/contrast/';
        $this->short_info_link = $this->info_link = 'calendar/info/contrast/';


        $this->field_list['_id'] = $this->load->field('Field_mongoid',"uid","_id");
        $this->field_list['name'] = $this->load->field('Field_string',"程序","name");
        $this->field_list['plan'] = $this->load->field('Field_string',"策划","plan");
        $this->field_list['art'] = $this->load->field('Field_string',"美术","art");
        $this->field_list['versionId'] = $this->load->field('Field_relate_simple_id',"所属版本","versionId");
        $this->field_list['versionId']->set_relate_db('pVersion','_id','name');
        $this->field_list['versionId']->add_where(WHERE_TYPE_WHERE,'packed',0);
        $this->field_list['versionId']->relateToProject = 1;

        $this->field_list['createTS'] = $this->load->field('Field_ts',"创建时间","createTS");

    }

    public function buildChangeShowFields(){
            return array(
                array('name','plan'),
                array('art'),
                );
    }

    public function buildDetailShowFields(){
        return array(
                    array('versionId','createTS'),
                    array('name','plan'),
                    array('art'),
                );
    }

    public function gen_list_html($templates){
        $msg = $this->load->view($templates, '', true);
    }
    public function gen_editor(){

    }

    public function buildInfoTitle(){
        return '<<快照>>';
    }

    public function do_delete_related($id){

    }

    public function get_list_ops(){
        $allow_ops=array();
        if(in_array($this->userInfo->field_list['typ']->value,array(1,4,100))){
            $allow_ops[] = 'delete';
        }

        return $allow_ops;
    }

    public function inc_counter(){
        $this->db->where(array('_id'=>new MongoId($this->id)))->increment($this->tableName,array('hitCounter'=>1));
    }


}
?>
