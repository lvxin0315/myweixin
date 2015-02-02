<?php
/**
 * Created by PhpStorm.
 * User: lvxin
 * Date: 2015/1/29
 * Time: 10:43
 */

namespace Mobile\Controller;


class IndexController extends BaseController{

    public function index(){
        //导航
        $menuList = array(
            array(
                'name' => '一级1',
                'secondMenuList' => array(
                    array('name'=>'1-1','url'=>'www.baidu.com?id-1'),
                    array('name'=>'1-2','url'=>'www.baidu.com?id-2'),
                    array('name'=>'1-3','url'=>'www.baidu.com?id-3'),
                    array('name'=>'1-4','url'=>'www.baidu.com?id-4'),
                )
            ),
            array(
                'name' => '一级2',
                'secondMenuList' => array(
                    array('name'=>'2-1','url'=>'www.baidu.com?id-5'),
                    array('name'=>'2-2','url'=>'www.baidu.com?id-6'),
                    array('name'=>'2-3','url'=>'www.baidu.com?id-7'),
                )
            ),
            array(
                'name' => '一级2',
                'url' => 'www.baidu.com',
            ),
        );
        $this->assign('_menuList',$menuList);
        //图片列表
        $pictureList = array(
            array('picUrl'=>'http://cn.bing.com/az/hprichv/LondonTrainStation_GettyRR_139321755_ZH-CN742316019.jpg','des'=>'11111','date'=>date('Y-m-d')),
            array('picUrl'=>'http://cn.bing.com/az/hprichv/LondonTrainStation_GettyRR_139321755_ZH-CN742316019.jpg','des'=>'2222222222222222222222222222','date'=>date('Y-m-d')),
            array('picUrl'=>'http://s.cn.bing.net/az/hprichbg/rb/CardinalsBerries_ZH-CN10679090179_1366x768.jpg','des'=>'333333333333','date'=>date('Y-m-d')),
            array('picUrl'=>'http://cn.bing.com/az/hprichv/LondonTrainStation_GettyRR_139321755_ZH-CN742316019.jpg','des'=>'11111','date'=>date('Y-m-d')),
            array('picUrl'=>'http://cn.bing.com/az/hprichv/LondonTrainStation_GettyRR_139321755_ZH-CN742316019.jpg','des'=>'2222222222222222222222222222','date'=>date('Y-m-d')),
            array('picUrl'=>'http://s.cn.bing.net/az/hprichbg/rb/CardinalsBerries_ZH-CN10679090179_1366x768.jpg','des'=>'333333333333','date'=>date('Y-m-d')),
            array('picUrl'=>'http://cn.bing.com/az/hprichv/LondonTrainStation_GettyRR_139321755_ZH-CN742316019.jpg','des'=>'11111','date'=>date('Y-m-d')),
            array('picUrl'=>'http://cn.bing.com/az/hprichv/LondonTrainStation_GettyRR_139321755_ZH-CN742316019.jpg','des'=>'2222222222222222222222222222','date'=>date('Y-m-d')),
            array('picUrl'=>'http://s.cn.bing.net/az/hprichbg/rb/CardinalsBerries_ZH-CN10679090179_1366x768.jpg','des'=>'333333333333','date'=>date('Y-m-d')),
            array('picUrl'=>'http://cn.bing.com/az/hprichv/LondonTrainStation_GettyRR_139321755_ZH-CN742316019.jpg','des'=>'11111','date'=>date('Y-m-d')),
            array('picUrl'=>'http://cn.bing.com/az/hprichv/LondonTrainStation_GettyRR_139321755_ZH-CN742316019.jpg','des'=>'2222222222222222222222222222','date'=>date('Y-m-d')),
            array('picUrl'=>'http://s.cn.bing.net/az/hprichbg/rb/CardinalsBerries_ZH-CN10679090179_1366x768.jpg','des'=>'333333333333','date'=>date('Y-m-d')),
        );
        $this->assign('_pictureList',$pictureList);
        //面板
        $panelList = array(
            array('title'=>'title1','content'=>'1111111e21111<br>123'),
            array('title'=>'title2','content'=>'2222'),
            array('title'=>'title3','content'=>'333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333'),
            array('title'=>'title4','content'=>'444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444'),
        );
        $this->assign('_panelList',$panelList);

        //文章
        $article = '
  <img src=http://s.cn.bing.net/az/hprichbg/rb/QingdaoJiaozhou_ZH-CN10690497202_1366x768.jpg>
  <p class=paragraph-default-p>南极洲又称
    <a href=http://zh.wikipedia.org/w/index.php?title=%E7%AC%AC%E4%B8%83%E5%A4%A7%E9%99%86&redirect=no>第七大陆</a>，是地球上最后一个被发现、唯一没有土著人居住的大陆。</p>
  <p>南极大陆为通常所说的南大洋（太平洋、印度洋和大西洋的南部水域）所包围，它与南美洲最近的距离为965公里，距新西兰2000公里、距澳大利亚2500公里、距南非3800公里、距中国北京的距离约有12000公里。南极大陆的总面积为1390万平方公里，相当于中国和印巴次大陆面积的总和，居世界各洲第五位。</p>
  <img
  src=http://home.hebei.com.cn/xwzx/jypd1/tp3/200911/W020091105523721711433.jpg
  />
  <p>整个南极大陆被一个巨大的冰盖所覆盖，平均海拔为2350米。南极洲是由冈瓦纳大陆分离解体而成，是世界上最高的大陆。南极横断山脉将南极大陆分成东西两部分。这两部分在地理和地质上差别很大。</p>
  <img
  src=http://a1.att.hudong.com/24/53/300000928390129593530805445.jpg />
  <p>东南极洲是一块很古老的大陆，据科学家推算,已有几亿年的历史。它的中心位于难接近点，从任何海边到难接近点的距离都很远。东南极洲平均海拔高度2500米，最大高度4800
    米。在东南极洲有南极大陆最大的活火山，即位于罗斯岛上的埃里伯斯火山，海拔高度3795米，有四个喷火口</p>
';
        $this->assign('_article',$article);

        //单图
        $onePicture = array('bigPic'=>'http://amui.qiniudn.com/pure-1.jpg','smallPic'=>'http://amui.qiniudn.com/pure-1.jpg?imageView2/0/w/640','des'=>'东南极洲是一块很古老的大陆，据科学家推算,已有几亿年的历史。它的中心位于难接近点，从任何海边到难接近点的距离都很远。东南极洲平均海拔高度2500米，最大高度4800米。在东南极洲有南极大陆最大的活火山，即位于罗斯岛上的埃里伯斯火山，海拔高度3795米');
        $this->assign($onePicture);

        //图片滚播
        $sliderList = array(
            array('url'=>'http://s.cn.bing.net/az/hprichbg/rb/FennecFox_ZH-CN13720911949_1366x768.jpg'),
            array('url'=>'http://s.cn.bing.net/az/hprichbg/rb/CardinalsBerries_ZH-CN10679090179_1366x768.jpg'),
            array('url'=>'http://s.cn.bing.net/az/hprichbg/rb/QingdaoJiaozhou_ZH-CN10690497202_1366x768.jpg'),
            array('url'=>'http://s.cn.bing.net/az/hprichbg/rb/CardinalsBerries_ZH-CN10679090179_1366x768.jpg'),
        );
        $this->assign('_sliderList',$sliderList);
        $this->display();
    }

} 