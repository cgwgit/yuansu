/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : juyuansu

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2017-06-08 11:33:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sp_banner
-- ----------------------------
DROP TABLE IF EXISTS `sp_banner`;
CREATE TABLE `sp_banner` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `banner_name` varchar(50) NOT NULL DEFAULT '' COMMENT 'banner的名字',
  `bannerdizhi` varchar(1000) NOT NULL DEFAULT '' COMMENT 'banner链接地址',
  `banner_pic` varchar(100) NOT NULL DEFAULT '' COMMENT '首页banner图片',
  `banner_addtime` int(11) NOT NULL,
  `banner_uptime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sp_banner
-- ----------------------------
INSERT INTO `sp_banner` VALUES ('2', '首页展示2', 'http://166xj71935.51mypc.cn/index.php/Home/Index/goods_detail/goods_id/10', './Public/Upload/2017-06-01/592f7edd2ab30.jpg', '1496282148', '1496284893');
INSERT INTO `sp_banner` VALUES ('6', '首页展示2', 'http://166xj71935.51mypc.cn/index.php/Home/Index/goods_detail/goods_id/10', './Public/Upload/2017-06-02/59310d7a3e46c.jpg', '1496386938', '1496386965');
INSERT INTO `sp_banner` VALUES ('7', 'ssss', 'http://166xj71935.51mypc.cn/index.php/Home/Index/goods_detail/goods_id/10', './Public/Upload/2017-06-07/59375d4882c74.jpg', '1496800584', '1496800613');
INSERT INTO `sp_banner` VALUES ('8', '测试', 'https://mp.weixin.qq.com/s?__biz=MzA3NDM5MjE0OQ==&amp;tempkey=P45nybPDOeSGoKBWs4YJn3rq%2FRRDmMBUHdGFrt6LlEgjmG7qOCVwwBUmMeGW0mM8mPsbbpAMS2BXxHpjuO%2FMiWxDK65hIwHFOMVesML6GSlcqY0mdRbCxRnbIjtmNBd3H0yePMBKeuqUV70yt2cejw%3D%3D&amp;chksm=070fb03030783926a22d80587f157792a1010122c709a76d2723de09bc3eb3906e22caa4c858#rd', './Public/Upload/2017-06-07/5937e249382b5.jpg', '1496834633', '1496834633');

-- ----------------------------
-- Table structure for sp_category
-- ----------------------------
DROP TABLE IF EXISTS `sp_category`;
CREATE TABLE `sp_category` (
  `cat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(100) NOT NULL DEFAULT '' COMMENT '分类名字',
  `cat_pid` int(11) NOT NULL,
  `cat_path` varchar(10) NOT NULL DEFAULT '' COMMENT '分类路径',
  `cat_level` tinyint(4) NOT NULL DEFAULT '0',
  `cat_logo` varchar(100) NOT NULL DEFAULT '' COMMENT '分类logo',
  `cat_addtime` int(11) NOT NULL COMMENT '添加时间',
  `cat_uptime` int(11) DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sp_category
-- ----------------------------
INSERT INTO `sp_category` VALUES ('34', '厨', '0', '34', '0', './Public/Upload/2017-06-01/592fa28e6e937.jpg', '1495244871', '1496294029');
INSERT INTO `sp_category` VALUES ('35', '酿', '0', '35', '0', './Public/Upload/2017-06-01/592fa2ae3c567.jpg', '1495244975', '1496294061');
INSERT INTO `sp_category` VALUES ('37', '液体调味系列', '34', '34-37', '1', './Public/Upload/2017-06-01/592fa53d42925.jpg', '1495245064', '1496294716');
INSERT INTO `sp_category` VALUES ('38', '液体酝酿系列', '35', '35-38', '1', './Public/Upload/2017-06-01/592fa56d3baea.jpg', '1495246741', '1496294764');
INSERT INTO `sp_category` VALUES ('40', '储酿腌泡系列', '35', '35-40', '1', './Public/Upload/2017-06-01/592fa57f8f4ca.jpg', '1495246766', '1496805372');
INSERT INTO `sp_category` VALUES ('41', '饮', '0', '41', '0', './Public/Upload/2017-06-07/59375733c4cc1.jpg', '1495246803', '1496799026');
INSERT INTO `sp_category` VALUES ('42', '居', '0', '42', '0', './Public/Upload/2017-06-07/5937576607eee.jpg', '1495246822', '1496805571');
INSERT INTO `sp_category` VALUES ('43', '厨房用具', '41', '41-43', '1', './Public/Upload/2017-06-07/5937574e20a0a.jpg', '1495246843', '1496799053');
INSERT INTO `sp_category` VALUES ('44', '调味系列', '34', '34-44', '1', './Public/Upload/2017-06-01/592fa5539e4e0.jpg', '1495525874', '1496294738');
INSERT INTO `sp_category` VALUES ('47', '烹饪器皿系列', '34', '34-47', '1', './Public/Upload/2017-06-07/59376f86a8d93.jpg', '1496805253', '1496805253');
INSERT INTO `sp_category` VALUES ('48', '固体调料系列', '34', '34-48', '1', './Public/Upload/2017-06-07/59376fc05e563.jpg', '1496805311', '1496805311');
INSERT INTO `sp_category` VALUES ('49', '水杯水具系列', '41', '41-49', '1', './Public/Upload/2017-06-07/59377010c9042.jpg', '1496805391', '1496805391');
INSERT INTO `sp_category` VALUES ('50', '酒杯酒具系列', '41', '41-50', '1', './Public/Upload/2017-06-07/5937701f5dfb1.jpg', '1496805406', '1496805406');
INSERT INTO `sp_category` VALUES ('51', '咖啡茶具系列', '41', '41-51', '1', './Public/Upload/2017-06-07/5937703379aeb.jpg', '1496805426', '1496805426');
INSERT INTO `sp_category` VALUES ('52', '主题礼盒', '42', '42-52', '1', './Public/Upload/2017-06-07/5937704c7a11c.jpg', '1496805451', '1496805451');
INSERT INTO `sp_category` VALUES ('53', '餐桌用具系列', '42', '42-53', '1', './Public/Upload/2017-06-07/5937705ba131f.jpg', '1496805466', '1496805466');

