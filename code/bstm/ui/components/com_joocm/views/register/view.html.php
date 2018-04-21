<?php
/**
 * @version $Id: view.html.php 133 2010-07-27 11:45:15Z sterob $
 * @package Joo!CM
 * @copyright Copyright (C) 2007-2009 Joo!BB Project. All rights reserved.
 * @license GNU/GPL. Please see license.php in Joo!CM directory 
 * for copyright notices and details.
 * Joo!CM is free software. This version may have been NOT modified.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

/**
 * Joo!CM Register View
 *
 * @package Joo!CM
 */
class JoocmViewRegister extends JView
{

	function display($tpl = null) {

		if ($this->joocmUser->get('id') > 0) {
			$this->app->redirect(JoocmHelper::getLink('login'), JText::_('CM_MSGALREADYLOGGEDIN'), 'notice');
		}

		$session =& JFactory::getSession();
		$joocmRegisterForm = $session->get('joocmRegisterForm');
		$session->set('joocmRegisterForm', null);

		if ($this->joocmConfig->getConfigSettings('enable_terms') && !JRequest::getVar('agreed_terms', 0, '', 'int') && !$joocmRegisterForm) {
			$this->app->redirect(JoocmHelper::getLink('terms'));
		}
		
		$joocmUser = new JoocmUser(0, true);
		
		if ($joocmRegisterForm) {
			$joocmUser->bind($joocmRegisterForm);
		}

		// handle page title
		$this->document->setTitle($this->joocmConfig->getConfigSettings('community_name') .' - '. JText::_('CM_REGISTRATION'));

		// handle bread crumb
		$this->breadCrumbs->addItem(JText::_('CM_REGISTRATION'));		
		
		// handle metadata
		$this->document->setDescription(JText::sprintf('CM_REGISTERATCOMMUNITYNAME', $this->joocmConfig->getConfigSettings('community_name')));
		$this->document->setMetadata('keywords', JText::_('CM_REGISTER'). ', '. $this->joocmConfig->getConfigSettings('keywords'));

		$this->assignRef('joocmUser', $joocmUser);

		$this->assignRef('captchaRegister', $this->joocmConfig->getCaptchaSettings('captcha_register'));
		
		if ($this->captchaRegister) {
			$joocmGD =& JoocmGD::getInstance();
		
			if ($joocmGD->isEnabled()) {
				$session =& JFactory::getSession();
				$this->assignRef('sessionId', $session->getId());
				
				$joocmCaptcha =& JoocmCaptcha::getInstance();
				$joocmCaptcha->prepare();
			} else {
				$this->app->enqueueMessage(JText::_('CM_MSGGDNOTAVAILABLE'), 'error');
				$this->app->enqueueMessage(JText::_('CM_MSGCAPTCHADISABLED'), 'notice');
				$this->assignRef('captchaRegister', 0);
			}
		}

		parent::display($tpl);
	}
}
?>