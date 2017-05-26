<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>个人中心</title>
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/reset.css">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/iconfont.css">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/myself.css">
		<script type="text/javascript" src="/Public/Qian/js/jquery-1.7.1.min.js"></script>
	</head>

	<body style="background: #f0f0f2;">
		<div id="main">
			<div id="header">
				<ul class="h_top">
					<li class="l1 lt" style="margin-left: 5%;">
						<img src="/Public/Qian/images/ju.jpg" alt="" width="70px" height="70px" style="border-radius: 55px;" />
					</li>
					<li class="l2 lt" style="margin-top: 3%;">
						<p class="p1">妞妞</p>
						<p class="p1">
							<I class="icon iconfont"></I>普通会员</p>
					</li>
					<li class="l3 rt">
						<a href="edit_message.html">
							<i class="icon iconfont" style="font-size: 20px;margin-right: 15px;">&#xe640;</i>
						</a>
					</li>
				</ul>

			</div>
			<div class="gd"></div>
			<div id="mell">
				<ul>
					<li class="lt litpc">
						<i class="icon iconfont">&#xe688;</i>
					</li>
					<li class="rt ritpc">
						<a href="">
							<p>我的优惠券</p>
							<i class="icon iconfont">
								&#xe640;
							</i>
							<span class="rt" style="line-height: 42px;font-size: 16px;color: #c30d23;vertical-align: middle;">8</span>
						</a>
					</li>
				</ul>
				<ul>
					<li class="lt litpc">
						<i class="icon iconfont">&#xe687;</i>
					</li>
					<li class="rt ritpc">
						<a href="">
							<p>我的收藏</p>
							<i class="icon iconfont">
								&#xe640;
							</i>
						</a>
					</li>
				</ul>
				<ul>
					<li class="lt litpc">
						<i class="icon iconfont">&#xe68a;</i>
					</li>
					<li class="rt ritpc">
						<a href="edit_message.html">
							<p>资料修改</p>
							<i class="icon iconfont">&#xe640;</i>
						</a>
					</li>
				</ul>
				<ul>
					<li class="lt litpc">
						<i class="icon iconfont">&#xe689;</i>
					</li>
					<li class="rt ritpc">
						<a href="storelists.html">
							<p>门店查询</p>
							<i class="icon iconfont">&#xe640;</i>
						</a>
					</li>
				</ul>
			</div>
			<div class="red_line">
				
			</div>
			<div id="little">
				<ul>
					<li class="lt litpc">
						<i class="icon iconfont">&#xe684;</i>
					</li>
					<li class="rt ritpc">
						<a href="">
							<p>17753205330</p>
						</a>
					</li>
				</ul>
				<ul>
					<li class="lt litpc">
						<i class="icon iconfont">&#xe686;</i>
					</li>
					<li class="rt ritpc">
						<p>会员卡</p>
						<div class="right_lq" onclick="function()">
							立即领取
						</div>
					</li>
				</ul>
				<ul>
					<li class="lt litpc">
						<i class="icon iconfont">&#xe685;</i>
					</li>
					<li class="rt ritpc">
						<a href="">
							<p>帮助中心</p>
						</a>
					</li>
				</ul>
			</div>
			<script>
				var c = window.screen.availHeight;
				console.log(c);
				$('#main').css('height', c);
				$(function() {
					$(".inp_tjr").hide();
					$(".change_tjr").click(function() {
						$(".inp_tjr").show();
					});
				});
			</script>
	</body>

</html>