-- ----------------------------
-- Table structure for sp_goods
-- ----------------------------
DROP TABLE IF EXISTS `sp_goods`;
CREATE TABLE `sp_goods` (
  `goods_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品主键id',
  `goods_name` varchar(100) NOT NULL COMMENT '商品名字',
  `goods_rongji` varchar(100) NOT NULL DEFAULT '' COMMENT '商品容积',
  `goods_color` varchar(50) NOT NULL DEFAULT '' COMMENT '商品颜色',
  `goods_tedian` varchar(100) NOT NULL DEFAULT '' COMMENT '商品特点',
  `goods_logo` varchar(100) NOT NULL DEFAULT '' COMMENT '商品logo',
  `cat_id` int(11) NOT NULL COMMENT '分类id',
  `goods_zhanshi` varchar(100) NOT NULL DEFAULT '' COMMENT '商品展示图片',
  `goods_addtime` int(11) NOT NULL COMMENT '商品添加时间',
  `goods_uptime` int(11) NOT NULL COMMENT '商品修改时间',
  `status` enum('1','0') NOT NULL DEFAULT '0' COMMENT '0不在首页展示1在首页展示',
  `goods_shoucang` int(11) NOT NULL DEFAULT '0' COMMENT '商品收藏人数',
  PRIMARY KEY (`goods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sp_goods
-- ----------------------------
INSERT INTO `sp_goods` VALUES ('9', '居元素产品测试', '100ml', '透明', '售房', './Public/Upload/2017-06-01/592fa5c434bc7.jpg', '38', './Public/Upload/2017-05-24/59254e134f595.jpg', '1495617043', '1496294852', '1', '1');
INSERT INTO `sp_goods` VALUES ('10', '居元素 喷砂', '300ml', '红色', '居元素 喷砂 酿酒器 储酿器 酵素罐', './Public/Upload/2017-06-01/592fd2cd4b417.png', '44', './Public/Upload/2017-05-27/592951eea597d.jpg', '1495880138', '1496452034', '1', '0');
INSERT INTO `sp_goods` VALUES ('11', '防守打法', '三个s', '感受感受', '公司给', './Public/Upload/2017-06-01/592fd28400941.png', '37', './Public/Upload/2017-05-27/59295ccd24c66.png', '1495882957', '1496306308', '1', '0');
INSERT INTO `sp_goods` VALUES ('17', '居元素烧杯', '200ml', '蓝色', '适合，好看，大方，得体', './Public/Upload/2017-06-01/592fa6022111b.jpg', '38', '', '1496216230', '1496294914', '1', '0');
INSERT INTO `sp_goods` VALUES ('18', '厨房下的用具', '200ml', '', '实用', './Public/Upload/2017-06-02/5931026000cbd.png', '37', '', '1496294986', '1496384096', '1', '0');
INSERT INTO `sp_goods` VALUES ('21', '居元素 喷砂', '居元素 喷砂', '蓝色', '居元素 喷砂', './Public/Upload/2017-06-01/592fd2b93bde6.png', '37', '', '1496302597', '1496452129', '0', '1');
INSERT INTO `sp_goods` VALUES ('22', '这是居分类下的系列', '200ml', '', '经济实用', './Public/Upload/2017-06-02/5930bb959beac.png', '43', '', '1496365973', '1496805520', '1', '0');
INSERT INTO `sp_goods` VALUES ('23', '居下的产品系列', '300ml', '', '经济适用', './Public/Upload/2017-06-02/5930bc65d395c.png', '43', '', '1496366181', '1496366181', '1', '0');
INSERT INTO `sp_goods` VALUES ('24', '居下面的产品', '300ml', '', '蓝色', './Public/Upload/2017-06-02/5930bccacdc6e.png', '43', '', '1496366282', '1496366282', '1', '0');
INSERT INTO `sp_goods` VALUES ('25', '居系列产品', '200ml', '红色', '经济适用', './Public/Upload/2017-06-02/5930bf11aea5a.png', '45', '', '1496366865', '1496367047', '1', '0');
INSERT INTO `sp_goods` VALUES ('26', '居下的系列产品', '500ml', '蓝色', '经济适用', './Public/Upload/2017-06-02/5930bfb2b6a03.png', '45', '', '1496367026', '1496367026', '1', '0');
INSERT INTO `sp_goods` VALUES ('27', '居系列下的产品', '100ml', '蓝色', '经济适用', './Public/Upload/2017-06-02/5930c011ba600.png', '45', '', '1496367121', '1496367121', '1', '0');
INSERT INTO `sp_goods` VALUES ('29', '厨房系列下的', '100ml', '蓝色', '好用', './Public/Upload/2017-06-02/5930c35c6022d.png', '37', '', '1496367964', '1496367964', '0', '0');
INSERT INTO `sp_goods` VALUES ('30', '居元素酿系列', '500ml', '蓝色', '美观经济适用', './Public/Upload/2017-06-03/593211602630a.png', '40', '', '1496453472', '1496453472', '1', '0');
INSERT INTO `sp_goods` VALUES ('31', '厨下的液体调味系列的产品', '1000ml', '', '美观实用', './Public/Upload/2017-06-07/5937581214c91.png', '37', '', '1496799250', '1496799250', '0', '0');
INSERT INTO `sp_goods` VALUES ('32', '居元素 思密达集成阀泡菜罐 密封罐 酵素罐', '2200ml', '', '密封罐/储物罐', './Public/Upload/2017-06-07/5937586ab8938.png', '37', '', '1496799338', '1496799338', '0', '0');
INSERT INTO `sp_goods` VALUES ('33', '思密达集成阀泡菜罐 密封罐 酵素罐', '2200ml', '无色透明', '便于存储', './Public/Upload/2017-06-07/593758a3a6cff.png', '38', '', '1496799395', '1496805488', '0', '0');
INSERT INTO `sp_goods` VALUES ('34', '密封罐 酵素罐', '2200ml', '绿色', '', './Public/Upload/2017-06-07/593758faa6ebc.png', '44', '', '1496799482', '1496799482', '0', '0');
INSERT INTO `sp_goods` VALUES ('35', '思密达集成阀泡菜罐 密封罐 酵素罐', '1000ml', '无色透明', '美观经济适用', './Public/Upload/2017-06-07/59376d6be5366.png', '44', '', '1496799594', '1496804715', '0', '0');

-- ----------------------------
-- Table structure for sp_goods_buy
-- ----------------------------
DROP TABLE IF EXISTS `sp_goods_buy`;
CREATE TABLE `sp_goods_buy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_title` varchar(200) NOT NULL DEFAULT '' COMMENT '产品标题',
  `goods_detail` text NOT NULL COMMENT '产品详情',
  `goods_yunfei` float(5,2) NOT NULL DEFAULT '0.00' COMMENT '运费',
  `goods_price` float(7,2) NOT NULL COMMENT '产品价格',
  `addtime` int(11) NOT NULL COMMENT '产品添加时间',
  `uptime` int(11) DEFAULT NULL COMMENT '抢购产品修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='产品抢购表';

-- ----------------------------
-- Records of sp_goods_buy
-- ----------------------------
INSERT INTO `sp_goods_buy` VALUES ('2', '居元素 雅韵亲水杯 玻璃随手杯 运动杯 带刻度 浅蓝色', '<p style=\"text-align: center;\">这是商品详情的描述</p><p style=\"text-align:center\"><img src=\"/ueditor/php/upload/image/20170603/1496470266218859.png\" title=\"1496470266218859.png\" alt=\"p1.png\"/></p><p style=\"text-align:center\"><img src=\"/ueditor/php/upload/image/20170603/1496470279799186.png\" title=\"1496470279799186.png\" alt=\"p4.png\"/></p><p style=\"text-align: center;\"><br/></p>', '0.00', '50.00', '1496470320', '1496740697');
INSERT INTO `sp_goods_buy` VALUES ('3', '居元素 思格尔方形储物罐密封罐零食罐(单买) 1730ml', '<ul class=\"parameter2 p-parameter-list list-paddingleft-2\" style=\"list-style-type: none;\"><ul class=\" list-paddingleft-2\" style=\"list-style-type: circle;\"><ul class=\" list-paddingleft-2\" style=\"list-style-type: disc;\"><ul class=\" list-paddingleft-2\" style=\"list-style-type: square;\"><ul class=\"custom_dash list-paddingleft-1\"><ul class=\"custom_dot list-paddingleft-2\"><ul class=\" list-paddingleft-3\" style=\"list-style-type: circle;\"><ul class=\" list-paddingleft-2\" style=\"list-style-type: disc;\"><ul class=\" list-paddingleft-2\" style=\"list-style-type: square;\"><li><p style=\"text-align: center;\">商品名称：居元素 阿波罗&nbsp;</p></li><li><p style=\"text-align: center;\">商品编号：12711458375</p></li><li><p style=\"text-align: center;\">店铺：&nbsp;<a href=\"https://elementalkitchen.jd.com/\" target=\"_blank\" style=\"margin: 0px; padding: 0px; color: rgb(94, 105, 173); text-decoration-line: none;\">居元素官方旗舰店</a></p></li><li><p style=\"text-align: center;\">商品毛重：2.0kg</p></li><li><p style=\"text-align: center;\">货号：E97526001</p></li></ul></ul></ul></ul></ul></ul></ul></ul></ul><p style=\"text-align: center;\"><img src=\"/ueditor/php/upload/image/20170606/1496740742876127.jpg\" title=\"1496740742876127.jpg\" alt=\"57bbeab4Ne1e62c8d.jpg\"/></p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>', '0.00', '100.00', '1496471556', '1496741040');
INSERT INTO `sp_goods_buy` VALUES ('4', '测试产品名称', '<p>&nbsp; &nbsp; &nbsp; &nbsp;此处添加文字，这是商品描述</p><p style=\"text-align: center;\"><img src=\"/ueditor/php/upload/image/20170606/1496740424521071.jpg\" title=\"1496740424521071.jpg\" alt=\"57bbeab4Ne1e62c8d.jpg\"/></p><p></p><p></p>', '0.00', '0.01', '1496718349', '1496740439');
INSERT INTO `sp_goods_buy` VALUES ('5', '居元素抢购产品', '<p style=\"text-align: center;\"><img src=\"/ueditor/php/upload/image/20170606/1496740640110884.jpg\" title=\"1496740640110884.jpg\" alt=\"57bbeab4Ne1e62c8d.jpg\"/></p>', '10.00', '10.00', '1496737424', '1496740646');
INSERT INTO `sp_goods_buy` VALUES ('6', '居元素 阿波罗 玻璃储酿器 酿酒器 酵素罐 阿波罗塑料底座', '<p style=\"text-align: center;\"><img src=\"/ueditor/php/upload/image/20170606/1496740254271530.jpg\" alt=\"57bbeab4Ne1e62c8d.jpg\"/></p>', '10.00', '688.00', '1496740264', '1496799916');

-- ----------------------------
-- Table structure for sp_goods_buypic
-- ----------------------------
DROP TABLE IF EXISTS `sp_goods_buypic`;
CREATE TABLE `sp_goods_buypic` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_buy_pic` varchar(100) NOT NULL DEFAULT '' COMMENT '购买产品的图集',
  `goods_buy_id` int(11) NOT NULL COMMENT '购物专区产品id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sp_goods_buypic
-- ----------------------------
INSERT INTO `sp_goods_buypic` VALUES ('17', './Public/Upload/2017-06-03/59327aafdd1d2.png', '3');
INSERT INTO `sp_goods_buypic` VALUES ('18', './Public/Upload/2017-06-03/59327aafde019.png', '3');
INSERT INTO `sp_goods_buypic` VALUES ('19', './Public/Upload/2017-06-05/5935135c53e6f.png', '2');
INSERT INTO `sp_goods_buypic` VALUES ('20', './Public/Upload/2017-06-05/5935135c59728.png', '2');
INSERT INTO `sp_goods_buypic` VALUES ('21', './Public/Upload/2017-06-06/59361c0e21195.png', '4');
INSERT INTO `sp_goods_buypic` VALUES ('22', './Public/Upload/2017-06-06/59361c0e221c6.png', '4');
INSERT INTO `sp_goods_buypic` VALUES ('23', './Public/Upload/2017-06-06/59361c0e22b8d.png', '4');
INSERT INTO `sp_goods_buypic` VALUES ('24', './Public/Upload/2017-06-06/59366691862a2.png', '5');
INSERT INTO `sp_goods_buypic` VALUES ('26', './Public/Upload/2017-06-06/593666b8dc2f6.png', '5');
INSERT INTO `sp_goods_buypic` VALUES ('27', './Public/Upload/2017-06-06/593671a96bdff.jpg', '6');

-- ----------------------------
-- Table structure for sp_goods_jianjie
-- ----------------------------
DROP TABLE IF EXISTS `sp_goods_jianjie`;
CREATE TABLE `sp_goods_jianjie` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL COMMENT '商品id',
  `goods_jianjie_pic` varchar(100) NOT NULL DEFAULT '' COMMENT '简介图片',
  `goods_jianjie_title` varchar(100) NOT NULL DEFAULT '' COMMENT '简介标题',
  `goods_jianjie_content` varchar(255) NOT NULL DEFAULT '' COMMENT '简介内容',
  `goods_jianjie_url` varchar(100) NOT NULL DEFAULT '' COMMENT '简介url链接',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sp_goods_jianjie
-- ----------------------------
INSERT INTO `sp_goods_jianjie` VALUES ('13', '9', './Public/Upload/2017-05-24/59254e1383957.jpg', 'V型从在在', '傅定芳的', '果然是的啊打发');
INSERT INTO `sp_goods_jianjie` VALUES ('14', '10', './Public/Upload/2017-05-27/592951ca9fa51.jpg', '居元素 思密达集成阀泡菜罐3件套', '居元素 思密达集成阀泡菜罐3件套', 'http://166xj71935.51mypc.cn/index.php/');
INSERT INTO `sp_goods_jianjie` VALUES ('15', '10', './Public/Upload/2017-05-27/592951caa0a40.jpg', '居元素 思密达集成阀泡菜罐3件套', '居元素 思密达集成阀泡菜罐3件套', 'http://166xj71935.51mypc.cn/index.php/');
INSERT INTO `sp_goods_jianjie` VALUES ('17', '17', './Public/Upload/2017-05-31/592e7351890c0.jpg', '这是视频简介', '这是居元素的简介过程', 'http://www.juyuansu.com/index.php/Admin/Index/index');
INSERT INTO `sp_goods_jianjie` VALUES ('18', '17', './Public/Upload/2017-05-31/592e737cb17b9.png', '这是第二个简介', '第二个简介', 'http://www.juyuansu.com/index.php/Admin/Index/index');
INSERT INTO `sp_goods_jianjie` VALUES ('19', '25', './Public/Upload/2017-06-02/5930bf11d9bcf.png', '这是饮系列下的简介', '饮系列下的简介', 'http://166xj71935.51mypc.cn/index.php/');
INSERT INTO `sp_goods_jianjie` VALUES ('20', '25', './Public/Upload/2017-06-02/5930bf11dbec9.png', '这是饮系列下的简介', '饮系列下的简介', 'http://166xj71935.51mypc.cn/index.php/');
INSERT INTO `sp_goods_jianjie` VALUES ('21', '35', './Public/Upload/2017-06-07/5937596ad6d0f.jpg', '这是 产品的简介', '居元素 思密达集成阀泡菜罐 密封罐 酵素罐', 'http://166xj71935.51mypc.cn/index.php/Home/Index/goods_list/cat_id/34');
INSERT INTO `sp_goods_jianjie` VALUES ('22', '35', './Public/Upload/2017-06-07/59376d8d580bd.jpg', '这是 产品的简介', '居元素 思密达集成阀泡菜罐 密封罐 酵素罐', 'http://166xj71935.51mypc.cn/index.php/Home/Index/goods_list/cat_id/34');

-- ----------------------------
-- Table structure for sp_goods_order
-- ----------------------------
DROP TABLE IF EXISTS `sp_goods_order`;
CREATE TABLE `sp_goods_order` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_buy_id` int(11) NOT NULL COMMENT '抢购产品id',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `order_bianhao` varchar(100) NOT NULL COMMENT '订单编号',
  `order_name` varchar(20) NOT NULL DEFAULT '' COMMENT '收货人姓名',
  `tel` varchar(20) NOT NULL COMMENT '收货人联系电话',
  `area` varchar(100) NOT NULL COMMENT '收货人所在的地区',
  `area_detail` varchar(100) NOT NULL COMMENT '详细地址',
  `fahuo_status` enum('1','0') NOT NULL DEFAULT '0' COMMENT '0未发货1已发货',
  `fahuo_danwei` varchar(100) NOT NULL DEFAULT '' COMMENT '快递公司',
  `fahuo_danhao` varchar(100) NOT NULL DEFAULT '' COMMENT '物流单号',
  `order_status` enum('1','0') NOT NULL DEFAULT '0' COMMENT '0未支付1已支付',
  `order_time` int(11) NOT NULL COMMENT '下单时间',
  `order_price` float(8,2) NOT NULL COMMENT '订单金额',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sp_goods_order
-- ----------------------------
INSERT INTO `sp_goods_order` VALUES ('1', '3', '3', '200549976821674000', '上传', '18612787765', '北京 北京市 东城区', '建材市场', '1', '圆通', '123456', '1', '1496632821', '100.00');
INSERT INTO `sp_goods_order` VALUES ('24', '2', '7', '550549994061717000', '张飞', '18612787765', '山东省青岛市', '崂山区', '1', '京东快递', '567890', '1', '1496650061', '100.00');
INSERT INTO `sp_goods_order` VALUES ('25', '2', '7', '860550056307352000', '张三', '18712787764', '北京 北京市 东城区', '金燕龙大厦', '1', '顺风快递', '987654321', '1', '1496712307', '100.00');

-- ----------------------------
-- Table structure for sp_goods_pic
-- ----------------------------
DROP TABLE IF EXISTS `sp_goods_pic`;
CREATE TABLE `sp_goods_pic` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL COMMENT '产品id',
  `goods_pics` varchar(150) NOT NULL COMMENT '产品展示图',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sp_goods_pic
-- ----------------------------
INSERT INTO `sp_goods_pic` VALUES ('3', '16', './Public/Upload/2017-05-31/592e67ca957a6.jpg');
INSERT INTO `sp_goods_pic` VALUES ('4', '16', './Public/Upload/2017-05-31/592e67ca95ff2.jpg');
INSERT INTO `sp_goods_pic` VALUES ('7', '16', './Public/Upload/2017-05-31/592e684d55913.png');
INSERT INTO `sp_goods_pic` VALUES ('8', '17', './Public/Upload/2017-05-31/592e72a6a4a9a.jpg');
INSERT INTO `sp_goods_pic` VALUES ('9', '17', './Public/Upload/2017-05-31/592e72a6a652c.jpg');
INSERT INTO `sp_goods_pic` VALUES ('10', '17', './Public/Upload/2017-05-31/592e72bc5d563.jpg');
INSERT INTO `sp_goods_pic` VALUES ('11', '18', './Public/Upload/2017-06-01/592fa64a9acaa.jpg');
INSERT INTO `sp_goods_pic` VALUES ('12', '18', './Public/Upload/2017-06-01/592fa64a9bef5.jpg');
INSERT INTO `sp_goods_pic` VALUES ('13', '19', './Public/Upload/2017-06-01/592fa6b903031.jpg');
INSERT INTO `sp_goods_pic` VALUES ('14', '19', './Public/Upload/2017-06-01/592fa6b905c4f.jpg');
INSERT INTO `sp_goods_pic` VALUES ('15', '20', './Public/Upload/2017-06-01/592fa6fc06661.jpg');
INSERT INTO `sp_goods_pic` VALUES ('16', '10', './Public/Upload/2017-06-01/592fb4ca7aa38.jpg');
INSERT INTO `sp_goods_pic` VALUES ('17', '10', './Public/Upload/2017-06-01/592fb5102eb5c.jpg');
INSERT INTO `sp_goods_pic` VALUES ('18', '21', './Public/Upload/2017-06-01/592fc405e3dc3.jpg');
INSERT INTO `sp_goods_pic` VALUES ('19', '22', './Public/Upload/2017-06-02/5930bb95c5d52.jpg');
INSERT INTO `sp_goods_pic` VALUES ('20', '23', './Public/Upload/2017-06-02/5930bc65ebd72.jpg');
INSERT INTO `sp_goods_pic` VALUES ('21', '24', './Public/Upload/2017-06-02/5930bccb2088a.jpg');
INSERT INTO `sp_goods_pic` VALUES ('22', '25', './Public/Upload/2017-06-02/5930bf11c55bc.jpg');
INSERT INTO `sp_goods_pic` VALUES ('23', '26', './Public/Upload/2017-06-02/5930bfb2cd2f4.jpg');
INSERT INTO `sp_goods_pic` VALUES ('24', '27', './Public/Upload/2017-06-02/5930c011d4bd7.jpg');
INSERT INTO `sp_goods_pic` VALUES ('25', '28', './Public/Upload/2017-06-02/5930c0904e24e.jpg');
INSERT INTO `sp_goods_pic` VALUES ('26', '29', './Public/Upload/2017-06-02/5930c35c753c0.jpg');
INSERT INTO `sp_goods_pic` VALUES ('27', '30', './Public/Upload/2017-06-03/5932116041bab.jpg');
INSERT INTO `sp_goods_pic` VALUES ('28', '31', './Public/Upload/2017-06-07/593758122a04d.jpg');
INSERT INTO `sp_goods_pic` VALUES ('29', '32', './Public/Upload/2017-06-07/5937586ace4b8.jpg');
INSERT INTO `sp_goods_pic` VALUES ('30', '33', './Public/Upload/2017-06-07/593758a3c40c2.jpg');
INSERT INTO `sp_goods_pic` VALUES ('31', '34', './Public/Upload/2017-06-07/593758fac473c.jpg');
INSERT INTO `sp_goods_pic` VALUES ('33', '35', './Public/Upload/2017-06-07/59376d6be61cd.jpg');
INSERT INTO `sp_goods_pic` VALUES ('34', '35', './Public/Upload/2017-06-07/59376d6be6d30.jpg');

-- ----------------------------
-- Table structure for sp_goods_shipin
-- ----------------------------
DROP TABLE IF EXISTS `sp_goods_shipin`;
CREATE TABLE `sp_goods_shipin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL,
  `goods_shipin_pic` varchar(100) NOT NULL DEFAULT '' COMMENT '视频图片',
  `goods_shipin_title` varchar(100) NOT NULL DEFAULT '' COMMENT '视频标题',
  `goods_shipin_content` varchar(100) NOT NULL DEFAULT '' COMMENT '视频内容',
  `goods_shipin_url` varchar(100) NOT NULL DEFAULT '' COMMENT '视频链接地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sp_goods_shipin
-- ----------------------------
INSERT INTO `sp_goods_shipin` VALUES ('8', '9', './Public/Upload/2017-05-24/59255612711e7.jpg', '阿芳', '三个', '按个');
INSERT INTO `sp_goods_shipin` VALUES ('9', '10', './Public/Upload/2017-06-02/5930b98ae14fb.png', '视频', '这是视频的简介', 'http://166xj71935.51mypc.cn/index.php/');
INSERT INTO `sp_goods_shipin` VALUES ('10', '29', './Public/Upload/2017-06-02/5930c35ca0b4d.jpg', '这是厨房下的视频', '发发', 'http://166xj71935.51mypc.cn/index.php');
INSERT INTO `sp_goods_shipin` VALUES ('11', '29', './Public/Upload/2017-06-02/5930c35ca1e8d.jpg', '居元素 薇娜 玻璃分储瓶 储存酵素', '居元素 薇娜 玻璃分储瓶 储存酵素', 'http://166xj71935.51mypc.cn/index.php');

-- ----------------------------
-- Table structure for sp_goods_shoucang
-- ----------------------------
DROP TABLE IF EXISTS `sp_goods_shoucang`;
CREATE TABLE `sp_goods_shoucang` (
  `goods_cid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL DEFAULT '0' COMMENT '产品id',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '门店id',
  PRIMARY KEY (`goods_cid`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sp_goods_shoucang
-- ----------------------------
INSERT INTO `sp_goods_shoucang` VALUES ('14', '9', '9');
INSERT INTO `sp_goods_shoucang` VALUES ('18', '21', '7');

-- ----------------------------
-- Table structure for sp_goods_yingyong
-- ----------------------------
DROP TABLE IF EXISTS `sp_goods_yingyong`;
CREATE TABLE `sp_goods_yingyong` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL,
  `goods_yingyong_pic` varchar(100) NOT NULL DEFAULT '' COMMENT '应用图片',
  `goods_yingyong_title` varchar(100) NOT NULL DEFAULT '' COMMENT '应用标题',
  `goods_yingyong_content` varchar(100) NOT NULL DEFAULT '' COMMENT '应用内容',
  `goods_yingyong_url` varchar(100) NOT NULL DEFAULT '' COMMENT '应用链接地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sp_goods_yingyong
-- ----------------------------
INSERT INTO `sp_goods_yingyong` VALUES ('10', '9', './Public/Upload/2017-05-24/592556078b750.jpg', '发发发', '阿芳', '发个大嘎嘎');
INSERT INTO `sp_goods_yingyong` VALUES ('11', '10', './Public/Upload/2017-06-01/592fb535eddf5.jpg', '居元素 喷砂 酿酒器 储酿器 酵素罐', '居元素 喷砂 酿酒器 储酿器 酵素罐', 'http://166xj71935.51mypc.cn/index.php/');

-- ----------------------------
-- Table structure for sp_manager
-- ----------------------------
DROP TABLE IF EXISTS `sp_manager`;
CREATE TABLE `sp_manager` (
  `manager_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `manager_name` varchar(20) NOT NULL DEFAULT '' COMMENT '管理员登录名',
  `manager_pwd` varchar(20) NOT NULL DEFAULT '' COMMENT '管理员密码',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `uptime` int(11) NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`manager_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sp_manager
-- ----------------------------
INSERT INTO `sp_manager` VALUES ('1', 'admin', '123456', '1495089338', '1495089338');

-- ----------------------------
-- Table structure for sp_shop
-- ----------------------------
DROP TABLE IF EXISTS `sp_shop`;
CREATE TABLE `sp_shop` (
  `shop_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_name` varchar(100) NOT NULL DEFAULT '' COMMENT '门店名字',
  `shop_tel` char(11) NOT NULL DEFAULT '' COMMENT '门店电话号码',
  `shop_position` varchar(100) NOT NULL DEFAULT '' COMMENT '门店位置',
  `shop_jing` decimal(10,7) NOT NULL DEFAULT '0.0000000' COMMENT '经度',
  `shop_wei` decimal(10,7) NOT NULL DEFAULT '0.0000000' COMMENT '维度',
  `shop_etime` varchar(20) NOT NULL DEFAULT '' COMMENT '营业结束时间',
  `shop_stime` varchar(20) NOT NULL DEFAULT '' COMMENT '营业时间开始',
  `shop_tuijian` varchar(200) NOT NULL DEFAULT '' COMMENT '推荐',
  `shop_logo` varchar(100) NOT NULL DEFAULT '' COMMENT '门店logo图片',
  `shop_tese` varchar(200) NOT NULL DEFAULT '' COMMENT '特色',
  `shop_addtime` int(11) NOT NULL,
  `shop_uptime` int(11) NOT NULL,
  `shop_shoucang` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '门店收藏人数',
  PRIMARY KEY (`shop_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sp_shop
-- ----------------------------
INSERT INTO `sp_shop` VALUES ('1', '山东省利群宇恒大厦居元素店', '', '山东省利群宇恒大厦', '120.3837140', '36.0963300', '20:00', '8:00', '居元素 薇娜 玻璃分储瓶 储存酵素', './Public/Upload/2017-05-26/59278e7d2dc13.jpg', '薇娜 玻璃分储瓶 储存酵素', '1496802303', '1496802303', '0');
INSERT INTO `sp_shop` VALUES ('2', '山东省青岛市利群宇恒大厦居元素店', '18765678765', '山东省青岛市徐州北路170号利群宇恒大厦', '120.3834160', '36.0970900', '20:00', '8:00', '特色推荐居元素', './Public/Upload/2017-05-26/59278e54418b8.jpg', '特色推荐', '1495764564', '1495764564', '0');
INSERT INTO `sp_shop` VALUES ('3', '青岛居元素店', '', '山东省青岛市山东路七号', '120.3855960', '36.0791600', '21:00', '9:00', '居元素 薇娜 玻璃分储瓶 储存酵素', './Public/Upload/2017-05-26/59278e6319f28.jpg', '薇娜 玻璃分储瓶 储存酵素', '1496451741', '1496451741', '0');
INSERT INTO `sp_shop` VALUES ('4', '北京市居元素店', '', '北京市建材西路金燕龙大厦', '116.3328280', '40.0674930', '20:00', '8:00', '居元素 薇娜 玻璃分储瓶 储存酵素', './Public/Upload/2017-05-26/5927f3ad2f040.jpg', '薇娜 玻璃分储瓶 储存酵素', '1496451718', '1496451718', '0');
INSERT INTO `sp_shop` VALUES ('5', '山东省居元素店', '', '山东省青岛市徐州路170号', '120.3834580', '36.0971140', '21:00', '8:00', '居元素 爱娜 密封 高硼硅玻璃 收纳 储物 保鲜 冷藏 微波多功能六件套 储酿 多功能小罐', './Public/Upload/2017-05-27/5929509939bc9.jpg', '北欧时尚设计，洁净的玻璃瓶身,质感非凡，居家点缀，时尚又实用。用来存放主食、杂粮、干果等，也可以存放各种小物品，防潮防尘；保存各种零食，茶包，糖果，大小适中。玻璃瓶身干净耐用，便于分辨食物品种分量。不容容量设计，满足不同分量和大小食物盛放，节省空间。', '1496451511', '1496451511', '0');
INSERT INTO `sp_shop` VALUES ('6', '居元素山东路店', '', '山东路7号乙', '120.3848140', '36.0792710', '20:00', '8:00', '居元素 喷砂', './Public/Upload/2017-06-03/59320c8654d19.jpg', '天悦竹风储酿器 玻璃酿酒器', '1496452230', '1496452230', '0');

-- ----------------------------
-- Table structure for sp_shop_pic
-- ----------------------------
DROP TABLE IF EXISTS `sp_shop_pic`;
CREATE TABLE `sp_shop_pic` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `shop_pic` varchar(100) NOT NULL DEFAULT '' COMMENT '门店展示图片',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sp_shop_pic
-- ----------------------------
INSERT INTO `sp_shop_pic` VALUES ('3', '2', './Public/Upload/2017-05-25/5926b98465c33.jpg');
INSERT INTO `sp_shop_pic` VALUES ('5', '3', './Public/Upload/2017-05-26/5927852600d66.jpg');
INSERT INTO `sp_shop_pic` VALUES ('6', '3', './Public/Upload/2017-05-26/59278526020cf.jpg');
INSERT INTO `sp_shop_pic` VALUES ('7', '2', './Public/Upload/2017-05-26/5927896618805.jpg');
INSERT INTO `sp_shop_pic` VALUES ('8', '1', './Public/Upload/2017-05-26/59278e7d2f536.jpg');
INSERT INTO `sp_shop_pic` VALUES ('9', '4', './Public/Upload/2017-05-26/5927f3ae7a4e8.jpg');
INSERT INTO `sp_shop_pic` VALUES ('10', '4', './Public/Upload/2017-05-26/5927f3ae7b1e6.jpg');
INSERT INTO `sp_shop_pic` VALUES ('11', '5', './Public/Upload/2017-05-27/5929509a58375.jpg');
INSERT INTO `sp_shop_pic` VALUES ('12', '5', './Public/Upload/2017-05-27/5929509a58d31.jpg');
INSERT INTO `sp_shop_pic` VALUES ('13', '5', './Public/Upload/2017-05-27/5929509a59564.jpg');
INSERT INTO `sp_shop_pic` VALUES ('15', '5', './Public/Upload/2017-05-31/592e8523e098f.jpg');
INSERT INTO `sp_shop_pic` VALUES ('16', '6', './Public/Upload/2017-06-03/59320c876d828.jpg');

-- ----------------------------
-- Table structure for sp_shop_shoucang
-- ----------------------------
DROP TABLE IF EXISTS `sp_shop_shoucang`;
CREATE TABLE `sp_shop_shoucang` (
  `shop_cid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL DEFAULT '0' COMMENT '门店id',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  PRIMARY KEY (`shop_cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sp_shop_shoucang
-- ----------------------------

-- ----------------------------
-- Table structure for sp_user
-- ----------------------------
DROP TABLE IF EXISTS `sp_user`;
CREATE TABLE `sp_user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_img` varchar(200) NOT NULL DEFAULT '' COMMENT '用户头像',
  `user_openid` varchar(100) NOT NULL DEFAULT '' COMMENT '用户openid',
  `user_tel` char(11) NOT NULL DEFAULT '' COMMENT '用户手机号',
  `user_name` varchar(20) NOT NULL DEFAULT '' COMMENT '用户名',
  `user_register_time` int(11) NOT NULL COMMENT '修改时间',
  `city` varchar(20) NOT NULL DEFAULT '' COMMENT '用户所在城市',
  `is_lingqu` enum('1','0') NOT NULL DEFAULT '0' COMMENT '0未领取1已领取',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sp_user
-- ----------------------------
INSERT INTO `sp_user` VALUES ('2', 'http://wx.qlogo.cn/mmopen/JltESJzc1JVOLP3icjp6W9d1xNYrCEbhbJxHiajYI3m5nAC8SQpvE3mGgkz1lml5OoEfQ1iaLicfaFmqTHF85iauQzDLQ8PkOjXc9/0', 'opmpVwsRpLhNiozis2KDwHe6CNiU', '', '근 丫头', '1496197121', '', '0');
INSERT INTO `sp_user` VALUES ('3', 'http://wx.qlogo.cn/mmopen/RcZp0ibqdBC655nYgJ1ibe995ZOZDIr6sDgFmaiaiaiaVrPSJBthjf1ia78k8feGxHWYibcibZzVEkuKjwSR3GSrv2PBLqq7KAYlvMNL/0', 'opmpVwlEe1OFqU_aldiAyC5Zn70E', '18612787764', '国伟', '1496226994', '山东省临沂市', '1');
INSERT INTO `sp_user` VALUES ('6', 'http://wx.qlogo.cn/mmopen/Gbu9BFoUcIY3Q8130x6W3WYuD5Ie0arVP6DHtbib1oWFpNVdkZVbpA7Y3u95aM35ZiblUWeN8wKsd0k5Y6S4zLrsHjLWn8Llc6/0', 'opmpVwloOsFy5KmBqPfnD7S9WinY', '', '高国权', '1496390742', '青岛', '0');
INSERT INTO `sp_user` VALUES ('7', 'http://wx.qlogo.cn/mmopen/VSDUdQBJlAUgW9joplxAE3hRfBbJJwpgl9lPhj3OpYVC4kdd6icun1JBjESnwDrk1SEKYgibnXM5YvUhl4SUx6c1b8j6D0S6C4/0', 'oVYA_twNS_69vkgYqGphR8o5VkyQ', '', '国伟', '1496645547', '山东临沂', '1');
INSERT INTO `sp_user` VALUES ('8', 'http://wx.qlogo.cn/mmopen/WAPRENBicOwWa2hIMicicYuZD0Vj4pz2pzWq8Q1KmpVBzlQncqhYVPpWI1stNcicoVWdkcV2VoPBQ1KqUayZPbUZ6jKMJ1wsVIDH/0', 'oVYA_t8KuVJsH7jrpRIk6Ns7GS3Q', '', '曼珠沙华', '1496736612', '青岛', '0');
INSERT INTO `sp_user` VALUES ('9', 'http://wx.qlogo.cn/mmopen/WCw45zmO00IbC6M8DFfhia8mJceKgJ5hWIas6xy9Tnnt5Vic25TgqWuZK5nlLUal48H6JS1UqeVbaDJUIWDGlJXOPsBtlLTslk/0', 'oVYA_t0lIvrWaHNlSYnBUlN6RrdI', '17263970080', '阿弥陀佛么么哒', '1496739379', '青岛-山东', '0');

-- ----------------------------
-- Table structure for sp_xinpin
-- ----------------------------
DROP TABLE IF EXISTS `sp_xinpin`;
CREATE TABLE `sp_xinpin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `xinpin_name` varchar(50) NOT NULL DEFAULT '' COMMENT '新品图片名称',
  `xinpin_dizhi` varchar(100) NOT NULL DEFAULT '' COMMENT '新品链接地址',
  `xinpin_logo` varchar(100) NOT NULL DEFAULT '' COMMENT '新品图片名称',
  `add_time` int(11) NOT NULL DEFAULT '0',
  `up_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sp_xinpin
-- ----------------------------
INSERT INTO `sp_xinpin` VALUES ('1', '这是新品1的编辑后的111', 'http://166xj71935.51mypc.cn/index.php/Home/Index/goods_detail/goods_id/10', './Public/Upload/2017-06-01/592f8c82475fe.jpg', '1496287058', '1496288386');
INSERT INTO `sp_xinpin` VALUES ('2', '这是新品2', 'http://166xj71935.51mypc.cn/index.php/Home/Index/goods_detail/goods_id/10', './Public/Upload/2017-06-01/592f8ca3a0009.jpg', '1496288419', '1496288419');
