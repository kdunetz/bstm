<?php
/**
 * @version $Id: usersync.php 134 2010-08-13 08:03:09Z sterob $
 * @package Joo!BB
 * @copyright Copyright (C) 2007-2010 Joo!BB Project. All rights reserved.
 * @license GNU/GPL. Please see license.php in Joo!BB directory 
 * for copyright notices and details.
 * Joo!BB is free software. This version may have been NOT modified.
 */
 
// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Joo!BB User Synchronization View
 *
 * @package Joo!BB
 */
class ViewUserSync {

	/**
	 * show user synchronization
	 */	
	function showUserSync(&$lists) {

		// initialize variables
		$document =& JFactory::getDocument();
		$document->addStyleSheet(JOOBB_ADMINCSS_LIVE.DL.'icon.css');
		
		$task	= JRequest::getVar('task'); ?>
		<div id="submenu-box">
			<div class="t"><div class="t"><div class="t"></div></div></div>			
			<div class="m">
				<ul id="submenu"><li>
					<?php $class = ($task == 'joobb_install_view') ? 'class="active"' : ''; ?>
					<a <?php echo $class; ?> href="index.php?option=com_joobb&task=joobb_install_view"><?php echo JText::_('BB_INSTALLATION'); ?></a>
				</li><li>
					<?php $class = ($task == 'joobb_usersync_view') ? 'class="active"' : ''; ?>
					<a <?php echo $class; ?> href="index.php?option=com_joobb&task=joobb_usersync_view"><?php echo JText::_('BB_USERSYNC'); ?></a>
				</li><li>
					<?php $class = ($task == 'joobb_sitemap_view') ? 'class="active"' : ''; ?>
					<a <?php echo $class; ?> href="index.php?option=com_joobb&task=joobb_sitemap_view"><?php echo JText::_('BB_SITEMAP'); ?></a>
				</li></ul>
				<div class="clr"></div>
			</div>
			<div class="b"><div class="b"><div class="b"></div></div></div>
		</div>
		<form action="index.php" method="post" name="adminForm" autocomplete="off">
			<div class="col width-50">
				<fieldset class="adminform">
					<legend><?php echo JText::_('BB_JOOMLAUSERGROUP'); ?></legend>
					<table class="admintable" cellspacing="1"><tr>
						<td class="key">
							<label for="role">
								<?php echo JText::_('BB_GROUP'); ?>
							</label>
						</td><td>
							<?php echo $lists['joomlagroup']; ?>
						</td>
					</tr></table>
				</fieldset>
				<fieldset class="adminform">
					<legend><?php echo JText::_('BB_USERDETAILSJOOBB'); ?></legend>
					<table class="admintable" cellspacing="1"><tr>
						<td class="key">
						</td><td class="key">
						</td><td class="key">
                        	<?php echo JText::_('BB_UPDATEEXISTINGUSERS'); ?>
                        </td>
					</tr><tr>
                    	<td class="key">
							<label for="role">
								<?php echo JText::_('BB_USERROLE'); ?>
							</label>
						</td><td>
							<?php echo $lists['roles']; ?>
						</td><td>
                        	<center><input type="checkbox" id="roles_update" name="update[]" value="role" /></center>
                        </td>
					</tr><tr>
						<td class="key">
							<?php echo JText::_('BB_ENABLEBBCODE'); ?>
						</td><td>
							<?php echo $lists['enable_bbcode']; ?>
						</td><td>
                        	<center><input type="checkbox" id="enable_bbcode_update" name="update[]" value="enable_bbcode" /></center>
                        </td>
					</tr><tr>
						<td class="key">
							<?php echo JText::_('BB_ENABLEEMOTIONS'); ?>
						</td><td>
							<?php echo $lists['enable_emotions']; ?>
						</td><td>
                        	<center><input type="checkbox" id="enable_emotions_update" name="update[]" value="enable_emotions" /></center>
                        </td>
					</tr><tr>
						<td class="key">
							<?php echo JText::_('BB_AUTOSUBSCRIPTION'); ?>
						</td><td>
							<?php echo $lists['auto_subscription']; ?>
						</td><td>
                        	<center><input type="checkbox" id="auto_subscription_update" name="update[]" value="auto_subscription" /></center>
                        </td>
					</tr></table>
				</fieldset>	
			</div>
			<div class="clr"></div>
			<input type="hidden" name="option" value="com_joobb" />
			<input type="hidden" name="task" value="" />
		</form><?php
	}	
} ?>