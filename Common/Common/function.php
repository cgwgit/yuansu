<?php
/**
 * 公用方法
 * User: TDSA
 * Date: 2016/11/3
 * Time: 13:21
 */
//使用htmlpurifier实现防止xss攻击
function fanXSS($string){
    require_once './Common/Plugin/htmlpurifier/HTMLPurifier.auto.php';
    // 生成配置对象
    $cfg = HTMLPurifier_Config::createDefault();
    // 以下就是配置：
    $cfg->set('Core.Encoding', 'UTF-8');
    // 设置允许使用的HTML标签
    $cfg->set('HTML.Allowed','div,b,strong,i,em,a[href|title],ul,ol,li,br,span[style],img[width|height|alt|src]');
    // 设置允许出现的CSS样式属性
    $cfg->set('CSS.AllowedProperties', 'font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align');
    // 设置a标签上是否允许使用target="_blank"
    $cfg->set('HTML.TargetBlank', TRUE);
    // 使用配置生成过滤用的对象
    $obj = new HTMLPurifier($cfg);
    // 过滤字符串
    return $obj->purify($string);
}
function show($status, $message, $data=array()){
    $reuslt = array(
        'status'=>$status,
        'message'=>$message,
        'data'=>$data
    );
    exit(json_encode($reuslt));
}

function getMd5Password($admin_password){
    return md5($admin_password.C('MD5_PRE'));
}

function getLogisticsTypeFind($id){
    return D('LogisticsType')->getLogisticsTypeFind($id);
}

function findLinkageById($id,$table,$field){
    $LinkageField = M($table)->where('Id='.$id)->find();
    return $LinkageField[$field];
}

function getStatus($status,$statusText){
    if($status == 0){
        $audit = $statusText[0];
    }elseif ($status == 1){
        $audit = $statusText[1];
    }elseif($status == -1){
        $audit = $statusText[2];
    }else{
        $audit = $statusText[3];
    }
    return $audit;
}

/**
 *   生成10位绝不重复订单号
 */
function order_number(){
    static $ORDERSN=array();                                        //静态变量
    $ors=date('ymd').substr(time(),-5).substr(microtime(),2,5);     //生成16位数字基本号
    if (isset($ORDERSN[$ors])) {                                    //判断是否有基本订单号
        $ORDERSN[$ors]++;                                           //如果存在,将值自增1
    }else{
        $ORDERSN[$ors]=1;
    }
    return $ors.str_pad($ORDERSN[$ors],2,'0',STR_PAD_LEFT);     //链接字符串
}



//十进制转换三十六进制
function inviteCode($int, $format = 8) {
    $dic = array(
        0 => '0', 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9',
        10 => 'A', 11 => 'B', 12 => 'C', 13 => 'D', 14 => 'E', 15 => 'F', 16 => 'G', 17 => 'H', 18 => 'I',
        19 => 'J', 20 => 'K', 21 => 'L', 22 => 'M', 23 => 'N', 24 => 'O', 25 => 'P', 26 => 'Q', 27 => 'R',
        28 => 'S', 29 => 'T', 30 => 'U', 31 => 'V', 32 => 'W', 33 => 'X', 34 => 'Y', 35 => 'Z'
    );
    $arr = array();
    $loop = true;
    while ($loop)
    {
        $arr[] = $dic[bcmod($int, 36)];
        $int = floor(bcdiv($int, 36));
        if ($int == 0) {
            $loop = false;
        }
    }
    array_pad($arr, $format, $dic[0]);
    return implode('', array_reverse($arr));
}

////编辑器
function showKind($status,$data){
    header('Content-type:application/json;charset=UTF-8');
    if($status == 0){
        exit(json_encode(array('error'=>0,'url'=>$data)));
    }
    exit(json_encode(array('error'=>1,'url'=>'上传失败')));
}


