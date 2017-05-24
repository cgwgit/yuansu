<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
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
		<link href="/Public/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
		<!--[if IE 6]>
<script type="text/javascript" src="/Public/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
		<title>添加产品 </title>
		<meta name="keywords" content="">
		<meta name="description" content="">
		<script type="text/javascript">
			var catinfo = new Array();//声明一个缓存变量，存储获得出来的分类信息
			  //根据当前分类 自动关联获取次级分类信息
			  function show_catinfo(obj,mark){
			    var cat_ida = $(obj).val(); //获得当前分类的id信息
			    if(typeof catinfo[cat_ida] === 'undefined'){
			      //通过ajax获取次级分类信息
			      $.ajax({
			        url:"/index.php/Admin/Category/getCatInfoB",
			        data:{'cat_ida':cat_ida},
			        dataType:'json',
			        async:false,
			        type:'get',
			        success:function(msg){
			          //console.log(msg);[Object { cat_id="5", cat_name="电子书"}, Object { cat_id="6", cat_name="数字音乐"}, Object { cat_id="7", cat_name="音像"}]
			          //遍历msg，使得数据 与 html代码结合并追加给页面
			          //m为键，n为遍历到的dom对象
			          var s = "";
			          $.each(msg,function(m,n){
			            s += '<option value="'+n.cat_id+'">'+n.cat_name+'</option>';
			          });

			          catinfo[cat_ida] = s; //缓存请求过的分类信息
			        }
			      });
			    }
			    $('#cat_id'+mark+' option:not(:first)').remove(); //删除旧的
			    $('#cat_id'+mark).append(catinfo[cat_ida]); //追加新的
			  }

