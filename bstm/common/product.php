<p>
<center><h3><font color=blue>Product</font></h3></center>
<p>
<?php
  $urlPrefix = "";
  if ($mobilesite == 'true')
  {
     $urlPrefix = "product.php?";
     $urlPrefixShort = "product.php";
  }
  else
  {
     $urlPrefix = "index.php?view=product&";
     $urlPrefixShort = "index.php?view=product";
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
      tep_db_query("DELETE FROM product WHERE product_id = " . $_GET['product_id']);
      if (isset($_GET['redirect_url']))
      {
          tep_redirect(tep_href_link($_GET['redirect_url'],'','SSL'));
      }
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'update_field'))
  {
      tep_db_query("UPDATE product SET " . $_GET['field'] . "= '" .  $_GET['value'] . "' WHERE product_id = " . $_GET['product_id']);
      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
  }

  if (isset($_POST['action']) && ($_POST['action'] == 'edit')) 
  {
if (empty($_POST['product_name'])) {
   $messageStack->add('Product Name is required');
}
if (empty($_POST['product_type'])) {
   $messageStack->add('Product Type is required');
}
if (empty($_POST['vendor_id'])) {
   $messageStack->add('Vendor Name is required');
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
'product_name' => $_POST['product_name'],
'product_type' => $_POST['product_type'],
'vendor_id' => $_POST['vendor_id'],
'packaging_quantity' => $_POST['packaging_quantity'],
'packaging_size' => $_POST['packaging_size'],
'packaging_units' => $_POST['packaging_units'],
'packaging_type' => $_POST['packaging_type'],
'best_unit_cost' => $_POST['best_unit_cost'],
'best_unit_cost_units' => $_POST['best_unit_cost_units'],
'best_unit_cost_date' => userToSQLDate($_POST['best_unit_cost_date']),
'best_unit_cost_store_name' => $_POST['best_unit_cost_store_name'],
'image_name' => $_POST['image_name'],
'upc_code' => $_POST['upc_code'],
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'view' && $key != 'redirect_url')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('product', $sql_data_array, 'update', "product_id = " . $_POST['product_id']);

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
if (empty($_POST['product_name'])) {
   $messageStack->add('Product Name is required');
}
if (empty($_POST['product_type'])) {
   $messageStack->add('Product Type is required');
}
if (empty($_POST['vendor_id'])) {
   $messageStack->add('Vendor Name is required');
}
if ($messageStack->size > 0)
{
   echo $messageStack->output(); 
   //include($hfPrefix . "footer.php");
   return;
}

$objects_query = tep_db_query("select * from product WHERE product_id != " . cs($_POST['product_id'],"0") . " AND PRODUCT_NAME= '" . $_POST['product_name'] . "' AND VENDOR_ID= '" . $_POST['vendor_id'] . "'");
      if (mysql_num_rows($objects_query) == 0)
      {
         $sql_data_array = array('creation_date' => 'now()',
'created_by' => $user_id,
'modification_date' => 'now()',
'modified_by' => $user_id,
'product_name' => $_POST['product_name'],
'product_type' => $_POST['product_type'],
'vendor_id' => $_POST['vendor_id'],
'packaging_quantity' => $_POST['packaging_quantity'],
'packaging_size' => $_POST['packaging_size'],
'packaging_units' => $_POST['packaging_units'],
'packaging_type' => $_POST['packaging_type'],
'best_unit_cost' => $_POST['best_unit_cost'],
'best_unit_cost_units' => $_POST['best_unit_cost_units'],
'best_unit_cost_date' => userToSQLDate($_POST['best_unit_cost_date']),
'best_unit_cost_store_name' => $_POST['best_unit_cost_store_name'],
'image_name' => $_POST['image_name'],
'upc_code' => $_POST['upc_code'],
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'view' && $key != 'redirect_url')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('product', $sql_data_array, 'insert', "product_id = " . $_POST['product_id']);

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
     echo "Please confirm you would like to delete this product<br><hr>";
     if (isset($_GET['redirect_url']))
     {
        $redirect_url = "redirect_url=" . urlencode($_GET['redirect_url']);
        $redirect_url_with_ampersand = "&" . $redirect_url;
     }
     echo "<a href=\" . $urlPrefix . \"action=delete_confirm&product_id=" . $_GET['product_id'] . $redirect_url_with_ampersand . ">Yes</a>";
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
    if (!isset($_GET['product_id']) && isset($_POST['product_id']))
        $_GET['product_id'] = $_POST['product_id'];

/* KAD leave off the ending quotes because it is an equation on the end */
     $objects_query = tep_db_query("SELECT product.*,vendor.vendor_name FROM product,vendor WHERE product.vendor_id = vendor.vendor_id AND product.product_id = " . $_GET['product_id']);
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
        echo "<a href=" . $urlPrefix . "action=display_edit_form&product_id=" . $objects['product_id'] . ">Edit</a>\n";

echo "<center><table class=contenttoc width=100% border=1>
<tr>
  <td class=sectiontableheader>Product Name</td>
  <td class=bstm_td>" .  $objects['product_name']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Product Type</td>
  <td class=bstm_td>" .  $objects['product_type']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Vendor Name</td>
  <td class=bstm_td>" .  $objects['vendor_name']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Packaging Quantity</td>
  <td class=bstm_td>" .  $objects['packaging_quantity']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Packaging Size (#)</td>
  <td class=bstm_td>" .  $objects['packaging_size']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Packaging Units</td>
  <td class=bstm_td>" .  $objects['packaging_units']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Packaging Type</td>
  <td class=bstm_td>" .  $objects['packaging_type']  . "</td>
</tr>
<tr>
  <td class=sectiontableheader>Comments</td>
  <td class=bstm_td>" .  $objects['comments']  . "</td>
</tr>
</table>";

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
  <td>Product Name: *</td>
  <td><input name=product_name value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Product Type: *</td>
  <td>
<select name=product_type>
  <option>";
$objects['product_type'] = '';$select_query = tep_db_query("SELECT subcategory AS _key, value FROM reference WHERE category = 'Product Type' ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['product_type'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Vendor Name: *</td>
  <td>
<select name=vendor_id>
  <option>";
$objects['vendor_id'] = '';$select_query = tep_db_query("SELECT vendor_id as _key, vendor_name as value FROM vendor ORDER BY vendor_name");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['vendor_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Packaging Quantity:</td>
  <td><input name=packaging_quantity value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Packaging Size (#):</td>
  <td><input name=packaging_size value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Packaging Units:</td>
  <td>
<select name=packaging_units>
  <option>";
$objects['packaging_units'] = '';$select_query = tep_db_query("SELECT subcategory AS _key, value FROM reference WHERE category = 'Unit of Measure' ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['packaging_units'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Packaging Type:</td>
  <td>
<select name=packaging_type>
  <option>";
$objects['packaging_type'] = '';$select_query = tep_db_query("SELECT subcategory AS _key, value FROM reference WHERE category = 'Packaging Type' ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['packaging_type'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Best Unit Cost:</td>
  <td><input name=best_unit_cost value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Best Unit Cost Units:</td>
  <td>
<select name=best_unit_cost_units>
  <option>";
$objects['best_unit_cost_units'] = '';$select_query = tep_db_query("SELECT subcategory AS _key, value FROM reference WHERE category = 'Unit of Measure' ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['best_unit_cost_units'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Best Unit Cost Date:</td>
  <td>
<input name=best_unit_cost_date value=" . sqlToUserDate($objects['best_unit_cost_date']) . "></td>
</tr>
<tr>
  <td>Best Unit Cost Store:</td>
  <td><input name=best_unit_cost_store_name value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Image Name:</td>
  <td><input name=image_name value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>UPC Code:</td>
  <td><input name=upc_code value=\"" . '' . "\"></td>
</tr>
<tr>
  <td>Comments:</td>
  <td>
<textarea rows=6 cols=25 name=comments>" . $objects['comments'] . "</textarea></td>
</tr>
</table>

    <input type=\"submit\">
    </form>";
    //include($hfPrefix . "footer.php");
    return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display_edit_form')) 
  {
     $objects_query = tep_db_query("select * from product WHERE product_id = " . $_GET['product_id']);
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
  <td>Product Name: *</td>
  <td><input name=product_name value=\"" . $objects['product_name'] . "\"></td>
</tr>
<tr>
  <td>Product Type: *</td>
  <td>
<select name=product_type>
  <option>";
$select_query = tep_db_query("SELECT subcategory AS _key, value FROM reference WHERE category = 'Product Type' ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['product_type'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Vendor Name: *</td>
  <td>
<select name=vendor_id>
  <option>";
$select_query = tep_db_query("SELECT vendor_id as _key, vendor_name as value FROM vendor ORDER BY vendor_name");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['vendor_id'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Packaging Quantity:</td>
  <td><input name=packaging_quantity value=\"" . $objects['packaging_quantity'] . "\"></td>
</tr>
<tr>
  <td>Packaging Size (#):</td>
  <td><input name=packaging_size value=\"" . $objects['packaging_size'] . "\"></td>
</tr>
<tr>
  <td>Packaging Units:</td>
  <td>
<select name=packaging_units>
  <option>";
$select_query = tep_db_query("SELECT subcategory AS _key, value FROM reference WHERE category = 'Unit of Measure' ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['packaging_units'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Packaging Type:</td>
  <td>
<select name=packaging_type>
  <option>";
$select_query = tep_db_query("SELECT subcategory AS _key, value FROM reference WHERE category = 'Packaging Type' ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['packaging_type'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Best Unit Cost:</td>
  <td><input name=best_unit_cost value=\"" . $objects['best_unit_cost'] . "\"></td>
</tr>
<tr>
  <td>Best Unit Cost Units:</td>
  <td>
<select name=best_unit_cost_units>
  <option>";
$select_query = tep_db_query("SELECT subcategory AS _key, value FROM reference WHERE category = 'Unit of Measure' ORDER BY value");
while ($select = tep_db_fetch_array($select_query))
{
   $rows++;
   echo "<option value=\"" . $select['_key'] . "\""; if ($objects['best_unit_cost_units'] == $select['_key']) echo " SELECTED"; echo ">" . $select['value'];
}
echo "</select>
</td>
</tr>
<tr>
  <td>Best Unit Cost Date:</td>
  <td>
<input name=best_unit_cost_date value=" . sqlToUserDate($objects['best_unit_cost_date']) . "></td>
</tr>
<tr>
  <td>Best Unit Cost Store:</td>
  <td><input name=best_unit_cost_store_name value=\"" . $objects['best_unit_cost_store_name'] . "\"></td>
</tr>
<tr>
  <td>Image Name:</td>
  <td><input name=image_name value=\"" . $objects['image_name'] . "\"></td>
</tr>
<tr>
  <td>UPC Code:</td>
  <td><input name=upc_code value=\"" . $objects['upc_code'] . "\"></td>
</tr>
<tr>
  <td>Comments:</td>
  <td>
<textarea rows=6 cols=25 name=comments>" . $objects['comments'] . "</textarea></td>
</tr>
</table>

    <input type=\"submit\">
    </form>";
    //include($hfPrefix . "footer.php");
    return;
  }

  $rows = 0;
  echo "<a href=\" . $urlPrefix . \"action=display_create_form>Add Product</a>";
  echo "<table border=1 width=\"100%\">";
  echo "<tr><td align=center><b>Action</b></td><td align=center><b>Name</b></td><td align=center><b>Vendor</b></td></tr>\n";

  $objects_query = tep_db_query("SELECT product_id as id, product.*, vendor.* FROM product, vendor WHERE product.vendor_id = vendor.vendor_id ORDER BY product_name");
  while ($objects = tep_db_fetch_array($objects_query)) 
  {
     $rows++;

     echo "<tr><a name=\"" . $objects['product_id'] . "\"></a><td><a href=" . $URLPrefix . "action=delete&product_id=" . $objects['product_id'] . ">Delete</a><br><a href=" . $URLPrefix . "action=display_edit_form&product_id=" . $objects['product_id'] . ">Edit</a>";
echo "</td>  <td><a href=product.php?action=display&product_id=" . $objects['product_id'] . ">" . displayField($objects['product_name'],'STRING','') . "</a></td>  <td>" . displayField($objects['vendor_name'],'STRING','') . "</td></tr>\n";

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
