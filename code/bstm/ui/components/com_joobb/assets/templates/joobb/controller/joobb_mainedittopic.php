<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

if ($this->params->get('show_page_title')) : ?>
	<div class="componentheading<?php echo $this->params->get('pageclass_sfx'); ?>">
		<?php echo $this->params->get('page_title'); ?>
	</div><?php
endif; ?>
<div class="jbJoobb"><?php
	echo $this->loadTemplate('header');
	echo $this->loadTemplate('message');
	
	if ($this->postPreview) {
		echo $this->loadTemplate('preview');
	}
	
	echo $this->loadTemplate('edittopic');
	if ($this->showBoxFooter) {
		echo $this->loadTemplate('footer');
	} ?>
</div>
