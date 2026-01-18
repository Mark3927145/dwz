<?php
function urlc($url, $type, $token)
{
    switch ($type) {
        case 'tcn':
            $ret = json_decode(file_get_contents("https://apis.btstu.cn/api.php?type=tcn&token=" . $token . "&url=" . $url), true);
            if ($ret['code'] == 200) {
                $data = array("code" => 0, "dwz" => $ret['msg']);
            } else {
                $data = array("code" => -1, "msg" => '生成失败');
            }
            break;
        case 'btfxw':
            $ret = json_decode(file_get_contents("https://apis.btstu.cn/api.php?type=btfxw&url=" . $url), true);
            if ($ret['code'] == 200) {
                $data = array("code" => 0, "dwz" => $ret['msg']);
            } else {
                $data = array("code" => -1, "msg" => '生成失败');
            }
            break;
        default:
            $data = array("code" => -1, "msg" => '短网址类型不存在');
            break;
    }
    return $data;
}
