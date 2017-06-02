<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE HTML>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit|ie-comp|ie-stand">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
        <meta http-equiv="Cache-Control" content="no-siteapp" />
        <!--[if lt IE 9]>
<script type="text/javascript" src="/Public/lib/html5shiv.js"></script>
<script type="text/javascript" src="/Public/lib/respond.min.js"></script>
<![endif]-->
        <link rel="stylesheet" type="text/css" href="/Public/static/h-ui/css/H-ui.min.css" />
        <link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/H-ui.admin.css" />
        <link rel="stylesheet" type="text/css" href="/Public/lib/Hui-iconfont/1.0.8/iconfont.css" />
        <link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/skin/default/skin.css" id="skin" />
        <link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/style.css" />
        <link rel="stylesheet" type="text/css" href="/Public/css/public.css" />
        <link href="/Public/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="http://api.map.baidu.com/api?v=1.2"></script>
        <style type="text/css">
            
            input{
            	border: none;
            }
        </style>
        <!--[if IE 6]>
<script type="text/javascript" src="/Public/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
        <title>查看新品</title>
        <meta name="keywords" content="">
        <meta name="description" content="">
    </head>

    <body>
        <div class="page-container">
            <article class="page-container pl-20 pr-20">
                <form class="form form-horizontal" id="form-article-add" method="post" action="/index.php/Admin/XinPin/editShop" enctype="multipart/form-data" onsubmit="return false">
                    <div class="row cl">
                        <label class="col-xs-4 col-sm-2 text-r">新品名称：</label>
                        <div class="col-xs-8 col-sm-9">
                            <?php echo ($xinpin['xinpin_name']); ?>
                        </div>
                    </div>
                    <div class="row cl">
                       <label class="col-xs-4 col-sm-2 text-r">新品展示图片：</label>
                       <div class="col-xs-8 col-sm-9">
                            <div id="default">
                                  <img src="<?php echo substr($xinpin['xinpin_logo'],1) ?>">
                            </div>
                       </div>
                    </div>
                </form>
            </article>
        </div>
        <!--_footer 作为公共模版分离出去-->
        <script type="text/javascript" src="/Public/lib/jquery/1.9.1/jquery.min.js"></script>
        <script type="text/javascript" src="/Public/lib/layer/2.4/layer.js"></script>
        <script type="text/javascript" src="/Public/static/h-ui/js/H-ui.min.js"></script>
        <script type="text/javascript" src="/Public/static/h-ui.admin/js/H-ui.admin.js"></script>
        <!--/_footer 作为公共模版分离出去-->
        <!--请在下方写此页面业务相关的脚本-->
        <script type="text/javascript" src="/Public/lib/My97DatePicker/4.8/WdatePicker.js"></script>
        <script type="text/javascript" src="/Public/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
        <script type="text/javascript" src="/Public/lib/jquery.validation/1.14.0/validate-methods.js"></script>
        <script type="text/javascript" src="/Public/lib/jquery.validation/1.14.0/messages_zh.js"></script>
        <script type="text/javascript" src="/Public/lib/webuploader/0.1.5/webuploader.min.js"></script>
        <script type="text/javascript" src="/Public/lib/ueditor/1.4.3/ueditor.config.js"></script>
        <script type="text/javascript" src="/Public/lib/ueditor/1.4.3/ueditor.all.min.js">
        </script>
        <script type="text/javascript" src="/Public/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
    </body>

</html>