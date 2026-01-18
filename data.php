<?php
$is_defend = true;
include("./includes/common.php");
if (!isset($_GET['id'])) {
    exit("<script language='javascript'>alert('非法访问');window.location.href='./';</script>");
}
if ($conf['statistics'] == 1) {
    if ($islogin2 == 1) {
    } else exit("<script language='javascript'>alert('登录后才能查看');window.location.href='./user/login.php';</script>");
}
if ($conf['vip_tj'] == 1) {
    if ($islogin2 == 1) {
        if ($userrow['vip'] < $date) {
            exit("<script language='javascript'>alert('会员才可查看统计');window.location.href='./';</script>");
        }
    } else {
        exit("<script language='javascript'>alert('登录后才能查看');window.location.href='./user/login.php';</script>");
    }
}

$id = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>网址统计</title>
    <link href="./static/user/css/bootstrap.min.css" rel="stylesheet">
    <link href="./static/user/css/bootstrap-reset.css" rel="stylesheet">
    <link href="./static/user/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="https://lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <link href="./static/user/css/style.css" rel="stylesheet">
    <link href="./static/user/css/style-responsive.css" rel="stylesheet">
    <link href="./static/plugin/morris/morris.css" rel="stylesheet">
    <style>
        #china_div {
            height: 400px;
            margin: 100px auto;
        }
    </style>
</head>

<body>
    <section class="wrapper tab-container">
        <div class="row state-overview">
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol terques">
                        <i class="fa fa-product-hunt"></i>
                    </div>
                    <div class="value">
                        <h1 id="count1">获取中..</h1>
                        <p>今日IP</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol yellow">
                        <i class="fa fa-vine"></i>
                    </div>
                    <div class="value">
                        <h1 id="count2">获取中..</h1>
                        <p>今日PV</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol red">
                        <i class="fa fa-product-hunt"></i>
                    </div>
                    <div class="value">
                        <h1 id="count3">获取中</h1>
                        <p>总IP</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol blue">
                        <i class="fa fa-vine"></i>
                    </div>
                    <div class="value">
                        <h1 id="count4">获取中</h1>
                        <p>总PV</p>
                    </div>
                </section>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="morris">
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                近七日访问数据
                            </header>
                            <div class="panel-body">
                                <div id="hero-area" class="graph"></div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>

        <div class="row state-overview">
            <div class="col-lg-3">
                <section class="panel">
                    <header class="panel-heading">
                        客户端
                    </header>
                    <div class="panel-body">
                        <div id="khd" class="graph"></div>
                    </div>
                </section>
            </div>

            <div class="col-lg-3">
                <section class="panel">
                    <header class="panel-heading">
                        浏览器
                    </header>
                    <div class="panel-body">
                        <div id="llq" class="graph"></div>
                    </div>
                </section>
            </div>

            <div class="col-lg-3">
                <section class="panel">
                    <header class="panel-heading">
                        网络
                    </header>
                    <div class="panel-body">
                        <div id="wl" class="graph"></div>
                    </div>
                </section>
            </div>

            <div class="col-lg-3">
                <section class="panel">
                    <header class="panel-heading">
                        运营商
                    </header>
                    <div class="panel-body">
                        <div id="yys" class="graph"></div>
                    </div>
                </section>
            </div>
        </div>

        <div class="row state-overview">
            <div class="col-lg-8">
                <section class="panel">
                    <header class="panel-heading">
                        访问地图
                    </header>
                    <div class="panel-body">
                        <div id="china_div" class="col-md-12" style="height:455px;"></div>
                    </div>
                </section>
            </div>
            <div class="col-lg-4">
                <section class="panel">
                    <header class="panel-heading">
                        IP榜（前十）
                    </header>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>IP</th>
                                    <th>次数</th>
                                </tr>
                            </thead>
                            <tbody id="ip_list">

                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </section>
