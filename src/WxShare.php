<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 2018/3/28
 * Time: 下午10:35
 */

namespace FCode;

use GuzzleHttp\Client;

/**
 * Class WxShare
 * 生成微信分享所需的签名信息
 * @author Wangchangchun
 * @package FCode
 */
class WxShare
{
    const API_GET_TOKEN = 'https://api.weixin.qq.com/cgi-bin/token';
    const API_GET_TICKET = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket';
    
    private $appId = '';
    
    private $secret = '';
    
    public function __construct($appId, $secret)
    {
        $this->appId = $appId;
        $this->secret = $secret;
    }
    
    /**
     * 获得微信分享签名数据
     * @param string $url
     *
     * @return array|mixed
     */
    public function getSign($url)
    {
        $data = $this->getToken();
        if (isset($data['errcode']) && $data['errcode'] > 0) {
            return $data;
        }
        $token = $data['access_token'];
        $data = $this->getTicket($token);
        if (!isset($data['ticket'])) {
            return $data;
        }
        $ticket = $data['ticket'];
        $randomSlot = $this->genarateRandomString();
        
        $input = [
            'jsapi_ticket' => $ticket,
            'noncestr' => $randomSlot,
            'timestamp' => time(),
            'url' => $url
        ];
        ksort($input);
        $newString = '';
        foreach ($input as $k => $v) {
            $newString .= $k.'='.$v.'&';
        }
        $sign = sha1(substr($newString,0,-1));
        return ['sign' => $sign,
                'timestamp' => $input['timestamp'],
                'noncestr' => $input['noncestr'],
                'appId' => $this->appId
        ];
    }
    
    /**
     * 获取微信接口所需token
     * @return mixed
     */
    public function getToken()
    {
        $params = [
            'grant_type' => 'client_credential',
            'appid' => $this->appId,
            'secret' => $this->secret
        ];
        $result = $this->getRequest(self::API_GET_TOKEN, $params);
        $data = json_decode($result, true);
        return $data;
    }
    
    /**
     * 获取ticket信息
     * @param string $token
     *
     * @return mixed
     */
    public function getTicket($token)
    {
        $params = [
            'access_token' => $token,
            'type'=> 'jsapi'
        ];
        $result = $this->getRequest(self::API_GET_TICKET, $params);
        $data = json_decode($result, true);
        return $data;
    }
    
    /**
     * 生成随机字符串
     * @return bool|string
     */
    private function genarateRandomString()
    {
        $str = md5(uniqid(date("YmdHIs")));
        return substr($str,8,16);
    }
    
    /**
     * GET请求
     * @param string $url
     * @param array $params
     *
     * @return string
     */
    private function getRequest($url, $params = [])
    {
        $client = new Client(['timeout' => 5.0]);
        $options = [];
        if (!empty($params)) {
            $options['query'] = $params;
        }
        $response = $client->request('GET', $url, $options);
        $data = $response->getBody()->getContents();
        return $data;
    }
}