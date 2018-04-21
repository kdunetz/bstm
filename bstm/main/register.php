<?php 
  $error = false;
  if (isset($_GET['action']) && ($_GET['action'] == 'process')) 
  {
    $email_address = tep_db_prepare_input($_POST['email_address']);
    $email2 = tep_db_prepare_input($_POST['email2']);
    $password = tep_db_prepare_input($_POST['password']);
    $password2 = tep_db_prepare_input($_POST['password2']);
    $first_name = tep_db_prepare_input($_POST['first_name']);
    $last_name = tep_db_prepare_input($_POST['last_name']);
    $zipcode = tep_db_prepare_input($_POST['zipcode']);
    $location = tep_db_prepare_input($_POST['location']);
    $location2 = tep_db_prepare_input($_POST['location2']);
    $location3 = tep_db_prepare_input($_POST['location3']);
    $location4 = tep_db_prepare_input($_POST['location4']);
    $location5 = tep_db_prepare_input($_POST['location5']);
    $security_question_1 = tep_db_prepare_input($_POST['security_question_1']);
    $security_answer_1 = tep_db_prepare_input($_POST['security_answer_1']);
    $security_question_2 = tep_db_prepare_input($_POST['security_question_2']);
    $security_answer_2 = tep_db_prepare_input($_POST['security_answer_2']);

    if (empty($_POST['first_name'])) 
    {
       $messageStack->add('Error Registering: First Name is a required field');
    }
    if (empty($_POST['last_name'])) 
    {
       $messageStack->add('Error Registering: Last Name is a required field');
    }
    if (empty($_POST['email_address'])) 
    {
       $messageStack->add('Error Registering: Email address is a required field');
    }
    if (empty($_POST['password'])) 
    {
       $messageStack->add('Error Registering: Password is a required field');
    }
    if (empty($_POST['password2'])) 
    {
       $messageStack->add('Error Registering: Verify Password is a required field');
    }
    if (empty($_POST['zipcode'])) 
    {
       $messageStack->add('Error Registering: Zip Code is a required field');
    }
    if (empty($_POST['location'])) 
    {
       $messageStack->add('Error Registering: Zone 1 is a required field');
    }
if (false)
{
    if (empty($_POST['security_question_1'])) 
    {
       $messageStack->add('Error Registering: Security Question 1 is a required field');
    }
    if (empty($_POST['security_answer_1'])) 
    {
       $messageStack->add('Error Registering: Security Answer 1 is a required field');
    }
    if (empty($_POST['security_question_2'])) 
    {
       $messageStack->add('Error Registering: Security Question 2 is a required field');
    }
    if (empty($_POST['security_answer_2'])) 
    {
       $messageStack->add('Error Registering: Security Answer 2 is a required field');
    }
    if ($security_question_1 == $security_question_2) 
    {
       $messageStack->add('Error Registering: Your 2 security questions need to be different');
    }
}
    if ($password != $password2) 
    {
       $messageStack->add('Error Registering: Password and Verify Password are not identical');
    }
    if (!empty($_POST['email_address'])) 
    {
       $check_user_query = tep_db_query("select * FROM user where email = '" . tep_db_input($email_address) . "'");
       if (tep_db_num_rows($check_user_query) > 0) 
       {
          $messageStack->add('Error Registering: User already exists');
       }
     }
     if ($messageStack->size > 0) 
     {
         echo "<div class=\"componentheading\">Registration</div>\n";
         echo $messageStack->output();
         return;
     }
     $password = base64_encode(sha1($password,true));
           $sql_data_array = array('creation_date' => 'now()',
                                    'created_by' => $user_id,
                                    'modification_date' => 'now()',
                                    'modified_by' => $user_id,
                                    'first_name' => $first_name,
                                    'last_name' => $last_name,
                                    'customer_id' => 1,
                                    'number_of_logins' => 0,
                                    'email' => $email_address,
                                    'email2' => $email2,
                                    'zipcode' => $zipcode,
                                    'location' => $location,
                                    'location2' => $location2,
                                    'location3' => $location3,
                                    'location4' => $location4,
                                    'location5' => $location5,
                                    'security_question_1' => $security_question_1,
                                    'security_answer_1' => $security_answer_1,
                                    'security_question_2' => $security_question_2,
                                    'security_answer_2' => $security_answer_2,
                                    'password' => $password);
      tep_db_perform('user', $sql_data_array, 'insert', "user_id = " . $_POST['user_id']);
   
      //tep_redirect(tep_href_link('index.php?tab=3'));
      echo "<div class=\"componentheading\">Registration</div>\n";
      echo "User Added Successfully.   You may log in to the application now";
      return;
  }

?>
<script type="text/javascript">
<!--
	Window.onDomReady(function(){
		document.formvalidator.setHandler('passverify', function (value) { return ($('password').value == value); }	);
	});
// -->
</script>


<form action="index.php?view=register&action=process" method="post" id="josForm" name="josForm" class="form-validate">

<div class="componentheading">Registration</div>

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="contentpane">
<tr>
	<td width="30%" height="40">
		<label id="namemsg" for="first_name">
			First Name:
		</label>
	</td>
  	<td>
  		<input type="text" name="first_name" id="first_name" size="40" value="" class="inputbox required" maxlength="50" /> *
  	</td>
