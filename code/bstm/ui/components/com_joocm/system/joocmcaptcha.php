<?php
/**
 * @version $Id: joocmcaptcha.php 22 2009-12-25 20:07:22Z sterob $
 * @package Joo!CM
 * @copyright Copyright (C) 2007-2009 Joo!BB Project. All rights reserved.
 * @license GNU/GPL. Please see license.php in Joo!CM directory 
 * for copyright notices and details.
 * Joo!CM is free software. This version may have been NOT modified.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Joo!CM Captcha
 *
 * @package Joo!CM
 */
class JoocmCaptcha
{

	/**
	 * character set
	 *
	 * @var string
	 */	
	var $_characterSet;
	
	function JoocmCaptcha() {
		$joocmConfig =& JoocmConfig::getInstance();
		
		$this->_characterSet = $joocmConfig->getCaptchaSettings('character_set');
		if ($this->_characterSet == '') {
			$this->_characterSet = "abcdefghjkmnpqrstuvwxyz23456789";
		}
	}
	
	/**
	 * get a joocm captcha object
	 *
	 * @access public
	 * @return object of JoocmCaptcha
	 */
	function &getInstance() {
	
		static $joocmCaptcha;

		if (!is_object($joocmCaptcha)) {
			$joocmCaptcha = new JoocmCaptcha();
		}

		return $joocmCaptcha;
	}

	function prepare() { 

		$codeString = $this->getCodeString(4);
		
		$session =& JFactory::getSession();
		
//		echo ' letzer wert: ' .$session->set('captcha_code_blank', $codeString);
				
		$session->set('captcha_code', md5($codeString));
				
//echo 'code string: '.$codeString.' ';
//echo 'code crypted: '.$session->get('captcha_code');
		$savedSession = $_SESSION; 
		session_write_close();
		ini_set('session.save_handler', 'files'); 
		session_start();

		$_SESSION['captcha_code'] = $codeString;
//echo 'session: '.$_SESSION['captcha_code'].' ';
		session_write_close();
//echo 'session: '.$_SESSION['captcha_code'].' ';
		ini_set('session.save_handler', 'user'); 
		new JSessionStorageDatabase();
		session_start(); 
		$_SESSION = $savedSession;
//echo ' code : '.$session->get('captcha_code_blank');
	}
	
	function getCodeString($lengh) { 
		srand($this->makeSeed());
		
		$codeString = '';
		while(strlen($codeString) < $lengh) {
			$codeString .= substr($this->_characterSet, (rand() % (strlen($this->_characterSet))), 1); 
		}

		return($codeString); 
	}
	
	function makeSeed(){ 
		list($usec, $sec) = explode (' ', microtime()); 
		return (float) $sec + ((float) $usec * 100000); 
	}
}
?>