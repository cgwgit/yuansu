<?php
namespace Home\Model;
use Think\Model;
class WechatModel extends Model {
	private $_token = ''; //令牌
    private $appid;
    private $appsecret;

    public function __construct()
    {
        $this->appid = C('APPID');//公众号的appid
        $this->appsecret = C('APPSECRET');//公众号的秘钥
    }
    //调用js-sdk的签名包
    public function getSignPackage() {
	    $jsapiTicket = $this->getJsApiTicket();
	    // 注意 URL 一定要动态获取，不能 hardcode.（获取当前网页的url）
	    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	    $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	    //时间戳
	    $timestamp = time();
	    //随机字符串获取
	    $nonceStr = $this->createNonceStr();
	    // 这里参数的顺序要按照 key 值 ASCII 码升序排序
	    $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
	    //生成字符串是用来签名用的
	    $signature = sha1($string);
	    $signPackage = array(
	      "appId"     => $this->appid,
	      "nonceStr"  => $nonceStr,
	      "timestamp" => $timestamp,
	      "url"       => $url,
	      "signature" => $signature,
	      "rawString" => $string
	    );
	    return $signPackage; 
  }
  //使用会员卡领取的签名包
  public function getHuiYuanSignPackage() {
	    $apiTicket = $this->getApiTicket();
	    // 注意 URL 一定要动态获取，不能 hardcode.（获取当前网页的url）
	    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	    $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	    //时间戳
	    $timestamp = time();
	    //随机字符串获取
	    // $nonceStr = $this->createNonceStr();
	    // 这里参数的顺序要按照 key 值 ASCII 码升序排序
	    $string = $timestamp.$apiTicket."pVYA_t3RCVF_yhNcO6QCeAmb-1UI";
	    //生成字符串是用来签名用的
	    $signature = sha1($string);
	    $signPackage = array(
	      "timestamp" => $timestamp,
	      "signature" => $signature,
	    );
	    return $signPackage; 
  }
  //获取会员卡的api_ticket
  public function getApiTicket(){
  	$data = json_decode(file_get_contents("api_ticket.json"));
    if ($data->expire_time < time()) {
      $accessToken = $this->getAccessToken();
      $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=wx_card&access_token=$accessToken";
      $res = json_decode($this->httpGet($url));
      $ticket = $res->ticket;
      if ($ticket) {
        $data->expire_time = time() + 7000;
        $data->jsapi_ticket = $ticket;
        $fp = fopen("api_ticket.json", "w");
        fwrite($fp, json_encode($data));
        fclose($fp);
      }
    } else {
      $ticket = $data->jsapi_ticket;
    }
    return $ticket;
  }
  //获取随机字符串
  private function createNonceStr($length = 16) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
      $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
  }
    //获取Access Token
    public function getAccessToken(){
    	//将json字符串转换为json对象
	    $data = json_decode(file_get_contents("access_token.json"));
	    if ($data->expire_time < time()) {
	      // 如果是企业号用以下URL获取access_token
	      $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appid&secret=$this->appsecret";
	      $res = json_decode($this->httpGet($url));
	      $access_token = $res->access_token;
		  if ($access_token) {
		        $data->expire_time = time() + 7000;
		        $data->access_token = $access_token;
		        $fp = fopen("access_token.json", "w");
		        fwrite($fp, json_encode($data));
		        fclose($fp);
		   }
	    } else {
	      $access_token = $data->access_token;
	    }
	    return $access_token;
	    }
  //获取jsapi_ticket(jsapi_ticket是公众号用于调用微信JS接口的临时票据)
   private function getJsApiTicket() {
    // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
    $data = json_decode(file_get_contents("jsapi_ticket.json"));
    if ($data->expire_time < time()) {
      $accessToken = $this->getAccessToken();
      // 如果是企业号用以下 URL 获取 ticket
      // $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";
      $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
      $res = json_decode($this->httpGet($url));
      $ticket = $res->ticket;
      if ($ticket) {
        $data->expire_time = time() + 7000;
        $data->jsapi_ticket = $ticket;
        $fp = fopen("jsapi_ticket.json", "w");
        fwrite($fp, json_encode($data));
        fclose($fp);
      }
    } else {
      $ticket = $data->jsapi_ticket;
    }
    return $ticket;
  }
    //获取用户的openid
    public function openId(){
    	$url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; 
	        if (!isset($_GET['code'])) {
	        	//获取组装的url
	            $openidUrl = $this->snsapi_base($url);
	            redirect($openidUrl);
	        }else{
	            $openidAccess_token = $this->openidAccess_token($_GET['code']);
	            return $openidAccess_token;
	        }
    }
     //获取微信用户的opnid
    public function getOpenId($openid,$access_token)
	    {
	        $userInfo = $this->getUserInfo($openid,$access_token);
	         return $userInfo;
	    }

     public function snsapi_base($redirect_uri, $scope = "snsapi_userinfo", $state = 0)
	    {
	        $appId = $this->appid;
	        $url = "https://open.weixin.qq.com/connect/oauth2/authorize";
	        $url .= "?appid=$appId";
	        $url .= "&redirect_uri=http://$redirect_uri";
	        $url .= "&response_type=code";
	        $url .= "&scope=$scope";
	        $url .= "&state=$state#wechat_redirect";
	        return $url;
	    }

	public function openidAccess_token($code){
        $appId = $this->appid;
        $appSecret= $this->appsecret;
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appId&secret=$appSecret&code=$code&grant_type=authorization_code";
        return json_decode($this->httpGet($url),true);
    }
    //获取用户信息
    public function getUserInfo($openid, $access_token){
    	 $url = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN ";
        return json_decode($this->httpGet($url),true);
      //请求
    }
	private function httpGet($url) {
	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	    curl_setopt($curl, CURLOPT_URL, $url);
	    $res = curl_exec($curl);
	    curl_close($curl);
	    return $res;
  }
}