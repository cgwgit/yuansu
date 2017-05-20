<?php
//曹国伟
//2017年2月22日16:51:52
namespace Admin\Controller;
use Think\Controller;
class ManagerController extends Controller {

//登录
  public function login(){
    if(IS_AJAX){
           $post = I('post.');
           !empty($post['name']) ? $name = trim($post['name']) : $err = '请填写正确的用户名';
           !empty($post['pwd']) ? $pwd = trim($post['pwd']) : $err = '请填写正确的密码';
           if($err){
            echo json_encode(array('code' =>0,'msg' => $err));exit;
           }
           $data = array(
                 'manager_name' => $name,
                 'manager_pwd' => $pwd
            );
           $rst = M('manager')->where($data)->find();
           if($rst){
            session('uid', $rst['manager_id']);
            session('manager_name', $rst['manager_name']);
            echo json_encode(array('code' =>1,'msg' => '登录成功'));exit;
           }else{
            echo json_encode(array('code' =>0,'msg' => '用户名或密码不正确'));exit;
           }
    }else{
      $this->display();
    }
  }
	//退出按钮
	public function loginout(){
    session(null);
		$this->display('login');
	}

   //用户显示列表
  public function showList(){
    if ($_SESSION['manager_name'] == NULL) {
            $this->success('请先登陆', U('Admin/Manager/login'));
            exit();
        }
    $admins = M('manager')->select();
    $this->assign('admin', $admins);
    $this->display();
  }
  //添加用户
  public function addUser(){
    if ($_SESSION['manager_name'] == NULL) {
            $this->success('请先登陆', U('Admin/Manager/login'));
            exit();
        }
    if(IS_AJAX){
          $rs = M('manager')->where(array('manager_name' => I('post.adminName')))->find();
          if($rs){
            echo json_encode(array('code' =>0,'msg' =>'用户名已存在'));exit;
          }
          $data = array(
               'manager_name' => I('post.adminName'),
               'manager_pwd' => I('post.password'),
               'addtime' => time()
            );
          $rst = M('manager')->add($data);
          if($rst){
            $data = array(
                  'code' => 1,
                  'msg' => '添加成功'
                );
            echo json_encode($data);exit;
          }else{
            echo json_encode(array('code' =>0,'msg' =>'添加失败'));exit;
          }
    }else{
      $this->display();
    }
  }

    //删除用户
  public function member_del(){
    $id = I('get.id');
    $rst = M('manager')->where(array('manager_id' => $id))->delete();
    if($rst){
      echo json_encode(array('code' => 1,'msg' => '删除成功'));exit;
    }else{
      echo json_encode(array('code' => 0,'msg' => '删除失败'));exit;
    }
  }
}