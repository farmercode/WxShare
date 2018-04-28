<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 2018/4/25
 * Time: 上午9:43
 * Description: 微信用户关注用户相关
 */

namespace FCode\WxShare;
use FCode\WxShare\Traits\Request;

/**
 * Class UserSubscribe
 * @package FCode\WxShare
 *
 */
class UserSubscribe extends App
{
    use Request;
    
    const WP_API_BASE = 'https://api.weixin.qq.com';
    const WP_GET_TOKEN_API = self::WP_API_BASE.'/cgi-bin/token';
    const WP_GET_USER_API = self::WP_API_BASE.'/cgi-bin/user/info';
    
    protected $appId;
    
    protected $appSecret;
    
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
    
    /**
     * 获取用户信息
     * @param string $token 平台token
     * @param string $openId 获得用户信息openid
     *
     * @return mixed
     */
    public function getUserInfo($token, $openId)
    {
        $params = [
            'access_token' => $token,
            'openid' => $openId,
            'lang' => 'zh_CN',
        ];
        $data = $this->getRequest(self::WP_GET_USER_API, $params);
        return json_decode($data, true);
    }
}