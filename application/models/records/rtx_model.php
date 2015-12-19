<?php
include_once(APPPATH."models/record_model.php");
class Rtx_model extends Record_model {
    public function __construct() {
        parent::__construct('aNeeds');
        $this->uname = '';
        $this->uid = 0;
        $this->title_create = 'RTX通知';

        $this->field_list['_id'] = $this->load->field('Field_mongoid',"uid","_id");
        $this->field_list['name'] = $this->load->field('Field_string',"接收人","name",true);
        $this->field_list['name']->tips = '全发填all，请慎重使用！多个人用 英文逗号 , 分割';
        $this->field_list['title'] = $this->load->field('Field_string',"标题","title",true);
        $this->field_list['msg'] = $this->load->field('Field_text',"内容","msg",true);
        $this->field_list['msg']->tips = '实测2行效果比较好';

        $this->field_list['url'] = $this->load->field('Field_string',"url","url");
        $this->field_list['delay'] = $this->load->field('Field_int',"持续时长","delay");
        $this->field_list['delay']->tips = '0表示不会自动关闭';


    }

    public function buildChangeShowFields(){
            return array(
                    array('name','title'),
                    array('msg'),
                    array('delay','url'),
                );
    }

    public function buildDetailShowFields(){
        return array(
            array('name','title'),
            array('msg'),
            array('delay'),
                );
    }

}
?>
