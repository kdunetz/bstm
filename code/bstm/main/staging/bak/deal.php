<?php
/* UPDATE MAIN APP WITH BEGIN DATE and END DATE for consistency */
/* Cost Per Unit instead of CPU */
$urlPrefix = "";
if ($mobilesite == 'true')
{
   $urlPrefix = "deal.php?";
   $urlPrefixShort = "deal.php";
}
else
{
   $urlPrefix = "index.php?view=deal&";
   $urlPrefixShort = "index.php?view=deal";
}
if ($mobilesite == 'true')
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
      tep_db_query("DELETE FROM deal WHERE deal_id = " . $_GET['deal_id']);
      if (isset($_GET['redirect_url']))
      {
          tep_redirect(tep_href_link($_GET['redirect_url'],'','SSL'));
      }
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'update_field'))
  {
      tep_db_query("UPDATE deal SET " . $_GET['field'] . "= '" .  $_GET['value'] . "' WHERE deal_id = " . $_GET['deal_id']);
      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
  }

  if (isset($_POST['action']) && ($_POST['action'] == 'edit')) 
  {
if (empty($_POST['deal_name'])) {
   $messageStack->add('Deal Name is required');
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
'deal_name' => $_POST['deal_name'],
'begin_date' => userToSQLDate($_POST['begin_date']),
'end_date' => userToSQLDate($_POST['end_date']),
'savings_amount' => $_POST['savings_amount'],
'cost_per_unit' => $_POST['cost_per_unit'],
'location' => $_POST['location'],
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'view' && $key != 'redirect_url')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('deal', $sql_data_array, 'update', "deal_id = " . $_POST['deal_id']);

      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
      if ($mobile == 'true')
         tep_redirect(tep_href_link($urlPrefix . 'action=display&deal_id=' . $_POST['deal_id'],'','SSL'));
      else
         $_GET['action'] = 'display';
  }

  if (isset($_POST['action']) && ($_POST['action'] == 'create')) 
  {
if (empty($_POST['deal_name'])) {
   $messageStack->add('Deal Name is required');
}
 if ($messageStack->size > 0) { echo $messageStack->output(); return; }

$objects_query = tep_db_query("select * from deal WHERE deal_id != " . cs($_POST['deal_id'],"0") . " AND DEAL_NAME= '" . $_POST['deal_name'] . "'");
      if (mysql_num_rows($objects_query) == 0)
      {
         $sql_data_array = array('creation_date' => 'now()',
'created_by' => $user_id,
'modification_date' => 'now()',
'modified_by' => $user_id,
'deal_name' => $_POST['deal_name'],
'begin_date' => userToSQLDate($_POST['begin_date']),
'end_date' => userToSQLDate($_POST['end_date']),
'savings_amount' => $_POST['savings_amount'],
'cost_per_unit' => $_POST['cost_per_unit'],
'location' => $_POST['location'],
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'view' && $key != 'redirect_url')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('deal', $sql_data_array, 'insert', "deal_id = " . $_POST['deal_id']);

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

  if (isset($_GET['action']) && ($_GET['action'] == 'delete')) 
  {
     echo "Please confirm you would like to delete this Deal<br><hr>";
     if (isset($_GET['redirect_url']))
     {
        $redirect_url = "redirect_url=" . urlencode($_GET['redirect_url']);
        $redirect_url_with_ampersand = "&" . $redirect_url;
     }
     echo "<a href=" . $urlPrefix . "action=delete_confirm&deal_id=" . $_GET['deal_id'] . $redirect_url_with_ampersand . ">Yes</a>";
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
if (!isset($_GET['deal_id']) && isset($_POST['deal_id']))
   $_GET['deal_id'] = $_POST['deal_id'];
     $objects_query = tep_db_query("SELECT * FROM deal WHERE deal.deal_id = " . $_GET['deal_id']);
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
displayForm($objects);
     echo "<div id=\"content\">
<a href=" . $urlPrefix . "action=display_edit_form&deal_id=" . $objects['deal_id'] . ">Edit</a>
<table width=100% border=1>
<tr>
  <td>Deal Id:</td>
  <td>" .  $objects['deal_id']  . "</td>
</tr>
<tr>
  <td>Deal Name: *</td>
  <td>" .  $objects['deal_name']  . "</td>
</tr>
<tr>
  <td>Begin Date: </td>
  <td>" .  sqlToUserDate($objects['begin_date'])  . "</td>
</tr>
<tr>
  <td>End Date: </td>
  <td>" .  sqlToUserDate($objects['end_date'])  . "</td>
</tr>
<tr>
  <td>Savings:</td>
  <td>" .  $objects['savings_amount']  . "</td>
</tr>
<tr>
  <td>Cost Per Unit:</td>
  <td>" .  $objects['cost_per_unit']  . "</td>
</tr>
<tr>
  <td>Location:</td>
  <td>" .  $objects['location']  . "</td>
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

     </div> <!- content ->";
     return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display_create_form')) 
  {
    echo "<div id=\"content\">
    <form action=\"" . $urlPrefixShort . "\" method=\"post\">
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
  <td>Deal Name: *</td>
  <td><input name=deal_name value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Begin Date: </td>
  <td><input name=begin_date value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>End Date: </td>
  <td><input name=end_date value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Savings:</td>
  <td><input name=savings_amount value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Cost Per Unit:</td>
  <td><input name=cost_per_unit value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Location:</td>
  <td><input name=location value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Comments:</td>
  <td>
<textarea rows=6 cols=6 name=comments>" . $objects['comments'] . "</textarea></td>

</tr>
</table>

    <input type=\"submit\">
    </form>
    </div> <!- content ->";
    return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display_edit_form')) 
  {
     $objects_query = tep_db_query("select * from deal WHERE deal_id = " . $_GET['deal_id']);
     $objects = tep_db_fetch_array($objects_query);
    echo "<div id=\"content\">
    <form action=\"" . $urlPrefixShort . "\" method=\"post\">
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
  <td>Deal Name: *</td>
  <td><input name=deal_name value=\"" . $objects['deal_name'] . "\"></td>
</tr>
<tr>
  <td>Begin Date: </td>
  <td><input name=begin_date value=\"" . sqlToUserDate($objects['begin_date']) . "\"></td>
</tr>
<tr>
  <td>End Date: </td>
  <td><input name=end_date value=\"" . sqlToUserDate($objects['end_date']) . "\"></td>
</tr>
<tr>
  <td>Savings:</td>
  <td><input name=savings_amount value=\"" . $objects['savings_amount'] . "\"></td>
</tr>
<tr>
  <td>Cost Per Unit:</td>
  <td><input name=cost_per_unit value=\"" . $objects['cost_per_unit'] . "\"></td>
</tr>
<tr>
  <td>Location:</td>
  <td><input name=location value=\"" . $objects['location'] . "\"></td>
</tr>
<tr>
  <td>Comments:</td>
  <td>
<textarea rows=6 cols=30 name=comments>" . $objects['comments'] . "</textarea></td>
</tr>
</table>

    <input type=\"submit\">
    </form>
    </div> <!- content ->";
    return;
  }

  $rows = 0;
  echo "<a href=" . $urlPrefix . "action=display_create_form>Add Deal</a>";
  echo "<table border=1 width=\"100%\">";
  echo "<tr><td align=center><b>Action</b></td><td align=center><b>Name</b></td><td align=center><b>Savings</b></td><td align=center><b>Cost Per Unit</b></td></tr>\n";

  $objects_query = tep_db_query("SELECT * FROM deal ORDER BY deal_name");
  while ($objects = tep_db_fetch_array($objects_query)) 
  {
     $rows++;

     echo "<tr><a name=\"" . $objects['deal_id'] . "\"></a><td><a href=" . $urlPrefix. "action=delete&deal_id=" . $objects['deal_id'] . ">Delete</a><br><a href=" . $urlPrefix . "action=display_edit_form&deal_id=" . $objects['deal_id'] . ">Edit</a>";
echo "</td>  <td><a href=" . $urlPrefix . "action=display&deal_id=" . $objects['deal_id'] . ">" . displayField($objects['deal_name'],'STRING','') . "</a></td>  <td align=right>" . displayField($objects['savings_amount'],'NUMBER','$###,###.00') . "</td>  <td align=right>" . displayField($objects['cost_per_unit'],'NUMBER','$###,###.00') . "</td></tr>\n";

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

function tableLayout()
{
global $fields;
   $display_type_date = 1;
   $type_date = 0;
   $type_number = 1;
   $type_string = 2;

   $display_type_input = 0;
   $display_type_dropdown = 1;
   $display_type_textarea = 2;
   $display_type_display = 3;
   $display_type_dateinput = 4;
   $display_type_dropdownwithinput = 5;

   $dropdown_source_reference = 0;
   $dropdown_source_string_list = 1;
   $dropdown_source_sql = 2;

   $fields  = array();

   $field  = array();
   $field['name'] = 'deal_id';
   $field['display_name'] = 'Deal ID';
   $field['display_type'] = $display_type_display;
   $field['type'] = $type_integer;
   $field['required'] = false;
   $field['dropdown_sql'] = "";
   $field['dropdown_reference'] = "";
   array_push($fields, $field);

   $field  = array();
   $field['name'] = 'deal_name';
   $field['display_name'] = 'Deal Name';
   $field['display_type'] = $display_type_input;
   $field['type'] = $type_string;
   $field['required'] = true;
   $field['dropdown_sql'] = "";
   $field['dropdown_reference'] = "";
   array_push($fields, $field);
}

function displayForm($object)
{  
global $fields;
tableLayout();
/*
<table width=100% border=1>
<tr>
  <td>Deal Id:</td>
  <td>" .  $objects['deal_id']  . "</td>
*/
   echo "<table width=100% border=1>\n";
   for ($i=0;$i<sizeof($fields);$i++)
   {
      $field = $fields[$i];
      echo "<tr>\n";
      echo "<td>" . $field['display_name'] . "</td><td>" . $object[$field['name']] . "</td>\n";
      echo "</tr>\n";
   }
   echo "</table>\n";
}
?>
