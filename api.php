<?php
$nod_jump = true;
include("./includes/common.php");
@header('Content-Type: text/html; charset=UTF-8');
@header('Access-Control-Allow-Origin:*');
$act = isset($_GET['act']) ? $_GET['act'] : null;
switch ($act) {
    case 'get_title':
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $_REQUEST['url']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // 302 redirect
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; Baiduspider-render/2.0; +http://www.baidu.com/search/spider.html)");
        $ret = curl_exec($ch);
        curl_close($ch);
        $ret = mb_convert_encoding($ret, 'UTF-8', 'UTF-8,GBK,GB2312,BIG5');
        preg_match('/<title>(.*)<\/title>/i', $ret, $title);
        $title = str_replace(array("\r\n", "\r", "\n", ',', ' '), '', $title[1]);
        $result = array(
            'code' => 1,
            'title' => $title
        );
        break;
    case 'siteinfo':
        $count1 = $DB->getColumn("select count(1) from pre_user");
        $count2 = $DB->getColumn("select count(1) from pre_url");
        $count3 = $DB->getColumn("select count(1) from pre_pay where status=1");
        $count4 = $DB->getColumn("select sum(money) from pre_pay where status=1");
        $count5 = $DB->getColumn("select count(1) from pre_domain");
        $result = array('sitename' => $conf['web_name'], 'kf_qq' => $conf['kf_qq'], 'pattern' => $conf['pattern'], 'group_link' => $conf['group_link'], 'dwz_type' => $conf['dwz_type'], 'app_alert' => $conf['app_alert'], 'version' => VERSION, 'build' => $conf['build'], 'user' => $count1, 'url' => $count2, 'orders' => $count3, 'price' => $count4, 'domainNum' => $count5, 'domain' => $conf['domain']);
        break;
    case 'geturl':
        $id = isset($_REQUEST['id']) ? trim(daddslashes($_REQUEST['id'])) : '';
        if ($id == '') {
            $url = 'https://www.baidu.com';
            $result = array(
                'code' => 1,
                'url' => $url
            );
        } else {
            $res = $DB->get_row("select url,uid,endtime from pre_url where id=:id and deltime is null", [':id' => $id]);
            if (!$res) {
                $url = 'https://www.baidu.com';
                $result = array(
                    'code' => 1,
                    'url' => $url
                );
            } else {
                if ($res['endtime'] != '' && $res['endtime'] < $date) {
                    $result = array(
                        'code' => -1,
                        'msg' => '网址已过期'
                    );
                } else {
                    $DB->exec("update pre_url set view=view+1,lasttime='$date' where id=:id", [':id' => $id]);
                    $uid = $res['uid'];
                    $adddate = date("Y-m-d");
                    $getip = GetIps();
                    $getos = getOs();
                    if ($DB->get_row("select id from pre_ip where urlid='$id' and ip='$getip' and adddate='$adddate' limit 1")) {
                        $ip = 0;
                    } else {
                        $DB->exec("insert into pre_ip(ip,urlid,adddate) values('$getip','$id','$adddate')");
                        $ip = 1;
                    }
                    if (strpos($getos, 'Android') !== false) {
                        $sys_az = 1;
                        $sys_pg = 0;
                        $sys_qt = 0;
                    } elseif (strpos($getos, 'IPhone') !== false) {
                        $sys_az = 0;
                        $sys_pg = 1;
                        $sys_qt = 0;
                    } else {
                        $sys_az = 0;
                        $sys_pg = 0;
                        $sys_qt = 1;
                    }
                    $num = $DB->getColumn("select count(1) from pre_stat where uid='$uid' and urlid=:id and date='$adddate'", [':id' => $id]);
                    if ($num <= 0) {
                        $DB->exec("insert into pre_stat(uid,urlid,ip,pv,sys_az,sys_pg,sys_qt,date) values('$uid',:id,'$ip','1','$sys_az','$sys_pg','$sys_qt','$adddate')", [':id' => $id]);
                    } elseif ($num == 1) {
                        $DB->exec("update pre_stat set ip=ip+$ip,pv=pv+1,sys_az=sys_az+$sys_az,sys_pg=sys_pg+$sys_pg,sys_qt=sys_qt+$sys_qt where uid='$uid' and urlid=:id and date='$adddate'", [':id' => $id]);
                    } else {
                        $DB->exec("delete from pre_stat where uid='$uid' and urlid=:id and date='$adddate' limit 1", [':id' => $id]);
                        $DB->exec("update pre_stat set ip=ip+$ip,pv=pv+1,sys_az=sys_az+$sys_az,sys_pg=sys_pg+$sys_pg,sys_qt=sys_qt+$sys_qt where uid='$uid' and urlid=:id and date='$adddate'", [':id' => $id]);
                    }
                    $froms = getIpFrom();
                    $province = $froms['province'];
                    $city = $froms['city'];
                    $isp = $froms['isp'];
                    $browser = getBrowser();
                    $network = getNetwork();
                    $DB->exec("insert into pre_visitors(uid,urlid,ip,addtime,system,browser,province,city,isp,network,adddate) values('$uid','$id','$getip','$date','$getos','$browser','$province','$city','$isp','$network','$adddate')");
                    $url = $res['url'];
                    $result = array(
                        'code' => 1,
                        'url' => $url
                    );
                }
            }
        }
        break;
}
echo json_encode($result);
