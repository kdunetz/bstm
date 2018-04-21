			<div class="module">
			<div>
				<div>
					<div>
													<h3>Login Form</h3>
											<form action="/bstm/main/staging/index.php?view=login&action=process" method="post" name="login" id="form-login" >
		<fieldset class="input">
	<p id="form-login-username">
		<label for="modlgn_username">Username</label><br />
		<input id="modlgn_username" type="text" name="email_address" class="inputbox" alt="username" size="18" value="alex@hotmail.com" />
	</p>
	<p id="form-login-password">
		<label for="modlgn_passwd">Password</label><br />
		<input id="modlgn_passwd" type="password" name="password" class="inputbox" size="18" alt="password" value = "testing123"/>
	</p>
		<p id="form-login-remember">
		<label for="modlgn_remember">Remember Me</label>
		<input id="modlgn_remember" type="checkbox" name="remember" class="inputbox" value="yes" alt="Remember Me" />
	</p>
		<input type="submit" name="Submit" class="button" value="Login" />
	</fieldset>
	<ul>
		<li>
			<a href="index.php?view=forgot_password&action=display">
			Forgot your password?</a>
		</li>
<!--
		<li>
			<a href="index.php?view=com_user&amp;view=remind">
			Forgot your username?</a>
		</li>
-->
				<li>
			<a href="index.php?view=register&action=display">
				Create an account</a>
		</li>
			</ul>
	
	</form>
					</div>
				</div>
			</div>
		</div>
