<?php if (!defined('THINK_PATH')) exit();?><!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="Bookmark" href="/Public/images/favicon.ico">
    <link rel="Shortcut Icon" href="/Public/images/favicon.ico" />
    <!--[if lt IE 9]>
<script type="text/javascript" src="/Public/lib/html5shiv.js"></script>
<script type="text/javascript" src="/Public/lib/respond.min.js"></script>
<![endif]-->
    <link rel="stylesheet" type="text/css" href="/Public/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/Public/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/style.css" />
    <!--[if IE 6]>
<script type="text/javascript" src="/Public/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
    <!--/meta 作为公共模版分离出去-->
    <title>banner管理-编辑新品</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
</head>

<body>
    <article class="page-container">
        <form class="form form-horizontal" id="form-article-add" method="post" action="/index.php/Admin/XinPin/editBanner" enctype="multipart/form-data" onsubmit="return false">
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">新品名称：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text"  value="<?php echo ($xinpin['xinpin_name']); ?>" name="xinpin_Name">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">新品链接地址：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text"  value="<?php echo ($xinpin['xinpin_dizhi']); ?>" name="xinpin_url">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">新品图片：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="file" class="input-text" value="20" placeholder="" name="xinpin_Pic">
                    图片尺寸：(750*260px)
                    <img src="<?php echo (substr($xinpin['xinpin_logo'],1)) ?>" width="50" height="50"/>
                     <input type="hidden" name="yuanpic" value="<?php echo $xinpin['xinpin_logo'] ?>"></input>
                <input type="hidden" name="id" value="<?php echo $xinpin['id'] ?>"></input>
                </div>
            </div>
            <div class="row cl">
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                    <button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i>保存</button>
                </div>
            </div>
        </form>
    </article>
    <!--_footer 作为公共模版分离出去-->
    <script type="text/javascript" src="/Public/lib/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/lib/layer/2.4/layer.js"></script>
    <script type="text/javascript" src="/Public/static/h-ui/js/H-ui.min.js"></script>
    <script type="text/javascript" src="/Public/static/h-ui.admin/js/H-ui.admin.js"></script>
    <!--/_footer /作为公共模版分离出去-->
    <!--请在下方写此页面业务相关的脚本-->
    <script type="text/javascript" src="/Public/lib/My97DatePicker/4.8/WdatePicker.js"></script>
    <script type="text/javascript" src="/Public/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
    <script type="text/javascript" src="/Public/lib/jquery.validation/1.14.0/validate-methods.js"></script>
    <script type="text/javascript" src="/Public/lib/jquery.validation/1.14.0/messages_zh.js"></script>
    <script type="text/javascript" src="/Public/lib/webuploader/0.1.5/webuploader.min.js"></script>
    <!--
<script type="text/javascript" src="/Public/lib/ueditor/1.4.3/ueditor.config.js"></script> 
<script type="text/javascript" src="/Public/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>-->
    <script type="text/javascript">
    $(function() {
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });

        $("#form-article-add").validate({
            rules: {
                articletitle: {
                    required: true,
                },
            },
            onkeyup: false,
            focusCleanup: true,
            success: "valid",
            submitHandler: function(form) {
                $(form).ajaxSubmit({
                    type: 'post',
                    url: "/index.php/Admin/XinPin/editXinPin/",
                    data: $("form").serialize(),
                    dataType: "json",
                    success: function(data) {
                        if (data.code == 1) {
                            layer.msg(data.msg, {
                                icon: 1,
                                time: 1000
                            }, function() {
                                window.location.href = "/index.php/Admin/XinPin/showList";
                            });
                        } else if (data.code == 0) {
                            layer.msg(data.msg, {
                                icon: 2,
                                time: 1000
                            });
                        }
                    }
                });
                return false;
            }
        });

    });
    </script>
    <!--/请在上方写此页面业务相关的脚本-->
</body>

</html>