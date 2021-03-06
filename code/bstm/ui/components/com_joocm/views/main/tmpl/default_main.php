<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

// load form validation behavior
JHTML::_('behavior.formvalidation'); ?>
<div class="cmLeft"><?php
    if ($this->joocmUser->get('id') < 1) : ?>
    <h2><?php echo JText::_('CM_WELCOME').', '.JText::_('CM_GUEST'); ?></h2><?php
    else : ?>
    <h2><?php echo JText::_('CM_WELCOME').', '. $this->joocmUser->get('name'); ?></h2><?php
    endif; ?>
</div><?php
if ($this->joocmUser->get('id') > 0) : ?>
<div class="cmRight">
	<a href="<?php echo JoocmHelper::getLink('logout'); ?>"><?php echo JTEXT::_('CM_LOGOUT'); ?></a>
</div><?php
endif; ?>
<br clear="all" />
<div class="cmProfile"><?php
if ($this->joocmUser->get('id') > 0) : 
	if ($this->enableAvatars) : ?>
	<div class="cmProfileAvatar"><div class="cmProfileAvatarImage"><?php
		$avatarFile = $this->joocmAvatar->getAvatarFile($this->joocmUser->get('id'));
		if ($avatarFile != '') : ?>
		<img src="<?php echo $avatarFile; ?>" width="<?php echo $this->joocmAvatar->avatarWidth; ?>" height="<?php echo $this->joocmAvatar->avatarHeight; ?>" title="<?php echo $this->joocmUser->get('name'); ?>" alt="<?php echo $this->joocmUser->get('name'); ?>" /><?php
		else :
			echo JText::_('CM_NOAVATAR');
		endif; ?>
	</div><center><a href="<?php echo JoocmHelper::getLink('avatar'); ?>"><?php echo JText::_('CM_EDITAVATAR'); ?></a></center></div><?php
	endif; ?>
    <div class="cmProfileView">
        <h3><?php echo $this->joocmUser->get('name'); ?></h3>
        <a href="<?php echo JoocmHelper::getLink('editaccount'); ?>"><?php echo JText::_('CM_EDITACCOUNT'); ?></a>
        <a href="<?php echo JoocmHelper::getLink('editsettings'); ?>" class="cmPaddingLeft10"><?php echo JText::_('CM_EDITSETTINGS'); ?></a>
        <a href="<?php echo JoocmHelper::getLink('terms'); ?>" class="cmPaddingLeft10"><?php echo JText::_('CM_TERMS'); ?></a>
        <ul class="cmProfileDetails">
            <li class="title"><?php echo JTEXT::_('CM_EMAIL'); ?></li><li><?php echo $this->joocmUser->get('email'); ?></li>
            <li class="title"><?php echo JTEXT::_('CM_USERGROUP'); ?></li><li><?php echo $this->joocmUser->get('usertype'); ?></li>
            <li class="title"><?php echo JTEXT::_('CM_MEMBERSINCE'); ?></li><li><?php echo JoocmHelper::Date($this->joocmUser->get('registerDate')); ?></li>
            <li class="title"><?php echo JTEXT::_('CM_LASTVISIT'); ?></li><li><?php echo JoocmHelper::Date($this->joocmUser->get('lastvisitDate')); ?></li>
            <li class="title"><?php echo JTEXT::_('CM_PROFILEVIEWS'); ?></li><li><?php echo $this->joocmUser->get('views_count'); ?></li>
        </ul>
    </div>
    <br clear="all" /><?php
else : ?>
	<div class="cmJoinView">
		<h3><?php echo JText::sprintf('CM_JOINCOMMUNITYNAME', $this->joocmConfig->getConfigSettings('community_name')); ?></h3>
    	<p><?php echo JText::_('CM_WELCOMETEXT'); ?></p>
        <div class="cmJoinButton">
            <a href="<?php echo JoocmHelper::getLink('register'); ?>" title="<?php echo JText::sprintf('CM_JOINCOMMUNITYNAME', $this->joocmConfig->getConfigSettings('community_name')); ?>">
                <span style="font-size: 24px;"><?php echo JText::_('CM_JOINNOW'); ?></span>
            </a>
        </div>
    </div>
    <br clear="all" /><?php
