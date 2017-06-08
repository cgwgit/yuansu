<?php
header("content-type:text/html;charset =utf-8");
//方便插件文件引入
define('APP_DEBUG', true);
define('BASE_PATH','/ThinkPHP/Library/Vendor');
define('SITE_URL','http://166xj71935.51mypc.cn/');
define('PUBLIC_URL',SITE_URL."Public/");
//引入tp框架的接口文件
include("./ThinkPHP/ThinkPHP.php");  