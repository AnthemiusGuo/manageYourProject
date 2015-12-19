<?php
include_once(APPPATH."models/record_model.php");
class Resume_model extends Record_model {
    public function __construct() {
        parent::__construct('qResume');
        $this->uname = '';
        $this->uid = 0;

        $this->title_create = '简历库';

        $this->deleteCtrl = 'quiz';
        $this->deleteMethod = 'doDel/resume/';
        $this->edit_link = 'quiz/edit/resume/';
        $this->short_info_link = $this->info_link = 'quiz/info/resume/';


        $this->field_list['_id'] = $this->load->field('Field_mongoid',"uid","_id");
        $this->field_list['candidate'] = $this->load->field('Field_string',"候选人姓名","candidate",true);
        $this->field_list['name'] = $this->load->field('Field_relate_simple_id',"应聘岗位","name");
        $this->field_list['name']->set_relate_db('qPosition','_id','name');
        $this->field_list['name']->add_where(WHERE_TYPE_WHERE,'state',1);
        $this->field_list['name']->url = 'quiz/info/position';

        $this->field_list['departId'] = $this->load->field('Field_departid',"部门","departId");

        $this->field_list['source'] = $this->load->field('Field_enum',"简历来源","source");
        $this->field_list['source']->setEnum(array(0=>'其他',1=>'智联招聘',2=>'51job'));
        $this->field_list['firstReview'] = $this->load->field('Field_ts',"初试时间","firstReview");
        $this->field_list['firstInterviewer'] = $this->load->field('Field_userid',"初试面试官","firstInterviewer");
        $this->field_list['firstInterviewer']->add_where(WHERE_TYPE_OR_WHERE,'isManager',1);
        $this->field_list['firstInterviewer']->add_where(WHERE_TYPE_OR_WHERE,'isManager',2);

        $this->field_list['firstResult'] = $this->load->field('Field_enum',"初试结果","firstResult");
        $this->field_list['firstResult']->setEnum(array(0=>'未进行',1=>'审核中',2=>'通过进入下一环节',3=>'未通过'));
        $this->field_list['firstDes'] = $this->load->field('Field_text',"初试备注","firstDes");
        $this->field_list['secondReview'] = $this->load->field('Field_ts',"复试时间","secondReview");
        $this->field_list['secondInterviewer'] = $this->load->field('Field_userid',"复试面试官","secondInterviewer");
        $this->field_list['secondInterviewer']->add_where(WHERE_TYPE_OR_WHERE,'isManager',1);
        $this->field_list['secondInterviewer']->add_where(WHERE_TYPE_OR_WHERE,'isManager',2);
        $this->field_list['secondInterviewer']->add_where(WHERE_TYPE_OR_WHERE,'isManager',3);

        $this->field_list['secondResult'] = $this->load->field('Field_enum',"初试结果","secondResult");
        $this->field_list['secondResult']->setEnum(array(0=>'未进行',1=>'审核中',2=>'通过进入下一环节',3=>'未通过'));
        $this->field_list['secondDes'] = $this->load->field('Field_text',"复试备注","secondDes");

        $this->field_list['hrReview'] = $this->load->field('Field_ts',"hr面试时间","hrReview");
        $this->field_list['hr'] = $this->load->field('Field_userid',"负责hr","hr");
        $this->field_list['hr']->add_where(WHERE_TYPE_WHERE,'typ',9);

        $this->field_list['result'] = $this->load->field('Field_enum',"hr面试结果","result");
        $this->field_list['result']->setEnum(array(0=>'未进行',1=>'审核中',2=>'录用',3=>'未通过'));
        $this->field_list['des'] = $this->load->field('Field_text',"备注","des");

        $this->changeShowFields=array(
            array('name','candidate'),
            array('source','null'),
            array('firstReview','null'),
            array('firstInterviewer','firstResult'),
            array('firstDes'),
            array('secondReview','null'),
            array('secondInterviewer','secondResult'),
            array('secondDes'),
            array('hrReview','null'),
            array('hr','result'),
            array('des'),
        );

        $this->detailShowFields = array(
            array('name','candidate'),
            array('source','departId'),
            array('firstReview','null'),
            array('firstInterviewer','firstResult'),
            array('firstDes'),
            array('secondReview','null'),
            array('secondInterviewer','secondResult'),
            array('secondDes'),
            array('hrReview','null'),
            array('hr','result'),
            array('des'),
        );

    }

    public function buildChangeShowFields(){
            return $this->changeShowFields;
    }

    public function buildDetailShowFields(){
        return $this->detailShowFields;
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

    public function gen_op_edit(){
        if($this->userInfo->field_list['isManager']->value==3||$this->userInfo->field_list['typ']->value==9){
            return '<a class="list_op tooltips" onclick="lightbox({size:\'m\',url:\''.site_url($this->edit_link).'/'.$this->id.'\'})" title="编辑"><span class="glyphicon glyphicon-edit"></span></a>';
        }else if($this->userInfo->id==$this->field_list['firstInterviewer']->value){
            return '<a class="list_op tooltips" onclick="lightbox({size:\'m\',url:\''.site_url("/quiz/editFirst").'/'.$this->id.'\'})" title="编辑"><span class="glyphicon glyphicon-edit"></span></a>';
        }else if($this->userInfo->id==$this->field_list['secondInterviewer']->value){
            return '<a class="list_op tooltips" onclick="lightbox({size:\'m\',url:\''.site_url("/quiz/editSecond/").'/'.$this->id.'\'})" title="编辑"><span class="glyphicon glyphicon-edit"></span></a>';
        }
    }

    public function get_list_ops(){
        $allow_ops = parent::get_list_ops();

        return $allow_ops;
    }

    public function inc_counter(){
        $this->db->where(array('_id'=>new MongoId($this->id)))->increment($this->tableName,array('hitCounter'=>1));
    }


}
?>
