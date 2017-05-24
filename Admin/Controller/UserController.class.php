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
		$users = M('user')->select();
		$this->assign('user', $users);
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