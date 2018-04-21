<?php
// no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<div class="componentheading"><?php echo JText::_('CM_INFORMATION'); ?></div>
<div class="contentpane">
	<h3><?php echo JText::_('CM_ACCOUNTACTIVATIONFAILED'); ?></h3>
	<p><?php echo JText::_('CM_INFOREASONSFORFAILURE'); ?></p>
	<ul>
		<li><?php echo JText::_('CM_INFOFAILUREREASON01'); ?></li>
		<li><?php echo JText::_('CM_INFOFAILUREREASON02'); ?></li>
		<li><?php echo JText::_('CM_INFOFAILUREREASON03'); ?></li>
	</ul>
	<ul>
		<li><a href="<?php echo $this->linkMainPage; ?>"><?php echo JText::_('CM_RETURNTOMAINPAGE'); ?></a></li>
	</ul>
</div>