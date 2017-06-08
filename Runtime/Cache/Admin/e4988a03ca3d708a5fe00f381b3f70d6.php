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
    <script type="text/javascript" charset="UTF-8" src="/Public/ueditor/ueditor.config.js"></script>  
    <script type="text/javascript" charset="UTF-8" src="/Public/ueditor/ueditor.all.min.js"> </script> 
     <script type="text/javascript" charset="utf-8" src="/Public/ueditor/lang/zh-cn/zh-cn.js"></script> 
    <!--[if IE 6]>
<script type="text/javascript" src="/Public/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
    <!--/meta 作为公共模版分离出去-->
    <title>banner管理-编辑产品</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
</head>

<body>
    <article class="page-container">
        <form class="form form-horizontal" id="form-article-add" enctype="multipart/form-data" onsubmit="return false">
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">产品简介：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text"  value="<?php echo ($goodsOne['goods_title']); ?>" name="goods_title">
                    <input type="hidden" class="input-text"  value="<?php echo ($goodsOne['id']); ?>" name="goods_id">
                </div>
            </div>
                      <script type="text/javascript">
                        function add_pics(){
                          $('#gallery-tab-show').append(' <div class="aa"> <label class="form-label col-xs-4 col-sm-2"><span class="STYLE19" onclick="$(this).parent().parent().remove()">[-]&nbsp;</span>产品logo图片：</label> <div class="formControls col-xs-8 col-sm-9"> <input type="file" class="input-text" value="20" placeholder="" name="goods_logo[]"> </div> </div>');
                        }

            /*商品-删除*/
            function activity_del(obj, pics_id) {
                layer.confirm('确认要删除吗？', function(index) {
                       $.ajax({
                            url:"/index.php/Admin/GoodsBuy/delPics",
                            data:{'pics_id':pics_id},
                            success:function(msg){
                              //dom方式删除li的元素节点对象
                              $('.pics_'+pics_id).remove();
                              layer.msg('已删除!', {
                                icon: 1,
                                time: 1000
                            });
                            }
                          });
                });
            }
            </script>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">产品logo图片：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <div id="default">
                              <?php if(is_array($goods_buy_pic)): foreach($goods_buy_pic as $key=>$v): ?><img class = "pics_<?php echo ($v["id"]); ?>" width="80px" height="80px" src="<?php echo substr($v['goods_buy_pic'],1) ?>"><span style='color:red;' class = "pics_<?php echo ($v["id"]); ?>" onclick="activity_del(this,'<?php echo $v['id'] ?>')">[-]</span><?php endforeach; endif; ?>
                    </div>
                </div>
            </div>
            <div class="row cl" id="gallery-tab-show">
              <div class="aa">
                <label class="form-label col-xs-4 col-sm-2"><span class="STYLE19" onclick="add_pics()">[+]&nbsp;</span>产品logo图片：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="file" class="input-text" value="20" placeholder="" name="goods_logo[]">
                </div>
              </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">产品价格：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="number" class="input-text" value="<?php echo ($goodsOne['goods_price']); ?>" name="goods_price">
                </div>
            </div>
             <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">运费价格：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="number" class="input-text"  name="yunfei_price" value="<?php echo ($goodsOne['goods_yunfei']); ?>">元
                </div>
            </div>
             <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">产品详情：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <script id="editor" style="width:1024px;height:500px;" type="text/plain" name="goods_detail" ><?php echo ($goodsOne['goods_detail']); ?></script>
                    </script> 
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
                var index = layer.load(0, {shade: false});
                $(form).ajaxSubmit({
                    type: 'post',
                    url: "/index.php/Admin/GoodsBuy/editGoodsBuy/",
                    data: $("form").serialize(),
                    dataType: "json",
                    success: function(data) {
                        if (data.code == 1) {
                            layer.msg(data.msg, {
                                icon: 1,
                                time: 1000
                            }, function() {
                                window.location.href = "/index.php/Admin/GoodsBuy/showList";
                            });
                        } else if (data.code == 0) {
                            layer.close(index);
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
    <script type="text/javascript">
        var ue = UE.getEditor('editor');
    </script>
    <!--/请在上方写此页面业务相关的脚本-->
</body>

</html>