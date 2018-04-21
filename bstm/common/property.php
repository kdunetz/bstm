<?php
  $urlPrefix = "";
  if ($mobilesite == 'true')
  {
     $urlPrefix = "property.php?";
     $urlPrefixShort = "property.php";
  }
  else
  {
     $urlPrefix = "index.php?view=property&";
     $urlPrefixShort = "index.php?view=property";
  }

  if ($mobilesite == "true")
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
      tep_db_query("DELETE FROM property WHERE property_id = " . $_GET['property_id']);
      if (isset($_GET['redirect_url']))
      {
          tep_redirect(tep_href_link($_GET['redirect_url'],'','SSL'));
      }
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'update_field'))
  {
      tep_db_query("UPDATE property SET " . $_GET['field'] . "= '" .  $_GET['value'] . "' WHERE property_id = " . $_GET['property_id']);
      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
  }

  if (isset($_POST['action']) && ($_POST['action'] == 'edit')) 
  {
if (empty($_POST['name'])) {
   $messageStack->add('Name is required');
}
if (empty($_POST['description'])) {
   $messageStack->add('Description is required');
}
if (empty($_POST['value'])) {
   $messageStack->add('Value is required');
}
if ($messageStack->size > 0)
{
   echo $messageStack->output(); 
   include($hfPrefix . "footer.php");
   return;
}

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
'name' => $_POST['name'],
'description' => $_POST['description'],
'value' => $_POST['value'],
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'view' && $key != 'redirect_url')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('property', $sql_data_array, 'update', "property_id = " . $_POST['property_id']);

      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
      if ($mobilesite == 'true')
         tep_redirect(tep_href_link($urlPrefix . 'action=display&deal_id=' . $_POST['deal_id'],'','SSL'));
      else
         $_GET['action'] = 'display';

  }

  if (isset($_POST['action']) && ($_POST['action'] == 'create')) 
  {
if (empty($_POST['name'])) {
   $messageStack->add('Name is required');
}
if (empty($_POST['description'])) {
   $messageStack->add('Description is required');
}
if (empty($_POST['value'])) {
   $messageStack->add('Value is required');
}
if ($messageStack->size > 0)
{
   echo $messageStack->output(); 
   include($hfPrefix . "footer.php");
   return;
}

$objects_query = tep_db_query("select * from property WHERE 1 = 2");
      if (mysql_num_rows($objects_query) == 0)
      {
         $sql_data_array = array('creation_date' => 'now()',
'created_by' => $user_id,
'modification_date' => 'now()',
'modified_by' => $user_id,
'name' => $_POST['name'],
'description' => $_POST['description'],
'value' => $_POST['value'],
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'view' && $key != 'redirect_url')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('property', $sql_data_array, 'insert', "property_id = " . $_POST['property_id']);

      }
      else
      {
         $messageStack->add('This record has already been loaded'); 
         if ($messageStack->size > 0) 
         { 
            echo $messageStack->output(); 
            include($hfPrefix . "footer.php");
            return; 
         }
      }
      //tep_redirect(tep_href_link('login.php', '', 'SSL'));
      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
  }
?>

