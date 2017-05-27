<?php
namespace Admin\Controller;
use Think\Controller;
class OrderController extends Controller {
	  public function _initialize() {
        if ($_SESSION['manager_name'] == NULL) {
            $this->success('请先登陆', U('Admin/Manager/login'));
            exit();
        }
     }
     //订单列表
     public function OrderList(){
     	$this->display();
     }
     //发货
     public function faHuo(){
     	$this->display();
     }
     //已发货订单详情
     public function orderDetail(){
     	$this->display();
     }
     //未发货订单详情
     public function WeiFaDetail(){
        $this->display();
     }
}