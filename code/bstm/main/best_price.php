<div class="componentheading">Best Price</div>
<?php
  if (isset($_GET['action']) && ($_GET['action'] == 'delete_confirm')) 
  {
      tep_db_query("DELETE FROM product_best_price WHERE product_best_price_id = " . $_GET['product_best_price_id']);
      if (isset($_GET['redirect_url']))
      {
          tep_redirect(tep_href_link($_GET['redirect_url'],'','SSL'));
      }
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'update_field'))
  {
      tep_db_query("UPDATE sale_line_item SET " . $_GET['field'] . "= '" .  $_GET['value'] . "' WHERE sale_line_item_id = " . $_GET['sale_line_item_id']);
      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
  }

  if (isset($_POST['action']) && ($_POST['action'] == 'edit')) 
  {
if (empty($_POST['product_best_price_name'])) {
   $messageStack->add('Best Price Name is required');
}
if (empty($_POST['store_id'])) {
   $messageStack->add('Store Name is required');
}
if (empty($_POST['store_location'])) {
   $messageStack->add('Store Location is required');
}
if (empty($_POST['product_id'])) {
   $messageStack->add('Product Name is required');
}
if (empty($_POST['price'])) {
   $messageStack->add('Price is required');
}
if (empty($_POST['price_units'])) {
   $messageStack->add('Price Units is required');
}
if (empty($_POST['price_date'])) {
   $messageStack->add('Price Date is required');
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
'store_id' => $_POST['store_id'],
'other_store_name' => $_POST['other_store_name'],
'store_location' => $_POST['store_location'],
'product_best_price_name' => $_POST['product_best_price_name'],
'product_id' => $_POST['product_id'],
'price' => $_POST['price'],
'price_units' => $_POST['price_units'],
'cost_per_unit' => $_POST['cost_per_unit'],
'cost_per_unit_units' => $_POST['cost_per_unit_units'],
'price_date' => usertoSQLDate($_POST['price_date']),
'location' => $_POST['location'],
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'redirect_url' && $key != 'view')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('product_best_price', $sql_data_array, 'update', "product_best_price_id= " . $_POST['product_best_price_id']);

      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
      //tep_redirect(tep_href_link('sale_line_item.php?action=display&sale_line_item_id=' . $_POST['sale_line_item_id'],'','SSL'));
      $_GET['action'] = "display";
      $_GET['product_best_price_id'] = $_POST['product_best_price_id'];
  }

  if (isset($_POST['action']) && ($_POST['action'] == 'create')) 
  {
if (empty($_POST['product_best_price_name'])) {
   $messageStack->add('Best Price Name is required');
}
if (empty($_POST['store_id'])) {
   $messageStack->add('Store Name is required (Select "Other" if the value is not in the list)');
}
if (empty($_POST['store_location'])) {
   $messageStack->add('Store Location is required (Enter at least the city)');
}
if (empty($_POST['product_id'])) {
   $messageStack->add('Product Name is required');
}
if (empty($_POST['price'])) {
   $messageStack->add('Price is required');
}
if (empty($_POST['price_units'])) {
   $messageStack->add('Price Units is required');
}
if (empty($_POST['price_date'])) {
   $messageStack->add('Price Date is required');
}
if (empty($_POST['location'])) {
   $messageStack->add('Zone is required');
}
 if ($messageStack->size > 0) { echo $messageStack->output(); return; }

$objects_query = tep_db_query("select * from product_best_price WHERE 1 = 2");
      if (mysql_num_rows($objects_query) == 0)
      {
         $sql_data_array = array('creation_date' => 'now()',
'created_by' => $user_id,
'modification_date' => 'now()',
'modified_by' => $user_id,
'product_best_price_name' => $_POST['product_best_price_name'],
'product_id' => $_POST['product_id'],
'store_id' => $_POST['store_id'],
'other_store_name' => $_POST['other_store_name'],
'price' => $_POST['price'],
'price_units' => $_POST['price_units'],
'price_date' => userToSQLDate($_POST['price_date']),
'cost_per_unit' => $_POST['cost_per_unit'],
'cost_per_unit_units' => $_POST['cost_per_unit_units'],
'location' => $_POST['location'],
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'redirect_url' && $key != 'view')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('product_best_price', $sql_data_array, 'insert', "product_best_price_id = " . $_POST['product_best_price_id']);

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
      $_GET['action'] = "display";
      $_GET['product_best_price_id'] = tep_db_insert_id();
  }

  if (isset($_GET['action']) && ($_GET['action'] == 'delete')) 
  {
     echo "Please confirm<br><hr>";
     if (isset($_GET['redirect_url']))
     {
        $redirect_url = "redirect_url=" . urlencode($_GET['redirect_url']);
        $redirect_url_with_ampersand = "&" . $redirect_url;
     }
     echo "<a href=sale_line_item.php?action=delete_confirm&sale_line_item_id=" . $_GET['sale_line_item_id'] . $redirect_url_with_ampersand . ">Yes</a>";
     echo "<hr>";
     if (isset($_GET['redirect_url']))
     {
        echo "<a href=" . $redirect_url . ">No</a>";
     }
     else
     {
        echo "<a href=sale_line_item.php>No</a>";
     }
     return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display_create_form')) 
  {
    echo "<div id=\"content\">
    <form action=\"index.php?view=best_price\" method=\"post\">
    <input type=\"hidden\" name=\"action\" value=\"create\">\n";

    while(list($key,$value) = each($_GET)) {
        if ($key != 'action')
        {
            echo "<input type=\"hidden\" name=\"" . $key . "\" value=\"" . $value . "\">\n";
        }
    }
echo "
<table class=contenttoc width=100%>
<tr>
  <td class=sectiontableheader>Best Price Name: *</td>
  <td class=bstm_td><input size=50 name=product_best_price_name value=\"" . '' . "\"></td>
</tr>
<tr>
  <td class=sectiontableheader>Store Name: *</td>
  <td class=bstm_td>
<select name=store_id>
  <option>";
$objects['store_id'] = '';
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
  <td class=sectiontableheader>Other Store Name: (*)</td>
  <td class=bstm_td><input name=other_store_name value=\"" . '' . "\"></td>
</tr>
<tr>
  <td class=sectiontableheader>Store Location: *</td>
  <td class=bstm_td><input name=store_location value=\"" . '' . "\"></td>
</tr>
<tr>
  <td class=sectiontableheader>Product Name: *</td>
  <td class=bstm_td>\n";
  createProductSelect("");
/*
<select name=product_id>
  <option>";
$objects['product_id'] = '';$select_query = tep_db_query("SELECT product_id as _key, concat(vendor_name, ' ', product_name)  as value FROM product,vendor WHERE product.vendor_id = vendor.vendor_id ORDER BY product_name");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;

   if (strpos($select['value'], "Any ") !== false) * KAD added to take off the any to make it easier to search *
   {
      $select['value'] = substr($select['value'], 4);
   }

   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['product_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
*/
echo "</td>
</tr>
<tr>
  <td class=sectiontableheader>Price: *</td>
  <td class=bstm_td><input name=price value=\"" . '' . "\"></td>
</tr>
<tr>
  <td class=sectiontableheader>Price Units: *</td>
  <td class=bstm_td>
<select name=price_units>
  <option>";
$select_query = tep_db_query("SELECT value as _key, value as value FROM reference WHERE category  = 'Unit of Measure' ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['price_units'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
  </td>
</tr>
<tr>
  <td class=sectiontableheader>Cost Per Unit:</td>
  <td class=bstm_td><input name=cost_per_unit value=\"" . '' . "\"></td>
</tr>
<tr>
  <td class=sectiontableheader>CPU Units:</td>
  <td class=bstm_td><input name=cost_per_unit_units value=\"" . '' . "\"></td>
</tr>
<tr>
  <td class=sectiontableheader>Price Date: *</td>
  <td class=bstm_td><input id=price_date name=price_date value=\"" . '' . "\">
	<button type=\"reset\" id=\"trigger_price_date\" class=\"button\">...</button>
	<script type=\"text/javascript\">
		Calendar.setup({
			inputField	:	\"price_date\",			// id of the input field
			ifFormat	:	\"%m/%d/%Y\",		// format of the input field
			button		:	\"trigger_price_date\",	// trigger for the calendar (button ID)
			singleClick	:	true,
			step		:	1				// show all years in drop-down boxes (instead of every other year as default)
		});
	</script>
  </td>
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
   </td>
</tr>
<tr>
  <td class=sectiontableheader>Comments:</td>
  <td class=bstm_td>
<textarea name=comments>" . $objects['comments'] . "</textarea></td>
</tr>
</table>

    <input type=\"submit\">
    </form>
    </div> <!- content ->";
    return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display_edit_form')) 
  {
     $objects_query = tep_db_query("select * from product_best_price WHERE product_best_price_id = " . $_GET['product_best_price_id']);
     $objects = tep_db_fetch_array($objects_query);
    echo "<div id=\"content\">
    <form action=\"index.php?view=best_price\" method=\"post\">
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
  <td>Best Price Name: *</td>
  <td><input size=50 name=product_best_price_name value=\"" . $objects['product_best_price_name'] . "\"></td>
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
  <td>Other Store Name: (*)</td>
  <td><input name=other_store_name value=\"" . $objects['other_store_name'] . "\"></td>
</tr>
<tr>
  <td>Store Location: *</td>
  <td><input name=store_location value=\"" . $objects['store_location'] . "\"></td>
</tr>
<tr>
  <td>Product Name: *</td>
  <td>\n";
  createProductSelect($objects['product_id']);
/*
<select name=product_id>
  <option>";
$select_query = tep_db_query("SELECT product_id as _key, concat(vendor_name, ' ', product_name)  as value FROM product,vendor WHERE product.vendor_id = vendor.vendor_id ORDER BY product_name");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['product_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
*/
echo "</td>
</tr>
<tr>
  <td>Price: *</td>
  <td><input name=price value=\"" . $objects['price'] . "\"></td>
</tr>
<tr>
  <td>Price Units: *</td>
  <td>
<select name=price_units>
  <option>";
$select_query = tep_db_query("SELECT value as _key, value as value FROM reference WHERE category  = 'Unit of Measure' ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['price_units'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Price Date: *</td>
  <td><input id=price_date name=price_date value=\"" . sqlToUserDate($objects['price_date']) . "\">
	<button type=\"reset\" id=\"trigger_price_date\" class=\"button\">...</button>
	<script type=\"text/javascript\">
		Calendar.setup({
			inputField	:	\"price_date\",			// id of the input field
			ifFormat	:	\"%m/%d/%Y\",		// format of the input field
			button		:	\"trigger_price_date\",	// trigger for the calendar (button ID)
			singleClick	:	true,
			step		:	1				// show all years in drop-down boxes (instead of every other year as default)
		});
	</script>
  </td>
</tr>
<tr>
  <td>Cost Per Unit:</td>
  <td><input name=cost_per_unit value=\"" . $objects['cost_per_unit'] . "\"></td>
</tr>
<tr>
  <td>CPU Units:</td>
  <td><input name=cost_per_unit_units value=\"" . $objects['cost_per_unit_units'] . "\"></td>
</tr>
<tr>
  <td>Zone: *</td>
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
  <td>Comments:</td>
  <td>
<textarea name=comments>" . $objects['comments'] . "</textarea></td>
</tr>
</table>

    <input type=\"submit\">
    </form>
    </div> <!- content ->";
    return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display')) 
  {
     printAddThisButton();
     $objects_query = tep_db_query("SELECT product_best_price.*, store.store_name, vendor.vendor_name, product.product_name FROM product_best_price, store, product, vendor WHERE product.vendor_id = vendor.vendor_id AND product_best_price.store_id = store.store_id AND product_best_price.product_id = product.product_id AND product_best_price.product_best_price_id = " . $_GET['product_best_price_id']);
     $objects = tep_db_fetch_array($objects_query);
     if (isset($objects['created_by']))
     {
        $user_query = tep_db_query("select concat(first_name, ' ', last_name) as user_name FROM user WHERE user_id = " . $objects['created_by']);
        $user = tep_db_fetch_array($user_query);
        $objects['created_by_name'] = $user['user_name'];
     }
     if (isset($objects['modified_by']))
     {
        $user_query = tep_db_query("select concat(first_name, ' ', last_name) as user_name FROM user WHERE user_id = " . $objects['modified_by']);
        $user = tep_db_fetch_array($user_query);
        $objects['modified_by_name'] = $user['user_name'];
     }
     echo "<div id=\"content\">";
     if (tep_session_is_registered('user_id'))
     {
        if ($role == 'admin' || $objects['user_id'] == $user_id || $objects['created_by'] == $user_id)
        {
           echo "<a href=index.php?view=best_price&action=display_edit_form&product_best_price_id=" . $objects['product_best_price_id'] . ">Edit</a>\n";
        }
     }
echo "<table class=contenttoc width=100% border=1>
<tr>
  <td class=sectiontableheader>Best Price Name</td>
  <td class=bstm_td>" .  $objects['product_best_price_name']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Store Name</td>
  <td class=bstm_td>" .  $objects['store_name']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Other Store Name</td>
  <td class=bstm_td>" .  $objects['other_store_name']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Store Location</td>
  <td class=bstm_td>" .  $objects['store_location']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Vendor Name</td>
  <td class=bstm_td>" .  $objects['vendor_name']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Product Name</td>
  <td class=bstm_td><a href=index.php?view=product&action=display&product_id=" . $objects['product_id'] . ">" . $objects['product_name']  . "</a></td>
</tr>
<tr>
  <td class=sectiontableheader>Price</td>
  <td class=bstm_td>" .  displayField($objects['price'],"NUMBER","$###,###.00")  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Price Units</td>
  <td class=bstm_td>" .  $objects['price_units']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Cost Per Unit</td>
  <td class=bstm_td>$" .  $objects['cost_per_unit'] . "</td>
</tr>
<tr>
  <td class=sectiontableheader>CPU Units</td>
  <td class=bstm_td>" .  $objects['cost_per_unit_units'] . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Price Date</td>
  <td class=bstm_td>" .  sqlToUserDate($objects['price_date'])  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Zone</td>
  <td class=bstm_td>" .  $objects['location']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Comments</td>
  <td class=bstm_td>" .  $objects['comments']  . "</td>
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
echo "</table>";
if (file_exists(MAIN_DIR . "/common/attachments/product_best_price/" . $objects['product_best_price_id'] . "/image.jpg"))
   echo "<img src=../common/attachments/product_best_price/" . $objects['product_best_price_id'] . "/image.jpg></img>";

     echo "</div> <!- content ->";
     return;
  }

if ($_GET['action'] == 'display_list')
{
  $rows = 0;
  echo "<a href=sale_line_item.php?action=display_create_form>Add Sale Line Item</a>";
  echo "<table border=1 width=\"100%\">";
  echo "<tr><td align=center><b>Action</b></td><td align=center><b>Name</b></td><td align=center><b>Product Name</b></td><td align=center><b>Price</b></td></tr>\n";

  $objects_query = tep_db_query("SELECT sale_line_item_id as id, product.product_name, sale_line_item.* FROM sale_line_item, product WHERE product.product_id = sale_line_item.product_id");
  while ($objects = tep_db_fetch_array($objects_query)) 
  {
     $rows++;

     echo "<tr><a name=\"" . $objects['sale_line_item_id'] . "\"></a><td><a href=sale_line_item.php?action=delete&sale_line_item_id=" . $objects['sale_line_item_id'] . ">Delete</a><br><a href=sale_line_item.php?action=display_edit_form&product_best_price_id=" . $objects['product_best_price_id'] . ">Edit</a>";
echo "</td>  <td><a href=sale_line_item.php?action=display&sale_line_item_id=" . $objects['sale_line_item_id'] . ">" . displayField($objects['sale_line_item_name'],'STRING','') . "</a></td>  <td>" . displayField($objects['product_name'],'STRING','') . "</td>  <td align=right>" . displayField($objects['price'],'NUMBER','$###,###.00') . "</td></tr>\n";

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

?>
