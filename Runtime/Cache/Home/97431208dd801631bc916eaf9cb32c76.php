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
						<a style="color:black;" href="/index.php/Home/Shop/daohang/shop_id/<?php echo ($shopInfo['shop_id']); ?>" class="db-block"><?php echo ($shopInfo['shop_position']); ?></a>
					</div>
					<div class="cell fixed">
						<i class="icon iconfont" style="color: #828287;">&#xe640;</i>
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
				<div class="store_detail_line">
				</div>
				<div class="item-message mui-flex" id="collection" <?php if(empty($rst)): ?>state="on"<?php else: ?> state="off"<?php endif; ?>>
					<div class="cell fixed name" style="width: 60px;text-align:left;color: #828282;">
						收藏门店
					</div>
					<div class="cell shoucang">
						<i class="icon iconfont" style="color: <?php if(empty($rst)): ?>#BFBDBD<?php else: ?>#c30d23<?php endif; ?>;font-size: 14px;vertical-align: top;">&#xe65d;</i>
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
		<script type="text/javascript" src="/Public/Qian/layer_mobile/layer.js"></script>
		<script>
			var pb1 = $.photoBrowser({
				items: [
				    <?php if(is_array($Pics)): foreach($Pics as $key=>$v): ?>"<?php echo substr($v['shop_pic'],1) ?>",<?php endforeach; endif; ?>
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
			$(function(){
				//获取图片宽度等于高度
				var imgWidth = $(".tuji").width();
				$(".tuji").height(imgWidth);
				//收藏
				$("#collection").click(function(){
                    var state = this.getAttribute("state");
					if(state === "on"){
						$.ajax({
							url: '/index.php/Home/Shop/shop_ShouCang',
							type: 'post',
							dataType: 'json',
							data: {user_id: "<?php echo session('user_id') ?>",shop_id:'<?php echo ($shopInfo['shop_id']); ?>'},
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
							url: '/index.php/Home/Shop/shop_QShouCang',
							type: 'post',
							dataType: 'json',
							data: {user_id: "<?php echo session('user_id') ?>",shop_id:'<?php echo ($shopInfo['shop_id']); ?>'},
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
				
			})
		</script>
	</body>

</html>