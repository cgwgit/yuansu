<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>资料修改</title>
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/reset.css">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/iconfont.css">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/myself.css">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/index.css" />
		<link rel="stylesheet" href="/Public/Qian/lib/weui.css">
	</head>

	<body style="background: #f0f0f2;">
		<div id="main">
			<div class="gd"></div>
			<form method="post" action="/index.php/Home/My/editUser">
				<div id="mell">
					<ul>
						<li class="lt ritpc" style="margin-left: 6%;">
							<p>头像</p>
							<div class="jsd_photo" onclick="function()">
								<img src="<?php echo ($user['user_img']); ?>" class="ui-width-100" />
							</div>
						</li>
					</ul>

					<ul>
						<li class="lt ritpc" style="margin-left: 6%;">
							<p>姓名</p>
							<div class="jsd_content" onclick="function()">
							    <input type="hidden" name="user_id" value="<?php echo ($user['user_id']); ?>"></input>
								<input type="text" name="user_name" value="<?php echo ($user['user_name']); ?>" />
							</div>
						</li>
					</ul>
					<ul>
						<li class="lt ritpc" style="margin-left: 6%;">
							<p>手机号</p>
							<div class="jsd_content">
								<input type="text" name="user_tel" value="<?php echo ($user['user_tel']); ?>" />
							</div>
						</li>
					</ul>
					<ul>
						<li class="lt ritpc" style="margin-left: 6%;">
							<p>地区</p>
							<div class="jsd_content" style="width: 60%;">
								<!--<input class="weui-input" id="home-city" type="text">-->
								<input type="text" name="city" value="<?php echo ($user['city']); ?>" />
							</div>
						</li>
					</ul>
				</div>
			<div class="box-btn-md" style="background: none;">
			    <input type="submit" value="保存" class="btn-md"></input>
				<!-- <a href="storelists.html" class="btn-md">保存 </a> -->
			</div>
			</form>
	</body>

</html>