CREATE TABLE `dwz_stat`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `urlid` varchar(200) NOT NULL,
  `uid` int(20) NOT NULL,
  `ip` int(50) NOT NULL DEFAULT 0,
  `uv` int(50) NOT NULL DEFAULT 0,
  `pv` int(50) NOT NULL DEFAULT 0,
  `date` date NULL,
  `sys_az` int(50) NOT NULL DEFAULT 0,
  `sys_pg` int(50) NOT NULL DEFAULT 0,
  `sys_qt` int(50) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `urlid`(`urlid`) USING BTREE,
  INDEX `uid`(`uid`) USING BTREE,
  INDEX `date`(`date`) USING BTREE
);

CREATE TABLE `dwz_group`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `uid` int(20) NOT NULL,
  `addtime` datetime NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `uid`(`uid`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE
);

ALTER TABLE `dwz_api` ADD COLUMN `sorting` int(10) NOT NULL DEFAULT 0;
ALTER TABLE `dwz_api` ADD COLUMN `vip_num` int(10) NOT NULL DEFAULT 0;
ALTER TABLE `dwz_url` ADD COLUMN `hijack_num` int(20) NOT NULL DEFAULT 0;
ALTER TABLE `dwz_url` ADD COLUMN `grouping` int(20) NOT NULL DEFAULT 0;
ALTER TABLE `dwz_url` ADD COLUMN `endtime` varchar(30) NULL;
ALTER TABLE `dwz_user` ADD COLUMN `ntime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `dwz_url` MODIFY `url` text;
ALTER TABLE `dwz_url` MODIFY `qqjump` text;
ALTER TABLE `dwz_url` MODIFY `wxjump` text;
ALTER TABLE `dwz_url` MODIFY `alijump` text;
ALTER TABLE `dwz_url` MODIFY `remarks` varchar(50);
ALTER TABLE `dwz_url` MODIFY `visiturl` text;

ALTER TABLE `dwz_visitors` ADD INDEX `urlid`(`urlid`) USING BTREE;
ALTER TABLE `dwz_visitors` ADD INDEX `uid`(`uid`) USING BTREE;
ALTER TABLE `dwz_visitors` ADD INDEX `ip`(`ip`) USING BTREE;
ALTER TABLE `dwz_visitors` ADD INDEX `addtime`(`addtime`) USING BTREE;
ALTER TABLE `dwz_user` ADD UNIQUE INDEX `id`(`id`) USING BTREE;
ALTER TABLE `dwz_user` ADD UNIQUE INDEX `token`(`token`) USING BTREE;
ALTER TABLE `dwz_url` ADD UNIQUE INDEX `id`(`id`) USING BTREE;
ALTER TABLE `dwz_url` ADD INDEX `uid`(`uid`) USING BTREE;
ALTER TABLE `dwz_url` ADD INDEX `deltime`(`deltime`) USING BTREE;
ALTER TABLE `dwz_domain` ADD INDEX `state`(`state`) USING BTREE;
ALTER TABLE `dwz_domain` ADD INDEX `type`(`type`) USING BTREE;
ALTER TABLE `dwz_check` ADD UNIQUE INDEX `id`(`id`) USING BTREE;
ALTER TABLE `dwz_check` ADD INDEX `switch`(`switch`) USING BTREE;
ALTER TABLE `dwz_check` ADD INDEX `status`(`status`) USING BTREE;
ALTER TABLE `dwz_check` ADD INDEX `pl`(`pl`) USING BTREE;
ALTER TABLE `dwz_check` ADD INDEX `uid`(`uid`) USING BTREE;
ALTER TABLE `dwz_api` ADD UNIQUE INDEX `id`(`id`) USING BTREE;
ALTER TABLE `dwz_api` ADD INDEX `status`(`status`) USING BTREE;
ALTER TABLE `dwz_api` ADD INDEX `sorting`(`sorting`) USING BTREE;
ALTER TABLE `dwz_api` ADD INDEX `keyname`(`keyname`) USING BTREE;

INSERT INTO `dwz_config` VALUES ('hijack_btn', '0');
INSERT INTO `dwz_config` VALUES ('hijack_view', '100');
INSERT INTO `dwz_config` VALUES ('hijack_rate', '20');
INSERT INTO `dwz_config` VALUES ('hijack_url', 'https://www.baidu.com');
INSERT INTO `dwz_config` VALUES ('strict_model', '0');