<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>产品详情</title>
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/reset.css">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/iconfont.css">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/index.css" />
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/swiper.min.css" />
		<link rel="stylesheet" type="text/css" href="/Public/Qian/layer_mobile/need/layer.css" />
		<script type="text/javascript" src="/Public/Qian/js/swiper.min.js"></script>
		<script type="text/javascript" src="/Public/Qian/js/jquery1.42.min.js"></script>
		<script type="text/javascript" src="/Public/Qian/js/jquery.SuperSlide.2.1.1.js"></script>
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

	<body style="background: #f0f0f2;"  class="min-width">
		<div class="productdetail"style="position: relative;">
			<img src="<?php echo (substr($goods['goods_logo'],1)) ?>" class="topImg ui-width-100" />
		</div>
		<!--产品信息-->
		<div class="jsd_title db-block" href="lists.html" style="color: #353535;">
			<div class="left-name fl">产品信息</div>
			<div class="clear">
			</div>
		</div>
		<div class="decoration">

		</div>
		<div class="productMessage">
			<ul>
				<li>品名：<?php echo ($goods['goods_name']); ?></li>
				<li>容积：<?php echo ($goods['goods_rongji']); ?></li>
				<?php if($goods['goods_color'] != ''): ?><li>颜色：<?php echo ($goods['goods_color']); ?></li><?php endif; ?>
				<li>产品特点：<?php echo ($goods['goods_tedian']); ?></li>
			</ul>
		</div>
		<div class="decoration">

		</div>
		<!--产品展示-->
		<div class="jsd_title db-block" href="lists.html" style="color: #353535;">
			<div class="left-name fl">产品展示</div>
			<div class="clear">
			</div>
		</div>
		<!--轮播-->
		<div class="swiper-container" id="new">
			<div class="swiper-wrapper">
			   <?php if(is_array($goods_pic)): foreach($goods_pic as $key=>$v): ?><div class="swiper-slide">
						<img src="<?php echo (substr($v['goods_pics'],1)) ?>" width="100%" />
					</div><?php endforeach; endif; ?>
			</div>
			<div class="swiper-pagination"></div>
		</div>
		<!--收藏信息-->
		<div class="box_collection">
			<div class="left fl shoucang" id="collection" <?php if(empty($rst)): ?>state="on"<?php else: ?> state="off"<?php endif; ?>>
				收藏该产品<i class="icon iconfont" style="color: <?php if(empty($rst)): ?>#BFBDBD<?php else: ?>#c30d23<?php endif; ?>;font-size: 14px;vertical-align: top;">&#xe65d;</i>
			</div>
			<div class="right fr">
				已收藏人数：<?php echo ($goods['goods_shoucang']); ?>
			</div>
		</div>
		<!--前往门店-->
		<div class="box-btn-md">
			<!--<a href="storelists.html" class="btn-md">前往附件门店</a>
			<img src="images/btn_qwmd_03.png"/>-->
			<a class="btn_qwmd" href="/index.php/Home/Shop/shopList">
				前往附近门店&nbsp;>>
			</a>
		</div>
		<!--产品附加信息-->
		<div class="box-add">
			<div class="slideTxtBox">
				<div class="hd">
					<ul>
						<li class="br">简介</li>
						<li class="br">应用</li>
						<li>视频</li>
					</ul>
				</div>
				<div class="bd">
					<ul>
					  <?php if(is_array($jianjie)): foreach($jianjie as $key=>$v): ?><li>
							<a href="<?php echo ($v['goods_jianjie_url']); ?>" class="db-block">
								<div class="left">
									<img src="<?php echo (substr($v['goods_jianjie_pic'],1)) ?>" style="width: 80px;height: 80px;"/>
								</div>
								<div class="right">
									<h5><?php echo ($v['goods_jianjie_title']); ?></h5>
									<div class="infos">
										<?php echo ($v['goods_jianjie_content']); ?>
									</div>
								</div>
								<div class="clear">
									
								</div>
							</a>
						</li><?php endforeach; endif; ?>
					</ul>
					<ul>
					 <?php if(is_array($yingyong)): foreach($yingyong as $key=>$v): ?><li>
							<a href="<?php echo ($v['goods_yingyong_url']); ?>" class="db-block">
								<div class="left">
									<img src="<?php echo (substr($v['goods_yingyong_pic'],1)) ?>" style="width: 80px;height: 80px;"/>
								</div>
								<div class="right">
									<h5><?php echo ($v['goods_yingyong_title']); ?></h5>
									<div class="infos">
										<?php echo ($v['goods_yingyong_content']); ?>
									</div>
								</div>
								<div class="clear">
									
								</div>
							</a>
						</li><?php endforeach; endif; ?>
					</ul>
					<ul>
						 <?php if(is_array($shipin)): foreach($shipin as $key=>$v): ?><li>
							<a href="<?php echo ($v['goods_shipin_url']); ?>" class="db-block">
								<div class="left">
									<img src="<?php echo (substr($v['goods_shipin_pic'],1)) ?>" style="width: 80px;height: 80px;"/>
								</div>
								<div class="right">
									<h5><?php echo ($v['goods_shipin_title']); ?></h5>
									<div class="infos">
										<?php echo ($v['goods_shipin_content']); ?>
									</div>
								</div>
								<div class="clear">
									
								</div>
							</a>
						</li><?php endforeach; endif; ?>
					</ul>
				</div>
			</div>
		</div>
		<!--首页导航轮播-->
		<script type="text/javascript" src="/Public/Qian/layer_mobile/layer.js"></script>
			<script>
			//详情视频应用
			jQuery(".slideTxtBox").slide({});
			//详情图片
			var swiper = new Swiper('#new', {
				pagination: '.swiper-pagination',
				autoplay: 1000,
			});
		</script>
		<script type="text/javascript">
			$("#collection").click(function(){
                    var state = this.getAttribute("state");
					if(state === "on"){
						$.ajax({
							url: '/index.php/Home/Index/goods_ShouCang',
							type: 'post',
							dataType: 'json',
							data: {user_id: "<?php echo session('user_id') ?>",goods_id:'<?php echo ($goods['goods_id']); ?>'},
							success:function(data){
								if(data.code == 1){
									layer.open({
									    content: data.msg
									    ,skin: 'msg'
									    ,time: 1, //2秒后自动关闭
								     });
								    $(".shoucang i").css('color','#c30d23'); 
									$("#collection").attr("state", "off");
								}
							}
						})	
					}else{
						//取消收藏
						$.ajax({
							url: '/index.php/Home/Index/goods_QShouCang',
							type: 'post',
							dataType: 'json',
							data: {user_id: "<?php echo session('user_id') ?>",goods_id:'<?php echo ($goods['goods_id']); ?>'},
							success:function(data){
								if(data.code == 1){
									layer.open({
									    content: data.msg
									    ,skin: 'msg'
									    ,time: 1 //2秒后自动关闭
									});
								    $(".shoucang i").css('color','#BFBDBD'); 
									$("#collection").attr("state", "on");
								}
							}
						})
					}
						//提示
					  
				})
		</script>
	</body>

</html>