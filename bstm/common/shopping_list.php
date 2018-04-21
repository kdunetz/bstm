<center><h3><font color=blue>Shopping List</font></h3></center>
<p>
<font color=black>
<?php
  $urlPrefix = "";
  if ($mobilesite == 'true')
  {
     $urlPrefix = "shopping_list.php?";
     $urlPrefixShort = "shopping_list.php";
  }
  else
  {
     $urlPrefix = "index.php?view=shopping_list&";
     $urlPrefixShort = "index.php?view=shopping_list";
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

  if (isset($_POST['action']) && ($_POST['action'] == 'edit')) 
  {
if (empty($_POST['product_id'])) {
   $messageStack->add('Product Name is required');
}
if ($messageStack->size > 0)
{
   echo $messageStack->output(); 
   //include($hfPrefix . "footer.php");
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
'product_id' => $_POST['product_id'],
'other_product_name' => $_POST['other_product_name'],
'status' => $_POST['status'],
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
      if ($mobilesite == 'true')
         tep_redirect(tep_href_link($urlPrefix . 'action=display&deal_id=' . $_POST['deal_id'],'','SSL'));
      else
         $_GET['action'] = 'display';

  }

  if (isset($_POST['action']) && ($_POST['action'] == 'create')) 
  {
if (empty($_POST['product_id'])) {
   $messageStack->add('Product Name is required');
}
if ($messageStack->size > 0)
{
   echo $messageStack->output(); 
   //include($hfPrefix . "footer.php");
   return;
}

$objects_query = tep_db_query("select * from shopping_list WHERE product_id = " . $_POST['product_id'] . " AND user_id = " . $user_id);
      if (mysql_num_rows($objects_query) == 0)
      {
/* KAD added user_id */
         $sql_data_array = array('creation_date' => 'now()',
'created_by' => $user_id,
'modification_date' => 'now()',
'modified_by' => $user_id,
'user_id' => $user_id,
'product_id' => $_POST['product_id'],
'other_product_name' => $_POST['other_product_name'],
'status' => $_POST['status'],
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
     echo "Please confirm you would like to delete this Shopping List Item<br><hr>";
     $redirect_url = "";
     if (isset($_GET['redirect_url']))
     {
        $redirect_url = "redirect_url=" . urlencode($_GET['redirect_url']);
        $redirect_url_with_ampersand = "&" . $redirect_url;
     }
     echo "<a href=" . $urlPrefix . "action=delete_confirm&shopping_list_id=" . $_GET['shopping_list_id'] . ">Yes</a>";
     echo "<hr>";
     if (isset($_GET['redirect_url']))
     {
        echo "<a href=" . $redirect_url . ">No</a>";
     }
     else
     {
        echo "<a href=" . $urlPrefixShort . ">No</a>";
     }
     //include($hfPrefix . "footer.php");
     return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display')) 
  {
    if (!isset($_GET['shopping_list_id']) && isset($_POST['shopping_list_id']))
        $_GET['shopping_list_id'] = $_POST['shopping_list_id'];

/* KAD leave off the ending quotes because it is an equation on the end */
     $objects_query = tep_db_query("SELECT shopping_list.*,user.user_name,product.product_name,concat(vendor.vendor_name, ' ', product.product_name) as product_name2 FROM shopping_list,user,product,vendor WHERE product.vendor_id = vendor.vendor_id AND shopping_list.product_id = product.product_id AND shopping_list.user_id = user.user_id AND shopping_list.shopping_list_id = " . $_GET['shopping_list_id']);
     $objects = tep_db_fetch_array($objects_query);

     if (strpos($objects['product_name2'], "Any ") !== false)
     {
        $objects['product_name2'] = substr($objects['product_name2'], 4);
     }

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
     echo "<p><a href=" . $urlPrefix . "action=display_edit_form&shopping_list_id=" . $objects['shopping_list_id'] . ">Edit</a>
<table width=100% border=1>
<tr>
  <td>Product Name</td>
  <td>" .  $objects['product_name2']  . "</td>
</tr>
<tr>
  <td>Other Product Name</td>
  <td>" .  $objects['other_product_name']  . "</td>
</tr>
<tr>
  <td>Status</td>
  <td>" .  $objects['status']  . "</td>
</tr>
<tr>
  <td>Frequency</td>
  <td>" .  $objects['purchase_frequency']  . "</td>
</tr>
<tr>
  <td>Frequency Units</td>
  <td>" .  $objects['purchase_frequency_units']  . "</td>
</tr>
<tr>
  <td>Desired Price</td>
  <td>" .  displayField($objects['desired_price'],'NUMBER','$###,###.00') .  "</td>
</tr>
<tr>
  <td>Price Units</td>
  <td>" .  $objects['price_units']  . "</td>
</tr>
<tr>
  <td>Current Quantity</td>
  <td>" .  $objects['current_quantity']  . "</td>
</tr>
<tr>
  <td>Quantity Units</td>
  <td>" .  $objects['quantity_units']  . "</td>
</tr>
<tr>
  <td>Comments</td>
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
echo "<p><p><b>Best Prices</b><p>\n";
     //$objects_query = tep_db_query("SELECT * FROM product_best_price, product, store WHERE product_best_price.product_id = product.product_id AND product_best_price.store_id = store.store_id AND product_best_price.product_id = " . $objects['product_id']);
global $location_filter;
$product_id = $objects['product_id'];
     $sqlCommand = "SELECT 'product_best_price' as _table, product_best_price.product_best_price_id as _id, store.store_name, product_best_price.price, price_units, price_date as date, product_best_price.cost_per_unit, product_best_price.cost_per_unit_units, '' as special_promotion FROM product_best_price, product, store WHERE product_best_price.product_id = product.product_id AND product_best_price.store_id = store.store_id AND product_best_price.product_id = " . $product_id . " AND '" . $location_filter . "' LIKE concat('%',location,'%')";
     $sqlCommand .= " UNION SELECT 'sale_line_item' as _table, sale_line_item.sale_line_item_id as _id, store.store_name, sale_line_item.price, price_units, end_date AS date, sale_line_item.cost_per_unit, sale_line_item.cost_per_unit_units, sale_line_item.special_promotion FROM sale, sale_line_item, store WHERE sale.sale_id = sale_line_item.sale_id AND sale.store_id = store.store_id AND sale_line_item.product_id = " . $product_id . " ORDER BY date DESC";
  $objects_query = tep_db_query($sqlCommand);
  $rows = 0;
  echo "<table border=1 width=\"100%\">\n";
  echo "<tr><td align=center><b>Store</b></td><td align=center><b>Date</b></td><td align=center><b>Price</b></td></tr>\n";
while ($objects = tep_db_fetch_array($objects_query))
{
   $rows++;
   $priceString = "";

   if ($objects['price'] == 0)
      $priceString = $objects['special_promotion'];
   else
      $priceString = displayField($objects['price'],'NUMBER','$###,###.00');

   echo "<td>" . displayField($objects['store_name'],'STRING','') . "</td><td>" . displayField(sqlToUserDate($objects['date']),'STRING','') . "</td><td>" . $priceString .  "</td></tr>\n";
}
  if ($rows == 0)
  {
     echo "<tr><td colspan=3 align=center>No Results</td></tr>";
  }
  echo "</table>\n";


     //include($hfPrefix . "footer.php");
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
echo "<p><table width=100% border=1>
<tr>
  <td>Product Name * <a href=index.php?view=product&action=display_create_form TARGET=new>(+)</a></td>
  <td>
<select name=product_id>
  <option>";
$objects['product_id'] = '';$select_query = tep_db_query("SELECT product_id as _key, concat(vendor_name, ' ', product_name)  as value FROM product,vendor WHERE product.vendor_id = vendor.vendor_id ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   if (strpos($select['value'], "Any ") !== false) /* KAD added to take off the any to make it easier to search */
   {
      $select['value'] = substr($select['value'], 4);
   }
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['product_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Other Product Name</td>
  <td><input name=other_product_name value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Status</td>
  <td>
<select name=status>
  <option>";
echo "
  <option value=\"Got\""; if ($objects['status'] == 'Got') echo " SELECTED";echo ">Got
  <option value=\"Need\""; if ($objects['status'] == 'Need') echo " SELECTED";echo ">Need
  <option value=\"Want\""; if ($objects['status'] == 'Want') echo " SELECTED";echo ">Want
  <option value=\"Buy If On Sale\""; if ($objects['status'] == 'Buy If On Sale') echo " SELECTED";echo ">Buy If On Sale
";
echo "</select>
</td>
</tr>
<tr>
  <td>Frequency</td>
  <td><input name=purchase_frequency value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Frequency Units</td>
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
  <td>Desired Price</td>
  <td><input name=desired_price value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Price Units</td>
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
  <td>Current Quantity</td>
  <td><input name=current_quantity></td>
</tr>
<tr>
  <td>Quantity Units</td>
  <td><input name=quantity_units></td>
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
     $objects_query = tep_db_query("select * from shopping_list WHERE shopping_list_id = " . $_GET['shopping_list_id']);
     $objects = tep_db_fetch_array($objects_query);
    echo "<form action=\"" . $urlPrefixShort . "\" method=\"post\">
    <input type=\"hidden\" name=\"action\" value=\"edit\">\n";
    while(list($key,$value) = each($_GET)) {
        if ($key != 'action' && $key != 'view')
        {
            echo "<input type=\"hidden\" name=\"" . $key . "\" value=\"" . $value . "\">\n";
        }
     }
echo "<p><table width=100% border=1>
<tr>
  <td>Product Name</td>
  <td>
<select name=product_id>
  <option>";
$select_query = tep_db_query("SELECT product_id as _key, concat(vendor_name, ' ', product_name)  as value FROM product,vendor WHERE product.vendor_id = vendor.vendor_id ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   if (strpos($select['value'], "Any ") !== false) /* KAD added to take off the any to make it easier to search */
   {
      $select['value'] = substr($select['value'], 4);
   }
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['product_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Other Product Name</td>
  <td><input name=other_product_name value=\"" . $objects['other_product_name'] . "\"></td>
</tr>
<tr>
  <td>Status</td>
  <td>
<select name=status>
  <option>";
echo "
  <option value=\"Got\""; if ($objects['status'] == 'Got') echo " SELECTED";echo ">Got
  <option value=\"Need\""; if ($objects['status'] == 'Need') echo " SELECTED";echo ">Need
  <option value=\"Want\""; if ($objects['status'] == 'Want') echo " SELECTED";echo ">Want
  <option value=\"Buy If On Sale\""; if ($objects['status'] == 'Buy If On Sale') echo " SELECTED";echo ">Buy If On Sale
";
echo "</select>
</td>
</tr>
<tr>
  <td>Frequency</td>
  <td><input name=purchase_frequency value=\"" . $objects['purchase_frequency'] . "\"></td>
</tr>
<tr>
  <td>Frequency Units</td>
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
  <td>Desired Price</td>
  <td><input name=desired_price value=\"" . displayField($objects['desired_price'], "NUMBER", "####.00") . "\"></td>
</tr>
<tr>
  <td>Price Units</td>
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
  <td>Current Quantity</td>
  <td><input name=current_quantity value=\"" . $objects['current_quantity'] . "\"></td>
</tr>
<tr>
  <td>Quantity Units</td>
  <td><input name=quantity_units value=\"" . $objects['quantity_units'] . "\"></td>
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

  if ($_GET['product_type'] == "") $_GET['product_type'] = 'All';
  $product_type = $_GET['product_type'];
  echo "<a href=index.php?view=shopping_list&action=display_create_form>Add Shopping List Item</a><select name=product_type onChange=\"window.open('index.php?view=shopping_list&product_type=' + this.options[this.selectedIndex].value,'_self');\">\n";

$objects['product_type'] = '';
$select_query = tep_db_query("SELECT subcategory AS _key, value FROM reference WHERE category = 'Product Type' ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($product_type == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select><br>";
  $rows = 0;
  echo "<table border=1 width=\"100%\">";
  echo "<tr><td align=center><b>Action</b></td><td align=center><b>Product</b></td><td align=center><b>Status</b></td></tr>\n";

  $filter = "";
  if (isset($_GET['product_type']) && $_GET['product_type'] != 'All')
     $filter = " AND product.product_type = '" . $_GET['product_type'] . "' ";

  $rows = 0;
//concat(vendor_name, ' ', product_name)  as value 
  $objects_query = tep_db_query("SELECT shopping_list_id as id, shopping_list.*, user.*, product.*, concat(vendor_name, ' ', product_name) as product_name2  FROM shopping_list, user, product, vendor WHERE product.vendor_id = vendor.vendor_id AND shopping_list.product_id = product.product_id AND shopping_list.user_id = user.user_id AND shopping_list.user_id = '" . $user_id . "'" . $filter . "ORDER BY status DESC, product_name");

  while ($objects = tep_db_fetch_array($objects_query)) 
  {
     $rows++;
     $sales_query = tep_db_query("SELECT * FROM store, sale, sale_line_item WHERE store.store_id = sale.store_id AND sale_line_item.sale_id = sale.sale_id AND sale_line_item.product_id = " . $objects['product_id'] . " AND end_date >= now()");
     $onSale = false;
     $saleString = "$$$";
     if (mysql_num_rows($sales_query) > 0)
     {
        $saleString = "<font color=green> ("; 
        while ($sales = tep_db_fetch_array($sales_query)) 
        {
           $saleString .= $sales['store_name'] . ", ";
        }
        $saleString = substr($saleString, 0, strlen($saleString) - 2);
        $saleString .= ")</font>"; 
        $onSale = true;
     }

     echo "<tr><a name=\"" . $objects['shopping_list_id'] . "\"></a><td><a href=" . $urlPrefix . "action=delete&shopping_list_id=" . $objects['shopping_list_id'] . ">Delete</a><br><a href=" . $urlPrefix . "action=display_edit_form&shopping_list_id=" . $objects['shopping_list_id'] . ">Edit</a>";
if ($objects['status'] == 'Need')
{
   echo "<br><a href=index.php?view=shopping_list&action=update_field&field=status&value=Got&shopping_list_id=" . $objects['shopping_list_id'] . "#" . $objects['shopping_list_id'] . ">Got it</a>";
}
else
{
   echo "<br><a href=index.php?view=shopping_list&action=update_field&field=status&value=Need&shopping_list_id=" . $objects['shopping_list_id'] . "#" . $objects['shopping_list_id'] . ">Need</a>";
}
if (strpos($objects['product_name2'], "Any ") !== false)
{
   $objects['product_name2'] = substr($objects['product_name2'], 4);
}
echo "</td>  <td><a href=index.php?view=shopping_list&action=display&shopping_list_id=" . $objects['shopping_list_id'] . ">" . displayField($objects['product_name2'],'STRING','') . ($onSale? $saleString:"") . (strlen($objects['other_product_name']) > 0?" (" . $objects['other_product_name'] . ")":"" ) . "</a></td>  <td>" . displayField($objects['status'],'STRING','') . "</td></tr>\n";

  }
  if ($rows == 0)
  {
     echo "<tr><td colspan=5 align=center>No Results</td></tr>";
  }
  echo "</table>";

if ($rows > 0 && isset($_GET['action']) && ($_GET['action'] == 'search')) 
{
   //include($hfPrefix . "footer.php");
   return;
}

if ($mobilesite == 'true') 
{
   //include($hfPrefix . "footer.php");
}

?>
