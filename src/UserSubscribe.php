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
    
    const WP_GET_USER_API = 'https://api.weixin.qq.com/cgi-bin/user/info';
    
    protected $appId;
    
    protected $appSecret;
    
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
    
    /**
     * 获得微信用户信息
     * @param string $openId
     *
     * @return bool|mixed
     */
    public function wechatUserInfo($openId)
    {
        $result = $this->getPlatformToken();
        if (!isset($result['access_token'])) {
            return false;
        }
        $user = $this->getUserInfo($result['access_token'], $openId);
        return $user;
    }
}