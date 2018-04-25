<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 2018/4/25
 * Time: 上午10:00
 */

namespace FCode\WxShare;


class App
{
    protected $appId;
    
    protected $appSecret;
    
    public function __construct($config)
    {
        $this->appId     = $config['app_id'];
        $this->appSecret = $config['app_secret'];
        $this->init($config);
    }
    
    protected function init($config)
    {
    
    }
}