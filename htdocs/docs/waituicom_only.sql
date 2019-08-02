/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50611
Source Host           : 127.0.0.1:3306
Source Database       : waituicom

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2019-08-02 18:22:58
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin_info
-- ----------------------------
DROP TABLE IF EXISTS `admin_info`;
CREATE TABLE `admin_info` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员id',
  `admin_name` varchar(32) NOT NULL COMMENT '管理员登录账号',
  `admin_pwd` varchar(256) NOT NULL COMMENT '管理员登录密码',
  `real_name` varchar(32) NOT NULL COMMENT '真实姓名',
  `status` varchar(11) NOT NULL DEFAULT 'inactive' COMMENT '管理员状态（inactive：冻结，active：正常）',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '管理员创建时间',
  `login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '登录时间',
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `管理员登录账号` (`admin_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for advertisement_info
-- ----------------------------
DROP TABLE IF EXISTS `advertisement_info`;
CREATE TABLE `advertisement_info` (
  `ad_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '广告编号',
  `ad_name` varchar(256) DEFAULT NULL COMMENT '广告名称',
  `author_id` int(11) NOT NULL COMMENT '广告创建人编号',
  `ad_desc` varchar(1024) DEFAULT NULL COMMENT '广告描述',
  `ad_type` varchar(256) NOT NULL DEFAULT 'image' COMMENT '广告类型（图片，iframe嵌套，video）',
  `ad_address` varchar(1024) NOT NULL COMMENT '广告图片、嵌套网页地址',
  `video_poster` varchar(1024) DEFAULT NULL COMMENT '视频快照地址',
  `ad_link` varchar(1024) DEFAULT NULL COMMENT '广告点击链接',
  `heart_amount` int(11) NOT NULL DEFAULT '0' COMMENT '点赞数',
  `is_award` int(11) NOT NULL DEFAULT '0' COMMENT '是否有红包奖励（0-否，1-是）',
  `award_amount` int(11) NOT NULL DEFAULT '0' COMMENT '红包奖励总额',
  `ad_status` int(11) NOT NULL DEFAULT '0' COMMENT '广告状态（0-未激活，1-正常）',
  `ad_remark` varchar(1024) DEFAULT NULL COMMENT '广告备注',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `publish_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '发布时间',
  `deadline_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '有效截止日期',
  PRIMARY KEY (`ad_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ad_heart_record
-- ----------------------------
DROP TABLE IF EXISTS `ad_heart_record`;
CREATE TABLE `ad_heart_record` (
  `heart_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '点赞编号',
  `ad_id` int(11) NOT NULL COMMENT '广告编号',
  `heart_amount` int(11) NOT NULL COMMENT '点赞数量（1或者-1）',
  `user_id` int(11) NOT NULL COMMENT '用户编号',
  `heart_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '点赞时间',
  `description` varchar(1024) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`heart_id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for article_author
-- ----------------------------
DROP TABLE IF EXISTS `article_author`;
CREATE TABLE `article_author` (
  `author_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '作者编号',
  `author_name` varchar(48) CHARACTER SET utf8 NOT NULL COMMENT '作者名称',
  `author_motto` varchar(1024) CHARACTER SET utf8 NOT NULL COMMENT '作者座右铭',
  `figure_path` varchar(1024) CHARACTER SET utf8 NOT NULL COMMENT '作者头像路径',
  `description` varchar(1024) CHARACTER SET utf8 DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Table structure for article_category
-- ----------------------------
DROP TABLE IF EXISTS `article_category`;
CREATE TABLE `article_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章类型编号',
  `category_type` varchar(48) CHARACTER SET utf8 NOT NULL COMMENT '文章类型英文名',
  `category_name` varchar(48) CHARACTER SET utf8 NOT NULL COMMENT '文章类型名称',
  `category_order` int(11) NOT NULL COMMENT '文章类型排序',
  `description` varchar(1024) CHARACTER SET utf8 DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Table structure for article_hotword
-- ----------------------------
DROP TABLE IF EXISTS `article_hotword`;
CREATE TABLE `article_hotword` (
  `hotword_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '热搜词编号',
  `hotword_name` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT '热搜词名称',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '热搜词搜索时间',
  `description` varchar(1024) CHARACTER SET utf8 DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`hotword_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for article_info
-- ----------------------------
DROP TABLE IF EXISTS `article_info`;
CREATE TABLE `article_info` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章编号',
  `article_title` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT '文章标题',
  `thumb_path` varchar(256) CHARACTER SET utf8 NOT NULL COMMENT '缩略图路径',
  `article_lead` varchar(1024) CHARACTER SET utf8 NOT NULL COMMENT '文章导语',
  `article_tag` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT '文章标签',
  `article_content` text CHARACTER SET utf8 NOT NULL COMMENT '文章内容',
  `status` varchar(11) CHARACTER SET utf8 NOT NULL DEFAULT 'inactive' COMMENT '文章状态(active:已发布，inactive:未发布)',
  `author_id` int(11) NOT NULL COMMENT '作者编号',
  `article_category` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT '文章类型',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '文章发布时间',
  `article_read` int(11) NOT NULL DEFAULT '0' COMMENT '文章阅读量',
  `description` varchar(1024) CHARACTER SET utf8 DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Table structure for butler_info
-- ----------------------------
DROP TABLE IF EXISTS `butler_info`;
CREATE TABLE `butler_info` (
  `butler_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管家id',
  `butler_name` varchar(32) NOT NULL COMMENT '管家昵称',
  `real_name` varchar(32) NOT NULL COMMENT '真实姓名',
  `butler_phone` varchar(32) NOT NULL COMMENT '手机号码',
  `butler_qq` varchar(32) NOT NULL COMMENT 'QQ号码',
  `butler_wechat` varchar(256) NOT NULL COMMENT '微信二维码',
  `status` varchar(11) NOT NULL DEFAULT 'inactive' COMMENT '管家状态（inactive：冻结，active：正常）',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '管家创建时间',
  PRIMARY KEY (`butler_id`),
  UNIQUE KEY `管家昵称` (`butler_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for company_certify
-- ----------------------------
DROP TABLE IF EXISTS `company_certify`;
CREATE TABLE `company_certify` (
  `certify_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '企业认证编号',
  `certify_userid` int(11) NOT NULL COMMENT '企业认证用户编号',
  `company_name` varchar(100) NOT NULL COMMENT '公司名称',
  `business_license` varchar(256) NOT NULL COMMENT '公司营业执照',
  `status` varchar(11) NOT NULL DEFAULT 'wait' COMMENT '认证状态（failed：认证失败，wait：认证中，success：认证成功）',
  `oper_name` varchar(100) DEFAULT NULL COMMENT '法定代表人',
  `regist_capi` varchar(100) DEFAULT NULL COMMENT '注册资本',
  `start_date` datetime DEFAULT NULL COMMENT '成立日期',
  `credit_code` varchar(100) DEFAULT NULL COMMENT '统一社会信用代码',
  `econ_kind` varchar(100) DEFAULT NULL COMMENT '企业类型',
  `business_term` varchar(100) DEFAULT NULL COMMENT '营业期限',
  `address` varchar(1024) DEFAULT NULL COMMENT '企业地址',
  `scope` varchar(1024) DEFAULT NULL COMMENT '经营范围',
  `contact_phone` varchar(32) DEFAULT NULL COMMENT '联系电话',
  `contact_email` varchar(32) DEFAULT NULL COMMENT '联系邮箱',
  `contact_address` varchar(1024) DEFAULT NULL COMMENT '联系地址',
  `website` varchar(100) DEFAULT NULL COMMENT '公司网址',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '认证时间',
  `description` varchar(1024) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`certify_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for company_info
-- ----------------------------
DROP TABLE IF EXISTS `company_info`;
CREATE TABLE `company_info` (
  `company_id` varchar(18) NOT NULL COMMENT '公司编号(公司名称加法定代表人加6位随机数的md5值)',
  `name` varchar(100) NOT NULL COMMENT '公司名称',
  `oper_name` varchar(100) DEFAULT NULL COMMENT '法定代表人',
  `regist_capi` varchar(100) DEFAULT NULL COMMENT '注册资本',
  `real_capi` varchar(100) DEFAULT NULL COMMENT '实缴资本',
  `status` varchar(100) DEFAULT NULL COMMENT '经营状态',
  `start_date` datetime DEFAULT NULL COMMENT '成立日期',
  `credit_code` varchar(100) DEFAULT NULL COMMENT '统一社会信用代码',
  `tax_no` varchar(100) DEFAULT NULL COMMENT '纳税人识别号',
  `no` varchar(100) DEFAULT NULL COMMENT '注册号',
  `org_no` varchar(100) DEFAULT NULL COMMENT '组织机构代码',
  `econ_kind` varchar(100) DEFAULT NULL COMMENT '企业类型',
  `industry` varchar(100) DEFAULT NULL COMMENT '所属行业',
  `check_date` datetime DEFAULT NULL COMMENT '核准日期',
  `belong_org` varchar(100) DEFAULT NULL COMMENT '登记机关',
  `province` varchar(100) DEFAULT NULL COMMENT '所属地区（省份、直辖市）',
  `en_name` varchar(100) DEFAULT NULL COMMENT '英文名',
  `original_name` varchar(100) DEFAULT NULL COMMENT '曾用名',
  `insured_person` varchar(100) DEFAULT NULL COMMENT '参保人数',
  `staff_size` varchar(100) DEFAULT NULL COMMENT '人员规模',
  `business_term` varchar(100) DEFAULT NULL COMMENT '营业期限',
  `address` varchar(1024) DEFAULT NULL COMMENT '企业地址',
  `scope` varchar(1024) DEFAULT NULL COMMENT '经营范围',
  `description` varchar(1024) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`company_id`),
  UNIQUE KEY `name` (`name`) USING BTREE COMMENT '公司名称唯一'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for domain_info
-- ----------------------------
DROP TABLE IF EXISTS `domain_info`;
CREATE TABLE `domain_info` (
  `domain_name` varchar(48) CHARACTER SET utf8 NOT NULL COMMENT '域名名称',
  `register_registrar` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT '注册商',
  `register_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT '注册人',
  `register_email` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT '注册邮箱',
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '注册日期',
  `expired_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '过期日期',
  `domain_type` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT '域名类型',
  `domain_price` int(11) DEFAULT NULL COMMENT '域名价格',
  `domain_summary` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT '域名简介',
  `is_onsale` varchar(11) CHARACTER SET utf8 DEFAULT 'unsale' COMMENT '是否出售（unsale-否，sale-是）',
  `domain_userid` int(11) DEFAULT NULL COMMENT '域名的用户编号',
  `description` varchar(1024) CHARACTER SET utf8 DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`domain_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for flash_info
-- ----------------------------
DROP TABLE IF EXISTS `flash_info`;
CREATE TABLE `flash_info` (
  `flash_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '快讯编号',
  `flash_title` varchar(100) NOT NULL COMMENT '快讯标题',
  `flash_content` text NOT NULL COMMENT '快讯内容',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '快讯发布时间',
  `description` varchar(1024) DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`flash_id`)
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for login_record
-- ----------------------------
DROP TABLE IF EXISTS `login_record`;
CREATE TABLE `login_record` (
  `login_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '登录编号',
  `login_userid` int(11) DEFAULT NULL COMMENT '登录用户id',
  `login_phone` varchar(11) DEFAULT NULL COMMENT '登录手机号',
  `login_name` varchar(256) DEFAULT NULL COMMENT '登录用户名',
  `login_client` varchar(256) DEFAULT NULL COMMENT '登录客户端',
  `login_ip` varchar(256) DEFAULT NULL COMMENT '登录ip地址',
  `login_city` varchar(256) DEFAULT NULL COMMENT '登录城市',
  `login_time` timestamp NULL DEFAULT NULL COMMENT '登录时间',
  PRIMARY KEY (`login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mark_category
-- ----------------------------
DROP TABLE IF EXISTS `mark_category`;
CREATE TABLE `mark_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商标分类编号',
  `category_name` varchar(48) NOT NULL COMMENT '商标分类名称',
  `category_no` varchar(48) NOT NULL COMMENT '商标分类编号(字符串)',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mark_info
-- ----------------------------
DROP TABLE IF EXISTS `mark_info`;
CREATE TABLE `mark_info` (
  `mark_regno` varchar(48) NOT NULL COMMENT '商标注册号',
  `mark_category` int(11) NOT NULL COMMENT '商标大类',
  `regno_md` varchar(100) NOT NULL COMMENT '注册号加大类的md5值',
  `mark_name` varchar(100) NOT NULL COMMENT '商标名称',
  `image_path` varchar(1024) NOT NULL COMMENT '商标图片地址',
  `mark_type` varchar(11) NOT NULL DEFAULT 'other' COMMENT '商标类型（other-其他，cn-纯中文，en-纯英文，graph-纯图形，num-纯数字）',
  `mark_group` varchar(1024) NOT NULL COMMENT '商标群组',
  `app_range` varchar(1024) NOT NULL COMMENT '适用范围',
  `mark_length` int(11) DEFAULT '0' COMMENT '商标长度（商标名称长度）',
  `mark_status` varchar(1024) DEFAULT NULL COMMENT '商标当前状态',
  `mark_flow` varchar(2048) DEFAULT NULL COMMENT '商标流程',
  `mark_applicant` varchar(100) DEFAULT NULL COMMENT '商标申请人',
  `app_date` timestamp NULL DEFAULT NULL COMMENT '申请日期',
  `announce_issue` varchar(48) DEFAULT NULL COMMENT '初审公告期号',
  `announce_date` timestamp NULL DEFAULT NULL COMMENT '初审公告日期',
  `reg_issue` varchar(48) DEFAULT NULL COMMENT '注册公告期号',
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '注册公告日期',
  `private_limit` varchar(100) DEFAULT NULL COMMENT '专用期限',
  `mark_price` decimal(16,2) DEFAULT NULL COMMENT '商标价格',
  `mark_agent` varchar(100) DEFAULT NULL COMMENT '代理公司',
  `is_moved` varchar(11) DEFAULT 'unmove' COMMENT '商标图片是否已经移动到文件服务器（unmove-否，moved-是）',
  `is_onsale` varchar(11) DEFAULT 'unsale' COMMENT '是否出售（unsale-否，sale-是）',
  `mark_userid` int(11) DEFAULT NULL COMMENT '商标的用户编号',
  `description` varchar(1024) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`mark_regno`,`mark_category`),
  UNIQUE KEY `regno_md` (`regno_md`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for smsvalid_info
-- ----------------------------
DROP TABLE IF EXISTS `smsvalid_info`;
CREATE TABLE `smsvalid_info` (
  `sms_phone` varchar(32) NOT NULL COMMENT '短信验证-手机号',
  `sms_code` varchar(32) NOT NULL COMMENT '短信验证-验证码',
  `sms_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '验证码生成时间',
  `sms_status` varchar(11) NOT NULL DEFAULT 'active' COMMENT '短信验证-验证码状态（active:有效，inactive:无效）',
  PRIMARY KEY (`sms_phone`,`sms_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for user_info
-- ----------------------------
DROP TABLE IF EXISTS `user_info`;
CREATE TABLE `user_info` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `user_phone` varchar(32) NOT NULL DEFAULT '' COMMENT '用戶手机号',
  `user_pwd` varchar(256) NOT NULL COMMENT '用户登录密码',
  `user_name` varchar(256) NOT NULL COMMENT '用户昵称',
  `user_figure` varchar(256) DEFAULT NULL COMMENT '用户头像',
  `real_name` varchar(256) DEFAULT NULL COMMENT '真实姓名',
  `user_qq` varchar(32) DEFAULT NULL COMMENT '用户QQ号码',
  `user_email` varchar(32) DEFAULT NULL COMMENT '用户邮箱',
  `user_wechat` varchar(32) DEFAULT NULL COMMENT '用户微信号',
  `user_butler` int(11) DEFAULT NULL COMMENT '品牌管家编号',
  `user_score` int(11) NOT NULL DEFAULT '0' COMMENT '用户获得的积分',
  `user_balance` decimal(16,2) NOT NULL DEFAULT '0.00' COMMENT '账户余额',
  `sign_time` timestamp NULL DEFAULT NULL COMMENT '签到时间',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `用户手机号` (`user_phone`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for user_msg_info
-- ----------------------------
DROP TABLE IF EXISTS `user_msg_info`;
CREATE TABLE `user_msg_info` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '消息id',
  `msg_userid` int(11) NOT NULL COMMENT '用户编号',
  `msg_title` varchar(256) NOT NULL COMMENT '消息标题',
  `msg_source` varchar(256) DEFAULT NULL COMMENT '消息来源',
  `msg_content` text COMMENT '消息内容',
  `status` varchar(11) NOT NULL DEFAULT 'unread' COMMENT '消息状态(unread:未读，read:已读，del:垃圾箱)',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '消息创建时间',
  `description` varchar(1024) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for user_score_record
-- ----------------------------
DROP TABLE IF EXISTS `user_score_record`;
CREATE TABLE `user_score_record` (
  `score_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '积分领取编号',
  `score_userid` int(11) NOT NULL COMMENT '积分领取用户编号',
  `score_amount` int(11) NOT NULL COMMENT '积分领取数量',
  `score_type` varchar(48) NOT NULL COMMENT '积分领取类型（ad广告源，sign签到）',
  `score_source_id` int(11) DEFAULT NULL COMMENT '积分来源编号（广告源为广告id,签到为空）',
  `score_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '积分领取时间',
  `description` varchar(1024) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`score_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for welfare_info
-- ----------------------------
DROP TABLE IF EXISTS `welfare_info`;
CREATE TABLE `welfare_info` (
  `welfare_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '福利编号',
  `welfare_title` varchar(1024) DEFAULT NULL COMMENT '福利标题',
  `welfare_banner` varchar(1024) NOT NULL COMMENT '福利banner图',
  `welfare_link` varchar(1024) DEFAULT NULL COMMENT '福利链接地址',
  `welfare_status` varchar(11) NOT NULL DEFAULT 'inactive' COMMENT '福利状态（inactive:未激活，active:激活）',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `publish_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '发布时间',
  PRIMARY KEY (`welfare_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
