<?php
// no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<div class="componentheading"><?php echo JText::_('CM_INFORMATION'); ?></div>
<div class="contentpane">
	<h3><?php echo JText::_('CM_DEARUSER'); ?></h3>
	<p><?php echo JText::_('CM_INFORESETFAILURE'); ?></p>
	<ul>
		<li><a href="<?php echo $this->linkMainPage; ?>"><?php echo JText::_('CM_RETURNTOMAINPAGE'); ?></a></li>
		<li><a href="<?php echo $this->linkRequestLogin; ?>"><?php echo JText::_('CM_REQUESTLOGIN'); ?></a></li>
	</ul>
</div>