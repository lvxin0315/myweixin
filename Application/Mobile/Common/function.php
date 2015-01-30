<?php
if(!defined('AMAZE_TPL_PATH')){
    define('AMAZE_TPL_PATH',APP_PATH . '/Mobile/Tpl/');
}

const NAV = 'nav.tpl';
const NAV_LI_FIRST = 'nav-li-first.tpl';
const NAV_LI_SECOND = 'nav-li-second.tpl';
const NAV_LI_SECOND_LI = 'nav-li-second-li.tpl';
const HEAD = 'head.tpl';
const PICTURE = 'picture.tpl';
const PICTURE_LI = 'picture-li.tpl';
const PANEL = 'panel.tpl';
const PANEL_DL = 'panel-dl.tpl';
const ARTICLE = 'article.tpl';
const ONE_PICTURE = 'one-picture.tpl';
const WIDGET = 'widget.tpl';
const WIDGET_LI = 'widget-li.tpl';
const SLIDER = 'slider.tpl';
const SLIDER_LI = 'slider-li.tpl';
const DETAIL = 'detail.tpl';

/**
 * 导航处理
 * @param Array $menuList 导航菜单集合
 *      格式：array(
 *              array(
 *                 'name'=>'一级名称1',
 *                  'url'=>'url',
 *                  'secondMenuList' => array(
 *                     array('name'=>'二级名称1','url'=>'url'),
 *                      ……
 *                     array('name'=>'二级名称n','url'=>'url')
 *                   )
 *               )
 *              ……
 *              array(
 *                 'name'=>'一级名称n',
 *                  'url'=>'url',
 *                  'secondMenuList' => array(
 *                     array('name'=>'二级名称1','url'=>'url'),
 *                      ……
 *                     array('name'=>'二级名称n','url'=>'url')
 *                   )
 *               )
 *            )
 * @return String
*/
function tpl_nav($menuList){
    $html = file_get_contents(AMAZE_TPL_PATH . NAV);
    $firstMenuHtml = file_get_contents(AMAZE_TPL_PATH . NAV_LI_FIRST);
    $secondMenuHtml = file_get_contents(AMAZE_TPL_PATH . NAV_LI_SECOND);
    $secondLiHtml = file_get_contents(AMAZE_TPL_PATH . NAV_LI_SECOND_LI);
    //li
    $li = '';
    foreach($menuList as $fvo){
        if(empty($fvo['url'])){//二级菜单
            $second_li_html = $secondMenuHtml;
            $second_li_html = str_replace('{name}',$fvo['name'],$second_li_html);
            //填充二级菜单
            $secondLi = '';
            foreach($fvo['secondMenuList'] as $svo){
                $second_menu_li_html = $secondLiHtml;
                $second_menu_li_html = str_replace('{name}',$svo['name'],$second_menu_li_html);
                $second_menu_li_html = str_replace('{url}',$svo['url'],$second_menu_li_html);
                $secondLi .= $second_menu_li_html;
            }
            $li .= str_replace('{secondLi}',$secondLi,$second_li_html);
        }else{//仅一级菜单
            $first_li_html = $firstMenuHtml;
            $first_li_html = str_replace('{name}',$fvo['name'],$first_li_html);
            $li .= str_replace('{url}',$fvo['url'],$first_li_html);
        }
    }
    $html = str_replace('{liHtml}',$li,$html);
    return str_replace(array("\r\n","\r","\n"),"",$html);
}

/**
 * 页头
 * @param String $title 站点title
 * @param String $url 首页地址
 * @return String
*/
function tpl_head($title,$url = '#'){
    $html = file_get_contents(AMAZE_TPL_PATH . HEAD);
    $html = str_replace('{title}',$title,$html);
    $html = str_replace('{url}',$url,$html);
    return str_replace(array("\r\n","\r","\n"),"",$html);
}

