<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 2018/4/16
 * Time: 上午11:24
 */
$loader = require_once "../vendor/autoload.php";

$config = [
    'app_id' => 'wxf6fb1080f764707d',
    'app_secret' => '0713bf283073bf05c784dba47be48518',
    'redirect' => '',
];
$auth = new \FCode\WxShare\UserAuth($config);
$auth->getOAuthCodeUrl();