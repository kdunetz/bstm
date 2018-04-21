-- phpMyAdmin SQL Dump
-- version 2.11.9.4
-- http://www.phpmyadmin.net
--
-- Host: 97.74.30.74
-- Generation Time: Dec 02, 2010 at 07:46 AM
-- Server version: 5.0.91
-- PHP Version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `bri1013705345853`
--

-- --------------------------------------------------------

--
-- Table structure for table `jos_banner`
--

CREATE TABLE `jos_banner` (
  `bid` int(11) NOT NULL auto_increment,
  `cid` int(11) NOT NULL default '0',
  `type` varchar(30) NOT NULL default 'banner',
  `name` varchar(255) NOT NULL default '',
  `alias` varchar(255) NOT NULL default '',
  `imptotal` int(11) NOT NULL default '0',
  `impmade` int(11) NOT NULL default '0',
  `clicks` int(11) NOT NULL default '0',
  `imageurl` varchar(100) NOT NULL default '',
  `clickurl` varchar(200) NOT NULL default '',
  `date` datetime default NULL,
  `showBanner` tinyint(1) NOT NULL default '0',
  `checked_out` tinyint(1) NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `editor` varchar(50) default NULL,
  `custombannercode` text,
  `catid` int(10) unsigned NOT NULL default '0',
  `description` text NOT NULL,
  `sticky` tinyint(1) unsigned NOT NULL default '0',
  `ordering` int(11) NOT NULL default '0',
  `publish_up` datetime NOT NULL default '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL default '0000-00-00 00:00:00',
  `tags` text NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY  (`bid`),
  KEY `viewbanner` (`showBanner`),
  KEY `idx_banner_catid` (`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `jos_banner`
--

INSERT INTO `jos_banner` VALUES(1, 1, '', 'Google', 'google-1', 0, 367, 0, 'osmbanner1.png', '', '2010-11-08 01:57:46', 1, 0, '0000-00-00 00:00:00', '', '<script type="text/javascript"><!--\r\ngoogle_ad_client = "pub-4542959536048980";\r\n/* www.temresources.com 468x60, created 11/7/10 */\r\ngoogle_ad_slot = "6538759229";\r\ngoogle_ad_width = 468;\r\ngoogle_ad_height = 60;\r\n//-->\r\n</script>\r\n<script type="text/javascript"\r\nsrc="http://pagead2.googlesyndication.com/pagead/show_ads.js">\r\n</script>', 33, '', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'width=0\nheight=0');
INSERT INTO `jos_banner` VALUES(2, 1, 'banner', 'OSM 2', 'osm-2', 0, 49, 0, 'osmbanner2.png', 'http://www.opensourcematters.org', '2004-07-07 15:31:29', 0, 0, '0000-00-00 00:00:00', '', '', 13, '', 0, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '');
INSERT INTO `jos_banner` VALUES(3, 1, '', 'Joomla!', 'joomla', 0, 131, 0, '', 'http://www.joomla.org', '2010-11-07 16:25:24', 0, 0, '0000-00-00 00:00:00', '', '<a href="{CLICKURL}" target="_blank">{NAME}</a>\r\n<br/>\r\nTEM Resources! The most popular and widely used Open Source CMS Project in the world.', 14, '', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'width=0\nheight=0');
INSERT INTO `jos_banner` VALUES(4, 1, '', 'JoomlaCode', 'joomlacode', 0, 131, 0, '', 'http://joomlacode.org', '2010-11-07 16:25:44', 0, 0, '0000-00-00 00:00:00', '', '<a href="{CLICKURL}" target="_blank">{NAME}</a>\r\n<br/>\r\nTEMResources, development and distribution made easy.', 14, '', 0, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'width=0\nheight=0');
INSERT INTO `jos_banner` VALUES(5, 1, '', 'Joomla! Extensions', 'joomla-extensions', 0, 126, 0, '', 'http://extensions.joomla.org', '2006-05-29 14:23:21', 0, 0, '0000-00-00 00:00:00', '', '<a href="{CLICKURL}" target="_blank">{NAME}</a>\r\n<br/>\r\nJoomla! Components, Modules, Plugins and Languages by the bucket load.', 14, '', 0, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '');
INSERT INTO `jos_banner` VALUES(6, 1, '', 'Joomla! Shop', 'joomla-shop', 0, 126, 0, '', 'http://shop.joomla.org', '2006-05-29 14:23:21', 0, 0, '0000-00-00 00:00:00', '', '<a href="{CLICKURL}" target="_blank">{NAME}</a>\r\n<br/>\r\nFor all your Joomla! merchandise.', 14, '', 0, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '');
INSERT INTO `jos_banner` VALUES(7, 1, '', 'Joomla! Promo Shop', 'joomla-promo-shop', 0, 103, 1, 'shop-ad.jpg', 'http://shop.joomla.org', '2007-09-19 17:26:24', 0, 0, '0000-00-00 00:00:00', '', '', 33, '', 0, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '');
INSERT INTO `jos_banner` VALUES(8, 1, '', 'Joomla! Promo Books', 'joomla-promo-books', 0, 107, 0, 'shop-ad-books.jpg', 'http://shop.joomla.org/amazoncom-bookstores.html', '2007-09-19 17:28:01', 0, 0, '0000-00-00 00:00:00', '', '', 33, '', 0, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `jos_bannerclient`
--

CREATE TABLE `jos_bannerclient` (
  `cid` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `contact` varchar(255) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `extrainfo` text NOT NULL,
  `checked_out` tinyint(1) NOT NULL default '0',
  `checked_out_time` time default NULL,
  `editor` varchar(50) default NULL,
  PRIMARY KEY  (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `jos_bannerclient`
--

INSERT INTO `jos_bannerclient` VALUES(1, 'Google', 'Administrator', 'admin@temresources.com', '', 0, '00:00:00', '');
INSERT INTO `jos_bannerclient` VALUES(2, 'Rivermine', 'Bob Jones', 'kevindunetz@gmail.com', '', 0, '00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `jos_bannertrack`
--

CREATE TABLE `jos_bannertrack` (
  `track_date` date NOT NULL,
  `track_type` int(10) unsigned NOT NULL,
  `banner_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_bannertrack`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_categories`
--

CREATE TABLE `jos_categories` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `alias` varchar(255) NOT NULL default '',
  `image` varchar(255) NOT NULL default '',
  `section` varchar(50) NOT NULL default '',
  `image_position` varchar(30) NOT NULL default '',
  `description` text NOT NULL,
  `published` tinyint(1) NOT NULL default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `editor` varchar(50) default NULL,
  `ordering` int(11) NOT NULL default '0',
  `access` tinyint(3) unsigned NOT NULL default '0',
  `count` int(11) NOT NULL default '0',
  `params` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `cat_idx` (`section`,`published`,`access`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `jos_categories`
--

INSERT INTO `jos_categories` VALUES(1, 0, 'Latest', '', 'latest-news', 'taking_notes.jpg', '1', 'left', 'The latest news from the Joomla! Team', 1, 0, '0000-00-00 00:00:00', '', 1, 0, 1, '');
INSERT INTO `jos_categories` VALUES(2, 0, 'Joomla! Specific Links', '', 'joomla-specific-links', 'clock.jpg', 'com_weblinks', 'left', 'A selection of links that are all related to the Joomla! Project.', 0, 0, '0000-00-00 00:00:00', NULL, 1, 0, 0, '');
INSERT INTO `jos_categories` VALUES(3, 0, 'Newsflash', '', 'newsflash', '', '1', 'left', '', 1, 0, '0000-00-00 00:00:00', '', 2, 0, 0, '');
INSERT INTO `jos_categories` VALUES(4, 0, 'Joomla!', '', 'joomla', '', 'com_newsfeeds', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 2, 0, 0, '');
INSERT INTO `jos_categories` VALUES(5, 0, 'Free and Open Source Software', '', 'free-and-open-source-software', '', 'com_newsfeeds', 'left', 'Read the latest news about free and open source software from some of its leading advocates.', 1, 0, '0000-00-00 00:00:00', NULL, 3, 0, 0, '');
INSERT INTO `jos_categories` VALUES(6, 0, 'Related Projects', '', 'related-projects', '', 'com_newsfeeds', 'left', 'Joomla builds on and collaborates with many other free and open source projects. Keep up with the latest news from some of them.', 1, 0, '0000-00-00 00:00:00', NULL, 4, 0, 0, '');
INSERT INTO `jos_categories` VALUES(12, 0, 'Contacts', '', 'contacts', '', 'com_contact_details', 'left', 'Contact Details for this Web site', 1, 0, '0000-00-00 00:00:00', NULL, 0, 0, 0, '');
INSERT INTO `jos_categories` VALUES(13, 0, 'Joomla', '', 'joomla', '', 'com_banner', 'left', '', 0, 0, '0000-00-00 00:00:00', NULL, 0, 0, 0, '');
INSERT INTO `jos_categories` VALUES(14, 0, 'Text Ads', '', 'text-ads', '', 'com_banner', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 0, 0, 0, '');
INSERT INTO `jos_categories` VALUES(15, 0, 'Features', '', 'features', '', 'com_content', 'left', '', 0, 0, '0000-00-00 00:00:00', NULL, 6, 0, 0, '');
INSERT INTO `jos_categories` VALUES(17, 0, 'Benefits', '', 'benefits', '', 'com_content', 'left', '', 0, 0, '0000-00-00 00:00:00', NULL, 4, 0, 0, '');
INSERT INTO `jos_categories` VALUES(18, 0, 'Platforms', '', 'platforms', '', 'com_content', 'left', '', 0, 0, '0000-00-00 00:00:00', NULL, 3, 0, 0, '');
INSERT INTO `jos_categories` VALUES(19, 0, 'Other Resources', '', 'other-resources', '', 'com_weblinks', 'left', '', 0, 0, '0000-00-00 00:00:00', NULL, 2, 0, 0, '');
INSERT INTO `jos_categories` VALUES(29, 0, 'The CMS', '', 'the-cms', '', '4', 'left', 'Information about the software behind Joomla!<br />', 1, 0, '0000-00-00 00:00:00', NULL, 2, 0, 0, '');
INSERT INTO `jos_categories` VALUES(28, 0, 'Current Users', '', 'current-users', '', '3', 'left', 'Questions that users migrating to Joomla! 1.5 are likely to raise<br />', 1, 0, '0000-00-00 00:00:00', NULL, 2, 0, 0, '');
INSERT INTO `jos_categories` VALUES(25, 0, 'The Project', '', 'the-project', '', '4', 'left', 'General facts about Joomla!<br />', 1, 0, '0000-00-00 00:00:00', NULL, 1, 0, 0, '');
INSERT INTO `jos_categories` VALUES(27, 0, 'New to Joomla!', '', 'new-to-joomla', '', '3', 'left', 'Questions for new users of Joomla!', 1, 0, '0000-00-00 00:00:00', NULL, 3, 0, 0, '');
INSERT INTO `jos_categories` VALUES(30, 0, 'The Community', '', 'the-community', '', '4', 'left', 'About the millions of Joomla! users and Web sites<br />', 1, 0, '0000-00-00 00:00:00', NULL, 3, 0, 0, '');
INSERT INTO `jos_categories` VALUES(31, 0, 'General', '', 'general', '', '3', 'left', 'General questions about the Joomla! CMS', 1, 0, '0000-00-00 00:00:00', NULL, 1, 0, 0, '');
INSERT INTO `jos_categories` VALUES(32, 0, 'Languages', '', 'languages', '', '3', 'left', 'Questions related to localisation and languages', 1, 0, '0000-00-00 00:00:00', NULL, 4, 0, 0, '');
INSERT INTO `jos_categories` VALUES(33, 0, 'TEM Providers', '', 'tem-providers', '', 'com_banner', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 1, 0, 0, '');
INSERT INTO `jos_categories` VALUES(34, 0, 'TEM Software Providers', '', 'tem-software-providers', '', 'com_weblinks', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 3, 0, 0, '');
INSERT INTO `jos_categories` VALUES(35, 0, 'Tariff Websites', '', 'tariff-websites', '', 'com_weblinks', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 4, 0, 0, '');
INSERT INTO `jos_categories` VALUES(36, 0, 'Tariff Services', '', 'tariff-services', '', 'com_weblinks', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 5, 0, 0, '');
INSERT INTO `jos_categories` VALUES(37, 0, 'Contract Negotiators', '', 'contract-negotiators', '', 'com_weblinks', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 6, 0, 0, '');
INSERT INTO `jos_categories` VALUES(38, 0, 'Independent Consultants', '', 'independent-consultants', '', 'com_weblinks', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 7, 0, 0, '');
INSERT INTO `jos_categories` VALUES(39, 0, 'Invoice Scanning Services', '', 'invoice-scanning-services', '', 'com_weblinks', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 8, 0, 0, '');
INSERT INTO `jos_categories` VALUES(40, 0, 'Auditors', '', 'auditors', '', 'com_weblinks', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 9, 0, 0, '');
INSERT INTO `jos_categories` VALUES(41, 0, 'TEM Service Providers', '', 'tem-service-providers', '', 'com_weblinks', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 10, 0, 0, '');
INSERT INTO `jos_categories` VALUES(42, 0, 'TEM Articles', '', 'tem-articles', '', 'com_weblinks', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 11, 0, 0, '');
INSERT INTO `jos_categories` VALUES(43, 0, 'TEM Whitepapers', '', 'tem-whitepapers', '', 'com_weblinks', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 12, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `jos_components`
--

CREATE TABLE `jos_components` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `link` varchar(255) NOT NULL default '',
  `menuid` int(11) unsigned NOT NULL default '0',
  `parent` int(11) unsigned NOT NULL default '0',
  `admin_menu_link` varchar(255) NOT NULL default '',
  `admin_menu_alt` varchar(255) NOT NULL default '',
  `option` varchar(50) NOT NULL default '',
  `ordering` int(11) NOT NULL default '0',
  `admin_menu_img` varchar(255) NOT NULL default '',
  `iscore` tinyint(4) NOT NULL default '0',
  `params` text NOT NULL,
  `enabled` tinyint(4) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `parent_option` (`parent`,`option`(32))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `jos_components`
--

INSERT INTO `jos_components` VALUES(1, 'Banners', '', 0, 0, '', 'Banner Management', 'com_banners', 0, 'js/ThemeOffice/component.png', 0, 'track_impressions=0\ntrack_clicks=0\ntag_prefix=\n\n', 1);
INSERT INTO `jos_components` VALUES(2, 'Banners', '', 0, 1, 'option=com_banners', 'Active Banners', 'com_banners', 1, 'js/ThemeOffice/edit.png', 0, '', 1);
INSERT INTO `jos_components` VALUES(3, 'Clients', '', 0, 1, 'option=com_banners&c=client', 'Manage Clients', 'com_banners', 2, 'js/ThemeOffice/categories.png', 0, '', 1);
INSERT INTO `jos_components` VALUES(4, 'Web Links', 'option=com_weblinks', 0, 0, '', 'Manage Weblinks', 'com_weblinks', 0, 'js/ThemeOffice/component.png', 0, 'show_comp_description=1\ncomp_description=\nshow_link_hits=1\nshow_link_description=1\nshow_other_cats=1\nshow_headings=1\nshow_page_title=1\nlink_target=0\nlink_icons=\n\n', 1);
INSERT INTO `jos_components` VALUES(5, 'Links', '', 0, 4, 'option=com_weblinks', 'View existing weblinks', 'com_weblinks', 1, 'js/ThemeOffice/edit.png', 0, '', 1);
INSERT INTO `jos_components` VALUES(6, 'Categories', '', 0, 4, 'option=com_categories&section=com_weblinks', 'Manage weblink categories', '', 2, 'js/ThemeOffice/categories.png', 0, '', 1);
INSERT INTO `jos_components` VALUES(7, 'Contacts', 'option=com_contact', 0, 0, '', 'Edit contact details', 'com_contact', 0, 'js/ThemeOffice/component.png', 1, 'contact_icons=0\nicon_address=\nicon_email=\nicon_telephone=\nicon_fax=\nicon_misc=\nshow_headings=1\nshow_position=1\nshow_email=0\nshow_telephone=1\nshow_mobile=1\nshow_fax=1\nbannedEmail=\nbannedSubject=\nbannedText=\nsession=1\ncustomReply=0\n\n', 1);
INSERT INTO `jos_components` VALUES(8, 'Contacts', '', 0, 7, 'option=com_contact', 'Edit contact details', 'com_contact', 0, 'js/ThemeOffice/edit.png', 1, '', 1);
INSERT INTO `jos_components` VALUES(9, 'Categories', '', 0, 7, 'option=com_categories&section=com_contact_details', 'Manage contact categories', '', 2, 'js/ThemeOffice/categories.png', 1, 'contact_icons=0\nicon_address=\nicon_email=\nicon_telephone=\nicon_fax=\nicon_misc=\nshow_headings=1\nshow_position=1\nshow_email=0\nshow_telephone=1\nshow_mobile=1\nshow_fax=1\nbannedEmail=\nbannedSubject=\nbannedText=\nsession=1\ncustomReply=0\n\n', 1);
INSERT INTO `jos_components` VALUES(10, 'Polls', 'option=com_poll', 0, 0, 'option=com_poll', 'Manage Polls', 'com_poll', 0, 'js/ThemeOffice/component.png', 0, '', 1);
INSERT INTO `jos_components` VALUES(11, 'News Feeds', 'option=com_newsfeeds', 0, 0, '', 'News Feeds Management', 'com_newsfeeds', 0, 'js/ThemeOffice/component.png', 0, '', 1);
INSERT INTO `jos_components` VALUES(12, 'Feeds', '', 0, 11, 'option=com_newsfeeds', 'Manage News Feeds', 'com_newsfeeds', 1, 'js/ThemeOffice/edit.png', 0, 'show_headings=1\nshow_name=1\nshow_articles=1\nshow_link=1\nshow_cat_description=1\nshow_cat_items=1\nshow_feed_image=1\nshow_feed_description=1\nshow_item_description=1\nfeed_word_count=0\n\n', 1);
INSERT INTO `jos_components` VALUES(13, 'Categories', '', 0, 11, 'option=com_categories&section=com_newsfeeds', 'Manage Categories', '', 2, 'js/ThemeOffice/categories.png', 0, '', 1);
INSERT INTO `jos_components` VALUES(14, 'User', 'option=com_user', 0, 0, '', '', 'com_user', 0, '', 1, '', 1);
INSERT INTO `jos_components` VALUES(15, 'Search', 'option=com_search', 0, 0, 'option=com_search', 'Search Statistics', 'com_search', 0, 'js/ThemeOffice/component.png', 1, 'enabled=0\n\n', 1);
INSERT INTO `jos_components` VALUES(16, 'Categories', '', 0, 1, 'option=com_categories&section=com_banner', 'Categories', '', 3, '', 1, '', 1);
INSERT INTO `jos_components` VALUES(17, 'Wrapper', 'option=com_wrapper', 0, 0, '', 'Wrapper', 'com_wrapper', 0, '', 1, '', 1);
INSERT INTO `jos_components` VALUES(18, 'Mail To', '', 0, 0, '', '', 'com_mailto', 0, '', 1, '', 1);
INSERT INTO `jos_components` VALUES(19, 'Media Manager', '', 0, 0, 'option=com_media', 'Media Manager', 'com_media', 0, '', 1, 'upload_extensions=bmp,csv,doc,epg,gif,ico,jpg,odg,odp,ods,odt,pdf,png,ppt,swf,txt,xcf,xls,BMP,CSV,DOC,EPG,GIF,ICO,JPG,ODG,ODP,ODS,ODT,PDF,PNG,PPT,SWF,TXT,XCF,XLS\nupload_maxsize=10000000\nfile_path=images\nimage_path=images/stories\nrestrict_uploads=1\nallowed_media_usergroup=3\ncheck_mime=1\nimage_extensions=bmp,gif,jpg,png\nignore_extensions=\nupload_mime=image/jpeg,image/gif,image/png,image/bmp,application/x-shockwave-flash,application/msword,application/excel,application/pdf,application/powerpoint,text/plain,application/x-zip\nupload_mime_illegal=text/html\nenable_flash=0\n\n', 1);
INSERT INTO `jos_components` VALUES(20, 'Articles', 'option=com_content', 0, 0, '', '', 'com_content', 0, '', 1, 'show_noauth=0\nshow_title=0\nlink_titles=0\nshow_intro=0\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=0\nshow_create_date=0\nshow_modify_date=0\nshow_item_navigation=0\nshow_readmore=0\nshow_vote=0\nshow_icons=0\nshow_pdf_icon=0\nshow_print_icon=0\nshow_email_icon=0\nshow_hits=0\nfeed_summary=0\nfilter_tags=\nfilter_attritbutes=\n\n', 1);
INSERT INTO `jos_components` VALUES(21, 'Configuration Manager', '', 0, 0, '', 'Configuration', 'com_config', 0, '', 1, '', 1);
INSERT INTO `jos_components` VALUES(22, 'Installation Manager', '', 0, 0, '', 'Installer', 'com_installer', 0, '', 1, '', 1);
INSERT INTO `jos_components` VALUES(23, 'Language Manager', '', 0, 0, '', 'Languages', 'com_languages', 0, '', 1, '', 1);
INSERT INTO `jos_components` VALUES(24, 'Mass mail', '', 0, 0, '', 'Mass Mail', 'com_massmail', 0, '', 1, 'mailSubjectPrefix=\nmailBodySuffix=\n\n', 1);
INSERT INTO `jos_components` VALUES(25, 'Menu Editor', '', 0, 0, '', 'Menu Editor', 'com_menus', 0, '', 1, '', 1);
INSERT INTO `jos_components` VALUES(27, 'Messaging', '', 0, 0, '', 'Messages', 'com_messages', 0, '', 1, '', 1);
INSERT INTO `jos_components` VALUES(28, 'Modules Manager', '', 0, 0, '', 'Modules', 'com_modules', 0, '', 1, '', 1);
INSERT INTO `jos_components` VALUES(29, 'Plugin Manager', '', 0, 0, '', 'Plugins', 'com_plugins', 0, '', 1, '', 1);
INSERT INTO `jos_components` VALUES(30, 'Template Manager', '', 0, 0, '', 'Templates', 'com_templates', 0, '', 1, '', 1);
INSERT INTO `jos_components` VALUES(31, 'User Manager', '', 0, 0, '', 'Users', 'com_users', 0, '', 1, 'allowUserRegistration=1\nnew_usertype=Registered\nuseractivation=1\nfrontend_userparams=1\n\n', 1);
INSERT INTO `jos_components` VALUES(32, 'Cache Manager', '', 0, 0, '', 'Cache', 'com_cache', 0, '', 1, '', 1);
INSERT INTO `jos_components` VALUES(33, 'Control Panel', '', 0, 0, '', 'Control Panel', 'com_cpanel', 0, '', 1, '', 1);
INSERT INTO `jos_components` VALUES(34, 'Joo!CM', 'option=com_joocm', 0, 0, 'option=com_joocm', 'Joo!CM', 'com_joocm', 0, 'components/com_joocm/images/menu/icon-16-joocm.png', 0, '', 1);
INSERT INTO `jos_components` VALUES(35, 'Joo!BB', 'option=com_joobb', 0, 0, 'option=com_joobb', 'Joo!BB', 'com_joobb', 0, 'components/com_joobb/images/menu/icon-16-joobb.png', 0, '', 1);
INSERT INTO `jos_components` VALUES(36, 'JoomGallery', 'option=com_joomgallery', 0, 0, 'option=com_joomgallery', 'JoomGallery', 'com_joomgallery', 0, 'components/com_joomgallery/assets/images/joom_main.png', 0, '', 1);
INSERT INTO `jos_components` VALUES(37, 'Category Manager', '', 0, 36, 'option=com_joomgallery&controller=categories', 'Category Manager', 'com_joomgallery', 0, 'components/com_joomgallery/assets/images/joom_categories.png', 0, '', 1);
INSERT INTO `jos_components` VALUES(38, 'Picture Manager', '', 0, 36, 'option=com_joomgallery&controller=images', 'Picture Manager', 'com_joomgallery', 1, 'components/com_joomgallery/assets/images/joom_pictures.png', 0, '', 1);
INSERT INTO `jos_components` VALUES(39, 'Comments Manager', '', 0, 36, 'option=com_joomgallery&controller=comments', 'Comments Manager', 'com_joomgallery', 2, 'components/com_joomgallery/assets/images/joom_comments.png', 0, '', 1);
INSERT INTO `jos_components` VALUES(40, 'Picture Upload', '', 0, 36, 'option=com_joomgallery&controller=upload', 'Picture Upload', 'com_joomgallery', 3, 'components/com_joomgallery/assets/images/joom_pictureupload.png', 0, '', 1);
INSERT INTO `jos_components` VALUES(41, 'Batch Upload', '', 0, 36, 'option=com_joomgallery&controller=batchupload', 'Batch Upload', 'com_joomgallery', 4, 'components/com_joomgallery/assets/images/joom_batchupload.png', 0, '', 1);
INSERT INTO `jos_components` VALUES(42, 'FTP Upload', '', 0, 36, 'option=com_joomgallery&controller=ftpupload', 'FTP Upload', 'com_joomgallery', 5, 'components/com_joomgallery/assets/images/joom_ftpupload.png', 0, '', 1);
INSERT INTO `jos_components` VALUES(43, 'Java Upload', '', 0, 36, 'option=com_joomgallery&controller=jupload', 'Java Upload', 'com_joomgallery', 6, 'components/com_joomgallery/assets/images/joom_jupload.png', 0, '', 1);
INSERT INTO `jos_components` VALUES(44, 'Configuration Manager', '', 0, 36, 'option=com_joomgallery&controller=config', 'Configuration Manager', 'com_joomgallery', 7, 'components/com_joomgallery/assets/images/joom_config.png', 0, '', 1);
INSERT INTO `jos_components` VALUES(45, 'Customize CSS', '', 0, 36, 'option=com_joomgallery&controller=cssedit', 'Customize CSS', 'com_joomgallery', 8, 'components/com_joomgallery/assets/images/joom_css.png', 0, '', 1);
INSERT INTO `jos_components` VALUES(46, 'Migration Manager', '', 0, 36, 'option=com_joomgallery&controller=migration', 'Migration Manager', 'com_joomgallery', 9, 'components/com_joomgallery/assets/images/joom_migration.png', 0, '', 1);
INSERT INTO `jos_components` VALUES(47, 'Maintenance Manager', '', 0, 36, 'option=com_joomgallery&controller=maintenance', 'Maintenance Manager', 'com_joomgallery', 10, 'components/com_joomgallery/assets/images/joom_maintenance.png', 0, '', 1);
INSERT INTO `jos_components` VALUES(48, 'Help', '', 0, 36, 'option=com_joomgallery&controller=help', 'Help', 'com_joomgallery', 11, 'components/com_joomgallery/assets/images/joom_information.png', 0, '', 1);
INSERT INTO `jos_components` VALUES(49, 'Jobline', 'option=com_jobline', 0, 0, 'option=com_jobline', 'Jobline', 'com_jobline', 0, 'js/ThemeOffice/component.png', 0, '', 1);
INSERT INTO `jos_components` VALUES(50, 'Job Postings', '', 0, 49, 'option=com_jobline&task=list', 'Job Postings', 'com_jobline', 0, 'js/ThemeOffice/content.png', 0, '', 1);
INSERT INTO `jos_components` VALUES(51, 'Posting Approval Queue', '', 0, 49, 'option=com_jobline&task=queue', 'Posting Approval Queue', 'com_jobline', 1, 'js/ThemeOffice/checkin.png', 0, '', 1);
INSERT INTO `jos_components` VALUES(52, 'List Templates', '', 0, 49, 'option=com_jobline&task=listtemplates', 'List Templates', 'com_jobline', 2, 'js/ThemeOffice/template.png', 0, '', 1);
INSERT INTO `jos_components` VALUES(53, 'Information', '', 0, 49, 'option=com_jobline&task=info', 'Information', 'com_jobline', 3, 'js/ThemeOffice/help.png', 0, '', 1);
INSERT INTO `jos_components` VALUES(54, 'Configuration', '', 0, 49, 'option=com_jobline&task=conf', 'Configuration', 'com_jobline', 4, 'js/ThemeOffice/config.png', 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jos_contact_details`
--

CREATE TABLE `jos_contact_details` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `alias` varchar(255) NOT NULL default '',
  `con_position` varchar(255) default NULL,
  `address` text,
  `suburb` varchar(100) default NULL,
  `state` varchar(100) default NULL,
  `country` varchar(100) default NULL,
  `postcode` varchar(100) default NULL,
  `telephone` varchar(255) default NULL,
  `fax` varchar(255) default NULL,
  `misc` mediumtext,
  `image` varchar(255) default NULL,
  `imagepos` varchar(20) default NULL,
  `email_to` varchar(255) default NULL,
  `default_con` tinyint(1) unsigned NOT NULL default '0',
  `published` tinyint(1) unsigned NOT NULL default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL default '0',
  `params` text NOT NULL,
  `user_id` int(11) NOT NULL default '0',
  `catid` int(11) NOT NULL default '0',
  `access` tinyint(3) unsigned NOT NULL default '0',
  `mobile` varchar(255) NOT NULL default '',
  `webpage` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `jos_contact_details`
--

INSERT INTO `jos_contact_details` VALUES(1, 'Name', 'name', 'Position', 'Street', 'Suburb', 'State', 'Country', 'Zip Code', 'Telephone', 'Fax', 'Miscellanous info', 'powered_by.png', 'top', 'email@email.com', 1, 1, 0, '0000-00-00 00:00:00', 1, 'show_name=1\r\nshow_position=1\r\nshow_email=0\r\nshow_street_address=1\r\nshow_suburb=1\r\nshow_state=1\r\nshow_postcode=1\r\nshow_country=1\r\nshow_telephone=1\r\nshow_mobile=1\r\nshow_fax=1\r\nshow_webpage=1\r\nshow_misc=1\r\nshow_image=1\r\nallow_vcard=0\r\ncontact_icons=0\r\nicon_address=\r\nicon_email=\r\nicon_telephone=\r\nicon_fax=\r\nicon_misc=\r\nshow_email_form=1\r\nemail_description=1\r\nshow_email_copy=1\r\nbanned_email=\r\nbanned_subject=\r\nbanned_text=', 0, 12, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `jos_content`
--

CREATE TABLE `jos_content` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `alias` varchar(255) NOT NULL default '',
  `title_alias` varchar(255) NOT NULL default '',
  `introtext` mediumtext NOT NULL,
  `fulltext` mediumtext NOT NULL,
  `state` tinyint(3) NOT NULL default '0',
  `sectionid` int(11) unsigned NOT NULL default '0',
  `mask` int(11) unsigned NOT NULL default '0',
  `catid` int(11) unsigned NOT NULL default '0',
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL default '0',
  `created_by_alias` varchar(255) NOT NULL default '',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL default '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL default '0000-00-00 00:00:00',
  `images` text NOT NULL,
  `urls` text NOT NULL,
  `attribs` text NOT NULL,
  `version` int(11) unsigned NOT NULL default '1',
  `parentid` int(11) unsigned NOT NULL default '0',
  `ordering` int(11) NOT NULL default '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `access` int(11) unsigned NOT NULL default '0',
  `hits` int(11) unsigned NOT NULL default '0',
  `metadata` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `idx_section` (`sectionid`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `jos_content`
--

INSERT INTO `jos_content` VALUES(1, 'Welcome to Joomla!', 'welcome-to-joomla', '', '<div align="left"><strong>Joomla! is a free open source framework and content publishing system designed for quickly creating highly interactive multi-language Web sites, online communities, media portals, blogs and eCommerce applications. <br /></strong></div><p><strong><br /></strong><img src="images/stories/powered_by.png" border="0" alt="Joomla! Logo" title="Example Caption" hspace="6" vspace="0" width="165" height="68" align="left" />Joomla! provides an easy-to-use graphical user interface that simplifies the management and publishing of large volumes of content including HTML, documents, and rich media.  Joomla! is used by organisations of all sizes for intranets and extranets and is supported by a community of tens of thousands of users. </p>', 'With a fully documented library of developer resources, Joomla! allows the customisation of every aspect of a Web site including presentation, layout, administration, and the rapid integration with third-party applications.<p>Joomla! now provides more developer power while making the user experience all the more friendly. For those who always wanted increased extensibility, Joomla! 1.5 can make this happen.</p><p>A new framework, ground-up refactoring, and a highly-active development team brings the excitement of ''the next generation CMS'' to your fingertips.  Whether you are a systems architect or a complete ''noob'' Joomla! can take you to the next level of content delivery. ''More than a CMS'' is something we have been playing with as a catchcry because the new Joomla! API has such incredible power and flexibility, you are free to take whatever direction your creative mind takes you and Joomla! can help you get there so much more easily than ever before.</p><p>Thinking Web publishing? Think Joomla!</p>', 1, 1, 0, 1, '2008-08-12 10:00:00', 62, '', '2008-08-12 10:00:00', 62, 0, '0000-00-00 00:00:00', '2006-01-03 01:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 29, 0, 1, '', '', 0, 92, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(2, 'Newsflash 1', 'newsflash-1', '', '<p>Vodafone purchased Quickcomm and TNT last week.  This acquisition removes 2 key players from the TEM market.</p>', '', 1, 1, 0, 3, '2008-08-10 06:30:34', 62, '', '2010-11-08 00:57:47', 62, 0, '0000-00-00 00:00:00', '2004-08-09 10:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 8, 0, 3, '', '', 0, 1, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(49, 'Contact Us', 'contact-us', '', '<p>If you''d like to receive more information about TEM Resources, please send an email to temresources@temresources.com.</p>', '', 1, 0, 0, 0, '2010-11-08 02:18:12', 62, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2010-11-08 02:18:12', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 1, 0, 2, '', '', 0, 8, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(3, 'Newsflash 2', 'newsflash-2', '', '<p>Asentinel''s new version is due out shortly.  It is supposed to contain many great new features.</p>', '', 1, 1, 0, 3, '2008-08-09 22:30:34', 62, '', '2010-11-08 01:06:01', 62, 0, '0000-00-00 00:00:00', '2004-08-09 06:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 7, 0, 4, '', '', 0, 0, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(4, 'Newsflash 3', 'newsflash-3', '', '<p>Tangoe''s filing for IPO has caused a lot of buzz in the industry.  The date of the IPO has yet to be announced.</p>', '', 1, 1, 0, 3, '2008-08-10 06:30:34', 62, '', '2010-11-08 01:07:05', 62, 0, '0000-00-00 00:00:00', '2004-08-09 10:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 8, 0, 5, '', '', 0, 1, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(50, 'List of Invoice Formats', 'list-of-invoice-formats', '', '<p>ATT Billing Edge - CD</p>\r\n<p>ATT EBill - Website</p>\r\n<p>ATT Premier - Website</p>\r\n<p>ATT EDI 811 - Text File</p>\r\n<p>BellSouth BMS - CD</p>\r\n<p>BellSouth EDI 811</p>\r\n<p>Sprint/Nextel Smart CD</p>\r\n<p>Sprint/Nextel EDI 811</p>\r\n<p>Qwest Local EDI 811</p>\r\n<p>Qwest LD EDI 811</p>\r\n<p>SBC EDI 811</p>\r\n<p>TMobile</p>\r\n<p>Verizon EDI 811</p>\r\n<p>Verizon Bill Manager</p>\r\n<p>Verizon Wireless My Biz</p>', '', 1, 0, 0, 0, '2010-11-11 13:10:57', 62, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2010-11-11 13:10:57', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 1, 0, 1, '', '', 0, 3, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(5, 'Joomla! License Guidelines', 'joomla-license-guidelines', 'joomla-license-guidelines', '<p>This Web site is powered by <a href="http://joomla.org/" target="_blank" title="Joomla!">Joomla!</a> The software and default templates on which it runs are Copyright 2005-2008 <a href="http://www.opensourcematters.org/" target="_blank" title="Open Source Matters">Open Source Matters</a>. The sample content distributed with Joomla! is licensed under the <a href="http://docs.joomla.org/JEDL" target="_blank" title="Joomla! Electronic Document License">Joomla! Electronic Documentation License.</a> All data entered into this Web site and templates added after installation, are copyrighted by their respective copyright owners.</p> <p>If you want to distribute, copy, or modify Joomla!, you are welcome to do so under the terms of the <a href="http://www.gnu.org/licenses/old-licenses/gpl-2.0.html#SEC1" target="_blank" title="GNU General Public License"> GNU General Public License</a>. If you are unfamiliar with this license, you might want to read <a href="http://www.gnu.org/licenses/old-licenses/gpl-2.0.html#SEC4" target="_blank" title="How To Apply These Terms To Your Program">''How To Apply These Terms To Your Program''</a> and the <a href="http://www.gnu.org/licenses/old-licenses/gpl-2.0-faq.html" target="_blank" title="GNU General Public License FAQ">''GNU General Public License FAQ''</a>.</p> <p>The Joomla! licence has always been GPL.</p>', '', 0, 4, 0, 25, '2008-08-20 10:11:07', 62, '', '2008-08-20 10:11:07', 62, 0, '0000-00-00 00:00:00', '2004-08-19 06:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 7, 0, 4, '', '', 0, 100, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(6, 'We are Volunteers', 'we-are-volunteers', '', '<p>The Joomla Core Team and Working Group members are volunteer developers, designers, administrators and managers who have worked together to take Joomla! to new heights in its relatively short life. Joomla! has some wonderfully talented people taking Open Source concepts to the forefront of industry standards.  Joomla! 1.5 is a major leap forward and represents the most exciting Joomla! release in the history of the project. </p>', '', 0, 1, 0, 1, '2007-07-07 09:54:06', 62, '', '2007-07-07 09:54:06', 62, 0, '0000-00-00 00:00:00', '2004-07-06 22:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 10, 0, 4, '', '', 0, 54, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(9, 'Millions of Smiles', 'millions-of-smiles', '', '<p>The Joomla! team has millions of good reasons to be smiling about the Joomla! 1.5. In its current incarnation, it''s had millions of downloads, taking it to an unprecedented level of popularity.  The new code base is almost an entire re-factor of the old code base.  The user experience is still extremely slick but for developers the API is a dream.  A proper framework for real PHP architects seeking the best of the best.</p><p>If you''re a former Mambo User or a 1.0 series Joomla! User, 1.5 is the future of CMSs for a number of reasons.  It''s more powerful, more flexible, more secure, and intuitive.  Our developers and interface designers have worked countless hours to make this the most exciting release in the content management system sphere.</p><p>Go on ... get your FREE copy of Joomla! today and spread the word about this benchmark project. </p>', '', 0, 1, 0, 1, '2007-07-07 09:54:06', 62, '', '2007-07-07 09:54:06', 62, 0, '0000-00-00 00:00:00', '2004-07-06 22:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 5, 0, 7, '', '', 0, 23, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(10, 'How do I localise Joomla! to my language?', 'how-do-i-localise-joomla-to-my-language', '', '<h4>General<br /></h4><p>In Joomla! 1.5 all User interfaces can be localised. This includes the installation, the Back-end Control Panel and the Front-end Site.</p><p>The core release of Joomla! 1.5 is shipped with multiple language choices in the installation but, other than English (the default), languages for the Site and Administration interfaces need to be added after installation. Links to such language packs exist below.</p>', '<p>Translation Teams for Joomla! 1.5 may have also released fully localised installation packages where site, administrator and sample data are in the local language. These localised releases can be found in the specific team projects on the <a href="http://extensions.joomla.org/component/option,com_mtree/task,listcats/cat_id,1837/Itemid,35/" target="_blank" title="JED">Joomla! Extensions Directory</a>.</p><h4>How do I install language packs?</h4><ul><li>First download both the admin and the site language packs that you require.</li><li>Install each pack separately using the Extensions-&gt;Install/Uninstall Menu selection and then the package file upload facility.</li><li>Go to the Language Manager and be sure to select Site or Admin in the sub-menu. Then select the appropriate language and make it the default one using the Toolbar button.</li></ul><h4>How do I select languages?</h4><ul><li>Default languages can be independently set for Site and for Administrator</li><li>In addition, users can define their preferred language for each Site and Administrator. This takes affect after logging in.</li><li>While logging in to the Administrator Back-end, a language can also be selected for the particular session.</li></ul><h4>Where can I find Language Packs and Localised Releases?</h4><p><em>Please note that Joomla! 1.5 is new and language packs for this version may have not been released at this time.</em> </p><ul><li><a href="http://joomlacode.org/gf/project/jtranslation/" target="_blank" title="Accredited Translations">The Joomla! Accredited Translations Project</a>  - This is a joint repository for language packs that were developed by teams that are members of the Joomla! Translations Working Group.</li><li><a href="http://extensions.joomla.org/component/option,com_mtree/task,listcats/cat_id,1837/Itemid,35/" target="_blank" title="Translations">The Joomla! Extensions Site - Translations</a>  </li><li><a href="http://community.joomla.org/translations.html" target="_blank" title="Translation Work Group Teams">List of Translation Teams and Translation Partner Sites for Joomla! 1.5</a> </li></ul>', 1, 3, 0, 32, '2008-07-30 14:06:37', 62, '', '2008-07-30 14:06:37', 62, 0, '0000-00-00 00:00:00', '2006-09-29 10:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 9, 0, 5, '', '', 0, 10, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(11, 'How do I upgrade to Joomla! 1.5 ?', 'how-do-i-upgrade-to-joomla-15', '', '<p>Joomla! 1.5 does not provide an upgrade path from earlier versions. Converting an older site to a Joomla! 1.5 site requires creation of a new empty site using Joomla! 1.5 and then populating the new site with the content from the old site. This migration of content is not a one-to-one process and involves conversions and modifications to the content dump.</p> <p>There are two ways to perform the migration:</p>', ' <div id="post_content-107"><li>An automated method of migration has been provided which uses a migrator Component to create the migration dump out of the old site (Mambo 4.5.x up to Joomla! 1.0.x) and a smart import facility in the Joomla! 1.5 Installation that performs required conversions and modifications during the installation process.</li> <li>Migration can be performed manually. This involves exporting the required tables, manually performing required conversions and modifications and then importing the content to the new site after it is installed.</li>  <p><!--more--></p> <h2><strong> Automated migration</strong></h2>  <p>This is a two phased process using two tools. The first tool is a migration Component named <font face="courier new,courier">com_migrator</font>. This Component has been contributed by Harald Baer and is based on his <strong>eBackup </strong>Component. The migrator needs to be installed on the old site and when activated it prepares the required export dump of the old site''s data. The second tool is built into the Joomla! 1.5 installation process. The exported content dump is loaded to the new site and all conversions and modification are performed on-the-fly.</p> <h3><u> Step 1 - Using com_migrator to export data from old site:</u></h3> <li>Install the <font face="courier new,courier">com_migrator</font> Component on the <u><strong>old</strong></u> site. It can be found at the <a href="http://joomlacode.org/gf/project/pasamioprojects/frs/" target="_blank" title="JoomlaCode">JoomlaCode developers forge</a>.</li> <li>Select the Component in the Component Menu of the Control Panel.</li> <li>Click on the <strong>Dump it</strong> icon. Three exported <em>gzipped </em>export scripts will be created. The first is a complete backup of the old site. The second is the migration content of all core elements which will be imported to the new site. The third is a backup of all 3PD Component tables.</li> <li>Click on the download icon of the particular exports files needed and store locally.</li> <li>Multiple export sets can be created.</li> <li>The exported data is not modified in anyway and the original encoding is preserved. This makes the <font face="courier new,courier">com_migrator</font> tool a recommended tool to use for manual migration as well.</li> <h3><u> Step 2 - Using the migration facility to import and convert data during Joomla! 1.5 installation:</u></h3><p>Note: This function requires the use of the <em><font face="courier new,courier">iconv </font></em>function in PHP to convert encodings. If <em><font face="courier new,courier">iconv </font></em>is not found a warning will be provided.</p> <li>In step 6 - Configuration select the ''Load Migration Script'' option in the ''Load Sample Data, Restore or Migrate Backed Up Content'' section of the page.</li> <li>Enter the table prefix used in the content dump. For example: ''jos_'' or ''site2_'' are acceptable values.</li> <li>Select the encoding of the dumped content in the dropdown list. This should be the encoding used on the pages of the old site. (As defined in the _ISO variable in the language file or as seen in the browser page info/encoding/source)</li> <li>Browse the local host and select the migration export and click on <strong>Upload and Execute</strong></li> <li>A success message should appear or alternately a listing of database errors</li> <li>Complete the other required fields in the Configuration step such as Site Name and Admin details and advance to the final step of installation. (Admin details will be ignored as the imported data will take priority. Please remember admin name and password from the old site)</li> <p><u><br /></u></p></div>', 1, 3, 0, 28, '2008-07-30 20:27:52', 62, '', '2008-07-30 20:27:52', 62, 0, '0000-00-00 00:00:00', '2006-09-29 12:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 10, 0, 3, '', '', 0, 14, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(12, 'Why does Joomla! 1.5 use UTF-8 encoding?', 'why-does-joomla-15-use-utf-8-encoding', '', '<p>Well... how about never needing to mess with encoding settings again?</p><p>Ever needed to display several languages on one page or site and something always came up in Giberish?</p><p>With utf-8 (a variant of Unicode) glyphs (character forms) of basically all languages can be displayed with one single encoding setting. </p>', '', 1, 3, 0, 31, '2008-08-05 01:11:29', 62, '', '2008-08-05 01:11:29', 62, 0, '0000-00-00 00:00:00', '2006-10-03 10:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 8, 0, 8, '', '', 0, 29, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(13, 'What happened to the locale setting?', 'what-happened-to-the-locale-setting', '', 'This is now defined in the Language [<em>lang</em>].xml file in the Language metadata settings. If you are having locale problems such as dates do not appear in your language for example, you might want to check/edit the entries in the locale tag. Note that multiple locale strings can be set and the host will usually accept the first one recognised.', '', 1, 3, 0, 28, '2008-08-06 16:47:35', 62, '', '2008-08-06 16:47:35', 62, 0, '0000-00-00 00:00:00', '2006-10-05 14:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 7, 0, 2, '', '', 0, 11, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(14, 'What is the FTP layer for?', 'what-is-the-ftp-layer-for', '', '<p>The FTP Layer allows file operations (such as installing Extensions or updating the main configuration file) without having to make all the folders and files writable. This has been an issue on Linux and other Unix based platforms in respect of file permissions. This makes the site admin''s life a lot easier and increases security of the site.</p><p>You can check the write status of relevent folders by going to ''''Help-&gt;System Info" and then in the sub-menu to "Directory Permissions". With the FTP Layer enabled even if all directories are red, Joomla! will operate smoothly.</p><p>NOTE: the FTP layer is not required on a Windows host/server. </p>', '', 1, 3, 0, 31, '2008-08-06 21:27:49', 62, '', '2008-08-06 21:27:49', 62, 0, '0000-00-00 00:00:00', '2006-10-05 16:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=', 6, 0, 6, '', '', 0, 23, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(15, 'Can Joomla! 1.5 operate with PHP Safe Mode On?', 'can-joomla-15-operate-with-php-safe-mode-on', '', '<p>Yes it can! This is a significant security improvement.</p><p>The <em>safe mode</em> limits PHP to be able to perform actions only on files/folders who''s owner is the same as PHP is currently using (this is usually ''apache''). As files normally are created either by the Joomla! application or by FTP access, the combination of PHP file actions and the FTP Layer allows Joomla! to operate in PHP Safe Mode.</p>', '', 1, 3, 0, 31, '2008-08-06 19:28:35', 62, '', '2008-08-06 19:28:35', 62, 0, '0000-00-00 00:00:00', '2006-10-05 14:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 7, 0, 4, '', '', 0, 8, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(16, 'Only one edit window! How do I create "Read more..."?', 'only-one-edit-window-how-do-i-create-read-more', '', '<p>This is now implemented by inserting a <strong>Read more...</strong> tag (the button is located below the editor area) a dotted line appears in the edited text showing the split location for the <em>Read more....</em> A new Plugin takes care of the rest.</p><p>It is worth mentioning that this does not have a negative effect on migrated data from older sites. The new implementation is fully backward compatible.</p>', '', 0, 3, 0, 28, '2008-08-06 19:29:28', 62, '', '2008-08-06 19:29:28', 62, 0, '0000-00-00 00:00:00', '2006-10-05 14:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 7, 0, 4, '', '', 0, 20, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(17, 'My MySQL database does not support UTF-8. Do I have a problem?', 'my-mysql-database-does-not-support-utf-8-do-i-have-a-problem', '', 'No you don''t. Versions of MySQL lower than 4.1 do not have built in UTF-8 support. However, Joomla! 1.5 has made provisions for backward compatibility and is able to use UTF-8 on older databases. Let the installer take care of all the settings and there is no need to make any changes to the database (charset, collation, or any other).', '', 1, 3, 0, 31, '2008-08-07 09:30:37', 62, '', '2008-08-07 09:30:37', 62, 0, '0000-00-00 00:00:00', '2006-10-05 20:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 10, 0, 7, '', '', 0, 9, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(18, 'Joomla! Features', 'joomla-features', '', '<h4><font color="#ff6600">Joomla! features:</font></h4> <ul><li>Completely database driven site engines </li><li>News, products, or services sections fully editable and manageable</li><li>Topics sections can be added to by contributing Authors </li><li>Fully customisable layouts including <em>left</em>, <em>center</em>, and <em>right </em>Menu boxes </li><li>Browser upload of images to your own library for use anywhere in the site </li><li>Dynamic Forum/Poll/Voting booth for on-the-spot results </li><li>Runs on Linux, FreeBSD, MacOSX server, Solaris, and AIX', '  </li></ul> <h4>Extensive Administration:</h4> <ul><li>Change order of objects including news, FAQs, Articles etc. </li><li>Random Newsflash generator </li><li>Remote Author submission Module for News, Articles, FAQs, and Links </li><li>Object hierarchy - as many Sections, departments, divisions, and pages as you want </li><li>Image library - store all your PNGs, PDFs, DOCs, XLSs, GIFs, and JPEGs online for easy use </li><li>Automatic Path-Finder. Place a picture and let Joomla! fix the link </li><li>News Feed Manager. Easily integrate news feeds into your Web site.</li><li>E-mail a friend and Print format available for every story and Article </li><li>In-line Text editor similar to any basic word processor software </li><li>User editable look and feel </li><li>Polls/Surveys - Now put a different one on each page </li><li>Custom Page Modules. Download custom page Modules to spice up your site </li><li>Template Manager. Download Templates and implement them in seconds </li><li>Layout preview. See how it looks before going live </li><li>Banner Manager. Make money out of your site.</li></ul>', 1, 4, 0, 29, '2008-08-08 23:32:45', 62, '', '2008-08-08 23:32:45', 62, 0, '0000-00-00 00:00:00', '2006-10-07 06:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 11, 0, 4, '', '', 0, 59, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(19, 'Joomla! Overview', 'joomla-overview', '', '<p>If you''re new to Web publishing systems, you''ll find that Joomla! delivers sophisticated solutions to your online needs. It can deliver a robust enterprise-level Web site, empowered by endless extensibility for your bespoke publishing needs. Moreover, it is often the system of choice for small business or home users who want a professional looking site that''s simple to deploy and use. <em>We do content right</em>.<br /> </p><p>So what''s the catch? How much does this system cost?</p><p> Well, there''s good news ... and more good news! Joomla! 1.5 is free, it is released under an Open Source license - the GNU/General Public License v 2.0. Had you invested in a mainstream, commercial alternative, there''d be nothing but moths left in your wallet and to add new functionality would probably mean taking out a second mortgage each time you wanted something adding!</p><p>Joomla! changes all that ... <br />Joomla! is different from the normal models for content management software. For a start, it''s not complicated. Joomla! has been developed for everybody, and anybody can develop it further. It is designed to work (primarily) with other Open Source, free, software such as PHP, MySQL, and Apache. </p><p>It is easy to install and administer, and is reliable. </p><p>Joomla! doesn''t even require the user or administrator of the system to know HTML to operate it once it''s up and running.</p><p>To get the perfect Web site with all the functionality that you require for your particular application may take additional time and effort, but with the Joomla! Community support that is available and the many Third Party Developers actively creating and releasing new Extensions for the 1.5 platform on an almost daily basis, there is likely to be something out there to meet your needs. Or you could develop your own Extensions and make these available to the rest of the community. </p>', '', 1, 4, 0, 29, '2008-08-09 07:49:20', 62, '', '2008-08-09 07:49:20', 62, 0, '0000-00-00 00:00:00', '2006-10-07 10:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 13, 0, 2, '', '', 0, 152, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(20, 'Support and Documentation', 'support-and-documentation', '', '<h1>Support </h1><p>Support for the Joomla! CMS can be found on several places. The best place to start would be the <a href="http://docs.joomla.org/" target="_blank" title="Joomla! Official Documentation Wiki">Joomla! Official Documentation Wiki</a>. Here you can help yourself to the information that is regularly published and updated as Joomla! develops. There is much more to come too!</p> <p>Of course you should not forget the Help System of the CMS itself. On the <em>topmenu </em>in the Back-end Control panel you find the Help button which will provide you with lots of explanation on features.</p> <p>Another great place would of course be the <a href="http://forum.joomla.org/" target="_blank" title="Forum">Forum</a> . On the Joomla! Forum you can find help and support from Community members as well as from Joomla! Core members and Working Group members. The forum contains a lot of information, FAQ''s, just about anything you are looking for in terms of support.</p> <p>Two other resources for Support are the <a href="http://developer.joomla.org/" target="_blank" title="Joomla! Developer Site">Joomla! Developer Site</a> and the <a href="http://extensions.joomla.org/" target="_blank" title="Joomla! Extensions Directory">Joomla! Extensions Directory</a> (JED). The Joomla! Developer Site provides lots of technical information for the experienced Developer as well as those new to Joomla! and development work in general. The JED whilst not a support site in the strictest sense has many of the Extensions that you will need as you develop your own Web site.</p> <p>The Joomla! Developers and Bug Squad members are regularly posting their blog reports about several topics such as programming techniques and security issues.</p> <h1>Documentation</h1> <p>Joomla! Documentation can of course be found on the <a href="http://docs.joomla.org/" target="_blank" title="Joomla! Official Documentation Wiki">Joomla! Official Documentation Wiki</a>. You can find information for beginners, installation, upgrade, Frequently Asked Questions, developer topics, and a lot more. The Documentation Team helps oversee the wiki but you are invited to contribute content, as well.</p> <p>There are also books written about Joomla! You can find a listing of these books in the <a href="http://shop.joomla.org/" target="_blank" title="Joomla! Shop">Joomla! Shop</a>.</p>', '', 1, 4, 0, 25, '2008-08-09 08:33:57', 62, '', '2008-08-09 08:33:57', 62, 0, '0000-00-00 00:00:00', '2006-10-07 10:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 13, 0, 3, '', '', 0, 6, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(21, 'Joomla! Facts', 'joomla-facts', '', '<p>Here are some interesting facts about Joomla!</p><ul><li><span>Over 210,000 active registered Users on the <a href="http://forum.joomla.org" target="_blank" title="Joomla Forums">Official Joomla! community forum</a> and more on the many international community sites.</span><ul><li><span>over 1,000,000 posts in over 200,000 topics</span></li><li>over 1,200 posts per day</li><li>growing at 150 new participants each day!</li></ul></li><li><span>1168 Projects on the JoomlaCode (<a href="http://joomlacode.org/" target="_blank" title="JoomlaCode">joomlacode.org</a> ). All for open source addons by third party developers.</span><ul><li><span>Well over 6,000,000 downloads of Joomla! since the migration to JoomlaCode in March 2007.<br /></span></li></ul></li><li><span>Nearly 4,000 extensions for Joomla! have been registered on the <a href="http://extensions.joomla.org" target="_blank" title="http://extensions.joomla.org">Joomla! Extension Directory</a>  </span></li><li><span>Joomla.org exceeds 2 TB of traffic per month!</span></li></ul>', '', 1, 4, 0, 30, '2008-08-09 16:46:37', 62, '', '2008-08-09 16:46:37', 62, 0, '0000-00-00 00:00:00', '2006-10-07 14:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 13, 0, 1, '', '', 0, 50, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(22, 'What''s New in 1.5?', 'whats-new-in-15', '', '<p>As with previous releases, Joomla! provides a unified and easy-to-use framework for delivering content for Web sites of all kinds. To support the changing nature of the Internet and emerging Web technologies, Joomla! required substantial restructuring of its core functionality and we also used this effort to simplify many challenges within the current user interface. Joomla! 1.5 has many new features.</p>', '<p style="margin-bottom: 0in">In Joomla! 1.5, you''ll notice: </p>    <ul><li>     <p style="margin-bottom: 0in">       Substantially improved usability, manageability, and scalability far beyond the original Mambo foundations</p>   </li><li>     <p style="margin-bottom: 0in"> Expanded accessibility to support internationalisation, double-byte characters and right-to-left support for Arabic, Farsi, and Hebrew languages among others</p>   </li><li>     <p style="margin-bottom: 0in"> Extended integration of external applications through Web services and remote authentication such as the Lightweight Directory Access Protocol (LDAP)</p>   </li><li>     <p style="margin-bottom: 0in"> Enhanced content delivery, template and presentation capabilities to support accessibility standards and content delivery to any destination</p>   </li><li>     <p style="margin-bottom: 0in">       A more sustainable and flexible framework for Component and Extension developers</p>   </li><li>     <p style="margin-bottom: 0in">Backward compatibility with previous releases of Components, Templates, Modules, and other Extensions</p></li></ul>', 1, 4, 0, 29, '2008-08-11 22:13:58', 62, '', '2008-08-11 22:13:58', 62, 0, '0000-00-00 00:00:00', '2006-10-10 18:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 10, 0, 1, '', '', 0, 98, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(23, 'Platforms and Open Standards', 'platforms-and-open-standards', '', '<p class="MsoNormal">Joomla! runs on any platform including Windows, most flavours of Linux, several Unix versions, and the Apple OS/X platform.  Joomla! depends on PHP and the MySQL database to deliver dynamic content.  </p>            <p class="MsoNormal">The minimum requirements are:</p>      <ul><li>Apache 1.x, 2.x and higher</li><li>PHP 4.3 and higher</li><li>MySQL 3.23 and higher</li></ul>It will also run on alternative server platforms such as Windows IIS - provided they support PHP and MySQL - but these require additional configuration in order for the Joomla! core package to be successful installed and operated.', '', 1, 4, 0, 25, '2008-08-11 04:22:14', 62, '', '2008-08-11 04:22:14', 62, 0, '0000-00-00 00:00:00', '2006-10-10 08:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 7, 0, 5, '', '', 0, 11, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(24, 'Content Layouts', 'content-layouts', '', '<p>Joomla! provides plenty of flexibility when displaying your Web content. Whether you are using Joomla! for a blog site, news or a Web site for a company, you''ll find one or more content styles to showcase your information. You can also change the style of content dynamically depending on your preferences. Joomla! calls how a page is laid out a <strong>layout</strong>. Use the guide below to understand which layouts are available and how you might use them. </p> <h2>Content </h2> <p>Joomla! makes it extremely easy to add and display content. All content  is placed where your mainbody tag in your template is located. There are three main types of layouts available in Joomla! and all of them can be customised via parameters. The display and parameters are set in the Menu Item used to display the content your working on. You create these layouts by creating a Menu Item and choosing how you want the content to display.</p> <h3>Blog Layout<br /> </h3> <p>Blog layout will show a listing of all Articles of the selected blog type (Section or Category) in the mainbody position of your template. It will give you the standard title, and Intro of each Article in that particular Category and/or Section. You can customise this layout via the use of the Preferences and Parameters, (See Article Parameters) this is done from the Menu not the Section Manager!</p> <h3>Blog Archive Layout<br /> </h3> <p>A Blog Archive layout will give you a similar output of Articles as the normal Blog Display but will add, at the top, two drop down lists for month and year plus a search button to allow Users to search for all Archived Articles from a specific month and year.</p> <h3>List Layout<br /> </h3> <p>Table layout will simply give you a <em>tabular </em>list<em> </em>of all the titles in that particular Section or Category. No Intro text will be displayed just the titles. You can set how many titles will be displayed in this table by Parameters. The table layout will also provide a filter Section so that Users can reorder, filter, and set how many titles are listed on a single page (up to 50)</p> <h2>Wrapper</h2> <p>Wrappers allow you to place stand alone applications and Third Party Web sites inside your Joomla! site. The content within a Wrapper appears within the primary content area defined by the "mainbody" tag and allows you to display their content as a part of your own site. A Wrapper will place an IFRAME into the content Section of your Web site and wrap your standard template navigation around it so it appears in the same way an Article would.</p> <h2>Content Parameters</h2> <p>The parameters for each layout type can be found on the right hand side of the editor boxes in the Menu Item configuration screen. The parameters available depend largely on what kind of layout you are configuring.</p>', '', 1, 4, 0, 29, '2008-08-12 22:33:10', 62, '', '2008-08-12 22:33:10', 62, 0, '0000-00-00 00:00:00', '2006-10-11 06:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 11, 0, 5, '', '', 0, 72, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(25, 'What are the requirements to run Joomla! 1.5?', 'what-are-the-requirements-to-run-joomla-15', '', '<p>Joomla! runs on the PHP pre-processor. PHP comes in many flavours, for a lot of operating systems. Beside PHP you will need a Web server. Joomla! is optimized for the Apache Web server, but it can run on different Web servers like Microsoft IIS it just requires additional configuration of PHP and MySQL. Joomla! also depends on a database, for this currently you can only use MySQL. </p>Many people know from their own experience that it''s not easy to install an Apache Web server and it gets harder if you want to add MySQL, PHP and Perl. XAMPP, WAMP, and MAMP are easy to install distributions containing Apache, MySQL, PHP and Perl for the Windows, Mac OSX and Linux operating systems. These packages are for localhost installations on non-public servers only.<br />The minimum version requirements are:<br /><ul><li>Apache 1.x or 2.x</li><li>PHP 4.3 or up</li><li>MySQL 3.23 or up</li></ul>For the latest minimum requirements details, see <a href="http://www.joomla.org/about-joomla/technical-requirements.html" target="_blank" title="Joomla! Technical Requirements">Joomla! Technical Requirements</a>.', '', 1, 3, 0, 31, '2008-08-11 00:42:31', 62, '', '2008-08-11 00:42:31', 62, 0, '0000-00-00 00:00:00', '2006-10-10 06:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 6, 0, 5, '', '', 0, 37, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(26, 'Extensions', 'extensions', '', '<p>Out of the box, Joomla! does a great job of managing the content needed to make your Web site sing. But for many people, the true power of Joomla! lies in the application framework that makes it possible for developers all around the world to create powerful add-ons that are called <strong>Extensions</strong>. An Extension is used to add capabilities to Joomla! that do not exist in the base core code. Here are just some examples of the hundreds of available Extensions:</p> <ul>   <li>Dynamic form builders</li>   <li>Business or organisational directories</li>   <li>Document management</li>   <li>Image and multimedia galleries</li>   <li>E-commerce and shopping cart engines</li>   <li>Forums and chat software</li>   <li>Calendars</li>   <li>E-mail newsletters</li>   <li>Data collection and reporting tools</li>   <li>Banner advertising systems</li>   <li>Paid subscription services</li>   <li>and many, many, more</li> </ul> <p>You can find more examples over at our ever growing <a href="http://extensions.joomla.org" target="_blank" title="Joomla! Extensions Directory">Joomla! Extensions Directory</a>. Prepare to be amazed at the amount of exciting work produced by our active developer community!</p><p>A useful guide to the Extension site can be found at:<br /><a href="http://extensions.joomla.org/content/view/15/63/" target="_blank" title="Guide to the Joomla! Extension site">http://extensions.joomla.org/content/view/15/63/</a> </p> <h3>Types of Extensions </h3><p>There are five types of extensions:</p> <ul>   <li>Components</li>   <li>Modules</li>   <li>Templates</li>   <li>Plugins</li>   <li>Languages</li> </ul> <p>You can read more about the specifics of these using the links in the Article Index - a Table of Contents (yet another useful feature of Joomla!) - at the top right or by clicking on the <strong>Next </strong>link below.<br /> </p> <hr title="Components" class="system-pagebreak" /> <h3><img src="images/stories/ext_com.png" border="0" alt="Component - Joomla! Extension Directory" title="Component - Joomla! Extension Directory" width="17" height="17" /> Components</h3> <p>A Component is the largest and most complex of the Extension types.  Components are like mini-applications that render the main body of the  page. An analogy that might make the relationship easier to understand  would be that Joomla! is a book and all the Components are chapters in  the book. The core Article Component (<font face="courier new,courier">com_content</font>), for example, is the  mini-application that handles all core Article rendering just as the  core registration Component (<font face="courier new,courier">com_user</font>) is the mini-application  that handles User registration.</p> <p>Many of Joomla!''s core features are provided by the use of default Components such as:</p> <ul>   <li>Contacts</li>   <li>Front Page</li>   <li>News Feeds</li>   <li>Banners</li>   <li>Mass Mail</li>   <li>Polls</li></ul><p>A Component will manage data, set displays, provide functions, and in general can perform any operation that does not fall under the general functions of the core code.</p> <p>Components work hand in hand with Modules and Plugins to provide a rich variety of content display and functionality aside from the standard Article and content display. They make it possible to completely transform Joomla! and greatly expand its capabilities.</p>  <hr title="Modules" class="system-pagebreak" /> <h3><img src="images/stories/ext_mod.png" border="0" alt="Module - Joomla! Extension Directory" title="Module - Joomla! Extension Directory" width="17" height="17" /> Modules</h3> <p>A more lightweight and flexible Extension used for page rendering is a Module. Modules are used for small bits of the page that are generally  less complex and able to be seen across different Components. To  continue in our book analogy, a Module can be looked at as a footnote  or header block, or perhaps an image/caption block that can be rendered  on a particular page. Obviously you can have a footnote on any page but  not all pages will have them. Footnotes also might appear regardless of  which chapter you are reading. Simlarly Modules can be rendered  regardless of which Component you have loaded.</p> <p>Modules are like little mini-applets that can be placed anywhere on your site. They work in conjunction with Components in some cases and in others are complete stand alone snippets of code used to display some data from the database such as Articles (Newsflash) Modules are usually used to output data but they can also be interactive form items to input data for example the Login Module or Polls.</p> <p>Modules can be assigned to Module positions which are defined in your Template and in the back-end using the Module Manager and editing the Module Position settings. For example, "left" and "right" are common for a 3 column layout. </p> <h4>Displaying Modules</h4> <p>Each Module is assigned to a Module position on your site. If you wish it to display in two different locations you must copy the Module and assign the copy to display at the new location. You can also set which Menu Items (and thus pages) a Module will display on, you can select all Menu Items or you can pick and choose by holding down the control key and selecting multiple locations one by one in the Modules [Edit] screen</p> <p>Note: Your Main Menu is a Module! When you create a new Menu in the Menu Manager you are actually copying the Main Menu Module (<font face="courier new,courier">mod_mainmenu</font>) code and giving it the name of your new Menu. When you copy a Module you do not copy all of its parameters, you simply allow Joomla! to use the same code with two separate settings.</p> <h4>Newsflash Example</h4> <p>Newsflash is a Module which will display Articles from your site in an assignable Module position. It can be used and configured to display one Category, all Categories, or to randomly choose Articles to highlight to Users. It will display as much of an Article as you set, and will show a <em>Read more...</em> link to take the User to the full Article.</p> <p>The Newsflash Component is particularly useful for things like Site News or to show the latest Article added to your Web site.</p>  <hr title="Plugins" class="system-pagebreak" /> <h3><img src="images/stories/ext_plugin.png" border="0" alt="Plugin - Joomla! Extension Directory" title="Plugin - Joomla! Extension Directory" width="17" height="17" /> Plugins</h3> <p>One  of the more advanced Extensions for Joomla! is the Plugin. In previous  versions of Joomla! Plugins were known as Mambots. Aside from changing their name their  functionality has been expanded. A Plugin is a section of code that  runs when a pre-defined event happens within Joomla!. Editors are Plugins, for example, that execute when the Joomla! event <font face="courier new,courier">onGetEditorArea</font> occurs. Using a Plugin allows a developer to change  the way their code behaves depending upon which Plugins are installed  to react to an event.</p>  <hr title="Languages" class="system-pagebreak" /> <h3><img src="images/stories/ext_lang.png" border="0" alt="Language - Joomla! Extensions Directory" title="Language - Joomla! Extensions Directory" width="17" height="17" /> Languages</h3> <p>New  to Joomla! 1.5 and perhaps the most basic and critical Extension is a Language. Joomla! is released with multiple Installation Languages but the base Site and Administrator are packaged in just the one Language <strong>en-GB</strong> - being English with GB spelling for example. To include all the translations currently available would bloat the core package and make it unmanageable for uploading purposes. The Language files enable all the User interfaces both Front-end and Back-end to be presented in the local preferred language. Note these packs do not have any impact on the actual content such as Articles. </p> <p>More information on languages is available from the <br />   <a href="http://community.joomla.org/translations.html" target="_blank" title="Joomla! Translation Teams">http://community.joomla.org/translations.html</a></p>', '', 1, 4, 0, 29, '2008-08-11 06:00:00', 62, '', '2008-08-11 06:00:00', 62, 0, '0000-00-00 00:00:00', '2006-10-10 22:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 24, 0, 3, 'About Joomla!, General, Extensions', '', 0, 103, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(27, 'The Joomla! Community', 'the-joomla-community', '', '<p><strong>Got a question? </strong>With more than 210,000 members, the Joomla! Discussion Forums at <a href="http://forum.joomla.org/" target="_blank" title="Forums">forum.joomla.org</a> are a great resource for both new and experienced users. Ask your toughest questions the community is waiting to see what you''ll do with your Joomla! site.</p><p><strong>Do you want to show off your new Joomla! Web site?</strong> Visit the <a href="http://forum.joomla.org/viewforum.php?f=514" target="_blank" title="Site Showcase">Site Showcase</a>Â section of our forum.</p><p><strong>Do you want to contribute?</strong></p><p>If you think working with Joomla is fun, wait until you start working on it. We''re passionate about helping Joomla users become contributors. There are many ways you can help Joomla''s development:</p><ul>	<li>Submit news about Joomla. We syndicate Joomla-related news on <a href="http://news.joomla.org" target="_blank" title="JoomlaConnect">JoomlaConnect<sup>TM</sup></a>. If you have Joomla news that you would like to share with the community, find out how to get connectedÂ <a href="http://community.joomla.org/connect.html" target="_blank" title="JoomlaConnect">here</a>.</li>	<li>Report bugs and request features in our <a href="http://joomlacode.org/gf/project/joomla/tracker/" target="_blank" title="Joomla! developement trackers">trackers</a>. Please read <a href="http://docs.joomla.org/Filing_bugs_and_issues" target="_blank" title="Reporting Bugs">Reporting Bugs</a>, for details on how we like our bug reports served up</li><li>Submit patches for new and/or fixed behaviour. Please read <a href="http://docs.joomla.org/Patch_submission_guidelines" target="_blank" title="Submitting Patches">Submitting Patches</a>, for details on how to submit a patch.</li><li>Join the <a href="http://forum.joomla.org/viewforum.php?f=509" target="_blank" title="Joomla! development forums">developer forums</a> and share your ideas for how to improve Joomla. We''re always open to suggestions, although we''re likely to be sceptical of large-scale suggestions without some code to back it up.</li><li>Join any of the <a href="http://www.joomla.org/about-joomla/the-project/working-groups.html" target="_blank" title="Joomla! working groups">Joomla Working Groups</a> and bring your personal expertise to the Joomla community.Â </li></ul><p>These are just a few ways you can contribute. SeeÂ <a href="http://www.joomla.org/about-joomla/contribute-to-joomla.html" target="_blank" title="Contribute">Contribute to Joomla</a>Â for many more ways.</p>', '', 1, 4, 0, 30, '2008-08-12 16:50:48', 62, '', '2008-08-12 16:50:48', 62, 0, '0000-00-00 00:00:00', '2006-10-11 02:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 12, 0, 2, '', '', 0, 58, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(28, 'How do I install Joomla! 1.5?', 'how-do-i-install-joomla-15', '', '<p>Installing of Joomla! 1.5 is pretty easy. We assume you have set-up your Web site, and it is accessible with your browser.<br /><br />Download Joomla! 1.5, unzip it and upload/copy the files into the directory you Web site points to, fire up your browser and enter your Web site address and the installation will start.  </p><p>For full details on the installation processes check out the <a href="http://help.joomla.org/content/category/48/268/302" target="_blank" title="Joomla! 1.5 Installation Manual">Installation Manual</a> on the <a href="http://help.joomla.org" target="_blank" title="Joomla! Help Site">Joomla! Help Site</a> where you will also find download instructions for a PDF version too. </p>', '', 1, 3, 0, 31, '2008-08-11 01:10:59', 62, '', '2008-08-11 01:10:59', 62, 0, '0000-00-00 00:00:00', '2006-10-10 06:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 5, 0, 3, '', '', 0, 5, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(29, 'What is the purpose of the collation selection in the installation screen?', 'what-is-the-purpose-of-the-collation-selection-in-the-installation-screen', '', 'The collation option determines the way ordering in the database is done. In languages that use special characters, for instance the German umlaut, the database collation determines the sorting order. If you don''t know which collation you need, select the "utf8_general_ci" as most languages use this. The other collations listed are exceptions in regards to the general collation. If your language is not listed in the list of collations it most likely means that "utf8_general_ci is suitable.', '', 1, 3, 0, 32, '2008-08-11 03:11:38', 62, '', '2008-08-11 03:11:38', 62, 0, '0000-00-00 00:00:00', '2006-10-10 08:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=', 4, 0, 4, '', '', 0, 6, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(30, 'What languages are supported by Joomla! 1.5?', 'what-languages-are-supported-by-joomla-15', '', 'Within the Installer you will find a wide collection of languages. The installer currently supports the following languages: Arabic, Bulgarian, Bengali, Czech, Danish, German, Greek, English, Spanish, Finnish, French, Hebrew, Devanagari(India), Croatian(Croatia), Magyar (Hungary), Italian, Malay, Norwegian bokmal, Dutch, Portuguese(Brasil), Portugues(Portugal), Romanian, Russian, Serbian, Svenska, Thai and more are being added all the time.<br />By default the English language is installed for the Back and Front-ends. You can download additional language files from the <a href="http://extensions.joomla.org" target="_blank" title="Joomla! Extensions Directory">Joomla!Extensions Directory</a>. ', '', 0, 3, 0, 32, '2008-08-11 01:12:18', 62, '', '2008-08-11 01:12:18', 62, 0, '0000-00-00 00:00:00', '2006-10-10 06:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 5, 0, 2, '', '', 0, 8, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(31, 'Is it useful to install the sample data?', 'is-it-useful-to-install-the-sample-data', '', 'Well you are reading it right now! This depends on what you want to achieve. If you are new to Joomla! and have no clue how it all fits together, just install the sample data. If you don''t like the English sample data because you - for instance - speak Chinese, then leave it out.', '', 1, 3, 0, 27, '2008-08-11 09:12:55', 62, '', '2008-08-11 09:12:55', 62, 0, '0000-00-00 00:00:00', '2006-10-10 10:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 6, 0, 3, '', '', 0, 3, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(32, 'Where is the Static Content Item?', 'where-is-the-static-content', '', '<p>In Joomla! versions prior to 1.5 there were separate processes for creating a Static Content Item and normal Content Items. The processes have been combined now and whilst both content types are still around they are renamed as Articles for Content Items and Uncategorized Articles for Static Content Items. </p><p>If you want to create a static item, create a new Article in the same way as for standard content and rather than relating this to a particular Section and Category just select <span style="font-style: italic">Uncategorized</span> as the option in the Section and Category drop down lists.</p>', '', 1, 3, 0, 28, '2008-08-10 23:13:33', 62, '', '2008-08-10 23:13:33', 62, 0, '0000-00-00 00:00:00', '2006-10-10 04:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 6, 0, 6, '', '', 0, 5, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(33, 'What is an Uncategorised Article?', 'what-is-uncategorised-article', '', 'Most Articles will be assigned to a Section and Category. In many cases, you might not know where you want it to appear so put the Article in the <em>Uncategorized </em>Section/Category. The Articles marked as <em>Uncategorized </em>are handled as static content.', '', 1, 3, 0, 31, '2008-08-11 15:14:11', 62, '', '2008-08-11 15:14:11', 62, 0, '0000-00-00 00:00:00', '2006-10-10 12:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 8, 0, 2, '', '', 0, 6, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(34, 'Does the PDF icon render pictures and special characters?', 'does-the-pdf-icon-render-pictures-and-special-characters', '', 'Yes! Prior to Joomla! 1.5, only the text values of an Article and only for ISO-8859-1 encoding was allowed in the PDF rendition. With the new PDF library in place, the complete Article including images is rendered and applied to the PDF. The PDF generator also handles the UTF-8 texts and can handle any character sets from any language. The appropriate fonts must be installed but this is done automatically during a language pack installation.', '', 1, 3, 0, 32, '2008-08-11 17:14:57', 62, '', '2008-08-11 17:14:57', 62, 0, '0000-00-00 00:00:00', '2006-10-10 14:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 7, 0, 3, '', '', 0, 6, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(35, 'Is it possible to change A Menu Item''s Type?', 'is-it-possible-to-change-the-types-of-menu-entries', '', '<p>You indeed can change the Menu Item''s Type to whatever you want, even after they have been created. </p><p>If, for instance, you want to change the Blog Section of a Menu link, go to the Control Panel-&gt;Menus Menu-&gt;[menuname]-&gt;Menu Item Manager and edit the Menu Item. Select the <strong>Change Type</strong> button and choose the new style of Menu Item Type from the available list. Thereafter, alter the Details and Parameters to reconfigure the display for the new selection  as you require it.</p>', '', 1, 3, 0, 31, '2008-08-10 23:15:36', 62, '', '2008-08-10 23:15:36', 62, 0, '0000-00-00 00:00:00', '2006-10-10 04:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 6, 0, 1, '', '', 0, 18, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(36, 'Where did the Installers go?', 'where-did-the-installer-go', '', 'The improved Installer can be found under the Extensions Menu. With versions prior to Joomla! 1.5 you needed to select a specific Extension type when you wanted to install it and use the Installer associated with it, with Joomla! 1.5 you just select the Extension you want to upload, and click on install. The Installer will do all the hard work for you.', '', 1, 3, 0, 28, '2008-08-10 23:16:20', 62, '', '2008-08-10 23:16:20', 62, 0, '0000-00-00 00:00:00', '2006-10-10 04:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 6, 0, 1, '', '', 0, 4, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(37, 'Where did the Mambots go?', 'where-did-the-mambots-go', '', '<p>Mambots have been renamed as Plugins. </p><p>Mambots were introduced in Mambo and offered possibilities to add plug-in logic to your site mainly for the purpose of manipulating content. In Joomla! 1.5, Plugins will now have much broader capabilities than Mambots. Plugins are able to extend functionality at the framework layer as well.</p>', '', 1, 3, 0, 28, '2008-08-11 09:17:00', 62, '', '2008-08-11 09:17:00', 62, 0, '0000-00-00 00:00:00', '2006-10-10 10:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 6, 0, 5, '', '', 0, 4, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(38, 'I installed with my own language, but the Back-end is still in English', 'i-installed-with-my-own-language-but-the-back-end-is-still-in-english', '', '<p>A lot of different languages are available for the Back-end, but by default this language may not be installed. If you want a translated Back-end, get your language pack and install it using the Extension Installer. After this, go to the Extensions Menu, select Language Manager and make your language the default one. Your Back-end will be translated immediately.</p><p>Users who have access rights to the Back-end may choose the language they prefer in their Personal Details parameters. This is of also true for the Front-end language.</p><p> A good place to find where to download your languages and localised versions of Joomla! is <a href="http://extensions.joomla.org/index.php?option=com_mtree&task=listcats&cat_id=1837&Itemid=35" target="_blank" title="Translations for Joomla!">Translations for Joomla!</a> on JED.</p>', '', 1, 3, 0, 32, '2008-08-11 17:18:14', 62, '', '2008-08-11 17:18:14', 62, 0, '0000-00-00 00:00:00', '2006-10-10 14:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 7, 0, 1, '', '', 0, 7, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(39, 'How do I remove an Article?', 'how-do-i-remove-an-article', '', '<p>To completely remove an Article, select the Articles that you want to delete and move them to the Trash. Next, open the Article Trash in the Content Menu and select the Articles you want to delete. After deleting an Article, it is no longer available as it has been deleted from the database and it is not possible to undo this operation.  </p>', '', 1, 3, 0, 27, '2008-08-11 09:19:01', 62, '', '2008-08-11 09:19:01', 62, 0, '0000-00-00 00:00:00', '2006-10-10 10:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 6, 0, 2, '', '', 0, 4, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(40, 'What is the difference between Archiving and Trashing an Article? ', 'what-is-the-difference-between-archiving-and-trashing-an-article', '', '<p>When you <em>Archive </em>an Article, the content is put into a state which removes it from your site as published content. The Article is still available from within the Control Panel and can be <em>retrieved </em>for editing or republishing purposes. Trashed Articles are just one step from being permanently deleted but are still available until you Remove them from the Trash Manager. You should use Archive if you consider an Article important, but not current. Trash should be used when you want to delete the content entirely from your site and from future search results.  </p>', '', 1, 3, 0, 27, '2008-08-11 05:19:43', 62, '', '2008-08-11 05:19:43', 62, 0, '0000-00-00 00:00:00', '2006-10-10 06:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 8, 0, 1, '', '', 0, 5, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(41, 'Newsflash 5', 'newsflash-5', '', 'Joomla! 1.5 - ''Experience the Freedom''!. It has never been easier to create your own dynamic Web site. Manage all your content from the best CMS admin interface and in virtually any language you speak.', '', 1, 1, 0, 3, '2008-08-12 00:17:31', 62, '', '2008-08-12 00:17:31', 62, 0, '0000-00-00 00:00:00', '2006-10-11 06:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 5, 0, 2, '', '', 0, 4, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(42, 'Newsflash 4', 'newsflash-4', '', 'Yesterday all servers in the U.S. went out on strike in a bid to get more RAM and better CPUs. A spokes person said that the need for better RAM was due to some fool increasing the front-side bus speed. In future, buses will be told to slow down in residential motherboards.', '', 1, 1, 0, 3, '2008-08-12 00:25:50', 62, '', '2008-08-12 00:25:50', 62, 0, '0000-00-00 00:00:00', '2006-10-11 06:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 5, 0, 1, '', '', 0, 5, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(43, 'Example Pages and Menu Links', 'example-pages-and-menu-links', '', '<p>This page is an example of content that is <em>Uncategorized</em>; that is, it does not belong to any Section or Category. You will see there is a new Menu in the left column. It shows links to the same content presented in 4 different page layouts.</p><ul><li>Section Blog</li><li>Section Table</li><li> Blog Category</li><li>Category Table</li></ul><p>Follow the links in the <strong>Example Pages</strong> Menu to see some of the options available to you to present all the different types of content included within the default installation of Joomla!.</p><p>This includes Components and individual Articles. These links or Menu Item Types (to give them their proper name) are all controlled from within the <strong><font face="courier new,courier">Menu Manager-&gt;[menuname]-&gt;Menu Items Manager</font></strong>. </p>', '', 1, 0, 0, 0, '2008-08-12 09:26:52', 62, '', '2008-08-12 09:26:52', 62, 0, '0000-00-00 00:00:00', '2006-10-11 10:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 7, 0, 4, 'Uncategorized, Uncategorized, Example Pages and Menu Links', '', 0, 44, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(44, 'Joomla! Security Strike Team', 'joomla-security-strike-team', '', '<p>The Joomla! Project has assembled a top-notch team of experts to form the new Joomla! Security Strike Team. This new team will solely focus on investigating and resolving security issues. Instead of working in relative secrecy, the JSST will have a strong public-facing presence at the <a href="http://developer.joomla.org/security.html" target="_blank" title="Joomla! Security Center">Joomla! Security Center</a>.</p>', '<p>The new JSST will call the new <a href="http://developer.joomla.org/security.html" target="_blank" title="Joomla! Security Center">Joomla! Security Center</a> their home base. The Security Center provides a public presence for <a href="http://developer.joomla.org/security/news.html" target="_blank" title="Joomla! Security News">security issues</a> and a platform for the JSST to <a href="http://developer.joomla.org/security/articles-tutorials.html" target="_blank" title="Joomla! Security Articles">help the general public better understand security</a> and how it relates to Joomla!. The Security Center also offers users a clearer understanding of how security issues are handled. There''s also a <a href="http://feeds.joomla.org/JoomlaSecurityNews" target="_blank" title="Joomla! Security News Feed">news feed</a>, which provides subscribers an up-to-the-minute notification of security issues as they arise.</p>', 0, 1, 0, 1, '2007-07-07 09:54:06', 62, '', '2007-07-07 09:54:06', 62, 0, '0000-00-00 00:00:00', '2004-07-06 22:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 1, 0, 3, '', '', 0, 0, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(45, 'Joomla! Community Portal', 'joomla-community-portal', '', '<p>The <a href="http://community.joomla.org/" target="_blank" title="Joomla! Community Portal">Joomla! Community Portal</a> is now online. There, you will find a constant source of information about the activities of contributors powering the Joomla! Project. Learn about <a href="http://community.joomla.org/events.html" target="_blank" title="Joomla! Events">Joomla! Events</a> worldwide, and see if there is a <a href="http://community.joomla.org/user-groups.html" target="_blank" title="Joomla! User Groups">Joomla! User Group</a> nearby.</p><p>The <a href="http://community.joomla.org/magazine.html" target="_blank" title="Joomla! Community Magazine">Joomla! Community Magazine</a> promises an interesting overview of feature articles, community accomplishments, learning topics, and project updates each month. Also, check out <a href="http://community.joomla.org/connect.html" target="_blank" title="JoomlaConnect">JoomlaConnect&#0153;</a>. This aggregated RSS feed brings together Joomla! news from all over the world in your language. Get the latest and greatest by clicking <a href="http://community.joomla.org/connect.html" target="_blank" title="JoomlaConnect">here</a>.</p>', '', 0, 1, 0, 1, '2007-07-07 09:54:06', 62, '', '2007-07-07 09:54:06', 62, 0, '0000-00-00 00:00:00', '2004-07-06 22:00:00', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 2, 0, 2, '', '', 0, 5, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(46, 'About TEM Resources', 'about-tem-resources', '', '<p>TEM Resources gives you everything you need to learn about TEM providers.</p>', '', 1, 4, 0, 25, '2010-11-06 14:01:10', 62, '', '2010-11-08 02:23:10', 62, 0, '0000-00-00 00:00:00', '2010-11-06 14:01:10', '0000-00-00 00:00:00', '', '', 'show_title=0\nlink_titles=0\nshow_intro=0\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_vote=0\nshow_author=0\nshow_create_date=0\nshow_modify_date=0\nshow_pdf_icon=0\nshow_print_icon=0\nshow_email_icon=0\nlanguage=\nkeyref=\nreadmore=', 2, 0, 2, '', '', 0, 18, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(47, 'List of TEM Providers', 'list-of-tem-providers', '', '<p>Rivermine</p>\r\n<p>Tangoe</p>\r\n<p>Asentinel</p>\r\n<p>HCL</p>\r\n<p>Profitline</p>\r\n<p>Anchor Point</p>\r\n<p>Invoice Insight</p>', '', 1, 4, 0, 25, '2010-11-07 16:53:17', 62, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2010-11-07 16:53:17', '0000-00-00 00:00:00', '', '', 'show_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_vote=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nlanguage=\nkeyref=\nreadmore=', 1, 0, 1, '', '', 0, 7, 'robots=\nauthor=');
INSERT INTO `jos_content` VALUES(48, 'Welcome to TEM Resources', 'welcome-to-tem-resources', '', '<p>TEM Resources is the first portal on the Internet dedicated to the Telecom Expense Management industry.  The portal will assist you in implementing a TEM initiative, provide value TEM tools, and provide you a place to network with other TEM professionals.</p>\r\n<p>Telecom Expensive Management can be a very complex solution to implement.  In some cases, you can do part of it with a bunch of people and some spreadsheets.  In others, you need to automate a lot of the process because of the size and complexity of the process.  Trying to figuring out the right balance of humans and computers can be challenging at times.</p>\r\n<p>The good and bad news is that there are a huge number of solutions out there in the market.  Good because you have a lot of solutions to choose from with varying capabilities. Bad because it can be hard to widdle the market down to the one that will meet your needs.  Sometimes you can''t get to one vendor.  Sometimes you might want one vendor to process your invoices, but you need another vendor to negotiate your contracts.</p>', '', 1, 0, 0, 0, '2010-11-08 02:03:33', 62, '', '2010-11-08 14:59:17', 62, 0, '0000-00-00 00:00:00', '2010-11-08 02:03:33', '0000-00-00 00:00:00', '', '', 'show_title=0\nlink_titles=0\nshow_intro=0\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_vote=0\nshow_author=0\nshow_create_date=0\nshow_modify_date=0\nshow_pdf_icon=0\nshow_print_icon=0\nshow_email_icon=0\nlanguage=\nkeyref=\nreadmore=', 6, 0, 3, '', '', 0, 0, 'robots=\nauthor=');

-- --------------------------------------------------------

--
-- Table structure for table `jos_content_frontpage`
--

CREATE TABLE `jos_content_frontpage` (
  `content_id` int(11) NOT NULL default '0',
  `ordering` int(11) NOT NULL default '0',
  PRIMARY KEY  (`content_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_content_frontpage`
--

INSERT INTO `jos_content_frontpage` VALUES(45, 3);
INSERT INTO `jos_content_frontpage` VALUES(6, 2);
INSERT INTO `jos_content_frontpage` VALUES(44, 4);
INSERT INTO `jos_content_frontpage` VALUES(5, 5);
INSERT INTO `jos_content_frontpage` VALUES(9, 6);
INSERT INTO `jos_content_frontpage` VALUES(30, 7);
INSERT INTO `jos_content_frontpage` VALUES(16, 8);
INSERT INTO `jos_content_frontpage` VALUES(48, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jos_content_rating`
--

CREATE TABLE `jos_content_rating` (
  `content_id` int(11) NOT NULL default '0',
  `rating_sum` int(11) unsigned NOT NULL default '0',
  `rating_count` int(11) unsigned NOT NULL default '0',
  `lastip` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`content_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_content_rating`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_core_acl_aro`
--

CREATE TABLE `jos_core_acl_aro` (
  `id` int(11) NOT NULL auto_increment,
  `section_value` varchar(240) NOT NULL default '0',
  `value` varchar(240) NOT NULL default '',
  `order_value` int(11) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `hidden` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `jos_section_value_value_aro` (`section_value`(100),`value`(100)),
  KEY `jos_gacl_hidden_aro` (`hidden`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `jos_core_acl_aro`
--

INSERT INTO `jos_core_acl_aro` VALUES(10, 'users', '62', 0, 'Administrator', 0);
INSERT INTO `jos_core_acl_aro` VALUES(11, 'users', '63', 0, 'Kevin Dunetz', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_core_acl_aro_groups`
--

CREATE TABLE `jos_core_acl_aro_groups` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `lft` int(11) NOT NULL default '0',
  `rgt` int(11) NOT NULL default '0',
  `value` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `jos_gacl_parent_id_aro_groups` (`parent_id`),
  KEY `jos_gacl_lft_rgt_aro_groups` (`lft`,`rgt`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `jos_core_acl_aro_groups`
--

INSERT INTO `jos_core_acl_aro_groups` VALUES(17, 0, 'ROOT', 1, 22, 'ROOT');
INSERT INTO `jos_core_acl_aro_groups` VALUES(28, 17, 'USERS', 2, 21, 'USERS');
INSERT INTO `jos_core_acl_aro_groups` VALUES(29, 28, 'Public Frontend', 3, 12, 'Public Frontend');
INSERT INTO `jos_core_acl_aro_groups` VALUES(18, 29, 'Registered', 4, 11, 'Registered');
INSERT INTO `jos_core_acl_aro_groups` VALUES(19, 18, 'Author', 5, 10, 'Author');
INSERT INTO `jos_core_acl_aro_groups` VALUES(20, 19, 'Editor', 6, 9, 'Editor');
INSERT INTO `jos_core_acl_aro_groups` VALUES(21, 20, 'Publisher', 7, 8, 'Publisher');
INSERT INTO `jos_core_acl_aro_groups` VALUES(30, 28, 'Public Backend', 13, 20, 'Public Backend');
INSERT INTO `jos_core_acl_aro_groups` VALUES(23, 30, 'Manager', 14, 19, 'Manager');
INSERT INTO `jos_core_acl_aro_groups` VALUES(24, 23, 'Administrator', 15, 18, 'Administrator');
INSERT INTO `jos_core_acl_aro_groups` VALUES(25, 24, 'Super Administrator', 16, 17, 'Super Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `jos_core_acl_aro_map`
--

CREATE TABLE `jos_core_acl_aro_map` (
  `acl_id` int(11) NOT NULL default '0',
  `section_value` varchar(230) NOT NULL default '0',
  `value` varchar(100) NOT NULL,
  PRIMARY KEY  (`acl_id`,`section_value`,`value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_core_acl_aro_map`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_core_acl_aro_sections`
--

CREATE TABLE `jos_core_acl_aro_sections` (
  `id` int(11) NOT NULL auto_increment,
  `value` varchar(230) NOT NULL default '',
  `order_value` int(11) NOT NULL default '0',
  `name` varchar(230) NOT NULL default '',
  `hidden` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `jos_gacl_value_aro_sections` (`value`),
  KEY `jos_gacl_hidden_aro_sections` (`hidden`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `jos_core_acl_aro_sections`
--

INSERT INTO `jos_core_acl_aro_sections` VALUES(10, 'users', 1, 'Users', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_core_acl_groups_aro_map`
--

CREATE TABLE `jos_core_acl_groups_aro_map` (
  `group_id` int(11) NOT NULL default '0',
  `section_value` varchar(240) NOT NULL default '',
  `aro_id` int(11) NOT NULL default '0',
  UNIQUE KEY `group_id_aro_id_groups_aro_map` (`group_id`,`section_value`,`aro_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_core_acl_groups_aro_map`
--

INSERT INTO `jos_core_acl_groups_aro_map` VALUES(19, '', 11);
INSERT INTO `jos_core_acl_groups_aro_map` VALUES(25, '', 10);

-- --------------------------------------------------------

--
-- Table structure for table `jos_core_log_items`
--

CREATE TABLE `jos_core_log_items` (
  `time_stamp` date NOT NULL default '0000-00-00',
  `item_table` varchar(50) NOT NULL default '',
  `item_id` int(11) unsigned NOT NULL default '0',
  `hits` int(11) unsigned NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_core_log_items`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_core_log_searches`
--

CREATE TABLE `jos_core_log_searches` (
  `search_term` varchar(128) NOT NULL default '',
  `hits` int(11) unsigned NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_core_log_searches`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_groups`
--

CREATE TABLE `jos_groups` (
  `id` tinyint(3) unsigned NOT NULL default '0',
  `name` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_groups`
--

INSERT INTO `jos_groups` VALUES(0, 'Public');
INSERT INTO `jos_groups` VALUES(1, 'Registered');
INSERT INTO `jos_groups` VALUES(2, 'Special');

-- --------------------------------------------------------

--
-- Table structure for table `jos_jl_jobposting`
--

CREATE TABLE `jos_jl_jobposting` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `jobtype` tinyint(1) unsigned NOT NULL default '0',
  `jobstatus` tinyint(3) NOT NULL default '1',
  `description` text NOT NULL,
  `qualifications` text NOT NULL,
  `compensation` text NOT NULL,
  `showcomp` tinyint(1) unsigned NOT NULL default '0',
  `applyinfo` text NOT NULL,
  `company` varchar(255) NOT NULL default '',
  `address1` varchar(255) NOT NULL default '',
  `address2` varchar(255) NOT NULL default '',
  `city` varchar(255) NOT NULL default '',
  `usstate` varchar(10) NOT NULL default '',
  `zipcode` varchar(10) NOT NULL default '',
  `companyurl` varchar(255) NOT NULL default '',
  `contactname` varchar(255) NOT NULL default '',
  `contactphone` varchar(255) NOT NULL default '',
  `contactemail` varchar(255) NOT NULL default '',
  `showcontact` tinyint(1) unsigned NOT NULL default '0',
  `memberid` varchar(255) NOT NULL default '',
  `creditcardtype` tinyint(1) unsigned NOT NULL default '0',
  `creditcardnumber` varchar(255) NOT NULL default '',
  `creditcardexpmon` tinyint(1) unsigned NOT NULL default '0',
  `creditcardexpyear` int(11) unsigned NOT NULL default '0',
  `reference` varchar(255) NOT NULL default '',
  `location` varchar(255) NOT NULL default '',
  `duration` varchar(255) NOT NULL default '',
  `attribs` text NOT NULL,
  `state` tinyint(3) NOT NULL default '0',
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL default '0',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL default '0',
  `checked_out` tinyint(4) NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `hits` int(11) unsigned NOT NULL default '0',
  `version` int(11) unsigned NOT NULL default '1',
  `access` int(11) unsigned NOT NULL default '0',
  `ordering` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `jos_jl_jobposting`
--

INSERT INTO `jos_jl_jobposting` VALUES(1, 'Telecom Auditor Needed', 0, 1, '', '', '', 0, '', '', '', '', '', 'AK', '', 'http://', '', '', '', 0, '', 0, '', 0, 0, '', 'New York ', '', 'Start_Date=\nNumber_of_Openings=\nPopulation=\nHighest_finished_education=\n', 1, '2010-11-11 06:55:51', 63, '2010-11-11 06:56:43', 62, 0, '0000-00-00 00:00:00', 0, 2, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jos_joobb_attachments`
--

CREATE TABLE `jos_joobb_attachments` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jos_joobb_attachments`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_joobb_categories`
--

CREATE TABLE `jos_joobb_categories` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `published` tinyint(1) NOT NULL default '1',
  `ordering` int(11) NOT NULL default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `ordering` (`ordering`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `jos_joobb_categories`
--

INSERT INTO `jos_joobb_categories` VALUES(1, 'Test Category', 1, 1, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `jos_joobb_configs`
--

CREATE TABLE `jos_joobb_configs` (
  `id` int(11) NOT NULL auto_increment,
  `template` varchar(255) NOT NULL default '',
  `theme` varchar(255) NOT NULL default '',
  `emotion_set` varchar(255) NOT NULL default '',
  `icon_set` varchar(255) NOT NULL default '',
  `editor` varchar(255) NOT NULL default '',
  `topic_icon_function` varchar(255) NOT NULL default '',
  `post_icon_function` varchar(255) NOT NULL default '',
  `board_settings` text NOT NULL,
  `latestpost_settings` text NOT NULL,
  `feed_settings` text NOT NULL,
  `view_settings` text NOT NULL,
  `user_settings_defaults` text NOT NULL,
  `attachment_settings` text NOT NULL,
  `captcha_settings` text NOT NULL,
  `parse_settings` text NOT NULL,
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `jos_joobb_configs`
--

INSERT INTO `jos_joobb_configs` VALUES(1, 'joobb.xml', 'joobb_black.xml', 'joobb_yellow.xml', 'joobb.xml', 'joobb', 'postPost', 'postPost', 'board_name=Joo!BB - Joomla Bulletin Board\nbreadcrumb_index=Board Index\ndescription=Joo!BB - Joomla! Bulletin Board\nkeywords=Joo!BB, Joomla! Bulletin Board\npublished=1\nflood_interval=30\ntopics_per_page=10\nposts_per_page=10\nsearch_results_per_page=10\nitems_per_page=10\nbreadcrumb_max_length=50\nguest_time=30\nlatest_items_count=5\nlatest_items_type=0\nenable_bbcode=1\nenable_emotions=1\nauto_subscription=0\nenable_guest_name=1\nguest_name_required=1\nlatest_members_count=3', 'enable_filter=1\nlatest_post_hours=8,12\nlatest_post_days=1,2,3\nlatest_post_weeks=1\nlatest_post_months=1,6\nlatest_post_years=1', 'enable_feeds=1\nfeed_items_count=10\nfeed_items_type=0\nfeed_desc_trunk_size=0\nfeed_desc_html_syndicate=0\nfeed_image_title=Joo!BB Logo\nfeed_image_url=http://www.joobb.org/images/logo.png\nfeed_image_link=http://www.joobb.org/\nfeed_image_description=This feed is provided by joobb.org. Please click to visit.\nfeed_image_desc_trunk_size=0\nfeed_image_desc_html_syndicate=0', 'show_latestitems=1\nshow_statistic=1\nshow_whosonline=1\nshow_legend=1\nshow_footer=1', 'role=1\nenable_bbcode=1\nenable_emotions=1\nauto_subscription=0', 'enable_attachments=1\nattachment_max=3\nattachment_max_file_size=512000\nattachment_file_types=jpg,png,gif,bmp,zip\nattachment_path=media/joobb/attachments', 'captcha_edittopic=0\ncaptcha_deletetopic=0\ncaptcha_editpost=0\ncaptcha_deletepost=0', 'enable_line_numbers=0\nlink_target=_blank\nimage_max_width=500\nimage_max_height=375\nyoutube_width=425\nyoutube_height=344\nyoutube_allow_fullscreen=1\ngvideo_width=425\ngvideo_height=344', 62, '2010-11-08 04:30:56');

-- --------------------------------------------------------

--
-- Table structure for table `jos_joobb_forums`
--

CREATE TABLE `jos_joobb_forums` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL default '1',
  `locked` tinyint(1) NOT NULL default '0',
  `ordering` int(11) NOT NULL default '1',
  `new_posts_time` int(5) NOT NULL default '0',
  `posts` int(11) NOT NULL default '0',
  `topics` int(11) NOT NULL default '0',
  `auth_view` int(3) NOT NULL default '0',
  `auth_read` int(3) NOT NULL default '0',
  `auth_post` int(3) NOT NULL default '0',
  `auth_post_all` int(3) NOT NULL default '0',
  `auth_reply` int(3) NOT NULL default '0',
  `auth_reply_all` int(3) NOT NULL default '0',
  `auth_edit` int(3) NOT NULL default '0',
  `auth_edit_all` int(3) NOT NULL default '0',
  `auth_delete` int(3) NOT NULL default '0',
  `auth_delete_all` int(3) NOT NULL default '0',
  `auth_move` int(3) NOT NULL default '0',
  `auth_reportpost` int(3) NOT NULL default '0',
  `auth_sticky` int(3) NOT NULL default '0',
  `auth_lock` int(3) NOT NULL default '0',
  `auth_lock_all` int(3) NOT NULL default '0',
  `auth_announce` int(3) NOT NULL default '0',
  `auth_attachments` int(3) NOT NULL default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `id_cat` int(11) NOT NULL default '0',
  `id_last_post` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `id_cat` (`id_cat`),
  KEY `id_last_post` (`id_last_post`),
  KEY `ordering` (`ordering`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `jos_joobb_forums`
--

INSERT INTO `jos_joobb_forums` VALUES(1, 'Test Forum', 'Test Forum', 1, 0, 1, 30, 4, 3, 0, 0, 1, 4, 1, 4, 1, 4, 1, 4, 3, 1, 3, 3, 4, 3, 1, 0, '0000-00-00 00:00:00', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `jos_joobb_forums_auth`
--

CREATE TABLE `jos_joobb_forums_auth` (
  `id_forum` int(11) NOT NULL default '0',
  `id_user` int(11) NOT NULL default '0',
  `role` tinyint(1) NOT NULL default '0',
  `id_group` int(11) NOT NULL default '0',
  KEY `id_forum` (`id_forum`),
  KEY `id_group` (`id_group`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_joobb_forums_auth`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_joobb_groups`
--

CREATE TABLE `jos_joobb_groups` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `description` text NOT NULL,
  `published` tinyint(1) NOT NULL default '1',
  `role` tinyint(1) NOT NULL default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `jos_joobb_groups`
--

INSERT INTO `jos_joobb_groups` VALUES(1, 'Admins (Main Role)', 'Forum Admins', 1, 4, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joobb_groups` VALUES(2, 'Moderators (Main Role)', 'Forum Moderators', 1, 3, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joobb_groups` VALUES(3, 'Private (Main Role)', 'Forum Private Access', 1, 2, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joobb_groups` VALUES(4, 'Users (Main Role)', 'Forum Users', 1, 1, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `jos_joobb_groups_users`
--

CREATE TABLE `jos_joobb_groups_users` (
  `id_group` int(11) NOT NULL default '0',
  `id_user` int(11) NOT NULL default '0',
  KEY `id_group` (`id_group`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_joobb_groups_users`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_joobb_posts`
--

CREATE TABLE `jos_joobb_posts` (
  `id` int(11) NOT NULL auto_increment,
  `subject` varchar(255) NOT NULL default '',
  `text` text NOT NULL,
  `date_post` datetime NOT NULL default '0000-00-00 00:00:00',
  `date_last_edit` datetime NOT NULL default '0000-00-00 00:00:00',
  `id_user_last_edit` int(11) NOT NULL default '0',
  `enable_bbcode` tinyint(1) NOT NULL default '1',
  `enable_emotions` tinyint(1) NOT NULL default '1',
  `ip_poster` varchar(15) NOT NULL default '',
  `icon_function` varchar(255) NOT NULL default '',
  `id_topic` int(11) NOT NULL default '0',
  `id_forum` int(11) NOT NULL default '0',
  `id_user` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `id_forum` (`id_forum`),
  KEY `id_user` (`id_user`),
  KEY `id_topic` (`id_topic`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `jos_joobb_posts`
--

INSERT INTO `jos_joobb_posts` VALUES(1, 'Welcome to Joo!BB', '[b]Welcome to Joo!BB[/b] :)', '2007-08-13 22:00:00', '0000-00-00 00:00:00', 0, 1, 1, '127.0.0.1', 'postPost', 1, 1, 0);
INSERT INTO `jos_joobb_posts` VALUES(2, 'hello there', 'Testing one two three', '2010-11-08 04:32:43', '0000-00-00 00:00:00', 0, 1, 1, '24.255.116.10', 'postPost', 2, 1, 63);
INSERT INTO `jos_joobb_posts` VALUES(3, 'Yeah', 'This is working', '2010-11-11 13:40:51', '0000-00-00 00:00:00', 0, 1, 1, '24.255.116.10', 'postPost', 2, 1, 63);
INSERT INTO `jos_joobb_posts` VALUES(4, 'What is the best price on PRIs?', 'I am in the market for PRIs in Atlanta. I need to find the best carrier and the best price.', '2010-11-11 13:42:32', '0000-00-00 00:00:00', 0, 1, 1, '24.255.116.10', 'postPost', 3, 1, 63);

-- --------------------------------------------------------

--
-- Table structure for table `jos_joobb_posts_guests`
--

CREATE TABLE `jos_joobb_posts_guests` (
  `id_post` int(11) NOT NULL default '0',
  `guest_name` varchar(255) NOT NULL default '',
  KEY `id_post` (`id_post`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_joobb_posts_guests`
--

INSERT INTO `jos_joobb_posts_guests` VALUES(1, 'Joo!BB Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `jos_joobb_ranks`
--

CREATE TABLE `jos_joobb_ranks` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `description` text NOT NULL,
  `min_posts` int(11) NOT NULL default '0',
  `published` tinyint(1) NOT NULL default '1',
  `rank_file` varchar(255) NOT NULL default '',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `jos_joobb_ranks`
--

INSERT INTO `jos_joobb_ranks` VALUES(1, 'Joo!BB - Newie', 'Joo!BB - Newie', 0, 1, 'stars_1.png', 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joobb_ranks` VALUES(2, 'Joo!BB - User', 'Joo!BB - User', 25, 1, 'stars_2.png', 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joobb_ranks` VALUES(3, 'Joo!BB - Experienced', 'Joo!BB - Experienced', 50, 1, 'stars_3.png', 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joobb_ranks` VALUES(4, 'Joo!BB - Hero', 'Joo!BB - Hero', 100, 1, 'stars_4.png', 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joobb_ranks` VALUES(5, 'Joo!BB - Master', 'Joo!BB - Master', 200, 1, 'stars_5.png', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `jos_joobb_topics`
--

CREATE TABLE `jos_joobb_topics` (
  `id` int(11) NOT NULL auto_increment,
  `views` int(11) unsigned NOT NULL default '0',
  `replies` int(11) unsigned NOT NULL default '0',
  `status` tinyint(3) NOT NULL default '0',
  `vote` tinyint(1) NOT NULL default '0',
  `type` tinyint(3) NOT NULL default '0',
  `id_forum` int(11) NOT NULL default '0',
  `id_first_post` int(11) unsigned NOT NULL default '0',
  `id_last_post` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `type` (`type`),
  KEY `status` (`status`),
  KEY `id_forum` (`id_forum`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `jos_joobb_topics`
--

INSERT INTO `jos_joobb_topics` VALUES(1, 0, 0, 0, 0, 2, 1, 1, 1);
INSERT INTO `jos_joobb_topics` VALUES(2, 5, 1, 0, 0, 0, 1, 2, 3);
INSERT INTO `jos_joobb_topics` VALUES(3, 3, 0, 0, 0, 0, 1, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `jos_joobb_topics_subscriptions`
--

CREATE TABLE `jos_joobb_topics_subscriptions` (
  `id_topic` int(11) NOT NULL default '0',
  `id_user` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id_topic`,`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_joobb_topics_subscriptions`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_joobb_updates`
--

CREATE TABLE `jos_joobb_updates` (
  `version` varchar(100) NOT NULL default '',
  `update_file` varchar(255) NOT NULL default '',
  `date_install` datetime NOT NULL default '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_joobb_updates`
--

INSERT INTO `jos_joobb_updates` VALUES('1.0.0 Phobos RC3', 'install.joobb.sql', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jos_joobb_users`
--

CREATE TABLE `jos_joobb_users` (
  `id` int(11) NOT NULL default '0',
  `posts` mediumint(8) unsigned NOT NULL default '0',
  `role` tinyint(1) unsigned NOT NULL default '1',
  `enable_bbcode` tinyint(1) NOT NULL default '1',
  `enable_emotions` tinyint(1) NOT NULL default '1',
  `auto_subscription` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_joobb_users`
--

INSERT INTO `jos_joobb_users` VALUES(62, 0, 1, 1, 1, 0);
INSERT INTO `jos_joobb_users` VALUES(63, 3, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_joocm_avatars`
--

CREATE TABLE `jos_joocm_avatars` (
  `id` int(11) NOT NULL auto_increment,
  `avatar_file` text NOT NULL,
  `published` tinyint(1) NOT NULL default '1',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `id_user` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `jos_joocm_avatars`
--

INSERT INTO `jos_joocm_avatars` VALUES(1, 'avatar_001.jpg', 1, 0, '0000-00-00 00:00:00', 0);
INSERT INTO `jos_joocm_avatars` VALUES(2, 'avatar_002.jpg', 1, 0, '0000-00-00 00:00:00', 0);
INSERT INTO `jos_joocm_avatars` VALUES(3, 'avatar_003.jpg', 1, 0, '0000-00-00 00:00:00', 0);
INSERT INTO `jos_joocm_avatars` VALUES(4, 'avatar_004.jpg', 1, 0, '0000-00-00 00:00:00', 0);
INSERT INTO `jos_joocm_avatars` VALUES(5, 'avatar_005.jpg', 1, 0, '0000-00-00 00:00:00', 0);
INSERT INTO `jos_joocm_avatars` VALUES(6, 'avatar_006.jpg', 1, 0, '0000-00-00 00:00:00', 0);
INSERT INTO `jos_joocm_avatars` VALUES(7, 'avatar_007.jpg', 1, 0, '0000-00-00 00:00:00', 0);
INSERT INTO `jos_joocm_avatars` VALUES(8, 'avatar_008.jpg', 1, 0, '0000-00-00 00:00:00', 0);
INSERT INTO `jos_joocm_avatars` VALUES(9, 'avatar_009.jpg', 1, 0, '0000-00-00 00:00:00', 0);
INSERT INTO `jos_joocm_avatars` VALUES(10, 'avatar_010.jpg', 1, 0, '0000-00-00 00:00:00', 0);
INSERT INTO `jos_joocm_avatars` VALUES(11, 'avatar_011.jpg', 1, 0, '0000-00-00 00:00:00', 0);
INSERT INTO `jos_joocm_avatars` VALUES(12, 'avatar_012.jpg', 1, 0, '0000-00-00 00:00:00', 0);
INSERT INTO `jos_joocm_avatars` VALUES(13, 'avatar_013.jpg', 1, 0, '0000-00-00 00:00:00', 0);
INSERT INTO `jos_joocm_avatars` VALUES(14, 'avatar_014.jpg', 1, 0, '0000-00-00 00:00:00', 0);
INSERT INTO `jos_joocm_avatars` VALUES(15, 'avatar_015.jpg', 1, 0, '0000-00-00 00:00:00', 0);
INSERT INTO `jos_joocm_avatars` VALUES(16, 'avatar_016.jpg', 1, 0, '0000-00-00 00:00:00', 0);
INSERT INTO `jos_joocm_avatars` VALUES(17, 'avatar_017.jpg', 1, 0, '0000-00-00 00:00:00', 0);
INSERT INTO `jos_joocm_avatars` VALUES(18, 'avatar_018.jpg', 1, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_joocm_configs`
--

CREATE TABLE `jos_joocm_configs` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `default_config` tinyint(1) NOT NULL default '0',
  `config_settings` text NOT NULL,
  `user_settings_defaults` text NOT NULL,
  `avatar_settings` text NOT NULL,
  `captcha_settings` text NOT NULL,
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `jos_joocm_configs`
--

INSERT INTO `jos_joocm_configs` VALUES(1, 'Joo!CM Standard Configuration', 1, 'community_name=Joo!CM Community\ntime_zone=0\ntime_format=%A,  %d.%B %Y %H:%M\ndaylight_saving_time=0\nenable_avatars=1\navatar_source=1\nenable_profiles=1\nforce_edit_profile=1\nenable_terms=1\nenable_root_pathway=0\naccount_activation=1\nallow_show_users=1\nshow_user_as=0\ndescription=Joomla Community Manager\nkeywords=Joomla, Community Manager\nitems_per_page=10\nusers_main_page=5', 'show_email=0\nshow_online_state=1\ntime_zone=0\ntime_format=%A,  %d.%B %Y %H:%M', 'image_resize=1\nimage_resize_quality=100\navatars_max=3\navatar_width=100\navatar_height=100\navatar_max_file_size=8192\navatar_path=media/joocm/avatars\navatar_file_types=jpg,png,gif,bmp', 'character_set=abcdefghjkmnpqrstuvwxyz23456789\ncaptcha_login=0\ncaptcha_register=0\ncaptcha_requestlogin=0', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `jos_joocm_interfaces`
--

CREATE TABLE `jos_joocm_interfaces` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `com` varchar(255) NOT NULL default '',
  `com_icon` varchar(255) NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  `client` tinyint(1) NOT NULL default '0',
  `show_restriction` tinyint(1) NOT NULL default '0',
  `ordering` int(11) NOT NULL default '0',
  `published` tinyint(1) NOT NULL default '1',
  `system` tinyint(1) NOT NULL default '0',
  `checked_out` int(11) NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `jos_joocm_interfaces`
--

INSERT INTO `jos_joocm_interfaces` VALUES(1, 'CM_USERS', 'com_joocm', 'administrator/components/com_joocm/images/header/icon-48-joocmuser.png', '&task=joocm_user_view', 1, 0, 1, 1, 1, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joocm_interfaces` VALUES(2, 'CM_CONFIG', 'com_joocm', 'administrator/components/com_joocm/images/header/icon-48-config.png', '&task=joocm_config_view', 1, 0, 2, 1, 1, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joocm_interfaces` VALUES(3, 'CM_PROFILEFIELDS', 'com_joocm', 'administrator/components/com_joocm/images/header/icon-48-profilefield.png', '&task=joocm_profilefield_view', 1, 0, 3, 1, 1, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joocm_interfaces` VALUES(4, 'CM_AVATARS', 'com_joocm', 'administrator/components/com_joocm/images/header/icon-48-avatar.png', '&task=joocm_avatar_view', 1, 0, 4, 1, 1, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joocm_interfaces` VALUES(5, 'CM_TIMEFORMATS', 'com_joocm', 'administrator/components/com_joocm/images/header/icon-48-timeformat.png', '&task=joocm_timeformat_view', 1, 0, 5, 1, 1, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joocm_interfaces` VALUES(6, 'CM_TERMS', 'com_joocm', 'administrator/components/com_joocm/images/header/icon-48-terms.png', '&task=joocm_terms_view', 1, 0, 6, 1, 1, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joocm_interfaces` VALUES(7, 'CM_INTERFACES', 'com_joocm', 'administrator/components/com_joocm/images/header/icon-48-interface.png', '&task=joocm_interface_view', 1, 0, 7, 1, 1, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joocm_interfaces` VALUES(8, 'CM_LINKS', 'com_joocm', 'administrator/components/com_joocm/images/header/icon-48-link.png', '&task=joocm_link_view', 1, 0, 8, 1, 1, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joocm_interfaces` VALUES(9, 'CM_TOOLS', 'com_joocm', 'administrator/components/com_joocm/images/header/icon-48-joocmtools.png', '&task=joocm_install_view', 1, 0, 9, 1, 1, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joocm_interfaces` VALUES(10, 'CM_CREDITS', 'com_joocm', 'administrator/components/com_joocm/images/header/icon-48-credits.png', '&task=joocm_credits_view', 1, 0, 10, 1, 1, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joocm_interfaces` VALUES(11, 'Joo!BB Forum', 'com_joobb', 'administrator/components/com_joobb/images/header/icon-48-joobb.png', '', 0, 0, 1, 0, 0, 62, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `jos_joocm_links`
--

CREATE TABLE `jos_joocm_links` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `com` varchar(255) NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  `function` varchar(255) NOT NULL default '',
  `replacement` text NOT NULL,
  `published` tinyint(1) NOT NULL default '1',
  `checked_out` int(11) NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `jos_joocm_links`
--

INSERT INTO `jos_joocm_links` VALUES(1, 'Joo!CM Main', 'com_joocm', '&view=main', 'main', '', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joocm_links` VALUES(2, 'Login', 'com_joocm', '&view=login', 'login', '', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joocm_links` VALUES(3, 'Edit Avatar', 'com_joocm', '&view=avatar', 'avatar', '', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joocm_links` VALUES(4, 'Register', 'com_joocm', '&view=register', 'register', '', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joocm_links` VALUES(5, 'Request Login', 'com_joocm', '&view=requestlogin', 'requestlogin', '', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joocm_links` VALUES(6, 'Logout', 'com_joocm', '&task=joocmlogout', 'logout', '', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joocm_links` VALUES(7, 'Edit Account', 'com_joocm', '&view=editaccount', 'editaccount', '', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joocm_links` VALUES(8, 'Edit Settings', 'com_joocm', '&view=editsettings', 'editsettings', '', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joocm_links` VALUES(9, 'Edit Profile', 'com_joocm', '&view=editprofile', 'editprofile', '', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joocm_links` VALUES(10, 'Profile', 'com_joocm', '&view=profile', 'profile', '', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joocm_links` VALUES(11, 'Terms', 'com_joocm', '&view=terms', 'terms', '', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joocm_links` VALUES(12, 'User List', 'com_joocm', '&view=userlist', 'userlist', '', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joocm_links` VALUES(13, 'User List Online', 'com_joocm', '&view=userlist&status=online', 'userlistonline', '', 1, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `jos_joocm_profiles`
--

CREATE TABLE `jos_joocm_profiles` (
  `id` int(11) NOT NULL default '0',
  `p_icq` varchar(15) default NULL,
  `p_aim` varchar(255) default NULL,
  `p_msnm` varchar(255) default NULL,
  `p_yim` varchar(255) default NULL,
  `p_firstname` varchar(100) default NULL,
  `p_lastname` varchar(100) default NULL,
  `p_address` text,
  `p_country` int(3) default NULL,
  `p_zipcode` varchar(25) default NULL,
  `p_town` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_joocm_profiles`
--

INSERT INTO `jos_joocm_profiles` VALUES(62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jos_joocm_profiles` VALUES(63, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jos_joocm_profiles_fields`
--

CREATE TABLE `jos_joocm_profiles_fields` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `description` text NOT NULL,
  `element` int(3) NOT NULL default '0',
  `type` varchar(255) NOT NULL default '',
  `default` varchar(255) NOT NULL default '',
  `size` int(7) unsigned NOT NULL default '0',
  `length` int(7) unsigned NOT NULL default '0',
  `rows` int(7) unsigned NOT NULL default '0',
  `columns` int(7) unsigned NOT NULL default '0',
  `published` tinyint(1) NOT NULL default '1',
  `required` tinyint(1) NOT NULL default '0',
  `disabled` tinyint(1) NOT NULL default '0',
  `ordering` int(11) NOT NULL default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `id_profile_field_list` int(11) NOT NULL default '0',
  `id_profile_field_set` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `jos_joocm_profiles_fields`
--

INSERT INTO `jos_joocm_profiles_fields` VALUES(1, 'p_icq', 'ICQ Number', 'Please enter your Icq-Number in this field.', 0, 'varchar', '', 15, 40, 0, 0, 1, 0, 0, 1, 0, '0000-00-00 00:00:00', 0, 2);
INSERT INTO `jos_joocm_profiles_fields` VALUES(2, 'p_aim', 'AIM Address', 'Please enter your AIM Address in this field.', 0, 'varchar', '', 255, 40, 0, 0, 1, 0, 0, 2, 0, '0000-00-00 00:00:00', 0, 2);
INSERT INTO `jos_joocm_profiles_fields` VALUES(3, 'p_msnm', 'MSN Messenger', 'Please enter your MSN Messenger in this field.', 0, 'varchar', '', 255, 40, 0, 0, 1, 0, 0, 3, 0, '0000-00-00 00:00:00', 0, 2);
INSERT INTO `jos_joocm_profiles_fields` VALUES(4, 'p_yim', 'Yahoo Messenger', 'Please enter your Yahoo Messenger in this field.', 0, 'varchar', '', 255, 40, 0, 0, 1, 0, 0, 4, 0, '0000-00-00 00:00:00', 0, 2);
INSERT INTO `jos_joocm_profiles_fields` VALUES(5, 'p_firstname', 'Firstname', 'Firstname', 0, 'varchar', '', 100, 40, 0, 0, 1, 1, 0, 1, 0, '0000-00-00 00:00:00', 0, 1);
INSERT INTO `jos_joocm_profiles_fields` VALUES(6, 'p_lastname', 'Lastname', 'Lastname', 0, 'varchar', '', 100, 40, 0, 0, 1, 1, 0, 2, 0, '0000-00-00 00:00:00', 0, 1);
INSERT INTO `jos_joocm_profiles_fields` VALUES(7, 'p_address', 'Address', 'Address', 1, 'text', '', 3, 0, 5, 40, 1, 0, 0, 3, 62, '2008-12-24 11:43:27', 2, 1);
INSERT INTO `jos_joocm_profiles_fields` VALUES(8, 'p_country', 'Country', 'Country', 5, 'integer', '0', 3, 0, 0, 0, 1, 0, 0, 7, 0, '0000-00-00 00:00:00', 2, 1);
INSERT INTO `jos_joocm_profiles_fields` VALUES(9, 'p_zipcode', 'Zip Code', 'Zip Code', 0, 'varchar', '', 25, 5, 0, 0, 1, 0, 0, 5, 0, '0000-00-00 00:00:00', 0, 1);
INSERT INTO `jos_joocm_profiles_fields` VALUES(10, 'p_town', 'Town', 'Town', 0, 'varchar', '', 100, 40, 0, 0, 1, 0, 0, 6, 0, '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jos_joocm_profiles_fields_lists`
--

CREATE TABLE `jos_joocm_profiles_fields_lists` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `published` tinyint(1) NOT NULL default '1',
  `checked_out` int(1) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `jos_joocm_profiles_fields_lists`
--

INSERT INTO `jos_joocm_profiles_fields_lists` VALUES(1, 'Yes - No', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joocm_profiles_fields_lists` VALUES(2, 'Country List', 1, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `jos_joocm_profiles_fields_lists_values`
--

CREATE TABLE `jos_joocm_profiles_fields_lists_values` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `value` varchar(255) NOT NULL default '',
  `published` tinyint(1) NOT NULL default '1',
  `ordering` int(11) NOT NULL default '0',
  `checked_out` int(1) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `id_profile_field_list` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=247 ;

--
-- Dumping data for table `jos_joocm_profiles_fields_lists_values`
--

INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(1, 'Yes', '1', 1, 1, 0, '0000-00-00 00:00:00', 1);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(2, 'No', '0', 1, 2, 0, '0000-00-00 00:00:00', 1);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(3, 'Abkhazia – Republic of Abkhazia', '1', 1, 1, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(4, 'Afghanistan – Islamic Republic of Afghanistan', '2', 1, 2, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(5, 'Akrotiri and Dhekelia – Sovereign Base Areas of Akrotiri and Dhekelia', '3', 1, 3, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(6, 'Åland – Åland Islands (Autonomous province of Finland)', '4', 1, 4, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(7, 'Albania – Republic of Albania', '5', 1, 5, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(8, 'Algeria – People''s Democratic Republic of Algeria', '6', 1, 6, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(9, 'American Samoa – Territory of American Samoa', '7', 1, 7, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(10, 'Andorra – Principality of Andorra', '8', 1, 8, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(11, 'Angola – Republic of Angola', '9', 1, 9, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(12, 'Anguilla (UK overseas territory)', '10', 1, 10, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(13, 'Antigua and Barbuda', '11', 1, 11, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(14, 'Argentina – Argentine Republic', '12', 1, 12, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(15, 'Armenia – Republic of Armenia', '13', 1, 13, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(16, 'Aruba (Self-governing country in the Kingdom of the Netherlands)', '14', 1, 14, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(17, 'Ascension Island (Dependency of the UK overseas territory of Saint Helena)', '15', 1, 15, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(18, 'Australia – Commonwealth of Australia', '16', 1, 16, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(19, 'Austria – Republic of Austria', '17', 1, 17, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(20, 'Azerbaijan – Republic of Azerbaijan', '18', 1, 18, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(21, 'Bahamas, The – Commonwealth of The Bahamas', '19', 1, 19, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(22, 'Bahrain – Kingdom of Bahrain', '20', 1, 20, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(23, 'Bangladesh – People''s Republic of Bangladesh', '21', 1, 21, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(24, 'Barbados', '22', 1, 22, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(25, 'Belarus – Republic of Belarus', '23', 1, 23, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(26, 'Belgium – Kingdom of Belgium', '24', 1, 24, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(27, 'Belize', '25', 1, 25, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(28, 'Benin – Republic of Benin', '26', 1, 26, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(29, 'Bermuda (UK overseas territory)', '27', 1, 27, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(30, 'Bhutan – Kingdom of Bhutan', '28', 1, 28, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(31, 'Bolivia – Republic of Bolivia', '29', 1, 29, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(32, 'Bosnia and Herzegovina', '30', 1, 30, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(33, 'Botswana – Republic of Botswana', '31', 1, 31, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(34, 'Brazil – Federative Republic of Brazil', '32', 1, 32, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(35, 'Brunei – Negara Brunei Darussalam', '33', 1, 33, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(36, 'Bulgaria – Republic of Bulgaria', '34', 1, 34, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(37, 'Burkina Faso', '35', 1, 35, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(38, 'Burundi – Republic of Burundi', '36', 1, 36, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(39, 'Cambodia – Kingdom of Cambodia', '37', 1, 37, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(40, 'Cameroon – Republic of Cameroon', '38', 1, 38, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(41, 'Canada', '39', 1, 39, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(42, 'Cape Verde – Republic of Cape Verde', '40', 1, 40, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(43, 'Cayman Islands (UK overseas territory)', '41', 1, 41, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(44, 'Central African Republic', '42', 1, 42, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(45, 'Chad – Republic of Chad', '43', 1, 43, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(46, 'Chile – Republic of Chile', '44', 1, 44, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(47, 'China – People''s Republic of China', '45', 1, 45, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(48, 'Christmas Island – Territory of Christmas Island', '46', 1, 46, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(49, 'Cocos (Keeling) Islands – Territory of Cocos (Keeling) Islands', '47', 1, 47, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(50, 'Colombia – Republic of Colombia', '48', 1, 48, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(51, 'Comoros – Union of the Comoros', '49', 1, 49, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(52, 'Congo – Democratic Republic of the Congo', '50', 1, 50, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(53, 'Congo – Republic of the Congo', '51', 1, 51, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(54, 'Cook Islands (Associated state of New Zealand)', '52', 1, 52, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(55, 'Costa Rica – Republic of Costa Rica', '53', 1, 53, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(56, 'Côte d''Ivoire – Republic of Côte d''Ivoire', '54', 1, 54, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(57, 'Croatia – Republic of Croatia', '55', 1, 55, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(58, 'Cuba – Republic of Cuba', '56', 1, 56, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(59, 'Cyprus – Republic of Cyprus', '57', 1, 57, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(60, 'Czech Republic', '58', 1, 58, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(61, 'Denmark – Kingdom of Denmark', '59', 1, 59, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(62, 'Djibouti – Republic of Djibouti', '60', 1, 60, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(63, 'Dominica – Commonwealth of Dominica', '61', 1, 61, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(64, 'Dominican Republic', '62', 1, 62, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(65, 'East Timor – Democratic Republic of Timor-Leste', '63', 1, 63, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(66, 'Ecuador – Republic of Ecuador', '64', 1, 64, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(67, 'Egypt – Arab Republic of Egypt', '65', 1, 65, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(68, 'El Salvador – Republic of El Salvador', '66', 1, 66, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(69, 'Equatorial Guinea – Republic of Equatorial Guinea', '67', 1, 67, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(70, 'Eritrea – State of Eritrea', '68', 1, 68, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(71, 'Estonia – Republic of Estonia', '69', 1, 69, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(72, 'Ethiopia – Federal Democratic Republic of Ethiopia', '70', 1, 70, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(73, 'Falkland Islands (UK overseas territory)', '71', 1, 71, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(74, 'Faroe Islands (Self-governing country in the Kingdom of Denmark)', '72', 1, 72, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(75, 'Fiji – Republic of the Fiji Islands', '73', 1, 73, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(76, 'Finland – Republic of Finland', '74', 1, 74, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(77, 'France – French Republic', '75', 1, 75, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(78, 'French Polynesia (French overseas collectivity)', '76', 1, 76, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(79, 'Gabon – Gabonese Republic', '77', 1, 77, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(80, 'Gambia, The – Republic of The Gambia', '78', 1, 78, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(81, 'Georgia', '79', 1, 79, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(82, 'Germany - Federal Republic of Germany', '80', 1, 80, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(83, 'Ghana – Republic of Ghana', '81', 1, 81, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(84, 'Gibraltar (UK overseas territory)', '82', 1, 82, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(85, 'Greece – Hellenic Republic', '83', 1, 83, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(86, 'Greenland (Self-governing country in the Kingdom of Denmark)', '84', 1, 84, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(87, 'Grenada', '85', 1, 85, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(88, 'Guam – Territory of Guam (US organized territory)', '86', 1, 86, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(89, 'Guatemala – Republic of Guatemala', '87', 1, 87, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(90, 'Guernsey – Bailiwick of Guernsey (British Crown dependency)', '88', 1, 88, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(91, 'Guinea – Republic of Guinea', '89', 1, 89, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(92, 'Guinea-Bissau – Republic of Guinea-Bissau', '90', 1, 90, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(93, 'Guyana – Co-operative Republic of Guyana', '91', 1, 91, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(94, 'Haiti – Republic of Haiti', '92', 1, 92, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(95, 'Honduras – Republic of Honduras', '93', 1, 93, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(96, 'Hong Kong – Hong Kong Special Administrative Region of the People''s Republic of China', '94', 1, 94, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(97, 'Hungary – Republic of Hungary', '95', 1, 95, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(98, 'Iceland – Republic of Iceland', '96', 1, 96, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(99, 'India – Republic of India', '97', 1, 97, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(100, 'Indonesia – Republic of Indonesia', '98', 1, 98, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(101, 'Iran – Islamic Republic of Iran', '99', 1, 99, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(102, 'Iraq – Republic of Iraq', '100', 1, 100, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(103, 'Ireland - Republic of Ireland', '101', 1, 101, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(104, 'Isle of Man (British Crown dependency)', '102', 1, 102, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(105, 'Israel – State of Israel', '103', 1, 103, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(106, 'Italy – Italian Republic', '104', 1, 104, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(107, 'Jamaica', '105', 1, 105, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(108, 'Japan', '106', 1, 106, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(109, 'Jersey – Bailiwick of Jersey (British Crown dependency)', '107', 1, 107, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(110, 'Jordan – Hashemite Kingdom of Jordan', '108', 1, 108, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(111, 'Kazakhstan – Republic of Kazakhstan', '109', 1, 109, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(112, 'Kenya – Republic of Kenya', '110', 1, 110, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(113, 'Kiribati – Republic of Kiribati', '111', 1, 111, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(114, 'Korea, North – Democratic People''s Republic of Korea', '112', 1, 112, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(115, 'Korea, South – Republic of Korea', '113', 1, 113, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(116, 'Kosovo', '114', 1, 114, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(117, 'Kuwait – State of Kuwait', '115', 1, 115, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(118, 'Kyrgyzstan – Kyrgyz Republic', '116', 1, 116, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(119, 'Laos – Lao People''s Democratic Republic', '117', 1, 117, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(120, 'Latvia – Republic of Latvia', '118', 1, 118, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(121, 'Lebanon – Republic of Lebanon', '119', 1, 119, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(122, 'Lesotho – Kingdom of Lesotho', '120', 1, 120, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(123, 'Liberia – Republic of Liberia', '121', 1, 121, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(124, 'Libya – Great Socialist People''s Libyan Arab Jamahiriya', '122', 1, 122, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(125, 'Liechtenstein – Principality of Liechtenstein', '123', 1, 123, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(126, 'Lithuania – Republic of Lithuania', '124', 1, 124, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(127, 'Luxembourg – Grand Duchy of Luxembourg', '125', 1, 125, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(128, 'Macao – Macao Special Administrative Region of the People''s Republic of China', '126', 1, 126, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(129, 'Macedonia – Republic of Macedonia', '127', 1, 127, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(130, 'Madagascar – Republic of Madagascar', '128', 1, 128, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(131, 'Malawi – Republic of Malawi', '129', 1, 129, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(132, 'Malaysia', '130', 1, 130, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(133, 'Maldives – Republic of Maldives', '131', 1, 131, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(134, 'Mali – Republic of Mali', '132', 1, 132, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(135, 'Malta – Republic of Malta', '133', 1, 133, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(136, 'Marshall Islands – Republic of the Marshall Islands', '134', 1, 134, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(137, 'Mauritania – Islamic Republic of Mauritania', '135', 1, 135, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(138, 'Mauritius – Republic of Mauritius', '136', 1, 136, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(139, 'Mayotte – Departmental Collectivity of Mayotte (French overseas collectivity)', '137', 1, 137, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(140, 'Mexico – United Mexican States', '138', 1, 138, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(141, 'Micronesia – Federated States of Micronesia', '139', 1, 139, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(142, 'Moldova – Republic of Moldova', '140', 1, 140, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(143, 'Monaco – Principality of Monaco', '141', 1, 141, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(144, 'Mongolia', '142', 1, 142, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(145, 'Montenegro – Republic of Montenegro', '143', 1, 143, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(146, 'Montserrat (UK overseas territory)', '144', 1, 144, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(147, 'Morocco – Kingdom of Morocco', '145', 1, 145, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(148, 'Mozambique – Republic of Mozambique', '146', 1, 146, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(149, 'Myanmar – Union of Myanmar', '147', 1, 147, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(150, 'Nagorno-Karabakh – Nagorno-Karabakh Republic', '148', 1, 148, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(151, 'Namibia – Republic of Namibia', '149', 1, 149, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(152, 'Nauru – Republic of Nauru', '150', 1, 150, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(153, 'Nepal – State of Nepal', '151', 1, 151, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(154, 'Netherlands – Kingdom of the Netherlands', '152', 1, 152, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(155, 'Netherlands Antilles (Self-governing country in the Kingdom of the Netherlands)', '153', 1, 153, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(156, 'New Caledonia – Territory of New Caledonia and Dependencies (French community sui generis)', '154', 1, 154, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(157, 'New Zealand', '155', 1, 155, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(158, 'Nicaragua – Republic of Nicaragua', '156', 1, 156, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(159, 'Niger – Republic of Niger', '157', 1, 157, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(160, 'Nigeria – Federal Republic of Nigeria', '158', 1, 158, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(161, 'Niue (Associated state of New Zealand)', '159', 1, 159, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(162, 'Norfolk Island – Territory of Norfolk Island (Australian overseas territory)', '160', 1, 160, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(163, 'Northern Cyprus – Turkish Republic of Northern Cyprus', '161', 1, 161, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(164, 'Northern Mariana Islands – Commonwealth of the Northern Mariana Islands (US commonwealth)', '162', 1, 162, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(165, 'Norway – Kingdom of Norway', '163', 1, 163, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(166, 'Oman – Sultanate of Oman', '164', 1, 164, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(167, 'Pakistan – Islamic Republic of Pakistan', '165', 1, 165, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(168, 'Palau – Republic of Palau', '166', 1, 166, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(169, 'Palestine – Occupied Palestinian Territories', '167', 1, 167, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(170, 'Panama – Republic of Panama', '168', 1, 168, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(171, 'Papua New Guinea – Independent State of Papua New Guinea', '169', 1, 169, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(172, 'Paraguay – Republic of Paraguay', '170', 1, 170, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(173, 'Peru – Republic of Peru', '171', 1, 171, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(174, 'Philippines – Republic of the Philippines', '172', 1, 172, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(175, 'Pitcairn Islands – Pitcairn, Henderson, Ducie, and Oeno Islands (UK overseas territory)', '173', 1, 173, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(176, 'Poland – Republic of Poland', '174', 1, 174, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(177, 'Portugal – Portuguese Republic', '175', 1, 175, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(178, 'Puerto Rico – Commonwealth of Puerto Rico (US commonwealth)', '176', 1, 176, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(179, 'Qatar – State of Qatar', '177', 1, 177, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(180, 'Romania', '178', 1, 178, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(181, 'Russia – Russian Federation', '179', 1, 179, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(182, 'Rwanda – Republic of Rwanda', '180', 1, 180, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(183, 'Saint Barthélemy – Collectivity of Saint Barthélemy (French overseas collectivity)', '181', 1, 181, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(184, 'Saint Helena (UK overseas territory)', '182', 1, 182, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(185, 'Saint Kitts and Nevis – Federation of Saint Christopher and Nevis', '183', 1, 183, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(186, 'Saint Lucia', '184', 1, 184, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(187, 'Saint Martin – Collectivity of Saint Martin (French overseas collectivity)', '185', 1, 185, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(188, 'Saint Pierre and Miquelon – Territorial Collectivity of Saint Pierre and Miquelon', '186', 1, 186, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(189, 'Saint Vincent and the Grenadines', '187', 1, 187, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(190, 'Samoa – Independent State of Samoa', '188', 1, 188, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(191, 'San Marino – Most Serene Republic of San Marino', '189', 1, 189, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(192, 'São Tomé and Príncipe – Democratic Republic of São Tomé and Príncipe', '190', 1, 190, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(193, 'Saudi Arabia – Kingdom of Saudi Arabia', '191', 1, 191, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(194, 'Senegal – Republic of Senegal', '192', 1, 192, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(195, 'Serbia – Republic of Serbia', '193', 1, 193, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(196, 'Seychelles – Republic of Seychelles', '194', 1, 194, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(197, 'Sierra Leone – Republic of Sierra Leone', '195', 1, 195, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(198, 'Singapore – Republic of Singapore', '196', 1, 196, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(199, 'Slovakia – Slovak Republic', '197', 1, 197, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(200, 'Slovenia – Republic of Slovenia', '198', 1, 198, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(201, 'Solomon Islands', '199', 1, 199, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(202, 'Somalia', '200', 1, 200, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(203, 'South Africa – Republic of South Africa', '201', 1, 201, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(204, 'South Ossetia – Republic of South Ossetia', '202', 1, 202, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(205, 'Spain – Kingdom of Spain', '203', 1, 203, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(206, 'Sri Lanka – Democratic Socialist Republic of Sri Lanka', '204', 1, 204, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(207, 'Sudan – Republic of the Sudan', '205', 1, 205, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(208, 'Suriname – Republic of Suriname', '206', 1, 206, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(209, 'Svalbard (Territory of Norway)', '207', 1, 207, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(210, 'Swaziland – Kingdom of Swaziland', '208', 1, 208, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(211, 'Sweden – Kingdom of Sweden', '209', 1, 209, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(212, 'Switzerland – Swiss Confederation', '210', 1, 210, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(213, 'Syria – Syrian Arab Republic', '211', 1, 211, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(214, 'Taiwan – Republic of China', '212', 1, 212, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(215, 'Tajikistan – Republic of Tajikistan', '213', 1, 213, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(216, 'Tanzania – United Republic of Tanzania', '214', 1, 214, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(217, 'Thailand – Kingdom of Thailand', '215', 1, 215, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(218, 'Togo – Togolese Republic', '216', 1, 216, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(219, 'Tokelau (Overseas territory of New Zealand)', '217', 1, 217, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(220, 'Tonga – Kingdom of Tonga', '218', 1, 218, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(221, 'Transnistria - Transnistrian Moldovan Republic', '219', 1, 219, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(222, 'Trinidad and Tobago – Republic of Trinidad and Tobago', '220', 1, 220, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(223, 'Tristan da Cunha (Dependency of the UK overseas territory of Saint Helena)', '221', 1, 221, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(224, 'Tunisia – Tunisian Republic', '222', 1, 222, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(225, 'Turkey – Republic of Turkey', '223', 1, 223, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(226, 'Turkmenistan', '224', 1, 224, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(227, 'Turks and Caicos Islands (UK overseas territory)', '225', 1, 225, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(228, 'Tuvalu', '226', 1, 226, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(229, 'Uganda – Republic of Uganda', '227', 1, 227, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(230, 'Ukraine', '228', 1, 228, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(231, 'United Arab Emirates', '229', 1, 229, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(232, 'United Kingdom – United Kingdom of Great Britain and Northern Ireland', '230', 1, 230, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(233, 'United States - United States of America', '231', 1, 231, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(234, 'Uruguay – Eastern Republic of Uruguay', '232', 1, 232, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(235, 'Uzbekistan – Republic of Uzbekistan', '233', 1, 233, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(236, 'Vanuatu – Republic of Vanuatu', '234', 1, 234, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(237, 'Vatican City – State of the Vatican City', '235', 1, 235, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(238, 'Venezuela – Bolivarian Republic of Venezuela', '236', 1, 236, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(239, 'Vietnam – Socialist Republic of Vietnam', '237', 1, 237, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(240, 'Virgin Islands, British – British Virgin Islands (UK overseas territory)', '238', 1, 238, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(241, 'Virgin Islands, United States – United States Virgin Islands (US organized territory)', '239', 1, 239, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(242, 'Wallis and Futuna – Territory of Wallis and Futuna Islands (French overseas collectivity)', '240', 1, 240, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(243, 'Western Sahara', '241', 1, 241, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(244, 'Yemen – Republic of Yemen', '242', 1, 242, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(245, 'Zambia – Republic of Zambia', '243', 1, 243, 0, '0000-00-00 00:00:00', 2);
INSERT INTO `jos_joocm_profiles_fields_lists_values` VALUES(246, 'Zimbabwe – Republic of Zimbabwe', '244', 1, 244, 0, '0000-00-00 00:00:00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `jos_joocm_profiles_fields_sets`
--

CREATE TABLE `jos_joocm_profiles_fields_sets` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `published` tinyint(1) NOT NULL default '1',
  `ordering` int(11) NOT NULL default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `jos_joocm_profiles_fields_sets`
--

INSERT INTO `jos_joocm_profiles_fields_sets` VALUES(1, 'Personal Data', 1, 1, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joocm_profiles_fields_sets` VALUES(2, 'Contact Information', 1, 2, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `jos_joocm_terms`
--

CREATE TABLE `jos_joocm_terms` (
  `id` int(11) NOT NULL auto_increment,
  `terms` varchar(255) NOT NULL default '',
  `termstext` text NOT NULL,
  `agreement` varchar(255) NOT NULL default '',
  `agreementtext` text NOT NULL,
  `description` text NOT NULL,
  `keywords` text NOT NULL,
  `locale` varchar(5) NOT NULL default '',
  `published` tinyint(1) NOT NULL default '1',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `jos_joocm_terms`
--

INSERT INTO `jos_joocm_terms` VALUES(1, 'Terms of Agreement', '<p>While the administrators and moderators of this community will attempt to remove or edit any generally objectionable material as quickly as possible, it is impossible to review every message. Therefore you acknowledge that all publications made to the <strong>community</strong> express the views and opinions of the author and not the administrators, moderators or webmaster (except for posts by these people) and hence will not be held liable.</p><p>You agree not to publish any abusive, obscene, vulgar, slanderous, hateful, threatening, sexually-oriented or any other material that may violate any applicable laws. Doing so may lead to you being immediately and permanently banned (and your service provider being informed). The IP address of all publications is recorded to aid in enforcing these conditions. You agree that the webmaster, administrator and moderators of this communiy have the right to remove, edit, move or close any publication at any time should they see fit. As a user you agree to any information you have entered above being stored in a database. While this information will not be disclosed to any third party without your consent the webmaster, administrator and moderators cannot be held responsible for any hacking attempt that may lead to the data being compromised.</p><p>This portal uses cookies to store information on your local computer. These cookies do not contain any of the information you have entered above; they serve only to improve your viewing pleasure. The e-mail address is used only for confirming your registration details and password (and for sending new passwords should you forget your current one).</p>', 'Agreement', '<p>By clicking <strong>Agree</strong> below you agree to be bound by these conditions. </p>', 'This is a short description of the site terms of agreement.', 'terms of agreement', 'en-GB', 1, 62, '2009-02-11 19:32:12');

-- --------------------------------------------------------

--
-- Table structure for table `jos_joocm_timeformats`
--

CREATE TABLE `jos_joocm_timeformats` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default '',
  `timeformat` varchar(25) NOT NULL default 'd M Y H:i',
  `published` tinyint(1) NOT NULL default '1',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `jos_joocm_timeformats`
--

INSERT INTO `jos_joocm_timeformats` VALUES(1, 'm/d/Y H:M', '%m/%d/%Y %H:%M', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joocm_timeformats` VALUES(2, 'm/d/Y', '%m/%d/%Y', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joocm_timeformats` VALUES(3, 'd/m/Y H:M', '%d/%m/%Y %H:%M', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joocm_timeformats` VALUES(4, 'd/m/Y', '%d/%m/%Y', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joocm_timeformats` VALUES(5, 'd.m.Y H:M', '%d.%m.%Y %H:%M', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joocm_timeformats` VALUES(6, 'd.m.Y', '%d.%m.%Y', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joocm_timeformats` VALUES(7, 'b, d.Y H:M', '%b, %d.%Y %H:%M', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joocm_timeformats` VALUES(8, 'b, d.Y', '%b, %d.%Y', 1, 62, '2008-12-23 10:06:50');
INSERT INTO `jos_joocm_timeformats` VALUES(9, 'A,  d.B Y H:M', '%A,  %d.%B %Y %H:%M', 1, 0, '0000-00-00 00:00:00');
INSERT INTO `jos_joocm_timeformats` VALUES(10, 'A,  d.B Y', '%A,  %d.%B %Y', 1, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `jos_joocm_updates`
--

CREATE TABLE `jos_joocm_updates` (
  `version` varchar(100) NOT NULL default '',
  `update_file` varchar(255) NOT NULL default '',
  `date_install` datetime NOT NULL default '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_joocm_updates`
--

INSERT INTO `jos_joocm_updates` VALUES('1.0.0 Phobos RC1', 'install.joocm.sql', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jos_joocm_users`
--

CREATE TABLE `jos_joocm_users` (
  `id` int(11) NOT NULL default '0',
  `views_count` int(11) NOT NULL default '0',
  `system_emails` tinyint(1) unsigned NOT NULL default '0',
  `agreed_terms` tinyint(1) NOT NULL default '0',
  `show_email` tinyint(1) NOT NULL default '0',
  `show_online_state` tinyint(1) NOT NULL default '1',
  `id_avatar` int(11) NOT NULL default '0',
  `signature` text NOT NULL,
  `time_format` varchar(25) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_joocm_users`
--

INSERT INTO `jos_joocm_users` VALUES(62, 0, 0, 0, 0, 1, 0, '', '%A,  %d.%B %Y %H:%M');
INSERT INTO `jos_joocm_users` VALUES(63, 0, 0, 0, 0, 1, 0, '', '%A,  %d.%B %Y %H:%M');

-- --------------------------------------------------------

--
-- Table structure for table `jos_joomgallery`
--

CREATE TABLE `jos_joomgallery` (
  `id` int(11) NOT NULL auto_increment,
  `catid` int(11) NOT NULL default '0',
  `imgtitle` text NOT NULL,
  `alias` varchar(255) NOT NULL default '',
  `imgauthor` varchar(50) default NULL,
  `imgtext` text NOT NULL,
  `imgdate` datetime NOT NULL,
  `hits` int(11) NOT NULL default '0',
  `imgvotes` int(11) NOT NULL default '0',
  `imgvotesum` int(11) NOT NULL default '0',
  `access` tinyint(3) NOT NULL default '0',
  `published` tinyint(1) NOT NULL default '0',
  `imgfilename` varchar(100) NOT NULL default '',
  `imgthumbname` varchar(100) NOT NULL default '',
  `checked_out` int(11) NOT NULL default '0',
  `owner` int(11) unsigned NOT NULL default '0',
  `approved` tinyint(1) NOT NULL default '0',
  `useruploaded` tinyint(1) NOT NULL default '0',
  `ordering` int(11) NOT NULL default '0',
  `params` text NOT NULL,
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `idx_catid` (`catid`),
  KEY `idx_owner` (`owner`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `jos_joomgallery`
--

INSERT INTO `jos_joomgallery` VALUES(1, 1, 'Flowers', 'flowers-1', '', '', '2010-11-11 02:51:00', 1, 0, 0, 0, 1, 'flowers_20101110_1109757106.jpg', 'flowers_20101110_1109757106.jpg', 0, 62, 1, 0, -1, '', '', '');
INSERT INTO `jos_joomgallery` VALUES(2, 1, 'File', 'file-2', NULL, '', '2010-11-11 03:09:25', 1, 0, 0, 0, 1, '95325335_batik_iris_20101110_1391011355.jpg', '95325335_batik_iris_20101110_1391011355.jpg', 0, 63, 1, 1, -2, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `jos_joomgallery_catg`
--

CREATE TABLE `jos_joomgallery_catg` (
  `cid` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `alias` varchar(255) NOT NULL default '',
  `parent` int(11) NOT NULL default '0',
  `description` text,
  `ordering` int(11) NOT NULL default '0',
  `access` tinyint(3) unsigned NOT NULL default '0',
  `published` char(1) NOT NULL default '0',
  `owner` int(11) default '0',
  `catimage` varchar(100) default NULL,
  `img_position` int(10) default '0',
  `catpath` varchar(255) NOT NULL default '',
  `params` text NOT NULL,
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  PRIMARY KEY  (`cid`),
  KEY `idx_parent` (`parent`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `jos_joomgallery_catg`
--

INSERT INTO `jos_joomgallery_catg` VALUES(1, 'Flowers', 'Flowers', 0, '', 1, 0, '1', 0, '', 0, 'flowers_1', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `jos_joomgallery_comments`
--

CREATE TABLE `jos_joomgallery_comments` (
  `cmtid` int(11) NOT NULL auto_increment,
  `cmtpic` int(11) NOT NULL default '0',
  `cmtip` varchar(15) NOT NULL default '',
  `userid` int(11) unsigned NOT NULL default '0',
  `cmtname` varchar(50) NOT NULL default '',
  `cmttext` text NOT NULL,
  `cmtdate` datetime NOT NULL,
  `published` tinyint(1) NOT NULL default '0',
  `approved` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`cmtid`),
  KEY `idx_cmtpic` (`cmtpic`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `jos_joomgallery_comments`
--

INSERT INTO `jos_joomgallery_comments` VALUES(1, 2, '24.255.116.10', 63, 'Kevin Dunetz', 'This is my comment', '2010-11-11 03:10:38', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jos_joomgallery_config`
--

CREATE TABLE `jos_joomgallery_config` (
  `id` int(1) NOT NULL default '0',
  `jg_pathimages` varchar(50) NOT NULL,
  `jg_pathoriginalimages` varchar(50) NOT NULL,
  `jg_paththumbs` varchar(50) NOT NULL,
  `jg_pathftpupload` varchar(50) NOT NULL,
  `jg_pathtemp` varchar(50) NOT NULL,
  `jg_wmpath` varchar(50) NOT NULL,
  `jg_wmfile` varchar(50) NOT NULL,
  `jg_dateformat` varchar(50) NOT NULL,
  `jg_checkupdate` int(1) NOT NULL,
  `jg_filenamewithjs` int(1) NOT NULL,
  `jg_filenamesearch` varchar(50) NOT NULL,
  `jg_filenamereplace` varchar(50) NOT NULL,
  `jg_thumbcreation` varchar(5) NOT NULL,
  `jg_fastgd2thumbcreation` int(1) NOT NULL,
  `jg_impath` varchar(50) NOT NULL,
  `jg_resizetomaxwidth` int(1) NOT NULL,
  `jg_maxwidth` int(5) NOT NULL,
  `jg_picturequality` int(3) NOT NULL,
  `jg_useforresizedirection` int(1) NOT NULL,
  `jg_cropposition` int(1) NOT NULL,
  `jg_thumbwidth` int(5) NOT NULL,
  `jg_thumbheight` int(5) NOT NULL,
  `jg_thumbquality` int(3) NOT NULL,
  `jg_uploadorder` int(1) NOT NULL,
  `jg_useorigfilename` int(1) NOT NULL,
  `jg_filenamenumber` int(1) NOT NULL,
  `jg_delete_original` int(1) NOT NULL,
  `jg_wrongvaluecolor` varchar(10) NOT NULL,
  `jg_msg_upload_type` int(1) NOT NULL,
  `jg_msg_upload_recipients` text NOT NULL,
  `jg_msg_comment_type` int(1) NOT NULL,
  `jg_msg_comment_recipients` text NOT NULL,
  `jg_msg_comment_toowner` int(1) NOT NULL,
  `jg_msg_report_type` int(1) NOT NULL,
  `jg_msg_report_recipients` text NOT NULL,
  `jg_msg_report_toowner` int(1) NOT NULL,
  `jg_realname` int(1) NOT NULL,
  `jg_cooliris` int(1) NOT NULL,
  `jg_coolirislink` int(1) NOT NULL,
  `jg_contentpluginsenabled` int(1) NOT NULL,
  `jg_itemid` varchar(10) NOT NULL,
  `jg_userspace` int(1) NOT NULL,
  `jg_approve` int(1) NOT NULL,
  `jg_usercat` int(1) NOT NULL,
  `jg_maxusercat` int(5) NOT NULL,
  `jg_userowncatsupload` int(1) NOT NULL,
  `jg_maxuserimage` int(9) NOT NULL,
  `jg_maxfilesize` int(9) NOT NULL,
  `jg_category` text NOT NULL,
  `jg_usercategory` text NOT NULL,
  `jg_usercatacc` int(1) NOT NULL,
  `jg_useruploadsingle` int(1) NOT NULL,
  `jg_maxuploadfields` int(3) NOT NULL,
  `jg_useruploadbatch` int(1) NOT NULL,
  `jg_useruploadjava` int(1) NOT NULL,
  `jg_useruploadnumber` int(1) NOT NULL,
  `jg_special_gif_upload` int(1) NOT NULL,
  `jg_delete_original_user` int(1) NOT NULL,
  `jg_newpiccopyright` int(1) NOT NULL,
  `jg_newpicnote` int(1) NOT NULL,
  `jg_showrating` int(1) NOT NULL,
  `jg_maxvoting` int(1) NOT NULL,
  `jg_ratingcalctype` int(1) NOT NULL,
  `jg_ratingdisplaytype` int(1) NOT NULL,
  `jg_ajaxrating` int(1) NOT NULL,
  `jg_onlyreguservotes` int(1) NOT NULL,
  `jg_showcomment` int(1) NOT NULL,
  `jg_anoncomment` int(1) NOT NULL,
  `jg_namedanoncomment` int(1) NOT NULL,
  `jg_approvecom` int(1) NOT NULL,
  `jg_bbcodesupport` int(1) NOT NULL,
  `jg_smiliesupport` int(1) NOT NULL,
  `jg_anismilie` int(1) NOT NULL,
  `jg_smiliescolor` varchar(10) NOT NULL,
  `jg_anchors` int(1) NOT NULL,
  `jg_tooltips` int(1) NOT NULL,
  `jg_dyncrop` int(1) NOT NULL,
  `jg_dyncropposition` int(1) NOT NULL,
  `jg_dyncropwidth` int(5) NOT NULL,
  `jg_dyncropheight` int(5) NOT NULL,
  `jg_firstorder` varchar(20) NOT NULL,
  `jg_secondorder` varchar(20) NOT NULL,
  `jg_thirdorder` varchar(20) NOT NULL,
  `jg_pagetitle_cat` text NOT NULL,
  `jg_pagetitle_detail` text NOT NULL,
  `jg_showgalleryhead` int(1) NOT NULL,
  `jg_showpathway` int(1) NOT NULL,
  `jg_completebreadcrumbs` int(1) NOT NULL,
  `jg_search` int(1) NOT NULL,
  `jg_showallpics` int(1) NOT NULL,
  `jg_showallhits` int(1) NOT NULL,
  `jg_showbacklink` int(1) NOT NULL,
  `jg_suppresscredits` int(1) NOT NULL,
  `jg_showuserpanel` int(1) NOT NULL,
  `jg_showallpicstoadmin` int(1) NOT NULL,
  `jg_showminithumbs` int(1) NOT NULL,
  `jg_openjs_padding` int(3) NOT NULL,
  `jg_openjs_background` varchar(10) NOT NULL,
  `jg_dhtml_border` varchar(10) NOT NULL,
  `jg_show_title_in_dhtml` int(1) NOT NULL,
  `jg_show_description_in_dhtml` int(1) NOT NULL,
  `jg_lightbox_speed` int(3) NOT NULL,
  `jg_lightbox_slide_all` int(1) NOT NULL,
  `jg_resize_js_image` int(1) NOT NULL,
  `jg_disable_rightclick_original` int(1) NOT NULL,
  `jg_showgallerysubhead` int(1) NOT NULL,
  `jg_showallcathead` int(1) NOT NULL,
  `jg_colcat` int(1) NOT NULL,
  `jg_catperpage` int(1) NOT NULL,
  `jg_ordercatbyalpha` int(1) NOT NULL,
  `jg_showgallerypagenav` int(1) NOT NULL,
  `jg_showcatcount` int(1) NOT NULL,
  `jg_showcatthumb` int(1) NOT NULL,
  `jg_showrandomcatthumb` int(1) NOT NULL,
  `jg_ctalign` int(1) NOT NULL,
  `jg_showtotalcatimages` int(1) NOT NULL,
  `jg_showtotalcathits` int(1) NOT NULL,
  `jg_showcatasnew` int(1) NOT NULL,
  `jg_catdaysnew` int(3) NOT NULL,
  `jg_showdescriptioningalleryview` int(1) NOT NULL,
  `jg_rmsm` int(1) NOT NULL,
  `jg_showrmsmcats` int(1) NOT NULL,
  `jg_showsubsingalleryview` int(1) NOT NULL,
  `jg_showcathead` int(1) NOT NULL,
  `jg_usercatorder` int(1) NOT NULL,
  `jg_usercatorderlist` varchar(50) NOT NULL,
  `jg_showcatdescriptionincat` int(1) NOT NULL,
  `jg_showpagenav` int(1) NOT NULL,
  `jg_showpiccount` int(1) NOT NULL,
  `jg_perpage` int(3) NOT NULL,
  `jg_catthumbalign` int(1) NOT NULL,
  `jg_colnumb` int(3) NOT NULL,
  `jg_detailpic_open` int(1) NOT NULL,
  `jg_lightboxbigpic` int(1) NOT NULL,
  `jg_showtitle` int(1) NOT NULL,
  `jg_showpicasnew` int(1) NOT NULL,
  `jg_daysnew` int(3) NOT NULL,
  `jg_showhits` int(1) NOT NULL,
  `jg_showauthor` int(1) NOT NULL,
  `jg_showowner` int(1) NOT NULL,
  `jg_showcatcom` int(1) NOT NULL,
  `jg_showcatrate` int(1) NOT NULL,
  `jg_showcatdescription` int(1) NOT NULL,
  `jg_showcategorydownload` int(1) NOT NULL,
  `jg_showcategoryfavourite` int(1) NOT NULL,
  `jg_category_report_images` int(1) NOT NULL,
  `jg_showsubcathead` int(1) NOT NULL,
  `jg_showsubcatcount` int(1) NOT NULL,
  `jg_colsubcat` int(3) NOT NULL,
  `jg_subperpage` int(3) NOT NULL,
  `jg_showpagenavsubs` int(1) NOT NULL,
  `jg_subcatthumbalign` int(1) NOT NULL,
  `jg_showsubthumbs` int(1) NOT NULL,
  `jg_showrandomsubthumb` int(1) NOT NULL,
  `jg_showdescriptionincategoryview` int(1) NOT NULL,
  `jg_ordersubcatbyalpha` int(1) NOT NULL,
  `jg_showtotalsubcatimages` int(1) NOT NULL,
  `jg_showtotalsubcathits` int(1) NOT NULL,
  `jg_showdetailpage` int(1) NOT NULL,
  `jg_showdetailnumberofpics` int(1) NOT NULL,
  `jg_cursor_navigation` int(1) NOT NULL,
  `jg_disable_rightclick_detail` int(1) NOT NULL,
  `jg_detail_report_images` int(1) NOT NULL,
  `jg_report_images_notauth` int(1) NOT NULL,
  `jg_showdetailtitle` int(1) NOT NULL,
  `jg_showdetail` int(1) NOT NULL,
  `jg_showdetailaccordion` int(1) NOT NULL,
  `jg_showdetaildescription` int(1) NOT NULL,
  `jg_showdetaildatum` int(1) NOT NULL,
  `jg_showdetailhits` int(1) NOT NULL,
  `jg_showdetailrating` int(1) NOT NULL,
  `jg_showdetailfilesize` int(1) NOT NULL,
  `jg_showdetailauthor` int(1) NOT NULL,
  `jg_showoriginalfilesize` int(1) NOT NULL,
  `jg_showdetaildownload` int(1) NOT NULL,
  `jg_downloadfile` int(1) NOT NULL,
  `jg_downloadwithwatermark` int(1) NOT NULL,
  `jg_watermark` int(1) NOT NULL,
  `jg_watermarkpos` int(1) NOT NULL,
  `jg_bigpic` int(1) NOT NULL,
  `jg_bigpic_open` int(1) NOT NULL,
  `jg_bbcodelink` int(1) NOT NULL,
  `jg_showcommentsunreg` int(1) NOT NULL,
  `jg_showcommentsarea` int(1) NOT NULL,
  `jg_send2friend` int(1) NOT NULL,
  `jg_minis` int(1) NOT NULL,
  `jg_motionminis` int(1) NOT NULL,
  `jg_motionminiWidth` int(3) NOT NULL,
  `jg_motionminiHeight` int(3) NOT NULL,
  `jg_miniWidth` int(3) NOT NULL,
  `jg_miniHeight` int(3) NOT NULL,
  `jg_minisprop` int(1) NOT NULL,
  `jg_nameshields` int(1) NOT NULL,
  `jg_nameshields_others` int(1) NOT NULL,
  `jg_nameshields_unreg` int(1) NOT NULL,
  `jg_show_nameshields_unreg` int(1) NOT NULL,
  `jg_nameshields_height` int(3) NOT NULL,
  `jg_nameshields_width` int(3) NOT NULL,
  `jg_slideshow` int(1) NOT NULL,
  `jg_slideshow_timer` int(3) NOT NULL,
  `jg_slideshow_transition` int(1) NOT NULL,
  `jg_slideshow_transtime` int(3) NOT NULL,
  `jg_slideshow_maxdimauto` int(1) NOT NULL,
  `jg_slideshow_width` int(3) NOT NULL,
  `jg_slideshow_heigth` int(3) NOT NULL,
  `jg_slideshow_infopane` int(1) NOT NULL,
  `jg_slideshow_carousel` int(1) NOT NULL,
  `jg_slideshow_arrows` int(1) NOT NULL,
  `jg_showexifdata` int(1) NOT NULL,
  `jg_geotagging` text NOT NULL,
  `jg_subifdtags` text NOT NULL,
  `jg_ifdotags` text NOT NULL,
  `jg_gpstags` text NOT NULL,
  `jg_showiptcdata` int(1) NOT NULL,
  `jg_iptctags` text NOT NULL,
  `jg_showtoplist` int(1) NOT NULL,
  `jg_toplist` int(3) NOT NULL,
  `jg_topthumbalign` int(1) NOT NULL,
  `jg_toptextalign` int(1) NOT NULL,
  `jg_toplistcols` int(3) NOT NULL,
  `jg_whereshowtoplist` int(1) NOT NULL,
  `jg_showrate` int(1) NOT NULL,
  `jg_showlatest` int(1) NOT NULL,
  `jg_showcom` int(1) NOT NULL,
  `jg_showthiscomment` int(1) NOT NULL,
  `jg_showmostviewed` int(1) NOT NULL,
  `jg_favourites` int(1) NOT NULL,
  `jg_showdetailfavourite` int(1) NOT NULL,
  `jg_favouritesshownotauth` int(1) NOT NULL,
  `jg_maxfavourites` int(5) NOT NULL,
  `jg_zipdownload` int(1) NOT NULL,
  `jg_usefavouritesforpubliczip` int(1) NOT NULL,
  `jg_usefavouritesforzip` int(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_joomgallery_config`
--

INSERT INTO `jos_joomgallery_config` VALUES(1, 'images/joomgallery/details/', 'images/joomgallery/originals/', 'images/joomgallery/thumbnails/', 'components/com_joomgallery/ftp_upload/', 'administrator/components/com_joomgallery/temp/', 'components/com_joomgallery/assets/images/', 'watermark.png', '%m/%d/%Y %I:%M:%S %p', 1, 1, 'ä|ö|ü|ß', 'ae|oe|ue|ss', 'gd2', 1, '', 1, 400, 100, 0, 2, 133, 100, 100, 1, 0, 1, 0, '#f00', 2, '', 2, '', 0, 2, '', 0, 0, 0, 0, 1, '', 1, 0, 1, 10, 0, 500, 2000000, '1', '', 1, 1, 3, 1, 1, 0, 1, 2, 1, 1, 1, 5, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 0, 'grey', 1, 2, 0, 2, 100, 100, 'ordering ASC', 'imgdate DESC', 'imgtitle DESC', '[! JGS_COMMON_CATEGORY!]: #cat', '[! JGS_COMMON_CATEGORY!]: #cat - [! JGS_COMMON_IMAGE!]:  #img', 1, 1, 1, 0, 3, 1, 3, 1, 3, 1, 1, 10, '#fff', '#808080', 0, 1, 5, 1, 1, 1, 1, 1, 3, 9, 0, 1, 1, 1, 3, 1, 1, 1, 1, 7, 1, 1, 1, 0, 1, 1, 'date,title', 1, 2, 1, 8, 1, 2, 0, 1, 1, 1, 10, 1, 1, 1, 1, 1, 1, 0, 0, 0, 1, 1, 2, 8, 1, 3, 2, 1, 1, 0, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 2, 1, 0, 9, 2, 6, 3, 1, 2, 1, 1, 2, 400, 50, 28, 28, 2, 0, 1, 1, 0, 10, 6, 1, 6000, 0, 2000, 0, 640, 480, 0, 0, 0, 0, '', '', '', '', 0, '', 2, 12, 1, 1, 1, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_joomgallery_countstop`
--

CREATE TABLE `jos_joomgallery_countstop` (
  `cspicid` int(11) NOT NULL default '0',
  `csip` varchar(20) NOT NULL,
  `cssessionid` varchar(200) default NULL,
  `cstime` datetime default NULL,
  KEY `idx_cspicid` (`cspicid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_joomgallery_countstop`
--

INSERT INTO `jos_joomgallery_countstop` VALUES(2, '24.255.116.10', 'a756e3e8cfe496aee4e5b9d8858038d8', '2010-11-10 20:10:14');

-- --------------------------------------------------------

--
-- Table structure for table `jos_joomgallery_maintenance`
--

CREATE TABLE `jos_joomgallery_maintenance` (
  `id` int(11) NOT NULL auto_increment,
  `refid` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `owner` int(11) NOT NULL,
  `title` text NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `orig` varchar(255) NOT NULL,
  `thumborphan` int(11) NOT NULL,
  `imgorphan` int(11) NOT NULL,
  `origorphan` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jos_joomgallery_maintenance`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_joomgallery_nameshields`
--

CREATE TABLE `jos_joomgallery_nameshields` (
  `nid` int(11) NOT NULL auto_increment,
  `npicid` int(11) NOT NULL default '0',
  `nuserid` int(11) unsigned NOT NULL default '0',
  `nxvalue` int(11) NOT NULL default '0',
  `nyvalue` int(11) NOT NULL default '0',
  `by` int(11) NOT NULL default '0',
  `nuserip` varchar(15) NOT NULL default '0',
  `ndate` datetime NOT NULL,
  `nzindex` int(11) NOT NULL default '0',
  PRIMARY KEY  (`nid`),
  KEY `idx_picid` (`npicid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jos_joomgallery_nameshields`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_joomgallery_orphans`
--

CREATE TABLE `jos_joomgallery_orphans` (
  `id` int(11) NOT NULL auto_increment,
  `fullpath` varchar(255) NOT NULL,
  `type` varchar(7) NOT NULL,
  `refid` int(11) NOT NULL,
  `title` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jos_joomgallery_orphans`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_joomgallery_users`
--

CREATE TABLE `jos_joomgallery_users` (
  `uid` int(11) NOT NULL auto_increment,
  `uuserid` int(11) NOT NULL default '0',
  `piclist` text,
  `layout` int(1) NOT NULL,
  `time` datetime NOT NULL,
  `zipname` varchar(70) NOT NULL,
  PRIMARY KEY  (`uid`),
  KEY `idx_uid` (`uuserid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jos_joomgallery_users`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_joomgallery_votes`
--

CREATE TABLE `jos_joomgallery_votes` (
  `voteid` int(11) NOT NULL auto_increment,
  `picid` int(11) NOT NULL default '0',
  `userid` int(11) unsigned NOT NULL default '0',
  `userip` varchar(15) NOT NULL default '0',
  `datevoted` datetime NOT NULL,
  `vote` int(11) NOT NULL default '0',
  PRIMARY KEY  (`voteid`),
  KEY `idx_picid` (`picid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jos_joomgallery_votes`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_menu`
--

CREATE TABLE `jos_menu` (
  `id` int(11) NOT NULL auto_increment,
  `menutype` varchar(75) default NULL,
  `name` varchar(255) default NULL,
  `alias` varchar(255) NOT NULL default '',
  `link` text,
  `type` varchar(50) NOT NULL default '',
  `published` tinyint(1) NOT NULL default '0',
  `parent` int(11) unsigned NOT NULL default '0',
  `componentid` int(11) unsigned NOT NULL default '0',
  `sublevel` int(11) default '0',
  `ordering` int(11) default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `pollid` int(11) NOT NULL default '0',
  `browserNav` tinyint(4) default '0',
  `access` tinyint(3) unsigned NOT NULL default '0',
  `utaccess` tinyint(3) unsigned NOT NULL default '0',
  `params` text NOT NULL,
  `lft` int(11) unsigned NOT NULL default '0',
  `rgt` int(11) unsigned NOT NULL default '0',
  `home` int(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `componentid` (`componentid`,`menutype`,`published`,`access`),
  KEY `menutype` (`menutype`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `jos_menu`
--

INSERT INTO `jos_menu` VALUES(1, 'mainmenu', 'Kevin Dunetz', 'home', 'index.php?option=com_content&view=frontpage', 'component', 1, 0, 20, 0, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'num_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=front\nmulti_column_order=1\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=0\nshow_title=1\nlink_titles=0\nshow_intro=1\nshow_section=1\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\nfeed_summary=\npage_title=TEM Resources\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 1);
INSERT INTO `jos_menu` VALUES(2, 'mainmenu', 'Joomla! License', 'joomla-license', 'index.php?option=com_content&view=article&id=5', 'component', 0, 0, 20, 0, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'pageclass_sfx=\nmenu_image=-1\nsecure=0\nshow_noauth=0\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(41, 'mainmenu', 'FAQ', 'faq', 'index.php?option=com_content&view=section&id=3', 'component', 0, 0, 20, 0, 5, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_page_title=1\nshow_description=0\nshow_description_image=0\nshow_categories=1\nshow_empty_categories=0\nshow_cat_num_articles=1\nshow_category_description=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\norderby=\nshow_noauth=0\nshow_title=1\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(11, 'othermenu', 'List of TEM Providers', 'tem-providers', 'index.php?option=com_content&view=article&id=47', 'component', 1, 0, 20, 0, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'show_noauth=0\nshow_title=0\nlink_titles=0\nshow_intro=0\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=0\nshow_create_date=0\nshow_modify_date=0\nshow_item_navigation=0\nshow_readmore=0\nshow_vote=0\nshow_icons=0\nshow_pdf_icon=0\nshow_print_icon=0\nshow_email_icon=0\nshow_hits=0\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(12, 'othermenu', 'Tariff Websites', 'tariff-websites', 'index.php?option=com_wrapper&view=wrapper', 'component', 1, 0, 17, 0, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'url=http://www.temresources.com/joomla1234567z/tariff-websites.html\nscrolling=auto\nwidth=100%\nheight=500\nheight_auto=0\nadd_scheme=1\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(13, 'othermenu', 'Joomla! Documentation', 'joomla-documentation', 'http://docs.joomla.org', 'url', 0, 0, 0, 0, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'menu_image=-1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(14, 'othermenu', 'Joomla! Community', 'joomla-community', 'http://community.joomla.org', 'url', 0, 0, 0, 0, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'menu_image=-1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(15, 'othermenu', 'Joomla! Magazine', 'joomla-community-magazine', 'http://community.joomla.org/magazine.html', 'url', 0, 0, 0, 0, 5, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'menu_image=-1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(16, 'othermenu', 'OSM Home', 'osm-home', 'http://www.opensourcematters.org', 'url', 0, 0, 0, 0, 6, 0, '0000-00-00 00:00:00', 0, 0, 0, 6, 'menu_image=-1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(17, 'othermenu', 'Administrator', 'administrator', 'administrator/', 'url', 0, 0, 0, 0, 8, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'menu_image=-1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(18, 'topmenu', 'News', 'news', 'index.php?option=com_newsfeeds&view=newsfeed&id=1&feedid=1', 'component', 0, 0, 11, 0, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'show_page_title=1\npage_title=News\npageclass_sfx=\nmenu_image=-1\nsecure=0\nshow_headings=1\nshow_name=1\nshow_articles=1\nshow_link=1\nshow_other_cats=1\nshow_cat_description=1\nshow_cat_items=1\nshow_feed_image=1\nshow_feed_description=1\nshow_item_description=1\nfeed_word_count=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(20, 'usermenu', 'Your Details', 'your-details', 'index.php?option=com_user&view=user&task=edit', 'component', 1, 0, 14, 0, 1, 62, '2010-11-06 23:28:03', 0, 0, 1, 3, '', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(24, 'usermenu', 'Logout', 'logout', 'index.php?option=com_user&view=login', 'component', 1, 0, 14, 0, 4, 0, '0000-00-00 00:00:00', 0, 0, 1, 3, '', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(38, 'keyconcepts', 'Content Layouts', 'content-layouts', 'index.php?option=com_content&view=article&id=24', 'component', 1, 0, 20, 0, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'pageclass_sfx=\nmenu_image=-1\nsecure=0\nshow_noauth=0\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(27, 'mainmenu', 'Joomla! Overview', 'joomla-overview', 'index.php?option=com_content&view=article&id=19', 'component', 0, 0, 20, 0, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'pageclass_sfx=\nmenu_image=-1\nsecure=0\nshow_noauth=0\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(28, 'topmenu', 'About TEM Resources', 'about-tem-resources', 'index.php?option=com_content&view=article&id=46', 'component', 1, 0, 20, 0, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_noauth=0\nshow_title=\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(29, 'topmenu', 'Features', 'features', 'index.php?option=com_content&view=article&id=22', 'component', 0, 0, 20, 0, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'pageclass_sfx=\nmenu_image=-1\nsecure=0\nshow_noauth=0\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(30, 'topmenu', 'The Community', 'the-community', 'index.php?option=com_content&view=article&id=27', 'component', 0, 0, 20, 0, 5, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'pageclass_sfx=\nmenu_image=-1\nsecure=0\nshow_noauth=0\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(34, 'mainmenu', 'What''s New in 1.5?', 'what-is-new-in-1-5', 'index.php?option=com_content&view=article&id=22', 'component', 0, 27, 20, 1, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'pageclass_sfx=\nmenu_image=-1\nsecure=0\nshow_noauth=0\nshow_title=1\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(40, 'keyconcepts', 'Extensions', 'extensions', 'index.php?option=com_content&view=article&id=26', 'component', 1, 0, 20, 0, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'pageclass_sfx=\nmenu_image=-1\nsecure=0\nshow_noauth=0\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(37, 'mainmenu', 'More about Joomla!', 'more-about-joomla', 'index.php?option=com_content&view=section&id=4', 'component', 0, 0, 20, 0, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_page_title=1\nshow_description=0\nshow_description_image=0\nshow_categories=1\nshow_empty_categories=0\nshow_cat_num_articles=1\nshow_category_description=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\norderby=\nshow_noauth=0\nshow_title=1\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(43, 'keyconcepts', 'Example Pages', 'example-pages', 'index.php?option=com_content&view=article&id=43', 'component', 1, 0, 20, 0, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'pageclass_sfx=\nmenu_image=-1\nsecure=0\nshow_noauth=0\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(44, 'ExamplePages', 'Section Blog', 'section-blog', 'index.php?option=com_content&view=section&layout=blog&id=3', 'component', 1, 0, 20, 0, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_page_title=1\npage_title=Example of Section Blog layout (FAQ section)\nshow_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\nshow_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\norderby_pri=\norderby_sec=\nshow_pagination=2\nshow_pagination_results=1\nshow_noauth=0\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(45, 'ExamplePages', 'Section Table', 'section-table', 'index.php?option=com_content&view=section&id=3', 'component', 1, 0, 20, 0, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_page_title=1\npage_title=Example of Table Blog layout (FAQ section)\nshow_description=0\nshow_description_image=0\nshow_categories=1\nshow_empty_categories=0\nshow_cat_num_articles=1\nshow_category_description=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\norderby=\nshow_noauth=0\nshow_title=1\nnlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(46, 'ExamplePages', 'Category Blog', 'categoryblog', 'index.php?option=com_content&view=category&layout=blog&id=31', 'component', 1, 0, 20, 0, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_page_title=1\npage_title=Example of Category Blog layout (FAQs/General category)\nshow_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\nshow_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\norderby_pri=\norderby_sec=\nshow_pagination=2\nshow_pagination_results=1\nshow_noauth=0\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(47, 'ExamplePages', 'Category Table', 'category-table', 'index.php?option=com_content&view=category&id=32', 'component', 1, 0, 20, 0, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_page_title=1\npage_title=Example of Category Table layout (FAQs/Languages category)\nshow_headings=1\nshow_date=0\ndate_format=\nfilter=1\nfilter_type=title\npageclass_sfx=\nmenu_image=-1\nsecure=0\norderby_sec=\nshow_pagination=1\nshow_pagination_limit=1\nshow_noauth=0\nshow_title=1\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(48, 'mainmenu', 'Web Links', 'web-links', 'index.php?option=com_weblinks&view=categories', 'component', 0, 0, 4, 0, 7, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'page_title=Weblinks\nimage=-1\nimage_align=right\npageclass_sfx=\nmenu_image=-1\nsecure=0\nshow_comp_description=1\ncomp_description=\nshow_link_hits=1\nshow_link_description=1\nshow_other_cats=1\nshow_headings=1\nshow_page_title=1\nlink_target=0\nlink_icons=\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(49, 'mainmenu', 'News Feeds', 'news-feeds', 'index.php?option=com_newsfeeds&view=categories', 'component', 0, 0, 11, 0, 8, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_page_title=1\npage_title=Newsfeeds\nshow_comp_description=1\ncomp_description=\nimage=-1\nimage_align=right\npageclass_sfx=\nmenu_image=-1\nsecure=0\nshow_headings=1\nshow_name=1\nshow_articles=1\nshow_link=1\nshow_other_cats=1\nshow_cat_description=1\nshow_cat_items=1\nshow_feed_image=1\nshow_feed_description=1\nshow_item_description=1\nfeed_word_count=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(50, 'mainmenu', 'The News', 'the-news', 'index.php?option=com_content&view=category&layout=blog&id=1', 'component', 0, 0, 20, 0, 6, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_page_title=1\npage_title=The News\nshow_description=0\nshow_description_image=0\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\nshow_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\norderby_pri=\norderby_sec=\nshow_pagination=2\nshow_pagination_results=1\nshow_noauth=0\nlink_titles=0\nshow_intro=1\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(51, 'usermenu', 'Submit an Article', 'submit-an-article', 'index.php?option=com_content&view=article&layout=form', 'component', 1, 0, 20, 0, 2, 0, '0000-00-00 00:00:00', 0, 0, 2, 0, '', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(52, 'usermenu', 'Submit a Web Link', 'submit-a-web-link', 'index.php?option=com_weblinks&view=weblink&layout=form', 'component', 1, 0, 4, 0, 3, 0, '0000-00-00 00:00:00', 0, 0, 1, 0, 'show_comp_description=\ncomp_description=\nshow_link_hits=\nshow_link_description=\nshow_other_cats=\nshow_headings=\ntarget=\nlink_icons=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(53, 'topmenu', 'Home', 'home', 'index.php?option=com_content&view=frontpage', 'component', 0, 0, 20, 0, 1, 62, '2010-11-08 02:10:41', 0, 0, 0, 0, 'num_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=front\nmulti_column_order=1\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=0\nlink_section=\nshow_category=\nlink_category=\nshow_author=0\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=0\nshow_hits=\nfeed_summary=\npage_title=Welcome to the Frontpage\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(54, 'othermenu', 'Web Links', 'web-links', 'index.php?option=com_weblinks&view=categories', 'component', 1, 0, 4, 0, 7, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'image=-1\nimage_align=right\nshow_feed_link=1\nshow_comp_description=\ncomp_description=\nshow_link_hits=\nshow_link_description=\nshow_other_cats=\nshow_headings=\ntarget=\nlink_icons=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(55, 'othermenu', 'TEM Tools', 'tem-tools', 'index.php?option=com_wrapper&view=wrapper', 'component', 1, 0, 17, 0, 9, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'url=http://www.temresources.com/joomla1234567z/tem-tools.html\nscrolling=auto\nwidth=100%\nheight=500\nheight_auto=0\nadd_scheme=1\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(56, 'topmenu', 'Contact Us', 'contact-us', 'index.php?option=com_content&view=article&id=49', 'component', 1, 0, 20, 0, 6, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_noauth=0\nshow_title=0\nlink_titles=0\nshow_intro=0\nshow_section=0\nlink_section=0\nshow_category=0\nlink_category=0\nshow_author=0\nshow_create_date=0\nshow_modify_date=0\nshow_item_navigation=0\nshow_readmore=0\nshow_vote=0\nshow_icons=0\nshow_pdf_icon=0\nshow_print_icon=0\nshow_email_icon=0\nshow_hits=0\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(57, 'topmenu', 'Community', 'community', 'index.php?option=com_joobb&view=forum&forum=1', 'component', 1, 0, 35, 0, 7, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'page_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(58, 'topmenu', 'Gallery', 'gallery', 'index.php?option=com_joomgallery&view=gallery', 'component', 1, 0, 36, 0, 8, 62, '2010-11-11 02:46:09', 0, 0, 0, 0, 'page_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(59, 'othermenu', 'Invoice Formats', 'invoice-formats', 'index.php?option=com_content&view=article&id=50', 'component', 1, 0, 20, 0, 10, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);
INSERT INTO `jos_menu` VALUES(60, 'topmenu', 'Jobs', 'jobs', 'index.php?option=com_jobline', 'component', 1, 0, 49, 0, 9, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'page_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_menu_types`
--

CREATE TABLE `jos_menu_types` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `menutype` varchar(75) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `menutype` (`menutype`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `jos_menu_types`
--

INSERT INTO `jos_menu_types` VALUES(1, 'mainmenu', 'Main Menu', 'The main menu for the site');
INSERT INTO `jos_menu_types` VALUES(2, 'usermenu', 'User Menu', 'A Menu for logged in Users');
INSERT INTO `jos_menu_types` VALUES(3, 'topmenu', 'Top Menu', 'Top level navigation');
INSERT INTO `jos_menu_types` VALUES(4, 'othermenu', 'Resources', 'Additional links');
INSERT INTO `jos_menu_types` VALUES(5, 'ExamplePages', 'Example Pages', 'Example Pages');
INSERT INTO `jos_menu_types` VALUES(6, 'keyconcepts', 'Key Concepts', 'This describes some critical information for new Users.');

-- --------------------------------------------------------

--
-- Table structure for table `jos_messages`
--

CREATE TABLE `jos_messages` (
  `message_id` int(10) unsigned NOT NULL auto_increment,
  `user_id_from` int(10) unsigned NOT NULL default '0',
  `user_id_to` int(10) unsigned NOT NULL default '0',
  `folder_id` int(10) unsigned NOT NULL default '0',
  `date_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `state` int(11) NOT NULL default '0',
  `priority` int(1) unsigned NOT NULL default '0',
  `subject` text NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY  (`message_id`),
  KEY `useridto_state` (`user_id_to`,`state`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `jos_messages`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_messages_cfg`
--

CREATE TABLE `jos_messages_cfg` (
  `user_id` int(10) unsigned NOT NULL default '0',
  `cfg_name` varchar(100) NOT NULL default '',
  `cfg_value` varchar(255) NOT NULL default '',
  UNIQUE KEY `idx_user_var_name` (`user_id`,`cfg_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_messages_cfg`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_migration_backlinks`
--

CREATE TABLE `jos_migration_backlinks` (
  `itemid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` text NOT NULL,
  `sefurl` text NOT NULL,
  `newurl` text NOT NULL,
  PRIMARY KEY  (`itemid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_migration_backlinks`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_modules`
--

CREATE TABLE `jos_modules` (
  `id` int(11) NOT NULL auto_increment,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `ordering` int(11) NOT NULL default '0',
  `position` varchar(50) default NULL,
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL default '0',
  `module` varchar(50) default NULL,
  `numnews` int(11) NOT NULL default '0',
  `access` tinyint(3) unsigned NOT NULL default '0',
  `showtitle` tinyint(3) unsigned NOT NULL default '1',
  `params` text NOT NULL,
  `iscore` tinyint(4) NOT NULL default '0',
  `client_id` tinyint(4) NOT NULL default '0',
  `control` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `published` (`published`,`access`),
  KEY `newsfeeds` (`module`,`published`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `jos_modules`
--

INSERT INTO `jos_modules` VALUES(1, 'Main Menu', '', 1, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_mainmenu', 0, 0, 1, 'menutype=mainmenu\nmoduleclass_sfx=_menu\n', 1, 0, '');
INSERT INTO `jos_modules` VALUES(2, 'Login', '', 1, 'login', 0, '0000-00-00 00:00:00', 1, 'mod_login', 0, 0, 1, '', 1, 1, '');
INSERT INTO `jos_modules` VALUES(3, 'Popular', '', 3, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_popular', 0, 2, 1, '', 0, 1, '');
INSERT INTO `jos_modules` VALUES(4, 'Recent added Articles', '', 4, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_latest', 0, 2, 1, 'ordering=c_dsc\nuser_id=0\ncache=0\n\n', 0, 1, '');
INSERT INTO `jos_modules` VALUES(5, 'Menu Stats', '', 5, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_stats', 0, 2, 1, '', 0, 1, '');
INSERT INTO `jos_modules` VALUES(6, 'Unread Messages', '', 1, 'header', 0, '0000-00-00 00:00:00', 1, 'mod_unread', 0, 2, 1, '', 1, 1, '');
INSERT INTO `jos_modules` VALUES(7, 'Online Users', '', 2, 'header', 0, '0000-00-00 00:00:00', 1, 'mod_online', 0, 2, 1, '', 1, 1, '');
INSERT INTO `jos_modules` VALUES(8, 'Toolbar', '', 1, 'toolbar', 0, '0000-00-00 00:00:00', 1, 'mod_toolbar', 0, 2, 1, '', 1, 1, '');
INSERT INTO `jos_modules` VALUES(9, 'Quick Icons', '', 1, 'icon', 0, '0000-00-00 00:00:00', 1, 'mod_quickicon', 0, 2, 1, '', 1, 1, '');
INSERT INTO `jos_modules` VALUES(10, 'Logged in Users', '', 2, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_logged', 0, 2, 1, '', 0, 1, '');
INSERT INTO `jos_modules` VALUES(11, 'Footer', '', 0, 'footer', 0, '0000-00-00 00:00:00', 1, 'mod_footer', 0, 0, 1, '', 1, 1, '');
INSERT INTO `jos_modules` VALUES(12, 'Admin Menu', '', 1, 'menu', 0, '0000-00-00 00:00:00', 1, 'mod_menu', 0, 2, 1, '', 0, 1, '');
INSERT INTO `jos_modules` VALUES(13, 'Admin SubMenu', '', 1, 'submenu', 0, '0000-00-00 00:00:00', 1, 'mod_submenu', 0, 2, 1, '', 0, 1, '');
INSERT INTO `jos_modules` VALUES(14, 'User Status', '', 1, 'status', 0, '0000-00-00 00:00:00', 1, 'mod_status', 0, 2, 1, '', 0, 1, '');
INSERT INTO `jos_modules` VALUES(15, 'Title', '', 1, 'title', 0, '0000-00-00 00:00:00', 1, 'mod_title', 0, 2, 1, '', 0, 1, '');
INSERT INTO `jos_modules` VALUES(16, 'Polls', '', 1, 'right', 0, '0000-00-00 00:00:00', 1, 'mod_poll', 0, 0, 1, 'id=14\ncache=1', 0, 0, '');
INSERT INTO `jos_modules` VALUES(17, 'User Menu', '', 4, 'left', 0, '0000-00-00 00:00:00', 1, 'mod_mainmenu', 0, 1, 1, 'menutype=usermenu\nmoduleclass_sfx=_menu\ncache=1', 1, 0, '');
INSERT INTO `jos_modules` VALUES(18, 'Login Form', '', 8, 'left', 0, '0000-00-00 00:00:00', 1, 'mod_login', 0, 0, 1, 'greeting=1\nname=0', 1, 0, '');
INSERT INTO `jos_modules` VALUES(19, 'Latest News', '', 4, 'user1', 0, '0000-00-00 00:00:00', 0, 'mod_latestnews', 0, 0, 1, 'cache=1', 1, 0, '');
INSERT INTO `jos_modules` VALUES(20, 'Statistics', '', 6, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_stats', 0, 0, 1, 'serverinfo=1\nsiteinfo=1\ncounter=1\nincrease=0\nmoduleclass_sfx=', 0, 0, '');
INSERT INTO `jos_modules` VALUES(21, 'Who''s Online', '', 1, 'right', 0, '0000-00-00 00:00:00', 1, 'mod_whosonline', 0, 0, 1, 'online=1\nusers=1\nmoduleclass_sfx=', 0, 0, '');
INSERT INTO `jos_modules` VALUES(22, 'Popular', '', 6, 'user2', 0, '0000-00-00 00:00:00', 0, 'mod_mostread', 0, 0, 1, 'cache=1', 0, 0, '');
INSERT INTO `jos_modules` VALUES(23, 'Archive', '', 9, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_archive', 0, 0, 1, 'cache=1', 1, 0, '');
INSERT INTO `jos_modules` VALUES(24, 'Sections', '', 10, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_sections', 0, 0, 1, 'cache=1', 1, 0, '');
INSERT INTO `jos_modules` VALUES(25, 'Newsflash', '', 0, 'right', 0, '0000-00-00 00:00:00', 1, 'mod_newsflash', 0, 0, 1, 'catid=3\nlayout=default\nimage=0\nlink_titles=\nshowLastSeparator=1\nreadmore=0\nitem_title=0\nitems=\nmoduleclass_sfx=\ncache=0\ncache_time=900\n\n', 0, 0, '');
INSERT INTO `jos_modules` VALUES(26, 'Related Items', '', 11, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_related_items', 0, 0, 1, '', 0, 0, '');
INSERT INTO `jos_modules` VALUES(27, 'Search', '', 1, 'user4', 0, '0000-00-00 00:00:00', 1, 'mod_search', 0, 0, 0, 'cache=1', 0, 0, '');
INSERT INTO `jos_modules` VALUES(28, 'Random Image', '', 9, 'right', 0, '0000-00-00 00:00:00', 1, 'mod_random_image', 0, 0, 1, '', 0, 0, '');
INSERT INTO `jos_modules` VALUES(29, 'Top Menu', '', 1, 'user3', 0, '0000-00-00 00:00:00', 1, 'mod_mainmenu', 0, 0, 0, 'cache=1\nmenutype=topmenu\nmenu_style=list_flat\nmenu_images=n\nmenu_images_align=left\nexpand_menu=n\nclass_sfx=-nav\nmoduleclass_sfx=\nindent_image1=0\nindent_image2=0\nindent_image3=0\nindent_image4=0\nindent_image5=0\nindent_image6=0', 1, 0, '');
INSERT INTO `jos_modules` VALUES(30, 'Banners', '', 0, 'top', 0, '0000-00-00 00:00:00', 1, 'mod_banners', 0, 0, 0, 'target=1\ncount=1\ncid=1\ncatid=33\ntag_search=0\nordering=random\nheader_text=\nfooter_text=\nmoduleclass_sfx=\ncache=1\ncache_time=15\n\n', 1, 0, '');
INSERT INTO `jos_modules` VALUES(31, 'Resources', '', 2, 'left', 0, '0000-00-00 00:00:00', 1, 'mod_mainmenu', 0, 0, 1, 'menutype=othermenu\nmenu_style=list\nstartLevel=0\nendLevel=0\nshowAllChildren=0\nwindow_open=\nshow_whitespace=0\ncache=1\ntag_id=\nclass_sfx=\nmoduleclass_sfx=_menu\nmaxdepth=10\nmenu_images=0\nmenu_images_align=0\nexpand_menu=0\nactivate_parent=0\nfull_active_id=0\nindent_image=0\nindent_image1=\nindent_image2=\nindent_image3=\nindent_image4=\nindent_image5=\nindent_image6=\nspacer=\nend_spacer=\n\n', 0, 0, '');
INSERT INTO `jos_modules` VALUES(32, 'Wrapper', '', 12, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_wrapper', 0, 0, 1, '', 0, 0, '');
INSERT INTO `jos_modules` VALUES(33, 'Footer', '', 2, 'footer', 0, '0000-00-00 00:00:00', 1, 'mod_footer', 0, 0, 0, 'cache=1\n\n', 1, 0, '');
INSERT INTO `jos_modules` VALUES(34, 'Feed Display', '', 13, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_feed', 0, 0, 1, '', 1, 0, '');
INSERT INTO `jos_modules` VALUES(35, 'Breadcrumbs', '', 1, 'breadcrumb', 0, '0000-00-00 00:00:00', 1, 'mod_breadcrumbs', 0, 0, 1, 'moduleclass_sfx=\ncache=0\nshowHome=1\nhomeText=Home\nshowComponent=1\nseparator=\n\n', 1, 0, '');
INSERT INTO `jos_modules` VALUES(36, 'Syndication', '', 3, 'syndicate', 0, '0000-00-00 00:00:00', 1, 'mod_syndicate', 0, 0, 0, '', 1, 0, '');
INSERT INTO `jos_modules` VALUES(38, 'Advertisement', '', 3, 'right', 0, '0000-00-00 00:00:00', 1, 'mod_banners', 0, 0, 1, 'count=4\r\nrandomise=0\r\ncid=0\r\ncatid=14\r\nheader_text=Featured Links:\r\nfooter_text=<a href="http://www.joomla.org">Ads by Joomla!</a>\r\nmoduleclass_sfx=_text\r\ncache=0\r\n\r\n', 0, 0, '');
INSERT INTO `jos_modules` VALUES(39, 'Example Pages', '', 5, 'left', 0, '0000-00-00 00:00:00', 1, 'mod_mainmenu', 0, 0, 1, 'cache=1\nclass_sfx=\nmoduleclass_sfx=_menu\nmenutype=ExamplePages\nmenu_style=list_flat\nstartLevel=0\nendLevel=0\nshowAllChildren=0\nfull_active_id=0\nmenu_images=0\nmenu_images_align=0\nexpand_menu=0\nactivate_parent=0\nindent_image=0\nindent_image1=\nindent_image2=\nindent_image3=\nindent_image4=\nindent_image5=\nindent_image6=\nspacer=\nend_spacer=\nwindow_open=\n\n', 0, 0, '');
INSERT INTO `jos_modules` VALUES(40, 'Key Concepts', '', 3, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_mainmenu', 0, 0, 1, 'cache=1\nclass_sfx=\nmoduleclass_sfx=_menu\nmenutype=keyconcepts\nmenu_style=list\nstartLevel=0\nendLevel=0\nshowAllChildren=0\nfull_active_id=0\nmenu_images=0\nmenu_images_align=0\nexpand_menu=0\nactivate_parent=0\nindent_image=0\nindent_image1=\nindent_image2=\nindent_image3=\nindent_image4=\nindent_image5=\nindent_image6=\nspacer=\nend_spacer=\nwindow_open=\n\n', 0, 0, '');
INSERT INTO `jos_modules` VALUES(41, 'Welcome to Joomla!', '<div style="padding: 5px">  <p>   Congratulations on choosing Joomla! as your content management system. To   help you get started, check out these excellent resources for securing your   server and pointers to documentation and other helpful resources. </p> <p>   <strong>Security</strong><br /> </p> <p>   On the Internet, security is always a concern. For that reason, you are   encouraged to subscribe to the   <a href="http://feedburner.google.com/fb/a/mailverify?uri=JoomlaSecurityNews" target="_blank">Joomla!   Security Announcements</a> for the latest information on new Joomla! releases,   emailed to you automatically. </p> <p>   If this is one of your first Web sites, security considerations may   seem complicated and intimidating. There are three simple steps that go a long   way towards securing a Web site: (1) regular backups; (2) prompt updates to the   <a href="http://www.joomla.org/download.html" target="_blank">latest Joomla! release;</a> and (3) a <a href="http://docs.joomla.org/Security_Checklist_2_-_Hosting_and_Server_Setup" target="_blank" title="good Web host">good Web host</a>. There are many other important security considerations that you can learn about by reading the <a href="http://docs.joomla.org/Category:Security_Checklist" target="_blank" title="Joomla! Security Checklist">Joomla! Security Checklist</a>. </p> <p>If you believe your Web site was attacked, or you think you have discovered a security issue in Joomla!, please do not post it in the Joomla! forums. Publishing this information could put other Web sites at risk. Instead, report possible security vulnerabilities to the <a href="http://developer.joomla.org/security/contact-the-team.html" target="_blank" title="Joomla! Security Task Force">Joomla! Security Task Force</a>.</p><p><strong>Learning Joomla!</strong> </p> <p>   A good place to start learning Joomla! is the   "<a href="http://docs.joomla.org/beginners" target="_blank">Absolute Beginner''s   Guide to Joomla!.</a>" There, you will find a Quick Start to Joomla!   <a href="http://help.joomla.org/ghop/feb2008/task048/joomla_15_quickstart.pdf" target="_blank">guide</a>   and <a href="http://help.joomla.org/ghop/feb2008/task167/index.html" target="_blank">video</a>,   amongst many other tutorials. The   <a href="http://community.joomla.org/magazine/view-all-issues.html" target="_blank">Joomla!   Community Magazine</a> also has   <a href="http://community.joomla.org/magazine/article/522-introductory-learning-joomla-using-sample-data.html" target="_blank">articles   for new learners</a> and experienced users, alike. A great place to look for   answers is the   <a href="http://docs.joomla.org/Category:FAQ" target="_blank">Frequently Asked   Questions (FAQ)</a>. If you are stuck on a particular screen in the   Administrator (which is where you are now), try clicking the Help toolbar   button to get assistance specific to that page. </p> <p>   If you still have questions, please feel free to use the   <a href="http://forum.joomla.org/" target="_blank">Joomla! Forums.</a> The forums   are an incredibly valuable resource for all levels of Joomla! users. Before   you post a question, though, use the forum search (located at the top of each   forum page) to see if the question has been asked and answered. </p> <p>   <strong>Getting Involved</strong> </p> <p>   <a name="twjs" title="twjs"></a> If you want to help make Joomla! better, consider getting   involved. There are   <a href="http://www.joomla.org/about-joomla/contribute-to-joomla.html" target="_blank">many ways   you can make a positive difference.</a> Have fun using Joomla!.</p></div>', 0, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_custom', 0, 2, 1, 'moduleclass_sfx=\n\n', 1, 1, '');
INSERT INTO `jos_modules` VALUES(42, 'Joomla! Security Newsfeed', '', 6, 'cpanel', 62, '2008-10-25 20:15:17', 1, 'mod_feed', 0, 0, 1, 'cache=1\ncache_time=15\nmoduleclass_sfx=\nrssurl=http://feeds.joomla.org/JoomlaSecurityNews\nrssrtl=0\nrsstitle=1\nrssdesc=0\nrssimage=1\nrssitems=1\nrssitemdesc=1\nword_count=0\n\n', 0, 1, '');
INSERT INTO `jos_modules` VALUES(43, 'JoomGallery News', '', 1, 'joom_cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_feed', 0, 0, 1, 'cache=1\n    cache_time=15\n    moduleclass_sfx=\n    rssurl=http://www.en.joomgallery.net/feed/rss.html\n    rssrtl=0\n    rsstitle=1\n    rssdesc=0\n    rssimage=1\n    rssitems=3\n    rssitemdesc=1\n    word_count=30', 0, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `jos_modules_menu`
--

CREATE TABLE `jos_modules_menu` (
  `moduleid` int(11) NOT NULL default '0',
  `menuid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`moduleid`,`menuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_modules_menu`
--

INSERT INTO `jos_modules_menu` VALUES(1, 0);
INSERT INTO `jos_modules_menu` VALUES(16, 1);
INSERT INTO `jos_modules_menu` VALUES(17, 0);
INSERT INTO `jos_modules_menu` VALUES(18, 1);
INSERT INTO `jos_modules_menu` VALUES(19, 1);
INSERT INTO `jos_modules_menu` VALUES(19, 2);
INSERT INTO `jos_modules_menu` VALUES(19, 4);
INSERT INTO `jos_modules_menu` VALUES(19, 27);
INSERT INTO `jos_modules_menu` VALUES(19, 36);
INSERT INTO `jos_modules_menu` VALUES(21, 1);
INSERT INTO `jos_modules_menu` VALUES(22, 1);
INSERT INTO `jos_modules_menu` VALUES(22, 2);
INSERT INTO `jos_modules_menu` VALUES(22, 4);
INSERT INTO `jos_modules_menu` VALUES(22, 27);
INSERT INTO `jos_modules_menu` VALUES(22, 36);
INSERT INTO `jos_modules_menu` VALUES(25, 0);
INSERT INTO `jos_modules_menu` VALUES(27, 0);
INSERT INTO `jos_modules_menu` VALUES(29, 0);
INSERT INTO `jos_modules_menu` VALUES(30, 0);
INSERT INTO `jos_modules_menu` VALUES(31, 1);
INSERT INTO `jos_modules_menu` VALUES(32, 0);
INSERT INTO `jos_modules_menu` VALUES(33, 0);
INSERT INTO `jos_modules_menu` VALUES(34, 0);
INSERT INTO `jos_modules_menu` VALUES(35, 0);
INSERT INTO `jos_modules_menu` VALUES(36, 0);
INSERT INTO `jos_modules_menu` VALUES(38, 1);
INSERT INTO `jos_modules_menu` VALUES(39, 43);
INSERT INTO `jos_modules_menu` VALUES(39, 44);
INSERT INTO `jos_modules_menu` VALUES(39, 45);
INSERT INTO `jos_modules_menu` VALUES(39, 46);
INSERT INTO `jos_modules_menu` VALUES(39, 47);
INSERT INTO `jos_modules_menu` VALUES(40, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_newsfeeds`
--

CREATE TABLE `jos_newsfeeds` (
  `catid` int(11) NOT NULL default '0',
  `id` int(11) NOT NULL auto_increment,
  `name` text NOT NULL,
  `alias` varchar(255) NOT NULL default '',
  `link` text NOT NULL,
  `filename` varchar(200) default NULL,
  `published` tinyint(1) NOT NULL default '0',
  `numarticles` int(11) unsigned NOT NULL default '1',
  `cache_time` int(11) unsigned NOT NULL default '3600',
  `checked_out` tinyint(3) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL default '0',
  `rtl` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `published` (`published`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `jos_newsfeeds`
--

INSERT INTO `jos_newsfeeds` VALUES(4, 1, 'Joomla! Announcements', 'joomla-official-news', 'http://feeds.joomla.org/JoomlaAnnouncements', '', 1, 5, 3600, 0, '0000-00-00 00:00:00', 1, 0);
INSERT INTO `jos_newsfeeds` VALUES(4, 2, 'Joomla! Core Team Blog', 'joomla-core-team-blog', 'http://feeds.joomla.org/JoomlaCommunityCoreTeamBlog', '', 1, 5, 3600, 0, '0000-00-00 00:00:00', 2, 0);
INSERT INTO `jos_newsfeeds` VALUES(4, 3, 'Joomla! Community Magazine', 'joomla-community-magazine', 'http://feeds.joomla.org/JoomlaMagazine', '', 1, 20, 3600, 0, '0000-00-00 00:00:00', 3, 0);
INSERT INTO `jos_newsfeeds` VALUES(4, 4, 'Joomla! Developer News', 'joomla-developer-news', 'http://feeds.joomla.org/JoomlaDeveloper', '', 1, 5, 3600, 0, '0000-00-00 00:00:00', 4, 0);
INSERT INTO `jos_newsfeeds` VALUES(4, 5, 'Joomla! Security News', 'joomla-security-news', 'http://feeds.joomla.org/JoomlaSecurityNews', '', 1, 5, 3600, 0, '0000-00-00 00:00:00', 5, 0);
INSERT INTO `jos_newsfeeds` VALUES(5, 6, 'Free Software Foundation Blogs', 'free-software-foundation-blogs', 'http://www.fsf.org/blogs/RSS', NULL, 1, 5, 3600, 0, '0000-00-00 00:00:00', 4, 0);
INSERT INTO `jos_newsfeeds` VALUES(5, 7, 'Free Software Foundation', 'free-software-foundation', 'http://www.fsf.org/news/RSS', NULL, 1, 5, 3600, 62, '2008-09-14 00:24:25', 3, 0);
INSERT INTO `jos_newsfeeds` VALUES(5, 8, 'Software Freedom Law Center Blog', 'software-freedom-law-center-blog', 'http://www.softwarefreedom.org/feeds/blog/', NULL, 1, 5, 3600, 0, '0000-00-00 00:00:00', 2, 0);
INSERT INTO `jos_newsfeeds` VALUES(5, 9, 'Software Freedom Law Center News', 'software-freedom-law-center', 'http://www.softwarefreedom.org/feeds/news/', NULL, 1, 5, 3600, 0, '0000-00-00 00:00:00', 1, 0);
INSERT INTO `jos_newsfeeds` VALUES(5, 10, 'Open Source Initiative Blog', 'open-source-initiative-blog', 'http://www.opensource.org/blog/feed', NULL, 1, 5, 3600, 0, '0000-00-00 00:00:00', 5, 0);
INSERT INTO `jos_newsfeeds` VALUES(6, 11, 'PHP News and Announcements', 'php-news-and-announcements', 'http://www.php.net/feed.atom', NULL, 1, 5, 3600, 62, '2008-09-14 00:25:37', 1, 0);
INSERT INTO `jos_newsfeeds` VALUES(6, 12, 'Planet MySQL', 'planet-mysql', 'http://www.planetmysql.org/rss20.xml', NULL, 1, 5, 3600, 62, '2008-09-14 00:25:51', 2, 0);
INSERT INTO `jos_newsfeeds` VALUES(6, 13, 'Linux Foundation Announcements', 'linux-foundation-announcements', 'http://www.linuxfoundation.org/press/rss20.xml', NULL, 1, 5, 3600, 62, '2008-09-14 00:26:11', 3, 0);
INSERT INTO `jos_newsfeeds` VALUES(6, 14, 'Mootools Blog', 'mootools-blog', 'http://feeds.feedburner.com/mootools-blog', NULL, 1, 5, 3600, 62, '2008-09-14 00:26:51', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_plugins`
--

CREATE TABLE `jos_plugins` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL default '',
  `element` varchar(100) NOT NULL default '',
  `folder` varchar(100) NOT NULL default '',
  `access` tinyint(3) unsigned NOT NULL default '0',
  `ordering` int(11) NOT NULL default '0',
  `published` tinyint(3) NOT NULL default '0',
  `iscore` tinyint(3) NOT NULL default '0',
  `client_id` tinyint(3) NOT NULL default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `params` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `idx_folder` (`published`,`client_id`,`access`,`folder`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `jos_plugins`
--

INSERT INTO `jos_plugins` VALUES(1, 'Authentication - Joomla', 'joomla', 'authentication', 0, 1, 1, 1, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES(2, 'Authentication - LDAP', 'ldap', 'authentication', 0, 2, 0, 1, 0, 0, '0000-00-00 00:00:00', 'host=\nport=389\nuse_ldapV3=0\nnegotiate_tls=0\nno_referrals=0\nauth_method=bind\nbase_dn=\nsearch_string=\nusers_dn=\nusername=\npassword=\nldap_fullname=fullName\nldap_email=mail\nldap_uid=uid\n\n');
INSERT INTO `jos_plugins` VALUES(3, 'Authentication - GMail', 'gmail', 'authentication', 0, 4, 0, 0, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES(4, 'Authentication - OpenID', 'openid', 'authentication', 0, 3, 0, 0, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES(5, 'User - Joomla!', 'joomla', 'user', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', 'autoregister=1\n\n');
INSERT INTO `jos_plugins` VALUES(6, 'Search - Content', 'content', 'search', 0, 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\nsearch_content=1\nsearch_uncategorised=1\nsearch_archived=1\n\n');
INSERT INTO `jos_plugins` VALUES(7, 'Search - Contacts', 'contacts', 'search', 0, 3, 1, 1, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\n\n');
INSERT INTO `jos_plugins` VALUES(8, 'Search - Categories', 'categories', 'search', 0, 4, 1, 0, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\n\n');
INSERT INTO `jos_plugins` VALUES(9, 'Search - Sections', 'sections', 'search', 0, 5, 1, 0, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\n\n');
INSERT INTO `jos_plugins` VALUES(10, 'Search - Newsfeeds', 'newsfeeds', 'search', 0, 6, 1, 0, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\n\n');
INSERT INTO `jos_plugins` VALUES(11, 'Search - Weblinks', 'weblinks', 'search', 0, 2, 1, 1, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\n\n');
INSERT INTO `jos_plugins` VALUES(12, 'Content - Pagebreak', 'pagebreak', 'content', 0, 10000, 1, 1, 0, 0, '0000-00-00 00:00:00', 'enabled=1\ntitle=1\nmultipage_toc=1\nshowall=1\n\n');
INSERT INTO `jos_plugins` VALUES(13, 'Content - Rating', 'vote', 'content', 0, 4, 1, 1, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES(14, 'Content - Email Cloaking', 'emailcloak', 'content', 0, 5, 1, 0, 0, 0, '0000-00-00 00:00:00', 'mode=1\n\n');
INSERT INTO `jos_plugins` VALUES(15, 'Content - Code Hightlighter (GeSHi)', 'geshi', 'content', 0, 5, 0, 0, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES(16, 'Content - Load Module', 'loadmodule', 'content', 0, 6, 1, 0, 0, 0, '0000-00-00 00:00:00', 'enabled=1\nstyle=0\n\n');
INSERT INTO `jos_plugins` VALUES(17, 'Content - Page Navigation', 'pagenavigation', 'content', 0, 2, 1, 1, 0, 0, '0000-00-00 00:00:00', 'position=1\n\n');
INSERT INTO `jos_plugins` VALUES(18, 'Editor - No Editor', 'none', 'editors', 0, 0, 1, 1, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES(19, 'Editor - TinyMCE', 'tinymce', 'editors', 0, 0, 1, 1, 0, 0, '0000-00-00 00:00:00', 'mode=advanced\nskin=0\ncompressed=0\ncleanup_startup=0\ncleanup_save=2\nentity_encoding=raw\nlang_mode=0\nlang_code=en\ntext_direction=ltr\ncontent_css=1\ncontent_css_custom=\nrelative_urls=1\nnewlines=0\ninvalid_elements=applet\nextended_elements=\ntoolbar=top\ntoolbar_align=left\nhtml_height=550\nhtml_width=750\nelement_path=1\nfonts=1\npaste=1\nsearchreplace=1\ninsertdate=1\nformat_date=%Y-%m-%d\ninserttime=1\nformat_time=%H:%M:%S\ncolors=1\ntable=1\nsmilies=1\nmedia=1\nhr=1\ndirectionality=1\nfullscreen=1\nstyle=1\nlayer=1\nxhtmlxtras=1\nvisualchars=1\nnonbreaking=1\ntemplate=0\nadvimage=1\nadvlink=1\nautosave=1\ncontextmenu=1\ninlinepopups=1\nsafari=1\ncustom_plugin=\ncustom_button=\n\n');
INSERT INTO `jos_plugins` VALUES(20, 'Editor - XStandard Lite 2.0', 'xstandard', 'editors', 0, 0, 0, 1, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES(21, 'Editor Button - Image', 'image', 'editors-xtd', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES(22, 'Editor Button - Pagebreak', 'pagebreak', 'editors-xtd', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES(23, 'Editor Button - Readmore', 'readmore', 'editors-xtd', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES(24, 'XML-RPC - Joomla', 'joomla', 'xmlrpc', 0, 7, 0, 1, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES(25, 'XML-RPC - Blogger API', 'blogger', 'xmlrpc', 0, 7, 0, 1, 0, 0, '0000-00-00 00:00:00', 'catid=1\nsectionid=0\n\n');
INSERT INTO `jos_plugins` VALUES(27, 'System - SEF', 'sef', 'system', 0, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES(28, 'System - Debug', 'debug', 'system', 0, 2, 1, 0, 0, 0, '0000-00-00 00:00:00', 'queries=1\nmemory=1\nlangauge=1\n\n');
INSERT INTO `jos_plugins` VALUES(29, 'System - Legacy', 'legacy', 'system', 0, 3, 1, 1, 0, 0, '0000-00-00 00:00:00', 'route=0\n\n');
INSERT INTO `jos_plugins` VALUES(30, 'System - Cache', 'cache', 'system', 0, 4, 0, 1, 0, 0, '0000-00-00 00:00:00', 'browsercache=0\ncachetime=15\n\n');
INSERT INTO `jos_plugins` VALUES(31, 'System - Log', 'log', 'system', 0, 5, 0, 1, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES(32, 'System - Remember Me', 'remember', 'system', 0, 6, 1, 1, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES(33, 'System - Backlink', 'backlink', 'system', 0, 7, 0, 1, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES(34, 'googleAds', 'googleads', 'content', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `jos_plugins` VALUES(35, 'Editor - Joo!BB', 'joobb', 'editors-bb', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', 'emotions_per_row=26\n');
INSERT INTO `jos_plugins` VALUES(36, 'Search - Joo!BB Forum', 'joobb', 'search', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\nconvert_bb_to_html=1\n');

-- --------------------------------------------------------

--
-- Table structure for table `jos_polls`
--

CREATE TABLE `jos_polls` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `alias` varchar(255) NOT NULL default '',
  `voters` int(9) NOT NULL default '0',
  `checked_out` int(11) NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL default '0',
  `access` int(11) NOT NULL default '0',
  `lag` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `jos_polls`
--

INSERT INTO `jos_polls` VALUES(14, 'Who is the Best TEM Provider?', 'who-is-the-best-tem-provider', 11, 0, '0000-00-00 00:00:00', 1, 0, 86400);

-- --------------------------------------------------------

--
-- Table structure for table `jos_poll_data`
--

CREATE TABLE `jos_poll_data` (
  `id` int(11) NOT NULL auto_increment,
  `pollid` int(11) NOT NULL default '0',
  `text` text NOT NULL,
  `hits` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `pollid` (`pollid`,`text`(1))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `jos_poll_data`
--

INSERT INTO `jos_poll_data` VALUES(1, 14, 'Rivermine', 2);
INSERT INTO `jos_poll_data` VALUES(2, 14, 'Tangoe', 3);
INSERT INTO `jos_poll_data` VALUES(3, 14, 'Asentinel', 1);
INSERT INTO `jos_poll_data` VALUES(4, 14, 'Invoice Insight', 0);
INSERT INTO `jos_poll_data` VALUES(5, 14, 'HCL', 0);
INSERT INTO `jos_poll_data` VALUES(6, 14, 'Profitline', 2);
INSERT INTO `jos_poll_data` VALUES(7, 14, 'Anchorpoint', 3);
INSERT INTO `jos_poll_data` VALUES(8, 14, '', 0);
INSERT INTO `jos_poll_data` VALUES(9, 14, '', 0);
INSERT INTO `jos_poll_data` VALUES(10, 14, '', 0);
INSERT INTO `jos_poll_data` VALUES(11, 14, '', 0);
INSERT INTO `jos_poll_data` VALUES(12, 14, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jos_poll_date`
--

CREATE TABLE `jos_poll_date` (
  `id` bigint(20) NOT NULL auto_increment,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `vote_id` int(11) NOT NULL default '0',
  `poll_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `poll_id` (`poll_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `jos_poll_date`
--

INSERT INTO `jos_poll_date` VALUES(1, '2006-10-09 13:01:58', 1, 14);
INSERT INTO `jos_poll_date` VALUES(2, '2006-10-10 15:19:43', 7, 14);
INSERT INTO `jos_poll_date` VALUES(3, '2006-10-11 11:08:16', 7, 14);
INSERT INTO `jos_poll_date` VALUES(4, '2006-10-11 15:02:26', 2, 14);
INSERT INTO `jos_poll_date` VALUES(5, '2006-10-11 15:43:03', 7, 14);
INSERT INTO `jos_poll_date` VALUES(6, '2006-10-11 15:43:38', 7, 14);
INSERT INTO `jos_poll_date` VALUES(7, '2006-10-12 00:51:13', 2, 14);
INSERT INTO `jos_poll_date` VALUES(8, '2007-05-10 19:12:29', 3, 14);
INSERT INTO `jos_poll_date` VALUES(9, '2007-05-14 14:18:00', 6, 14);
INSERT INTO `jos_poll_date` VALUES(10, '2007-06-10 15:20:29', 6, 14);
INSERT INTO `jos_poll_date` VALUES(11, '2007-07-03 12:37:53', 2, 14);

-- --------------------------------------------------------

--
-- Table structure for table `jos_poll_menu`
--

CREATE TABLE `jos_poll_menu` (
  `pollid` int(11) NOT NULL default '0',
  `menuid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`pollid`,`menuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_poll_menu`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_sections`
--

CREATE TABLE `jos_sections` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `alias` varchar(255) NOT NULL default '',
  `image` text NOT NULL,
  `scope` varchar(50) NOT NULL default '',
  `image_position` varchar(30) NOT NULL default '',
  `description` text NOT NULL,
  `published` tinyint(1) NOT NULL default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL default '0',
  `access` tinyint(3) unsigned NOT NULL default '0',
  `count` int(11) NOT NULL default '0',
  `params` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `idx_scope` (`scope`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `jos_sections`
--

INSERT INTO `jos_sections` VALUES(1, 'News', '', 'news', 'articles.jpg', 'content', 'right', 'Select a news topic from the list below, then select a news article to read.', 1, 0, '0000-00-00 00:00:00', 3, 0, 2, '');
INSERT INTO `jos_sections` VALUES(3, 'FAQs', '', 'faqs', 'key.jpg', 'content', 'left', 'From the list below choose one of our FAQs topics, then select an FAQ to read. If you have a question which is not in this section, please contact us.', 1, 0, '0000-00-00 00:00:00', 5, 0, 23, '');
INSERT INTO `jos_sections` VALUES(4, 'About TEM Resources', '', 'about-tem-resources', '', 'content', 'left', '', 1, 0, '0000-00-00 00:00:00', 2, 0, 14, '');

-- --------------------------------------------------------

--
-- Table structure for table `jos_session`
--

CREATE TABLE `jos_session` (
  `username` varchar(150) default '',
  `time` varchar(14) default '',
  `session_id` varchar(200) NOT NULL default '0',
  `guest` tinyint(4) default '1',
  `userid` int(11) default '0',
  `usertype` varchar(50) default '',
  `gid` tinyint(3) unsigned NOT NULL default '0',
  `client_id` tinyint(3) unsigned NOT NULL default '0',
  `data` longtext,
  PRIMARY KEY  (`session_id`(64)),
  KEY `whosonline` (`guest`,`usertype`),
  KEY `userid` (`userid`),
  KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_session`
--

INSERT INTO `jos_session` VALUES('', '1291300876', 'iqo55iput98c770l7kvt2kt6q0', 1, 0, '', 0, 0, '__default|a:8:{s:15:"session.counter";i:4;s:19:"session.timer.start";i:1291300612;s:18:"session.timer.last";i:1291300713;s:17:"session.timer.now";i:1291300876;s:22:"session.client.browser";s:97:"Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.5; en-US; rv:1.9.2.12) Gecko/20101026 Firefox/3.6.12";s:8:"registry";O:9:"JRegistry":3:{s:17:"_defaultNameSpace";s:7:"session";s:9:"_registry";a:1:{s:7:"session";a:1:{s:4:"data";O:8:"stdClass":0:{}}}s:7:"_errors";a:0:{}}s:4:"user";O:5:"JUser":19:{s:2:"id";i:0;s:4:"name";N;s:8:"username";N;s:5:"email";N;s:8:"password";N;s:14:"password_clear";s:0:"";s:8:"usertype";N;s:5:"block";N;s:9:"sendEmail";i:0;s:3:"gid";i:0;s:12:"registerDate";N;s:13:"lastvisitDate";N;s:10:"activation";N;s:6:"params";N;s:3:"aid";i:0;s:5:"guest";i:1;s:7:"_params";O:10:"JParameter":7:{s:4:"_raw";s:0:"";s:4:"_xml";N;s:9:"_elements";a:0:{}s:12:"_elementPath";a:1:{i:0;s:84:"/home/content/45/4598445/html/joomla1234567z/libraries/joomla/html/parameter/element";}s:17:"_defaultNameSpace";s:8:"_default";s:9:"_registry";a:1:{s:8:"_default";a:1:{s:4:"data";O:8:"stdClass":0:{}}}s:7:"_errors";a:0:{}}s:9:"_errorMsg";N;s:7:"_errors";a:0:{}}s:13:"session.token";s:32:"8068e431cf7183b4da29a38c77e8da1c";}');
INSERT INTO `jos_session` VALUES('kdunetz', '1291300831', 'afe09e732c6c9cfbf53b60d1eba11bf0', 0, 62, 'Super Administrator', 25, 1, '__default|a:8:{s:15:"session.counter";i:10;s:19:"session.timer.start";i:1291300659;s:18:"session.timer.last";i:1291300823;s:17:"session.timer.now";i:1291300831;s:22:"session.client.browser";s:97:"Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.5; en-US; rv:1.9.2.12) Gecko/20101026 Firefox/3.6.12";s:8:"registry";O:9:"JRegistry":3:{s:17:"_defaultNameSpace";s:7:"session";s:9:"_registry";a:2:{s:7:"session";a:1:{s:4:"data";O:8:"stdClass":0:{}}s:11:"application";a:1:{s:4:"data";O:8:"stdClass":1:{s:4:"lang";s:0:"";}}}s:7:"_errors";a:0:{}}s:4:"user";O:5:"JUser":19:{s:2:"id";s:2:"62";s:4:"name";s:13:"Administrator";s:8:"username";s:7:"kdunetz";s:5:"email";s:23:"kevindunetz@hotmail.com";s:8:"password";s:32:"dd46d03c762d3e7226c63311ccc02f89";s:14:"password_clear";s:0:"";s:8:"usertype";s:19:"Super Administrator";s:5:"block";s:1:"0";s:9:"sendEmail";s:1:"1";s:3:"gid";s:2:"25";s:12:"registerDate";s:19:"2010-05-17 17:46:32";s:13:"lastvisitDate";s:19:"2010-12-02 13:53:34";s:10:"activation";s:0:"";s:6:"params";s:0:"";s:3:"aid";i:2;s:5:"guest";i:0;s:7:"_params";O:10:"JParameter":7:{s:4:"_raw";s:0:"";s:4:"_xml";N;s:9:"_elements";a:0:{}s:12:"_elementPath";a:1:{i:0;s:84:"/home/content/45/4598445/html/joomla1234567z/libraries/joomla/html/parameter/element";}s:17:"_defaultNameSpace";s:8:"_default";s:9:"_registry";a:1:{s:8:"_default";a:1:{s:4:"data";O:8:"stdClass":0:{}}}s:7:"_errors";a:0:{}}s:9:"_errorMsg";N;s:7:"_errors";a:0:{}}s:13:"session.token";s:32:"741f149681b5db2f4e87480237be60f1";}');

-- --------------------------------------------------------

--
-- Table structure for table `jos_stats_agents`
--

CREATE TABLE `jos_stats_agents` (
  `agent` varchar(255) NOT NULL default '',
  `type` tinyint(1) unsigned NOT NULL default '0',
  `hits` int(11) unsigned NOT NULL default '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_stats_agents`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_templates_menu`
--

CREATE TABLE `jos_templates_menu` (
  `template` varchar(255) NOT NULL default '',
  `menuid` int(11) NOT NULL default '0',
  `client_id` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`menuid`,`client_id`,`template`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jos_templates_menu`
--

INSERT INTO `jos_templates_menu` VALUES('rhuk_milkyway', 0, 0);
INSERT INTO `jos_templates_menu` VALUES('khepri', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jos_users`
--

CREATE TABLE `jos_users` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `username` varchar(150) NOT NULL default '',
  `email` varchar(100) NOT NULL default '',
  `password` varchar(100) NOT NULL default '',
  `usertype` varchar(25) NOT NULL default '',
  `block` tinyint(4) NOT NULL default '0',
  `sendEmail` tinyint(4) default '0',
  `gid` tinyint(3) unsigned NOT NULL default '1',
  `registerDate` datetime NOT NULL default '0000-00-00 00:00:00',
  `lastvisitDate` datetime NOT NULL default '0000-00-00 00:00:00',
  `activation` varchar(100) NOT NULL default '',
  `params` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `usertype` (`usertype`),
  KEY `idx_name` (`name`),
  KEY `gid_block` (`gid`,`block`),
  KEY `username` (`username`),
  KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `jos_users`
--

INSERT INTO `jos_users` VALUES(62, 'Administrator', 'kdunetz', 'kevindunetz@hotmail.com', 'dd46d03c762d3e7226c63311ccc02f89', 'Super Administrator', 0, 1, 25, '2010-05-17 17:46:32', '2010-12-02 14:37:44', '', '');
INSERT INTO `jos_users` VALUES(63, 'Kevin Dunetz', 'kevindunetz', 'kevindunetz@gmail.com', '3391cf625757e18826a20bd2346241d7:Q3okNy7QBpth8USMH59zKWKoPWSH2JLH', 'Author', 0, 0, 19, '2010-11-07 16:10:03', '2010-11-11 13:40:06', '', 'language=\ntimezone=0\n\n');

-- --------------------------------------------------------

--
-- Table structure for table `jos_weblinks`
--

CREATE TABLE `jos_weblinks` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `catid` int(11) NOT NULL default '0',
  `sid` int(11) NOT NULL default '0',
  `title` varchar(250) NOT NULL default '',
  `alias` varchar(255) NOT NULL default '',
  `url` varchar(250) NOT NULL default '',
  `description` text NOT NULL,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `hits` int(11) NOT NULL default '0',
  `published` tinyint(1) NOT NULL default '0',
  `checked_out` int(11) NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL default '0',
  `archived` tinyint(1) NOT NULL default '0',
  `approved` tinyint(1) NOT NULL default '1',
  `params` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `catid` (`catid`,`published`,`archived`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `jos_weblinks`
--

INSERT INTO `jos_weblinks` VALUES(1, 2, 0, 'Joomla!', 'joomla', 'http://www.joomla.org', 'Home of Joomla!', '2005-02-14 15:19:02', 3, 0, 0, '0000-00-00 00:00:00', 1, 0, 1, 'target=0');
INSERT INTO `jos_weblinks` VALUES(2, 2, 0, 'php.net', 'php', 'http://www.php.net', 'The language that Joomla! is developed in', '2004-07-07 11:33:24', 6, 0, 0, '0000-00-00 00:00:00', 3, 0, 1, '');
INSERT INTO `jos_weblinks` VALUES(3, 2, 0, 'MySQL', 'mysql', 'http://www.mysql.com', 'The database that Joomla! uses', '2004-07-07 10:18:31', 1, 0, 0, '0000-00-00 00:00:00', 5, 0, 1, '');
INSERT INTO `jos_weblinks` VALUES(4, 2, 0, 'OpenSourceMatters', 'opensourcematters', 'http://www.opensourcematters.org', 'Home of OSM', '2005-02-14 15:19:02', 11, 0, 0, '0000-00-00 00:00:00', 2, 0, 1, 'target=0');
INSERT INTO `jos_weblinks` VALUES(5, 2, 0, 'Joomla! - Forums', 'joomla-forums', 'http://forum.joomla.org', 'Joomla! Forums', '2005-02-14 15:19:02', 4, 0, 0, '0000-00-00 00:00:00', 4, 0, 1, 'target=0');
INSERT INTO `jos_weblinks` VALUES(6, 2, 0, 'Ohloh Tracking of Joomla!', 'ohloh-tracking-of-joomla', 'http://www.ohloh.net/projects/20', 'Objective reports from Ohloh about Joomla''s development activity. Joomla! has some star developers with serious kudos.', '2007-07-19 09:28:31', 1, 0, 0, '0000-00-00 00:00:00', 6, 0, 1, 'target=0\n\n');
INSERT INTO `jos_weblinks` VALUES(7, 34, 0, 'RIvermine', 'rivermine', 'http://www.rivermine.com', '', '2010-11-07 16:59:34', 1, 1, 0, '0000-00-00 00:00:00', 1, 0, 1, 'target=\n\n');
INSERT INTO `jos_weblinks` VALUES(8, 34, 0, 'Tangoe', 'tangoe', 'http://www.tangoe.com', '', '2010-11-07 16:59:55', 0, 1, 0, '0000-00-00 00:00:00', 2, 0, 1, 'target=\n\n');
INSERT INTO `jos_weblinks` VALUES(9, 36, 0, 'CCMI', 'ccmi', 'http://www.ccmi.com', '', '2010-11-07 17:00:18', 1, 1, 0, '0000-00-00 00:00:00', 1, 0, 1, 'target=\n\n');
INSERT INTO `jos_weblinks` VALUES(10, 34, 0, 'Asentinel', 'asentinel', 'http://www.asentinel.com', '', '2010-11-08 04:12:19', 0, 1, 0, '0000-00-00 00:00:00', 3, 0, 1, 'target=\n\n');
INSERT INTO `jos_weblinks` VALUES(11, 41, 0, 'Invoice Insight', 'invoice-insight', 'http://www.invoiceinsight.com', '', '2010-11-08 04:16:53', 0, 1, 0, '0000-00-00 00:00:00', 1, 0, 1, 'target=\n\n');
INSERT INTO `jos_weblinks` VALUES(12, 36, 0, 'Tariff Net', 'tariff-net', 'http://www.tariffnet.com/', '', '2010-11-08 15:03:06', 0, 1, 0, '0000-00-00 00:00:00', 2, 0, 1, 'target=\n\n');
INSERT INTO `jos_weblinks` VALUES(13, 41, 0, 'Anchor Point', 'anchor-point', 'http://www.anchorpoint.com', '', '2010-11-08 15:04:42', 0, 1, 0, '0000-00-00 00:00:00', 2, 0, 1, 'target=\n\n');
INSERT INTO `jos_weblinks` VALUES(14, 41, 0, 'Profitline', 'profitline', 'http://www.profitline.com', '', '2010-11-08 15:05:38', 0, 1, 0, '0000-00-00 00:00:00', 3, 0, 1, 'target=\n\n');
INSERT INTO `jos_weblinks` VALUES(15, 39, 0, 'IPS', 'ips', 'http://www.imageserv.com/', '', '2010-11-08 15:06:42', 0, 1, 0, '0000-00-00 00:00:00', 1, 0, 1, 'target=\n\n');
INSERT INTO `jos_weblinks` VALUES(16, 41, 0, 'HCL/Control Point Solutions', 'hcl-control-point-solutions', 'http://www.controlpointsolutions.com', '', '2010-11-08 15:12:06', 0, 1, 0, '0000-00-00 00:00:00', 4, 0, 1, 'target=\n\n');
INSERT INTO `jos_weblinks` VALUES(17, 34, 0, 'TEM Specialists', 'tem-specials', 'http://www.temspecialists.com', '', '2010-11-11 14:00:31', 0, 1, 0, '0000-00-00 00:00:00', 4, 0, 1, 'target=\n\n');

