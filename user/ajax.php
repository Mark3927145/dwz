<?php
include('../includes/common.php');
if ($islogin2 == 1) {
} else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>

<?php
$act = isset($_GET['act']) ? trim(daddslashes($_GET['act'])) : null;
@header('Content-Type: application/json; charset=UTF-8');
switch ($act) {
    case 'getcount':
        $alertgg = $conf['gg3'];
        if (isset($_COOKIE['user_alert']) && $alertgg == $_COOKIE['user_alert']) {
            $alertgg = '';
        } else {
            setcookie("user_alert", $alertgg, time() + 3600 * 24);
        }
        $yesterday = date("Y-m-d", strtotime("-1 day"));
        $allUrl = $DB->getColumn("select count(1) from pre_url where uid='$uid' and deltime is null");
        $allView = $DB->getColumn("select sum(pv) from pre_stat where uid='$uid'");
        if ($allView == '') {
            $allView = 0;
        }
        $res = $DB->get_row("select sum(ip) ip,sum(pv) pv from pre_stat where uid='$uid' and date='$yesterday'");
        $yIp = $res['ip'] == '' ? 0 : $res['ip'];
        $yPv = $res['pv'] == '' ? 0 : $res['pv'];
        $result = array("code" => 0, "gg1" => $conf['gg1'], "gg3" => $alertgg, "count1" => $allUrl, "count2" => $allView, "count3" => $yIp, "count4" => $yPv);
        exit(json_encode($result));
        break;
    case 'creatUrls':
        $urls = daddslashes($_POST['urls']);
        $type = trim(daddslashes($_POST['type']));
        if (count($urls) > 50) {
            $result = array("code" => -1, "msg" => '一次最多生成50个短网址');
            exit(json_encode($result));
        }
        $data = array();
        foreach ($urls as $v) {
            if ($v != '') {
                $preg = "#^http(s)?://(www.)?(\w+(\.)?)+#";
                if (!preg_match($preg, $v)) {
                    array_push($data, '网址格式有误');
                } else {
                    $id = getCode($conf['link_length']);
                    $str = createUrl($type, $id, $uid, $v);
                    array_push($data, $str['msg']);
                }
            }
        }
        $result = array("code" => 0, "data" => $data);
        exit(json_encode($result));
        break;
    case 'addUrl':
        $id = ($conf['diy_suffix'] == 1 ? trim(daddslashes($_POST['id'])) : '');
        $url = daddslashes($_POST['url']);
        $type = trim(daddslashes($_POST['type']));
        $group = trim(daddslashes($_POST['group']));
        $pwd = trim(daddslashes($_POST['pwd']));
        $qqjump = daddslashes($_POST['qqjump']);
        $wxjump = daddslashes($_POST['wxjump']);
        $alijump = daddslashes($_POST['alijump']);
        $remarks = trim(daddslashes($_POST['remarks']));
        $visit = trim(daddslashes($_POST['visit']));
        $visiturl = daddslashes($_POST['visiturl']);
        $endtime = daddslashes($_POST['endtime']);
        if (($url == '')) {
            $result = array("code" => -1, "msg" => "跳转网址不能为空");
            exit(json_encode($result));
        }
        if ($id == '') {
            $id = getCode($conf['link_length']);
        } else {
            if ($id == '0') {
                $result = array("code" => -1, "msg" => "后缀不能设置为0");
                exit(json_encode($result));
            }
            if (!preg_match("/^[0-9a-zA-Z]{1,8}$/", $id)) {
                $result = array("code" => -1, "msg" => "后缀只能为字母或数字，且长度为1-8之间");
                exit(json_encode($result));
            } else {
                if ($DB->get_row("select id from pre_url where id=:id limit 1", [':id' => $id])) {
                    $result = array("code" => -1, "msg" => "该后缀已存在");
                    exit(json_encode($result));
                }
            }
        }
        $str = createUrl($type, $id, $uid, $url, $group, $remarks, $visit, $visiturl, $pwd, $qqjump, $wxjump, $alijump, $endtime);
        if ($str['code'] == 0) {
            $result = array("code" => 0, "msg" => "生成成功，短链地址：" . $str['msg']);
            exit(json_encode($result));
        } else {
            $result = array("code" => -1, "msg" => $str['msg']);
            exit(json_encode($result));
        }
        break;
    case 'getUrlInfo':
        $id = trim(daddslashes($_GET['id']));
        $res = $DB->get_row("select * from pre_url where id=:id and uid=:uid limit 1", [':id' => $id, ':uid' => $uid]);
        if ($res) {
            $result = array(
                "code" => 0,
                "id" => $id,
                "dwz" => $res['dwz'],
                "url" => $res['url'],
                "group" => $res['grouping'],
                "remarks" => $res['remarks'],
                "visit" => $res['visit'],
                "visiturl" => $res['visiturl'],
                "endtime" => $res['endtime'],
                "pwd" => $res['pwd'],
                "qqjump" => $res['qqjump'],
                "wxjump" => $res['wxjump'],
                "alijump" => $res['alijump'],
                "view" => $res['view'],
                "addtime" => $res['addtime']
            );
            exit(json_encode($result));
        } else {
            $result = array("code" => -1, "msg" => "网址信息不存在");
            exit(json_encode($result));
        }
        break;
    case 'upUrl':
        $id = trim(addslashes($_POST['id']));
        $url = daddslashes($_POST['url']);
        $group = trim(daddslashes($_POST['group']));
        $remarks = trim(daddslashes($_POST['remarks']));
        $visit = trim(daddslashes($_POST['visit']));
        $visiturl = daddslashes($_POST['visiturl']);
        $endtime = daddslashes($_POST['endtime']);
        $pwd = trim(daddslashes($_POST['pwd']));
        $qqjump = daddslashes($_POST['qqjump']);
        $wxjump = daddslashes($_POST['wxjump']);
        $alijump = daddslashes($_POST['alijump']);
        $ret = editUrl($uid, $id, $vip, $url, $group, $remarks, $visit, $visiturl, $endtime, $pwd, $qqjump, $wxjump, $alijump);
        exit(json_encode($ret));
        break;
    case 'delUrl':
        $id = trim(daddslashes($_POST['id']));
        if (!$DB->get_row("select id from pre_url where id=:id and uid=:uid and deltime is null", [':id' => $id, ':uid' => $uid])) {
            $result = array("code" => -1, "msg" => "网址不存在");
            exit(json_encode($result));
        }
        $rs = $DB->exec("update pre_url set deltime='$date' where id=:id and uid=:uid", [':id' => $id, ':uid' => $uid]);
        if ($rs) {
            $result = array("code" => 0);
            exit(json_encode($result));
        } else {
            $result = array("code" => -1, "msg" => "删除失败");
            exit(json_encode($result));
        }
        break;
    case 'delSelect':
        $ids = explode('&', $_POST['str']);
        $i = 0;
        while ($i < count($ids)) {
            $id = trim(daddslashes($ids[$i]));
            $DB->exec("update pre_url set deltime='$date' where id=:id and uid=:uid", [':id' => $id, ':uid' => $uid]);
            $i++;
        }
        $result = array("code" => 0);
        exit(json_encode($result));
        break;
    case 'delSelect2':
        $ids = explode('&', $_POST['str']);
        $i = 0;
        while ($i < count($ids)) {
            $id = trim(daddslashes($ids[$i]));
            $DB->exec("delete from pre_check where id=:id and uid='$uid'", [':id' => $id, ':uid' => $uid]);
            $i++;
        }
        $result = array("code" => 0);
        exit(json_encode($result));
        break;
    case 'setUrlState':
        $id = trim(daddslashes($_GET['id']));
        $state = trim(daddslashes($_GET['state']));
        $rs = $DB->exec("update pre_url set u_state=:state where id=:id and uid=:uid", [':state' => $state, ':id' => $id, ':uid' => $uid]);
        if ($rs) {
            $result = array("code" => 0, "msg" => "修改成功");
            exit(json_encode($result));
        } else {
            $result = array("code" => -1, "msg" => "修改失败");
            exit(json_encode($result));
        }
        break;
    case 'setUrlStateAll':
        $ids = explode('&', $_POST['str']);
        $i = 0;
        $state = trim(daddslashes($_POST['state']));
        while ($i < count($ids)) {
            $id = trim(daddslashes($ids[$i]));
            $DB->exec("update pre_url set u_state=:state where id=:id and uid=:uid", [':state' => $state, ':id' => $id, ':uid' => $uid]);
            $i++;
        }
        $result = array("code" => 0);
        exit(json_encode($result));
        break;
    case 'upSelect':
        if ($vip == 0) {
            $result = array("code" => -1, "msg" => "会员功能，非会员无法修改网址");
            exit(json_encode($result));
        }
        $ids = explode('&', $_POST['str']);
        $i = 0;
        $url = daddslashes($_POST['url']);
        while ($i < count($ids)) {
            $id = trim(daddslashes($ids[$i]));
            $res = $DB->get_row("select * from pre_url where id=:id", [':id' => $id]);
            if ($url != $res['url']) {
                $DB->exec("insert into pre_modify(uid,urlid,addtime,url1,url2,dwz) values(:uid,:id,'$date',:url,'{$res["url"]}','{$res["dwz"]}')", [':uid' => $uid, ':id' => $id, ':url' => $url]);
            }
            $DB->exec("update pre_url set url=:url where id=:id and uid='$uid'", [':url' => $url, ':id' => $id]);
            $i++;
        }
        $result = array("code" => 0);
        exit(json_encode($result));
        break;
    case 'upUser':
        $qq = trim(daddslashes($_POST['qq']));
        $name = trim(daddslashes($_POST['name']));
        $pattern = trim(daddslashes($_POST['pattern']));
        $dwz_type = trim(daddslashes($_POST['dwz_type']));
        $pwd = trim(daddslashes($_POST['pwd']));
        if (!empty($pwd) && !preg_match('/^[a-zA-Z0-9\_\!\@\#\$~\%\^\&\*.,]+$/', $pwd)) {
            $result = array("code" => -1, "msg" => "密码只能为英文与数字！");
            exit(json_encode($result));
        } elseif (!preg_match('#^[0-9]{5,11}+$#', $qq)) {
            $result = array("code" => -1, "msg" => "QQ格式不正确！");
            exit(json_encode($result));
        } else {
            if ($name == '') {
                $result = array("code" => -1, "msg" => "昵称不能为空");
                exit(json_encode($result));
            }
            if ($DB->getColumn("select count(*) from pre_user where qq=:qq and id<>:uid", [':qq' => $qq, ':uid' => $uid]) > 0) {
                $result = array("code" => -1, "msg" => "该QQ号已被其他账号使用！");
                exit(json_encode($result));
            }
            $DB->exec("update pre_user set qq=:qq,name=:name,pattern=:pattern,dwz_type=:dwz_type where id=:uid", [':qq' => $qq, ':name' => $name, ':pattern' => $pattern, ':dwz_type' => $dwz_type, ':uid' => $uid]);
            if (!empty($pwd)) $DB->exec("update pre_user set pwd=:pwd where id=:uid", [':pwd' => $pwd, ':uid' => $uid]);
            $result = array("code" => 0);
            exit(json_encode($result));
        }
        break;
    case 'updateMail':
        $code = trim(daddslashes($_POST['code']));
        $mail = trim(daddslashes($_POST['mail']));
        if ($code == '' || $mail == '') {
            $result = array("code" => -1, "msg" => "验证码与邮箱不能为空");
            exit(json_encode($result));
        }
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            exit(json_encode(['code' => -1, 'msg' => '请填写正确的邮箱'], JSON_UNESCAPED_UNICODE));
        }
        if (!$DB->get_row("select id from pre_mail_log where type=2 and status=0 and mail=:mail and code=:code and addtime>=DATE_SUB(NOW(),INTERVAL 30 MINUTE) limit 1", [':mail' => $mail, ':code' => $code])) {
            $result = array("code" => -1, "msg" => "验证码错误");
            exit(json_encode($result));
        }
        $res = $DB->get_row("select mail from pre_user where mail=:mail limit 1", [':mail' => $mail]);
        if ($res) {
            exit(json_encode(['code' => -1, 'msg' => '该邮箱已被注册'], JSON_UNESCAPED_UNICODE));
        }
        $rs = $DB->exec("update pre_user set mail=:mail where id=:uid", [':mail' => $mail, ':uid' => $uid]);
        if ($rs) {
            $DB->exec("update pre_mail_log set status=1,used='$date' where type=2 and code=:code and mail=:mail", [':code' => $code, ':mail' => $mail]);
            $result = array("code" => 0, "msg" => "修改成功");
            exit(json_encode($result));
        } else {
            $result = array("code" => -1, "msg" => "修改失败");
            exit(json_encode($result));
        }
        break;
    case 'setToken':
        $token = md5($userrow['user'] . date('Ymd') . time() . rand(11111, 99999));
        if ($DB->exec("update pre_user set token=:token where id=:uid", [':token' => $token, ':uid' => $uid])) {
            $result = array("code" => 0, "token" => $token);
            exit(json_encode($result));
        } else {
            $result = array("code" => -1, "msg" => "重置失败");
            exit(json_encode($result));
        }
        break;
    case 'usekm':
        $km = trim(daddslashes($_POST['km']));
        $myrow = $DB->get_row("SELECT * FROM pre_km WHERE km=:km LIMIT 1", [':km' => $km]);
        if (!$myrow) {
            exit('{"code":-1,"msg":"此卡密不存在！"}');
        } elseif ($myrow['status'] == 1) {
            exit('{"code":-1,"msg":"此卡密已被使用！"}');
        }
        $num = $myrow['days'];
        switch ($myrow['type']) {
            case 0:
                if ($vip == 1) {
                    $DB->query("update pre_user set vip=date_add(vip,interval '$num' day) where id='$uid'");
                } else {
                    $vtime = date('Y-m-d H:i:s', strtotime("$date + $num day"));
                    $DB->exec("update pre_user set vip='$vtime' where id='$uid'");
                }
                $bz = '你使用卡密充值了' . $num . '天会员';
                $msg = '成功充值' . $num . '天会员！';
                break;
            case 1:
                $DB->exec("update pre_user set create_num=create_num+$num where id='$uid'");
                $bz = '你使用卡密充值了' . $num . '点短网址点数';
                $msg = '成功充值' . $num . '点短网址点数！';
                break;
            case 2:
                if ($userrow['trial_vip'] >= 1) {
                    exit('{"code":-1,"msg":"您已使用过会员试用卡密，不可再使用"}');
                }
                if ($vip == 1) {
                    $DB->exec("update pre_user set vip=date_add(vip,interval '$num' day),trial_vip=1 where id='$uid'");
                } else {
                    $vtime = date('Y-m-d H:i:s', strtotime("$date + $num day"));
                    $DB->exec("update pre_user set vip='$vtime' where id='$uid'");
                }
                $bz = '你使用会员试用卡密充值了' . $num . '天会员';
                $msg = '成功充值' . $num . '天会员！';
                break;
            case 3:
                if ($userrow['trial_create'] >= 1) {
                    exit('{"code":-1,"msg":"您已使用过额度试用卡密，不可再使用"}');
                }
                $DB->exec("update pre_user set create_num=create_num+$num,trial_create=1 where id='$uid'");
                $bz = '你使用额度试用卡密充值了' . $num . '点短网址点数';
                $msg = '成功充值' . $num . '点短网址点数！';
                break;
            default:
                exit('{"code":-1,"msg":"无效卡密！"}');
                break;
        }
        if ($DB->exec("UPDATE `pre_km` SET `status`=1 WHERE `id`='{$myrow['id']}'")) {
            $DB->exec("UPDATE `pre_km` SET `uid` ='$uid',`usetime` ='" . $date . "' WHERE `id`='{$myrow['id']}'");
            $rs = $DB->exec("insert into pre_points(uid,action,number,point,bz,addtime,status) values('$uid','卡密','$num',0,'$bz','$date',1)");
            if ($rs) {
                exit('{"code":0,"msg":"' . $msg . '"}');
            }
        }
        exit('{"code":-1,"msg":"充值失败"}');
        break;
    case 'recharge':
        $value = trim(daddslashes($_GET['value']));
        $num = trim(daddslashes($_GET['num']));
        if ($value == 1) {
            $name = '会员月卡';
            $money = $conf['vip_month'] * $num;
        } elseif ($value == 2) {
            $name = '会员季卡';
            $money = $conf['vip_quarter'] * $num;
        } elseif ($value == 3) {
            $name = '会员年卡';
            $money = $conf['vip_year'] * $num;
        } elseif ($value == 4) {
            $name = '短网址点数（100次）';
            if ($vip == 1) {
                $money = $conf['dwz_price'] * $num * $conf['discount'];
            } else {
                $money = $conf['dwz_price'] * $num;
            }
        } else {
            exit('{"code":-1,"msg":"提交订单失败！"}');
        }
        $trade_no = date("YmdHis") . rand(111, 999);
        $rs = $DB->exec("insert into pre_pay(trade_no,uid,num,name,money,ip,addtime,status) values('$trade_no','$uid',:num,'$name','$money','$clientip','$date',0)", [':num' => $num]);
        if ($rs) {
            exit('{"code":0,"msg":"提交订单成功！","trade_no":"' . $trade_no . '","money":"' . $money . '","name":"' . $name . '"}');
        } else {
            exit('{"code":-1,"msg":"提交订单失败！' . $DB->error() . '"}');
        }
        break;
    case 'urllist':
        $callback = $_GET['callback'];
        $kw = isset($_GET['kw']) ? trim(daddslashes($_GET['kw'])) : '';
        $grouping = isset($_GET['grouping']) ? trim(daddslashes($_GET['grouping'])) : 'all';
        if ($grouping == 'all') {
            $groups = " 1";
        } else {
            $groups = " (grouping='$grouping')";
        }
        if ($kw != '') {
            $sql = " (id like '%$kw%' or dwz like '%$kw%' or remarks like '%$kw%' or url like '%$kw%')";
        } else {
            $sql = "1";
        }
        $totle = $DB->getColumn("select count(*) from pre_url where({$sql} and{$groups} and uid='$uid' and deltime is null)");
        $pagesize = trim(daddslashes($_GET['limit']));
        $pages = ceil($totle / $pagesize);
        $page = isset($_GET['page']) ? trim(daddslashes($_GET['page'])) : 1;
        $offset = trim(daddslashes($_GET['offset']));
        $sort = isset($_GET['sort']) ? trim(daddslashes($_GET['sort'])) : 'addtime';
        $sortOrder = trim(daddslashes($_GET['sortOrder']));
        $rs = $DB->query("select * from pre_url where({$sql} and{$groups} and uid='$uid' and deltime is null) order by $sort $sortOrder limit $offset,$pagesize");
        $i = 0;
        $rows = array();
        $groupInfo = groupInfo();
        while ($res = $rs->fetch()) {
            $grouping = $groupInfo[$res['grouping']];
            $rows[$i] = array(
                'id' => $res['id'], 'dwz' => $res['dwz'], 'u_state' => $res['u_state'], 'remarks' => $res['remarks'],
                'view' => $res['view'], 'addtime' => $res['addtime'], 'url' => $res['url'],
                'lasttime' => $res['lasttime'], 'grouping' => $grouping
            );
            $i++;
        }
        $result = array('rows' => $rows, 'total' => $totle);
        exit($callback . '(' . json_encode($result) . ')');
        break;
    case 'glist':
        $callback = trim(daddslashes($_GET['callback']));
        $kw = isset($_GET['kw']) ? trim(daddslashes($_GET['kw'])) : '';
        if ($kw != '') {
            $sql = " (id like '%$kw%' or name like '%$kw%')";
        } else {
            $sql = "1";
        }
        $totle = $DB->getColumn("select count(*) from pre_group where({$sql} and uid='$uid')");
        $pagesize = trim(daddslashes($_GET['limit']));
        $pages = ceil($totle / $pagesize);
        $page = isset($_GET['page']) ? trim(daddslashes($_GET['page'])) : 1;
        $offset = trim(daddslashes($_GET['offset']));
        $sort = isset($_GET['sort']) ? trim(daddslashes($_GET['sort'])) : 'addtime';
        $sortOrder = trim(daddslashes($_GET['sortOrder']));
        $rs = $DB->query("select * from pre_group where({$sql} and uid='$uid') order by $sort $sortOrder limit $offset,$pagesize");
        $i = 0;
        $rows = array();
        while ($res = $rs->fetch()) {
            $rows[$i] = array(
                'id' => $res['id'], 'name' => $res['name'], 'addtime' => $res['addtime']
            );
            $i++;
        }
        $result = array('rows' => $rows, 'total' => $totle);
        exit($callback . '(' . json_encode($result) . ')');
        break;
    case 'addGroup':
        $name = trim(daddslashes($_POST['name']));
        if (($name == '')) {
            $result = array("code" => -1, "msg" => "分组名称不能为空");
            exit(json_encode($result));
        }
        if ($DB->getColumn("select count(1) from pre_group where name=:name and uid=:uid", [':name' => $name, ':uid' => $uid]) > 0) {
            $result = array("code" => -1, "msg" => "该名称已存在");
            exit(json_encode($result));
        }
        $rs = $DB->exec("insert into pre_group(name,uid,addtime) values(:name,:uid,'$date')", [':name' => $name, ':uid' => $uid]);
        if ($rs) {
            $result = array("code" => 0, "msg" => "添加成功");
            exit(json_encode($result));
        } else {
            $result = array("code" => -1, "msg" => "添加失败");
            exit(json_encode($result));
        }
        break;
    case 'getGroupInfo':
        $id = trim(daddslashes($_GET['id']));
        $res = $DB->get_row("select * from pre_group where id=:id and uid=:uid limit 1", [':id' => $id, ':uid' => $uid]);
        if ($res) {
            $result = array(
                "code" => 0,
                "id" => $id,
                "name" => $res['name']
            );
            exit(json_encode($result));
        } else {
            $result = array("code" => -1, "msg" => "分组信息不存在");
            exit(json_encode($result));
        }
        break;
    case 'upGroup':
        $id = trim(daddslashes($_POST['id']));
        if ($DB->getColumn("select count(1) from pre_group where id=:id and uid=:uid", [':id' => $id, ':uid' => $uid]) == 0) {
            $result = array("code" => -1, "msg" => "分组不存在");
            exit(json_encode($result));
        }
        $name = trim(daddslashes($_POST['name']));
        if ($name == '') {
            $result = array("code" => -1, "msg" => "分组名称不能为空");
            exit(json_encode($result));
        }
        if ($DB->getColumn("select count(1) from pre_group where uid=:uid and name=:name and id<>:id", [':uid' => $uid, ':name' => $name, ':id' => $id]) > 0) {
            $result = array("code" => -1, "msg" => "分组名称已存在");
            exit(json_encode($result));
        }
        $rs = $DB->exec("update pre_group set name=:name where id=:id and uid=:uid", [':name' => $name, ':id' => $id, ':uid' => $uid]);
        if ($rs) {
            $result = array("code" => 0, "msg" => "修改成功");
            exit(json_encode($result));
        } else {
            $result = array("code" => -1, "msg" => "修改失败");
            exit(json_encode($result));
        }
        break;
    case 'delGroupAll':
        $ids = explode('&', $_POST['str']);
        $i = 0;
        while ($i < count($ids)) {
            $id = trim(daddslashes($ids[$i]));
            $DB->query("delete from pre_group where id=:id and uid=:uid", [':id' => $id, ':uid' => $uid]);
            $i++;
        }
        $result = array("code" => 0, "msg" => "删除成功");
        exit(json_encode($result));
        break;
    case 'delGroup':
        $id = trim(daddslashes($_POST['id']));
        if ($DB->getColumn("select count(id) from pre_group where id=:id and uid=:uid", [':id' => $id, ':uid' => $uid]) == 0) {
            $result = array("code" => -1, "msg" => "分组不存在");
            exit(json_encode($result));
        }
        $rs = $DB->exec("delete from pre_group where id=:id", [':id' => $id]);
        if ($rs) {
            $result = array("code" => 0);
            exit(json_encode($result));
        } else {
            $result = array("code" => -1, "msg" => "删除失败");
            exit(json_encode($result));
        }
        break;
    case 'tranking':
        $num = (int)trim(daddslashes($_POST['num']));
        $t = date("Y-m-d");
        $rs = $DB->query("select urlid,pv,ip from pre_stat where uid='$uid' and date='$t' order by pv desc limit $num");
        $i = 0;
        $rows = array();
        while ($res = $rs->fetch()) {
            $rows[$i] = array(
                'urlid' => $res['urlid'], 'pv' => $res['pv'], 'ip' => $res['ip']
            );
            $i++;
        }
        $result = array('rows' => $rows);
        exit(json_encode($result));
        break;
    case 'yranking':
        $num = (int)trim(daddslashes($_POST['num']));
        $t = date("Y-m-d", strtotime("-1 day"));
        $rs = $DB->query("select urlid,pv,ip from pre_stat where uid='$uid' and date='$t' order by pv desc limit $num");
        $i = 0;
        $rows = array();
        while ($res = $rs->fetch()) {
            $rows[$i] = array(
                'urlid' => $res['urlid'], 'pv' => $res['pv'], 'ip' => $res['ip']
            );
            $i++;
        }
        $result = array('rows' => $rows);
        exit(json_encode($result));
        break;
    case 'getCode':
        $mail = trim(daddslashes($_POST['mail']));
        if ($mail == '') {
            $result = array("code" => -1, "msg" => "请填写新邮箱");
            exit(json_encode($result));
        }
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            exit(json_encode(['code' => -1, 'msg' => '请填写正确的邮箱'], JSON_UNESCAPED_UNICODE));
        }
        if ($mail == $userrow['mail']) {
            exit(json_encode(['code' => -1, 'msg' => '新邮箱与旧邮箱一样'], JSON_UNESCAPED_UNICODE));
        }
        $res = $DB->get_row("select mail from pre_user where mail=:mail limit 1", [':mail' => $mail]);
        if ($res) {
            exit(json_encode(['code' => -1, 'msg' => '该邮箱已被注册'], JSON_UNESCAPED_UNICODE));
        } else {
            $ip = real_ip();
            $code = rand(100000, 999999);
            if ($DB->get_row("select id from pre_mail_log where type=2 and ip='$ip' and addtime>=DATE_SUB(NOW(),INTERVAL 1 MINUTE);")) {
                exit(json_encode(['code' => -1, 'msg' => '已经获取过了，请一分钟后再重新获取'], JSON_UNESCAPED_UNICODE));
            }
            send_mail($mail, '操作验证码', regSendCode($code));
            $rs = $DB->exec("insert into pre_mail_log(addtime,code,ip,mail,type) values('$date','$code','$ip',:mail,2)", [':mail' => $mail]);
            if ($rs) {
                exit(json_encode(['code' => 0, 'msg' => '邮箱验证码发送成功'], JSON_UNESCAPED_UNICODE));
            } else {
                exit(json_encode(['code' => -1, 'msg' => '邮箱验证码发送失败'], JSON_UNESCAPED_UNICODE));
            }
        }
        break;
}
