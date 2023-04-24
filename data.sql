-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2023-04-23 00:36:01
-- 服务器版本： 5.6.50-log
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sql_vipweb_store`
--

-- --------------------------------------------------------

--
-- 表的结构 `xn_address_book`
--

CREATE TABLE IF NOT EXISTS `xn_address_book` (
  `id` bigint(20) NOT NULL,
  `uid` bigint(20) NOT NULL,
  `currency` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:trc;2:erc',
  `address` varchar(100) NOT NULL,
  `beizhu` varchar(200) DEFAULT NULL,
  `is_moren` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1:默认;0非默认',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0正常;1删除'
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COMMENT='用户地址薄';

--
-- 插入之前先把表清空（truncate） `xn_address_book`
--

TRUNCATE TABLE `xn_address_book`;
--
-- 转存表中的数据 `xn_address_book`
--

INSERT INTO `xn_address_book` (`id`, `uid`, `currency`, `address`, `beizhu`, `is_moren`, `is_delete`) VALUES
(1, 55, 1, 'Trcageaeahheahehaherahe', 'test', 0, 0),
(2, 55, 1, 'Trcsfhsreahaharhahbaweh', '', 0, 0),
(3, 51, 1, 'Trfagageaeageagh', 'sssget', 0, 1),
(4, 51, 1, 'Thehsdaharehabb', 'eagtea', 0, 1),
(5, 51, 1, 'TaggagdcHesd', 'GAWEG', 0, 1),
(6, 51, 1, 'Tzgaewahah', 'etgeagg', 0, 1),
(7, 51, 1, 'Trcasdfghjkl', 'qwerty', 0, 1),
(8, 51, 1, 'Tasgbaaah', 'agaegaeg', 0, 1),
(9, 52, 1, 'Trctest1', 'Trctest1', 0, 0),
(10, 51, 1, 'Tsagaxsahahawharhawer8965', '测试', 0, 1),
(11, 51, 1, 'Tagghawbahaweh', 'sgaeah', 0, 1),
(12, 51, 1, 'Tsaagegaddgasgd', 'dgaegg', 0, 1),
(13, 51, 1, 'Tsahahrhasgageagewwd', 'agega', 0, 1),
(14, 51, 1, 'Tsahahhahahr', 'hHabhaa', 0, 1),
(15, 51, 1, 'TXfoWjrWgEENU6BYWHzGJoU6eyfRgHb3cU', '12364deff ', 1, 1),
(16, 51, 2, '0xgagaeaehweh', 'sgeaegaeg', 0, 0),
(17, 51, 1, 'Tgsgxbgaedabwb', 'sgsa', 0, 0),
(18, 51, 1, 'Tshdhshdrfhjsrth', 'bhdhrh', 0, 1),
(19, 51, 2, '0xgagesgaaheah', 'sgawegsgawegh', 0, 0),
(20, 51, 1, 'Tsgasgawea998', '454231', 0, 0),
(21, 51, 2, '0xgegage998', '998', 0, 0),
(22, 51, 1, 'Tdhahfdharherh', 'x3333', 0, 0),
(23, 115, 1, 'TJ7UQEMps1B3BkU85VPdYepH2AxA3RXbgZ', 'ST', 0, 0),
(24, 118, 1, 'TQLFgabFwodcQzs4xR4634HoPjEwoRCZFf', '张三', 0, 0),
(25, 115, 1, 'TYNpAgNwvrq4Nv1L72mNj49f69ishnKMFf', '', 0, 0),
(26, 60, 1, 'Testestsetsetstsetststststststs', '测试', 0, 0),
(27, 60, 1, 'Test1dddagegegegegegegege', '测试2', 0, 0),
(28, 60, 1, 'Test2gggggggghdihfjdb', '测试3', 0, 0),
(29, 60, 1, 'Test4hhhhhhhhcjvfjncjcg', '测试4', 0, 0),
(30, 60, 1, 'TSQL1SuxFcy6v2HNmxyiHksLVx7LazjQYC', '123', 0, 0),
(31, 102, 1, 'Test1aaaaaaaaaaaaaaaa', '测试1', 0, 1),
(32, 102, 1, 'Test2bbbbbbbbbbbbbbb', '测试2', 0, 1),
(33, 102, 1, 'Test3ccccccccccccccccc', '测试3', 0, 1),
(34, 102, 1, 'Test4ddddddddddddddddddddd', '测试4', 0, 1),
(35, 102, 1, 'TXWmGNesaKRCUc27Yfj46UdJhH6Q9BtKKA', 'test20220705', 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `xn_admin`
--

CREATE TABLE IF NOT EXISTS `xn_admin` (
  `id` int(11) unsigned NOT NULL,
  `username` varchar(60) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(64) NOT NULL DEFAULT '' COMMENT '登录密码；mb_password加密',
  `avatar` varchar(255) NOT NULL DEFAULT '' COMMENT '用户头像，相对于upload/avatar目录',
  `email` varchar(100) NOT NULL DEFAULT '' COMMENT '登录邮箱',
  `email_code` varchar(60) DEFAULT NULL COMMENT '激活码',
  `phone` bigint(11) unsigned DEFAULT NULL COMMENT '手机号',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户状态 0：禁用； 1：正常',
  `register_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `last_login_ip` varchar(16) NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `remark` varchar(100) DEFAULT NULL,
  `google_key` varchar(50) DEFAULT NULL COMMENT 'google密钥',
  `google_key_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '密钥开关',
  `qrCodeUrl` varchar(240) NOT NULL COMMENT '谷歌二维码'
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- 插入之前先把表清空（truncate） `xn_admin`
--

TRUNCATE TABLE `xn_admin`;
--
-- 转存表中的数据 `xn_admin`
--

INSERT INTO `xn_admin` (`id`, `username`, `password`, `avatar`, `email`, `email_code`, `phone`, `status`, `register_time`, `last_login_ip`, `last_login_time`, `remark`, `google_key`, `google_key_status`, `qrCodeUrl`) VALUES
(1, 'admin', 'bc2c812d34aefb609595e1c14744d1f5', '', 'david55@163.com', '', 13724211980, 1, 1449199996, '', 0, '11', '', 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `xn_admin_log`
--

CREATE TABLE IF NOT EXISTS `xn_admin_log` (
  `id` int(11) unsigned NOT NULL,
  `admin_id` int(11) NOT NULL,
  `url` varchar(512) DEFAULT '',
  `remark` varchar(512) DEFAULT NULL,
  `ip` char(15) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `method` varchar(10) DEFAULT NULL,
  `param` text
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

--
-- 插入之前先把表清空（truncate） `xn_admin_log`
--

TRUNCATE TABLE `xn_admin_log`;
--
-- 转存表中的数据 `xn_admin_log`
--

INSERT INTO `xn_admin_log` (`id`, `admin_id`, `url`, `remark`, `ip`, `create_time`, `method`, `param`) VALUES
(1, 1, 'https://www.mayixitong.site/admin/admin/info.html?id=1', '修改个人资料', '211.22.180.19', 1657375522, 'POST', '{"id":"1","password":"aa112233","phone":"13724211980","email":"david55@163.com","remark":"11"}'),
(2, 1, 'https://www.mayixitong.site/admin/login/index.html', '后台登录', '211.22.180.19', 1657375537, 'POST', '{"username":"admin","password":"aa112233","vercode":"4zdh"}'),
(3, 1, 'https://www.mayixitong.site/admin/login/index.html', '后台登录', '114.139.71.46', 1657377135, 'POST', '{"username":"admin","password":"aa112233","vercode":"i4ia"}'),
(4, 1, 'https://www.mayixitong.site/admin/login/index.html', '后台登录', '47.57.2.52', 1657428676, 'POST', '{"username":"admin","password":"aa112233","vercode":"8z6i"}'),
(5, 1, 'https://www.mayixitong.site/admin/login/index.html', '后台登录', '139.162.107.219', 1657442024, 'POST', '{"username":"Admin","password":"aa112233","vercode":"8a53"}'),
(6, 1, 'https://www.mayixitong.site/admin/login/index.html', '后台登录', '45.78.58.83', 1657467105, 'POST', '{"username":"admin","password":"aa112233","vercode":"c5v5"}'),
(7, 1, 'https://www.mayixitong.site/admin/login/index.html', '后台登录', '206.190.234.7', 1657556362, 'POST', '{"username":"admin","password":"aa112233","vercode":"z73f"}'),
(8, 1, 'https://www.mayixitong.site/admin/login/index.html', '后台登录', '103.170.26.39', 1657627741, 'POST', '{"username":"admin","password":"aa112233","vercode":"kw6s"}'),
(9, 1, 'https://www.mayixitong.site/admin/login/index.html', '后台登录', '36.249.156.207', 1658590400, 'POST', '{"username":"admin","password":"aa112233","vercode":"fseb"}'),
(10, 1, 'https://www.mayixitong.site/admin/login/index.html', '后台登录', '211.22.180.73', 1658661983, 'POST', '{"username":"admin","password":"aa112233","vercode":"xmc5"}'),
(11, 1, 'https://www.mayixitong.site/admin/login/index.html', '后台登录', '61.221.110.208', 1659525606, 'POST', '{"username":"admin","password":"aa112233","vercode":"mydi"}'),
(12, 1, 'https://www.mayixitong.site/admin/login/index.html', '后台登录', '182.239.93.196', 1659535274, 'POST', '{"username":"admin","password":"aa112233","vercode":"nvt8"}'),
(13, 1, 'https://www.mayixitong.site/admin/login/index.html', '后台登录', '103.170.26.38', 1662585031, 'POST', '{"username":"admin","password":"aa112233","vercode":"xzif"}'),
(14, 1, 'https://www.mayixitong.site/admin/login/index.html', '后台登录', '119.62.135.195', 1662586959, 'POST', '{"username":"admin","password":"aa112233","vercode":"f4c2"}'),
(15, 1, 'https://www.mayixitong.site/admin/login/index.html', '后台登录', '103.170.27.218', 1663161628, 'POST', '{"username":"admin","password":"aa112233","vercode":"5w4d"}'),
(16, 1, 'https://www.mayixitong.site/admin/login/index.html', '后台登录', '103.82.4.219', 1663164175, 'POST', '{"username":"admin","password":"aa112233","vercode":"nijq"}'),
(17, 1, 'https://www.mayixitong.site/admin/User/edit.html?id=1', '修改用户信息', '103.82.4.219', 1663164616, 'POST', '{"id":"1","username":"18016567006","password":"qaz123456","trans_password":"qaz123456","usdt_nums":"0","status":"1"}'),
(18, 1, 'http://23.105.202.169/admin/login/index.html', '后台登录', '120.42.246.118', 1663165645, 'POST', '{"username":"admin","password":"aa112233","vercode":"inwm"}'),
(19, 1, 'http://23.105.202.169/admin/User/edit.html?id=1', '修改用户信息', '120.42.246.118', 1663166612, 'POST', '{"id":"1","username":"18016567006","password":"","trans_password":"","usdt_nums":"5000","status":"1"}'),
(20, 1, 'https://www.mayixitong.site/admin/login/index.html', '后台登录', '180.130.255.99', 1663167478, 'POST', '{"username":"admin","password":"aa112233","vercode":"hy4a"}'),
(21, 1, 'http://23.105.202.169/admin/User/edit.html?id=1', '修改用户信息', '120.42.246.118', 1663167498, 'POST', '{"id":"1","username":"18016567006","password":"aa112233","trans_password":"159753","usdt_nums":"5000","status":"1"}'),
(22, 1, 'https://www.mayixitong.site/admin/login/index.html', '后台登录', '180.130.255.99', 1663167527, 'POST', '{"username":"admin","password":"aa112233","vercode":"vrtf"}'),
(23, 1, 'https://www.mayixitong.site/admin/User/sfzedit.html', '修改认证状态', '180.130.255.99', 1663175805, 'POST', '{"id":"1","uid":"3","renzheng1":"1"}'),
(24, 1, 'https://www.mayixitong.site/admin/User/sfzedit.html', '修改认证状态', '180.130.255.99', 1663175832, 'POST', '{"id":"1","uid":"3","renzheng2":"1"}'),
(25, 1, 'https://www.mayixitong.site/admin/User/sfzedit.html', '修改认证状态', '180.130.255.99', 1663175850, 'POST', '{"id":"1","uid":"3","renzheng2":"2"}'),
(26, 1, 'https://www.mayixitong.site/admin/User/sfzedit.html', '修改认证状态', '180.130.255.99', 1663175880, 'POST', '{"id":"1","uid":"3","renzheng2":"1"}'),
(27, 1, 'http://23.105.202.169/admin/login/index.html', '后台登录', '192.243.122.122', 1663182622, 'POST', '{"username":"admin","password":"aa112233","vercode":"emdk"}'),
(28, 1, 'https://www.mayixitong.site/admin/login/index.html', '后台登录', '206.190.237.108', 1663254722, 'POST', '{"username":"admin","password":"aa112233","vercode":"fu7b"}'),
(29, 1, 'https://www.mayixitong.site/admin/User/edit.html?id=3', '修改用户信息', '180.130.255.99', 1663260275, 'POST', '{"id":"3","username":"TA33jr7veNemrrZHfvsyxFPJ1BbRRoeNVf","password":"9872a521a8144ec373aa32837cba32a5","trans_password":"","usdt_nums":"1000","status":"1"}'),
(30, 1, 'https://www.mayixitong.site/admin/login/index.html', '后台登录', '206.190.233.23', 1663521720, 'POST', '{"username":"admin","password":"aa112233","vercode":"hcqb"}'),
(31, 1, 'https://www.mayixitong.site/admin/User/edit.html?id=4', '修改用户信息', '206.190.233.23', 1663522601, 'POST', '{"id":"4","username":"","email":"64991359@qq.com","password":"123456","trans_password":"123456","usdt_nums":"1327.94","status":"1"}'),
(32, 1, 'https://www.mayixitong.site/admin/user/edit.html', '修改用户信息', '206.190.233.23', 1663522616, 'POST', '{"id":"4","email_yz":"1"}'),
(33, 1, 'https://www.mayixitong.site/admin/user/edit.html', '修改用户信息', '206.190.233.23', 1663522713, 'POST', '{"id":"4","status":"1"}'),
(34, 1, 'https://www.mayixitong.site/admin/User/edit.html?id=3', '修改用户信息', '206.190.233.23', 1663522789, 'POST', '{"id":"3","username":"","email":"56190160@qq.com","password":"123456","trans_password":"","usdt_nums":"1000","status":"1"}'),
(35, 1, 'https://www.mayixitong.site/admin/User/edit.html?id=2', '修改用户信息', '206.190.233.23', 1663522826, 'POST', '{"id":"2","username":"","email":"56190610@qq.com","password":"123456","trans_password":"","usdt_nums":"500","status":"1"}'),
(36, 1, 'https://www.mayixitong.site/admin/login/index.html', '后台登录', '192.243.123.204', 1665319321, 'POST', '{"username":"admin","password":"aa112233","vercode":"dv8m"}'),
(37, 1, 'https://www.mayixitong.site/admin/login/index.html', '后台登录', '192.243.123.204', 1665321939, 'POST', '{"username":"admin","password":"aa112233","vercode":"bcx3"}'),
(38, 1, 'https://www.mayixitong.site/admin/login/index.html', '后台登录', '192.53.174.32', 1666592754, 'POST', '{"username":"admin","password":"aa112233","vercode":"snvs"}'),
(39, 1, 'https://www.mayixitong.site/admin/login/index.html', '后台登录', '185.14.47.167', 1682003781, 'POST', '{"username":"admin","password":"aa112233","vercode":"cfrq"}'),
(40, 1, 'https://www.mayixitong.site/admin/login/index.html', '后台登录', '185.14.47.167', 1682172223, 'POST', '{"username":"admin","password":"aa112233","vercode":"u3ve"}'),
(41, 1, 'https://www.mayixitong.site/admin/user/edit.html', '修改用户信息', '185.14.47.167', 1682172768, 'POST', '{"id":"4","phone_yz":"1"}'),
(42, 1, 'https://www.mayixitong.site/admin/user/edit.html', '修改用户信息', '185.14.47.167', 1682172774, 'POST', '{"id":"4","phone_yz":"0"}'),
(43, 1, 'https://www.mayixitong.site/admin/user/edit.html', '修改用户信息', '185.14.47.167', 1682172776, 'POST', '{"id":"1","phone_yz":"1"}'),
(44, 1, 'https://www.mayixitong.site/admin/User/edit.html?id=1', '修改用户信息', '185.14.47.167', 1682172819, 'POST', '{"id":"1","username":"18016567006","email":"18016567006@qq.com","password":"aa112233","trans_password":"159753","usdt_nums":"5020"}'),
(45, 1, 'https://www.mayixitong.site/admin/user/edit.html', '修改用户信息', '185.14.47.167', 1682173703, 'POST', '{"id":"1","status":"1"}'),
(46, 1, 'https://www.mayixitong.site/admin/user/edit.html', '修改用户信息', '185.14.47.167', 1682173706, 'POST', '{"id":"4","status":"1"}');

-- --------------------------------------------------------

--
-- 表的结构 `xn_auth_group`
--

CREATE TABLE IF NOT EXISTS `xn_auth_group` (
  `id` int(11) unsigned NOT NULL,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` text COMMENT '规则id'
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='用户组表';

