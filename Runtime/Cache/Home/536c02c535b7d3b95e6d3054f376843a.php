<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>知厨系列</title>
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/reset.css">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/iconfont.css">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/index.css" />
		<link rel="stylesheet" href="/Public/Qian/lib/weui.min.css">
		<script type="text/javascript" src="/Public/Qian/js/jquery-1.10.1.min.js"></script>
	</head>

	<body  class="min-width">
		<!--search-->
		<div class="weui-search-bar" id="searchBar">
			<form class="weui-search-bar__form" method="post" action="/index.php/Home/Index/Search">
				<div class="weui-search-bar__box">
					<i class="weui-icon-search"></i>
					<input type="search" class="weui-search-bar__input" id="searchInput" name="goods_name" placeholder="搜索商品" required="">
					<a href="javascript:" class="weui-icon-clear" id="searchClear"></a>
				</div>
				<label class="weui-search-bar__label" id="searchText" style="transform-origin: 0px 0px 0px; opacity: 1; transform: scale(1, 1);">
		          <i class="weui-icon-search"></i>
		          <span>搜索商品</span>
		        </label>
			</form>
			<a href="javascript:" class="weui-search-bar__cancel-btn" id="searchCancel">取消</a>
		</div>
		<!--series-->
		<?php if(is_array($xilie)): foreach($xilie as $key=>$v): ?><div class="stitle">
				<img src="<?php echo (substr($v['cat_logo'],1)) ?>" class="series-icon fl" />
				<div class="seriesName fl">
					<?php echo ($v['cat_name']); ?>
				</div>
				<div class="clear">

				</div>
			</div>
			<div class="productlist ui-width-100">
				<ul>
				  <?php if(is_array($goods)): foreach($goods as $key=>$vv): if($v['cat_id'] == $vv['cat_id']): ?><li>
						<a href="/index.php/Home/Index/goods_detail/goods_id/<?php echo ($vv['goods_id']); ?>">
							<img src="<?php echo (substr($vv['goods_logo'],1)) ?>" class="ui-width-100" />
						</a>
					</li><?php endif; endforeach; endif; ?>
					<div class="clear">

					</div>
				</ul>
			</div><?php endforeach; endif; ?>
		<script src="/Public/Qian/js/jquery-weui.js"></script>

	</body>

</html>