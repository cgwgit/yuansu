<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>个人中心</title>
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/reset.css">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/jquery-weui.css">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/myself.css">
		<script type="text/javascript" src="/Public/Qian/js/jquery-1.10.1.min.js"></script>
		<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
		<script type="text/javascript">
			//配置信息验证接口
				 wx.config({
				    debug: true,
				    appId: '<?php echo $signPackage["appId"];?>',
				    timestamp: '<?php echo $signPackage["timestamp"];?>',
				    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
				    signature: '<?php echo $signPackage["signature"];?>',
				    jsApiList: [
				        // 所有要调用的 API 都要加到这个列表中
				        'addCard'
				      ]
	            });
				 wx.ready(function(){
                                //添加卡券
                document.querySelector('#addCard').onclick = function () {
                    wx.addCard({
                      cardList: [
                        {
                          cardId: "pVYA_t3RCVF_yhNcO6QCeAmb-1UI",
                          cardExt: '{"timestamp":"<?php echo $huiyuanPackage['timestamp'] ?>","signature":"<?php echo $huiyuanPackage['signature'] ?>"}'
                        }
                      ],
                      success: function (res) {
                        alert('已添加卡券：' + JSON.stringify(res.cardList));
                      }
                    });
                };
            });
		</script>
	</head>

	<body style="background: #f0f0f2;">
		<div id="main">
			<div id="header">
				<ul class="h_top">
					<li class="l1 lt" style="margin-left: 6%;">
						<img src="<?php echo ($user['user_img']); ?>" alt="" width="70px" height="70px" style="border-radius: 55px;" />
					</li>
					<li class="l2 lt" style="margin-left: 4%;">
						<p class="p1" style="width: 60%;height: 40px;overflow: hidden;line-height: 40px;font-size: 20px;"><?php echo ($user['user_name']); ?></p>
						<p class="p1" style="line-height: 18px;">
							<I class="icon iconfont" style="color:#c30d23;font-size: 20px;">&#xe68b;</I>
							普通会员
						</p>
					</li>
				</ul>

			</div>
			<div class="gd"></div>
			<div id="mell">
				<ul>
					<li class="lt litpc">
						<i class="icon iconfont">&#xe691;</i>
					</li>
					<li class="rt ritpc">
						<a href="/index.php/Home/My/goodsShouCang">
							<p>收藏产品</p>
							<i class="icon iconfont" style="color:#9f9d9d;">
								&#xe640;
							</i>
							<span class="rt" style="line-height: 42px;font-size: 16px;color: #c30d23;vertical-align: middle;"><?php echo ($goods_count); ?></span>
						</a>
					</li>
				</ul>
				<ul>
					<li class="lt litpc">
						<i class="icon iconfont">&#xe690;</i>
					</li>
					<li class="rt ritpc">
						<a href="/index.php/Home/My/shopShouCang">
							<p>收藏店铺</p>
							<i class="icon iconfont" style="color:#9f9d9d;">
								&#xe640;
							</i>
							<span class="rt" style="line-height: 42px;font-size: 16px;color: #c30d23;vertical-align: middle;"><?php echo ($shop_count); ?></span>
						</a>
					</li>
				</ul>
				<ul>
					<li class="lt litpc">
						<i class="icon iconfont">&#xe68a;</i>
					</li>
					<li class="rt ritpc">
						<a href="/index.php/Home/My/editUser">
							<p>资料修改</p>
							<i class="icon iconfont" style="color:#9f9d9d;">&#xe640;</i>
						</a>
					</li>
				</ul>
				<ul>
					<li class="lt litpc">
						<i class="icon iconfont">&#xe689;</i>
					</li>
					<li class="rt ritpc">
						<a href="/index.php/Home/Shop/shopList">
							<p>门店查询</p>
							<i class="icon iconfont" style="color:#9f9d9d;">&#xe640;</i>
						</a>
					</li>
				</ul>
			</div>
			<div class="red_line">
				
			</div>
			<div id="little">
				<!--<ul>
					<li class="lt litpc">
						<i class="icon iconfont">&#xe684;</i>
					</li>
					<li class="rt ritpc">
						<a href="">
							<p>17753205330</p>
						</a>
					</li>
				</ul>-->
				<ul>
					<li class="lt litpc">
						<i class="icon iconfont">&#xe686;</i>
					</li>
					<li class="rt ritpc">
						<p>会员卡</p>
						<div class="right_lq" id="addCard">
							立即领取
						</div>
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