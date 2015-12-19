<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu {
	public function __construct() {
		$this->all_menus = array();
	}

	private function _load_default_menus(){
		$this->all_menus["index"]=array(
                "menu_array"=>array(
                    "index"=>array(
                        "method"=>"href",
                        "href"=>site_url('index/index'),
                        "name"=>"我的信息",
                        "onclick"=>''
                    ),

                ),
                "default_menu"=>"index",
                "name"=>'个人面板',
                "icon"=>'glyphicon-dashboard',
            );
			$this->all_menus["managerweek"]=array(
	                "menu_array"=>array(
						"managerweek"=>array(
	                        "method"=>"href",
	                        "href"=>site_url('task/managerweek'),
	                        "name"=>"周会",
	                        "onclick"=>''
	                    ),
	                ),
	                "default_menu"=>"index",
	                "name"=>'周报管理',
	                "icon"=>'glyphicon-dashboard',
	            );
			$this->all_menus["task"]=array(
	                "menu_array"=>array(
						"pushtask"=>array(
							"method"=>"href",
							"href"=>site_url('task/pushtask'),
							"name"=>"我发布的任务",
							"onclick"=>''
						),"duetask"=>array(
	                        "method"=>"href",
	                        "href"=>site_url('task/duetask'),
	                        "name"=>"我的任务",
	                        "onclick"=>''
	                    ),"reportertask"=>array(
	                        "method"=>"href",
	                        "href"=>site_url('task/reportertask'),
	                        "name"=>"下属任务",
	                        "onclick"=>''
	                    )
	                ),
	                "default_menu"=>"duetask",
	                "name"=>'任务系统',
	                "icon"=>'glyphicon-dashboard',
	            );

        $this->all_menus["art"] = array(
            "menu_array"=>array(
                "index"=>array(
                    "method"=>"href",
                    "href"=>site_url('art/index'),
                    "name"=>"美术需求",
                    "onclick"=>''
                ),
            ),
            "default_menu"=>"index",
            "name"=>'美术管理',
            "icon"=>'glyphicon-user',
        );
		$this->all_menus["calendar"] = array(
			"menu_array"=>array(

				"index"=>array(
					"method"=>"href",
					"href"=>site_url('calendar/index'),
					"name"=>"开发日历",
					"onclick"=>''
				),
				"calendarPeaple"=>array(
					"method"=>"href",
					"href"=>site_url('calendar/calendarPeaple'),
					"name"=>"人员分配日历",
					"onclick"=>''
				),
				"version"=>array(
					"method"=>"href",
					"href"=>site_url('calendar/version'),
					"name"=>"版本信息",
					"onclick"=>''
				),
				"feature"=>array(
					"method"=>"href",
					"href"=>site_url('calendar/feature'),
					"name"=>"版本信息",
					"onclick"=>''
				),
				"story"=>array(
					"method"=>"href",
					"href"=>site_url('calendar/story'),
					"name"=>"程序开发内容",
					"onclick"=>''
				),
				"week"=>array(
					"method"=>"href",
					"href"=>site_url('calendar/week'),
					"name"=>"本周进展",
					"onclick"=>''
				),

			),
			"default_menu"=>"index",
			"name"=>'项目管理',
			"icon"=>'glyphicon-phone-alt',
		);
		$this->all_menus["quiz"] = array(
            "menu_array"=>array(

                "position"=>array(
                    "method"=>"href",
                    "href"=>site_url('quiz/position'),
                    "name"=>"岗位计划",
                    "onclick"=>''
                ),
                "resume"=>array(
                    "method"=>"href",
                    "href"=>site_url('quiz/resume'),
                    "name"=>"面试预约",
                    "onclick"=>''
                ),

            ),
            "default_menu"=>"index",
            "name"=>'招聘管理',
            "icon"=>'glyphicon-th',
        );


        $this->all_menus["admin"]=array(
                "menu_array"=>array(
                    "index"=>array(
                        "method"=>"href",
                        "href"=>site_url('admin/index'),
                        "name"=>"人员管理",
                        "onclick"=>''
                    ),
					"department"=>array(
						"method"=>"href",
						"href"=>site_url('admin/department'),
						"name"=>"部门",
						"onclick"=>''
					),
					"departMembers"=>array(
						"method"=>"href",
						"href"=>site_url('admin/departMembers'),
						"name"=>"部门成员",
						"onclick"=>''
					),
					"project"=>array(
						"method"=>"href",
						"href"=>site_url('project/index'),
						"name"=>"项目列表",
						"onclick"=>''
					),
                ),
                "default_menu"=>"index",
                "name"=>'部门人员管理',
                "icon"=>'glyphicon-home',
            );
	}

	function load_menu($roleId){
		//$this->field_list['typ']->setEnum(array(0=>"普通员工",1=>"技师",2=>"客服",3=>'前台行政',
		// 10=>'店长',99=>'总店经理',999=>'系统管理员'));
		$this->_load_default_menus();

		return $this->all_menus;
	}

}
