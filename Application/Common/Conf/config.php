<?php
return array(
    'DB_TYPE' => 'mysqli',     // 数据库类型
    'DB_HOST' => '203.195.212.69', // 服务器地址
    'DB_NAME' => 'myweixin',          // 数据库名
    'DB_USER' => 'lvxin',      // 用户名
    'DB_PWD' => '19890315',          // 密码
    'DB_PORT' => '3306',        // 端口
    'DB_PREFIX' => 'mwx_',    // 数据库表前缀
    'WEB_SITE' => 'http://wei.demoto.cn',
    'ARTICLE_TYPE' => array(
        array('key'=>'xinxianshi','title'=>'新鲜事'),
        array('key'=>'shangpin','title'=>'商品'),
    ),
    //微信配置
    "WEIXIN_OPTIONS" => array(
        'token' => 'myweixin', //填写你设定的key
        'encodingaeskey' => 'KU67JrIFA9bFIrTmJJA29n2ujZIPIuBz7S6AzY8X7H7', //填写加密用的EncodingAESKey
        'appid' => 'wx2660171eb3a2eac6', //填写高级调用功能的app id
        'appsecret' => 'ba292691e3737a34ad7e5855b6568459', //填写高级调用功能的密钥
        //'partnerid' => '88888888', //财付通商户身份标识
        //partnerkey' => '', //财付通商户权限密钥Key
        //'paysignkey' => '' //商户签名密钥Key
    ),
);