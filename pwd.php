<?php
$is_defend = true;
$nod_jump = true;
include("includes/common.php");
$my = (isset($_GET['my']) ? trim(daddslashes($_GET['my'])) : NULL);
if ($my == 'pwd') {
    if ($_GET['id'] == '') {
        @header('Content-Type: text/html; charset=UTF-8');
        exit("<script language='javascript'>alert('禁止访问！');history.go(-1);</script>");
    }
    $pwd = trim(daddslashes($_POST['pwd']));
    $id = trim(daddslashes($_GET['id']));
    $res = $DB->get_row("select id from pre_url where id=:id and pwd=:pwd limit 1", [':id' => $id, ':pwd' => $pwd]);
    if ($res) {
        $_SESSION['pwd' . $id] = $id . $pwd;
        header("Location: ./" . $res['id']);
        exit();
    } else {
        @header('Content-Type: text/html; charset=UTF-8');
        exit("<script language='javascript'>alert('密码错误！');history.go(-1);</script>");
    }
}
?>
<html>

<head>
    <title>密码访问</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="https://lib.baomitu.com/twitter-bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./static/css/components.min.css">
    <link rel="stylesheet" type="text/css" href="./static/css/pwd.css">
    <script type="text/javascript" src="https://lib.baomitu.com/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://lib.baomitu.com/twitter-bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>

<body id="body">
    <section>
        <div class="container">
            <div class="centered form">
                <form role="form" class="live_form" method="post" action="pwd.php?id=<?php echo $_GET['id'] ?>&my=pwd">
                    <h3>输入密码解锁此网址</h3>
                    <p>此网址的访问受到限制，请输入密码进行查看</p>
                    <div class="form-group">
                        <label for="pwd">密码</label>
                        <input type="password" class="form-control" id="pwd" placeholder="请输入访问密码" name="pwd">
                    </div>
                    <button type="submit" class="btn btn-primary">解锁</button>
                </form>
            </div>
        </div>
    </section>
</body>

</html>