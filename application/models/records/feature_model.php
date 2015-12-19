<?php
include_once(APPPATH."models/record_model.php");
class Feature_model extends Record_model {
    public function __construct() {
        parent::__construct('pFeature');
        $this->title_create = '功能';
        $this->deleteCtrl = 'calendar';
        $this->deleteMethod = 'doDel/feature/';
        $this->edit_link = 'calendar/edit/feature/';
        $this->short_info_link = $this->info_link = 'calendar/featureDetail/';
//服务简述（解决方法）	问题描述（故障详细描述）	服务建议	一级现象	二级现象	有无故障码	故障码代码
//	故障码内容	配件ID

        $this->field_list['_id'] = $this->load->field('Field_mongoid',"id","_id");

        $this->field_list['name'] = $this->load->field('Field_title',"功能","name",true);

        $this->field_list['status'] = $this->load->field('Field_enum_colorful',"状态","status");
        $this->field_list['status']->setEnum(array('思路','计划内','开发中','测试中','已结','内容补充中'));
        $this->field_list['status']->setColor(array(0=>'danger',1=>'danger',2=>'warning',3=>'success',4=>'success',5=>'warning'));

        $this->field_list['packed'] = $this->load->field('Field_bool',"隐藏","packed");
        $this->field_list['hasArt'] = $this->load->field('Field_bool',"有美术工作","hasArt");

        $this->field_list['hasUI'] = $this->load->field('Field_bool',"有UI工作","hasUI");
        $this->field_list['hasExcel'] = $this->load->field('Field_bool',"有配表","hasExcel");
        $this->field_list['hasCode'] = $this->load->field('Field_bool',"有代码开发","hasCode");

        $this->field_list['dueUser'] = $this->load->field('Field_userid',"负责人","dueUser");
        $this->field_list['dueUser']->set_in_typ(array(1,3,4));

        $this->field_list['desc'] = $this->load->field('Field_text',"描述","desc");
        $this->field_list['projectId'] = $this->load->field('Field_projectid',"所属项目","projectId");
        $this->field_list['versionId'] = $this->load->field('Field_relate_simple_id',"所属版本","versionId");
        $this->field_list['versionId']->set_relate_db('pVersion','_id','name');
        $this->field_list['versionId']->add_where(WHERE_TYPE_WHERE,'packed',0);
        $this->field_list['versionId']->relateToProject = 1;

        $this->field_list['taskId'] = $this->load->field('Field_relate_simple_id',"所属工作","taskId");
        $this->field_list['taskId']->set_relate_db('tTask','_id','name');
        $this->field_list['taskId']->add_where(WHERE_TYPE_OR_WHERE,'dueUser',$this->userInfo->id);
        $this->field_list['taskId']->add_where(WHERE_TYPE_OR_WHERE,'createUid',$this->userInfo->id);
        $this->field_list['taskId']->add_where(WHERE_TYPE_WHERE_NE,'status',4);
        // $this->field_list['taskId']->add_where(WHERE_TYPE_WHERE_NE,'status',4);

        $this->field_list['taskId']->url = 'task/info/task';
        $this->field_list['progress'] = $this->load->field('Field_progress',"进度","progress");


        $this->field_list['beginTS'] = $this->load->field('Field_date',"首版日期","beginTS");
        $this->field_list['dueEndTS'] = $this->load->field('Field_date',"预期结束日期","dueEndTS");
        $this->field_list['endTS'] = $this->load->field('Field_date',"实际结束日期","endTS");

        $this->has_changelog = true;
        $this->changelog_typ = 2;

    }

    public function gen_list_html($templates){
        $msg = $this->load->view($templates, '', true);
    }
    public function gen_editor(){

    }

    public function buildInfoTitle(){
        return $this->title_create.':'.$this->field_list['name']->gen_show_html();
    }

    public function buildChangeShowFields(){
            return array(
                array('taskId'),
                array('versionId'),

                    array('name','status'),
                    array('dueUser'),

                    array('desc'),
                    array('hasUI','hasArt'),
                    array('hasCode','hasExcel'),



                    array('beginTS','dueEndTS'),
                    array('endTS','packed'),


                );
    }

    public function buildDetailShowFields(){
        return array(
          array('taskId'),
          array('projectId','versionId'),

          array('name','status'),
          array('dueUser'),
          array('hasUI','hasArt'),
          array('hasCode','hasExcel'),
          array('desc'),
          array('beginTS','dueEndTS'),
          array('endTS','packed'),

                );
    }

    public function check_can_delete($id){
        $this->db->where(array('featureId' => $id,'status'=>array('$ne'=>0)));
        $query = $this->db->get('pActionitem');
        if ($query->num_rows() > 0)
        {
            $this->setError(-100,'事项表有已经启动的工作，不可删除');
            return false;
        }
        $this->db->where(array('featureId' => $id,'status'=>array('$ne'=>0)));
        $query = $this->db->get('pStory');
        if ($query->num_rows() > 0)
        {
            $this->setError(-100,'开发项表有已经启动的工作，不可删除');

            return false;
        }
        return true;
    }

    public function do_delete_related($id){
        $this->db->where(array('featureId'=>$id,'status'=>0))->delete_batch('pActionitem');
        $this->db->where(array('featureId'=>$id,'status'=>0))->delete_batch('pStory');
    }



    public function inc_counter(){
        $this->db->where(array('_id'=>new MongoId($this->id)))->increment($this->tableName,array('hitCounter'=>1));
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
                $logData['changes'] .= '[预期结束时间] =>'.$this->field_list['dueEndTS']->gen_show_html()."\n";
            }

            if ($keyChanged==false && ($changelog===false || $changelog=="")){
                return;
            }


            $this->do_write_update_changelog($data,$changelog,$logData);
        } else {
            $logData['typ'] =0;
            $logData['name'] = '新加功能'.$data['name'];
            $this->do_write_other_changelog($data,$changelog,$logData);
        }
    }

}
?>
