# WxShare
微信相关工具类库，目前包含的功能有微信登录授权，获取用户信息(亦可用来检查用户是否关注公众账号)，微信分享所需的签名。

## composer安装

    composer require fcode/wxshare
    #安装dev版本
    composer require "fcode/wxshare:dev-master"
## 配置文件
根目录下面的`config.php`是配置文件，里面目前支持3个参数。
####app_id
微信公众账号的APP ID。
####app_secret
微信公众账号密钥。
####redirect
微信用户授权登录以后重定向地址,如果此项不设置，默认会把当前页面作为重定向地址。

## 使用
请查看example目录下面的参考例子。
`wechat_login.php`是用户授权登录例子。 
`wechat_share.php`是微信分享例子。
`wechat_user_info.php`是根据openid来获取用户信息，或者判断用户是否关注公众账号。
