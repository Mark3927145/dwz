<?php

use libs\PHPMailer\PHPMailer;
use libs\PHPMailer\Exception;

function curl_get($_arg_0)
{
    $_var_1 = curl_init($_arg_0);
    $_var_2[] = "Accept: */*";
    $_var_2[] = "Accept-Encoding: gzip,deflate,sdch";
    $_var_2[] = "Accept-Language: zh-CN,zh;q=0.8";
    $_var_2[] = "Connection: close";
    curl_setopt($_var_1, CURLOPT_HTTPHEADER, $_var_2);
    curl_setopt($_var_1, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($_var_1, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($_var_1, CURLOPT_ENCODING, "gzip");
    curl_setopt($_var_1, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($_var_1, CURLOPT_USERAGENT, "Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1");
    curl_setopt($_var_1, CURLOPT_TIMEOUT, 30);
    $_var_3 = curl_exec($_var_1);
    curl_close($_var_1);
    return $_var_3;
}

function processOrder($_arg_0)
{
    global $DB;
    global $date;
    $uid = intval($_arg_0['uid']);
    switch ($_arg_0['name']) {
        case '会员月卡':
            $row = $DB->get_row("select * from pre_user where id='$uid' limit 1");
            $num = intval($_arg_0['num']) * 30;
            if ($row['vip'] > date("Y-m-d H:i:s")) {
                $vip = date("Y-m-d H:i:s", strtotime("+ {$num} days", strtotime($row['vip'])));
            } else {
                $vip = date("Y-m-d H:i:s", strtotime("+ {$num} days"));
            }
            $DB->exec("update pre_user set vip='$vip' where id='{$uid}'");
            $bz = '购买会员月卡';
            break;
        case '会员季卡':
            $row = $DB->get_row("select * from pre_user where id='$uid' limit 1");
            $num = intval($_arg_0['num']) * 92;
            if ($row['vip'] > date("Y-m-d H:i:s")) {
                $vip = date("Y-m-d H:i:s", strtotime("+ {$num} days", strtotime($row['vip'])));
            } else {
                $vip = date("Y-m-d H:i:s", strtotime("+ {$num} days"));
            }
            $DB->query("update pre_user set vip='$vip' where id='{$uid}'");
            $bz = '购买会员季卡';
            break;
        case '会员年卡':
            $row = $DB->get_row("select * from pre_user where id='$uid' limit 1");
            $num = intval($_arg_0['num']) * 365;
            if ($row['vip'] > date("Y-m-d H:i:s")) {
                $vip = date("Y-m-d H:i:s", strtotime("+ {$num} days", strtotime($row['vip'])));
            } else {
                $vip = date("Y-m-d H:i:s", strtotime("+ {$num} days"));
            }
            $DB->query("update pre_user set vip='$vip' where id='{$uid}'");
            $bz = '购买会员年卡';
            break;
        case '短网址点数（100次）':
            $num = intval($_arg_0['num']) * 100;
            $DB->query("update pre_user set create_num=create_num+'$num' where id='{$uid}'");
            $bz = '购买短网址点数（100次）';
            break;
    }
    switch ($_arg_0['type']) {
        case 'wxpay':
            $type = '微信';
            break;
        case 'qqpay':
            $type = 'QQ';
            break;
        case 'alipay':
            $type = '支付宝';
            break;
    }
    $_var_1 = $DB->query("insert into pre_points(uid,action,number,point,bz,addtime,status,orderid) values('$uid','$type','{$_arg_0['num']}','{$_arg_0['money']}','$bz','$date',1,'{$_arg_0['trade_no']}')");
    if (!$_var_1) {
        return false;
    }
    return $_var_1;
}

function send_mail($to, $sub, $msg)
{
    global $conf;
    require ROOT . 'includes/libs/PHPMailer/Exception.php';
    require ROOT .  'includes/libs/PHPMailer/PHPMailer.php';
    require ROOT .  'includes/libs/PHPMailer/SMTP.php';

    $mail = new PHPMailer(true);
    try {
        $mail->CharSet = "UTF-8";
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = $conf['mail_smtp'];
        $mail->SMTPAuth = true;
        $mail->Username = $conf['mail_name'];
        $mail->Password = $conf['mail_pwd'];
        $mail->SMTPSecure = 'ssl';
        $mail->Port = $conf['mail_port'];
        $mail->setFrom($conf['mail_name'], $conf['web_name']);
        $mail->addAddress($to);
        $mail->addReplyTo($conf['mail_name']);
        $mail->Subject = $sub;
        $mail->Body    = $msg;
        $mail->AltBody = $msg;
        $mail->send();
        return true;
    } catch (Exception $e) {
        return $mail->ErrorInfo;
    }
}

function getSetting($_arg_0, $_arg_1 = false)
{
    global $DB;
    global $CACHE;
    if ($_arg_1) {
        return $_var_4[$_arg_0] = $DB->get_row("SELECT v FROM pre_config WHERE k=:k limit 1", [':k' => $_arg_0]);
    }
    $_var_5 = $CACHE->get($_arg_0);
    return $_var_5[$_arg_0];
}

function saveSetting($_arg_0, $_arg_1)
{
    global $DB;
    $_arg_1 = $_arg_1;
    return $DB->exec("REPLACE INTO pre_config SET v=:v,k=:k", [':v' => $_arg_1, ':k' => $_arg_0]);
}

function myscandir($_arg_0)
{
    foreach (glob($_arg_0) as $_var_1) {
        if (is_dir($_var_1)) {
            echo $_var_1 . "<br/>";
        }
    }
}

function checkIfActive($_arg_0, $_arg_1 = 0)
{
    $_var_1 = explode(",", $_arg_0);
    $_var_2 = substr($_SERVER["REQUEST_URI"], strrpos($_SERVER["REQUEST_URI"], "/") + 1, strrpos($_SERVER["REQUEST_URI"], ".") - strrpos($_SERVER["REQUEST_URI"], "/") - 1);
    if (in_array($_var_2, $_var_1)) {
        if ($_arg_1 == 1) {
            return "active open";
        }
        return "active";
    }
    if (isset($_GET["mod"]) && in_array(str_replace("_n", '', $_GET["mod"]), $_var_1)) {
        if ($_arg_1 == 1) {
            return "active open";
        }
        return "active";
    }
}

function update_version()
{
    $_var_0 = curl_get("http://auth.btstu.cn/check.php?url=" . $_SERVER["HTTP_HOST"] . "&authcode=" . authcode . "&ver=" . VERSION);
    if ($_var_0 = json_decode($_var_0, true)) {
        return $_var_0;
    }
    return false;
}

function getCheckString()
{
    $_var_0 = 'http://auth.btstu.cn/check.php?url=' . $_SERVER['HTTP_HOST'] . '&authcode=' . authcode . "&ver=" . VERSION;
    return $_var_0;
}

function sysmsg($_arg_0 = "未知的异常")
{
    echo "  \r\n    <!DOCTYPE html>\r\n    <html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"zh-CN\">\r\n    <head>\r\n        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n        <title>站点提示信息</title>\r\n        <style type=\"text/css\">\r\nhtml{background:#eee}body{background:#fff;color:#333;font-family:\"微软雅黑\",\"Microsoft YaHei\",sans-serif;margin:2em auto;padding:1em 2em;max-width:700px;-webkit-box-shadow:10px 10px 10px rgba(0,0,0,.13);box-shadow:10px 10px 10px rgba(0,0,0,.13);opacity:.8}h1{border-bottom:1px solid #dadada;clear:both;color:#666;font:24px \"微软雅黑\",\"Microsoft YaHei\",,sans-serif;margin:30px 0 0 0;padding:0;padding-bottom:7px}#error-page{margin-top:50px}h3{text-align:center}#error-page p{font-size:9px;line-height:1.5;margin:25px 0 20px}#error-page code{font-family:Consolas,Monaco,monospace}ul li{margin-bottom:10px;font-size:9px}a{color:#21759B;text-decoration:none;margin-top:-10px}a:hover{color:#D54E21}.button{background:#f7f7f7;border:1px solid #ccc;color:#555;display:inline-block;text-decoration:none;font-size:9px;line-height:26px;height:28px;margin:0;padding:0 10px 1px;cursor:pointer;-webkit-border-radius:3px;-webkit-appearance:none;border-radius:3px;white-space:nowrap;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;-webkit-box-shadow:inset 0 1px 0 #fff,0 1px 0 rgba(0,0,0,.08);box-shadow:inset 0 1px 0 #fff,0 1px 0 rgba(0,0,0,.08);vertical-align:top}.button.button-large{height:29px;line-height:28px;padding:0 12px}.button:focus,.button:hover{background:#fafafa;border-color:#999;color:#222}.button:focus{-webkit-box-shadow:1px 1px 1px rgba(0,0,0,.2);box-shadow:1px 1px 1px rgba(0,0,0,.2)}.button:active{background:#eee;border-color:#999;color:#333;-webkit-box-shadow:inset 0 2px 5px -3px rgba(0,0,0,.5);box-shadow:inset 0 2px 5px -3px rgba(0,0,0,.5)}table{table-layout:auto;border:1px solid #333;empty-cells:show;border-collapse:collapse}th{padding:4px;border:1px solid #333;overflow:hidden;color:#333;background:#eee}td{padding:4px;border:1px solid #333;overflow:hidden;color:#333}\r\n        </style>\r\n    </head>\r\n    <body id=\"error-page\">\r\n        ";
    echo "<h3>站点提示信息</h3>";
    echo $_arg_0;
    echo "    </body>\r\n    </html>\r\n    ";
    return 0;
}

function rm_dir($_arg_0)
{
    if (!is_dir($_arg_0)) {
        return false;
    }
    $_var_1 = opendir($_arg_0);
    while ($_var_2 = readdir($_var_1)) {
        if ($_var_2 != "." && $_var_2 != "..") {
            $_var_3 = $_arg_0 . "/" . $_var_2;
            if (!is_dir($_var_3)) {
                unlink($_var_3);
            } else {
                rm_dir($_var_3);
            }
        }
    }
    closedir($_var_1);
    if (rmdir($_arg_0)) {
        return true;
    }
    return false;
}

function dwzList()
{
    global $conf, $DB, $userrow;
    $dwz = '';
    $rs = $DB->query("select * from pre_api where status=1 order by sorting");
    while ($res = $rs->fetch()) {
        if (!$userrow || $userrow['dwz_type'] == '') {
            $selected = $res['keyname'] == $conf['dwz_type'] ? ' selected' : '';
        } else {
            $selected = $res['keyname'] == $userrow['dwz_type'] ? ' selected' : '';
        }
        $dwz .= '<option value="' . $res['keyname'] . '"' . $selected . '>' . $res['name'] . '</option>';
    }
    return $dwz;
}

function dwz($url, $type, $token = '')
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://apis.btstu.cn/api.php?type=' . $type . '&url=' . urlencode($url) . '&token=' . $token);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $url = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($url, true);
    if ($data['code'] == 200 && $data['msg'] != '') {
        return $data['msg'];
    } else {
        return '';
    }
}

function dwz2($domain, $url, $type, $token)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $domain . '/api/url.php?type=' . $type . '&url=' . urlencode($url) . '&token=' . $token);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $url = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($url, true);
    if ($data['code'] == 200) {
        return $data['dwz'];
    } else {
        return '';
    }
}

