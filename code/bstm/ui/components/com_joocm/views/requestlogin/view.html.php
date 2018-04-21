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
 * Joo!CM Request Login View
 *
 * @package Joo!CM
 */
class JoocmViewRequestLogin extends JView
{

	function display( $tpl = null ) {

		// handle page title
		$this->document->setTitle($this->joocmConfig->getConfigSettings('community_name') .' - '. JText::_('CM_REQUESTLOGIN'));
		
		// handle metadata
		$this->document->setDescription(JText::sprintf('CM_LOGINREQUESTFORCOMMUNITYNAME', $this->joocmConfig->getConfigSettings('community_name')));
		$this->document->setMetadata('keywords', JText::_('CM_REQUESTLOGIN'). ', '. $this->joocmConfig->getConfigSettings('community_name'));
				
		// handle bread crumb
		$this->breadCrumbs->addItem(JText::_('CM_REQUESTLOGIN'));
		
		$this->assignRef('captchaRequestLogin', $this->joocmConfig->getCaptchaSettings('captcha_requestlogin'));
		
		if ($this->captchaRequestLogin) {
			$joocmGD =& JoocmGD::getInstance();
		
			if ($joocmGD->isEnabled()) {
				$session =& JFactory::getSession();
				$this->assignRef('sessionId', $session->getId());
				
				$joocmCaptcha =& JoocmCaptcha::getInstance();
				$joocmCaptcha->prepare();
			} else {
				$this->app->enqueueMessage(JText::_('CM_MSGGDNOTAVAILABLE'), 'error');
				$this->app->enqueueMessage(JText::_('CM_MSGCAPTCHADISABLED'), 'notice');
				$this->assignRef('captchaRequestLogin', 0);
			}
		}
		
		parent::display($tpl);
	}
}
?>