<div class="componentheading">
	Confirm your account.</div>

<form action="/bstm/main/index.php?view=forgot_password&action=confirm_account" method="post" class="josForm form-validate">
	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="contentpane">
		<tr>
			<td colspan="2" height="40">
				<p>An e-mail has been sent to your e-mail address. The e-mail contains a verification token, please paste the token in the field below to prove that you are the owner of this account.</p>
			</td>
		</tr>
		<tr>
			<td height="40">
				<label for="email" class="hasTip" title="Email::Please enter the email for your account">Email:</label>
			</td>
			<td>
				<input id="email" name="email" type="text" class="required validate-email" size="36" />
			</td>
		</tr>
		<tr>
			<td height="40">
				<label for="token" class="hasTip" title="Token::Please enter the token that was sent to your e-mail address.">Token:</label>
			</td>
			<td>
				<input id="token" name="token" type="text" class="required" size="36" />
			</td>
		</tr>
	</table>

	<button type="submit" class="validate">Submit</button>
	<input type="hidden" name="0f5e089948b5ee8cfe2f772e36de3bce" value="1" /></form>

