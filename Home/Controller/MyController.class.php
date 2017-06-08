<?php
namespace Home\Controller;
use Think\Controller;
class MyController extends Controller {
	//个人中心首页显示
    public function index(){
    	$user_id = session('user_id');
      if($user_id){
        $jssdk = new \Home\Model\WechatModel();
        $signPackage = $jssdk->GetSignPackage();
        $huiyuanPackage = $jssdk->getHuiYuanSignPackage();
        //获取用户信息    
        $user = M('user')->where(array('user_id' => $user_id))->find();
        //产品收藏数量统计
      	$goods_count = M('goods_shoucang')->where(array('user_id' => $user_id))->count();
        //门店收藏数量统计
      	$shop_count = M('shop_shoucang')->where(array('user_id' => $user_id))->count();
      }else{
        //判断该用户是否存在
       $model = new \Home\Model\WechatModel();
       $openid_accesstoken = $model->openId();
       $rst = M('user')->where(array('user_openid' => $openid_accesstoken['openid']))->find();
       if($rst){
          session('openid',$openid_accesstoken['openid']);
          session('user_id', $rst['user_id']);
          $jssdk = new \Home\Model\WechatModel();
          $signPackage = $jssdk->GetSignPackage();
          $huiyuanPackage = $jssdk->getHuiYuanSignPackage();
           //获取用户信息    
          $user = M('user')->where(array('user_id' => $rst['user_id']))->find();
          //产品收藏数量统计
          $goods_count = M('goods_shoucang')->where(array('user_id' => $rst['user_id']))->count();
          //门店收藏数量统计
          $shop_count = M('shop_shoucang')->where(array('user_id' => $rst['user_id']))->count();
       }else{
           $userInfo = $model->getOpenId($openid_accesstoken['openid'],$openid_accesstoken['access_token']);
                    $data = array(
                      'user_img' => $userInfo['headimgurl'],
                      'user_openid' => $userInfo['openid'],
                      'user_name' => filter($userInfo['nickname']),
                      'user_register_time' => time(),
                      'city' => $userInfo['province'].'-'.$userInfo['city'],
                    );
          $id = M('user')->add($data);
          session('openid', $userInfo['openid']);
          session('user_id',$id);
          $jssdk = new \Home\Model\WechatModel();
          $signPackage = $jssdk->GetSignPackage();
          $huiyuanPackage = $jssdk->getHuiYuanSignPackage();
           //获取用户信息    
          $user = M('user')->where(array('user_id' => $id))->find();
          //产品收藏数量统计
          $goods_count = M('goods_shoucang')->where(array('user_id' => $id))->count();
          //门店收藏数量统计
          $shop_count = M('shop_shoucang')->where(array('user_id' => $id))->count();
          }
      }
        $this->assign('signPackage', $signPackage);
        $this->assign('huiyuanPackage', $huiyuanPackage);
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
    //修改领取状态
    public function editHuiYuan(){
      $lingqu = I('post.');
      M('user')->where(array('user_id' => $lingqu['user_id']))->save(array('is_lingqu' => $lingqu['is_LingQu']));
    }
}