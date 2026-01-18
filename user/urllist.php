<?php
include('../includes/common.php');
if ($islogin2 == 1) {
} else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>

<?php
$title = '网址列表';
include('head.php');
?>
<link href="../static/admin/js/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
<link href="../static/admin/css/style.min.css" rel="stylesheet">
<style>
    .dropdown-item.active,
    .dropdown-item:active {
        background-color: #33cabb;
        color: #fff;
        text-decoration: none;
    }

    .dropdown-item,
    .dropdown-header,
    .dropdown-item-text {
        padding: 8px 15px;
    }

    .dropdown-item {
        display: block;
        width: 100%;

        clear: both;
        font-weight: 400;
        color: #212529;
        text-align: inherit;
        white-space: nowrap;
        border: 0;
    }
</style>
<section id="main-content">
    <section class="wrapper">
        <div class="modal fade" align="left" id="up_url" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">一键修改</h4>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" name="ckurl" placeholder="请输入修改网址" required><br />
                        <button type="button" class="btn btn-primary btn-block" id="update_submit">一键修改</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div aria-hidden="true" aria-labelledby="addUrlLabel" role="dialog" tabindex="-1" id="addUrl" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                            <h4 class="modal-title">添加网址</h4>
                        </div>
                        <div class="modal-body">
                            <form>
                                <?php
                                if ($conf['diy_suffix'] == 1) {
                                ?>
                                    <div class="form-group" id="add10">
                                        <label>自定义后缀:</label>
                                        <input type="text" name="id" value="" id="add-id" class="form-control" />
                                        <p class="help-block">随机后缀请留空，部分短网址不支持</p>
                                    </div>
                                <?php
                                }
                                ?>
                                <div class="form-group">
                                    <label>默认跳转:</label>
                                    <input type="text" name="url" value="" id="add-url" class="form-control" placeholder="请输入需要跳转的网址" required />
                                </div>
                                <div class="form-group">
                                    <label>短链类型:</label>
                                    <select class="form-control" id="add-type" name="type">
                                        <?php
                                        echo dwzList();
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>网址分组:</label>
                                    <select class="form-control" id="add-group" name="group">
                                        <?php
                                        echo groupList();
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group" id="add2">
                                    <label>备注:</label>
                                    <input type="text" name="remarks" value="" id="add-remarks" class="form-control" />
                                </div>
                                <div class="form-group" id="add3">
                                    <label>访问密码:</label>
                                    <input type="text" name="pwd" value="" id="add-pwd" class="form-control" />
                                    <p class="help-block">不需要密码访问请留空</p>
                                </div>
                                <div class="form-group" id="add4">
                                    <label>限制访问次数:</label>
                                    <input type="number" name="visit" value="" id="add-visit" class="form-control" />
                                </div>
                                <div class="form-group" id="add5">
                                    <label>达到次数访问网址:</label>
                                    <input type="text" name="visiturl" value="" id="add-visiturl" class="form-control" />
                                    <p class="help-block">留空的话达到访问次数直接停止该网址访问</p>
                                </div>
                                <div class="form-group" id="add11">
                                    <label>网址过期时间：</label>
                                    <input type="text" class="form-control" id="add-endtime" size="16" data-provide="datetimepicker" data-side-by-side="true" data-format="YYYY-MM-DD HH:mm:ss">
                                    <p class="help-block">不设置过期时间请留空</p>
                                </div>
                                <div class="form-group" id="add6">
                                    <label>QQ跳转:</label>
                                    <input type="text" name="qqjump" value="" id="add-qqjump" class="form-control" />
                                    <p class="help-block">QQ无需特别跳转请留空</p>
                                </div>
                                <div class="form-group" id="add7">
                                    <label>微信跳转:</label>
                                    <input type="text" name="wxjump" value="" id="add-wxjump" class="form-control" />
                                    <p class="help-block">微信无需特别跳转请留空</p>
                                </div>
                                <div class="form-group" id="add8">
                                    <label>支付宝跳转:</label>
                                    <input type="text" name="alijump" value="" id="add-alijump" class="form-control" />
                                    <p class="help-block">支付宝无需特别跳转请留空</p>
                                </div>
                                <button type="button" onclick="insertUrl()" class="btn btn-primary btn-block">确认添加</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div aria-hidden="true" aria-labelledby="editUrlLabel" role="dialog" tabindex="-1" id="editUrl" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                            <h4 class="modal-title">修改网址</h4>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group" style="display: none">
                                    <label>ID：</label>
                                    <input type="text" class="form-control" id="edit-id" readonly>
                                </div>
                                <div class="form-group">
                                    <label>短链接：</label>
                                    <input type="text" class="form-control" id="edit-dwz" readonly>
                                </div>
                                <div class="form-group" id="edit1">
                                    <label>默认跳转:</label>
                                    <input type="text" name="url" value="" id="edit-url" class="form-control" placeholder="请输入需要跳转的网址" required />
                                </div>
                                <div class="form-group">
                                    <label>网址分组:</label>
                                    <select class="form-control" name="group" id="edit-group">
                                        <?php
                                        echo groupList();
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group" id="edit5">
                                    <label>备注:</label>
                                    <input type="text" name="remarks" value="" id="edit-remarks" class="form-control" />
                                </div>
                                <div class="form-group" id="edit6">
                                    <label>访问密码:</label>
                                    <input type="text" name="pwd" value="" id="edit-pwd" class="form-control" />
                                    <p class="help-block">不需要密码访问请留空</p>
                                </div>
                                <div class="form-group" id="edit7">
                                    <label>限制访问次数:</label>
                                    <input type="number" name="visit" value="" id="edit-visit" class="form-control" />
                                </div>
                                <div class="form-group" id="edit8">
                                    <label>达到次数访问网址:</label>
                                    <input type="text" name="visiturl" value="" id="edit-visiturl" class="form-control" />
                                    <p class="help-block">留空的话达到访问次数直接停止该网址访问</p>
                                </div>
                                <div class="form-group" id="edit12">
                                    <label>网址过期时间：</label>
                                    <input type="text" class="form-control" id="edit-endtime" size="16" data-provide="datetimepicker" data-side-by-side="true" data-format="YYYY-MM-DD HH:mm:ss">
                                    <p class="help-block">不设置过期时间请留空</p>
                                </div>
                                <div class="form-group" id="edit9">
                                    <label>QQ跳转:</label>
                                    <input type="text" name="qqjump" value="" id="edit-qqjump" class="form-control" />
                                    <p class="help-block">QQ无需特别跳转请留空</p>
                                </div>
                                <div class="form-group" id="edit10">
                                    <label>微信跳转:</label>
                                    <input type="text" name="wxjump" value="" id="edit-wxjump" class="form-control" />
                                    <p class="help-block">微信无需特别跳转请留空</p>
                                </div>
                                <div class="form-group" id="edit11">
                                    <label>支付宝跳转:</label>
                                    <input type="text" name="alijump" value="" id="edit-alijump" class="form-control" />
                                    <p class="help-block">支付宝无需特别跳转请留空</p>
                                </div>
                                <button type="button" onclick="updateUrl()" class="btn btn-primary btn-block">确认修改</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <section class="panel">
                    <div class="card">
                        <div class="card-body">

                            <div id="toolbar">
                                <form class="form-inline" role="form">
                                    <select name="grouping" id="grouping" class="form-control" style="width:100px">
                                        <option value="all" selected>全部</option>
                                        <?php
                                        echo groupList();
                                        ?>
                                    </select>
                                    <a href="#addUrl" data-toggle="modal" class="btn btn-primary">添加网址</a>&nbsp;
                                    <div class="btn-group">
                                        <a class="btn btn-warning" href="#" data-toggle="dropdown">
                                            操作
                                            <i class="icon-angle-down "></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#" onclick="datadel()"><i class="icon-trash"></i>一键删除</a></li>
                                            <li><a href="#" data-toggle="modal" data-target="#up_url" id="up_url"><i class="icon-pencil"></i>一键修改</a></li>
                                            <li><a href="#" onclick="setactiveAll(1)"><i class="icon-unlock"></i> 一键开启</a></li>
                                            <li><a href="#" onclick="setactiveAll(0)"><i class="icon-unlock-alt"></i> 一键关闭</a></li>
                                        </ul>
                                    </div>
                                </form>
                            </div>


                            <table id="listTable"></table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</section>
