<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>门店详情</title>
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/reset.css">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/iconfont.css">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/index.css" />
		<link rel="stylesheet" href="/Public/Qian/css/weui.css">
		<link rel="stylesheet" href="/Public/Qian/css/jquery-weui.css">

		<!--<script type="text/javascript" src="/Public/Qian/js/jquery-1.10.1.min.js"></script>-->

	</head>

	<body class="min-width">
		<div class="storedetail ui-width-100">
			<div class="store-top ui-width-100">
				<h2><?php echo ($shopInfo['shop_name']); ?></h2>
			</div>
			<div class="store-message">
				<div class="item-message mui-flex" onclick="location()">
					<div class="cell fixed name" style="width: 60px;text-align:left;color: #828282;">
						位置
					</div>
					<div class="cell">
						<?php echo ($shopInfo['shop_position']); ?>
					</div>
					<div class="cell fixed">
						<i class="icon iconfont" style="color: #828287;">&#xe640;</i>
					</div>
				</div>
				<div class="store_detail_line">

				</div>
				<div class="item-message mui-flex">
					<div class="cell fixed name" style="width: 60px;text-align:left;color: #828282;">
						电话
					</div>
					<div class="cell">
						<?php echo ($shopInfo['shop_tel']); ?>
					</div>
				</div>
				<div class="store_detail_line">

				</div>
				<div id="imgSet" class="item-message mui-flex">
					<div class="cell fixed name" style="width: 60px;text-align: left;	color: #828282;">
						图集
					</div>
					<div class="imgLists cell">
						<ul>
						  <?php if(is_array($Pics)): foreach($Pics as $key=>$v): ?><li>
									<img src="<?php echo substr($v['shop_pic'],1) ?>" class="ui-width-100 tuji" />
								</li><?php endforeach; endif; ?>
						</ul>
					</div>
				</div>
				<div class="decoration" style="height: 20px;">

				</div>

				<div class="item-message mui-flex">
					<div class="cell fixed name" style="width: 60px;text-align:left;color: #828282;">
						营业时间
					</div>
					<div class="cell">
						<?php echo ($shopInfo['shop_stime']); ?>-<?php echo ($shopInfo['shop_etime']); ?>
					</div>
				</div>
				<div class="store_detail_line">
				</div>
				<div class="item-message mui-flex">
					<div class="cell fixed name" style="width: 60px;text-align:left;color: #828282;">
						推荐
					</div>
					<div class="cell">
						<?php echo ($shopInfo['shop_tuijian']); ?>
					</div>
				</div>
				<div class="store_detail_line">

				</div>
				<div class="item-message mui-flex">
					<div class="cell fixed name" style="width: 60px;text-align:left;color: #828282;">
						特色
					</div>
					<div class="cell">
						<?php echo ($shopInfo['shop_tese']); ?>
					</div>
				</div>

			</div>
		</div>
		<script src="/Public/Qian/js/jquery-2.1.4.js"></script>
		<script src="/Public/Qian/js/fastclick.js"></script>
		<script src="/Public/Qian/js/jquery-weui.js"></script>
		<script src="/Public/Qian/js/swiper.js"></script>
		<script>
			var pb1 = $.photoBrowser({
				items: [
					"http://jqweui.com/dist/demos//Public/Qian/images/swiper-2.jpg",
					"http://jqweui.com/dist/demos//Public/Qian/images/swiper-2.jpg",
					".//Public/Qian/images/store_03.jpg"
				],

				onSlideChange: function(index) {
					console.log(this, index);
				},

				onOpen: function() {
					console.log("onOpen", this);
				},
				onClose: function() {
					console.log("onClose", this);
				}
			});
			$(".tuji").click(function() {
				pb1.open();
			});
		</script>
	</body>

</html>