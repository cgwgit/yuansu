<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>确认支付</title>
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/reset.css">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/newaddress.css">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/iconfont.css">
		<link rel="stylesheet" href="/Public/Qian/css/jquery-weui.css">
		<script src="/Public/Qian/js/jquery-2.1.4.min.js"></script>
	</head>
	<body>
	   
		<div id="main">
			  <div id="header">
				<ul id="dimension">
					<li>
						<ul>
							<li class="l1">收货人</li>
							<li class="l2"><?php echo ($order_Info['order_name']); ?></li>
							<input type="hidden" name="order_id" value="<?php echo ($order_Info['order_id']); ?>"></input>
							<div class="clear"></div>
						</ul>
					</li>
					<li>
						<ul>
							<li class="l1">联系电话</li>
							<li class="l2"><?php echo ($order_Info['tel']); ?></li>
							<div class="clear"></div>
						</ul>
					</li>
					<li>
						<ul>
							<li class="l1">地区</li>
							<li class="" style="float: left;width: 70%;">
								<?php echo ($order_Info['area']); ?>
							</li>
							<div class="clear"></div>
						</ul>
					</li>
					<li>
						<ul>
							<li class="l1">详细地址</li>
							<li class="l2">
								<?php echo ($order_Info['area_detail']); ?>
							</li>
							<div class="clear"></div>
						</ul>
					</li>
				</ul>
				<div class="box_price">
				<div class="left ui-width-50 fl">
					商品合计￥：<span class="color-danger"><?php echo ($order_Info['order_price']); ?></span>元
				</div>
			</div>
				<div id="baocun">
					<a class="btn" href="javascript:void(0)" onclick="callpay()">确认支付</a>
				</div>
			</div>
		</div>
			<script src="/Public/Qian/js/jquery-weui.js"></script>
			<script type="text/javascript">
		        //调用微信JS api 支付
		        //在线充值
		        function jsApiCall() //jsApiCall 数据处理
		        {
		            WeixinJSBridge.invoke(
		                    'getBrandWCPayRequest',
		                    <?php echo ($parameters); ?>,
		                    function (res) {
		                        // alert(res.err_code+ ' | ' + res.err_desc +' | ' +res.err_msg);
		                        if (res.err_msg == 'get_brand_wcpay_request:ok') {
		                        	// $.toast("支付成功");
		                        	window.location.href="/index.php/Home/GoodsBuy/pay_success";
		                             //登录成功 跳转到主要页面
		                        }else if(res.err_msg == "get_brand_wcpay_request:cancel"){
			                            layer.open({
										content: '取消支付',
										skin: 'msg',
										time: 2 //2秒后自动关闭
								       });	
		                        }else{
                                        layer.open({
										content: '支付失败',
										skin: 'msg',
										time: 2 //2秒后自动关闭
								       });
		                        }
		                    }
		            );
		        }
		        function callpay() {
		            if (typeof WeixinJSBridge == "undefined") {
		                if (document.addEventListener) {
		                    document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
		                } else if (document.attachEvent) {
		                    document.attachEvent('WeixinJSBridgeReady', jsApiCall);
		                    document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
		                }
		            } else {
		                jsApiCall();
		            }
		        }
    </script>
	</body>

</html>