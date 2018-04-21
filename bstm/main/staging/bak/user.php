<div class="componentheading">My Account</div>
<?php
if (!tep_session_is_registered('user_id')) {
   echo "You cannot access this information without logging in first";
   return;
}
$urlPrefix = "";
if ($mobilesite == 'true')
{
   $urlPrefix = "user.php?";
   $urlPrefixShort = "user.php";
}
else
{
   $urlPrefix = "index.php?view=user&";
   $urlPrefixShort = "index.php?view=user";
}
/* security to ensure that nobody except an admin can actual delete a user's records */
if ($role != 'admin')
   $_GET['user_id'] = $user_id;
else
{
   if (!isset($_GET['user_id']))
      $_GET['user_id'] = $user_id;
}
if ($role != 'admin')
{
   if (!isset($_GET['action'])) /* don't let people see anything without an action */
       return;
   if ($_GET['user_id'] != $user_id)
   {
      echo "Security Violation: User attempting to access unauthorized record";
      return;
   }
}

if ($mobile)
{
  require('configure.php');
  require('database.php');
  tep_db_connect();
  require('functions.php');

  require('general.php');
  require('html_output.php');
  require('boxes.php');
  require('table_block.php');
 // require('sessions.php');
  require('initialize.php');

// initialize the message stack for output messages
  require('message_stack.php');
  $messageStack = new messageStack;

  if (!tep_session_is_registered('user_id')) {
    //$navigation->set_snapshot();
    tep_redirect(tep_href_link('login.php', '', 'SSL'));
  }
}

