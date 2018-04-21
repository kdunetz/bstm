<?php
if ($_GET['action'] == 'reset_password')
{
   include("confirm_account.php");
   return;
}
?>

<div class="componentheading">
		Forgot your Password?	</div>
<form action="/bstm/main/staging/index.php?view=forgot_password&action=reset_password" method="post" class="josForm form-validate">
	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="contentpane">
		<tr>
			<td colspan="2" height="40">
				<p>Please enter the e-mail address for your account. A verification token will be sent to you.  Once you have received the token, you will be able to choose a new password for your account.</p>
			</td>
		</tr>
		<tr>
			<td height="40">
				<label for="email" class="hasTip" title="E-mail Address::Please enter the e-mail address for your account.">E-mail Address:</label>
			</td>
			<td>
				<input id="email" name="email" type="text" class="required validate-email" />
			</td>
		</tr>
	</table>

	<button type="submit" class="validate">Submit</button>
	</form>

