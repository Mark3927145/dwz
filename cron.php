<?php
if (preg_match('/Baiduspider/', $_SERVER['HTTP_USER_AGENT'])) exit;
include("./includes/common.php");
if (function_exists("set_time_limit")) {
    @set_time_limit(0);
}
if (function_exists("ignore_user_abort")) {
    @ignore_user_abort(true);
}

@header('Content-Type: text/html; charset=UTF-8');

$do = isset($_GET['do']) ? trim(daddslashes($_GET['do'])) : null;
if (empty($conf['cronkey'])) exit("请先设置好监控密钥");
$key = isset($_GET['key']) ? trim(daddslashes($_GET['key'])) : null;
if ($conf['cronkey'] != $key) exit("监控密钥不正确");

if ($do == 'cleanData') {
    $today = date("Y-m-d");
    $num = $DB->exec("delete from pre_ip where adddate<'$today'");
    $DB->exec("optimize table pre_ip");
    exit('已清理' . $num . '条数据');
} elseif ($do == 'cleanVisitors') {
    $today = date("Y-m-d");
    $num = $DB->exec("delete from pre_visitors where addtime<'" . date("Y-m-d H:i:s", strtotime("-7 days")) . "'");
    $DB->exec("optimize table pre_visitors");
    exit('已清理' . $num . '条数据');
} elseif ($do == 'cleanUrl') {
    $num = $DB->exec("delete from pre_url where uid=10000 and addtime<'" . date("Y-m-d H:i:s", strtotime("-7 days")) . "'");
    $DB->exec("optimize table pre_url");
    exit('游客链接清理任务已成功执行，本次共清理' . $num . '条链接');
} elseif ($do == 'daily') {
    $num = $DB->exec("delete from pre_pay where addtime<'" . date("Y-m-d H:i:s", strtotime("-12 hours")) . "' and status=0");
    $DB->exec("OPTIMIZE TABLE `pre_pay`");
    exit('日常维护任务已成功执行，本次共清理' . $num . '条数据<br/>');
}   elseif ($do == 'vipcheck') {
    $t = date("Y-m-d H:i:s", strtotime("+3 day"));
    $t2 = date("Y-m-d H:i:s", strtotime("-3 day"));
    $rs = $DB->query("select id,mail,vip from pre_user where vip>'$date' and vip<'$t' and ntime<'$t2'");
    $i = 0;
    while ($res = $rs->fetch()) {
        $DB->exec("update pre_user set ntime='$date' where id='{$res["id"]}'");
        send_mail($res['mail'], '会员到期提醒', '您的会员将于' . $res['vip'] . '过期，请及时充值');
        $i++;
    }
    echo '执行成功，共通知' . $i . '个用户';
}
