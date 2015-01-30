<?php
/**
 * Created by PhpStorm.
 * User: lvxin
 * Date: 2014/12/12
 * Time: 17:09
 */

namespace Home\Controller;


use Think\Controller;

class ContentController extends Controller{

    public function index(){
        $this->display();
    }

    public function lists(){
        $map['type'] = I('type');
        $list = M('html')->where($map)->order("id DESC")->limit(20)->select();
        $this->assign('_list',$list);
        $this->display();
    }

    public function detail(){
        $id = I('id');
        //添加点击量
        @addDianjiCount('html',$id);
        $content = S('content-'.$id);
        if(empty($content)){//缓存不存在
            $html = M('html')->find($id);
            $this->assign($html);
            S('content-'.$id,$this->fetch(),2*60*60);
            $content = S('content-'.$id);
        }
        echo $content;
    }

    public function test(){
        $id = I('id');
        $html = M('html')->find($id);
        $this->assign($html);
        $this->display('detail');
    }

    public function about(){
        $this->display();
    }
}