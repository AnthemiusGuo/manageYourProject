<?php
include_once(APPPATH."models/record_model.php");
class Bug_model extends Record_model {
    public function __construct() {
        parent::__construct('tBug');
        $this->uname = '';
        $this->uid = 0;

        $this->title_create = 'Bug';

        $this->deleteCtrl = 'test';
        $this->deleteMethod = 'doDel/bug/';
        $this->edit_link = 'test/editBug';
        $this->short_info_link = $this->info_link = 'test/infoBug/';


        $this->field_list['_id'] = $this->load->field('Field_mongoid',"uid","_id");
        $this->field_list['name'] = $this->load->field('Field_string',"标题","name",true);
        $this->field_list['reStep'] = $this->load->field('Field_text',"重现步骤","reStep");
        $this->field_list['desc'] = $this->load->field('Field_text',"备注","desc");
        $this->field_list['picture'] = $this->load->field('Field_array_pics',"图片","picture");
        $this->field_list['picture']->uploadUrl = "test/doUpload/bug/";

        $this->field_list['attachment'] = $this->load->field('Field_array_files',"附件","attachment");
        $this->field_list['attachment']->uploadUrl = "test/doUpload/bug/";


        $this->field_list['projectId'] = $this->load->field('Field_projectid',"所属项目","projectId");
        $this->field_list['versionId'] = $this->load->field('Field_relate_simple_id',"所属版本","versionId");
        $this->field_list['versionId']->set_relate_db('pVersion','_id','name');
        $this->field_list['versionId']->add_where(WHERE_TYPE_WHERE,'packed',0);
        $this->field_list['versionId']->url='calendar/info/version';
        $this->field_list['versionId']->relateToProject = 1;

        $this->field_list['releaseId'] = $this->load->field('Field_relate_simple_id',"所属release","releaseId");
        $this->field_list['releaseId']->set_relate_db('tRelease','_id','name');
        $this->field_list['releaseId']->add_where(WHERE_TYPE_WHERE,'projectId',$this->userInfo->field_list['projectId']->value);
        $this->field_list['releaseId']->url='test/info/release';
        $this->field_list['releaseId']->relateToProject = 1;

        $this->field_list['typ'] = $this->load->field('Field_enum',"bug类型","typ");
        $this->field_list['typ']->setEnum(array(0=>'代码错误',1=>'界面优化',2=>'任务',3=>'界面优化',4=>'文字/文档/语法',5=>'背景音乐',6=>'音效',7=>'特效',8=>'人工智能',9=>'本地化',10=>'帧率',11=>'碰撞',12=>'网络延迟',13=>'设计缺陷',14=>'配置相关',15=>'安装部署',16=>'安全相关',17=>'性能问题',18=>'标准规范',19=>'测试脚本',20=>'死机',21=>'其他'));
        $this->field_list['level'] = $this->load->field('Field_enum',"严重程度","level");
        $this->field_list['level']->setEnum(array(0=>'S',1=>'A',2=>'B',3=>'C'));
        $this->field_list['priority'] = $this->load->field('Field_enum',"优先级","priority");
        $this->field_list['priority']->setEnum(array('','100%','90%','80%','70%','60%','50%','40%','30%','20%','<=10%'));
        $this->field_list['status'] = $this->load->field('Field_enum',"bug状态","status");
        $this->field_list['status']->setEnum(array(0=>'激活',1=>'已解决',2=>'关闭',3=>'延期处理'));
        $this->field_list['createUid'] = $this->load->field('Field_userid',"创建人","createUid");
        $this->field_list['dueUser'] = $this->load->field('Field_userid',"指派给","dueUser",true);
        $this->field_list['dueUser']->add_where(WHERE_TYPE_IN,'typ',array(2,3,7));
        $this->field_list['dueUser']->isRelateToProjectId=true;

        $this->field_list['IE'] = $this->load->field('Field_enum',"浏览器","IE");
        $this->field_list['IE']->setEnum(array('','IE','chrome','firefox','opera','safari','傲游','UC','360','2345','猎豹','搜狗','世界之窗','其他'));
        $this->field_list['relatedUsers'] = $this->load->field('Field_array_user',"抄送给","relatedUsers");

        $this->field_list['createTS'] = $this->load->field('Field_ts',"发起时间","createTS");
        $this->field_list['endTS'] = $this->load->field('Field_ts',"解決时间","endTS");
        // $this->field_list['closeUser'] = $this->load->field('Field_userid',"由谁关闭","closeUser");

        $this->field_list['activateNum'] = $this->load->field('Field_float',"激活次数","activateNum");

        $this->changeShowFields =array(
                array('name','reStep'),
                array('desc'),
                array('picture','attachment'),
                array('projectId','versionId'),
                array('releaseId','typ'),
                array('level','priority'),
                array('status','dueUser'),
                array('IE','relatedUsers'),
            );

    }

    public function buildChangeShowFields(){
            return $this->changeShowFields;
    }

    public function buildDetailShowFields(){
        return array(

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

    public function gen_op_edit(){
        return '<a href="'.site_url($this->edit_link).'/'.$this->id.'" class="list_op tooltips" ><span class="glyphicon glyphicon-edit"></span></a>';

    }
    public function gen_op_delay(){
        return '<a class="list_op tooltips" onclick=\'reqOperator("test","doDelay","'.$this->id.'","延期处理？")\' title="延期"><span class="glyphicon glyphicon-hourglass"></span></a>';

    }
    public function gen_op_OK(){
        return '<a class="list_op tooltips" onclick="lightbox({size:\'m\',url:\''.site_url('test/edit/bug').'/'.$this->id.'\'})" title="编辑"><span class="glyphicon glyphicon-ok"></span></a>';

    }
    public function gen_op_activation(){
        return '<a class="list_op tooltips" onclick=\'reqOperator("test","doActivation","'.$this->id.'","再次激活？")\' title="激活"><span class="glyphicon glyphicon-transfer"></span></a>';

    }
    public function gen_op_close(){
        return '<a class="list_op tooltips" onclick=\'reqOperator("test","doClose","'.$this->id.'","关闭bug？")\' title="关闭"><span class="glyphicon glyphicon-off"></span></a>';

    }

    public function get_list_ops($limits=''){
        $allow_ops = array();

        $allow_ops[] = 'edit';
        // $allow_ops[] = 'delete';
        if($this->userInfo->id==$this->field_list['dueUser']->value&&$this->field_list['status']->value==0){
            $allow_ops[] = 'OK';
            $allow_ops[] = 'delay';
        }
        if($this->userInfo->id==$this->field_list['dueUser']->value&&$this->field_list['status']->value==3){
            $allow_ops[] = 'OK';
        }
        if($this->userInfo->id==$this->field_list['createUid']->value&&$this->field_list['status']->value==1){
            $allow_ops[] = 'activation';
            $allow_ops[] = 'close';
        }
        if($this->userInfo->field_list['typ']->value==7){
            $allow_ops[] = 'delete';
        }
        return $allow_ops;
    }
}
?>
