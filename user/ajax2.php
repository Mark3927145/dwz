<?php
include('../includes/common.php');
$act = isset($_GET['act']) ? trim(daddslashes($_GET['act'])) : null;
@header('Content-Type: application/json; charset=UTF-8');
switch ($act) {
    case 'login':
        if ($conf['captcha_login'] == 1) {
            $ticket = isset($_POST['ticket']) ? $_POST['ticket'] : '';
            $randstr = isset($_POST['randstr']) ? $_POST['randstr'] : '';
            if ($ticket == '' || $randstr == '') {
                $result = array("code" => -1, "msg" => "验证出错");
                exit(json_encode($result));
            }
            if (!tx_captcha($ticket, $randstr)) {
                $result = array("code" => -1, "msg" => '验证失败');
                exit(json_encode($result));
            }
        }
        if (isset($_POST['user']) && isset($_POST['pwd'])) {
            $user = trim(daddslashes($_POST['user']));
            $pwd = trim(daddslashes($_POST['pwd']));
            $res = $DB->get_row("select id,state from pre_user where user=:user and pwd=:pwd limit 1", [':user' => $user, ':pwd' => $pwd]);
            if ($res) {
                if ($res['state'] == 0) {
                    $result = array("code" => -1, "msg" => "当前账号已被封禁！");
                    exit(json_encode($result));
                }
                $id = $res['id'];
                $clientip = real_ip();
                $DB->exec("update pre_user set lasttime='$date',lastip='$clientip' where id='$id'");
                $session = md5($user . $pwd . $password_hash);
                $token = authcode("{$id}\t{$session}", 'ENCODE', SYS_KEY);
                setcookie("user_token", $token, time() + 604800, '/');
                log_result('用户登录', 'id:' . $id . ',ip:' . $clientip, '登录成功');
                $result = array("code" => 0, "msg" => "登录成功");
                exit(json_encode($result));
            } else {
                $result = array("code" => -1, "msg" => "账号或密码不正确！");
                exit(json_encode($result));
            }
        } else {
            $result = array("code" => -1, "msg" => "请填写账号和密码");
            exit(json_encode($result));
        }
        break;
    case 'reg':
        if ($conf['captcha_reg'] == 1) {
            $ticket = isset($_POST['ticket']) ? $_POST['ticket'] : '';
            $randstr = isset($_POST['randstr']) ? $_POST['randstr'] : '';
            if ($ticket == '' || $randstr == '') {
                $result = array("code" => -1, "msg" => "验证出错");
                exit(json_encode($result));
            }
            if (!tx_captcha($ticket, $randstr)) {
                $result = array("code" => -1, "msg" => '验证失败');
                exit(json_encode($result));
            }
        }
        if ($conf['is_reg'] == 0) {
            $result = array("code" => -1, "msg" => '注册通道已关闭');
            exit(json_encode($result));
        }
        $user = trim(daddslashes($_POST['user']));
        $pwd = trim(daddslashes($_POST['pwd']));
        $pwds = trim(daddslashes($_POST['pwds']));
        $qq = trim(daddslashes($_POST['qq']));
        $mail = trim(daddslashes($_POST['mail']));
        $code = trim(daddslashes($_POST['code']));
        if ($user == '' || $pwd == '' || $pwds == '' || $qq == '' || $mail == '') {
            $result = array("code" => -1, "msg" => "填写的信息不完整！");
            exit(json_encode($result));
        }
        if ($pwd != $pwds) {
            $result = array("code" => -1, "msg" => "俩次输入的密码不一致！");
            exit(json_encode($result));
        }
        if (!preg_match('/[a-zA-Z0-9_]{5,10}$/', $user)) {
            $result = array("code" => -1, "msg" => "账号格式有误！请输入5-10位的英文或数字");
            exit(json_encode($result));
        }
        if (!preg_match('/\w{5,12}$/', $pwd)) {
            $result = array("code" => -1, "msg" => "密码格式有误！请输入5-12位的英文或数字");
            exit(json_encode($result));
        }
        if (!preg_match('/^[0-9]{5,11}+$/', $qq)) {
            $result = array("code" => -1, "msg" => "QQ格式有误！");
            exit(json_encode($result));
        }
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            exit(json_encode(['code' => -1, 'msg' => '请填写正确的邮箱'], JSON_UNESCAPED_UNICODE));
        }
        if ($conf['regMailCheck'] == 1) {
            if ($code == '') {
                $result = array("code" => -1, "msg" => "请填写邮箱验证码");
                exit(json_encode($result));
            }
            if (!$DB->get_row("select id from pre_mail_log where type=1 and code=:code and mail=:mail order by addtime desc limit 1", [':code' => $code, ':mail' => $mail])) {
                $result = array("code" => -1, "msg" => "邮箱验证码有误");
                exit(json_encode($result));
            }
        }
        if ($DB->getColumn("select count(*) from pre_user where user=:user", [':user' => $user]) > 0) {
            $result = array("code" => -1, "msg" => "该账号已被注册!");
            exit(json_encode($result));
        }
        if ($DB->getColumn("select count(*) from pre_user where qq=:qq", [':qq' => $qq]) > 0) {
            $result = array("code" => -1, "msg" => "该QQ已被注册，请更换QQ！");
            exit(json_encode($result));
        }
        if ($DB->get_row("select mail from pre_user where mail=:mail limit 1", [':mail' => $mail])) {
            exit(json_encode(['code' => 0, 'msg' => '该邮箱已被注册'], JSON_UNESCAPED_UNICODE));
        }
        $clientip = real_ip();
        if ($conf['reg_limit'] != 0) {
            $num = $DB->getColumn("select count(*) from pre_user where addip='$clientip' and to_days(addtime) = to_days(now())");
            if ($num >= $conf['reg_limit']) {
                $result = array("code" => -1, "msg" => "您今日注册的账号已超过上限，请明日再注册");
                exit(json_encode($result));
            }
        }
        $name = $user;
        $img = 'https://q.qlogo.cn/headimg_dl?dst_uin=' . $qq . '&spec=100';
        $day = $conf['default_vip'];
        $vip = date('Y-m-d H:i:s', strtotime("$date + $day day"));
        if ($DB->exec("insert into pre_user(user,pwd,addtime,vip,create_num,check_num,qq,mail,addip,name,img) values(:user,:pwd,'$date','$vip','{$conf['default_create']}','{$conf['default_check']}',:qq,:mail,'$clientip',:name,:img)", [':user' => $user, ':pwd' => $pwd, ':qq' => $qq, ':mail' => $mail, ':name' => $name, ':img' => $img])) {
            $id = $DB->lastInsertId();
            $DB->exec("update pre_mail_log set status=1,used='$date' where type=1 and code=:code and mail=:mail", [':code' => $code, ':mail' => $mail]);
            $DB->exec("update pre_user set lasttime='$date',lastip='$clientip' where id='$id'");
            $session = md5($user . $pwd . $password_hash);
            $token = authcode("{$id}\t{$session}", 'ENCODE', SYS_KEY);
            setcookie("user_token", $token, time() + 604800, '/');
            log_result('用户登录', 'id:' . $id . ',ip:' . $clientip, '登录成功');
            $result = array("code" => 0, "msg" => "注册成功，点击确认自动登录！");
            exit(json_encode($result));
        } else {
            $result = array("code" => -1, "msg" => "注册失败，请重新注册或联系客服处理！");
            exit(json_encode($result));
        }
        break;
    case 'getCode':
        $mail = trim(daddslashes($_POST['mail']));
        if ($mail == '') {
            $result = array("code" => -1, "msg" => "请填写邮箱");
            exit(json_encode($result));
        }
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            exit(json_encode(['code' => -1, 'msg' => '请填写正确的邮箱'], JSON_UNESCAPED_UNICODE));
        }
        $res = $DB->get_row("select mail from pre_user where mail=:mail limit 1", [':mail' => $mail]);
        if ($res) {
            exit(json_encode(['code' => -1, 'msg' => '该邮箱已被注册'], JSON_UNESCAPED_UNICODE));
        } else {
            $ip = real_ip();
            $code = rand(100000, 999999);
            if ($DB->get_row("select id from pre_mail_log where type=1 and ip='$ip' and addtime>=DATE_SUB(NOW(),INTERVAL 1 MINUTE);")) {
                exit(json_encode(['code' => -1, 'msg' => '已经获取过了，请一分钟后再重新获取'], JSON_UNESCAPED_UNICODE));
            }
            send_mail($mail, '操作验证码', regSendCode($code));
            $rs = $DB->exec("insert into pre_mail_log(addtime,code,ip,mail,type) values('$date','$code','$ip',:mail,1)", [':mail' => $mail]);
            if ($rs) {
                exit(json_encode(['code' => 0, 'msg' => '邮箱验证码发送成功'], JSON_UNESCAPED_UNICODE));
            } else {
                exit(json_encode(['code' => -1, 'msg' => '邮箱验证码发送失败'], JSON_UNESCAPED_UNICODE));
            }
        }
        break;
}
