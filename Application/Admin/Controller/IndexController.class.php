<?php
/**
 * 微信功能控制类
 * Created by PhpStorm.
 * User: lvxin
 * Date: 2014/12/12
 * Time: 10:22
 */

namespace Admin\Controller;


use Think\Controller;
use Think\Upload;

class IndexController extends Controller{

    public function index(){
        $list = M('html')->order('id DESC')->select();
        $this->assign('_list',$list);
        $this->display();
    }
    public function add(){
        $this->assign('_typeList',C('ARTICLE_TYPE'));
        $this->display();
    }
    public function doAdd(){
        //封面处理
        $config = array(
            'mimes'         =>  array(), //允许上传的文件MiMe类型
            'maxSize'       =>  0, //上传的文件大小限制 (0-不做限制)
            'exts'          =>  array('jpg','gif','png','jpeg'), //允许上传的文件后缀
            'autoSub'       =>  true, //自动子目录保存文件
            'subName'       =>  array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
            'rootPath'      =>  './Upload/', //保存根路径
            'savePath'      =>  '', //保存路径
            'saveName'      =>  array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
            'saveExt'       =>  '', //文件保存后缀，空则使用原后缀
            'replace'       =>  false, //存在同名是否覆盖
            'hash'          =>  true, //是否生成hash编码
            'callback'      =>  false, //检测文件是否存在回调，如果存在返回文件信息数组
            'driver'        =>  '', // 文件上传驱动
            'driverConfig'  =>  array(), // 上传驱动配置
        );
        $upload = new Upload($config);
        $pic = $upload->uploadOne($_FILES['pic']);
        //数据处理
        $data['title'] = I('title');
        $data['type'] = I('type');
        $data['des'] = trim(I('des'));
        $data['html'] = $_REQUEST['html'];
        $data['create_time'] = time();
        $data['pic'] = C('WEB_SITE')."/Upload/".$pic['savepath'].$pic['savename'];
        $id = M('html')->add($data);
        if(empty($id)){
            echo 'error';
        }else{
            echo 'success';
        }
    }
    public function detail(){
        $id = I('id');
        $this->assign(M('html')->find($id));
        $this->display();
    }
    public function edit(){
        $id = I('id');
        $this->assign(M('html')->find($id));
        $this->assign('_typeList',C('ARTICLE_TYPE'));
        $this->display();
    }
    public function doEdit(){
        if(!empty($_FILES['pic'])){
            //封面处理
            $config = array(
                'mimes'         =>  array(), //允许上传的文件MiMe类型
                'maxSize'       =>  0, //上传的文件大小限制 (0-不做限制)
                'exts'          =>  array('jpg','gif','png','jpeg'), //允许上传的文件后缀
                'autoSub'       =>  true, //自动子目录保存文件
                'subName'       =>  array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
                'rootPath'      =>  './Upload/', //保存根路径
                'savePath'      =>  '', //保存路径
                'saveName'      =>  array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
                'saveExt'       =>  '', //文件保存后缀，空则使用原后缀
                'replace'       =>  false, //存在同名是否覆盖
                'hash'          =>  true, //是否生成hash编码
                'callback'      =>  false, //检测文件是否存在回调，如果存在返回文件信息数组
                'driver'        =>  '', // 文件上传驱动
                'driverConfig'  =>  array(), // 上传驱动配置
            );
            $upload = new Upload($config);
            $pic = $upload->uploadOne($_FILES['pic']);
            $data['pic'] = C('WEB_SITE')."/Upload/".$pic['savepath'].$pic['savename'];
        }
        //数据处理
        $data['title'] = I('title');
        $data['type'] = I('type');
        $data['des'] = trim(I('des'));
        $data['html'] = $_REQUEST['html'];
        $id = M('html')->where('id = ' . $_REQUEST['id'])->save($data);
        if(empty($id)){
            echo 'error';
        }else{
            //编辑更新缓存
            S('content-'.$_REQUEST['id'],null);
            echo 'success';
        }
    }
} 