--
-- 插入之前先把表清空（truncate） `xn_auth_group`
--

TRUNCATE TABLE `xn_auth_group`;
--
-- 转存表中的数据 `xn_auth_group`
--

INSERT INTO `xn_auth_group` (`id`, `title`, `status`, `rules`) VALUES
(1, '超级管理员', 1, '14,14,15,1,2,3,4,5,6,7,8,9,10,11,12,13,21,16,17,29,34,35,22,18,18,19,20,20,23,23,24,28,33,25,25,26,27,36,37,38,30,30,31,32,39,39,40,41,42,43,44,44,45,46'),
(2, '一般管理员', 1, '14,14,1,21,22,18,18,20,20,23,23,24,28,33,25,25,26,27,37,38,30,30,31,32,39,39,40,41,42,43,44,44,46');

-- --------------------------------------------------------

--
-- 表的结构 `xn_auth_group_access`
--

CREATE TABLE IF NOT EXISTS `xn_auth_group_access` (
  `admin_id` int(11) unsigned NOT NULL COMMENT '用户id',
  `group_id` int(11) unsigned NOT NULL COMMENT '用户组id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组明细表';

--
-- 插入之前先把表清空（truncate） `xn_auth_group_access`
--

TRUNCATE TABLE `xn_auth_group_access`;
--
-- 转存表中的数据 `xn_auth_group_access`
--

INSERT INTO `xn_auth_group_access` (`admin_id`, `group_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `xn_auth_rule`
--

CREATE TABLE IF NOT EXISTS `xn_auth_rule` (
  `id` int(11) unsigned NOT NULL,
  `pid` int(11) unsigned DEFAULT '0' COMMENT '父级id',
  `name` char(80) DEFAULT '' COMMENT '规则唯一标识',
  `title` char(20) DEFAULT '' COMMENT '规则中文名称',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态：为1正常，为0禁用',
  `is_menu` tinyint(1) unsigned DEFAULT '0' COMMENT '菜单显示',
  `condition` char(100) DEFAULT '' COMMENT '规则表达式，为空表示存在就验证，不为空表示按照条件验证',
  `type` tinyint(1) DEFAULT '1',
  `sort` int(5) DEFAULT '999',
  `icon` varchar(40) DEFAULT ''
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COMMENT='规则表';

--
-- 插入之前先把表清空（truncate） `xn_auth_rule`
--

TRUNCATE TABLE `xn_auth_rule`;
--
-- 转存表中的数据 `xn_auth_rule`
--

INSERT INTO `xn_auth_rule` (`id`, `pid`, `name`, `title`, `status`, `is_menu`, `condition`, `type`, `sort`, `icon`) VALUES
(1, 15, 'admin/auth/index', '后台管理', 1, 1, '', 1, 50, 'layui-icon-auz'),
(2, 1, 'admin/auth/index', '菜单管理', 1, 0, '', 1, 1, ''),
(3, 2, 'admin/auth/add', '添加', 1, 0, '', 1, 2, NULL),
(4, 2, 'admin/auth/edit', '编辑', 1, 0, '', 1, 3, NULL),
(5, 2, 'admin/auth/delete', '删除', 1, 0, '', 1, 4, NULL),
(6, 1, 'admin/AuthGroup/index', '用户组', 1, 1, '', 1, 999, ''),
(7, 6, 'admin/AuthGroup/add', '添加', 1, 0, '', 1, 999, NULL),
(8, 6, 'admin/AuthGroup/edit', '编辑', 1, 0, '', 1, 999, NULL),
(9, 6, 'admin/AuthGroup/delete', '删除', 1, 0, '', 1, 39, NULL),
(10, 1, 'admin/admin/index', '管理员', 1, 1, '', 1, 3, ''),
(11, 10, 'admin/admin/add', '添加', 1, 0, '', 1, 999, NULL),
(12, 10, 'admin/admin/edit', '编辑', 1, 0, '', 1, 999, NULL),
(13, 10, 'admin/admin/delete', '删除', 1, 0, '', 1, 999, NULL),
(14, 0, 'admin/index/home', '管理首页', 1, 1, '', 1, 1, 'layui-icon-home'),
(15, 0, 'admin/config/base', '系统管理', 1, 1, '', 1, 999, 'layui-icon-set'),
(16, 21, 'admin/config/base', '系统设置', 1, 1, '', 1, 999, ''),
(17, 21, 'admin/config/upload', '上传配置', 1, 1, '', 1, 999, ''),
(18, 0, 'admin/upload_files/index', '上传管理', 1, 0, '', 1, 40, 'layui-icon-picture'),
(19, 18, 'admin/upload_files/delete', '删除文件', 1, 0, '', 1, 999, ''),
(20, 0, 'admin/banner/index', '轮播管理', 1, 1, '', 1, 999, 'layui-icon-face-surprised'),
(21, 15, '', '配置管理', 1, 1, '', 1, 999, ''),
(22, 15, 'admin/AdminLog/index', '日志管理', 1, 1, '', 1, 999, ''),
(23, 0, '', '会员管理', 1, 1, '', 1, 999, 'layui-icon-username'),
(24, 23, 'admin/user/index', '会员管理', 1, 1, '', 1, 999, ''),
(25, 0, '', '订单管理', 1, 1, '', 1, 999, 'layui-icon-template-1'),
(26, 25, 'admin/order/sell', '出售订单', 1, 1, '', 1, 999, ''),
(27, 25, 'admin/order/buy', '买家订单', 1, 1, '', 1, 999, ''),
(28, 23, 'admin/commission/index', '推荐管理', 1, 1, '', 1, 999, 'layui-icon-user'),
(29, 21, 'admin/admin/google', '谷歌验证', 1, 1, '', 1, 999, ''),
(30, 0, '', '信息管理', 1, 1, '', 1, 999, 'layui-icon-notice'),
(31, 30, 'admin/message/msg', '用户信息', 1, 1, '', 1, 999, ''),
(32, 30, 'admin/message/notice', '平台公告', 1, 1, '', 1, 999, ''),
(33, 23, 'admin/user/renzheng', '身份认证', 1, 1, '', 1, 999, ''),
(34, 21, 'admin/transfer/base', '转帐设置', 1, 1, '', 1, 999, ''),
(35, 21, 'admin/order/index', '订单设置', 1, 1, '', 1, 1000, ''),
(36, 25, 'admin/order/del', '删除出售订单', 1, 0, '', 1, 999, ''),
(37, 25, 'admin/order/order', '匹配订单', 1, 1, '', 1, 998, ''),
(38, 25, 'admin/order/editsell', '编辑卖家订单', 1, 0, '', 1, 999, ''),
(39, 0, '', '转账管理', 1, 1, '', 1, 999, 'layui-icon-dollar'),
(40, 39, 'admin/transfer/index', '提现管理', 1, 1, '', 1, 999, ''),
(41, 39, 'admin/transfer/qtlog', '充提记录', 1, 1, '', 1, 999, ''),
(42, 39, 'admin/transfer/agree', '同意', 1, 0, '', 1, 999, ''),
(43, 39, 'admin/transfer/reject', '拒绝', 1, 0, '', 1, 999, ''),
(44, 0, '', '归集管理', 1, 1, '', 1, 999, 'layui-icon-ios'),
(45, 44, 'admin/guiji/config', '归集设置', 1, 1, '', 1, 999, ''),
(46, 44, 'admin/guiji/index', '归集日志', 1, 1, '', 1, 999, '');

-- --------------------------------------------------------

--
-- 表的结构 `xn_banner`
--

CREATE TABLE IF NOT EXISTS `xn_banner` (
  `id` int(10) NOT NULL COMMENT 'id',
  `url` varchar(200) DEFAULT NULL COMMENT '链接地址',
  `title` varchar(100) DEFAULT NULL COMMENT '标题',
  `img_url` varchar(200) DEFAULT NULL COMMENT '图片地址'
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- 插入之前先把表清空（truncate） `xn_banner`
--

TRUNCATE TABLE `xn_banner`;
--
-- 转存表中的数据 `xn_banner`
--

INSERT INTO `xn_banner` (`id`, `url`, `title`, `img_url`) VALUES
(34, 'https://www.mayixitong.site', 'H5轮播', '/uploads/file/20220407/514b2ee8bf2975540188c77b901dc83b.jpg'),
(35, 'https://www.mayixitong.site', 'H5轮播', '/uploads/file/20220407/7194af0e304f6018d26a85ca73de4f55.jpg'),
(36, 'https://www.mayixitong.site', 'H5轮播', '/uploads/file/20220407/9124de1904af239921f95437a44f047f.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `xn_check_balance`
--

CREATE TABLE IF NOT EXISTS `xn_check_balance` (
  `id` bigint(20) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `update_time` int(11) NOT NULL,
  `uid` bigint(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 插入之前先把表清空（truncate） `xn_check_balance`
--

TRUNCATE TABLE `xn_check_balance`;
--
-- 转存表中的数据 `xn_check_balance`
--

INSERT INTO `xn_check_balance` (`id`, `status`, `update_time`, `uid`) VALUES
(1, 0, 1682174212, 1),
(2, 0, 1663260493, 3),
(3, 0, 1682178918, 4);

-- --------------------------------------------------------

--
-- 表的结构 `xn_commission_links`
--

CREATE TABLE IF NOT EXISTS `xn_commission_links` (
  `id` bigint(15) NOT NULL COMMENT 'id',
  `pid` varchar(32) NOT NULL COMMENT '商户id',
  `commission_rate` float(10,4) NOT NULL COMMENT '分佣',
  `reg_links` varchar(200) NOT NULL COMMENT '注册链接',
  `create_time` datetime NOT NULL COMMENT '生成时间',
  `delete_time` datetime DEFAULT NULL COMMENT '删除时间'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 插入之前先把表清空（truncate） `xn_commission_links`
--

TRUNCATE TABLE `xn_commission_links`;
--
-- 转存表中的数据 `xn_commission_links`
--

INSERT INTO `xn_commission_links` (`id`, `pid`, `commission_rate`, `reg_links`, `create_time`, `delete_time`) VALUES
(2, '1', 1.0000, 'https://www.mayixitong.site/user/login/reg/commission_rate/1/pid/1', '2023-04-20 23:22:21', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `xn_config`
--

CREATE TABLE IF NOT EXISTS `xn_config` (
  `id` int(2) NOT NULL,
  `sys_name` varchar(200) DEFAULT NULL,
  `logo` varchar(200) DEFAULT NULL,
  `sitename` varchar(200) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `keywords` varchar(200) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `app_down_url` varchar(200) DEFAULT NULL COMMENT 'app下载地址',
  `usdt_price` float(10,8) DEFAULT '0.99000001' COMMENT 'usdt价格',
  `auto_update` tinyint(1) DEFAULT '0' COMMENT '自动更新',
  `login_vercode` tinyint(1) NOT NULL DEFAULT '0',
  `usdt_modify` float(5,2) NOT NULL COMMENT 'usdt价格修正',
  `commission_rate` float(10,2) NOT NULL DEFAULT '100.00' COMMENT '平台佣金',
  `poundage` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '平台抽水手续费',
  `trc20_collection_address` varchar(100) DEFAULT NULL,
  `trc20_collection_key` varchar(150) DEFAULT NULL,
  `trc20_pay_address` varchar(100) DEFAULT NULL,
  `trc20_pay_key` varchar(150) DEFAULT NULL,
  `erc20_collection_address` varchar(100) DEFAULT NULL,
  `erc20_collection_key` varchar(150) DEFAULT NULL,
  `erc20_pay_address` varchar(100) DEFAULT NULL,
  `erc20_pay_key` varchar(150) DEFAULT NULL,
  `trc20_pay_usdt` float(10,6) NOT NULL DEFAULT '0.000000',
  `trx_pay` float(10,6) NOT NULL DEFAULT '0.000000',
  `erc20_pay_usdt` float(10,6) NOT NULL DEFAULT '0.000000',
  `eth_pay` float(10,6) NOT NULL DEFAULT '0.000000',
  `erc20_collection_usdt` float(10,6) NOT NULL DEFAULT '0.000000',
  `eth_collection` float(10,6) NOT NULL DEFAULT '0.000000',
  `trc20_collection_usdt` float(10,6) NOT NULL DEFAULT '0.000000',
  `trx_collection` float(10,6) NOT NULL DEFAULT '0.000000',
  `pexpay_price` varchar(50) NOT NULL DEFAULT '0.00' COMMENT '币安价格',
  `okx_price` varchar(50) NOT NULL DEFAULT '0.00' COMMENT '欧易价格'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 插入之前先把表清空（truncate） `xn_config`
--

TRUNCATE TABLE `xn_config`;
--
-- 转存表中的数据 `xn_config`
--

INSERT INTO `xn_config` (`id`, `sys_name`, `logo`, `sitename`, `title`, `keywords`, `description`, `app_down_url`, `usdt_price`, `auto_update`, `login_vercode`, `usdt_modify`, `commission_rate`, `poundage`, `trc20_collection_address`, `trc20_collection_key`, `trc20_pay_address`, `trc20_pay_key`, `erc20_collection_address`, `erc20_collection_key`, `erc20_pay_address`, `erc20_pay_key`, `trc20_pay_usdt`, `trx_pay`, `erc20_pay_usdt`, `eth_pay`, `erc20_collection_usdt`, `eth_collection`, `trc20_collection_usdt`, `trx_collection`, `pexpay_price`, `okx_price`) VALUES
(1, 'Otc交易后台管理系统', '', 'usdt交易系统官网', 'usdt交易系统官网', 'usdt交易系统', 'usdt交易系统', 'https://www.mayixitong.site/down', 7.34999990, 1, 1, 0.00, 100.00, 0.3000, 'TA33jr7veNemrrZHfvsyxFPJ1BbRRoeNVf', '0xfc11123c088f7f894e41ea1e8f36edc8d10927c92ef8ebfac42a0684ef920c48', 'TA33jr7veNemrrZHfvsyxFPJ1BbRRoeNVf', '0xfc11123c088f7f894e41ea1e8f36edc8d10927c92ef8ebfac42a0684ef920c48', 'TA33jr7veNemrrZHfvsyxFPJ1BbRRoeNVf', '0xfc11123c088f7f894e41ea1e8f36edc8d10927c92ef8ebfac42a0684ef920c48', 'TA33jr7veNemrrZHfvsyxFPJ1BbRRoeNVf', '0xfc11123c088f7f894e41ea1e8f36edc8d10927c92ef8ebfac42a0684ef920c48', 100.000000, 100.000000, 0.000000, 0.000000, 0.000000, 0.000000, 10.000000, 1.706640, '6.94,+0.2', '6.91,-0.11');

-- --------------------------------------------------------

--
-- 表的结构 `xn_guiji`
--

CREATE TABLE IF NOT EXISTS `xn_guiji` (
  `id` bigint(20) NOT NULL,
  `run_time` int(11) NOT NULL DEFAULT '0',
  `contents` varchar(200) DEFAULT NULL,
  `create_time` int(11) NOT NULL DEFAULT '0',
  `amount` float(10,4) NOT NULL DEFAULT '0.0000',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0等待1执行2成功3失败'
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

--
-- 插入之前先把表清空（truncate） `xn_guiji`
--

TRUNCATE TABLE `xn_guiji`;
--
-- 转存表中的数据 `xn_guiji`
--

INSERT INTO `xn_guiji` (`id`, `run_time`, `contents`, `create_time`, `amount`, `status`) VALUES
(1, 1657303627, '归集任务完成', 1657375202, 0.0000, 2),
(2, 1657390027, '归集任务完成', 1657382402, 0.0000, 2),
(3, 1657476427, '归集任务完成', 1657468802, 0.0000, 2),
(4, 1657562827, '归集任务完成', 1657555203, 0.0000, 2),
(5, 1657649227, '归集任务完成', 1657641602, 0.0000, 2),
(6, 1657735627, '归集任务完成', 1657728002, 0.0000, 2),
(7, 1657822027, '归集任务完成', 1657814403, 0.0000, 2),
(8, 1657908427, '归集任务完成', 1657900803, 0.0000, 2),
(9, 1657994827, '归集任务完成', 1657987203, 0.0000, 2),
(10, 1658081227, '归集任务完成', 1658073603, 0.0000, 2),
(11, 1658167627, '归集任务完成', 1658160002, 0.0000, 2),
(12, 1658254027, '归集任务完成', 1658246403, 0.0000, 2),
(13, 1658340427, '归集任务完成', 1658332803, 0.0000, 2),
(14, 1658426827, '归集任务完成', 1658419202, 0.0000, 2),
(15, 1658513227, '归集任务完成', 1658505602, 0.0000, 2),
(16, 1658599627, '归集任务完成', 1658592002, 0.0000, 2),
(17, 1658686027, '归集任务完成', 1658678401, 0.0000, 2),
(18, 1658772427, '归集任务完成', 1658764802, 0.0000, 2),
(19, 1658858827, '归集任务完成', 1658851203, 0.0000, 2),
(20, 1658945227, '归集任务完成', 1658937603, 0.0000, 2),
(21, 1659031627, '归集任务完成', 1659024003, 0.0000, 2),
(22, 1659118027, '归集任务完成', 1659110403, 0.0000, 2),
(23, 1659204427, '归集任务完成', 1659196802, 0.0000, 2),
(24, 1659290827, '归集任务完成', 1659283202, 0.0000, 2),
(25, 1659377227, '归集任务完成', 1659369603, 0.0000, 2),
(26, 1659463627, '归集任务完成', 1659456003, 0.0000, 2),
(27, 1659550027, '归集任务完成', 1659542402, 0.0000, 2),
(28, 1659636427, '归集任务完成', 1659628803, 0.0000, 2),
(29, 1662574027, '归集任务完成', 1662586201, 0.0000, 2),
(30, 1662660427, '归集任务完成', 1662652803, 0.0000, 2),
(31, 1662746827, '归集任务完成', 1662739202, 0.0000, 2),
(32, 1662833227, '归集任务完成', 1662825603, 0.0000, 2),
(33, 1662919627, '归集任务完成', 1662912003, 0.0000, 2),
(34, 1663006027, '归集任务完成', 1662998402, 0.0000, 2),
(35, 1663092427, '归集任务完成', 1663084803, 0.0000, 2),
(36, 1663178827, '归集任务完成', 1663171204, 0.0000, 2),
(37, 1663265227, '归集任务完成', 1663257602, 0.0000, 2),
(38, 1663351627, '归集任务完成', 1663344002, 0.0000, 2),
(39, 1663438027, '归集任务完成', 1663430403, 0.0000, 2),
(40, 1663524427, '归集任务完成', 1663516802, 0.0000, 2),
(41, 1665252427, '归集任务完成', 1665322202, 0.0000, 2),
(42, 1665338827, '归集任务完成', 1665331203, 0.0000, 2),
(43, 1665425227, '归集任务完成', 1665417602, 0.0000, 2),
(44, 1665511627, '归集任务完成', 1665504003, 0.0000, 2),
(45, 1665598027, '归集任务完成', 1665590402, 0.0000, 2),
(46, 1665684427, '归集任务完成', 1665676803, 0.0000, 2),
(47, 1665770827, '归集任务完成', 1665763202, 0.0000, 2),
(48, 1665857227, '归集任务完成', 1665849604, 0.0000, 2),
(49, 1665943627, '归集任务完成', 1665936002, 0.0000, 2),
(50, 1666030027, '归集任务完成', 1666022402, 0.0000, 2),
(51, 1666116427, '归集任务完成', 1666108802, 0.0000, 2),
(52, 1666202827, '归集任务完成', 1666195203, 0.0000, 2),
(53, 1666289227, '归集任务完成', 1666281602, 0.0000, 2),
(54, 1666375627, '归集任务完成', 1666368003, 0.0000, 2),
(55, 1666462027, '归集任务完成', 1666454402, 0.0000, 2),
(56, 1666548427, '归集任务完成', 1666540802, 0.0000, 2),
(57, 1682014027, '归集任务完成', 1682078779, 0.0000, 2),
(58, 1682100427, '归集任务完成', 1682092801, 0.0000, 2),
(59, 1682186827, '	归集任务即将执行', 1682179202, 0.0000, 0);

-- --------------------------------------------------------

--
-- 表的结构 `xn_guiji_config`
--

CREATE TABLE IF NOT EXISTS `xn_guiji_config` (
  `id` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `open_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `trx_address` varchar(200) DEFAULT NULL,
  `eth_address` varchar(200) DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 插入之前先把表清空（truncate） `xn_guiji_config`
--

TRUNCATE TABLE `xn_guiji_config`;
--
-- 转存表中的数据 `xn_guiji_config`
--

INSERT INTO `xn_guiji_config` (`id`, `status`, `open_time`, `update_time`, `trx_address`, `eth_address`, `type`) VALUES
(1, 1, 1657303627, 1657374235, 'TA33jr7veNemrrZHfvsyxFPJ1BbRRoeNVf', 'TA33jr7veNemrrZHfvsyxFPJ1BbRRoeNVf', 0);

-- --------------------------------------------------------

--
-- 表的结构 `xn_identity_auth`
--

CREATE TABLE IF NOT EXISTS `xn_identity_auth` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `country` varchar(50) NOT NULL COMMENT '国家',
  `true_name` varchar(50) NOT NULL COMMENT '姓名',
  `id_no` varchar(50) NOT NULL COMMENT '身份证号码',
  `img_first` varchar(100) DEFAULT NULL COMMENT '正面照',
  `img_back` varchar(100) DEFAULT NULL COMMENT '反面照',
  `renzheng1` tinyint(1) NOT NULL DEFAULT '0' COMMENT '初级认证0未认证1通过2待审核',
  `renzheng2` tinyint(1) NOT NULL DEFAULT '0' COMMENT '高级认证0未认证1通过2待审核',
  `reason1` varchar(100) DEFAULT NULL COMMENT '初级认证拒绝理由',
  `reason2` varchar(100) DEFAULT NULL COMMENT '高级认证拒绝理由',
  `add_time` int(11) NOT NULL COMMENT '添加时间',
  `shenhe_time` int(11) NOT NULL COMMENT '审核时间'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='身份认证表';

--
-- 插入之前先把表清空（truncate） `xn_identity_auth`
--

TRUNCATE TABLE `xn_identity_auth`;
--
-- 转存表中的数据 `xn_identity_auth`
--

INSERT INTO `xn_identity_auth` (`id`, `uid`, `country`, `true_name`, `id_no`, `img_first`, `img_back`, `renzheng1`, `renzheng2`, `reason1`, `reason2`, `add_time`, `shenhe_time`) VALUES
(1, 3, '中国大陆', '刘进', '430321198112022533', NULL, NULL, 1, 1, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `xn_order`
--

CREATE TABLE IF NOT EXISTS `xn_order` (
  `id` bigint(20) NOT NULL,
  `order_sn` varchar(50) NOT NULL,
  `b_uid` int(10) NOT NULL DEFAULT '0',
  `s_uid` int(10) NOT NULL DEFAULT '0',
  `b_phone` varchar(20) DEFAULT NULL,
  `s_phone` varchar(20) DEFAULT NULL,
  `b_email` varchar(50) DEFAULT NULL,
  `s_email` varchar(50) DEFAULT NULL,
  `amount` float(10,4) NOT NULL DEFAULT '0.0000',
  `usdt_nums` float(10,4) NOT NULL DEFAULT '0.0000',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT ' 0批配成功 1买钱付款 2卖家确认，3取消订单，4超时处理',
  `pay_account` varchar(50) DEFAULT NULL,
  `pay_code` tinyint(1) NOT NULL DEFAULT '0',
  `create_time` int(10) NOT NULL DEFAULT '0',
  `update_time` int(10) NOT NULL DEFAULT '0',
  `beizhu` varchar(50) DEFAULT NULL,
  `sell_order_number` varchar(50) DEFAULT NULL COMMENT '卖家订单号',
  `qr_code_url` varchar(200) DEFAULT NULL,
  `b_price` float(10,4) NOT NULL DEFAULT '0.0000',
  `price` float(6,4) NOT NULL DEFAULT '0.0000' COMMENT '卖家价格',
  `b_amount` float(10,4) NOT NULL DEFAULT '0.0000',
  `b_usdt_nums` float(10,4) NOT NULL DEFAULT '0.0000',
  `platform_usdt_nums` float(10,4) NOT NULL DEFAULT '0.0000'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='订单表';

--
-- 插入之前先把表清空（truncate） `xn_order`
--

TRUNCATE TABLE `xn_order`;
--
-- 转存表中的数据 `xn_order`
--

INSERT INTO `xn_order` (`id`, `order_sn`, `b_uid`, `s_uid`, `b_phone`, `s_phone`, `b_email`, `s_email`, `amount`, `usdt_nums`, `status`, `pay_account`, `pay_code`, `create_time`, `update_time`, `beizhu`, `sell_order_number`, `qr_code_url`, `b_price`, `price`, `b_amount`, `b_usdt_nums`, `platform_usdt_nums`) VALUES
(1, 'SN202209142305224448797617', 4, 1, NULL, '18016567006', '64991359@qq.com', '', 344.3379, 51.4705, 4, 'www.baidu.comqwqqqqqqq2222222', 1, 1663167922, 0, NULL, 'S2022091423021318980376271', NULL, 6.8900, 6.6900, 344.6600, 50.0000, 1.4705),
(2, 'SN202209142352466564252028', 1, 4, '18016567006', NULL, '', '64991359@qq.com', 137.7351, 20.5882, 2, 'werwewerwerrwerwswwww', 1, 1663170766, 1663172486, NULL, 'S2022091423440573902414324', 'http://23.105.202.169/qrcode/41663167891.jpg', 6.8900, 6.6900, 137.8600, 20.0000, 0.5882),
(3, 'SN202209150025141104305053', 1, 4, '18016567006', NULL, '', '64991359@qq.com', 344.3379, 51.4705, 1, 'werwewerwerrwerwswwww', 1, 1663172714, 1663172883, NULL, 'S2022091423440573902414324', 'http://23.105.202.169/qrcode/41663167891.jpg', 6.8900, 6.6900, 344.6600, 50.0000, 1.4705);

-- --------------------------------------------------------

--
-- 表的结构 `xn_order_buy`
--

CREATE TABLE IF NOT EXISTS `xn_order_buy` (
  `id` bigint(20) NOT NULL,
  `email` varchar(150) DEFAULT NULL COMMENT '买家邮箱',
  `order_number` varchar(100) DEFAULT NULL COMMENT '订单号',
  `price` float(10,2) NOT NULL DEFAULT '0.00' COMMENT 'usdt2cny价格',
  `amount` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '总金额',
  `status` tinyint(1) DEFAULT '0' COMMENT '0订单提交，1匹配成功， 2订单完成， 3买家撤单，4订单过期',
  `usdt_nums` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT 'usdt数量',
  `phone` varchar(20) DEFAULT NULL COMMENT '手机',
  `frozen_usdts` float(10,4) DEFAULT '0.0000' COMMENT '冻结数量',
  `locked` tinyint(1) DEFAULT '0' COMMENT '锁定',
  `uid` int(11) DEFAULT '0',
  `pay_code` tinyint(1) DEFAULT NULL COMMENT '1银行2微信3支付宝',
  `pay_account` varchar(200) DEFAULT NULL COMMENT '付款帐号',
  `create_time` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  `beizhu` varchar(50) DEFAULT NULL,
  `remain_usdts` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '剩余usdt',
  `qr_code_url` varchar(200) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- 插入之前先把表清空（truncate） `xn_order_buy`
--

TRUNCATE TABLE `xn_order_buy`;
--
-- 转存表中的数据 `xn_order_buy`
--

INSERT INTO `xn_order_buy` (`id`, `email`, `order_number`, `price`, `amount`, `status`, `usdt_nums`, `phone`, `frozen_usdts`, `locked`, `uid`, `pay_code`, `pay_account`, `create_time`, `update_time`, `beizhu`, `remain_usdts`, `qr_code_url`) VALUES
(1, '64991359@qq.com', 'B2022091423052116596807254', 6.89, 344.66, 4, 50.0000, NULL, 50.0000, 0, 4, 1, '', 1663167921, NULL, NULL, 0.0000, NULL),
(2, '', 'B2022091423524363086685191', 6.89, 137.86, 2, 20.0000, '18016567006', 20.0000, 0, 1, 1, '', 1663170763, NULL, NULL, 0.0000, ''),
(3, '', 'B2022091500251277076928231', 6.89, 344.66, 4, 50.0000, '18016567006', 50.0000, 0, 1, 1, '', 1663172712, 1663179914, NULL, 0.0000, ''),
(4, '56190160@qq.com', 'B2022091501354839618876103', 6.89, 6893.15, 4, 1000.0000, NULL, 0.0000, 0, 3, 1, '', 1663176948, NULL, NULL, 1000.0000, '');

-- --------------------------------------------------------

--
-- 表的结构 `xn_order_config`
--

CREATE TABLE IF NOT EXISTS `xn_order_config` (
  `id` tinyint(1) NOT NULL,
  `limit_buy` int(10) NOT NULL DEFAULT '0',
  `limit_sell` int(10) NOT NULL DEFAULT '0',
  `timeout` int(11) NOT NULL DEFAULT '0',
  `buy_mark_up` float(5,4) NOT NULL DEFAULT '0.0000' COMMENT '买家加价'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 插入之前先把表清空（truncate） `xn_order_config`
--

TRUNCATE TABLE `xn_order_config`;
--
-- 转存表中的数据 `xn_order_config`
--

INSERT INTO `xn_order_config` (`id`, `limit_buy`, `limit_sell`, `timeout`, `buy_mark_up`) VALUES
(1, 10, 10, 45, -0.1500);

-- --------------------------------------------------------

--
-- 表的结构 `xn_order_sell`
--

CREATE TABLE IF NOT EXISTS `xn_order_sell` (
  `id` bigint(20) NOT NULL,
  `email` varchar(150) DEFAULT NULL COMMENT '买家邮箱',
  `order_number` varchar(100) DEFAULT NULL COMMENT '订单号',
  `price` float(10,2) NOT NULL DEFAULT '0.00' COMMENT 'usdt2cny价格',
  `amount` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '总金额',
  `status` tinyint(1) DEFAULT '0' COMMENT '0订单提交，1匹配成功， 2订单完成， 3卖家撤单，4订单过期',
  `usdt_nums` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT 'usdt数量',
  `phone` varchar(20) DEFAULT NULL COMMENT '手机',
  `frozen_usdts` float(10,4) DEFAULT '0.0000' COMMENT '冻结数量',
  `locked` tinyint(1) DEFAULT '0' COMMENT '锁定',
  `uid` int(11) DEFAULT '0',
  `pay_code` tinyint(1) DEFAULT NULL COMMENT '1银行2微信3支付宝',
  `pay_account` varchar(200) DEFAULT NULL COMMENT '付款帐号',
  `create_time` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  `beizhu` varchar(50) DEFAULT NULL COMMENT '备注',
  `remain_usdts` float(10,4) DEFAULT '0.0000',
  `qr_code_url` varchar(200) DEFAULT NULL COMMENT '二维码'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- 插入之前先把表清空（truncate） `xn_order_sell`
--

TRUNCATE TABLE `xn_order_sell`;
--
-- 转存表中的数据 `xn_order_sell`
--

INSERT INTO `xn_order_sell` (`id`, `email`, `order_number`, `price`, `amount`, `status`, `usdt_nums`, `phone`, `frozen_usdts`, `locked`, `uid`, `pay_code`, `pay_account`, `create_time`, `update_time`, `beizhu`, `remain_usdts`, `qr_code_url`) VALUES
(1, '', 'S2022091423021318980376271', 6.69, 669.32, 4, 100.0000, '18016567006', 0.0000, 0, 1, 1, 'www.baidu.comqwqqqqqqq2222222', 1663167733, NULL, NULL, 100.0000, NULL),
(4, '64991359@qq.com', 'S2022091423440573902414324', 6.69, 2342.60, 4, 350.0000, NULL, 51.4705, 0, 4, 1, 'werwewerwerrwerwswwww', 1663170245, 1663177446, NULL, 277.9413, '/qrcode/41663167891.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `xn_payment`
--

CREATE TABLE IF NOT EXISTS `xn_payment` (
  `id` bigint(25) NOT NULL COMMENT 'id',
  `uid` bigint(25) DEFAULT NULL,
  `bank_number` varchar(50) DEFAULT NULL COMMENT '银行帐号',
  `holder_name` char(20) DEFAULT NULL COMMENT '持卡人姓名',
  `bank_name` char(20) DEFAULT NULL COMMENT '银行名称',
  `bank_kaihu` varchar(100) DEFAULT NULL COMMENT '开户支行名称',
  `bank_nature` tinyint(1) DEFAULT '0' COMMENT '银行类型，0个人，1公司',
  `wx_account` char(20) DEFAULT NULL COMMENT '微信帐号',
  `wx_qrcode` char(100) DEFAULT NULL COMMENT '微信二维码',
  `zfb_account` char(20) DEFAULT NULL COMMENT '支付宝帐号',
  `zfb_qrcode` char(100) DEFAULT NULL COMMENT '支付宝二维码',
  `first_pay_account` tinyint(1) DEFAULT '0' COMMENT '0bank,1zfb,2wx',
  `user_area_code` char(5) DEFAULT 'cn' COMMENT 'cn大陆hk香港tw台湾',
  `user_currency` char(10) DEFAULT NULL COMMENT '用户法币',
  `user_area` char(10) NOT NULL COMMENT '用户区域汉字',
  `user_currency_code` char(10) DEFAULT 'CNY' COMMENT '货币符号',
  `type` char(10) DEFAULT NULL COMMENT '类型 bank wallet',
  `title` char(50) DEFAULT NULL COMMENT '标题',
  `subtype` tinyint(1) DEFAULT NULL COMMENT '子类型用于type是wallet',
  `decp_account` varchar(50) DEFAULT NULL COMMENT '数字人民币',
  `decp_qrcode` varchar(100) DEFAULT NULL,
  `qr_image` varchar(200) DEFAULT NULL COMMENT '二维码保存',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0正常;1删除',
  `is_moren` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0非默认;1默认'
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COMMENT='用户收款帐号';

--
-- 插入之前先把表清空（truncate） `xn_payment`
--

TRUNCATE TABLE `xn_payment`;
--
-- 转存表中的数据 `xn_payment`
--

INSERT INTO `xn_payment` (`id`, `uid`, `bank_number`, `holder_name`, `bank_name`, `bank_kaihu`, `bank_nature`, `wx_account`, `wx_qrcode`, `zfb_account`, `zfb_qrcode`, `first_pay_account`, `user_area_code`, `user_currency`, `user_area`, `user_currency_code`, `type`, `title`, `subtype`, `decp_account`, `decp_qrcode`, `qr_image`, `is_delete`, `is_moren`) VALUES
(16, 52, '1564684641868596', '詹某', '北京银行', 'aga', 0, NULL, NULL, NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'bank', NULL, NULL, NULL, NULL, NULL, 1, 0),
(17, 51, '12321454648786484', '张某', '安徽省农村信用社', 'geag', 0, NULL, NULL, NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'bank', NULL, NULL, NULL, NULL, NULL, 1, 0),
(18, 51, '4387834866', '张某', '渤海银行', 'ttt', 0, NULL, NULL, NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'bank', NULL, NULL, NULL, NULL, NULL, 1, 0),
(19, 51, '736878383', '张某', '渤海银行', 'trdgh', 0, NULL, NULL, NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'bank', NULL, NULL, NULL, NULL, NULL, 1, 0),
(20, 51, '2134546548985513', '王某', '北京银行', 'ageag', 0, NULL, NULL, NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'bank', NULL, NULL, NULL, NULL, NULL, 1, 0),
(21, 51, '459625494999999', '王大谋', '包商银行', 'bank', 0, NULL, NULL, NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'bank', NULL, NULL, NULL, NULL, NULL, 0, 1),
(22, 51, NULL, '王某', NULL, NULL, 0, '12345678910', 'http://qwe.cqalhg.com/20220505/165173526169636.png', NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'wx', NULL, NULL, NULL, NULL, NULL, 1, 0),
(23, 51, NULL, '张默', NULL, NULL, 0, NULL, NULL, '98765432100112', 'http://qwe.cqalhg.com/20220505/165173576941735.png', 0, 'cn', NULL, '', 'CNY', 'zfb', NULL, NULL, NULL, NULL, NULL, 1, 0),
(24, 52, NULL, '许某', NULL, NULL, 0, '963852741123', 'http://qwe.cqalhg.com/20220505/165173678328431.png', NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'wx', NULL, NULL, NULL, NULL, NULL, 1, 0),
(25, 51, NULL, '张默', NULL, NULL, 0, NULL, NULL, '98765432100123', 'http://qwe.cqalhg.com/20220505/165173576941735.png', 0, 'cn', NULL, '', 'CNY', 'zfb', NULL, NULL, NULL, NULL, NULL, 1, 0),
(26, 51, NULL, '张默', NULL, NULL, 0, NULL, NULL, '9876543210', 'http://qwe.cqalhg.com/20220505/165173576941735.png', 0, 'cn', NULL, '', 'CNY', 'zfb', NULL, NULL, NULL, NULL, NULL, 1, 0),
(27, 51, NULL, '张默', NULL, NULL, 0, NULL, NULL, '9876543210011234', 'http://qwe.cqalhg.com/20220505/165173576941735.png', 0, 'cn', NULL, '', 'CNY', 'zfb', NULL, NULL, NULL, NULL, NULL, 1, 0),
(28, 51, '1231345654968956', '张某', '鞍山银行', '鞍山', 0, NULL, NULL, NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'bank', NULL, NULL, NULL, NULL, NULL, 1, 0),
(29, 51, '1321234659856789', '张大大', '安徽省农村信用社', '安徽', 0, NULL, NULL, NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'bank', NULL, NULL, NULL, NULL, NULL, 1, 0),
(30, 51, NULL, '张张', NULL, NULL, 0, '1236454985963', 'http://qwe.cqalhg.com/20220507/165188925818697.png', NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'wx', NULL, NULL, NULL, NULL, NULL, 0, 0),
(31, 51, NULL, '张小小', NULL, NULL, 0, NULL, NULL, '1656569491946980', 'http://qwe.cqalhg.com/20220507/165188948135098.png', 0, 'cn', NULL, '', 'CNY', 'zfb', NULL, NULL, NULL, NULL, NULL, 1, 0),
(32, 63, '59885326555', '大事', '德州银行', '无', 0, NULL, NULL, NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'bank', NULL, NULL, NULL, NULL, NULL, 0, 0),
(33, 51, NULL, '张照片', NULL, NULL, 0, 'gjuuf86343684678965', 'http://qwe.cqalhg.com/20220512/165232840382851.png', NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'wx', NULL, NULL, NULL, NULL, NULL, 1, 0),
(34, 51, '15648416819465198', '张张', '北京农村商业银行', 'dagge', 0, NULL, NULL, NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'bank', NULL, NULL, NULL, NULL, NULL, 1, 0),
(35, 66, NULL, '测试', NULL, NULL, 0, '18046567006', 'http://qwe.cqalhg.com/20220521/165311335469502.jpg', NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'wx', NULL, NULL, NULL, NULL, NULL, 0, 1),
(36, 66, '0', '', '', '', 0, '18016567006', 'http://qwe.cqalhg.com/20220521/165311335469502.jpg', NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'wx', NULL, NULL, NULL, NULL, NULL, 0, 0),
(37, 63, '6876854624321321321', '爱测', '安阳银行', '无', 0, NULL, NULL, NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'bank', NULL, NULL, NULL, NULL, NULL, 0, 1),
(38, 51, NULL, '张张', NULL, NULL, 0, NULL, NULL, 'dgasgbeageaegh', 'http://qwe.cqalhg.com/20220525/165346771321410.png', 0, 'cn', NULL, '', 'CNY', 'zfb', NULL, NULL, NULL, NULL, NULL, 0, 0),
(39, 51, '125963214788888', 'geaeg', '安徽省农村信用社', 'sgge', 0, NULL, NULL, NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'bank', NULL, NULL, NULL, NULL, NULL, 0, 0),
(40, 51, '922337203685', '大大王', '北京农村商业银行', '151565', 0, NULL, NULL, NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'bank', NULL, NULL, NULL, NULL, NULL, 1, 0),
(41, 51, '56665234111111190', '王中王', '中国建设银行', '大笔列电ege', 0, NULL, NULL, NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'bank', NULL, NULL, NULL, NULL, NULL, 0, 0),
(42, 52, NULL, '张张', NULL, NULL, 0, 'ssag_sageadgae123456', 'http://qwe.cqalhg.com/20220526/165353122037439.png', NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'wx', NULL, NULL, NULL, NULL, NULL, 0, 1),
(43, 52, NULL, '王二', NULL, NULL, 0, NULL, NULL, '13005962181', 'http://qwe.cqalhg.com/20220526/165353163062591.png', 0, 'cn', NULL, '', 'CNY', 'zfb', NULL, NULL, NULL, NULL, NULL, 1, 0),
(44, 63, NULL, '测试', NULL, NULL, 0, 'sgeage_sgeg', 'http://qwe.cqalhg.com/20220526/165354480527146.png', NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'wx', NULL, NULL, NULL, NULL, NULL, 0, 0),
(45, 70, '6217006836653456349', '蟹老板', '中国建设银行', '蟹堡王', 0, NULL, NULL, NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'bank', NULL, NULL, NULL, NULL, NULL, 0, 0),
(46, 71, '621855780508000515', '王源', '中国光大银行', '秘密花园', 0, NULL, NULL, NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'bank', NULL, NULL, NULL, NULL, NULL, 0, 0),
(47, 84, NULL, '党建', NULL, NULL, 0, NULL, NULL, '16652735125', 'http://qwe.cqalhg.com/20220530/165391444819236.jpg', 0, 'cn', NULL, '', 'CNY', 'zfb', NULL, NULL, NULL, NULL, NULL, 0, 1),
(48, NULL, '9223372036854775807', '张三丰', '北京农村商业银行', '背景', 0, NULL, NULL, NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'bank', NULL, NULL, NULL, NULL, NULL, 0, 0),
(49, NULL, '956966541523629', '王者', '请选择开户银行', 'geg', 0, NULL, NULL, NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'bank', NULL, NULL, NULL, NULL, NULL, 0, 0),
(50, NULL, '1231342423', 'hghnv', '请选择开户银行', 'sgagrga', 0, NULL, NULL, NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'bank', NULL, NULL, NULL, NULL, NULL, 0, 0),
(51, 51, '383853854475539568', '大王', '北京银行', '碑林', 0, NULL, NULL, NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'bank', NULL, NULL, NULL, NULL, NULL, 0, 0),
(52, NULL, '5555', '5555', '成都银行', '222', 0, NULL, NULL, NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'bank', NULL, NULL, NULL, NULL, NULL, 0, 0),
(53, 51, NULL, '图片', NULL, NULL, 0, 'lemo', 'http://qwe.cqalhg.com/20220606/165450085218333.jpg', NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'wx', NULL, NULL, NULL, NULL, NULL, 1, 0),
(54, 52, '6248996545569654135', '张张', '中国建设银行', '测试', 0, NULL, NULL, NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'bank', NULL, NULL, NULL, NULL, NULL, 0, 0),
(55, 52, NULL, '大哥哥', NULL, NULL, 0, NULL, NULL, '13005962189', 'http://qwe.cqalhg.com/20220616/165536003755675.png', 0, 'cn', NULL, '', 'CNY', 'zfb', NULL, NULL, NULL, NULL, NULL, 0, 0),
(56, 110, NULL, '宁鹏飞', NULL, NULL, 0, NULL, NULL, 'das2959448@163.com', 'http://qwe.cqalhg.com/20220621/165579452534436.jpg', 0, 'cn', NULL, '', 'CNY', 'zfb', NULL, NULL, NULL, NULL, NULL, 0, 0),
(57, 115, '6212262004001658088', '陈天浩', '中国工商银行', '广东分行', 0, NULL, NULL, NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'bank', NULL, NULL, NULL, NULL, NULL, 0, 0),
(58, 118, '6214835812345566', '张三', '中信银行', '杭州支', 0, NULL, NULL, NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'bank', NULL, NULL, NULL, NULL, NULL, 0, 0),
(59, 102, '9223372036854775807', '吴三少', '中国工商银行', '泉州支行', 0, NULL, NULL, NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'bank', NULL, NULL, NULL, NULL, NULL, 0, 0),
(60, 124, '6217003250004541262', '丁家浩', '中国建设银行', '广东分行', 0, NULL, NULL, NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'bank', NULL, NULL, NULL, NULL, NULL, 0, 0),
(61, 1, 'www.baidu.comqwqqqqqqq2222222', '爱测试', '数字人民币', '无', 0, NULL, NULL, NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'bank', NULL, NULL, NULL, '/qrcode/611663165437.jpg', NULL, 0, 1),
(62, 4, 'werwewerwerrwerwswwww', '第二人', '数字人民币', '无', 0, NULL, NULL, NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'bank', NULL, NULL, NULL, '/qrcode/41663167891.jpg', NULL, 0, 1),
(63, 3, '0041003951630743', '段佳晴', '数字人民币', '兴业钱包', 0, NULL, NULL, NULL, NULL, 0, 'cn', NULL, '', 'CNY', 'bank', NULL, NULL, NULL, '/qrcode/631663258696.jpg', NULL, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `xn_recharge_record`
--

CREATE TABLE IF NOT EXISTS `xn_recharge_record` (
  `id` bigint(25) NOT NULL,
  `type` char(10) NOT NULL,
  `network` char(10) NOT NULL,
  `block_no` char(100) NOT NULL,
  `height` bigint(25) NOT NULL DEFAULT '0',
  `index_no` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `txid` varchar(100) NOT NULL,
  `confirmations` int(10) NOT NULL,
  `from_address` varchar(100) NOT NULL,
  `to_address` varchar(100) NOT NULL,
  `usdt_nums` bigint(20) NOT NULL,
  `token` varchar(100) NOT NULL,
  `uid` bigint(25) NOT NULL,
  `update_time` int(11) NOT NULL DEFAULT '0',
  `finished` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否入帐',
  `transfer_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0转出1转入'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 插入之前先把表清空（truncate） `xn_recharge_record`
--

TRUNCATE TABLE `xn_recharge_record`;
-- --------------------------------------------------------

--
-- 表的结构 `xn_sys_notice`
--

CREATE TABLE IF NOT EXISTS `xn_sys_notice` (
  `id` int(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `contents` text NOT NULL,
  `create_time` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 插入之前先把表清空（truncate） `xn_sys_notice`
--

TRUNCATE TABLE `xn_sys_notice`;
--
-- 转存表中的数据 `xn_sys_notice`
--

INSERT INTO `xn_sys_notice` (`id`, `title`, `contents`, `create_time`) VALUES
(1, '享最优汇率，卖币最高可上浮1%', '', 1657033407),
(3, '免实名（KYC）认证卖币', '<p><img src="/ueditor/php/upload/image/20211023/1634927303806846.jpg" title="1634927303806846.jpg" alt="x4.jpg"/><br/></p>', 1657033422);

-- --------------------------------------------------------

--
-- 表的结构 `xn_trading_partner`
--

CREATE TABLE IF NOT EXISTS `xn_trading_partner` (
  `id` bigint(20) NOT NULL,
  `order_number` varchar(50) NOT NULL,
  `uid` bigint(20) NOT NULL,
  `partner_username` varchar(50) NOT NULL COMMENT '对象用户名',
  `partner_uid` bigint(20) NOT NULL,
  `praise` int(11) DEFAULT NULL COMMENT '好评',
  `bad` int(11) DEFAULT NULL COMMENT '差评',
  `trusted_user` tinyint(4) DEFAULT NULL COMMENT '可信用户',
  `masked_user` tinyint(4) DEFAULT NULL COMMENT '屏蔽的用户',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `create_time` int(11) NOT NULL,
  `contacts` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否联系人'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='交易对象';

--
-- 插入之前先把表清空（truncate） `xn_trading_partner`
--

TRUNCATE TABLE `xn_trading_partner`;
-- --------------------------------------------------------

--
-- 表的结构 `xn_transfer_config`
--

CREATE TABLE IF NOT EXISTS `xn_transfer_config` (
  `id` tinyint(1) NOT NULL,
  `amount` int(10) NOT NULL,
  `default_free` float(10,2) NOT NULL,
  `transfer_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0全手工 1 全自动   2 多少钱以下自动转帐  3  多少钱以上自动转帐',
  `platform_free_charge` tinyint(1) NOT NULL DEFAULT '0' COMMENT '内转免费',
  `commission` int(10) NOT NULL DEFAULT '0' COMMENT '每笔固定抽水',
  `timeout` int(11) NOT NULL COMMENT '超时时间分钟'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='平台转帐设置';

--
-- 插入之前先把表清空（truncate） `xn_transfer_config`
--

TRUNCATE TABLE `xn_transfer_config`;
--
-- 转存表中的数据 `xn_transfer_config`
--

INSERT INTO `xn_transfer_config` (`id`, `amount`, `default_free`, `transfer_status`, `platform_free_charge`, `commission`, `timeout`) VALUES
(1, 5000, 0.00, 2, 1, 1, 30);

-- --------------------------------------------------------

--
-- 表的结构 `xn_transfer_record`
--

CREATE TABLE IF NOT EXISTS `xn_transfer_record` (
  `id` bigint(25) NOT NULL,
  `uid` bigint(25) NOT NULL,
  `form_address` varchar(100) NOT NULL,
  `to_address` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `txid` varchar(100) NOT NULL,
  `type` char(5) NOT NULL DEFAULT '0' COMMENT '支付主链类型',
  `free` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '手续费',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `arrival` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '实到帐',
  `order_no` varchar(50) DEFAULT NULL COMMENT '订单号',
  `amount` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '转帐金额'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户转账记录';

--
-- 插入之前先把表清空（truncate） `xn_transfer_record`
--

TRUNCATE TABLE `xn_transfer_record`;
-- --------------------------------------------------------

--
-- 表的结构 `xn_trans_gas_log`
--

CREATE TABLE IF NOT EXISTS `xn_trans_gas_log` (
  `id` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `create_time` int(11) NOT NULL,
  `info` varchar(100) NOT NULL,
  `txid` varchar(200) NOT NULL,
  `type` char(10) DEFAULT NULL,
  `trx` float(10,4) NOT NULL DEFAULT '0.0000',
  `eth` float(10,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 插入之前先把表清空（truncate） `xn_trans_gas_log`
--

TRUNCATE TABLE `xn_trans_gas_log`;
-- --------------------------------------------------------

--
-- 表的结构 `xn_upload_files`
--

CREATE TABLE IF NOT EXISTS `xn_upload_files` (
  `id` int(11) unsigned NOT NULL,
  `storage` tinyint(1) DEFAULT '0' COMMENT '存储位置 0本地',
  `app` smallint(4) DEFAULT '0' COMMENT '来自应用 0前台 1后台',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '根据app类型判断用户类型',
  `file_name` varchar(100) DEFAULT '',
  `file_size` int(11) DEFAULT '0',
  `extension` varchar(10) DEFAULT '' COMMENT '文件后缀',
  `url` varchar(500) DEFAULT '' COMMENT '图片路径',
  `create_time` int(11) DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=443 DEFAULT CHARSET=utf8;

--
-- 插入之前先把表清空（truncate） `xn_upload_files`
--

TRUNCATE TABLE `xn_upload_files`;
--
-- 转存表中的数据 `xn_upload_files`
--

INSERT INTO `xn_upload_files` (`id`, `storage`, `app`, `user_id`, `file_name`, `file_size`, `extension`, `url`, `create_time`) VALUES
(335, 0, 1, 1, 'logo2.png', 9451, 'png', '/uploads/20200318/137b548c5ece2e8efc3dfa54c0b3f7e1.png', 1584527929),
(340, 0, 1, 1, 'a.jpg', 210328, 'jpg', '/uploads/file/20220407/7e1cf7e5aae4734da96628d95b770cf9.jpg', 1649266267),
(341, 0, 1, 1, 'jj20.jpg', 451649, 'jpg', '/uploads/file/20220407/b8a46537594fd5e168b48a8e5a0d38a2.jpg', 1649266374),
(342, 0, 1, 1, 'jj20.jpg', 451649, 'jpg', '/uploads/file/20220407/9f9782218ec701f5abba2296dc61d88a.jpg', 1649267158),
(343, 0, 1, 1, 'a.jpg', 210328, 'jpg', '/uploads/file/20220407/d496928720ca65b9b239427c311ee624.jpg', 1649267516),
(344, 0, 1, 1, 'jj20.jpg', 451649, 'jpg', '/uploads/file/20220407/0e9f8e11bfa751d0f4e0649fb564f68a.jpg', 1649267518),
(345, 0, 1, 1, 'x4.jpg', 245870, 'jpg', '/uploads/file/20220407/d0da7ced959d9d190463c46f8f1027ee.jpg', 1649267523),
(346, 0, 1, 1, 'a.jpg', 210328, 'jpg', '/uploads/file/20220407/6af1483059d1dd468d9eea30677ea227.jpg', 1649268325),
(347, 0, 1, 1, 'jj20.jpg', 451649, 'jpg', '/uploads/file/20220407/7b8644f680c621835f8ab36f5829f6fa.jpg', 1649268330),
(348, 0, 1, 1, 'x4.jpg', 245870, 'jpg', '/uploads/file/20220407/4c1f51700d95620341e2c9bc7c5a9bda.jpg', 1649268335),
(349, 0, 1, 1, 'a.jpg', 210328, 'jpg', '/uploads/file/20220407/7a61974212b33ebd7adc0b99ff0d0bb2.jpg', 1649268591),
(350, 0, 1, 1, 'jj20.jpg', 451649, 'jpg', '/uploads/file/20220407/06f17d7726dc1c8c69429d014b2d57c0.jpg', 1649268596),
(351, 0, 1, 1, 'x4.jpg', 245870, 'jpg', '/uploads/file/20220407/8d3c482c24f220396948367b4cdf5373.jpg', 1649268602),
(352, 0, 1, 1, 'a.jpg', 210328, 'jpg', '/uploads/file/20220407/95190bbbf74d1e99f6db152495a689cb.jpg', 1649268755),
(353, 0, 1, 1, 'jj20.jpg', 451649, 'jpg', '/uploads/file/20220407/26ff9ead3d49f2397321fbec1586bf9e.jpg', 1649268766),
(354, 0, 1, 1, 'x4.jpg', 245870, 'jpg', '/uploads/file/20220407/7f7490047383fdbd1bd20a2380c2507d.jpg', 1649268772),
(355, 0, 1, 1, 'x4.jpg', 245870, 'jpg', '/uploads/file/20220407/f6dd8b8c1e201b37f11cf70ad471802e.jpg', 1649269104),
(356, 0, 1, 1, 'jj20.jpg', 451649, 'jpg', '/uploads/file/20220407/ca838f4da7267200c21a02f3c1e1cecc.jpg', 1649269251),
(357, 0, 1, 1, 'jj20.jpg', 451649, 'jpg', '/uploads/file/20220407/4a55c2de10a8bf3662b382d0062351de.jpg', 1649269294),
(358, 0, 1, 1, 'a.jpg', 210328, 'jpg', '/uploads/file/20220407/514b2ee8bf2975540188c77b901dc83b.jpg', 1649269788),
(359, 0, 1, 1, 'a.jpg', 210328, 'jpg', '/uploads/file/20220407/4baf59e7fa1cc900d8522ffa2aa94dbf.jpg', 1649272147),
(360, 0, 1, 1, 'jj20.jpg', 451649, 'jpg', '/uploads/file/20220407/58d9e7332cf9450215554faf0baeffd1.jpg', 1649272147),
(361, 0, 1, 1, 'jj20.jpg', 451649, 'jpg', '/uploads/file/20220407/7194af0e304f6018d26a85ca73de4f55.jpg', 1649272152),
(362, 0, 1, 1, 'x4.jpg', 245870, 'jpg', '/uploads/file/20220407/9124de1904af239921f95437a44f047f.jpg', 1649272395),
(363, 0, 1, 1, 'QQ截图20220413144143.png', 15772, 'png', '/uploads/file/20220429/d141e50e80caa3c58e4094a61efec77c.png', 1651217434),
(364, 0, 1, 1, 'QQ截图20220413144143.png', 15772, 'png', '/uploads/file/20220429/d16ddb9002e98e843b7d40ab05b454ae.png', 1651217468),
(365, 0, 1, 1, 'QQ截图20220413144143.png', 15772, 'png', '/uploads/file/20220430/0961c072c9fd79b0f816e8771ce23774.png', 1651280865),
(366, 0, 1, 1, 'QQ截图20220413144143.png', 15772, 'png', '/uploads/file/20220505/9a05bddb7357c99369d69cd61f95c997.png', 1651716763),
(369, 2, 1, 1, 'QQ截图20220413144143.png', 15772, 'png', 'http://qwe.cqalhg.com/20220505/165173240188186.png', 1651732401),
(368, 2, 1, 1, 'QQ截图20220413144143.png', 15772, 'png', 'http://qwe.cqalhg.com/20220505/e0d30ebab95035dafa80fd38191c2fe1.png', 1651719538),
(370, 2, 1, 1, '3954836055992f32.png', 62616, 'png', 'http://qwe.cqalhg.com/20220505/165173273498297.png', 1651732735),
(371, 2, 1, 1, '3954836055992f32.png', 62616, 'png', 'http://qwe.cqalhg.com/20220505/165173284492487.png', 1651732845),
(372, 2, 1, 1, 'QQ图片20220416095816.png', 721377, 'png', 'http://qwe.cqalhg.com/20220505/165173294367488.png', 1651732943),
(373, 2, 1, 1, 'QQ图片20220416095808.png', 978793, 'png', 'http://qwe.cqalhg.com/20220505/165173300318116.png', 1651733004),
(374, 2, 1, 1, '39453e16abe502c9.png', 35724, 'png', 'http://qwe.cqalhg.com/20220505/165173307381229.png', 1651733073),
(375, 2, 1, 1, '2851c1ad5cb23d14.png', 52333, 'png', 'http://qwe.cqalhg.com/20220505/165173315278412.png', 1651733153),
(376, 2, 1, 1, '3954836055992f32.png', 62616, 'png', 'http://qwe.cqalhg.com/20220505/165173449260837.png', 1651734493),
(377, 2, 1, 1, '2851c1ad5cb23d14.png', 52333, 'png', 'http://qwe.cqalhg.com/20220505/165173518999691.png', 1651735189),
(378, 2, 1, 1, '39453e16abe502c9.png', 35724, 'png', 'http://qwe.cqalhg.com/20220505/165173526169636.png', 1651735262),
(379, 2, 1, 1, 'QQ图片20220416095801.png', 263355, 'png', 'http://qwe.cqalhg.com/20220505/165173563887472.png', 1651735639),
(380, 2, 1, 1, 'QQ图片20220416095801.png', 263355, 'png', 'http://qwe.cqalhg.com/20220505/165173567470918.png', 1651735674),
(381, 2, 1, 1, '-4088b1d14fb66b43.png', 34880, 'png', 'http://qwe.cqalhg.com/20220505/165173576941735.png', 1651735770),
(382, 2, 1, 1, '-4088b1d14fb66b43.png', 34880, 'png', 'http://qwe.cqalhg.com/20220505/165173673210078.png', 1651736733),
(383, 2, 1, 1, '39453e16abe502c9.png', 35724, 'png', 'http://qwe.cqalhg.com/20220505/165173678328431.png', 1651736783),
(384, 2, 1, 1, '2851c1ad5cb23d14.png', 52333, 'png', 'http://qwe.cqalhg.com/20220507/165188925818697.png', 1651889258),
(385, 2, 1, 1, '3954836055992f32.png', 62616, 'png', 'http://qwe.cqalhg.com/20220507/165188948135098.png', 1651889482),
(386, 2, 1, 1, '1652328404010_1648708068549.png', 195687, 'png', 'http://qwe.cqalhg.com/20220512/165232840382851.png', 1652328405),
(387, 2, 1, 1, '1652519794189_Screenshot_2022-04-21-15-40-05-45.png', 873659, 'png', 'http://qwe.cqalhg.com/20220514/165251979484495.png', 1652519795),
(388, 2, 1, 1, '1652520160963_Screenshot_2022-04-21-15-40-05-45.png', 873659, 'png', 'http://qwe.cqalhg.com/20220514/165252016150886.png', 1652520161),
(389, 2, 1, 1, '1652520179358_Screenshot_2022-04-16-09-54-46-44.png', 457738, 'png', 'http://qwe.cqalhg.com/20220514/165252017829279.png', 1652520179),
(390, 2, 1, 1, '-4088b1d14fb66b43.png', 34880, 'png', 'http://qwe.cqalhg.com/20220514/165252064790481.png', 1652520648),
(391, 2, 1, 1, '3954836055992f32.png', 62616, 'png', 'http://qwe.cqalhg.com/20220514/165252066218188.png', 1652520662),
(392, 2, 1, 1, '39453e16abe502c9.png', 35724, 'png', 'http://qwe.cqalhg.com/20220514/165252228328321.png', 1652522284),
(393, 2, 1, 1, '-4088b1d14fb66b43.png', 34880, 'png', 'http://qwe.cqalhg.com/20220514/165252228815861.png', 1652522288),
(394, 2, 1, 1, '2851c1ad5cb23d14.png', 52333, 'png', 'http://qwe.cqalhg.com/20220514/165252265238936.png', 1652522653),
(395, 2, 1, 1, '3954836055992f32.png', 62616, 'png', 'http://qwe.cqalhg.com/20220514/165252265827080.png', 1652522658),
(396, 2, 1, 1, '1652916043652_b727f805336208df0fde3a1c94d326ef.jpg', 43177, 'jpg', 'http://qwe.cqalhg.com/20220519/165291604596107.jpg', 1652916045),
(397, 2, 1, 1, '1652916059757_wx_camera_1629765456691.jpg', 92178, 'jpg', 'http://qwe.cqalhg.com/20220519/165291605844682.jpg', 1652916058),
(398, 2, 1, 1, '1652916193691_b727f805336208df0fde3a1c94d326ef.jpg', 43177, 'jpg', 'http://qwe.cqalhg.com/20220519/165291619155800.jpg', 1652916192),
(399, 2, 1, 1, '1652916204476_wx_camera_1629765456691.jpg', 92178, 'jpg', 'http://qwe.cqalhg.com/20220519/165291620222553.jpg', 1652916203),
(400, 2, 1, 1, '1652916266551_b727f805336208df0fde3a1c94d326ef.jpg', 43177, 'jpg', 'http://qwe.cqalhg.com/20220519/165291626424718.jpg', 1652916264),
(401, 2, 1, 1, '1652916273452_wx_camera_1629765456691.jpg', 92178, 'jpg', 'http://qwe.cqalhg.com/20220519/165291627131372.jpg', 1652916272),
(402, 2, 1, 1, 'jj20.jpg', 346842, 'jpg', 'http://qwe.cqalhg.com/20220519/165291714813713.jpg', 1652917148),
(403, 2, 1, 1, 'a.jpg', 168043, 'jpg', 'http://qwe.cqalhg.com/20220519/165291843961945.jpg', 1652918439),
(404, 2, 1, 1, 'a.jpg', 168043, 'jpg', 'http://qwe.cqalhg.com/20220519/165291844631744.jpg', 1652918446),
(405, 2, 1, 1, 'jj20.jpg', 346842, 'jpg', 'http://qwe.cqalhg.com/20220519/165291849329770.jpg', 1652918494),
(406, 2, 1, 1, 'jj20.jpg', 346842, 'jpg', 'http://qwe.cqalhg.com/20220519/165291850348386.jpg', 1652918504),
(407, 2, 1, 1, 'a.jpg', 168043, 'jpg', 'http://qwe.cqalhg.com/20220519/165291864286324.jpg', 1652918644),
(408, 2, 1, 1, 'jj20.jpg', 346842, 'jpg', 'http://qwe.cqalhg.com/20220519/165291865585375.jpg', 1652918655),
(409, 2, 1, 1, 'a.jpg', 168043, 'jpg', 'http://qwe.cqalhg.com/20220519/165291880599735.jpg', 1652918806),
(410, 2, 1, 1, 'jj20.jpg', 346842, 'jpg', 'http://qwe.cqalhg.com/20220519/165291881233484.jpg', 1652918813),
(411, 2, 1, 1, 'a.jpg', 168043, 'jpg', 'http://qwe.cqalhg.com/20220519/165291885694379.jpg', 1652918857),
(412, 2, 1, 1, 'jj20.jpg', 346842, 'jpg', 'http://qwe.cqalhg.com/20220519/165291886244648.jpg', 1652918862),
(413, 2, 1, 1, '-52d47d974a89835f.png', 27480, 'png', 'http://qwe.cqalhg.com/20220519/165294390178145.png', 1652943902),
(414, 2, 1, 1, 'mmexport1648461392049.jpg', 28938, 'jpg', 'http://qwe.cqalhg.com/20220519/165294390645174.jpg', 1652943906),
(415, 2, 1, 1, '-7f3b655db8e34376.png', 31597, 'png', 'http://qwe.cqalhg.com/20220519/165294542182786.png', 1652945421),
(416, 2, 1, 1, '-4088b1d14fb66b43.png', 34880, 'png', 'http://qwe.cqalhg.com/20220519/165294542579677.png', 1652945426),
(417, 2, 1, 1, '-52d47d974a89835f.png', 27480, 'png', 'http://qwe.cqalhg.com/20220519/165294547822273.png', 1652945478),
(418, 2, 1, 1, '2851c1ad5cb23d14.png', 52333, 'png', 'http://qwe.cqalhg.com/20220519/165294548127280.png', 1652945482),
(419, 2, 1, 1, '-52d47d974a89835f.png', 27480, 'png', 'http://qwe.cqalhg.com/20220519/165294555755733.png', 1652945558),
(420, 2, 1, 1, '-4088b1d14fb66b43.png', 34880, 'png', 'http://qwe.cqalhg.com/20220519/165294556310867.png', 1652945564),
(421, 2, 1, 1, '1652955503829.jpg', 72797, 'jpg', 'http://qwe.cqalhg.com/20220519/165295551061359.jpg', 1652955510),
(422, 2, 1, 1, '1652962862280_IMG_20220516_205845_040.jpg', 62546, 'jpg', 'http://qwe.cqalhg.com/20220519/165296287942419.jpg', 1652962879),
(423, 2, 1, 1, '1652962874880_IMG_20220516_205846_072.jpg', 85557, 'jpg', 'http://qwe.cqalhg.com/20220519/165296289470171.jpg', 1652962895),
(424, 2, 1, 1, '1652963013292.jpg', 66168, 'jpg', 'http://qwe.cqalhg.com/20220519/165296302898777.jpg', 1652963029),
(425, 2, 1, 1, '1652994518806_b727f805336208df0fde3a1c94d326ef.jpg', 43177, 'jpg', 'http://qwe.cqalhg.com/20220520/165299451612029.jpg', 1652994516),
(426, 2, 1, 1, '1652994533120_wx_camera_1629765456691.jpg', 92178, 'jpg', 'http://qwe.cqalhg.com/20220520/165299453018434.jpg', 1652994530),
(427, 2, 1, 1, '1653113355151_b727f805336208df0fde3a1c94d326ef.jpg', 43177, 'jpg', 'http://qwe.cqalhg.com/20220521/165311335469502.jpg', 1653113355),
(428, 2, 1, 1, '3954836055992f32.png', 62616, 'png', 'http://qwe.cqalhg.com/20220525/165346771321410.png', 1653467714),
(429, 2, 1, 1, '39453e16abe502c9.png', 35724, 'png', 'http://qwe.cqalhg.com/20220526/165353096031833.png', 1653530960),
(430, 2, 1, 1, 'mmexport1649921720012.jpg', 281964, 'jpg', 'http://qwe.cqalhg.com/20220526/165353098528996.jpg', 1653530985),
(431, 2, 1, 1, 'logo.png', 125697, 'png', 'http://qwe.cqalhg.com/20220526/165353100250049.png', 1653531003),
(432, 2, 1, 1, '3954836055992f32.png', 62616, 'png', 'http://qwe.cqalhg.com/20220526/165353122037439.png', 1653531221),
(433, 2, 1, 1, 'logo.png', 125697, 'png', 'http://qwe.cqalhg.com/20220526/165353163062591.png', 1653531630),
(434, 2, 1, 1, '-4088b1d14fb66b43.png', 34880, 'png', 'http://qwe.cqalhg.com/20220526/165354480527146.png', 1653544806),
(435, 2, 1, 1, '1653914175706_e88d7b397a3f5c029439fed6ae3b2ed8.jpg', 176284, 'jpg', 'http://qwe.cqalhg.com/20220530/165391417482483.jpg', 1653914174),
(436, 2, 1, 1, '1653914449543_Screenshot_20220527_163714_uni.UNIEC82119.jpg', 143312, 'jpg', 'http://qwe.cqalhg.com/20220530/165391444819236.jpg', 1653914448),
(437, 2, 1, 1, '1654500851926_IMG_20220522_141145.jpg', 21794, 'jpg', 'http://qwe.cqalhg.com/20220606/165450085218333.jpg', 1654500852),
(438, 2, 1, 1, '-52d47d974a89835f.png', 27480, 'png', 'http://qwe.cqalhg.com/20220616/165536002352928.png', 1655360024),
(439, 2, 1, 1, '-7f3b655db8e34376.png', 31597, 'png', 'http://qwe.cqalhg.com/20220616/165536003755675.png', 1655360037),
(440, 2, 1, 1, '1655794525254_1655794517091.jpg', 68486, 'jpg', 'http://qwe.cqalhg.com/20220621/165579452534436.jpg', 1655794525),
(441, 2, 1, 1, 'user2-160x160.jpg', 6053, 'jpg', 'http://qwe.cqalhg.com/20220621/5c9391eb308631313fd9dbd7dfe28e31.jpg', 1655809456),
(442, 2, 1, 1, '2232.png', 30, 'png', 'http://qwe.cqalhg.com/20220621/7a94163350138d7aa365abcb4648bcc7.png', 1655809621);

-- --------------------------------------------------------

--
-- 表的结构 `xn_user`
--

CREATE TABLE IF NOT EXISTS `xn_user` (
  `id` int(11) unsigned NOT NULL,
  `username` varchar(60) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(64) NOT NULL DEFAULT '' COMMENT '登录密码；mb_password加密',
  `pid` int(10) NOT NULL DEFAULT '0' COMMENT '推荐人id',
  `trans_password` varchar(64) DEFAULT NULL COMMENT '交易密码',
  `avatar` varchar(255) NOT NULL DEFAULT '' COMMENT '用户头像，相对于upload/avatar目录',
  `email` varchar(100) NOT NULL DEFAULT '' COMMENT '登录邮箱',
  `citycode` varchar(10) DEFAULT NULL COMMENT '国家区号',
  `phone` bigint(20) DEFAULT NULL COMMENT '手机号',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户状态 0：禁用； 1：正常',
  `register_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `last_login_ip` varchar(16) NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `remark` varchar(100) DEFAULT NULL,
  `usdt_nums` float(10,2) NOT NULL DEFAULT '0.00' COMMENT 'usdt数量',
  `score` int(10) NOT NULL DEFAULT '0' COMMENT '积分余额',
  `identification` varchar(50) DEFAULT NULL COMMENT '身份证号',
  `transactions_num` int(10) NOT NULL DEFAULT '0' COMMENT '交易次数',
  `quota` int(11) NOT NULL COMMENT '交易限额',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `phone_yz` tinyint(1) DEFAULT '0' COMMENT '手机验证0关1开',
  `email_yz` tinyint(1) DEFAULT '0' COMMENT '邮箱验证0关1开',
  `verification_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '谷歌验证0关1开',
  `qr_code_url` varchar(200) DEFAULT NULL COMMENT '谷歌验证',
  `google_secret` varchar(30) DEFAULT NULL COMMENT '谷歌密钥',
  `msg_login_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '短信登陆开关',
  `session_id` varchar(50) DEFAULT NULL COMMENT 'sessionid',
  `frozen_usdt` float(10,4) NOT NULL DEFAULT '0.0000' COMMENT '转帐冻结金额',
  `renzheng1` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否初级认证0未认证1通过2待审核',
  `renzheng2` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否高级认证0未认证1通过2待审核',
  `niname` varchar(50) NOT NULL COMMENT '呢称'
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- 插入之前先把表清空（truncate） `xn_user`
--

TRUNCATE TABLE `xn_user`;
--
-- 转存表中的数据 `xn_user`
--

INSERT INTO `xn_user` (`id`, `username`, `password`, `pid`, `trans_password`, `avatar`, `email`, `citycode`, `phone`, `status`, `register_time`, `last_login_ip`, `last_login_time`, `remark`, `usdt_nums`, `score`, `identification`, `transactions_num`, `quota`, `update_time`, `phone_yz`, `email_yz`, `verification_status`, `qr_code_url`, `google_secret`, `msg_login_status`, `session_id`, `frozen_usdt`, `renzheng1`, `renzheng2`, `niname`) VALUES
(1, '18016567006', 'bc2c812d34aefb609595e1c14744d1f5', 0, '4dff674707c1cc9f0dc655d8d7b520f4', '', '18016567006@qq.com', '+86', 18016567006, 1, 1663162056, '', 1682173746, NULL, 5020.00, 0, NULL, 0, 10, NULL, 1, 0, 0, NULL, NULL, 0, '3b8f147fcde6171c8bf29a3a398dc069', 0.0000, 0, 0, '6i7IGx'),
(2, '', '24026eee8538c996f677ee775d316013', 0, '24026eee8538c996f677ee775d316013', '', '56190610@qq.com', NULL, NULL, 1, 1663167260, '', 1663167288, NULL, 500.00, 0, NULL, 0, 10, NULL, 0, 0, 0, NULL, NULL, 0, 'dd54da3f386c094e5752d403cbe02b21', 0.0000, 0, 0, 'cBCH2Y'),
(3, '', '24026eee8538c996f677ee775d316013', 0, '978d5f8a157e92da38f69291d7f1b2bb', '', '56190160@qq.com', NULL, NULL, 1, 1663167335, '', 1663256513, NULL, 1000.00, 0, NULL, 0, 10, 1663175951, 0, 0, 0, NULL, NULL, 0, '8998d1a924c3155f0e816daa6f29bf8f', 0.0000, 1, 1, 'GclHCO'),
(4, '', '24026eee8538c996f677ee775d316013', 0, '24026eee8538c996f677ee775d316013', '', '64991359@qq.com', NULL, NULL, 1, 1663167773, '', 1682178217, NULL, 1327.94, 0, NULL, 0, 10, 1663172375, 0, 1, 0, NULL, NULL, 0, '478c1ed6d8207be5c07d9ba0b4ae7c3b', 0.0000, 0, 0, 'VfTtuh');

-- --------------------------------------------------------

--
-- 表的结构 `xn_user_address`
--

CREATE TABLE IF NOT EXISTS `xn_user_address` (
  `id` bigint(20) NOT NULL,
  `uid` bigint(20) NOT NULL,
  `trc_address` varchar(100) NOT NULL,
  `trc_qrcode_url` varchar(200) NOT NULL,
  `erc_address` varchar(100) NOT NULL,
  `erc_qrcode_url` varchar(200) NOT NULL,
  `trx_usdt_nums` float(10,6) NOT NULL,
  `eth_usdt_nums` float(10,6) NOT NULL,
  `create_time` int(11) NOT NULL COMMENT '生成时间',
  `trc20_key` varchar(200) DEFAULT NULL,
  `erc20_key` varchar(200) DEFAULT NULL,
  `trx_free` float(10,6) NOT NULL DEFAULT '0.000000' COMMENT '燃料费',
  `eth_free` float(10,6) NOT NULL DEFAULT '0.000000' COMMENT '燃料费',
  `txCount` int(10) NOT NULL DEFAULT '0',
  `ethCount` int(10) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `is_auth` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0无1trc2erc3全部',
  `run_time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- 插入之前先把表清空（truncate） `xn_user_address`
--

TRUNCATE TABLE `xn_user_address`;
--
-- 转存表中的数据 `xn_user_address`
--

INSERT INTO `xn_user_address` (`id`, `uid`, `trc_address`, `trc_qrcode_url`, `erc_address`, `erc_qrcode_url`, `trx_usdt_nums`, `eth_usdt_nums`, `create_time`, `trc20_key`, `erc20_key`, `trx_free`, `eth_free`, `txCount`, `ethCount`, `update_time`, `is_auth`, `run_time`) VALUES
(1, 1, 'TAZeLypbzpvn21uE6DvF1SF35XoyhncdzQ', 'https://www.mayixitong.site/phpqrcode/20220914/971663162061.png', '0x8e628b7056f9792cf0a353870ec10db1301239f9', 'https://www.mayixitong.site/phpqrcode/20220914/771663162060.png', 0.000000, 0.000000, 1663162061, '0xfca19494f1f94bea7bd9ae99730375e819ff749ae77742e03f6e6eaf7a2b7385', '9045e27f3495811214aa5cae600a46ba90d2d5b3f19c2edae45bcdcc46b67678', 4.000000, 0.000000, 0, 0, 1665321513, 0, 1682100427),
(2, 2, 'TW4rrMZRzPKYR9tjPzqS6ebETSQvL2Ky1r', 'https://www.mayixitong.site/phpqrcode/20220914/531663167264.png', '0xa560f359ed8c654e6fe9f73ae96d074518d78a76', 'https://www.mayixitong.site/phpqrcode/20220914/271663167263.png', 0.000000, 0.000000, 1663167264, '0xecc91a54367a21834e72ea43e4b5588a708de815b09e5a579ca672a48a297eec', '10573c11fdd66bb643bccf514a2522fc1e37ea917b6c9f90d7e18dec425c9dbb', 0.000000, 0.000000, 0, 0, 0, 0, 1682100427),
(3, 3, 'TJAyfmQVUNyuJmfe4Ey4WfSv1yTEcStYAR', 'https://www.mayixitong.site/phpqrcode/20220914/131663167341.png', '0xe37987e35a3bc2d87c4057e605d9a53fd0d72779', 'https://www.mayixitong.site/phpqrcode/20220914/671663167340.png', 0.000000, 0.000000, 1663167340, '0xe15705d37069f7c9bbc1d9ba31415a3edbc1cb04794bd23b1db4dcd6deafa877', 'a9bb0bbe1380ecdd83ac11f7dee880cda41cdd91395c5159b24f4b630886d794', 0.000000, 0.000000, 0, 0, 0, 0, 1682100427),
(4, 4, 'TA6NymRqdkunxVu7E7EKBk1deufCtxduoe', 'https://www.mayixitong.site/phpqrcode/20220914/711663167789.png', '0x4d76e2e5943eab0283ca75fe3687d5a36acef1d3', 'https://www.mayixitong.site/phpqrcode/20220914/851663167788.png', 0.000000, 0.000000, 1663167789, '0xebfa3b61ccc5f7f26fa178c362347f749d2f6dba74388514b9cbf178a33c37fe', '31b6fd8645729368e98828b9e426614f59327fad62737762daf4ed76be91af64', 0.000000, 0.000000, 0, 0, 0, 0, 1682100427);

-- --------------------------------------------------------

--
-- 表的结构 `xn_user_info`
--

CREATE TABLE IF NOT EXISTS `xn_user_info` (
  `id` bigint(20) NOT NULL COMMENT 'id',
  `uid` bigint(20) NOT NULL COMMENT '帐号id',
  `vip_level` tinyint(1) NOT NULL COMMENT '会员等级',
  `layer_1` int(10) NOT NULL DEFAULT '0' COMMENT '一级下线数量',
  `layer_2` int(10) NOT NULL DEFAULT '0' COMMENT '二级下线',
  `admin_forzen_amount` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '管理员冻结金额',
  `trans_ok_times` int(10) NOT NULL DEFAULT '0' COMMENT '交易次数',
  `trans_fail_times` int(10) NOT NULL DEFAULT '0' COMMENT '失败交易次数',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) DEFAULT NULL COMMENT '更新时间',
  `notice_update_time` int(10) DEFAULT NULL COMMENT '公告更新时间',
  `true_name` varchar(50) DEFAULT NULL COMMENT '真实姓名',
  `q1` varchar(100) DEFAULT NULL COMMENT '问答',
  `q2` varchar(100) DEFAULT NULL COMMENT '问答',
  `q3` varchar(100) DEFAULT NULL COMMENT '问答',
  `a1` varchar(100) DEFAULT NULL COMMENT '问答',
  `a2` varchar(100) DEFAULT NULL COMMENT '问答',
  `a3` varchar(100) DEFAULT NULL COMMENT '问答',
  `ding` int(10) NOT NULL DEFAULT '0' COMMENT '好评',
  `cai` int(10) NOT NULL DEFAULT '0' COMMENT '差评'
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8 COMMENT='用户信息扩展表';

--
-- 插入之前先把表清空（truncate） `xn_user_info`
--

TRUNCATE TABLE `xn_user_info`;
--
-- 转存表中的数据 `xn_user_info`
--

INSERT INTO `xn_user_info` (`id`, `uid`, `vip_level`, `layer_1`, `layer_2`, `admin_forzen_amount`, `trans_ok_times`, `trans_fail_times`, `create_time`, `update_time`, `notice_update_time`, `true_name`, `q1`, `q2`, `q3`, `a1`, `a2`, `a3`, `ding`, `cai`) VALUES
(5, 44, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, '', '', '', '', '', '', 0, 0),
(6, 50, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(7, 51, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(8, 52, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(9, 53, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(10, 54, 1, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(11, 55, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(12, 56, 1, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(13, 57, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(14, 58, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(15, 59, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(16, 60, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(17, 61, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(18, 62, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(19, 63, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(20, 64, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(21, 66, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(22, 70, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(23, 71, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(26, 83, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(27, 84, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(29, 86, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(31, 88, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(32, 89, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(33, 90, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(34, 91, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(35, 92, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(36, 93, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(37, 94, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(38, 95, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(39, 96, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(40, 97, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(41, 98, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(42, 99, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(43, 100, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(44, 101, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(45, 102, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(46, 103, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(47, 104, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(48, 105, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(49, 106, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(50, 107, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(51, 108, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(52, 109, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(53, 110, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(54, 111, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(55, 112, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(56, 113, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(57, 114, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(58, 115, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(59, 116, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(60, 117, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(61, 118, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(62, 119, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(63, 120, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(64, 121, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(65, 122, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(66, 123, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(67, 124, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(68, 1, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(69, 2, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(70, 3, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(71, 4, 0, 0, 0, 0.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `xn_user_msg`
--

CREATE TABLE IF NOT EXISTS `xn_user_msg` (
  `id` bigint(20) NOT NULL COMMENT 'id',
  `uid` bigint(20) DEFAULT NULL COMMENT '用户id ',
  `sender` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1平台管理员0系统发送',
  `title` varchar(50) DEFAULT NULL COMMENT '标题',
  `contents` varchar(250) DEFAULT NULL COMMENT '内容',
  `has_readed` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未读，1已读',
  `create_time` int(10) DEFAULT NULL COMMENT '生成时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户信息';

--
-- 插入之前先把表清空（truncate） `xn_user_msg`
--

TRUNCATE TABLE `xn_user_msg`;
-- --------------------------------------------------------

--
-- 表的结构 `xn_user_operation_log`
--

CREATE TABLE IF NOT EXISTS `xn_user_operation_log` (
  `id` bigint(20) NOT NULL,
  `uid` bigint(20) NOT NULL,
  `create_time` int(11) NOT NULL,
  `contents` varchar(50) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `city` varchar(60) DEFAULT NULL COMMENT '所在地区',
  `information` varchar(30) DEFAULT NULL COMMENT '用户环境信息'
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- 插入之前先把表清空（truncate） `xn_user_operation_log`
--

TRUNCATE TABLE `xn_user_operation_log`;
--
-- 转存表中的数据 `xn_user_operation_log`
--

INSERT INTO `xn_user_operation_log` (`id`, `uid`, `create_time`, `contents`, `ip`, `city`, `information`) VALUES
(1, 1, 1663162070, '用户已登录', '127.0.0.1', '(本机地址)', 'Firefox Mobile(Android Mobile)'),
(2, 2, 1663167288, '用户已登录', '180.130.255.99', '(云南省临沧市)联通', 'Microsoft Edge Mobile(Android '),
(3, 3, 1663167345, '用户已登录', '180.130.255.99', '(云南省临沧市)联通', 'Microsoft Edge Mobile(Android '),
(4, 1, 1663167508, '用户已登录', '127.0.0.1', '(本机地址)', 'Firefox Mobile(Android Mobile)'),
(5, 4, 1663167789, '用户已登录', '127.0.0.1', '(本机地址)', 'Firefox Mobile(Android Mobile)'),
(6, 1, 1663170728, '用户已登录', '127.0.0.1', '(本机地址)', 'Firefox Mobile(Android Mobile)'),
(7, 4, 1663172231, '用户已登录', '127.0.0.1', '(本机地址)', 'Firefox Mobile(Android Mobile)'),
(8, 1, 1663172598, '用户已登录', '127.0.0.1', '(本机地址)', 'Firefox Mobile(Android Mobile)'),
(9, 3, 1663173699, '用户已登录', '180.130.255.99', '(云南省临沧市)联通', 'Microsoft Edge Mobile(Android '),
(10, 3, 1663249982, '用户已登录', '180.130.255.99', '(云南省临沧市)联通', 'Microsoft Edge Mobile(Android '),
(11, 3, 1663256512, '用户已登录', '180.130.255.99', '(云南省临沧市)联通', 'Microsoft Edge Mobile(Android '),
(12, 4, 1663257622, '用户已登录', '127.0.0.1', '(本机地址)', 'Firefox Mobile(Android Mobile)'),
(13, 4, 1663522772, '用户已登录', '127.0.0.1', '(本机地址)', 'Firefox Mobile(Android Mobile)'),
(14, 4, 1666594212, '用户已登录', '127.0.0.1', '(本机地址)', 'Chrome 9(Windows 8)'),
(15, 1, 1682011410, '用户已登录', '185.14.47.167', '(俄罗斯)', 'Microsoft Edge Mobile(Android '),
(16, 4, 1682166206, '用户已登录', '127.0.0.1', '(本机地址)', 'Firefox Mobile(Android Mobile)'),
(17, 4, 1682166207, '用户已登录', '127.0.0.1', '(本机地址)', 'Firefox Mobile(Android Mobile)'),
(18, 1, 1682167267, '用户已登录', '127.0.0.1', '(本机地址)', 'Firefox Mobile(Android Mobile)'),
(19, 1, 1682173746, '用户已登录', '185.14.47.167', '(俄罗斯)', 'Microsoft Edge Mobile(Android '),
(20, 4, 1682175567, '用户已登录', '127.0.0.1', '(本机地址)', 'Firefox Mobile(Android Mobile)'),
(21, 4, 1682178217, '用户已登录', '172.105.113.159', '(新加坡)Linode数据中心', 'Microsoft Edge Mobile(Android ');

-- --------------------------------------------------------

--
-- 表的结构 `xn_wallet_temp`
--

CREATE TABLE IF NOT EXISTS `xn_wallet_temp` (
  `id` bigint(25) NOT NULL,
  `uid` bigint(25) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `create_time` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='钱包地址成生';

--
-- 插入之前先把表清空（truncate） `xn_wallet_temp`
--

TRUNCATE TABLE `xn_wallet_temp`;
--
-- 转存表中的数据 `xn_wallet_temp`
--

INSERT INTO `xn_wallet_temp` (`id`, `uid`, `status`, `create_time`) VALUES
(1, 1, 0, 1663162061),
(2, 2, 0, 1663167264),
(3, 3, 0, 1663167340),
(4, 4, 0, 1663167789);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `xn_address_book`
--
ALTER TABLE `xn_address_book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xn_admin`
--
ALTER TABLE `xn_admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_login_key` (`username`) USING BTREE;

--
-- Indexes for table `xn_admin_log`
--
ALTER TABLE `xn_admin_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xn_auth_group`
--
ALTER TABLE `xn_auth_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xn_auth_group_access`
--
ALTER TABLE `xn_auth_group_access`
  ADD UNIQUE KEY `uid_group_id` (`admin_id`,`group_id`),
  ADD KEY `uid` (`admin_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `xn_auth_rule`
--
ALTER TABLE `xn_auth_rule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xn_banner`
--
ALTER TABLE `xn_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xn_check_balance`
--
ALTER TABLE `xn_check_balance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `xn_commission_links`
--
ALTER TABLE `xn_commission_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `xn_config`
--
ALTER TABLE `xn_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xn_guiji`
--
ALTER TABLE `xn_guiji`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xn_guiji_config`
--
ALTER TABLE `xn_guiji_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xn_identity_auth`
--
ALTER TABLE `xn_identity_auth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xn_order`
--
ALTER TABLE `xn_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xn_order_buy`
--
ALTER TABLE `xn_order_buy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xn_order_config`
--
ALTER TABLE `xn_order_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xn_order_sell`
--
ALTER TABLE `xn_order_sell`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xn_payment`
--
ALTER TABLE `xn_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `xn_recharge_record`
--
ALTER TABLE `xn_recharge_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `xn_sys_notice`
--
ALTER TABLE `xn_sys_notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xn_trading_partner`
--
ALTER TABLE `xn_trading_partner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xn_transfer_config`
--
ALTER TABLE `xn_transfer_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xn_transfer_record`
--
ALTER TABLE `xn_transfer_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `xn_trans_gas_log`
--
ALTER TABLE `xn_trans_gas_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `xn_upload_files`
--
ALTER TABLE `xn_upload_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xn_user`
--
ALTER TABLE `xn_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_login_key` (`username`) USING BTREE;

--
-- Indexes for table `xn_user_address`
--
ALTER TABLE `xn_user_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `uid_2` (`uid`);

--
-- Indexes for table `xn_user_info`
--
ALTER TABLE `xn_user_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uid` (`uid`),
  ADD KEY `uid_2` (`uid`);

--
-- Indexes for table `xn_user_msg`
--
ALTER TABLE `xn_user_msg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xn_user_operation_log`
--
ALTER TABLE `xn_user_operation_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `xn_wallet_temp`
--
ALTER TABLE `xn_wallet_temp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `xn_address_book`
--
ALTER TABLE `xn_address_book`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `xn_admin`
--
ALTER TABLE `xn_admin`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `xn_admin_log`
--
ALTER TABLE `xn_admin_log`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `xn_auth_group`
--
ALTER TABLE `xn_auth_group`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `xn_auth_rule`
--
ALTER TABLE `xn_auth_rule`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `xn_banner`
--
ALTER TABLE `xn_banner`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id',AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `xn_check_balance`
--
ALTER TABLE `xn_check_balance`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `xn_commission_links`
--
ALTER TABLE `xn_commission_links`
  MODIFY `id` bigint(15) NOT NULL AUTO_INCREMENT COMMENT 'id',AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `xn_config`
--
ALTER TABLE `xn_config`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `xn_guiji`
--
ALTER TABLE `xn_guiji`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `xn_guiji_config`
--
ALTER TABLE `xn_guiji_config`
  MODIFY `id` tinyint(1) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `xn_identity_auth`
--
ALTER TABLE `xn_identity_auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `xn_order`
--
ALTER TABLE `xn_order`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `xn_order_buy`
--
ALTER TABLE `xn_order_buy`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `xn_order_config`
--
ALTER TABLE `xn_order_config`
  MODIFY `id` tinyint(1) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `xn_order_sell`
--
ALTER TABLE `xn_order_sell`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `xn_payment`
--
ALTER TABLE `xn_payment`
  MODIFY `id` bigint(25) NOT NULL AUTO_INCREMENT COMMENT 'id',AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `xn_recharge_record`
--
ALTER TABLE `xn_recharge_record`
  MODIFY `id` bigint(25) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `xn_sys_notice`
--
ALTER TABLE `xn_sys_notice`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `xn_trading_partner`
--
ALTER TABLE `xn_trading_partner`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `xn_transfer_config`
--
ALTER TABLE `xn_transfer_config`
  MODIFY `id` tinyint(1) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `xn_transfer_record`
--
ALTER TABLE `xn_transfer_record`
  MODIFY `id` bigint(25) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `xn_trans_gas_log`
--
ALTER TABLE `xn_trans_gas_log`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `xn_upload_files`
--
ALTER TABLE `xn_upload_files`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=443;
--
-- AUTO_INCREMENT for table `xn_user`
--
ALTER TABLE `xn_user`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `xn_user_address`
--
ALTER TABLE `xn_user_address`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `xn_user_info`
--
ALTER TABLE `xn_user_info`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'id',AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `xn_user_msg`
--
ALTER TABLE `xn_user_msg`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- AUTO_INCREMENT for table `xn_user_operation_log`
--
ALTER TABLE `xn_user_operation_log`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `xn_wallet_temp`
--
ALTER TABLE `xn_wallet_temp`
  MODIFY `id` bigint(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
