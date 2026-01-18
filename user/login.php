﻿<?php
include('../includes/common.php');
$my = (isset($_GET['my']) ? trim(daddslashes($_GET['my'])) : NULL);

if ($my == 'logout') {
  setcookie("user_token", "", time() - 604800, '/');
  @header('Content-Type: text/html; charset=UTF-8');
  exit("<script language='javascript'>alert('您已成功注销本次登陆！');window.location.href='./login.php';</script>");
}
if ($islogin2 == 1) {
  @header('Content-Type: text/html; charset=UTF-8');
  exit("<script language='javascript'>alert('您已登陆！');window.location.href='./';</script>");
}
?>


<!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="utf-8" />
  <title>登录 | <?php echo $conf['web_name'] ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="https://lib.baomitu.com/twitter-bootstrap/3.0.0/css/bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="../static/user/css/style.css" type="text/css" />
  <script src="https://lib.baomitu.com/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://lib.baomitu.com/layer/3.1.1/layer.js"></script>
  <script src="https://ssl.captcha.qq.com/TCaptcha.js"></script>
</head>

<body class="login-body">
  <div class="container">
    <form class="form-signin" method="post" action="#">
      <h2 class="form-signin-heading">用户登录</h2>
      <div class="login-wrap">
        <input type="text" name="user" id="user" class="form-control" placeholder="账号" autofocus required />
        <input type="password" name="pwd" id="pwd" class="form-control" placeholder="密码" required />
        <label class="checkbox">
          <span class="pull-right" style="padding-bottom:15px"> <a href="./reg.php"> 注册账号</a> |<a href="./findpwd.php"> 找回密码</a></span>
        </label>
        <button class="btn btn-lg btn-login btn-block" type="button" onClick="login();return false;">登 录</button>
      </div>
    </form>
  </div>
</body>
<script>
  function login() {
    var user = $('#user').val();
    var pwd = $('#pwd').val();
    if (user == '') {
      layer.alert('请填写账号');
      return false;
    }
    if (pwd == '') {
      layer.alert('请填写密码');
      return false;
    }
    <?php
    if ($conf['captcha_login'] == 1) {
    ?>
      var captcha1 = new TencentCaptcha('<?php echo $conf['CaptchaAppId'] ?>', function(res) {
        if (res.ret === 0) {
          $.ajax({
            url: "ajax2.php?act=login",
            type: "POST",
            data: {
              "user": user,
              "pwd": pwd,
              "ticket": res.ticket,
              "randstr": res.randstr
            },
            dataType: "json",
            success: function(data) {
              if (data.code == 0) {
                layer.confirm(data.msg, {
                  btn: ['确定']
                }, function() {
                  window.location.href = './index.php';
                });
              } else {
                layer.alert(data.msg);
                return false;
              }
            },
            error: function(data) {
              layer.msg('服务器错误');
              return false;
            }
          });
        }
      });
      captcha1.show();
    <?php
    } else {
    ?>
      $.ajax({
        url: "ajax2.php?act=login",
        type: "POST",
        data: {
          "user": user,
          "pwd": pwd
        },
        dataType: "json",
        success: function(data) {
          if (data.code == 0) {
            layer.confirm(data.msg, {
              btn: ['确定']
            }, function() {
              window.location.href = './index.php';
            });
          } else {
            layer.alert(data.msg);
            return false;
          }
        },
        error: function(data) {
          layer.msg('服务器错误');
          return false;
        }
      });
    <?php
    }
    ?>
  }

  document.onkeydown = keyListener;

  function keyListener(e) {
    if (e.keyCode == 13) {
      login();
    }
  }
</script>

</html>