endif;
if (count($this->interfaces)) { ?>
<h2><?php echo JText::_('CM_APPLICATIONS'); ?></h2>
    <div id="cpanel"><?php
    foreach ($this->interfaces as $interface) :
        switch ($interface->show_restriction) {		
            case 1: // offline users only
                if ($this->joocmUser->get('id') < 1) {
                    $link = 'index.php?option='.$interface->com.$interface->url.'&Itemid='.JoocmHelper::getMenuId($interface->com);
                    JoocmHTML::createIconButton($link, $interface->com_icon, JText::_($interface->name));
                }
                break;
            case 2: // online users only
                if ($this->joocmUser->get('id') > 0) {
                    $link = 'index.php?option='.$interface->com.$interface->url.'&Itemid='.JoocmHelper::getMenuId($interface->com);
                    JoocmHTML::createIconButton($link, $interface->com_icon, JText::_($interface->name));
                }
                break;
            default:
                $link = 'index.php?option='.$interface->com.$interface->url.'&Itemid='.JoocmHelper::getMenuId($interface->com);
                JoocmHTML::createIconButton($link, $interface->com_icon, JText::_($interface->name));
                break;
        }
    endforeach; ?>
    </div><?php
} ?>
<br clear="all" />
<h2><?php echo JText::_('CM_MEMBERS'); ?></h2>
<div class="cmMembersNav">
    <div class="cmMarginBottom20 cmRight">
    	<?php $class = ($this->members == 'latest') ? 'class="cmActive"' : ''; ?>
        <a href="<?php echo JoocmHelper::getLink('main', '&members=latest'); ?>" <?php echo $class; ?>><?php echo JText::_('CM_LATEST'); ?></a>
        <span class="cmMembersNavSpacer">|</span>
        <?php $class = ($this->members == 'online') ? 'class="cmActive"' : ''; ?>
        <a href="<?php echo JoocmHelper::getLink('main', '&members=online'); ?>" <?php echo $class; ?>><?php echo JText::_('CM_ONLINE'); ?></a>
        <span class="cmMembersNavSpacer">|</span>
        <?php $class = ($this->members == 'recentonline') ? 'class="cmActive"' : ''; ?>
        <a href="<?php echo JoocmHelper::getLink('main', '&members=recentonline'); ?>" <?php echo $class; ?>><?php echo JText::_('CM_RECENTONLINE'); ?></a>
    </div>
</div><br clear="all" /><?php
if ($this->members == 'online') :
	$onlineUsersCount = count($this->onlineUsers);
	if ($onlineUsersCount > 0) :
		for ($i = 0; $i < $onlineUsersCount; $i++) :
			$onlineUser =& $this->getOnlineUser($i); ?>
			<div align="center" class="cmLeft cmPaddingLeft10">
			<a href="<?php echo $onlineUser->userLink; ?>">
				<img src="<?php echo $this->joocmAvatar->getAvatarFile($onlineUser->userid); ?>" width="60" height="60" title="<?php echo $onlineUser->name; ?>" alt="<?php echo $onlineUser->name; ?>" />
				<div><?php echo $onlineUser->name; ?></div>
			</a>
			</div><?php
		endfor;
	else :
		echo JText::_('CM_NOMEMBERSONLINE');
	endif; ?>
	<br clear="all" />
	<div class="cmRight"><a href="<?php echo JoocmHelper::getLink('userlistonline'); ?>"><?php echo JText::_('CM_VIEWALLONLINEMEMBERS'); ?></a></div><?php 
endif;
if ($this->members == 'latest') :
	$latestMembersCount = count($this->latestMembers);
	if ($latestMembersCount > 0) :
		for ($i = 0; $i < $latestMembersCount; $i++) :
			$latestMember =& $this->getLatestMember($i); ?>
			<div align="center" class="cmLeft cmPaddingLeft10">
			<a href="<?php echo $latestMember->userLink; ?>"><?php
            if ($this->enableAvatars) : ?>
				<img src="<?php echo $this->joocmAvatar->getAvatarFile($latestMember->id); ?>" width="60" height="60" title="<?php echo $latestMember->name; ?>" alt="<?php echo $latestMember->name; ?>" /><?php
            endif; ?>
				<div><?php echo $latestMember->name; ?></div>
			</a>
			</div><?php
		endfor; 
	endif; ?>
	<br clear="all" />
	<div class="cmRight"><a href="<?php echo JoocmHelper::getLink('userlist'); ?>"><?php echo JText::_('CM_VIEWALLMEMBERS'); ?></a></div><?php 
