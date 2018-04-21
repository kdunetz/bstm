<?php
/**
 * @version $Id: captchaimage.php 22 2009-12-25 20:07:22Z sterob $
 * @package Joo!CM
 * @copyright Copyright (C) 2007-2009 Joo!BB Project. All rights reserved.
 * @license GNU/GPL. Please see license.php in Joo!CM directory 
 * for copyright notices and details.
 * Joo!CM is free software. This version may have been NOT modified.
 */

define('DS', DIRECTORY_SEPARATOR);

define('JOOCM_CAPTCHABASE', dirname(__FILE__));
define('JOOCM_CAPTCHAFONTS', JOOCM_CAPTCHABASE.DS.'fonts');
define('JOOCM_CAPTCHAIMAGES', JOOCM_CAPTCHABASE.DS.'images');

/**
 * Joo!CM Captcha
 *
 * @package Joo!CM
 */
class JoocmCaptchaImage
{
	/**
	 * image file list
	 *
	 * @var array
	 */
	var $_imageFileList;

	/**
	 * font file list
	 *
	 * @var array
	 */
	var $_fontFileList;

	function JoocmCaptchaImage() {
		$this->setImageList();
		$this->setFontList();
	}
	
	/**
	 * get a joocm captcha object
	 *
	 * @access public
	 * @return object of JoocmCaptcha
	 */
	function &getInstance() {
	
		static $joocmCaptchaImage;

		if (!is_object($joocmCaptchaImage)) {
			$joocmCaptchaImage = new JoocmCaptchaImage();
		}

		return $joocmCaptchaImage;
	}

	function createImage($codeText) {
	
		header('Content-type: image/png'); 
	
		// create a background image
		$captchaImage = ImageCreateFromPNG($this->getRandomImage());

		$color = ImageColorAllocate($captchaImage, 255, 255, 255);

		$codeTextLength = strlen($codeText);
		$this->segmentSize = (int)(ImageSX($captchaImage) / $codeTextLength);
		for ($i=0; $i < $codeTextLength; $i++) {
			$this->drawCharacter($captchaImage, $codeText[$i], $i);
		}
		
		ImagePNG($captchaImage);
		ImageDestroy($captchaImage);
	}

	function drawCharacter($captchaImage, $character, $characterPos) {
	
		// get random font
		$characterFont = JOOCM_CAPTCHAFONTS.DS.$this->_fontFileList[array_rand($this->_fontFileList)];
		
		// get random colour
		$textColour = ImageColorAllocate($captchaImage, rand(120, 125), rand(120, 125), rand(120, 125));

		// get random font size
		$fontSize = rand(25, 30);
		
		// get random angle
		$angle = rand(-30, 30);
		
		// get the points of the bounding box of the character
		$characterDetails = ImageTTFBBox($fontSize, $angle, $characterFont, $character);
		
		/**
			0 lower left corner, X position 
			1 lower left corner, Y position 
			2 lower right corner, X position 
			3 lower right corner, Y position 
			4 upper right corner, X position 
			5 upper right corner, Y position 
			6 upper left corner, X position 
			7 upper left corner, Y position
		*/		

		// calculate character starting coordinates
		$posX = $characterPos * $this->segmentSize+10;
		$posY = rand(ImageSY($captchaImage) - ($characterDetails[1] - $characterDetails[7]), ImageSY($captchaImage)-10);
		
		// draw the character
		ImageTTFText($captchaImage, $fontSize, $angle, $posX, $posY, $textColour, $characterFont, $character);
	}
	
	function getRandomImage() {
		return JOOCM_CAPTCHAIMAGES.DS.$this->_imageFileList[array_rand($this->_imageFileList)];
	}
			
	function setImageList() {
		if (empty($this->_imageFileList)) {
			$this->_imageFileList = array();
			$this->_imageFileList = $this->getFileList(JOOCM_CAPTCHAIMAGES, '.png');
		}
	}
	
	function setFontList() {
		if (empty($this->_fontFileList)) {
			$this->_fontFileList = array();
			$this->_fontFileList = $this->getFileList(JOOCM_CAPTCHAFONTS, '.ttf');
		}
	}
	
	function getFileList($path, $filter = '.') { 
	
		// initialize variables
		$files = array();

		if (is_dir($path)) {
			$handle = opendir($path);
			while (($file = readdir($handle)) !== false) {
				if (($file != '.') && ($file != '..')) {
					if (preg_match("/$filter/", strtolower($file))) {
						$files[] = $file;
					}
				}
			}
			closedir($handle);
			asort($files);
		} else {
			$files = NULL;
		}
		return $files;
	}
}
?>