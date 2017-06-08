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
		<title>产品列表</title>
	</head>
	<body>
		<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品管理 <span class="c-gray en">&gt;</span> 产品列表
			<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新">
				<i class="Hui-iconfont">&#xe68f;</i></a>
		</nav>
		<div class="page-container">
        <form method="post" id="myFormId" action="/index.php/Admin/GoodsBuy/showList">
			<div class="text-c">
				<input type="text" name="goods_title" placeholder="请输入产品描述" style="width:150px" class="input-text">
				<button name="" id="tijiao" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
			</div>
		</form>
			<div class="mt-20">
				<table class="table table-border table-bordered table-bg table-hover table-sort">
					<thead>
						<tr class="text-c">
							<th width="80">ID</th>
							<th width="120">产品描述</th>
							<th width="120">产品价格</th>
							<th width="120">运费价格</th>
							<th width="120">产品购买链接</th>
							<th width="180">添加时间</th>
							<th width="180">修改时间</th>
							<th width="180">操作</th>
						</tr>
					</thead>
					<tbody>
					<?php if(is_array($goods_buy)): foreach($goods_buy as $key=>$v): ?><tr class="text-c">
							<td><?php echo $v['id'] ?></td>
							<td><?php echo $v['goods_title'] ?></td>
							<td><?php echo $v['goods_price'] ?></td>
							<td><?php echo $v['goods_yunfei'] ?>元</td>
							<td><?php echo SITE_URL ?>index.php/Home/GoodsBuy/index/id/<?php echo $v['id'] ?></td>
							<td><?php echo date('Y-m-d H:i:s', $v['addtime']) ?></td>
							<td><?php echo date('Y-m-d H:i:s', $v['uptime']) ?></td>
							<td class="td-manage">
								<a title="编辑" href="/index.php/Admin/GoodsBuy/editGoodsBuy/aid/<?php echo $v['id'] ?>" class="ml-10" style="text-decoration:none">
									<i class="Hui-iconfont">&#xe6df;</i>
								</a>
								<a title="删除" href="javascript:;" onclick="activity_del(this,'<?php echo $v['id'] ?>')" class="ml-10" style="text-decoration:none">
									<i class="Hui-iconfont">&#xe6e2;</i>
								</a>
								<a href="javascript:;" class="ml-10" onclick="activity_detail('查看详情','/index.php/Admin/GoodsBuy/goods_ListOne/id/<?php echo $v['id'] ?>','800','500')">查看详情</a>
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

			/*商品-删除*/
			function activity_del(obj, id) {
				layer.confirm('确认要删除吗？', function(index) {
					$.ajax({
						type: 'get',
						url: '/index.php/Admin/GoodsBuy/goods_BuyDel',
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
						url: '/index.php/Admin/GoodsBuy/del_Goods',
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
        window.location.href = '/index.php/Admin/GoodsBuy/delAction/aid/' + ids; //Tp框架中的写法
    };
$(function(){
    //给编辑按钮添加点击事件
    $('#btnedit').on('click',function(){
        //获取复选框的id值
        var id = $(':checkbox:checked').val();
        //跳转
        window.location.href = '/index.php/Admin/GoodsBuy/edit/id/' + id;
    });
});
		</script>
	</body>

</html>