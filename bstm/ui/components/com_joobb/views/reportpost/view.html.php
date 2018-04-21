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
 * Joo!BB Report View
 *
 * @package Joo!BB
 */
class JoobbViewReportPost extends JView
{

	function display($tpl = null) {

		// initialize variables
		$postId = JRequest::getVar('post', 0, '', 'int');

		// load form validation behavior
		JHTML::_('behavior.formvalidation');
		
		// handle page title
		$this->document->setTitle(JText::_('BB_REPORTPOST'));
		
		// handle bread crumb
		$this->breadCrumbs->addBreadCrumb(JText::_('BB_REPORTPOST'), '');

		$this->assignRef('postId', $postId);
		
		// get buttons
		$joobbButtonSet	=& JoobbButtonSet::getInstance();
		$this->assignRef('buttonSubmit', $joobbButtonSet->buttonByFunction['buttonSubmit']);
		$this->assignRef('buttonCancel', $joobbButtonSet->buttonByFunction['buttonCancel']);
				
		parent::display($tpl);
	}
}
?>