function createUrl($type, $id, $uid, $url, $group = 0, $bz = '', $visit = '', $visiturl = '', $pwd = '', $qqjump = '', $wxjump = '', $alijump = '', $endtime = '')
{
    global $DB, $date, $conf;
    include_once ROOT . 'includes/libs/dwz.class.php';
    if ($DB->get_row("select id from pre_black where content=:url and type=1 limit 1", [':url' => $url])) {
        $str = array('code' => -1, 'msg' => '该网址已被拉黑');
        return $str;
    }
    $ip = x_real_ip();
    if ($DB->get_row("select id from pre_black where content='$ip' and type=0 limit 1")) {
        $str = array('code' => -1, 'msg' => '您的IP已被拉黑');
        return $str;
    }
    $domain = parse_url($url, PHP_URL_HOST);
    if ($DB->get_row("select id from pre_black where content=:domain and type=2 limit 1", [':domain' => $domain])) {
        $str = array('code' => -1, 'msg' => '该域名已被拉黑');
        return $str;
    }
    $rs = $DB->query("select content from pre_black where type=3");
    while ($res = $rs->fetch()) {
        if (preg_match("#{$res['content']}#", $domain)) {
            $str = array('code' => -1, 'msg' => '该域名已被拉黑');
            return $str;
        }
    }
    if ($conf['strict_model'] == 1) {
        $preg = "#^http(s)?://(www.)?(\w+(\.)?)+#";
        if (!preg_match($preg, $url)) {
            $str = array('code' => -1, 'msg' => '请输入正确的网址');
            return $str;
        }
    }
    $urow = $DB->get_row("select * from pre_user where id=:uid limit 1", [':uid' => $uid]);
    if (!$urow) {
        $urow['create_num'] = 0;
        $urow['vip'] = '2020-01-01 00:00:00';
    }
    $today = date('Y-m-d');
    if ($conf['limit_url2'] != '' && $urow['vip'] <= $date) {
        $num = $DB->getColumn("select count(1) from pre_url where uid=:uid and addtime>'$today'", [':uid' => $uid]);
        if ($num >= $conf['limit_url2']) {
            $str = array('code' => -1, 'msg' => '已超过当日可用链接上限,普通用户每日最多可生成' . $conf['limit_url2'] . '次链接');
            return $str;
        }
    }
    if ($conf['limit_url3'] != '' && $urow['vip'] > $date) {
        $num = $DB->getColumn("select count(1) from pre_url where uid=:uid and addtime>'$today'", [':uid' => $uid]);
        if ($num >= $conf['limit_url3']) {
            $str = array('code' => -1, 'msg' => '已超过当日可用链接上限,会员每日最多可生成' . $conf['limit_url3'] . '次链接');
            return $str;
        }
    }
    $arow = $DB->get_row("select * from pre_api where keyname=:type limit 1", [':type' => $type]);
    if (!$arow) {
        $str = array('code' => -1, 'msg' => '该短网址类型不存在');
        return $str;
    }
    if ($arow['status'] == 0) {
        $str = array('code' => -1, 'msg' => '该短网址已停用');
        return $str;
    }
    $num = $urow['vip'] < $date ? $arow['num'] : $arow['vip_num'];
    if ($urow['create_num'] < $num) {
        $str = array('code' => -1, 'msg' => '您的额度已不足，请充值后再生成！');
        return $str;
    }
    $token = $arow['token'] == '' ? $conf['dwz_token'] : $arow['token'];
    $path = $conf['htaccess'] == 0 ? 'tz.php?id=' . $id : $id;
    $group = $group == '' ? 0 : $group;
    if ($conf['jump1'] == 0) {
        $str = array('code' => -1, 'msg' => '该功能已关闭');
        return $str;
    }
    $res = $DB->get_row("select * from pre_domain where state=1 and type=2 order by rand() limit 1");
    if (!$res) {
        $res = $DB->get_row("select * from pre_domain where state=1 and type=0 order by rand() limit 1");
    }
    if (!$res) {
        $str = array('code' => -1, 'msg' => '未设置域名');
        return $str;
    }
    $r_domain = preg_replace("/\*/", getrand2(8), $res['domain']);
    $tzurl = ($res['is_https'] == 0 ? 'http://' : 'https://') . $r_domain . '/' . $path;
    if ($arow['type'] == 0) {
        $dwz = $arow['domain'] . '/' . $path;
    } elseif ($arow['type'] == 1) {
        $dwz = dwz($tzurl, $type, $token);
    } elseif ($arow['type'] == 2) {
        $dwz = dwz2($arow['domain'], $tzurl, $type, $arow['token']);
    } elseif ($arow['type'] == 3) {
        $data = urlc($url, $type, $token, $id, $pattern);
        if ($data['code'] == 0) {
            $dwz = $data['dwz'];
        } else {
            $str = array('code' => -1, 'msg' => $data['msg']);
            return $str;
        }
    } else {
        $str = array('code' => -1, 'msg' => '生成出错');
        return $str;
    }
    if ($dwz == '') {
        $str = array('code' => -1, 'msg' => '短网址生成失败');
        return $str;
    } else {
        if ($DB->query("insert into pre_url(id,uid,addtime,dwz,url,ip,remarks,visit,visiturl,endtime,grouping,pwd,qqjump,wxjump,alijump,lasttime) values('$id','$uid','$date','$dwz','$url','$ip','$bz','$visit','$visiturl','$endtime','$group','$pwd','$qqjump','$wxjump','$alijump','$date')")) {
            $DB->exec("update pre_user set create_num=create_num-$num where id=:uid", [':uid' => $uid]);
            $str = array('code' => 0, 'msg' => $dwz);
            return $str;
        } else {
            $str = array('code' => -1, 'msg' => '生成失败');
            return $str;
        }
    }
}

