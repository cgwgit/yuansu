<?php
namespace Admin\Controller;
use Think\Controller;
class XinPinController extends Controller {
	 public function _initialize() {
        if ($_SESSION['manager_name'] == NULL) {
            $this->success('请先登陆', U('Admin/Manager/login'));
            exit();
        }
     }

    public function showList(){
      if($aid = I('get.id')){
        $xinpin = M('xinpin')->where(array('id' => $aid))->find();
        $this->assign('xinpin', $xinpin);
        $this->display('showOne');exit;
    }
       $xinpins = M('xinpin')->select();
       $this->assign('xinpin', $xinpins);
       $this->display();
     }

     public function addXinPin(){
      if(IS_AJAX){
         $banner = I('post.');
         $pic = $this->logo_deal();
         $data = array(
             'xinpin_logo' => $pic,
             'xinpin_name' => $banner['xinpin_Name'],
             'xinpin_dizhi' =>  $banner['xinpin_url'],
             'add_time' => time(),
             'up_time' => time()
          );
         $rst = M('xinpin')->add($data);
         if($rst){
           echo json_encode(array('code' => 1,'msg' => '新品添加成功'));exit;
         }else{
           echo json_encode(array('code' => 0,'msg' => '新品添加失败'));exit;
         }
      }else{
         $this->display();
      }
     } 

     public function editXinPin(){
      if(IS_AJAX){
        $xinpin = I('post.');
        $pic = $this->logo_deal($xinpin['id'],$xinpin['yuanpic']);
        $data = array(
             'id' => $xinpin['id'],
             'xinpin_logo' => $pic,
             'xinpin_name' => $xinpin['xinpin_Name'],
             'xinpin_dizhi' => $xinpin['xinpin_url'],
             'up_time' => time()
          );
        $rst = M('xinpin')->save($data);
        if($rst !== false){
           echo json_encode(array('code' => 1,'msg' => '新品编辑成功'));exit;
        }
        echo json_encode(array('code' => 0,'msg' => '新品编辑失败'));exit;
      }else{
        $id = I('get.id');
        $banner = M('xinpin')->where(array('id' => $id))->find();
        $this->assign('xinpin', $banner);
        $this->display();
      }
     }

        //参数：$data是引用传递,在内部对其进行修改，在外边仍然可以访问到
    private function logo_deal($id,$post){
        //判断有进行正常的附加上传
        if($_FILES['xinpin_Pic']['error']===0){
            //判断是否是“更新”商品的logo处理
            //并删除旧的logo图片
            if(!empty($id)){
                $logo_info = D('xinpin')->
                    field('xinpin_logo')->
                    find($id);
                unlink($logo_info['xinpin_logo']);
            }
            //A.大图logo处理
            //tp框架现成功能类实现附件上传(Think\Upload.class.php)
            //保存附件图片的根目录
            $cfg = array(
                'rootPath'      =>  './Public/Upload/', //保存根路径
                'exts'          =>  array('jpg','jpeg','png','gif'), //允许上传的文件后缀
            );
            $up = new \Think\Upload($cfg);
            //通过uploadOne的返回值可以获得附件上传到服务器的情况信息
            //例如：存储目录、存储名字等
            $z = $up -> uploadOne($_FILES['xinpin_Pic']);
            //整理附件的路径 和 名字信息，存储到数据库指定字段里边
            $biglogoname = $up->rootPath.$z['savepath'].$z['savename'];
            return $biglogoname;//存储到数据库
        }else{
          if($post){
            return $post;
          }else{
            M('xinpin')->where(array('id' => $id))->delete();
            echo json_encode(array('code' => 0,'msg' => '请添加新品图片'));exit;
          }
          
        }
    }
    //新品的删除
    public function delXinPin(){
       $xinpin_id = $_GET['aid'];
       $xinpin = M('xinpin')->where(array('id' => $xinpin_id))->find();
       unlink($xinpin['xinpin_logo']);
       $rst = M('xinpin')->where(array('id' => $xinpin_id))->delete();
       if($rst){
        echo json_encode(array('code' => 1,'msg' => 'banner删除成功'));exit;
       }
    }
}