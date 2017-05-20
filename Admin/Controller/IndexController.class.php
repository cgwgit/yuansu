<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {

	public function _initialize() {
        if ($_SESSION['manager_name'] == NULL) {
            $this->success('请先登陆', U('Admin/Manager/login'));
            exit();
        }
     } 

      //显示后台首页
	public function index(){
	   $this->display();
	}

	//显示欢迎页面
	public function welcome(){
	  $this->display();
	}


}