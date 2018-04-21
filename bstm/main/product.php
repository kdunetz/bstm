<div class="componentheading">Product</div>
<?php

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
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'redirect_url')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('product', $sql_data_array, 'update', "product_id = " . $_POST['product_id']);

      if (isset($_POST['redirect_url']))
      {
          tep_redirect(tep_href_link($_POST['redirect_url'],'','SSL'));
      }
      tep_redirect(tep_href_link('product.php?action=display&product_id=' . $_POST['product_id'],'','SSL'));
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
 if ($messageStack->size > 0) { echo $messageStack->output(); return; }

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
'comments' => $_POST['comments']);
while(list($key,$value) = each($_POST)) {
  if (!isset($sql_data_array[$key]) && $key != 'action' && $key != 'redirect_url')
  {
      $sql_data_array[$key] = $value;
  }
}
tep_db_perform('product', $sql_data_array, 'insert', "product_id = " . $_POST['product_id']);

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
     echo "Please confirm<br><hr>";
     if (isset($_GET['redirect_url']))
     {
        $redirect_url = "redirect_url=" . urlencode($_GET['redirect_url']);
        $redirect_url_with_ampersand = "&" . $redirect_url;
     }
     echo "<a href=product.php?action=delete_confirm&product_id=" . $_GET['product_id'] . $redirect_url_with_ampersand . ">Yes</a>";
     echo "<hr>";
     if (isset($_GET['redirect_url']))
     {
        echo "<a href=" . $redirect_url . ">No</a>";
     }
     else
     {
        echo "<a href=product.php>No</a>";
     }
     return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display')) 
  {
     printAddThisButton();
/* KAD leave off the ending quotes because it is an equation on the end */
     $objects_query = tep_db_query("SELECT product.*,vendor.vendor_name FROM product,vendor WHERE product.vendor_id = vendor.vendor_id AND product.product_id = " . $_GET['product_id']);
     $objects = tep_db_fetch_array($objects_query);
     if (!empty($objects['image_name']))
        echo "<img src=../common/images/" . $objects['image_name'] . ">\n";
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
     echo "<div id=\"content\">\n";
     if (tep_session_is_registered('user_id'))
     {
        if (($role == 'admin' || $objects['user_id'] == $user_id) && strlen($objects['deal_id']) == 0)
        {
           echo "<a class=button href=product.php?action=display_edit_form&product_id=" . $objects['product_id'] . "><span>Edit</span></a>\n";
        }
     }
echo "<table class=contenttoc width=100% border=1>
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

     echo "</div> <!- content ->";
     return;
  }
  if (isset($_GET['action']) && ($_GET['action'] == 'display_create_form')) 
  {
    echo "<div id=\"content\">
    <form action=\"product.php\" method=\"post\">
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
  if (isset($_GET['action']) && ($_GET['action'] == 'display_edit_form')) 
  {
     $objects_query = tep_db_query("select * from product WHERE product_id = " . $_GET['product_id']);
     $objects = tep_db_fetch_array($objects_query);
    echo "<div id=\"content\">
    <form action=\"product.php\" method=\"post\">
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

  $rows = 0;
  echo "<a href=product.php?action=display_create_form>Add Product</a>";
  echo "<table border=1 width=\"100%\">";
  echo "<tr><td align=center><b>Action</b></td><td align=center><b>Name</b></td><td align=center><b>Vendor</b></td></tr>\n";

  $objects_query = tep_db_query("SELECT product_id as id, product.*, vendor.* FROM product, vendor WHERE product.vendor_id = vendor.vendor_id ORDER BY product_name");
  while ($objects = tep_db_fetch_array($objects_query)) 
  {
     $rows++;

     echo "<tr><a name=\"" . $objects['product_id'] . "\"></a><td><a href=product.php?action=delete&product_id=" . $objects['product_id'] . ">Delete</a><br><a href=product.php?action=display_edit_form&product_id=" . $objects['product_id'] . ">Edit</a>";
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
   return;
}

?>
  <div id="pageFooter">
    <div class="uim first last" id="defaultFooter">
      <div class="bd">
        <div class="uic small first"> 
          <a class="inline" href="set_my_location.php><span>Set My Location</span></a> 
        </div>
        <div class="uic small"> 
          <a class="inline" href="settings.php"><span>Settings</span></a> 
        </div>
        <div class="uic small"> 
<?php
          if (tep_session_is_registered('user_id')) {
              echo "<a class=\"inline\" href=\"logoff.php\"><span>Log Off</span></a>\n";
          }
?>
          <span> | </span>
          <a class="inline" href="privacy.php"><span>Privacy</span></a> 
          <span> | </span> 
          <a class="inline" href="legal.php"><span>Legal</span></a> 
        </div>
        <div class="uic small last"> © 2011 Bring Savings To Me! - All rights reserved </div>
      </div>
    </div>
  </div> <!- Page Footer ->
</div> <!- Page ->
</body>
</html>