/**
 * 图片列表
 * @param Array $pictureList 图片集合
 *      格式：array(
 *              array('picUrl'=>'picUrl','des'=>'des','data'=>'2014-02-05'),
 *               ……
 *              array('picUrl'=>'picUrl','des'=>'des','data'=>'2014-02-08'),
 *          )
 * @return String
*/
function picture($pictureList){
    $pictureHtml = file_get_contents(AMAZE_TPL_PATH . PICTURE);
    $pictureLiHtml = file_get_contents(AMAZE_TPL_PATH . PICTURE_LI);
    $picture_li = '';
    foreach($pictureList as $vo){
        $picture_li_html = $pictureLiHtml;
        $picture_li_html = str_replace('{picUrl}',$vo['picUrl'],$picture_li_html);
        $picture_li_html = str_replace('{des}',$vo['des'],$picture_li_html);
        $picture_li .= str_replace('{date}',$vo['date'],$picture_li_html);
    }
    $html = str_replace('{pictureLi}',$picture_li,$pictureHtml);
    return str_replace(array("\r\n","\r","\n"),"",$html);
}
/**
 * 面板
 * @param Array $contentList 内容集合
 *      格式：array(
                array('title'=>'title','content'=>'content'),
 *              ……
 *          )
 * @return String
*/
function panel($contentList){
    $panelHtml = file_get_contents(AMAZE_TPL_PATH . PANEL);
    $panelDlHtml = file_get_contents(AMAZE_TPL_PATH . PANEL_DL);
    $dl = '';
    foreach($contentList as $vo){
        $panel_dl_html = $panelDlHtml;
        $panel_dl_html = str_replace('{title}',$vo['title'],$panel_dl_html);
        $dl .= str_replace('{content}',$vo['content'],$panel_dl_html);
    }
    $html = str_replace('{dlList}',$dl,$panelHtml);
    return str_replace(array("\r\n","\r","\n"),"",$html);
}

/**
 * 文章
 * @param String $article 文章
 * @return String
*/
function article($article){
    $articleHtml = file_get_contents(AMAZE_TPL_PATH . ARTICLE);
    $html = str_replace('{article}',$article,$articleHtml);
    return str_replace(array("\r\n","\r","\n"),"",$html);
}

/**
 * 单图
 * @param String $bigPic 大图
 * @param String $smallPic 缩略图
 * @param String $des 描述
 * @return String
*/
function onePicture($bigPic,$smallPic,$des){
    $onePictureHtml = file_get_contents(AMAZE_TPL_PATH . ONE_PICTURE);
    $onePictureHtml = str_replace('{bigPic}',$bigPic,$onePictureHtml);
    $onePictureHtml = str_replace('{smallPic}',$smallPic,$onePictureHtml);
    $html = str_replace('{des}',$des,$onePictureHtml);
    return str_replace(array("\r\n","\r","\n"),"",$html);
}

/**
 * 工具栏
 * @return String
*/
function widget(){
    $widgetHtml = file_get_contents(AMAZE_TPL_PATH . WIDGET);
    $widgetLiHtml = file_get_contents(AMAZE_TPL_PATH . WIDGET_LI);
    $config = C('WIDGET_CONFIG');
    $li = '';
    foreach($config as $vo){
        $widget_li_html = $widgetLiHtml;
        foreach($vo as $k=>$v){
            $widget_li_html = str_replace('{' . $k . '}',$v,$widget_li_html);
        }
        $li .= $widget_li_html;
    }
    $html = str_replace('{liHtml}',$li,$widgetHtml);
    return str_replace(array("\r\n","\r","\n"),"",$html);
}

/**
 * 图片滚播
 * @param Array $picList 图片列表
 *      格式：array(
 *          array('url'=>'url'),
 *          ……
 *      )
 * @return String
*/
function slider($picList){
    $sliderHtml = file_get_contents(AMAZE_TPL_PATH . SLIDER);
    $slideLirHtml = file_get_contents(AMAZE_TPL_PATH . SLIDER_LI);
    $li = '';
    foreach($picList as $vo){
        $slider_li_html = $slideLirHtml;
        $li .= str_replace('{url}',$vo['url'],$slider_li_html);
    }
    $html = str_replace('{liHtml}',$li,$sliderHtml);
    return str_replace(array("\r\n","\r","\n"),"",$html);
}
/**
 * 介绍
 * @param String $title 标题
 * @param String $pic 封面路径
 * @param String $url 跳转地址
 * @param String $content 内容
 * @return String
*/
function detail($title,$pic,$url,$content){
    $detailHtml = file_get_contents(AMAZE_TPL_PATH . DETAIL);
    $detailHtml = str_replace('{title}',$title,$detailHtml);
    $detailHtml = str_replace('{pic}',$pic,$detailHtml);
    $detailHtml = str_replace('{url}',$url,$detailHtml);
    $html = str_replace('{content}',$content,$detailHtml);
    return str_replace(array("\r\n","\r","\n"),"",$html);
}


////////////////////////////////////////////////////////////
/**
 * 根据分类名获取分类ID
 * @param String $name
 * @return Integer
*/
function get_category_id($name){
    $category = M('category')->where("name LIKE '{$name}'")->find();
    return $category['id'];
}

/**
 * 根据参数获取document数据
 * @param Array $where 条件
 * @param String $order 排序
 * @param Integer $p 当前页
 * @param Integer $rows 页数
*/
function get_document($where = array(),$order = 'id DESC',$p = 1,$rows = 20){
    return M('document')->where($where)->order($order)->limit($p,$rows)->select();
}