<?php
/**
 * Created by PhpStorm.
 * User: lvxin
 * Date: 2015/1/29
 * Time: 20:04
 */

namespace Mobile\Controller;


use Think\Controller;

class ContentController extends Controller{

    public function index(){
        //获取轮播图
        $sliderList = get_document(array('category_id'=>get_category_id('slider')));
        foreach($sliderList as $key => $vo){
            $sliderList[$key]['url'] = get_cover($vo['cover_id']);
        }
        $this->assign('_sliderList',$sliderList);
        $this->display();
    }

    public function lists(){
        $name = I('name');
        $map['status'] = 1;
        $map['category_id'] = get_category_id($name);
        $list = M('document')->where(' = 1')->order('id DESC')->limit(20)->select();
        foreach($list as $vo){

        }
        $this->display();
    }

    public function detail(){

    }

    public function test(){

    }

    public function about(){

    }
} 