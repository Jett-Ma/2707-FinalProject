/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 80012
Source Host           : localhost:3306
Source Database       : join

Target Server Type    : MYSQL
Target Server Version : 80012
File Encoding         : 65001

Date: 2021-07-27 23:43:07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for application
-- ----------------------------
DROP TABLE IF EXISTS `application`;
CREATE TABLE `application` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employeeID` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `companyID` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `jobID` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of application
-- ----------------------------
INSERT INTO `application` VALUES ('6', '594115018@qq.com', 'admin@gmail.com', '2021-07-27 23:28:22', '1', 'review');
INSERT INTO `application` VALUES ('5', '594115018@qq.com', 'admin@gmail.com', '2021-07-27 23:45:14', '6', 'review');

-- ----------------------------
-- Table structure for applyjob
-- ----------------------------
DROP TABLE IF EXISTS `applyjob`;
CREATE TABLE `applyjob` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `salary` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `deadline` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of applyjob
-- ----------------------------
INSERT INTO `applyjob` VALUES ('1', '', 'Part Time', '123', '123', '', '2021-07-30 23:59:59', '2021-07-27 03:35:10', 'admin@gmail.com');
INSERT INTO `applyjob` VALUES ('2', '', 'Part Time', '123', '123', '', '2021-07-28 23:59:59', '2021-07-27 03:50:10', 'admin@gmail.com');
INSERT INTO `applyjob` VALUES ('3', '', 'Internship', '123', '123', '', '2021-08-20 23:59:59', '2021-07-27 03:11:11', 'admin@gmail.com');
INSERT INTO `applyjob` VALUES ('4', '', 'Part Time', '12', '12', '', '2021-08-01 23:59:59', '2021-07-27 03:28:11', 'admin@gmail.com');
INSERT INTO `applyjob` VALUES ('5', 'UX/UI Designer', 'Part Time', '123', '123', '123', '2021-07-28 23:59:59', '2021-07-27 16:44:53', 'admin@gmail.com');
INSERT INTO `applyjob` VALUES ('6', 'Web Developer', 'Full Time', '120', 'Des1', 'title1', '2021-07-31 23:59:59', '2021-07-27 23:40:13', 'admin@gmail.com');

-- ----------------------------
-- Table structure for company
-- ----------------------------
DROP TABLE IF EXISTS `company`;
CREATE TABLE `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `introduction` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `qualifications` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `officialWebsiteUrl` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of company
-- ----------------------------
INSERT INTO `company` VALUES ('1', 'admin@gmail.com', '123', '1', '123', '3', '22', '1', '1', '1', '1');

-- ----------------------------
-- Table structure for employee
-- ----------------------------
DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `introduction` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `learnExperience` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `workExperience` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `resumeUrl` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of employee
-- ----------------------------
INSERT INTO `employee` VALUES ('1', '594115018@qq.com', '123', '1', '1', '1', '1', '1', '6594291627383672.jpg', '1', '1');
