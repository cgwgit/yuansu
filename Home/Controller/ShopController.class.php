<?php
namespace Home\Controller;
use Think\Controller;
class ShopController extends Controller {
    public function shopList(){
    	if(IS_AJAX){
	    	$post = I('post.');
	    	//纬度信息
	    	// session('latitude', $post['latitude']);
	    	// session('longitude', $post['longitude']);
	    	// 其中30.664385188806是纬度,104.07559730274是经度
	    	// 5公里范围是5000
	    	$longitude = $post['longitude'];//经度信息
	    	$latitude = $post['latitude'];//纬度信息
	    	$sql = "select * from (select shop_id,shop_name,shop_tel,shop_position,shop_logo,  ROUND(6378.138*2*ASIN(SQRT(POW(SIN(($latitude*PI()/180-`shop_wei`*PI()/180)/2),2)+COS($latitude*PI()/180)*COS(`shop_wei`*PI()/180)*POW(SIN(($longitude*PI()/180-`shop_jing`*PI()/180)/2),2)))*1000) AS distance from sp_shop order by distance ) as a where a.distance<=5000";
	    	// $sql = "select * from (select shop_id,shop_name,shop_tel,shop_position,shop_logo, ROUND(6378.138*2*ASIN(SQRT(POW(SIN((36.09297*PI()/180-`shop_wei`*PI()/180)/2),2)+COS(36.09297*PI()/180)*COS(`shop_wei`*PI()/180)*POW(SIN((120.3743*PI()/180-`shop_jing`*PI()/180)/2),2)))*1000) AS distance from sp_shop order by distance ) as a where a.distance<=5000";
	    	$shopInfo = M()->query($sql);
	    	echo json_encode($shopInfo);exit;
    	}else{
            if(session('openid')){
                //获取微信签名包信息（用户地理位置的获取）
                $jssdk = new \Home\Model\WechatModel();
                $signPackage = $jssdk->GetSignPackage();
                $this->assign('signPackage', $signPackage);
            	$this->display();
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
                    $this->assign('signPackage', $signPackage);
                    $this->display();exit;
                }else{
                    //如果不存在获取微信用户的基本信息
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
                    $this->assign('signPackage', $signPackage);
                    $this->display();
                }
            }
    	}
    }
    public function shopDetail(){
    	$shop_id = $_GET['shop_id'];
        //门店信息
    	$shopInfo = M('shop')->where(array('shop_id' => $shop_id))->find();
        //门店图集
    	$Pics = M('shop_pic')->where(array('shop_id' => $shop_id))->select();
        $user_id = session('user_id');
        $rst = M('shop_shoucang')->where(array('shop_id' =>$shop_id,'user_id' => $user_id))->find();
        $this->assign('rst', $rst);
    	$this->assign('shopInfo', $shopInfo);
    	$this->assign('Pics', $Pics);
    	$this->display();
    }
    //根据所选城市获取门店
    public function getShop(){
    	$title['shop_position']= array('LIKE','%'.$_GET['city'].'%');
    	$title['shop_name']= array('LIKE','%'.$_GET['city'].'%');
    	$title['_logic'] = 'or';
        $data['_complex'] = $title;
    	$shopInfos = M('shop')->where($data)->select();
        if($shopInfos){
            echo json_encode($shopInfos);exit;
         }else{
         	echo json_encode(array('code' => 0));exit;
         }
    }

    public function daohang(){
    	$shopInfo = M('shop')->where(array('shop_id' => $_GET['shop_id']))->find();
        header('Access-Control-Allow-Origin:*');
        $str = $shopInfo['shop_position'];
        $reg = '/省(.+)市/U';
        preg_match_all($reg, $str, $result);
        $shopInfo['shop_position'] = $result[1][0]."市";
        
    	$this->assign('shopInfo', $shopInfo);
    	$this->display();
    }
    // 门店收藏
    public function shop_ShouCang(){
        $post = I('post.');
        $rst = M('shop_shoucang')->add($post);
        M('shop')->where(array('shop_id' => $post['shop_id']))->setInc('shop_shoucang',1);
        if($rst){
            echo json_encode(array('code' =>1,'msg' => '门店收藏成功' ));exit;
        }
    }
    // 取消门店收藏
    public function shop_QShouCang(){
         $post = I('post.');
         $rst = M('shop_shoucang')->where($post)->delete();
         M('shop')->where(array('shop_id' => $post['shop_id']))->setDec('shop_shoucang',1);
         if($rst !== false){
            echo json_encode(array('code' =>1,'msg' => '取消门店收藏' ));exit;
         }
    }
}