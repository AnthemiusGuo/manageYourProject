<?php
include_once(APPPATH."models/record_model.php");
class Release_model extends Record_model {
    public function __construct() {
        parent::__construct('tRelease');
        $this->uname = '';
        $this->uid = 0;

        $this->title_create = 'release note';

        $this->deleteCtrl = 'test';
        $this->deleteMethod = 'doDel/release/';
        $this->edit_link = 'test/edit/release/';
        $this->short_info_link = $this->info_link = 'test/releaseInfo/';


        $this->field_list['_id'] = $this->load->field('Field_mongoid',"uid","_id");
        $this->field_list['name'] = $this->load->field('Field_string',"名称","name");
        $this->field_list['projectId'] = $this->load->field('Field_projectid',"当前项目","projectId");
        $this->field_list['versionId'] = $this->load->field('Field_relate_simple_id',"所属版本","versionId");
        $this->field_list['versionId']->set_relate_db('pVersion','_id','name');
        $this->field_list['versionId']->add_where(WHERE_TYPE_WHERE,'packed',0);
        $this->field_list['versionId']->url='calendar/info/version';
        $this->field_list['versionId']->relateToProject = 1;

        $this->field_list['pushTime'] = $this->load->field('Field_date',"发版日期","pushTime");
        $this->field_list['endTS'] = $this->load->field('Field_ts',"解决时间","endTS");
        $this->field_list['status'] = $this->load->field('Field_enum',"状态","status");
        $this->field_list['status']->setEnum(array(0=>'未发版',1=>'已发版',2=>'测试中',3=>'成功',4=>'失败'));

    }

    public function buildChangeShowFields(){
            return array(
                    array('name','versionId'),
                    array('pushTime','status'),
                );
    }

    public function buildDetailShowFields(){
        return array(
                    array('name'),
                    array('projectId','versionId'),
                    array('pushTime','status'),
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
