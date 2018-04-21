<?php 
/*
  require('configure.php');
  require('database.php');
  tep_db_connect();
  require('functions.php');

  require('general.php');
  require('html_output.php');
  require('boxes.php');
  require('table_block.php');
  require('initialize.php');

// initialize the message stack for output messages
  require('message_stack.php');
  $messageStack = new messageStack;
*/

  $error = false;
  if (isset($_GET['action']) && ($_GET['action'] == 'process')) {
    $email_address = tep_db_prepare_input($_POST['email_address']);
    $password = tep_db_prepare_input($_POST['password']);

// Check if email exists
    $check_user_query = tep_db_query("select * FROM user where email = '" . tep_db_input($email_address) . "'");
    if (!tep_db_num_rows($check_user_query)) {
//echo "in here 1";
      $error = true;
    } else {
      $check_user = tep_db_fetch_array($check_user_query);
// Check that password is good
      //if (!tep_validate_password($password, $check_user['password'])) {
      $password = base64_encode(sha1($password,true));
      if ($password != $check_user['password']) {
        $error = true;
//echo "in here 2";
      } else {
//echo "in here 3";

        $user_id = $check_user['user_id'];
        $user_name = $check_user['user_name'];
        $first_name = $check_user['first_name'];
        $role = $check_user['role'];
        tep_session_register('user_id');
        tep_session_register('user_name');
        tep_session_register('first_name');
        tep_session_register('role');

        tep_db_query("update user set date_of_last_login = now(), number_of_logins = number_of_logins + 1 where user_id = '" . (int)$user_id . "'");

        //tep_redirect(tep_href_link('index.php'));
      }
    }
  }

?>
<?php

  if ($error == true) {
    
    $messageStack->add('Error Logging in');
    echo $messageStack->output();
  }
  if (false || isset($_GET['action']) && ($_GET['action'] == 'display_create_form')) 
  {
    echo "<div id=\"content\">
    <form action=\"login.php?action=process\" method=\"post\">
    <input type=\"hidden\" name=\"action\" value=\"create\">
    <div align=center>
    <table width=100% border=1>
    <tr>
      <td>Email Address: *</td>
      <td><input name=email_address value=\"@hotmail.com\"></td>
    </tr>
    <tr>
      <td>Password : *</td>
      <td><input type=password name=password value=\"testing123\"></td>
    </tr>
    <tr>
      <td colspan=2 align=center> <input type=\"submit\"></td>
    </tr>
    </table>
    </div>

    </form>
    </div> <!- content ->";
    return;
  }

?>
