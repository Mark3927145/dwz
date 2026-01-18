<?php
include('../includes/common.php');
if ($islogin != 1) {
    exit('<script language=\'javascript\'>window.location.href=\'./login.php\';</script>');
}
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>接口管理</title>
    <link rel="icon" href="favicon.ico" type="image/ico">
    <link href="../static/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="../static/admin/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="../static/admin/js/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
    <link href="../static/admin/js/jquery-confirm/jquery-confirm.min.css" rel="stylesheet">
    <link href="../static/admin/js/jquery-tagsinput/jquery.tagsinput.min.css" rel="stylesheet">
    <link href="../static/admin/css/style.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid p-t-15">
        <div class="row">
            <div class="col-lg-12">
                <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addUrlChangeLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="addChangeTitle">新增接口</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form name="add" action="ajax.php?act=addApi">
                                    <div class="form-group">
                                        <label for="add-domain" class="control-label">对接网址：</label>
                                        <input type="text" class="form-control" name="domain" id="add-domain" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="add-type" class="control-label">类型：</label>
                                        <select class="form-control" name="type" id="add-type" required>
                                            <option value="0">本站域名接口</option>
                                            <option value="1">第三方接口</option>
                                            <option value="2">同程序接口</option>
                                            <option value="3">自定义对接</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="add-name" class="control-label">接口名称：</label>
                                        <input type="text" class="form-control" name="name" id="add-name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="add-keyname" class="control-label">对接key：</label>
                                        <input type="text" class="form-control" name="keyname" id="add-keyname" required>
                                        <small>对接api时的key名，你自己用户中心使用api接口时也需要用到</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="add-token" class="control-label">对接token：</label>
                                        <input type="text" class="form-control" name="token" id="add-token">
                                        <small>对接外部接口时，需要填写的token，留空默认使用网站设置中的token</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="add-num" class="control-label">消耗点数：</label>
                                        <input type="text" class="form-control" name="num" id="add-num" value="0" required>
                                        <small>用户使用该短网址需要花费的点数</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="add-vip_num" class="control-label">会员消耗点数</label>
                                        <input type="text" class="form-control" name="vip_num" id="add-vip_num" value="0" required>
                                        <small>会员使用该短网址需要花费的点数</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="add-disable_pattern" class="control-label">跳转模式禁用</label>
                                        <input class="js-tags-input form-control" type="text" id="add-disable_pattern" name="disable_pattern" placeholder="请输入ID">
                                        <small>禁用后设置的跳转模式无法使用该短网址（普通：1，防红：2，直链：3，直接：4，例如禁用防红则填2，多个用,隔开）</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="add-sorting" class="control-label">排序：</label>
                                        <input type="text" class="form-control" name="sorting" id="add-sorting" value="0" required>
                                        <small>数字越小，排序越前</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="add-bz" class="control-label">接口备注：</label>
                                        <input type="text" class="form-control" name="bz" id="add-bz">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                                <button type="submit" class="btn btn-primary ajax-post refresh" target-form="add">添加</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="adds" tabindex="-1" role="dialog" aria-labelledby="addUrlsChangeLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="addChangeTitle">批量新增接口</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form name="adds" action="ajax.php?act=addApis">
                                    <div class="form-group">
                                        <label for="add-domains" class="control-label">对接网址：</label>
                                        <textarea id="add-domains" class="form-control" placeholder="每行一个网址" rows="7" name="domain"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="add-types" class="control-label">类型：</label>
                                        <select class="form-control" name="type" id="add-types" required>
                                            <option value="0">本站域名接口</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="add-nums" class="control-label">消耗点数：</label>
                                        <input type="text" class="form-control" name="num" id="add-nums" value="0" required>
                                        <small>用户使用该短网址需要花费的点数</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="add-vip_nums" class="control-label">会员消耗点数</label>
                                        <input type="text" class="form-control" name="vip_num" id="add-vip_nums" value="0" required>
                                        <small>会员使用该短网址需要花费的点数</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="add-disable_patterns" class="control-label">跳转模式禁用</label>
                                        <input class="js-tags-input form-control" type="text" id="add-disable_patterns" name="disable_pattern" placeholder="请输入ID">
                                        <small>禁用后设置的跳转模式无法使用该短网址（普通：1，防红：2，直链：3，直接：4，例如禁用防红则填2，多个用,隔开）</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="add-sortings" class="control-label">排序：</label>
                                        <input type="text" class="form-control" name="sorting" id="add-sortings" value="0" required>
                                        <small>数字越小，排序越前</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="add-bzs" class="control-label">接口备注：</label>
                                        <input type="text" class="form-control" name="bz" id="add-bzs">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                                <button type="submit" class="btn btn-primary ajax-post refresh" target-form="adds">添加</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editChangeLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="editChangeTitle">修改接口信息</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form name="edit" action="ajax.php?act=editApi">
                                    <div class="form-group" style="display: none">
                                        <label for="edit-id" class="control-label">ID：</label>
                                        <input type="text" class="form-control" name="id" id="edit-id" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-domain" class="control-label">对接网址：</label>
                                        <input type="text" class="form-control" name="domain" id="edit-domain" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-type" class="control-label">类型：</label>
                                        <select class="form-control" name="type" id="edit-type">
                                            <option value="0">本站域名接口</option>
                                            <option value="1">第三方接口</option>
                                            <option value="2">同程序接口</option>
                                            <option value="3">自定义对接</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-name" class="control-label">接口名称：</label>
                                        <input type="text" class="form-control" name="name" id="edit-name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-keyname" class="control-label">对接key：</label>
                                        <input type="text" class="form-control" name="keyname" id="edit-keyname" required>
                                        <small>对接api时的key名，你自己用户中心使用api接口时也需要用到</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-token" class="control-label">对接token：</label>
                                        <input type="text" class="form-control" name="token" id="edit-token">
                                        <small>对接外部接口时，需要填写的token，留空默认使用网站设置中的token</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-num" class="control-label">消耗点数</label>
                                        <input type="text" class="form-control" name="num" id="edit-num" required>
                                        <small>用户使用该短网址需要花费的点数</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-vip_num" class="control-label">会员消耗点数</label>
                                        <input type="text" class="form-control" name="vip_num" id="edit-vip_num" required>
                                        <small>会员使用该短网址需要花费的点数</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-disable_pattern" class="control-label">跳转模式禁用</label>
                                        <input class="js-tags-input form-control" type="text" id="edit-disable_pattern" name="disable_pattern" placeholder="请输入ID">
                                        <small>禁用后设置的跳转模式无法使用该短网址（普通：1，防红：2，直链：3，直接：4，例如禁用防红则填2，多个用,隔开）</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-sorting" class="control-label">排序：</label>
                                        <input type="text" class="form-control" name="sorting" id="edit-sorting" value="0" required>
                                        <small>数字越小，排序越前</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-bz" class="control-label">接口备注：</label>
                                        <input type="text" class="form-control" name="bz" id="edit-bz">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                                <button type="submit" class="btn btn-primary ajax-post refresh" target-form="edit">修改</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div id="toolbar" class="toolbar-btn-action">
                            <button id="btn_add" type="button" class="btn btn-primary m-r-5" data-toggle="modal" data-target="#add">
                                <span class="mdi mdi-plus" aria-hidden="true"></span>新增
                            </button>
                            <button id="btn_adds" type="button" class="btn btn-info m-r-5" data-toggle="modal" data-target="#adds">
                                <span class="mdi mdi-plus" aria-hidden="true"></span>批量新增
                            </button>
                            <button id="btn_edit" type="button" class="btn btn-success m-r-5" onclick="setActiveAll(1)">
                                <span class="mdi mdi-check" aria-hidden="true"></span>启用
                            </button>
                            <button id="btn_edit" type="button" class="btn btn-warning m-r-5" onclick="setActiveAll(0)">
                                <span class="mdi mdi-block-helper" aria-hidden="true"></span>停用
                            </button>
                            <button id="btn_delete" type="button" class="btn btn-danger" onclick="delAll()">
                                <span class="mdi mdi-window-close" aria-hidden="true"></span>删除
                            </button>
                        </div>
                        <table id="listTable"></table>
                    </div>
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
    <script type="text/javascript" src="../static/admin/js/bootstrap-table/bootstrap-table.min.js"></script>
    <script type="text/javascript" src="../static/admin/js/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>
    <script type="text/javascript" src="../static/admin/js/jquery-tagsinput/jquery.tagsinput.min.js"></script>
    <script src="https://lib.baomitu.com/layer/3.1.1/layer.js"></script>
    <script type="text/javascript" src="../static/admin/js/main.min.js"></script>
    <script type="text/javascript">
        function initTable() {
            $('#listTable').bootstrapTable('destroy');
            $('#listTable').bootstrapTable({
                classes: 'table table-bordered table-hover table-striped',
                url: 'ajax.php?act=apilist',
                method: 'get',
                dataType: 'jsonp',
                uniqueId: 'id',
                selectItemName: 'ids[]',
                idField: 'id',
                toolbar: '#toolbar',
                showColumns: true,
                showRefresh: true,
                showToggle: true,
                pagination: true,
                sortOrder: "",
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
                        title: 'ID',
                        sortable: true
                    }, {
                        field: 'domain',
                        title: '域名'
                    },
                    {
                        field: 'type',
                        title: '类型',
                        formatter: function(value, row, index) {
                            switch (row.type) {
                                case '0':
                                    type = '本站域名接口';
                                    break;
                                case '1':
                                    type = '第三方接口';
                                    break;
                                case '2':
                                    type = '同程序接口';
                                    break;
                                case '3':
                                    type = '自定义对接';
                                    break;
                                default:
                                    type = '未知接口';
                                    break;
                            }
                            return type;
                        },
                        sortable: true
                    },
                    {
                        field: 'name',
                        title: '接口名称'
                    },
                    {
                        field: 'keyname',
                        title: '对接key'
                    },
                    {
                        field: 'token',
                        title: '对接token'
                    },
                    {
                        field: 'num',
                        title: '消耗点数',
                        sortable: true
                    },
                    {
                        field: 'vip_num',
                        title: '会员消耗',
                        sortable: true
                    },
                    {
                        field: 'bz',
                        title: '备注'
                    },
                    {
                        field: 'status',
                        title: '状态',
                        formatter: function(value, row, index) {
                            var value = "";
                            if (row.status == '0') {
                                value = '<span class="badge badge-danger" onclick="setactive(' + row['id'] + ',' + row['status'] + ')">停用</span>';
                            } else if (row.status == '1') {
                                value = '<span class="badge badge-success" onclick="setactive(' + row['id'] + ',' + row['status'] + ')">正常</span>';
                            }
                            return value;
                        },
                        sortable: true
                    },
                    {
                        field: 'sorting',
                        title: '排序',
                        sortable: true
                    },
                    {
                        field: 'addtime',
                        title: '添加时间',
                        sortable: true
                    },
                    {
                        field: 'operate',
                        title: '操作',
                        formatter: function(value, row, index) {
                            var value = "";
                            value = '<div class="btn-group"><button type="button" class="btn btn-xs btn-default" title="编辑" data-toggle="modal" data-target="#edit" data-id="' + row['id'] + '"><i class="mdi mdi-pencil"></i></button>';
                            value += '<button type="button" onclick="del(' + row['id'] + ')" class="btn btn-xs btn-default" title="删除"><i class="mdi mdi-window-close"></i></button></div>';
                            return value;
                        }
                    }
                ],
                onLoadSuccess: function(data) {
                    $("[data-toggle='tooltip']").tooltip();
                }
            });
        }

        function setactive(id, state) {
            var loader = $('body').lyearloading({
                opacity: 0.2,
                spinnerSize: 'lg'
            });
            state == 1 ? state = 0 : state = 1;
            $.ajax({
                type: 'GET',
                url: 'ajax.php?act=setApiState&id=' + id + '&state=' + state,
                dataType: 'json',
                success: function(data) {
                    loader.destroy();
                    if (data.code == 0) {
                        showNotify(data.msg, 'success');
                        setTimeout(function() {
                            return $("#listTable").bootstrapTable('refresh');
                        }, 1000);
                    } else {
                        showNotify(data.msg, 'danger');
                    }
                },
                error: function(data) {
                    loader.destroy();
                    showNotify('服务器发生错误，请稍后再试', 'danger');
                    return false;
                }
            });
        }

        function setActiveAll(state) {
            var selRows = $("#listTable").bootstrapTable("getSelections");
            if (selRows.length == 0) {
                alert("请至少选择一条数据");
                return;
            }
            $.confirm({
                title: '',
                content: '确认要执行该操作吗？',
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
                            var postData = "";
                            $.each(selRows, function(i) {
                                postData += this.id;
                                if (i < selRows.length - 1) {
                                    postData += "&";
                                }
                            });
                            $.ajax({
                                url: "ajax.php?act=setApiStateAll",
                                type: "POST",
                                data: {
                                    "state": state,
                                    "str": postData
                                },
                                dataType: "json",
                                success: function(data) {
                                    loader.destroy();
                                    if (data.code == 0) {
                                        showNotify(data.msg, 'success');
                                        setTimeout(function() {
                                            return $("#listTable").bootstrapTable('refresh');
                                        }, 1000);
                                    } else {
                                        showNotify(data.msg, 'danger');
                                    }
                                },
                                error: function(data) {
                                    loader.destroy();
                                    showNotify('服务器发生错误，请稍后再试', 'danger');
                                    return false;
                                }
                            });
                        }
                    },
                    cancel: {
                        text: '取消',
                        action: function() {}
                    }
                }
            });
        }

        function delAll() {
            var selRows = $("#listTable").bootstrapTable("getSelections");
            if (selRows.length == 0) {
                alert("请至少选择一条数据");
                return;
            }
            $.confirm({
                title: '',
                content: '确认要执行该操作吗？',
                type: 'red',
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
                            var postData = "";
                            $.each(selRows, function(i) {
                                postData += this.id;
                                if (i < selRows.length - 1) {
                                    postData += "&";
                                }
                            });
                            $.ajax({
                                url: "ajax.php?act=delApiAll",
                                type: "POST",
                                data: {
                                    "str": postData
                                },
                                dataType: "json",
                                success: function(data) {
                                    loader.destroy();
                                    if (data.code == 0) {
                                        showNotify(data.msg, 'success');
                                        setTimeout(function() {
                                            return $("#listTable").bootstrapTable('refresh');
                                        }, 1000);
                                    } else {
                                        showNotify(data.msg, 'danger');
                                    }
                                },
                                error: function(data) {
                                    loader.destroy();
                                    showNotify('服务器发生错误，请稍后再试', 'danger');
                                    return false;
                                }
                            });
                        }
                    },
                    cancel: {
                        text: '取消',
                        action: function() {}
                    }
                }
            });
        }

        $('#edit').on('show.bs.modal', function(event) {
            var loader = $('body').lyearloading({
                opacity: 0.2,
                spinnerSize: 'lg'
            });
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            $.ajax({
                type: 'GET',
                url: 'ajax.php?act=getApiInfo&id=' + id,
                dataType: 'json',
                success: function(data) {
                    loader.destroy();
                    if (data.code == 0) {
                        modal.find('#edit-id').val(id)
                        modal.find('#edit-domain').val(data.domain)
                        modal.find('#edit-type').val(data.type)
                        modal.find('#edit-name').val(data.name)
                        modal.find('#edit-keyname').val(data.keyname)
                        modal.find('#edit-token').val(data.token)
                        modal.find('#edit-num').val(data.num)
                        modal.find('#edit-vip_num').val(data.vip_num)
                        modal.find('#edit-disable_pattern').importTags(data.disable_pattern)
                        modal.find('#edit-sorting').val(data.sorting)
                        modal.find('#edit-bz').val(data.bz)
                    } else {
                        showNotify(data.msg, 'warning');
                    }
                },
                error: function(data) {
                    loader.destroy();
                    showNotify('服务器错误', 'danger');
                    return false;
                }
            });
        })

        function del(id) {
            $.confirm({
                title: '',
                content: '确认要执行该操作吗？',
                type: 'red',
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
                            $.ajax({
                                url: "ajax.php?act=delApi",
                                type: "POST",
                                data: {
                                    "id": id
                                },
                                dataType: "json",
                                success: function(data) {
                                    loader.destroy();
                                    if (data.code == 0) {
                                        showNotify(data.msg, 'success');
                                        setTimeout(function() {
                                            return $("#listTable").bootstrapTable('refresh');
                                        }, 1000);
                                    } else {
                                        showNotify(data.msg, 'danger');
                                    }
                                },
                                error: function(data) {
                                    loader.destroy();
                                    showNotify('服务器发生错误，请稍后再试', 'danger');
                                    return false;
                                }
                            });

                        }
                    },
                    cancel: {
                        text: '取消',
                        action: function() {}
                    }
                }
            });
        }

        $(function() {
            initTable();
            if ($(".search-input").val() != '') {
                $(".search-input").bind("click", initTable);
            }
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


            function ajaxPostFun(selfObj, ajax_url, form_data, loader) {
                jQuery.post(ajax_url, form_data).done(function(res) {
                    loader.destroy();
                    var msg = res.msg;
                    if (res.code == 0) {
                        showNotify(msg, 'success');
                        setTimeout(function() {
                            selfObj.attr("autocomplete", "on").prop("disabled", false);
                            return selfObj.hasClass("refresh") ? location.reload() : $("#listTable").bootstrapTable('refresh');
                        }, 1000);
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
        });

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
    </script>
</body>

</html>