<script type="text/javascript" src="../static/admin/js/moment.js/moment.min.js"></script>
<script type="text/javascript" src="../static/admin/js/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="../static/admin/js/moment.js/locale/zh-cn.min.js"></script>
<script type="text/javascript" src="../static/admin/js/main.min.js"></script>
<script src="../static/user/js/common-scripts.js"></script>
<script>
    function initTable(grouping = 'all') {
        $('#listTable').bootstrapTable('destroy');
        $('#listTable').bootstrapTable({
            classes: 'table table-hover table-striped',
            url: 'ajax.php?act=urllist&grouping=' + grouping,
            method: 'get',
            dataType: 'jsonp',
            uniqueId: 'id',
            selectItemName: 'ids[]',
            idField: 'id',
            toolbar: '#toolbar',
            showColumns: false,
            showRefresh: true,
            showToggle: true,
            pagination: true,
            sortOrder: "desc",
            queryParams: function(params) {
                var temp = {
                    limit: params.limit,
                    offset: params.offset,
                    page: (params.offset / params.limit) + 1,
                    sort: params.sort,
                    sortOrder: params.order,
                    kw: $(".search-input").val()
                };
                return temp;
            },
            sidePagination: "server",
            pageNumber: 1,
            pageSize: 10,
            pageList: [10, 25, 50, 100],
            search: true,
            columns: [{
                    field: 'ids',
                    checkbox: true
                }, {
                    field: 'id',
                    title: 'ID'
                },
                {
                    field: 'dwz',
                    title: '短网址',
                    formatter: function(value, row, index) {
                        var value = '<a href="javascript:void(0)" title="点击复制" onclick="msg()" class="clipboard" data-clipboard-text="' + row['dwz'] + '">' + row['dwz'] + ' </a>';
                        return value;
                    }
                },
                {
                    field: 'url',
                    title: '跳转网址',
                    cellStyle: function(value, row, index) {
                        return {
                            css: {
                                "white-space": "nowrap",
                                "text-overflow": "ellipsis",
                                "overflow": "hidden",
                                "max-width": "100px"
                            }
                        }
                    },
                    formatter: function(value, row, index) {
                        var span = document.createElement("span");
                        span.setAttribute("title", value);
                        span.innerHTML = '<a onclick="msg()" class="clipboard" data-clipboard-text="' + row['url'] + '">' + value + ' </a>';
                        return span.outerHTML;
                    }
                },
                {
                    field: 'grouping',
                    title: '分组',
                    sortable: true
                },
                {
                    field: 'view',
                    title: '访问',
                    sortable: true
                },
                {
                    field: 'remarks',
                    title: '备注',
                    cellStyle: function(value, row, index) {
                        return {
                            css: {
                                "white-space": "nowrap",
                                "text-overflow": "ellipsis",
                                "overflow": "hidden",
                                "max-width": "100px"
                            }
                        }
                    },
                    formatter: function(value, row, index) {
                        var span = document.createElement("span");
                        span.setAttribute("title", value);
                        span.innerHTML = value;
                        return span.outerHTML;
                    },
                    sortable: true
                },
                {
                    field: 'u_state',
                    title: '开关',
                    formatter: function(value, row, index) {
                        var value = "";
                        if (row.u_state == '0') {
                            value = '<span class="btn btn-xs btn-danger" onclick="setActive(\'' + row['id'] + '\',' + row['u_state'] + ')">关闭</span>';
                        } else {
                            value = '<span class="btn btn-xs btn-success" onclick="setActive(\'' + row['id'] + '\',' + row['u_state'] + ')">开启</span>';
                        }
                        return value;
                    },
                    sortable: true
                },
                {
                    field: 'addtime',
                    title: '添加时间',
                    sortable: true
                },
                {
                    field: 'lasttime',
                    title: '最后访问',
                    sortable: true
                },
                {
                    field: 'operate',
                    title: '操作',
                    formatter: function(value, row, index) {
                        var value = "";
                        value = '<div class="btn-group"><button type="button" onclick="ewm(&quot;' + row['dwz'] + '&quot;)" class="btn btn-xs btn-default" title="二维码"><i class="mdi mdi-qrcode"></i></button>';
                        value += '<button type="button" class="btn btn-xs btn-default" title="编辑" data-toggle="modal" data-target="#editUrl" data-id="' + row['id'] + '"><i class="mdi mdi-pencil"></i></button>';
                        value += '<a href="../data.php?id=' + row['id'] + '" target="_blank" class="btn btn-xs btn-default" title="访问数据"><i class="mdi mdi-database"></i></a>';
                        value += '<button type="button" onclick="show(&quot;' + row['id'] + '&quot;)" class="btn btn-xs btn-default" title="详细信息"><i class="mdi mdi-information-outline"></i></button>';
                        value += '<button type="button" onclick="delUrl(&quot;' + row['id'] + '&quot;)" class="btn btn-xs btn-default" title="删除"><i class="mdi mdi-window-close"></i></button></div>';
                        return value;
                    }
                }
            ],
            onLoadSuccess: function(data) {
                $("[data-toggle='tooltip']").tooltip();
            }
        });
    }

    $(document).ready(function() {
        initTable();

        $("#grouping").change(function() {
            var opt = $("#grouping").val();
            initTable(opt);
        });

        if ($(".search-input").val() != '') {
            $(".search-input").bind("click", initTable);
        }
        new ClipboardJS('.clipboard')

        $('#editUrl').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            $.ajax({
                type: 'GET',
                url: 'ajax.php?act=getUrlInfo&id=' + id,
                dataType: 'json',
                success: function(data) {
                    if (data.code == 0) {
                        modal.find('#edit-id').val(id)
                        modal.find('#edit-dwz').val(data.dwz)
                        modal.find('#edit-url').val(data.url)
                        modal.find('#edit-group').val(data.group)
                        modal.find('#edit-remarks').val(data.remarks)
                        modal.find('#edit-visit').val(data.visit)
                        modal.find('#edit-visiturl').val(data.visiturl)
                        modal.find('#edit-endtime').val(data.endtime)
                        modal.find('#edit-pwd').val(data.pwd)
                        modal.find('#edit-qqjump').val(data.qqjump)
                        modal.find('#edit-wxjump').val(data.wxjump)
                        modal.find('#edit-alijump').val(data.alijump)
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

        $("#update_submit").click(function() {
            var url = $("input[name='ckurl']").val();
            if (url == '') {
                layer.msg('网址不能为空');
                return false;
            }
            $("#up_url").modal('hide');
            layer.confirm('您确定要修改这些网址吗？', {
                btn: ['确定', '取消']
            }, function() {
                var cks = document.getElementsByName("ids[]");
                var str = "";
                for (var i = 0; i < cks.length; i++) {
                    if (cks[i].checked) {
                        str += cks[i].value + "&";
                    }
                }
                str = str.substring(0, str.length - 1);
                $.ajax({
                    url: "ajax.php?act=upSelect",
                    type: "POST",
                    data: {
                        "str": str,
                        "url": url
                    },
                    dataType: "json",
                    success: function(result) {
                        if (result.code == 0) {
                            layer.msg('修改成功');
                            $("#listTable").bootstrapTable('refresh');
                        } else {
                            layer.msg(result.msg);
                        }
                    },
                    error: function(data) {
                        layer.msg('服务器错误');
                        return false;
                    }
                });
            })
        });
    })

    function msg() {
        layer.msg('复制成功')
    }

    function insertUrl() {
        id = $('#add-id').val();
        url = $('#add-url').val();
        type = $('#add-type').val();
        group = $('#add-group').val();
        remarks = $('#add-remarks').val();
        visit = $('#add-visit').val();
        visiturl = $('#add-visiturl').val();
        endtime = $('#add-endtime').val();
        pwd = $('#add-pwd').val();
        qqjump = $('#add-qqjump').val();
        wxjump = $('#add-wxjump').val();
        alijump = $('#add-alijump').val();
        if (url == '' || type == '') {
            layer.alert('输入内容不完整');
            return false;
        }
        $.ajax({
            url: "ajax.php?act=addUrl",
            type: "POST",
            data: {
                "id": id,
                "url": url,
                "type": type,
                "group": group,
                "remarks": remarks,
                "visit": visit,
                "visiturl": visiturl,
                "endtime": endtime,
                "pwd": pwd,
                "qqjump": qqjump,
                "wxjump": wxjump,
                "alijump": alijump
            },
            dataType: "json",
            success: function(data) {
                if (data.code == 0) {
                    layer.confirm(data.msg, {
                        btn: ['确定', '继续生成']
                    }, function() {
                        location.reload();
                    });
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

    function updateUrl() {
        id = $('#edit-id').val();
        url = $('#edit-url').val();
        group = $('#edit-group').val();
        remarks = $('#edit-remarks').val();
        visit = $('#edit-visit').val();
        visiturl = $('#edit-visiturl').val();
        endtime = $('#edit-endtime').val();
        pwd = $('#edit-pwd').val();
        qqjump = $('#edit-qqjump').val();
        wxjump = $('#edit-wxjump').val();
        alijump = $('#edit-alijump').val();
        if (url == '') {
            layer.alert('信息填写不完整');
            return false;
        }
        $.ajax({
            url: "ajax.php?act=upUrl",
            type: "POST",
            data: {
                "id": id,
                "url": url,
                "group": group,
                "remarks": remarks,
                "visit": visit,
                "visiturl": visiturl,
                "endtime": endtime,
                "pwd": pwd,
                "qqjump": qqjump,
                "wxjump": wxjump,
                "alijump": alijump
            },
            dataType: "json",
            success: function(data) {
                if (data.code == 0) {
                    layer.msg('修改成功');
                    setTimeout(function() {
                        location.reload();
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

    function delUrl(id) {
        layer.confirm('您确定要删除这个网址吗？', {
            btn: ['确定', '取消']
        }, function() {
            $.ajax({
                url: "ajax.php?act=delUrl",
                type: "POST",
                data: {
                    "id": id
                },
                dataType: "json",
                success: function(result) {
                    if (result.code == 0) {
                        layer.msg('删除成功');
                        $("#listTable").bootstrapTable('refresh');
                    } else {
                        layer.msg(result.msg);
                    }
                },
                error: function(data) {
                    layer.msg('服务器错误');
                    return false;
                }
            });
        })
    }

    function datadel() {
        layer.confirm('您确定要删除这些网址吗？', {
            btn: ['确定', '取消']
        }, function() {
            var cks = document.getElementsByName("ids[]");
            var str = "";
            for (var i = 0; i < cks.length; i++) {
                if (cks[i].checked) {
                    str += cks[i].value + "&";
                }
            }
            str = str.substring(0, str.length - 1);
            $.ajax({
                url: "ajax.php?act=delSelect",
                type: "POST",
                data: {
                    "str": str
                },
                dataType: "json",
                success: function(result) {
                    if (result.code == 0) {
                        layer.msg('删除成功');
                        $("#listTable").bootstrapTable('refresh');
                    } else {
                        layer.msg(result.msg);
                    }
                },
                error: function(data) {
                    layer.msg('服务器错误');
                    return false;
                }
            });
        })
    }


    function ewm(url) {
        layer.open({
            type: 1,
            skin: 'layui-layer-lan',
            anim: 2,
            shadeClose: true,
            title: '二维码',
            content: '<div style="padding:20px;text-align:center;"><img width="200px" src="../includes/libs/qrcode.php?size=300&text=' + url + '" /></div>'
        });
    }

    function show(id) {
        $.ajax({
            type: 'GET',
            url: 'ajax.php?act=getUrlInfo&id=' + id,
            dataType: 'json',
            success: function(data) {
                if (data.code == 0) {
                    state = data.code == 1 ? '正常' : '封禁';
                    layer.open({
                        type: 1,
                        skin: 'layui-layer-molv',
                        anim: 2,
                        shadeClose: true,
                        title: '详细信息',
                        content: '<div style="padding:15px"><p>网址ID：' + data.id + '</p><p>默认跳转：' + data.url + '</p><p>网址备注：' + data.remarks + '</p><p>限制次数：' + data.visit + '</p><p>限制跳转：' + data.visiturl + '</p><p>短链地址：' + data.dwz + '</p><p>QQ跳转：' + data.qqjump + '</p><p>微信跳转：' + data.wxjump + '</p><p>支付宝跳转：' + data.alijump + '</p><p>访问次数：' + data.view + '</p><p>访问密码：' + data.pwd + '</p><p>添加时间：' + data.addtime + '</p><p>到期时间：' + data.endtime + '</p></div>'
                    });
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

    function setActive(id, state) {
        state == 1 ? state = 0 : state = 1;
        $.ajax({
            type: 'GET',
            url: 'ajax.php?act=setUrlState&id=' + id + '&state=' + state,
            dataType: 'json',
            success: function(data) {
                if (data.code == 0) {
                    layer.msg('修改成功');
                    $("#listTable").bootstrapTable('refresh');
                } else {
                    layer.msg(data.msg);
                }
            },
            error: function(data) {
                layer.msg('服务器错误');
                return false;
            }
        });
    }

    function setactiveAll(state) {
        title = state == 1 ? '您确定要开启这些网址吗？' : '您确定要关闭这些网址吗？';
        layer.confirm(title, {
            btn: ['确定', '取消']
        }, function() {
            var cks = document.getElementsByName("ids[]");
            var str = "";
            for (var i = 0; i < cks.length; i++) {
                if (cks[i].checked) {
                    str += cks[i].value + "&";
                }
            }
            str = str.substring(0, str.length - 1);
            $.ajax({
                url: "ajax.php?act=setUrlStateAll",
                type: "POST",
                data: {
                    "state": state,
                    "str": str
                },
                dataType: "json",
                success: function(data) {
                    if (data.code == 0) {
                        layer.msg('修改成功');
                        $("#listTable").bootstrapTable('refresh');
                    }
                },
                error: function(data) {
                    layer.msg('服务器错误');
                    return false;
                }
            });
        })
    }
</script>