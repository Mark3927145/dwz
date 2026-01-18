<?php
include('../includes/common.php');
if ($islogin2 == 1) {
} else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>

<?php
$title = '充值中心';
include('head.php');
?>
<style>
    img.logo {
        width: 14px;
        height: 14px;
        margin: 0 5px 0 3px;
    }
</style>
<section id="main-content">
    <section class="wrapper">
        <div class="col-lg-6">
            <section class="panel">
                <header class="panel-heading">
                    购买商品
                </header>
                <div class="panel-body">
                    <form class="form-horizontal tasi-form">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">商品</label>
                            <div class="col-sm-10">
                                <select name="number" id="number" class="form-control">
                                    <option value="1">会员月卡(<?php echo $conf['vip_month'] ?>元)</option>
                                    <option value="2">会员季卡(<?php echo $conf['vip_quarter'] ?>元)</option>
                                    <option value="3">会员年卡(<?php echo $conf['vip_year'] ?>元)</option>
                                    <option value="4">短网址点数（100次）(<?php echo $conf['dwz_price'] ?>元)</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">数量</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" value="1" id="num" name="num" required>
                            </div>
                        </div>
                    </form>
                    <br>
                    <div class="text-center">
                        <?php
                        if ($conf['alipay_api']) echo '<button type="submit" class="btn btn-success" id="buy_alipay"><img src="../static/icon/alipay.ico" class="logo">支付宝</button>&nbsp;';
                        if ($conf['qqpay_api']) echo '<button type="submit" class="btn btn-warning" id="buy_qqpay"><img src="../static/icon/qqpay.ico" class="logo">QQ钱包</button>&nbsp;';
                        if ($conf['wxpay_api']) echo '<button type="submit" class="btn btn-default" id="buy_wxpay"><img src="../static/icon/wechat.ico" class="logo">微信支付</button>&nbsp;';
                        ?>
                    </div>

                </div>
            </section>
            <section class="panel">
                <header class="panel-heading">
                    卡密充值
                </header>
                <div class="panel-body">
                    <input type="text" name="km" value="" class="form-control" autocomplete="off" placeholder="请输入卡密" />
                    <br />
                    <div class="text-center">
                        <button class="btn btn-danger" type="submit" id="usekm">确认使用</button>
                        <?php
                        if ($conf['km_buy'] != '') {
                        ?>
                            <a class="btn btn-info" href="<?php echo $conf['km_buy'] ?>" target="_blank">购买卡密</a>
                        <?php
                        }

                        ?>
                    </div>
                </div>
            </section>
            <section class="panel">
                <header class="panel-heading no-border">
                    会员功能
                </header>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>普通用户</th>
                            <th>会员用户</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>生成短链接</td>
                            <td>
                                <font color="green">支持</font>
                            </td>
                            <td>
                                <font color="green">支持</font>
                            </td>
                        </tr>
                        <tr>
                            <td>链接二维码</td>
                            <td>
                                <font color="green">支持</font>
                            </td>
                            <td>
                                <font color="green">支持</font>
                            </td>
                        </tr>
                        <tr>
                            <td>链接统计</td>
                            <td>
                                <?php echo $conf['vip_tj'] == 0 ? '<font color="green">支持</font>' : '<font color="red">不支持</font>' ?>
                            </td>
                            <td>
                                <font color="green">支持</font>
                            </td>
                        </tr>
                        <tr>
                            <td>对接api</td>
                            <td>
                                <?php echo $conf['vip_api'] == 0 ? '<font color="green">支持</font>' : '<font color="red">不支持</font>' ?>
                            </td>
                            <td>
                                <font color="green">支持</font>
                            </td>
                        </tr>
                        <tr>
                            <td>修改网址</td>
                            <td>
                                <?php echo $conf['vip_edit'] == 0 ? '<font color="green">支持</font>' : '<font color="red">不支持</font>' ?>
                            </td>
                            <td>
                                <font color="green">支持</font>
                            </td>
                        </tr>
                        <tr>
                            <td>每日最高生成短网址</td>
                            <td>
                                <font color="green"><?php echo $conf['limit_url2'] != '' ? $conf['limit_url2'] : '无限' ?>次</font>
                            </td>
                            <td>
                                <font color="green"><?php echo $conf['limit_url3'] != '' ? $conf['limit_url3'] : '无限' ?>次</font>
                            </td>
                        </tr>
                        <tr>
                            <td>跳转劫持</td>
                            <td>
                                <?php echo $conf['hijack_btn'] == 0 ? '<font color="green">无</font>' : '<font color="red">轻微劫持</font>' ?>
                            </td>
                            <td>
                                <font color="green">无</font>
                            </td>
                        </tr>
                        <tr>
                            <td>数据中心</td>
                            <td>
                                <?php echo $conf['vip_data'] == 0 ? '<font color="green">支持</font>' : '<font color="red">不支持</font>' ?>
                            </td>
                            <td>
                                <font color="green">支持</font>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </div>
        <div class="col-lg-6">
            <section class="panel">
                <header class="panel-heading">
                    充值记录
                </header>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>类型</th>
                                <th>名称</th>
                                <th>数量</th>
                                <th>花费金额</th>
                                <th>充值时间</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($DB->getColumn("select count(*) from pre_points where uid='$uid'") > 0) {
                                $rs = $DB->query("select * from pre_points where uid='$uid' order by id desc limit 10");
                                while ($res = $rs->fetch()) {
                                    echo '<tr><td>' . $res['action'] . '</td><td>' . $res['bz'] . '</td><td>' . $res['number'] . '</td><td>' . $res['point'] . '元</td><td>' . $res['addtime'] . '</td></tr>';
                                }
                            } else {
                                echo '<tr><th colspan="5" style="text-align:center">暂无充值记录</th></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="panel">
                <header class="panel-heading">
                    短网址列表
                </header>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>名称</th>
                                <th>对接type</th>
                                <th>普通价格</th>
                                <th>会员价格</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($DB->getColumn("select count(*) from pre_api where status=1") > 0) {
                                $rs = $DB->query("select * from pre_api where status=1 order by sorting");
                                while ($res = $rs->fetch()) {
                                    echo '<tr><td>' . $res['name'] . '</td><td>' . $res['keyname'] . '</td><td>' . $res['num'] . '点</td><td>' . $res['vip_num'] . '点</td></tr>';
                                }
                            } else {
                                echo '<tr><th colspan="5" style="text-align:center">暂无接口，请联系管理员</th></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </section>
</section>
<script>
    function dopay(type) {
        var value = $("select[name='number']").val();
        var num = $("#num").val();
        $.get("ajax.php?act=recharge&type=" + type + "&value=" + value + "&num=" + num, function(data) {
            if (data.code == 0) {
                window.location.href = '../other/submit.php?type=' + type + '&orderid=' + data.trade_no;
            } else {
                layer.alert(data.msg);
            }
        }, 'json');
    }
    $(document).ready(function() {
        $("#buy_alipay").click(function() {
            dopay('alipay')
        });
        $("#buy_qqpay").click(function() {
            dopay('qqpay')
        });
        $("#buy_wxpay").click(function() {
            dopay('wxpay')
        });
        $("#usekm").click(function() {
            var km = $("input[name='km']").val();
            $.ajax({
                type: "POST",
                url: "ajax.php?act=usekm",
                data: {
                    km: km
                },
                dataType: 'json',
                async: true,
                success: function(data) {
                    if (data.code == 0) {
                        layer.alert(data.msg, {
                            icon: 1
                        }, function() {
                            window.location.reload()
                        });
                    } else {
                        layer.alert(data.msg, {
                            icon: 2
                        });
                    }
                }
            });
        });
    });
</script>
<script src="../static/user/js/common-scripts.js"></script>