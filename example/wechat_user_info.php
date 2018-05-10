<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 2018/5/10
 * Time: 下午3:46
 */

require "../vendor/autoload.php";

$config = require "../config.php";

$userSubscribe = new \FCode\WxShare\UserSubscribe($config);

$platformToken = $userSubscribe->getPlatformToken();//此处返回的access_token可以缓存7200秒，或者在getUserInfo失败时重新调用此函数缓存结果
if (isset($platformToken['access_token'])) {
    $user = $userSubscribe->getUserInfo($platformToken['access_token'], 'openid xxx');
}
//wechatUserInfo是对上面2个函数的封装，但是无法缓存token了
//$user = $userSubscribe->wechatUserInfo("openid xxxx");