</tr>
<tr>
	<td height="40">
		<label id="usernamemsg" for="last_name">
			Last Name:
		</label>
	</td>
	<td>
		<input type="text" id="last_name" name="last_name" size="40" value="" class="inputbox required validate-username" maxlength="25" /> *
	</td>
</tr>
<tr>
	<td height="40">
		<label id="emailmsg" for="email_address">
			E-mail:
		</label>
	</td>
	<td>
		<input type="text" id="email_address" name="email_address" size="40" value="" class="inputbox required validate-email" maxlength="100" /> *
	</td>
</tr>
<tr>
	<td height="40">
		<label id="emailmsg" for="email2">
			E-mail 2 (optional):
		</label>
	</td>
	<td>
		<input type="text" id="email2" name="email2" size="40" value="" class="inputbox validate-email" maxlength="100" />
	</td>
</tr>
<tr>
	<td height="40">
		<label id="pwmsg" for="password">
			Password:
		</label>
	</td>
  	<td>
  		<input class="inputbox required validate-password" type="password" id="password" name="password" size="40" value="" /> *
  	</td>
</tr>
<tr>
	<td height="40">
		<label id="pw2msg" for="password2">
			Verify Password:
		</label>
	</td>
	<td>
		<input class="inputbox required validate-passverify" type="password" id="password2" name="password2" size="40" value="" /> *
	</td>
</tr>
<tr>
	<td height="40">
		<label id="zipcode" for="zipcode">
			Zip Code:
		</label>
	</td>
	<td>
		<input class="inputbox required" type="input" id="zipcode" name="zipcode" size="15" value="" /> *
	</td>
</tr>
<tr>
	<td height="40">
		<label id="location" for="location">
			Zone 1:
		</label>
	</td>
	<td>
          <select name="location">
            <option>
<?php
$select_query = tep_db_query("SELECT value AS _key, value FROM reference WHERE category = 'Zone' ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($product_type == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
?>
          </select> *
          Your Zone missing? Click <a href=index.php?view=add_zone>here</a> to get added.
	</td>
</tr>
<tr>
	<td height="40">
		<label id="location2" for="location2">
			Zone 2:
		</label>
	</td>
	<td>
          <select name="location2">
            <option>
<?php
$select_query = tep_db_query("SELECT value AS _key, value FROM reference WHERE category = 'Zone' ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($product_type == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
?>
          </select>
	</td>
</tr>
<tr>
	<td height="40">
		<label id="location3" for="location3">
			Zone 3:
		</label>
	</td>
	<td>
          <select name="location3">
            <option>
<?php
$select_query = tep_db_query("SELECT value AS _key, value FROM reference WHERE category = 'Zone' ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($product_type == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
?>
          </select> 
	</td>
</tr>
<tr>
	<td height="40">
		<label id="location4" for="location4">
			Zone 4:
		</label>
	</td>
	<td>
          <select name="location4">
            <option>
<?php
$select_query = tep_db_query("SELECT value AS _key, value FROM reference WHERE category = 'Zone' ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($product_type == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
?>
          </select> 
	</td>
</tr>
<tr>
	<td height="40">
		<label id="location5" for="location5">
			Zone 5:
		</label>
	</td>
	<td>
          <select name="location5">
            <option>
<?php
$select_query = tep_db_query("SELECT value AS _key, value FROM reference WHERE category = 'Zone' ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($product_type == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
?>
          </select> 
	</td>
</tr>
<!--
<tr>
	<td height="40">
		<label id="security_question_1" for="security_question_1">
			Security Question 1:
		</label>
	</td>
	<td>
          <select name="security_question_1">
            <option>
<?php
$select_query = tep_db_query("SELECT reference_id AS _key, value FROM reference WHERE category = 'Security Question' ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($product_type == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
?>
          </select> *
	</td>
</tr>
<tr>
	<td height="40">
		<label id="security_answer_1" for="security_answer_1">
			Security Answer 1:
		</label>
	</td>
	<td>
		<input class="inputbox required" type="input" id="security_answer_1" name="security_answer_1" size="30" value="" /> *
	</td>
</tr>
<tr>
	<td height="40">
		<label id="security_question_2" for="security_question_2">
			Security Question 2:
		</label>
	</td>
	<td>
          <select name="security_question_2">
            <option>
<?php
$select_query = tep_db_query("SELECT reference_id AS _key, value FROM reference WHERE category = 'Security Question' ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($product_type == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
?>
          </select> *
	</td>
</tr>
<tr>
	<td height="40">
		<label id="security_answer_2" for="security_answer_2">
			Security Answer 2:
		</label>
	</td>
	<td>
		<input class="inputbox required" type="input" id="security_answer_2" name="security_answer_2" size="30" value="" /> *
	</td>
</tr>-->
<tr>
	<td colspan="2" height="40">
		Fields marked with an asterisk (*) are required.	</td>
</tr>
</table>
	<button class="button validate" type="submit">Register</button>
</form>
