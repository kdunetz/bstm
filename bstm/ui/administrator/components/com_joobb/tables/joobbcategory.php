<?php
/**
 * @version $Id: joobbcategory.php 131 2010-07-24 09:09:45Z sterob $
 * @package Joo!BB
 * @copyright Copyright (C) 2007-2010 Joo!BB Project. All rights reserved.
 * @license GNU/GPL. Please see license.php in Joo!BB directory 
 * for copyright notices and details.
 * Joo!BB is free software. This version may have been NOT modified.
 */
 
/**
 * Joobb Category Table Class
 *
 * @package Joo!BB
 */
class JTableJoobbCategory extends JTable {
	/** @var int Unique id*/
	var $id					= null;
	/** @var string */
	var $name				= null;
	/** @var int */
	var $published			= null;
	/** @var int */
	var $ordering			= null;
	/** @var int */
	var $checked_out		= null;	
	/** @var datetime */
	var $checked_out_time	= null;
														
	/**
	 * @param database A database connector object
	 */
	function __construct(&$db) {
		parent::__construct('#__joobb_categories', 'id', $db);
	}
}
?>