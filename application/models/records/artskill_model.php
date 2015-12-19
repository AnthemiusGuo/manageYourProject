<?php
include_once(APPPATH."models/record_model.php");
class Artskill_model extends Record_model {
    public function __construct() {
        parent::__construct('aArtskill');
        $this->title_create = '事项';
        $this->deleteCtrl = 'art';
        $this->deleteMethod = 'doDel/artskill';
        $this->edit_link = 'art/edit/artskill/';
        $this->short_info_link = $this->info_link = 'art/info/artskill/';
//人物	技能名称	技能编号	技能性质	是否群攻	施放范围	技能描述
//动作名称	动作命名	装备需求	起始动作	动作帧数	动作描述
//	特效编号	特效性质	是否循环	描述绑定点	特效描述	完成日期 制作人	特效修改意见

        $this->field_list['_id'] = $this->load->field('Field_mongoid',"id","_id");
        $this->field_list['peaple'] = $this->load->field('Field_string',"人物","peaple");
        $this->field_list['peaple']->tips = '例：男/女主角';

        $this->field_list['name'] = $this->load->field('Field_title',"技能名称","name",true);
        $this->field_list['skillId'] = $this->load->field('Field_int',"技能编号","skillId",true);
        $this->field_list['skillTyp'] = $this->load->field('Field_enum',"技能性质","skillTyp",true);
        $this->field_list['skillTyp']->setEnum(array('其他','主角攻击技能','变身魔神后的技能'));
        $this->field_list['skillTyp']->tips = '需要更多类型请联系项管开发';

        $this->field_list['skillisQun'] = $this->load->field('Field_bool',"是否群攻","skillisQun");
        $this->field_list['scope'] = $this->load->field('Field_string',"施放范围","scope",true);
        $this->field_list['scope']->tips = '例：群攻通用，扇形120度';


        $this->field_list['desc'] = $this->load->field('Field_text',"技能描述","desc",true);
        $this->field_list['desc']->tips = '例：右手挥剑，以短暂的蓄力后，从后向前猛击对方';


        $this->field_list['actionName'] = $this->load->field('Field_title',"动作名称","actionName",true);
        $this->field_list['actionName']->tips = '例：法术施放动作';

        $this->field_list['actionId'] = $this->load->field('Field_int',"动作命名","actionId",true);

        $this->field_list['itemReq'] = $this->load->field('Field_string',"装备需求","itemReq",true);
        $this->field_list['itemReq']->tips = '例：剑';

        $this->field_list['action'] = $this->load->field('Field_string',"起始动作","itemReq",true);
        $this->field_list['actionFrame'] = $this->load->field('Field_string',"动作帧数","actionFrame",true);
        $this->field_list['actionFrame']->tips = '例：不规定帧数，但动作较短 或 60帧';

        $this->field_list['actionDesc'] = $this->load->field('Field_text',"动作描述","actionDesc",true);

        $this->field_list['effectId'] = $this->load->field('Field_int',"特效编号","effectId",true);
        $this->field_list['effectTyp'] = $this->load->field('Field_enum',"特效性质","effectTyp",true);
        $this->field_list['effectTyp']->setEnum(array('其他','施放特效','受击特效'));

        $this->field_list['effectisLoop'] = $this->load->field('Field_bool',"是否循环","effectisLoop");
        $this->field_list['effectPoint'] = $this->load->field('Field_string',"描述绑定点","effectPoint");
        $this->field_list['effectPoint']->tips = '例：武器、右手';

        $this->field_list['effectDesc'] = $this->load->field('Field_text',"特效描述","effectDesc");
        $this->field_list['effectDesc']->tips = '例：剑挥舞后留下剑气残影，一定帧数后拖尾消失。';


        $this->field_list['status'] = $this->load->field('Field_enum_colorful',"状态","status");
        $this->field_list['status']->setEnum(array(0=>'未设置',1=>'未启动',2=>'准备',3=>'进行中',4=>'完工',5=>'延迟'));
        $this->field_list['status']->setColor(array(0=>'default',1=>'danger',2=>'warning',3=>'primary',4=>'success'));
        // $this->field_list['progress'] = $this->load->field('Field_progress',"进度","progress");


        $this->field_list['projectId'] = $this->load->field('Field_projectid',"所属项目","projectId");

        $this->field_list['dueUser'] = $this->load->field('Field_userid',"负责人","dueUser");
        $this->field_list['dueUser']->set_in_typ(array(5));
        $this->field_list['dueUserDesc'] = $this->load->field('Field_string',"负责人备注","dueUserDesc");

        $this->field_list['finalFile'] = $this->load->field('Field_string',"最终作品路径","finalFile");
        $this->field_list['editDesc'] = $this->load->field('Field_text',"特效修改意见","editDesc");


        $this->field_list['beginTS'] = $this->load->field('Field_ts',"需求确认日期","beginTS");
        $this->field_list['dueEndTS'] = $this->load->field('Field_ts',"预期结束日期","dueEndTS");
        $this->field_list['endTS'] = $this->load->field('Field_ts',"实际结束日期","endTS");

        $this->field_list['taskId'] = $this->load->field('Field_relate_simple_id',"关联工作","taskId");
        $this->field_list['taskId']->set_relate_db('tTask','_id','name');
        $this->field_list['taskId']->add_where(WHERE_TYPE_WHERE_NE,'status',4);
        $this->field_list['taskId']->is_link = false;


        $this->changeShowFields = array(
                array('peaple','name'),
                array('skillId','skillTyp'),
                array('skillisQun','scope'),
                array('desc'),
                array('null','null'),

                array('actionName','actionId'),
                array('itemReq','action'),
                array('actionFrame','null'),
                array('actionDesc'),
                array('null','null'),

                array('effectTyp','effectId'),
                array('effectisLoop','effectPoint'),
                array('effectDesc'),
                array('null','null'),

            );
        $this->detailShowFields = array(
                array('peaple','name'),
                array('skillId','skillTyp'),
                array('skillisQun','scope'),
                array('desc'),
                array('null','null'),

                array('actionName','actionId'),
                array('itemReq','action'),
                array('actionFrame','null'),
                array('actionDesc'),
                array('null','null'),

                array('effectTyp','effectId'),
                array('effectisLoop','effectPoint'),
                array('effectDesc'),
                array('null','null'),

            );
    }

    public function gen_list_html($templates){
        $msg = $this->load->view($templates, '', true);
    }
    public function gen_editor(){

    }

    public function buildInfoTitle(){
        return '事项Action Item :'.$this->field_list['name']->gen_show_html();
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

}
?>
