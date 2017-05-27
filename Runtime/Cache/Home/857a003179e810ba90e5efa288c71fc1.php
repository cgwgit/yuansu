<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cmn-Hans">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>居元素门店导航</title>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=wDYEcxgRRheZwyC9jpN1Tt7fzr2zjosZ"></script>  
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script><!--调用jQuery-->

  <style type="text/css">
        body, html,#allmap {width: 100%;height: 100%;overflow: hidden;margin:0;font-family:"微软雅黑";}
    </style> 

</head>
<body>  
   <div id="allmap"></div>
</body>  
</html>  
<script type="text/javascript">  
    var shop_jing = <?php echo ($shopInfo['shop_jing']); ?>;
    var shop_wei = <?php echo ($shopInfo['shop_wei']); ?>;
    var shop_position = "<?php echo ($shopInfo['shop_position']); ?>";
    var map = new BMap.Map("allmap");  
    var point = new BMap.Point(shop_jing,shop_wei);
    map.centerAndZoom(point, 16);  
    map.enableScrollWheelZoom(); 
    var myIcon = new BMap.Icon("myicon.png",new BMap.Size(30,30),{
        anchor: new BMap.Size(10,10)    
    });
    var marker=new BMap.Marker(point,{icon: myIcon});  
    map.addOverlay(marker);  
    var geolocation = new BMap.Geolocation();
    geolocation.getCurrentPosition(function(r){
        if(this.getStatus() == BMAP_STATUS_SUCCESS){
            var mk = new BMap.Marker(r.point);
            map.addOverlay(mk);
            //map.panTo(r.point);//地图中心点移到当前位置
            var latCurrent = r.point.lat;
            var lngCurrent = r.point.lng;
            //alert('我的位置：'+ latCurrent + ',' + lngCurrent);
            location.href="http://api.map.baidu.com/direction?origin="+latCurrent+","+lngCurrent+"&destination="+shop_wei+","+shop_jing+"&mode=driving&region="+shop_position+"&output=html";
        }
        else {
            alert('failed'+this.getStatus());
        }        
    },{enableHighAccuracy: true})
</script>