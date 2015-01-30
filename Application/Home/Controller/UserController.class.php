<?php
/**
 * Created by PhpStorm.
 * User: lvxin
 * Date: 2014/12/15
 * Time: 10:27
 */

namespace Home\Controller;


use Think\Controller;

class UserController extends Controller{

    public function info(){
        $openid = I('openid');
        $user = M('user')->where("openid LIKE '{$openid}'")->find();
        $user['openid'] = $openid;
        $this->assign('_user',$user);
        $this->display();
    }

    public function save(){
        $data['nickname'] = trim(I('nickname'));
        $data['sex'] = I('sex');
        $data['openid'] = I('openid');
        if(empty($data['openid'])){
            echo 0;
            exit;
        }
        $dao = M('user');
        $user = $dao->where("openid LIKE '{$data['openid']}'")->find();
        if(empty($user)){//新增用户
            $res = $dao->add($data);
        }else{//编辑用户信息
            $res = $dao->where($user)->save($data);
        }
        echo empty($res) ? 0 : 1;
    }
} 