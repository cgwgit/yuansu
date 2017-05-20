<?php
namespace Admin\Controller;
use Think\Controller;
class BannerController extends Controller {
		  public function _initialize() {
        if ($_SESSION['manager_name'] == NULL) {
            $this->success('请先登陆', U('Admin/Manager/login'));
            exit();
        }
     }

     public function showList(){
       $this->display();
     }

     public function addBanner(){
       $this->display();
     } 

     public function editBanner(){
       $this->display();
     }

     public function delBanner(){
       $this->display();
     }
}