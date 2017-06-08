<?php
namespace Home\Controller;
use Think\Controller;
class GoodsBuyController extends Controller {
	private $parameters;
	public $orderid = null;
	private $makesign = 'juyuansuqingdao88888123456789012'; 
	//抢购页面
	public function index(){
    $user_id = session('user_id');
    if($user_id){
      //获取购买商品的信息
  		$goods_buy = M('goods_buy')->where(array('id' => $_GET['id']))->find();
      //图集信息
      $pics = M('goods_buypic')->where(array('goods_buy_id' => $_GET['id']))->select();
    }else{
      //判断该用户是否存在
       $model = new \Home\Model\WechatModel();
       $openid_accesstoken = $model->openId();
       $rst = M('user')->where(array('user_openid' => $openid_accesstoken['openid']))->find();
       if($rst){
          session('openid',$openid_accesstoken['openid']);
          session('user_id', $rst['user_id']);
          //获取购买商品的信息
        $goods_buy = M('goods_buy')->where(array('id' => $_GET['id']))->find();
        //图集信息
        $pics = M('goods_buypic')->where(array('goods_buy_id' => $_GET['id']))->select();
       }else{
           $userInfo = $model->getOpenId($openid_accesstoken['openid'],$openid_accesstoken['access_token']);
            $data = array(
              'user_img' => $userInfo['headimgurl'],
              'user_openid' => $userInfo['openid'],
              'user_name' => filter($userInfo['nickname']),
              'user_register_time' => time(),
              'city' => $userInfo['province'].'-'.$userInfo['city'],
            );
          $id = M('user')->add($data);
          session('openid', $userInfo['openid']);
          session('user_id',$id);
          $goods_buy = M('goods_buy')->where(array('id' => $_GET['id']))->find();
        //图集信息
         $pics = M('goods_buypic')->where(array('goods_buy_id' => $_GET['id']))->select();
       }
    }
    $this->assign('pics', $pics);
		$this->assign('goods_buy', $goods_buy);
		$this->display();
	}
	//填写地址的页面
	public function newAddr(){
		if(IS_POST){
             $post = I('post.');
             $data = array(
                'goods_buy_id' => $post['goods_id'],
                'user_id' => session('user_id'),
                'order_bianhao' => $this->randomkeys(),
                'order_name' => $post['order_Name'],
                'tel' => $post['order_tel'],
                'area' => $post['order_Area'],
                'area_detail' => $post['order_AreaDetail'],
                'order_status' => '0',
                'order_price' => $post['order_Price'],
                'order_time' => time()
             	);
            $rst = M('goods_order')->add($data);
            if($rst){
            	//添加成功之后跳到付款的页面
            	$this->redirect('GoodsBuy/pay', array('order_id' => $rst));
            }
		}else{
      $goods = M('goods_buy')->where(array('id' => $_GET['id']))->find();
      if($goods['goods_yunfei'] != 0){
        $goods['goods_price'] = $goods['goods_price']+ $goods['goods_yunfei'];
      }
      $this->assign('goods', $goods);
			$this->assign('goods_id', $_GET['id']);
			$this->display();
		}
	}
	//付款成功后的显示页面
	public function pay_success(){
      $this->display();
	}
    //付款页面
    public function pay(){
    	//获取订单信息
        $order_Info = M('goods_order')->where(array('order_id' => $_GET['order_id']))->find();
      #支付前的数据配置
        //配置参数并发起微信请求（返回微信请求的数组）
        $conf = $this->payconfig($order_Info['order_bianhao'],$order_Info['order_price'] * 100, '支付订单号-'.$order_Info['order_bianhao']);//微信支付金额*100
        if (!$conf || $conf['return_code'] == 'FAIL') exit("<script>alert('对不起，微信支付接口调用错误!" . $conf['return_msg'] . "');history.go(-1);</script>");
        $this->orderid = $conf['prepay_id'];//预付款id
        //生成页面调用参数
        $jsApiObj["appId"] = $conf['appid'];//appid
        $timeStamp = time();
        $jsApiObj["timeStamp"] = "$timeStamp";//时间戳
        $jsApiObj["nonceStr"] = $this->createNoncestr();//生成随机字符串
        $jsApiObj["package"] = "prepay_id=" . $conf['prepay_id'];
        $jsApiObj["signType"] = "MD5";
        $jsApiObj["paySign"] = $this->MakeSign($jsApiObj);//生成支付签名
      $this->parameters  = json_encode($jsApiObj);//这个数据发送到 模板文件


      
      $this->assign('parameters', $this->parameters);
      $this->assign('order_Info', $order_Info);
      $this->display();
    }
	 #微信JS支付参数获取#
    protected function payconfig($no, $fee, $body)
    {   $dsUser = session('dsUser');
        $url = "https://api.mch.weixin.qq.com/pay/unifiedorder";
        $data['appid'] = C('APPID');
        $data['mch_id'] = C('mchid');           //商户号
        $data['device_info'] = 'WEB';
        $data['body'] = $body;
        //订单号
        $data['out_trade_no'] = $no;               //订单号
        $data['total_fee'] = $fee;               //金额
        $data['spbill_create_ip'] = $_SERVER["REMOTE_ADDR"];  //ip地址
        $data['notify_url'] = SITE_URL.'index.php/Home/GoodsBuy/notify_url/';//这里的回调地址不正确
        $data['trade_type'] = 'JSAPI';//调用微信发起支付
        $data['openid'] = session('openid');   //获取保存用户的openid
        $data['nonce_str'] = $this->createNoncestr();//产生随机字符串
        $data['sign'] = $this->MakeSign($data);//签名
        //print_r($data);
        $xml = $this->ToXml($data);//生成xml数据
        $curl = curl_init(); // 启动一个CURL会话
        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        //设置header
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
        //要求结果为字符串且输出到屏幕上
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_POST, TRUE); // 发送一个常规的Post请求
        curl_setopt($curl, CURLOPT_POSTFIELDS, $xml); // Post提交的数据包
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
        $tmpInfo = curl_exec($curl); // 执行操作
        curl_close($curl); // 关闭CURL会话
        $arr = $this->FromXml($tmpInfo);//将返回的xml数据转化为数组
        return $arr;
    }

        //微信支付回调
    public function notify_url(){
       $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
       $array = $this->FromXml($xml);
       if($array['result_code'] == 'SUCCESS'){
        $rst = M('goods_order')->where(array('order_bianhao' => $array['out_trade_no']))->save(array('order_status' => '1'));
        if($rst !== false){
          echo "success";exit;
        }
       }
    }

    /**
     *    作用：产生随机字符串，不长于32位
     */
    public function createNoncestr($length = 32)
    {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    /**
     *    作用：产生随机字符串，不长于32位
     */
    public function randomkeys()
    {
         return mt_rand(10,99)
              . sprintf('%010d',time() - 946656000)
              . sprintf('%03d', (float) microtime() * 1000)
              . sprintf('%03d', (int) $_SESSION['member_id'] % 1000);
    }

    /**
     * 将xml转为array
     * @param string $xml
     * @throws WxPayException
     */
    public function FromXml($xml)
    {
        //将XML转为array
        return json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    }

    /**
     * 输出xml字符
     * @throws WxPayException
     **/
    public function ToXml($arr)
    {
        $xml = "<xml>";
        foreach ($arr as $key => $val) {
            if (is_numeric($val)) {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
            } else {
                $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
            }
        }
        $xml .= "</xml>";
        return $xml;
    }

    /**
     * 生成签名
     * @return 签名，本函数不覆盖sign成员变量，如要设置签名需要调用SetSign方法赋值
     */
    protected function MakeSign($arr)
    {
        //签名步骤一：按字典序排序参数
        ksort($arr);
        $string = $this->ToUrlParams($arr);
        //签名步骤二：在string后加入KEY
        $string = $string . "&key=" . $this->makesign;
        //签名步骤三：MD5加密
        $string = md5($string);
        //签名步骤四：所有字符转为大写
        $result = strtoupper($string);
        return $result;
    }

    /**
     * 格式化参数格式化成url参数
     */
    protected function ToUrlParams($arr)
    {
        $buff = "";
        foreach ($arr as $k => $v) {
            if ($k != "sign" && $v != "" && !is_array($v)) {
                $buff .= $k . "=" . $v . "&";
            }
        }

        $buff = trim($buff, "&");
        return $buff;
    }
}