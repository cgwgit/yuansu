<?php if (!defined('THINK_PATH')) exit();?>                                                                                                                  <!DOCTYPE HTML>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="renderer" content="webkit|ie-comp|ie-stand">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
		<meta http-equiv="Cache-Control" content="no-siteapp" />
		<!--[if lt IE 9]>
<script type="text/javascript" src="/Public/lib/html5shiv.js"></script>
<script type="text/javascript" src="/Public/lib/respond.min.js"></script>
<![endif]-->
		<link rel="stylesheet" type="text/css" href="/Public/static/h-ui/css/H-ui.min.css" />
		<link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/H-ui.admin.css" />
		<link rel="stylesheet" type="text/css" href="/Public/lib/Hui-iconfont/1.0.8/iconfont.css" />
		<link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/skin/default/skin.css" id="skin" />
		<link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/style.css" />
		<link rel="stylesheet" type="text/css" href="/Public/css/page.css" />
		<!--[if IE 6]>
<script type="text/javascript" src="/Public/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
		<title>门店列表</title>
	</head>
	<body>
		<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 门店管理 <span class="c-gray en">&gt;</span> 门店列表
			<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新">
				<i class="Hui-iconfont">&#xe68f;</i></a>
		</nav>
		<div class="page-container">
			<form method="post" id="myFormId" action="/index.php/Admin/Shop/shopList">
				<div class="text-c">
					<input type="text" name="shop_name" placeholder="请输入门店名称或位置" style="width:150px" class="input-text">
					<button name="" id="tijiao" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
				</div>
			</form>
			<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" id="btndel" class="btn btn-danger radius" onclick="activity_dels(this)">
				<i class="Hui-iconfont" id="btndel">&#xe6e2;</i> 批量删除</a>
			</div>
			<div class="mt-20">
				<table class="table table-border table-bordered table-bg table-hover table-sort">
					<thead>
						<tr class="text-c">
							<th width="25"></th>
							<th width="80">门店ID</th>
							<th width="180">门店logo</th>
							<th width="120">门店名称</th>
							<th width="120">门店位置</th>
							<!-- <th width="120">门店推荐</th>
							<th width="120">门店特色</th> -->
							<th width="120">营业时间</th>
							<!-- <th width="180">门店电话</th> -->
							<th width="100">收藏人数</th>
							<th width="180">添加时间</th>
							<th width="180">修改时间</th>
							<th width="180">操作</th>
						</tr>
					</thead>
					<tbody>
					<?php if(is_array($shop)): foreach($shop as $key=>$v): ?><tr class="text-c">
							<td><input type="checkbox" id="aid" name="huodong" value="<?php echo $v['shop_id'] ?>" /></td>
							<td><?php echo $v['shop_id'] ?></td>
							<td><img src = "<?php echo substr($v['shop_logo'],1)?>" width="50" height = "50"></td>
							<td><?php echo $v['shop_name'] ?></td>
							<td><?php echo $v['shop_position'] ?></td>
							<!-- <td><?php echo $v['shop_tuijian'] ?></td>
							<td><?php echo $v['shop_tese'] ?></td> -->
							<td><?php echo $v['shop_stime'] ?>--<?php echo $v['shop_etime'] ?></td>
							<td><u style="cursor:pointer" class="text-primary" onClick="article_list('查看','/index.php/Admin/Shop/shoucangList/shop_id/<?php echo $v['shop_id'] ?>','800','500')" title="查看"><?php echo $v['shop_shoucang'] ?>人</u></td>
							<td><?php echo date('Y-m-d H:i:s', $v['shop_addtime']) ?></td>
							<td><?php echo date('Y-m-d H:i:s', $v['shop_uptime']) ?></td>
							<td class="td-manage">
								<a title="编辑" href="/index.php/Admin/Shop/editShop/shop_id/<?php echo $v['shop_id'] ?>" class="ml-10" style="text-decoration:none">
									<i class="Hui-iconfont">&#xe6df;</i>
								</a>
								<a title="删除" href="javascript:;" onclick="activity_del(this,'<?php echo $v['shop_id'] ?>')" class="ml-10" style="text-decoration:none">
									<i class="Hui-iconfont">&#xe6e2;</i>
								</a>
								<a href="javascript:;" class="ml-10" onclick="activity_detail('查看','/index.php/Admin/Shop/shopList/aid/<?php echo $v['shop_id'] ?>','800','500')">查看</a>
							</td>
						</tr><?php endforeach; endif; ?>
					</tbody>

				</table>
			</div>
			<div class="pagination ue-clear">
				<div id="page" class="page">
						<?php echo $page ?>
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

		<script type="text/javascript" src="/Public/lib/My97DatePicker/4.8/WdatePicker.js"></script>
		<script type="text/javascript" src="/Public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="/Public/lib/laypage/1.2/laypage.js"></script>
		<script type="text/javascript">
			/*商品-添加*/
			function article_add(title, url, w, h) {
				layer_show(title, url, w, h);
			}
			/*商品-收藏人数*/
			function article_list(title, url, w, h) {
				layer_show(title, url, w, h);
			}
			/*商品-查看详情*/
			function activity_detail(title, url, w, h) {
				layer_show(title, url, w, h);
			}

			/*商品-编辑*/
			function activity_edit(title, url, w, h) {
				layer_show(title, url, w, h);
			}
			/*商品-关闭*/
			function activity_stop(obj, id) {
				layer.confirm('确认要关闭吗？', function(index) {
					           $.ajax({
						        type: "get",
						        dataType: "json",
						        url: '/index.php/Admin/Shop/endAction',
						        data: {'aid':id},
						        success: function (data) {
						            if(data.code == 1) {
						                //此处请求后台程序，下方是成功后的前台处理……
											$(obj).parents("tr").find(".td-manage").prepend('<a onClick="activity_start(this,<?php echo $v['id'] ?>)" href="javascript:;" title="开启" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
											$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">已关闭</span>');
											$(obj).remove();
											layer.msg('已关闭', {
												icon: 5,
												time: 1000
											});
						            }
						        }
				});
				});
			}

			/*商品-开启*/
			function activity_start(obj, id) {
				layer.confirm('确认要开启吗？', function(index) {
					//此处请求后台程序，下方是成功后的前台处理……
                           $.ajax({
						        type: "get",
						        dataType: "json",
						        url: '/index.php/Admin/Shop/startAction',
						        data: {'aid':id},
						        success: function (data) {
						            if(data.code == 0) {
						                layer.msg('请关闭正在进行的商品', {
												icon: 6,
												time: 1000
											});
						            }else if(data.code == 1){
						            		$(obj).parents("tr").find(".td-manage").prepend('<a onClick="activity_stop(this,<?php echo $v['id'] ?>)" href="javascript:;" title="关闭" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
											$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已开启</span>');
											$(obj).remove();
											layer.msg('已开启!', {
												icon: 6,
												time: 1000
											});
						            }

						        }
						   
				
				});
                 	});
			}
			/*商品-删除*/
			function activity_del(obj, id) {
				layer.confirm('确认要删除吗？', function(index) {
					$.ajax({
						type: 'get',
						url: '/index.php/Admin/Shop/delShop',
						data:{'aid':id},
						dataType: 'json',
						success: function(data) {
							if(data.code == 1){
							$(obj).parents("tr").remove();
							layer.msg('已删除!', {
								icon: 1,
								time: 1000
							});
						}else{
							layer.msg('删除失败!', {
								icon: 1,
								time: 1000
							});
						}
					},
						error: function(data) {
							console.log(data.msg);
						},
					});
				});
			}
    //给删除按钮添加点击事件(批量删除)
    	function activity_dels(obj) {
        	layer.confirm('确认要删除吗？', function(index) {
        		        //获取复选框的id值
	        var id = $(':checkbox:checked');    //jQuery对象,类数组的对象
	        var ids = '';   //要求ids的形式是 1,2,3,4,5
	        for(var i = 0;i < id.length;i++){
	            ids = ids + id[i].value + ',';
	        }
	        //剔除右边的逗号
	        ids = ids.substring(0,ids.length-1);
					$.ajax({
						type: 'get',
						url: '/index.php/Admin/Shop/delShop',
						data:{'aid':ids},
						dataType: 'json',
						success: function(data) {
							if(data.code == 1){
								$(obj).parents("tr").remove();
							layer.msg('已删除!', {
								icon: 1,
								time: 1000,
							},function(){
								window.location.href=window.location.href;
							});
						}
					}
					});
				});
        window.location.href = '/index.php/Admin/Shop/delAction/aid/' + ids; //Tp框架中的写法
    };
$(function(){
    //给编辑按钮添加点击事件
    $('#btnedit').on('click',function(){
        //获取复选框的id值
        var id = $(':checkbox:checked').val();
        //跳转
        window.location.href = '/index.php/Admin/Shop/edit/id/' + id;
    });
});
		</script>
	</body>

</html>