function editUrl($uid, $id, $vip, $url, $group = 0, $remarks = '',  $visit = '', $visiturl = '', $endtime = '', $pwd = '', $qqjump = '', $wxjump = '', $alijump = '')
{
    global $DB, $conf, $date, $userrow;
    $uid = $userrow['id'];
    if ($url == '') {
        $str = array('code' => -1, 'msg' => '跳转地址不能为空');
        return $str;
    }
    if ($DB->get_row("select id from pre_black where content=:url and type=1 limit 1", [':url' => $url])) {
        $str = array('code' => -1, 'msg' => '该网址已被拉黑');
        return $str;
    }
    $ip = x_real_ip();
    if ($DB->get_row("select id from pre_black where content='$ip' and type=0 limit 1")) {
        $str = array('code' => -1, 'msg' => '您的IP已被拉黑');
        return $str;
    }
    $domain = parse_url($url, PHP_URL_HOST);
    if ($DB->get_row("select id from pre_black where content=:domain and type=2 limit 1", [':domain' => $domain])) {
        $str = array('code' => -1, 'msg' => '该域名已被拉黑');
        return $str;
    }
    $rs = $DB->query("select content from pre_black where type=3");
    while ($res = $rs->fetch()) {
        if (preg_match("#{$res['content']}#", $domain)) {
            $str = array('code' => -1, 'msg' => '该域名已被拉黑');
            return $str;
        }
    }
    if ($conf['strict_model'] == 1) {
        $preg = "#^http(s)?://(www.)?(\w+(\.)?)+#";
        if (!preg_match($preg, $url)) {
            $str = array('code' => -1, 'msg' => '请输入正确的网址');
            return $str;
        }
    }
    $group = $group == '' ? 0 : $group;
    $res = $DB->get_row("select url,dwz from pre_url where id=:id limit 1", [':id' => $id]);
    if ($res) {
        if ($vip == 0 && $conf['vip_edit'] == 1) {
            if ($DB->exec("update pre_url set remarks=:remarks,pwd=:pwd where id=:id and uid=:uid", [':remarks' => $remarks, ':pwd' => $pwd, ':id' => $id, ':uid' => $uid])) {
                $str = array('code' => 0, 'msg' => '修改成功');
                return $str;
            } else {
                $str = array('code' => -1, 'msg' => '修改失败');
                return $str;
            }
        } else {
            if ($DB->exec(
                "update pre_url set url=:url,remarks=:remarks,visit=:visit,visiturl=:visiturl,endtime=:endtime,pwd=:pwd,qqjump=:qqjump,wxjump=:wxjump,alijump=:alijump,grouping=:group where id=:id and uid=:uid",
                [':url' => $url, ':remarks' => $remarks, ':visit' => $visit, ':visiturl' => $visiturl, ':endtime' => $endtime, ':pwd' => $pwd, ':qqjump' => $qqjump, ':wxjump' => $wxjump, ':alijump' => $alijump, ':group' => $group, ':id' => $id, ':uid' => $uid]
            )) {
                if ($url != $res['url']) {
                    $DB->exec("insert into pre_modify(uid,urlid,addtime,url1,url2,dwz) values(:uid,:id,'$date',:url,:url1,:url2)", [':uid' => $uid, ':id' => $id, ':url1' => $res["url"], ':url2' => $res["dwz"]]);
                }
                $str = array('code' => 0, 'msg' => '修改成功');
                return $str;
            } else {
                $str = array('code' => -1, 'msg' => '修改失败');
                return $str;
            }
        }
    } else {
        $str = array('code' => -1, 'msg' => '网址信息不存在');
        return $str;
    }
}

