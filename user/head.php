<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="../static/user/css/bootstrap.min.css" rel="stylesheet">
    <link href="../static/user/css/bootstrap-reset.css" rel="stylesheet">
    <link href="../static/user/js/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
    <link href="../static/user/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="https://lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="../static/admin/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="../static/user/css/style.css" rel="stylesheet">
    <link href="../static/user/css/style-responsive.css" rel="stylesheet">
    <script src="https://lib.baomitu.com/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://lib.baomitu.com/twitter-bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="https://lib.baomitu.com/jquery.nicescroll/3.5.1/jquery.nicescroll.min.js"></script>
    <script type="text/javascript" src="../static/user/js/bootstrap-table/bootstrap-table.min.js"></script>
    <script type="text/javascript" src="../static/user/js/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>
    <script src="https://lib.baomitu.com/layer/3.1.1/layer.js"></script>
    <script src="https://lib.baomitu.com/clipboard.js/2.0.6/clipboard.min.js"></script>

</head>
<?php
if ($userrow['state'] == 0) {
    sysmsg('你的账号已被封禁！', true);
    exit;
}
?>

<body>
    <section id="container" class="">
        <header class="header white-bg">
            <div class="sidebar-toggle-box">
                <div data-original-title="收缩/展开" data-placement="right" class="icon-reorder tooltips"></div>
            </div>
            <a href="./" class="logo">用户<span>中心</span></a>
            <div class="top-nav ">
                <ul class="nav pull-right top-menu">
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="https://q.qlogo.cn/headimg_dl?dst_uin=<?php echo $userrow['qq'] ?>&spec=100" width="29px" height="29px">
                            <span class="username"><?php echo $userrow['name'] ?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li><a href="../"><i class="fa fa-home"></i>网站首页</a></li>
                            <li><a href="./uset.php?mod=user"><i class="fa fa-cog"></i> 资料修改</a></li>
                            <li><a href="./urllist.php"><i class="fa fa-link"></i> 网址管理</a></li>
                            <li><a href="./login.php?my=logout"><i class="fa fa-key"></i> 登出</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </header>
        <aside>
            <div id="sidebar" class="nav-collapse ">
                <ul class="sidebar-menu">
                    <li class="<?php echo checkIfActive('index,') ?>">
                        <a class="" href="./index.php">
                            <i class="fa fa-home"></i>
                            <span>用户首页</span>
                        </a>
                    </li>
                    <li class="<?php echo checkIfActive('pay') ?>">
                        <a class="" href="./pay.php">
                            <i class="fa fa-shopping-cart"></i>
                            <span>充值中心</span>
                        </a>
                    </li>
                    <li class="sub-menu <?php echo checkIfActive('glist,urllist,data') ?>">
                        <a href="javascript:;" class="">
                            <i class="fa fa-link"></i>
                            <span>网址管理</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub">
                            <li class="<?php echo checkIfActive('glist') ?>">
                                <a class="" href="./glist.php">分组管理</a>
                            </li>
                            <li class="<?php echo checkIfActive('urllist') ?>">
                                <a class="" href="./urllist.php">网址列表</a>
                            </li>
                            <li class="<?php echo checkIfActive('data') ?>">
                                <a class="" href="./data.php">数据中心</a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo checkIfActive('problem') ?>">
                        <a class="" href="./problem.php">
                            <i class="fa fa-info-circle"></i>
                            <span>常见问题</span>
                        </a>
                    </li>
                    <li class="sub-menu <?php echo checkIfActive('uset') ?>">
                        <a href="javascript:;" class="">
                            <i class="fa fa-cog"></i>
                            <span>系统设置</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub">
                            <li class="<?php echo checkIfActive('user') ?>">
                                <a class="" href="./uset.php?mod=user">资料修改</a>
                            </li>
                            <li class="<?php echo checkIfActive('setMail') ?>">
                                <a class="" href="./uset.php?mod=setMail">更改邮箱</a>
                            </li>
                            <li class="<?php echo checkIfActive('token') ?>">
                                <a class="" href="./uset.php?mod=token">对接设置</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="" href="./login.php?my=logout">
                            <i class="fa fa-sign-out"></i>
                            <span>退出登录</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
</body>

</html>