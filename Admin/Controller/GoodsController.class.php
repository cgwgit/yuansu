<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends Controller {
    public function _initialize() {
        if ($_SESSION['manager_name'] == NULL) {
            $this->success('请先登陆', U('Admin/Manager/login'));
            exit();
        }
     }  
      //显示产品列表
  public function showList(){
    $model = M('goods');
    if($aid = I('get.aid')){
      $goodsinfo = M('goods')->where(array('goods_id' => $aid))->find();
      $category = M('category')->where(array('cat_id' => $goodsinfo['cat_id']))->find();
      $categorys = M('category')->where(array('cat_level' => 0))->select();
      $jianjie = M('goods_jianjie')->where(array('goods_id' => $aid))->select();
      $shipin = M('goods_shipin')->where(array('goods_id' => $aid))->select();
      $yingyong = M('goods_yingyong')->where(array('goods_id' => $aid))->select();
      $parentCategory = M('category')->where(array('cat_id' => $category['cat_pid']))->find();
      $this->assign('parentCategory', $parentCategory);
      $this->assign('jianjie', $jianjie);
      $this->assign('shipin', $shipin);
      $this->assign('yingyong', $yingyong);
      $this->assign('categorys', $categorys);
      $this->assign('category', $category);
      $this->assign('goodsinfo', $goodsinfo);
      $this->display('showOne');exit;
    }
    $count = $model->count();
    $Page = new \Think\Page($count,10);
    $Page -> setConfig('prev','上一页');
    $Page -> setConfig('next','下一页');
    $Page -> setConfig('first','首页');
    $Page -> setConfig('last','末页');
    $Page -> lastSuffix = false;  //将末页从数字的显示方式切换成汉字提示
    $show = $Page->show();
    $list = $model->order('goods_id')->limit($Page->firstRow.','.$Page->listRows)->select();
    $this->assign('goods', $list);
    $this->assign('page', $show);
    $this->display();
  }
    //添加产品
  public function addGoods(){
    if(IS_AJAX){
      $goods_Model = M('goods');
      $post = I('post.');
      !empty($post['goods_Name']) ? $goods_name = trim($post['goods_Name']) : $this->err('产品名称不能为空');
      !empty($post['cat_id']) ? $cat_id = trim($post['cat_id']) : $this->err('请选择所属分类');
      $rst = $this->logo_deal();
      $data = array(
                    'goods_name' => $goods_name,
                    'cat_id' => $cat_id,
                    'goods_rongji' => $post['rongji'],
                    'goods_color' => $post['yanse'],
                    'goods_tedian' =>$post['tedian'],
                    'goods_logo' => $rst['logo_pic'],
                    'goods_zhanshi' => $rst['zhanshi_pic'],
                    'goods_addtime' => time(),
                    'goods_uptime' => time(),
                    'status' => $post['status']
        );
        $id = $goods_Model->add($data);
        if($id){
            $this->pics_deal($id,$post);
            echo json_encode(array('code' => 1,'msg' => '产品信息添加成功'));exit;
        }else{
          echo json_encode(array('code' => 0,'msg' => '产品信息添加失败'));exit;
        }
    }else{
      $categorys = M('category')->where(array('cat_pid' => 0))->select();
      $this->assign('categorys', $categorys);
      $this->display();
    }
    
  }
  //编辑产品基本信息
  public function editGoods(){
    $aid = I('get.aid');
    if(IS_POST){
      $post = I('post.');
      !empty($post['goods_Name']) ? $goods_name = trim($post['goods_Name']) : $this->err('产品名称不能为空');
      !empty($post['cat_id']) ? $cat_id = trim($post['cat_id']) : $this->err('请选择所属分类');
      $rst = $this->logo_deal1($post);
      $data = array(
                    'goods_id' => $post['goods_Id'],
                    'goods_name' => $goods_name,
                    'cat_id' => $cat_id,
                    'goods_rongji' => $post['rongji'],
                    'goods_color' => $post['yanse'],
                    'goods_tedian' =>$post['tedian'],
                    'goods_logo' => $rst['logo_pic'],
                    'goods_zhanshi' => $rst['zhanshi_pic'],
                    'goods_uptime' => time(),
                    'status' => $post['status']
        );
      $rst = M('goods')->save($data);
      if($rst !== false){
        echo json_encode(array('code' => 1,'msg' => '产品基本信息编辑成功'));exit;
      }
      echo json_encode(array('code' => 0,'msg' => '产品基本信息编辑失败'));exit;
    }else{
      $goodsinfo = M('goods')->where(array('goods_id' => $aid))->find();
      $category = M('category')->where(array('cat_id' => $goodsinfo['cat_id']))->find();
      $categorys = M('category')->where(array('cat_level' => 0))->select();
      $jianjie = M('goods_jianjie')->where(array('goods_id' => $aid))->select();
      $shipin = M('goods_shipin')->where(array('goods_id' => $aid))->select();
      $yingyong = M('goods_yingyong')->where(array('goods_id' => $aid))->select();
      $this->assign('jianjie', $jianjie);
      $this->assign('shipin', $shipin);
      $this->assign('yingyong', $yingyong);
      $this->assign('categorys', $categorys);
      $this->assign('category', $category);
      $this->assign('goodsinfo', $goodsinfo);
      $this->display();
    }
    
  }
  //编辑产品简介信息
  public function edit_jianjie(){
    if(IS_AJAX){
      //添加简介
      if($_GET['id'] == 'jianjie_add'){
         $post = I('post.');
         $jianjie_pic = $this->jianjie_logo();
         $data = array(
           'goods_id' => $_GET['goods_id'],
           'goods_jianjie_title' => $post['jianjie_title'],
           'goods_jianjie_content' => $post['jianjie_content'],
           'goods_jianjie_url' => $post['jianjie_url'],
           'goods_jianjie_pic' => $jianjie_pic
          );
         $rst = M('goods_jianjie')->add($data);
         if($rst){
          echo json_encode(array('code' => 1,'msg' => '编辑添加成功'));exit;
         }else{
          echo json_encode(array('code' => 0,'msg' => '编辑添加失败'));exit;
         }
      }else{
         //编辑简介
          $post = I('post.');
          $jianjie_pic = $this->jianjie_logo($post);
          $data = array(
           'id' => $post['id'],
           'goods_id' => $post['goods_Id'],
           'goods_jianjie_title' => $post['jianjie_title'],
           'goods_jianjie_content' => $post['jianjie_content'],
           'goods_jianjie_url' => $post['jianjie_url'],
           'goods_jianjie_pic' => $jianjie_pic
          );
          $rst = M('goods_jianjie')->save($data);
          if($rst !== false){
            echo json_encode(array('code' => 1,'msg' => '简介信息编辑成功'));exit;
          }else{
            echo json_encode(array('code' => 0,'msg' => '简介信息编辑失败'));exit;
          }

      }
    }
  }
  //对简介的图片的处理
    public function jianjie_logo($post){
       if($post['id'] != ''){
           if($_FILES['jianjie_pic']['error']===0){
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
            $z = $up -> uploadOne($_FILES['jianjie_pic']);
            return $up->rootPath.$z['savepath'].$z['savename'];die;
        }else{
           return $post['yuan_jianjie_pic'];exit;
        }
       }
       if($_FILES['jianjie_pic']['error']===0){
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
            $z = $up -> uploadOne($_FILES['jianjie_pic']);
            return $up->rootPath.$z['savepath'].$z['savename'];die;
        }else{
            echo json_encode(array('code' => 0,'msg' => '请添加logo图片或展示图片'));exit;
        }
    }

    //对应用的编辑
    public function edit_yingyong(){
      if(IS_AJAX){
      //添加简介
      if($_GET['id'] == 'yingyong_add'){
         $post = I('post.');
         $yingyong_pic = $this->yingyong_logo();
         $data = array(
           'goods_id' => $_GET['goods_id'],
           'goods_yingyong_title' => $post['yingyong_title'],
           'goods_yingyong_content' => $post['yingyong_content'],
           'goods_yingyong_url' => $post['yingyong_url'],
           'goods_yingyong_pic' => $yingyong_pic
          );
         $rst = M('goods_yingyong')->add($data);
         if($rst){
          echo json_encode(array('code' => 1,'msg' => '应用添加成功'));exit;
         }else{
          echo json_encode(array('code' => 0,'msg' => '应用添加失败'));exit;
         }
      }else{
         //编辑简介
          $post = I('post.');
          $yingyong_pic = $this->yingyong_logo($post);
          $data = array(
           'id' => $post['id'],
           'goods_id' => $post['goods_Id'],
           'goods_yingyong_title' => $post['yingyong_title'],
           'goods_yingyong_content' => $post['yingyong_content'],
           'goods_yingyong_url' => $post['yingyong_url'],
           'goods_yingyong_pic' => $yingyong_pic
          );
          $rst = M('goods_yingyong')->save($data);
          if($rst !== false){
            echo json_encode(array('code' => 1,'msg' => '应用信息编辑成功'));exit;
          }else{
            echo json_encode(array('code' => 0,'msg' => '应用信息编辑失败'));exit;
          }

      }
    }
    }
    //对应用的图片进行处理
     //对简介的图片的处理
    public function yingyong_logo($post){
       if($post['id'] != ''){
           if($_FILES['yingyong_pic']['error']===0){
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
            $z = $up -> uploadOne($_FILES['yingyong_pic']);
            return $up->rootPath.$z['savepath'].$z['savename'];die;
        }else{
           return $post['yuan_yingyong_pic'];exit;
        }
       }
       if($_FILES['yingyong_pic']['error']===0){
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
            $z = $up -> uploadOne($_FILES['yingyong_pic']);
            return $up->rootPath.$z['savepath'].$z['savename'];die;
        }else{
            echo json_encode(array('code' => 0,'msg' => '请添加logo图片或展示图片'));exit;
        }
    }
    //对视频的修改和编辑
    public function edit_shipin(){
       if(IS_AJAX){
        //添加简介
        if($_GET['id'] == 'shipin_add'){
           $post = I('post.');
           $shipin_pic = $this->shipin_logo();
           $data = array(
             'goods_id' => $_GET['goods_id'],
             'goods_shipin_title' => $post['shipin_title'],
             'goods_shipin_content' => $post['shipin_content'],
             'goods_shipin_url' => $post['shipin_url'],
             'goods_shipin_pic' => $shipin_pic
            );
           $rst = M('goods_shipin')->add($data);
           if($rst){
            echo json_encode(array('code' => 1,'msg' => '视频添加成功'));exit;
           }else{
            echo json_encode(array('code' => 0,'msg' => '视频添加失败'));exit;
           }
        }else{
           //编辑简介
            $post = I('post.');
            $shipin_pic = $this->shipin_logo($post);
            $data = array(
             'id' => $post['id'],
             'goods_id' => $post['goods_Id'],
             'goods_shipin_title' => $post['shipin_title'],
             'goods_shipin_content' => $post['shipin_content'],
             'goods_shipin_url' => $post['shipin_url'],
             'goods_shipin_pic' => $shipin_pic
            );
            $rst = M('goods_shipin')->save($data);
            if($rst !== false){
              echo json_encode(array('code' => 1,'msg' => '视频信息编辑成功'));exit;
            }else{
              echo json_encode(array('code' => 0,'msg' => '视频信息编辑失败'));exit;
            }

        }
      }
    }
    //视频图片的处理
    public function shipin_logo(){
          if($post['id'] != ''){
           if($_FILES['shipin_pic']['error']===0){
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
            $z = $up -> uploadOne($_FILES['shipin_pic']);
            return $up->rootPath.$z['savepath'].$z['savename'];die;
        }else{
           return $post['yuan_shipin_pic'];exit;
        }
       }
       if($_FILES['shipin_pic']['error']===0){
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
            $z = $up -> uploadOne($_FILES['shipin_pic']);
            return $up->rootPath.$z['savepath'].$z['savename'];die;
        }else{
            echo json_encode(array('code' => 0,'msg' => '请添加logo图片或展示图片'));exit;
        }
    }

  //删除活动
  public function delGoods(){
    $aid = I('get.aid');
    if(is_numeric($aid)){
      //删除单个活动
    $goods_info = M('goods')
              ->join('sp_goods_jianjie on sp_goods.goods_id = sp_goods_jianjie.goods_id')
              ->join('sp_goods_yingyong on sp_goods.goods_id = sp_goods_yingyong.goods_id')
                  ->join('sp_goods_shipin on sp_goods.goods_id = sp_goods_shipin.goods_id')
                  ->where(array('sp_goods.goods_id' => $aid))->find();
          unlink($goods_info['goods_logo']);
          unlink($goods_info['goods_zhanshi']);
          unlink($goods_info['goods_jianjie_pic']);
          unlink($goods_info['goods_yingyong_pic']);
          unlink($goods_info['goods_shipin_pic']);
          $where['goods_id'] = $aid;
          $goods = M('goods')->where($where)->delete();
          $jianjie = M('goods_jianjie')->where($where)->delete();
          $shipin = M('goods_shipin')->where($where)->delete();
          $yingyong = M('goods_yingyong')->where($where)->delete();
    }else{
      //删除多个活动
      $where['aid'] = array('in', $aid);
      M('cinfo')->where($where)->delete();
      $wh['id'] = array('in', $aid); 
      $logo_infos = M('action')->where($wh)->select();
      foreach ($logo_infos as $key => $value) {
        unlink($value['pic']);
              unlink($value['smallpic']);
      }
    }
    $rst = M('action')->delete($aid);
    if($rst){
      echo json_encode(array('code' => 1));exit;
    }
  }
    private function logo_deal(){
        //判断有进行正常的附加上传
        if($_FILES['logo_pic']['error']===0 && $_FILES['zhanshi_pic']['error']===0){
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
            $z = $up -> upload($_FILES);
            $data = array();
            foreach ($z as $key => $value) {
              $data[$key] = $up->rootPath.$value['savepath'].$value['savename'];
            }
            return $data;die;
        }else{
            echo json_encode(array('code' => 0,'msg' => '请添加logo图片或展示图片'));exit;
        }
    }

    public function err($err){
      echo json_encode(array('code' => 0,'msg' => $err));exit;
    }
      //对应用、简介、视频进行处理
    private function pics_deal($goods_id,$post){
        //判断是否有上传相册，遍历error的信息即可，只有有一个为"0"
        //就给做上传处理
        $up_pics = false;
        //简介
        if(!empty($_FILES['jianjie_pic'])){
              foreach($_FILES['jianjie_pic']['error'] as $k => $v){
                if($v === 0){
                    $up_pics = true;
                    break;
                }
            }
            if($up_pics === true){
                $cfg = array(
                    'rootPath'      =>  './Public/Upload/', //保存根路径
                    'exts'          =>  array('jpg','jpeg','png','gif'), //允许上传的文件后缀
                );
                $up = new \Think\Upload($cfg);
                
                //$_FILES: logo_tu和jianjie_pic两部分附件
                //upload(array('pics_tu'=>array(name=>123,error=>,tmp_name=>,size=>,type=>)))
                //多图片上传
                $z = $up -> upload(array('jianjie_pic'=>$_FILES['jianjie_pic']));
                //遍历$z,并制作缩略图，完成sp_goods_pics数据表的记录填充
                $arr = array();
                foreach($z as $m => $n){
                    //小图：50*50  中图:350*350  大图:800*800
                    // $im = new \Think\Image();
                    $jianjie_pic = $up->rootPath.$n['savepath'].$n['savename'];
                    $arr['goods_id'] = $goods_id;
                    $arr['goods_jianjie_pic'] = $jianjie_pic;
                    $arr['goods_jianjie_title'] = $post['jianjie_title'][$m];
                    $arr['goods_jianjie_content'] = $post['jianjie_content'][$m];
                    $arr['goods_jianjie_url'] = $post['jianjie_url'][$m];
                    D('goods_jianjie')->add($arr);
                }
            }
          }  
          //应用
          if(!empty($_FILES['yingyong_pic'])){
                foreach($_FILES['yingyong_pic']['error'] as $k => $v){
                if($v === 0){
                    $up_pics = true;
                    break;
                }
            }
            if($up_pics === true){
                $cfg = array(
                    'rootPath'      =>  './Public/Upload/', //保存根路径
                    'exts'          =>  array('jpg','jpeg','png','gif'), //允许上传的文件后缀
                );
                $up = new \Think\Upload($cfg);
                
                //$_FILES: logo_tu和jianjie_pic两部分附件
                //upload(array('pics_tu'=>array(name=>123,error=>,tmp_name=>,size=>,type=>)))
                //多图片上传
                $z = $up -> upload(array('yingyong_pic'=>$_FILES['yingyong_pic']));
                //遍历$z,并制作缩略图，完成sp_goods_pics数据表的记录填充
                $arr = array();
                foreach($z as $m => $n){
                    //小图：50*50  中图:350*350  大图:800*800
                    // $im = new \Think\Image();
                    $yingyong_pic = $up->rootPath.$n['savepath'].$n['savename'];
                    $arr['goods_id'] = $goods_id;
                    $arr['goods_yingyong_pic'] = $yingyong_pic;
                    $arr['goods_yingyong_title'] = $post['yingyong_title'][$m];
                    $arr['goods_yingyong_content'] = $post['yingyong_content'][$m];
                    $arr['goods_yingyong_url'] = $post['yingyong_url'][$m];
                    D('goods_yingyong')->add($arr);
                }
            }
          } 
             //视频
             if(!empty($_FILES['shipin_pic'])){
                   
                foreach($_FILES['shipin_pic']['error'] as $k => $v){
                if($v === 0){
                    $up_pics = true;
                    break;
                }
            }
            if($up_pics === true){
                $cfg = array(
                    'rootPath'      =>  './Public/Upload/', //保存根路径
                    'exts'          =>  array('jpg','jpeg','png','gif'), //允许上传的文件后缀
                );
                $up = new \Think\Upload($cfg);
                
                //$_FILES: logo_tu和jianjie_pic两部分附件
                //upload(array('pics_tu'=>array(name=>123,error=>,tmp_name=>,size=>,type=>)))
                //多图片上传
                $z = $up -> upload(array('shipin_pic'=>$_FILES['shipin_pic']));
                //遍历$z,并制作缩略图，完成sp_goods_pics数据表的记录填充
                $arr = array();
                foreach($z as $m => $n){
                    //小图：50*50  中图:350*350  大图:800*800
                    // $im = new \Think\Image();
                    $shipin_pic = $up->rootPath.$n['savepath'].$n['savename'];
                    $arr['goods_id'] = $goods_id;
                    $arr['goods_shipin_pic'] = $shipin_pic;
                    $arr['goods_shipin_title'] = $post['shipin_title'][$m];
                    $arr['goods_shipin_content'] = $post['shipin_content'][$m];
                    $arr['goods_shipin_url'] = $post['shipin_url'][$m];
                    D('goods_shipin')->add($arr);
                }
            }
          } 
    }
    //删除简介
    public function del_Pic(){
        $pics_id = I('get.pics_id');
        $picsinfo = D('goods_jianjie')->find($pics_id);
        //① 删除物理图片
        unlink($picsinfo['goods_jianjie_pic']);
        //② 删除记录信息
        D('goods_jianjie')->delete($pics_id);
    }

          //删除应用
    public function del_Shipin(){
        $pics_id = I('get.pics_id');
        $picsinfo = D('goods_shipin')->find($pics_id);
        //① 删除物理图片
        unlink($picsinfo['goods_shipin_pic']);
        //② 删除记录信息
        D('goods_shipin')->delete($pics_id);

    }
        //删除应用
    public function del_Yingyong(){
        $pics_id = I('get.pics_id');
        $picsinfo = D('goods_yingyong')->find($pics_id);
        //① 删除物理图片
        unlink($picsinfo['goods_yingyong_pic']);
        //② 删除记录信息
        D('goods_yingyong')->delete($pics_id);
    }
      
     private function logo_deal1($post){
        //判断有进行正常的附加上传
        if($_FILES['logo_pic']['error']===0 || $_FILES['zhanshi_pic']['error']===0){
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
            $z = $up -> upload($_FILES);
            //logo上传
            if($z['logo_pic'] != '' && $z['zhanshi_pic'] == ''){
              $data['logo_pic'] = $up->rootPath.$z['logo_pic']['savepath'].$z['logo_pic']['savename'];
              $data['zhanshi_pic'] = $post['yuan_zhanshi_pic'];
              return $data;die;
            }
            //展示图上传
            if($z['logo_pic'] == '' && $z['zhanshi_pic'] != ''){
              $data['zhanshi_pic'] = $up->rootPath.$z['zhanshi_pic']['savepath'].$z['zhanshi_pic']['savename'];
              $data['logo_pic'] = $post['yuan_logo_pic'];
              return $data;die;
            }
            //两图都上传
            if($z['logo_pic'] != '' && $z['zhanshi_pic'] != ''){
              $data = array();
              foreach ($z as $key => $value) {
                $data[$key] = $up->rootPath.$value['savepath'].$value['savename'];
              }
              return $data;die;
            }
        }else{
          //没有新上传的logo和展示图
          if($post){
              $data['logo_pic'] = $post['yuan_logo_pic'];
              $data['zhanshi_pic'] = $post['yuan_zhanshi_pic'];
              return $data;exit;
          }
        }
    }
    public function del_Goods(){
      $aid = I('get.aid');
       if(is_numeric($aid)){
        //删除单个活动
        $goods = M('goods')->where(array('goods_id' => $aid))->find();
        unlink($goods['goods_logo']);
        unlink($goods['goods_zhanshi']);
        $jianjie = M('goods_jianjie')->where(array('goods_id' => $aid))->select();
        foreach ($jianjie as $key => $value) {
          unlink($value['goods_jianjie_pic']);
        }
        $shipin = M('goods_shipin')->where(array('goods_id' => $aid))->select();
        foreach ($shipin as $key => $value) {
          unlink($value['goods_shipin_pic']);
        }
        $yingyong = M('goods_yingyong')->where(array('goods_id' => $aid))->select();
         foreach ($yingyong as $key => $value) {
          unlink($value['goods_yingyong_pic']);
        }
        $rst1 = M('goods')->where(array('goods_id' => $aid))->delete();
        $rst2 = M('goods_jianjie')->where(array('goods_id' => $aid))->delete();
        $rst3 = M('goods_shipin')->where(array('goods_id' => $aid))->delete();
        $rst4 = M('goods_yingyong')->where(array('goods_id' => $aid))->delete();
         echo json_encode(array('code' => 1));exit;
    }else{
        //删除多个产品
          $wh['goods_id'] = array('in', $aid); 
          $goods = M('goods')->where($wh)->select();
          foreach ($goods as $key => $value) {
              unlink($value['goods_logo']);
              unlink($value['goods_zhanshi']);
              $jianjie = M('goods_jianjie')->where(array('goods_id' => $value['goods_id']))->select();
              foreach ($jianjie as $k => $v) {
              unlink($v['goods_jianjie_pic']);
            }
            $shipin = M('goods_shipin')->where(array('goods_id' => $value['goods_id']))->select();
          foreach ($shipin as $k => $v) {
            unlink($v['goods_shipin_pic']);
          }
          $yingyong = M('goods_yingyong')->where(array('goods_id' => $value['goods_id']))->select();
           foreach ($yingyong as $k => $v) {
            unlink($v['goods_yingyong_pic']);
          }
        }
        $rst1 = M('goods')->where($wh)->delete();
        $rst2 = M('goods_jianjie')->where($wh)->delete();
        $rst3 = M('goods_shipin')->where($wh)->delete();
        $rst4 = M('goods_yingyong')->where($wh)->delete();
         echo json_encode(array('code' => 1));exit;
    }
}

}