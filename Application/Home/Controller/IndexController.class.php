<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller
{
    public function index(){
        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>-_-!</h1><p>hello <b>php</b>！</p><br/></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>', 'utf-8');
    }

    public function test(){
        $apiKey = "9d727773545f0f3201347e84dd7f4c4d";
        $apiURL = "http://www.tuling123.com/openapi/api?key=KEY&info=INFO";
        $url = str_replace("INFO", "新闻", str_replace("KEY", $apiKey, $apiURL));
        /** 方法一、用file_get_contents 以get方式获取内容 */
        $res = json_decode(file_get_contents($url), true);
//        echo $res;
        /** 方法二、使用curl库，需要查看php.ini是否已经打开了curl扩展 */
//        $ch = curl_init();
//        $timeout = 5; curl_setopt ($ch, CURLOPT_URL, $url); curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
//        $file_contents = curl_exec($ch);
//        curl_close($ch);
//        echo $file_contents;

        switch ($res['code']) {
            case 100000:
                $this->wechatObj->text($res['text'])->reply();
                break;
            case 200000:
                $this->wechatObj->text($res['text'] . ",<a href='{$res['url']}'>点击这里</a>")->reply();
                break;
            case 302000:
                $array = array();
                foreach($res['list'] as $v){
                    $data['Title'] = empty($v['article']) ? "新闻" : $v['article'];
                    $data['Description'] = empty($v['source']) ? "点击查看详情" : $v['source'];
                    $data['PicUrl'] = empty($v['icon']) ? C('WEB_SITE')."/Public/images/wu.gif" : $v['icon'];
                    $data['Url'] = $v['detailurl'];
                    $array[] = $data;
                }

                var_dump($array);
                break;
        }
    }
}