<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller {
		  public function _initialize() {
        if ($_SESSION['manager_name'] == NULL) {
            $this->success('请先登陆', U('Admin/Manager/login'));
            exit();
        }
     }   
	//用户显示列表
	public function showList(){
    $where = '2>1';
    if(!empty($_POST['user_name'])){
      $where .= " AND `user_name` like '%{$_POST['user_name']}%'";
    }
    $model = M('user');
    $count = $model->where($where)->count();
    $Page = new \Think\Page($count,10);
    $Page -> setConfig('prev','上一页');
    $Page -> setConfig('next','下一页');
    $Page -> setConfig('first','首页');
    $Page -> setConfig('last','末页');
    $Page -> lastSuffix = false;  //将末页从数字的显示方式切换成汉字提示
    $show = $Page->show();
    $users = $model->where($where)->order('user_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('user', $users);
    $this->assign('page', $show);
		$this->display();
	}
    //删除用户
  public function member_del(){
    $id = I('get.id');
    $rst = M('user')->where(array('user_id' => $id))->delete();
    if($rst){
      echo json_encode(array('code' => 1,'msg' => '删除成功'));exit;
    }else{
      echo json_encode(array('code' => 0,'msg' => '删除失败'));exit;
    }
  }
}