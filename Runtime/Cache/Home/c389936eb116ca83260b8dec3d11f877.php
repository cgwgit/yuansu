<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>店铺列表</title>
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/reset.css">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/iconfont.css">
		<link rel="stylesheet" type="text/css" href="/Public/Qian/css/index.css" />		
    	<link rel="stylesheet" href="/Public/Qian/css/cityPicker.css"/>
		<link rel="stylesheet" href="/Public/Qian/lib/weui.min.css">
		<script src="/Public/Qian/js/jquery-2.1.4.min.js"></script>
		<script src="/Public/Qian/js/cityPicker.js"></script>
		<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
		<script type="text/javascript">
		//配置信息验证接口
				 wx.config({
				    debug: false,
				    appId: '<?php echo $signPackage["appId"];?>',
				    timestamp: '<?php echo $signPackage["timestamp"];?>',
				    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
				    signature: '<?php echo $signPackage["signature"];?>',
				    jsApiList: [
				        // 所有要调用的 API 都要加到这个列表中
				        'checkJsApi',
				        'openLocation',
				        'getLocation'
				      ]
	            });
			//验证之后进入该函数，所有需要加载页面时调用的接口都必须写在该里面
			 wx.ready(function () {
			 	//基础接口判断当前客户端版本是否支持指定JS接口
				 wx.checkJsApi({
				    jsApiList: [
				        'getLocation'
				    ],
				    success: function (res) {
				        // alert(JSON.stringify(res));
				        // alert(JSON.stringify(res.checkResult.getLocation));
				        if (res.checkResult.getLocation == false) {
				            alert('你的微信版本太低，不支持微信JS接口，请升级到最新的微信版本！');
				            return;
				        }
				    }
				});

				 wx.getLocation({
				    success: function (res) {
				        var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
				        var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
                        $.ajax({
                        	type: 'post',
                        	url: '/index.php/Home/Shop/shopList',
                        	dataType: 'json',
                        	data: {"latitude": latitude,"longitude":longitude},
                        	success:function(shopInfo){
                        		//index是下表，el是值
                               $(shopInfo).each(function(index,el){
                                    $("#list").append('<div class="item-store"> <a class="s-top ui-width-100 ui-flex" href="/index.php/Home/Shop/shopDetail/shop_id/'+el.shop_id+'"> <img src="'+el.shop_logo.substring(1)+'" class="s-img"/> <div class="s-message"> <h4>'+el.shop_name+'</h4> <div class="s-address">'+el.shop_position+'</div> </div> </a> <div class="s-bottom-block ui-width-100"> <ul> <li class="br"> <a href="tel:'+el.shop_tel+'" class="db-block"> <i class="icon iconfont">&#xe624;</i>'+el.shop_tel+'</a> </li> <li> <a href="/index.php/Home/Shop/daohang/shop_id/'+el.shop_id+'" class="db-block"> <i class="icon iconfont">&#xe66c;</i> 一键导航 <span class="kilemiter"> '+el.distance/1000+'km </span> </a> </li> </ul> </div> </div>');
                               })                        
                         	}
                        });
				    },
				    cancel: function (res) {
				    	$(".city").triggerHandler("focus");
				    }
                });
            });
		</script>
	</head>

	<body class="min-width">
		<!--search-->
		<div class="box_storeTop">
			<div class="leftAddress">
				
			<input type="text" value="青岛市" class="city" id="quxiao"readonly="" style="width:50px;overflow: hidden;max-width: 50px;display: inline-block;height: 40px;border:0;background:none;float: left;" >
				<i class="icon iconfont" style="color: #4b4949;display: inline-block;float: left;vertical-align: middle;">&#xe60e;</i>
			</div>
			<div class="weui-search-bar" id="searchBar" >
			<form class="weui-search-bar__form" >
				<div class="weui-search-bar__box">
					<i class="weui-icon-search"></i>
					<input type="search" class="weui-search-bar__input" id="searchInput" placeholder="搜索" required="">
					<a href="javascript:" class="weui-icon-clear" id="searchClear"></a>
				</div>
				<label class="weui-search-bar__label" id="searchText" style="transform-origin: 0px 0px 0px; opacity: 1; transform: scale(1, 1);">
		          <i class="weui-icon-search"></i>
		          <span>搜索</span>
		        </label>
			</form>
			<a href="javascript:" class="weui-search-bar__cancel-btn" id="searchCancel">取消</a>
		</div>
		
		</div>
		<!--lists-->
		<div class="storelists ui-width-100" id="list">
		</div>
		<script src="/Public/Qian/js/jquery-weui.js"></script>
		<script>
		    var picker = $(".city").CityPicker();
		</script>
	</body>
</html>
	<script type="text/javascript">
	$(function(){
		$("body").delegate(".picker-box .city-picker li","click",function(){
			var city = $(this).text();
			$.ajax({
				url: '/index.php/Home/Shop/getShop/city/'+city,
				type: 'get',
				dataType: 'json',
				success:function(data){
                    if(data.code != 0){
                    	$(".item-store").remove();
                    	    $(data).each(function(index,el){
                                    $("#list").append('<div class="item-store"> <a class="s-top ui-width-100 ui-flex" href="/index.php/Home/Shop/shopDetail/shop_id/'+el.shop_id+'"> <img src="'+el.shop_logo.substring(1)+'" class="s-img"/> <div class="s-message"> <h4>'+el.shop_name+'</h4> <div class="s-address">'+el.shop_position+'</div> </div> </a> <div class="s-bottom-block ui-width-100"> <ul> <li class="br"> <a href="tel:'+el.shop_tel+'" class="db-block"> <i class="icon iconfont">&#xe624;</i>'+el.shop_tel+'</a> </li> <li> <a href="http://api.map.baidu.com/direction?origin=latlng:36.09297,120.3743|name:我的位置&destination=山东省青岛市利群宇恒大厦&mode=driving&output=html&src=yourCompanyName|yourAppName" class="db-block"> <i class="icon iconfont">&#xe66c;</i> 一键导航</a> </li> </ul> </div> </div>');
                               });  
                    }else{
	         	      alert("您搜索的城市商店不存在");
	              }
				},
			})
		});
		$("form").submit(function(){
		    var city = $("#searchInput").val();
        	$.ajax({
				type: 'get',
				url: '/index.php/Home/Shop/getShop/city/'+city,
				dataType: 'json',
				async : false,
				success:function(data){
                    if(data.code != 0){
                    	$(".item-store").remove();
                	    $(data).each(function(index,el){
                            $("#list").append('<div class="item-store"> <a class="s-top ui-width-100 ui-flex" href="/index.php/Home/Shop/shopDetail/shop_id/'+el.shop_id+'"> <img src="'+el.shop_logo.substring(1)+'" class="s-img"/> <div class="s-message"> <h4>'+el.shop_name+'</h4> <div class="s-address">'+el.shop_position+'</div> </div> </a> <div class="s-bottom-block ui-width-100"> <ul> <li class="br"> <a href="tel:'+el.shop_tel+'" class="db-block"> <i class="icon iconfont">&#xe624;</i>'+el.shop_tel+'</a> </li> <li> <a href="http://api.map.baidu.com/direction?origin=latlng:36.09297,120.3743|name:我的位置&destination=山东省青岛市利群宇恒大厦&mode=driving&output=html&src=yourCompanyName|yourAppName" class="db-block"> <i class="icon iconfont">&#xe66c;</i> 一键导航</a> </li> </ul> </div> </div>');
                        });  
                    }else{
	         	      alert("您搜索的城市商店不存在");
	            	}
				}
			
			});
			return false;
		});
	});
		
	</script>