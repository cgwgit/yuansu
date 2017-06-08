<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
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
		<title>未发货订单详情</title>
	</head>

	<body>
		<nav class="breadcrumb">
			<i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 订单管理 <span class="c-gray en">&gt;</span> 订单列表<span class="c-gray en">&gt;</span> 订单详情
			<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新">
				<i class="Hui-iconfont">&#xe68f;</i>
			</a>
		</nav>
		<div class="ml-20 mr-20">
			<div class="page-container">
				<div class="row cl order-border-b pt-5 pb-5">
					<label class="form-label col-xs-4 col-sm-2 text-r">订单号：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<?php echo ($order_Info['order_bianhao']); ?>
					</div>
				</div>
				<div class="row cl order-border-b pt-5 pb-5">
					<label class="form-label col-xs-4 col-sm-2 text-r">产品名称：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<?php echo ($order_Info['goods_title']); ?>
					</div>
				</div>
				<div class="row cl order-border-b pt-5 pb-5">
					<label class="form-label col-xs-4 col-sm-2 text-r">产品价格：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<?php echo ($order_Info['order_price']); ?>
					</div>
				</div>
				<div class="row cl order-border-b pt-5 pb-5">
					<label class="form-label col-xs-4 col-sm-2 text-r">收货人：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<?php echo ($order_Info['order_name']); ?>
					</div>
				</div>
				<div class="row cl order-border-b pt-5 pb-5">
					<label class="form-label col-xs-4 col-sm-2 text-r">联系电话：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<?php echo ($order_Info['tel']); ?>
					</div>
				</div>
				<div class="row cl order-border-b pt-5 pb-5">
					<label class="form-label col-xs-4 col-sm-2 text-r">收货地址：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<?php echo ($order_Info['area']); echo ($order_Info['area_detail']); ?>
					</div>
				</div>
				<div class="row cl order-border-b pt-5 pb-5">
					<label class="form-label col-xs-4 col-sm-2 text-r">快递方式：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<?php echo ($order_Info['fahuo_danwei']); ?>
					</div>
				</div>
				<div class="row cl order-border-b pt-5 pb-5">
					<label class="form-label col-xs-4 col-sm-2 text-r">物流单号：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<?php echo ($order_Info['fahuo_danhao']); ?>
					</div>
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

		<script type="text/javascript" src="/Public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
		<script type="text/javascript">
		</script>
	</body>

</html>