function editUrl2($id, $url, $remarks = '',  $visit = '', $visiturl = '', $pwd = '', $qqjump = '', $wxjump = '', $alijump = '')
{
    global $DB, $conf, $date;
    if ($url == '') {
        $str = array('code' => -1, 'msg' => '跳转地址不能为空');
        return $str;
    }
    if ($DB->get_row("select id from pre_black where content=:url and type=1 limit 1", [':url' => $url])) {
        $str = array('code' => -1, 'msg' => '该网址已被拉黑');
        return $str;
    }
    $domain = parse_url($url, PHP_URL_HOST);
    if ($DB->get_row("select id from pre_black where content=:domain and type=2 limit 1", [':domain' => $domain])) {
        $str = array('code' => -1, 'msg' => '该域名已被拉黑');
        return $str;
    }
    $rs = $DB->query("select content from pre_black where type=3");
    while ($res = $rs->fetch()) {
        if (preg_match("#{$res['content']}#", $domain)) {
            $str = array('code' => -1, 'msg' => '该域名已被拉黑');
            return $str;
        }
    }
    if ($conf['strict_model'] == 1) {
        $preg = "#^http(s)?://(www.)?(\w+(\.)?)+#";
        if (!preg_match($preg, $url)) {
            $str = array('code' => -1, 'msg' => '请输入正确的网址');
            return $str;
        }
    }
    $res = $DB->get_row("select url,dwz from pre_url where id=:id limit 1", [':id' => $id]);
    if ($res) {
        if ($DB->exec(
            "update pre_url set url=:url,remarks=:remarks,visit=:visit,visiturl=:visiturl,pwd=:pwd,qqjump=:qqjump,wxjump=:wxjump,alijump=:alijump where id=:id",
            [':url' => $url, ':remarks' => $remarks, ':visit' => $visit, ':visiturl' => $visiturl, ':pwd' => $pwd, ':qqjump' => $qqjump, ':wxjump' => $wxjump, ':alijump' => $alijump, ':id' => $id]
        )) {
            if ($url != $res['url']) {
                $DB->exec("insert into pre_modify(uid,urlid,addtime,url1,url2,dwz) values(:uid,:id,'$date',:url,:url1,:url2)", [':uid' => 0, ':id' => $id, ':url1' => $res["url"], ':url2' => $res["dwz"]]);
            }
            $str = array('code' => 0, 'msg' => '修改成功');
            return $str;
        } else {
            $str = array('code' => -1, 'msg' => '修改失败');
            return $str;
        }
    } else {
        $str = array('code' => -1, 'msg' => '网址信息不存在');
        return $str;
    }
}

