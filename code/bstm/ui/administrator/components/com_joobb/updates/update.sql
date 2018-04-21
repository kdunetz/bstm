CREATE TABLE IF NOT EXISTS `#__joobb_updates` (
  `version` varchar(100) NOT NULL DEFAULT '',
  `update_file` varchar(255) NOT NULL DEFAULT '',
  `date_install` datetime NOT NULL default '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`version`)
) TYPE=MyISAM CHARACTER SET `utf8`;

INSERT INTO `#__joobb_updates` (`version`,`update_file`,`status`) VALUES
 ('1.0.0 Update','update.sql',0)
ON DUPLICATE KEY UPDATE version=version;

