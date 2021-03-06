<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>抢购活动</title>
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/reset.css">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/product-buy.css">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/index.css" />
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/swiper.min.css">
		<link rel="stylesheet" href="//cdn.bootcss.com/weui/0.4.3/style/weui.min.css">
        <link rel="stylesheet" href="//cdn.bootcss.com/jquery-weui/0.8.3/css/jquery-weui.min.css">
		<script type="text/javascript" src="/Public/Qian/js/swiper.min.js"></script>
		<script type="text/javascript" src="/Public/Qian/js/jquery1.42.min.js"></script>
		<style type="text/css">
			.swiper-container {
				z-index: 0;
				width: 100%;
			}
			
			.swiper-container-horizontal>.swiper-pagination,
			.swiper-container-horizontal>.swiper-pagination2 {
				width: 100%;
				bottom: 24px;
				left: 0;
				height: 0;
			}
			
			.swiper-pagination,
			.swiper-pagination2 {
				position: relative;
			}
			
			.swiper-pagination-bullet {
				width: 8px;
				height: 8px;
				display: inline-block;
				border-radius: 100%;
				background: #959494;
			}
			
			.swiper-pagination-bullet-active {
				width: 8px;
				height: 8px;
				display: inline-block;
				border-radius: 100%;
				background: #c30d23;
			}
			
			.swiper-pagination-bullet {
				margin-right: 5px;
			}
		</style>
	</head>
	<body style="background: #f0f0f2;">
		<div id="product">
			<div id="picture">
				<div class="pDetail_wrap">
					<!--轮播-->
					<div class="swiper-container" id="new">
						<div class="swiper-wrapper">
						   <?php if(is_array($pics)): foreach($pics as $key=>$v): ?><div class="swiper-slide">
									<img src="<?php echo substr($v['goods_buy_pic'], 1) ?>" width="100%" />
								</div><?php endforeach; endif; ?>
						</div>
						<div class="swiper-pagination"></div>
					</div>
					<div class="bot">
						<div class="text">
							<p style="font-size: 16px;padding-right: 10px;width: 94%;">
								<?php echo ($goods_buy['goods_title']); ?>
							</p>
						</div>
						<div class="text1">
							<p class="p1"><span class="s1">￥</span><b><?php echo ($goods_buy['goods_price']); ?></b></p>
						</div>
					</div>
				</div>
				<!--选择数量-->
				<div class="footer_buy">
					<ul>
						<li>
							<a href="javascript:void(0)" id="qianggou">
								立即抢购
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		</div>
		<!--产品信息-->
		<div class="jsd_title db-block" href="javascript:void(0)" style="color: #353535;margin-top:10px;">
			<div class="left-name fl">产品详情</div>
			<div class="clear">
			</div>
		</div>
		<div class="product_xq">
			<?php echo ($goods_buy['goods_detail']); ?>
				<div class="b_height">
					
				</div>
		</div>
	</body>
	<script src="//cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/jquery-weui/0.8.3/js/jquery-weui.min.js"></script>
	<script type="text/javascript">
		/*详情图轮播*/
		$(function() {
			/*详情图轮播*/
			var swiper = new Swiper('#new', {
				pagination: '.swiper-pagination',
			});
		})
	</script>
	<script type="text/javascript">
		$("#qianggou").click(function(){
			$.showLoading("正在加载...");
			window.location.href="/index.php/Home/GoodsBuy/newAddr/id/<?php echo ($goods_buy['id']); ?>"
		})
	</script>

</html>