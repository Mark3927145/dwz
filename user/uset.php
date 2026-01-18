<?php
include("../includes/common.php");
if ($islogin2 == 1) {
} else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>

<?php
$mod = isset($_GET['mod']) ? $_GET['mod'] : null;
if ($mod == 'user') {
    $title = '资料修改';
} elseif ($mod == 'setMail') {
    $title = '更改邮箱';
} else {
    $title = '对接设置';
}
include 'head.php';
?>
<section id="main-content">
    <section class="wrapper">
        <?php
        if ($mod == 'user') {
        ?>
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            用户资料设置
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">ＱＱ</label>
                                    <div class="col-sm-10"><input type="text" name="qq" id="qq" value="<?php echo $userrow['qq']; ?>" class="form-control" placeholder="用于联系与找回密码" /></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">昵称</label>
                                    <div class="col-sm-10"><input type="text" name="name" id="name" value="<?php echo $userrow['name']; ?>" class="form-control" placeholder="用于联系与找回密码" /></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">默认短链</label>
                                    <div class="col-sm-10"><select name="dwz_type" id="dwz_type" class="form-control">
                                            <?php
                                            echo dwzList();
                                            ?>
                                        </select></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">重置密码</label>
                                    <div class="col-sm-10"><input type="text" name="pwd" id="pwd" value="" class="form-control" placeholder="不修改请留空" /></div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-danger" type="button" onclick="updateUser()">确认修改</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        <?php
        } elseif ($mod == 'setMail') {
        ?>
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            更改邮箱绑定
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">旧邮箱</label>
                                    <div class="col-sm-10"><input type="text" name="mail" id="mail" value="<?php echo $userrow['mail']; ?>" class="form-control" readonly /></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">新邮箱</label>
                                    <div class="col-sm-10"><input type="text" name="newMail" id="newMail" class="form-control" placeholder="请输入新邮箱" /></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">验证码</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <input type="text" name="code" id="code" class="form-control" placeholder="请输入验证码" />
                                            <div class="input-group-btn">
                                                <input type="button" class="btn btn-default" onclick="getCode(this)" value="获取验证码">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-danger" type="button" onclick="updateMail()">确认修改</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        <?php
        } elseif ($mod == 'token') {
        ?>
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            用户token设置
                        </header>
                        <?php
                        if ($userrow['token'] == '') {
                            $token = md5($userrow['user'] . date('Ymd') . time() . rand(11111, 99999));
                            $DB->query("update pre_user set token = '$token' where id='$uid'");
                        } else {
                            $token = $userrow['token'];
                        }
                        if ($conf['is_https'] == 1) {
                            $http = 'https';
                        } else {
                            $http = 'http';
                        }
                        $type = $userrow['dwz_type'] == '' ? $conf['dwz_type'] : $userrow['dwz_type'];
                        ?>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">token:</label>
                                    <div class="col-sm-10"><input type="text" name="token" id="token" value="<?php echo $token; ?>" onclick="msg()" data-clipboard-text="<?php echo $token; ?>" class="form-control clipboard" readonly /></div>
                                </div><br />
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-danger" type="button" onclick="setToken()">重置</button>
                                        <button class="btn btn-success clipboard" type="button" onclick="msg()" data-clipboard-target="#token">复制</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                    <section class="panel">
                        <header class="panel-heading">
                            对接文档
                        </header>
                        <div class="panel-body">
                            <h3>生成短网址</h3>
                            <p>请求地址:<?php echo $http . '://' . $conf['domain'] . '/api/url.php' ?></p>
                            <p>请求方式:get/post</p>
                            <p>请求示例:<?php echo $http . '://' . $conf['domain'] . '/api/url.php?type=' . $type . '&pattern=1&token=' . $token . '&url=https://www.baidu.com' ?></p>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td>参数</td>
                                        <td>是否必须</td>
                                        <td>说明</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>url</td>
                                        <td>是</td>
                                        <td>需要缩短的长网址</td>
                                    </tr>
                                    <tr>
                                        <td>type</td>
                                        <td>否</td>
                                        <td>短网址类型，默认<?php echo $type ?>，suiji则随机短网址类型</td>
                                    </tr>
                                    <tr>
                                        <td>token</td>
                                        <td>是</td>
                                        <td>用户token</td>
                                    </tr>
                                    <tr>
                                        <td>bz</td>
                                        <td>否</td>
                                        <td>网址备注</td>
                                    </tr>
                                    <tr>
                                        <td>pwd</td>
                                        <td>否</td>
                                        <td>访问密码</td>
                                    </tr>
                                    <tr>
                                        <td>visit</td>
                                        <td>否</td>
                                        <td>限制访问次数</td>
                                    </tr>
                                    <tr>
                                        <td>visiturl</td>
                                        <td>否</td>
                                        <td>超过访问次数后访问网址</td>
                                    </tr>
                                </tbody>
                            </table>

                            <h3>查询剩余短网址点数</h3>
                            <p>请求地址:<?php echo $http . '://' . $conf['domain'] . '/api/quota.php' ?></p>
                            <p>请求方式:get/post</p>
                            <p>请求示例:<?php echo $http . '://' . $conf['domain'] . '/api/quota.php?token=' . $token ?></p>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td>参数</td>
                                        <td>是否必须</td>
                                        <td>说明</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>token</td>
                                        <td>是</td>
                                        <td>用户token</td>
                                    </tr>
                                </tbody>
                            </table>

                            <h3>修改短网址跳转网址</h3>
                            <p>请求地址:<?php echo $http . '://' . $conf['domain'] . '/api/upurl.php' ?></p>
                            <p>请求方式:get/post</p>
                            <p>请求示例:<?php echo $http . '://' . $conf['domain'] . '/api/upurl.php?token=' . $token ?>&dwz=https://dwz.com&url=https://www.baidu.com</p>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td>参数</td>
                                        <td>是否必须</td>
                                        <td>说明</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>token</td>
                                        <td>是</td>
                                        <td>用户token</td>
                                    </tr>
                                    <tr>
                                        <td>dwz</td>
                                        <td>是</td>
                                        <td>短网址</td>
                                    </tr>
                                    <tr>
                                        <td>url</td>
                                        <td>是</td>
                                        <td>修改的网址</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </div>
        <?php
        }
        ?>
    </section>
