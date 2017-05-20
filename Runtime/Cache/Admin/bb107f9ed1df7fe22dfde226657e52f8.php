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
		<title>商品列表</title>
	</head>
	<body>
		<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 商品管理 <span class="c-gray en">&gt;</span> 商品列表
			<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新">
				<i class="Hui-iconfont">&#xe68f;</i></a>
		</nav>
		<div class="page-container">
<!-- 			<div class="text-c">
				<input type="text" name="" id="" placeholder="商品标题" style="width:250px" class="input-text">
				<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜商品</button>
			</div> -->
			<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" id="btndel" class="btn btn-danger radius" onclick="activity_dels(this)">
				<i class="Hui-iconfont" id="btndel">&#xe6e2;</i> 批量删除</a>
				<!-- <a class="btn btn-primary radius" onclick="article_add('添加商品','/index.php/Admin/Goods/addAction/','800','500')" href="javascript:;">
					<i class="Hui-iconfont">&#xe600;</i> 添加产品</a></span> <span class="r">共有数据：<strong><?php echo $allmoney[0][count] ?></strong> 条</span> -->
			</div>
			<div class="mt-20">
				<table class="table table-border table-bordered table-bg table-hover table-sort">
					<thead>
						<tr class="text-c">
							<th width="25"></th>
							<th width="80">ID</th>
							<th width="120">产品品名</th>
							<th width="120">产品容积</th>
							<thwidth="120">产品颜色</th>
							<th width="180">产品特点</th>
							<th width="180">产品logo</th>
							<th width="180">操作</th>
						</tr>
					</thead>
					<tbody>
					<?php if(is_array($action)): foreach($action as $key=>$v): ?><tr class="text-c">
							<td><input type="checkbox" id="aid" name="huodong" value="<?php echo $v['id'] ?>" /></td>
							<td><?php echo $v['id'] ?></td>
							<td><?php echo date('Y-m-d H:i:s', $v['stime']) ?></td>
							<td><?php echo date('Y-m-d H:i:s', $v['etime']) ?></td>
							<td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="article_list('查看','/index.php/Admin/Goods/showList/aid/<?php echo $v['id'] ?>','800','500')" title="查看"><?php echo $v['title'] ?></u></td>
							<td><?php echo $v['sumperson'] ?></td>
							<td><?php echo $v['money'] ?></td>
							<td><?php echo $v['summoney'] ?></td>
							<td>http://166xj71935.51mypc.cn/index.php/Home/Index/index/id/<?php echo $v['dizhi'] ?></td>
							<td class="td-status" id="kai">
							<?php if($v['status'] == 1): ?><span class="label label-success radius">已开启</span>
							<?php elseif($v['status'] == 3): ?>
							   <span class="label label-default radius">未开启</span>
							 <?php else: ?>
							   <span class="label label-default radius">已关闭</span><?php endif; ?></td>

							<td class="td-manage">
							<?php if($v['status'] == 0): ?><a style="text-decoration:none" onClick="activity_start(this,'<?php echo $v['id'] ?>')" href="javascript:;" title="启用">
									<i class="Hui-iconfont">&#xe615;</i>
								</a>
							<?php elseif($v['status'] == 3): ?>
							     <a style="text-decoration:none" onClick="activity_start(this,'<?php echo $v['id'] ?>')" href="javascript:;" title="启用">
									<i class="Hui-iconfont">&#xe615;</i>
								</a>
							<?php else: ?>
                              <a style="text-decoration:none" onClick="activity_stop(this,'<?php echo $v['id'] ?>')" href="javascript:;" title="关闭">
									<i class="Hui-iconfont">&#xe615;</i>
								</a><?php endif; ?>
							    
								<a title="编辑" href="/index.php/Admin/Goods/editAction/aid/<?php echo $v['id'] ?>" class="ml-10" style="text-decoration:none">
									<i class="Hui-iconfont">&#xe6df;</i>
								</a>
								<a title="删除" href="javascript:;" onclick="activity_del(this,'<?php echo $v['id'] ?>')" class="ml-10" style="text-decoration:none">
									<i class="Hui-iconfont">&#xe6e2;</i>
								</a>
								<a href="javascript:;" class="ml-10" onclick="activity_detail('参与详情','/index.php/Admin/Cinfo/showList/aid/<?php echo $v['id'] ?>','800','500')">参与详情</a>
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
			/*商品-查看*/
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
						        url: '/index.php/Admin/Goods/endAction',
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
						        url: '/index.php/Admin/Goods/startAction',
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
						url: '/index.php/Admin/Goods/delAction',
						data:{'aid':id},
						dataType: 'json',
						success: function(data) {
							if(data.code == 1){
							$(obj).parents("tr").remove();
							layer.msg('已删除!', {
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
						url: '/index.php/Admin/Goods/delAction',
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
        window.location.href = '/index.php/Admin/Goods/delAction/aid/' + ids; //Tp框架中的写法
    };
$(function(){
    //给编辑按钮添加点击事件
    $('#btnedit').on('click',function(){
        //获取复选框的id值
        var id = $(':checkbox:checked').val();
        //跳转
        window.location.href = '/index.php/Admin/Goods/edit/id/' + id;
    });
});
		</script>
	</body>

</html>