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
        $post = I('post.');
        $where = "`order_status` = '1'";
        if(isset($post['fahuo_status']) and $post['fahuo_status'] !== ''){
          $where .= " AND `fahuo_status` = '{$post['fahuo_status']}'";
        }
        if(!empty($post['tel'])){
          $where .= " AND `tel` = '{$post['tel']}'";
        }
        // if($post['fahuo_danhao'] != ''){
        //   $where .= " AND `fahuo_danhao` = '{$post['fahuo_danhao']}'";
        // }
        $model = M('goods_order');
        $count = $model->where($where)->count();
        $Page = new \Think\Page($count,10);
        $Page -> setConfig('prev','上一页');
        $Page -> setConfig('next','下一页');
        $Page -> setConfig('first','首页');
        $Page -> setConfig('last','末页');
        $Page -> lastSuffix = false;    //将末页从数字的显示方式切换成汉字提示
        $show = $Page->show();
        $orders = $model->field('sp_goods_order.*,sp_goods_buy.goods_title')->join('sp_goods_buy on sp_goods_order.goods_buy_id=sp_goods_buy.id')->where($where)->order('order_time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('orders', $orders);
        $this->assign('page', $show);
     	$this->display();
     }
     //发货
     public function faHuo(){
        $faHuo = I('post.');
        $data = array(
             'fahuo_danwei' => $faHuo['fahuo_danwei'],
             'fahuo_danhao' => $faHuo['fahuo_danhao'],
             'fahuo_status' => $faHuo['order_id'],
             'fahuo_status' => '1'
            );
        $rst = M('goods_order')->where(array('order_id' => $faHuo['order_id']))->save($data);
        if($rst !== false){
            echo json_encode(array('code' =>1,'msg' => '发货成功'));exit;
        }
        echo json_encode(array('code' =>0,'msg' => '发货失败'));exit;
     }
     //已发货订单详情
     public function orderDetail(){
        $order_id = $_GET['order_id'];
        $order_Info = M('goods_order')->field('sp_goods_buy.goods_title,sp_goods_order.*')->join('sp_goods_buy on sp_goods_order.goods_buy_id = sp_goods_buy.id')->where(array('order_id' => $order_id))->find();
        $this->assign('order_Info', $order_Info);
     	$this->display();
     }
     //未发货订单详情
     public function WeiFaDetail(){
        $order_id = $_GET['order_id'];
        $order_Info = M('goods_order')->field('sp_goods_buy.goods_title,sp_goods_order.*')->join('sp_goods_buy on sp_goods_order.goods_buy_id = sp_goods_buy.id')->where(array('order_id' => $order_id))->find();
         $this->assign('order_Info', $order_Info);
        $this->display();
     }
     //订单信息
     public function OrderInfo(){
        $order_id = $_GET['order_id'];
        $order_Info = M('goods_order')->field('sp_goods_order.*,sp_goods_buy.goods_title')->join('sp_goods_buy on sp_goods_order.goods_buy_id=sp_goods_buy.id')->where(array('order_id' => $order_id))->find();
        $this->assign('order_Info', $order_Info);
        $this->display();
     }
}