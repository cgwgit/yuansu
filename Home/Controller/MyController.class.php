<?php
namespace Home\Controller;
use Think\Controller;
class MyController extends Controller {
	//个人中心首页显示
    public function index(){
    	$user_id = session('user_id');
      $user = M('user')->where(array('user_id' => $user_id))->find();
    	$goods_count = M('goods_shoucang')->where(array('user_id' => $user_id))->count();
    	$shop_count = M('shop_shoucang')->where(array('user_id' => $user_id))->count();
      $this->assign('user', $user);
    	$this->assign('shop_count', $shop_count);
    	$this->assign('goods_count', $goods_count);
    	$this->display();
    }
    //展示收藏的产品
    public function goodsShouCang(){
      $user_id = session('user_id');
      $goods = M('goods')->join('sp_goods_shoucang on sp_goods_shoucang.goods_id=sp_goods.goods_id')->where(array('sp_goods_shoucang.user_id' => $user_id))->select();
      $this->assign('goods',$goods);
      $this->display();
    }
    //门店收藏
    public function shopShouCang(){
       $user_id = session('user_id');
       $shops = M('shop')->join('sp_shop_shoucang on sp_shop_shoucang.shop_id=sp_shop.shop_id')->where(array('sp_shop_shoucang.user_id' => $user_id))->select();
       $this->assign('shops', $shops);
      $this->display();
    }
    //编辑用户信息
    public function editUser(){
      if (IS_POST) {
        $post = I('post.');
        $rst = M('user')->save($post);
        if($rst !== false){
          $this->redirect('My/index');
        }
      }
      $user = M('user')->where(array('user_id' => session('user_id')))->find();
      $this->assign('user', $user);
      $this->display();
    }
}