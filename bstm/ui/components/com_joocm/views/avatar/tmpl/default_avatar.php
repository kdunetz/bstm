<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
$this->document->addScript(JOOCM_BASEPATH_LIVE.DL.'assets'.DL.'js'.DL.'jquery-1.4.1.min.js');
$this->document->addScript(JOOCM_BASEPATH_LIVE.DL.'assets'.DL.'js'.DL.'jquery.jcarousel.pack.js');
$this->document->addScript(JOOCM_BASEPATH_LIVE.DL.'assets'.DL.'js'.DL.'joocm_core.js'); ?>
<script language="javascript" type="text/javascript">
	$j(document).ready(function(){try{
		$j("#jcarousel").jcarousel({
			scroll: 1,
			initCallback: carousel_initCallback
		});		
		$j("#myAvatars span").click(function () {
			$j("input[name='id_avatar']").val($j(this).attr("id"));
			$j("#cmMyAvatar").html($j(this).html()); 
		});
		$j("#standardAvatars li").click(function () {
			$j("input[name='id_avatar']").val($j(this).attr("id"));
			$j("#cmMyAvatar").html($j(this).html()); 
		});
	}catch(e){}});
	
	function carousel_initCallback(carousel) {
		$j('#jcarousel-next').bind('click', function() {
			carousel.next();
			return false;
		});
	
		$j('#jcarousel-prev').bind('click', function() {
			carousel.prev();
			return false;
		});
	};
</script><?php
if ($this->enableAvatars) : ?>
<form action="index.php" method="post" id="josForm" name="josForm" class="form-validate">
    <fieldset>
        <legend><?php echo JText::_('CM_MYCURRENTAVATAR') .' - '. $this->joocmUser->get('name'); ?></legend>
        <div class="cmProfileAvatar"><div class="cmProfileAvatarImage"><div id="cmMyAvatar"><?php
        $avatarFile = $this->joocmAvatar->getAvatarFile($this->joocmUser->get('id'));
        if ($avatarFile != '') : ?>
            <img src="<?php echo $avatarFile; ?>" width="<?php echo $this->joocmAvatar->avatarWidth; ?>" height="<?php echo $this->joocmAvatar->avatarHeight; ?>" title="<?php echo $this->joocmUser->get('name'); ?>" alt="<?php echo $this->joocmUser->get('name'); ?>" /><?php
        else :
            echo JText::_('CM_NOAVATAR');
        endif; ?>
        </div></div></div>
        <div class="cmAvatarDesc">
        <p><?php echo JText::_('CM_AVATARDESC1'); ?></p>
        <p><ul>
            <li><?php echo JText::_('CM_AVATAROPTION1'); ?></li>
            <li><?php echo JText::_('CM_AVATAROPTION2'); ?></li>
            <li><?php echo JText::_('CM_AVATAROPTION3'); ?></li>
        </ul></p>
        <p><?php echo JText::_('CM_AVATARDESC2'); ?> </p>
        </div>
        <br clear="all"/><br />
        <div>
        <input type="submit" name="Submit" class="button validate" value="<?php echo JText::_('CM_SAVE'); ?>" />
        <input type="button" name="Cancel" class="button" onclick="document.location.href='<?php echo JoocmHelper::getLink('main'); ?>'" value="<?php echo JText::_('CM_CANCEL'); ?>" />
        </div>
    </fieldset>
    <input type="hidden" name="option" value="com_joocm" />
    <input type="hidden" name="task" value="joocmsaveavatar" />
    <input type="hidden" name="id_avatar" value="<?php echo $this->joocmUser->get('id_avatar'); ?>" />
    <input type="hidden" name="Itemid" value="<?php echo $this->Itemid; ?>" />
</form>
<form action="index.php" method="post" id="josForm" name="josForm" class="form-validate" enctype="multipart/form-data">
<fieldset>
    <legend><?php echo JText::_('CM_MYAVATARS'); ?></legend>
    <ul class="cmMyAvatars" id="myAvatars"><?php
    $userAvatarsCount = count($this->userAvatars);
    foreach ($this->userAvatars as $userAvatar) : ?>
        <li>
            <span id="<?php echo $userAvatar->id; ?>">
            <img src="<?php echo $this->joocmAvatar->getJoocmAvatarFile($userAvatar); ?>" width="<?php echo $this->joocmAvatar->avatarWidth; ?>" height="<?php echo $this->joocmAvatar->avatarHeight; ?>" />
            </span><br />
            <center><a href="<?php echo JRoute::_('index.php?option=com_joocm&task=joocmdeleteavatar&id_avatar='.$userAvatar->id.'&Itemid='. $this->Itemid, false); ?>"><?php echo JTEXT::_('CM_DELETE'); ?></a></center>
        </li><?php
    endforeach; ?>
    </ul>
	<br clear="all"/><br />
    <h3></h3>
    <table cellpadding="0" cellspacing="0" border="0" width="100%"><tr>
        <td width="20%" height="40"><label for="avatarfile"><?php echo JText::_('CM_UPLOADAVATARFILE'); ?></label></td>
        <td><input type="file" name="avatarfile" id="avatarfile" class="inputbox" size="40" value="" maxlength="512" />
        <input type="submit" name="Submit" class="button validate" value="<?php echo JText::_('CM_UPLOAD'); ?>" /></td>
    </tr><tr>
        <td width="20%" height="40"><label for="avatarurl"><?php echo JText::_('CM_SETAVATARURL'); ?></label></td>
        <td><textarea name="avatarurl" id="avatarurl" rows="5" cols="50" class="inputbox"></textarea></td>
    </tr></table>
</fieldset>
<input type="hidden" name="option" value="com_joocm" />
<input type="hidden" name="task" value="joocmuploadavatar" />
<input type="hidden" name="my_avatar_id" value="" />
<input type="hidden" name="Itemid" value="<?php echo $this->Itemid; ?>" />
</form>
<fieldset>
    <legend><?php echo JText::_('CM_SELECTSTANDARDAVATAR'); ?></legend>
    <div id="jcarousel" class="jcarousel-skin-cm"><ul id="standardAvatars"><?php
    $standardAvatarsCount = count($this->standardAvatars);
    foreach ($this->standardAvatars as $standardAvatar) : ?>
        <li id="<?php echo $standardAvatar->id; ?>"><img src="<?php echo $this->joocmAvatar->getJoocmAvatarFile($standardAvatar); ?>" width="<?php echo $this->joocmAvatar->avatarWidth; ?>" height="<?php echo $this->joocmAvatar->avatarHeight; ?>"/></li><?php
    endforeach; ?>
    </ul></div>
</fieldset><br /><?php
endif; ?>