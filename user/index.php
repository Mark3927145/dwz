<?php
include('../includes/common.php');
if ($islogin2 == 1) {
} else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>

<?php
$title = '用户首页';
include('head.php');
?>
<section id="main-content">
    <section class="wrapper">
        <div class="alert alert-info fade in">
            <button data-dismiss="alert" class="close close-sm" type="button">
                <i class="icon-remove"></i>
            </button>
            <span id="gg">获取中...</span>
        </div>
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol terques">
                        <i class="fa fa-link"></i>
                    </div>
                    <div class="value">
                        <h1 id="count1">获取中..</h1>
                        <p>总链接数</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol yellow">
                        <i class="fa fa-eye"></i>
                    </div>
                    <div class="value">
                        <h1 id="count2">获取中..</h1>
                        <p>总访问数</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol red">
                        <i class="fa fa-product-hunt"></i>
                    </div>
                    <div class="value">
                        <h1 id="count3">获取中..</h1>
                        <p>昨日IP</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol blue">
                        <i class="fa fa-vine"></i>
                    </div>
                    <div class="value">
                        <h1 id="count4">获取中..</h1>
                        <p>昨日访问</p>
                    </div>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <section class="panel">
                    <div class="panel-body">
                        <a href="#" class="task-thumb">
                            <img src="https://q.qlogo.cn/headimg_dl?dst_uin=<?php echo $userrow['qq'] ?>&spec=100" alt="" width="90px" height="90px">
                        </a>
                        <div class="task-thumb-details">
                            <h1><a href="#"><?php echo $userrow['name'] ?></a></h1>
                            <?php echo $vip == 1 ? '<p style="color:red">本站会员</p>' : '<p>免费用户</p>' ?>
                        </div>
                    </div>
                    <table class="table table-hover personal-task">
                        <tbody>
                            <tr>
                                <td>
                                    <i class="fa fa-qq"></i>
                                </td>
                                <td>用户QQ</td>
                                <td><?php echo $userrow['qq'] ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="fa fa-registered"></i>
                                </td>
                                <td>注册时间</td>
                                <td><?php echo $userrow['addtime'] ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="fa fa-envelope"></i>
                                </td>
                                <td>通知邮箱</td>
                                <td><?php echo $userrow['mail'] ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="fa fa-star"></i>
                                </td>
                                <td>短网址点数</td>
                                <td><?php echo $userrow['create_num'] ?>次</td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="fa fa-vimeo"></i>
                                </td>
                                <td>会员到期时间</td>
                                <td><?php echo $userrow['vip'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </div>
            <div class="col-lg-8">
                <section class="panel">
                    <div class="panel-body">
                        <textarea id="urls" class="form-control" placeholder="每行一个长网址，可以批量缩短，一次最多50个网址" rows="7" name="urls"></textarea>
                        <select class="form-control" name="type" id="dwz-type">
                            <?php
                            echo dwzList();
                            ?>
                        </select>
                        <hr>
                        <button type="submit" class="btn btn-info" id="start">生成</button>&nbsp;
                        <button id="reset" class="btn btn-warning">重置</button>&nbsp;
                        <button id="copy" class="btn btn-success">复制</button>
                    </div>
                </section>
            </div>
        </div>
    </section>
</section>
<script>
    $(document).ready(function() {
        $.ajax({
            type: "GET",
            url: "ajax.php?act=getcount",
            dataType: 'json',
            async: true,
            success: function(data) {
                if (data.gg3 != '') {
                    layer.open({
                        type: 1,
                        skin: 'layui-layer-molv',
                        anim: 2,
                        shadeClose: true,
                        title: '公告',
                        content: '<div style="padding:15px">' + data.gg3 + '</div>'
                    });
                }
                $('#gg').html('公告：' + data.gg1);
                $('#count1').html(data.count1);
                $('#count2').html(data.count2);
                $('#count3').html(data.count3);
                $('#count4').html(data.count4);
            }
        });
        $('#start').click(function() {
            $('#start').text('生成中..');
            $("#start").addClass("btn-warning").removeClass("btn-info");
            var type = $("select[id='dwz-type']").val();
            var url = $('#urls').val()
            if (url == '') {
                alert('网址不能为空');
            } else {
                url = url.replace(/\+/g, "%2B");
                var urls = url.split(/[(\r\n)\r\n]+/);
                $.ajax({
                    type: "post",
                    url: "ajax.php?act=creatUrls",
                    dataType: "json",
                    data: {
                        "urls": urls,
                        "type": type
                    },
                    success: function(obj) {
                        $('#start').text('生成');
                        $("#start").addClass("btn-info").removeClass("btn-warning");
                        if (obj.code == 0) {
                            var str = '';
                            for (let i in obj.data) {
                                str += obj.data[i] + '\n';
                            }
                            $('#urls').val(str)
                            var content = document.getElementById("urls");
                            content.select();
                            document.execCommand("Copy");
                            layer.msg('生成成功，已自动复制到剪切板');
                        } else {
                            layer.alert(obj.msg)
                            return false;
                        }
                    },
                    error: function(a) {
                        $('#start').text('生成');
                        $("#start").addClass("btn-info").removeClass("btn-warning");
                        $('#urls').val('生成失败');
                    }
                });
            }

        });
        $('#reset').click(function() {
            $('#urls').val('');
        });

        $('#copy').click(function() {
            var content = document.getElementById("urls");
            if (content.value == '') {
                layer.msg('复制内容不能为空');
                return false;
            }
            content.select();
            document.execCommand("Copy");
            layer.msg('复制成功');
        });
    })
</script>
<script src="../static/user/js/common-scripts.js"></script>