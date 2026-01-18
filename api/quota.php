<?php
include('../includes/common.php');
header('Access-Control-Allow-Origin:*');
if (isset($_REQUEST['token'])) {
    $token = trim(daddslashes($_REQUEST['token']));
    $ures = $DB->get_row("select * from pre_user where token=:token limit 1", [':token' => $token]);
    if (!$ures) {
        exit(json_encode(['code' => 202, 'msg' => '无效token'], JSON_UNESCAPED_UNICODE));
    }
    if ($ures['state'] == 0) {
        exit(json_encode(['code' => 206, 'msg' => '用户已被冻结，请联系客服处理'], JSON_UNESCAPED_UNICODE));
    }
    $result = array("code" => 200, "num" => $ures['create_num']);
    exit(json_encode($result, JSON_UNESCAPED_UNICODE));
} else {
    exit(json_encode(['code' => 201, 'msg' => '缺少token参数'], JSON_UNESCAPED_UNICODE));
}
