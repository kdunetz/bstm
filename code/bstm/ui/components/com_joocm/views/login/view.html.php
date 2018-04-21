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
 * Joo!CM Login View
 *
 * @package Joo!CM
 */
class JoocmViewLogin extends JView
{

	function display($tpl = null) {

		if ($this->joocmUser->get('id') > 0) {
			$this->app->redirect(JoocmHelper::getLink('main'), JText::_('CM_MSGALREADYLOGGEDIN'), 'notice');
		}
		
		// handle page title
		$this->document->setTitle($this->joocmConfig->getConfigSettings('community_name') .' - '. JText::_('CM_LOGIN'));
		
		// handle metadata
		$this->document->setDescription(JText::sprintf('CM_LOGINATCOMMUNITYNAME', $this->joocmConfig->getConfigSettings('community_name')));
		$this->document->setMetadata('keywords', JText::_('CM_LOGIN'). ', '. $this->joocmConfig->getConfigSettings('keywords'));
		
		// handle bread crumb
		$this->breadCrumbs->addItem(JText::_('CM_LOGIN'));
		
		$this->assignRef('captchaLogin', $this->joocmConfig->getCaptchaSettings('captcha_login'));
		
		if ($this->captchaLogin) {
			$joocmGD =& JoocmGD::getInstance();
		
			if ($joocmGD->isEnabled()) {
				$session =& JFactory::getSession();
				$this->assignRef('sessionId', $session->getId());
				
				$joocmCaptcha =& JoocmCaptcha::getInstance();
				$joocmCaptcha->prepare();
			} else {
				$this->app->enqueueMessage(JText::_('CM_MSGGDNOTAVAILABLE'), 'error');
				$this->app->enqueueMessage(JText::_('CM_MSGCAPTCHADISABLED'), 'notice');
				$this->assignRef('captchaLogin', 0);
			}
		}
		
		parent::display($tpl);
	}
}
?>