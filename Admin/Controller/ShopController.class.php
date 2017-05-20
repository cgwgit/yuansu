<?php
namespace Admin\Controller;
use Think\Controller;
class ShopController extends Controller {
		  public function _initialize() {
        if ($_SESSION['manager_name'] == NULL) {
            $this->success('请先登陆', U('Admin/Manager/login'));
            exit();
        }
     } 

          	//显示门店列表
	public function shopList(){
		if($aid = I('get.aid')){
           $goods = M('shop')->find($aid);
           $this->assign('shopinfo', $shop);
           $this->display('showOne');exit;
		}
		$model = M('shop');
		$count = $model->count();
        $Page = new \Think\Page($count,10);
        $Page -> setConfig('prev','上一页');
		$Page -> setConfig('next','下一页');
		$Page -> setConfig('first','首页');
		$Page -> setConfig('last','末页');
		$Page -> lastSuffix = false;	//将末页从数字的显示方式切换成汉字提示
        $show = $Page->show();
        $list = $model->order('shop_id')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('shop', $list);
		$this->assign('page', $show);
		$this->display();
	}
		//添加门店
	public function addShop(){
		$aid = I('get.id');
		if(IS_AJAX){
			$post = I('post.');
			!empty($post['articletitle']) ? $articletitle = trim($post['articletitle']) : $err = '请填写门店标题';
			!empty($post['abstract']) ? $abstract = trim($post['abstract']) : $err = '请填写门店内容';
            !empty($post['articlesort']) ? $articlesort = trim($post['articlesort']) : $err = '请选择最大参与人数';
            if($err){
            	echo json_encode(array('code' => 0,'msg' => $err));exit;
            }
            !empty($post['startTime']) ? $stime = strtotime($post['startTime']) : $stime = time();
            !empty($post['endTime']) ? $etime = strtotime($post['endTime']) : $etime = time();
			$data = array(
                    'title' => $articletitle,
                    'content' => $abstract,
                    'money' => $post['articletype'],
                    'stime' => $stime,
                    'etime' => $etime,
                    'dizhi' => rand(10,10000),
                    'maxperson' => $articlesort,
                    'code' => $post['articlecolumn']
				);
			  
			  $id = M('action')->add($data);
			  if($id){
			  	$rst = $this->logo_deal($id);
			  	if($rst){
			  		echo json_encode(array('code' => 1,'msg' => '门店添加成功','id'=>$aid));exit;
			  	}
			  }else{
			  	echo json_encode(array('code' => 0,'msg' => '添加失败','id' => $aid));exit;
			  }
		}else{
			$this->assign('id',$aid);
			$this->display();
		}
		
	}
	//编辑门店
	public function editShop(){
		$aid = I('get.aid');
		if(IS_POST){
			$post = I('post.');
			!empty($post['articletitle']) ? $articletitle = trim($post['articletitle']) : $err = '请填写活动标题';
			!empty($post['abstract']) ? $abstract = trim($post['abstract']) : $err = '请填写活动内容';
            !empty($post['articlesort']) ? $articlesort = trim($post['articlesort']) : $err = '请选择最大参与人数';
            if($err){
            	echo json_encode(array('code' => 0,'msg' => $err));exit;
            }
            !empty($post['startTime']) ? $stime = strtotime($post['startTime']) : $stime = time();
            !empty($post['endTime']) ? $etime = strtotime($post['endTime']) : $etime = time();
			$data = array(
				    'id' => $aid,
                    'title' => $post['articletitle'],
                    'content' => $post['abstract'],
                    'money' => $post['articletype'],
                    'stime' => $stime,
                    'etime' => $etime,
                    'maxperson' => $post['articlesort'],
                    'code' => $post['articlecolumn'],
				);
			$rst = M('action')->save($data);
			$rst1 = $this->logo_deal($aid,$post);
			if($rst && $rst1){
				echo json_encode(array('code' => 1,'msg' => '活动编辑成功'));exit;
			}else{
				echo json_encode(array('code' => 1,'msg' => '活动编辑成功'));exit;
			}
		}else{
			$actioninfo = M('action')->where(array('id' => $aid))->find();
			$this->assign('actioninfo', $actioninfo);
			$this->display();
		}
		
	} 
 }