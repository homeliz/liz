/*
Navicat MySQL Data Transfer

Source Server         : locaohost
Source Server Version : 50719
Source Host           : 127.0.0.1:3306
Source Database       : yts_new_mofang

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2018-03-18 16:30:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for config_master
-- ----------------------------
DROP TABLE IF EXISTS `config_master`;
CREATE TABLE `config_master` (
  `uuid` char(32) NOT NULL COMMENT '唯一标识符',
  `created_at` datetime NOT NULL COMMENT '创建时间',
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '配置id',
  `updated_at` datetime NOT NULL COMMENT '更新时间',
  `useFlag` tinyint(1) DEFAULT NULL COMMENT '状态 1:开启 0:禁用',
  `remark` varchar(200) NOT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of config_master
-- ----------------------------
INSERT INTO `config_master` VALUES ('B8F5C3CF9C4358CDE78AE60C12A95C3E', '2018-01-16 17:18:51', '1', '2018-03-18 12:25:30', '1', '路由器接收设备配置按钮');

-- ----------------------------
-- Table structure for global_setting
-- ----------------------------
DROP TABLE IF EXISTS `global_setting`;
CREATE TABLE `global_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID 主键',
  `mac_id` int(11) NOT NULL COMMENT '绑定的路由ID',
  `monitor_enable` tinyint(2) DEFAULT '0' COMMENT '启动进程控制 0：未选 1：已选',
  `enable_switch` tinyint(2) DEFAULT '0' COMMENT '启用自动切换  0：不启用 1：启用',
  `switch_time` int(10) DEFAULT NULL COMMENT '自动切换检查周期',
  `switch_timeout` int(10) DEFAULT NULL COMMENT '切换检查超时时间',
  `gfw_enable` varchar(10) DEFAULT NULL COMMENT '运行模式',
  `tunnel_forward` varchar(10) DEFAULT NULL COMMENT 'DNS服务器和端口',
  `global_server` varchar(200) DEFAULT NULL COMMENT '全局服务器',
  `udp_relay_server` varchar(200) DEFAULT NULL COMMENT 'UDP中继服务器',
  `server` varchar(200) DEFAULT NULL COMMENT 'SOCKS5服务器',
  `local_port` varchar(10) CHARACTER SET utf16le DEFAULT NULL COMMENT '本地端口',
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `tunnel_enable` tinyint(2) DEFAULT '0' COMMENT '启用隧道（DNS）转发 0-禁用 1-启用',
  `tunnel_port` varchar(20) DEFAULT NULL COMMENT '隧道（DNS）本地端口',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of global_setting
-- ----------------------------

-- ----------------------------
-- Table structure for interface_log
-- ----------------------------
DROP TABLE IF EXISTS `interface_log`;
CREATE TABLE `interface_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `visit_time` datetime NOT NULL COMMENT '用户访问时间',
  `user_ip` int(11) unsigned NOT NULL COMMENT '用户访问的ip',
  `mac` varchar(100) NOT NULL COMMENT 'mac地址',
  `ssid` varchar(100) NOT NULL,
  `net` int(11) DEFAULT NULL COMMENT '状态',
  `count` int(11) DEFAULT NULL COMMENT '用户请求累计的次数',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=266 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of interface_log
-- ----------------------------
INSERT INTO `interface_log` VALUES ('140', '2018-03-05 17:19:43', '3080777678', 'AA-AA-AA-2C-AC-0021012', 'MofangBox-3A18E8', '1', '1', '2018-03-05 17:19:43', '2018-03-06 14:26:46');
INSERT INTO `interface_log` VALUES ('141', '2018-03-05 17:19:43', '3080777678', 'AA-AA-AA-2C-AC-00210', 'MofangBox-3A18E8', '1', '1', '2018-03-05 17:19:43', '2018-03-06 14:26:21');
INSERT INTO `interface_log` VALUES ('152', '2018-03-06 14:31:54', '3080777678', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-06 14:31:54', '2018-03-06 14:31:54');
INSERT INTO `interface_log` VALUES ('151', '2018-03-06 14:30:27', '3080777678', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-06 14:30:27', '2018-03-06 14:30:27');
INSERT INTO `interface_log` VALUES ('142', '2018-03-07 17:19:28', '3080777678', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '11212', '12121', '2018-03-05 17:19:28', '2018-03-06 14:28:16');
INSERT INTO `interface_log` VALUES ('153', '2018-03-06 14:44:31', '3080777678', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-06 14:44:31', '2018-03-06 14:44:31');
INSERT INTO `interface_log` VALUES ('154', '2018-03-06 14:44:51', '3080777678', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-06 14:44:51', '2018-03-06 14:44:51');
INSERT INTO `interface_log` VALUES ('155', '2018-03-07 12:50:31', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 12:50:31', '2018-03-07 12:50:31');
INSERT INTO `interface_log` VALUES ('156', '2018-03-07 12:51:10', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 12:51:10', '2018-03-07 12:51:10');
INSERT INTO `interface_log` VALUES ('157', '2018-03-07 12:51:49', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 12:51:49', '2018-03-07 12:51:49');
INSERT INTO `interface_log` VALUES ('158', '2018-03-07 12:56:21', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 12:56:21', '2018-03-07 12:56:21');
INSERT INTO `interface_log` VALUES ('159', '2018-03-07 12:56:40', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 12:56:40', '2018-03-07 12:56:40');
INSERT INTO `interface_log` VALUES ('160', '2018-03-07 13:00:58', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 13:00:58', '2018-03-07 13:00:58');
INSERT INTO `interface_log` VALUES ('161', '2018-03-07 13:01:36', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 13:01:36', '2018-03-07 13:01:36');
INSERT INTO `interface_log` VALUES ('162', '2018-03-07 13:03:17', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 13:03:17', '2018-03-07 13:03:17');
INSERT INTO `interface_log` VALUES ('163', '2018-03-07 13:03:28', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 13:03:28', '2018-03-07 13:03:28');
INSERT INTO `interface_log` VALUES ('164', '2018-03-07 13:06:13', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 13:06:13', '2018-03-07 13:06:13');
INSERT INTO `interface_log` VALUES ('165', '2018-03-07 13:06:15', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 13:06:15', '2018-03-07 13:06:15');
INSERT INTO `interface_log` VALUES ('166', '2018-03-07 13:06:24', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 13:06:24', '2018-03-07 13:06:24');
INSERT INTO `interface_log` VALUES ('167', '2018-03-07 13:06:57', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 13:06:57', '2018-03-07 13:06:57');
INSERT INTO `interface_log` VALUES ('168', '2018-03-07 13:07:22', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 13:07:22', '2018-03-07 13:07:22');
INSERT INTO `interface_log` VALUES ('169', '2018-03-07 13:07:32', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 13:07:32', '2018-03-07 13:07:32');
INSERT INTO `interface_log` VALUES ('170', '2018-03-07 13:08:10', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 13:08:10', '2018-03-07 13:08:10');
INSERT INTO `interface_log` VALUES ('171', '2018-03-07 13:08:12', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 13:08:12', '2018-03-07 13:08:12');
INSERT INTO `interface_log` VALUES ('172', '2018-03-07 13:08:30', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 13:08:30', '2018-03-07 13:08:30');
INSERT INTO `interface_log` VALUES ('173', '2018-03-07 13:08:54', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 13:08:54', '2018-03-07 13:08:54');
INSERT INTO `interface_log` VALUES ('174', '2018-03-07 13:08:56', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 13:08:56', '2018-03-07 13:08:56');
INSERT INTO `interface_log` VALUES ('175', '2018-03-07 13:09:07', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 13:09:07', '2018-03-07 13:09:07');
INSERT INTO `interface_log` VALUES ('176', '2018-03-07 13:09:08', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 13:09:08', '2018-03-07 13:09:08');
INSERT INTO `interface_log` VALUES ('177', '2018-03-07 13:09:18', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 13:09:18', '2018-03-07 13:09:18');
INSERT INTO `interface_log` VALUES ('178', '2018-03-07 13:10:05', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 13:10:05', '2018-03-07 13:10:05');
INSERT INTO `interface_log` VALUES ('179', '2018-03-07 13:11:22', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 13:11:22', '2018-03-07 13:11:22');
INSERT INTO `interface_log` VALUES ('180', '2018-03-07 13:11:25', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 13:11:25', '2018-03-07 13:11:25');
INSERT INTO `interface_log` VALUES ('181', '2018-03-07 13:11:41', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 13:11:41', '2018-03-07 13:11:41');
INSERT INTO `interface_log` VALUES ('182', '2018-03-07 13:11:59', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 13:11:59', '2018-03-07 13:11:59');
INSERT INTO `interface_log` VALUES ('183', '2018-03-07 13:12:17', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 13:12:17', '2018-03-07 13:12:17');
INSERT INTO `interface_log` VALUES ('184', '2018-03-07 13:12:37', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 13:12:37', '2018-03-07 13:12:37');
INSERT INTO `interface_log` VALUES ('186', '2018-03-07 13:16:35', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 13:16:35', '2018-03-07 13:16:35');
INSERT INTO `interface_log` VALUES ('187', '2018-03-07 13:17:09', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 13:17:09', '2018-03-07 13:17:09');
INSERT INTO `interface_log` VALUES ('188', '2018-03-07 13:17:55', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 13:17:55', '2018-03-07 13:17:55');
INSERT INTO `interface_log` VALUES ('189', '2018-03-07 13:18:24', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 13:18:24', '2018-03-07 13:18:24');
INSERT INTO `interface_log` VALUES ('190', '2018-03-07 13:18:47', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 13:18:47', '2018-03-07 13:18:47');
INSERT INTO `interface_log` VALUES ('191', '2018-03-07 13:27:13', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 13:27:13', '2018-03-07 13:27:13');
INSERT INTO `interface_log` VALUES ('192', '2018-03-07 13:58:22', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '1', '1', '2018-03-07 13:58:22', '2018-03-07 13:58:22');
INSERT INTO `interface_log` VALUES ('194', '2018-03-17 22:05:04', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 22:05:04', '2018-03-17 22:05:04');
INSERT INTO `interface_log` VALUES ('195', '2018-03-17 22:05:16', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 22:05:16', '2018-03-17 22:05:16');
INSERT INTO `interface_log` VALUES ('196', '2018-03-17 22:09:10', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 22:09:10', '2018-03-17 22:09:10');
INSERT INTO `interface_log` VALUES ('197', '2018-03-17 22:09:22', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 22:09:22', '2018-03-17 22:09:22');
INSERT INTO `interface_log` VALUES ('198', '2018-03-17 22:09:27', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 22:09:27', '2018-03-17 22:09:27');
INSERT INTO `interface_log` VALUES ('199', '2018-03-17 22:13:34', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 22:13:34', '2018-03-17 22:13:34');
INSERT INTO `interface_log` VALUES ('200', '2018-03-17 22:14:38', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 22:14:38', '2018-03-17 22:14:38');
INSERT INTO `interface_log` VALUES ('201', '2018-03-17 22:14:43', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 22:14:43', '2018-03-17 22:14:43');
INSERT INTO `interface_log` VALUES ('202', '2018-03-17 22:16:21', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 22:16:21', '2018-03-17 22:16:21');
INSERT INTO `interface_log` VALUES ('203', '2018-03-17 22:16:58', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 22:16:58', '2018-03-17 22:16:58');
INSERT INTO `interface_log` VALUES ('204', '2018-03-17 22:17:45', '0', 'AA-AA-AA-2C-AC', 'MofangBox-3A18E8', null, null, '2018-03-17 22:17:45', '2018-03-17 22:17:45');
INSERT INTO `interface_log` VALUES ('205', '2018-03-17 22:17:54', '0', 'AA-AA-AA-2C-AC', 'MofangBox-3A18E8', null, null, '2018-03-17 22:17:54', '2018-03-17 22:17:54');
INSERT INTO `interface_log` VALUES ('206', '2018-03-17 22:19:48', '0', 'AA-AA-AA-2C-AC', 'MofangBox-3A18E8', null, null, '2018-03-17 22:19:48', '2018-03-17 22:19:48');
INSERT INTO `interface_log` VALUES ('207', '2018-03-17 22:20:04', '0', 'AA-AA-AA-2C-AC', 'MofangBox-3A18E8', null, null, '2018-03-17 22:20:04', '2018-03-17 22:20:04');
INSERT INTO `interface_log` VALUES ('208', '2018-03-17 22:20:40', '0', 'AA-AA-AA-2C-AC', 'MofangBox-3A18E8', null, null, '2018-03-17 22:20:40', '2018-03-17 22:20:40');
INSERT INTO `interface_log` VALUES ('209', '2018-03-17 22:21:19', '0', 'AA-AA-AA-2C-AC', 'MofangBox-3A18E8', null, null, '2018-03-17 22:21:19', '2018-03-17 22:21:19');
INSERT INTO `interface_log` VALUES ('210', '2018-03-17 22:21:42', '0', 'AA-AA-AA-2C-AC', 'MofangBox-3A18E8', null, null, '2018-03-17 22:21:42', '2018-03-17 22:21:42');
INSERT INTO `interface_log` VALUES ('211', '2018-03-17 22:21:57', '0', 'AA-AA-AA-2C-AC', 'MofangBox-3A18E8', null, null, '2018-03-17 22:21:57', '2018-03-17 22:21:57');
INSERT INTO `interface_log` VALUES ('212', '2018-03-17 22:22:48', '0', 'AA-AA-AA-2C-AC', 'MofangBox-3A18E8', null, null, '2018-03-17 22:22:48', '2018-03-17 22:22:48');
INSERT INTO `interface_log` VALUES ('213', '2018-03-17 22:24:24', '0', 'AA-AA-AA-2C-AC', 'MofangBox-3A18E8', null, null, '2018-03-17 22:24:24', '2018-03-17 22:24:24');
INSERT INTO `interface_log` VALUES ('214', '2018-03-17 22:24:48', '0', 'AA-AA-AA-2C-AC', 'MofangBox-3A18E8', null, null, '2018-03-17 22:24:48', '2018-03-17 22:24:48');
INSERT INTO `interface_log` VALUES ('215', '2018-03-17 22:25:10', '0', 'AA-AA-AA-2C-AC', 'MofangBox-3A18E8', null, null, '2018-03-17 22:25:10', '2018-03-17 22:25:10');
INSERT INTO `interface_log` VALUES ('216', '2018-03-17 22:25:58', '0', 'AA-AA-AA-2C-AC', 'MofangBox-3A18E8', null, null, '2018-03-17 22:25:58', '2018-03-17 22:25:58');
INSERT INTO `interface_log` VALUES ('217', '2018-03-17 22:26:21', '0', 'AA-AA-AA-2C-AC', 'MofangBox-3A18E8', null, null, '2018-03-17 22:26:21', '2018-03-17 22:26:21');
INSERT INTO `interface_log` VALUES ('218', '2018-03-17 22:28:08', '0', 'AA-AA-AA-2C-AC', 'MofangBox-3A18E8', null, null, '2018-03-17 22:28:08', '2018-03-17 22:28:08');
INSERT INTO `interface_log` VALUES ('219', '2018-03-17 22:28:44', '0', 'AA-AA-AA-2C-AC', 'MofangBox-3A18E8', null, null, '2018-03-17 22:28:44', '2018-03-17 22:28:44');
INSERT INTO `interface_log` VALUES ('220', '2018-03-17 22:35:20', '0', 'AA-AA-AA-2C-AC', 'MofangBox-3A18E8', null, null, '2018-03-17 22:35:20', '2018-03-17 22:35:20');
INSERT INTO `interface_log` VALUES ('221', '2018-03-17 22:36:20', '0', 'AA-AA-AA-2C-AC', 'MofangBox-3A18E8', null, null, '2018-03-17 22:36:20', '2018-03-17 22:36:20');
INSERT INTO `interface_log` VALUES ('222', '2018-03-17 22:36:41', '0', 'AA-AA-AA-2C-AC', 'MofangBox-3A18E8', null, null, '2018-03-17 22:36:41', '2018-03-17 22:36:41');
INSERT INTO `interface_log` VALUES ('223', '2018-03-17 22:36:47', '0', 'AA-AA-AA-2C-AC', 'MofangBox-3A18E8', null, null, '2018-03-17 22:36:47', '2018-03-17 22:36:47');
INSERT INTO `interface_log` VALUES ('224', '2018-03-17 22:36:56', '0', 'AA-AA-AA-2C-AC', 'MofangBox-3A18E8', null, null, '2018-03-17 22:36:56', '2018-03-17 22:36:56');
INSERT INTO `interface_log` VALUES ('225', '2018-03-17 22:37:32', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 22:37:32', '2018-03-17 22:37:32');
INSERT INTO `interface_log` VALUES ('226', '2018-03-17 22:37:36', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 22:37:36', '2018-03-17 22:37:36');
INSERT INTO `interface_log` VALUES ('227', '2018-03-17 22:37:47', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 22:37:47', '2018-03-17 22:37:47');
INSERT INTO `interface_log` VALUES ('228', '2018-03-17 22:37:51', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 22:37:51', '2018-03-17 22:37:51');
INSERT INTO `interface_log` VALUES ('229', '2018-03-17 22:40:16', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 22:40:16', '2018-03-17 22:40:16');
INSERT INTO `interface_log` VALUES ('230', '2018-03-17 22:42:59', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 22:42:59', '2018-03-17 22:42:59');
INSERT INTO `interface_log` VALUES ('231', '2018-03-17 22:43:48', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 22:43:48', '2018-03-17 22:43:48');
INSERT INTO `interface_log` VALUES ('232', '2018-03-17 22:44:21', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 22:44:21', '2018-03-17 22:44:21');
INSERT INTO `interface_log` VALUES ('233', '2018-03-17 22:44:39', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 22:44:39', '2018-03-17 22:44:39');
INSERT INTO `interface_log` VALUES ('234', '2018-03-17 22:50:21', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 22:50:21', '2018-03-17 22:50:21');
INSERT INTO `interface_log` VALUES ('235', '2018-03-17 22:50:28', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 22:50:28', '2018-03-17 22:50:28');
INSERT INTO `interface_log` VALUES ('236', '2018-03-17 22:50:32', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 22:50:32', '2018-03-17 22:50:32');
INSERT INTO `interface_log` VALUES ('237', '2018-03-17 22:50:45', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 22:50:45', '2018-03-17 22:50:45');
INSERT INTO `interface_log` VALUES ('238', '2018-03-17 22:50:59', '0', 'AA-AA-AA-2C-AC', 'MofangBox-3A18E8', null, null, '2018-03-17 22:50:59', '2018-03-17 22:50:59');
INSERT INTO `interface_log` VALUES ('239', '2018-03-17 22:51:04', '0', 'AA-AA-AA-2C-AC', 'MofangBox-3A18E8', null, null, '2018-03-17 22:51:04', '2018-03-17 22:51:04');
INSERT INTO `interface_log` VALUES ('240', '2018-03-17 22:51:19', '0', 'AA-AA-AA-2C-AC', 'MofangBox-3A18E8', null, null, '2018-03-17 22:51:19', '2018-03-17 22:51:19');
INSERT INTO `interface_log` VALUES ('241', '2018-03-17 22:51:36', '0', 'AA-AA-AA-2C-AC', 'MofangBox-3A18E8', null, null, '2018-03-17 22:51:36', '2018-03-17 22:51:36');
INSERT INTO `interface_log` VALUES ('242', '2018-03-17 22:52:54', '0', 'AA-AA-AA-2C-AC', 'MofangBox-3A18E8', null, null, '2018-03-17 22:52:54', '2018-03-17 22:52:54');
INSERT INTO `interface_log` VALUES ('243', '2018-03-17 22:53:16', '0', 'AA-AA-AA-2C-AC', 'MofangBox-3A18E8', null, null, '2018-03-17 22:53:16', '2018-03-17 22:53:16');
INSERT INTO `interface_log` VALUES ('244', '2018-03-17 22:53:21', '0', 'AA-AA-AA-2C-AC', 'MofangBox-3A18E8', null, null, '2018-03-17 22:53:21', '2018-03-17 22:53:21');
INSERT INTO `interface_log` VALUES ('245', '2018-03-17 22:54:00', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 22:54:00', '2018-03-17 22:54:00');
INSERT INTO `interface_log` VALUES ('246', '2018-03-17 22:54:11', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 22:54:11', '2018-03-17 22:54:11');
INSERT INTO `interface_log` VALUES ('247', '2018-03-17 22:54:16', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 22:54:16', '2018-03-17 22:54:16');
INSERT INTO `interface_log` VALUES ('248', '2018-03-17 22:54:27', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 22:54:27', '2018-03-17 22:54:27');
INSERT INTO `interface_log` VALUES ('249', '2018-03-17 22:55:55', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 22:55:55', '2018-03-17 22:55:55');
INSERT INTO `interface_log` VALUES ('250', '2018-03-17 22:57:20', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 22:57:20', '2018-03-17 22:57:20');
INSERT INTO `interface_log` VALUES ('251', '2018-03-17 23:20:23', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 23:20:23', '2018-03-17 23:20:23');
INSERT INTO `interface_log` VALUES ('252', '2018-03-17 23:33:58', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 23:33:58', '2018-03-17 23:33:58');
INSERT INTO `interface_log` VALUES ('253', '2018-03-17 23:34:14', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 23:34:14', '2018-03-17 23:34:14');
INSERT INTO `interface_log` VALUES ('254', '2018-03-17 23:38:44', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 23:38:44', '2018-03-17 23:38:44');
INSERT INTO `interface_log` VALUES ('255', '2018-03-17 23:39:19', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 23:39:19', '2018-03-17 23:39:19');
INSERT INTO `interface_log` VALUES ('256', '2018-03-17 23:39:54', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 23:39:54', '2018-03-17 23:39:54');
INSERT INTO `interface_log` VALUES ('257', '2018-03-17 23:41:02', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 23:41:02', '2018-03-17 23:41:02');
INSERT INTO `interface_log` VALUES ('258', '2018-03-17 23:44:45', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', null, null, '2018-03-17 23:44:45', '2018-03-17 23:44:45');
INSERT INTO `interface_log` VALUES ('259', '2018-03-17 23:49:48', '0', 'AA-AA-AA-2C-AC-0010', 'MofangBox-3A18E8', null, null, '2018-03-17 23:49:48', '2018-03-17 23:49:48');
INSERT INTO `interface_log` VALUES ('260', '2018-03-17 23:49:54', '0', 'AA-AA-AA-2C-AC-0010', 'MofangBox-3A18E8', null, null, '2018-03-17 23:49:54', '2018-03-17 23:49:54');
INSERT INTO `interface_log` VALUES ('261', '2018-03-17 23:50:18', '0', 'AA-AA-AA-2C-AC-0010', 'MofangBox-3A18E8', null, null, '2018-03-17 23:50:18', '2018-03-17 23:50:18');
INSERT INTO `interface_log` VALUES ('262', '2018-03-17 23:50:36', '0', 'AA-AA-AA-2C-AC-0010', 'MofangBox-3A18E8', null, null, '2018-03-17 23:50:36', '2018-03-17 23:50:36');
INSERT INTO `interface_log` VALUES ('263', '2018-03-17 23:51:20', '0', 'AA-AA-AA-2C-AC-0010', 'MofangBox-3A18E8', null, null, '2018-03-17 23:51:20', '2018-03-17 23:51:20');
INSERT INTO `interface_log` VALUES ('264', '2018-03-17 23:51:50', '0', 'AA-AA-AA-2C-AC-0010', 'MofangBox-3A18E8', null, null, '2018-03-17 23:51:50', '2018-03-17 23:51:50');
INSERT INTO `interface_log` VALUES ('265', '2018-03-18 10:00:47', '0', 'AA-AA-AA-2C-AC-0010', 'MofangBox-3A18E8', null, null, '2018-03-18 10:00:47', '2018-03-18 10:00:47');

-- ----------------------------
-- Table structure for lan
-- ----------------------------
DROP TABLE IF EXISTS `lan`;
CREATE TABLE `lan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `router_proxy` tinyint(3) DEFAULT NULL COMMENT '路由器访问控制  正常代理=1  不走代理= 0  强制走代理=2',
  `lan_ac_mode` varchar(5) DEFAULT NULL COMMENT '内网访问控制 停用=0 仅允许列表内=w 仅允许列表外=b',
  `in_online_host` varchar(255) DEFAULT NULL COMMENT '内网主机列表',
  `global_id` int(11) NOT NULL COMMENT '绑定的全局设置ID',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lan
-- ----------------------------

-- ----------------------------
-- Table structure for mac_log
-- ----------------------------
DROP TABLE IF EXISTS `mac_log`;
CREATE TABLE `mac_log` (
  `uuid` char(32) NOT NULL,
  `creator` varchar(30) DEFAULT 'system' COMMENT '创建者',
  `created_at` datetime NOT NULL COMMENT '创建时间',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `updated_at` datetime NOT NULL COMMENT '更新时间',
  `ip` int(10) unsigned DEFAULT NULL COMMENT '请求IP地址',
  `mac` varchar(100) NOT NULL COMMENT 'mac地址',
  `ssid` varchar(100) DEFAULT NULL,
  `content` text COMMENT '内容',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mac_log
-- ----------------------------
INSERT INTO `mac_log` VALUES ('E4E0D54C157939FE5BF7DFF43EDBCE95', 'system', '2018-03-05 11:34:28', '1', '2018-03-05 11:34:28', '2130706433', 'AA-AA-AA-2C-AC-00210', 'MofangBox-3A18E8', '{\"内容\":\"修改MAC信息\"}');
INSERT INTO `mac_log` VALUES ('83F9044AD6BED0E9AD28DA6B1C896118', 'system', '2018-03-05 11:51:29', '2', '2018-03-05 11:51:29', '2130706433', 'AA-AA-AA-2C-AC-0040', 'MofangBox-3A18E8', '{\"内容\":\"修改MAC信息\"}');
INSERT INTO `mac_log` VALUES ('0EA11A5B6B710E0411A097E7C1C8E5C5', 'system', '2018-03-05 12:11:46', '3', '2018-03-05 12:11:46', '2130706433', 'AA-AA-AA-2C-AC-0050', 'MofangBox-3A18E8', '{\"内容\":\"修改MAC信息\"}');
INSERT INTO `mac_log` VALUES ('F758B9C0E65E2D7EB1DC85339B850DF8', 'system', '2018-03-05 13:10:16', '4', '2018-03-05 13:10:16', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"添加MAC信息\"}');
INSERT INTO `mac_log` VALUES ('41EDE3969B20B40D5BA3B79B2B2A03B8', 'system', '2018-03-05 13:10:27', '5', '2018-03-05 13:10:27', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"已通过审核\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('5D118AD1E8F7DC5A3B3424FDFE863752', 'system', '2018-03-05 13:27:42', '6', '2018-03-05 13:27:42', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"修改MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('42F7828EF625ECA66426EE1128ABE712', 'system', '2018-03-05 13:28:17', '7', '2018-03-05 13:28:17', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"修改MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('745DE4E530493A000FEE7ECD4D082D28', 'system', '2018-03-05 13:29:12', '8', '2018-03-05 13:29:12', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"修改MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('B62E980F8B77F5EE0879CBC91B71451B', 'system', '2018-03-05 13:29:53', '9', '2018-03-05 13:29:53', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"修改MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('05623D696B84E63916934460C02EFD1F', 'system', '2018-03-05 13:30:36', '10', '2018-03-05 13:30:36', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"修改MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('663EE5091E4FC5E23054559717555855', 'system', '2018-03-05 13:34:11', '11', '2018-03-05 13:34:11', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"修改MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('EF5933E67801FAEECEDA87B8E07FA9C6', 'system', '2018-03-05 13:35:25', '12', '2018-03-05 13:35:25', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"修改MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('D9653BEF3582DD78EAEE91DA0FFE4A7A', 'system', '2018-03-05 13:35:38', '13', '2018-03-05 13:35:38', '2130706433', 'AA-AA-AA-2C-AC-00210', 'MofangBox-3A18E8', '{\"内容\":\"修改MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('7DCA5E58CB379A430AE0FCB0DFE45F58', 'system', '2018-03-05 17:47:18', '14', '2018-03-05 17:47:18', '2130706433', '2C67FB3A19D0', 'MofangBox-3A18E8', '{\"内容\":\"添加MAC信息\"}');
INSERT INTO `mac_log` VALUES ('B51A64E2FAC0D630BF0D6AEAC0E0BD64', 'system', '2018-03-05 18:25:35', '15', '2018-03-05 18:25:35', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"修改接口日志\",\"操作人\":\"\"}');
INSERT INTO `mac_log` VALUES ('893BDA50760CB3FEF27CF2A136A5CCFB', 'system', '2018-03-05 18:25:57', '16', '2018-03-05 18:25:57', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"修改接口日志\",\"操作人\":\"\"}');
INSERT INTO `mac_log` VALUES ('3DA61ADF599B3561FB56A695291AB335', 'system', '2018-03-05 18:35:23', '17', '2018-03-05 18:35:23', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"删除MAC\",\"操作人\":\"\"}');
INSERT INTO `mac_log` VALUES ('A69B39E8F7F02D415C447483E1B797A4', 'system', '2018-03-05 18:35:38', '18', '2018-03-05 18:35:38', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"删除MAC\",\"操作人\":\"\"}');
INSERT INTO `mac_log` VALUES ('64761210EDAE5985FC28AC6BB02815D4', 'system', '2018-03-05 21:20:34', '19', '2018-03-05 21:20:34', '2130706433', '2C67FB3A19D0', 'MofangBox-3A18E8', '{\"内容\":\"删除接口日志\",\"操作人\":\"\"}');
INSERT INTO `mac_log` VALUES ('FE6A1394FB2C83096A74D759B29D109C', 'system', '2018-03-05 21:20:34', '20', '2018-03-05 21:20:34', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"删除接口日志\",\"操作人\":\"\"}');
INSERT INTO `mac_log` VALUES ('C6622D348DB9D43A4A04FE71C07C94C7', 'system', '2018-03-05 21:25:21', '21', '2018-03-05 21:25:21', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"删除接口日志\",\"操作人\":\"\"}');
INSERT INTO `mac_log` VALUES ('18C3645E7D9B4E88B9C68CB278B58ACC', 'system', '2018-03-05 21:25:21', '22', '2018-03-05 21:25:21', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"删除接口日志\",\"操作人\":\"\"}');
INSERT INTO `mac_log` VALUES ('D62CA3FC4A840938ACEDAC016918AE4E', 'system', '2018-03-05 21:25:45', '23', '2018-03-05 21:25:45', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"修改接口日志\",\"操作人\":\"\"}');
INSERT INTO `mac_log` VALUES ('8F66C798B155EE14BD670C21E2C341A1', 'system', '2018-03-06 08:13:25', '24', '2018-03-06 08:13:25', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"修改接口日志\",\"操作人\":\"\"}');
INSERT INTO `mac_log` VALUES ('277FD0C163EE0EDAD97B45C2686A92DC', 'system', '2018-03-06 08:14:16', '25', '2018-03-06 08:14:16', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"修改接口日志\",\"操作人\":\"\"}');
INSERT INTO `mac_log` VALUES ('081E89C89C97A28596AC87D1539E0940', 'system', '2018-03-06 08:20:22', '26', '2018-03-06 08:20:22', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"修改接口日志\",\"操作人\":\"\"}');
INSERT INTO `mac_log` VALUES ('2D8E9F33AB2850D82B32DC957797DF53', 'system', '2018-03-06 08:20:36', '27', '2018-03-06 08:20:36', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"修改接口日志\",\"操作人\":\"\"}');
INSERT INTO `mac_log` VALUES ('C82046CCBA76F8591F7D081346956E15', 'system', '2018-03-06 08:20:52', '28', '2018-03-06 08:20:52', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"修改接口日志\",\"操作人\":\"\"}');
INSERT INTO `mac_log` VALUES ('C99653CB9ED80E3371858ECA99301E6A', 'system', '2018-03-06 08:28:21', '29', '2018-03-06 08:28:21', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"删除接口日志\",\"操作人\":\"\"}');
INSERT INTO `mac_log` VALUES ('E42F7BBF18B151FD72E9B15DEC2A9BF1', 'system', '2018-03-06 08:28:26', '30', '2018-03-06 08:28:26', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"删除接口日志\",\"操作人\":\"\"}');
INSERT INTO `mac_log` VALUES ('C7A340C3C320A86AFE2183EA6A170B5B', 'system', '2018-03-06 08:28:27', '31', '2018-03-06 08:28:27', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"删除接口日志\",\"操作人\":\"\"}');
INSERT INTO `mac_log` VALUES ('AC1647A01CA91924FDC49CB757FC5683', 'system', '2018-03-06 09:04:24', '32', '2018-03-06 09:04:24', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"修改接口日志\",\"操作人\":\"\"}');
INSERT INTO `mac_log` VALUES ('64F0DAE0C6187C0728EB183E9C70D16E', 'system', '2018-03-06 09:04:34', '33', '2018-03-06 09:04:34', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"删除接口日志\",\"操作人\":\"\"}');
INSERT INTO `mac_log` VALUES ('620251A4FF6D600602AD9D386B9293AB', 'system', '2018-03-06 10:34:25', '34', '2018-03-06 10:34:25', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"删除接口日志\",\"操作人\":\"\"}');
INSERT INTO `mac_log` VALUES ('7CDC84F8FFAA89A0825A7FA65FA93F52', 'system', '2018-03-06 10:34:31', '35', '2018-03-06 10:34:31', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"删除接口日志\",\"操作人\":\"\"}');
INSERT INTO `mac_log` VALUES ('138D63BB76EC77F8615E2D985A7E68BE', 'system', '2018-03-06 10:34:31', '36', '2018-03-06 10:34:31', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"删除接口日志\",\"操作人\":\"\"}');
INSERT INTO `mac_log` VALUES ('FD9CB1E3F709FA151A50C96B71401027', 'system', '2018-03-06 11:02:32', '37', '2018-03-06 11:02:32', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"修改接口日志\",\"操作人\":\"\"}');
INSERT INTO `mac_log` VALUES ('ADCC36ADEA15403AA9738EEDA25A435C', 'system', '2018-03-06 12:57:56', '38', '2018-03-06 12:57:56', '2130706433', 'AA-AA-AA-2C-AC', 'MofangBox-3A18E8', '{\"内容\":\"修改MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('9D968374639AB73251EECBD8D14A8C4F', 'system', '2018-03-06 13:03:59', '39', '2018-03-06 13:03:59', '2130706433', 'AA-AA-AA-2C-AC-00', 'MofangBox-3A18E8', '{\"内容\":\"修改MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('6802F0D645CE38ABABB2F6A57EBECFCD', 'system', '2018-03-06 13:05:58', '40', '2018-03-06 13:05:58', '2130706433', 'AA-AA-AA-2C-AC-00', 'MofangBox-3A18E8', '{\"内容\":\"修改MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('1766EC98C84563B4F1381F3BEA699017', 'system', '2018-03-06 13:06:05', '41', '2018-03-06 13:06:05', '2130706433', 'AA-AA-AA-2C-AC-00', 'MofangBox-3A18E8', '{\"内容\":\"修改MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('939A381AB4D7FB68C02B944A6DA30C1C', 'system', '2018-03-06 13:06:26', '42', '2018-03-06 13:06:26', '2130706433', 'AA-AA-AA-2C-AC-00', 'MofangBox-3A18E8', '{\"内容\":\"修改MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('91DC4AFCDD6EC05355A8B4557936894D', 'system', '2018-03-06 13:06:38', '43', '2018-03-06 13:06:38', '2130706433', 'AA-AA-AA-2C-AC-00', 'MofangBox-3A18E8', '{\"内容\":\"修改MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('9AC0C74D6992EEECCB069BC11D8AE036', 'system', '2018-03-06 13:07:31', '44', '2018-03-06 13:07:31', '2130706433', 'AA-AA-AA-2C-AC-00', 'MofangBox-3A18E8', '{\"内容\":\"修改MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('4912A4FF0F663E4FE1AA5C59844EFD22', 'system', '2018-03-06 13:07:46', '45', '2018-03-06 13:07:46', '2130706433', 'AA-AA-AA-2C-AC-00', 'MofangBox-3A18E8', '{\"内容\":\"修改MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('D7CDD2969FFE6B8F880A68D67062C054', 'system', '2018-03-06 13:08:28', '46', '2018-03-06 13:08:28', '2130706433', 'AA-AA-AA-2C-AC-00', 'MofangBox-3A18E8', '{\"内容\":\"修改MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('6CA74DB7C47E0C9A6A90292FF8E1B8DE', 'system', '2018-03-06 13:09:08', '47', '2018-03-06 13:09:08', '2130706433', 'AA-AA-AA-2C-AC-00', 'MofangBox-3A18E8', '{\"内容\":\"修改MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('3EE60EB5EC9D57940686ED813150DD15', 'system', '2018-03-06 13:09:33', '48', '2018-03-06 13:09:33', '2130706433', 'AA-AA-AA-2C-AC-00', 'MofangBox-3A18E8', '{\"内容\":\"修改MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('55F75BF2E5A415D12DC2C79C826CDD05', 'system', '2018-03-06 13:12:02', '49', '2018-03-06 13:12:02', '2130706433', 'AA-AA-AA-2C-AC-00', 'MofangBox-3A18E8', '{\"内容\":\"修改MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('254B725343E2E1237B093C9236D30E39', 'system', '2018-03-06 13:23:40', '50', '2018-03-06 13:23:40', '2130706433', '2C67FB3A19D0', 'MofangBox-3A18E8', '{\"内容\":\"修改MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('513995F769ACC868FE4F2262D9B206C9', 'system', '2018-03-06 13:25:49', '51', '2018-03-06 13:25:49', '2130706433', '2C67FB3A19D0', 'MofangBox-3A18E8', '{\"内容\":\"修改MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('D2153094FF49A7D68DFAE7012E9E45D4', 'system', '2018-03-06 13:31:13', '52', '2018-03-06 13:31:13', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"修改接口日志\",\"操作人\":\"\"}');
INSERT INTO `mac_log` VALUES ('17BA597C8A993A530FCEC3D456A0DDB2', 'system', '2018-03-06 13:31:57', '53', '2018-03-06 13:31:57', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"修改接口日志\",\"操作人\":\"\"}');
INSERT INTO `mac_log` VALUES ('2C8E57E1E5B4B2D92BC81E706A63BC20', 'system', '2018-03-06 14:25:51', '54', '2018-03-06 14:25:51', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"修改接口日志\",\"操作人\":\"\"}');
INSERT INTO `mac_log` VALUES ('A5E96067DDE79D3B0CD980DB71BC89B1', 'system', '2018-03-06 14:26:21', '55', '2018-03-06 14:26:21', '2130706433', 'AA-AA-AA-2C-AC-00210', 'MofangBox-3A18E8', '{\"内容\":\"修改接口日志\",\"操作人\":\"\"}');
INSERT INTO `mac_log` VALUES ('471335F98E33A4B9D6D8518AA4EB0D9F', 'system', '2018-03-06 14:26:46', '56', '2018-03-06 14:26:46', '2130706433', 'AA-AA-AA-2C-AC-0021012', 'MofangBox-3A18E8', '{\"内容\":\"修改接口日志\",\"操作人\":\"\"}');
INSERT INTO `mac_log` VALUES ('8499ABE0220E510EBF2FC7B74788E87F', 'system', '2018-03-06 14:27:40', '57', '2018-03-06 14:27:40', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"修改接口日志\",\"操作人\":\"\"}');
INSERT INTO `mac_log` VALUES ('6198DA6FEDB61D8750316010DA5ED54E', 'system', '2018-03-06 14:28:07', '58', '2018-03-06 14:28:07', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"修改接口日志\",\"操作人\":\"\"}');
INSERT INTO `mac_log` VALUES ('6F931CF84B04B4C52438998EE3E0207E', 'system', '2018-03-06 14:28:16', '59', '2018-03-06 14:28:16', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"修改接口日志\",\"操作人\":\"\"}');
INSERT INTO `mac_log` VALUES ('28DEA309149D326DBAF873C6925949B8', 'system', '2018-03-06 14:30:28', '60', '2018-03-06 14:30:28', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"添加MAC信息\"}');
INSERT INTO `mac_log` VALUES ('B1BC2C88C1A3B25D42443E4F4E533660', 'system', '2018-03-06 15:12:56', '61', '2018-03-06 15:12:56', '2130706433', '2C67FB3A19D0', 'MofangBox-3A18E8', '{\"内容\":\"修改MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('5237EF9C89CB9E97C081DF38300F3B4B', 'system', '2018-03-06 15:13:30', '62', '2018-03-06 15:13:30', '2130706433', 'AA-AA-AA-2C-AC-00', 'MofangBox-3A18E8', '{\"内容\":\"修改MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('DB8B9F39110A876E5214545D62E3AAB6', 'system', '2018-03-07 12:50:53', '63', '2018-03-07 12:50:53', '2130706433', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"已通过审核\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('F795159F701567D403DD16BF9C547828', 'system', '2018-03-08 09:44:09', '64', '2018-03-08 09:44:09', '0', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"删除MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('69414CF8B1834D95C436D60795E65751', 'system', '2018-03-08 09:44:29', '65', '2018-03-08 09:44:29', '0', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"删除接口日志\",\"操作人\":\"\"}');
INSERT INTO `mac_log` VALUES ('C3FE0C290D8A88924BC2E03E2A1C7767', 'system', '2018-03-08 09:44:34', '66', '2018-03-08 09:44:34', '0', 'AA-AA-AA-2C-AC-0021011', 'MofangBox-3A18E8', '{\"内容\":\"删除接口日志\",\"操作人\":\"\"}');
INSERT INTO `mac_log` VALUES ('35CC636382564BF61945739ED53775A8', 'system', '2018-03-17 13:21:12', '67', '2018-03-17 13:21:12', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', '{\"内容\":\"已通过审核\",\"操作人\":\"admin1\"}');
INSERT INTO `mac_log` VALUES ('994E31476545DC519F8A0BECD39FE1BD', 'system', '2018-03-17 13:21:14', '68', '2018-03-17 13:21:14', '0', 'AA-AA-AA-2C-AC-00', 'MofangBox-3A18E8', '{\"内容\":\"已撤销审核\",\"操作人\":\"admin1\"}');
INSERT INTO `mac_log` VALUES ('D92CA24155C39829C18B6E7D319D10AF', 'system', '2018-03-17 13:21:37', '69', '2018-03-17 13:21:37', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', '{\"内容\":\"修改MAC\",\"操作人\":\"admin1\"}');
INSERT INTO `mac_log` VALUES ('6549846122A46DBFE72F499902C1EF8D', 'system', '2018-03-17 13:22:04', '70', '2018-03-17 13:22:04', '0', 'AA-AA-AA-2C-AC-00', 'MofangBox-3A18E8', '{\"内容\":\"已通过审核\",\"操作人\":\"admin1\"}');
INSERT INTO `mac_log` VALUES ('EE7DEBA6547F63DB5C835C567A06204C', 'system', '2018-03-17 23:28:52', '71', '2018-03-17 23:28:52', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', '{\"内容\":\"删除MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('82077757CBF8472B399ABFCD4E9311AF', 'system', '2018-03-17 23:29:13', '72', '2018-03-17 23:29:13', '0', 'AA-AA-AA-2C-AC-00', 'MofangBox-3A18E8', '{\"内容\":\"删除MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('74C21EB7E9EB3E864FB473744AB9EF5A', 'system', '2018-03-17 23:29:20', '73', '2018-03-17 23:29:20', '0', 'AA-AA-AA-2C-AC', 'MofangBox-3A18E8', '{\"内容\":\"删除MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('6E980C6466CA107AC8E56C19EF054345', 'system', '2018-03-17 23:29:51', '74', '2018-03-17 23:29:51', '0', 'AA-AA-AA-2C-A', 'MofangBox-3A18E8', '{\"内容\":\"删除MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('8192F9649D5CAC5C59EEDC64AA38B848', 'system', '2018-03-17 23:29:57', '75', '2018-03-17 23:29:57', '0', 'AA-AA-AA-2C', 'MofangBox-3A18E8', '{\"内容\":\"删除MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('1AF30A81BE2F5EEE8D66CFB7A615593C', 'system', '2018-03-17 23:30:06', '76', '2018-03-17 23:30:06', '0', 'AA-AA-AA-2C-AC-00f', 'C2to22', '{\"内容\":\"删除MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('D00EA13F2DB1D4F5BDF7A9513D148379', 'system', '2018-03-17 23:30:38', '77', '2018-03-17 23:30:38', '0', 'AA-AA-AA-2C-AC-0020', 'C2to223', '{\"内容\":\"删除MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('C4750855C73D7CF3694C17186CDBC72A', 'system', '2018-03-17 23:32:48', '78', '2018-03-17 23:32:48', '0', 'AA-AA-AA-2C-AC-0010', 'C2to11', '{\"内容\":\"修改MAC工作模式\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('8F9DA3683F47577FC620448859FFE95D', 'system', '2018-03-17 23:33:08', '79', '2018-03-17 23:33:08', '0', 'AA-AA-AA-2C-AC-0010', 'C2to11', '{\"内容\":\"修改MAC工作模式\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('2D2FB4A2951BB0452FF12CC2A00D7EE2', 'system', '2018-03-17 23:33:39', '80', '2018-03-17 23:33:39', '0', 'AA-AA-AA-2C-AC-0010', 'C2to11', '{\"内容\":\"修改MAC工作模式\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('6DE4BBBA34151B91CA3E65D902E15BA4', 'system', '2018-03-17 23:33:58', '81', '2018-03-17 23:33:58', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', '{\"内容\":\"添加MAC信息\"}');
INSERT INTO `mac_log` VALUES ('2AB257C28B55B53398266B83E64D11AF', 'system', '2018-03-17 23:34:09', '82', '2018-03-17 23:34:09', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', '{\"内容\":\"已通过审核\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('144A3335DCCC82C996DED291ED6C8FB7', 'system', '2018-03-17 23:35:06', '83', '2018-03-17 23:35:06', '0', 'B8-88-E3-7E-E1-3C0', 'C2to22', '{\"内容\":\"修改MAC工作模式\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('57251840D578443EAB5C0148F0DA975E', 'system', '2018-03-17 23:38:45', '84', '2018-03-17 23:38:45', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', '{\"内容\":\"添加MAC信息\"}');
INSERT INTO `mac_log` VALUES ('C1DE1873625902A398EC9238566BDB69', 'system', '2018-03-17 23:39:19', '85', '2018-03-17 23:39:19', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', '{\"内容\":\"添加MAC信息\"}');
INSERT INTO `mac_log` VALUES ('3A6D6CC4C1322D6A0272520E6B9FE5E7', 'system', '2018-03-17 23:41:02', '86', '2018-03-17 23:41:02', '0', '2C67FB3A19D0', 'MofangBox-3A18E8', '{\"内容\":\"添加MAC信息\"}');
INSERT INTO `mac_log` VALUES ('0B40E136D515B6A4A820BFDCC8CF46AF', 'system', '2018-03-17 23:49:54', '87', '2018-03-17 23:49:54', '0', 'AA-AA-AA-2C-AC-0010', 'MofangBox-3A18E8', '{\"内容\":\"修改MAC信息\"}');
INSERT INTO `mac_log` VALUES ('735A8D16CF5DC541448C7C6C141AB76B', 'system', '2018-03-17 23:50:27', '88', '2018-03-17 23:50:27', '0', 'AA-AA-AA-2C-AC-0010', 'MofangBox-3A18E8', '{\"内容\":\"修改MAC工作模式\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('5520C7E038EA98E1401B42C586B5743E', 'system', '2018-03-17 23:58:34', '89', '2018-03-17 23:58:34', '0', 'AA-AA-AA-2C-AC-0010', 'MofangBox-3A18E8', '{\"内容\":\"删除MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('3CF12C1F3F76C5AC77B8BFF2468C2377', 'system', '2018-03-18 10:00:47', '90', '2018-03-18 10:00:47', '0', 'AA-AA-AA-2C-AC-0010', 'MofangBox-3A18E8', '{\"内容\":\"添加MAC信息\"}');
INSERT INTO `mac_log` VALUES ('972A6487DD43A197F0DF3238F2557C72', 'system', '2018-03-18 12:15:40', '91', '2018-03-18 12:15:40', '0', 'AA-AA-AA-2C-AC-0010', 'MofangBox-3A18E8', '{\"内容\":\"已通过审核\",\"操作人\":\"admin1\"}');
INSERT INTO `mac_log` VALUES ('2B58E4FF18075E99B3B628B58149CC3D', 'system', '2018-03-18 12:33:07', '92', '2018-03-18 12:33:07', '0', 'B8-88-E3-7E-E1-3C10', 'C11', '{\"内容\":\"修改MAC工作模式\",\"操作人\":\"admina\"}');
INSERT INTO `mac_log` VALUES ('F23E42B7DB0E3A1D6CFD7397093EED4F', 'system', '2018-03-18 13:13:29', '93', '2018-03-18 13:13:29', '0', 'B8-88-E3-7E-E1-3C10', 'C11', '{\"内容\":\"修改MAC工作模式\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('0F8F8F4773388C6AD04285D56E89C58E', 'system', '2018-03-18 13:13:33', '94', '2018-03-18 13:13:33', '0', 'B8-88-E3-7E-E1-3C0', 'C2to22', '{\"内容\":\"修改MAC工作模式\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('3CF5A2567F0097888077F17F9B2B2F0E', 'system', '2018-03-18 15:14:28', '95', '2018-03-18 15:14:28', '0', 'AA-AA-AA-2C-AC-0010', 'MofangBox-3A18E8', '{\"内容\":\"删除MAC\",\"操作人\":\"admin\"}');
INSERT INTO `mac_log` VALUES ('9F063E223848AB2127AAB566BBFB9A11', 'system', '2018-03-18 15:27:27', '96', '2018-03-18 15:27:27', '0', 'B8-88-E3-7E-E1-3C0', 'C2to22', '{\"内容\":\"修改MAC工作模式\",\"操作人\":\"admin\"}');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for router_mac
-- ----------------------------
DROP TABLE IF EXISTS `router_mac`;
CREATE TABLE `router_mac` (
  `uuid` char(32) NOT NULL COMMENT '唯一标识符',
  `creator` varchar(50) DEFAULT 'system' COMMENT '创建者',
  `created_at` datetime NOT NULL COMMENT '创建时间',
  `mac_id` int(11) NOT NULL AUTO_INCREMENT,
  `updated_at` datetime NOT NULL COMMENT '更新时间',
  `mac` varchar(100) NOT NULL COMMENT 'mac地址',
  `ssid` varchar(100) DEFAULT NULL COMMENT 'ssid',
  `registration_time` datetime NOT NULL COMMENT '注册时间',
  `expire_date` datetime DEFAULT NULL COMMENT '到期时间',
  `useFlag` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'mac地址状态(审核、未审核)',
  `remark_info` varchar(255) DEFAULT NULL COMMENT '备注信息',
  `product_type` int(10) DEFAULT NULL COMMENT '工作模式：0关闭 1生活 2工作 3 隐云',
  PRIMARY KEY (`mac_id`),
  UNIQUE KEY `mac` (`mac`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of router_mac
-- ----------------------------
INSERT INTO `router_mac` VALUES ('EB9F45660483065C664F77737F46B8CC', 'admin', '2018-01-17 18:11:22', '5', '2018-03-01 09:47:05', 'B8-88-E3-7E-E1-3C', 'C2to22', '2018-01-17 18:11:22', '2019-01-17 23:59:59', '1', null, '0');
INSERT INTO `router_mac` VALUES ('EB9F45660483065C664F77737F46B8CC', 'admin', '2018-01-17 18:11:22', '7', '2018-01-17 18:30:33', 'B8-88-E3-7E-E1-3C1', 'C11', '2018-01-17 18:11:22', '2019-01-17 23:59:59', '1', null, '0');
INSERT INTO `router_mac` VALUES ('C3C6357AF41A6E9697240C212BDAD5C5', 'admin', '2018-01-17 18:12:15', '8', '2018-02-27 17:32:44', 'AA-AA-AA-2C-AC-001', 'C2to11', '2018-01-17 18:12:15', '2019-02-06 23:59:59', '1', null, '0');
INSERT INTO `router_mac` VALUES ('63BFEBEF12E0630A8194E6917C8E1E34', 'admin', '2018-02-28 10:02:34', '9', '2018-03-01 09:19:51', 'AA-AA-AA-2C-AC-002', 'C2to223', '2018-02-28 10:02:34', '2019-02-28 23:59:59', '1', null, '0');
INSERT INTO `router_mac` VALUES ('8D08B53630750055D0F391A1E5C01106', 'admin', '2018-02-28 13:13:42', '10', '2018-02-28 13:20:35', 'AA-AA-AA-2C-AC-003', 'C2to22', '2018-02-28 13:13:42', '2019-02-28 23:59:59', '1', null, '3');
INSERT INTO `router_mac` VALUES ('34C9E101367CD8349C2810C56A17D4AD', 'admin', '2018-02-28 13:16:23', '11', '2018-02-28 14:37:13', 'AA-AA-AA-2C-AC-004', 'C2to2234', '2018-02-28 13:16:23', '2019-02-28 23:59:59', '1', null, '2');
INSERT INTO `router_mac` VALUES ('CF24E37303A20491C5E7E8E19DB2D85A', 'admin', '2018-02-28 17:42:17', '12', '2018-02-28 17:51:49', 'AA-AA-AA-2C-AC-005', 'C2to223', '2018-02-28 17:42:17', '2019-02-28 23:59:59', '1', null, '3');
INSERT INTO `router_mac` VALUES ('D28D428BC9C1E1821E15207A26C7B053', 'admin', '2018-03-01 09:23:10', '14', '2018-03-01 09:27:39', 'AA-AA-AA-2C-AC-0021', 'C2to22', '2018-03-01 09:23:10', '2019-03-01 23:59:59', '1', null, '1');
INSERT INTO `router_mac` VALUES ('EB9F45660483065C664F77737F46B8CC', 'admin', '2018-01-17 18:11:22', '55', '2018-03-18 15:27:27', 'B8-88-E3-7E-E1-3C0', 'C2to22', '2018-01-17 18:11:22', '2019-01-17 23:59:59', '1', null, '3');
INSERT INTO `router_mac` VALUES ('EB9F45660483065C664F77737F46B8CC', 'admin', '2018-01-17 18:11:22', '77', '2018-03-18 13:13:29', 'B8-88-E3-7E-E1-3C10', 'C11', '2018-01-17 18:11:22', '2019-01-17 23:59:59', '1', null, '1');

-- ----------------------------
-- Table structure for server_list
-- ----------------------------
DROP TABLE IF EXISTS `server_list`;
CREATE TABLE `server_list` (
  `uuid` char(32) NOT NULL COMMENT '唯一标识符',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `creator` varchar(50) DEFAULT 'system' COMMENT '创建者',
  `updated_at` datetime DEFAULT NULL COMMENT '更新时间',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(100) DEFAULT NULL COMMENT '别名',
  `auth_enable` tinyint(1) DEFAULT '0' COMMENT '一次验证 0:未选 1:已选',
  `switch_enable` tinyint(1) DEFAULT '0' COMMENT '自动切换 0:未选 1:已选',
  `server` varchar(200) DEFAULT NULL COMMENT '服务器地址',
  `server_port` varchar(10) DEFAULT NULL COMMENT '服务器端口',
  `local_port` varchar(10) DEFAULT '1234' COMMENT '本地端口',
  `timeout` int(10) DEFAULT '60' COMMENT '连接超时',
  `password` varchar(50) DEFAULT NULL COMMENT '密码',
  `encrypt_method` tinyint(2) DEFAULT NULL COMMENT '加密方式',
  `protocol` tinyint(2) DEFAULT NULL COMMENT '传输协议',
  `obfs` tinyint(1) DEFAULT NULL COMMENT '混淆插件',
  `obfs_param` varchar(200) DEFAULT NULL COMMENT '混淆参数',
  `fast_open` tinyint(1) DEFAULT '0' COMMENT 'TCP快速打开 0:未选 1:已选',
  `kcp_enable` tinyint(1) DEFAULT '0' COMMENT 'KcpTun 启用 0:未选 1:已选',
  `kcp_port` varchar(10) DEFAULT NULL COMMENT 'KcpTun 端口',
  `kcp_password` varchar(50) DEFAULT NULL COMMENT 'KcpTun 密码',
  `kcp_param` varchar(200) DEFAULT NULL COMMENT 'KcpTun 参数',
  `product_type` int(10) DEFAULT '0',
  `username` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `server` (`server`,`server_port`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of server_list
-- ----------------------------
INSERT INTO `server_list` VALUES ('1900E47F6085F196F162408C67951016', '2018-03-06 16:27:01', 'admin', '2018-03-06 16:27:01', '1', 'aa', '1', '1', '2', 'a', '1234', '60', 'a', '1', '1', '1', '', '0', '0', '4000', '', '--nocomp', '0', null);
INSERT INTO `server_list` VALUES ('9E76E8CF583F247032BA593A61AA3394', '2018-03-06 16:27:10', 'admin', '2018-03-06 16:27:10', '2', 'a', '1', '1', '1', 's', '1234', '60', 'd', '1', '1', '1', '', '0', '0', '4000', '', '--nocomp', '0', null);
INSERT INTO `server_list` VALUES ('1900E47F6085F196F162408C67951016', '2018-03-06 16:27:01', 'admin', '2018-03-06 16:27:01', '3', 'aa', '1', '1', '6', 'a', '1234', '60', 'a', '1', '1', '1', '', '0', '0', '4000', '', '--nocomp', '2', null);
INSERT INTO `server_list` VALUES ('9E76E8CF583F247032BA593A61AA3394', '2018-03-06 16:27:10', 'admin', '2018-03-06 16:27:10', '4', 'a', '1', '1', '4', 's', '1234', '60', 'd', '1', '1', '1', '', '0', '0', '4000', '', '--nocomp', '2', null);
INSERT INTO `server_list` VALUES ('1900E47F6085F196F162408C67951016', '2018-03-06 16:27:01', 'admin', '2018-03-06 16:27:01', '6', 'aa', '1', '1', 'aa', 'a', '1234', '60', 'a', '1', '1', '1', '', '0', '0', '4000', '', '--nocomp', '3', null);
INSERT INTO `server_list` VALUES ('1900E47F6085F196F162408C67951016', '2018-03-06 16:27:01', 'admin', '2018-03-06 16:27:01', '11', 'aa', '1', '1', '25', 'a', '1234', '60', 'a', '1', '1', '1', '', '0', '0', '4000', '', '--nocomp', '0', null);
INSERT INTO `server_list` VALUES ('9E76E8CF583F247032BA593A61AA3394', '2018-03-06 16:27:10', 'admin', '2018-03-06 16:27:10', '22', 'a', '1', '1', '14', 's', '1234', '60', 'd', '1', '1', '1', '', '0', '0', '4000', '', '--nocomp', '1', null);
INSERT INTO `server_list` VALUES ('9E76E8CF583F247032BA593A61AA3394', '2018-03-06 16:27:10', 'admin', '2018-03-06 16:27:10', '23', 'a', '1', '1', '1y', 's', '1234', '60', 'd', '1', '1', '1', '', '0', '0', '4000', '', '--nocomp', '1', null);
INSERT INTO `server_list` VALUES ('1900E47F6085F196F162408C67951016', '2018-03-06 16:27:01', 'admin', '2018-03-06 16:27:01', '33', 'aa', '1', '1', '63', 'a', '1234', '60', 'a', '1', '1', '1', '', '0', '0', '4000', '', '--nocomp', '2', null);
INSERT INTO `server_list` VALUES ('1900E47F6085F196F162408C67951016', '2018-03-06 16:27:01', 'admin', '2018-03-06 16:27:01', '34', 'aa', '1', '1', '6u', 'a', '1234', '60', 'a', '1', '1', '1', '', '0', '0', '4000', '', '--nocomp', '1', null);
INSERT INTO `server_list` VALUES ('C84DE04AE1476DBCA905245C47BA2794', '2018-03-17 17:31:48', 'admin1', '2018-03-17 17:33:29', '66', '', '1', '1', '1', '1', '1234', '60', '1', '1', '1', '1', '1', '1', '1', '4000', '1', '--nocomp', '2', null);
INSERT INTO `server_list` VALUES ('D988F81318BEF9F0A02AFB7D463ADDCB', '2018-03-17 17:42:21', 'admin1', '2018-03-17 17:45:01', '67', '', '1', '1', '433', '1', '1234', '60', '123456', '1', '1', '1', '', '1', '1', '4000', '', '--nocomp', '0', 'admin1');

-- ----------------------------
-- Table structure for set_server
-- ----------------------------
DROP TABLE IF EXISTS `set_server`;
CREATE TABLE `set_server` (
  `rid` int(11) NOT NULL COMMENT '路由器的ID',
  `sid` int(11) NOT NULL COMMENT '关联的服务器的ID',
  `uid` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of set_server
-- ----------------------------
INSERT INTO `set_server` VALUES ('77', '34', '10');
INSERT INTO `set_server` VALUES ('55', '6', '1');
INSERT INTO `set_server` VALUES ('14', '34', '10');
INSERT INTO `set_server` VALUES ('11', '4', '1');
INSERT INTO `set_server` VALUES ('12', '6', '1');

-- ----------------------------
-- Table structure for set_user_router
-- ----------------------------
DROP TABLE IF EXISTS `set_user_router`;
CREATE TABLE `set_user_router` (
  `rid` int(10) NOT NULL COMMENT '绑定的路由id',
  `uid` int(10) NOT NULL COMMENT '绑定的用户id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of set_user_router
-- ----------------------------
INSERT INTO `set_user_router` VALUES ('55', '10');
INSERT INTO `set_user_router` VALUES ('77', '10');
INSERT INTO `set_user_router` VALUES ('55', '2');
INSERT INTO `set_user_router` VALUES ('14', '2');
INSERT INTO `set_user_router` VALUES ('12', '2');
INSERT INTO `set_user_router` VALUES ('77', '9');
INSERT INTO `set_user_router` VALUES ('55', '9');
INSERT INTO `set_user_router` VALUES ('9', '7');
INSERT INTO `set_user_router` VALUES ('10', '7');
INSERT INTO `set_user_router` VALUES ('11', '7');
INSERT INTO `set_user_router` VALUES ('12', '7');
INSERT INTO `set_user_router` VALUES ('14', '10');
INSERT INTO `set_user_router` VALUES ('12', '10');

-- ----------------------------
-- Table structure for set_user_server
-- ----------------------------
DROP TABLE IF EXISTS `set_user_server`;
CREATE TABLE `set_user_server` (
  `sid` int(10) NOT NULL COMMENT '绑定服务器id',
  `uid` int(10) NOT NULL COMMENT '绑定用户id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of set_user_server
-- ----------------------------
INSERT INTO `set_user_server` VALUES ('11', '7');
INSERT INTO `set_user_server` VALUES ('6', '7');
INSERT INTO `set_user_server` VALUES ('66', '9');
INSERT INTO `set_user_server` VALUES ('67', '9');
INSERT INTO `set_user_server` VALUES ('22', '7');
INSERT INTO `set_user_server` VALUES ('23', '7');
INSERT INTO `set_user_server` VALUES ('33', '7');
INSERT INTO `set_user_server` VALUES ('34', '7');
INSERT INTO `set_user_server` VALUES ('4', '7');
INSERT INTO `set_user_server` VALUES ('3', '7');
INSERT INTO `set_user_server` VALUES ('67', '10');
INSERT INTO `set_user_server` VALUES ('66', '10');
INSERT INTO `set_user_server` VALUES ('34', '10');

-- ----------------------------
-- Table structure for set_wifi
-- ----------------------------
DROP TABLE IF EXISTS `set_wifi`;
CREATE TABLE `set_wifi` (
  `rid` int(11) NOT NULL COMMENT '路由的id',
  `ssid` varchar(100) DEFAULT NULL COMMENT '路由的ssid',
  `key` varchar(255) DEFAULT NULL COMMENT '密码',
  `needset` tinyint(2) DEFAULT NULL COMMENT '一次性 0关闭 1 开启',
  `encryption` varchar(255) DEFAULT NULL COMMENT '加密类型',
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of set_wifi
-- ----------------------------
INSERT INTO `set_wifi` VALUES ('1414', 'admin11', '123456', '1', 'psk2', '2018-03-05 13:03:40', '2018-03-05 10:36:09');
INSERT INTO `set_wifi` VALUES ('1415', 'MofangBox-3A18E8', '1111', '0', 'wep-shared', '2018-03-06 12:58:04', '2018-03-05 16:54:19');
INSERT INTO `set_wifi` VALUES ('1416', 'MofangBox-3A18E8', '', '0', 'none', '2018-03-06 13:25:44', '2018-03-06 13:24:21');
INSERT INTO `set_wifi` VALUES ('1417', 'MofangBox-3A18E8', '1111', '0', 'none', '2018-03-07 13:59:13', '2018-03-07 13:26:54');

-- ----------------------------
-- Table structure for user_master
-- ----------------------------
DROP TABLE IF EXISTS `user_master`;
CREATE TABLE `user_master` (
  `uuid` char(32) NOT NULL COMMENT 'uuid',
  `created_at` datetime NOT NULL COMMENT '创建时间',
  `creator` varchar(100) NOT NULL COMMENT '创建者',
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `updated_at` datetime NOT NULL COMMENT '更新时间',
  `userName` varchar(50) NOT NULL COMMENT '用户名',
  `password` varchar(100) NOT NULL COMMENT '用户密码',
  `email` varchar(100) DEFAULT NULL COMMENT '邮箱',
  `phone` char(11) DEFAULT NULL COMMENT '移动电话',
  `permissions` tinyint(1) NOT NULL COMMENT '权限等级1:超级管理员 2:普通用户',
  `useFlag` tinyint(1) DEFAULT '1' COMMENT '用户状态 0:禁用 1:启用',
  `expire_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='用户主表';

-- ----------------------------
-- Records of user_master
-- ----------------------------
INSERT INTO `user_master` VALUES ('B8F5C3CF9C4358CDE78AE60C12A95C3E', '2017-11-07 15:16:14', 'admin', '1', '2018-03-18 16:29:05', 'admin', '$2y$10$65KJextF.8PkSzT2s2Vf6uM6hH2qlK.B5vp8KgfO3c5xxnjJGqkPS', null, null, '1', '1', null);
INSERT INTO `user_master` VALUES ('B8F5C3CF9C4358CDE78AE60C12A95C3E', '2017-11-07 15:16:14', 'admin', '2', '2018-03-18 12:26:03', 'admin1', '$2y$10$8dqK6b1yvxI84SsPY5UNX.HU1vZVtQoWDoqnqy7TiYhvrab0Q7s.q', '', '', '2', '1', '2018-04-05 01:24:49');
INSERT INTO `user_master` VALUES ('', '2018-03-17 09:43:22', 'admin', '4', '2018-03-18 12:26:19', 'admin2', '$2y$10$smuDJWbGpLKYi.H3XN86X.4CKNveLWvpNtyBrX3T0njZhORqvgeU2', null, null, '1', '1', null);
INSERT INTO `user_master` VALUES ('', '2018-03-17 09:43:51', 'admin', '5', '2018-03-17 09:44:27', 'admin13', '$2y$10$l54jy.6L1YH7nMcuZpozwems3D.7lZ2AsarHSdbGAq3M/.FWGjNpa', null, null, '1', '1', null);
INSERT INTO `user_master` VALUES ('', '2018-03-18 12:31:23', 'admin', '6', '2018-03-18 12:31:50', 'admina', '$2y$10$cf88Dj/f1ptD/3BhxQXd0.YwZnaaZxfUBgSwqPE/a0y2psB3fjCjK', null, null, '1', '1', null);
INSERT INTO `user_master` VALUES ('', '2018-03-18 12:34:15', 'admina', '7', '2018-03-18 12:35:42', 'adminb', '$2y$10$Ff7fwM6hDJZXS5Hlk2X8kO.dyYL2Io6/BjgIX1ofsCUu/q3PeCTqW', null, null, '2', '1', '2018-03-23 23:59:59');
INSERT INTO `user_master` VALUES ('', '2018-03-18 12:35:59', 'admina', '8', '2018-03-18 12:36:50', 'adminc', '$2y$10$KB4Z5hjHQHNKIwO7Gg8Bhuepkn9KKCE4lRi7ako5uLtQ6pAqlieRy', null, null, '1', '1', null);
INSERT INTO `user_master` VALUES ('', '2018-03-18 12:37:17', 'admina', '9', '2018-03-18 12:37:17', 'ad', '$2y$10$r7ouJorsd28c0bfv4rgz4uSj0sLXPoCTBzaw2YZljJ/OgDn6JRdry', null, null, '2', '1', '2018-03-23 23:59:59');
INSERT INTO `user_master` VALUES ('', '2018-03-18 16:07:48', 'qq', '10', '2018-03-18 16:08:48', 'qq', '$2y$10$BtGj5J9O0asnSyq.vraDeuoxQ857ZlMWFFl094t5mVOOjhyv8lMpu', null, null, '2', '1', '2018-03-22 23:59:59');

-- ----------------------------
-- Table structure for user_ops
-- ----------------------------
DROP TABLE IF EXISTS `user_ops`;
CREATE TABLE `user_ops` (
  `updated_at` datetime NOT NULL COMMENT '时间戳',
  `created_at` datetime NOT NULL COMMENT '创建时间',
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(60) NOT NULL COMMENT '用户名',
  `ip` int(10) unsigned DEFAULT NULL COMMENT 'ip地址',
  `op` tinyint(1) unsigned NOT NULL COMMENT '操作 1、登录 2、退出',
  `extend_json` varchar(2000) DEFAULT NULL COMMENT '扩展json',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=484 DEFAULT CHARSET=utf8 COMMENT='用户操作记录表';

-- ----------------------------
-- Records of user_ops
-- ----------------------------
INSERT INTO `user_ops` VALUES ('2017-11-07 16:20:00', '2017-11-07 16:20:00', '1', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"615262c502ce14fd4f8638be1b6adf22b348e40e\"}');
INSERT INTO `user_ops` VALUES ('2017-11-07 17:11:37', '2017-11-07 17:11:37', '2', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"615262c502ce14fd4f8638be1b6adf22b348e40e\"}');
INSERT INTO `user_ops` VALUES ('2017-11-07 17:25:14', '2017-11-07 17:25:14', '3', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\\/login\",\"session_id\":\"615262c502ce14fd4f8638be1b6adf22b348e40e\"}');
INSERT INTO `user_ops` VALUES ('2017-11-07 17:39:57', '2017-11-07 17:39:57', '4', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/dd\\/login\",\"session_id\":\"615262c502ce14fd4f8638be1b6adf22b348e40e\"}');
INSERT INTO `user_ops` VALUES ('2017-11-07 17:40:16', '2017-11-07 17:40:16', '5', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"615262c502ce14fd4f8638be1b6adf22b348e40e\"}');
INSERT INTO `user_ops` VALUES ('2017-11-07 17:53:38', '2017-11-07 17:53:38', '6', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\\/login\",\"session_id\":\"615262c502ce14fd4f8638be1b6adf22b348e40e\"}');
INSERT INTO `user_ops` VALUES ('2017-11-07 18:07:28', '2017-11-07 18:07:28', '7', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/dd\\/login\",\"session_id\":\"615262c502ce14fd4f8638be1b6adf22b348e40e\"}');
INSERT INTO `user_ops` VALUES ('2017-11-07 18:07:43', '2017-11-07 18:07:43', '8', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"615262c502ce14fd4f8638be1b6adf22b348e40e\"}');
INSERT INTO `user_ops` VALUES ('2017-11-07 18:07:46', '2017-11-07 18:07:46', '9', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\\/login\",\"session_id\":\"615262c502ce14fd4f8638be1b6adf22b348e40e\"}');
INSERT INTO `user_ops` VALUES ('2017-11-07 18:07:54', '2017-11-07 18:07:54', '10', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/dd\\/login\",\"session_id\":\"615262c502ce14fd4f8638be1b6adf22b348e40e\"}');
INSERT INTO `user_ops` VALUES ('2017-11-07 18:08:37', '2017-11-07 18:08:37', '11', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"615262c502ce14fd4f8638be1b6adf22b348e40e\"}');
INSERT INTO `user_ops` VALUES ('2017-11-07 18:09:13', '2017-11-07 18:09:13', '12', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\\/login\",\"session_id\":\"615262c502ce14fd4f8638be1b6adf22b348e40e\"}');
INSERT INTO `user_ops` VALUES ('2017-11-07 18:09:52', '2017-11-07 18:09:52', '13', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/dd\\/login\",\"session_id\":\"615262c502ce14fd4f8638be1b6adf22b348e40e\"}');
INSERT INTO `user_ops` VALUES ('2017-11-07 18:12:39', '2017-11-07 18:12:39', '14', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"615262c502ce14fd4f8638be1b6adf22b348e40e\"}');
INSERT INTO `user_ops` VALUES ('2017-11-07 18:12:42', '2017-11-07 18:12:42', '15', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"615262c502ce14fd4f8638be1b6adf22b348e40e\"}');
INSERT INTO `user_ops` VALUES ('2017-11-07 18:12:51', '2017-11-07 18:12:51', '16', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"615262c502ce14fd4f8638be1b6adf22b348e40e\"}');
INSERT INTO `user_ops` VALUES ('2017-11-08 09:06:31', '2017-11-08 09:06:31', '17', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"3db9acc266d855ea1c17cdfddc885281e4a341cb\"}');
INSERT INTO `user_ops` VALUES ('2017-11-10 08:58:07', '2017-11-10 08:58:07', '18', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"bec0e3fa30fc2c6a4c1e3dafc540820085107307\"}');
INSERT INTO `user_ops` VALUES ('2017-11-10 11:59:32', '2017-11-10 11:59:32', '19', 'admin', '2130706433', '1', '{\"redirect_url\":\"http:\\/\\/127.0.0.1:8095\\/dd\",\"session_id\":\"8d8351ea6e69bbedb7db9660fb52cb55198ed600\"}');
INSERT INTO `user_ops` VALUES ('2017-11-10 13:10:47', '2017-11-10 13:10:47', '20', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"8d8351ea6e69bbedb7db9660fb52cb55198ed600\"}');
INSERT INTO `user_ops` VALUES ('2017-11-17 21:59:00', '2017-11-17 21:59:00', '21', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"678a28f6c74076a808d39ada1cb819b48ea4650e\"}');
INSERT INTO `user_ops` VALUES ('2017-11-22 17:49:42', '2017-11-22 17:49:42', '22', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"b05ee87902f8e5bbaf4d31c2aeca349d6f6bdb8e\"}');
INSERT INTO `user_ops` VALUES ('2018-01-16 20:31:21', '2018-01-16 20:31:21', '23', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"88bf4b27b84dc684002220e118742c5a43575a40\"}');
INSERT INTO `user_ops` VALUES ('2018-01-17 09:59:36', '2018-01-17 09:59:36', '24', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"abd7b1c5be1fc663cc1a666c2601055a0a764c4a\"}');
INSERT INTO `user_ops` VALUES ('2018-01-17 21:41:12', '2018-01-17 21:41:12', '25', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"0af36594883340603fa86ebde4ecf690e45b70c4\"}');
INSERT INTO `user_ops` VALUES ('2018-01-18 08:53:08', '2018-01-18 08:53:08', '26', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"3b0cccedbb15a65f720904b6ec468087d423ccc9\"}');
INSERT INTO `user_ops` VALUES ('2018-01-19 14:23:11', '2018-01-19 14:23:11', '27', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"57748f687700bfb0fceac59cb1537d0dc5e122f7\"}');
INSERT INTO `user_ops` VALUES ('2018-01-20 12:28:35', '2018-01-20 12:28:35', '28', 'admin', '2130706433', '1', '{\"redirect_url\":\"http:\\/\\/127.0.0.1:8099\\/mf\",\"session_id\":\"339c2adeb7e56450f309a8be75fa7043f348e74b\"}');
INSERT INTO `user_ops` VALUES ('2018-01-20 14:44:55', '2018-01-20 14:44:55', '29', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"339c2adeb7e56450f309a8be75fa7043f348e74b\"}');
INSERT INTO `user_ops` VALUES ('2018-01-20 18:40:30', '2018-01-20 18:40:30', '30', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"02330368e9d1f7a7ab9286e1d0b031398ea746ce\"}');
INSERT INTO `user_ops` VALUES ('2018-01-20 22:05:11', '2018-01-20 22:05:11', '31', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"02330368e9d1f7a7ab9286e1d0b031398ea746ce\"}');
INSERT INTO `user_ops` VALUES ('2018-01-21 08:28:14', '2018-01-21 08:28:14', '32', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"0bbed2095408863e8b03e4cce9ac2f379b894258\"}');
INSERT INTO `user_ops` VALUES ('2018-01-29 11:32:47', '2018-01-29 11:32:47', '33', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"e9f652603157baf9527ec16947aa47f55f8e2438\"}');
INSERT INTO `user_ops` VALUES ('2018-01-30 09:30:24', '2018-01-30 09:30:24', '34', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"f0978e7462bbb2b4bb8028dc6b08fc12ed8a5fbb\"}');
INSERT INTO `user_ops` VALUES ('2018-01-30 09:35:36', '2018-01-30 09:35:36', '35', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"f0978e7462bbb2b4bb8028dc6b08fc12ed8a5fbb\"}');
INSERT INTO `user_ops` VALUES ('2018-01-30 09:36:20', '2018-01-30 09:36:20', '36', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"f0978e7462bbb2b4bb8028dc6b08fc12ed8a5fbb\"}');
INSERT INTO `user_ops` VALUES ('2018-01-30 09:36:56', '2018-01-30 09:36:56', '37', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"f0978e7462bbb2b4bb8028dc6b08fc12ed8a5fbb\"}');
INSERT INTO `user_ops` VALUES ('2018-02-05 09:51:41', '2018-02-05 09:51:41', '38', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"deccd9ff538987fc76cba3c82f98d144692db688\"}');
INSERT INTO `user_ops` VALUES ('2018-02-05 11:23:42', '2018-02-05 11:23:42', '39', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"e0107f51b81e07bac72540dd24e7e26a9e489297\"}');
INSERT INTO `user_ops` VALUES ('2018-02-05 11:23:43', '2018-02-05 11:23:43', '40', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"e0107f51b81e07bac72540dd24e7e26a9e489297\"}');
INSERT INTO `user_ops` VALUES ('2018-02-05 14:16:30', '2018-02-05 14:16:30', '41', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"1263ad87654d7316879f7ed4aeede5b3a76b92f4\"}');
INSERT INTO `user_ops` VALUES ('2018-02-05 15:04:53', '2018-02-05 15:04:53', '42', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"1263ad87654d7316879f7ed4aeede5b3a76b92f4\"}');
INSERT INTO `user_ops` VALUES ('2018-02-05 15:04:53', '2018-02-05 15:04:53', '43', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"1263ad87654d7316879f7ed4aeede5b3a76b92f4\"}');
INSERT INTO `user_ops` VALUES ('2018-02-05 15:12:07', '2018-02-05 15:12:07', '44', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"1263ad87654d7316879f7ed4aeede5b3a76b92f4\"}');
INSERT INTO `user_ops` VALUES ('2018-02-05 15:51:32', '2018-02-05 15:51:32', '45', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"1263ad87654d7316879f7ed4aeede5b3a76b92f4\"}');
INSERT INTO `user_ops` VALUES ('2018-02-05 15:51:49', '2018-02-05 15:51:49', '46', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"1263ad87654d7316879f7ed4aeede5b3a76b92f4\"}');
INSERT INTO `user_ops` VALUES ('2018-02-05 15:51:49', '2018-02-05 15:51:49', '47', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"1263ad87654d7316879f7ed4aeede5b3a76b92f4\"}');
INSERT INTO `user_ops` VALUES ('2018-02-05 15:54:28', '2018-02-05 15:54:28', '48', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"1263ad87654d7316879f7ed4aeede5b3a76b92f4\"}');
INSERT INTO `user_ops` VALUES ('2018-02-05 15:55:54', '2018-02-05 15:55:54', '49', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"1263ad87654d7316879f7ed4aeede5b3a76b92f4\"}');
INSERT INTO `user_ops` VALUES ('2018-02-05 16:49:27', '2018-02-05 16:49:27', '50', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"1263ad87654d7316879f7ed4aeede5b3a76b92f4\"}');
INSERT INTO `user_ops` VALUES ('2018-02-05 16:50:21', '2018-02-05 16:50:21', '51', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"1263ad87654d7316879f7ed4aeede5b3a76b92f4\"}');
INSERT INTO `user_ops` VALUES ('2018-02-05 16:50:31', '2018-02-05 16:50:31', '52', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"1263ad87654d7316879f7ed4aeede5b3a76b92f4\"}');
INSERT INTO `user_ops` VALUES ('2018-02-06 08:41:50', '2018-02-06 08:41:50', '53', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"2f2951061a0eff32847c50c286f13540058030d2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-06 08:41:50', '2018-02-06 08:41:50', '54', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"2f2951061a0eff32847c50c286f13540058030d2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-07 08:30:16', '2018-02-07 08:30:16', '55', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"5b9c50f635a537ccc075abea43aba4b89363850d\"}');
INSERT INTO `user_ops` VALUES ('2018-02-08 08:13:38', '2018-02-08 08:13:38', '56', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"563e7ae8691a71b3dbfe8aee5205fc9f69665a93\"}');
INSERT INTO `user_ops` VALUES ('2018-02-08 09:03:39', '2018-02-08 09:03:39', '57', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/f=mf\",\"session_id\":\"563e7ae8691a71b3dbfe8aee5205fc9f69665a93\"}');
INSERT INTO `user_ops` VALUES ('2018-02-08 09:03:57', '2018-02-08 09:03:57', '58', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"563e7ae8691a71b3dbfe8aee5205fc9f69665a93\"}');
INSERT INTO `user_ops` VALUES ('2018-02-08 09:47:07', '2018-02-08 09:47:07', '59', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/f=mf\",\"session_id\":\"563e7ae8691a71b3dbfe8aee5205fc9f69665a93\"}');
INSERT INTO `user_ops` VALUES ('2018-02-08 09:47:13', '2018-02-08 09:47:13', '60', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"563e7ae8691a71b3dbfe8aee5205fc9f69665a93\"}');
INSERT INTO `user_ops` VALUES ('2018-02-08 09:59:29', '2018-02-08 09:59:29', '61', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"563e7ae8691a71b3dbfe8aee5205fc9f69665a93\"}');
INSERT INTO `user_ops` VALUES ('2018-02-08 10:11:46', '2018-02-08 10:11:46', '62', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"563e7ae8691a71b3dbfe8aee5205fc9f69665a93\"}');
INSERT INTO `user_ops` VALUES ('2018-02-08 14:02:04', '2018-02-08 14:02:04', '63', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/f=mf\",\"session_id\":\"563e7ae8691a71b3dbfe8aee5205fc9f69665a93\"}');
INSERT INTO `user_ops` VALUES ('2018-02-08 14:02:09', '2018-02-08 14:02:09', '64', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"563e7ae8691a71b3dbfe8aee5205fc9f69665a93\"}');
INSERT INTO `user_ops` VALUES ('2018-02-09 08:10:27', '2018-02-09 08:10:27', '65', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"f94affa6207b5022da4ebf63999cd96c58e96e15\"}');
INSERT INTO `user_ops` VALUES ('2018-02-09 08:43:55', '2018-02-09 08:43:55', '66', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"f94affa6207b5022da4ebf63999cd96c58e96e15\"}');
INSERT INTO `user_ops` VALUES ('2018-02-09 09:50:03', '2018-02-09 09:50:03', '67', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/f=mf\",\"session_id\":\"f94affa6207b5022da4ebf63999cd96c58e96e15\"}');
INSERT INTO `user_ops` VALUES ('2018-02-09 09:50:10', '2018-02-09 09:50:10', '68', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"f94affa6207b5022da4ebf63999cd96c58e96e15\"}');
INSERT INTO `user_ops` VALUES ('2018-02-09 10:04:45', '2018-02-09 10:04:45', '69', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"f94affa6207b5022da4ebf63999cd96c58e96e15\"}');
INSERT INTO `user_ops` VALUES ('2018-02-09 10:07:21', '2018-02-09 10:07:21', '70', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"f94affa6207b5022da4ebf63999cd96c58e96e15\"}');
INSERT INTO `user_ops` VALUES ('2018-02-09 11:27:55', '2018-02-09 11:27:55', '71', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"f94affa6207b5022da4ebf63999cd96c58e96e15\"}');
INSERT INTO `user_ops` VALUES ('2018-02-09 14:10:21', '2018-02-09 14:10:21', '72', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"960445fab55accc21850825d5fef1c23d6e67bb4\"}');
INSERT INTO `user_ops` VALUES ('2018-02-10 08:13:37', '2018-02-10 08:13:37', '73', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"e78c4817ea5f2b8a31817fb50a8ca597ba1cc5e8\"}');
INSERT INTO `user_ops` VALUES ('2018-02-10 08:23:09', '2018-02-10 08:23:09', '74', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"e78c4817ea5f2b8a31817fb50a8ca597ba1cc5e8\"}');
INSERT INTO `user_ops` VALUES ('2018-02-10 09:07:01', '2018-02-10 09:07:01', '75', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/f=mf\",\"session_id\":\"e78c4817ea5f2b8a31817fb50a8ca597ba1cc5e8\"}');
INSERT INTO `user_ops` VALUES ('2018-02-10 09:07:28', '2018-02-10 09:07:28', '76', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"e78c4817ea5f2b8a31817fb50a8ca597ba1cc5e8\"}');
INSERT INTO `user_ops` VALUES ('2018-02-10 09:13:43', '2018-02-10 09:13:43', '77', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"e78c4817ea5f2b8a31817fb50a8ca597ba1cc5e8\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 10:24:51', '2018-02-24 10:24:51', '78', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"2d86cbbed64e57a50520559c7d34f6721f2eda4d\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 11:45:30', '2018-02-24 11:45:30', '79', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"48853df119e45526c952a6db33251e140d4cc746\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 11:45:31', '2018-02-24 11:45:31', '80', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"48853df119e45526c952a6db33251e140d4cc746\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 13:50:08', '2018-02-24 13:50:08', '81', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"2d86cbbed64e57a50520559c7d34f6721f2eda4d\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 16:54:39', '2018-02-24 16:54:39', '82', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 17:03:05', '2018-02-24 17:03:05', '83', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 17:03:12', '2018-02-24 17:03:12', '84', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 17:04:52', '2018-02-24 17:04:52', '85', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 17:06:03', '2018-02-24 17:06:03', '86', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 17:06:08', '2018-02-24 17:06:08', '87', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 17:06:14', '2018-02-24 17:06:14', '88', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 17:21:33', '2018-02-24 17:21:33', '89', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 17:22:22', '2018-02-24 17:22:22', '90', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 17:23:34', '2018-02-24 17:23:34', '91', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 17:23:37', '2018-02-24 17:23:37', '92', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 17:23:43', '2018-02-24 17:23:43', '93', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 17:25:53', '2018-02-24 17:25:53', '94', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 17:26:08', '2018-02-24 17:26:08', '95', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 17:26:10', '2018-02-24 17:26:10', '96', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 17:26:16', '2018-02-24 17:26:16', '97', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 17:26:24', '2018-02-24 17:26:24', '98', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 17:26:33', '2018-02-24 17:26:33', '99', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 17:27:12', '2018-02-24 17:27:12', '100', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 17:27:14', '2018-02-24 17:27:14', '101', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 17:27:16', '2018-02-24 17:27:16', '102', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 17:27:31', '2018-02-24 17:27:31', '103', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 18:01:47', '2018-02-24 18:01:47', '104', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 18:43:18', '2018-02-24 18:43:18', '105', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 18:44:54', '2018-02-24 18:44:54', '106', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 18:49:30', '2018-02-24 18:49:30', '107', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 18:49:30', '2018-02-24 18:49:30', '108', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 18:50:40', '2018-02-24 18:50:40', '109', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 19:02:19', '2018-02-24 19:02:19', '110', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 19:02:22', '2018-02-24 19:02:22', '111', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 19:02:37', '2018-02-24 19:02:37', '112', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 19:02:40', '2018-02-24 19:02:40', '113', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 19:03:32', '2018-02-24 19:03:32', '114', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 19:03:35', '2018-02-24 19:03:35', '115', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 19:05:51', '2018-02-24 19:05:51', '116', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 19:05:54', '2018-02-24 19:05:54', '117', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-24 19:33:32', '2018-02-24 19:33:32', '118', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"fcff4a97cc98e78a15268ba1d43bfcd399d509f2\"}');
INSERT INTO `user_ops` VALUES ('2018-02-26 08:12:22', '2018-02-26 08:12:22', '119', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"bd96c7a9c2c6ad1746b5eeed39bc11e7782e82ca\"}');
INSERT INTO `user_ops` VALUES ('2018-02-26 08:19:41', '2018-02-26 08:19:41', '120', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"bd96c7a9c2c6ad1746b5eeed39bc11e7782e82ca\"}');
INSERT INTO `user_ops` VALUES ('2018-02-26 08:19:45', '2018-02-26 08:19:45', '121', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"bd96c7a9c2c6ad1746b5eeed39bc11e7782e82ca\"}');
INSERT INTO `user_ops` VALUES ('2018-02-26 08:19:49', '2018-02-26 08:19:49', '122', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"bd96c7a9c2c6ad1746b5eeed39bc11e7782e82ca\"}');
INSERT INTO `user_ops` VALUES ('2018-02-26 08:19:55', '2018-02-26 08:19:55', '123', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"bd96c7a9c2c6ad1746b5eeed39bc11e7782e82ca\"}');
INSERT INTO `user_ops` VALUES ('2018-02-26 08:21:39', '2018-02-26 08:21:39', '124', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"bd96c7a9c2c6ad1746b5eeed39bc11e7782e82ca\"}');
INSERT INTO `user_ops` VALUES ('2018-02-26 08:59:36', '2018-02-26 08:59:36', '125', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"bd96c7a9c2c6ad1746b5eeed39bc11e7782e82ca\"}');
INSERT INTO `user_ops` VALUES ('2018-02-26 08:59:39', '2018-02-26 08:59:39', '126', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"bd96c7a9c2c6ad1746b5eeed39bc11e7782e82ca\"}');
INSERT INTO `user_ops` VALUES ('2018-02-26 08:59:41', '2018-02-26 08:59:41', '127', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"bd96c7a9c2c6ad1746b5eeed39bc11e7782e82ca\"}');
INSERT INTO `user_ops` VALUES ('2018-02-26 09:02:07', '2018-02-26 09:02:07', '128', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"bd96c7a9c2c6ad1746b5eeed39bc11e7782e82ca\"}');
INSERT INTO `user_ops` VALUES ('2018-02-26 09:17:35', '2018-02-26 09:17:35', '129', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"bd96c7a9c2c6ad1746b5eeed39bc11e7782e82ca\"}');
INSERT INTO `user_ops` VALUES ('2018-02-26 09:17:44', '2018-02-26 09:17:44', '130', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"bd96c7a9c2c6ad1746b5eeed39bc11e7782e82ca\"}');
INSERT INTO `user_ops` VALUES ('2018-02-26 09:17:46', '2018-02-26 09:17:46', '131', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"bd96c7a9c2c6ad1746b5eeed39bc11e7782e82ca\"}');
INSERT INTO `user_ops` VALUES ('2018-02-26 09:17:48', '2018-02-26 09:17:48', '132', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"bd96c7a9c2c6ad1746b5eeed39bc11e7782e82ca\"}');
INSERT INTO `user_ops` VALUES ('2018-02-26 09:17:51', '2018-02-26 09:17:51', '133', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"bd96c7a9c2c6ad1746b5eeed39bc11e7782e82ca\"}');
INSERT INTO `user_ops` VALUES ('2018-02-26 09:18:00', '2018-02-26 09:18:00', '134', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"bd96c7a9c2c6ad1746b5eeed39bc11e7782e82ca\"}');
INSERT INTO `user_ops` VALUES ('2018-02-26 09:20:30', '2018-02-26 09:20:30', '135', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"bd96c7a9c2c6ad1746b5eeed39bc11e7782e82ca\"}');
INSERT INTO `user_ops` VALUES ('2018-02-26 09:20:50', '2018-02-26 09:20:50', '136', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"bd96c7a9c2c6ad1746b5eeed39bc11e7782e82ca\"}');
INSERT INTO `user_ops` VALUES ('2018-02-26 10:08:44', '2018-02-26 10:08:44', '137', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"11e03634e38f6600287404a100c26e89f0bae082\"}');
INSERT INTO `user_ops` VALUES ('2018-02-26 15:20:07', '2018-02-26 15:20:07', '138', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"825b89ce5f24f2acf1e5f95d03358e68e279d39c\"}');
INSERT INTO `user_ops` VALUES ('2018-02-26 15:29:13', '2018-02-26 15:29:13', '139', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"ce44090dcecfa15c32a275c40bd6d47469a5d201\"}');
INSERT INTO `user_ops` VALUES ('2018-02-26 16:16:56', '2018-02-26 16:16:56', '140', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"825b89ce5f24f2acf1e5f95d03358e68e279d39c\"}');
INSERT INTO `user_ops` VALUES ('2018-02-26 17:22:24', '2018-02-26 17:22:24', '141', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"825b89ce5f24f2acf1e5f95d03358e68e279d39c\"}');
INSERT INTO `user_ops` VALUES ('2018-02-26 18:33:28', '2018-02-26 18:33:28', '142', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"825b89ce5f24f2acf1e5f95d03358e68e279d39c\"}');
INSERT INTO `user_ops` VALUES ('2018-02-26 18:58:05', '2018-02-26 18:58:05', '143', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"825b89ce5f24f2acf1e5f95d03358e68e279d39c\"}');
INSERT INTO `user_ops` VALUES ('2018-02-26 18:58:07', '2018-02-26 18:58:07', '144', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"825b89ce5f24f2acf1e5f95d03358e68e279d39c\"}');
INSERT INTO `user_ops` VALUES ('2018-02-27 08:56:59', '2018-02-27 08:56:59', '145', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"cc37a6794ec5bb9c8771eee465a3f6a0a683aadc\"}');
INSERT INTO `user_ops` VALUES ('2018-02-27 13:41:28', '2018-02-27 13:41:28', '146', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"04f812d5f9240c08592815aa8b95f375b4494e1e\"}');
INSERT INTO `user_ops` VALUES ('2018-02-27 17:30:49', '2018-02-27 17:30:49', '147', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"f15c6ef467f852a62311a3ad9db471ce9c9e4610\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 09:09:03', '2018-02-28 09:09:03', '148', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 10:25:55', '2018-02-28 10:25:55', '149', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 10:25:59', '2018-02-28 10:25:59', '150', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 11:52:12', '2018-02-28 11:52:12', '151', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"69894d320afa475e8783d4a316dc44a31966f22b\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 14:49:54', '2018-02-28 14:49:54', '152', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 14:56:44', '2018-02-28 14:56:44', '153', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:05:47', '2018-02-28 15:05:47', '154', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:05:53', '2018-02-28 15:05:53', '155', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:20:04', '2018-02-28 15:20:04', '156', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:20:15', '2018-02-28 15:20:15', '157', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:22:08', '2018-02-28 15:22:08', '158', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:22:17', '2018-02-28 15:22:17', '159', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:22:24', '2018-02-28 15:22:24', '160', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:22:32', '2018-02-28 15:22:32', '161', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:23:16', '2018-02-28 15:23:16', '162', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:23:24', '2018-02-28 15:23:24', '163', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:24:32', '2018-02-28 15:24:32', '164', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:24:37', '2018-02-28 15:24:37', '165', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:25:23', '2018-02-28 15:25:23', '166', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:25:30', '2018-02-28 15:25:30', '167', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:26:35', '2018-02-28 15:26:35', '168', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:26:40', '2018-02-28 15:26:40', '169', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:27:24', '2018-02-28 15:27:24', '170', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:27:31', '2018-02-28 15:27:31', '171', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:29:18', '2018-02-28 15:29:18', '172', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:29:20', '2018-02-28 15:29:20', '173', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:29:22', '2018-02-28 15:29:22', '174', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:29:32', '2018-02-28 15:29:32', '175', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:32:23', '2018-02-28 15:32:23', '176', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:32:29', '2018-02-28 15:32:29', '177', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:33:30', '2018-02-28 15:33:30', '178', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:33:32', '2018-02-28 15:33:32', '179', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:34:53', '2018-02-28 15:34:53', '180', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:34:57', '2018-02-28 15:34:57', '181', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:35:01', '2018-02-28 15:35:01', '182', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:35:06', '2018-02-28 15:35:06', '183', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:41:05', '2018-02-28 15:41:05', '184', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:41:17', '2018-02-28 15:41:17', '185', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:42:53', '2018-02-28 15:42:53', '186', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:42:58', '2018-02-28 15:42:58', '187', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:42:58', '2018-02-28 15:42:58', '188', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:43:32', '2018-02-28 15:43:32', '189', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:43:37', '2018-02-28 15:43:37', '190', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:43:37', '2018-02-28 15:43:37', '191', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:44:49', '2018-02-28 15:44:49', '192', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:44:56', '2018-02-28 15:44:56', '193', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:45:41', '2018-02-28 15:45:41', '194', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:45:52', '2018-02-28 15:45:52', '195', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:46:12', '2018-02-28 15:46:12', '196', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:46:14', '2018-02-28 15:46:14', '197', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:46:33', '2018-02-28 15:46:33', '198', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:46:38', '2018-02-28 15:46:38', '199', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:47:24', '2018-02-28 15:47:24', '200', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:47:29', '2018-02-28 15:47:29', '201', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:47:49', '2018-02-28 15:47:49', '202', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:47:57', '2018-02-28 15:47:57', '203', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:48:09', '2018-02-28 15:48:09', '204', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:48:13', '2018-02-28 15:48:13', '205', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:49:06', '2018-02-28 15:49:06', '206', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:49:11', '2018-02-28 15:49:11', '207', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:54:38', '2018-02-28 15:54:38', '208', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:54:46', '2018-02-28 15:54:46', '209', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:55:12', '2018-02-28 15:55:12', '210', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:55:17', '2018-02-28 15:55:17', '211', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:55:58', '2018-02-28 15:55:58', '212', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 15:56:01', '2018-02-28 15:56:01', '213', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 16:02:38', '2018-02-28 16:02:38', '214', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 16:02:44', '2018-02-28 16:02:44', '215', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 16:03:17', '2018-02-28 16:03:17', '216', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 16:03:25', '2018-02-28 16:03:25', '217', 'admin1', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 16:04:15', '2018-02-28 16:04:15', '218', 'admin1', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 16:04:29', '2018-02-28 16:04:29', '219', 'admin12', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 16:05:39', '2018-02-28 16:05:39', '220', 'admin12', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 16:05:51', '2018-02-28 16:05:51', '221', 'admin123', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 16:07:55', '2018-02-28 16:07:55', '222', 'admin123', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 16:08:09', '2018-02-28 16:08:09', '223', 'admin1234', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 16:10:59', '2018-02-28 16:10:59', '224', 'admin1234', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 16:11:10', '2018-02-28 16:11:10', '225', 'admin123', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 16:15:13', '2018-02-28 16:15:13', '226', 'admin123', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 16:15:29', '2018-02-28 16:15:29', '227', 'admin1234', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 16:15:59', '2018-02-28 16:15:59', '228', 'admin1234', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-02-28 16:16:02', '2018-02-28 16:16:02', '229', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9bca4b3b004916b02665d90fd3bffd9d444c7b34\"}');
INSERT INTO `user_ops` VALUES ('2018-03-01 09:10:10', '2018-03-01 09:10:10', '230', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"690f3cad4f5dacdb089210b45b82bca981061fbc\"}');
INSERT INTO `user_ops` VALUES ('2018-03-01 11:41:03', '2018-03-01 11:41:03', '231', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"690f3cad4f5dacdb089210b45b82bca981061fbc\"}');
INSERT INTO `user_ops` VALUES ('2018-03-01 11:54:06', '2018-03-01 11:54:06', '232', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"8722a892b64b44d4fd3f426570c02f08368628ca\"}');
INSERT INTO `user_ops` VALUES ('2018-03-01 13:33:34', '2018-03-01 13:33:34', '233', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"690f3cad4f5dacdb089210b45b82bca981061fbc\"}');
INSERT INTO `user_ops` VALUES ('2018-03-01 13:34:09', '2018-03-01 13:34:09', '234', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"690f3cad4f5dacdb089210b45b82bca981061fbc\"}');
INSERT INTO `user_ops` VALUES ('2018-03-01 13:58:11', '2018-03-01 13:58:11', '235', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"690f3cad4f5dacdb089210b45b82bca981061fbc\"}');
INSERT INTO `user_ops` VALUES ('2018-03-01 15:01:39', '2018-03-01 15:01:39', '236', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"690f3cad4f5dacdb089210b45b82bca981061fbc\"}');
INSERT INTO `user_ops` VALUES ('2018-03-01 15:01:41', '2018-03-01 15:01:41', '237', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"690f3cad4f5dacdb089210b45b82bca981061fbc\"}');
INSERT INTO `user_ops` VALUES ('2018-03-01 20:25:51', '2018-03-01 20:25:51', '238', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"ddd124e68e91ba0878bd0db48733940695f9693b\"}');
INSERT INTO `user_ops` VALUES ('2018-03-01 23:16:11', '2018-03-01 23:16:11', '239', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"3e7a08b7548ab5ea43002f64ee6386b5821ae077\"}');
INSERT INTO `user_ops` VALUES ('2018-03-01 23:35:59', '2018-03-01 23:35:59', '240', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"ddd124e68e91ba0878bd0db48733940695f9693b\"}');
INSERT INTO `user_ops` VALUES ('2018-03-01 23:36:02', '2018-03-01 23:36:02', '241', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"ddd124e68e91ba0878bd0db48733940695f9693b\"}');
INSERT INTO `user_ops` VALUES ('2018-03-01 23:37:49', '2018-03-01 23:37:49', '242', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"6c29573b250e211b75c7cb56af8bd91b43f422a9\"}');
INSERT INTO `user_ops` VALUES ('2018-03-01 23:37:52', '2018-03-01 23:37:52', '243', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"6c29573b250e211b75c7cb56af8bd91b43f422a9\"}');
INSERT INTO `user_ops` VALUES ('2018-03-01 23:37:55', '2018-03-01 23:37:55', '244', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"6c29573b250e211b75c7cb56af8bd91b43f422a9\"}');
INSERT INTO `user_ops` VALUES ('2018-03-01 23:38:02', '2018-03-01 23:38:02', '245', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"ddd124e68e91ba0878bd0db48733940695f9693b\"}');
INSERT INTO `user_ops` VALUES ('2018-03-01 23:38:05', '2018-03-01 23:38:05', '246', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"ddd124e68e91ba0878bd0db48733940695f9693b\"}');
INSERT INTO `user_ops` VALUES ('2018-03-02 08:17:05', '2018-03-02 08:17:05', '247', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"6510541f4a87b06060d1470c4167a676173cf100\"}');
INSERT INTO `user_ops` VALUES ('2018-03-02 08:17:17', '2018-03-02 08:17:17', '248', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"e796bc652ec2fec17530274d3af2bdcb5d87b35e\"}');
INSERT INTO `user_ops` VALUES ('2018-03-02 09:20:31', '2018-03-02 09:20:31', '249', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"e796bc652ec2fec17530274d3af2bdcb5d87b35e\"}');
INSERT INTO `user_ops` VALUES ('2018-03-04 12:15:53', '2018-03-04 12:15:53', '250', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"22a55c2510ee9d020b8aa9dc7be8dc8e797b7742\"}');
INSERT INTO `user_ops` VALUES ('2018-03-04 20:20:04', '2018-03-04 20:20:04', '251', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"bfc658d350d8ab70e1cc8d8391ff99d21ee6dd45\"}');
INSERT INTO `user_ops` VALUES ('2018-03-05 09:18:12', '2018-03-05 09:18:12', '252', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"14d90fef4dbda006a4bdbb9cb0f44e246b6ebd32\"}');
INSERT INTO `user_ops` VALUES ('2018-03-05 14:13:16', '2018-03-05 14:13:16', '253', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9710927c794a232520f6ac3a8cb273c3254320f6\"}');
INSERT INTO `user_ops` VALUES ('2018-03-05 14:14:12', '2018-03-05 14:14:12', '254', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"9710927c794a232520f6ac3a8cb273c3254320f6\"}');
INSERT INTO `user_ops` VALUES ('2018-03-05 14:14:16', '2018-03-05 14:14:16', '255', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"14d90fef4dbda006a4bdbb9cb0f44e246b6ebd32\"}');
INSERT INTO `user_ops` VALUES ('2018-03-05 14:14:17', '2018-03-05 14:14:17', '256', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"14d90fef4dbda006a4bdbb9cb0f44e246b6ebd32\"}');
INSERT INTO `user_ops` VALUES ('2018-03-05 14:41:37', '2018-03-05 14:41:37', '257', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"4ae6721c9da171737c70fd22e8fa5015761fb025\"}');
INSERT INTO `user_ops` VALUES ('2018-03-05 16:24:52', '2018-03-05 16:24:52', '258', 'admin', '2130706433', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"14d90fef4dbda006a4bdbb9cb0f44e246b6ebd32\"}');
INSERT INTO `user_ops` VALUES ('2018-03-05 16:24:55', '2018-03-05 16:24:55', '259', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"14d90fef4dbda006a4bdbb9cb0f44e246b6ebd32\"}');
INSERT INTO `user_ops` VALUES ('2018-03-05 21:03:08', '2018-03-05 21:03:08', '260', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"c759e9d194cabe4728689d91171b0906e3d9c608\"}');
INSERT INTO `user_ops` VALUES ('2018-03-05 22:26:28', '2018-03-05 22:26:28', '261', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"32d45a56cd99866ad2c1861377b9e9bc4800da61\"}');
INSERT INTO `user_ops` VALUES ('2018-03-06 08:12:47', '2018-03-06 08:12:47', '262', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"d34ccc3544657b67fd2e0bc099e5bd6de9586731\"}');
INSERT INTO `user_ops` VALUES ('2018-03-06 08:38:31', '2018-03-06 08:38:31', '263', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"bac14b002044a866e0fd69291e8685507de9bd73\"}');
INSERT INTO `user_ops` VALUES ('2018-03-06 15:07:05', '2018-03-06 15:07:05', '264', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"d34ccc3544657b67fd2e0bc099e5bd6de9586731\"}');
INSERT INTO `user_ops` VALUES ('2018-03-06 17:06:26', '2018-03-06 17:06:26', '265', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"f25dd16d9f7a8d1a2c2079dda9ddbbfbb9f7f8a8\"}');
INSERT INTO `user_ops` VALUES ('2018-03-06 17:07:24', '2018-03-06 17:07:24', '266', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"d34ccc3544657b67fd2e0bc099e5bd6de9586731\"}');
INSERT INTO `user_ops` VALUES ('2018-03-06 23:11:42', '2018-03-06 23:11:42', '267', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"0fa2fb8521b086e3e65c06f2e4bb073464e6f0b9\"}');
INSERT INTO `user_ops` VALUES ('2018-03-06 23:16:00', '2018-03-06 23:16:00', '268', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"3e3386355508f4d82bf1e49f41f7a368dc5b7455\"}');
INSERT INTO `user_ops` VALUES ('2018-03-07 08:38:45', '2018-03-07 08:38:45', '269', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"a089436cd7d5a5f11e43c12f6649e94c90a168dd\"}');
INSERT INTO `user_ops` VALUES ('2018-03-07 08:38:57', '2018-03-07 08:38:57', '270', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"1c498c90ff5eafbe937be16132ecf6b9a341187e\"}');
INSERT INTO `user_ops` VALUES ('2018-03-07 11:59:55', '2018-03-07 11:59:55', '271', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"f7eccd0a4ac2ecdff9715e6ca0e78680f1e16df7\"}');
INSERT INTO `user_ops` VALUES ('2018-03-07 12:50:48', '2018-03-07 12:50:48', '272', 'admin', '2130706433', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"f7eccd0a4ac2ecdff9715e6ca0e78680f1e16df7\"}');
INSERT INTO `user_ops` VALUES ('2018-03-08 09:26:52', '2018-03-08 09:26:52', '273', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"1db1f19327783347aa04a9eaf5e13eb9467dd9a4\"}');
INSERT INTO `user_ops` VALUES ('2018-03-16 21:16:08', '2018-03-16 21:16:08', '274', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"b003430f94561446873bb42fb311678791b663e9\"}');
INSERT INTO `user_ops` VALUES ('2018-03-16 21:22:50', '2018-03-16 21:22:50', '275', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"b003430f94561446873bb42fb311678791b663e9\"}');
INSERT INTO `user_ops` VALUES ('2018-03-16 21:33:33', '2018-03-16 21:33:33', '276', 'admin', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"b003430f94561446873bb42fb311678791b663e9\"}');
INSERT INTO `user_ops` VALUES ('2018-03-16 21:45:33', '2018-03-16 21:45:33', '277', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"b003430f94561446873bb42fb311678791b663e9\"}');
INSERT INTO `user_ops` VALUES ('2018-03-16 21:46:37', '2018-03-16 21:46:37', '278', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"b003430f94561446873bb42fb311678791b663e9\"}');
INSERT INTO `user_ops` VALUES ('2018-03-16 21:47:03', '2018-03-16 21:47:03', '279', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"b003430f94561446873bb42fb311678791b663e9\"}');
INSERT INTO `user_ops` VALUES ('2018-03-16 21:52:23', '2018-03-16 21:52:23', '280', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"b003430f94561446873bb42fb311678791b663e9\"}');
INSERT INTO `user_ops` VALUES ('2018-03-16 21:53:41', '2018-03-16 21:53:41', '281', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"b003430f94561446873bb42fb311678791b663e9\"}');
INSERT INTO `user_ops` VALUES ('2018-03-16 21:55:13', '2018-03-16 21:55:13', '282', 'admin', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"b003430f94561446873bb42fb311678791b663e9\"}');
INSERT INTO `user_ops` VALUES ('2018-03-16 21:55:15', '2018-03-16 21:55:15', '283', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"b003430f94561446873bb42fb311678791b663e9\"}');
INSERT INTO `user_ops` VALUES ('2018-03-16 22:02:52', '2018-03-16 22:02:52', '284', 'admin', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"b003430f94561446873bb42fb311678791b663e9\"}');
INSERT INTO `user_ops` VALUES ('2018-03-16 22:02:54', '2018-03-16 22:02:54', '285', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"b003430f94561446873bb42fb311678791b663e9\"}');
INSERT INTO `user_ops` VALUES ('2018-03-17 08:26:20', '2018-03-17 08:26:20', '286', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"cbe87ec92b79dee6b5d202102c7c3e7de0456bca\"}');
INSERT INTO `user_ops` VALUES ('2018-03-17 12:23:48', '2018-03-17 12:23:48', '287', 'admin', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"cbe87ec92b79dee6b5d202102c7c3e7de0456bca\"}');
INSERT INTO `user_ops` VALUES ('2018-03-17 12:24:10', '2018-03-17 12:24:10', '288', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"cbe87ec92b79dee6b5d202102c7c3e7de0456bca\"}');
INSERT INTO `user_ops` VALUES ('2018-03-17 12:24:19', '2018-03-17 12:24:19', '289', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"cbe87ec92b79dee6b5d202102c7c3e7de0456bca\"}');
INSERT INTO `user_ops` VALUES ('2018-03-17 12:24:25', '2018-03-17 12:24:25', '290', 'admin', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"cbe87ec92b79dee6b5d202102c7c3e7de0456bca\"}');
INSERT INTO `user_ops` VALUES ('2018-03-17 12:25:31', '2018-03-17 12:25:31', '291', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"cbe87ec92b79dee6b5d202102c7c3e7de0456bca\"}');
INSERT INTO `user_ops` VALUES ('2018-03-17 12:59:17', '2018-03-17 12:59:17', '292', 'admin1', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"cbe87ec92b79dee6b5d202102c7c3e7de0456bca\"}');
INSERT INTO `user_ops` VALUES ('2018-03-17 12:59:19', '2018-03-17 12:59:19', '293', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"cbe87ec92b79dee6b5d202102c7c3e7de0456bca\"}');
INSERT INTO `user_ops` VALUES ('2018-03-17 13:00:23', '2018-03-17 13:00:23', '294', 'admin1', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"cbe87ec92b79dee6b5d202102c7c3e7de0456bca\"}');
INSERT INTO `user_ops` VALUES ('2018-03-17 13:00:25', '2018-03-17 13:00:25', '295', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"cbe87ec92b79dee6b5d202102c7c3e7de0456bca\"}');
INSERT INTO `user_ops` VALUES ('2018-03-17 13:40:11', '2018-03-17 13:40:11', '296', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"cbe87ec92b79dee6b5d202102c7c3e7de0456bca\"}');
INSERT INTO `user_ops` VALUES ('2018-03-17 13:52:14', '2018-03-17 13:52:14', '297', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"cbe87ec92b79dee6b5d202102c7c3e7de0456bca\"}');
INSERT INTO `user_ops` VALUES ('2018-03-17 14:27:49', '2018-03-17 14:27:49', '298', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"91eb73f14023fa7c3e69e751b71dec034f4d9926\"}');
INSERT INTO `user_ops` VALUES ('2018-03-17 14:32:58', '2018-03-17 14:32:58', '299', 'admin1', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"91eb73f14023fa7c3e69e751b71dec034f4d9926\"}');
INSERT INTO `user_ops` VALUES ('2018-03-17 14:33:00', '2018-03-17 14:33:00', '300', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"91eb73f14023fa7c3e69e751b71dec034f4d9926\"}');
INSERT INTO `user_ops` VALUES ('2018-03-17 14:40:08', '2018-03-17 14:40:08', '301', 'admin1', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"91eb73f14023fa7c3e69e751b71dec034f4d9926\"}');
INSERT INTO `user_ops` VALUES ('2018-03-17 14:40:09', '2018-03-17 14:40:09', '302', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"91eb73f14023fa7c3e69e751b71dec034f4d9926\"}');
INSERT INTO `user_ops` VALUES ('2018-03-17 14:43:15', '2018-03-17 14:43:15', '303', 'admin1', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"91eb73f14023fa7c3e69e751b71dec034f4d9926\"}');
INSERT INTO `user_ops` VALUES ('2018-03-17 14:43:17', '2018-03-17 14:43:17', '304', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"91eb73f14023fa7c3e69e751b71dec034f4d9926\"}');
INSERT INTO `user_ops` VALUES ('2018-03-17 14:45:24', '2018-03-17 14:45:24', '305', 'admin1', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"91eb73f14023fa7c3e69e751b71dec034f4d9926\"}');
INSERT INTO `user_ops` VALUES ('2018-03-17 14:45:26', '2018-03-17 14:45:26', '306', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"91eb73f14023fa7c3e69e751b71dec034f4d9926\"}');
INSERT INTO `user_ops` VALUES ('2018-03-17 14:47:19', '2018-03-17 14:47:19', '307', 'admin1', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"91eb73f14023fa7c3e69e751b71dec034f4d9926\"}');
INSERT INTO `user_ops` VALUES ('2018-03-17 14:47:22', '2018-03-17 14:47:22', '308', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"91eb73f14023fa7c3e69e751b71dec034f4d9926\"}');
INSERT INTO `user_ops` VALUES ('2018-03-17 15:48:39', '2018-03-17 15:48:39', '309', 'admin', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"91eb73f14023fa7c3e69e751b71dec034f4d9926\"}');
INSERT INTO `user_ops` VALUES ('2018-03-17 15:48:42', '2018-03-17 15:48:42', '310', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"91eb73f14023fa7c3e69e751b71dec034f4d9926\"}');
INSERT INTO `user_ops` VALUES ('2018-03-17 20:13:29', '2018-03-17 20:13:29', '311', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"68e951ce9bd5b253ac5541fe9904fddd37c3ad9a\"}');
INSERT INTO `user_ops` VALUES ('2018-03-17 23:53:08', '2018-03-17 23:53:08', '312', 'admin', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"68e951ce9bd5b253ac5541fe9904fddd37c3ad9a\"}');
INSERT INTO `user_ops` VALUES ('2018-03-17 23:53:10', '2018-03-17 23:53:10', '313', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"68e951ce9bd5b253ac5541fe9904fddd37c3ad9a\"}');
INSERT INTO `user_ops` VALUES ('2018-03-17 23:53:20', '2018-03-17 23:53:20', '314', 'admin1', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"68e951ce9bd5b253ac5541fe9904fddd37c3ad9a\"}');
INSERT INTO `user_ops` VALUES ('2018-03-17 23:53:24', '2018-03-17 23:53:24', '315', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"68e951ce9bd5b253ac5541fe9904fddd37c3ad9a\"}');
INSERT INTO `user_ops` VALUES ('2018-03-17 23:53:24', '2018-03-17 23:53:24', '316', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"68e951ce9bd5b253ac5541fe9904fddd37c3ad9a\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 00:02:19', '2018-03-18 00:02:19', '317', 'admin', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"68e951ce9bd5b253ac5541fe9904fddd37c3ad9a\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 00:09:24', '2018-03-18 00:09:24', '318', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"68e951ce9bd5b253ac5541fe9904fddd37c3ad9a\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 00:10:18', '2018-03-18 00:10:18', '319', 'admin1', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"68e951ce9bd5b253ac5541fe9904fddd37c3ad9a\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 00:10:21', '2018-03-18 00:10:21', '320', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"68e951ce9bd5b253ac5541fe9904fddd37c3ad9a\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 00:12:53', '2018-03-18 00:12:53', '321', 'admin1', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"68e951ce9bd5b253ac5541fe9904fddd37c3ad9a\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 00:12:55', '2018-03-18 00:12:55', '322', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"68e951ce9bd5b253ac5541fe9904fddd37c3ad9a\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 00:13:34', '2018-03-18 00:13:34', '323', 'admin1', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"68e951ce9bd5b253ac5541fe9904fddd37c3ad9a\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 00:13:36', '2018-03-18 00:13:36', '324', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"68e951ce9bd5b253ac5541fe9904fddd37c3ad9a\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 00:19:08', '2018-03-18 00:19:08', '325', 'admin1', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"68e951ce9bd5b253ac5541fe9904fddd37c3ad9a\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 00:19:09', '2018-03-18 00:19:09', '326', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"68e951ce9bd5b253ac5541fe9904fddd37c3ad9a\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 00:20:40', '2018-03-18 00:20:40', '327', 'admin1', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"68e951ce9bd5b253ac5541fe9904fddd37c3ad9a\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 00:20:42', '2018-03-18 00:20:42', '328', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"68e951ce9bd5b253ac5541fe9904fddd37c3ad9a\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 00:22:46', '2018-03-18 00:22:46', '329', 'admin1', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"68e951ce9bd5b253ac5541fe9904fddd37c3ad9a\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 00:22:48', '2018-03-18 00:22:48', '330', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"68e951ce9bd5b253ac5541fe9904fddd37c3ad9a\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 00:27:13', '2018-03-18 00:27:13', '331', 'admin1', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"68e951ce9bd5b253ac5541fe9904fddd37c3ad9a\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 00:27:17', '2018-03-18 00:27:17', '332', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"68e951ce9bd5b253ac5541fe9904fddd37c3ad9a\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 00:40:54', '2018-03-18 00:40:54', '333', 'admin1', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"68e951ce9bd5b253ac5541fe9904fddd37c3ad9a\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 00:40:56', '2018-03-18 00:40:56', '334', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"68e951ce9bd5b253ac5541fe9904fddd37c3ad9a\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 00:55:04', '2018-03-18 00:55:04', '335', 'admin1', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"68e951ce9bd5b253ac5541fe9904fddd37c3ad9a\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 00:56:58', '2018-03-18 00:56:58', '336', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"68e951ce9bd5b253ac5541fe9904fddd37c3ad9a\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 01:00:11', '2018-03-18 01:00:11', '337', 'admin1', '0', '2', '{\"redirect_url\":null,\"session_id\":\"68e951ce9bd5b253ac5541fe9904fddd37c3ad9a\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 01:00:44', '2018-03-18 01:00:44', '338', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"68e951ce9bd5b253ac5541fe9904fddd37c3ad9a\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 01:00:49', '2018-03-18 01:00:49', '339', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"68e951ce9bd5b253ac5541fe9904fddd37c3ad9a\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 01:00:53', '2018-03-18 01:00:53', '340', 'admin1', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"68e951ce9bd5b253ac5541fe9904fddd37c3ad9a\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 01:01:02', '2018-03-18 01:01:02', '341', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"68e951ce9bd5b253ac5541fe9904fddd37c3ad9a\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 08:49:08', '2018-03-18 08:49:08', '342', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 08:52:20', '2018-03-18 08:52:20', '343', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:00:18', '2018-03-18 09:00:18', '344', 'admin1', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:00:21', '2018-03-18 09:00:21', '345', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:00:25', '2018-03-18 09:00:25', '346', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:03:00', '2018-03-18 09:03:00', '347', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:04:08', '2018-03-18 09:04:08', '348', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:04:29', '2018-03-18 09:04:29', '349', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:05:20', '2018-03-18 09:05:20', '350', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:07:39', '2018-03-18 09:07:39', '351', 'admin', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:07:40', '2018-03-18 09:07:40', '352', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:08:00', '2018-03-18 09:08:00', '353', 'admin', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:08:17', '2018-03-18 09:08:17', '354', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:08:33', '2018-03-18 09:08:33', '355', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:08:39', '2018-03-18 09:08:39', '356', 'admin', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:08:53', '2018-03-18 09:08:53', '357', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:11:08', '2018-03-18 09:11:08', '358', 'admin1', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:11:10', '2018-03-18 09:11:10', '359', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:19:11', '2018-03-18 09:19:11', '360', 'admin1', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:19:13', '2018-03-18 09:19:13', '361', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:30:33', '2018-03-18 09:30:33', '362', 'admin1', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:30:35', '2018-03-18 09:30:35', '363', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:33:36', '2018-03-18 09:33:36', '364', 'admin1', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:33:40', '2018-03-18 09:33:40', '365', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:34:15', '2018-03-18 09:34:15', '366', 'admin', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:34:18', '2018-03-18 09:34:18', '367', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:36:29', '2018-03-18 09:36:29', '368', 'admin1', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:36:31', '2018-03-18 09:36:31', '369', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:37:24', '2018-03-18 09:37:24', '370', 'admin1', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:37:25', '2018-03-18 09:37:25', '371', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:38:48', '2018-03-18 09:38:48', '372', 'admin1', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:38:50', '2018-03-18 09:38:50', '373', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:50:07', '2018-03-18 09:50:07', '374', 'admin1', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:50:23', '2018-03-18 09:50:23', '375', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:51:19', '2018-03-18 09:51:19', '376', 'admin1', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:51:21', '2018-03-18 09:51:21', '377', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:54:18', '2018-03-18 09:54:18', '378', 'admin1', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:54:21', '2018-03-18 09:54:21', '379', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:54:25', '2018-03-18 09:54:25', '380', 'admin', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 09:54:28', '2018-03-18 09:54:28', '381', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 10:14:26', '2018-03-18 10:14:26', '382', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 10:17:29', '2018-03-18 10:17:29', '383', 'admin', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 10:17:41', '2018-03-18 10:17:41', '384', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 10:18:13', '2018-03-18 10:18:13', '385', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 11:00:25', '2018-03-18 11:00:25', '386', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 11:00:30', '2018-03-18 11:00:30', '387', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 11:00:48', '2018-03-18 11:00:48', '388', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 11:00:49', '2018-03-18 11:00:49', '389', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 11:01:11', '2018-03-18 11:01:11', '390', 'admin1', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 11:01:13', '2018-03-18 11:01:13', '391', 'admin1', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 12:25:22', '2018-03-18 12:25:22', '392', 'admin1', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 12:25:25', '2018-03-18 12:25:25', '393', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 12:31:33', '2018-03-18 12:31:33', '394', 'admin', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 12:31:43', '2018-03-18 12:31:43', '395', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 12:31:44', '2018-03-18 12:31:44', '396', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 12:32:40', '2018-03-18 12:32:40', '397', 'admin', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 12:32:43', '2018-03-18 12:32:43', '398', 'admina', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 12:37:21', '2018-03-18 12:37:21', '399', 'admina', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 12:37:27', '2018-03-18 12:37:27', '400', 'ad', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 12:46:15', '2018-03-18 12:46:15', '401', 'ad', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 12:46:19', '2018-03-18 12:46:19', '402', 'ad', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 12:48:05', '2018-03-18 12:48:05', '403', 'ad', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 12:48:07', '2018-03-18 12:48:07', '404', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 12:48:56', '2018-03-18 12:48:56', '405', 'admin', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 12:49:00', '2018-03-18 12:49:00', '406', 'ad', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 12:53:31', '2018-03-18 12:53:31', '407', 'ad', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 12:53:34', '2018-03-18 12:53:34', '408', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 12:54:05', '2018-03-18 12:54:05', '409', 'admin', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 12:54:09', '2018-03-18 12:54:09', '410', 'ad', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 12:54:09', '2018-03-18 12:54:09', '411', 'ad', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 12:55:53', '2018-03-18 12:55:53', '412', 'ad', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 12:55:56', '2018-03-18 12:55:56', '413', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 12:57:28', '2018-03-18 12:57:28', '414', 'admin', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 12:57:31', '2018-03-18 12:57:31', '415', 'ad', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 12:57:31', '2018-03-18 12:57:31', '416', 'ad', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 13:01:49', '2018-03-18 13:01:49', '417', 'ad', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 13:01:51', '2018-03-18 13:01:51', '418', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 13:01:51', '2018-03-18 13:01:51', '419', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 13:02:32', '2018-03-18 13:02:32', '420', 'admin', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 13:02:34', '2018-03-18 13:02:34', '421', 'ad', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 13:02:35', '2018-03-18 13:02:35', '422', 'ad', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 13:13:24', '2018-03-18 13:13:24', '423', 'ad', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 13:13:25', '2018-03-18 13:13:25', '424', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 13:13:36', '2018-03-18 13:13:36', '425', 'admin', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 13:13:39', '2018-03-18 13:13:39', '426', 'ad', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 13:13:39', '2018-03-18 13:13:39', '427', 'ad', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 13:15:06', '2018-03-18 13:15:06', '428', 'ad', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 13:15:08', '2018-03-18 13:15:08', '429', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 13:28:28', '2018-03-18 13:28:28', '430', 'admin', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 13:28:30', '2018-03-18 13:28:30', '431', 'ad', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 13:28:30', '2018-03-18 13:28:30', '432', 'ad', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 13:29:02', '2018-03-18 13:29:02', '433', 'ad', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 13:29:03', '2018-03-18 13:29:03', '434', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 15:07:29', '2018-03-18 15:07:29', '435', 'admin', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 15:07:32', '2018-03-18 15:07:32', '436', 'ad', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 15:07:32', '2018-03-18 15:07:32', '437', 'ad', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 15:07:43', '2018-03-18 15:07:43', '438', 'ad', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 15:07:45', '2018-03-18 15:07:45', '439', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 15:10:32', '2018-03-18 15:10:32', '440', 'admin', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 15:10:36', '2018-03-18 15:10:36', '441', 'adminb', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 15:11:46', '2018-03-18 15:11:46', '442', 'adminb', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 15:11:50', '2018-03-18 15:11:50', '443', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 15:12:02', '2018-03-18 15:12:02', '444', 'admin', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 15:12:07', '2018-03-18 15:12:07', '445', 'adminb', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 15:12:21', '2018-03-18 15:12:21', '446', 'adminb', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 15:12:24', '2018-03-18 15:12:24', '447', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 15:23:26', '2018-03-18 15:23:26', '448', 'admin', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 15:23:39', '2018-03-18 15:23:39', '449', 'adminb', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 15:23:39', '2018-03-18 15:23:39', '450', 'adminb', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 15:23:48', '2018-03-18 15:23:48', '451', 'adminb', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 15:23:50', '2018-03-18 15:23:50', '452', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 15:24:29', '2018-03-18 15:24:29', '453', 'admin', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 15:24:31', '2018-03-18 15:24:31', '454', 'adminb', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 15:24:31', '2018-03-18 15:24:31', '455', 'adminb', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 15:27:02', '2018-03-18 15:27:02', '456', 'adminb', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 15:27:03', '2018-03-18 15:27:03', '457', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 15:33:25', '2018-03-18 15:33:25', '458', 'admin', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 15:33:27', '2018-03-18 15:33:27', '459', 'adminb', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 15:33:41', '2018-03-18 15:33:41', '460', 'adminb', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 15:33:43', '2018-03-18 15:33:43', '461', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 15:37:02', '2018-03-18 15:37:02', '462', 'admin', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 15:37:04', '2018-03-18 15:37:04', '463', 'adminb', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 15:37:05', '2018-03-18 15:37:05', '464', 'adminb', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 16:05:12', '2018-03-18 16:05:12', '465', 'adminb', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 16:05:14', '2018-03-18 16:05:14', '466', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 16:08:05', '2018-03-18 16:08:05', '467', 'admin', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 16:08:09', '2018-03-18 16:08:09', '468', 'qq', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 16:08:50', '2018-03-18 16:08:50', '469', 'qq', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 16:09:00', '2018-03-18 16:09:00', '470', 'qq', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 16:09:16', '2018-03-18 16:09:16', '471', 'qq', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 16:09:26', '2018-03-18 16:09:26', '472', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 16:09:27', '2018-03-18 16:09:27', '473', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 16:22:19', '2018-03-18 16:22:19', '474', 'admin', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 16:22:28', '2018-03-18 16:22:28', '475', 'qq', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 16:24:39', '2018-03-18 16:24:39', '476', 'qq', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 16:24:41', '2018-03-18 16:24:41', '477', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 16:25:05', '2018-03-18 16:25:05', '478', 'admin', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 16:25:16', '2018-03-18 16:25:16', '479', 'qq', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 16:26:50', '2018-03-18 16:26:50', '480', 'qq', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 16:26:51', '2018-03-18 16:26:51', '481', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 16:29:11', '2018-03-18 16:29:11', '482', 'admin', '0', '2', '{\"redirect_url\":\"\\/dd\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');
INSERT INTO `user_ops` VALUES ('2018-03-18 16:29:17', '2018-03-18 16:29:17', '483', 'admin', '0', '1', '{\"redirect_url\":\"\\/mf\",\"session_id\":\"734b18b829443629bbce5abb2efc0e560fc6c843\"}');

-- ----------------------------
-- Table structure for wan
-- ----------------------------
DROP TABLE IF EXISTS `wan`;
CREATE TABLE `wan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wan_bp_list` varchar(200) DEFAULT NULL COMMENT '被忽略的ip列表',
  `extra_ignore_ip` varchar(255) DEFAULT NULL COMMENT '额外被忽略的ip',
  `force_ip` varchar(255) DEFAULT NULL COMMENT '强制走代理',
  `global_id` int(11) NOT NULL COMMENT '绑定的全局设置ID',
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wan
-- ----------------------------
