ALTER TABLE `#__joobb_users` ADD `auto_subscription` tinyint(1) NOT NULL default '0' AFTER `enable_emotions`;
ALTER TABLE `#__joobb_configs` ADD `parse_settings` text NOT NULL AFTER `captcha_settings`;

CREATE TABLE `#__joobb_attachments` (
  `id` int(11) NOT NULL auto_increment,
  `file_name` varchar(255) NOT NULL default '',
  `original_name` varchar(255) NOT NULL default '',
  `hits` int(11) NOT NULL default '0',
  `date_upload` datetime NOT NULL default '0000-00-00 00:00:00',
  `id_post` int(11) NOT NULL default '0',
  `id_user` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `id_post` (`id_post`),
  KEY `id_user` (`id_user`)
) TYPE=MyISAM CHARACTER SET `utf8`;

