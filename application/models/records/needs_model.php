<?php
include_once(APPPATH."models/record_model.php");
class Needs_model extends Record_model {
    public function __construct() {
        parent::__construct('aNeeds');
        $this->uname = '';
        $this->uid = 0;
        $this->title_create = '美术需求';
        $this->deleteCtrl = 'art';
        $this->deleteMethod = 'doDel/needs/';
        $this->edit_link = 'art/edit/needs/';
        // $this->short_info_link = $this->info_link = 'art/info/needs/';
        $this->short_info_link = $this->info_link = 'art/needsinfo/';
        $this->is_lightbox = false;


        $this->field_list['_id'] = $this->load->field('Field_mongoid',"uid","_id");
        $this->field_list['projectId'] = $this->load->field('Field_projectid',"当前项目","projectId");
        $this->field_list['versionId'] = $this->load->field('Field_relate_simple_id',"所属版本","versionId");
        $this->field_list['versionId']->set_relate_db('pVersion','_id','name');
        $this->field_list['versionId']->add_where(WHERE_TYPE_WHERE,'packed',0);
        $this->field_list['versionId']->url = 'calendar/info/version';
        $this->field_list['versionId']->relateToProject = 1;
        $this->field_list['typ'] = $this->load->field('Field_enum',"分类","typ");
        $this->field_list['typ']->setEnum(array('其他','UI','2D场景','3D人物','动作特效'));
        $this->field_list['priority'] = $this->load->field('Field_enum',"优先级","priority");
        $this->field_list['priority']->setEnum(array('S','A','B','C'));
        $this->field_list['priority']->setDefault(3);
        $this->field_list['name'] = $this->load->field('Field_string',"美术需求","name",true);
        $this->field_list['num'] = $this->load->field('Field_float',"需求数量","num",true);
        $this->field_list['num']->setDefault(1);

        $this->field_list['dueUser'] = $this->load->field('Field_userid',"负责人","dueUser");
        $this->field_list['dueUser']->set_in_typ(array(5));
        $this->field_list['createUid'] = $this->load->field('Field_userid',"发起人","createUid");
        $this->field_list['createTS'] = $this->load->field('Field_ts',"发起时间","createTS");
        $this->field_list['beginTS'] = $this->load->field('Field_date',"开工时间","beginTS");
        $this->field_list['dueEndTS'] = $this->load->field('Field_date',"预期完成日期","dueEndTS");
        $this->field_list['endTS'] = $this->load->field('Field_ts',"实际完成时间","endTS");
        $this->field_list['details'] = $this->load->field('Field_text',"详细说明","details");

        $this->field_list['status'] = $this->load->field('Field_enum_colorful',"状态","status");
        $this->field_list['status']->setEnum(array(0=>'未确认',1=>'进行中',2=>'完工',3=>'已确认'));
        $this->field_list['status']->setColor(array(0=>'danger',1=>'primary',2=>'success'));

        $this->field_list['pic'] = $this->load->field('Field_pic',"pic","pic");
        $this->field_list['pic']->uploadUrl = "art/doUpload/needs/";
        $this->field_list['pics'] = $this->load->field('Field_array_pics',"pics","pics");
        $this->field_list['pics']->uploadUrl = "art/doUpload/needs/";

        $this->field_list['doc'] = $this->load->field('Field_file',"doc","doc");
        $this->field_list['doc']->uploadUrl = "art/doUpload/needs/";

        $this->field_list['docs'] = $this->load->field('Field_array_files',"docs","docs");
        $this->field_list['docs']->uploadUrl = "art/doUpload/needs/";


        $this->has_changelog = true;
        $this->changelog_typ = 5;
    }

    public function buildChangeShowFields(){
            return array(
                    array('projectId','versionId'),
                    array('name','num'),
                    array('typ','priority'),
                    array('dueEndTS','dueUser'),
                    array('details'),
                    array('pic'),
                    array('pics'),
                    array('doc'),
                    array('docs'),

                );
    }

    public function buildDetailShowFields(){
        return array(
                    array('projectId','versionId'),
                    array('typ','status'),
                    array('name','num'),
                    array('createTS','dueEndTS'),
                    array('endTS','dueUser'),
                    array('details'),
                );
    }
    public function write_changelog($typ,$data,$changelog){
        $logData = array();

        if ($typ=='create'){
            $this->init_with_part_data($data);
            $logData['typ'] = 1;
            $logData['relate_turple'] = array('t'=>$this->changelog_typ,'v'=>(string)$data['_id']);
            $logData['name'] = $data['name'];
            $logData['changes'] = '[预期结束时间] =>'.$this->field_list['dueEndTS']->gen_show_html();
            $this->do_write_create_changelog($data,$changelog,$logData);

        } elseif ($typ=='update'){
            $this->init_with_part_data($data);
            $logData['typ'] =2;

            $logData['relate_turple'] = array('t'=>$this->changelog_typ,'v'=>$this->id);
            $logData['name'] = $this->field_list['name']->value;
            $logData['changes'] = '';
            $keyChanged = false;

            if (isset($data['status'])){
                $keyChanged = true;
                $logData['changes'] .= '[状态] =>'.$this->field_list['status']->gen_show_html()."\n";
            }
            if (isset($data['endTS'])){
                $keyChanged = true;
                $logData['changes'] .= '[结束时间] =>'.$this->field_list['endTS']->gen_show_html()."\n";
            }
            if (isset($data['dueEndTS'])){
                $keyChanged = true;
                $logData['changes'] .= '[预期结束时间] =>'.$this->field_list['endTS']->gen_show_html()."\n";
            }

            if ($keyChanged==false && $changelog===false){
                return;
            }


            $this->do_write_update_changelog($data,$changelog,$logData);
        } else {
            $logData['typ'] =0;
            $logData['name'] = $data['name'];
            $this->do_write_other_changelog($data,$changelog,$logData);
        }
    }

    public function gen_list_html($templates){
        $msg = $this->load->view($templates, '', true);
    }
    public function gen_editor(){

    }

    public function buildInfoTitle(){
        return '美术需求 :'.$this->field_list['name']->gen_show_html();
    }

    public function do_delete_related($id){

    }

    public function gen_op_confirm(){
        return '<a class="list_op tooltips" onclick=\'reqOperator("art","doConfirm","'.$this->id.'","确认需求？")\' title="确认"><span class="glyphicon glyphicon-ok"></span></a>';
    }

    public function gen_op_finish(){
        return '<a class="list_op tooltips" onclick=\'reqOperator("art","doFinish","'.$this->id.'","确认完工提交？")\' title="确认"><span class="glyphicon glyphicon-send"></span></a>';
    }

    public function get_list_ops(){

        $allow_ops = parent::get_list_ops();

        if ($this->field_list['status']->value==0){
            $allow_ops[] = 'confirm';
        } else if ($this->field_list['status']->value==1){
            $allow_ops[] = 'finish';

        }

        return $allow_ops;
    }

    public function inc_counter(){
        $this->db->where(array('_id'=>new MongoId($this->id)))->increment($this->tableName,array('hitCounter'=>1));
    }


}
?>
