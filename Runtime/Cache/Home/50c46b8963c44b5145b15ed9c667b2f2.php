<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>产品收藏列表</title>
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/reset.css">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/iconfont.css">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/index.css" />
		<link rel="stylesheet" href="/Public/Qian/lib/weui.min.css">
		<script type="text/javascript" src="/Public/Qian/js/jquery-1.10.1.min.js"></script>
	</head>

	<body class="min-width">
		<!--lists-->
		<div class="productlist ui-width-100">
		   <?php if(empty($goods)): ?><div class="empty-store">
					<i class="icon iconfont">&#xe60c;</i>
					<div class="word">
						暂时还没有收藏的商品哦~
					</div>
		      </div>
           <?php else: ?>
	             <ul>
				    <?php if(is_array($goods)): foreach($goods as $key=>$v): ?><li>
							<a href="/index.php/Home/Index/goods_detail/goods_id/<?php echo ($v['goods_id']); ?>">
								<img src="<?php echo (substr($v['goods_logo'],1)) ?>" class="ui-width-100"/>
							</a>
						</li><?php endforeach; endif; ?>
					<div class="clear">
						
					</div>
				</ul><?php endif; ?>
		</div>
		<script src="/Public/Qian/js/jquery-weui.js"></script>
		
	</body>

</html>