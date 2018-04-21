<div class="componentheading">My Shopping List</div>
<?php
  if ($_GET['action'] != "simple_list" && $_GET['action'] != "send_list" && $_GET['action'] != 'simple_list' && $_GET['action'] != 'send_list_confirm_email')
     echo "<p>Product missing? Click <a href=index.php?view=request_catalog_update&category=product>here</a> to request a product be added to our catalog.<br><br>\n";

/*
  if (!tep_session_is_registered('user_id')) {
    //$navigation->set_snapshot();
    tep_redirect(tep_href_link('index.php?tab=3', '', 'SSL'));
  }
*/

/* do the save actions up here so we can redirect if we want to */

  if (isset($_GET['action']) && ($_GET['action'] == 'delete_confirm')) 
  {
      tep_db_query("DELETE FROM shopping_list WHERE shopping_list_id = " . $_GET['shopping_list_id']);
      if (isset($_GET['redirect_url']))
      {
          tep_redirect(tep_href_link($_GET['redirect_url'],'','SSL'));
      }
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'update_field'))
  {
      tep_db_query("UPDATE shopping_list SET " . $_GET['field'] . "= '" .  $_GET['value'] . "' WHERE shopping_list_id = " . $_GET['shopping_list_id']);
      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'send_list_confirm_email'))
  {
global $email;
     echo "<br><p><p>Send to these addresses:\n";
     echo "<form action=\"index.php?view=my_shopping_list\" method=\"post\">\n";
     echo "<input type=\"hidden\" name=\"action\" value=\"send_list\"><br>\n";
     echo "Email Address: <input name=\"email_address\" value=\"" . $email . "\"><br>\n";
     echo "Email Address 2: <input name=\"email_address2\" value=\"\"><br>\n";
     echo "<input type=\"submit\">\n";
     echo "</form>\n";
     return; 
  }
  if (isset($_POST['action']) && ($_POST['action'] == 'send_list'))
  {
    $originalAction = $_GET['action'];
    $_GET['action'] = "simple_list";
     if (sendMail("admin@bringsavingstome.com", $_POST['email_address'] . (isset($_POST['email_address2'])?"," . $_POST['email_address2']:""), "Your Shopping List From Bring Savings To Me", createShoppingList()))
     {
         echo "<p><p>Your Shopping List has been sent to you";
         echo createShoppingList();
         $_GET['action'] = $originalAction;
         return;
     }
  }