function clear_file()
{
    rm_dir(ROOT);
    mkdir(ROOT);
    $_var_0 = "<?php\r\n@header(\"Content-Type: text/html; charset=UTF-8\");\r\necho \"系统检测到网站文件被恶意篡改，请重新下载完整安装包上传安装\";";
    file_put_contents(ROOT . "index.php", $_var_0);
}

function groupList()
{
    global $DB, $userrow;
    $glist = '<option value="0">默认分组</option>';
    $rs = $DB->query("select * from pre_group where uid=:uid order by id desc", [':uid' => $userrow['id']]);
    while ($res = $rs->fetch()) {
        $glist .= '<option value="' . $res['id'] . '">' . $res['name'] . '</option>';
    }
    return $glist;
}

function groupInfo()
{
    global $DB, $userrow;
    $info = array();
    $info[0] = '默认';
    $rs = $DB->query("select * from pre_group where uid=:uid", [':uid' => $userrow['id']]);
    while ($res = $rs->fetch()) {
        $info[$res['id']] = $res['name'];
    }
    return $info;
}

function getday($day = '', $num = 7)
{
    $days = array();
    if ($day == '') {
        $day = date("Y-m-d");
    }
    for ($i = 0; $i < $num; $i++) {
        $days[] = date("Y-m-d", strtotime("-$i day", strtotime($day)));
    }
    return $days;
}

