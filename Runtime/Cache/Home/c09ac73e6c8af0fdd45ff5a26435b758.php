<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>新增地址</title>
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/reset.css">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/newaddress.css">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/iconfont.css">
		<link rel="stylesheet" href="/Public/Qian/css/jquery-weui.css">
		<link rel="stylesheet" href="//cdn.bootcss.com/weui/0.4.3/style/weui.min.css">
        <link rel="stylesheet" href="//cdn.bootcss.com/jquery-weui/0.8.3/css/jquery-weui.min.css">
		<script src="/Public/Qian/js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="/Public/Qian/js/layer.js"></script>
	</head>

	<body>
	   
		<div id="main">
			<div style="font-size: 16px;color: #888;margin: auto 10px;line-height: 50px;">请填写收货信息：</div>
			<form method="post" action="/index.php/Home/GoodsBuy/newAddr">
			  <div id="header">
				<ul id="dimension">
					<li>
						<ul>
							<li class="l1">收货人</li>
							<li class="l2"><input type="text" name="order_Name" value="" placeholder="收货人姓名" onfocus="this.style.color='#333'" /></li>
							<input type="hidden" name="goods_id" value="<?php echo ($goods_id); ?>"></input>
							<div class="clear"></div>
						</ul>
					</li>
					<li>
						<ul>
							<li class="l1">联系电话</li>
							<li class="l2"><input type="tel" name="order_tel"  placeholder="联系电话" onfocus="this.style.color='#333'" /></li>
							<div class="clear"></div>
						</ul>
					</li>
					<li>
						<ul>
							<li class="l1">选择地区</li>
							<li class="" style="float: left;width: 70%;">
								<input class="weui-input" id="home-city" type="text" name="order_Area" placeholder="省市区">
							</li>
							<div class="clear"></div>
						</ul>
					</li>
					<li>
						<ul>
							<li class="l1">详细地址</li>
							<li class="l2">
								<input type="text" name="order_AreaDetail" placeholder="街道门牌信息" onfocus="this.style.color='#333'" />
							</li>
							<div class="clear"></div>
						</ul>
					</li>
				</ul>
				<div class="box_price">
				<?php if($goods['goods_yunfei'] == 0): ?><div class="left ui-width-50 fl">
					商品合计￥：<span class="color-danger"><?php echo ($goods['goods_price']); ?></span>元
					<input type="hidden" value="<?php echo ($goods['goods_price']); ?>" name="order_Price"></input>
				</div>
				<div class="right_yf fr">
					<span>包邮</span>
					<!--<span>包邮</span>-->
				</div>
				<?php else: ?>
				    <div class="left ui-width-50 fl">
					商品合计￥：<span class="color-danger"><?php echo ($goods['goods_price']); ?></span>元
					<input type="hidden" value="<?php echo ($goods['goods_price']); ?>" name="order_Price"></input>
				</div>
				<div class="right_yf fr">
					<span>邮费：<?php echo ($goods['goods_yunfei']); ?></span>
					<!--<span>包邮</span>-->
				</div><?php endif; ?>
			</div>
				<div id="baocun">
					<a class="btn" href="javascript:void(0)">点击确认</a>
				</div>
				<!-- <div style="font-size: 12px;color: #888;margin: auto 20px;line-height: 50px;">提示：除新疆西藏等偏远地区外均包邮</div> -->
			</div>
			</form>
			</div>
		</div>
			<script src="/Public/Qian/js/jquery-weui.js"></script>
			<script type="text/javascript" src="/Public/Qian/js/city-Picker.js"></script>
			
			<script>
				$("#home-city").cityPicker({
					title: "选择地区",
					onChange: function(picker, values, displayValues) {
						console.log(values, displayValues);
					}
				});
			</script>
			<script type="text/javascript">
				 $(function(){
				 	$(".btn").click(function(){
				 		var name = $('input[name="order_Name"]').val();
				 		if(!name || name.length>15){
							layer.msg('请输入正确的收货人姓名');return;
						}
				 		var tel = $('input[name="order_tel"]').val();
				 		if(tel == ''){
				 			layer.msg('手机号不能为空');return;
				 		}
				 		if(!(/^1\d{10}$/.test(tel))){
		    				layer.msg('请输入正确的手机号');return;
		    			}
						var area = $('input[name="order_AreaDetail"]').val();
						if(!area){
							layer.msg('请填写收货地址');return;
						}
				 		$.showLoading("正在加载...");
				 		$("form").submit();
				 	})
				 })
			</script>
	</body>
    <script src="//cdn.bootcss.com/jquery-weui/0.8.3/js/jquery-weui.min.js"></script>

</html>