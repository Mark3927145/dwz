DROP TABLE IF EXISTS `pre_config`;
create table `pre_config` (
`k` varchar(32) NOT NULL,
`v` text NULL,
PRIMARY KEY  (`k`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `pre_config` VALUES ('admin_user', 'admin');
INSERT INTO `pre_config` VALUES ('admin_pwd', '123456');
INSERT INTO `pre_config` VALUES ('web_name', '搏天短网址');
INSERT INTO `pre_config` VALUES ('uid', '10001');
INSERT INTO `pre_config` VALUES ('keywords', '搏天短网址，短网址生成');
INSERT INTO `pre_config` VALUES ('description', '搏天短网址-短网址生成');
INSERT INTO `pre_config` VALUES ('kf_qq', '10001');
INSERT INTO `pre_config` VALUES ('template', 'blum');
INSERT INTO `pre_config` VALUES ('index_bg', '2');
INSERT INTO `pre_config` VALUES ('is_https', '0');
INSERT INTO `pre_config` VALUES ('is_reg', '1');
INSERT INTO `pre_config` VALUES ('statistics', '0');
INSERT INTO `pre_config` VALUES ('group_link', '');
INSERT INTO `pre_config` VALUES ('d_jump', '0');
INSERT INTO `pre_config` VALUES ('forcelogin', '0');
INSERT INTO `pre_config` VALUES ('gg1', '公告1');
INSERT INTO `pre_config` VALUES ('gg2', '公告2');
INSERT INTO `pre_config` VALUES ('gg3', '公告3');
INSERT INTO `pre_config` VALUES ('icp', '');
INSERT INTO `pre_config` VALUES ('mail_name', '');
INSERT INTO `pre_config` VALUES ('mail_port', '465');
INSERT INTO `pre_config` VALUES ('mail_pwd', '');
INSERT INTO `pre_config` VALUES ('mail_smtp', 'smtp.qq.com');
INSERT INTO `pre_config` VALUES ('htaccess', '1');
INSERT INTO `pre_config` VALUES ('dwz_type', 'btfxw');
INSERT INTO `pre_config` VALUES ('pattern', '1');
INSERT INTO `pre_config` VALUES ('version', '4013');
INSERT INTO `pre_config` VALUES ('alipay_api', '0');
INSERT INTO `pre_config` VALUES ('qqpay_api', '0');
INSERT INTO `pre_config` VALUES ('wxpay_api', '0');
INSERT INTO `pre_config` VALUES ('epay_url', '');
INSERT INTO `pre_config` VALUES ('epay_pid', '');
INSERT INTO `pre_config` VALUES ('epay_key', '');
INSERT INTO `pre_config` VALUES ('codepay_id', '');
INSERT INTO `pre_config` VALUES ('codepay_key', '');
INSERT INTO `pre_config` VALUES ('vip_month', '5');
INSERT INTO `pre_config` VALUES ('vip_quarter', '13');
INSERT INTO `pre_config` VALUES ('vip_year', '50');
INSERT INTO `pre_config` VALUES ('alipay_appid', '');
INSERT INTO `pre_config` VALUES ('alipay_publickey', '');
INSERT INTO `pre_config` VALUES ('alipay_privatekey', '');
INSERT INTO `pre_config` VALUES ('qqpay_mchid', '');
INSERT INTO `pre_config` VALUES ('qqpay_key', '');
INSERT INTO `pre_config` VALUES ('wxpay_appid', '');
INSERT INTO `pre_config` VALUES ('wxpay_key', '');
INSERT INTO `pre_config` VALUES ('wxpay_mchid', '');
INSERT INTO `pre_config` VALUES ('wxpay_appsecret', '');
INSERT INTO `pre_config` VALUES ('wxpay_domain', '');
INSERT INTO `pre_config` VALUES ('link_length', '6');
INSERT INTO `pre_config` VALUES ('index_top', '');
INSERT INTO `pre_config` VALUES ('index_bottom', '');
INSERT INTO `pre_config` VALUES ('default_vip', '0');
INSERT INTO `pre_config` VALUES ('vip_api', '1');
INSERT INTO `pre_config` VALUES ('vip_tj', '1');
INSERT INTO `pre_config` VALUES ('jump1', '1');
INSERT INTO `pre_config` VALUES ('jump2', '1');
INSERT INTO `pre_config` VALUES ('jump3', '1');
INSERT INTO `pre_config` VALUES ('jump4', '1');
INSERT INTO `pre_config` VALUES ('limit_url', '');
INSERT INTO `pre_config` VALUES ('second_jump', '0');
INSERT INTO `pre_config` VALUES ('dwz_price', '1');
INSERT INTO `pre_config` VALUES ('discount', '0.9');
INSERT INTO `pre_config` VALUES ('dwz_token', '');
INSERT INTO `pre_config` VALUES ('vip_fh', '0');
INSERT INTO `pre_config` VALUES ('vip_zl', '0');
INSERT INTO `pre_config` VALUES ('qqdomaincheck', '0');
INSERT INTO `pre_config` VALUES ('wxdomaincheck', '0');
INSERT INTO `pre_config` VALUES ('outqqdomain', '0');
INSERT INTO `pre_config` VALUES ('outwxdomain', '0');
INSERT INTO `pre_config` VALUES ('mail_recv', '');
INSERT INTO `pre_config` VALUES ('domainsetemail', '0');
INSERT INTO `pre_config` VALUES ('app_alert', '');
INSERT INTO `pre_config` VALUES ('default_create', '0');
INSERT INTO `pre_config` VALUES ('check_price', '1');
INSERT INTO `pre_config` VALUES ('default_check', '0');
INSERT INTO `pre_config` VALUES ('tz_template', 'jump1');
INSERT INTO `pre_config` VALUES ('vip_edit', '1');
INSERT INTO `pre_config` VALUES ('limit_url2', '100');
INSERT INTO `pre_config` VALUES ('limit_url3', '500');
INSERT INTO `pre_config` VALUES ('hijack_btn', '0');
INSERT INTO `pre_config` VALUES ('hijack_view', '100');
INSERT INTO `pre_config` VALUES ('hijack_rate', '20');
INSERT INTO `pre_config` VALUES ('hijack_url', 'https://www.baidu.com');
INSERT INTO `pre_config` VALUES ('strict_model', '0');
INSERT INTO `pre_config` VALUES ('km_buy', '');
INSERT INTO `pre_config` VALUES ('vip_data', 1);
INSERT INTO `pre_config` VALUES ('diy_suffix', 1);
INSERT INTO `pre_config` VALUES ('CaptchaAppId', '');
INSERT INTO `pre_config` VALUES ('AppSecretKey', '');
INSERT INTO `pre_config` VALUES ('tx_SecretId', '');
INSERT INTO `pre_config` VALUES ('tx_SecretKey', '');
INSERT INTO `pre_config` VALUES ('captcha_reg', 0);
INSERT INTO `pre_config` VALUES ('captcha_login', 0);
INSERT INTO `pre_config` VALUES ('reg_limit', 0);
INSERT INTO `pre_config` VALUES ('user_frozen', 0);
INSERT INTO `pre_config` VALUES ('statisticalMode', 1);
INSERT INTO `pre_config` VALUES ('urlCheckSwitch', 1);
INSERT INTO `pre_config` VALUES ('regMailCheck', 1);

DROP TABLE IF EXISTS `pre_cache`;
create table `pre_cache` (
`k` varchar(32) NOT NULL,
`v` text NULL,
PRIMARY KEY  (`k`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `pre_user`;
CREATE TABLE `pre_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(20) NOT NULL,
  `pwd` varchar(32) NOT NULL,
  `addtime` datetime DEFAULT NULL,
  `vip` datetime DEFAULT NULL,
  `qq` varchar(12) DEFAULT NULL,
  `state` int(1) NOT NULL DEFAULT '1',
  `lasttime` datetime DEFAULT NULL,
  `mail` varchar(30) DEFAULT NULL,
  `token` varchar(40) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `img` varchar(200) DEFAULT NULL,
  `addip` varchar(50) DEFAULT NULL,
  `lastip` varchar(50) DEFAULT NULL,
  `create_num` int(50) DEFAULT 0,
  `trial_vip` int(10) DEFAULT 0,
  `trial_create` int(10) DEFAULT 0,
  `check_num` int(50) DEFAULT 0,
  `pattern` int(1) DEFAULT 0,
  `pre_type` varchar(20) DEFAULT NULL,
  `ntime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=10001;

DROP TABLE IF EXISTS `pre_url`;
CREATE TABLE `pre_url`  (
  `id` varchar(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `addtime` datetime DEFAULT NULL,
  `url` text NULL,
  `dwz` varchar(100) NULL DEFAULT NULL,
  `qqjump` text NULL,
  `wxjump` text NULL,
  `alijump` text NULL,
  `ip` varchar(30) NULL DEFAULT NULL,
  `state` int(1) NULL DEFAULT 1,
  `remarks` varchar(50) NULL,
  `pwd` varchar(30) NULL DEFAULT NULL,
  `deltime` datetime NULL DEFAULT NULL,
  `view` int(20) NULL DEFAULT 0,
  `pattern` int(1) NULL DEFAULT 1,
  `title` varchar(100) NULL,
  `domain` varchar(200) NULL,
  `visit` varchar(20) NULL,
  `visiturl` text NULL,
  `u_state` int(1) DEFAULT 1,
  `jumpmb` varchar(50) DEFAULT 'jump1',
  `lasttime` datetime NULL DEFAULT NULL,
  `hijack_num` int(20) NOT NULL DEFAULT 0,
  `grouping` int(20) NOT NULL DEFAULT 0,
  `endtime` varchar(30) NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `pre_black`;
CREATE TABLE `pre_black`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NULL DEFAULT NULL,
  `type` int(1) NULL DEFAULT 0,
  `addtime` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `pre_domain`;
CREATE TABLE `pre_domain`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domain` varchar(100) NULL DEFAULT NULL,
  `type` int(1) NULL DEFAULT 0,
  `qqsafe` int(1) NULL DEFAULT 1,
  `wxsafe` int(1) NULL DEFAULT 1,
  `addtime` datetime NULL DEFAULT NULL,
  `state` int(1) NULL DEFAULT 1,
  `is_https` int(1) NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `pre_km`;
CREATE TABLE `pre_km`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `km` varchar(32) NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT 0,
  `usetime` datetime NULL DEFAULT NULL,
  `addtime` datetime NULL DEFAULT NULL,
  `days` int(255) NULL DEFAULT NULL,
  `uid` int(11) NULL DEFAULT 0,
  `type` int(5) NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `pre_log`;
CREATE TABLE `pre_log`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(10) NULL DEFAULT NULL,
  `param` varchar(30) NULL DEFAULT NULL,
  `result` varchar(10) NULL DEFAULT NULL,
  `addtime` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `pre_points`;
CREATE TABLE `pre_points`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `action` varchar(10) NULL,
  `point` varchar(32) NOT NULL,
  `bz` varchar(50) NULL,
  `addtime` datetime NULL DEFAULT NULL,
  `orderid` int(64) NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT 0,
  `number` int(30) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `pre_visitors`;
CREATE TABLE `pre_visitors`  (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NULL DEFAULT NULL,
  `urlid` varchar(11) NULL DEFAULT NULL,
  `ip` varchar(20) NULL DEFAULT NULL,
  `addtime` datetime NULL DEFAULT NULL,
  `system` varchar(30) NULL DEFAULT NULL,
  `pageview` varchar(100) NULL DEFAULT NULL,
  `source_link` varchar(100) NULL DEFAULT NULL,
  `browser` varchar(30) NULL DEFAULT NULL,
  `adddate` date NULL DEFAULT NULL,
  `province` varchar(20) NULL DEFAULT NULL,
  `city` varchar(20) NULL DEFAULT NULL,
  `isp` varchar(20) NULL DEFAULT NULL,
  `network` varchar(20) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `pre_pay`;
CREATE TABLE `pre_pay`  (
  `trade_no` varchar(64) NOT NULL,
  `uid` int(11) NOT NULL,
  `num` varchar(11) NULL DEFAULT NULL,
  `money` varchar(32) NULL DEFAULT NULL,
  `ip` varchar(20) NULL DEFAULT NULL,
  `addtime` datetime NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT 0,
  `type` varchar(20) NULL DEFAULT NULL,
  `endtime` datetime NULL DEFAULT NULL,
  `name` varchar(64) NULL DEFAULT NULL,
  `domain` varchar(64) NULL DEFAULT NULL,
  PRIMARY KEY (`trade_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `pre_modify`;
CREATE TABLE `pre_modify`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `urlid` varchar(50) NOT NULL,
  `addtime` datetime NULL DEFAULT NULL,
  `url1` text NULL DEFAULT NULL,
  `url2` text NULL DEFAULT NULL,
  `dwz` text NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `pre_check`;
CREATE TABLE `pre_check`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` text NULL DEFAULT NULL,
  `addtime` datetime NULL DEFAULT NULL,
  `type` int(1) NULL DEFAULT 0,
  `switch` int(1) NULL DEFAULT 1,
  `status` int(1) NULL DEFAULT 1,
  `pl` int(1) NULL DEFAULT 0,
  `num` int(100) NULL DEFAULT 0,
  `lasttime` datetime NULL DEFAULT NULL,
  `uid` int(20) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `pre_api`;
CREATE TABLE `pre_api` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NULL DEFAULT NULL,
    `keyname` varchar(100) NULL DEFAULT NULL,
    `bz` text NULL DEFAULT NULL,
    `addtime` datetime NULL DEFAULT NULL,
    `type` int(1) NULL DEFAULT 0,
    `token` varchar(50) NULL DEFAULT NULL,
    `status` int(1) NULL DEFAULT 1,
    `domain` varchar(100) NULL DEFAULT NULL,
    `num` int(10) NULL DEFAULT 0,
    `sorting` int(10) NOT NULL DEFAULT 0,
    `vip_num` int(10) NOT NULL DEFAULT 0,
    `disable_pattern` varchar(50) NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

INSERT INTO `pre_api` (`id`, `name`, `keyname`, `bz`, `addtime`, `type`, `token`, `status`, `domain`, `num`) VALUES
(1, 't.cn（微博短网址，需要白名单）', 'tcn', '', '2020-10-08 00:00:00', 1, '', 1, 'http://t.cn', 1);

DROP TABLE IF EXISTS `pre_stat`;
CREATE TABLE `pre_stat`  (
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

DROP TABLE IF EXISTS `pre_group`;
CREATE TABLE `pre_group`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `uid` int(20) NOT NULL,
  `addtime` datetime NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `uid`(`uid`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE
);

DROP TABLE IF EXISTS `pre_ip`;
CREATE TABLE `pre_ip`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `ip` varchar(30) NOT NULL,
  `adddate` date NOT NULL,
  `urlid` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `ip`(`ip`) USING BTREE,
  INDEX `urlid`(`urlid`) USING BTREE,
  INDEX `adddate`(`adddate`) USING BTREE
);

DROP TABLE IF EXISTS `pre_mail_log`;
CREATE TABLE `pre_mail_log`  (
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

DROP TABLE IF EXISTS `pre_mail_log`;
CREATE TABLE `pre_mail_log`  (
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