<?php 

  if ($mobilesite == 'true') 
  {     
     $showSearch = false;
     include($hfPrefix . "header.php");
  }

  if (isset($_GET['action']) && ($_GET['action'] == 'delete')) 
  {
     echo "Please confirm you would like to delete this property<br><hr>";
     if (isset($_GET['redirect_url']))
     {
        $redirect_url = "redirect_url=" . urlencode($_GET['redirect_url']);
        $redirect_url_with_ampersand = "&" . $redirect_url;
     }
     echo "<a href=\" . $urlPrefix . \"action=delete_confirm&property_id=" . $_GET['property_id'] . $redirect_url_with_ampersand . ">Yes</a>";
     echo "<hr>";
     if (isset($_GET['redirect_url']))
     {
        echo "<a href=" . $redirect_url . ">No</a>";
     }
     else
     {
        echo "<a href=" . $urlPrefixShort . ">No</a>";
     }
     include($hfPrefix . "footer.php");
     return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display')) 
  {
    if (!isset($_GET['property_id']) && isset($_POST['property_id']))
        $_GET['property_id'] = $_POST['property_id'];

/* KAD leave off the ending quotes because it is an equation on the end */
     $objects_query = tep_db_query("SELECT * FROM property WHERE property_id = " . $_GET['property_id']);
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
     echo "<a href=" . $urlPrefix . "action=display_edit_form&property_id=" . $objects['property_id'] . ">Edit</a>
<table width=100% border=1>
<tr>
  <td>Property ID:</td>
  <td>" .  $objects['property_id']  . "</td>
</tr>
<tr>
  <td>Name: *</td>
  <td>" .  $objects['name']  . "</td>
</tr>
<tr>
  <td>Description: *</td>
  <td>" .  $objects['description']  . "</td>
</tr>
<tr>
  <td>Value: *</td>
  <td>" .  $objects['value']  . "</td>
</tr>
<tr>
  <td>Comments:</td>
  <td>" .  $objects['comments']  . "</td>
</tr>
<tr>
  <td>Created By</td><td>" .  $objects['created_by'] . "</td></tr>
<tr>
  <td>Creation Date</td><td>" .  sqlToUserDate($objects['creation_date']) . "</td></tr>
<tr>
  <td>Modified By</td><td>" .  $objects['modified_by'] . "</td></tr>
<tr>
  <td>Modification Date</td><td>" .  sqlToUserDate($objects['modification_date']) . "</td></tr>
</table>

     include($hfPrefix . "footer.php");
     return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display_create_form')) 
  {
    echo "<form action=\"" . $urlPrefixShort . "\" method=\"post\">
    <input type=\"hidden\" name=\"action\" value=\"create\">\n";

    while(list($key,$value) = each($_GET)) {
        if ($key != 'action' && $key != 'view')
        {
            echo "<input type=\"hidden\" name=\"" . $key . "\" value=\"" . $value . "\">\n";
        }
    }
echo "<table width=100% border=1>
<tr>
  <td>Name: *</td>
  <td><input name=name value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Description: *</td>
  <td><input name=description value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Value: *</td>
  <td><input name=value value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Comments:</td>
  <td>
<textarea rows=6 cols=6 name=comments>" . $objects['comments'] . "</textarea></td>
</tr>
</table>

    <input type=\"submit\">
    </form>
    include($hfPrefix . "footer.php");
    return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display_edit_form')) 
  {
     $objects_query = tep_db_query("select * from property WHERE property_id = " . $_GET['property_id']);
     $objects = tep_db_fetch_array($objects_query);
    echo "<form action=\"" . $urlPrefixShort . "\" method=\"post\">
    <input type=\"hidden\" name=\"action\" value=\"edit\">\n";
    while(list($key,$value) = each($_GET)) {
        if ($key != 'action' && $key != 'view')
        {
            echo "<input type=\"hidden\" name=\"" . $key . "\" value=\"" . $value . "\">\n";
        }
     }
echo "<table width=100% border=1>
<tr>
  <td>Name: *</td>
  <td><input name=name value=\"" . $objects['name'] . "\"></td>
</tr>
<tr>
  <td>Description: *</td>
  <td><input name=description value=\"" . $objects['description'] . "\"></td>
</tr>
<tr>
  <td>Value: *</td>
  <td><input name=value value=\"" . $objects['value'] . "\"></td>
</tr>
<tr>
  <td>Comments:</td>
  <td>
<textarea rows=6 cols=6 name=comments>" . $objects['comments'] . "</textarea></td>
</tr>
</table>

    <input type=\"submit\">
    </form>
    include($hfPrefix . "footer.php");
    return;
  }

  $rows = 0;
  echo "<a href=\" . $urlPrefix . \"action=display_create_form>Add Property</a>";
  echo "<table border=1 width=\"100%\">";
  echo "<tr><td align=center><b>Action</b></td><td align=center><b>Property ID</b></td><td align=center><b>Name</b></td><td align=center><b>Description</b></td><td align=center><b>Value</b></td></tr>\n";

  $objects_query = tep_db_query("SELECT * FROM property ORDER BY property_name");
  while ($objects = tep_db_fetch_array($objects_query)) 
  {
     $rows++;

     echo "<tr><a name=\"" . $objects['property_id'] . "\"></a><td><a href=" . $URLPrefix . "action=delete&property_id=" . $objects['property_id'] . ">Delete</a><br><a href=" . $URLPrefix . "action=display_edit_form&property_id=" . $objects['property_id'] . ">Edit</a>";
echo "</td>  <td align=right><a href=property.php?action=display&property_id=" . $objects['property_id'] . ">" . displayField($objects['property_id'],'NUMBER','') . "</a></td>  <td>" . displayField($objects['name'],'STRING','') . "</td>  <td>" . displayField($objects['description'],'STRING','') . "</td>  <td>" . displayField($objects['value'],'STRING','') . "</td></tr>\n";

  }
  if ($rows == 0)
  {
     echo "<tr><td colspan=5 align=center>No Results</td></tr>";
  }
  echo "</table>";
  echo "<hr>";

if ($rows > 0 && isset($_GET['action']) && ($_GET['action'] == 'search')) 
{
   include($hfPrefix . "footer.php");
   return;
}

if ($mobilesite == 'true') 
{
   include($hfPrefix . "footer.php");
}

?>
