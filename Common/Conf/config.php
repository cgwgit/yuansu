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
         //微信授权登录配置信息
    //'secret' => '608566b91ce68b2281a69c200698f176',
     //微信支付配置信息
     //"appid" => 'wx2ceec07b58f9bddc',
     //"mchid" => '1432685802',
     //"key" => '483a7b92d286d87b8b622b0285b38d1f',
     'secret' => '5d589955487c40d34e7a113643f95426',
     "appid" => 'wxbf62c184cea7890c',
     "mchid" => '1390091802',
     "key" => 'shangruweilai8888888888888888886',
    'redirect_uri' => 'http://166xj71935.51mypc.cn/index.php/Home/Index/index',
    //设置跟踪日志(以便查看function.php文件是否被引入)
    // 'TMPL_L_DELIM'          =>  '<{',            // 模板引擎普通标签开始标记  
    // 'TMPL_R_DELIM'          =>  '}>',            // 模板引擎普通标签结束标记  
    // 'TMPL_EXCEPTION_FILE'   =>  './Public/error.html',// 异常页面的模板文件
);