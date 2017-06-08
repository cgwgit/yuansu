<?php
namespace Admin\Controller;
use Think\Controller;
class ShopController extends Controller {
		public function _initialize() {
        if ($_SESSION['manager_name'] == NULL) {
            $this->success('请先登陆', U('Admin/Manager/login'));
            exit();
        }
     } 

          	//显示门店列表
	public function shopList(){
		if($aid = I('get.aid')){
            $shopinfo = M('shop')->where(array('shop_id' => $aid))->find();
			$shop_pic = M('shop_pic')->where(array('shop_id' => $aid))->select();
			$this->assign('shop_pic', $shop_pic);
			$this->assign('shopinfo', $shopinfo);
            $this->display('showOne');exit;
		}
		$model = M('shop');
        if(!empty($_POST['shop_name'])){
            $title['shop_name']= array('LIKE','%'.$_POST['shop_name'].'%');
            $title['shop_position']= array('LIKE','%'.$_POST['shop_name'].'%');
            $title['_logic'] = 'or';
            $where['_complex'] = $title;
        }
		$count = $model->where($where)->count();
        $Page = new \Think\Page($count,10);
        $Page -> setConfig('prev','上一页');
		$Page -> setConfig('next','下一页');
		$Page -> setConfig('first','首页');
		$Page -> setConfig('last','末页');
		$Page -> lastSuffix = false;	//将末页从数字的显示方式切换成汉字提示
        $show = $Page->show();
        $list = $model->where($where)->order('shop_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('shop', $list);
		$this->assign('page', $show);
		$this->display();
	}
		//添加门店
	public function addShop(){
		if(IS_AJAX){
			$post = I('post.');
			!empty($post['shop_Name']) ? $shop_Name = trim($post['shop_Name']) : $this->err('请填写门店名称');
			!empty($post['shop_Position']) ? $shop_Position = trim($post['shop_Position']) : $this->err('请填写门店地址');
            !empty($post['lonlat']) ? $lonlat = trim($post['lonlat']) : $this->err('请选择所属位置');
            !empty($post['shop_Stime']) ? $shop_Stime = trim($post['shop_Stime']) : $this->err('请填写门店开始营业时间');
            !empty($post['shop_Etime']) ? $shop_Etime = trim($post['shop_Etime']) : $this->err('请填写门店结束营业时间');
            $shop_logo = $this->logo_deal();
			$data = array(
                    'shop_name' => $shop_Name ,
                    'shop_position' => $shop_Position,
                    'shop_tel' => '',
                    'shop_jing' => $post['lonlat'],
                    'shop_wei' => $post['lonlat2'],
                    'shop_stime' => $post['shop_Stime'],
                    'shop_etime' => $post['shop_Etime'],
                    'shop_tuijian' => $post['shop_Tuijian'],
                    'shop_tese' => $post['shop_Tese'],
                    'shop_logo' => $shop_logo,
                    'shop_addtime' => time(),
                    'shop_uptime' => time(),
				);
			  $id = M('shop')->add($data);
			  if($id){
			  	$this->pics_deal($id);
			  	echo json_encode(array('code' => 1,'msg' => '门店信息添加成功'));exit;
			  }else{
			  	echo json_encode(array('code' => 0,'msg' => '添加失败'));exit;
			  }
		}else{
			$this->display();
		}
		
	}
	//编辑门店
	public function editShop(){
		$aid = I('get.shop_id');
		if(IS_POST){
			$post = I('post.');
			!empty($post['shop_Name']) ? $shop_Name = trim($post['shop_Name']) : $this->err('请填写门店名称');
			!empty($post['shop_Position']) ? $shop_Position = trim($post['shop_Position']) : $this->err('请填写门店地址');
            !empty($post['lonlat']) ? $lonlat = trim($post['lonlat']) : $this->err('请选择所属位置');
            !empty($post['shop_Stime']) ? $shop_Stime = trim($post['shop_Stime']) : $this->err('请填写门店开始营业时间');
            !empty($post['shop_Etime']) ? $shop_Etime = trim($post['shop_Etime']) : $this->err('请填写门店结束营业时间');
            $shop_logo = $this->logo_deal($post['shop_id'],$post);
			$data = array(
				    'shop_id' => $post['shop_id'],
                    'shop_name' => $shop_Name ,
                    'shop_position' => $shop_Position,
                    'shop_tel' => '',
                    'shop_jing' => $post['lonlat'],
                    'shop_wei' => $post['lonlat2'],
                    'shop_stime' => $post['shop_Stime'],
                    'shop_etime' => $post['shop_Etime'],
                    'shop_tuijian' => $post['shop_Tuijian'],
                    'shop_tese' => $post['shop_Tese'],
                    'shop_logo' => $shop_logo,
                    'shop_addtime' => time(),
                    'shop_uptime' => time(),
				);
			$this->pics_deal($post['shop_id']);
			$rst = M('shop')->save($data);
			if($rst !== false){
				echo json_encode(array('code' => 1,'msg' => '门店编辑成功'));exit;
			}
				echo json_encode(array('code' => 0,'msg' => '门店编辑失败'));exit;
		}else{
			$shopinfo = M('shop')->where(array('shop_id' => $aid))->find();
			$shop_pic = M('shop_pic')->where(array('shop_id' => $aid))->select();
			$this->assign('shop_pic', $shop_pic);
			$this->assign('shopinfo', $shopinfo);
			$this->display();
		}
		
	}

	public function delShop(){
         $aid = I('get.aid');
        if(is_numeric($aid)){
            //删除单个活动
            $shop = M('shop_pic')->where(array('shop_id' => $aid))->select();
            foreach ($shop as $key => $value) {
            	unlink($value['shop_pic']);
            }
            $delshop = M('shop')->where(array('shop_id' => $aid))->delete();
            $delshop_pic = M('shop_pic')->where(array('shop_id' => $aid))->delete();
            if($delshop || $delshop_pic){
            	echo json_encode(array('code' => 1));exit;
            }
        }else{
            //删除多个活动
            $wh['shop_id'] = array('in', $aid); 
            $shops = M('shop_pic')->where($wh)->select();
            foreach ($shops as $key => $value) {
                unlink($value['shop_pic']);
            }
            $where['shop_id'] = array('in', $aid);
            $delshop = M('shop')->where($where)->delete();
            $delshop_pic = M('shop_pic')->where($where)->delete();
            if($delshop || $delshop_pic){
            	echo json_encode(array('code' => 1));exit;
            }
        }
    }
    //检查字段
	public function err($err){
      echo json_encode(array('code' => 0,'msg' => $err));exit;
    }

    //处理相册
    private function pics_deal($goods_id){
        //判断是否有上传相册，遍历error的信息即可，只有有一个为"0"
        //就给做上传处理
        $up_pics = false;
        foreach($_FILES['shop_pic']['error'] as $k => $v){
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
            
            //$_FILES: logo_tu和shop_pic两部分附件
            //upload(array('pics_tu'=>array(name=>123,error=>,tmp_name=>,size=>,type=>)))
            //多图片上传
            $z = $up -> upload(array('shop_pic'=>$_FILES['shop_pic']));
            //遍历$z,并制作缩略图，完成sp_goods_pics数据表的记录填充
            $arr = array();
            foreach($z as $m => $n){
                //小图：50*50  中图:350*350  大图:800*800
                // $im = new \Think\Image();
                $shop_pic = $up->rootPath.$n['savepath'].$n['savename'];
                $arr['shop_id'] = $goods_id;
                $arr['shop_pic'] = $shop_pic;
                D('shop_pic')->add($arr);
            }
        }

    }
    public function delPics(){
        $pics_id = I('get.pics_id');
        $picsinfo = D('shop_pic')->find($pics_id);
        //① 删除物理图片
        unlink($picsinfo['shop_pic']);
        //② 删除记录信息
        D('shop_pic')->delete($pics_id);
    }

        //参数：$data是引用传递,在内部对其进行修改，在外边仍然可以访问到
    private function logo_deal($id,$post){
        //判断有进行正常的附加上传
        if($_FILES['shop_logo']['error']===0){
            //判断是否是“更新”商品的logo处理
            //并删除旧的logo图片
            if(!empty($post['shop_id'])){
                $logo_info = D('shop')->
                    field('shop_logo')->
                    find($post['shop_id']);
                unlink($logo_info['shop_logo']);
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
            $z = $up -> uploadOne($_FILES['shop_logo']);
            //整理附件的路径 和 名字信息，存储到数据库指定字段里边
            $biglogoname = $up->rootPath.$z['savepath'].$z['savename'];
            return $data['shop_logo'] = $biglogoname;//存储到数据库
        }else{
            if($post){
                return $post['yuanshop_logo'];
            }else{
                M('shop')->where(array('shop_id' => $id))->delete();
                echo json_encode(array('code' => 0,'msg' => '请添加门店logo图片'));exit;
            }
            
        }
    }
    //门店收藏人数信息展示
    public function shoucangList(){
        $shop_id = $_GET['shop_id'];
        $Info = M('shop_shoucang')->join('sp_user on sp_user.user_id=sp_shop_shoucang.user_id')->where(array('shop_id' => $shop_id))->select();
        $this->assign('user', $Info);
        $this->display();
    }
 }