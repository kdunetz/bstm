			<div class="module">
			<div>
				<div>
					<div>
													<h3>Logoff Form</h3>
Welcome <?php echo $user_name?>
, <?php echo $zipcode?>
, <?php echo $role?>
											<form action="/bstm/main/staging/logoff.php?action=process" method="post" name="login" id="form-login" >
		<fieldset class="input">
		<input type="submit" name="Submit" class="button" value="Logoff" />
	</fieldset>
	</form>
	<ul>
		<li>
			<a href="index.php?view=user&action=display">My Account</a>
		</li>
        </ul>
       
					</div>
				</div>
			</div>
		</div>
