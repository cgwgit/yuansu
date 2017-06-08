<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="renderer" content="webkit|ie-comp|ie-stand">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
		<meta http-equiv="Cache-Control" content="no-siteapp" />
		<link rel="Bookmark" href="/Public/images/favicon.ico">
		<link rel="Shortcut Icon" href="/Public/images/favicon.ico" />
		<!--[if lt IE 9]>
<script type="text/javascript" src="/Public/lib/html5shiv.js"></script>
<script type="text/javascript" src="/Public/lib/respond.min.js"></script>
<![endif]-->
		<link rel="stylesheet" type="text/css" href="/Public/static/h-ui/css/H-ui.min.css" />
		<link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/H-ui.admin.css" />
		<link rel="stylesheet" type="text/css" href="/Public/lib/Hui-iconfont/1.0.8/iconfont.css" />
		<link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/skin/default/skin.css" id="skin" />
		<link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/style.css" />
		<!--[if IE 6]>
<script type="text/javascript" src="/Public/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
		<title>订单列表</title>
	</head>

	<body>
		<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 订单管理 <span class="c-gray en">&gt;</span> 订单列表
			<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新"><i class="Hui-iconfont">&#xe68f;</i></a>
		</nav>
		<div class="page-container">
		   <form method="post" id="myFormId" action="/index.php/Admin/Order/orderList">
				<div class="text-c">
				发货状态：<span class="select-box"style=" width:150px;height: 31px">
						<select name="fahuo_status" class="select">
						    <option value="">请选择发货状态</option>
							<option value="0">未发货</option>
							<option value="1">已发货</option>
						</select>
						</span>
						手机号：<input type="text" name="tel" placeholder="请输入手机号" style="width:150px" class="input-text">
						<!-- 物流单号：<input type="text" name="" placeholder="请输入物流单号" style="width:150px" class="input-text"> -->
					<button  class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
				</div>
			</form>
			<div id="tab_demo" class="HuiTab">
				<div class="tabCon">
					<table class="table table-border table-bordered table-bg mt-20">
						<thead>
							<tr>
							</tr>
							<tr class="text-c">
								<th width="40">ID</th>
								<th width="150">订单号</th>
								<th>产品名称</th>
								<th width="130">产品价格</th>
								<th width="130">姓名</th>
								<th width="130">手机号</th>
								<th width="130">地址</th>
								<th width="130">创建时间</th>
								<th width="130">状态</th>
								<th width="130">相关操作</th>
							</tr>
						</thead>
					<tbody>
						<?php if(is_array($orders)): foreach($orders as $key=>$v): ?><tr class="text-c">
									<td><?php echo ($v['order_id']); ?></td>
									<td><?php echo ($v['order_bianhao']); ?></td>
									<td><?php echo ($v['goods_title']); ?></td>
									<td><?php echo ($v['order_price']); ?></td>
									<td><?php echo ($v['order_name']); ?></td>
									<td><?php echo ($v['tel']); ?></td>
									<td><?php echo ($v['area']); echo ($v['area_detail']); ?></td>
									<td><?php echo date('Y-m-d H:i:s',$v['order_time']) ?></td>
									<td><?php if($v['fahuo_status'] == 1): ?><span class="label label-success radius">已发货</span><?php else: ?><span class="label label-danger radius">未发货</span><?php endif; ?></td>
									<td>
										<a href="javascript:;" class="ml-10" onclick="order_infos('查看订单详情','/index.php/Admin/Order/WeiFaDetail/order_id/<?php echo ($v['order_id']); ?>','680','510')">查看订单详情</a>
										<?php if($v['fahuo_status'] == 0): ?><a style="text-decoration:none" onClick="activity_start(this,'<?php echo $v['order_id'] ?>')" href="javascript:;" title="发货">
											<i class="Hui-iconfont">&nbsp;&nbsp;&nbsp;&nbsp;发货</i>
										    </a><?php endif; ?>
									</td>
								</tr><?php endforeach; endif; ?>
					</tbody>
					</table>

				</div>
				<div class="pagination ue-clear" align="left">
				<div id="page" class="page">
						<?php echo $page ?>
			     </div>
            </div>
			</div>
		</div>
		<!--_footer 作为公共模版分离出去-->
		<script type="text/javascript" src="/Public/lib/jquery/1.9.1/jquery.min.js"></script>
		<script type="text/javascript" src="/Public/lib/layer/2.4/layer.js"></script>
		<script type="text/javascript" src="/Public/static/h-ui/js/H-ui.min.js"></script>
		<script type="text/javascript" src="/Public/static/h-ui.admin/js/H-ui.admin.js"></script>
		<!--/_footer 作为公共模版分离出去-->

		<!--请在下方写此页面业务相关的脚本-->

		<script type="text/javascript" src="/Public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
		<script type="text/javascript">
			/*
				参数解释：
				title	标题
				url		请求的url
				id		需要操作的数据id
				w		弹出层宽度（缺省调默认值）
				h		弹出层高度（缺省调默认值）
			*/
			/*未发货订单详情*/
			function order_infos(title, url, w, h) {
				layer_show(title, url, w, h);
			}
			/*已发货订单详情*/
			function order_infos2(title, url, w, h) {
				layer_show(title, url, w, h);
			}
			$(function() {
				$.Huitab("#tab_demo .tabBar span", "#tab_demo .tabCon", "current", "click", "0")
			});

			/*活动-开启*/
			function activity_start(obj, id) {
				layer.confirm('确认要发货吗？', function(index) {
					window.location.href="/index.php/Admin/Order/OrderInfo/order_id/"+id;
					//此处请求后台程序，下方是成功后的前台处理……
    //                        $.ajax({
				// 		        type: "get",
				// 		        dataType: "json",
				// 		        url: '/index.php/Admin/Order/faHuo',
				// 		        data: {'aid':id},
				// 		        success: function (data) {
				// 		            if(data.code == 1) {
				// 		               layer.msg(data.msg,{icon:1,time:1000},function(){
				// 						window.location.href="/index.php/Admin/Order/OrderList";
				// 				       });
				// 		            }else if(data.code == 0){
				// 		            	layer.close(index); 
				// 				        layer.msg(data.msg,{icon:2,time:1000});
				// 		            }
				// 		        }
						   
				
				// });
                 	});
			}
		</script>
	</body>

</html>