</body>
<script src="./static/user/js/jquery.js" type="text/javascript"></script>
<script src="./static/user/js/bootstrap.min.js" type="text/javascript"></script>
<script src="./static/user/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="https://cdn.staticfile.org/layer/2.3/layer.js" type="text/javascript"></script>
<script src="./static/plugin/morris/morris.min.js" type="text/javascript"></script>
<script src="./static/plugin/morris/raphael-min.js" type="text/javascript"></script>
<script src="https://cdn.staticfile.org/echarts/4.7.0/echarts.min.js"></script>
<script src="./static/js/china.js"></script>
<script src="./static/user/js/common-scripts.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: "ajax.php?act=tongji&id=<?php echo $id ?>",
            type: "GET",
            dataType: "json",
            success: function(result) {
                week = result.week;
                system = result.system;
                $('#count1').html(result.total[0]);
                $('#count2').html(result.total[1]);
                $('#count3').html(result.total[2]);
                $('#count4').html(result.total[3]);
                var Script = function() {
                    $(function() {
                        Morris.Area({
                            element: 'hero-area',
                            data: [{
                                    period: week[6][0],
                                    ip: week[6][1],
                                    pv: week[6][2]
                                },
                                {
                                    period: week[5][0],
                                    ip: week[5][1],
                                    pv: week[5][2]
                                },
                                {
                                    period: week[4][0],
                                    ip: week[4][1],
                                    pv: week[4][2]
                                },
                                {
                                    period: week[3][0],
                                    ip: week[3][1],
                                    pv: week[3][2]
                                },
                                {
                                    period: week[2][0],
                                    ip: week[2][1],
                                    pv: week[2][2]
                                },
                                {
                                    period: week[1][0],
                                    ip: week[1][1],
                                    pv: week[1][2]
                                },
                                {
                                    period: week[0][0],
                                    ip: week[0][1],
                                    pv: week[0][2]
                                }
                            ],

                            xkey: 'period',
                            ykeys: ['ip', 'pv'],
                            labels: ['ip', 'pv'],
                            hideHover: 'auto',
                            lineWidth: 1,
                            pointSize: 5,
                            lineColors: ['#4a8bc2', '#ff6c60'],
                            fillOpacity: 0.5,
                            smooth: true
                        });

                        Morris.Donut({
                            element: 'khd',
                            data: [{
                                    label: 'Other',
                                    value: system[0]
                                },
                                {
                                    label: 'iPhone',
                                    value: system[2]
                                },
                                {
                                    label: 'Android',
                                    value: system[1]
                                }
                            ],
                            colors: ['#41cac0', '#1d953f', '#faa755'],
                            formatter: function(y) {
                                return y + "%"
                            }
                        });
                    });
                }();
            }
        });

        $.ajax({
            url: "ajax.php?act=tongji2&id=<?php echo $id ?>",
            type: "GET",
            dataType: "json",
            success: function(result) {
                data = result.china;
                data2 = result.ip;
                data3 = result.browser;
                data4 = result.network;
                data5 = result.isp;
                var arr = [];
                for (var x in data) {
                    if (x == '') {
                        arr.push({
                            name: '未知',
                            value: data[x]
                        });
                    } else {
                        arr.push({
                            name: x,
                            value: data[x]
                        })
                    }
                }

                var arr2 = [];
                for (var x in data3) {
                    if (x == '') {
                        arr2.push({
                            label: '未知',
                            value: data3[x]
                        })
                    } else {
                        arr2.push({
                            label: x,
                            value: data3[x]
                        })
                    }
                }

                var arr3 = [];
                for (var x in data4) {
                    if (x == '') {
                        arr3.push({
                            label: '其它',
                            value: data4[x]
                        })
                    } else {
                        arr3.push({
                            label: x,
                            value: data4[x]
                        })
                    }
                }

                var arr4 = [];
                for (var x in data5) {
                    if (x == '') {
                        arr4.push({
                            label: '未知',
                            value: data5[x]
                        })
                    } else {
                        arr4.push({
                            label: x,
                            value: data5[x]
                        })
                    }
                }

                Morris.Donut({
                    element: 'llq',
                    data: arr2,
                    colors: ['#ed1941', '#41cac0', '#faa755', '#4e72b8', '#ef5b9c', '#1d953f', '#f26522'],
                    formatter: function(y) {
                        return y + "次"
                    }
                });

                Morris.Donut({
                    element: 'wl',
                    data: arr3,
                    colors: ['#ed1941', '#41cac0', '#faa755', '#4e72b8', '#ef5b9c', '#1d953f', '#f26522'],
                    formatter: function(y) {
                        return y + "次"
                    }
                });

                Morris.Donut({
                    element: 'yys',
                    data: arr4,
                    colors: ['#ed1941', '#41cac0', '#faa755', '#4e72b8', '#ef5b9c', '#1d953f', '#f26522'],
                    formatter: function(y) {
                        return y + "次"
                    }
                });

                var splitList = [{
                        start: 5000,
                        end: 999999
                    },
                    {
                        start: 2000,
                        end: 5000
                    },
                    {
                        start: 500,
                        end: 2000
                    },
                    {
                        start: 100,
                        end: 500
                    },
                    {
                        start: 0,
                        end: 100
                    }
                ];

                var mydata = arr;
                var optionMap = {
                    backgroundColor: '#FFFFFF',
                    tooltip: {
                        trigger: 'item'
                    },

                    visualMap: {
                        left: 'left',
                        bottom: 'bottom',
                        splitList: splitList,
                        color: ['red', '#9feaa5', '#85daef', '#74e2ca', '#e6ac53'],
                        show: true
                    },

                    series: [{
                        name: '省级',
                        type: 'map',
                        mapType: 'china',
                        roam: 'true',
                        label: {
                            normal: {
                                show: true
                            },
                            emphasis: {
                                show: false
                            }
                        },
                        data: mydata
                    }]
                };

                var myChart = echarts.init(document.getElementById('china_div'));
                myChart.setOption(optionMap);

                for (var x in data2) {
                    if (x == 'unknown') {
                        $("#ip_list").append('<tr><td>未知</td><td>' + data2[x] + '</td></tr>')
                    } else {
                        $("#ip_list").append('<tr><td>' + x + '</td><td>' + data2[x] + '</td></tr>')
                    }

                }
            }
        });
    })
</script>