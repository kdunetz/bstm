<div class="componentheading">Sale</div>
<?php
/* do the save actions up here so we can redirect if we want to */

  if (isset($_GET['action']) && ($_GET['action'] == 'delete_confirm')) 
  {
      tep_db_query("DELETE FROM sale WHERE sale_id = " . $_GET['sale_id']);
      if (isset($_GET['redirect_url']))
      {
          tep_redirect(tep_href_link($_GET['redirect_url'],'','SSL'));
      }
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'update_field'))
  {
      tep_db_query("UPDATE sale SET " . $_GET['field'] . "= '" .  $_GET['value'] . "' WHERE sale_id = " . $_GET['sale_id']);
      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
  }

  if (isset($_POST['action']) && ($_POST['action'] == 'edit')) 
  {
if (empty($_POST['sale_name'])) {
   $messageStack->add('Sale Name is required');
}
if (empty($_POST['store_id'])) {
   $messageStack->add('Store Name is required');
}
if (empty($_POST['begin_date'])) {
   $messageStack->add('Begin Date is required');
}
if (empty($_POST['end_date'])) {
   $messageStack->add('End Date is required');
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
'sale_name' => $_POST['sale_name'],
'store_id' => $_POST['store_id'],
'begin_date' => userToSQLDate($_POST['begin_date']),
'end_date' => userToSQLDate($_POST['end_date']),
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'redirect_url')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('sale', $sql_data_array, 'update', "sale_id = " . $_POST['sale_id']);

      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
      tep_redirect(tep_href_link('sale.php?action=display&sale_id=' . $_POST['sale_id'],'','SSL'));
  }

  if (isset($_POST['action']) && ($_POST['action'] == 'create')) 
  {
if (empty($_POST['sale_name'])) {
   $messageStack->add('Sale Name is required');
}
if (empty($_POST['store_id'])) {
   $messageStack->add('Store Name is required');
}
if (empty($_POST['begin_date'])) {
   $messageStack->add('Begin Date is required');
}
if (empty($_POST['end_date'])) {
   $messageStack->add('End Date is required');
}
 if ($messageStack->size > 0) { echo $messageStack->output(); return; }

$objects_query = tep_db_query("select * from sale WHERE 1 = 2");
      if (mysql_num_rows($objects_query) == 0)
      {
         $sql_data_array = array('creation_date' => 'now()',
'created_by' => $user_id,
'modification_date' => 'now()',
'modified_by' => $user_id,
'sale_name' => $_POST['sale_name'],
'store_id' => $_POST['store_id'],
'begin_date' => userToSQLDate($_POST['begin_date']),
'end_date' => userToSQLDate($_POST['end_date']),
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'redirect_url')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('sale', $sql_data_array, 'insert', "sale_id = " . $_POST['sale_id']);

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
  if (isset($_GET['action']) && ($_GET['action'] == 'delete')) 
  {
     echo "Please confirm you would like to delete this Sale<br><hr>";
     if (isset($_GET['redirect_url']))
     {
        $redirect_url = "redirect_url=" . urlencode($_GET['redirect_url']);
        $redirect_url_with_ampersand = "&" . $redirect_url;
     }
     echo "<a href=sale.php?action=delete_confirm&sale_id=" . $_GET['sale_id'] . $redirect_url_with_ampersand . ">Yes</a>";
     echo "<hr>";
     if (isset($_GET['redirect_url']))
     {
        echo "<a href=" . $redirect_url . ">No</a>";
     }
     else
     {
        echo "<a href=sale.php>No</a>";
     }
     return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display')) 
  {
/* KAD leave off the ending quotes because it is an equation on the end */
     $objects_query = tep_db_query("SELECT sale.*, store.store_name FROM sale, store WHERE store.store_id = sale.store_id AND sale.sale_id = " . $_GET['sale_id']);
     $objects = tep_db_fetch_array($objects_query);
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
     echo "<div id=\"content\">
<a href=index.php>Back to Sale List</a>";
if ($role == 'admin' || $objects['user_id'] == $user_id)
{
   echo " | <a href=sale.php?action=display_edit_form&sale_id=" . $objects['sale_id']. "&redirect_url="; echo urlencode("sale.php?action=display&sale_id=" . $objects['sale_id'] . ""); echo "&sale_id=" . $objects['sale_id']; echo ">Edit</a>\n";
}
echo "<table width=100% border=1>
<tr>
  <td>Sale Name: *</td>
  <td>" .  $objects['sale_name']  . "</td>
</tr>
<tr>
  <td>Store Name: *</td>
  <td>" .  $objects['store_name']  . "</td>
</tr>
<tr>
  <td>Begin Date: *</td>
  <td>" . sqlToUserDate( $objects['begin_date'] ) . "</td>
</tr>
<tr>
  <td>End Date: *</td>
  <td>" . sqlToUserDate( $objects['end_date'] ) . "</td>
</tr>
<tr>
  <td>Comments:</td>
  <td>" .  $objects['comments']  . "</td>
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
";
echo "<br>\n";
if ($role == 'admin' || $objects['user_id'] == $user_id)
{
  echo "<a href=index.php?view=sale_line_item.php&action=display_create_form&redirect_url="; echo urlencode("sale.php?action=display&sale_id=" . $objects['sale_id'] . ""); echo "&sale_id=" . $objects['sale_id'] . ">Add Sale Line Item</a>";
}
  echo "<table border=1 width=\"100%\">";
  echo "<tr><td align=center><b>Action</b></td><td align=center><b>Name</b></td><td align=center><b>Product Name</b></td><td align=center><b>Price</b></td></tr>\n";

  $objects_query = tep_db_query("SELECT sale_line_item.*, concat(vendor.vendor_name, ' ', product.product_name) as product_name FROM sale_line_item, product, vendor WHERE vendor.vendor_id = product.vendor_id AND sale_line_item.product_id = product.product_id AND sale_line_item.sale_id = " . $objects['sale_id']);
  while ($objects = tep_db_fetch_array($objects_query)) 
  {
     $rows++;

     echo "<tr><a name=\"" . $objects['sale_line_item_id'] . "\"></a><td><a href=index.php?sale_line_item&action=delete&sale_line_item_id=" . $objects['sale_line_item_id']. "&redirect_url="; echo urlencode("sale.php?action=display&sale_id=" . $objects['sale_id'] . ""); echo ">Delete</a><br><a href=index.php?view=sale_line_item&action=display_edit_form&sale_line_item_id=" . $objects['sale_line_item_id']. "&redirect_url="; echo urlencode("sale.php?action=display&sale_id=" . $objects['sale_id'] . ""); echo "&sale_id=" . $objects['sale_id']; echo ">Edit</a>";
echo "</td>  <td><a href=index.php?view=sale_line_item&action=display&sale_line_item_id=" . $objects['sale_line_item_id'] . ">" . displayField($objects['sale_line_item_name'],'STRING','') . "</a></td>  <td>" . displayField($objects['product_name'],'STRING','') . "</td>  <td align=right>" . displayField($objects['price'],'NUMBER','$###,###.00') . "</td></tr>\n";

  }
  if ($rows == 0)
  {
     echo "<tr><td colspan=5 align=center>No Results</td></tr>";
  }
  echo "</table>";
echo "
     </div> <!- content ->";
     return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display_create_form')) 
  {
    echo "<div id=\"content\">
    <form action=\"sale.php\" method=\"post\">
    <input type=\"hidden\" name=\"action\" value=\"create\">\n";

    while(list($key,$value) = each($_GET)) {
        if ($key != 'action')
        {
            echo "<input type=\"hidden\" name=\"" . $key . "\" value=\"" . $value . "\">\n";
        }
    }
echo "
<table width=100% border=1>
<tr>
  <td>Sale Name: *</td>
  <td><input name=sale_name value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Store Name: *</td>
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
<tr>
  <td>Begin Date: *</td>
  <td>
<input name=begin_date value=" . sqlToUserDate($objects['begin_date']) . "></td>
</tr>
<tr>
  <td>End Date: *</td>
  <td>
<input name=end_date value=" . sqlToUserDate($objects['end_date']) . "></td>
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
     $objects_query = tep_db_query("select * from sale WHERE sale_id = " . $_GET['sale_id']);
     $objects = tep_db_fetch_array($objects_query);
    echo "<div id=\"content\">
    <form action=\"sale.php\" method=\"post\">
    <input type=\"hidden\" name=\"action\" value=\"edit\">\n";
    while(list($key,$value) = each($_GET)) {
        if ($key != 'action')
        {
            echo "<input type=\"hidden\" name=\"" . $key . "\" value=\"" . $value . "\">\n";
        }
     }
echo "
<table width=100% border=1>
<tr>
  <td>Sale Name: *</td>
  <td><input name=sale_name value=\"" . $objects['sale_name'] . "\"></td>
</tr>
<tr>
  <td>Store Name: *</td>
  <td>
<select name=store_id>
  <option>";
$select_query = tep_db_query("SELECT store_id as _key, store_name as value FROM store ORDER BY store_name");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['store_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Begin Date: *</td>
  <td>
<input name=begin_date value=" . sqlToUserDate($objects['begin_date']) . "></td>
</tr>
<tr>
  <td>End Date: *</td>
  <td>
<input name=end_date value=" . sqlToUserDate($objects['end_date']) . "></td>
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

  $rows = 0;
  echo "<a href=sale.php?action=display_create_form>Add Sale</a>";
  echo "<table border=1 width=\"100%\">";
  echo "<tr><td align=center><b>Action</b></td><td align=center><b>Name</b></td><td align=center><b>Store</b></td><td align=center><b>Begin Date</b></td><td align=center><b>End Date</b></td></tr>\n";

  $objects_query = tep_db_query("SELECT sale_id as id, store.store_name, sale.* FROM sale,store WHERE store.store_id = sale.store_id AND end_date >= date(now()) ORDER BY end_date");
  while ($objects = tep_db_fetch_array($objects_query)) 
  {
     $rows++;

     echo "<tr><a name=\"" . $objects['sale_id'] . "\"></a><td><a href=sale.php?action=delete&sale_id=" . $objects['sale_id'] . ">Delete</a><br><a href=sale.php?action=display_edit_form&sale_id=" . $objects['sale_id'] . ">Edit</a>";
echo "</td>  <td><a href=sale.php?action=display&sale_id=" . $objects['sale_id'] . ">" . displayField($objects['sale_name'],'STRING','') . "</a></td>  <td>" . displayField($objects['store_name'],'STRING','') . "</td>  <td>" . displayField($objects['begin_date'],'DATETIME','') . "</td>  <td>" . displayField($objects['end_date'],'DATETIME','') . "</td></tr>\n";

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

?>