function getWeek($time)
{
    $weekarray = array("日", "一", "二", "三", "四", "五", "六");
    $str =  "周" . $weekarray[date("w", strtotime("-" . $time . " day"))];
    return $str;
}

function getTitle($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; Baiduspider-render/2.0; +http://www.baidu.com/search/spider.html)");
    $ret = curl_exec($ch);
    curl_close($ch);
    preg_match('/<title>(.*)<\/title>/i', $ret, $title);
    $title = str_replace(array("\r\n", "\r", "\n", ',', ' '), '', $title[1]);
    if (!isset($title)) {
        $title = '';
    }
    return $title;
}

function tx_captcha($Ticket, $Randstr)
{
    global $conf;
    $CaptchaAppId = $conf['CaptchaAppId'];
    $AppSecretKey = $conf['AppSecretKey'];
    $secretId = $conf['tx_SecretId'];
    $secretKey = $conf['tx_SecretKey'];

    if (!$CaptchaAppId || !$AppSecretKey || !$secretId || !$secretKey || !$Ticket || !$Randstr) {
        return false;
    }

    $CaptchaAppId = (int) $CaptchaAppId;
    $host = "captcha.tencentcloudapi.com";
    $service = "captcha";
    $version = "2019-07-22";
    $action = "DescribeCaptchaResult";
    $timestamp = time();

    $payload = array(
        'CaptchaType' => 9,
        'Ticket' => $Ticket,
        'Randstr' => $Randstr,
        'UserIp' => real_ip(),
        'CaptchaAppId' => $CaptchaAppId,
        'AppSecretKey' => $AppSecretKey,
    );

    $algorithm = "TC3-HMAC-SHA256";
    $httpRequestMethod = "POST";
    $canonicalUri = "/";
    $canonicalQueryString = "";
    $canonicalHeaders = "content-type:application/json\n" . "host:" . $host . "\n";
    $signedHeaders = "content-type;host";
    $hashedRequestPayload = hash("SHA256", json_encode($payload));
    $canonicalRequest = $httpRequestMethod . "\n"
        . $canonicalUri . "\n"
        . $canonicalQueryString . "\n"
        . $canonicalHeaders . "\n"
        . $signedHeaders . "\n"
        . $hashedRequestPayload;
    $date = gmdate("Y-m-d", $timestamp);
    $credentialScope = $date . "/" . $service . "/tc3_request";
    $hashedCanonicalRequest = hash("SHA256", $canonicalRequest);
    $stringToSign = $algorithm . "\n"
        . $timestamp . "\n"
        . $credentialScope . "\n"
        . $hashedCanonicalRequest;
    $secretDate = hash_hmac("SHA256", $date, "TC3" . $secretKey, true);
    $secretService = hash_hmac("SHA256", $service, $secretDate, true);
    $secretSigning = hash_hmac("SHA256", "tc3_request", $secretService, true);
    $signature = hash_hmac("SHA256", $stringToSign, $secretSigning);
    $authorization = $algorithm
        . " Credential=" . $secretId . "/" . $credentialScope
        . ", SignedHeaders=content-type;host, Signature=" . $signature;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://' . $host);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $httpRequestMethod);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: ' . $authorization,
        'Content-Type: application/json',
        'Host: ' . $host,
        'X-TC-Action: ' . $action,
        'X-TC-Version: ' . $version,
        'X-TC-Timestamp: ' . $timestamp,
    ));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    $output = curl_exec($ch);
    curl_close($ch);
    $output = json_decode($output);
    if (isset($output->Response) && isset($output->Response->CaptchaCode) && $output->Response->CaptchaCode == 1) {
        return true;
    }
    return false;
}

