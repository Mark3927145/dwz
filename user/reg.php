﻿<?php
include('../includes/common.php');
if ($conf['is_reg'] == 0) {
  exit("<script language='javascript'>alert('注册通道已关闭');history.go(-1);</script>");
}
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="utf-8" />
  <title>用户注册 | <?php echo $conf['web_name'] ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="https://lib.baomitu.com/twitter-bootstrap/3.0.0/css/bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="../static/user/css/style.css" type="text/css" />
  <script src="https://lib.baomitu.com/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://lib.baomitu.com/layer/3.1.1/layer.js"></script>
  <script src="https://ssl.captcha.qq.com/TCaptcha.js"></script>
  <style>
    .yzm {
      border-radius: 5px;
      -webkit-border-radius: 5px;
      border: 1px solid #eaeaea;
      box-shadow: none;
      font-size: 12px !important;
    }
  </style>
</head>

<body class="login-body">

  <div class="container">

    <form class="form-signin" method="post" action="#">
      <h2 class="form-signin-heading">用户注册</h2>
      <div class="login-wrap">
        <input type="text" name="user" id="user" class="form-control" placeholder="请输入账号" autofocus required />
        <input type="password" name="pwd" id="pwd" class="form-control" placeholder="请输入密码" required />
        <input type="password" name="pwds" id="pwds" class="form-control" placeholder="请再次输入密码" required />
        <input type="text" name="qq" id="qq" class="form-control" placeholder="请输入QQ" required />
        <input type="text" name="mail" id="mail" class="form-control" placeholder="请输入邮箱" required />
        <?php
        if ($conf['regMailCheck'] == 1) {
        ?>
          <div class="form-group">
            <div class="input-group">
              <input type="yzm" name="code" id="code" class="form-control yzm" placeholder="请输入验证码" required />
              <div class="input-group-btn">
                <input type="button" class="btn btn-default" onclick="getCode(this)" value="获取验证码">
              </div>
            </div>
          </div>
        <?php
        }
        ?>
        <label class="checkbox">
          <span class="pull-right" style="padding-bottom:15px"> <a href="./login.php"> 返回登录</a> |<a href="./findpwd.php"> 找回密码</a></span>
        </label>
        <button class="btn btn-lg btn-login btn-block" type="button" onClick="reg();return false;">注 册</button>
      </div>
    </form>
  </div>
</body>
<script>
  var nums = 60;
  var codeBtn;

  function getCode(btn) {
    var mail = $("#mail").val();
    if (mail == '') {
      layer.msg('请填写邮箱');
      return false;
    }
    $.ajax({
      url: "ajax2.php?act=getCode",
      type: "POST",
      data: {
        "mail": mail
      },
      dataType: "json",
      success: function(data) {
        if (data.code == 0) {
          layer.msg(data.msg);
          codeBtn = btn;
          codeBtn.disabled = true;
          codeBtn.value = nums + 'S';
          clock = setInterval(doLoop, 1000);
        } else {
          layer.msg(data.msg);
          return false;
        }
      },
      error: function(data) {
        layer.msg('服务器错误');
        return false;
      }
    });
  }

  function doLoop() {
    nums--;
    if (nums > 0) {
      codeBtn.value = nums + 'S';
    } else {
      clearInterval(clock);
      codeBtn.disabled = false;
      codeBtn.value = '获取验证码';
      nums = 60;
    }
  }

  function reg() {
    var user = $('#user').val();
    var pwd = $('#pwd').val();
    var pwds = $('#pwds').val();
    var qq = $('#qq').val();
    var mail = $('#mail').val();
    var code = $('#code').val();
    if (user == '') {
      layer.alert('请填写账号');
      return false;
    }
    if (pwd == '') {
      layer.alert('请填写密码');
      return false;
    }
    if (pwds == '') {
      layer.alert('请再次输入密码');
      return false;
    }
    if (pwd != pwds) {
      layer.alert('俩次输入的密码不一致');
      return false;
    }
    if (qq == '') {
      layer.alert('请填写qq');
      return false;
    }
    if (mail == '') {
      layer.msg('请填写邮箱');
      return false;
    }
    <?php
    if ($conf['captcha_reg'] == 1) {
    ?>
      var captcha1 = new TencentCaptcha('<?php echo $conf['CaptchaAppId'] ?>', function(res) {
        if (res.ret === 0) {
          $.ajax({
            url: "ajax2.php?act=reg",
            type: "POST",
            data: {
              "user": user,
              "pwd": pwd,
              "pwds": pwds,
              "qq": qq,
              "mail": mail,
              "code": code,
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
        url: "ajax2.php?act=reg",
        type: "POST",
        data: {
          "user": user,
          "pwd": pwd,
          "pwds": pwds,
          "qq": qq,
          "mail": mail,
          "code": code
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
      reg();
    }
  }
</script>

</html>