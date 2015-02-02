<?php
return array(

    "HELP_CONFIG" => array(
//        array('key'=>'新鲜事','des'=>'查看小编为您准备的新鲜事'),
//        array('key'=>'小礼物','des'=>'查看小编为您的爱宠准备的小惊喜'),
    ),

    "TULING_CONFIG" => array(
        'apiKey' => "9d727773545f0f3201347e84dd7f4c4d",
        'apiURL' => "http://www.tuling123.com/openapi/api?key=KEY&info=INFO",
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
