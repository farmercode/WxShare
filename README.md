# WxShare
微信分享服务端生成分享所需的签名

## composer安装

    composer require fcode/wxshare
    #安装dev版本
    composer require "fcode/wxshare:dev-master"
## 使用

    require "vendor/autoload.php";
    $appId = "xxxxxxx";
    $appSecret = "xxxxxxx";
    $wxShare = new \FCode\WxShare($appId, $appSecret);
    $url = "http://ab.aaa.com/";
    $result = $wxShare->getSign($url);
    print_r($result);