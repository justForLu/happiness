/*
 Navicat Premium Data Transfer

 Source Server         : 本地数据库
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : happiness

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 30/03/2020 15:14:30
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ss_category
-- ----------------------------
DROP TABLE IF EXISTS `ss_category`;
CREATE TABLE `ss_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '分类名称',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父级分类ID',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '分类类型',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序。越小越靠前',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态。1正常，99禁用',
  `image` varchar(32) NOT NULL DEFAULT '' COMMENT '分类图标',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='网站分类表';

-- ----------------------------
-- Records of ss_category
-- ----------------------------
BEGIN;
INSERT INTO `ss_category` VALUES (1, '行业新闻', 0, 1, 0, 1, '', 1581737949, 0);
INSERT INTO `ss_category` VALUES (2, '公司新闻', 0, 1, 0, 1, '', 1581737974, 1581738606);
COMMIT;

-- ----------------------------
-- Table structure for ss_config
-- ----------------------------
DROP TABLE IF EXISTS `ss_config`;
CREATE TABLE `ss_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '网站标题',
  `copyright` varchar(100) NOT NULL DEFAULT '' COMMENT '网站版权',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='网站配置表';

-- ----------------------------
-- Records of ss_config
-- ----------------------------
BEGIN;
INSERT INTO `ss_config` VALUES (1, '郑州拾叁网络科技有限公司', 'ICP 豫备案号 88888888');
COMMIT;

-- ----------------------------
-- Table structure for ss_event
-- ----------------------------
DROP TABLE IF EXISTS `ss_event`;
CREATE TABLE `ss_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT '' COMMENT '日程标题',
  `content` varchar(255) DEFAULT '' COMMENT '日程内容',
  `username` tinyint(1) DEFAULT '0' COMMENT '添加人',
  `status` tinyint(1) DEFAULT '0' COMMENT '状态',
  `create_time` int(11) DEFAULT '0',
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='日程';

-- ----------------------------
-- Records of ss_event
-- ----------------------------
BEGIN;
INSERT INTO `ss_event` VALUES (1, '测试一下', '测试一下', 1, 1, 1585550659, 1585550947, NULL);
COMMIT;

-- ----------------------------
-- Table structure for ss_example
-- ----------------------------
DROP TABLE IF EXISTS `ss_example`;
CREATE TABLE `ss_example` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '案例标题',
  `image` varchar(32) NOT NULL DEFAULT '' COMMENT '案例图片',
  `desc` varchar(255) NOT NULL DEFAULT '' COMMENT '案例简介',
  `info` text COMMENT '案例详情',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态（1启用，99禁用）',
  `display` varchar(255) NOT NULL DEFAULT '' COMMENT '案例展示图片',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of ss_example
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for ss_feedback
-- ----------------------------
DROP TABLE IF EXISTS `ss_feedback`;
CREATE TABLE `ss_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '姓名',
  `mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '手机号',
  `email` varchar(32) NOT NULL DEFAULT '' COMMENT '邮箱',
  `content` varchar(255) NOT NULL DEFAULT '' COMMENT '反馈内容',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态。1待处理，2已处理',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  `admin_id` int(11) NOT NULL DEFAULT '0' COMMENT '处理人ID',
  `admin_name` varchar(32) NOT NULL DEFAULT '' COMMENT '处理人姓名',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='网站意见反馈表';

-- ----------------------------
-- Records of ss_feedback
-- ----------------------------
BEGIN;
INSERT INTO `ss_feedback` VALUES (1, '张三', '15924140778', '1120414124@qq.com', '元气满满', 2, '', 1, 'admin', 1581664083, 1581666575);
COMMIT;

-- ----------------------------
-- Table structure for ss_file
-- ----------------------------
DROP TABLE IF EXISTS `ss_file`;
CREATE TABLE `ss_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(200) NOT NULL DEFAULT '' COMMENT '文件地址',
  `original_name` varchar(200) NOT NULL DEFAULT '' COMMENT '原始文件名',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '类型',
  `gmt_create` datetime DEFAULT NULL COMMENT '创建时间',
  `gmt_update` datetime DEFAULT NULL,
  `note` varchar(500) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='上传文件表';

-- ----------------------------
-- Records of ss_file
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for ss_happy
-- ----------------------------
DROP TABLE IF EXISTS `ss_happy`;
CREATE TABLE `ss_happy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT '' COMMENT '标题',
  `content` text COMMENT '内容',
  `username` tinyint(1) DEFAULT '0',
  `image` varchar(50) DEFAULT '',
  `category` tinyint(1) DEFAULT '0' COMMENT '生活点滴分类',
  `create_time` int(11) DEFAULT '0',
  `update_time` int(11) DEFAULT '0',
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='生活点滴';

-- ----------------------------
-- Records of ss_happy
-- ----------------------------
BEGIN;
INSERT INTO `ss_happy` VALUES (1, '测试一下下', '<p>ces</p>', 1, '', 1, 1585552286, 1585552286, NULL);
COMMIT;

-- ----------------------------
-- Table structure for ss_link
-- ----------------------------
DROP TABLE IF EXISTS `ss_link`;
CREATE TABLE `ss_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL DEFAULT '' COMMENT '链接标题',
  `url` varchar(120) NOT NULL DEFAULT '' COMMENT '链接地址',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序（越小越靠前）',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态（1启用，99禁用）',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='友情链接表';

-- ----------------------------
-- Records of ss_link
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for ss_manager
-- ----------------------------
DROP TABLE IF EXISTS `ss_manager`;
CREATE TABLE `ss_manager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(100) NOT NULL DEFAULT '' COMMENT '密码',
  `remember_token` varchar(100) NOT NULL DEFAULT '' COMMENT 'session令牌',
  `gmt_last_login` datetime DEFAULT NULL COMMENT '最后登录时间',
  `last_ip` varchar(50) NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `parent` int(11) NOT NULL DEFAULT '0' COMMENT '父级管理员id',
  `path` varchar(100) NOT NULL DEFAULT '' COMMENT '路径',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `is_system` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否系统用户',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='管理员表';

-- ----------------------------
-- Records of ss_manager
-- ----------------------------
BEGIN;
INSERT INTO `ss_manager` VALUES (1, 'admin', '$2y$10$K9ZqSDPveI6zuQjOgJj3OeWibeAevedhv5E6vOSLCo2qizF1GAUw.', 'emzzLmsysCwl2UNFIq2lUrSzYW8MpZv9oyCL6bCPVRb1eCvMVCS5Aak4SS9j', '2020-03-30 14:12:05', '127.0.0.1', 1, '0,1,1,', 1, 1, '2016-11-25 09:40:30', '2020-03-30 14:12:05', NULL);
INSERT INTO `ss_manager` VALUES (2, 'test', '$2y$10$Ujyg8YXL9SGVaqNFf9slbOwNhaWBO3hqvpMEpLozqM8u6E7vP9hZK', 'PtmQwtKVTFPenmidu7NxC7DF1NzOn5DojN2vxkfzIL9WBw6nSfavItdQZOCQ', '2020-02-13 09:46:46', '127.0.0.1', 1, '0,1,1,2,', 1, 0, '2017-11-23 09:28:10', '2019-05-29 06:27:38', NULL);
COMMIT;

-- ----------------------------
-- Table structure for ss_menu
-- ----------------------------
DROP TABLE IF EXISTS `ss_menu`;
CREATE TABLE `ss_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `code` varchar(50) NOT NULL DEFAULT '' COMMENT '编码',
  `parent` int(11) NOT NULL DEFAULT '0' COMMENT '父级id',
  `path` varchar(100) NOT NULL DEFAULT '' COMMENT '路径',
  `url` varchar(200) NOT NULL DEFAULT '' COMMENT '菜单地址',
  `grade` tinyint(4) NOT NULL DEFAULT '0' COMMENT '菜单等级',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '菜单排序',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '菜单状态',
  `module` tinyint(4) NOT NULL DEFAULT '0' COMMENT '所属模块',
  `is_system` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否系统菜单',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COMMENT='菜单表';

-- ----------------------------
-- Records of ss_menu
-- ----------------------------
BEGIN;
INSERT INTO `ss_menu` VALUES (1, '系统配置', 'system', 0, '0,1,1', '/system', 1, 1, 1, 1, 0);
INSERT INTO `ss_menu` VALUES (2, '管理员管理', 'manager', 1, '0,1,2', '/manager', 2, 2, 1, 1, 0);
INSERT INTO `ss_menu` VALUES (3, '角色管理', 'role', 1, '0,1,3', '/role', 2, 3, 1, 1, 0);
INSERT INTO `ss_menu` VALUES (4, '权限管理', 'permission', 1, '0,1,4', '/permission', 2, 4, 1, 1, 1);
INSERT INTO `ss_menu` VALUES (5, '菜单管理', 'menu', 1, '0,1,5', '/menu', 2, 5, 1, 1, 1);
INSERT INTO `ss_menu` VALUES (6, '网站配置', 'config', 1, '0,1,1,15', '/config', 2, 5, 1, 1, 0);
INSERT INTO `ss_menu` VALUES (9, '分类管理', 'category', 1, '0,1,1,19', '/category', 2, 9, 1, 1, 0);
INSERT INTO `ss_menu` VALUES (10, '反馈管理', 'feedback', 1, '0,1,1,20', '/feedback', 2, 10, 1, 1, 0);
INSERT INTO `ss_menu` VALUES (11, '生活', 'life', 0, '0,11,11', '/life', 1, 2, 1, 1, 0);
INSERT INTO `ss_menu` VALUES (12, '日程', 'event', 11, '0,11,12', '/event', 2, 1, 1, 1, 0);
INSERT INTO `ss_menu` VALUES (13, '日记', 'notebook', 11, '0,11,13', '/notebook', 2, 2, 1, 1, 0);
INSERT INTO `ss_menu` VALUES (14, '生活点滴', 'happy', 11, '0,11,14', '/happy', 2, 3, 1, 1, 0);
COMMIT;

-- ----------------------------
-- Table structure for ss_news
-- ----------------------------
DROP TABLE IF EXISTS `ss_news`;
CREATE TABLE `ss_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(120) NOT NULL DEFAULT '' COMMENT '新闻标题',
  `category_id` int(11) NOT NULL DEFAULT '0' COMMENT '分类ID',
  `desc` varchar(255) NOT NULL DEFAULT '' COMMENT '新闻简介',
  `image` varchar(32) NOT NULL DEFAULT '' COMMENT '新闻图片',
  `info` text COMMENT '新闻内容',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序，（越小越靠前）',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态，（1启用，99禁用）',
  `read` int(11) NOT NULL DEFAULT '0' COMMENT '阅读数',
  `admin_id` int(11) NOT NULL DEFAULT '0' COMMENT '作者',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of ss_news
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for ss_notebook
-- ----------------------------
DROP TABLE IF EXISTS `ss_notebook`;
CREATE TABLE `ss_notebook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT '' COMMENT '标题',
  `content` varchar(255) DEFAULT '' COMMENT '内容',
  `username` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `create_time` int(11) DEFAULT '0',
  `update_time` int(11) DEFAULT '0',
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='小本本';

-- ----------------------------
-- Records of ss_notebook
-- ----------------------------
BEGIN;
INSERT INTO `ss_notebook` VALUES (1, '测试一下下', '测试一下下', 1, 1, 1585552021, 1585552021, NULL);
COMMIT;

-- ----------------------------
-- Table structure for ss_permission
-- ----------------------------
DROP TABLE IF EXISTS `ss_permission`;
CREATE TABLE `ss_permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '',
  `code` varchar(255) NOT NULL DEFAULT '',
  `desc` varchar(255) NOT NULL DEFAULT '',
  `menu_id` int(11) NOT NULL DEFAULT '0' COMMENT '所属菜单id',
  `module` tinyint(4) NOT NULL DEFAULT '0' COMMENT '所属模块',
  `is_system` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否系统权限',
  PRIMARY KEY (`id`),
  UNIQUE KEY `wx_permissions_code_unique` (`code`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COMMENT='权限表';

-- ----------------------------
-- Records of ss_permission
-- ----------------------------
BEGIN;
INSERT INTO `ss_permission` VALUES (1, '菜单列表', 'menu.index', '', 5, 1, 1);
INSERT INTO `ss_permission` VALUES (2, '菜单添加', 'menu.create,menu.store', '', 5, 1, 1);
INSERT INTO `ss_permission` VALUES (3, '菜单修改', 'menu.edit,menu.update', '', 5, 1, 1);
INSERT INTO `ss_permission` VALUES (4, '菜单查看', 'menu.show', '', 5, 1, 1);
INSERT INTO `ss_permission` VALUES (5, '菜单删除', 'menu.destroy', '', 5, 1, 1);
INSERT INTO `ss_permission` VALUES (6, '管理员列表', 'manager.index', '', 2, 1, 0);
INSERT INTO `ss_permission` VALUES (7, '管理员添加', 'manager.create,manager.store', '', 2, 1, 0);
INSERT INTO `ss_permission` VALUES (8, '管理员修改', 'manager.edit,manager.update', '', 2, 1, 0);
INSERT INTO `ss_permission` VALUES (9, '管理员查看', 'manager.show', '', 2, 1, 0);
INSERT INTO `ss_permission` VALUES (10, '管理员删除', 'manager.destroy', '', 2, 1, 0);
INSERT INTO `ss_permission` VALUES (11, '权限列表', 'permission.index', '', 4, 1, 1);
INSERT INTO `ss_permission` VALUES (12, '权限添加', 'permission.create,permission.store', '', 4, 1, 1);
INSERT INTO `ss_permission` VALUES (13, '权限修改', 'permission.edit,permission.update', '', 4, 1, 1);
INSERT INTO `ss_permission` VALUES (14, '权限查看', 'permission.show', '', 4, 1, 1);
INSERT INTO `ss_permission` VALUES (15, '权限删除', 'permission.destroy', '', 4, 1, 1);
INSERT INTO `ss_permission` VALUES (16, '角色列表', 'role.index', '', 3, 1, 0);
INSERT INTO `ss_permission` VALUES (17, '角色添加', 'role.create,role.store', '', 3, 1, 0);
INSERT INTO `ss_permission` VALUES (18, '角色修改', 'role.edit,role.update', '', 3, 1, 0);
INSERT INTO `ss_permission` VALUES (19, '角色查看', 'role.show', '', 3, 1, 0);
INSERT INTO `ss_permission` VALUES (20, '角色删除', 'role.destroy', '', 3, 1, 0);
INSERT INTO `ss_permission` VALUES (21, '角色授权', 'role.authority', '', 3, 1, 0);
INSERT INTO `ss_permission` VALUES (22, '网站配置', 'config.index', '', 6, 1, 0);
INSERT INTO `ss_permission` VALUES (23, '网站配置修改', 'config.update', '', 6, 1, 0);
INSERT INTO `ss_permission` VALUES (24, '关于我们', 'about.index', '', 7, 1, 0);
INSERT INTO `ss_permission` VALUES (25, '关于我们修改', 'about.update', '', 7, 1, 0);
INSERT INTO `ss_permission` VALUES (26, '分类列表', 'category.index', ' ', 9, 1, 0);
INSERT INTO `ss_permission` VALUES (27, '分类新增', 'category.create,category.store', ' ', 9, 1, 0);
INSERT INTO `ss_permission` VALUES (28, '分类编辑', 'category.edit,category.update', ' ', 9, 1, 0);
INSERT INTO `ss_permission` VALUES (29, '分类删除', 'category.destroy', ' ', 9, 1, 0);
INSERT INTO `ss_permission` VALUES (30, '反馈列表', 'feedback.index', ' ', 10, 1, 0);
INSERT INTO `ss_permission` VALUES (31, '反馈处理', 'feedback.edit,feedback.update', ' ', 10, 1, 0);
INSERT INTO `ss_permission` VALUES (32, '反馈删除', 'feedback.destroy', ' ', 10, 1, 0);
INSERT INTO `ss_permission` VALUES (33, '日程列表', 'event.index', '', 12, 1, 0);
INSERT INTO `ss_permission` VALUES (34, '添加日程', 'event.create,event.store', '', 12, 1, 0);
INSERT INTO `ss_permission` VALUES (35, '编辑日程', 'event.edit,event.update', '', 12, 1, 0);
INSERT INTO `ss_permission` VALUES (36, '删除日程', 'event.destroy', '', 12, 1, 0);
INSERT INTO `ss_permission` VALUES (37, '生活点滴', 'happy.index', '', 14, 1, 0);
INSERT INTO `ss_permission` VALUES (38, '添加生活点滴', 'happy.create,happy.store', '', 14, 1, 0);
INSERT INTO `ss_permission` VALUES (39, '编辑生活点滴', 'happy.edit,happy.update', '', 14, 1, 0);
INSERT INTO `ss_permission` VALUES (40, '删除生活点滴', 'happy.destroy', '', 14, 1, 0);
INSERT INTO `ss_permission` VALUES (41, '日记列表', 'notebook.index', '', 13, 1, 0);
INSERT INTO `ss_permission` VALUES (42, '添加日记', 'notebook.create,notebook.store', '', 13, 1, 0);
INSERT INTO `ss_permission` VALUES (43, '编辑日记', 'notebook.edit,notebook.update', '', 13, 1, 0);
INSERT INTO `ss_permission` VALUES (44, '删除日记', 'notebook.destroy', '', 13, 1, 0);
COMMIT;

-- ----------------------------
-- Table structure for ss_permission_role
-- ----------------------------
DROP TABLE IF EXISTS `ss_permission_role`;
CREATE TABLE `ss_permission_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `module` tinyint(4) NOT NULL DEFAULT '0' COMMENT '所属模块',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COMMENT='权限角色表';

-- ----------------------------
-- Records of ss_permission_role
-- ----------------------------
BEGIN;
INSERT INTO `ss_permission_role` VALUES (20, 16, 3, 1);
INSERT INTO `ss_permission_role` VALUES (21, 17, 3, 1);
INSERT INTO `ss_permission_role` VALUES (22, 18, 3, 1);
INSERT INTO `ss_permission_role` VALUES (23, 19, 3, 1);
INSERT INTO `ss_permission_role` VALUES (24, 20, 3, 1);
INSERT INTO `ss_permission_role` VALUES (25, 21, 3, 1);
INSERT INTO `ss_permission_role` VALUES (26, 6, 2, 1);
INSERT INTO `ss_permission_role` VALUES (27, 16, 2, 1);
INSERT INTO `ss_permission_role` VALUES (28, 17, 2, 1);
COMMIT;

-- ----------------------------
-- Table structure for ss_product
-- ----------------------------
DROP TABLE IF EXISTS `ss_product`;
CREATE TABLE `ss_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(120) NOT NULL DEFAULT '' COMMENT '产品标题',
  `category_id` int(11) NOT NULL DEFAULT '0' COMMENT '分类ID',
  `image` varchar(100) NOT NULL DEFAULT '' COMMENT '产品图片',
  `display` varchar(255) NOT NULL COMMENT '产品展示图集',
  `desc` varchar(255) NOT NULL DEFAULT '' COMMENT '简介',
  `info` text COMMENT '详情',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序（越小越靠前）',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态（1启用，99禁用）',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of ss_product
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for ss_role
-- ----------------------------
DROP TABLE IF EXISTS `ss_role`;
CREATE TABLE `ss_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(10) NOT NULL DEFAULT '0' COMMENT '父级角色id',
  `path` varchar(100) NOT NULL DEFAULT '' COMMENT '路径',
  `name` varchar(255) NOT NULL DEFAULT '',
  `desc` varchar(255) NOT NULL DEFAULT '',
  `module` tinyint(4) NOT NULL DEFAULT '0' COMMENT '所属模块',
  `is_system` tinyint(4) NOT NULL DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='角色表';

-- ----------------------------
-- Records of ss_role
-- ----------------------------
BEGIN;
INSERT INTO `ss_role` VALUES (1, 1, '0,1,', '超级管理员', '这是超级管理员', 1, 1, 0, 0);
INSERT INTO `ss_role` VALUES (2, 1, '0,1,2,', '测试管理员', '', 1, 0, 0, 0);
INSERT INTO `ss_role` VALUES (3, 1, '0,1,3,', '测试', '', 1, 0, 0, 0);
COMMIT;

-- ----------------------------
-- Table structure for ss_role_user
-- ----------------------------
DROP TABLE IF EXISTS `ss_role_user`;
CREATE TABLE `ss_role_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `module` tinyint(4) NOT NULL DEFAULT '0' COMMENT '所属模块',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='管理员角色表';

-- ----------------------------
-- Records of ss_role_user
-- ----------------------------
BEGIN;
INSERT INTO `ss_role_user` VALUES (1, 1, 1, 1);
INSERT INTO `ss_role_user` VALUES (2, 2, 2, 1);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
