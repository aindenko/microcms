/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50166
Source Host           : localhost:3306
Source Database       : microcms

Target Server Type    : MYSQL
Target Server Version : 50166
File Encoding         : 65001

Date: 2014-07-13 14:18:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `article`
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `body` text NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `route` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article
-- ----------------------------

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `hash` varchar(32) NOT NULL,
  `right` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '615a182919b747ac61256100f0d5b8c0', '1');
INSERT INTO `user` VALUES ('2', 'user', '169f27c5d7059afa6bf0aff44703675d', '0');
