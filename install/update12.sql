ALTER TABLE `dwz_visitors` ADD COLUMN `isp` varchar(20) NULL;
ALTER TABLE `dwz_visitors` ADD COLUMN `network` varchar(20) NULL;

DROP TABLE IF EXISTS `dwz_mail_log`;
CREATE TABLE `dwz_mail_log`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `addtime` datetime NULL,
  `code` varchar(10) NULL,
  `status` int(1) NULL DEFAULT 0,
  `ip` varchar(50) NULL,
  `used` datetime NULL,
  `mail` varchar(255) NULL,
  `type` int(2) NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  INDEX `addtime`(`addtime`) USING BTREE,
  INDEX `code`(`code`) USING BTREE,
  INDEX `mail`(`mail`) USING BTREE
);