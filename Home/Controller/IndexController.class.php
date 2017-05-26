<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	//门店主页
    public function index(){
    	$this->display();
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