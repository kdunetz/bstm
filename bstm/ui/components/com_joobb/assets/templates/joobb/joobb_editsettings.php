<?php
// no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<form action="<?php echo $this->action; ?>" method="post" id="josForm" name="josForm" class="form-validate" enctype="multipart/form-data">
	<div class="jbBoxTopLeft"><div class="jbBoxTopRight"><div class="jbBoxTop">
		<div class="jbTextHeader"><?php echo JText::_('BB_MYBOARDSETTINGS'); ?></div>
	</div></div></div>
	<div class="jbBoxOuter"><div class="jbBoxInner">
		<div class="jbLeft jbMargin5 jbWidth95">
			<fieldset class="jbLeft jbWidth100">
				<label for="enable_bbcode" class="jbLabel"><?php echo JText::_('BB_ENABLEBBCODE'); ?></label>
				<div class="jbField"><?php echo $this->lists['enable_bbcode']; ?></div>
				<br clear="all" />
				<label for="enable_emotions" class="jbLabel"><?php echo JText::_('BB_ENABLEEMOTIONS'); ?></label>
				<div class="jbField"><?php echo $this->lists['enable_emotions']; ?></div>
				<br clear="all" />
				<label for="notify_on_reply" class="jbLabel"><?php echo JText::_('BB_AUTOSUBSCRIPTION'); ?></label>
				<div class="jbField"><?php echo $this->lists['auto_subscription']; ?></div>
			</fieldset>
		</div>
		<br clear="all" />
		<div class="jbLeft jbMargin5">
			<button type="submit" class="<?php echo $this->buttonSubmit->class; ?> validate" title="<?php echo $this->buttonSubmit->title; ?>"><span><?php echo $this->buttonSubmit->text; ?></span></button>
			<button type="button" class="<?php echo $this->buttonCancel->class; ?>" title="<?php echo $this->buttonCancel->title; ?>" onclick="history.back();"><span><?php echo $this->buttonCancel->text; ?></span></button>
		</div>
		<br clear="all" />
	</div></div>
	<div class="jbBoxBottomLeft"><div class="jbBoxBottomRight"><div class="jbBoxBottom"></div></div></div>
	<div class="jbMarginBottom10"></div>
	<input type="hidden" name="option" value="com_joobb" />
	<input type="hidden" name="task" value="joobbsavesettings" />
	<input type="hidden" name="Itemid" value="<?php echo $this->Itemid; ?>" />
</form>