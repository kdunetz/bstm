<p>
<center><h3><font color=blue>Product Best Price</font></h3></center>
<p>
<?php
  $urlPrefix = "";
  if ($mobilesite == 'true')
  {
     $urlPrefix = "product_best_price.php?";
     $urlPrefixShort = "product_best_price.php";
  }
  else
  {
     $urlPrefix = "index.php?view=product_best_price&";
     $urlPrefixShort = "index.php?view=product_best_price";
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
      tep_db_query("DELETE FROM product_best_price WHERE product_best_price_id = " . $_GET['product_best_price_id']);
      if (isset($_GET['redirect_url']))
      {
          tep_redirect(tep_href_link($_GET['redirect_url'],'','SSL'));
      }
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'update_field'))
  {
      tep_db_query("UPDATE product_best_price SET " . $_GET['field'] . "= '" .  $_GET['value'] . "' WHERE product_best_price_id = " . $_GET['product_best_price_id']);
      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
  }

  if (isset($_POST['action']) && ($_POST['action'] == 'edit')) 
  {
if (empty($_POST['product_best_price_name'])) {
   $messageStack->add('Product Best Price Name is required');
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
'product_best_price_name' => $_POST['product_best_price_name'],
'product_id' => $_POST['product_id'],
'discount' => $_POST['discount'],
'price' => $_POST['price'],
'price_units' => $_POST['price_units'],
'cost_per_unit' => $_POST['cost_per_unit'],
'cost_per_unit_units' => $_POST['cost_per_unit_units'],
'special_promotion' => $_POST['special_promotion'],
'_limit' => $_POST['_limit'],
'quantity' => $_POST['quantity'],
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'view' && $key != 'redirect_url')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('product_best_price', $sql_data_array, 'update', "product_best_price_id = " . $_POST['product_best_price_id']);

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
if (empty($_POST['product_best_price_name'])) {
   $messageStack->add('Product Best Price Name is required');
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
if ($messageStack->size > 0)
{
   echo $messageStack->output(); 
   include($hfPrefix . "footer.php");
   return;
}

$objects_query = tep_db_query("select * from product_best_price WHERE 1 = 2");
      if (mysql_num_rows($objects_query) == 0)
      {
         $sql_data_array = array('creation_date' => 'now()',
'created_by' => $user_id,
'modification_date' => 'now()',
'modified_by' => $user_id,
'product_best_price_name' => $_POST['product_best_price_name'],
'product_id' => $_POST['product_id'],
'discount' => $_POST['discount'],
'price' => $_POST['price'],
'price_units' => $_POST['price_units'],
'cost_per_unit' => $_POST['cost_per_unit'],
'cost_per_unit_units' => $_POST['cost_per_unit_units'],
'special_promotion' => $_POST['special_promotion'],
'_limit' => $_POST['_limit'],
'quantity' => $_POST['quantity'],
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'view' && $key != 'redirect_url')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('product_best_price', $sql_data_array, 'insert', "product_best_price_id = " . $_POST['product_best_price_id']);

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
     echo "Please confirm you would like to delete this product_best_price<br><hr>";
     if (isset($_GET['redirect_url']))
     {
        $redirect_url = "redirect_url=" . urlencode($_GET['redirect_url']);
        $redirect_url_with_ampersand = "&" . $redirect_url;
     }
     echo "<a href=\" . $urlPrefix . \"action=delete_confirm&product_best_price_id=" . $_GET['product_best_price_id'] . $redirect_url_with_ampersand . ">Yes</a>";
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
    if (!isset($_GET['product_best_price_id']) && isset($_POST['product_best_price_id']))
        $_GET['product_best_price_id'] = $_POST['product_best_price_id'];

/* KAD leave off the ending quotes because it is an equation on the end */
     $objects_query = tep_db_query("SELECT product_best_price.*, product.product_name, store.store_name FROM product_best_price, product, store WHERE product_best_price.product_id = product.product_id AND store.store_id = product_best_price.store_id AND product_best_price.product_best_price_id = " . $_GET['product_best_price_id']);
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
     echo "<a class=\"button\" href=" . $urlPrefix . "action=display_edit_form&product_best_price_id=" . $objects['product_best_price_id'] . "><span>Edit</span></a><br>\n";
//$objects['price'] = substr($objects['price'], 0, strlen($objects['price']) - 2);
$objects['cost_per_unit'] = substr($objects['cost_per_unit'], 0, strlen($objects['cost_per_unit']) - 2);
echo "<table class=contenttoc width=100% border=1>
<tr>
  <td class=sectiontableheader>Product Best Price Name</td>
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
  <td class=sectiontableheader>Product Name</td>
  <td class=bstm_td><a href=index.php?view=product&action=display&product_id=" . $objects['product_id'] . ">" .  $objects['product_name']  . "</a></td>
</tr>
<tr>
  <td class=sectiontableheader>Discount</td>
  <td class=bstm_td>" .  $objects['discount']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Price</td>
  <td class=bstm_td>$" .  $objects['price']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Price Units</td>
  <td class=bstm_td>" .  $objects['price_units']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Cost Per Unit</td>
  <td class=bstm_td>$" .  $objects['cost_per_unit']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>CPU Units</td>
  <td class=bstm_td>" .  $objects['cost_per_unit_units']  . "</td>
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
echo "<table width=100% border=1>
<tr>
  <td>Product Best Price Name: *</td>
  <td><input name=product_best_price_name value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Other Store Name: *</td>
  <td><input name=other_store_name value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Product Name: *</td>
  <td>
<select name=product_id>
  <option>";
$objects['product_id'] = '';
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
  <td>Discount:</td>
  <td><input name=discount value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Price: *</td>
  <td><input name=price value=\"" . '' . "\"></td>
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
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['product_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Cost Per Unit:</td>
  <td><input name=cost_per_unit value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>CPU Units:</td>
  <td><input name=cost_per_unit_units value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Comments:</td>
  <td>
<textarea rows=6 cols=6 name=comments>" . $objects['comments'] . "</textarea></td>
</tr>
</table>

    <input type=\"submit\">
    </form>";
    include($hfPrefix . "footer.php");
    return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display_edit_form')) 
  {
     $objects_query = tep_db_query("select * from product_best_price WHERE product_best_price_id = " . $_GET['product_best_price_id']);
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
  <td>Product Best Price Name: *</td>
  <td><input name=product_best_price_name value=\"" . $objects['product_best_price_name'] . "\"></td>
</tr>
<tr>
  <td>Other Store Name: *</td>
  <td><input name=other_store_name value=\"" . $objects['other_store_name']  . "\"></td>
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
  <td>Discount:</td>
  <td><input name=discount value=\"" . $objects['discount'] . "\"></td>
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
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['product_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
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
  <td>Comments:</td>
  <td>
<textarea rows=6 cols=6 name=comments>" . $objects['comments'] . "</textarea></td>
</tr>
</table>

    <input type=\"submit\">
    </form>\n";
    include($hfPrefix . "footer.php");
    return;
  }

  $rows = 0;
  echo "<a href=\" . $urlPrefix . \"action=display_create_form>Add Product Best Price</a>";
  echo "<table border=1 width=\"100%\">";
  echo "<tr><td align=center><b>Action</b></td><td align=center><b>Name</b></td><td align=center><b>Product Name</b></td><td align=center><b>Price</b></td></tr>\n";

  $objects_query = tep_db_query("SELECT product_best_price_id as id, product.product_name, product_best_price.* FROM product_best_price, product WHERE product.product_id = product_best_price.product_id");
  while ($objects = tep_db_fetch_array($objects_query)) 
  {
     $rows++;

     echo "<tr><a name=\"" . $objects['product_best_price_id'] . "\"></a><td><a href=" . $URLPrefix . "action=delete&product_best_price_id=" . $objects['product_best_price_id'] . ">Delete</a><br><a href=" . $URLPrefix . "action=display_edit_form&product_best_price_id=" . $objects['product_best_price_id'] . ">Edit</a>";
echo "</td>  <td><a href=product_best_price.php?action=display&product_best_price_id=" . $objects['product_best_price_id'] . ">" . displayField($objects['product_best_price_name'],'STRING','') . "</a></td>  <td>" . displayField($objects['product_name'],'STRING','') . "</td>  <td align=right>" . displayField($objects['price'],'NUMBER','$###,###.00') . "</td></tr>\n";

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
