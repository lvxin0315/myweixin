<?php
function addWeixinLog($json){
    return M('weixin_message_log')->add(array('message_json'=>$json,'create_time'=>time()));
}