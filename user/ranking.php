<?php
include('../includes/common.php');
if ($islogin2 == 1) {
} else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>

<?php
$title = '排行榜';
include('head.php');
?>
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-6">
                <section class="panel">
                    <div class="panel-body progress-panel">
                        <div class="task-progress">
                            <h1>今日访问排行榜</h1>
                            <p></p>
                        </div>
                        <div class="task-option">
                            <select class="styled" name="tranking" id="tranking" onchange="tranking()">
                                <option value="10">前10</option>
                                <option value="50">前50</option>
                                <option value="100">前100</option>
                            </select>
                        </div>
                    </div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>
                                    链接ID
                                </th>
                                <th>
                                    访问次数
                                </th>
                                <th>
                                    IP数
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tlist">
                        </tbody>
                    </table>
                </section>
            </div>
            <div class="col-lg-6">
                <section class="panel">
                    <div class="panel-body progress-panel">
                        <div class="task-progress">
                            <h1>昨日访问排行榜</h1>
                            <p></p>
                        </div>
                        <div class="task-option">
                            <select class="styled" name="yranking" id="yranking" onchange="yranking()">
                                <option value="10">前10</option>
                                <option value="50">前50</option>
                                <option value="100">前100</option>
                            </select>
                        </div>
                    </div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>
                                    链接ID
                                </th>
                                <th>
                                    访问次数
                                </th>
                                <th>
                                    IP数
                                </th>
                            </tr>
                        </thead>
                        <tbody id="ylist">
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </section>
</section>
<script>
    $(document).ready(function() {
        $.ajax({
            url: "ajax.php?act=tranking",
            type: "POST",
            data: {
                "num": 10
            },
            dataType: "json",
            success: function(result) {
                rows = result.rows;
                var content = "";
                for (i = 0, len = rows.length; i < len; i++) {
                    content += "<tr><td>" + (i + 1) + "</td><td>" + rows[i]["urlid"] + "</td><td>" + rows[i]["pv"] + "</td><td>" + rows[i]["ip"] + "</td></tr>";
                }
                $("#tlist").html(content)
            },
            error: function(data) {
                layer.msg('服务器错误');
                return false;
            }
        });

        $.ajax({
            url: "ajax.php?act=yranking",
            type: "POST",
            data: {
                "num": 10
            },
            dataType: "json",
            success: function(result) {
                rows = result.rows;
                var content = "";
                for (i = 0, len = rows.length; i < len; i++) {
                    content += "<tr><td>" + (i + 1) + "</td><td>" + rows[i]["urlid"] + "</td><td>" + rows[i]["pv"] + "</td><td>" + rows[i]["ip"] + "</td></tr>";
                }
                $("#ylist").html(content)
            },
            error: function(data) {
                layer.msg('服务器错误');
                return false;
            }
        });
    })

    function tranking() {
        var num = $('#tranking').val();
        $.ajax({
            url: "ajax.php?act=tranking",
            type: "POST",
            data: {
                "num": num
            },
            dataType: "json",
            success: function(result) {
                rows = result.rows;
                var content = "";
                for (i = 0, len = rows.length; i < len; i++) {
                    content += "<tr><td>" + (i + 1) + "</td><td>" + rows[i]["urlid"] + "</td><td>" + rows[i]["pv"] + "</td></tr>";
                }
                $("#tlist").html(content)
            },
            error: function(data) {
                layer.msg('服务器错误');
                return false;
            }
        });
    }

    function yranking() {
        var num = $('#yranking').val();
        $.ajax({
            url: "ajax.php?act=yranking",
            type: "POST",
            data: {
                "num": num
            },
            dataType: "json",
            success: function(result) {
                rows = result.rows;
                var content = "";
                for (i = 0, len = rows.length; i < len; i++) {
                    content += "<tr><td>" + (i + 1) + "</td><td>" + rows[i]["urlid"] + "</td><td>" + rows[i]["pv"] + "</td></tr>";
                }
                $("#ylist").html(content)
            },
            error: function(data) {
                layer.msg('服务器错误');
                return false;
            }
        });
    }
</script>
<script src="../static/user/js/common-scripts.js"></script>