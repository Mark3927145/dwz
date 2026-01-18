<?php
include('../includes/common.php');
header('Access-Control-Allow-Origin:*');
if (isset($_REQUEST['token'])) {
    $token = trim(daddslashes($_REQUEST['token']));
    $res = $DB->get_row("select * from pre_user where token=:token limit 1", [':token' => $token]);
    if (!$res) {
        exit(json_encode(['code' => 202, 'msg' => '无效token'], JSON_UNESCAPED_UNICODE));
    }
    if ($res['state'] == 0) {
        exit(json_encode(['code' => 206, 'msg' => '用户已被冻结，请联系客服处理'], JSON_UNESCAPED_UNICODE));
    }
    if ($res['check_num'] <= 0) {
        exit(json_encode(['code' => 203, 'msg' => '监控额度不足，请充值后再使用'], JSON_UNESCAPED_UNICODE));
    }
    $type = isset($_REQUEST['type']) ? trim(daddslashes($_REQUEST['type'])) : 'wxsafe';
    $domain = isset($_REQUEST['domain']) ? trim(daddslashes($_REQUEST['domain'])) : '';
    if ($domain == '') {
        exit(json_encode(['code' => 204, 'msg' => '检测域名不能为空'], JSON_UNESCAPED_UNICODE));
    }
    $ret = $type == 'wxsafe' ? checkDomain($domain, 'wxsafe') : checkDomain($domain, 'qqsafe');
    if ($ret['code'] == 201) {
        $DB->exec("update pre_user set check_num=check_num-1 where token=:token", [':token' => $token]);
        exit(json_encode(['code' => 301, 'msg' => '域名已被拦截'], JSON_UNESCAPED_UNICODE));
    } elseif ($ret['code'] == 200) {
        $DB->exec("update pre_user set check_num=check_num-1 where token=:token", [':token' => $token]);
        exit(json_encode(['code' => 300, 'msg' => '域名正常'], JSON_UNESCAPED_UNICODE));
    } else {
        exit(json_encode(['code' => 302, 'msg' => '检测失败'], JSON_UNESCAPED_UNICODE));
    }
} else {
    exit(json_encode(['code' => 201, 'msg' => '缺少token参数'], JSON_UNESCAPED_UNICODE));
}
