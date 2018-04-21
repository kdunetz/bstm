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
 * Joo!CM Reset Login View
 *
 * @package Joo!CM
 */
class JoocmViewResetLogin extends JView
{

	function display($tpl = null) {

		// initialize variables
		$activation	= JRequest::getVar('activation', '');
		$joocmUser = $this->get('joocmuser');

		if (!is_object($joocmUser) || $activation == '' || $joocmUser->get('activation') != $activation) {
			$this->app->redirect(JRoute::_('index.php?option=com_joocm&view=information&info=reset_failure&Itemid='.$this->Itemid, false));		
		}
				
		// this overrides the session user
		$this->assignRef('joocmUser', $joocmUser);

		$this->assign('activation', $activation);

		// handle page title
		$this->document->setTitle($this->joocmConfig->getConfigSettings('community_name') .' - '. JText::_('CM_RESETLOGIN'));
		
		// handle metadata
		$this->document->setDescription(JText::sprintf('CM_LOGINRESETFORUSERATCOMMUNITYNAME', $joocmUser->get('name'), $this->joocmConfig->getConfigSettings('community_name')));
		$this->document->setMetadata('keywords', JText::_('CM_RESETLOGIN'). ', '. $this->joocmConfig->getConfigSettings('community_name'));
		
		// handle bread crumb
		$this->breadCrumbs->addItem(JText::_('CM_RESETLOGIN'));

		parent::display($tpl);
	}
}
?>