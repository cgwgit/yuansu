<?php
namespace Admin\Controller;
use Think\Controller;
class CategoryController extends Controller {
		public function _initialize() {
        if ($_SESSION['manager_name'] == NULL) {
            $this->success('请先登陆', U('Admin/Manager/login'));
            exit();
        }
     }  

     	//显示分类列表
	public function showList(){
		// if($aid = I('get.aid')){
  //          $category = M('category')->find($aid);
  //          $this->assign('categoryinfo', $category);
  //          $this->display('showOne');exit;
		// }
		$model = M('category');
		$count = $model->count();
        $Page = new \Think\Page($count,10);
        $Page -> setConfig('prev','上一页');
		$Page -> setConfig('next','下一页');
		$Page -> setConfig('first','首页');
		$Page -> setConfig('last','末页');
		$Page -> lastSuffix = false;	//将末页从数字的显示方式切换成汉字提示
        $show = $Page->show();
        $list = $model->order('cat_path')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('count', $count);
		$this->assign('category', $list);
		$this->assign('page', $show);
		$this->display();
	}
		//添加分类
	public function addCategory(){
		$aid = I('get.id');
		if(IS_AJAX){
			$post = I('post.');
			!empty($post['cat_name']) ? $cat_name = trim($post['cat_name']) : $err = '请填写分类名称';
            if($err){
            	echo json_encode(array('code' => 0,'msg' => $err));exit;
            }
            $data = array(
                'cat_name' => $cat_name,
                'cat_addtime' => time(),
                'cat_uptime' => time(),
                'cat_pid' => $post['cat_pid'],
                );
              $categoryModel = M('category'); 
			  $id = $categoryModel->add($data);
			  if($id){
                if($data['cat_pid']==0){
                    $path = $id;
                }else{
                //② 非顶级权限：全路径=父级全路径-本身主键id值
                    $ppath = $categoryModel->where(array('cat_id'=>$data['cat_pid']))->getField('cat_path');
                    $path = $ppath ."-". $id;
                }
                $level = substr_count($path,'-');
			  	$rst = $this->logo_deal($id);
			  	if($rst){
                    $arr = array(
                        'cat_id'=>$id,
                        'cat_level' => $level,
                        'cat_path'=>$path,
                        'cat_logo' => $rst
                        );
                    $rst1 = $categoryModel->save($arr);
                    if($rst1 !== false){
                        echo json_encode(array('code' => 1,'msg' => '分类添加成功','id'=>$aid));exit;
                    }
                    echo json_encode(array('code' => 0,'msg' => '分类添加失败','id'=>$aid));exit;
                }else{
                    echo json_encode(array('code' => 0,'msg' => '图片尺寸过大，请重新上传','id'=>$aid));exit;
                }
		}else{
            echo json_encode(array('code' => 0,'msg' => '分类添加失败','id'=>$aid));exit;
        }
	}else{
            $categorys = M('category')->where(array('cat_pid' => 0))->select();
            $this->assign('categorys', $categorys);
            $this->assign('id',$aid);
            $this->display();
        }
	}
	//编辑分类
	public function editCategory(){
		$cat_id = I('get.cat_id');
		if(IS_POST){   
			$post = I('post.');
			!empty($post['cat_name']) ? $cat_name = trim($post['cat_name']) : $err = '请填写分类名称';
            if($err){
            	echo json_encode(array('code' => 0,'msg' => $err));exit;
            }
             $data = array(
                'cat_name' => $cat_name,
                'cat_uptime' => time(),
                'cat_pid' => $post['cat_pid'],
                );
            $categoryModel = M('category'); 
			$rst = $categoryModel->where(array('cat_id' => $post['cat_id']))->save($data);
            if($rst !== false){
                if($data['cat_pid']==0){
                    $path = $post['cat_id'];
                }else{
                //② 非顶级权限：全路径=父级全路径-本身主键id值
                    $ppath = $categoryModel->where(array('cat_id'=>$data['cat_pid']))->getField('cat_path');
                    $path = $ppath ."-". $post['cat_id'];
                }
                $level = substr_count($path,'-');
			    $rst1 = $this->logo_deal($post['cat_id'] ,$post);
                if($rst1){
                     $arr = array(
                        'cat_id' => $post['cat_id'],
                        'cat_level' => $level,
                        'cat_path'=>$path,
                        'cat_logo' => $rst1
                        );
                     $rst2 = $categoryModel->save($arr);
                     if($rst2 !== false){
                        echo json_encode(array('code' => 1,'msg' => '分类添加成功'));exit;
                     }else{
                        echo json_encode(array('code' => 0,'msg' => '分类添加失败'));exit;
                     }
                }else{
                    echo json_encode(array('code' => 0,'msg' => '图片尺寸过大，请重新上传','id'=>$aid));exit;
                }
            }

			if($rst !== false && $rst1 !== false){
				echo json_encode(array('code' => 1,'msg' => '分类编辑成功'));exit;
			}
			   echo json_encode(array('code' => 0,'msg' => '分类编辑失败'));exit;
		}else{
			$categoryinfo = M('category')->where(array('cat_id' => $cat_id))->find();
			$categorys = M('category')->where(array('cat_pid' => 0))->select();
			$this->assign('categorys', $categorys);
			$this->assign('categoryinfo', $categoryinfo);
			$this->display();
		}
		
	}

