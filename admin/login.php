<?php
$verifycode = 1; //验证码开关
if (!function_exists("imagecreate") || !file_exists('code.php')) $verifycode = 0;
include("../includes/common.php");
if (isset($_POST['user']) && isset($_POST['pass'])) {
  $user = trim(daddslashes($_POST['user']));
  $pass = trim(daddslashes($_POST['pass']));
  $code = trim(daddslashes($_POST['code']));
  $rememberme = trim(daddslashes($_POST['rememberme']));
  if ($verifycode == 1 && (!$code || strtolower($code) != $_SESSION['vc_code'])) {
    unset($_SESSION['vc_code']);
    @header('Content-Type: text/html; charset=UTF-8');
    exit("<script language='javascript'>alert('验证码错误！');history.go(-1);</script>");
  } elseif ($user === $conf['admin_user'] && $pass === $conf['admin_pwd']) {
    unset($_SESSION['vc_code']);
    $session = md5($user . $pass . $password_hash);
    $token = authcode("{$user}\t{$session}", 'ENCODE', SYS_KEY);
    if ($rememberme) {
      setcookie("admin_token", $token, time() + 604800);
    } else {
      setcookie("admin_token", $token, time() + 259200);
    }
    saveSetting('adminlogin', $date);
    log_result('后台登录', 'ip:' . $clientip, '登录成功');
    @header('Content-Type: text/html; charset=UTF-8');
    exit("<script language='javascript'>alert('登陆管理中心成功！');window.location.href='./';</script>");
  } else {
    unset($_SESSION['vc_code']);
    @header('Content-Type: text/html; charset=UTF-8');
    exit("<script language='javascript'>alert('用户名或密码不正确！');history.go(-1);</script>");
  }
} elseif (isset($_GET['logout'])) {
  setcookie("admin_token");
  @header('Content-Type: text/html; charset=UTF-8');
  exit("<script language='javascript'>alert('您已成功注销本次登陆！');window.location.href='./login.php';</script>");
} elseif ($islogin == 1) {
  @header('Content-Type: text/html; charset=UTF-8');
  exit("<script language='javascript'>alert('您已登陆！');window.location.href='./';</script>");
}
?>

<!DOCTYPE html>
<html lang="zh">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
  <title>后台登录 - 短网址管理系统</title>
  <link rel="icon" href="favicon.ico" type="image/ico">
  <link href="../static/admin/css/bootstrap.min.css" rel="stylesheet">
  <link href="../static/admin/css/materialdesignicons.min.css" rel="stylesheet">
  <link href="../static/admin/css/style.min.css" rel="stylesheet">
  <style>
    .login-form .has-feedback {
      position: relative;
    }

    .login-form .has-feedback .form-control {
      padding-left: 36px;
    }

    .login-form .has-feedback .mdi {
      position: absolute;
      top: 0;
      left: 0;
      right: auto;
      width: 36px;
      height: 36px;
      line-height: 36px;
      z-index: 4;
      color: #dcdcdc;
      display: block;
      text-align: center;
      pointer-events: none;
    }

    .login-form .has-feedback.row .mdi {
      left: 15px;
    }
  </style>
</head>

<body class="center-vh" style="background-image: url(images/login-bg-2.jpg); background-size: cover;">
  <div class="card card-shadowed p-5 w-420 mb-0 mr-2 ml-2">
    <div class="text-center mb-3">
      <a href="#"> <img alt="后台登录" src="../static/admin/images/logo-sidebar.png"> </a>
    </div>

    <form action="#!" method="post" class="login-form">
      <div class="form-group has-feedback">
        <span class="mdi mdi-account" aria-hidden="true"></span>
        <input type="text" class="form-control" name="user" id="user" placeholder="用户名" required>
      </div>

      <div class="form-group has-feedback">
        <span class="mdi mdi-lock" aria-hidden="true"></span>
        <input type="password" class="form-control" name="pass" id="pass" placeholder="密码" required>
      </div>

      <?php if ($verifycode == 1) { ?>
        <div class="form-group has-feedback row">
          <div class="col-7">
            <span class="mdi mdi-check-all form-control-feedback" aria-hidden="true"></span>
            <input type="text" name="code" class="form-control" placeholder="验证码" required>
          </div>
          <div class="col-5 text-right">
            <img src="./code.php?r=<?php echo time(); ?>" class="pull-right" id="captcha" style="cursor: pointer;" onclick="this.src='./code.php?r='+Math.random();" title="点击刷新" alt="captcha">
          </div>
        </div>
      <?php } ?>

      <div class="form-group">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="rememberme" name="rememberme" checked>
          <label class="custom-control-label not-user-select" for="rememberme">7天内自动登录</label>
        </div>
      </div>

      <div class="form-group">
        <button class="btn btn-block btn-primary" type="submit">立即登录</button>
      </div>
    </form>

    <p class="text-center text-muted mb-0">Copyright © 2019-2021 <a href="#"><?php echo $conf['web_name'] ?></a>. All right reserved</p>
  </div>

  <script type="text/javascript" src="../static/admin/js/jquery.min.js"></script>
  <script type="text/javascript">
    if (window.top != window.self) {
      window.top.location.href = window.self.location.href;
    }
  </script>
</body>

</html>