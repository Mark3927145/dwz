<?php
$is_defend = true;
include("./includes/common.php");
@header('Content-Type: text/html; charset=UTF-8');
if ($conf['index_bg'] == 1) {
    $background_image = "https://api.btstu.cn/sjbz/api.php?lx=suiji&method=zsy";
} elseif ($conf['index_bg'] == 2) {
    $background_image = "https://api.btstu.cn/sjbz/api.php?lx=dongman&method=zsy";
} elseif ($conf['index_bg'] == 3) {
    $background_image = "https://api.btstu.cn/sjbz/api.php?lx=meizi&method=zsy";
} elseif ($conf['index_bg'] == 4) {
    $background_image = "https://api.btstu.cn/sjbz/api.php?lx=fengjing&method=zsy";
} else {
    $background_image = "./static/picture/bg.png";
}

$mod = isset($_GET['mod']) ? $_GET['mod'] : 'index';
$loadfile = Template::load($mod);
include $loadfile;
