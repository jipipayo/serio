

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `serio1`
-- ----------------------------
DROP TABLE IF EXISTS `serio1`;
CREATE TABLE `serio1` (
  `uuid` varbinary(32) NOT NULL,
  `data_pack` text NOT NULL,
  PRIMARY KEY (`uuid`),
  FULLTEXT KEY `search` (`data_pack`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 PACK_KEYS=0 ROW_FORMAT=COMPRESSED;


