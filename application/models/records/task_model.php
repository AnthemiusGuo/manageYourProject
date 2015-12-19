<?php
include_once(APPPATH."models/record_model.php");
class Task_model extends Record_model {
    public function __construct() {
        parent::__construct('tTask');
        $this->title_create = '工作';
        $this->deleteCtrl = 'common';
        $this->deleteMethod = 'doDel/task';
        $this->edit_link = 'task/edit/task/';
        $this->info_link = 'task/taskinfo/';
        $this->short_info_link = 'task/info/task';


        $this->field_list['_id'] = $this->load->field('Field_mongoid',"id","_id");
        $this->field_list['name'] = $this->load->field('Field_title',"名称","name",true);

        $this->field_list['parentTaskId'] = $this->load->field('Field_relate_simple_id',"父工作","parentTaskId");
        $this->field_list['parentTaskId']->set_relate_db('tTask','_id','name');
        $this->field_list['parentTaskId']->add_where(WHERE_TYPE_WHERE_NE,'status',4);
        $this->field_list['parentTaskId']->is_link = false;

        $this->field_list['packed'] = $this->load->field('Field_bool',"隐藏","packed");
        // $this->field_list['inConf'] = $this->load->field('Field_bool',"需例会讨论","inConf");


        $this->field_list['desc'] = $this->load->field('Field_text',"备注","desc");
        $this->field_list['solution'] = $this->load->field('Field_text',"评价细节","solution");

        $this->field_list['priority'] = $this->load->field('Field_enum',"优先级","priority");
        $this->field_list['priority']->setEnum(array('S','A','B','C'));
        $this->field_list['typ'] = $this->load->field('Field_enum',"类型","typ");
        $this->field_list['typ']->setEnum(array('长期工作','限期工作','小杂事'));

        $this->field_list['relate_turple'] = $this->load->field('Field_cross_relate',"关联内容","relate_turple");
        $this->field_list['relate_turple']->setEnum(array(
            0=>array('tableName'=>'pVersion','valueField'=>'_id','showField'=>'name'),
            1=>array('tableName'=>'pStory','valueField'=>'_id','showField'=>'name'),
            2=>array('tableName'=>'pFeature','valueField'=>'_id','showField'=>'name'),
            3=>array('tableName'=>'pActionitem','valueField'=>'_id','showField'=>'name'),
        ));

        $this->field_list['status'] = $this->load->field('Field_enum_colorful',"状态","status");
        $this->field_list['status']->setEnum(array(0=>'未设置',1=>'未启动',2=>'准备',3=>'进行中',4=>'完工',5=>'延迟'));
        $this->field_list['status']->setColor(array(0=>'danger',1=>'danger',2=>'warning',3=>'primary',4=>'success'));
        $this->field_list['progress'] = $this->load->field('Field_progress',"进度","progress");

        $this->field_list['dueUser'] = $this->load->field('Field_userid',"负责人","dueUser",true);
        $this->field_list['createUid'] = $this->load->field('Field_userid',"派发人","createUid");
        $this->field_list['relatedUsers'] = $this->load->field('Field_array_user',"关注人员","relatedUsers");

        $this->field_list['rate'] = $this->load->field('Field_enum_colorful',"评价","rate");
        $this->field_list['rate']->setEnum(array(0=>'未设置',1=>'严重低于预期',2=>'低于预期',3=>'符合预期',4=>'超出预期'));
        $this->field_list['rate']->setColor(array(0=>'default',1=>'danger',2=>'warning',3=>'primary',4=>'success'));



        $this->field_list['beginTS'] = $this->load->field('Field_hour',"开始时间","beginTS");
        $this->field_list['dueEndTS'] = $this->load->field('Field_hour',"计划完成时间","dueEndTS");

        $this->field_list['endTS'] = $this->load->field('Field_hour',"完工时间","endTS");

        $this->field_list['createTS'] = $this->load->field('Field_ts',"创建时间","createTS");


        $this->has_changelog = true;
        $this->changelog_typ = 4;

        $this->changeShowFields = array(
                array('name'),
                array('dueUser','parentTaskId'),
                array('typ','priority'),
                array('status','progress'),
                array('relatedUsers'),
                array('beginTS','dueEndTS'),
                array('desc'),
                array('rate'),
                array('solution'),
        );

        $this->detailShowFields = array(
                array('name'),
                array('dueUser','parentTaskId'),

                array('typ','priority'),
                array('status','progress'),
                array('relatedUsers'),
                array('beginTS','dueEndTS'),
                array('endTS','null'),
                array('desc'),
                array('rate'),
                array('solution'),
        );
    }

    public function write_changelog($typ,$data,$changelog){
        $logData = array();

        if ($typ=='create'){
            $this->init_with_part_data($data);
            if ($data['parentTaskId']!=""){
                $logData['name'] = '[子工作] '.$data['name'];
            } else {
                $logData['name'] = '[工作] '.$data['name'];
            }
            $logData['typ'] = 1;
            $logData['changes'] = '[预期结束时间] =>'.$this->field_list['dueEndTS']->gen_show_html();
            $logData['relate_turple'] = array('t'=>$this->changelog_typ,'v'=>(string)$data['_id']);

            $this->do_write_create_changelog($data,$changelog,$logData);

        } elseif ($typ=='update'){
            $this->init_with_part_data($data);

            $logData['typ'] =2;
            $logData['relate_turple'] = array('t'=>$this->changelog_typ,'v'=>$this->id);
            $logData['name'] = '[工作] '.$this->field_list['name']->value;

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
                $logData['changes'] .= '[预期结束时间] =>'.$this->field_list['dueEndTS']->gen_show_html()."\n";
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
        return '工作 :'.$this->field_list['name']->gen_show_html();
    }

    public function buildChangeShowFields(){
        return $this->changeShowFields;
    }

    public function buildDetailShowFields(){
        return $this->detailShowFields;
    }

    public function do_delete_related($id){
        //用户表，清除店长

    }


    public function gen_op_send(){
        return '<a class="list_op tooltips" onclick=\'lightbox({size:"m",url:"'.
            site_url("/task/edit/sendtask/".$this->id).'"})\' title="工作委托"><span class="glyphicon glyphicon-send"></span></a>';

        // return '<a class="list_op tooltips" onclick=\'reqOperator("art","doAdd","'.$this->id.'","确认添加？")\' title="添加美术需求单"><span class="glyphicon glyphicon-tag"></span></a>';

    }
    public function gen_op_look(){
        return '<a class="list_op tooltips" onclick=\'reqOperator("task","doLook","'.$this->id.'","确认关注该工作？")\' title="关注工作"><span class="glyphicon glyphicon-eye-open"></span></a>';

    }

    public function get_list_ops($limits=''){
        $allow_ops = array();

        $allow_ops[] = 'edit';
        if ($limits!="due"){
            $allow_ops[] = 'delete';
        } else {
            $allow_ops[] = 'send';
        }
        if($this->show_method_name=="reportertask"){
            $allow_ops[] = 'look';
        }

        return $allow_ops;
    }


}
?>
