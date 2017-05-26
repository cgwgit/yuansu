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
	    	// $sql = "select * from (select shop_id,shop_name,shop_tel,shop_position,  ROUND(6378.138*2*ASIN(SQRT(POW(SIN(($latitude*PI()/180-`shop_wei`*PI()/180)/2),2)+COS($latitude*PI()/180)*COS(`shop_wei`*PI()/180)*POW(SIN(($longitude*PI()/180-`shop_jing`*PI()/180)/2),2)))*1000) AS distance from sp_shop order by distance ) as a where a.distance<=5000";
	    	$sql = "select * from (select shop_id,shop_name,shop_tel,shop_position,shop_logo, ROUND(6378.138*2*ASIN(SQRT(POW(SIN((36.09297*PI()/180-`shop_wei`*PI()/180)/2),2)+COS(36.09297*PI()/180)*COS(`shop_wei`*PI()/180)*POW(SIN((120.3743*PI()/180-`shop_jing`*PI()/180)/2),2)))*1000) AS distance from sp_shop order by distance ) as a where a.distance<=5000";
	    	$shopInfo = M()->query($sql);

	    	echo json_encode($shopInfo);exit;
    	}else{
	        $jssdk = new \Home\Model\WechatModel();
	        $signPackage = $jssdk->GetSignPackage();
	        $this->assign('signPackage', $signPackage);
	    	$this->display();
    	}
    }
    public function shopDetail(){
    	$shop_id = $_GET['shop_id'];
    	$shopInfo = M('shop')->where(array('shop_id' => $shop_id))->find();
    	$Pics = M('shop_pic')->where(array('shop_id' => $shop_id))->select();
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
    	$this->assign('shopInfo', $shopInfo);
    	$this->display();
    }
}