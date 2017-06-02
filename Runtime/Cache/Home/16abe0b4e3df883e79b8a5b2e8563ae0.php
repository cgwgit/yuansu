<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>产品专区</title>
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/reset.css">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/iconfont.css">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/index.css">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/swiper.min.css" />
		<link rel="stylesheet" href="/Public/Qian/lib/weui.min.css">
		<script type="text/javascript" src="/Public/Qian/js/jquery-1.10.1.min.js"></script>
		<script type="text/javascript" src="/Public/Qian/js/swiper.min.js"></script>
		<style type="text/css">
			.swiper-container {
				z-index: 0;
				width: 100%;
			}
			
			.swiper-pagination2 {
				position: absolute;
				text-align: center;
				-webkit-transition: 300ms;
				-moz-transition: 300ms;
				-o-transition: 300ms;
				transition: 300ms;
				-ms-transform: translate3d(0, 0, 0);
				-o-transform: translate3d(0, 0, 0);
				transform: translate3d(0, 0, 0);
				z-index: 10;
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

	<body style="background: #f0f0f2;" class="min-width">
		<!--search-->
		<div class="weui-search-bar" id="searchBar">
			<form class="weui-search-bar__form" method="post" action="/index.php/Home/Index/Search">
				<div class="weui-search-bar__box">
					<i class="weui-icon-search"></i>
					<input type="search" class="weui-search-bar__input" id="searchInput"  name="goods_name" placeholder="搜索商品" required="">
					<a href="javascript:" class="weui-icon-clear" id="searchClear"></a>
				</div>
				<label class="weui-search-bar__label" id="searchText" style="transform-origin: 0px 0px 0px; opacity: 1; transform: scale(1, 1);">
		          <i class="weui-icon-search"></i>
		          <span>搜索商品</span>
		        </label>
			</form>
			<a href="javascript:" class="weui-search-bar__cancel-btn" id="searchCancel">取消</a>
		</div>
		<!--首页bannerr-->
		<div class="swiper-container" id="banner">
			<div class="swiper-wrapper">
			   <?php if(is_array($logos)): foreach($logos as $key=>$v): ?><div class="swiper-slide">
					  <a href="<?php echo ($v['bannerdizhi']); ?>">
						<img src="<?php echo (substr($v['banner_pic'],1)) ?>" width="100%" />
					  </a>
					</div><?php endforeach; endif; ?>
			</div>
			<div class="swiper-pagination"></div>
		</div>
		<div class="decoration">
		</div>
		<!--new-->
		<a class="jsd_title db-block" href="javascript:void(0)" style="color: #353535;">
			<div class="left-name fl">新品上市</div>
		<!-- 	<div class="right-open fr">
				<i class="icon iconfont">&#xe640;</i>
			</div> -->
			<div class="clear">

			</div>
		</a>
		<div class="swiper-container" id="new">
			<div class="swiper-wrapper">
			   <?php if(is_array($xinpins)): foreach($xinpins as $key=>$v): ?><div class="swiper-slide">
						<a href="<?php echo ($v['xinpin_dizhi']); ?>">
							<img src="<?php echo (substr($v['xinpin_logo'],1)) ?>" width="100%" />
						</a>
					</div><?php endforeach; endif; ?>
			</div>
			<div class="swiper-pagination2"></div>
		</div>
		<!--category-->
		<a class="jsd_title db-block" href="javascript:void(0)" style="color: #353535;">
			<div class="left-name fl">分类查询</div>
			<!-- <div class="right-open fr">
				<i class="icon iconfont">&#xe640;</i>
			</div> -->
			<div class="clear">

			</div>
		</a>
		<div class="decoration">
		</div>
		<?php if(is_array($categorys)): foreach($categorys as $key=>$v): ?><div class="index-category ui-width-100">
				<!--厨-->
				<div class="item-category ui-width-100">
					<ul class="ui-width-100">
						<li class="c-icon fl mr-1">
							<img src="<?php echo (substr($v['cat_logo'],1)) ?>" class="icon-category ui-width-100" />
						</li>
						<?php if(is_array($goods)): foreach($goods as $key=>$vv): if($v['cat_path'] == $vv['cat_path']): ?><li class="fl mr-1">
									<a href="/index.php/Home/Index/goods_detail/goods_id/<?php echo ($vv['goods_id']); ?>">
										<img src="<?php echo (substr($vv['goods_logo'],1)) ?>" class="ui-width-100" />
									</a>
								</li><?php endif; endforeach; endif; ?>
						<li class="fl right-open">
							<a href="/index.php/Home/Index/goods_list/cat_id/<?php echo ($v['cat_id']); ?>">
								<img src="/Public/Qian/images/icon1_03.jpg?id=2016" class="ui-width-100" />
							</a>
						</li>
						<div class="clear">

						</div>
					</ul>
				</div>
			</div><?php endforeach; endif; ?>
		<script src="/Public/Qian/js/jquery-weui.js"></script>
		<!--首页导航轮播-->
		<script>
			var swiper = new Swiper('#banner', {
				pagination: '.swiper-pagination',
			});
			var swiper = new Swiper('#new', {
				pagination: '.swiper-pagination2',
				autoplay: 1000,
			});
		</script>
	</body>
<!-- 	<script type="text/javascript">
			$(function(){
				$("form").submit(function(){
					$.ajax({
						url: '/index.php/Home/Index/Search',
						type: 'post',
						dataType: 'json',
						data: {goods_name:$("#searchInput").val()},
						success:function(data){
                           if(data != ''){
                           	  $("#div1").remove();
                             $(data).each(function(index,el){
                             	var goods_logo = "<?php echo (substr($vv['goods_logo'],1)) ?>"
                             	$("body").append('<div class="productlist ui-width-100"> <ul> <li> <a href="/index.php/Home/Index/goods_detail/goods_id/'+el.goods_id+'"> <img src="'+el.goods_logo.substring(1)+'" class="ui-width-100"/> </a> </li> <div class="clear"> </div> </ul> </div>');
                             })
                           }else{

                           }
						}
					})
                 return false;
					
				});
			})
		</script> -->
</html>