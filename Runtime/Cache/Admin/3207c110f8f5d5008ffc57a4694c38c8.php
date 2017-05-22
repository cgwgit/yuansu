<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="renderer" content="webkit|ie-comp|ie-stand">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
		<meta http-equiv="Cache-Control" content="no-siteapp" />
		<link rel="Bookmark" href="/favicon.ico">
		<link rel="Shortcut Icon" href="/favicon.ico" />
		<link rel="stylesheet" type="text/css" href="/Public/static/h-ui/css/H-ui.min.css" />
		<link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/H-ui.admin.css" />
		<link rel="stylesheet" type="text/css" href="/Public/lib/Hui-iconfont/1.0.8/iconfont.css" />
		<link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/skin/default/skin.css" id="skin" />
		<link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/style.css" />
		<!--[if IE 6]>
<script type="text/javascript" src="/Public/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
		<title>居元素后台管理系统</title>
		<meta name="keywords" content="">
		<meta name="description" content="">
	</head>

	<body>
		<header class="navbar-wrapper">
			<div class="navbar navbar-fixed-top">
				<div class="container-fluid cl">
					<a class="logo navbar-logo f-l mr-10 hidden-xs" href="/aboutHui.shtml">居元素后台管理系统</a>
					<a class="logo navbar-logo-m f-l mr-10 visible-xs" href="/aboutHui.shtml">H-ui</a> <span class="logo navbar-slogan f-l mr-10 hidden-xs">v1.0</span>
					<a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
					<nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
						<ul class="cl">
							<li>管理员</li>
							<li class="dropDown dropDown_hover">
								<a href="#" class="dropDown_A"><?php echo session('manager_name') ?> <i class="Hui-iconfont">&#xe6d5;</i></a>
								<ul class="dropDown-menu menu radius box-shadow">
									<li>
										<a href="<<?php echo U('Admin/Manager/loginout');?>>">切换账户</a>
									</li>
									<li>
										<a href="<<?php echo U('Admin/Manager/loginout');?>>">退出</a>
									</li>
								</ul>
							</li>
						</ul>
					</nav>
				</div>
			</div>
		</header>
		<aside class="Hui-aside">
			<input runat="server" id="divScrollValue" type="hidden" value="" />
			<div class="menu_dropdown bk_2">
				<dl id="menu-admin">
					<dt><i class="Hui-iconfont">&#xe62d;</i> 管理员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
					<dd>
						<ul>
							<li>
								<a data-href="/index.php/Admin/Manager/showList" data-title="管理员列表" href="javascript:void(0);">管理员列表</a>
							</li>
						</ul>
					</dd>
				</dl>
					<dl id="menu-admin">
					<dt><i class="Hui-iconfont">&#xe62d;</i> 会员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
					<dd>
						<ul>
							<li>
								<a data-href="/index.php/Admin/User/showList" data-title="管理员列表" href="javascript:void(0);">会员列表</a>
							</li>
						</ul>
					</dd>
				</dl>
				<dl id="menu-article">
					<dt><i class="Hui-iconfont">&#xe616;</i> 产品管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
					<dd>
						<ul>
							<li>
								<a data-href="/index.php/Admin/Goods/showList" data-title="产品列表" href="javascript:void(0);">产品列表</a>
							</li>
							<li>
								<a data-href="/index.php/Admin/Goods/addGoods" data-title="添加产品" href="javascript:void(0);">添加产品</a>
							</li>
						</ul>
					</dd>
				</dl>
				<dl id="menu-article">
					<dt><i class="Hui-iconfont">&#xe616;</i> 门店管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
					<dd>
						<ul>
							<li>
								<a data-href="/index.php/Admin/Shop/shopList" data-title="分类列表" href="javascript:void(0);">门店列表</a>
							</li>
							<li>
								<a data-href="/index.php/Admin/Shop/addShop/id/1" data-title="添加分类" href="javascript:void(0);">添加门店</a>
							</li>
						</ul>
					</dd>
				</dl>
				<dl id="menu-article">
					<dt><i class="Hui-iconfont">&#xe616;</i> 产品分类管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
					<dd>
						<ul>
							<li>
								<a data-href="/index.php/Admin/Category/showList" data-title="分类列表" href="javascript:void(0);">分类列表</a>
							</li>
							<li>
								<a data-href="/index.php/Admin/Category/addCategory/id/1" data-title="添加分类" href="javascript:void(0);">添加产品分类</a>
							</li>
						</ul>
					</dd>
				</dl>
					<dl id="menu-article">
					<dt><i class="Hui-iconfont">&#xe616;</i> banner管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
					<dd>
						<ul>
							<li>
								<a data-href="/index.php/Admin/Banner/showList" data-title="分类列表" href="javascript:void(0);">banner列表</a>
							</li>
							<li>
								<a data-href="/index.php/Admin/Banner/addBanner/id/1" data-title="添加分类" href="javascript:void(0);">添加banner</a>
							</li>
						</ul>
					</dd>
				</dl>	
			</div>
		</aside>
		<div class="dislpayArrow hidden-xs">
			<a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a>
		</div>
		<section class="Hui-article-box">
			<div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
				<div class="Hui-tabNav-wp">
					<ul id="min_title_list" class="acrossTab cl">
						<li class="active"><span title="我的桌面" data-href="welcome.html">我的桌面</span><em></em></li>
					</ul>
				</div>
				<div class="Hui-tabNav-more btn-group">
					<a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a>
					<a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a>
				</div>
			</div>
			<div id="iframe_box" class="Hui-article">
				<div class="show_iframe">
					<div style="display:none" class="loading"></div>
					<iframe scrolling="yes" frameborder="0" src="/index.php/Admin/Index/welcome"></iframe>
				</div>
			</div>
		</section>
		<!--_footer 作为公共模版分离出去-->
		<script type="text/javascript" src="/Public/lib/jquery/1.9.1/jquery.min.js"></script>
		<script type="text/javascript" src="/Public/lib/layer/2.4/layer.js"></script>
		<script type="text/javascript" src="/Public/static/h-ui/js/H-ui.min.js"></script>
		<script type="text/javascript" src="/Public/static/h-ui.admin/js/H-ui.admin.js"></script>
		<!--/_footer 作为公共模版分离出去-->
		<!--请在下方写此页面业务相关的脚本-->
	</body>

</html>