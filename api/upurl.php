<?php
include('../includes/common.php');
header('Access-Control-Allow-Origin:*');
header('Content-type:application/json; charset=utf-8');
if (isset($_REQUEST['token'])) {
    $token = trim(daddslashes($_REQUEST['token']));
    $ures = $DB->get_row("select * from pre_user where token=:token limit 1", [':token' => $token]);
    if (!$ures) {
        exit(json_encode(['code' => 202, 'msg' => '无效token'], JSON_UNESCAPED_UNICODE));
    } else {
        if ($ures['state'] == 0) {
            exit(json_encode(['code' => 206, 'msg' => '用户已被冻结，请联系客服处理'], JSON_UNESCAPED_UNICODE));
        } else {
            if ($conf['vip_api'] == 1 && $ures['vip'] < $date) {
                exit(json_encode(['code' => 205, 'msg' => '您的会员已过期，请充值后使用'], JSON_UNESCAPED_UNICODE));
            } else {
                $uid = $ures['id'];
                $dwz = isset($_REQUEST['dwz']) ? trim(daddslashes($_REQUEST['dwz'])) : '';
                if ($dwz == '') {
                    exit(json_encode(['code' => 201, 'msg' => '缺少dwz参数'], JSON_UNESCAPED_UNICODE));
                }
                $url = isset($_REQUEST['url']) ? trim(daddslashes($_REQUEST['url'])) : '';
                if ($dwz == '') {
                    exit(json_encode(['code' => 201, 'msg' => '缺少url参数'], JSON_UNESCAPED_UNICODE));
                }
                $url = daddslashes($_REQUEST['url']);
                $preg = "#^http(s)?://(www.)?(\w+(\.)?)+#";
                if (!preg_match($preg, $url)) {
                    exit(json_encode(['code' => 203, 'msg' => '网址格式有误'], JSON_UNESCAPED_UNICODE));
                } else {
                    $res = $DB->get_row("select url,id from pre_url where dwz=:dwz and uid=$uid and deltime is null limit 1", [':dwz' => $dwz]);
                    if (!$res) {
                        exit(json_encode(['code' => 204, 'msg' => '短网址不存在'], JSON_UNESCAPED_UNICODE));
                    }
                    $rs = $DB->exec("update pre_url set url=:url where dwz=:dwz and uid='$uid'", [':dwz' => $dwz,':url'=>$url]);
                    if ($rs) {
                        if ($url != $res['url']) {
                            $DB->exec("insert into pre_modify(uid,urlid,addtime,url1,url2,dwz) values(:uid,:id,'$date',:url,'{$res["url"]}','{$res["dwz"]}')", [':uid' => $uid, ':id' => $res['id'], ':url' => $url]);
                        }
                        exit(json_encode(['code' => 200, 'msg' => '修改成功', 'dwz' => $dwz, 'url' => $url], JSON_UNESCAPED_UNICODE));
                    } else {
                        exit(json_encode(['code' => 206, 'msg' => '修改失败'], JSON_UNESCAPED_UNICODE));
                    }
                }
            }
        }
    }
} else {
    exit(json_encode(['code' => 201, 'msg' => '缺少token参数'], JSON_UNESCAPED_UNICODE));
}
