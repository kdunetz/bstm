<?php
// no direct access
defined('_JEXEC') or die('Restricted access'); 
$this->document->addScript(JOOCM_BASEPATH_LIVE.DL.'assets'.DL.'js'.DL.'jquery-1.4.1.min.js');
$this->document->addScript(JOOCM_BASEPATH_LIVE.DL.'assets'.DL.'js'.DL.'joocm_core.js');

// load form validation behavior
JHTML::_('behavior.formvalidation'); ?>
<script language="javascript" type="text/javascript">
	$j(document).ready(function(){try{
		document.josForm.login_username.focus();
	}catch(e){}});
</script>
<form action="index.php" method="post" id="josForm" name="josForm" class="form-validate">
    <fieldset>
        <legend><?php echo JText::_('CM_LOGIN'); ?></legend>
        <table cellpadding="0" cellspacing="0" border="0" width="100%"><tr>
            <td width="30%" height="40"><label for="login_username"><?php echo JText::_('CM_USERNAME'); ?></label></td>
            <td><input type="text" name="login_username" id="login_username" class="inputbox required" size="40" maxlength="150" /></td>
        </tr><tr>
            <td width="30%" height="40"><label for="login_password"><?php echo JText::_('CM_PASSWORD'); ?></label></td>
            <td><input type="password" name="login_password" id="login_password" class="inputbox required" size="40" maxlength="100" /></td>
        </tr><tr>
            <td width="30%"></td>
            <td><input type="checkbox" name="remember" id="login_remember" value="yes" alt="<?php echo JText::_('CM_REMEMBERME'); ?>" /><label for="login_remember"><?php echo JText::_('CM_REMEMBERME'); ?></label></td>
        </tr><tr>
            <td width="30%"></td>
        <td><a href="<?php echo JoocmHelper::getLink('requestlogin'); ?>"><?php echo JText::_('CM_FORGOTYOURLOGIN'); ?></a></td>
        </tr></table>
    </fieldset><?php
    if ($this->captchaLogin) { ?>
    <fieldset>
        <legend><?php echo JText::_('CM_HUMANVERIFICATION'); ?></legend>
        <p><img src="<?php echo JOOCM_CAPTCHAS_LIVE.DL.'joocm'.DL.'image.php?sid='.$this->sessionId; ?>" title="<?php echo JText::_('CM_CAPTCHACODE'); ?>" alt="<?php echo JText::_('CM_CAPTCHACODE'); ?>" /></p>
        <p><input type="text" name="captcha_code" id="captcha_code" class="inputbox required" size="10" maxlength="4"/><p>
    </fieldset><?php
    } ?>
    <br clear="all" />
    <input type="submit" name="Submit" class="button validate" value="<?php echo JText::_('CM_LOGIN'); ?>" />
    <input type="button" name="Cancel" class="button" onclick="history.back();" value="<?php echo JText::_('CM_CANCEL'); ?>" />
	<input type="hidden" name="option" value="com_joocm" />
	<input type="hidden" name="task" value="joocmlogin" />
	<input type="hidden" name="Itemid" value="<?php echo $this->Itemid; ?>" />
</form>