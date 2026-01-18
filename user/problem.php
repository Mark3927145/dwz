<?php
include('../includes/common.php');
if ($islogin2 == 1) {
} else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>

<?php
$title = '常见问题';
include('head.php');
?>
<section id="main-content">
    <div class="wrapper">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading font-bold" style="background-color: #FF6C60;color: white;">常见问题</div>
                <div class="panel-body">
                    <div id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">怎么生成短网址？</a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                                <div class="panel-body">
                                    在用户首页可以批量生成短网址，如果网址需要具备更多功能，请在网址列表里面添加
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed">为什么不能修改网址信息？</a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" style="height: 0px;">
                                <div class="panel-body">
                                    修改网址是会员才有的功能，您需要购买会员才可以修改网址信息
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed">为什么有些短网址无法生成？</a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" style="height: 0px;">
                                <div class="panel-body">
                                    有些短网址是第三方接口，有可能限制了生成，还有部分短网址是收费的，需要购买短网址点数才能生成
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive" class="collapsed">为什么网址被封禁了？</a>
                                </h4>
                            </div>
                            <div id="collapseFive" class="panel-collapse collapse" style="height: 0px;">
                                <div class="panel-body">
                                    本站禁止生成违法链接，发现了后会对违法链接进行封禁处理，严重者还会受到封号惩罚
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

<script src="../static/user/js/common-scripts.js"></script>