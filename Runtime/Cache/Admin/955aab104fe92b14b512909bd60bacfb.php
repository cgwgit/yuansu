<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
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
		<link href="/Public/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
		<!--[if IE 6]>
<script type="text/javascript" src="/Public/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
		<title>查看产品 </title>
		<meta name="keywords" content="">
		<meta name="description" content="">
	</head>
	<body>
		<div class="page-container">
			<!--选项卡-->
			<div id="tab_demo" class="HuiTab mt-20">
				<div class="tabBar clearfix mb-20">
					<span>基本信息</span>
					<span>简介</span>
					<span>应用</span>
					<span>视频</span>
				</div>
				<div class="tabCon">
					<article class="page-container pl-20 pr-20">
							<div class="row cl">
								<label class="form-label col-xs-4 col-sm-2">产品名称：</label>
								<div class="col-xs-8 col-sm-9"><?php echo ($goodsinfo['goods_name']); ?>
								</div>
							</div>
							<div class="row cl">
								<label class="form-label col-xs-4 col-sm-2">产品分类：</label>
								<div class=" col-xs-8 col-sm-9">
									<div class="col-xs-6 col-sm-6">
									<span>
										<?php echo ($parentCategory['cat_name']); ?>
										</span>
									</div>
									<div class="col-xs-6 col-sm-6">
                                        <span><?php echo ($category['cat_name']); ?>
									</div>
								</div>
							</div>
							<div class="row cl">
								<label class="form-label col-xs-4 col-sm-2">产品容积：</label>
								<div class=" col-xs-8 col-sm-9"> <?php echo ($goodsinfo['goods_rongji']); ?>
								</div>
							</div>
							<div class="row cl">
								<label class="form-label col-xs-4 col-sm-2">产品颜色：</label>
								<div class=" col-xs-8 col-sm-9"><?php echo ($goodsinfo['goods_color']); ?>
								</div>
							</div>
							<div class="row cl">
								<label class="form-label col-xs-4 col-sm-2">产品特点：</label>
								<div class=" col-xs-8 col-sm-9"><?php echo ($goodsinfo['goods_tedian']); ?>
								</div>
							</div>
							<div class="row cl">
								<label class="form-label col-xs-4 col-sm-2">首页展示：</label>
								<div class=" col-xs-8 col-sm-9">
								<?php if($goodsinfo['status'] == 1): ?>是<?php endif; ?>
								<?php if($goodsinfo['status'] == 0): ?>否<?php endif; ?>
								</div>
							</div>
							<div class="row cl mt-20 mb-20">
									<label class="form-label col-xs-4 col-sm-2">产品logo图：</label>
									<div class=" col-xs-8 col-sm-9">
					                    <img src="<?php echo (substr($goodsinfo['goods_logo'],1)) ?>" width="50" height="50"/>
					                </div>
							</div>
							<div class="row cl mt-20 mb-20">
									<label class="form-label col-xs-4 col-sm-2">产品展示图：</label>
									<div class=" col-xs-8 col-sm-9">
					                    <img src="<?php echo (substr($goodsinfo['goods_zhanshi'],1)) ?>" width="50" height="50"/>
					                </div>
							</div>
					</article>
				</div>
				<div class="tabCon" id="jianjie">
				   <?php if(is_array($jianjie)): foreach($jianjie as $key=>$v): ?><article class="pl-20 pr-20 xiangqing1 pics_<?php echo ($v["id"]); ?>">
						<div class="item-demo form-horizontal">
							<div class="pb-20">
								<div class="row cl">
									<label class="form-label col-xs-4 col-sm-2">标题：</label>
									<div class=" col-xs-8 col-sm-9"><?php echo ($v['goods_jianjie_title']); ?>
									</div>
								</div>
								<div class="row cl mt-20 mb-20">
									<label class="form-label col-xs-4 col-sm-2">图片：</label>
									<div class=" col-xs-8 col-sm-9">
					                    <img src="<?php echo (substr($v['goods_jianjie_pic'],1)) ?>" width="50" height="50"/>
					                </div>
								</div>
								<div class="row cl">
									<label class="form-label col-xs-4 col-sm-2">简介：</label>
									<div class=" col-xs-8 col-sm-9"><?php echo ($v['goods_jianjie_content']); ?>
									</div>
								</div>
								<div class="row cl">
									<label class="form-label col-xs-4 col-sm-2">链接地址：</label>
									<div class=" col-xs-8 col-sm-9"><?php echo ($v['goods_jianjie_url']); ?>
									</div>
								</div>
							</div>
						</div>
					</article><?php endforeach; endif; ?>
				</div>
				<div class="tabCon" id="yingyong">
				  <?php if(is_array($yingyong)): foreach($yingyong as $key=>$v): ?><article class="pl-20 pr-20 xiangqing2 pics_<?php echo ($v["id"]); ?>">
						<div class="item-demo form-horizontal">
							<div class="pb-20">
								<div class="row cl">
									<label class="form-label col-xs-4 col-sm-2">标题：</label>
									<div class=" col-xs-8 col-sm-9"><?php echo ($v['goods_yingyong_title']); ?>
									</div>
								</div>
								<div class="row cl mt-20 mb-20">
									<label class="form-label col-xs-4 col-sm-2">图片：</label>
									<div class=" col-xs-8 col-sm-9">
					                    <img src="<?php echo (substr($v['goods_yingyong_pic'],1)) ?>" width="50" height="50"/>
					                </div>
								</div>
								<div class="row cl">
									<label class="form-label col-xs-4 col-sm-2">简介：</label>
									<div class=" col-xs-8 col-sm-9"><?php echo ($v['goods_yingyong_content']); ?>
									</div>
								</div>
								<div class="row cl">
									<label class="form-label col-xs-4 col-sm-2">链接地址：</label>
									<div class=" col-xs-8 col-sm-9"><?php echo ($v['goods_yingyong_url']); ?>
									</div>
								</div>
							</div>
						</div>
					</article><?php endforeach; endif; ?>
				</div>
				<div class="tabCon" id="shipin">
				 <?php if(is_array($shipin)): foreach($shipin as $key=>$v): ?><article class="pl-20 pr-20 xiangqing3 pics_<?php echo ($v["id"]); ?>">
						<div class="item-demo form-horizontal">
							<div class="pb-20">
								<div class="row cl">
									<label class="form-label col-xs-4 col-sm-2">标题：</label>
									<div class=" col-xs-8 col-sm-9"><?php echo ($v['goods_shipin_title']); ?>
									</div>
								</div>
								<div class="row cl mt-20 mb-20">
									<label class="form-label col-xs-4 col-sm-2">图片：</label>
									<div class=" col-xs-8 col-sm-9">
					                    <img src="<?php echo (substr($v['goods_shipin_pic'],1)) ?>" width="50" height="50"/>
					                </div>
								</div>
								<div class="row cl">
									<label class="form-label col-xs-4 col-sm-2">简介：</label>
									<div class=" col-xs-8 col-sm-9"><?php echo ($v['goods_shipin_content']); ?>
									</div>
								</div>
								<div class="row cl">
									<label class="form-label col-xs-4 col-sm-2">链接地址：</label>
									<div class=" col-xs-8 col-sm-9"><?php echo ($v['goods_shipin_url']); ?>
									</div>
								</div>
							</div>
						</div>
					</article><?php endforeach; endif; ?>
				</div>
			</div>
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
			<script type="text/javascript">
				$(function() {
					$.Huitab("#tab_demo .tabBar span", "#tab_demo .tabCon", "current", "click", "0");

				});
			</script>
	</body>

</html>