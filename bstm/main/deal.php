<div class="componentheading">Deals</div>
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

  if (isset($_GET['action']) && ($_GET['action'] == 'select_deal')) 
  {
     $objects_query = tep_db_query("SELECT * FROM deal WHERE deal_id = " . $_GET['deal_id']);
     $objects = tep_db_fetch_array($objects_query);
$objects_query = tep_db_query("select * from coupon WHERE deal_id = " . $_GET['deal_id']);
      if (mysql_num_rows($objects_query) == 0)
      {
         $sql_data_array = array('creation_date' => 'now()',
'created_by' => $user_id,
'deal_id' => $objects['deal_id'], 
'modification_date' => 'now()',
'modified_by' => $user_id,
'coupon_name' => $objects['deal_name'],
'begin_date' => $objects['begin_date'],
'end_date' => $objects['end_date'],
'product_id' => '95',
'source_id' => $objects['source_id'],
'delivery_mechanism_id' => '6',
'date_received' => 'now()',
'discount' => $objects['savings'],
'discount_type' => 'Price', 
'discount_units' => 'Dollars', 
'comments' => $objects['comments'],
'user_id' => $user_id);
tep_db_perform('coupon', $sql_data_array, 'insert', "coupon_id = " . $_POST['coupon_id']);
$_GET['coupon_id'] = tep_db_insert_id();
     }
     else
     {
        $objects = tep_db_fetch_array($objects_query);
        $_GET['coupon_id'] = $objects['coupon_id']; 
     }
     tep_db_query("UPDATE deal set num_downloads = num_downloads + 1 WHERE deal_id = " . $_GET['deal_id']);
$objects_query = tep_db_query("select * from my_coupons WHERE coupon_id = " . $_GET['coupon_id'] . " AND user_id = " . $user_id);
      if (mysql_num_rows($objects_query) == 0)
      {
         $sql_data_array = array('creation_date' => 'now()',
'created_by' => $user_id,
'modification_date' => 'now()',
'modified_by' => $user_id,
'user_id' => $user_id,
'coupon_id' => $_GET['coupon_id'],
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'view' && $key != 'redirect_url')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('my_coupons', $sql_data_array, 'insert', "my_coupons_id = " . $_POST['my_coupons_id']);
echo "Coupon added";
return;
      }
      else
      {
         $messageStack->add('This coupon has already been loaded'); 
         if ($messageStack->size > 0) { echo $messageStack->output(); return; }
      }
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'delete_confirm')) 
  {
      tep_db_query("DELETE FROM deal WHERE deal_id = " . $_GET['deal_id']);
      if (isset($_GET['redirect_url']))
      {
          tep_redirect(tep_href_link($_GET['redirect_url'],'','SSL'));
      }
      $_GET['action'] = 'display'; /* KAD */
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'update_field'))
  {
      tep_db_query("UPDATE deal SET " . $_GET['field'] . "= '" .  $_GET['value'] . "' WHERE deal_id = " . $_GET['deal_id']);
      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
      $_GET['action'] = 'display'; /* KAD */
  }

