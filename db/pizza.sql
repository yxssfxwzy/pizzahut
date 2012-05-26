-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- 主机: localhost
-- 生成日期: 2012 年 05 月 26 日 15:28
-- 服务器版本: 5.0.51
-- PHP 版本: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- 数据库: `pizza`
-- 
CREATE DATABASE `pizza` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `pizza`;

-- --------------------------------------------------------

-- 
-- 表的结构 `branch`
-- 

CREATE TABLE `branch` (
  `bid` mediumint(8) unsigned NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `coordinate` varchar(20) NOT NULL,
  PRIMARY KEY  (`bid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='分店表' AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `branch`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `order`
-- 

CREATE TABLE `order` (
  `oid` mediumint(8) unsigned NOT NULL auto_increment COMMENT '订单编号',
  `uid` varchar(20) NOT NULL COMMENT '用户ID',
  `bid` mediumint(8) unsigned NOT NULL,
  `pid` mediumint(8) unsigned NOT NULL COMMENT '产品编号',
  `quantity` smallint(4) unsigned NOT NULL COMMENT '数量',
  `price` decimal(10,0) unsigned NOT NULL COMMENT '价格',
  `time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP COMMENT '时间',
  `status` varchar(100) NOT NULL COMMENT '订单状态',
  PRIMARY KEY  (`oid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='订单表' AUTO_INCREMENT=13 ;

-- 
-- 导出表中的数据 `order`
-- 

INSERT INTO `order` VALUES (9, '4', 0, 134, 1, 1, '2012-05-26 21:47:04', 'ordering');
INSERT INTO `order` VALUES (10, '4', 0, 134, 1, 1, '2012-05-26 21:47:24', 'ordering');
INSERT INTO `order` VALUES (11, '', 0, 10000001, 100, 10, '2012-05-26 21:48:55', 'ordering');
INSERT INTO `order` VALUES (12, '4', 0, 10000001, 100, 10, '2012-05-26 21:49:55', 'ordering');

-- --------------------------------------------------------

-- 
-- 表的结构 `orderdetail`
-- 

CREATE TABLE `orderdetail` (
  `oid` mediumint(8) NOT NULL COMMENT '订单编号',
  `psid` mediumint(8) NOT NULL COMMENT '比萨店编号',
  `pid` mediumint(8) NOT NULL COMMENT '比萨编号',
  `amount` mediumint(8) NOT NULL default '0' COMMENT '数量',
  `price` decimal(10,0) NOT NULL default '0' COMMENT '价格'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单详情';

-- 
-- 导出表中的数据 `orderdetail`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `product`
-- 

CREATE TABLE `product` (
  `pid` int(8) unsigned NOT NULL auto_increment COMMENT '商品编号',
  `sort` varchar(20) character set utf8 NOT NULL COMMENT '类别',
  `name` varchar(10) character set utf8 NOT NULL COMMENT '名字',
  `price` decimal(10,0) NOT NULL COMMENT '价格',
  `description` varchar(100) character set utf8 NOT NULL COMMENT '描述',
  PRIMARY KEY  (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='商品表' AUTO_INCREMENT=10000002 ;

-- 
-- 导出表中的数据 `product`
-- 

INSERT INTO `product` VALUES (123, '饮料', '罗兰校长咖啡', 6, '7');
INSERT INTO `product` VALUES (134, '主食', '12', 1, '1');
INSERT INTO `product` VALUES (10000001, '比萨', '比萨1', 10, '100');

-- --------------------------------------------------------

-- 
-- 表的结构 `user`
-- 

CREATE TABLE `user` (
  `uid` varchar(20) NOT NULL COMMENT '用户ID',
  `name` varchar(10) NOT NULL COMMENT '用户名',
  `password` varchar(50) NOT NULL COMMENT '密码',
  `tel` varchar(20) NOT NULL COMMENT '电话',
  `address` varchar(100) NOT NULL COMMENT '地址',
  `coordinate` varchar(20) NOT NULL default '0' COMMENT '坐标',
  `isadmin` char(1) NOT NULL default 'N' COMMENT '管理员标志',
  PRIMARY KEY  (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';

-- 
-- 导出表中的数据 `user`
-- 

INSERT INTO `user` VALUES ('0', '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', '', '', 'N');
INSERT INTO `user` VALUES ('1', '1', '1', '1', '1', '0', 'N');
INSERT INTO `user` VALUES ('2', '1', '011c945f30ce2cbafc452f39840f025693339c42', '1', '1', '1', 'N');
INSERT INTO `user` VALUES ('3', '3', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2', '3', '3', '3', 'N');
INSERT INTO `user` VALUES ('4', '4', '011c945f30ce2cbafc452f39840f025693339c42', '4', '4', '4', 'N');
INSERT INTO `user` VALUES ('5', '5', '011c945f30ce2cbafc452f39840f025693339c42', '5', '5', '5', 'Y');
