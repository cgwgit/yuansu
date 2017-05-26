<?php
return array(
	//'配置项'=>'配置值'
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'juyuansu',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'sp_',    // 数据库表前缀  
    'DB_DEBUG'              =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志
    'DB_FIELDS_CACHE'       =>  true,        // 启用字段缓存
    'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8
     'APPSECRET' => '608566b91ce68b2281a69c200698f176',
     "APPID" => 'wx2ceec07b58f9bddc',
    'redirect_uri' => 'http://166xj71935.51mypc.cn/index.php/Home/Index/index',
    // 'TMPL_EXCEPTION_FILE'   =>  './Public/error.html',// 异常页面的模板文件
);