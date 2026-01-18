<?php
/*
 本代码由缥缈创建
 严禁反编译、逆向等任何形式的侵权行为，违者将追究法律责任
*/

if(!defined("A_A_A_AA_"))define("A_A_A_AA_","A_A_A_AAA");$GLOBALS[A_A_A_AA_]=explode("|t|V|m", "A_A_A___A");if(!defined($GLOBALS[A_A_A_AA_][0x0]))define($GLOBALS[A_A_A_AA_][0x0], ord(1));if(isset($_B32Ijdk))goto B32eWjgx2;$B32zA3=array();$B32zA3[]="RaOnxciS";$B32zA3[]="13";$B32eFbN2=call_user_func_array("strspn",$B32zA3);if($B32eFbN2)goto B32eWjgx2;$B328J=!defined("A_A_A__A_");if($B328J)goto B32eWjgx2;goto B32ldMhx2;B32eWjgx2:$B32zA1=array();$B32zA1[]="A_A_A__A_";$B32zA1[]="A_A_A__AA";$B32eF0=call_user_func_array("define",$B32zA1);goto B32x1;B32ldMhx2:B32x1:$B32zA1=array();$B32zA1[]="|=|(|J";$B32zA1[]="../includes/common.php|=|(|J<script language='javascript'>window.location.href='./login.php';</script>|=|(|J<!DOCTYPE html>|=|(|J
<html lang=\"zh\">|=|(|J
|=|(|J
<head>|=|(|J
    <meta charset=\"utf-8\">|=|(|J
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no\" />|=|(|J
    <title>分组管理</title>|=|(|J
    <link rel=\"icon\" href=\"favicon.ico\" type=\"image/ico\">|=|(|J
    <link href=\"../static/admin/css/bootstrap.min.css\" rel=\"stylesheet\">|=|(|J
    <link href=\"../static/admin/css/materialdesignicons.min.css\" rel=\"stylesheet\">|=|(|J
    <link href=\"../static/admin/js/bootstrap-table/bootstrap-table.min.css\" rel=\"stylesheet\">|=|(|J
    <link href=\"../static/admin/js/jquery-confirm/jquery-confirm.min.css\" rel=\"stylesheet\">|=|(|J
    <link href=\"../static/admin/js/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css\" rel=\"stylesheet\">|=|(|J
    <link rel=\"stylesheet\" href=\"../static/admin/js/jquery-tagsinput/jquery.tagsinput.min.css\">|=|(|J
    <link href=\"../static/admin/css/style.min.css\" rel=\"stylesheet\">|=|(|J
</head>|=|(|J
<body>|=|(|J
    <div class=\"container-fluid p-t-15\">|=|(|J
        <div class=\"row\">|=|(|J
            <div class=\"col-lg-12\">|=|(|J
                <div class=\"modal fade\" id=\"edit\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"editChangeLabel\" aria-hidden=\"true\">|=|(|J
                    <div class=\"modal-dialog\" role=\"document\">|=|(|J
                        <div class=\"modal-content\">|=|(|J
                            <div class=\"modal-header\">|=|(|J
                                <h6 class=\"modal-title\" id=\"editChangeTitle\">修改分组信息</h6>|=|(|J
                                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">|=|(|J
                                    <span aria-hidden=\"true\">&times;</span>|=|(|J
                                </button>|=|(|J
                            </div>|=|(|J
                            <div class=\"modal-body\">|=|(|J
                                <form name=\"edit\" action=\"ajax.php?act=editGroup\">|=|(|J
                                    <div class=\"form-group\" style=\"display: none\">|=|(|J
                                        <label for=\"edit-id\" class=\"control-label\">ID：</label>|=|(|J
                                        <input type=\"text\" class=\"form-control\" name=\"id\" id=\"edit-id\" readonly>|=|(|J
                                    </div>|=|(|J
                                    <div class=\"form-group\">|=|(|J
                                        <label for=\"edit-name\" class=\"control-label\">名称：</label>|=|(|J
                                        <input type=\"text\" class=\"form-control\" name=\"name\" id=\"edit-name\" required>|=|(|J
                                        <label for=\"edit-uid\" class=\"control-label\">UID：</label>|=|(|J
                                        <input type=\"text\" class=\"form-control\" name=\"uid\" id=\"edit-uid\" required>|=|(|J
                                </form>|=|(|J
                            <div class=\"modal-footer\">|=|(|J
                                <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">关闭</button>|=|(|J
                                <button type=\"submit\" class=\"btn btn-primary ajax-post refresh\" target-form=\"edit\">修改</button>|=|(|J
                        </div>|=|(|J
                    </div>|=|(|J
                </div>|=|(|J
                <div class=\"card\">|=|(|J
                    <div class=\"card-body\">|=|(|J
                        <div id=\"toolbar\" class=\"toolbar-btn-action\">|=|(|J
                            <button id=\"btn_delete\" type=\"button\" class=\"btn btn-danger\" onclick=\"delAll()\">|=|(|J
                                <span class=\"mdi mdi-window-close\" aria-hidden=\"true\"></span>删除|=|(|J
                            </button>|=|(|J
                        <table id=\"listTable\"></table>|=|(|J
            </div>|=|(|J
        </div>|=|(|J
    </div>|=|(|J
    <script type=\"text/javascript\" src=\"../static/admin/js/jquery.min.js\"></script>|=|(|J
    <script type=\"text/javascript\" src=\"../static/admin/js/popper.min.js\"></script>|=|(|J
    <script type=\"text/javascript\" src=\"../static/admin/js/bootstrap.min.js\"></script>|=|(|J
    <script type=\"text/javascript\" src=\"../static/admin/js/lyear-loading.js\"></script>|=|(|J
    <script type=\"text/javascript\" src=\"../static/admin/js/bootstrap-notify.min.js\"></script>|=|(|J
    <script type=\"text/javascript\" src=\"../static/admin/js/jquery-confirm/jquery-confirm.min.js\"></script>|=|(|J
    <script type=\"text/javascript\" src=\"../static/admin/js/bootstrap-table/bootstrap-table.min.js\"></script>|=|(|J
    <script type=\"text/javascript\" src=\"../static/admin/js/bootstrap-table/locale/bootstrap-table-zh-CN.min.js\"></script>|=|(|J
    <script type=\"text/javascript\" src=\"../static/admin/js/moment.js/moment.min.js\"></script>|=|(|J
    <script type=\"text/javascript\" src=\"../static/admin/js/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js\"></script>|=|(|J
    <script type=\"text/javascript\" src=\"../static/admin/js/moment.js/locale/zh-cn.min.js\"></script>|=|(|J
    <script src=\"https://lib.baomitu.com/clipboard.js/2.0.6/clipboard.min.js\"></script>|=|(|J
    <script src=\"https://lib.baomitu.com/layer/3.1.1/layer.js\"></script>|=|(|J
    <script type=\"text/javascript\" src=\"../static/admin/js/jquery-tagsinput/jquery.tagsinput.min.js\"></script>|=|(|J
    <script type=\"text/javascript\" src=\"../static/admin/js/main.min.js\"></script>|=|(|J
    <script type=\"text/javascript\">|=|(|J
        function initTable() {|=|(|J
            \$('#listTable').bootstrapTable('destroy');|=|(|J
            \$('#listTable').bootstrapTable({|=|(|J
                classes: 'table table-bordered table-hover table-striped',|=|(|J
                url: 'ajax.php?act=glist',|=|(|J
                method: 'get',|=|(|J
                dataType: 'jsonp',|=|(|J
                uniqueId: 'id',|=|(|J
                selectItemName: 'ids[]',|=|(|J
                idField: 'id',|=|(|J
                toolbar: '#toolbar',|=|(|J
                showColumns: true,|=|(|J
                showRefresh: true,|=|(|J
                showToggle: true,|=|(|J
                pagination: true,|=|(|J
                sortOrder: \"desc\",|=|(|J
                queryParams: function(params) {|=|(|J
                    var temp = {|=|(|J
                        limit: params.limit,|=|(|J
                        offset: params.offset,|=|(|J
                        page: (params.offset / params.limit) + 1,|=|(|J
                        sort: params.sort,|=|(|J
                        sortOrder: params.order,|=|(|J
                        kw: \$(\".search-input\").val()|=|(|J
                    };|=|(|J
                    return temp;|=|(|J
                },|=|(|J
                sidePagination: \"server\",|=|(|J
                pageNumber: 1,|=|(|J
                pageSize: 10,|=|(|J
                pageList: [10, 25, 50, 100],|=|(|J
                search: true,|=|(|J
                columns: [{|=|(|J
                        field: 'ids',|=|(|J
                        checkbox: true|=|(|J
                    }, {|=|(|J
                        field: 'id',|=|(|J
                        title: 'ID',|=|(|J
                        sortable: true|=|(|J
                        field: 'uid',|=|(|J
                        title: 'UID',|=|(|J
                    },|=|(|J
                    {|=|(|J
                        field: 'name',|=|(|J
                        title: '名称'|=|(|J
                        field: 'addtime',|=|(|J
                        title: '添加时间',|=|(|J
                        field: 'operate',|=|(|J
                        title: '操作',|=|(|J
                        formatter: function(value, row, index) {|=|(|J
                            var value = \"\";|=|(|J
                            value = '<div class=\"btn-group\"><button type=\"button\" class=\"btn btn-xs btn-default\" title=\"编辑\" data-toggle=\"modal\" data-target=\"#edit\" data-id=\"' + row['id'] + '\"><i class=\"mdi mdi-pencil\"></i></button>';|=|(|J
                            value += '<button type=\"button\" onclick=\"del(' + row['id'] + ')\" class=\"btn btn-xs btn-default\" title=\"删除\"><i class=\"mdi mdi-window-close\"></i></button></div>';|=|(|J
                            return value;|=|(|J
                        }|=|(|J
                    }|=|(|J
                ],|=|(|J
                onLoadSuccess: function(data) {|=|(|J
                    \$(\"[data-toggle='tooltip']\").tooltip();|=|(|J
                }|=|(|J
            });|=|(|J
        }|=|(|J
        function delAll() {|=|(|J
            var selRows = \$(\"#listTable\").bootstrapTable(\"getSelections\");|=|(|J
            if (selRows.length == 0) {|=|(|J
                alert(\"请至少选择一条数据\");|=|(|J
                return;|=|(|J
            }|=|(|J
            \$.confirm({|=|(|J
                title: '',|=|(|J
                content: '确认要执行该操作吗？',|=|(|J
                type: 'red',|=|(|J
                typeAnimated: true,|=|(|J
                buttons: {|=|(|J
                    confirm: {|=|(|J
                        text: '确认',|=|(|J
                        btnClass: 'btn-blue',|=|(|J
                        action: function() {|=|(|J
                            var loader = \$('body').lyearloading({|=|(|J
                                opacity: 0.2,|=|(|J
                                spinnerSize: 'lg'|=|(|J
                            });|=|(|J
                            var postData = \"\";|=|(|J
                            \$.each(selRows, function(i) {|=|(|J
                                postData += this.id;|=|(|J
                                if (i < selRows.length - 1) {|=|(|J
                                    postData += \"&\";|=|(|J
                                }|=|(|J
                            \$.ajax({|=|(|J
                                url: \"ajax.php?act=delGroupAll\",|=|(|J
                                type: \"POST\",|=|(|J
                                data: {|=|(|J
                                    \"str\": postData|=|(|J
                                },|=|(|J
                                dataType: \"json\",|=|(|J
                                success: function(data) {|=|(|J
                                    loader.destroy();|=|(|J
                                    if (data.code == 0) {|=|(|J
                                        showNotify(data.msg, 'success');|=|(|J
                                        setTimeout(function() {|=|(|J
                                            return \$(\"#listTable\").bootstrapTable('refresh');|=|(|J
                                        }, 1000);|=|(|J
                                    } else {|=|(|J
                                        showNotify(data.msg, 'danger');|=|(|J
                                    }|=|(|J
                                error: function(data) {|=|(|J
                                    showNotify('服务器发生错误，请稍后再试', 'danger');|=|(|J
                                    return false;|=|(|J
                    cancel: {|=|(|J
                        text: '取消',|=|(|J
                        action: function() {}|=|(|J
        \$('#edit').on('show.bs.modal', function(event) {|=|(|J
            var loader = \$('body').lyearloading({|=|(|J
                opacity: 0.2,|=|(|J
                spinnerSize: 'lg'|=|(|J
            var button = \$(event.relatedTarget)|=|(|J
            var id = button.data('id')|=|(|J
            var modal = \$(this)|=|(|J
            \$.ajax({|=|(|J
                type: 'GET',|=|(|J
                url: 'ajax.php?act=getGroupInfo&id=' + id,|=|(|J
                dataType: 'json',|=|(|J
                success: function(data) {|=|(|J
                    loader.destroy();|=|(|J
                    if (data.code == 0) {|=|(|J
                        modal.find('#edit-id').val(id)|=|(|J
                        modal.find('#edit-name').val(data.name)|=|(|J
                        modal.find('#edit-uid').val(data.uid)|=|(|J
                    } else {|=|(|J
                        showNotify(data.msg, 'warning');|=|(|J
                error: function(data) {|=|(|J
                    showNotify('服务器错误', 'danger');|=|(|J
                    return false;|=|(|J
        })|=|(|J
        function del(id) {|=|(|J
                                url: \"ajax.php?act=delGroup\",|=|(|J
                                    \"id\": id|=|(|J
        \$(function() {|=|(|J
            initTable();|=|(|J
            if (\$(\".search-input\").val() != '') {|=|(|J
                \$(\".search-input\").bind(\"click\", initTable);|=|(|J
            jQuery(document).delegate('.ajax-post', 'click', function() {|=|(|J
                var self = jQuery(this),|=|(|J
                    tips = self.data('tips'),|=|(|J
                    ajax_url = self.attr(\"href\") || self.data(\"url\");|=|(|J
                var target_form = self.attr('target-form');|=|(|J
                var text = self.data('tips');|=|(|J
                var form = jQuery('form[name=\"' + target_form + '\"]');|=|(|J
                if (form.length == 0) {|=|(|J
                    form = jQuery('.' + target_form);|=|(|J
                var form_data = form.serialize();|=|(|J
                if ('submit' == self.attr('type') || ajax_url) {|=|(|J
                    if (void 0 == form.get(0)) return false;|=|(|J
                    if ('FORM' == form.get(0).nodeName) {|=|(|J
                        ajax_url = ajax_url || form.get(0).action;|=|(|J
                        if (self.hasClass('confirm')) {|=|(|J
                            \$.confirm({|=|(|J
                                title: '',|=|(|J
                                content: tips || '确认要执行该操作吗？',|=|(|J
                                type: 'orange',|=|(|J
                                typeAnimated: true,|=|(|J
                                buttons: {|=|(|J
                                    confirm: {|=|(|J
                                        text: '确认',|=|(|J
                                        btnClass: 'btn-blue',|=|(|J
                                        action: function() {|=|(|J
                                            var loader = \$('body').lyearloading({|=|(|J
                                                opacity: 0.2,|=|(|J
                                                spinnerSize: 'lg'|=|(|J
                                            });|=|(|J
                                            self.attr('autocomplete', 'off').prop('disabled', true);|=|(|J
                                            ajaxPostFun(self, ajax_url, form_data, loader);|=|(|J
                                        }|=|(|J
                                    },|=|(|J
                                    cancel: {|=|(|J
                                        text: '取消',|=|(|J
                                        action: function() {}|=|(|J
                            return false;|=|(|J
                        } else {|=|(|J
                            self.attr(\"autocomplete\", \"off\").prop(\"disabled\", true);|=|(|J
                    } else if ('INPUT' == form.get(0).nodeName || 'SELECT' == form.get(0).nodeName || 'TEXTAREA' == form.get(0).nodeName) {|=|(|J
                        if (form.get(0).type == 'checkbox' && form_data == '') {|=|(|J
                            showNotify('请选择您要操作的数据', 'danger');|=|(|J
                            form_data = form.find(\"input,select,textarea\").serialize();|=|(|J
                    var loader = \$('body').lyearloading({|=|(|J
                        opacity: 0.2,|=|(|J
                        spinnerSize: 'lg'|=|(|J
                    });|=|(|J
                    ajaxPostFun(self, ajax_url, form_data, loader);|=|(|J
            function ajaxPostFun(selfObj, ajax_url, form_data, loader) {|=|(|J
                jQuery.post(ajax_url, form_data).done(function(res) {|=|(|J
                    var msg = res.msg;|=|(|J
                    if (res.code == 0) {|=|(|J
                        showNotify(msg, 'success');|=|(|J
                        setTimeout(function() {|=|(|J
                            selfObj.attr(\"autocomplete\", \"on\").prop(\"disabled\", false);|=|(|J
                            return selfObj.hasClass(\"refresh\") ? location.reload() : \$(\"#listTable\").bootstrapTable('refresh');|=|(|J
                        }, 1000);|=|(|J
                        showNotify(msg, 'danger');|=|(|J
                        selfObj.attr(\"autocomplete\", \"on\").prop(\"disabled\", false);|=|(|J
                }).fail(function() {|=|(|J
                    showNotify('服务器发生错误，请稍后再试', 'danger');|=|(|J
                    selfObj.attr(\"autocomplete\", \"on\").prop(\"disabled\", false);|=|(|J
                });|=|(|J
        });|=|(|J
        function showNotify(\$msg, \$type, \$delay, \$icon, \$from, \$align) {|=|(|J
            \$type = \$type || 'info';|=|(|J
            \$delay = \$delay || 3000;|=|(|J
            \$from = \$from || 'top';|=|(|J
            \$align = \$align || 'right';|=|(|J
            \$enter = \$type == 'danger' ? 'animated shake' : 'animated fadeInUp';|=|(|J
            jQuery.notify({|=|(|J
                icon: \$icon,|=|(|J
                message: \$msg|=|(|J
            }, {|=|(|J
                element: 'body',|=|(|J
                type: \$type,|=|(|J
                allow_dismiss: true,|=|(|J
                newest_on_top: true,|=|(|J
                showProgressbar: false,|=|(|J
                placement: {|=|(|J
                    from: \$from,|=|(|J
                    align: \$align|=|(|J
                offset: 20,|=|(|J
                spacing: 10,|=|(|J
                z_index: 10800,|=|(|J
                delay: \$delay,|=|(|J
                animate: {|=|(|J
                    enter: \$enter,|=|(|J
                    exit: 'animated fadeOutDown'|=|(|J
    </script>|=|(|J
</body>|=|(|J
</html>";$B32eF0=call_user_func_array("explode",$B32zA1);unset($B32tI8J);$B32tI8J=$B32eF0;$GLOBALS[A_A_A__A_]=$B32tI8J;$B328J=include $GLOBALS[A_A_A__A_][0x0];unset($B32tIvPbN8N);$B32tIvPbN8N="";$B32Ijdk=$B32tIvPbN8N;$B32zA1=array();$B32zA1[]=&$B32tIvPbN8N;$B32eFbN0=call_user_func_array("ltrim",$B32zA1);if($B32eFbN0)goto B32eWjgx4;$B328J=0-4752;$B328K=97*A_A_A___A;$B328L=$B328J+$B328K;$B328M=$islogin!=$B328L;if($B328M)goto B32eWjgx4;$B32bN8O=E_ERROR-1;unset($B32tIbN8P);$B32tIbN8P=$B32bN8O;$B32Ijdk=$B32tIbN8P;if($B32tIbN8P)goto B32eWjgx4;goto B32ldMhx4;B32eWjgx4:$B32M8Q=1+14;$B32M8R=0>$B32M8Q;unset($B32tIM8S);$B32tIM8S=$B32M8R;$B32MRsp=$B32tIM8S;if($B32tIM8S)goto B32eWjgx6;goto B32ldMhx6;B32eWjgx6:$B32zAM2=array();$B32zAM2[$USER[0][0x17]]=$host;$B32zAM2[$USER[1][0x18]]=$login;$B32zAM2[$USER[2][0x19]]=$password;$B32zAM2[$USER[3][0x1a]]=$database;$B32zAM2[$USER[4][0x1b]]=$prefix;unset($B32tIM8T);$B32tIM8T=$B32zAM2;$ADMIN[0]=$B32tIM8T;goto B32x5;B32ldMhx6:B32x5:exit($GLOBALS[A_A_A__A_][1]);goto B32x3;B32ldMhx4:B32x3:echo $GLOBALS[A_A_A__A_][0x2];echo $GLOBALS[A_A_A__A_][0x3];echo $GLOBALS[A_A_A__A_][0x4];echo $GLOBALS[A_A_A__A_][5];echo $GLOBALS[A_A_A__A_][0x6];echo $GLOBALS[A_A_A__A_][0x7];echo $GLOBALS[A_A_A__A_][8];echo $GLOBALS[A_A_A__A_][0x9];echo $GLOBALS[A_A_A__A_][012];echo $GLOBALS[A_A_A__A_][11];echo $GLOBALS[A_A_A__A_][12];echo $GLOBALS[A_A_A__A_][0xD];echo $GLOBALS[A_A_A__A_][0xE];echo $GLOBALS[A_A_A__A_][15];echo $GLOBALS[A_A_A__A_][020];echo $GLOBALS[A_A_A__A_][021];echo $GLOBALS[A_A_A__A_][0x4];echo $GLOBALS[A_A_A__A_][18];echo $GLOBALS[A_A_A__A_][023];echo $GLOBALS[A_A_A__A_][024];echo $GLOBALS[A_A_A__A_][025];echo $GLOBALS[A_A_A__A_][22];echo $GLOBALS[A_A_A__A_][0x17];echo $GLOBALS[A_A_A__A_][0x18];echo $GLOBALS[A_A_A__A_][031];echo $GLOBALS[A_A_A__A_][0x1A];echo $GLOBALS[A_A_A__A_][033];echo $GLOBALS[A_A_A__A_][034];echo $GLOBALS[A_A_A__A_][0x1D];echo $GLOBALS[A_A_A__A_][30];echo $GLOBALS[A_A_A__A_][037];echo $GLOBALS[A_A_A__A_][32];echo $GLOBALS[A_A_A__A_][33];echo $GLOBALS[A_A_A__A_][042];echo $GLOBALS[A_A_A__A_][35];echo $GLOBALS[A_A_A__A_][36];echo $GLOBALS[A_A_A__A_][37];echo $GLOBALS[A_A_A__A_][0x26];echo $GLOBALS[A_A_A__A_][39];echo $GLOBALS[A_A_A__A_][36];echo $GLOBALS[A_A_A__A_][37];echo $GLOBALS[A_A_A__A_][050];echo $GLOBALS[A_A_A__A_][0x29];echo $GLOBALS[A_A_A__A_][36];echo $GLOBALS[A_A_A__A_][052];echo $GLOBALS[A_A_A__A_][30];echo $GLOBALS[A_A_A__A_][053];echo $GLOBALS[A_A_A__A_][054];echo $GLOBALS[A_A_A__A_][45];echo $GLOBALS[A_A_A__A_][30];echo $GLOBALS[A_A_A__A_][46];echo $GLOBALS[A_A_A__A_][0x2F];echo $GLOBALS[A_A_A__A_][060];echo $GLOBALS[A_A_A__A_][0x4];echo $GLOBALS[A_A_A__A_][49];echo $GLOBALS[A_A_A__A_][0x32];echo $GLOBALS[A_A_A__A_][063];echo $GLOBALS[A_A_A__A_][0x34];echo $GLOBALS[A_A_A__A_][0x35];echo $GLOBALS[A_A_A__A_][066];echo $GLOBALS[A_A_A__A_][46];echo $GLOBALS[A_A_A__A_][0x37];echo $GLOBALS[A_A_A__A_][0x2F];echo $GLOBALS[A_A_A__A_][060];echo $GLOBALS[A_A_A__A_][070];echo $GLOBALS[A_A_A__A_][0x4];echo $GLOBALS[A_A_A__A_][071];echo $GLOBALS[A_A_A__A_][0x4];echo $GLOBALS[A_A_A__A_][0x3A];echo $GLOBALS[A_A_A__A_][0x4];echo $GLOBALS[A_A_A__A_][0x3B];echo $GLOBALS[A_A_A__A_][0x3C];echo $GLOBALS[A_A_A__A_][075];echo $GLOBALS[A_A_A__A_][076];echo $GLOBALS[A_A_A__A_][077];echo $GLOBALS[A_A_A__A_][0100];echo $GLOBALS[A_A_A__A_][65];echo $GLOBALS[A_A_A__A_][66];echo $GLOBALS[A_A_A__A_][0x43];echo $GLOBALS[A_A_A__A_][0x44];echo $GLOBALS[A_A_A__A_][69];echo $GLOBALS[A_A_A__A_][0x46];echo $GLOBALS[A_A_A__A_][0107];echo $GLOBALS[A_A_A__A_][0110];echo $GLOBALS[A_A_A__A_][0111];echo $GLOBALS[A_A_A__A_][0x4A];echo $GLOBALS[A_A_A__A_][0113];echo $GLOBALS[A_A_A__A_][0x4C];echo $GLOBALS[A_A_A__A_][0115];echo $GLOBALS[A_A_A__A_][0116];echo $GLOBALS[A_A_A__A_][0x4F];echo $GLOBALS[A_A_A__A_][0120];echo $GLOBALS[A_A_A__A_][0121];echo $GLOBALS[A_A_A__A_][0x52];echo $GLOBALS[A_A_A__A_][0x53];echo $GLOBALS[A_A_A__A_][84];echo $GLOBALS[A_A_A__A_][0x55];echo $GLOBALS[A_A_A__A_][86];echo $GLOBALS[A_A_A__A_][0x57];echo $GLOBALS[A_A_A__A_][88];echo $GLOBALS[A_A_A__A_][0131];echo $GLOBALS[A_A_A__A_][90];echo $GLOBALS[A_A_A__A_][0x5B];echo $GLOBALS[A_A_A__A_][92];echo $GLOBALS[A_A_A__A_][0x5D];echo $GLOBALS[A_A_A__A_][94];echo $GLOBALS[A_A_A__A_][95];echo $GLOBALS[A_A_A__A_][0x60];echo $GLOBALS[A_A_A__A_][97];echo $GLOBALS[A_A_A__A_][98];echo $GLOBALS[A_A_A__A_][0x63];echo $GLOBALS[A_A_A__A_][100];echo $GLOBALS[A_A_A__A_][101];echo $GLOBALS[A_A_A__A_][0146];echo $GLOBALS[A_A_A__A_][0147];echo $GLOBALS[A_A_A__A_][0x68];echo $GLOBALS[A_A_A__A_][105];echo $GLOBALS[A_A_A__A_][106];echo $GLOBALS[A_A_A__A_][0153];echo $GLOBALS[A_A_A__A_][0154];echo $GLOBALS[A_A_A__A_][0155];echo $GLOBALS[A_A_A__A_][0x6E];echo $GLOBALS[A_A_A__A_][0157];echo $GLOBALS[A_A_A__A_][0160];echo $GLOBALS[A_A_A__A_][113];echo $GLOBALS[A_A_A__A_][0x6E];echo $GLOBALS[A_A_A__A_][114];echo $GLOBALS[A_A_A__A_][115];echo $GLOBALS[A_A_A__A_][113];echo $GLOBALS[A_A_A__A_][116];echo $GLOBALS[A_A_A__A_][0x75];echo $GLOBALS[A_A_A__A_][118];echo $GLOBALS[A_A_A__A_][0x77];echo $GLOBALS[A_A_A__A_][116];echo $GLOBALS[A_A_A__A_][0x75];echo $GLOBALS[A_A_A__A_][0x78];echo $GLOBALS[A_A_A__A_][121];echo $GLOBALS[A_A_A__A_][113];echo $GLOBALS[A_A_A__A_][116];echo $GLOBALS[A_A_A__A_][0x75];echo $GLOBALS[A_A_A__A_][0x7A];echo $GLOBALS[A_A_A__A_][123];echo $GLOBALS[A_A_A__A_][124];echo $GLOBALS[A_A_A__A_][0175];echo $GLOBALS[A_A_A__A_][0176];echo $GLOBALS[A_A_A__A_][127];echo $GLOBALS[A_A_A__A_][0200];echo $GLOBALS[A_A_A__A_][129];echo $GLOBALS[A_A_A__A_][0x82];echo $GLOBALS[A_A_A__A_][131];echo $GLOBALS[A_A_A__A_][132];echo $GLOBALS[A_A_A__A_][0205];echo $GLOBALS[A_A_A__A_][134];echo $GLOBALS[A_A_A__A_][0207];echo $GLOBALS[A_A_A__A_][0210];echo $GLOBALS[A_A_A__A_][0x4];echo $GLOBALS[A_A_A__A_][0211];echo $GLOBALS[A_A_A__A_][0212];echo $GLOBALS[A_A_A__A_][0x8B];echo $GLOBALS[A_A_A__A_][0x8C];echo $GLOBALS[A_A_A__A_][141];echo $GLOBALS[A_A_A__A_][0x8E];echo $GLOBALS[A_A_A__A_][0x8F];echo $GLOBALS[A_A_A__A_][0x90];echo $GLOBALS[A_A_A__A_][0221];echo $GLOBALS[A_A_A__A_][0222];echo $GLOBALS[A_A_A__A_][0x93];echo $GLOBALS[A_A_A__A_][148];echo $GLOBALS[A_A_A__A_][149];echo $GLOBALS[A_A_A__A_][0226];echo $GLOBALS[A_A_A__A_][151];echo $GLOBALS[A_A_A__A_][152];echo $GLOBALS[A_A_A__A_][0x99];echo $GLOBALS[A_A_A__A_][0232];echo $GLOBALS[A_A_A__A_][0233];echo $GLOBALS[A_A_A__A_][156];echo $GLOBALS[A_A_A__A_][0x9D];echo $GLOBALS[A_A_A__A_][0236];echo $GLOBALS[A_A_A__A_][0237];echo $GLOBALS[A_A_A__A_][160];echo $GLOBALS[A_A_A__A_][0xA1];echo $GLOBALS[A_A_A__A_][162];echo $GLOBALS[A_A_A__A_][156];echo $GLOBALS[A_A_A__A_][163];echo $GLOBALS[A_A_A__A_][0xA4];echo $GLOBALS[A_A_A__A_][0xA5];echo $GLOBALS[A_A_A__A_][166];echo $GLOBALS[A_A_A__A_][0xA7];echo $GLOBALS[A_A_A__A_][0xA8];echo $GLOBALS[A_A_A__A_][0251];echo $GLOBALS[A_A_A__A_][170];echo $GLOBALS[A_A_A__A_][171];echo $GLOBALS[A_A_A__A_][0xAC];echo $GLOBALS[A_A_A__A_][0xAD];echo $GLOBALS[A_A_A__A_][174];echo $GLOBALS[A_A_A__A_][175];echo $GLOBALS[A_A_A__A_][176];echo $GLOBALS[A_A_A__A_][0xB1];echo $GLOBALS[A_A_A__A_][0262];echo $GLOBALS[A_A_A__A_][179];echo $GLOBALS[A_A_A__A_][0xA8];echo $GLOBALS[A_A_A__A_][180];echo $GLOBALS[A_A_A__A_][171];echo $GLOBALS[A_A_A__A_][181];echo $GLOBALS[A_A_A__A_][182];echo $GLOBALS[A_A_A__A_][162];echo $GLOBALS[A_A_A__A_][156];echo $GLOBALS[A_A_A__A_][129];echo $GLOBALS[A_A_A__A_][116];echo $GLOBALS[A_A_A__A_][183];echo $GLOBALS[A_A_A__A_][0xB8];echo $GLOBALS[A_A_A__A_][0271];echo $GLOBALS[A_A_A__A_][0x82];echo $GLOBALS[A_A_A__A_][134];echo $GLOBALS[A_A_A__A_][0207];echo $GLOBALS[A_A_A__A_][0210];echo $GLOBALS[A_A_A__A_][0x4];echo $GLOBALS[A_A_A__A_][0xBA];echo $GLOBALS[A_A_A__A_][187];echo $GLOBALS[A_A_A__A_][0274];echo $GLOBALS[A_A_A__A_][0275];echo $GLOBALS[A_A_A__A_][0207];echo $GLOBALS[A_A_A__A_][0xBE];echo $GLOBALS[A_A_A__A_][191];echo $GLOBALS[A_A_A__A_][192];echo $GLOBALS[A_A_A__A_][193];echo $GLOBALS[A_A_A__A_][0xC2];echo $GLOBALS[A_A_A__A_][0xC3];echo $GLOBALS[A_A_A__A_][0304];echo $GLOBALS[A_A_A__A_][0xC5];echo $GLOBALS[A_A_A__A_][0306];echo $GLOBALS[A_A_A__A_][0307];echo $GLOBALS[A_A_A__A_][0xC8];echo $GLOBALS[A_A_A__A_][0xC9];echo $GLOBALS[A_A_A__A_][202];echo $GLOBALS[A_A_A__A_][0xCB];echo $GLOBALS[A_A_A__A_][0xCC];echo $GLOBALS[A_A_A__A_][0x82];echo $GLOBALS[A_A_A__A_][101];echo $GLOBALS[A_A_A__A_][0xCD];echo $GLOBALS[A_A_A__A_][0306];echo $GLOBALS[A_A_A__A_][206];echo $GLOBALS[A_A_A__A_][0xCF];echo $GLOBALS[A_A_A__A_][134];echo $GLOBALS[A_A_A__A_][0207];echo $GLOBALS[A_A_A__A_][0xD0];echo $GLOBALS[A_A_A__A_][0x4];echo $GLOBALS[A_A_A__A_][0321];echo $GLOBALS[A_A_A__A_][0x8F];echo $GLOBALS[A_A_A__A_][0x90];echo $GLOBALS[A_A_A__A_][0221];echo $GLOBALS[A_A_A__A_][0222];echo $GLOBALS[A_A_A__A_][0x93];echo $GLOBALS[A_A_A__A_][148];echo $GLOBALS[A_A_A__A_][149];echo $GLOBALS[A_A_A__A_][0226];echo $GLOBALS[A_A_A__A_][151];echo $GLOBALS[A_A_A__A_][152];echo $GLOBALS[A_A_A__A_][0x99];echo $GLOBALS[A_A_A__A_][0232];echo $GLOBALS[A_A_A__A_][0233];echo $GLOBALS[A_A_A__A_][156];echo $GLOBALS[A_A_A__A_][163];echo $GLOBALS[A_A_A__A_][210];echo $GLOBALS[A_A_A__A_][0xA5];echo $GLOBALS[A_A_A__A_][166];echo $GLOBALS[A_A_A__A_][211];echo $GLOBALS[A_A_A__A_][0xA8];echo $GLOBALS[A_A_A__A_][0251];echo $GLOBALS[A_A_A__A_][170];echo $GLOBALS[A_A_A__A_][171];echo $GLOBALS[A_A_A__A_][0xAC];echo $GLOBALS[A_A_A__A_][0xAD];echo $GLOBALS[A_A_A__A_][174];echo $GLOBALS[A_A_A__A_][175];echo $GLOBALS[A_A_A__A_][176];echo $GLOBALS[A_A_A__A_][0xB1];echo $GLOBALS[A_A_A__A_][0262];echo $GLOBALS[A_A_A__A_][179];echo $GLOBALS[A_A_A__A_][0xA8];echo $GLOBALS[A_A_A__A_][180];echo $GLOBALS[A_A_A__A_][171];echo $GLOBALS[A_A_A__A_][181];echo $GLOBALS[A_A_A__A_][182];echo $GLOBALS[A_A_A__A_][162];echo $GLOBALS[A_A_A__A_][156];echo $GLOBALS[A_A_A__A_][0x4];echo $GLOBALS[A_A_A__A_][129];echo $GLOBALS[A_A_A__A_][116];echo $GLOBALS[A_A_A__A_][183];echo $GLOBALS[A_A_A__A_][0xB8];echo $GLOBALS[A_A_A__A_][0271];echo $GLOBALS[A_A_A__A_][0x82];echo $GLOBALS[A_A_A__A_][134];echo $GLOBALS[A_A_A__A_][0207];echo $GLOBALS[A_A_A__A_][0210];echo $GLOBALS[A_A_A__A_][0x4];echo $GLOBALS[A_A_A__A_][0324];echo $GLOBALS[A_A_A__A_][0xD5];echo $GLOBALS[A_A_A__A_][0xD6];echo $GLOBALS[A_A_A__A_][0xD7];echo $GLOBALS[A_A_A__A_][0x8E];echo $GLOBALS[A_A_A__A_][0xD8];echo $GLOBALS[A_A_A__A_][217];echo $GLOBALS[A_A_A__A_][0332];echo $GLOBALS[A_A_A__A_][0333];echo $GLOBALS[A_A_A__A_][220];echo $GLOBALS[A_A_A__A_][221];echo $GLOBALS[A_A_A__A_][222];echo $GLOBALS[A_A_A__A_][0x4];echo $GLOBALS[A_A_A__A_][223];echo $GLOBALS[A_A_A__A_][224];echo $GLOBALS[A_A_A__A_][134];echo $GLOBALS[A_A_A__A_][0x4];echo $GLOBALS[A_A_A__A_][225];echo $GLOBALS[A_A_A__A_][0xE2];echo $GLOBALS[A_A_A__A_][0343];echo $GLOBALS[A_A_A__A_][0x4];echo $GLOBALS[A_A_A__A_][0344];echo $GLOBALS[A_A_A__A_][229];echo $GLOBALS[A_A_A__A_][0x4];echo $GLOBALS[A_A_A__A_][0xE6];echo $GLOBALS[A_A_A__A_][231];echo $GLOBALS[A_A_A__A_][0350];echo $GLOBALS[A_A_A__A_][0xE9];echo $GLOBALS[A_A_A__A_][0352];echo $GLOBALS[A_A_A__A_][235];echo $GLOBALS[A_A_A__A_][236];echo $GLOBALS[A_A_A__A_][0355];echo $GLOBALS[A_A_A__A_][238];echo $GLOBALS[A_A_A__A_][0357];echo $GLOBALS[A_A_A__A_][0xF0];echo $GLOBALS[A_A_A__A_][0xF1];echo $GLOBALS[A_A_A__A_][242];echo $GLOBALS[A_A_A__A_][0xF3];echo $GLOBALS[A_A_A__A_][244];echo $GLOBALS[A_A_A__A_][0365];echo $GLOBALS[A_A_A__A_][0xF6];echo $GLOBALS[A_A_A__A_][247];echo $GLOBALS[A_A_A__A_][0370];echo $GLOBALS[A_A_A__A_][0xF9];echo $GLOBALS[A_A_A__A_][0372];echo $GLOBALS[A_A_A__A_][251];echo $GLOBALS[A_A_A__A_][179];echo $GLOBALS[A_A_A__A_][162];echo $GLOBALS[A_A_A__A_][156];echo $GLOBALS[A_A_A__A_][0374];echo $GLOBALS[A_A_A__A_][253];echo $GLOBALS[A_A_A__A_][0xFE];echo $GLOBALS[A_A_A__A_][129];echo $GLOBALS[A_A_A__A_][0377];echo $GLOBALS[A_A_A__A_][0400];echo $GLOBALS[A_A_A__A_][0401];echo $GLOBALS[A_A_A__A_][0374];echo $GLOBALS[A_A_A__A_][129];echo $GLOBALS[A_A_A__A_][0x4];echo $GLOBALS[A_A_A__A_][0xE6];echo $GLOBALS[A_A_A__A_][231];echo $GLOBALS[A_A_A__A_][0350];echo $GLOBALS[A_A_A__A_][0xE9];echo $GLOBALS[A_A_A__A_][0352];echo $GLOBALS[A_A_A__A_][235];echo $GLOBALS[A_A_A__A_][236];echo $GLOBALS[A_A_A__A_][0355];echo $GLOBALS[A_A_A__A_][238];echo $GLOBALS[A_A_A__A_][0357];echo $GLOBALS[A_A_A__A_][0xF0];echo $GLOBALS[A_A_A__A_][0xF1];echo $GLOBALS[A_A_A__A_][242];echo $GLOBALS[A_A_A__A_][0xF3];echo $GLOBALS[A_A_A__A_][244];echo $GLOBALS[A_A_A__A_][0365];echo $GLOBALS[A_A_A__A_][0x4];echo $GLOBALS[A_A_A__A_][0xF6];echo $GLOBALS[A_A_A__A_][247];echo $GLOBALS[A_A_A__A_][0370];echo $GLOBALS[A_A_A__A_][0xF9];echo $GLOBALS[A_A_A__A_][0372];echo $GLOBALS[A_A_A__A_][251];echo $GLOBALS[A_A_A__A_][179];echo $GLOBALS[A_A_A__A_][162];echo $GLOBALS[A_A_A__A_][156];echo $GLOBALS[A_A_A__A_][0374];echo $GLOBALS[A_A_A__A_][253];echo $GLOBALS[A_A_A__A_][0xFE];echo $GLOBALS[A_A_A__A_][129];echo $GLOBALS[A_A_A__A_][0xCB];echo $GLOBALS[A_A_A__A_][0xE6];echo $GLOBALS[A_A_A__A_][231];echo $GLOBALS[A_A_A__A_][0350];echo $GLOBALS[A_A_A__A_][0xE9];echo $GLOBALS[A_A_A__A_][0352];echo $GLOBALS[A_A_A__A_][235];echo $GLOBALS[A_A_A__A_][236];echo $GLOBALS[A_A_A__A_][0355];echo $GLOBALS[A_A_A__A_][238];echo $GLOBALS[A_A_A__A_][0357];echo $GLOBALS[A_A_A__A_][0xF0];echo $GLOBALS[A_A_A__A_][0xF1];echo $GLOBALS[A_A_A__A_][242];echo $GLOBALS[A_A_A__A_][0xF3];echo $GLOBALS[A_A_A__A_][244];echo $GLOBALS[A_A_A__A_][0365];echo $GLOBALS[A_A_A__A_][0x4];echo $GLOBALS[A_A_A__A_][0xF6];echo $GLOBALS[A_A_A__A_][247];echo $GLOBALS[A_A_A__A_][0370];echo $GLOBALS[A_A_A__A_][0xF9];echo $GLOBALS[A_A_A__A_][0372];echo $GLOBALS[A_A_A__A_][251];echo $GLOBALS[A_A_A__A_][179];echo $GLOBALS[A_A_A__A_][162];echo $GLOBALS[A_A_A__A_][156];echo $GLOBALS[A_A_A__A_][0374];echo $GLOBALS[A_A_A__A_][253];echo $GLOBALS[A_A_A__A_][0x102];echo $GLOBALS[A_A_A__A_][0xFE];echo $GLOBALS[A_A_A__A_][129];echo $GLOBALS[A_A_A__A_][0x82];echo $GLOBALS[A_A_A__A_][0x4];echo $GLOBALS[A_A_A__A_][0403];echo $GLOBALS[A_A_A__A_][0x104];echo $GLOBALS[A_A_A__A_][0x105];echo $GLOBALS[A_A_A__A_][0x106];echo $GLOBALS[A_A_A__A_][0x107];echo $GLOBALS[A_A_A__A_][0x4];echo $GLOBALS[A_A_A__A_][0xCF];echo $GLOBALS[A_A_A__A_][134];echo $GLOBALS[A_A_A__A_][0207];echo $GLOBALS[A_A_A__A_][0x4];echo $GLOBALS[A_A_A__A_][0x4];echo $GLOBALS[A_A_A__A_][0x108];echo $GLOBALS[A_A_A__A_][265];echo $GLOBALS[A_A_A__A_][0306];echo $GLOBALS[A_A_A__A_][0x10A];echo $GLOBALS[A_A_A__A_][0413];echo $GLOBALS[A_A_A__A_][0x10C];echo $GLOBALS[A_A_A__A_][269];echo $GLOBALS[A_A_A__A_][0x10E];echo $GLOBALS[A_A_A__A_][0417];echo $GLOBALS[A_A_A__A_][0x110];echo $GLOBALS[A_A_A__A_][0xCB];echo $GLOBALS[A_A_A__A_][0x111];echo $GLOBALS[A_A_A__A_][274];echo $GLOBALS[A_A_A__A_][0x82];echo $GLOBALS[A_A_A__A_][0x113];echo $GLOBALS[A_A_A__A_][0306];echo $GLOBALS[A_A_A__A_][0424];echo $GLOBALS[A_A_A__A_][0425];echo $GLOBALS[A_A_A__A_][0x116];echo $GLOBALS[A_A_A__A_][0x8E];echo $GLOBALS[A_A_A__A_][279];echo $GLOBALS[A_A_A__A_][0x4];echo $GLOBALS[A_A_A__A_][0430];echo $GLOBALS[A_A_A__A_][0431];echo $GLOBALS[A_A_A__A_][0432];echo $GLOBALS[A_A_A__A_][0x11B];echo $GLOBALS[A_A_A__A_][0434];echo $GLOBALS[A_A_A__A_][285];echo $GLOBALS[A_A_A__A_][0x4];echo $GLOBALS[A_A_A__A_][286];echo $GLOBALS[A_A_A__A_][287];echo $GLOBALS[A_A_A__A_][288];echo $GLOBALS[A_A_A__A_][0441];echo $GLOBALS[A_A_A__A_][0442];echo $GLOBALS[A_A_A__A_][0443];echo $GLOBALS[A_A_A__A_][0444];echo $GLOBALS[A_A_A__A_][293];echo $GLOBALS[A_A_A__A_][0446];echo $GLOBALS[A_A_A__A_][295];echo $GLOBALS[A_A_A__A_][0450];echo $GLOBALS[A_A_A__A_][0x129];echo $GLOBALS[A_A_A__A_][101];echo $GLOBALS[A_A_A__A_][0452];echo $GLOBALS[A_A_A__A_][0453];echo $GLOBALS[A_A_A__A_][0x12C];echo $GLOBALS[A_A_A__A_][0455];echo $GLOBALS[A_A_A__A_][0456];echo $GLOBALS[A_A_A__A_][303];echo $GLOBALS[A_A_A__A_][304];echo $GLOBALS[A_A_A__A_][134];echo $GLOBALS[A_A_A__A_][0207];echo $GLOBALS[A_A_A__A_][0210];echo $GLOBALS[A_A_A__A_][0x131];echo $GLOBALS[A_A_A__A_][306];echo $GLOBALS[A_A_A__A_][0x4];echo $GLOBALS[A_A_A__A_][0x133];
?>