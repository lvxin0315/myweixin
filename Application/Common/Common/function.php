<?php
/**
 * 自定义函数
 * User: lvxin
 * Date: 2014/12/18
 * Time: 10:45
 */

/**
 * 添加点击数
 * @param string $model 操作模板
 * @param integer $dataId 操作数据主键
 * @openid string $openid 操作者
 * @return boolean|integer
*/
function addDianjiCount($model,$dataId,$openid = null){
    if(empty($model)) return false;
    if(empty($dataId)) return false;
    $dao = M('dianji_log');
    $data['model'] = $model;
    $data['data_id'] = $dataId;
    $data['openid'] = $openid;
    $data['create_time'] = time();
    $dao->add($data);
    return $dao->where("model LIKE '{$model}' AND data_id = {$dataId}")->count();
}

/**
 * 字符串截取，支持中文和其他编码
 * @static
 * @access public
 * @param string $str 需要转换的字符串
 * @param integer $start 开始位置
 * @param string $length 截取长度
 * @param string $charset 编码格式
 * @param boolean $suffix 截断显示字符
 * @return string
 */
function goods_msubstr($str,$length,$start=0,$charset="utf-8",$suffix=true) {
    if(mb_strlen($str) < $length){
        return $str;
    }
    if(function_exists("mb_substr"))
        $slice = mb_substr($str, $start, $length, $charset);
    elseif(function_exists('iconv_substr')) {
        $slice = iconv_substr($str,$start,$length,$charset);
        if(false === $slice) {
            $slice = '';
        }
    }else{
        $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("",array_slice($match[0], $start, $length));
    }
    return $suffix ? $slice.'...' : $slice;
}