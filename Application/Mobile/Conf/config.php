<?php
    return array(
        'WIDGET_CONFIG' => array(
            array('title'=>'图','url'=>'http://www.baidu.com?id=1','class'=>'am-icon-area-chart'),
            array('title'=>'文章','url'=>'http://www.baidu.com?id=2','class'=>'am-icon-newspaper-o'),
            array('title'=>'推荐','url'=>'http://www.baidu.com?id=3','class'=>'am-icon-thumbs-o-up'),
            array('title'=>'小心','url'=>'http://www.baidu.com?id=4','class'=>'am-icon-bomb'),
            array('title'=>'献爱心','url'=>'http://www.baidu.com?id=5','class'=>'am-icon-heart'),
            array('title'=>'评论','url'=>'http://www.baidu.com?id=6','class'=>'am-icon-pencil'),
            array('title'=>'联系我们','url'=>'http://www.baidu.com?id=7','class'=>'am-icon-phone'),
        ),
        'MENU_CONFIG' => array(
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
        ),
    );