function sec_check()
{
    global $conf, $DB;
    global $dbconfig;
    $_var_4 = glob(ROOT . "dwz_release_*");
    foreach ($_var_4 as $_var_5) {
        unlink($_var_5);
    }
    $_var_4 = glob(ROOT . "dwz_update_*");
    foreach ($_var_4 as $_var_5) {
        unlink($_var_5);
    }
    $_var_6 = array();
    if (strpos($_SERVER["SERVER_SOFTWARE"], "kangle") !== false && function_exists("pcntl_exec")) {
        $_var_6[] = "<li class=\"list-group-item\"><span class=\"btn-sm btn-danger\">高危</span>&nbsp;当前主机为kangle且开启了php的pcntl组件，会被黑客入侵，请联系主机商修复或更换主机</a></li>";
    }
    if (strpos($_SERVER["SERVER_SOFTWARE"], "kangle") !== false && count(glob("/vhs/kangle/etc/*")) > 1) {
        $_var_6[] = "<li class=\"list-group-item\"><span class=\"btn-sm btn-danger\">高危</span>&nbsp;当前主机为kangle且未设置open_basedir防跨站，会被黑客入侵，请联系主机商修复或更换主机</a></li>";
    }
    if ($conf["admin_pwd"] === "123456") {
        $_var_6[] = "<li class=\"list-group-item\"><span class=\"btn-sm btn-danger\">重要</span>&nbsp;请及时修改默认管理员密码 <a href=\"pwd.php\">点此进入网站信息配置修改</a></li>";
    } else {
        if (strlen($conf["admin_pwd"]) < 6 || is_numeric($conf["admin_pwd"]) && strlen($conf["admin_pwd"]) <= 10 || $conf["admin_pwd"] === $conf["kfqq"]) {
            $_var_6[] = "<li class=\"list-group-item\"><span class=\"btn-sm btn-danger\">重要</span>&nbsp;网站管理员密码过于简单，请不要使用较短的纯数字或自己的QQ号当做密码</li>";
        } else {
            if ($conf["admin_user"] === $conf["admin_pwd"]) {
                $_var_6[] = "<li class=\"list-group-item\"><span class=\"btn-sm btn-danger\">重要</span>&nbsp;网站管理员用户名与密码相同，极易被黑客破解，请及时修改密码</li>";
            }
        }
    }
    if (strlen($dbconfig["pwd"]) < 5 || is_numeric($dbconfig["pwd"]) && strlen($dbconfig["pwd"]) <= 10 || $dbconfig["pwd"] === $conf["kfqq"]) {
        $_var_6[] = "<li class=\"list-group-item\"><span class=\"btn-sm btn-danger\">重要</span>&nbsp;当前主机的数据库密码过于简单，请不要使用较短的纯数字或自己的QQ号当做数据库密码</li>";
    } else {
        if ($dbconfig["pwd"] === $dbconfig["user"]) {
            $_var_6[] = "<li class=\"list-group-item\"><span class=\"btn-sm btn-danger\">重要</span>&nbsp;当前主机的数据库用户名与密码相同，极易被黑客破解，请及时修改数据库密码</li>";
        }
    }
    $_var_7 = glob(ROOT . "*.zip");
    $_var_8 = glob(ROOT . "*.7z");
    $_var_9 = glob(ROOT . "*.rar");
    if ($_var_7 && count($_var_7) > 0 || $_var_8 && count($_var_8) > 0 || $_var_9 && count($_var_9) > 0) {
        $_var_6[] = "<li class=\"list-group-item\"><span class=\"btn-sm btn-warning\">提示</span>&nbsp;网站根目录存在压缩包文件，可能会被人恶意获取并泄露数据库密码，请及时删除</a></li>";
    }
    if ($DB->getColumn("select count(*) from pre_domain where type=0 and state=1") == 0) {
        $_var_6[] = "<li class=\"list-group-item\"><span class=\"btn-sm btn-warning\">提示</span>&nbsp;网站未设置或启用通用入口域名，可能导致无法生成短网址</a></li>";
    }
    if ($conf['second_jump'] == 1 && $DB->getColumn("select count(*) from pre_domain where type=1 and state=1") == 0) {
        $_var_6[] = "<li class=\"list-group-item\"><span class=\"btn-sm btn-warning\">提示</span>&nbsp;您开启了二次跳转，需要至少添加或启用一个通用落地域名</a></li>";
    }
    if ($conf['dwz_token'] == '') {
        $_var_6[] = "<li class=\"list-group-item\"><span class=\"btn-sm btn-warning\">提示</span>&nbsp;未设置对接token，将导致部分功能无法使用</a></li>";
    }
    if ($conf['pattern'] == '') {
        $_var_6[] = "<li class=\"list-group-item\"><span class=\"btn-sm btn-warning\">提示</span>&nbsp;未设置默认跳转类型，可能导致短网址生成出错</a></li>";
    }
    if ($conf['dwz_type'] == '') {
        $_var_6[] = "<li class=\"list-group-item\"><span class=\"btn-sm btn-warning\">提示</span>&nbsp;未设置默认短网址，可能导致无法生成短网址</a></li>";
    }
    return $_var_6;
}
