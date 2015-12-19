<?
require "yunqipei/class_wsclient.php";
define('API_AUTH_KEY',  '2(a4IU8(RRRGF0dfjs4*35&6');
class Yunqipei {
    public $is_inited = false;

    public function __construct(){
        $this->server_uri = 'http://test.yunqipei.com/Service/WSServer.php';
    }

    public function init(){
        $parm = array('str'=>'111abcdefg','id'=>3);
        $re = apiClient::send($this->server_uri,'Test.index', $parm);
        var_dump($re);

        $re1 = json_decode($re, true);
        var_dump($re1);
    }

    public function search(){

    }
}
