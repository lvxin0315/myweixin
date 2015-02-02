<?php
/**
 * 微信功能控制类
 * Created by PhpStorm.
 * User: lvxin
 * Date: 2014/12/12
 * Time: 10:22
 */

namespace Weixin\Controller;


use Think\Controller;

class IndexController extends Controller{

    private $wechatObj;//微信类对象

    public function __construct(){
        parent::__construct();
        //引入微信类文件
        vendor("Wechat",VENDOR_PATH . "Weixin",".class.php");
        //读取微信配置
        $option = C("WEIXIN_OPTIONS");
        //创建对象
        $this->wechatObj = new \Wechat($option);
        //保存消息
        addWeixinLog(json_encode($this->wechatObj->getRev()->getRevData()));
    }

    public function index(){
        switch(strtolower($this->wechatObj->getRev()->getRevType())){
            case 'event'://事件处理
                $this->makeEvent();
                break;
            case 'text'://文本消息
                $this->makeText();
                break;
            case 'image'://图片消息
                $this->makeImage();
                break;
            default;
                $this->replyWelcome();
        }
    }

    //文本消息处理
    private function makeText(){
        $dao = M('weixin_message_text');
        //保留消息记录
        $data = $this->wechatObj->getRev()->getRevData();
        $text['openid'] = $data['FromUserName'];
        $text['create_time'] = $data['CreateTime'];
        $text['msg_id'] = $data['MsgId'];
        $text['content'] = $data['Content'];
        $text['status'] = 1;
        $id = $dao->add($text);
        if($id === false){
            $this->replyText('服务器太忙了~请稍后再试试~');
            exit;
        }
        //内容判断
        $content = trim($text['content']);
        //特殊内容回复
        if(strstr($content,'呆萌圈')){
            $this->replyWelcome();
            exit;
        }
        //基本内容回复
        switch($content){
//            case '新鲜事':
//                $this->xinxianshi();
//                break;
            case 'help':
                $this->help();
                break;
//            case '小礼物':
//                $this->chongwuShop();
//                break;
            default:
                $this->autoReplyByTuling($content);
        }
    }
    //事件处理
    private function makeEvent(){
        //关注事件
        $event = $this->wechatObj->getRev()->getRevEvent();
        switch($event['event']){
            case 'subscribe'://订阅
                $this->replyWelcome();
                break;
        }
    }
    //图片消息处理
    private function makeImage(){
        $dao = M('weixin_message_image');
        //保留消息记录
        $data = $this->wechatObj->getRev()->getRevData();
        $image['openid'] = $data['FromUserName'];
        $image['create_time'] = $data['CreateTime'];
        $image['pic_url'] = $data['PicUrl'];
        //图片存在校验
        $res = $dao->where("pic_url LIKE '{$image['pic_url']}'")->find();
        if(!empty($res)){
            $this->replyText('感谢您的分享，小编一定会分享给全国各地的亲们~');
            exit;
        }
        $image['msg_id'] = $data['MsgId'];
        $image['media_id'] = $data['MediaId'];
        $image['status'] = 1;
        $id = $dao->add($image);
        if(empty($id)){
            $this->replyText('服务器太忙了~请稍后再试试~');
        }else{
            $this->replyText('感谢您的分享，小编一定会分享给全国各地的亲们~');
        }
    }
    //新鲜事回复
//    private function xinxianshi(){
//        $list = M('html')->where("type LIKE 'xinxianshi'")->order('create_time DESC')->limit(8)->select();
//        foreach($list as $v){
//            $data['Title'] = empty($v['title']) ? '暂无标题' : $v['title'];
//            $data['Description'] = date('Y-m-d',$v['create_time']);
//            $data['PicUrl'] = $v['pic'];
//            $data['Url'] = C('WEB_SITE').U('Mobile/Content/detail',array('id'=>$v['id']));
//            $array[] = $data;
//        }
//        $this->wechatObj->news($array)->reply();
//    }
    //消息回复，包含昵称设置判断
    private function replyText($message){
        $user = M('user')->where("openid LIKE '{$this->wechatObj->getRev()->getRevFrom()}'")->find();
        if(empty($user['nickname'])){
            $url = C('WEB_SITE').U('Mobile/User/info',array('openid'=>$this->wechatObj->getRev()->getRevFrom()));
            $message .= "\r\n"."快来完善自己<a href='{$url}'>昵称</a>，大家可是都有昵称了呢~";
        }else{
            $url = C('WEB_SITE').U('Mobile/Content/index',array('openid'=>$this->wechatObj->getRev()->getRevFrom()));
            $message .= "\r\n"."快来看看，<a href='{$url}'>点击这里</a>~";
        }
        $this->wechatObj->text($message)->reply();
    }
    //回复欢迎语及使用简要说明
    private function replyWelcome(){
        $message = "感谢您使用《呆萌圈》，
        在这里您可以将自己的爱宠分享给全国各地的‘宠爸&宠妈’们，
        同时还会收到意外的惊喜哦~
        发送《照片》即可分享
        发送“help”即可获得使用帮助";
        $this->wechatObj->text($message)->reply();
    }
    //help
    private function help(){
//        $message = "回复语及描述。\r\n";
//        $helpList = C('HELP_CONFIG');
//        foreach($helpList as $v){
//            $message.= $v['key']."---".$v['des']."\r\n";
//        }
//        $this->wechatObj->text($message)->reply();
        $user = M('user')->where("openid LIKE '{$this->wechatObj->getRev()->getRevFrom()}'")->find();
        if(empty($user['nickname'])){
            $url = C('WEB_SITE').U('Mobile/User/info',array('openid'=>$this->wechatObj->getRev()->getRevFrom()));
            $message = "快来完善自己<a href='{$url}'>昵称</a>，大家可是都有昵称了呢~";
        }else{
            $url = C('WEB_SITE').U('Mobile/Content/index',array('openid'=>$this->wechatObj->getRev()->getRevFrom()));
            $message = "快来看看，<a href='{$url}'>点击这里</a>~";
        }
        $this->wechatObj->text($message)->reply();
    }
    //宠物店相关内容
//    private function chongwuShop(){
//        $list = M('html')->where("type LIKE 'shangpin'")->order('create_time DESC')->limit(8)->select();
//        foreach($list as $v){
//            $data['Title'] = empty($v['title']) ? '暂无标题' : $v['title'];
//            $data['Description'] = date('Y-m-d',$v['create_time']);
//            $data['PicUrl'] = $v['pic'];
//            $data['Url'] = C('WEB_SITE').U('Mobile/Content/detail',array('id'=>$v['id']));
//            $array[] = $data;
//        }
//        $this->wechatObj->news($array)->reply();
//    }
    //图灵自动回复机器人
    private function autoReplyByTuling($reqInfo){
        $config = C('TULING_CONFIG');
        $url = str_replace("INFO", $reqInfo, str_replace("KEY", $config['apiKey'], $config['apiURL']));
        /** 方法一、用file_get_contents 以get方式获取内容 */
        $res =json_decode(file_get_contents($url),true);
//        echo $res;
        /** 方法二、使用curl库，需要查看php.ini是否已经打开了curl扩展 */
//        $ch = curl_init();
//        $timeout = 5; curl_setopt ($ch, CURLOPT_URL, $url); curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
//        $file_contents = curl_exec($ch);
//        curl_close($ch);
//        echo $file_contents;

        switch($res['code']){
            case 100000://文字
                $this->wechatObj->text($res['text'])->reply();
                break;
            case 200000://链接
                $this->wechatObj->text($res['text'] . ",<a href='{$res['url']}'>点击这里</a>")->reply();
                break;
            case 302000://新闻
                $array = array();
                foreach($res['list'] as $v){
                    if(!empty($v['article']) && !empty($v['source']) && !empty($v['icon']) && !empty($v['detailurl'])){
                        $data['Title'] =  $v['article'];
                        $data['Description'] = $v['source'];
                        $data['PicUrl'] = $v['icon'];
                        $data['Url'] = $v['detailurl'];
                        $array[] = $data;
                    }
                    if(count($array) >= 10) break;
                }
                if(count($array) <= 0){
                    $this->wechatObj->text("暂无消息")->reply();
                }else{
                    $this->wechatObj->news($array)->reply();
                }
                break;
            case 304000://软件下载
                $array = array();
                foreach($res['list'] as $v){
                    if(!empty($v['name']) && !empty($v['count']) && !empty($v['icon']) && !empty($v['detailurl'])){
                        $data['Title'] =  $v['name'];
                        $data['Description'] = "下载量：" . $v['count'];
                        $data['PicUrl'] = $v['icon'];
                        $data['Url'] = $v['detailurl'];
                        $array[] = $data;
                    }
                    if(count($array) >= 10) break;
                }
                if(count($array) <= 0){
                    $this->wechatObj->text("暂无消息")->reply();
                }else{
                    $this->wechatObj->news($array)->reply();
                }
                break;
            case 305000://火车
                $array = array();
                foreach($res['list'] as $v){
                    if(!empty($v['trainnum']) && !empty($v['icon']) && !empty($v['detailurl'])){
                        $data['Title'] =  $v['trainnum'];
                        $data['Description'] = "";
                        $data['PicUrl'] = $v['icon'];
                        $data['Url'] = $v['detailurl'];
                        $array[] = $data;
                    }
                    if(count($array) >= 10) break;
                }
                if(count($array) <= 0){
                    $this->wechatObj->text("暂无消息")->reply();
                }else{
                    $this->wechatObj->news($array)->reply();
                }
                break;
            case 306000://航班
                $array = array();
                foreach($res['list'] as $v){
                    if(!empty($v['flight']) && !empty($v['icon']) && !empty($v['detailurl'])){
                        $data['Title'] =  $v['flight'];
                        $data['Description'] = "";
                        $data['PicUrl'] = $v['icon'];
                        $data['Url'] = $v['detailurl'];
                        $array[] = $data;
                    }
                    if(count($array) >= 10) break;
                }
                if(count($array) <= 0){
                    $this->wechatObj->text("暂无消息")->reply();
                }else{
                    $this->wechatObj->news($array)->reply();
                }
                break;
            case 308000://电影、视频、菜谱
            case 309000://酒店
            case 311000://价格
                $array = array();
                foreach($res['list'] as $v){
                    if(!empty($v['name']) && !empty($v['icon']) && !empty($v['detailurl'])){
                        $data['Title'] =  $v['name'];
                        $data['Description'] = "";
                        $data['PicUrl'] = $v['icon'];
                        $data['Url'] = $v['detailurl'];
                        $array[] = $data;
                    }
                    if(count($array) >= 10) break;
                }
                if(count($array) <= 0){
                    $this->wechatObj->text("暂无消息")->reply();
                }else{
                    $this->wechatObj->news($array)->reply();
                }
                break;

        }
    }

} 