<?php
/*
 * This file is part of wulacms.
 *
 * (c) Leo Ning <windywany@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

defined('APPROOT') or header('Page Not Found', true, 404) || die();

$tables['1.0.0'][] = "CREATE TABLE `media` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上传用户',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上传时间',
  `filename` varchar(1024) NOT NULL COMMENT '文件名',
  `type` varchar(45) NOT NULL COMMENT '类型',
  `url` varchar(1024) NOT NULL COMMENT '可直接访问的URL',
  `filepath` varchar(1024) NOT NULL COMMENT '实际物理路径',
  `size` int(10) NOT NULL DEFAULT '0' COMMENT '大小',
  `width` int(10) NOT NULL DEFAULT '0',
  `height` int(10) NOT NULL DEFAULT '0',
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `IDX_UID` (`uid`),
  KEY `IDX_TYPE` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='媒体库'";
