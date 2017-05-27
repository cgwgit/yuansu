<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	//门店主页
    public function index(){
        if(session('openid')){
            $this->display();exit;
        }else{
            $model = new \Home\Model\WechatModel();
            $openid_accesstoken = $model->openId();
            $rst = M('user')->where(array('user_openid' => $openid_accesstoken['openid']))->find();
            if($rst){
                session('openid',$openid_accesstoken['openid']);
                session('user_id', $rst['user_id']);
                $this->display();exit;
            }else{
                $userInfo = $model->getOpenId($openid_accesstoken['openid'],$openid_accesstoken['access_token']);
                $data = array(
                    'user_img' => $userInfo['headimgurl'],
                    'user_openid' => $userInfo['openid'],
                    'user_name' => $userInfo['nickname'],
                    'user_register_time' => time(),
                    'city' => $userInfo['city'],
                    'province' => $userInfo['province']
                    );
                $id = M('user')->add($data);
                session('openid', $userInfo['openid']);
                session('user_id',$id);
                $this->display();exit;
            }
        }
    }
    //门店详情
    public function goods_detail(){
    	$this->display();
    }
    //门店列表
    public function goods_list(){
    	$this->display();
    }
}