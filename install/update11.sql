INSERT INTO `dwz_config` VALUES ('km_buy', '');
INSERT INTO `dwz_config` VALUES ('vip_data', 1);
INSERT INTO `dwz_config` VALUES ('diy_suffix', 1);
INSERT INTO `dwz_config` VALUES ('CaptchaAppId', '');
INSERT INTO `dwz_config` VALUES ('AppSecretKey', '');
INSERT INTO `dwz_config` VALUES ('tx_SecretId', '');
INSERT INTO `dwz_config` VALUES ('tx_SecretKey', '');
INSERT INTO `dwz_config` VALUES ('captcha_reg', 0);
INSERT INTO `dwz_config` VALUES ('captcha_login', 0);
INSERT INTO `dwz_config` VALUES ('reg_limit', 0);
INSERT INTO `dwz_config` VALUES ('user_frozen', 0);

ALTER TABLE `dwz_api` ADD COLUMN `disable_pattern` varchar(50) NULL;
ALTER TABLE `dwz_visitors` ADD COLUMN `province` varchar(20) NULL;
ALTER TABLE `dwz_visitors` ADD COLUMN `city` varchar(20) NULL;

ALTER TABLE `dwz_visitors` DROP `froms`;

DROP TABLE IF EXISTS `dwz_ip`;
CREATE TABLE `dwz_ip`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `ip` varchar(30) NOT NULL,
  `adddate` date NOT NULL,
  `urlid` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `ip`(`ip`) USING BTREE,
  INDEX `urlid`(`urlid`) USING BTREE,
  INDEX `adddate`(`adddate`) USING BTREE
);