<?php
include_once(APPPATH."models/record_model.php");
class Confitem_model extends Record_model {
    public function __construct() {
        parent::__construct('sConfitem');
        $this->title_create = '例会讨论内容';
        $this->deleteCtrl = 'common';
        $this->deleteMethod = 'doDel/confitem';
        $this->edit_link = 'task/edit/confitem/';
        $this->info_link = 'task/info/confitem/';
        $this->short_info_link = 'task/info/confitem';


        $this->field_list['_id'] = $this->load->field('Field_mongoid',"id","_id");
        $this->field_list['name'] = $this->load->field('Field_title',"名称","name",true);

        $this->field_list['desc'] = $this->load->field('Field_text',"备注","desc");

        $this->field_list['status'] = $this->load->field('Field_enum_colorful',"状态","status");
        $this->field_list['status']->setEnum(array(2=>'未讨论',1=>'已讨论'));
        $this->field_list['status']->setColor(array(2=>'danger',1=>'success'));
        $this->field_list['status']->setDefault(2);

        $this->field_list['createUid'] = $this->load->field('Field_userid',"提出人","createUid");

        $this->field_list['beginTS'] = $this->load->field('Field_date',"计划讨论时间","beginTS");
        $this->field_list['createTS'] = $this->load->field('Field_date',"创建时间","createTS");


        $this->changeShowFields = array(
            array('name'),
            array('status','beginTS'),
            array('desc'),
        );

        $this->detailShowFields = array(
            array('name'),
            array('status','beginTS'),
            array('desc'),
        );
    }


    public function buildInfoTitle(){
        return '讨论项 :'.$this->field_list['name']->gen_show_html();
    }

    public function buildChangeShowFields(){
        return $this->changeShowFields;
    }

    public function buildDetailShowFields(){
        return $this->detailShowFields;
    }

    public function gen_op_end(){
        return '<a class="list_op tooltips" onclick=\'reqOperator("task","doEnd","'.$this->id.'")\' title="确认"><span class="glyphicon glyphicon-ok"></span></a>';
    }

    public function gen_op_send(){
        return '<a class="list_op tooltips" onclick=\'lightbox({size:"m",url:"'.
            site_url("/task/edit/sendtask/".$this->id).'"})\' title="创建任务"><span class="glyphicon glyphicon-send"></span></a>';
    }

    public function get_list_ops($limits=''){
        $allow_ops = array();


        if ($limits!="conf"){
            $allow_ops[] = 'delete';
            $allow_ops[] = 'edit';
        } else {
            $allow_ops[] = 'end';
            // $allow_ops[] = 'send';
        }

        return $allow_ops;
    }


}
?>
