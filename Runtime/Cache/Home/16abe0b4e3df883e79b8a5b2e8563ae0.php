<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>产品专区</title>
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/
reset.css">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/iconfont.css">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/index.css">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/swiper.min.css" />
		<link rel="stylesheet" href="/Public/Qian/lib/weui.min.css">
		<script type="text/javascript" src="/Public/Qian/js/jquery-1.10.1.min.js"></script>
		<script type="text/javascript" src="/Public/Qian/js/swiper.min.js"></script>
		<style type="text/css">
			.swiper-container {
				z-index: 0;
			}
			
			.swiper-container-horizontal>.swiper-pagination {
				width: 100%;
				bottom: 24px;
				left: 0;
				height: 0;
			}
			
			.swiper-pagination {
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

	<body style="background: #f0f0f2;" class="min-width">
		<!--search-->
		<div class="weui-search-bar" id="searchBar">
			<form class="weui-search-bar__form">
				<div class="weui-search-bar__box">
					<i class="weui-icon-search"></i>
					<input type="search" class="weui-search-bar__input" id="searchInput" placeholder="搜索商品" required="">
					<a href="javascript:" class="weui-icon-clear" id="searchClear"></a>
				</div>
				<label class="weui-search-bar__label" id="searchText" style="transform-origin: 0px 0px 0px; opacity: 1; transform: scale(1, 1);">
		          <i class="weui-icon-search"></i>
		          <span>搜索商品</span>
		        </label>
			</form>
			<a href="javascript:" class="weui-search-bar__cancel-btn" id="searchCancel">取消</a>
		</div>
		<!--swiper-->
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<div class="swiper-slide">
					<img src="/Public/Qian/temp/banner1.jpg" width="100%" />
				</div>
				<div class="swiper-slide">
					<img src="/Public/Qian/temp/banner2.jpg" width="100%" />
				</div>
			</div>
			<div class="swiper-pagination"></div>
		</div>
		<div class="decoration">
		</div>
		<!--new-->
		<a class="jsd_title db-block" href="lists.html" style="color: #353535;">
			<div class="left-name fl">新品上市</div>
			<div class="right-open fr">
				<i class="icon iconfont">&#xe640;</i>
			</div>
			<div class="clear">

			</div>
		</a>
		<div class="jsd_new-content">
			<div class="first-block">
				<a href="productdetail.html">
					<img src="/Public/Qian/temp/news-pro1_02.jpg" class="ui-width-100" />
				</a>
			</div>
			<div class="second-block">
				<ul>
					<li style="width: 52%;">
						<a href="productdetail.html">
							<img src="/Public/Qian/temp/news-pro2_04.jpg" />
						</a>
					</li>
					<li style="width: 46%;margin-left: 2%;">
						<a href="productdetail.html">
							<img src="/Public/Qian/temp/news-pro3_06.jpg" />
						</a>
					</li>
					<div class="clear">

					</div>
				</ul>
			</div>
		</div>
		<div class="decoration">
		</div>
		<!--category-->
		<a class="jsd_title db-block" href="lists.html" style="color: #353535;">
			<div class="left-name fl">分类查询</div>
			<div class="right-open fr">
				<i class="icon iconfont">&#xe640;</i>
			</div>
			<div class="clear">

			</div>
		</a>
		<div class="decoration">
		</div>
		<div class="index-category ui-width-100">
			<!--厨-->
			<div class="item-category ui-width-100">
				<ul class="ui-width-100">
					<li class="c-icon fl mr-1">
						
						<img src="/Public/Qian/images/chu.jpg" class="icon-category ui-width-100" />
					</li>
					<li class="fl mr-1">
						<a href="productdetail.html">
							<img src="/Public/Qian/temp/product_03.jpg" class="ui-width-100" />
						</a>
					</li>
					<li class="fl mr-1">
						<a href="productdetail.html">
							<img src="/Public/Qian/temp/product_03.jpg" class="ui-width-100" />
						</a>
					</li>
					<li class="fl mr-1">
						<a href="productdetail.html">
							<img src="/Public/Qian/temp/product_03.jpg" class="ui-width-100" />
						</a>
					</li>
					<li class="fl right-open">
						<a href="xlists.html">
							<img src="/Public/Qian/images/icon1_03.jpg" class="ui-width-100" />
						</a>
					</li>
					<div class="clear">
						
					</div>
				</ul>
			</div>
			<!--酿-->
			<div class="item-category ui-width-100">
				<ul class="ui-width-100">
					<li class="c-icon fl mr-1">
						<img src="/Public/Qian/images/niang.jpg" class="icon-category ui-width-100" />
					</li>
					<li class="fl mr-1">
						<a href="productdetail.html">
							<img src="/Public/Qian/temp/product_03.jpg" class="ui-width-100" />
						</a>
					</li>
					<li class="fl mr-1">
						<a href="productdetail.html">
							<img src="/Public/Qian/temp/product_03.jpg" class="ui-width-100" />
						</a>
					</li>
					<li class="fl mr-1">
						<a href="productdetail.html">
							<img src="/Public/Qian/temp/product_03.jpg" class="ui-width-100" />
						</a>
					</li>
					<li class="fl right-open">
						<a href="xlists.html">
							<img src="/Public/Qian/images/icon2_03.jpg" class="ui-width-100" />
						</a>
					</li>
					<div class="clear">
						
					</div>
				</ul>
			</div>
			<!--饮-->
			<div class="item-category ui-width-100">
				<ul class="ui-width-100">
					<li class="c-icon fl mr-1">
						<img src="/Public/Qian/images/yin.jpg" class="icon-category ui-width-100" />
					</li>
					<li class="fl mr-1">
						<a href="productdetail.html">
							<img src="/Public/Qian/temp/product_03.jpg" class="ui-width-100" />
						</a>
					</li>
					<li class="fl mr-1">
						<a href="productdetail.html">
							<img src="/Public/Qian/temp/product_03.jpg" class="ui-width-100" />
						</a>
					</li>
					<li class="fl mr-1">
						<a href="productdetail.html">
							<img src="/Public/Qian/temp/product_03.jpg" class="ui-width-100" />
						</a>
					</li>
					<li class="fl right-open">

						<a href="xlists.html">
							<img src="/Public/Qian/images/icon3_03.jpg" class="ui-width-100" />
						</a>
					</li>
					<div class="clear">
						
					</div>
				</ul>
			</div>
			<!--居-->
			<div class="item-category ui-width-100">
				<ul class="ui-width-100">
					<li class="c-icon fl mr-1">
						<img src="/Public/Qian/images/ju.jpg" class="icon-category ui-width-100" />
					</li>
					<li class="fl mr-1">
						<img src="/Public/Qian/temp/product_03.jpg" class="ui-width-100" />
					</li>
					<li class="fl mr-1">
						<img src="/Public/Qian/temp/product_03.jpg" class="ui-width-100" />
					</li>
					<li class="fl mr-1">
						<img src="/Public/Qian/temp/product_03.jpg" class="ui-width-100" />
					</li>
					<li class="fl right-open">
						<a href="xlists.html">
							<img src="/Public/Qian/images/icon4_03.jpg" class="ui-width-100" />
						</a>
					</li>
					<div class="clear">
						
					</div>
				</ul>
			</div>
		</div>
		</div>

		<script src="/Public/Qian/js/jquery-weui.js"></script>
		<!--首页导航轮播-->
		<script>
			var swiper = new Swiper('.swiper-container', {
				pagination: '.swiper-pagination',
			});
		</script>
	</body>

</html>