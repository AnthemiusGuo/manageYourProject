<?php
/**
 * WSCLIENT.php
*
* 客户端调用示例
*
* @filename WSCLIENT.php
*/


define('API_AUTH_KEY',  'i8XsJb$fJ!87FblnW@#&*0kk');
$server_uri = 'http://test.yunqipei.com/Service/WSServer.php';
$parm = array('str'=>'111abcdefg','id'=>3);
$re = apiClient::send($server_uri,'Test.index', $parm);
var_dump($re);

$re1 = json_decode($re, true);
var_dump($re1);

//print_r(apiClient::test($server_uri));
