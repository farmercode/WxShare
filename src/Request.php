<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 2018/4/16
 * Time: 上午11:13
 */

namespace FCode\WxShare;


use GuzzleHttp\Client;

class Request
{
    /**
     * GET请求
     * @param string $url
     * @param array $params
     *
     * @return string
     */
    protected function getRequest($url, $params = [])
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