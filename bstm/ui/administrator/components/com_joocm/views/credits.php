<?php
/**
 * @version $Id: credits.php 132 2010-07-26 11:50:33Z sterob $
 * @package Joo!CM
 * @copyright Copyright (C) 2007-2010 Joo!BB Project. All rights reserved.
 * @license GNU/GPL. Please see license.php in Joo!CM  directory 
 * for copyright notices and details.
 * Joo!CM is free software. This version may have been NOT modified.
 */
 
// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Joo!CM Credits View
 *
 * @package Joo!CM
 */
class ViewCredits {

	/**
	 * shows credits
	 */	
	function showCredits() {

		$document =& JFactory::getDocument();
		$document->addStyleSheet(JOOCM_ADMINCSS_LIVE.DL.'icon.css'); ?>		
		<form action="index.php?option=com_joocm" method="post" name="adminForm">
			<table><tr align="center" valign="middle">
                <td align="left" valign="top" width="70%" style="font-size: 13px;">
                    <h1><strong><?php echo JText::_('CM_CREDITSWELCOME'); ?></strong></h1>
                    <h2><?php echo JText::_('CM_CREDITSWHATISJOOCM'); ?></h2>
                    <p><?php echo JText::_('CM_CREDITSWHATISJOOBBTEXT'); ?></p>
                    <h2><?php echo JText::_('CM_CREDITSLEADDEVELOPER'); ?></h2>
                    <p><ul><li>Robert Stemplewski</li></ul></p>
                    <h2><?php echo JText::_('CM_CREDITSDEVELOPERS'); ?></h2>
                    <p>
                        <ul><li>Ramses aka Andy</li></ul>
                    </p>
                    <h2><?php echo JText::_('CM_CREDITSBETATESTER'); ?></h2>
                    <p><ul>
                        <li>Olaf Dryja</li>
                        <li>Jeff Hetrick</li>
                        <li>Jim Kass</li>
                        <li>Ramses aka Andy</li>
					</ul></p>
                    <h2><?php echo JText::_('CM_CREDITSDOCUMENTATIONTEAM'); ?></h2>
                    <p><ul>
                        <li>Olaf Dryja</li>
                        <li>Jeff Hetrick</li>
                        <li>Robert Stemplewski</li>
                    </ul></p>
                    <h2><?php echo JText::_('CM_CREDITSSPECIALTHANKS'); ?></h2>
                    <ul>
                        <li><?php echo JText::_('CM_CREDITSSPECIALTHANKS1'); ?> </li>
                        <li><?php echo JText::_('CM_CREDITSSPECIALTHANKS2'); ?> </li>															
                    </ul>
                </td>
                <td align="left" valign="top" width="30%" style="padding-left: 50px;">
                    <img src="<?php echo JOOCM_ADMINIMAGES_LIVE.DL.'install'.DL.'joocm_box.png'; ?>" border="1" alt="<?php echo JText::_('JOOCM_JOOCM'); ?>" />
                </td>
			</tr></table>
			<input type="hidden" name="option" value="com_joocm" />
			<input type="hidden" name="task" value="" />
		</form><?php
	}
}
?>