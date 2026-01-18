<?php
if (!defined('IN_CRONLITE')) exit();

$clientip = real_ip();

if (isset($_COOKIE["admin_token"])) {
	$token = authcode(daddslashes($_COOKIE['admin_token']), 'DECODE', SYS_KEY);
	list($user, $sid) = explode("\t", $token);
	$session = md5($conf['admin_user'] . $conf['admin_pwd'] . $password_hash);
	if ($session === $sid) {
		$islogin = 1;
	}
}

if (isset($_COOKIE["user_token"])) {
	$token = authcode(daddslashes($_COOKIE['user_token']), 'DECODE', SYS_KEY);
	list($uid, $sid) = explode("\t", $token);
	$userrs = $DB->query("select * from pre_user where id=:id limit 1", [":id" => intval($uid)]);
	if ($userrow = $userrs->fetch()) {
		$session = md5($userrow['user'] . $userrow['pwd'] . $password_hash);
		if ($session == $sid && $userrow['state'] == 1) {
			$islogin2 = 1;
			$uid = $userrow['id'];
			$vip = $userrow['vip'] > $date ? 1 : 0;
		}
	}
}
