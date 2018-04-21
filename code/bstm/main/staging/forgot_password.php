<?php
if ($_GET['action'] == 'confirm_account')
{
   $objects_query =  tep_db_query("select * from user where email = '" . $_POST['email'] . "' AND reset_token = '" . $_POST['token'] . "'");
   if (mysql_num_rows($objects_query) == 0)
   {
      $messageStack->add('Error: Email and/or token do not match. Please try again');
      if ($messageStack->size > 0) 
      {
         echo "<div class=\"componentheading\">Change Password</div>\n";
         echo $messageStack->output();
         return;
      }
   }
   else
   {
      include("change_password.php");
   }
   return;
}
if ($_GET['action'] == 'change_password')
{
   $email = $_POST['email'];
   $token = $_POST['token'];
   $password = $_POST['password'];
   $password2 = $_POST['password2'];
   if ($password != $password2) 
   {
      $messageStack->add('Error Registering: Password and Verify Password are not identical');
   }
   if ($messageStack->size > 0) 
   {
         echo "<div class=\"componentheading\">Change Password</div>\n";
         echo $messageStack->output();
         return;
   }

   $password = base64_encode(sha1($password,true));
/* KAD need to check to see if this query is successful before claiming victory */
   tep_db_query("UPDATE user set reset_token = null, password = '" . $password . "' WHERE email = '" . $email . "' AND reset_token = '" . $token . "'");
   echo "<div class=\"componentheading\">Change Password</div>\n";
   echo "Password has been changed";
   return;
}
if ($_GET['action'] == 'reset_password')
{
     $to = $_POST['email']; 
echo $to;
     $subject = "Reset Email Password";
     $headers = "MIME-Version: 1.0" . "\r\n"; 
     $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n"; 
     //$headers .= "Content-type: multipart/alternative; boundary=" . $mime_boundary_header . "\r\n";
     $headers .= 'From: admin@bringsavingstome.com' . "\r\n";
     $body  = "Please enter this token into the Confirm Account Screen: ";
     $token = base64_encode(sha1('TOKEN', true));
     $body .= $token;
     tep_db_query("UPDATE user set reset_token = '" . $token . "' WHERE email = '" . $to . "'");
   
     if (mail($to, $subject, $body, $headers)) {
        echo("<p>Message successfully sent!</p>");
      } 
      else {
        echo("<p>Message delivery failed...</p>");
     }
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