</section>
<script src="../static/user/js/common-scripts.js"></script>
<script>
    var nums = 60;
    var codeBtn;

    function getCode(btn) {
        var newMail = $("#newMail").val();
        if (newMail == '') {
            layer.msg('请填写新邮箱');
            return false;
        }
        $.ajax({
            url: "ajax.php?act=getCode",
            type: "POST",
            data: {
                "mail": newMail
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

    $(document).ready(function() {
        new ClipboardJS('.clipboard');
    });

    function updateUser() {
        qq = $('#qq').val();
        name = $('#name').val();
        pattern = $('#pattern').val();
        dwz_type = $('#dwz_type').val();
        pwd = $('#pwd').val();
        $.ajax({
            url: "ajax.php?act=upUser",
            type: "POST",
            data: {
                "qq": qq,
                "name": name,
                "pattern": pattern,
                "dwz_type": dwz_type,
                "pwd": pwd,
            },
            dataType: "json",
            success: function(data) {
                if (data.code == 0) {
                    layer.msg('修改成功');
                    setTimeout(function() {
                        window.location.reload();
                    }, 1 * 1000);
                } else {
                    layer.alert(data.msg);
                }
            },
            error: function(data) {
                layer.msg('服务器错误');
                return false;
            }
        });
    }

    function updateMail() {
        code = $('#code').val();
        newMail = $('#newMail').val();
        $.ajax({
            url: "ajax.php?act=updateMail",
            type: "POST",
            data: {
                "code": code,
                "mail": newMail
            },
            dataType: "json",
            success: function(data) {
                if (data.code == 0) {
                    layer.msg('修改成功');
                    setTimeout(function() {
                        window.location.reload();
                    }, 1 * 1000);
                } else {
                    layer.alert(data.msg);
                }
            },
            error: function(data) {
                layer.msg('服务器错误');
                return false;
            }
        });
    }

    function setToken() {
        layer.confirm('您确定要重置token吗？重置后之前的token将无法使用', {
            btn: ['确定', '取消']
        }, function() {
            $.ajax({
                url: "ajax.php?act=setToken",
                type: "POST",
                dataType: "json",
                success: function(data) {
                    if (data.code == 0) {
                        layer.msg('重置成功');
                        $("#token").val(data.token);
                    } else {
                        layer.alert(data.msg);
                    }
                },
                error: function(data) {
                    layer.msg('服务器错误');
                    return false;
                }
            });
        })
    }

    function msg() {
        layer.msg('复制成功')
    }
</script>