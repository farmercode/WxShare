<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 2018/5/10
 * Time: 下午3:59
 */

require "../vendor/autoload.php";

$config = require "../config.php";

$shareUrl = "http://xxxxxxxxxxxxx";
$wxShare = new \FCode\WxShare\WxShare($config);
$data = $wxShare->getSign($shareUrl);
print_r($data);