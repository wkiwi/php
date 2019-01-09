<?php

/**
 * @Author: wangzhen
 * @Date:   2019-01-08 14:29:33
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-09 09:28:53
 */

return [
    //  +---------------------------------
    //  微信相关配置
    //  +---------------------------------

    // 小程序app_id
    'app_id' => 'wxf5d7fbf999f8eda8',
    // 小程序app_secret
    'app_secret' => 'd1658005b918df11e89a5c25294c29e8',

    // 微信使用code换取用户openid及session_key的url地址
    'login_url' => "https://api.weixin.qq.com/sns/jscode2session?" .
        "appid=%s&secret=%s&js_code=%s&grant_type=authorization_code",

    // 微信获取access_token的url地址
    'access_token_url' => "https://api.weixin.qq.com/cgi-bin/token?" .
        "grant_type=client_credential&appid=%s&secret=%s",

];