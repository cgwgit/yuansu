<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>店铺列表</title>
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/reset.css">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/iconfont.css">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/index.css" />		
    	<link rel="stylesheet" href="/Public/Qian/css/cityPicker.css"/>
		<link rel="stylesheet" href="/Public/Qian/lib/weui.min.css">
		<script src="/Public/Qian/js/jquery-2.1.4.min.js"></script>
		<script src="/Public/Qian/js/cityPicker.js"></script>
	</head>
	<body class="min-width">
		<div class="storelists ui-width-100">
		  <?php if(empty($shops)): ?><div class="empty-store"> <i class="icon iconfont">&#xe690;</i> <div class="word"> 暂时还没有收藏的店铺哦~ </div> </div>
		  <?php else: ?>
			     <?php if(is_array($shops)): foreach($shops as $key=>$v): ?><div class="item-store"> 
				       <a class="s-top ui-width-100 ui-flex" href="/index.php/Home/Shop/shopDetail/shop_id/<?php echo ($v['shop_id']); ?>">
							<img src="<?php echo substr($v['shop_logo'],1) ?>" class="s-img"/>
							<div class="s-message">
								<h4><?php echo ($v['shop_name']); ?></h4>
								<div class="s-address">
									<?php echo ($v['shop_position']); ?>
								</div>
							</div>
						</a>
						<div class="s-bottom-block ui-width-100">
							<ul>
								<li>
									
									<a href="" class="db-block">
										<a href="/index.php/Home/Shop/daohang/shop_id/<?php echo ($v['shop_id']); ?>" class="db-block"> <i class="icon iconfont">&#xe66c;</i> 一键导航</a>
									</a>
								</li>
							</ul>
						</div>
				   </div><?php endforeach; endif; endif; ?>
		</div>
		<script src="/Public/Qian/js/jquery-weui.js"></script>
	</body>
</html>