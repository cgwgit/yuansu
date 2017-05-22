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
      if($aid = I('get.id')){
        $banner = M('banner')->where(array('id' => $aid))->find();
        $this->assign('banner', $banner);
        $this->display('showOne');exit;
    }
       $banners = M('banner')->select();
       $this->assign('banner', $banners);
       $this->display();
     }

     public function addBanner(){
      if(IS_AJAX){
         $banner = I('post.');
         $pic = $this->logo_deal();
         $data = array(
             'banner_pic' => $pic,
             'banner_name' => $banner['banner_Name'],
             'banner_addtime' => time(),
             'banner_uptime' => time()
          );
         $rst = M('banner')->add($data);
         if($rst){
           echo json_encode(array('code' => 1,'msg' => 'banner添加成功'));exit;
         }else{
           echo json_encode(array('code' => 0,'msg' => 'banner添加失败'));exit;
         }
      }else{
         $this->display();
      }
     } 

     public function editBanner(){
      if(IS_AJAX){
        $banner = I('post.');
        $pic = $this->logo_deal($banner['id'],$banner['yuanpic']);
        $data = array(
             'id' => $banner['id'],
             'banner_pic' => $pic,
             'banner_name' => $banner['banner_Name'],
             'banner_uptime' => time()
          );
        $rst = M('banner')->save($data);
        if($rst !== false){
           echo json_encode(array('code' => 1,'msg' => 'banner编辑成功'));exit;
        }
        echo json_encode(array('code' => 0,'msg' => 'banner编辑失败'));exit;
      }else{
        $id = I('get.id');
        $banner = M('banner')->where(array('id' => $id))->find();
        $this->assign('banner', $banner);
        $this->display();
      }
     }

     public function delBanner(){
       $this->display();
     }

        //参数：$data是引用传递,在内部对其进行修改，在外边仍然可以访问到
    private function logo_deal($id,$post){
        //判断有进行正常的附加上传
        if($_FILES['banner_Pic']['error']===0){
            //判断是否是“更新”商品的logo处理
            //并删除旧的logo图片
            if(!empty($id)){
                $logo_info = D('banner')->
                    field('banner_pic')->
                    find($id);
                unlink($logo_info['cat_logo']);
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
            $z = $up -> uploadOne($_FILES['banner_Pic']);
            //整理附件的路径 和 名字信息，存储到数据库指定字段里边
            $biglogoname = $up->rootPath.$z['savepath'].$z['savename'];
            return $biglogoname;//存储到数据库
        }else{
          if($post){
            return $post;
          }else{
            M('banner')->where(array('id' => $id))->delete();
            echo json_encode(array('code' => 0,'msg' => '请添加banner图片'));exit;
          }
          
        }
    }
}