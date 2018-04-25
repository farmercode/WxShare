<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 2018/4/16
 * Time: 上午10:49
 */

namespace FCode\WxShare;

use FCode\WxShare\Traits\Request;

class UserAuth extends App
{
    use Request;
    
    const OAUTH2_AUTH_URL = 'https://open.weixin.qq.com/connect/oauth2/authorize';
    const OAUTH2_ACCESS_TOKEN_URL = 'https://api.weixin.qq.com/sns/oauth2/access_token';
    
    protected $redirectUrl;
    
    protected function init($config)
    {
        parent::init($config);
        $this->redirectUrl = isset($config['redirect'])?$config['redirect'] : null;
    }
    
    protected function getRedirectUrl()
    {
        if (empty($this->redirectUrl)) {
            $this->redirectUrl = urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].$_SERVER['QUERY_STRING']);
        }
        return $this->redirectUrl;
    }
    
    public function getOAuthCodeUrl($isReturn = false, $scope = 'snsapi_userinfo')
    {
        $params["appid"]         = $this->appId;
        $params["redirect_uri"]  = $this->getRedirectUrl();
        $params["response_type"] = "code";
        $params["scope"]         = $scope;
        $params["state"]         = "STATE#wechat_redirect";
        $bizString               = http_build_query($params);
        $authUrl = self::OAUTH2_AUTH_URL."?".$bizString;
        if (!$isReturn) {
            header("Location: $authUrl");
            exit();
        }
        return $authUrl;
    }
    
    /**
     * 根据Code获得用户access_token信息
     * @param string $code
     *
     * @return string
     */
    public function getAccessToekn($code = '')
    {
        $params["appid"]      = $this->appId;
        $params["secret"]     = $this->appSecret;
        $params["code"]       = !empty($code)?$code : $_GET['code'];
        $params["grant_type"] = "authorization_code";
        $result = $this->getRequest(self::OAUTH2_ACCESS_TOKEN_URL, $params);
        return $result;
    }
}