</script> 
	</head>
	<body>
		<div class="page-container">
			<!--选项卡-->
			<div id="tab_demo" class="HuiTab mt-20">
				<div class="tabBar clearfix mb-20">
					<span>基本信息</span>
					<span>简介</span>
					<span>应用</span>
					<span>视频</span>
				</div>
				<div class="tabCon">
					<article class="page-container pl-20 pr-20">
					      <form class="form form-horizontal" id="form-article-add" method="post" action="/index.php/Admin/Goods/editGoods" enctype="multipart/form-data" onsubmit="return false">
							<div class="row cl">
								<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>产品名称：</label>
								<div class="formControls col-xs-8 col-sm-9">
									<input type="text" class="input-text" value="<?php echo ($goodsinfo['goods_name']); ?>" placeholder=""  name="goods_Name">
									<input type="hidden" class="input-text" value="<?php echo ($goodsinfo['goods_id']); ?>" id="goods_id" placeholder=""  name="goods_Id">
								</div>
							</div>
							<div class="row cl">
								<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>产品分类：</label>
								<div class="formControls col-xs-8 col-sm-9">
									<div class="col-xs-6 col-sm-6">
									<span class="select-box">
										<select  id="cat_idA" onchange="show_catinfo(this,'B')"class="select">
										    <option value='0'>-请选择-</option>
											<?php if(is_array($categorys)): foreach($categorys as $key=>$c): ?><option value='<?php echo ($c["cat_id"]); ?>' <?php if($c["cat_id"] == $category['cat_pid']): ?>selected="selected"<?php endif; ?>><?php echo ($c["cat_name"]); ?></option><?php endforeach; endif; ?>
										</select>
										</span>
									</div>
									<div class="col-xs-6 col-sm-6">
                                        <span class="select-box">
										<select name="cat_id" id="cat_idB" class="select">
											<option value='<?php echo ($category['cat_id']); ?>'><?php echo ($category['cat_name']); ?></option>
										</select>
									</div>
								</div>
							</div>
							<div class="row cl">
								<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>产品容积：</label>
								<div class="formControls col-xs-8 col-sm-9"> 
									<input type="text" class="input-text" value="<?php echo ($goodsinfo['goods_rongji']); ?>" placeholder=""  name="rongji">
								</div>
							</div>
							<div class="row cl">
								<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>产品颜色：</label>
								<div class="formControls col-xs-8 col-sm-9">
									<input type="text" class="input-text" value="<?php echo ($goodsinfo['goods_color']); ?>" placeholder="" name="yanse">
								</div>
							</div>
							<div class="row cl">
								<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>产品特点：</label>
								<div class="formControls col-xs-8 col-sm-9">
									<input type="text" class="input-text" value="<?php echo ($goodsinfo['goods_tedian']); ?>" placeholder=""  name="tedian">
								</div>
							</div>
							<div class="row cl">
								<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>首页展示：</label>
								<div class="formControls col-xs-8 col-sm-9">
									是<input type="radio" value="1"<?php if($goodsinfo['status'] == 1): ?>checked="checked"<?php endif; ?>  name="status">
									否<input type="radio" value="0"<?php if($goodsinfo['status'] == 0): ?>checked="checked"<?php endif; ?> name="status">
								</div>
							</div>
							<div class="row cl mt-20 mb-20">
									<label class="form-label col-xs-4 col-sm-2">产品logo图：</label>
									<div class="formControls col-xs-8 col-sm-9">
					                    <input type="file" class="input-text" placeholder="" name="logo_pic">
					                    <img src="<?php echo (substr($goodsinfo['goods_logo'],1)) ?>" width="50" height="50"/>
					                    <input type="hidden" class="input-text" placeholder="" name="yuan_logo_pic" value="<?php echo $goodsinfo['goods_logo'] ?>">
					                </div>
							</div>
							<div class="row cl mt-20 mb-20">
									<label class="form-label col-xs-4 col-sm-2">产品展示图：</label>
									<div class="formControls col-xs-8 col-sm-9">
					                    <input type="file" class="input-text"  placeholder="" name="zhanshi_pic">
					                    <img src="<?php echo (substr($goodsinfo['goods_zhanshi'],1)) ?>" width="50" height="50"/>
					                    <input type="hidden" class="input-text" placeholder="" name="yuan_zhanshi_pic" value="<?php echo $goodsinfo['goods_zhanshi'] ?>">
					                </div>
							</div>
					<div class="row cl mt-20">
						<div class="formControls col-xs-8 col-sm-9"align="center">
							<input class="btn btn-primary radius" type="submit"  value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
						</div>
				    </div>
			 </form>
					</article>
				</div>
				<script type="text/javascript">
				// 添加简介
                        function add_jianjie(){
                          $('#jianjie').append('<article class="pl-20 pr-20 xiangqing1"><form class="form form-horizontal" id="form1" method="post" enctype="multipart/form-data" onsubmit="return false"> <div class="item-demo form-horizontal"> <div class="pb-20"> <div class="row cl"> <label class="form-label col-xs-4 col-sm-2"><span class="STYLE19" onclick="$(this).parent().parent().parent().parent().parent().remove()">[-]&nbsp;</span><span class="c-red">*</span>标题：</label> <div class="formControls col-xs-8 col-sm-9"> <input type="text" class="input-text" value="" placeholder=""  name="jianjie_title"> </div> </div> <div class="row cl mt-20 mb-20"> <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>图片：</label> <div class="formControls col-xs-8 col-sm-9"> <input type="file" class="input-text" value="20" placeholder="" id="articlesort" name="jianjie_pic"> </div> </div> <div class="row cl"> <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>简介：</label> <div class="formControls col-xs-8 col-sm-9"> <input type="text" class="input-text" value="" placeholder=""name="jianjie_content"> </div> </div> <div class="row cl"> <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>链接地址：</label> <div class="formControls col-xs-8 col-sm-9"> <input type="text" class="input-text" value="" placeholder=""name="jianjie_url"> </div> </div></div> </div> <div class="row cl mt-20"> <div class="formControls col-xs-8 col-sm-9"align="center"> <input class="btn btn-primary radius" onclick="add_jianjie1()"type="button"value="&nbsp;&nbsp;提交&nbsp;&nbsp;"> </div> </div> </form></article>');
                        }
                        function add_jianjie1(){
                        	var goods_id = $("#goods_id").val();
                        	var index = layer.load(0, {shade: false});
                           /*简介-删除*/
                            $("#form1").ajaxSubmit({
				                 url:"/index.php/Admin/Goods/edit_jianjie/id/jianjie_add/goods_id/"+goods_id,
				                 data:$("#form1").serialize(),
				                 type:"post",
				                 dataType: "json",
				                 success:function(data){
				                 	if(data.code == 1){
										layer.msg(data.msg,{icon:1,time:1000},function(){
												window.location.href=window.location.href;
										});
									   }else if(data.code == 0){
									   	layer.close(index); 
										layer.msg(data.msg,{icon:2,time:1000});
								    }
				                 }
				            });     
                        }
			            function jianjie_del(obj, pics_id) {
			                layer.confirm('确认要删除吗？', function(index) {
			                       $.ajax({
			                            url:"/index.php/Admin/Goods/del_Pic",
			                            data:{'pics_id':pics_id},
			                            success:function(msg){
			                              //dom方式删除li的元素节点对象
			                              $('.pics_'+pics_id).remove();
			                              layer.msg('已删除!', {
			                                icon: 1,
			                                time: 1000
			                            });
			                            }
			                          });
			                });
			            }
			         //编辑简介信息
			         function edit_jianjie(id){
			         	var index = layer.load(0, {shade: false});
		                 $("#form_jianije_"+id).ajaxSubmit({
				                 url:"/index.php/Admin/Goods/edit_jianjie",
				                 data:$("#form_jianije_"+id).serialize(),
				                 type:"post",
				                 dataType: "json",
				                 success:function(data){
				                 	if(data.code == 1){
										layer.msg(data.msg,{icon:1,time:1000},function(){
												window.location.href=window.location.href;
										});
									   }else if(data.code == 0){
									   	layer.close(index); 
										layer.msg(data.msg,{icon:2,time:1000});
								    }
				                 }
				            });
			         }
                </script>
				<div class="tabCon" id="jianjie">
				<?php if(empty($jianjie)): ?><span class="STYLE19" onclick="add_jianjie()">[+]&nbsp;</span><?php endif; ?>
				   <?php if(is_array($jianjie)): foreach($jianjie as $key=>$v): ?><article class="pl-20 pr-20 xiangqing1 pics_<?php echo ($v["id"]); ?>">
					   <form class="form form-horizontal jianjie" method="post" action="/index.php/Admin/Goods/editGoods" enctype="multipart/form-data" onsubmit="return false" id="form_jianije_<?php echo ($v["id"]); ?>">
						<div class="item-demo form-horizontal">
							<div class="pb-20">
								<div class="row cl">
									<label class="form-label col-xs-4 col-sm-2"><span class="STYLE19" onclick="add_jianjie()">[+]&nbsp;</span><span class="STYLE19" onclick="jianjie_del(this,'<?php echo $v['id'] ?>')">[-]&nbsp;</span><span class="c-red">*</span>标题：</label>
									<div class="formControls col-xs-8 col-sm-9">
										<input type="text" class="input-text" value="<?php echo ($v['goods_jianjie_title']); ?>" placeholder=""  name="jianjie_title">
										<input type="hidden" name="id" value="<?php echo ($v['id']); ?>" id="jianjie_id"></input>
										<input type="hidden" name="goods_Id" value="<?php echo ($v['goods_id']); ?>"></input>
									</div>
								</div>
								<div class="row cl mt-20 mb-20">
									<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>图片：</label>
									<div class="formControls col-xs-8 col-sm-9">
					                    <input type="file" class="input-text" value="20" placeholder="" id="articlesort" name="jianjie_pic">
					                    <input type="hidden" class="input-text" placeholder="" name="yuan_jianjie_pic" value="<?php echo $v['goods_jianjie_pic'] ?>">
					                    <img src="<?php echo (substr($v['goods_jianjie_pic'],1)) ?>" width="50" height="50"/>
					                </div>
								</div>
								<div class="row cl">
									<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>简介：</label>
									<div class="formControls col-xs-8 col-sm-9">
										<input type="text" class="input-text" value="<?php echo ($v['goods_jianjie_content']); ?>" placeholder=""name="jianjie_content">
									</div>
								</div>
								<div class="row cl">
									<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>链接地址：</label>
									<div class="formControls col-xs-8 col-sm-9">
										<input type="text" class="input-text" value="<?php echo ($v['goods_jianjie_url']); ?>" placeholder=""name="jianjie_url">
									</div>
								</div>
							</div>
						</div>
					<div class="row cl mt-20">
						<div class="formControls col-xs-8 col-sm-9"align="center">
							<input class="btn btn-primary radius" type="button" onclick="edit_jianjie('<?php echo $v['id'] ?>')" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
						</div>
				    </div>
			 </form>
					</article><?php endforeach; endif; ?>
				</div>
				<script type="text/javascript">
                        function add_yingyong(){
                          $('#yingyong').append('<article class="pl-20 pr-20 xiangqing2"> <form class="form form-horizontal" id="form_yingyong" method="post" enctype="multipart/form-data" onsubmit="return false"><div class="item-demo form-horizontal"> <div class="pb-20"> <div class="row cl"> <label class="form-label col-xs-4 col-sm-2"><span class="STYLE19" onclick="$(this).parent().parent().parent().parent().parent().remove()">[-]&nbsp;</span><span class="c-red">*</span>标题：</label> <div class="formControls col-xs-8 col-sm-9"> <input type="text" class="input-text" value="" placeholder=""  name="yingyong_title"> </div> </div> <div class="row cl mt-20 mb-20"> <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>图片：</label> <div class="formControls col-xs-8 col-sm-9"> <input type="file" class="input-text" value="20" placeholder="" name="yingyong_pic"> </div> </div> <div class="row cl"> <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>简介：</label> <div class="formControls col-xs-8 col-sm-9"> <input type="text" class="input-text" value="" placeholder=""  name="yingyong_content"> </div> </div><div class="row cl"> <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>链接地址：</label> <div class="formControls col-xs-8 col-sm-9"> <input type="text" class="input-text" value="" placeholder=""name="yingyong_url"> </div> </div> </div> </div> <div class="row cl mt-20"> <div class="formControls col-xs-8 col-sm-9"align="center"> <input class="btn btn-primary radius" onclick="add_yingyong1()"type="button"value="&nbsp;&nbsp;提交&nbsp;&nbsp;"> </div> </div> </form></article>');
                        }
                        //应用添加的提交
                        function add_yingyong1(){
                        	var goods_id = $("#goods_id").val();
                        	var index = layer.load(0, {shade: false});
                           /*简介-删除*/
                            $("#form_yingyong").ajaxSubmit({
				                 url:"/index.php/Admin/Goods/edit_yingyong/id/yingyong_add/goods_id/"+goods_id,
				                 data:$("#form_yingyong").serialize(),
				                 type:"post",
				                 dataType: "json",
				                 success:function(data){
				                 	if(data.code == 1){
										layer.msg(data.msg,{icon:1,time:1000},function(){
												window.location.href=window.location.href;
										});
									   }else if(data.code == 0){
									   	layer.close(index); 
										layer.msg(data.msg,{icon:2,time:1000});
								    }
				                 }
				            });     
                        }
                        //编辑应用信息
                         //编辑简介信息
			         function edit_yingyong(id){
			         	var index = layer.load(0, {shade: false});
		                 $("#form_yingyong_"+id).ajaxSubmit({
				                 url:"/index.php/Admin/Goods/edit_yingyong",
				                 data:$("#form_yingyong_"+id).serialize(),
				                 type:"post",
				                 dataType: "json",
				                 success:function(data){
				                 	if(data.code == 1){
										layer.msg(data.msg,{icon:1,time:1000},function(){
												window.location.href=window.location.href;
										});
									   }else if(data.code == 0){
									   	layer.close(index); 
										layer.msg(data.msg,{icon:2,time:1000});
								    }
				                 }
				            });
			         }
			         //删除应用
			             function yingyong_del(obj, pics_id) {
			                layer.confirm('确认要删除吗？', function(index) {
			                       $.ajax({
			                            url:"/index.php/Admin/Goods/del_Yingyong",
			                            data:{'pics_id':pics_id},
			                            success:function(msg){
			                              //dom方式删除li的元素节点对象
			                              $('.pics_'+pics_id).remove();
			                              layer.msg('已删除!', {
			                                icon: 1,
			                                time: 1000
			                            });
			                            }
			                          });
			                });
			            }
                </script>
				<div class="tabCon" id="yingyong">
				<?php if(empty($yingyong)): ?><span class="STYLE19" onclick="add_yingyong()">[+]&nbsp;</span><?php endif; ?>
				  <?php if(is_array($yingyong)): foreach($yingyong as $key=>$v): ?><article class="pl-20 pr-20 xiangqing2 pics_<?php echo ($v["id"]); ?>">
					  <form class="form form-horizontal yingyong" method="post" action="/index.php/Admin/Goods/edityingyong" enctype="multipart/form-data" onsubmit="return false" id="form_yingyong_<?php echo ($v["id"]); ?>">
						<div class="item-demo form-horizontal">
							<div class="pb-20">
								<div class="row cl">
									<label class="form-label col-xs-4 col-sm-2"><span class="STYLE19" onclick="add_yingyong()">[+]&nbsp;</span><span class="STYLE19" onclick="yingyong_del(this,'<?php echo $v['id'] ?>')">[-]&nbsp;</span><span class="c-red">*</span>标题：</label>
									<div class="formControls col-xs-8 col-sm-9">
										<input type="text" class="input-text" value="<?php echo ($v['goods_yingyong_title']); ?>" placeholder=""  name="yingyong_title">
										<input type="hidden" name="id" value="<?php echo ($v['id']); ?>" id="yingyong_id"></input>
										<input type="hidden" name="goods_Id" value="<?php echo ($v['goods_id']); ?>"></input>
									</div>
								</div>
								<div class="row cl mt-20 mb-20">
									<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>图片：</label>
									<div class="formControls col-xs-8 col-sm-9">
					                    <input type="file" class="input-text" value="20" placeholder="" name="yingyong_pic">
					                    <img src="<?php echo (substr($v['goods_yingyong_pic'],1)) ?>" width="50" height="50"/>
					                    <input type="hidden" class="input-text" placeholder="" name="yuan_yingyong_pic" value="<?php echo $v['goods_yingyong_pic'] ?>">

					                </div>
								</div>
								<div class="row cl">
									<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>简介：</label>
									<div class="formControls col-xs-8 col-sm-9">
										<input type="text" class="input-text" value="<?php echo ($v['goods_yingyong_content']); ?>" placeholder=""  name="yingyong_content">
									</div>
								</div>
								<div class="row cl">
									<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>链接地址：</label>
									<div class="formControls col-xs-8 col-sm-9">
										<input type="text" class="input-text" value="<?php echo ($v['goods_yingyong_url']); ?>" placeholder=""name="yingyong_url">
									</div>
								</div>
							</div>
						</div>
					<div class="row cl mt-20">
						<div class="formControls col-xs-8 col-sm-9"align="center">
							<input class="btn btn-primary radius" type="button" onclick="edit_yingyong('<?php echo $v['id'] ?>')" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
						</div>
				    </div>
			 </form>
					</article><?php endforeach; endif; ?>
				</div>
					<script type="text/javascript">
                        function add_shipin(){
                          $('#shipin').append('<article class="pl-20 pr-20 xiangqing3"> <form class="form form-horizontal" id="form_shipin" method="post" enctype="multipart/form-data" onsubmit="return false"><div class="item-demo form-horizontal"> <div class="pb-20"> <div class="row cl"> <label class="form-label col-xs-4 col-sm-2"><span class="STYLE19" onclick="$(this).parent().parent().parent().parent().parent().remove()">[-]&nbsp;</span><span class="c-red">*</span>标题：</label> <div class="formControls col-xs-8 col-sm-9"> <input type="text" class="input-text" value="" placeholder=""  name="shipin_title"> </div> </div> <div class="row cl mt-20 mb-20"> <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>图片：</label> <div class="formControls col-xs-8 col-sm-9"> <input type="file" class="input-text" value="20" placeholder="" name="shipin_pic"> </div> </div> <div class="row cl"> <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>简介：</label> <div class="formControls col-xs-8 col-sm-9"> <input type="text" class="input-text" value="" placeholder=""  name="shipin_content"> </div> </div> <div class="row cl"> <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>链接地址：</label> <div class="formControls col-xs-8 col-sm-9"> <input type="text" class="input-text" value="" placeholder=""name="shipin_url"> </div> </div> </div> </div><div class="row cl mt-20"> <div class="formControls col-xs-8 col-sm-9"align="center"> <input class="btn btn-primary radius" onclick="add_shipin1()"type="button"value="&nbsp;&nbsp;提交&nbsp;&nbsp;"> </div> </div> </form> </article>');
                        }
                  function add_shipin1(){
                        	var goods_id = $("#goods_id").val();
                        	var index = layer.load(0, {shade: false});
                           /*简介-删除*/
                            $("#form_shipin").ajaxSubmit({
				                 url:"/index.php/Admin/Goods/edit_shipin/id/shipin_add/goods_id/"+goods_id,
				                 data:$("#form_shipin").serialize(),
				                 type:"post",
				                 dataType: "json",
				                 success:function(data){
				                 	if(data.code == 1){
										layer.msg(data.msg,{icon:1,time:1000},function(){
												window.location.href=window.location.href;
										});
									   }else if(data.code == 0){
									   	layer.close(index); 
										layer.msg(data.msg,{icon:2,time:1000});
								    }
				                 }
				            });     
                        }
			            function shipin_del(obj, pics_id) {
			                layer.confirm('确认要删除吗？', function(index) {
			                       $.ajax({
			                            url:"/index.php/Admin/Goods/del_Shipin",
			                            data:{'pics_id':pics_id},
			                            success:function(msg){
			                              //dom方式删除li的元素节点对象
			                              $('.pics_'+pics_id).remove();
			                              layer.msg('已删除!', {
			                                icon: 1,
			                                time: 1000
			                            });
			                            }
			                          });
			                });
			            }
			         //编辑简介信息
			         function edit_shipin(id){
			         	var index = layer.load(0, {shade: false});
		                 $("#form_shipin_"+id).ajaxSubmit({
				                 url:"/index.php/Admin/Goods/edit_shipin",
				                 data:$("#form_shipin_"+id).serialize(),
				                 type:"post",
				                 dataType: "json",
				                 success:function(data){
				                 	if(data.code == 1){
										layer.msg(data.msg,{icon:1,time:1000},function(){
												window.location.href=window.location.href;
										});
									   }else if(data.code == 0){
									   	layer.close(index); 
										layer.msg(data.msg,{icon:2,time:1000});
								    }
				                 }
				            });
			         }
                </script>
				<div class="tabCon" id="shipin">
				  <!-- 如果为视频为空的情况下 -->
				 <?php if(empty($shipin)): ?><span class="STYLE19" onclick="add_shipin()">[+]&nbsp;</span><?php endif; ?>
				 <?php if(is_array($shipin)): foreach($shipin as $key=>$v): ?><article class="pl-20 pr-20 xiangqing3 pics_<?php echo ($v["id"]); ?>">
					 <form class="form form-horizontal shipin" method="post" action="/index.php/Admin/Goods/editGoods" enctype="multipart/form-data" onsubmit="return false" id="form_shipin_<?php echo ($v["id"]); ?>">
						<div class="item-demo form-horizontal">
							<div class="pb-20">
								<div class="row cl">
									<label class="form-label col-xs-4 col-sm-2"><span class="STYLE19" onclick="add_shipin()">[+]&nbsp;</span><span class="STYLE19" onclick="shipin_del(this,'<?php echo $v['id'] ?>')">[-]&nbsp;</span><span class="c-red">*</span>标题：</label>
									<div class="formControls col-xs-8 col-sm-9">
										<input type="text" class="input-text" value="<?php echo ($v['goods_shipin_title']); ?>" placeholder=""  name="shipin_title">
										<input type="hidden" name="id" value="<?php echo ($v['id']); ?>" id="jianjie_id"></input>
										<input type="hidden" name="goods_Id" value="<?php echo ($v['goods_id']); ?>"></input>
									</div>
								</div>
								<div class="row cl mt-20 mb-20">
									<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>图片：</label>
									<div class="formControls col-xs-8 col-sm-9">
					                    <input type="file" class="input-text" value="20" placeholder="" name="shipin_pic">
					                    <img src="<?php echo (substr($v['goods_shipin_pic'],1)) ?>" width="50" height="50"/>
					                     <input type="hidden" class="input-text" placeholder="" name="yuan_shipin_pic" value="<?php echo $v['goods_shipin_pic'] ?>">
					                </div>
								</div>
								<div class="row cl">
									<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>简介：</label>
									<div class="formControls col-xs-8 col-sm-9">
										<input type="text" class="input-text" value="<?php echo ($v['goods_shipin_content']); ?>" placeholder=""  name="shipin_content">
									</div>
								</div>
								<div class="row cl">
									<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>链接地址：</label>
									<div class="formControls col-xs-8 col-sm-9">
										<input type="text" class="input-text" value="<?php echo ($v['goods_shipin_url']); ?>" placeholder=""name="shipin_url">
									</div>
								</div>
							</div>
						</div>
							<div class="row cl mt-20">
						<div class="formControls col-xs-8 col-sm-9"align="center">
							<input class="btn btn-primary radius" type="button" onclick="edit_shipin('<?php echo $v['id'] ?>')" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
						</div>
				    </div>
			 </form>
					</article><?php endforeach; endif; ?>
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
			<script type="text/javascript" src="/Public/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
			<script type="text/javascript" src="/Public/lib/jquery.validation/1.14.0/validate-methods.js"></script>
			<script type="text/javascript" src="/Public/lib/jquery.validation/1.14.0/messages_zh.js"></script>
			<script type="text/javascript" src="/Public/lib/webuploader/0.1.5/webuploader.min.js"></script>
			<script type="text/javascript">
				$(function() {
					$.Huitab("#tab_demo .tabBar span", "#tab_demo .tabCon", "current", "click", "0");
					//产品基本信息
		            $("#form-article-add").validate({
					onkeyup:false,
					focusCleanup:true,
					success:"valid",
					submitHandler:function(form){
					var index = layer.load(0, {shade: false});
						$(form).ajaxSubmit({
							type: 'post',
							url: "/index.php/Admin/Goods/editGoods",
							data:$("form").serialize(),
							dataType: "json",
							success: function(data){
								if(data.code == 1){
									layer.msg(data.msg,{icon:1,time:1000},function(){
											window.location.href = window.location.href;
									});
								}else if(data.code == 0){
									layer.close(index); 
									layer.msg(data.msg,{icon:2,time:1000});
								}
							}
						});	
						return false;
					}
				});
                  //产品简介(修改)
                    $(".jianjie").validate({
					onkeyup:false,
					focusCleanup:true,
					success:"valid",
					submitHandler:function(form){
						$(form).ajaxSubmit({
							type: 'post',
							url: "/index.php/Admin/Goods/edit_jianjie",
							data:$("form").serialize(),
							dataType: "json",
							success: function(data){
								if(data.code == 1){
									layer.msg(data.msg,{icon:1,time:1000},function(){
											window.location.href= window.location.href;
									});
								}else if(data.code == 0){
									layer.msg(data.msg,{icon:2,time:1000});
								}
							}
						});	
						return false;
					}
				});

                    
				});
			</script>
	</body>

</html>