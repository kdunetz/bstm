INSERT INTO `#__joocm_updates` (`version`,`update_file`,`status`) VALUES
 ('0.9.1','update_0.9.1.joocm.sql',0)
ON DUPLICATE KEY UPDATE version=version;

ALTER TABLE `#__joocm_interfaces` CHANGE `name` `name` varchar(255) NOT NULL default '' AFTER `id`;
ALTER TABLE `#__joocm_interfaces` CHANGE `com_name` `com` varchar(255) NOT NULL default '' AFTER `name`;
ALTER TABLE `#__joocm_interfaces` CHANGE `com_icon` `com_icon` varchar(255) NOT NULL default '' AFTER `com`;
ALTER TABLE `#__joocm_interfaces` CHANGE `url_params` `url` varchar(255) NOT NULL default '' AFTER `com_icon`;
ALTER TABLE `#__joocm_interfaces` CHANGE `client` `client` tinyint(1) NOT NULL default '0' AFTER `url`;
ALTER TABLE `#__joocm_interfaces` CHANGE `show_restriction` `show_restriction` tinyint(1) NOT NULL default '0' AFTER `client`;
ALTER TABLE `#__joocm_interfaces` CHANGE `ordering` `ordering` int(11) NOT NULL default '0' AFTER `show_restriction`;
ALTER TABLE `#__joocm_interfaces` CHANGE `published` `published` tinyint(1) NOT NULL default '0' AFTER `ordering`;
ALTER TABLE `#__joocm_interfaces` CHANGE `system` `system` tinyint(1) NOT NULL default '0' AFTER `published`;
ALTER TABLE `#__joocm_interfaces` CHANGE `checked_out` `checked_out` int(11) NOT NULL default '0' AFTER `system`;
ALTER TABLE `#__joocm_interfaces` CHANGE `checked_out_time` `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00' AFTER `checked_out`;

INSERT INTO `#__joocm_interfaces` (`name`,`com`,`com_icon`,`url`,`client`,`show_restriction`,`ordering`,`published`,`system`,`checked_out`,`checked_out_time`) VALUES
 ('CM_LINKS','com_joocm','administrator/components/com_joocm/images/header/icon-48-link.png','&task=joocm_link_view',1,0,20,1,0,0,'0000-00-00 00:00:00');
 
ALTER TABLE `#__joocm_links` CHANGE `com` `com` varchar(255) NOT NULL default '';

ALTER TABLE `#__joocm_links` ADD `checked_out` int(11) NOT NULL default '0' AFTER `published`;
ALTER TABLE `#__joocm_links` ADD `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00' AFTER `checked_out`;

