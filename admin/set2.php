<?php
include('../includes/common.php');
if ($islogin != 1) {
    exit('<script language=\'javascript\'>window.location.href=\'./login.php\';</script>');
}
$match = rand(1, 50);
$mod = isset($_GET['mod']) ? $_GET['mod'] : null;
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>网站设置</title>
    <link rel="icon" href="favicon.ico" type="image/ico">
    <link href="../static/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="../static/admin/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="../static/admin/js/jquery-confirm/jquery-confirm.min.css" rel="stylesheet">
    <link href="../static/admin/css/animate.min.css" rel="stylesheet">
    <link href="../static/admin/css/style.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid p-t-15">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <?php
                    if ($mod == 'setLogo') {
                    ?>
                        <div class="card-header">
                            <div class="card-title">更改首页logo</div>
                            <div class="block-options pull-right"><a href="set2.php?mod=setBg">更改背景图</a></div>
                        </div>
                        <div class="card-body">
                            <form action="#" method="post" role="form" enctype="multipart/form-data">
                                <input type="file" name="file-logo" id="file-logo">
                                <br>
                                <button type="submit" id="submit-logo" class="btn btn-primary btn-block">提交</button>
                            </form>
                            <br>
                            <p>现在的logo：</p>
                            <img src="../static/picture/logo.png?<?php echo $match ?>" class="img-responsive" alt="">
                        </div>
                    <?php
                    } elseif ($mod == 'setBg') {
                    ?>
                        <div class="card-header">
                            <div class="card-title">更改首页背景图</div>
                            <div class="block-options pull-right"><a href="set2.php?mod=setLogo">更改LOGO</a></div>
                        </div>
                        <div class="card-body">
                            <form action="set-style.php" method="post" role="form" enctype="multipart/form-data">
                                <input type="file" name="file-bg" id="file-bg">
                                <br>
                                <button type="submit" id="submit-bg" class="btn btn-primary btn-block">提交</button>
                            </form>
                            <br>
                            <p>现在的logo：</p>
                            <img src="../static/picture/bg.png?<?php echo $match ?>" class="img-responsive" alt="">
                        </div>
                    <?php
                    } elseif ($mod == 'cron') {
                    ?>
                        <div class="card-header">
                            <div class="card-title">计划任务配置</div>
                        </div>
                        <div class="card-body">
                            <form name="cron" action="ajax.php?act=setCron" class="edit-form">
                                <div class="form-group">
                                    <label for="cronkey">监控秘钥</label>
                                    <input class="form-control" type="text" id="cronkey" name="cronkey" value="<?php echo $conf['cronkey'] ?>" placeholder="请输入监控秘钥" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary m-r-5 ajax-post" target-form="cron">修 改</button>
                                </div>
                            </form>
                        </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">计划任务列表</div>
                    </div>
                    <div class="card-body">
                        <p>请按自己的需要监控以下网址。只能在一个地方监控，千万不要多节点监控或在多处监控，否则会导致数据错乱！</p>
                        <p>每日数据库维护（每天0点后执行）：</p>
                        <li class="list-group-item"><?php echo 'http://' . $conf['domain'] . '/cron.php?do=daily&key=' . $conf['cronkey'] ?></li>
                        </br />
                        <p>会员不足三天到期提醒（1小时一次）：</p>
                        <li class="list-group-item"><?php echo 'http://' . $conf['domain'] . '/cron.php?do=vipcheck&key=' . $conf['cronkey'] ?></li>
                        </br />
                        <p>IP记录清理,这个很重要，一定要监控（每天0点后执行一次）：</p>
                        <li class="list-group-item"><?php echo 'http://' . $conf['domain'] . '/cron.php?do=cleanData&key=' . $conf['cronkey'] ?></li>
                        </br />
                        <p>清理七天前访客记录（每天0点后执行一次）：</p>
                        <li class="list-group-item"><?php echo 'http://' . $conf['domain'] . '/cron.php?do=cleanVisitors&key=' . $conf['cronkey'] ?></li>
                        </br />
                        <p>清理游客生成超过七天的链接（不想清理就不要监控这一条，每天0点后执行一次）：</p>
                        <li class="list-group-item"><?php echo 'http://' . $conf['domain'] . '/cron.php?do=cleanUrl&key=' . $conf['cronkey'] ?></li>
                    </div>
                <?php
                    } elseif ($mod == 'clean') {
                ?>
                    <div class="card-header">
                        <div class="card-title">系统数据清理</div>
                    </div>
                    <div class="card-body">
                        <a href="ajax.php?act=cleanCache" class="btn btn-block btn-warning ajax-get confirm no-refresh">清理设置缓存</a><br />
                        <a href="ajax.php?act=cleanvisitors" class="btn btn-block btn-warning ajax-get confirm no-refresh">删除7天前访客记录</a><br />
                        <a href="ajax.php?act=cleanurl" class="btn btn-block btn-warning ajax-get confirm no-refresh">删除7天前无访问链接</a><br />
                        <a href="ajax.php?act=cleanuser1" class="btn btn-block btn-warning ajax-get confirm no-refresh">删除7天前从未登录用户</a><br />
                        <a href="ajax.php?act=cleanmodify" class="btn btn-block btn-warning ajax-get confirm no-refresh">删除7天前修改记录</a><br />
                        <a href="ajax.php?act=cleanurl5" class="btn btn-block btn-warning ajax-get confirm no-refresh">删除7天前游客链接</a><br />
                        <a href="ajax.php?act=cleanurl3" class="btn btn-block btn-warning ajax-get confirm no-refresh">清理7天前回收站网址</a><br />
                        <a href="ajax.php?act=cleancheck" class="btn btn-block btn-warning ajax-get confirm no-refresh">清理7天前未执行监控</a><br />
                        <a href="ajax.php?act=cleanuser2" class="btn btn-block btn-warning ajax-get confirm no-refresh">删除30天前未登录用户</a><br />
                        <a href="ajax.php?act=cleanpoints" class="btn btn-block btn-warning ajax-get confirm no-refresh">删除30天前收支明细</a><br />
                        <h4>自定义清理：</h4>
                        <form name="cleanurl2" action="ajax.php?act=cleanurl2" class="edit-form">
                            <b>跳转链接</b>：
                            <input type="number" name="days" value="" placeholder="天数" required />天前，访问次数小于等于
                            <input type="number" name="view" value="" placeholder="访问" required />次的网址&nbsp;
                            <button type="submit" class="btn btn-danger m-r-3 ajax-post confirm" target-form="cleanurl2">立即清理</button>
                        </form><br />
                        <form name="cleanurl4" action="ajax.php?act=cleanurl4" class="edit-form">
                            <input type="number" name="days" value="" placeholder="天数" required />天前未访问网址
                            <button type="submit" class="btn btn-danger m-r-3 ajax-post confirm" target-form="cleanurl4">立即清理</button>
                        </form><br />
                        <form name="cleanuser3" action="ajax.php?act=cleanuser3" class="edit-form">
                            <b>网站用户</b>：
                            超过<input type="number" name="days" value="" placeholder="天数" required />天未登录的用户&nbsp;
                            <button type="submit" class="btn btn-danger m-r-3 ajax-post confirm" target-form="cleanuser3">立即清理</button>
                        </form><br />
                        <div class="panel-footer">
                            <span class="mdi mdi-information"></span>
                            定期清理数据有助于提升网站访问速度;用户清理不会清理vip用户
                        </div>
                    </div>
                <?php
                    } elseif ($mod == 'update') {
                        function zipExtract($src, $dest)
                        {
                            $zip = new ZipArchive();
                            if ($zip->open($src) === true) {
                                $zip->extractTo($dest);
                                $zip->close();
                                return true;
                            }
                            return false;
                        }
                        function deldir($dir)
                        {
                            if (!is_dir($dir)) return false;
                            $dh = opendir($dir);
                            while ($file = readdir($dh)) {
                                if ($file != "." && $file != "..") {
                                    $fullpath = $dir . "/" . $file;
                                    if (!is_dir($fullpath)) {
                                        unlink($fullpath);
                                    } else {
                                        deldir($fullpath);
                                    }
                                }
                            }
                            closedir($dh);
                            if (rmdir($dir)) {
                                return true;
                            } else {
                                return false;
                            }
                        }

                        $scriptpath = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
                        $scriptpath = substr($scriptpath, 0, strrpos($scriptpath, '/'));
                        $admin_path = substr($scriptpath, strrpos($scriptpath, '/') + 1);
                ?>
                    <div class="card-header">
                        <div class="card-title">检测版本更新</div>
                    </div>
                    <div class="card-body">
                        <?php
                        $act = isset($_GET['act']) ? $_GET['act'] : null;
                        switch ($act) {
                            default:
                                $res = update_version();
                                if (!$res['msg']) $res['msg'] = '啊哦，更新服务器开小差了，请刷新此页面。';
                                echo '<div class="alert alert-info">' . $res['msg'] . '</div>';
                                echo '<hr/>';

                                if ($res['code'] == 1) {
                                    if (!class_exists('ZipArchive') || defined("SAE_ACCESSKEY") || defined("BAE_ENV_APPID")) {
                                        echo '您的空间不支持自动更新，请手动下载更新包并覆盖到程序根目录！<br/>
更新包下载：<a href="' . $res['file'] . '" class="btn btn-primary">点击下载</a>';
                                    } else {
                                        echo '<a href="set2.php?act=do&mod=update" class="btn btn-primary btn-block">立即更新到最新版本</a>';
                                    }

                                    echo '<hr/><div class="well">' . $res['uplog'] . '</div>';
                                }
                                break;
                            case 'do':
                                $res = update_version();
                                $RemoteFile = $res['file'];
                                $ZipFile = "Archive.zip";
                                copy($RemoteFile, $ZipFile) or die("无法下载更新包文件！" . '<a href="set2.php?mod=update">返回上级</a>');
                                if (zipExtract($ZipFile, ROOT)) {
                                    if ($admin_path != 'admin') {
                                        deldir(ROOT . $admin_path);
                                        rename(ROOT . 'admin', ROOT . $admin_path);
                                    }
                                    if (function_exists("opcache_reset")) @opcache_reset();
                                    if (!empty($res['sql'])) {
                                        $sql = $res['sql'];
                                        $t = 0;
                                        $e = 0;
                                        $error = '';
                                        for ($i = 0; $i < count($sql); $i++) {
                                            if (trim($sql[$i]) == '') continue;
                                            if ($DB->query($sql[$i])) {
                                                ++$t;
                                            } else {
                                                ++$e;
                                                $error .= $DB->error() . '<br/>';
                                            }
                                        }
                                        $addstr = '<br/>数据库更新成功。SQL成功' . $t . '句/失败' . $e . '句';
                                    }
                                    echo "程序更新成功！" . $addstr . "<br>";
                                    echo '<a href="./">返回首页</a>';
                                    unlink($ZipFile);
                                } else {
                                    echo "无法解压文件！<br>";
                                    echo '<a href="set2.php?mod=update">返回上级</a>';
                                    if (file_exists($ZipFile))
                                        unlink($ZipFile);
                                }
                                break;
                        }
                        ?>
                    </div>
                <?php
                    }
                ?>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../static/admin/js/jquery.min.js"></script>
    <script type="text/javascript" src="../static/admin/js/popper.min.js"></script>
    <script type="text/javascript" src="../static/admin/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../static/admin/js/lyear-loading.js"></script>
    <script type="text/javascript" src="../static/admin/js/bootstrap-notify.min.js"></script>
    <script type="text/javascript" src="../static/admin/js/jquery-confirm/jquery-confirm.min.js"></script>
    <script src="https://lib.baomitu.com/layer/3.1.1/layer.js"></script>
    <script type="text/javascript" src="../static/admin/js/main.min.js"></script>
    <script>
        $(function() {
            $('#submit-bg').click(function() {
                var fd = new FormData();
                fd.append("file", $('#file-bg')[0].files[0]);
                $.ajax({
                    type: "post",
                    url: "ajax.php?act=setBg",
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    data: fd,
                    success: function(data) {
                        if (data.code == 0) {
                            layer.msg('修改成功');
                            setTimeout(function() {
                                window.location.reload();
                            }, 1 * 1000);
                        } else {
                            layer.msg(data.msg);
                        }
                    },
                    error: function(a) {
                        layer.msg('修改失败');
                    }
                });
                return false;
            });
            $('#submit-logo').click(function() {
                var fd = new FormData();
                fd.append("file", $('#file-logo')[0].files[0]);
                $.ajax({
                    type: "post",
                    url: "ajax.php?act=setLogo",
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    data: fd,
                    success: function(data) {
                        if (data.code == 0) {
                            layer.msg('修改成功');
                            setTimeout(function() {
                                window.location.reload();
                            }, 1 * 1000);
                        } else {
                            layer.msg(data.msg);
                        }
                    },
                    error: function(a) {
                        layer.msg('修改失败');
                    }
                });
                return false;
            });


            jQuery(document).delegate('.ajax-post', 'click', function() {
                var self = jQuery(this),
                    tips = self.data('tips'),
                    ajax_url = self.attr("href") || self.data("url");
                var target_form = self.attr('target-form');
                var text = self.data('tips');
                var form = jQuery('form[name="' + target_form + '"]');

                if (form.length == 0) {
                    form = jQuery('.' + target_form);
                }

                var form_data = form.serialize();
                if ('submit' == self.attr('type') || ajax_url) {
                    if (void 0 == form.get(0)) return false;

                    if ('FORM' == form.get(0).nodeName) {
                        ajax_url = ajax_url || form.get(0).action;

                        if (self.hasClass('confirm')) {
                            $.confirm({
                                title: '',
                                content: tips || '确认要执行该操作吗？',
                                type: 'orange',
                                typeAnimated: true,
                                buttons: {
                                    confirm: {
                                        text: '确认',
                                        btnClass: 'btn-blue',
                                        action: function() {
                                            var loader = $('body').lyearloading({
                                                opacity: 0.2,
                                                spinnerSize: 'lg'
                                            });
                                            self.attr('autocomplete', 'off').prop('disabled', true);
                                            ajaxPostFun(self, ajax_url, form_data, loader);
                                        }
                                    },
                                    cancel: {
                                        text: '取消',
                                        action: function() {}
                                    }
                                }
                            });
                            return false;
                        } else {
                            self.attr("autocomplete", "off").prop("disabled", true);
                        }
                    } else if ('INPUT' == form.get(0).nodeName || 'SELECT' == form.get(0).nodeName || 'TEXTAREA' == form.get(0).nodeName) {
                        if (form.get(0).type == 'checkbox' && form_data == '') {
                            showNotify('请选择您要操作的数据', 'danger');
                            return false;
                        }

                        if (self.hasClass('confirm')) {
                            $.confirm({
                                title: '',
                                content: tips || '确认要执行该操作吗？',
                                type: 'orange',
                                typeAnimated: true,
                                buttons: {
                                    confirm: {
                                        text: '确认',
                                        btnClass: 'btn-blue',
                                        action: function() {
                                            var loader = $('body').lyearloading({
                                                opacity: 0.2,
                                                spinnerSize: 'lg'
                                            });
                                            self.attr('autocomplete', 'off').prop('disabled', true);

                                            ajaxPostFun(self, ajax_url, form_data, loader);
                                        }
                                    },
                                    cancel: {
                                        text: '取消',
                                        action: function() {}
                                    }
                                }
                            });
                            return false;
                        } else {
                            self.attr("autocomplete", "off").prop("disabled", true);
                        }
                    } else {
                        if (self.hasClass('confirm')) {
                            $.confirm({
                                title: '',
                                content: tips || '确认要执行该操作吗？',
                                type: 'orange',
                                typeAnimated: true,
                                buttons: {
                                    confirm: {
                                        text: '确认',
                                        btnClass: 'btn-blue',
                                        action: function() {
                                            var loader = $('body').lyearloading({
                                                opacity: 0.2,
                                                spinnerSize: 'lg'
                                            });
                                            self.attr('autocomplete', 'off').prop('disabled', true);

                                            ajaxPostFun(self, ajax_url, form_data, loader);
                                        }
                                    },
                                    cancel: {
                                        text: '取消',
                                        action: function() {}
                                    }
                                }
                            });
                            return false;
                        } else {
                            form_data = form.find("input,select,textarea").serialize();
                            self.attr("autocomplete", "off").prop("disabled", true);
                        }
                    }

                    var loader = $('body').lyearloading({
                        opacity: 0.2,
                        spinnerSize: 'lg'
                    });
                    ajaxPostFun(self, ajax_url, form_data, loader);

                    return false;
                }
            });

            jQuery(document).delegate('.ajax-get', 'click', function() {
                var self = $(this),
                    tips = self.data('tips'),
                    ajax_url = self.attr("href") || self.data("url");

                if (self.hasClass('confirm')) {
                    $.confirm({
                        title: '',
                        content: tips || '确认要执行该操作吗？',
                        type: 'orange',
                        typeAnimated: true,
                        buttons: {
                            confirm: {
                                text: '确认',
                                btnClass: 'btn-blue',
                                action: function() {
                                    var loader = $('body').lyearloading({
                                        opacity: 0.2,
                                        spinnerSize: 'lg'
                                    });
                                    self.attr('autocomplete', 'off').prop('disabled', true);

                                    ajaxGetFun(self, ajax_url, loader);
                                }
                            },
                            cancel: {
                                text: '取消',
                                action: function() {}
                            }
                        }
                    });
                    return false;
                } else {
                    var loader = $('body').lyearloading({
                        opacity: 0.2,
                        spinnerSize: 'lg'
                    });
                    self.attr('autocomplete', 'off').prop('disabled', true);

                    ajaxGetFun(self, ajax_url, loader);
                }
                return false;
            });


            function ajaxPostFun(selfObj, ajax_url, form_data, loader) {
                jQuery.post(ajax_url, form_data).done(function(res) {
                    loader.destroy();
                    var msg = res.msg;
                    if (res.code == 0) {
                        if (res.url && !selfObj.hasClass('no-refresh')) {
                            msg += '页面即将自动跳转';
                        }
                        showNotify(msg, 'success');
                        setTimeout(function() {
                            selfObj.attr("autocomplete", "on").prop("disabled", false);
                            return selfObj.hasClass("no-refresh") ? false : (res.url ? location.href = res.url : window.location.reload());
                        }, 1500);
                    } else {
                        showNotify(msg, 'danger');
                        selfObj.attr("autocomplete", "on").prop("disabled", false);
                    }
                }).fail(function() {
                    loader.destroy();
                    showNotify('服务器发生错误，请稍后再试', 'danger');
                    selfObj.attr("autocomplete", "on").prop("disabled", false);
                });
            }

            function ajaxGetFun(selfObj, ajax_url, loader) {
                jQuery.get(ajax_url).done(function(res) {
                    loader.destroy();
                    var msg = res.msg;
                    if (res.code == 0) {
                        if (res.url && !selfObj.hasClass('no-refresh')) {
                            msg += '页面即将自动跳转';
                        }
                        showNotify(msg, 'success');
                        setTimeout(function() {
                            selfObj.attr("autocomplete", "on").prop("disabled", false);
                            return selfObj.hasClass("no-refresh") ? false : (res.url ? location.href = res.url : location.reload());
                        }, 1500);
                    } else {
                        showNotify(msg, 'danger');
                        selfObj.attr("autocomplete", "on").prop("disabled", false);
                    }
                }).fail(function() {
                    loader.destroy();
                    showNotify('服务器发生错误，请稍后再试', 'danger');
                    selfObj.attr("autocomplete", "on").prop("disabled", false);
                });
            }

            function showNotify($msg, $type, $delay, $icon, $from, $align) {
                $type = $type || 'info';
                $delay = $delay || 3000;
                $from = $from || 'top';
                $align = $align || 'right';
                $enter = $type == 'danger' ? 'animated shake' : 'animated fadeInUp';

                jQuery.notify({
                    icon: $icon,
                    message: $msg
                }, {
                    element: 'body',
                    type: $type,
                    allow_dismiss: true,
                    newest_on_top: true,
                    showProgressbar: false,
                    placement: {
                        from: $from,
                        align: $align
                    },
                    offset: 20,
                    spacing: 10,
                    z_index: 10800,
                    delay: $delay,
                    animate: {
                        enter: $enter,
                        exit: 'animated fadeOutDown'
                    }
                });
            }
        });
    </script>
</body>

</html>