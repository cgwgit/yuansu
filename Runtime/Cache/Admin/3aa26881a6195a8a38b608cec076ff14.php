<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="Keywords" content="">
		<meta name="Description" content="">
		<meta http-equiv="X-UA-Compatible" content="IE=9" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge"></meta>
		<title>居元素后台管理系统</title>
		<link type="text/css" rel="stylesheet" href="/Public/css/dailishang.css" />
		<link rel="stylesheet" type="text/css" href="/Public/static/h-ui/css/H-ui.min.css" />
		<link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/H-ui.admin.css" />
		<link rel="stylesheet" type="text/css" href="/Public/lib/Hui-iconfont/1.0.8/iconfont.css" />
		<link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/skin/default/skin.css" id="skin" />
		<link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/style.css" />
	</head>
	<body class="insurance_body">
		<div class="insurance_main">
			<div class="pingan_main">
				<img src="/Public/images/admin_logo.png" alt="居元素" class="pingan_logo" />
				<div class="form_pingan">
					<h2>后台管理系统</h2>
					<form id="form-admin-add" name="" id="" method="post" action="/index.php/Admin/Manager/login" onsubmit="return false">
						<div class="form_pinan_main">
							<div class="item_f">
								<label>用户名：</label>
								<input type="text" name="name" id="" value="" class="input_f" />
								<em class="tips">*必填</em>
							</div>
							<div class="item_f">
								<label>密码：</label>
								<input type="password" name="pwd" id="" value="" class="input_f" />
								<em class="tips">*必填</em>
							</div>
							<div class="item_f">
							</div>
						</div>
						<input type="submit" class="btn_login" value="登&nbsp;&nbsp;&nbsp;&nbsp;录" />
					</form>
				</div>
				<!-- <p class="banquan">版权所有：**科技有限公司 Onesoft © 2017 All Rights Reserved</p> -->
			</div>
		</div>
	</body>
<script type="text/javascript" src="/Public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Public/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Public/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/Public/static/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="/Public/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/Public/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/Public/lib/jquery.validation/1.14.0/messages_zh.js"></script> 
<script type="text/javascript">
	$(function(){
	$("#form-admin-add").validate({
		rules:{
			name:{
				required:false,
				minlength:4,
				maxlength:16
			},
			pwd:{
				required:false,
			},
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit({
				type: 'post',
				url: "/index.php/Admin/Manager/login",
				data:$("form").serialize(),
				dataType: "json",
				success: function(data){
					if(data.code == 1){
						layer.msg(data.msg,{icon:1,time:1000},function(){
							window.location.href="/index.php/Admin/Index/index";
						}
					   );
					}else if(data.code == 0){
						layer.msg(data.msg,{icon:2,time:1000});
					}
				}
			});
		}
	});
	})
</script>
</html>