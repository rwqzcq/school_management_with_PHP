/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50505
 Source Host           : localhost
 Source Database       : school

 Target Server Type    : MySQL
 Target Server Version : 50505
 File Encoding         : utf-8

 Date: 04/12/2019 17:15:32 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `award`
-- ----------------------------
DROP TABLE IF EXISTS `award`;
CREATE TABLE `award` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `introduction` varchar(255) NOT NULL,
  `create_time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `award`
-- ----------------------------
BEGIN;
INSERT INTO `award` VALUES ('1', 'pretty girl', 'this is tha award !', '1554895765');
COMMIT;

-- ----------------------------
--  Table structure for `award_student`
-- ----------------------------
DROP TABLE IF EXISTS `award_student`;
CREATE TABLE `award_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `award_student`
-- ----------------------------
BEGIN;
INSERT INTO `award_student` VALUES ('5', '1', '1');
COMMIT;

-- ----------------------------
--  Table structure for `class`
-- ----------------------------
DROP TABLE IF EXISTS `class`;
CREATE TABLE `class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `class`
-- ----------------------------
BEGIN;
INSERT INTO `class` VALUES ('1', 'class01'), ('2', 'class02'), ('3', 'class03'), ('4', 'class04');
COMMIT;

-- ----------------------------
--  Table structure for `course`
-- ----------------------------
DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `introduction` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `create_time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `course`
-- ----------------------------
BEGIN;
INSERT INTO `course` VALUES ('1', 'PHP', 'Learn PHP', 'course/20190412/cd94c042bfa1860e008e64fbe9c1d447.jpeg', '1554865526'), ('3', 'sqllite', 'sqllite2sss			', 'course/20190411/57d91977e1b3a072db042e2bab80c754.jpg', '1554916991');
COMMIT;

-- ----------------------------
--  Table structure for `course_teacher`
-- ----------------------------
DROP TABLE IF EXISTS `course_teacher`;
CREATE TABLE `course_teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `course_teacher`
-- ----------------------------
BEGIN;
INSERT INTO `course_teacher` VALUES ('28', '3', '6'), ('29', '3', '2');
COMMIT;

-- ----------------------------
--  Table structure for `grade`
-- ----------------------------
DROP TABLE IF EXISTS `grade`;
CREATE TABLE `grade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `score` float NOT NULL,
  `comment` varchar(255) NOT NULL,
  `student_feedback` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `grade`
-- ----------------------------
BEGIN;
INSERT INTO `grade` VALUES ('1', '1', '1', '98.5', '', 'ok'), ('4', '4', '3', '91', 'you need to word hard!', ''), ('6', '1', '3', '91', 'OK', 'OK\r\n');
COMMIT;

-- ----------------------------
--  Table structure for `manager`
-- ----------------------------
DROP TABLE IF EXISTS `manager`;
CREATE TABLE `manager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `manager`
-- ----------------------------
BEGIN;
INSERT INTO `manager` VALUES ('1', 'admin', '1234567');
COMMIT;

-- ----------------------------
--  Table structure for `student`
-- ----------------------------
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `student_number` int(11) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `class_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `student`
-- ----------------------------
BEGIN;
INSERT INTO `student` VALUES ('1', 'Kobe', '123456', '2015214531', '1997-05-05', '1', 'London Niujin', '15071392076', 'student/20190410/e9818542eaba4b1011df2cfa544d7aeb.jpg', '1'), ('2', 'Student_1', '123456', '2015214532', '1997-05-05', '1', 'London', '15071392076', 'student/20190410/5fb71a491321417e3fc39ca1c8de14f0.jpeg', '1'), ('4', 'student_02', '123456', '2015214534', '1997-05-02', '2', 'Londo', '15071392050', 'student/20190410/ea10897663a68b67dd918632af1a80ac.jpeg', '2');
COMMIT;

-- ----------------------------
--  Table structure for `teacher`
-- ----------------------------
DROP TABLE IF EXISTS `teacher`;
CREATE TABLE `teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `teacher_number` int(11) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `class_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `teacher`
-- ----------------------------
BEGIN;
INSERT INTO `teacher` VALUES ('2', 'James', '123456', '2000214531', '19876543098', '1', '/student/kobe.jpg', '1'), ('3', 'Curry', '123456', '2000214532', '19876543094', '1', 'teacher/20190411/393f8913b3a641646720690ad67cfad3.jpg', '2'), ('6', 'teacher_01', '123456', '2015214009', '15071392059', '1', 'teacher/20190411/d27def30ee21cea1e8a07b89c3b17f08.jpeg', '3');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
