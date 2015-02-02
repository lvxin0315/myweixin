<?php
/**
 * Created by PhpStorm.
 * User: lvxin
 * Date: 2015/1/29
 * Time: 20:04
 */

namespace Mobile\Controller;



class ContentController extends BaseController{

    public function index(){
        //获取轮播图
        $sliderList = get_document_list(array('category_id'=>get_category_id('slider')));
        foreach($sliderList as $key => $vo){
            $sliderList[$key]['url'] = get_cover($vo['cover_id'],'path');
        }
        $this->assign('_sliderList',$sliderList);
        //简介
        $detail = get_document_list(array('category_id'=>get_category_id('me')),$order = 'id DESC',$p = 1,$rows = 1);
        $detail[0]['pic'] = get_cover($detail[0]['cover_id'],'path');
        $this->assign('_detail',$detail[0]);
        $this->display();
    }

    public function lists(){
        $name = I('name');
        $map['status'] = 1;
        $map['category_id'] = get_category_id($name);
        $list = get_document_list($map,$order = 'id DESC',$p = 1,$rows = 10);
        $this->$name($list);
        $this->display($name);
    }

    public function detail(){
        $id = I('id');
        $doc = get_document($id);
        $this->assign('_doc',$doc);
        $this->display();
    }

    public function about(){

    }
    public function telMe(){
        $map['status'] = 1;
        $map['category_id'] = get_category_id('tel_me');
        $detail = get_document_list(array('category_id'=>get_category_id('tel_me')),$order = 'id DESC',$p = 1,$rows = 1);
        $doc = get_document($detail[0]['id']);
        $this->assign('_doc',$doc);
        $this->display('tel_me');
    }
    //整理gou格式
    private function gou($list){
        foreach($list as $key => $value){
            $list[$key]['picUrl'] = get_cover($value['cover_id'],'path');
            $list[$key]['des'] = $value['description'];
            $list[$key]['date'] = date('Y-m-d',$value['update_time']);
            $list[$key]['url'] = U('Mobile/Content/detail',array('id'=>$value['id']));
        }
        $this->assign('_list',$list);
    }
    //整理picture格式
    private function picture($list){
        foreach($list as $key => $value){
            $list[$key]['picUrl'] = get_cover($value['cover_id'],'path');
            $list[$key]['des'] = $value['description'];
            $list[$key]['date'] = date('Y-m-d',$value['update_time']);
        }
        $this->assign('_list',$list);
    }
    //整理article格式
    private function article($list){
        foreach($list as $key => $value){
            $list[$key]['picUrl'] = get_cover($value['cover_id'],'path');
            $list[$key]['des'] = $value['description'];
            $list[$key]['date'] = date('Y-m-d',$value['update_time']);
        }
        $this->assign('_list',$list);
    }
} 