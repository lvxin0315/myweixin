<?php
/**
 * Created by PhpStorm.
 * User: lvxin
 * Date: 2015/2/2
 * Time: 10:45
 */

namespace Mobile\Controller;


use Think\Controller;

class BaseController extends Controller{

    public function __construct(){
        parent::__construct();
        //openid过滤
//        $openid = empty($_REQUEST['openid']) ? $_SESSION['openid'] : $_REQUEST['openid'];
//        if(empty($openid)){
//
//        }else{
//            $userDao = M('ucenter_member');
//            //重新初始化session
//            if(empty($_SESSION['openid'])) $_SESSION['openid'] = $openid;
//            //查看用户信息
//            $user = $userDao->where("openid LIKE '{$openid}'")->find();
//            //判断用户状态
//            if($user['status'] == 1){//正常
//                //记录登陆情况
//                $userDao->save();
//                $_SESSION['user'] = $user;
//            }else{//禁用
//                $this->error('您的账户可能未激活');
//            }
//        }

    }

    protected function error($msg){
        $this->assign('_msg',$msg);
        $this->display('Public/error');
    }
} 