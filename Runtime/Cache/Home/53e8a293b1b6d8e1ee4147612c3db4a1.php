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
		<link rel="stylesheet" href="//cdn.bootcss.com/weui/0.4.3/style/weui.min.css">
        <link rel="stylesheet" href="//cdn.bootcss.com/jquery-weui/0.8.3/css/jquery-weui.min.css">
		<script src="/Public/Qian/js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="/Public/Qian/js/layer.js"></script>
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
								<input type="tel" name="user_tel" value="<?php echo ($user['user_tel']); ?>" />
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
				<a href="javascript:void(0)" class="btn-md" id="tijiao">保存 </a>
			</div>
			</form>
	</body>
    <script type="text/javascript">
    	$(function(){
    		$("#tijiao").click(function(){
    			var name = $('input[name="user_name"]').val();
    			if(!name){
    				layer.msg('姓名不能为空');return;
    			}
    			if(name.length > 10){
    				layer.msg('姓名的长度太长');return;
    			}
    			var area = $('input[name="city"]').val();
    			if(!area){
    				layer.msg('地区不能为空');return;
    			}
    			var tel = $('input[name="user_tel"]').val();
    			if(tel != '' && !(/^1\d{10}$/.test(tel))){
    				layer.msg('请输入正确的手机号');return;
    			}
    			$.showLoading("正在加载...");
    			$("form").submit();
    		})
    	})
    </script>
     <script src="//cdn.bootcss.com/jquery-weui/0.8.3/js/jquery-weui.min.js"></script>
</html>