endif;
if ($this->members == 'recentonline') :
	$recentOnlineMembersCount = count($this->recentOnlineMembers);
	if ($recentOnlineMembersCount > 0) :
		for ($i = 0; $i < $recentOnlineMembersCount; $i++) :
			$recentOnlineMember =& $this->getRecentOnlineMember($i); ?>
			<div align="center" class="cmLeft cmPaddingLeft10">
			<a href="<?php echo $recentOnlineMember->userLink; ?>"><?php
            if ($this->enableAvatars) : ?>
				<img src="<?php echo $this->joocmAvatar->getAvatarFile($recentOnlineMember->id); ?>" width="60" height="60" title="<?php echo $recentOnlineMember->name; ?>" alt="<?php echo $latestMember->name; ?>" /><?php
            endif; ?>
				<div><?php echo $recentOnlineMember->name; ?></div>
			</a>
			</div><?php
		endfor; 
	endif; ?>
	<br clear="all" />
	<div class="cmRight"><a href="<?php echo JoocmHelper::getLink('userlist'); ?>"><?php echo JText::_('CM_VIEWALLMEMBERS'); ?></a></div><?php 
endif; ?>
</div><?php
if ($this->joocmUser->get('id') > 0) : ?>
<div class="cmProfileBox">
    <h3><?php echo JText::_('CM_ABOUTME'); ?></h3>
    <a href="<?php echo JoocmHelper::getLink('editprofile'); ?>"><?php echo JText::_('CM_EDITPROFILE'); ?></a><?php
    for ($i=0, $n=count($this->profilefieldsets); $i < $n; $i++) :
        $fieldset =& $this->profilefieldsets[$i]; ?>
        <ul class="cmProfileBox">
            <li class="cmFieldSetName"><?php echo JText::_($fieldset->name); ?></li><?php
            for ($j=0, $m=count($this->profilefields); $j < $m; $j++) :
                $field 	=& $this->profilefields[$j];
                if ($fieldset->id == $field->id_profile_field_set && $field->value != '') : ?>						
                    <li class="cmFieldTitle"><?php echo JText::_($field->title); ?></li>
                    <li class="cmFieldValue"><?php echo JText::_($field->value); ?></li><?php
                endif;
            endfor; ?>
        </ul><?php
    endfor; ?>
</div><?php
else : ?>
<div class="cmProfileBox">
<h3><?php echo JText::_('CM_MEMBERSLOGIN'); ?></h3>
<form action="<?php echo JRoute::_('index.php'); ?>" method="post" id="josForm" name="josForm" class="form-validate">
    <p>
        <label for="login_username"><?php echo JText::_('CM_USERNAME') ?></label><br />
        <input type="text" name="login_username" id="login_username" class="inputbox required" size="20" maxlength="150" />
    </p>
    <p>
        <label for="login_password"><?php echo JText::_('CM_PASSWORD') ?></label><br />
        <input type="password" name="login_password" id="login_password" class="inputbox required" size="20" maxlength="100" />
    </p><?php 
    if(JPluginHelper::isEnabled('system', 'remember')) : ?>
    <p>
        <label for="login_remember"><?php echo JText::_('CM_REMEMBERME') ?></label>
        <input type="checkbox" name="login_remember" id="login_remember" value="yes" alt="<?php echo JText::_('CM_REMEMBERME'); ?>" />
    </p><?php 
    endif;
    if ($this->captchaLogin) { ?>
    <p><img src="<?php echo JOOCM_CAPTCHAS_LIVE.DL.'joocm'.DL.'image.php?sid='.$this->sessionId; ?>" title="<?php echo JText::_('CM_CAPTCHACODE'); ?>" alt="<?php echo JText::_('CM_CAPTCHACODE'); ?>" /></p>
    <p><input type="text" name="captcha_code" id="captcha_code" class="inputbox required" size="10" maxlength="4"/><p><?php
    } ?>
    <p><input type="submit" name="Submit" class="button" value="<?php echo JText::_('CM_LOGIN') ?>" /></p>
    <p><a href="<?php echo JoocmHelper::getLink('requestlogin'); ?>"><?php echo JText::_('CM_FORGOTYOURLOGIN'); ?></a></p>
	<input type="hidden" name="option" value="com_joocm" />
	<input type="hidden" name="task" value="joocmlogin" />
	<input type="hidden" name="Itemid" value="<?php echo $this->Itemid; ?>" />
</form>
</div><?php 
endif; ?>
<br clear="all" />