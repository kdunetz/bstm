<?php
/**
 * @version $Id: view.html.php 133 2010-07-27 11:45:15Z sterob $
 * @package Joo!CM
 * @copyright Copyright (C) 2007-2010 Joo!BB Project. All rights reserved.
 * @license GNU/GPL. Please see license.php in Joo!CM directory 
 * for copyright notices and details.
 * Joo!CM is free software. This version may have been NOT modified.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

/**
 * Joo!CM Edit Account View
 *
 * @package Joo!CM
 */
class JoocmViewEditAccount extends JView
{

	function display($tpl = null) {

		if ($this->joocmUser->get('id') < 1) {
			$this->app->redirect(JoocmHelper::getLink('login'), JText::_('CM_MSGNOPERMISSIONEDITACCOUNT'), 'notice');
		}

		// handle page title
		$this->document->setTitle($this->joocmConfig->getConfigSettings('community_name') .' - '. JText::_('CM_MYACCOUNT'));
		
		// handle bread crumb
		$this->breadCrumbs->addItem(JText::_('CM_MYACCOUNT'));
		
		// handle metadata
		$this->document->setDescription($this->joocmConfig->getConfigSettings('description'));
		$this->document->setMetadata('keywords', $this->joocmConfig->getConfigSettings('keywords'));
			
		parent::display($tpl);
	}
}
?>