<?php
  $urlPrefix = "";
  if ($mobilesite == 'true')
  {
     $urlPrefix = "receipt_line_item.php?";
     $urlPrefixShort = "receipt_line_item.php";
  }
  else
  {
     $urlPrefix = "index.php?view=receipt_line_item&";
     $urlPrefixShort = "index.php?view=receipt_line_item";
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
      tep_db_query("DELETE FROM receipt_line_item WHERE receipt_line_item_id = " . $_GET['receipt_line_item_id']);
      if (isset($_GET['redirect_url']))
      {
          tep_redirect(tep_href_link($_GET['redirect_url'],'','SSL'));
      }
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'update_field'))
  {
      tep_db_query("UPDATE receipt_line_item SET " . $_GET['field'] . "= '" .  $_GET['value'] . "' WHERE receipt_line_item_id = " . $_GET['receipt_line_item_id']);
      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
  }

  if (isset($_POST['action']) && ($_POST['action'] == 'edit')) 
  {
if (empty($_POST['receipt_line_item_name'])) {
   $messageStack->add('Receipt Line Item Name is required');
}
if (empty($_POST['product_id'])) {
   $messageStack->add('Product Name is required');
}
if (empty($_POST['price'])) {
   $messageStack->add('Price is required');
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
'receipt_line_item_name' => $_POST['receipt_line_item_name'],
'product_id' => $_POST['product_id'],
'price' => $_POST['price'],
'cost_per_unit' => $_POST['cost_per_unit'],
'unit' => $_POST['unit'],
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'view' && $key != 'redirect_url')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('receipt_line_item', $sql_data_array, 'update', "receipt_line_item_id = " . $_POST['receipt_line_item_id']);

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
if (empty($_POST['receipt_line_item_name'])) {
   $messageStack->add('Receipt Line Item Name is required');
}
if (empty($_POST['product_id'])) {
   $messageStack->add('Product Name is required');
}
if (empty($_POST['price'])) {
   $messageStack->add('Price is required');
}
if ($messageStack->size > 0)
{
   echo $messageStack->output(); 
   include($hfPrefix . "footer.php");
   return;
}

$objects_query = tep_db_query("select * from receipt_line_item WHERE 1 = 2");
      if (mysql_num_rows($objects_query) == 0)
      {
         $sql_data_array = array('creation_date' => 'now()',
'created_by' => $user_id,
'modification_date' => 'now()',
'modified_by' => $user_id,
'receipt_line_item_name' => $_POST['receipt_line_item_name'],
'product_id' => $_POST['product_id'],
'price' => $_POST['price'],
'cost_per_unit' => $_POST['cost_per_unit'],
'unit' => $_POST['unit'],
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'view' && $key != 'redirect_url')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('receipt_line_item', $sql_data_array, 'insert', "receipt_line_item_id = " . $_POST['receipt_line_item_id']);

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
     echo "Please confirm you would like to delete this receipt_line_item<br><hr>";
     if (isset($_GET['redirect_url']))
     {
        $redirect_url = "redirect_url=" . urlencode($_GET['redirect_url']);
        $redirect_url_with_ampersand = "&" . $redirect_url;
     }
     echo "<a href=\" . $urlPrefix . \"action=delete_confirm&receipt_line_item_id=" . $_GET['receipt_line_item_id'] . $redirect_url_with_ampersand . ">Yes</a>";
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
    if (!isset($_GET['receipt_line_item_id']) && isset($_POST['receipt_line_item_id']))
        $_GET['receipt_line_item_id'] = $_POST['receipt_line_item_id'];

/* KAD leave off the ending quotes because it is an equation on the end */
     $objects_query = tep_db_query("SELECT receipt_line_item.*, product.product_name FROM receipt_line_item, product WHERE receipt_line_item.product_id = product.product_id AND receipt_line_item.receipt_line_item_id = " . $_GET['receipt_line_item_id']);
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
     echo "<a href=" . $urlPrefix . "action=display_edit_form&receipt_line_item_id=" . $objects['receipt_line_item_id'] . ">Edit</a>
<table width=100% border=1>
<tr>
  <td>Receipt Line Item Id:</td>
  <td>" .  $objects['receipt_line_item_id']  . "</td>
</tr>
<tr>
  <td>Receipt Line Item Name: *</td>
  <td>" .  $objects['receipt_line_item_name']  . "</td>
</tr>
<tr>
  <td>Product Name: *</td>
  <td>" .  $objects['product_name']  . "</td>
</tr>
<tr>
  <td>Price: *</td>
  <td>" .  $objects['price']  . "</td>
</tr>
<tr>
  <td>Cost Per Unit:</td>
  <td>" .  $objects['cost_per_unit']  . "</td>
</tr>
<tr>
  <td>Units:</td>
  <td>" .  $objects['unit']  . "</td>
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
  <td>Receipt Line Item Name: *</td>
  <td><input name=receipt_line_item_name value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Product Name: *</td>
  <td>
<select name=product_id>
  <option>";
$objects['product_id'] = '';$select_query = tep_db_query("SELECT product_id as _key, concat(vendor_name, ' ', product_name)  as value FROM product,vendor WHERE product.vendor_id = vendor.vendor_id ORDER BY product_name");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['product_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Price: *</td>
  <td><input name=price value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Cost Per Unit:</td>
  <td><input name=cost_per_unit value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Units:</td>
  <td>
<select name=unit>
  <option>";
$objects['unit'] = '';$select_query = tep_db_query("SELECT subcategory AS _key, value FROM reference WHERE category = 'Unit of Measure' ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['unit'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
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
     $objects_query = tep_db_query("select * from receipt_line_item WHERE receipt_line_item_id = " . $_GET['receipt_line_item_id']);
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
  <td>Receipt Line Item Name: *</td>
  <td><input name=receipt_line_item_name value=\"" . $objects['receipt_line_item_name'] . "\"></td>
</tr>
<tr>
  <td>Product Name: *</td>
  <td>
<select name=product_id>
  <option>";
$select_query = tep_db_query("SELECT product_id as _key, concat(vendor_name, ' ', product_name)  as value FROM product,vendor WHERE product.vendor_id = vendor.vendor_id ORDER BY product_name");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['product_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Price: *</td>
  <td><input name=price value=\"" . $objects['price'] . "\"></td>
</tr>
<tr>
  <td>Cost Per Unit:</td>
  <td><input name=cost_per_unit value=\"" . $objects['cost_per_unit'] . "\"></td>
</tr>
<tr>
  <td>Units:</td>
  <td>
<select name=unit>
  <option>";
$select_query = tep_db_query("SELECT subcategory AS _key, value FROM reference WHERE category = 'Unit of Measure' ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['unit'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
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
  echo "<a href=\" . $urlPrefix . \"action=display_create_form>Add Receipt Line Item</a>";
  echo "<table border=1 width=\"100%\">";
  echo "<tr><td align=center><b>Action</b></td><td align=center><b>Name</b></td><td align=center><b>Product Name</b></td><td align=center><b>Price</b></td></tr>\n";

  $objects_query = tep_db_query("SELECT receipt_line_item_id as id, product.product_name, receipt_line_item.* FROM receipt_line_item, product WHERE product.product_id = receipt_line_item.product_id");
  while ($objects = tep_db_fetch_array($objects_query)) 
  {
     $rows++;

     echo "<tr><a name=\"" . $objects['receipt_line_item_id'] . "\"></a><td><a href=" . $URLPrefix . "action=delete&receipt_line_item_id=" . $objects['receipt_line_item_id'] . ">Delete</a><br><a href=" . $URLPrefix . "action=display_edit_form&receipt_line_item_id=" . $objects['receipt_line_item_id'] . ">Edit</a>";
echo "</td>  <td><a href=receipt_line_item.php?action=display&receipt_line_item_id=" . $objects['receipt_line_item_id'] . ">" . displayField($objects['receipt_line_item_name'],'STRING','') . "</a></td>  <td>" . displayField($objects['product_name'],'STRING','') . "</td>  <td align=right>" . displayField($objects['price'],'NUMBER','$###,###.00') . "</td></tr>\n";

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