/**
 * 使用：   
 * echo curlOpen('http://www.baidu.com');   
 *   
 * POST数据   
 * $post = array('aa'=>'ddd','ee'=>'d')   
 * 或   
 * $post = 'aa=ddd&ee=d';   
 * echo curlOpen('http://www.baidu.com',array('post'=>$post));   
 * @param string $url
 * @param array $config
 */
function curlOpen($url, $config = array())
{
    $arr = array('post' => false,'referer' => $url,'cookie' => '', 'useragent' => 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506; customie8)', 'timeout' => 20, 'return' => true, 'proxy' => '', 'userpwd' => '', 'nobody' => false,'header'=>array(),'gzip'=>true,'ssl'=>false,'isupfile'=>false);
    $arr = array_merge($arr, $config);
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, $arr['return']);
    curl_setopt($ch, CURLOPT_NOBODY, $arr['nobody']);  
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $arr['useragent']);
    curl_setopt($ch, CURLOPT_REFERER, $arr['referer']);
    curl_setopt($ch, CURLOPT_TIMEOUT, $arr['timeout']);
    //curl_setopt($ch, CURLOPT_HEADER, true);//获取header
    if($arr['gzip']) curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
    if($arr['ssl'])
    {
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    }
    if(!empty($arr['cookie']))
    {
        curl_setopt($ch, CURLOPT_COOKIEJAR, $arr['cookie']);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $arr['cookie']); 
    } 
    
    if(!empty($arr['proxy']))
    {
        //curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);  
        curl_setopt ($ch, CURLOPT_PROXY, $arr['proxy']);
        if(!empty($arr['userpwd']))
        {            
            curl_setopt($ch,CURLOPT_PROXYUSERPWD,$arr['userpwd']);
        }        
    }    
    
    //ip比较特殊，用键值表示
    if(!empty($arr['header']['ip']))
    {
        array_push($arr['header'],'X-FORWARDED-FOR:'.$arr['header']['ip'],'CLIENT-IP:'.$arr['header']['ip']);
        unset($arr['header']['ip']);
    }   
    $arr['header'] = array_filter($arr['header']);
    
    if(!empty($arr['header']))
    {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arr['header']); 
    }

    if ($arr['post'] != false)
    {
        curl_setopt($ch, CURLOPT_POST, true);
        if(is_array($arr['post']) && $arr['isupfile'] === false)
        {
            $post = http_build_query($arr['post']);            
        } 
        else
        {
            $post = $arr['post'];
        }
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }    
    $result = curl_exec($ch);
    curl_close($ch);
     
    return $result;
}
     // 尊敬的业务员，${name}已下单，货名${ming}吨,地址${addr},请处理
     //阿里大鱼短信调用方法
     function aliduanxin($tel,$plateNo,$name,$dizhi){
        $data = array(
            'name' => $plateNo,
            'ming' => $name,
            'addr' => $dizhi
            );
        $datas = json_encode($data);
        $alidayu = new \Think\Lib\Alidayu\SendMSM();
        $result = $alidayu->send($tel,$datas);
    }
  // 无限极分类
    function getTree($list,$pid=0,$level=0) {
    static $tree = array();
    foreach($list as $row) {
        if($row['cat_pid']==$pid) {
            $row['cat_level'] = $level;
            $tree[] = $row;
            getTree($list, $row['cat_id'], $level + 1);
        }
    }
    return $tree;
}
//过滤微信昵称中的表情符号
   function filter($str) {      
        if($str){ 
            $name = $str; 
            $name = preg_replace('/\xEE[\x80-\xBF][\x80-\xBF]|\xEF[\x81-\x83][\x80-\xBF]/', '', $name); 
            $name = preg_replace('/xE0[x80-x9F][x80-xBF]‘.‘|xED[xA0-xBF][x80-xBF]/S','?', $name); 
            $return = json_decode(preg_replace("#(\\\ud[0-9a-f]{3})#ie","",json_encode($name))); 
            if(!$return){ 
                return $this->jsonName($return); 
            } 
        }else{ 
            $return = ''; 
        }     
        return $return; 
 
}