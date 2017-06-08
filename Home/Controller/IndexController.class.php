<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	//产品主页
    public function index(){
        //如果存在session信息
        if(session('openid')){
            $Logos = M('banner')->select();
            $xinpins = M('xinpin')->select();
            $categorys = M('category')->where(array('cat_level' => 0))->select();
            $goods = M('goods')->join('sp_category on sp_goods.cat_id=sp_category.cat_id')->where(array('status' => '1'))->select();
            foreach ($goods as $key => $value) {
                $tp = strpos($value['cat_path'],"-");
                $goods[$key]['cat_path'] = substr($value['cat_path'],0,$tp); 
            }
            $this->assign('goods',$goods);
            $this->assign('categorys', $categorys);
            $this->assign('xinpins', $xinpins);
            $this->assign('logos', $Logos);
            $this->display();exit;
        }else{
            $model = new \Home\Model\WechatModel();
            $openid_accesstoken = $model->openId();
            //去数据库查询该用户是否存在
            $rst = M('user')->where(array('user_openid' => $openid_accesstoken['openid']))->find();
            if($rst){
                session('openid',$openid_accesstoken['openid']);
                session('user_id', $rst['user_id']);
                $Logos = M('banner')->select();
                $xinpins = M('xinpin')->select();
                $categorys = M('category')->where(array('cat_level' => 0))->select();
                $goods = M('goods')->join('sp_category on sp_goods.cat_id=sp_category.cat_id')->where(array('status' => '1'))->select();
                foreach ($goods as $key => $value) {
                    $tp = strpos($value['cat_path'],"-");
                    $goods[$key]['cat_path'] = substr($value['cat_path'],0,$tp); 
                }
                $this->assign('goods',$goods);
                $this->assign('categorys', $categorys);
                $this->assign('xinpins', $xinpins);
                $this->assign('logos', $Logos);
                $this->display();exit;
            }else{
                //获取用户信息（要注意对用户昵称进行过滤处理）
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
                $Logos = M('banner')->select();
                $xinpins = M('xinpin')->select();
                $categorys = M('category')->where(array('cat_level' => 0))->select();
                $goods = M('goods')->join('sp_category on sp_goods.cat_id=sp_category.cat_id')->where(array('status' => '1'))->select();
                foreach ($goods as $key => $value) {
                    $tp = strpos($value['cat_path'],"-");
                    $goods[$key]['cat_path'] = substr($value['cat_path'],0,$tp); 
                }
                $this->assign('goods',$goods);
                $this->assign('categorys', $categorys);
                $this->assign('xinpins', $xinpins);
                $this->assign('logos', $Logos);
                $this->display();exit;
            }
        }
    }
    //产品详情
    public function goods_detail(){
        $goods_id = $_GET['goods_id'];
        //产品详情展示
        $goods = M('goods')->where(array('goods_id' => $goods_id))->find();
        //产品简介
        $jianjie = M('goods_jianjie')->where(array('goods_id' => $goods_id))->select();
        $shipin = M('goods_shipin')->where(array('goods_id' => $goods_id))->select();
        $yingyong = M('goods_yingyong')->where(array('goods_id' => $goods_id))->select();
        $goods_pic = M('goods_pic')->where(array('goods_id' => $goods_id))->select();
        $rst = M('goods_shoucang')->where(array('goods_id' =>$goods_id,'user_id' => session('user_id')))->find();
        $this->assign('rst', $rst);
        $this->assign('jianjie', $jianjie);
        $this->assign('shipin', $shipin);
        $this->assign('yingyong', $yingyong);
        $this->assign('goods_pic', $goods_pic);
        $this->assign('goods', $goods);
    	$this->display();
    }
    //产品列表
    public function goods_list(){
        $cat_id = $_GET['cat_id'];
        $xilie = M('category')->where(array('cat_pid' => $cat_id))->select();
        $goods = M('goods')->join('sp_category on sp_goods.cat_id = sp_category.cat_id')->where(array('cat_pid' => $cat_id))->select();
        $this->assign('goods', $goods);
        $this->assign('xilie', $xilie);
    	$this->display();
    }
    //产品收藏
    public function goods_ShouCang(){
        $post = I('post.');
        $rst = M('goods_shoucang')->add($post);
        M('goods')->where(array('goods_id' => $post['goods_id']))->setInc('goods_shoucang',1);
        if($rst){
            echo json_encode(array('code' =>1,'msg' => '产品收藏成功' ));exit;
        }
    }
     // 取消产品收藏
    public function goods_QShouCang(){
         $post = I('post.');
         $rst = M('goods_shoucang')->where($post)->delete();
         M('goods')->where(array('goods_id' => $post['goods_id']))->setDec('goods_shoucang',1);
         if($rst !== false){
            echo json_encode(array('code' =>1,'msg' => '取消产品收藏' ));exit;
         }
    }
    //搜索商品
    public function Search(){
        $post = I('post.');
        $where = '2>1';
        $where .= " AND `goods_name` like '%{$post['goods_name']}%'";
        $goods = M('goods')->where($where)->select();
        $this->assign('goods', $goods);
        $this->display();
    }
}