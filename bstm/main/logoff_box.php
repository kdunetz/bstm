			<div class="module">
			<div>
				<div>
					<div>
													<h3>Logoff Form</h3>
Welcome <?php echo $user_name?>
, <?php echo $zipcode?>
<?php if (false) echo $location_filter?>
											<form action="/bstm/main/logoff.php?action=process" method="post" name="login" id="form-login" >
		<fieldset class="input">
		<input type="submit" name="Submit" class="button" value="Logoff" />
	</fieldset>
	</form>
	<ul>
		<li>
			<a href="index.php?view=user&action=display">My Account</a>
		</li>
<?php
if ($mobile_browser > 0)
		echo "<li>
			<a href=\"index.php?view=mobile_view&action=display\">
				View Mobile Version</a>
		</li>\n";
?>
        </ul>
       
					</div>
				</div>
			</div>
		</div>
