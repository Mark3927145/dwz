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
                if (isset($_REQUEST['url'])) {
                    $url = daddslashes($_REQUEST['url']);
                    $preg = "#^http(s)?://(www.)?(\w+(\.)?)+#";
                    if (!preg_match($preg, $url)) {
                        exit(json_encode(['code' => 203, 'msg' => '网址格式有误'], JSON_UNESCAPED_UNICODE));
                    } else {
                        $id = isset($_REQUEST['id']) ? trim(daddslashes($_REQUEST['id'])) : '';
                        $type = isset($_REQUEST['type']) ? trim(daddslashes($_REQUEST['type'])) : ($ures['dwz_type'] == '' ? $conf['dwz_type'] : $ures['dwz_type']);
                        if ($type == 'suiji') {
                            $res = $DB->get_row("select keyname from pre_api where status=1 order by rand() limit 1");
                            $type = $res['keyname'];
                        }
                        $bz = isset($_REQUEST['bz']) ? trim(daddslashes($_REQUEST['bz'])) : '';
                        $pwd = isset($_REQUEST['pwd']) ? trim(daddslashes($_REQUEST['pwd'])) : '';
                        $visit = isset($_REQUEST['visit']) ? trim(daddslashes($_REQUEST['visit'])) : '';
                        $visiturl = isset($_REQUEST['visiturl']) ? daddslashes($_REQUEST['visiturl']) : '';
                        if ($id == '') {
                            $id = getCode($conf['link_length']);
                        } else {
                            $plen = strlen($id);
                            if (!preg_match("/^[a-za-z0-9]+$/i", $id) || $plen < 2 || $plen > 8 || $id == 0) {
                                $result = array("code" => -1, "msg" => "后缀只能为字母或数字，且长度为1-8之间");
                                exit(json_encode($result));
                            } else {
                                if ($DB->get_row("select id from pre_url where id=:id limit 1", [':id' => $id])) {
                                    $result = array("code" => -1, "msg" => "该后缀已存在");
                                    exit(json_encode($result));
                                }
                            }
                        }
                        $str = createUrl($type, $id, $uid, $url, 0, $bz, $visit, $visiturl, $pwd);
                        if ($str['code'] == 0) {
                            $result = array("code" => 200, "dwz" => $str['msg'], "ae_url" => $str['msg'], "url" => $str['msg'], "short_url" => $str['msg']);
                            exit(json_encode($result, JSON_UNESCAPED_UNICODE));
                        } else {
                            exit(json_encode(['code' => 204, 'msg' => $str['msg']], JSON_UNESCAPED_UNICODE));
                        }
                    }
                } else {
                    exit(json_encode(['code' => 201, 'msg' => '缺少url参数'], JSON_UNESCAPED_UNICODE));
                }
            }
        }
    }
} else {
    exit(json_encode(['code' => 201, 'msg' => '缺少token参数'], JSON_UNESCAPED_UNICODE));
}