/* do the save actions up here so we can redirect if we want to */

  if (isset($_GET['action']) && ($_GET['action'] == 'delete_confirm')) 
  {
      tep_db_query("DELETE FROM user WHERE user_id = " . $_GET['user_id']);
      if (isset($_GET['redirect_url']))
      {
          tep_redirect(tep_href_link($_GET['redirect_url'],'','SSL'));
      }
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'update_field'))
  {
      tep_db_query("UPDATE user SET " . $_GET['field'] . "= '" .  $_GET['value'] . "' WHERE user_id = " . $_GET['user_id']);
      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
  }

  if (isset($_POST['action']) && ($_POST['action'] == 'edit')) 
  {
if (empty($_POST['user_name'])) {
   $messageStack->add('User Name is required');
}
if (empty($_POST['email'])) {
   $messageStack->add('Email is required');
}
if (empty($_POST['password'])) {
   $messageStack->add('Password is required');
}
 if ($messageStack->size > 0) { echo $messageStack->output(); return; }

/*
     $sql_data_array = array('customers_firstname' => $firstname,
                              'customers_lastname' => $lastname,
                              'customers_email_address' => $email_address,
                              'customers_telephone' => $telephone,
                              'customers_fax' => $fax,
                              'customers_newsletter' => $newsletter,
                              'customers_password' => tep_encrypt_password($password));

      tep_db_perform(TABLE_CUSTOMERS, $sql_data_array);
*/
$sql_data_array = array('modification_date' => 'now()',
'modified_by' => $user_id,
'user_name' => $_POST['user_name'],
'email' => $_POST['email'],
'password' => $_POST['password']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'redirect_url')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('user', $sql_data_array, 'update', "user_id = " . $_POST['user_id']);

      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
      if ($mobile == 'true')
         tep_redirect(tep_href_link($urlPrefix . 'action=display&user_id=' . $_POST['user_id'],'','SSL'));
      else
         $_GET['action'] = 'display';
  }

  if (isset($_POST['action']) && ($_POST['action'] == 'create')) 
  {
if (empty($_POST['user_name'])) {
   $messageStack->add('User Name is required');
}
if (empty($_POST['email'])) {
   $messageStack->add('Email is required');
}
if (empty($_POST['password'])) {
   $messageStack->add('Password is required');
}
if (empty($_POST['zipcode'])) {
   $messageStack->add('Zipcode is required');
}
 if ($messageStack->size > 0) { echo $messageStack->output(); return; }

$objects_query = tep_db_query("select * from user WHERE user_id != " . cs($_POST['user_id'],"0") . " AND USER_NAME= '" . $_POST['user_name'] . "'");
      if (mysql_num_rows($objects_query) == 0)
      {
         $sql_data_array = array('creation_date' => 'now()',
'created_by' => $user_id,
'modification_date' => 'now()',
'modified_by' => $user_id,
'user_name' => $_POST['user_name'],
'email' => $_POST['email'],
'password' => $_POST['password'],
'zipcode' => $_POST['zipcode'],
);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'redirect_url')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('user', $sql_data_array, 'insert', "user_id = " . $_POST['user_id']);

      }
      else
      {
         $messageStack->add('This record has already been loaded'); 
         if ($messageStack->size > 0) { echo $messageStack->output(); return; }
      }
      //tep_redirect(tep_href_link('login.php', '', 'SSL'));
      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
  }
  if ($mobile == 'true') include("header.php");
     tep_db_connect();

  if (isset($_GET['action']) && ($_GET['action'] == 'delete')) 
  {
     echo "Please confirm<br><hr>";
     if (isset($_GET['redirect_url']))
     {
        $redirect_url = "redirect_url=" . urlencode($_GET['redirect_url']);
        $redirect_url_with_ampersand = "&" . $redirect_url;
     }
     echo "<a href=" . $urlPrefix . "action=delete_confirm&user_id=" . $_GET['user_id'] . $redirect_url_with_ampersand . ">Yes</a>";
     echo "<hr>";
     if (isset($_GET['redirect_url']))
     {
        echo "<a href=" . $redirect_url . ">No</a>";
     }
     else
     {
        echo "<a href=" . $urlPrefixShort . ">No</a>";
     }
     return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display')) 
  {
/* KAD leave off the ending quotes because it is an equation on the end */
     $objects_query = tep_db_query("SELECT user.* FROM user WHERE user.user_id = " . $_GET['user_id']);
     $objects = tep_db_fetch_array($objects_query);
     if (isset($objects['created_by']))
     {
        $user_query = tep_db_query("select user_name FROM user WHERE user_id = " . $objects['created_by']);
        $user = tep_db_fetch_array($user_query);
        $objects['created_by'] = $user['user_name'];
     }
     if (isset($objects['modified_by']))
     {
        $user_query = tep_db_query("select user_name FROM user WHERE user_id = " . $objects['modified_by']);
        $user = tep_db_fetch_array($user_query);
        $objects['modified_by'] = $user['user_name'];
     }
     echo "<div id=\"content\">
<a href=" . $urlPrefix . "action=display_edit_form&user_id=" . $objects['user_id'] . ">Edit</a><table width=100% border=1>
<tr>
  <td>User Name: *</td>
  <td>" .  $objects['user_name']  . "</td>
</tr>
<tr>
  <td>Email: *</td>
  <td>" .  $objects['email']  . "</td>
</tr>
<tr>
  <td>Password: *</td>
  <td>XXX</td>
</tr>
</table>

     </div> <!- content ->";
     return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display_create_form')) 
  {
    echo "<div id=\"content\">
    <form action=\"" . $urlPrefix . "\" method=\"post\">
    <input type=\"hidden\" name=\"action\" value=\"create\">\n";

    while(list($key,$value) = each($_GET)) {
        if ($key != 'action' && $key != 'view')
        {
            echo "<input type=\"hidden\" name=\"" . $key . "\" value=\"" . $value . "\">\n";
        }
    }
echo "
<table width=100% border=1>
<tr>
  <td>User Name: *</td>
  <td><input name=user_name value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Email: *</td>
  <td><input name=email value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Password: *</td>
  <td><input name=password type=password value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Store Name:</td>
  <td>
<select name=store_id>
  <option>";
$objects['store_id'] = '';$select_query = tep_db_query("SELECT store_id as _key, store_name as value FROM store ORDER BY store_name");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['store_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
</table>

    <input type=\"submit\">
    </form>
    </div> <!- content ->";
    return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display_edit_form')) 
  {
     $objects_query = tep_db_query("select * from user WHERE user_id = " . $_GET['user_id']);
     $objects = tep_db_fetch_array($objects_query);
    echo "<div id=\"content\">
    <form action=\"" . $urlPrefix . "\" method=\"post\">
    <input type=\"hidden\" name=\"action\" value=\"edit\">\n";
    while(list($key,$value) = each($_GET)) {
        if ($key != 'action' && $key != 'view')
        {
            echo "<input type=\"hidden\" name=\"" . $key . "\" value=\"" . $value . "\">\n";
        }
     }
echo "
<table width=100% border=1>
<tr>
  <td>User Name: *</td>
  <td><input name=user_name value=\"" . $objects['user_name'] . "\"></td>
</tr>
<tr>
  <td>Email: *</td>
  <td><input name=email value=\"" . $objects['email'] . "\"></td>
</tr>
<tr>
  <td>Password: *</td>
  <td><input name=password type=password value=\"" . $objects['password'] . "\"></td>
</tr>
</table>

    <input type=\"submit\">
    </form>
    </div> <!- content ->";
    return;
  }

  $rows = 0;
  echo "<a href=" . $urlPrefix . "action=display_create_form>Add User</a>";
  echo "<table border=1 width=\"100%\">";
  echo "<tr><td align=center><b>Action</b></td><td align=center><b>Name</b></td><td align=center><b>Customer</b></td><td align=center><b>Default List</b></td></tr>\n";

  $objects_query = tep_db_query("SELECT user_id as id, user.*, customer.* FROM user, customer WHERE user.customer_id = customer.customer_id");
  while ($objects = tep_db_fetch_array($objects_query)) 
  {
     $rows++;

     echo "<tr><a name=\"" . $objects['user_id'] . "\"></a><td><a href=" . $urlPrefix. "action=delete&user_id=" . $objects['user_id'] . ">Delete</a><br><a href=" . $urlPrefix . "action=display_edit_form&user_id=" . $objects['user_id'] . ">Edit</a>";
echo "</td>  <td><a href=" . $urlPrefix . "action=display&user_id=" . $objects['user_id'] . ">" . displayField($objects['user_name'],'STRING','') . "</a></td>  <td>" . displayField($objects['customer_name'],'STRING','') . "</td>  <td>" . displayField($objects['default_list'],'STRING','') . "</td></tr>\n";

  }
  if ($rows == 0)
  {
     echo "<tr><td colspan=5 align=center>No Results</td></tr>";
  }
  echo "</table>";
  echo "<hr>";

if ($rows > 0 && isset($_GET['action']) && ($_GET['action'] == 'search')) 
{
   return;
}

if ($mobile == 'true') include("footer.php");

?>
