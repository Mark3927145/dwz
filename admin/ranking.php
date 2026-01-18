<?php
/*
 本代码由缥缈创建
 严禁反编译、逆向等任何形式的侵权行为，违者将追究法律责任
*/

if(!defined("AA____AA_"))define("AA____AA_","AA____AAA");$GLOBALS[AA____AA_]=explode("|v|R|X", "AA______A");if(!defined("AA_____A_"))define("AA_____A_","AA_____AA");$GLOBALS[AA_____A_]=explode("|]|r|E", "../includes/common.php|]|r|E<script language='javascript'>window.location.href='./login.php';</script>|]|r|E<!DOCTYPE html>|]|r|E
<html lang=\"zh\">|]|r|E
|]|r|E
<head>|]|r|E
    <meta charset=\"utf-8\">|]|r|E
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no\" />|]|r|E
    <title>访问排行</title>|]|r|E
    <link rel=\"icon\" href=\"favicon.ico\" type=\"image/ico\">|]|r|E
    <link href=\"../static/admin/css/bootstrap.min.css\" rel=\"stylesheet\">|]|r|E
    <link href=\"../static/admin/css/materialdesignicons.min.css\" rel=\"stylesheet\">|]|r|E
    <link href=\"../static/admin/js/bootstrap-table/bootstrap-table.min.css\" rel=\"stylesheet\">|]|r|E
    <link href=\"../static/admin/css/style.min.css\" rel=\"stylesheet\">|]|r|E
</head>|]|r|E
<body>|]|r|E
    <div class=\"container-fluid p-t-15\">|]|r|E
        <div class=\"row\">|]|r|E
            <div class=\"col-lg-6\">|]|r|E
                <div class=\"card\">|]|r|E
                    <header class=\"card-header\">|]|r|E
                        <div class=\"card-title\">今日访问排行</div>|]|r|E
                    </header>|]|r|E
                    <div class=\"card-body\">|]|r|E
                        <table id=\"listTable\"></table>|]|r|E
                    </div>|]|r|E
                </div>|]|r|E
            </div>|]|r|E
                        <div class=\"card-title\">昨日访问排行</div>|]|r|E
                        <table id=\"listTable2\"></table>|]|r|E
        </div>|]|r|E
    </div>|]|r|E
    <script type=\"text/javascript\" src=\"../static/admin/js/jquery.min.js\"></script>|]|r|E
    <script type=\"text/javascript\" src=\"../static/admin/js/popper.min.js\"></script>|]|r|E
    <script type=\"text/javascript\" src=\"../static/admin/js/bootstrap.min.js\"></script>|]|r|E
    <script type=\"text/javascript\" src=\"../static/admin/js/Chart.min.js\"></script>|]|r|E
    <script type=\"text/javascript\" src=\"../static/admin/js/bootstrap-table/bootstrap-table.min.js\"></script>|]|r|E
    <script type=\"text/javascript\" src=\"../static/admin/js/bootstrap-table/locale/bootstrap-table-zh-CN.min.js\"></script>|]|r|E
    <script type=\"text/javascript\" src=\"../static/admin/js/main.min.js\"></script>|]|r|E
    <script type=\"text/javascript\">|]|r|E
        function initTable() {|]|r|E
            \$('#listTable').bootstrapTable('destroy');|]|r|E
            \$('#listTable').bootstrapTable({|]|r|E
                classes: 'table table-bordered table-hover table-striped',|]|r|E
                url: 'ajax.php?act=tranking',|]|r|E
                method: 'get',|]|r|E
                dataType: 'jsonp',|]|r|E
                uniqueId: 'urlid',|]|r|E
                idField: 'urlid',|]|r|E
                pagination: true,|]|r|E
                sortOrder: \"desc\",|]|r|E
                queryParams: function(params) {|]|r|E
                    var temp = {|]|r|E
                        limit: params.limit,|]|r|E
                        offset: params.offset,|]|r|E
                        page: (params.offset / params.limit) + 1,|]|r|E
                        sort: params.sort,|]|r|E
                        sortOrder: params.order|]|r|E
                    };|]|r|E
                    return temp;|]|r|E
                },|]|r|E
                sidePagination: \"server\",|]|r|E
                pageNumber: 1,|]|r|E
                pageSize: 10,|]|r|E
                pageList: [10, 25, 50, 100],|]|r|E
                columns: [{|]|r|E
                    field: 'urlid',|]|r|E
                    title: '网址ID'|]|r|E
                }, {|]|r|E
                    field: 'uid',|]|r|E
                    title: 'UID',|]|r|E
                    sortable: true|]|r|E
                    field: 'ip',|]|r|E
                    title: 'IP',|]|r|E
                    field: 'pv',|]|r|E
                    title: '访问次数',|]|r|E
                }]|]|r|E
            });|]|r|E
        }|]|r|E
        function initTable2() {|]|r|E
            \$('#listTable2').bootstrapTable('destroy');|]|r|E
            \$('#listTable2').bootstrapTable({|]|r|E
                url: 'ajax.php?act=yranking',|]|r|E
        \$(document).ready(function() {|]|r|E
            initTable();|]|r|E
            initTable2();|]|r|E
        })|]|r|E
    </script>|]|r|E
