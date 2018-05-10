<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 2018/5/10
 * Time: 下午3:39
 */

require "../vendor/autoload.php";

$config = require "../config.php";

$auth = new \FCode\WxShare\UserAuth($config);
if(isset($_GET['code'])) {
    $result = $auth->getAccessToekn($_GET['code']);
    print_r($result);//成功返回用户token和openid等信息
}else {
    $return = true; //设置为ture时返回重定向地址，false则直接返回302重定向
    $result = $auth->getOAuthCodeUrl($return);
    echo $result;
}
