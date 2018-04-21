<?php
  $urlPrefix = "";
  if ($mobilesite == 'true')
  {
     $urlPrefix = "store.php?";
     $urlPrefixShort = "store.php";
  }
  else
  {
     $urlPrefix = "index.php?view=store&";
     $urlPrefixShort = "index.php?view=store";
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
      tep_db_query("DELETE FROM store WHERE store_id = " . $_GET['store_id']);
      if (isset($_GET['redirect_url']))
      {
          tep_redirect(tep_href_link($_GET['redirect_url'],'','SSL'));
      }
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'update_field'))
  {
      tep_db_query("UPDATE store SET " . $_GET['field'] . "= '" .  $_GET['value'] . "' WHERE store_id = " . $_GET['store_id']);
      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
  }

  if (isset($_POST['action']) && ($_POST['action'] == 'edit')) 
  {
if (empty($_POST['store_name'])) {
   $messageStack->add('Store Name is required');
}
if (empty($_POST['zone_id'])) {
   $messageStack->add('Zone Id is required');
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
'store_name' => $_POST['store_name'],
'zone_id' => $_POST['zone_id'],
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'view' && $key != 'redirect_url')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('store', $sql_data_array, 'update', "store_id = " . $_POST['store_id']);

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
if (empty($_POST['store_name'])) {
   $messageStack->add('Store Name is required');
}
if (empty($_POST['zone_id'])) {
   $messageStack->add('Zone Id is required');
}
if ($messageStack->size > 0)
{
   echo $messageStack->output(); 
   include($hfPrefix . "footer.php");
   return;
}

$objects_query = tep_db_query("select * from store WHERE store_id != " . cs($_POST['store_id'],"0") . " AND STORE_NAME= '" . $_POST['store_name'] . "'");
      if (mysql_num_rows($objects_query) == 0)
      {
         $sql_data_array = array('creation_date' => 'now()',
'created_by' => $user_id,
'modification_date' => 'now()',
'modified_by' => $user_id,
'store_name' => $_POST['store_name'],
'zone_id' => $_POST['zone_id'],
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'view' && $key != 'redirect_url')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('store', $sql_data_array, 'insert', "store_id = " . $_POST['store_id']);

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
     echo "Please confirm you would like to delete this store<br><hr>";
     if (isset($_GET['redirect_url']))
     {
        $redirect_url = "redirect_url=" . urlencode($_GET['redirect_url']);
        $redirect_url_with_ampersand = "&" . $redirect_url;
     }
     echo "<a href=\" . $urlPrefix . \"action=delete_confirm&store_id=" . $_GET['store_id'] . $redirect_url_with_ampersand . ">Yes</a>";
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
    if (!isset($_GET['store_id']) && isset($_POST['store_id']))
        $_GET['store_id'] = $_POST['store_id'];

/* KAD leave off the ending quotes because it is an equation on the end */
     $objects_query = tep_db_query("SELECT store.*, reference.value as zone_name FROM store,reference WHERE reference.reference_id = store.zone_id AND store.store_id = " . $_GET['store_id']);
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
     echo "<a href=" . $urlPrefix . "action=display_edit_form&store_id=" . $objects['store_id'] . ">Edit</a>
<table width=100% border=1>
<tr>
  <td>Store Id:</td>
  <td>" .  $objects['store_id']  . "</td>
</tr>
<tr>
  <td>Store Name: *</td>
  <td>" .  $objects['store_name']  . "</td>
</tr>
<tr>
  <td>Zone Id: *</td>
  <td>" .  $objects['zone_name']  . "</td>
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
  <td>Store Name: *</td>
  <td><input name=store_name value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Zone Id: *</td>
  <td>
<select name=zone_id>
  <option>";
$objects['zone_id'] = '';$select_query = tep_db_query("SELECT reference_id as _key, value FROM reference WHERE category = 'Zone' ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['zone_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
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
     $objects_query = tep_db_query("select * from store WHERE store_id = " . $_GET['store_id']);
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
  <td>Store Name: *</td>
  <td><input name=store_name value=\"" . $objects['store_name'] . "\"></td>
</tr>
<tr>
  <td>Zone Id: *</td>
  <td>
<select name=zone_id>
  <option>";
$select_query = tep_db_query("SELECT reference_id as _key, value FROM reference WHERE category = 'Zone' ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['zone_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
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
  echo "<a href=\" . $urlPrefix . \"action=display_create_form>Add Store</a>";
  echo "<table border=1 width=\"100%\">";
  echo "<tr><td align=center><b>Action</b></td><td align=center><b>Name</b></td></tr>\n";

  $objects_query = tep_db_query("SELECT * FROM store ORDER BY store_name");
  while ($objects = tep_db_fetch_array($objects_query)) 
  {
     $rows++;

     echo "<tr><a name=\"" . $objects['store_id'] . "\"></a><td><a href=" . $URLPrefix . "action=delete&store_id=" . $objects['store_id'] . ">Delete</a><br><a href=" . $URLPrefix . "action=display_edit_form&store_id=" . $objects['store_id'] . ">Edit</a>";
echo "</td>  <td><a href=store.php?action=display&store_id=" . $objects['store_id'] . ">" . displayField($objects['store_name'],'STRING','') . "</a></td></tr>\n";

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
