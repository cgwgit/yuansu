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
           $goods = $model->find($aid);
           $jianjie = M('goods_jianjie')->where(array('goods_id' => $aid))->find();
           $yingyong = M('goods_yingyong')->where(array('goods_id' => $aid))->find();
           $shipin = M('goods_shipin')->where(array('goods_id' => $aid))->find();
           $goodsInfo = array_merge($goods, $jianjie, $yingyong, $shipin);
           $this->assign('goodsinfo', $goods);
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
        );
        
        $id = $goods_Model->add($data);
        if($id){
           $jianjie = array(
                      'goods_id' => $id,
                      'goods_jianjie_pic' => $rst['jianjie_pic'],
                      'goods_jianjie_title' => $post['jianjie_title'],
                      'goods_jianjie_content' => $post['jianjie_content']
            );
           $rstjian = M('goods_jianjie') -> add($jianjie);
           $yingyong = array(
                      'goods_id' => $id,
                      'goods_yingyong_pic' => $rst['yingyong_pic'],
                      'goods_yingyong_title' => $post['yingyong_title'],
                      'goods_yingyong_content' => $post['yingyong_content']
            );
                   $rstyingyong = M('goods_yingyong') -> add($yingyong);
                    $shipin = array(
                      'goods_id' => $id,
                      'goods_shipin_pic' => $rst['shipin_pic'],
                      'goods_shipin_title' => $post['shipin_title'],
                      'goods_shipin_content' => $post['shipin_content']
            );
                   $rstshipin = M('goods_shipin') -> add($shipin);
          if($rstjian && $rstyingyong && $rstshipin){
            echo json_encode(array('code' => 1,'msg' => '产品信息添加成功'));exit;
          }else{
            echo json_encode(array('code' => 0,'msg' => '简介、应用、视频添加失败'));exit;
          }
        }else{
          echo json_encode(array('code' => 0,'msg' => '基本信息添加失败'));exit;
        }
    }else{
      $categorys = M('category')->where(array('cat_pid' => 0))->select();
      $this->assign('categorys', $categorys);
      $this->display();
    }
    
  }
  //编辑产品
  public function editAction(){
    $aid = I('get.aid');
    if(IS_POST){
      $post = I('post.');
      !empty($post['articletitle']) ? $articletitle = trim($post['articletitle']) : $err = '请填写产品标题';
      !empty($post['abstract']) ? $abstract = trim($post['abstract']) : $err = '请填写活动内容';
            !empty($post['articlesort']) ? $articlesort = trim($post['articlesort']) : $err = '请选择最大参与人数';
            if($err){
              echo json_encode(array('code' => 0,'msg' => $err));exit;
            }
            !empty($post['startTime']) ? $stime = strtotime($post['startTime']) : $stime = time();
            !empty($post['endTime']) ? $etime = strtotime($post['endTime']) : $etime = time();
      $data = array(
            'id' => $aid,
                    'title' => $post['articletitle'],
                    'content' => $post['abstract'],
                    'money' => $post['articletype'],
                    'stime' => $stime,
                    'etime' => $etime,
                    'maxperson' => $post['articlesort'],
                    'code' => $post['articlecolumn'],
        );
      $rst = M('action')->save($data);
      $rst1 = $this->logo_deal($aid,$post);
      if($rst && $rst1){
        echo json_encode(array('code' => 1,'msg' => '活动编辑成功'));exit;
      }else{
        echo json_encode(array('code' => 1,'msg' => '活动编辑成功'));exit;
      }
    }else{
      $actioninfo = M('action')->where(array('id' => $aid))->find();
      $this->assign('actioninfo', $actioninfo);
      $this->display();
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

  //参数：$data是引用传递,在内部对其进行修改，在外边仍然可以访问到
    private function logo_deal1(){
      var_dump($_FILES);die;
        //判断有进行正常的附加上传
        if($_FILES['logo_pic']['error']===0){
            //判断是否是“更新”商品的logo处理
            //并删除旧的logo图片
            if(!empty($data['aid'])){
                $logo_info = D('action')->
                    field('pic,smallpic')->
                    find($data['aid']);
                unlink($logo_info['pic']);
                unlink($logo_info['smallpic']);
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
            $z = $up -> uploadOne($_FILES['pic']);

            //整理附件的路径 和 名字信息，存储到数据库指定字段里边
            $biglogoname = $up->rootPath.$z['savepath'].$z['savename'];
            $data['pic'] = $biglogoname;//存储到数据库
            
            //B.缩略图logo处理，具体通过\Think\Image.class.php实现
            $im = new \Think\Image();
            $im -> open($biglogoname); //找到大图
            $im -> thumb(750,440,1);//制作缩略图
            //存储制作好的缩略图(事先声明好缩略图的路径名)
            //./Public/Upload/2016-03-29/56f9e9c66664f.jpg
            //./Public/Upload/2016-03-29/s_56f9e9c66664f.jpg
            $smalllogoname = $up->rootPath.$z['savepath']."s_".$z['savename'];
            $im -> save($smalllogoname);
            $data['smallpic'] = $smalllogoname; //存储到数据库
            $data['id'] = $id;
            return M('action')->save($data);exit;
        }else{
          if($post){
            $data['smallpic'] = $post['smallpic'];
              $data['pic'] = $post['pic'];
              $data['id'] = $id;
              return M('action')->save($data);exit;
          }else{
            echo json_encode(array('code' => 0,'msg' => '请添加活动图片'));exit;
          }
          
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
          if($post){
            $data['smallpic'] = $post['smallpic'];
              $data['pic'] = $post['pic'];
              $data['id'] = $id;
              return M('action')->save($data);exit;
          }else{
            echo json_encode(array('code' => 0,'msg' => '请添加logo图片或展示图片'));exit;
          }
          
        }
    }

    public function err($err){
      echo json_encode(array('code' => 0,'msg' => $err));exit;
    }
}