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
    
    const WP_GET_TOKEN_API = 'https://api.weixin.qq.com/cgi-bin/token';
    
    public function __construct($config)
    {
        $this->appId     = $config['app_id'];
        $this->appSecret = $config['app_secret'];
        $this->init($config);
    }
    
    protected function init($config)
    {
    
    }
    
    /**
     * 获取平台token
     * @return mixed
     */
    public function getPlatformToken()
    {
        $params = [
            'grant_type' => 'client_credential',
            'appid' => $this->appId,
            'secret' => $this->appSecret
        ];
        $data = $this->getRequest(self::WP_GET_TOKEN_API, $params);
        return json_decode($data, true);
    }
}