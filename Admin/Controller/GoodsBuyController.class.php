<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsBuyController extends Controller {
	  public function _initialize() {
        if ($_SESSION['manager_name'] == NULL) {
            $this->success('请先登陆', U('Admin/Manager/login'));
            exit();
        }
     }
     //购物专区产品列表的显示
     public function showList(){
        $where = '2>1';
        $goods_title = trim($_POST['goods_title']);
        if($goods_title != ''){
            $where .= " AND `goods_title` like '%{$goods_title}%'";
        }
        $model = M('goods_buy');
        $count = $model->where($where)->count();
        $Page = new \Think\Page($count,10);
        $Page -> setConfig('prev','上一页');
        $Page -> setConfig('next','下一页');
        $Page -> setConfig('first','首页');
        $Page -> setConfig('last','末页');
        $Page -> lastSuffix = false;    //将末页从数字的显示方式切换成汉字提示
        $show = $Page->show();
        $list = $model->where($where)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('goods_buy', $list);
        $this->assign('page', $show);
     	$this->display();
     }
     //购物专区产品列表的显示
     public function addGoods(){
        if(IS_AJAX){
            $post = I('post.');
            $goods_detail = \fanXSS($_POST['goods_detail']);
            $data = array(
                'goods_title' => $post['goods_title'],
                'goods_detail' => $goods_detail,
                'goods_price' => $post['goods_price'],
                'goods_yunfei' => $post['yunfei_price'],
                'addtime' => time(),
                'uptime' => time()
                );
            $rst = M('goods_buy')->add($data);
            if($rst){
                $this->pics_deal($rst);
                echo json_encode(array('code' => 1,'msg' => '产品信息添加成功'));exit;
            }else{
                echo json_encode(array('code' => 0,'msg' => '产品信息添加失败'));exit;
            }
        }else{
            $this->display();
        }
     	
     }

     //购物专区产品列表的显示
     public function editGoodsBuy(){
        if(IS_AJAX){
            $post = I('post.');
            $data = array(
                'id' => $post['goods_id'],
                'goods_title' => $post['goods_title'],
                'goods_detail' => $_POST['goods_detail'],
                'goods_price' => $post['goods_price'],
                'goods_yunfei' => $post['yunfei_price'],
                'uptime' => time()
                );
            $this->pics_deal($post['goods_id']);
            $rst = M('goods_buy')->save($data);
            if($rst !== false){
                echo json_encode(array('code' => 1,'msg' => '产品信息编辑成功'));exit;
            }
                echo json_encode(array('code' => 0,'msg' => '产品信息编辑失败'));exit;
        }else{
            $aid = $_GET['aid'];
            $goodsOne = M('goods_buy')->where(array('id' => $aid))->find();
            $pics = M('goods_buypic')->where(array('goods_buy_id' => $aid))->select();
            $this->assign('goods_buy_pic', $pics);
            $this->assign('goodsOne', $goodsOne);
            $this->display();
        }
        
     }
     //显示产品详情
     public function goods_ListOne(){
        $detail = M('goods_buy')->field('goods_detail,id')->where(array('id' => $_GET['id']))->find();
        $goods_buy_pic = M('goods_buypic')->where(array('goods_buy_id' => $detail['id']))->select();
        $this->assign('goods_buy_pic', $goods_buy_pic);
        $this->assign('detail', $detail);
        $this->display();
     }
     public function goods_BuyDel(){
        $pics = M('goods_buypic')->where(array('id' => $_GET['aid']))->find();
            foreach ($pics as $key => $value) {
                unlink($value['goods_buy_pic']);
            }
        M('goods_buypic')->where(array('goods_buy_id' => $_GET['aid']))->delete();
        $rst = M('goods_buy')->where(array('id' => $_GET['aid']))->delete();
        if($rst){
            echo json_encode(array('code' => 1,'msg' => '产品信息删除成功'));exit;
        }
     }
      //处理相册
    private function pics_deal($goods_id){
        //判断是否有上传相册，遍历error的信息即可，只有有一个为"0"
        //就给做上传处理
        $up_pics = false;
        foreach($_FILES['goods_logo']['error'] as $k => $v){
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
            
            //$_FILES: logo_tu和goods_logo两部分附件
            //upload(array('pics_tu'=>array(name=>123,error=>,tmp_name=>,size=>,type=>)))
            //多图片上传
            $z = $up -> upload(array('goods_logo'=>$_FILES['goods_logo']));
            //遍历$z,并制作缩略图，完成sp_goods_pics数据表的记录填充
            $arr = array();
            foreach($z as $m => $n){
                //小图：50*50  中图:350*350  大图:800*800
                // $im = new \Think\Image();
                $goods_logo = $up->rootPath.$n['savepath'].$n['savename'];
                $arr['goods_buy_id'] = $goods_id;
                $arr['goods_buy_pic'] = $goods_logo;
                D('goods_buypic')->add($arr);
            }
        }

    }
    public function delPics(){
        $pics_id = I('get.pics_id');
        $picsinfo = D('goods_buypic')->find($pics_id);
        //① 删除物理图片
        unlink($picsinfo['shop_pic']);
        //② 删除记录信息
        D('goods_buypic')->delete($pics_id);
    }
}