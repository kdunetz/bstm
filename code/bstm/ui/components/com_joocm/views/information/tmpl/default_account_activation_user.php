<?php
// no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<div class="componentheading"><?php echo JText::_('CM_INFORMATION'); ?></div>
<div class="contentpane">
	<h3><?php echo JText::sprintf('CM_WELCOMEUSER', $this->joocmUser->name); ?></h3>
	<p><?php echo JText::_('CM_INFOACCOUNTACTIVATIONUSER'); ?></p>
	<ul>
		<li><a href="<?php echo $this->linkMainPage; ?>"><?php echo JText::_('CM_RETURNTOMAINPAGE'); ?></a></li>
	</ul>
</div>