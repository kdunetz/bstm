ALTER TABLE `#__joobb_forums` ADD `auth_edit_all` int(3) NOT NULL default '0' AFTER `auth_edit`;
ALTER TABLE `#__joobb_forums` ADD `auth_delete_all` int(3) NOT NULL default '0' AFTER `auth_delete`;

UPDATE `#__joobb_forums` SET `auth_edit_all` = 4,  `auth_delete_all` = 4;

UPDATE `#__joobb_ranks` SET `rank_file` = 'stars_1.png' WHERE `rank_file` = 'stars_1.gif';
UPDATE `#__joobb_ranks` SET `rank_file` = 'stars_2.png' WHERE `rank_file` = 'stars_2.gif';
UPDATE `#__joobb_ranks` SET `rank_file` = 'stars_3.png' WHERE `rank_file` = 'stars_3.gif';
UPDATE `#__joobb_ranks` SET `rank_file` = 'stars_4.png' WHERE `rank_file` = 'stars_4.gif';
UPDATE `#__joobb_ranks` SET `rank_file` = 'stars_5.png' WHERE `rank_file` = 'stars_5.gif';



