<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 2018/3/28
 * Time: 下午10:59
 */

require "../vendor/autoload.php";

$appId = "wx2be37a2e643c5daa";
$appSecret = "23a10fb3c44d6039c796df600528dcdf";
$wxShare = new \FCode\WxShare\WxShare($appId, $appSecret);
$url = "http://ab.aaa.com/";
$result = $wxShare->getSign($url);
print_r($result);