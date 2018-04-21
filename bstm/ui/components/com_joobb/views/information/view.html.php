<?php
/**
 * @version $Id: view.html.php 135 2010-08-13 10:03:14Z sterob $
 * @package Joo!BB
 * @copyright Copyright (C) 2007-2010 Joo!BB Project. All rights reserved.
 * @license GNU/GPL. Please see license.php in Joo!BB directory 
 * for copyright notices and details.
 * Joo!BB is free software. This version may have been NOT modified.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

/**
 * Joo!BB Information View
 *
 * @package Joo!BB
 */
class JoobbViewInformation extends JView
{

	function display($tpl = null) {

		// initialize variables
		$this->assignRef('info', JRequest::getVar('info', ''));

		// handle page title
		$this->document->setTitle(JText::_('BB_INFORMATION'));
		
		// handle metadata
		$this->document->setDescription($this->joobbConfig->getBoardSettings('description'));
		$this->document->setMetadata('keywords', $this->joobbConfig->getBoardSettings('keywords'));
		
		// handle bread crumb
		$this->breadCrumbs->addBreadCrumb(JText::_('BB_INFORMATION'), '');
		
		parent::display($tpl);
	}
	
	function loadInformation() {

		// initialize variables
		$infoFile = $this->templatePath.DS.'information'.DS.$this->info.'.php';

		jimport('joomla.filesystem.file');
		if (JFile::exists($infoFile)) {
			include $infoFile;
		} else {
			JError::raiseError(500, JText::sprintf('BB_MSGFILENOTFOUND', $infoFile)); 
		}
	}
	
}
?>