$display = false;
  if (isset($_POST['action']) && ($_POST['action'] == 'edit')) 
  {
if (empty($_POST['product_id'])) {
   $messageStack->add('Product Name is required');
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
'product_id' => $_POST['product_id'],
'other_product_name' => $_POST['other_product_name'],
'status' => $_POST['status'],
'store_id' => $_POST['store_id'],
'purchase_frequency' => $_POST['purchase_frequency'],
'purchase_frequency_units' => $_POST['purchase_frequency_units'],
'desired_price' => $_POST['desired_price'],
'price_units' => $_POST['price_units'],
'current_quantity' => $_POST['current_quantity'],
'quantity_units' => $_POST['quantity_units'],
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'view' && $key != 'redirect_url')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('shopping_list', $sql_data_array, 'update', "shopping_list_id = " . $_POST['shopping_list_id']);

      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
      // KAD tep_redirect(tep_href_link('index.php?view=my_shopping_list&action=display&shopping_list_id=' . $_POST['shopping_list_id'],'','SSL'));
      $display= "true";
  }

  if (isset($_POST['action']) && ($_POST['action'] == 'create')) 
  {
if (empty($_POST['product_id'])) {
   $messageStack->add('Product Name is required');
}
 if ($messageStack->size > 0) { echo $messageStack->output(); return; }

$objects_query = tep_db_query("select * from shopping_list WHERE product_id = " . $_POST['product_id'] . " AND user_id = " . $user_id);
      if (mysql_num_rows($objects_query) == 0)
      {
         $sql_data_array = array('creation_date' => 'now()',
'created_by' => $user_id,
'modification_date' => 'now()',
'modified_by' => $user_id,
'user_id' => $user_id,
'product_id' => $_POST['product_id'],
'other_product_name' => $_POST['other_product_name'],
'status' => $_POST['status'],
'store_id' => $_POST['store_id'],
'purchase_frequency' => $_POST['purchase_frequency'],
'purchase_frequency_units' => $_POST['purchase_frequency_units'],
'desired_price' => $_POST['desired_price'],
'price_units' => $_POST['price_units'],
'current_quantity' => $_POST['current_quantity'],
'quantity_units' => $_POST['quantity_units'],
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'view' && $key != 'redirect_url')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('shopping_list', $sql_data_array, 'insert', "shopping_list_id = " . $_POST['shopping_list_id']);

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
     echo "Please confirm you would like to delete this Shopping List Item<br><hr>";
     if (isset($_GET['redirect_url']))
     {
        $redirect_url = "redirect_url=" . urlencode($_GET['redirect_url']);
        $redirect_url_with_ampersand = "&" . $redirect_url;
     }
     echo "<a href=index.php?view=my_shopping_list&action=delete_confirm&shopping_list_id=" . $_GET['shopping_list_id'] . $redirect_url_with_ampersand . ">Yes</a>";
     echo "<hr>";
     if (isset($_GET['redirect_url']))
     {
        echo "<a href=" . $redirect_url . ">No</a>";
     }
     else
     {
        echo "<a href=index.php&view=my_shopping_list>No</a>";
     }
     return;
  }
  if ((isset($_GET['action']) && ($_GET['action'] == 'display')) || $display == "true") 
  {
/* KAD leave off the ending quotes because it is an equation on the end */
if (!isset($_GET['shopping_list_id']) && isset($_POST['shopping_list_id']))
   $_GET['shopping_list_id'] = $_POST['shopping_list_id'];
     $objects_query = tep_db_query("SELECT shopping_list.*,user.first_name, user.last_name, product.product_name, concat(vendor_name, ' ', product_name) as product_name2 FROM shopping_list,user,product,vendor WHERE product.vendor_id = vendor.vendor_id AND shopping_list.product_id = product.product_id AND shopping_list.user_id = user.user_id AND shopping_list.shopping_list_id = " . $_GET['shopping_list_id']);
     $objects = tep_db_fetch_array($objects_query);
     if (isset($objects['created_by']))
     {
        $user_query = tep_db_query("select concat(first_name, ' ', last_name) as user_name FROM user WHERE user_id = " . $objects['created_by']);
        $user = tep_db_fetch_array($user_query);
        $objects['created_by'] = $user['last_name'];
     }
     if (isset($objects['modified_by']))
     {
        $user_query = tep_db_query("select concat(first_name, ' ', last_name) as user_name FROM user WHERE user_id = " . $objects['modified_by']);
        $user = tep_db_fetch_array($user_query);
        $objects['modified_by'] = $user['last_name'];
     }
     if (isset($objects['store_id']))
     {
        $user_query = tep_db_query("select store_name FROM store WHERE store_id = " . $objects['store_id']);
        $user = tep_db_fetch_array($user_query);
        $objects['store_name'] = $user['store_name'];
     }
     echo "<div id=\"content\">
<a href=index.php?view=my_shopping_list&action=list>Back to Shopping List</a> |
<a href=index.php?view=my_shopping_list&action=display_edit_form&shopping_list_id=" . $objects['shopping_list_id'] . ">Edit</a>\n<table width=100% border=1>\n
<tr>
  <td>Product Name: *</td>
  <td>" .  $objects['product_name2']  . "</td>
</tr>
<tr>
  <td>Other Product Name:</td>
  <td>" .  $objects['other_product_name']  . "</td>
</tr>
<tr>
  <td>Status:</td>
  <td>" .  $objects['status']  . "</td>
</tr>
<tr>
  <td>Default Store:</td>
  <td>" .  $objects['store_name']  . "</td>
</tr>
<tr>
  <td>Frequency:</td>
  <td>" .  $objects['purchase_frequency']  . "</td>
</tr>
<tr>
  <td>Frequency Units:</td>
  <td>" .  $objects['purchase_frequency_units']  . "</td>
</tr>
<tr>
  <td>Desired Price:</td>
  <td>" .  displayField($objects['desired_price'],"NUMBER","$###,###.00")  . "</td>
</tr>
<tr>
  <td>Price Units:</td>
  <td>" .  $objects['price_units']  . "</td>
</tr>
<tr>
  <td>Current Quantity:</td>
  <td>" .  $objects['current_quantity'] . "</td>
</tr>
<tr>
  <td>Quantity Units:</td>
  <td>" .  $objects['quantity_units']  . "</td>
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
echo "</table>\n";
printBestPrices($objects['product_id']);
     echo "</div> <!- content ->\n";
     return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display_create_form')) 
  {
    echo "<div id=\"content\">
    <form action=\"index.php?view=my_shopping_list&action=create\" method=\"post\">
    <input type=\"hidden\" name=\"view\" value=\"shopping_list\">
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
  <td>Product Name: *</td>
  <td>\n";
   createProductSelect("");
echo "</td>
</tr>
<tr>
  <td>Other Product Name:</td>
  <td><input name=other_product_name value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Status:</td>
  <td>
<select name=status>\n";
echo "
  <option value=\"Got\""; if ($objects['status'] == 'Got') echo " SELECTED";echo ">Got
  <option value=\"Need\" SELECTED>Need
  <option value=\"Want\""; if ($objects['status'] == 'Want') echo " SELECTED";echo ">Want
";
echo "</select>
</td>
</tr>
<tr>
  <td>Default Store:</td>
  <td>
    <select name=store_id>\n
      <option>\n";

$select_query = tep_db_query("SELECT store_id as _key, store_name as value FROM store ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['store_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Frequency:</td>
  <td><input name=purchase_frequency value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Frequency Units:</td>
  <td>
<select name=purchase_frequency_units>
  <option>";
echo "
  <option value=\"Day\""; if ($objects['purchase_frequency_units'] == 'Day') echo " SELECTED";echo ">Day
  <option value=\"Week\""; if ($objects['purchase_frequency_units'] == 'Week') echo " SELECTED";echo ">Week
  <option value=\"Month\""; if ($objects['purchase_frequency_units'] == 'Month') echo " SELECTED";echo ">Month
  <option value=\"Year\""; if ($objects['purchase_frequency_units'] == 'Year') echo " SELECTED";echo ">Year
";
echo "</select>
</td>
</tr>
<tr>
  <td>Desired Price:</td>
  <td><input name=desired_price value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Price Units:</td>
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
  <td>Current Quantity:</td>
  <td><input name=current_quantity></td>
</tr>
<tr>
  <td>Quantity Units:</td>
  <td><input name=quantity_units></td>
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
  if (isset($_GET['action']) && ($_GET['action'] == 'display_edit_form')) 
  {
     $objects_query = tep_db_query("select * from shopping_list WHERE shopping_list_id = " . $_GET['shopping_list_id']);
     $objects = tep_db_fetch_array($objects_query);
    echo "<div id=\"content\">
    <form action=\"index.php?view=my_shopping_list&action=edit\" method=\"post\">
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
  <td>Other Product Name:</td>
  <td><input name=other_product_name value=\"" . $objects['other_product_name'] . "\"></td>
</tr>
<tr>
  <td>Status:</td>
  <td>
<select name=status>";
echo "
  <option value=\"Got\""; if ($objects['status'] == 'Got') echo " SELECTED";echo ">Got
  <option value=\"Need\""; if ($objects['status'] == 'Need') echo " SELECTED";echo ">Need
  <option value=\"Want\""; if ($objects['status'] == 'Want') echo " SELECTED";echo ">Want
";
echo "</select>
</td>
</tr>
<tr>
  <td>Default Store:</td>
  <td>
    <select name=store_id>\n
      <option>\n";
$select_query = tep_db_query("SELECT store_id as _key, store_name as value FROM store ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['store_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Frequency:</td>
  <td><input name=purchase_frequency value=\"" . $objects['purchase_frequency'] . "\"></td>
</tr>
<tr>
  <td>Frequency Units:</td>
  <td>
<select name=purchase_frequency_units>
  <option>";
echo "
  <option value=\"Day\""; if ($objects['purchase_frequency_units'] == 'Day') echo " SELECTED";echo ">Day
  <option value=\"Week\""; if ($objects['purchase_frequency_units'] == 'Week') echo " SELECTED";echo ">Week
  <option value=\"Month\""; if ($objects['purchase_frequency_units'] == 'Month') echo " SELECTED";echo ">Month
  <option value=\"Year\""; if ($objects['purchase_frequency_units'] == 'Year') echo " SELECTED";echo ">Year
";
echo "</select>
</td>
</tr>
<tr>
  <td>Desired Price:</td>
  <td><input name=desired_price value=\"" . $objects['desired_price'] . "\"></td>
</tr>
<tr>
  <td>Price Units:</td>
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
  <td>Current Quantity:</td>
  <td><input name=current_quantity value=\"" . $objects['current_quantity'] . "\"></td>
</tr>
<tr>
  <td>Quantity Units:</td>
  <td><input name=quantity_units value=\"" . $objects['quantity_units'] . "\"></td>
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

  $rows = 0;
  if ($_GET['product_type'] == "") $_GET['product_type'] = 'Food';
  $product_type = $_GET['product_type'];
  if ($_GET['action'] != "simple_list")
  {
//<a class="button" href="#" onclick="this.blur(); return false;"><span>Cancel</span></a>
     echo "<a class=\"button\" href=index.php?view=my_shopping_list&action=display_create_form><span>Add Shopping List Item</span></a>\n";
     echo "<a class=\"button\" href=simpleindex.php?view=my_shopping_list&action=simple_list TARGET=new><span>Print Shopping List</span></a>\n";
     echo "<a class=\"button\" href=index.php?view=my_shopping_list&action=send_list_confirm_email><span>Email Shopping List</span></a>\n";
  }
  else
     echo "<a href=\"javascript:window.print()\">Print Shopping List</a>\n";
  $simplePrefix = "";
  if ($_GET['action'] == "simple_list")
     $simplePrefix = "simple";
  echo "<select name=product_type onChange=\"window.open('" . $simplePrefix. "index.php?view=my_shopping_list&action=" . $_GET['action'] . "&product_type=' + this.options[this.selectedIndex].value,'_self');\">\n";

$objects['product_type'] = '';
$select_query = tep_db_query("SELECT subcategory AS _key, value FROM reference WHERE category = 'Product Type' ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   if (strpos($select['value'], "Any ") !== false) /* KAD added to take off the any to make it easier to search */
   {
      $select['value'] = substr($select['value'], 4);
   }
   echo "<option value=\"" . $select['_key'] . "\""; if ($product_type == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>";

/*
  echo "<option" . ($product_type == 'Food'?" SELECTED":"") . ">Food\n";
  echo "<option" . ($product_type == 'Electronics'?" SELECTED":"") . ">Electronics\n";
  echo "<option" . ($product_type == 'Lawn Care'?" SELECTED":"") . ">Lawn Care\n";
  echo "</select>\n";
*/
  echo createShoppingList();

if ($rows > 0 && isset($_GET['action']) && ($_GET['action'] == 'search')) 
{
   return;
}

?>