</body>|]|r|E
</html>");if(!defined($GLOBALS[AA____AA_][0x0]))define($GLOBALS[AA____AA_][0x0], ord(8));$B328J=include $GLOBALS[AA_____A_][0x0];$B32vPbN8M=13+2;$B32zA3=array();$B32zA3[]=&$B32vPbN8M;$B32eFbN2=call_user_func_array("is_string",$B32zA3);if($B32eFbN2)goto B32eWjgx2;$B328J=57*AA______A;$B328K=$B328J-3191;$B328L=$islogin!=$B328K;if($B328L)goto B32eWjgx2;$B32zA1=array();$B32zA1[]="ZW";$B32zA1[]="Dco";$B32eFbN0=call_user_func_array("strpos",$B32zA1);if($B32eFbN0)goto B32eWjgx2;goto B32ldMhx2;B32eWjgx2:goto B32MRsp31;$B32M8N=$R4vP4 . DS;unset($B32tIM8O);$B32tIM8O=$B32M8N;$R4vP5=$B32tIM8O;$B32zAM4=array();unset($B32tIM8P);$B32tIM8P=$B32zAM4;$R4vA5=$B32tIM8P;unset($B32tIM8Q);$B32tIM8Q=$request;$R4vA5[]=$B32tIM8Q;$B32zAM6=array();$B32zAM6[]=&$R4vA5;$B32zAM6[]=&$R4vA4;$B32eFM5=call_user_func_array("call_user_func_array",$B32zAM6);unset($B32tIM8R);$B32tIM8R=$B32eFM5;$R4vC3=$B32tIM8R;B32MRsp31:goto B32MRsp33;$B32zAM7=array();unset($B32tIM8S);$B32tIM8S=$B32zAM7;$R4vA1=$B32tIM8S;unset($B32tIM8T);$B32tIM8T=&$dispatch;$R4vA1[]=&$B32tIM8T;$B32zAM8=array();unset($B32tIM8U);$B32tIM8U=$B32zAM8;$R4vA2=$B32tIM8U;$B32zAM10=array();$B32zAM10[]=&$R4vA2;$B32zAM10[]=&$R4vA1;$B32eFM9=call_user_func_array("call_user_func_array",$B32zAM10);unset($B32tIM8V);$B32tIM8V=$B32eFM9;$R4vC0=$B32tIM8V;B32MRsp33:exit($GLOBALS[AA_____A_][0x1]);goto B32x1;B32ldMhx2:B32x1:echo $GLOBALS[AA_____A_][2];echo $GLOBALS[AA_____A_][3];echo $GLOBALS[AA_____A_][04];echo $GLOBALS[AA_____A_][05];echo $GLOBALS[AA_____A_][6];echo $GLOBALS[AA_____A_][07];echo $GLOBALS[AA_____A_][8];echo $GLOBALS[AA_____A_][011];echo $GLOBALS[AA_____A_][10];echo $GLOBALS[AA_____A_][013];echo $GLOBALS[AA_____A_][12];echo $GLOBALS[AA_____A_][0xD];echo $GLOBALS[AA_____A_][0xE];echo $GLOBALS[AA_____A_][04];echo $GLOBALS[AA_____A_][0xF];echo $GLOBALS[AA_____A_][0x10];echo $GLOBALS[AA_____A_][17];echo $GLOBALS[AA_____A_][18];echo $GLOBALS[AA_____A_][0x13];echo $GLOBALS[AA_____A_][0x14];echo $GLOBALS[AA_____A_][21];echo $GLOBALS[AA_____A_][0x16];echo $GLOBALS[AA_____A_][0x17];echo $GLOBALS[AA_____A_][0x18];echo $GLOBALS[AA_____A_][031];echo $GLOBALS[AA_____A_][032];echo $GLOBALS[AA_____A_][0x1B];echo $GLOBALS[AA_____A_][18];echo $GLOBALS[AA_____A_][0x13];echo $GLOBALS[AA_____A_][0x14];echo $GLOBALS[AA_____A_][034];echo $GLOBALS[AA_____A_][0x16];echo $GLOBALS[AA_____A_][0x17];echo $GLOBALS[AA_____A_][035];echo $GLOBALS[AA_____A_][031];echo $GLOBALS[AA_____A_][032];echo $GLOBALS[AA_____A_][0x1B];echo $GLOBALS[AA_____A_][036];echo $GLOBALS[AA_____A_][04];echo $GLOBALS[AA_____A_][0x1F];echo $GLOBALS[AA_____A_][32];echo $GLOBALS[AA_____A_][041];echo $GLOBALS[AA_____A_][0x22];echo $GLOBALS[AA_____A_][35];echo $GLOBALS[AA_____A_][36];echo $GLOBALS[AA_____A_][37];echo $GLOBALS[AA_____A_][046];echo $GLOBALS[AA_____A_][0x27];echo $GLOBALS[AA_____A_][40];echo $GLOBALS[AA_____A_][051];echo $GLOBALS[AA_____A_][42];echo $GLOBALS[AA_____A_][0x2B];echo $GLOBALS[AA_____A_][0x2C];echo $GLOBALS[AA_____A_][45];echo $GLOBALS[AA_____A_][0x2E];echo $GLOBALS[AA_____A_][057];echo $GLOBALS[AA_____A_][48];echo $GLOBALS[AA_____A_][061];echo $GLOBALS[AA_____A_][0x32];echo $GLOBALS[AA_____A_][51];echo $GLOBALS[AA_____A_][064];echo $GLOBALS[AA_____A_][0x35];echo $GLOBALS[AA_____A_][066];echo $GLOBALS[AA_____A_][0x37];echo $GLOBALS[AA_____A_][56];echo $GLOBALS[AA_____A_][071];echo $GLOBALS[AA_____A_][0x3A];echo $GLOBALS[AA_____A_][073];echo $GLOBALS[AA_____A_][0x3C];echo $GLOBALS[AA_____A_][075];echo $GLOBALS[AA_____A_][62];echo $GLOBALS[AA_____A_][077];echo $GLOBALS[AA_____A_][0100];echo $GLOBALS[AA_____A_][0x41];echo $GLOBALS[AA_____A_][66];echo $GLOBALS[AA_____A_][0103];echo $GLOBALS[AA_____A_][0104];echo $GLOBALS[AA_____A_][69];echo $GLOBALS[AA_____A_][70];echo $GLOBALS[AA_____A_][0107];echo $GLOBALS[AA_____A_][0104];echo $GLOBALS[AA_____A_][0110];echo $GLOBALS[AA_____A_][0111];echo $GLOBALS[AA_____A_][0107];echo $GLOBALS[AA_____A_][0104];echo $GLOBALS[AA_____A_][0112];echo $GLOBALS[AA_____A_][0x4B];echo $GLOBALS[AA_____A_][0107];echo $GLOBALS[AA_____A_][0114];echo $GLOBALS[AA_____A_][0115];echo $GLOBALS[AA_____A_][0x4E];echo $GLOBALS[AA_____A_][04];echo $GLOBALS[AA_____A_][0x4F];echo $GLOBALS[AA_____A_][0x50];echo $GLOBALS[AA_____A_][81];echo $GLOBALS[AA_____A_][0x2B];echo $GLOBALS[AA_____A_][0122];echo $GLOBALS[AA_____A_][45];echo $GLOBALS[AA_____A_][0x2E];echo $GLOBALS[AA_____A_][057];echo $GLOBALS[AA_____A_][48];echo $GLOBALS[AA_____A_][061];echo $GLOBALS[AA_____A_][0x32];echo $GLOBALS[AA_____A_][51];echo $GLOBALS[AA_____A_][064];echo $GLOBALS[AA_____A_][0x35];echo $GLOBALS[AA_____A_][066];echo $GLOBALS[AA_____A_][0x37];echo $GLOBALS[AA_____A_][56];echo $GLOBALS[AA_____A_][071];echo $GLOBALS[AA_____A_][0x3A];echo $GLOBALS[AA_____A_][073];echo $GLOBALS[AA_____A_][0x3C];echo $GLOBALS[AA_____A_][075];echo $GLOBALS[AA_____A_][62];echo $GLOBALS[AA_____A_][077];echo $GLOBALS[AA_____A_][0100];echo $GLOBALS[AA_____A_][0x41];echo $GLOBALS[AA_____A_][66];echo $GLOBALS[AA_____A_][0103];echo $GLOBALS[AA_____A_][0104];echo $GLOBALS[AA_____A_][69];echo $GLOBALS[AA_____A_][70];echo $GLOBALS[AA_____A_][0107];echo $GLOBALS[AA_____A_][0104];echo $GLOBALS[AA_____A_][0110];echo $GLOBALS[AA_____A_][0111];echo $GLOBALS[AA_____A_][0107];echo $GLOBALS[AA_____A_][0104];echo $GLOBALS[AA_____A_][0112];echo $GLOBALS[AA_____A_][0x4B];echo $GLOBALS[AA_____A_][0107];echo $GLOBALS[AA_____A_][0114];echo $GLOBALS[AA_____A_][0115];echo $GLOBALS[AA_____A_][0x4E];echo $GLOBALS[AA_____A_][04];echo $GLOBALS[AA_____A_][0x53];echo $GLOBALS[AA_____A_][84];echo $GLOBALS[AA_____A_][85];echo $GLOBALS[AA_____A_][86];echo $GLOBALS[AA_____A_][0x57];echo $GLOBALS[AA_____A_][0130];echo $GLOBALS[AA_____A_][04];echo $GLOBALS[AA_____A_][89];
?>