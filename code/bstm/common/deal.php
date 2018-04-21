<p>
<center><h3><font color=blue>Deal</font></h3></center>
<p>
<?php
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
if (empty($_POST['source_id'])) {
   $messageStack->add('Source is required');
}
if (empty($_POST['end_date'])) {
   $messageStack->add('End Date is required');
}
if (empty($_POST['savings_amount'])) {
   $messageStack->add('Savings is required');
}
if (empty($_POST['location'])) {
   $messageStack->add('Zone is required');
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
'deal_name' => $_POST['deal_name'],
'begin_date' => userToSQLDate($_POST['begin_date']),
'end_date' => userToSQLDate($_POST['end_date']),
'original_amount' => $_POST['original_amount'],
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
      if ($mobilesite == 'true')
         tep_redirect(tep_href_link($urlPrefix . 'action=display&deal_id=' . $_POST['deal_id'],'','SSL'));
      else
         $_GET['action'] = 'display';

  }

  if (isset($_POST['action']) && ($_POST['action'] == 'create')) 
  {
if (empty($_POST['deal_name'])) {
   $messageStack->add('Deal Name is required');
}
if (empty($_POST['source_id'])) {
   $messageStack->add('Source is required');
}
if (empty($_POST['end_date'])) {
   $messageStack->add('End Date is required');
}
if (empty($_POST['savings_amount'])) {
   $messageStack->add('Savings is required');
}
if (empty($_POST['location'])) {
   $messageStack->add('Zone is required');
}
if ($messageStack->size > 0)
{
   echo $messageStack->output(); 
   //include($hfPrefix . "footer.php");
   return;
}

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
'original_amount' => $_POST['original_amount'],
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
         if ($messageStack->size > 0) 
         { 
            echo $messageStack->output(); 
            //include($hfPrefix . "footer.php");
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
     echo "Please confirm you would like to delete this deal<br><hr>";
     if (isset($_GET['redirect_url']))
     {
        $redirect_url = "redirect_url=" . urlencode($_GET['redirect_url']);
        $redirect_url_with_ampersand = "&" . $redirect_url;
     }
     echo "<a href=\" . $urlPrefix . \"action=delete_confirm&deal_id=" . $_GET['deal_id'] . $redirect_url_with_ampersand . ">Yes</a>";
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
    if (!isset($_GET['deal_id']) && isset($_POST['deal_id']))
        $_GET['deal_id'] = $_POST['deal_id'];

/* KAD leave off the ending quotes because it is an equation on the end */
     $objects_query = tep_db_query("SELECT deal.*,source.source_name FROM deal, source WHERE deal.source_id = source.source_id AND deal.deal_id = " . $_GET['deal_id']);
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
if (($role == 'admin' || $objects['user_id'] == $user_id) && tep_session_is_registered('user_id'))
     echo "<a class=\"button\" href=" . $urlPrefix . "action=display_edit_form&deal_id=" . $objects['deal_id'] . "><span>Edit</span></a><br>\n";
echo "<center><table class=contenttoc width=100% border=1>
<tr>
  <td class=sectiontableheader>Deal Name</td>
  <td class=bstm_td>" .  $objects['deal_name']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Description</td>
  <td class=bstm_td>" .  $objects['comments']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Source</td>
  <td class=bstm_td>" .  $objects['source_name']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Download End Date</td>
  <td class=bstm_td>" . sqlToUserDate( $objects['download_end_date'] ) . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Begin Date</td>
  <td class=bstm_td>" . sqlToUserDate( $objects['begin_date'] ) . "</td>
</tr>
<tr>
  <td class=sectiontableheader>End Date</td>
  <td class=bstm_td>" . sqlToUserDate( $objects['end_date'] ) . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Price</td>
  <td class=bstm_td>" .  displayField($objects['price'], "NUMBER", "$###,###.00")  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Original Amount</td>
  <td class=bstm_td>" .  displayField($objects['original_amount'], "NUMBER", "$###,###.00")  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Savings</td>
  <td class=bstm_td>" .  displayField($objects['savings_amount'], "NUMBER", "$###,###.00")  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Cost Per Unit</td>
  <td class=bstm_td>" .  displayField($objects['cost_per_unit'], "NUMBER", "$###,###.00")  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Buy This Deal</td>
  <td class=bstm_td>" .  (strlen($objects['url']) > 0?"<a href=" . $objects['url']  . " TARGET=_new>Click Here</a>":"") . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Location</td>
  <td class=bstm_td>" .  $objects['location']  . "</td>
</tr>\n";
if (false)
{
echo "<tr>
  <td>Created By</td><td>" .  $objects['created_by'] . "</td></tr>
<tr>
  <td>Creation Date</td><td>" .  sqlToUserDate($objects['creation_date']) . "</td></tr>
<tr>
  <td>Modified By</td><td>" .  $objects['modified_by'] . "</td></tr>
<tr>
  <td>Modification Date</td><td>" .  sqlToUserDate($objects['modification_date']) . "</td></tr>\n";
}
echo "</table>\n";

     //include($hfPrefix . "footer.php");
     return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display_create_form')) 
  {
    echo "<p><center><h3><font color=blue>Create Deal</font></h3></center>\n";
    echo "<form action=\"" . $urlPrefixShort . "\" method=\"post\">
    <input type=\"hidden\" name=\"action\" value=\"create\">\n";

    while(list($key,$value) = each($_GET)) {
        if ($key != 'action' && $key != 'view')
        {
            echo "<input type=\"hidden\" name=\"" . $key . "\" value=\"" . $value . "\">\n";
        }
    }
echo "<SCRIPT LANGUAGE=\"text/javascript\" ID=\"js1\">
var cal1 = new CalendarPopup();
</SCRIPT>\n";
echo "<table width=100% border=1>
<tr>
  <td>Deal Name *</td>
  <td><input name=deal_name value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Source *</td>
  <td>
<select name=source_id>
  <option>";
$objects['source_id'] = '';
$select_query = tep_db_query("SELECT source_id as _key, source_name as value FROM source ORDER BY source_name");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['source_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Download End Date *</td>
  <td><input size=15 id=download_end_date name=download_end_date value=" . sqlToUserDate($objects['download_end_date']) . ">
	<button type=\"reset\" id=\"trigger_download_end_date\" class=\"button\">...</button>
	<script type=\"text/javascript\">
		Calendar.setup({
			inputField	:	\"download_end_date\",			// id of the input field
			ifFormat	:	\"%m/%d/%Y\",		// format of the input field
			button		:	\"trigger_download_end_date\",	// trigger for the calendar (button ID)
			singleClick	:	true,
			step		:	1				// show all years in drop-down boxes (instead of every other year as default)
		});
	</script>
  </td>
</tr>
<tr>
  <td>Begin Date</td>
  <td>
<input size=15 id=begin_date name=begin_date value=" . sqlToUserDate($objects['begin_date']) . ">
	<button type=\"reset\" id=\"trigger_begin_date\" class=\"button\">...</button>
	<script type=\"text/javascript\">
		Calendar.setup({
			inputField	:	\"begin_date\",			// id of the input field
			ifFormat	:	\"%m/%d/%Y\",		// format of the input field
			button		:	\"trigger_begin_date\",	// trigger for the calendar (button ID)
			singleClick	:	true,
			step		:	1				// show all years in drop-down boxes (instead of every other year as default)
		});
	</script>
  </td>
</tr>
<tr>
  <td>End Date *</td>
  <td>
<input size=15 id=end_date name=end_date value=" . sqlToUserDate($objects['end_date']) . ">
	<button type=\"reset\" id=\"trigger_end_date\" class=\"button\">...</button>
	<script type=\"text/javascript\">
		Calendar.setup({
			inputField	:	\"end_date\",			// id of the input field
			ifFormat	:	\"%m/%d/%Y\",		// format of the input field
			button		:	\"trigger_end_date\",	// trigger for the calendar (button ID)
			singleClick	:	true,
			step		:	1				// show all years in drop-down boxes (instead of every other year as default)
		});
	</script>
  </td>
</tr>
<tr>
  <td>Savings *</td>
  <td><input name=savings_amount value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Cost Per Unit</td>
  <td><input name=cost_per_unit value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Zone *</td>
      <td>
          <select name=\"location\">
            <option>\n";
$location = $objects['location'];
$select_query = tep_db_query("SELECT value AS _key, value FROM reference WHERE category = 'Zone' ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($location == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
          echo "</select>
      </td>
</tr>
<tr>
  <td>Comments</td>
  <td>
<textarea rows=6 cols=25 name=comments>" . $objects['comments'] . "</textarea></td>
</tr>
<tr>
  <td align=center colspan=2><input type=\"submit\"></td>
</tr>
</table>

    </form>";
    //include($hfPrefix . "footer.php");
    return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display_edit_form')) 
  {
     $objects_query = tep_db_query("select * from deal WHERE deal_id = " . $_GET['deal_id']);
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
  <td>Deal Name</td>
  <td><input name=deal_name value=\"" . $objects['deal_name'] . "\"></td>
</tr>
<tr>
  <td>Download End Date</td>
  <td>
<input name=download_end_date value=" . sqlToUserDate($objects['download_end_date']) . "></td>
</tr>
<tr>
  <td>Begin Date</td>
  <td>
<input name=begin_date value=" . sqlToUserDate($objects['begin_date']) . "></td>
</tr>
<tr>
  <td>End Date</td>
  <td>
<input name=end_date value=" . sqlToUserDate($objects['end_date']) . "></td>
</tr>
<tr>
  <td>Original Amount</td>
  <td><input name=original_amount value=\"" . $objects['original_amount'] . "\"></td>
</tr>
<tr>
  <td>Savings</td>
  <td><input name=savings_amount value=\"" . $objects['savings_amount'] . "\"></td>
</tr>
<tr>
  <td>Cost Per Unit</td>
  <td><input name=cost_per_unit value=\"" . $objects['cost_per_unit'] . "\"></td>
</tr>
<tr>
  <td>Location</td>
  <td><input name=location value=\"" . $objects['location'] . "\"></td>
</tr>
<tr>
  <td>Comments</td>
  <td>
<textarea rows=6 cols=25 name=comments>" . $objects['comments'] . "</textarea></td>
</tr>
<tr>
  <td align=center colspan=2><input type=\"submit\"></td>
</tr>
</table>

    </form>";
    include($hfPrefix . "footer.php");
    return;
  }

if (isset($_GET['action']) && ($_GET['action'] == 'display_list')) 
{
  $rows = 0;
  echo "<a href=\" . $urlPrefix . \"action=display_create_form>Add Deal</a>";
  echo "<table border=1 width=\"100%\">";
  echo "<tr><td align=center><b>Action</b></td><td align=center><b>Name</b></td><td align=center><b>Savings</b></td><td align=center><b>Cost Per Unit</b></td></tr>\n";

  $objects_query = tep_db_query("SELECT * FROM deal ORDER BY deal_name");
  while ($objects = tep_db_fetch_array($objects_query)) 
  {
     $rows++;

     echo "<tr><a name=\"" . $objects['deal_id'] . "\"></a><td><a href=" . $URLPrefix . "action=delete&deal_id=" . $objects['deal_id'] . ">Delete</a><br><a href=" . $URLPrefix . "action=display_edit_form&deal_id=" . $objects['deal_id'] . ">Edit</a>";
echo "</td>  <td><a href=deal.php?action=display&deal_id=" . $objects['deal_id'] . ">" . displayField($objects['deal_name'],'STRING','') . "</a></td>  <td align=right>" . displayField($objects['savings_amount'],'NUMBER','$###,###.00') . "</td>  <td align=right>" . displayField($objects['cost_per_unit'],'NUMBER','$###,###.00') . "</td></tr>\n";

  }
  if ($rows == 0)
  {
     echo "<tr><td colspan=5 align=center>No Results</td></tr>";
  }
  echo "</table>";
  echo "<hr>";
}

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
