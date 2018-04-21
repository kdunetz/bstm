<div class="componentheading">
	Change Password</div>

<form action="/bstm/main/staging/index.php?view=forgot_password&action=change_password" method="post" class="josForm form-validate">
<input type=hidden name=token value=<?php echo $_POST['token']; ?>>
<input type=hidden name=email value=<?php echo $_POST['email']; ?>>
	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="contentpane">
		<tr>
			<td colspan="2" height="40">
				<p>Please enter your password and then your password again.</p>
			</td>
		</tr>
		<tr>
			<td height="40">
				<label for="password" class="hasTip" title="Password::Please enter the password for your account">Password:</label>
			</td>
			<td>
				<input id="password" name="password" type="password" class="required" size="36" />
			</td>
		</tr>
		<tr>
			<td height="40">
				<label for="password2" class="hasTip" title="Token::Please enter the token that was sent to your e-mail address.">Verify Password:</label>
			</td>
			<td>
				<input id="password2" name="password2" type="password" class="required" size="36" />
			</td>
		</tr>
	</table>

	<button type="submit" class="validate">Submit</button>
	<input type="hidden" name="0f5e089948b5ee8cfe2f772e36de3bce" value="1" /></form>