$display = false;

  if (isset($_POST['action']) && ($_POST['action'] == 'edit')) 
  {
if (empty($_POST['deal_name'])) {
   $messageStack->add('Deal Name is required');
}
if (empty($_POST['source_id'])) {
   $messageStack->add('Source is required');
}
if (empty($_POST['download_end_date'])) {
   $messageStack->add('Purchase/Download End Date is required');
}
if (empty($_POST['end_date'])) {
   $messageStack->add('End Date is required');
}
if (empty($_POST['savings_amount'])) {
   $messageStack->add('Savings Amount is required');
}
if (empty($_POST['location'])) {
   $messageStack->add('Zone is required');
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
if (empty($_POST['download_end_date'])) {
   $messageStack->add('Purchase/Download End Date is required');
}
if (empty($_POST['end_date'])) {
   $messageStack->add('End Date is required');
}
if (empty($_POST['original_amount'])) {
   $messageStack->add('Original Amount is required');
}
if (empty($_POST['savings_amount'])) {
   $messageStack->add('Savings Amount is required');
}
if (empty($_POST['location'])) {
   $messageStack->add('Zone is required');
}
 if ($messageStack->size > 0) { echo $messageStack->output(); return; }

$objects_query = tep_db_query("select * from deal WHERE deal_id != " . cs($_POST['deal_id'],"0") . " AND DEAL_NAME= '" . $_POST['deal_name'] . "'");
      if (mysql_num_rows($objects_query) == 0)
      {
         $sql_data_array = array('creation_date' => 'now()',
'created_by' => $user_id,
'modification_date' => 'now()',
'modified_by' => $user_id,
'user_id' => $user_id,
'deal_name' => $_POST['deal_name'],
'begin_date' => userToSQLDate($_POST['begin_date']),
'end_date' => userToSQLDate($_POST['end_date']),
'price' => $_POST['price'],
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
$_GET['deal_id'] = tep_db_insert_id();

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
      $_GET['action'] = 'display';
  }

  if ($mobilesite == 'true') include("header.php");

  if (isset($_GET['action']) && ($_GET['action'] == 'delete')) 
  {
     echo "Please confirm you would like to delete this deal<br><hr>";
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
     printAddThisButton();
    if (!isset($_GET['deal_id']) && isset($_POST['deal_id']))
        $_GET['deal_id'] = $_POST['deal_id'];

/* KAD leave off the ending quotes because it is an equation on the end */
     $objects_query = tep_db_query("SELECT deal.*, source.source_name, source.url as source_url FROM deal, source WHERE deal.source_id = source.source_id AND deal.deal_id = " . $_GET['deal_id']);
     $objects = tep_db_fetch_array($objects_query);
     $url = "";
     if (strlen($objects['url']) > 0)
     {
        $url = $objects['url'];
     }
     else
     {
        $url = $objects['source_url'];
     }
     if (isset($objects['created_by']))
     {
        $user_query = tep_db_query("select concat(first_name, ' ', last_name) as user_name FROM user WHERE user_id = " . $objects['created_by']);
        $user = tep_db_fetch_array($user_query);
        $objects['created_by'] = $user['user_name'];
     }
     if (isset($objects['modified_by']))
     {
        $user_query = tep_db_query("select concat(first_name, ' ', last_name) as user_name FROM user WHERE user_id = " . $objects['modified_by']);
        $user = tep_db_fetch_array($user_query);
        $objects['modified_by'] = $user['user_name'];
     }
     echo "<div id=\"content\">\n";
     if (tep_session_is_registered('user_id'))
     {
        if ($role == 'admin' || $objects['user_id'] == $user_id)
        {
           echo "<a href=" . $urlPrefix . "action=display_edit_form&deal_id=" . $objects['deal_id'] . ">Edit</a>\n";
        }
     }
if ($objects['source_name'] == 'Bring Savings To Me')
{
  echo "<a href=" . $urlPrefix . "action=select_deal&deal_id=" . $objects['deal_id'] . ">Select Deal</a>";
}
echo "<table class=contenttoc width=100% border=1>
<tr>
  <td class=sectiontableheader>Deal Name:</td>
  <td class=bstm_td><a href=" . $url . ">" .  $objects['deal_name']  . "</a></td>
</tr>
<tr>
  <td class=sectiontableheader>Comments:</td>
  <td class=bstm_td>" .  $objects['comments']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Source:</td>
  <td class=bstm_td>" .  $objects['source_name']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Purchase/Download End Date:</td>
  <td class=bstm_td>" . sqlToUserDate( $objects['download_end_date'] ) . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Begin Date:</td>
  <td class=bstm_td>" . sqlToUserDate( $objects['begin_date'] ) . "</td>
</tr>
<tr>
  <td class=sectiontableheader>End Date:</td>
  <td class=bstm_td>" . sqlToUserDate( $objects['end_date'] ) . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Price:</td>
  <td class=bstm_td>$" .  $objects['price']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Original Amount:</td>
  <td class=bstm_td>$" .  $objects['original_amount']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Savings:</td>
  <td class=bstm_td>$" .  $objects['savings_amount']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Cost Per Unit:</td>
  <td class=bstm_td>$" .  $objects['cost_per_unit']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Buy This Deal</td>
  <td class=bstm_td>" .  (strlen($objects['url']) > 0?"<a href=" . $objects['url']  . " TARGET=_new>Click Here</a>":"") . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Location:</td>
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
echo "</table>

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
<table class=contenttoc width=100%>
<tr>
  <td class=sectiontableheader>Deal Name: *</td>
  <td class=bstm_td><input size=50 name=deal_name value=\"" . '' . "\"></td>
</tr>
<tr>
  <td class=sectiontableheader>Source: *</td>
  <td class=bstm_td>
<select name=source_id>
  <option>";
$objects['source_id'] = '';$select_query = tep_db_query("SELECT source_id as _key, source_name as value FROM source ORDER BY source_name");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['source_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td class=sectiontableheader>Purchase/Download End Date: *</td>
  <td class=bstm_td><input id=download_end_date name=download_end_date value=" . sqlToUserDate($objects['download_end_date']) . ">
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
  <td class=sectiontableheader>Begin Date:</td>
  <td class=bstm_td><input id=begin_date name=begin_date value=" . sqlToUserDate($objects['begin_date']) . ">
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
  <td class=sectiontableheader>End Date: *</td>
  <td class=bstm_td>
<input id=end_date name=end_date value=" . sqlToUserDate($objects['end_date']) . ">
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
  <td class=sectiontableheader>Price: </td>
  <td class=bstm_td><input name=price value=\"" . '' . "\"></td>
</tr>
<tr>
  <td class=sectiontableheader>Original Amount: *</td>
  <td class=bstm_td><input name=original_amount value=\"" . '' . "\"></td>
</tr>
<tr>
  <td class=sectiontableheader>Savings: *</td>
  <td class=bstm_td><input name=savings_amount value=\"" . '' . "\"></td>
</tr>
<tr>
  <td class=sectiontableheader>Cost Per Unit:</td>
  <td class=bstm_td><input name=cost_per_unit value=\"" . '' . "\"></td>
</tr>
<tr>
  <td class=sectiontableheader>Zone: *</td>
      <td class=bstm_td>
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
</tr>
<tr>
  <td class=sectiontableheader>Comments:</td>
  <td class=bstm_td>
<textarea rows=6 cols=50 name=comments>" . $objects['comments'] . "</textarea></td>
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
  <td class=sectiontableheader>Deal Name: *</td>
  <td><input size=50 name=deal_name value=\"" . $objects['deal_name'] . "\"></td>
</tr>
<tr>
  <td class=sectiontableheader>Source: *</td>
  <td>
<select name=source_id>
  <option>";
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
  <td>Purchase/Download End Date: *</td>
  <td><input name=download_end_date value=" . sqlToUserDate($objects['download_end_date']) . "></td>
</tr>
<tr>
  <td>Begin Date:</td>
  <td>
<input name=begin_date value=" . sqlToUserDate($objects['begin_date']) . "></td>
</tr>
<tr>
  <td>End Date: *</td>
  <td>
<input name=end_date value=" . sqlToUserDate($objects['end_date']) . "></td>
</tr>
<tr>
  <td>Price:</td>
  <td><input name=price value=\"" . $objects['price'] . "\"></td>
</tr>
<tr>
  <td>Original Amount: *</td>
  <td><input name=original_amount value=\"" . $objects['original_amount'] . "\"></td>
</tr>
<tr>
  <td>Savings: *</td>
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
<textarea rows=6 cols=50 name=comments>" . $objects['comments'] . "</textarea></td>
</tr>
</table>

    <input type=\"submit\">
    </form>
    </div> <!- content ->";
    return;
  }

if (isset($_GET['action']) && ($_GET['action'] == 'display_list')) 
{
  $rows = 0;
  echo "<a href=" . $urlPrefix . "action=display_create_form>Add Deal</a>";
  echo "<table border=1 width=\"100%\">";
  echo "<tr><td align=center><b>Action</b></td><td align=center><b>Name</b></td><td align=center><b>Savings</b></td><td align=center><b>Cost Per Unit</b></td></tr>\n";

  $objects_query = tep_db_query("SELECT * FROM deal ORDER BY deal_name");
  while ($objects = tep_db_fetch_array($objects_query)) 
  {
     $rows++;

     echo "<tr><a name=\"" . $objects['deal_id'] . "\"></a><td><a href=" . $urlPrefix . "action=delete&deal_id=" . $objects['deal_id'] . ">Delete</a><br><a href=" . $urlPrefix . "action=display_edit_form&deal_id=" . $objects['deal_id'] . ">Edit</a>";
echo "</td>  <td><a href=" . $urlPrefix . "action=display&deal_id=" . $objects['deal_id'] . ">" . displayField($objects['deal_name'],'STRING','') . "</a></td>  <td align=right>" . displayField($objects['savings_amount'],'NUMBER','$###,###.00') . "</td>  <td align=right>" . displayField($objects['cost_per_unit'],'NUMBER','$###,###.00') . "</td></tr>\n";

  }
  if ($rows == 0)
  {
     echo "<tr><td colspan=5 align=center>No Results</td></tr>";
  }
  echo "</table>";

if ($rows > 0 && isset($_GET['action']) && ($_GET['action'] == 'search')) 
{
   return;
}
}

if ($mobilesite == 'true') include("footer.php");

?>
