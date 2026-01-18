<?php
include("includes/common.php");
$act = isset($_GET['act']) ? daddslashes($_GET['act']) : null;
header('Content-Type: application/json; charset=UTF-8');
switch ($act) {
    case 'creat1':
        if ($_REQUEST['url'] == "") {
            exit('{"code":-1,"msg":"请填写需要缩短的网址"}');
        }
        $url = daddslashes($_REQUEST['url']);
        $preg = "#^http(s)?://(www.)?(\w+(\.)?)+#";
        if (!preg_match($preg, $url)) {
            exit('{"code":-1,"msg":"请填写正确的网址"}');
        }
        if ($islogin2 != 1) {
            if ($conf['forcelogin'] == 1) {
                exit('{"code":-1,"msg":"请登录后再生成网址"}');
            }
            $ip = real_ip();
            $today = date('Y-m-d') . ' 00:00:00';
            if ($conf['limit_url'] != '') {
                if ($DB->getColumn("select count(*) from pre_url where ip='$ip' and addtime>'$today'") >= $conf['limit_url']) {
                    exit('{"code":-1,"msg":"已超过每日生成限制，请登录后再生成"}');
                }
            }
            $res = $DB->get_row("select * from pre_url where ip='$ip' and url=:url and uid='10000'", [':url' => $url]);
            if ($res) {
                if ($conf['is_https'] == 1) {
                    $data = 'https://' . $conf['domain'] . '/data.php?id=' . $res['id'];
                } else {
                    $data = 'http://' . $conf['domain'] . '/data.php?id=' . $res['id'];
                }
                $result = array("code" => 0, "dwz" => $res['dwz'], "data" => $data, "url" => $url);
                exit(json_encode($result));
            }
            $uid = 10000;
        }
        $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : $conf['dwz_type'];
        $id = getCode($conf['link_length']);
        if ($conf['is_https'] == 1) {
            $data = 'https://' . $conf['domain'] . '/data.php?id=' . $id;
        } else {
            $data = 'http://' . $conf['domain'] . '/data.php?id=' . $id;
        }
        $str = createUrl($type, $id, $uid, $url);
        if ($str['code'] == 0) {
            $result = array("code" => 0, "dwz" => $str['msg'], "data" => $data, "url" => $url);
            exit(json_encode($result));
        } else {
            exit('{"code":-1,"msg":"' . $str['msg'] . '"}');
        }
        break;
    case 'creat2':
        if ($_REQUEST['url'] == "") {
            exit('{"code":-1,"msg":"请填写需要还原的网址"}');
        }
        $url = trim(daddslashes($_REQUEST['url']));
        $preg = "#^http(s)?://(www.)?(\w+(\.)?)+#";
        if (!preg_match($preg, $url)) {
            exit('{"code":-1,"msg":"请填写正确的网址"}');
        }
        if ($DB->getColumn("select count(*) from pre_url where dwz=:url", [':url' => $url]) > 0) {
            $res = $DB->get_row("select * from pre_url where dwz=:url limit 1", [':url' => $url]);
            $tzurl = $res['url'];
            $result = array("code" => 0, "url" => $url, "tzurl" => $tzurl);
            exit(json_encode($result));
        } else {
            $headers = get_headers($url, TRUE);
            if (gettype($headers['Location']) == 'string') {
                $tzurl = $headers['Location'];
            } else {
                $tzurl = $headers['Location'][0];
            }
            if ($tzurl == '') {
                $tzurl = '还原失败';
            }
            $result = array("code" => 0, "url" => $url, "tzurl" => $tzurl);
            exit(json_encode($result));
        }
    case 'tongji':
        $id = trim(daddslashes($_GET['id']));
        $res = $DB->get_row("select sum(ip) ip,sum(pv) pv from pre_stat where urlid=:id", [':id' => $id]);
        $allIp = $res['ip'] == '' ? 0 : $res['ip'];
        $allPv = $res['pv'] == '' ? 0 : $res['pv'];
        $t = date('Y-m-d 00:00:00');
        $res = $DB->get_row("select ip from pre_stat where urlid=:id and date='$t' limit 1", [':id' => $id]);
        if (!$res) {
            $tIp = 0;
        } else {
            $tIp = $res['ip'];
        }
        $res = $DB->get_row("select pv from pre_stat where urlid=:id and date='$t' limit 1", [':id' => $id]);
        if (!$res) {
            $tPv = 0;
        } else {
            $tPv = $res['pv'];
        }
        $total = array($tIp, $tPv, $allIp, $allPv);
        $a = getday();
        for ($i = 0; $i < 7; $i++) {
            $res = $DB->get_row("select ip,pv from pre_stat where urlid=:id and date='$a[$i]' limit 1", [':id' => $id]);
            $ip = $res['ip'] == '' ? 0 : $res['ip'];
            $pv = $res['pv'] == '' ? 0 : $res['pv'];
            $data[] = array($a[$i], $ip, $pv);
        }
        $res  = $DB->get_row("select sum(sys_az) sys_an,sum(sys_pg) sys_pg,sum(sys_qt) sys_qt from pre_stat where urlid=:id", [':id' => $id]);
        $allAz = $res['sys_az'] == '' ? 0 : $res['sys_az'];
        $allPg = $res['sys_pg'] == '' ? 0 : $res['sys_pg'];
        $allQt = $res['sys_qt'] == '' ? 0 : $res['sys_qt'];
        $allSys = $allAz + $allPg + $allQt;
        if ($allSys == 0) {
            $system = array(34, 33, 33);
        } else {
            $system = array(ceil($allQt / $allSys * 100), ceil($allAz / $allSys * 100), ceil($allPg / $allSys * 100));
        }
        $result = array("total" => $total, "week" => $data, "system" => $system);
        exit(json_encode($result));
        break;
    case 'tongji2':
        $id = trim(daddslashes($_GET['id']));
        $data = array();
        $data2 = array();
        $data3 = array();
        $data4 = array();
        $data5 = array();
        $rs = $DB->query("select province,ip,browser,network,isp from pre_visitors where urlid=:id", [':id' => $id]);
        while ($res = $rs->fetch()) {
            array_push($data, $res['province']);
            array_push($data2, $res['ip']);
            array_push($data3, $res['browser']);
            array_push($data4, $res['network']);
            array_push($data5, $res['isp']);
        }
        $data = array_count_values($data);
        $data2 = array_count_values($data2);
        arsort($data2);
        $data2 = array_slice($data2, 0, 10);
        $data3 = array_count_values($data3);
        $data4 = array_count_values($data4);
        $data5 = array_count_values($data5);
        $result = array("code" => 0, "china" => $data, "ip" => $data2, "browser" => $data3, "network" => $data4, "isp" => $data5);
        exit(json_encode($result));
        break;
}
