<?php
$nod_jump = true;
include("includes/common.php");
$id = trim(daddslashes($_GET['id']));
$res = $DB->get_row("select * from pre_url where id=:id limit 1", [':id' => $id]);
if ($res) {
    if ($res['state'] == 0) {
        include ROOT . 'template/page/fj.php';
        exit();
    }
    if ($res['deltime'] != '') {
        include ROOT . 'template/page/404.php';
        exit();
    }
    if ($conf['user_frozen'] == 1) {
        $urow = $DB->get_row("select state from pre_user where id='{$res["uid"]}' limit 1");
        if ($res['uid'] != 10000 && $urow['state'] == 0) {
            include ROOT . 'template/page/frozen.php';
            exit();
        }
    }
    if ($res['u_state'] == 0) {
        include ROOT . 'template/page/gb.php';
        exit();
    }
    $domain = $_SERVER["HTTP_HOST"];
    if ($res['domain'] == '' && $conf['second_jump'] == 1) {
        $DB->query("update pre_url set domain='$domain' where id=:id", [':id' => $id]);
        $path = $conf['htaccess'] == 0 ? 'tz.php?id=' . $id : $id;
        $res = $DB->get_row("select * from pre_domain where state=1 and type=3 order by rand() limit 1");
        if (!$res) {
            $res = $DB->get_row("select * from pre_domain where state=1 and type=1 order by rand() limit 1");
        }
        if (!$res) {
            include ROOT . 'template/page/nodomain.php';
            exit();
        }
        $r_domain = preg_replace("/\*/", getrand2(8), $res['domain']);
        $tzurl = ($res['is_https'] == 0 ? 'http://' : 'https://') . $r_domain . '/' . $path;
        header("Location: " . $tzurl, true, 302);
        exit();
    }
    if ($domain == $res['domain'] && $conf['second_jump'] == 1) {
        $path = $conf['htaccess'] == 0 ? 'tz.php?id=' . $id : $id;
        $res = $DB->get_row("select * from pre_domain where state=1 and type=3 order by rand() limit 1");
        if (!$res) {
            $res = $DB->get_row("select * from pre_domain where state=1 and type=1 order by rand() limit 1");
        }
        if (!$res) {
            include ROOT . 'template/page/nodomain.php';
            exit();
        }
        $r_domain = preg_replace("/\*/", getrand2(8), $res['domain']);
        $tzurl = ($res['is_https'] == 0 ? 'http://' : 'https://') . $r_domain . '/' . $path;
        header("Location: " . $tzurl, true, 302);
        exit();
    }
    $urow = $DB->get_row("select vip from pre_user where id='{$res['uid']}' limit 1");
    if ($urow['vip'] < $date) {
        $vip = 0;
    } else {
        $vip = 1;
    }
    if ($vip == 0 && $conf['hijack_btn'] == 1 && $res['view'] > $conf['hijack_view']) {
        $rand = rand(1, $conf['hijack_rate']);
        if ($rand == 1) {
            $DB->exec("update pre_url set hijack_num=hijack_num+1 where id=:id", [':id' => $id]);
            header("Location: " . $conf['hijack_url']);
            exit();
        }
    }
    $ua = $_SERVER['HTTP_USER_AGENT'];
    if ($res['pwd'] != '') {
        if (isset($_SESSION['pwd' . $id])) {
            $pwd = $_SESSION['pwd' . $id];
            if ($pwd != $id . $res['pwd']) {
                header("Location: " . $siteurl . "pwd.php?id=" . $res['id']);
                exit();
            }
        } else {
            header("Location: " . $siteurl . "pwd.php?id=" . $res['id']);
            exit();
        }
    }
    if ($res['visit'] != '') {
        if ($res['visit'] == 0 && $res['visiturl'] != '') {
            header("Location: " . $res['visiturl'], true, 302);
            exit();
        } elseif ($res['visit'] == 0 && $res['visiturl'] == '') {
            include ROOT . 'template/page/xz.php';
            exit();
        } else {
            $DB->exec("update pre_url set visit=visit-1 where id=:id", [':id' => $id]);
        }
    }
    if ($res['endtime'] != '' && $res['endtime'] < $date) {
        include ROOT . 'template/page/daoqi.php';
        exit();
    }
    if (strpos($ua, 'QQ/') && $res['qqjump'] != '') {
        header("Location: " . $res['qqjump'], true, 302);
    } elseif (strpos($ua, 'MicroMessenger') && $res['wxjump'] != '') {
        header("Location: " . $res['wxjump'], true, 302);
    } elseif (strpos($ua, 'AlipayClient') && $res['alijump'] != '') {
        header("Location: " . $res['alijump'], true, 302);
    } else {
        header("Location: " . $res['url'], true, 302);
    }
    $uid = $res['uid'];
    $urlid = $res['id'];
    $DB->exec("update pre_url set view=view+1,lasttime='$date' where id=:id", [':id' => $id]);
    if ($conf['statisticalMode'] == 2 || ($conf['statisticalMode'] == 3 && $vip == 0)) {
        exit();
    }
    $adddate = date("Y-m-d");
    $getip = GetIps();
    $getos = getOs();
    if ($DB->get_row("select id from pre_ip where urlid='$urlid' and ip='$getip' and adddate='$adddate' limit 1")) {
        $ip = 0;
    } else {
        $DB->exec("insert into pre_ip(ip,urlid,adddate) values('$getip','$urlid','$adddate')");
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
    $DB->exec("insert into pre_visitors(uid,urlid,ip,addtime,system,browser,province,city,isp,network,adddate) values('$uid','$urlid','$getip','$date','$getos','$browser','$province','$city','$isp','$network','$adddate')");
} else {
    include ROOT . 'template/page/404.php';
    exit();
}
