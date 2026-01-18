<?php
include('../includes/common.php');
if ($islogin2 == 1) {
} else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>

<?php
$title = '分组管理';
include('head.php');
?>
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
        <div class="row">
            <div aria-hidden="true" aria-labelledby="addLabel" role="dialog" tabindex="-1" id="add" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                            <h4 class="modal-title">添加分组</h4>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label>分组名称:</label>
                                    <input type="text" name="name" value="" id="add-name" class="form-control" required />
                                </div>
                                <button type="button" onclick="insertUrl()" class="btn btn-primary btn-block">确认添加</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div aria-hidden="true" aria-labelledby="editLabel" role="dialog" tabindex="-1" id="edit" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                            <h4 class="modal-title">修改分组</h4>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group" style="display: none">
                                    <label>ID：</label>
                                    <input type="text" class="form-control" id="edit-id" readonly>
                                </div>
                                <div class="form-group">
                                    <label>分组名称:</label>
                                    <input type="text" name="name" value="" id="edit-name" class="form-control" required />
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
                                <a href="#add" data-toggle="modal" class="btn btn-primary">添加分组</a>&nbsp;
                                <a href="#" onclick="datadel()" class="btn btn-danger">一键删除</a>&nbsp;
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
    function initTable() {
        $('#listTable').bootstrapTable('destroy');
        $('#listTable').bootstrapTable({
            classes: 'table table-hover table-striped',
            url: 'ajax.php?act=glist',
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
                }, {
                    field: 'name',
                    title: '名称'
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
                        value += '<button type="button" class="btn btn-xs btn-default" title="编辑" data-toggle="modal" data-target="#edit" data-id="' + row['id'] + '"><i class="mdi mdi-pencil"></i></button>';
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

        new ClipboardJS('.clipboard');

        initTable();
        if ($(".search-input").val() != '') {
            $(".search-input").bind("click", initTable);
        }

        $('#edit').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var modal = $(this)
            $.ajax({
                type: 'GET',
                url: 'ajax.php?act=getGroupInfo&id=' + id,
                dataType: 'json',
                success: function(data) {
                    if (data.code == 0) {
                        modal.find('#edit-id').val(id)
                        modal.find('#edit-name').val(data.name)
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
    })

    function msg() {
        layer.msg('复制成功')
    }

    function insertUrl() {
        name = $('#add-name').val();
        $.ajax({
            url: "ajax.php?act=addGroup",
            type: "POST",
            data: {
                "name": name
            },
            dataType: "json",
            success: function(data) {
                if (data.code == 0) {
                    layer.msg('添加成功');
                    setTimeout(function() {
                        window.location.reload();
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

    function updateUrl() {
        id = $('#edit-id').val();
        name = $('#edit-name').val();
        $.ajax({
            url: "ajax.php?act=upGroup",
            type: "POST",
            data: {
                "id": id,
                "name": name
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
        layer.confirm('您确定要删除这个分组吗？', {
            btn: ['确定', '取消']
        }, function() {
            $.ajax({
                url: "ajax.php?act=delGroup",
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
        layer.confirm('您确定要删除这些分组吗？', {
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
                url: "ajax.php?act=delGroupAll",
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
</script>