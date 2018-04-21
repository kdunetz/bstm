<?php
/**
 * @version $Id: joobbeditorhtml.php 180 2010-10-03 12:36:37Z sterob $
 * @package Joo!BB
 * @copyright Copyright (C) 2007-2009 Joo!BB Project. All rights reserved.
 * @license GNU/GPL. Please see license.php in Joo!BB directory 
 * for copyright notices and details.
 * Joo!BB is free software. This version may have been NOT modified.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Joo!BB Editor Plugin
 *
 * @package Joo!BB
 */
class JoobbEditorHtml {

	/**
	 * constructor
	 */
	function JoobbEditorHtml() {
	}

	/**
	 * get editor buttons
	 */
	function getButtons($name, $params) {
		$html = '<div class="jbEditorButtons">';

		// button bold
		if ($params->get('show_button_bold', 1)) {
			$html .= '<a href="javascript:addBBCode(\''. $name .'\', \'b\')" class="jbEditorButton" target="_self">';
			$html .= '<img src="'.JOOBB_EDITOR_IMAGES_LIVE.DL.'bold.png'.'" title="'. JText::_('BB_EDITORBUTTONBOLD') .'" class="jbEditorButton" />';
			$html .= '</a>';
		}
		
		// button italic
		if ($params->get('show_button_italic', 1)) {
			$html .= '<a href="javascript:addBBCode(\''. $name .'\', \'i\')" class="jbEditorButton" target="_self">';
			$html .= '<img src="'.JOOBB_EDITOR_IMAGES_LIVE.DL.'italic.png'.'" title="'. JText::_('BB_EDITORBUTTONITALIC') .'" class="jbEditorButton" />';
			$html .= '</a>';
		}
		
		// button underline
		if ($params->get('show_button_underline', 1)) {
			$html .= '<a href="javascript:addBBCode(\''. $name .'\', \'u\')" class="jbEditorButton" target="_self">';
			$html .= '<img src="'.JOOBB_EDITOR_IMAGES_LIVE.DL.'underline.png'.'" title="'. JText::_('BB_EDITORBUTTONUNDERLINE') .'" class="jbEditorButton" />';
			$html .= '</a>';
		}
		
		// button strikeout
		if ($params->get('show_button_strikeout', 1)) {
			$html .= '<a href="javascript:addBBCode(\''. $name .'\', \'s\')" class="jbEditorButton" target="_self">';
			$html .= '<img src="'.JOOBB_EDITOR_IMAGES_LIVE.DL.'strikeout.png'.'" title="'. JText::_('BB_EDITORBUTTONSTRIKEOUT') .'" class="jbEditorButton" />';
			$html .= '</a>';
		}

		// button left
		if ($params->get('show_button_left', 1)) {
			$html .= '<a href="javascript:addBBCode(\''. $name .'\', \'left\')" class="jbEditorButton" target="_self">';
			$html .= '<img src="'.JOOBB_EDITOR_IMAGES_LIVE.DL.'left.png'.'" title="'. JText::_('BB_EDITORBUTTONLEFT') .'" class="jbEditorButton" />';
			$html .= '</a>';
		}

		// button center
		if ($params->get('show_button_center', 1)) {
			$html .= '<a href="javascript:addBBCode(\''. $name .'\', \'center\')" class="jbEditorButton" target="_self">';
			$html .= '<img src="'.JOOBB_EDITOR_IMAGES_LIVE.DL.'center.png'.'" title="'. JText::_('BB_EDITORBUTTONCENTER') .'" class="jbEditorButton" />';
			$html .= '</a>';
		}

		// button right
		if ($params->get('show_button_right', 1)) {
			$html .= '<a href="javascript:addBBCode(\''. $name .'\', \'right\')" class="jbEditorButton" target="_self">';
			$html .= '<img src="'.JOOBB_EDITOR_IMAGES_LIVE.DL.'right.png'.'" title="'. JText::_('BB_EDITORBUTTONRIGHT') .'" class="jbEditorButton" />';
			$html .= '</a>';
		}

		// button justify
		if ($params->get('show_button_justify', 1)) {
			$html .= '<a href="javascript:addBBCode(\''. $name .'\', \'justify\')" class="jbEditorButton" target="_self">';
			$html .= '<img src="'.JOOBB_EDITOR_IMAGES_LIVE.DL.'justify.png'.'" title="'. JText::_('BB_EDITORBUTTONJUSTIFY') .'" class="jbEditorButton" />';
			$html .= '</a>';
		}
		
		// button img
		if ($params->get('show_button_image', 1)) {
			$html .= '<a href="javascript:addBBCode(\''. $name .'\', \'img\')" class="jbEditorButton" target="_self">';
			$html .= '<img src="'.JOOBB_EDITOR_IMAGES_LIVE.DL.'image.png'.'" title="'. JText::_('BB_EDITORBUTTONIMAGE') .'" class="jbEditorButton" />';
			$html .= '</a>';
		}

		// button url
		if ($params->get('show_button_url', 1)) {
			$html .= '<a href="javascript:addBBCode(\''. $name .'\', \'url\')" class="jbEditorButton" target="_self">';
			$html .= '<img src="'.JOOBB_EDITOR_IMAGES_LIVE.DL.'url.png'.'" title="'. JText::_('BB_EDITORBUTTONURL') .'" class="jbEditorButton" />';
			$html .= '</a>';
		}
		
		// button e-mail
		if ($params->get('show_button_email', 1)) {
			$html .= '<a href="javascript:addBBCode(\''. $name .'\', \'email\')" class="jbEditorButton" target="_self">';
			$html .= '<img src="'.JOOBB_EDITOR_IMAGES_LIVE.DL.'email.png'.'" title="'. JText::_('BB_EDITORBUTTONEMAIL') .'" class="jbEditorButton" />';
			$html .= '</a>';
		}
									
		// button code
		if ($params->get('show_button_code', 1)) {
			$html .= '<a href="javascript:addBBCode(\''. $name .'\', \'code\')" class="jbEditorButton" target="_self">';
			$html .= '<img src="'.JOOBB_EDITOR_IMAGES_LIVE.DL.'code.png'.'" title="'. JText::_('BB_EDITORBUTTONCODE') .'" class="jbEditorButton" />';
			$html .= '</a>';
		}

		// button bullist
		if ($params->get('show_button_bullist', 1)) {
			$html .= '<a href="javascript:addBBCode(\''. $name .'\', \'list\')" class="jbEditorButton" target="_self">';
			$html .= '<img src="'.JOOBB_EDITOR_IMAGES_LIVE.DL.'bullist.png'.'" title="'. JText::_('BB_EDITORBUTTONBULLIST') .'" class="jbEditorButton" />';
			$html .= '</a>';
		}
		
		// button bollist
		if ($params->get('show_button_bollist', 1)) {
			$html .= '<a href="javascript:addBBCode(\''. $name .'\', \'list\', \'l\')" class="jbEditorButton" target="_self">';
			$html .= '<img src="'.JOOBB_EDITOR_IMAGES_LIVE.DL.'bollist.png'.'" title="'. JText::_('BB_EDITORBUTTONBOLLIST') .'" class="jbEditorButton" />';
			$html .= '</a>';
		}
		
		// button youtube
		if ($params->get('show_button_youtube', 1)) {
			$html .= '<a href="javascript:addBBCode(\''. $name .'\', \'youtube\')" class="jbEditorButton" target="_self">';
			$html .= '<img src="'.JOOBB_EDITOR_IMAGES_LIVE.DL.'youtube.png'.'" title="'. JText::_('BB_EDITORBUTTONYOUTUBE') .'" class="jbEditorButton" />';
			$html .= '</a>';
		}
		
		// button google video
		if ($params->get('show_button_gvideo', 1)) {
			$html .= '<a href="javascript:addBBCode(\''. $name .'\', \'gvideo\')" class="jbEditorButton" target="_self">';
			$html .= '<img src="'.JOOBB_EDITOR_IMAGES_LIVE.DL.'gvideo.png'.'" title="'. JText::_('BB_EDITORBUTTONGVIDEO') .'" class="jbEditorButton" />';
			$html .= '</a>';
		}
		
		// button emotions
		if ($params->get('show_button_emotions', 1)) {
			$html .= '<a href="javascript:toggleDisplay(\'emotions\')" class="jbEditorButton" target="_self">';
			$html .= '<img src="'.JOOBB_EDITOR_IMAGES_LIVE.DL.'emotion.png'.'" title="'. JText::_('BB_EDITORBUTTONEMOTIONS') .'" class="jbEditorButton" />';
			$html .= '</a>';
			
			// get emotions
			$html .= '<div id="emotions">';
			$html .= JoobbEditorHtml::getEmotions('text', $params);
			$html .= '</div>';
		}

		// button super script
		if ($params->get('show_button_superscript', 1)) {
			$html .= '<a href="javascript:addBBCode(\''. $name .'\', \'sup\')" class="jbEditorButton" target="_self">';
			$html .= '<img src="'.JOOBB_EDITOR_IMAGES_LIVE.DL.'superscript.png'.'" title="'. JText::_('BB_EDITORBUTTONSUPERSCRIPT') .'" class="jbEditorButton" />';
			$html .= '</a>';
		}
		
		// button subscript
		if ($params->get('show_button_subscript', 1)) {
			$html .= '<a href="javascript:addBBCode(\''. $name .'\', \'sub\')" class="jbEditorButton" target="_self">';
			$html .= '<img src="'.JOOBB_EDITOR_IMAGES_LIVE.DL.'subscript.png'.'" title="'. JText::_('BB_EDITORBUTTONSUBSCRIPT') .'" class="jbEditorButton" />';
			$html .= '</a>';
		}

		// is there any combo to show? if so, then break the line
		if ($params->get('show_combo_font', 1) || $params->get('show_combo_size', 1) || 
				$params->get('show_combo_color', 1) || $params->get('show_combo_table', 1)) {
			$html .= '<br />';
		}

		// combo font
		if ($params->get('show_combo_font', 1)) {
		    $html .= '<select class="jbEditorSelect" onChange="javascript:addBBCode(\''. $name .'\', \'font\', this.value)">';
		    $html .= '<option value="">'. JText::_('BB_FONT') .'</option>';
		    $html .= '<option style="font-family:Arial, Helvetica, sans-serif" value="Arial, Helvetica, sans-serif">'. JText::_('BB_FONTARIAL') .'</option>';
		    $html .= '<option style="font-family:Chicago, Impact, Compacta, sans-serif" value="Chicago, Impact, Compacta, sans-serif">'. JText::_('BB_FONTARIAL') .'Chicago</option>';
		    $html .= '<option style="font-family:Comic Sans MS, sans-serif" value="Comic Sans MS, sans-serif">'. JText::_('BB_FONTCOMICSANSMS') .'</option>';
		    $html .= '<option style="font-family:Courier New, Courier, mono" value="Courier New, Courier, mono">'. JText::_('BB_FONTCOURIERNEW') .'</option>';
		    $html .= '<option style="font-family:Geneva, Arial, Helvetica, sans-serif" value="Geneva, Arial, Helvetica, sans-serif">'. JText::_('BB_FONTGENEVA') .'</option>';
		    $html .= '<option style="font-family:Georgia, Times New Roman, Times, serif" value="Georgia, Times New Roman, Times, serif">'. JText::_('BB_FONTGEORGIA') .'</option>';
		    $html .= '<option style="font-family:Helvetica, Verdana, sans-serif" value="Helvetica, Verdana, sans-serif">'. JText::_('BB_FONTHELVETICA') .'</option>';
		    $html .= '<option style="font-family:Impact, Compacta, Chicago, sans-serif" value="Impact, Compacta, Chicago, sans-serif">'. JText::_('BB_FONTIMPACT') .'</option>';
		    $html .= '<option style="font-family:Lucida Sans, Monaco, Geneva, sans-serif" value="Lucida Sans, Monaco, Geneva, sans-serif">'. JText::_('BB_FONTLUCIDASANS') .'</option>';
		    $html .= '<option style="font-family:Tahoma, Arial, Helvetica, sans-serif" value="Tahoma, Arial, Helvetica, sans-serif">'. JText::_('BB_FONTTAHOMA') .'</option>';
		    $html .= '<option style="font-family:Times New Roman, Times, Georgia, serif" value="Times New Roman, Times, Georgia, serif">'. JText::_('BB_FONTTIMESNEWROMAN') .'</option>';
		    $html .= '<option style="font-family:Trebuchet MS, Arial, sans-serif" value="Trebuchet MS, Arial, sans-serif">'. JText::_('BB_FONTTREBUCHETMS') .'</option>';
		    $html .= '<option style="font-family:Verdana, Helvetica, sans-serif" value="Verdana, Helvetica, sans-serif">'. JText::_('BB_FONTVERDANA') .'</option>';
		    $html .= '</select>';
		}

		// combo size
		if ($params->get('show_combo_size', 1)) {
		    $html .= '<select class="jbEditorSelect" onChange="javascript:addBBCode(\''. $name .'\', \'size\', this.value)">';
		    $html .= '<option value="">'. JText::_('BB_FONTSIZE') .'</option>';
		    $html .= '<option style="font-size:10px" value="10px">'. JText::_('BB_SIZE10PX') .'</option>';
		    $html .= '<option style="font-size:12px" value="12px">'. JText::_('BB_SIZE12PX') .'</option>';
		    $html .= '<option style="font-size:14px" value="14px">'. JText::_('BB_SIZE14PX') .'</option>';
		    $html .= '<option style="font-size:16px" value="16px">'. JText::_('BB_SIZE16PX') .'</option>';
		    $html .= '<option style="font-size:20px" value="20px">'. JText::_('BB_SIZE20PX') .'</option>';
		    $html .= '<option style="font-size:24px" value="24px">'. JText::_('BB_SIZE24PX') .'</option>';
		    $html .= '<option style="font-size:36px" value="36px">'. JText::_('BB_SIZE36PX') .'</option>';
			$html .= '<option style="font-size:60px" value="60px">'. JText::_('BB_SIZE60PX') .'</option>';
		    $html .= '</select>';
		}

		// combo color
		if ($params->get('show_combo_color', 1)) {
		    $html .= '<select class="jbEditorSelect" onChange="javascript:addBBCode(\''. $name .'\', \'color\', this.value)">';
		    $html .= '<option value="">'. JText::_('BB_FONTCOLOR') .'</option>';
		    $html .= '<option style="color:#ff0000" value="#ff0000">'. JText::_('BB_COLORRED') .'</option>';
		    $html .= '<option style="color:#00ff00" value="#00ff00">'. JText::_('BB_COLORGREEN') .'</option>';
		    $html .= '<option style="color:#0000ff" value="#0000ff">'. JText::_('BB_COLORBLUE') .'</option>';
		    $html .= '<option style="color:#000000" value="#000000">'. JText::_('BB_COLORBLACK') .'</option>';
		    $html .= '<option style="color:#ffff00" value="#ffff00">'. JText::_('BB_COLORYELLOW') .'</option>';
		    $html .= '<option style="color:#00ffff" value="#00ffff">'. JText::_('BB_COLORAQUA') .'</option>';
		    $html .= '<option style="color:#ff00ff" value="#ff00ff">'. JText::_('BB_COLORFUCHSIA') .'</option>';
		    $html .= '<option style="color:#c0c0c0" value="#c0c0c0">'. JText::_('BB_COLORGREY') .'</option>';
		    $html .= '<option style="color:#ffffff; background-color:#000000" value="#ffffff">'. JText::_('BB_COLORWHITE') .'</option>';
		    $html .= '</select>';
		}

		// combo table
		if ($params->get('show_combo_table', 1)) {
		    $html .= '<select class="jbEditorSelect" onChange="javascript:addBBCode(\''. $name .'\', this.options[this.selectedIndex].innerHTML, this.value)">';
		    $html .= '<option value="">'. JText::_('BB_TABLES') .'</option>';
		    $html .= '<option value="border=\'1\' cellspacing=\'0\' cellpadding=\'0\' width=\'100%\'">table</option>';
		    $html .= '<option value="bgcolor=\'#ffffff\'">tr</option>';
		    $html .= '<option value="bgcolor=\'#f1f1f1\' width=\'*\'">th</option>';
		    $html .= '<option value="width=\'*\'">td</option>';
		    $html .= '</select>';
		}

		$html .= '</div>';
		
		return $html;
	}
	
	/**
	 * get editor emotions
	 */	
	function getEmotions($name, $params) {

		// initialize variables
		$joobbConfig	=& JoobbConfig::getInstance();		
		$joobbEmotionSet =& JoobbEmotionSet::getInstance($joobbConfig->getEmotionSetFile());

		$html = '';

		$i = 1;
		$emotionsPerRow = $params->get('emotions_per_row');
		foreach($joobbEmotionSet->emotions as $emotion) {
			if(!$emotion->hidden) {
				$html .= '<a href="javascript:addEmotion(\''. $name .'\', \''. $emotion->codes[0] .'\'); toggleDisplay(\'emotions\');" class="jbEmotion" target="_self">';
				$html .= '<img src="'. $emotion->fileName .'" title="'. JText::_($emotion->emotion) .'" class="jbEmotion" />';
				$html .= '</a>';
				if ($emotionsPerRow != 0 && ($i % $emotionsPerRow) == 0) {
					$html .= '<br />';
				}
				$i++;
			}
		}
		
		return $html;
	}
}
?>