    public function delCategory(){
         $aid = I('get.aid');
        if(is_numeric($aid)){
            //删除单个活动
            $category = M('category')->where(array('cat_id' => $aid))->find();
            unlink($category['cat_logo']);
            $rst = M('category')->where(array('cat_id' => $aid))->delete();
        }else{
            //删除多个活动
            $wh['cat_id'] = array('in', $aid); 
            $categorys = M('category')->where($wh)->select();
            foreach ($categorys as $key => $value) {
                unlink($value['cat_logo']);
            }
            $where['cat_id'] = array('in', $aid);
            $rst = M('category')->where($where)->delete();
        }
        if($rst){
            echo json_encode(array('code' => 1));exit;
        }else{
            echo json_encode(array('code' => 0));exit;
        }
    }

		//参数：$data是引用传递,在内部对其进行修改，在外边仍然可以访问到
    private function logo_deal($id,$post){
        //判断有进行正常的附加上传
        if($_FILES['pic']['error']===0){
            //判断是否是“更新”商品的logo处理
            //并删除旧的logo图片
            if(!empty($post['cat_id'])){
                $logo_info = D('category')->
                    field('cat_logo')->
                    find($post['cat_id']);
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
            $z = $up -> uploadOne($_FILES['pic']);

            //整理附件的路径 和 名字信息，存储到数据库指定字段里边
            $biglogoname = $up->rootPath.$z['savepath'].$z['savename'];
            return $data['cat_logo'] = $biglogoname;//存储到数据库
            //B.缩略图logo处理，具体通过\Think\Image.class.php实现
            // $im = new \Think\Image();
            // $im -> open($biglogoname); //找到大图
            // $im -> thumb(750,440,1);//制作缩略图
            //存储制作好的缩略图(事先声明好缩略图的路径名)
            //./Public/Upload/2016-03-29/56f9e9c66664f.jpg
            //./Public/Upload/2016-03-29/s_56f9e9c66664f.jpg
            // $smalllogoname = $up->rootPath.$z['savepath']."s_".$z['savename'];
            // $im -> save($smalllogoname);
            // $data['smallpic'] = $smalllogoname; //存储到数据库
            // $data['cat_id'] = $id;
            // return M('category')->save($data);exit;
        }else{
        	if($post){
        		return $post['yuanpic'];
        	}else{
                M('category')->where(array('cat_id' => $id))->delete();
        		echo json_encode(array('code' => 0,'msg' => '请添加分类logo图片'));exit;
        	}
        	
        }
    }

        //得到下级的分类信息
    public function getCatInfoB(){
        $cat_id = $_GET['cat_ida'];
        $categoryB = M('category')->where(array('cat_pid' => $cat_id))->select();
        if($categoryB){
            echo json_encode($categoryB);exit;
        }
    }
}